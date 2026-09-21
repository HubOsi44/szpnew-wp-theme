<?php
if (!defined('ABSPATH')) {
    exit;
}

/**
 * Basic theme setup.
 */
function szpnew_theme_setup()
{
    load_theme_textdomain('szpnew-wp-theme', get_template_directory() . '/languages');

    add_theme_support('title-tag');
    add_theme_support('post-thumbnails');
    add_theme_support('automatic-feed-links');
    add_theme_support('html5', ['search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script']);
    add_theme_support('custom-logo', [
        'height'      => 120,
        'width'       => 320,
        'flex-height' => true,
        'flex-width'  => true,
    ]);

    register_nav_menus([
        'main-menu'   => __('Main Menu', 'szpnew-wp-theme'),
        'footer-menu' => __('Footer Menu', 'szpnew-wp-theme'),
    ]);
}
add_action('after_setup_theme', 'szpnew_theme_setup');

/**
 * Return theme version for cache-busting.
 */
function szpnew_theme_version()
{
    $theme = wp_get_theme();
    $version = $theme->get('Version');

    return is_string($version) && $version !== '' ? $version : null;
}

/**
 * Estimate reading time in minutes.
 * Uses Yoast value when available, then falls back to local word count.
 */
function szpnew_get_reading_time_minutes($post_id = null)
{
    $post = get_post($post_id);
    if (!$post instanceof WP_Post) {
        return 0;
    }

    if (function_exists('YoastSEO')) {
        $yoast_meta = YoastSEO()->meta->for_post($post->ID);
        if ($yoast_meta && isset($yoast_meta->estimated_reading_time_minutes)) {
            $yoast_minutes = (int) $yoast_meta->estimated_reading_time_minutes;
            if ($yoast_minutes > 0) {
                return $yoast_minutes;
            }
        }
    }

    $content = wp_strip_all_tags(strip_shortcodes((string) $post->post_content));
    preg_match_all('/\p{L}+/u', $content, $matches);
    $word_count = isset($matches[0]) ? count($matches[0]) : 0;

    if ($word_count === 0) {
        return 0;
    }

    $words_per_minute = (int) apply_filters('szpnew_reading_words_per_minute', 180);
    if ($words_per_minute <= 0) {
        $words_per_minute = 180;
    }

    return max(1, (int) ceil($word_count / $words_per_minute));
}

/**
 * Return localized reading time label.
 */
function szpnew_get_reading_time_label($post_id = null)
{
    $minutes = szpnew_get_reading_time_minutes($post_id);
    if ($minutes <= 0) {
        return '';
    }

    return sprintf(
        _n('%d min czytania', '%d min czytania', $minutes, 'szpnew-wp-theme'),
        $minutes
    );
}

/**
 * Enqueue assets built by Vite (dist/manifest.json).
 */
function szpnew_enqueue_vite_assets()
{
    $theme_dir = get_template_directory();
    $theme_uri = get_template_directory_uri();
    $manifest_path = $theme_dir . '/dist/manifest.json';
    $entry = 'js/index.js';
    $main_style_deps = [];

    wp_enqueue_style(
        'szpnew-google-fonts',
        'https://fonts.googleapis.com/css2?family=Barlow+Condensed:wght@600;700;900&family=Poppins:ital,wght@0,400;0,600;1,400;1,600&display=swap',
        [],
        null
    );
    $main_style_deps[] = 'szpnew-google-fonts';

    if (!file_exists($manifest_path)) {
        // Safe fallback so theme still has base styles if build is missing.
        wp_enqueue_style('szpnew-style-fallback', get_stylesheet_uri(), [], szpnew_theme_version());
        return;
    }

    $manifest_raw = file_get_contents($manifest_path);
    $manifest = json_decode((string) $manifest_raw, true);

    if (!is_array($manifest) || !isset($manifest[$entry]['file'])) {
        wp_enqueue_style('szpnew-style-fallback', get_stylesheet_uri(), [], szpnew_theme_version());
        return;
    }

    if (!empty($manifest[$entry]['css']) && is_array($manifest[$entry]['css'])) {
        foreach ($manifest[$entry]['css'] as $index => $css_file) {
            wp_enqueue_style(
                'szpnew-main-' . $index,
                $theme_uri . '/dist/' . ltrim((string) $css_file, '/'),
                $main_style_deps,
                null
            );
        }
    }

    wp_enqueue_script(
        'szpnew-main',
        $theme_uri . '/dist/' . ltrim((string) $manifest[$entry]['file'], '/'),
        [],
        null,
        true
    );
    wp_script_add_data('szpnew-main', 'type', 'module');
}
add_action('wp_enqueue_scripts', 'szpnew_enqueue_vite_assets', 20);

/**
 * Prefetch Google Fonts origins.
 */
function szpnew_google_fonts_resource_hints($urls, $relation_type)
{
    if ($relation_type !== 'preconnect') {
        return $urls;
    }

    $urls[] = 'https://fonts.googleapis.com';
    $urls[] = [
        'href' => 'https://fonts.gstatic.com',
        'crossorigin' => 'anonymous',
    ];

    return $urls;
}
add_filter('wp_resource_hints', 'szpnew_google_fonts_resource_hints', 10, 2);

/**
 * Register sidebars and footer widget areas.
 */
function szpnew_register_widget_areas()
{
    register_sidebar([
        'name'          => __('Sidebar', 'szpnew-wp-theme'),
        'id'            => 'sidebar-main',
        'description'   => __('Main sidebar widgets.', 'szpnew-wp-theme'),
        'before_widget' => '<section id="%1$s" class="widget %2$s">',
        'after_widget'  => '</section>',
        'before_title'  => '<h3 class="widget-title">',
        'after_title'   => '</h3>',
    ]);

    $footer_columns = [
        'footer-1' => __('Footer Column 1', 'szpnew-wp-theme'),
        'footer-2' => __('Footer Column 2', 'szpnew-wp-theme'),
        'footer-3' => __('Footer Column 3', 'szpnew-wp-theme'),
        'footer-4' => __('Footer Column 4', 'szpnew-wp-theme'),
    ];

    foreach ($footer_columns as $id => $label) {
        register_sidebar([
            'name'          => $label,
            'id'            => $id,
            'description'   => sprintf(__('Widgets in %s.', 'szpnew-wp-theme'), $label),
            'before_widget' => '<section id="%1$s" class="widget %2$s">',
            'after_widget'  => '</section>',
            'before_title'  => '<h4 class="widget-title">',
            'after_title'   => '</h4>',
        ]);
    }

    // Global campaign widget layer rendered at the very end of footer.
    register_sidebar([
        'name'          => __('Layer Campaigne', 'szpnew-wp-theme'),
        'id'            => 'layer-campaign',
        'description'   => __('Global campaign bar/widget for all pages (e.g. fixed bottom banner).', 'szpnew-wp-theme'),
        'before_widget' => '<section id="%1$s" class="widget %2$s layer-campaign-widget">',
        'after_widget'  => '</section>',
        'before_title'  => '<h4 class="widget-title">',
        'after_title'   => '</h4>',
    ]);
}
add_action('widgets_init', 'szpnew_register_widget_areas');

/**
 * Include optional theme modules.
 */
$szpnew_optional_includes = [
    '/inc/extras.php',
    '/inc/wp_bootstrap_navwalker.php',
    '/inc/seo-services.php',
];

foreach ($szpnew_optional_includes as $relative_file) {
    $file = get_template_directory() . $relative_file;
    if (file_exists($file)) {
        require_once $file;
    }
}
