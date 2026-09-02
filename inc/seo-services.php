<?php
/**
 * SEO Title and Description for Services Archive (/en/services/)
 * This file handles custom SEO tags for the services post type archive
 */

// Prevent direct access
if (!defined('ABSPATH')) exit;

/**
 * Custom SEO title for services archive
 */
add_filter('pre_get_document_title', function ($title) {
    // Only for services post type archive
    if (!is_post_type_archive('uslugi')) {
        return $title;
    }
    
    // Check if current language is English
    $current_lang = function_exists('pll_current_language') ? pll_current_language('slug') : 'pl';
    
    if ($current_lang === 'en') {
        // Return English title
        return 'Biprotech - design and delivery of industrial installations';
    }
    
    return $title;
}, 20);

/**
 * Custom meta description for services archive
 */
add_action('wp_head', function () {
    // Only for services post type archive
    if (!is_post_type_archive('uslugi')) {
        return;
    }
    
    // Check if current language is English
    $current_lang = function_exists('pll_current_language') ? pll_current_language('slug') : 'pl';
    
    if ($current_lang === 'en') {
        // Output English meta description
        $description = 'Comprehensive engineering services for industry: design, supervision, and execution of industrial installations. Specializations: chemical, petrochemical, energy, and process systems.';
        echo '<meta name="description" content="' . esc_attr($description) . '">' . "\n";
    }
}, 1);
