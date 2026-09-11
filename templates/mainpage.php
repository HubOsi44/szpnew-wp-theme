<?php

/**
 * Template Name: Mainpage Szlachetna Paczka
 * Template Post Type: page
 */

if (!defined('ABSPATH')) {
  exit;
}

get_header();

?>
<main id="main" class="mainpage-template" role="main">
    <?php if (have_posts()) : ?>
        <?php while (have_posts()) : the_post(); ?>
            <?php
            $flex_field = null;

            if (have_rows('mainpage_flex')) {
                $flex_field = 'mainpage_flex';
            } elseif (have_rows('flex_sections')) {
                // Backward-compatible fallback for older field naming.
                $flex_field = 'flex_sections';
            }
            ?>

            <?php if ($flex_field) : ?>
                <?php while (have_rows($flex_field)) : the_row(); ?>
                    <?php
                    $layout = get_row_layout();
                    ?>

                    <?php if ($layout === 'hero') : ?>
                        <?php
                        $background = get_sub_field('background');
                        $content = get_sub_field('cnt');
                        $background_url = '';

                        if (is_array($background) && !empty($background['url'])) {
                            $background_url = (string) $background['url'];
                        } elseif (is_numeric($background)) {
                            $background_url = (string) wp_get_attachment_image_url((int) $background, 'full');
                        } elseif (is_string($background) && $background !== '') {
                            $background_url = $background;
                        }
                        ?>
                        <section
                            class="mainpage-section mainpage-section-hero"
                            <?php if ($background_url) : ?>
                                style="background-image: url('<?php echo esc_url($background_url); ?>');"
                            <?php endif; ?>
                        >
                            <div class="container py-5">
                                <?php if ($content) : ?>
                                    <div class="mainpage-section-content">
                                        <?php echo wp_kses_post($content); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </section>
                    <?php elseif (current_user_can('manage_options') && $layout) : ?>
                        <section class="mainpage-section mainpage-section-missing">
                            <div class="container py-4">
                                <?php
                                echo esc_html(
                                    sprintf(
                                        __('Brak obsługi layoutu w mainpage.php: %s', 'szpnew-wp-theme'),
                                        $layout
                                    )
                                );
                                ?>
                            </div>
                        </section>
                    <?php endif; ?>
                <?php endwhile; ?>
            <?php else : ?>
                <div class="container py-4">
                    <?php the_content(); ?>
                </div>
            <?php endif; ?>
        <?php endwhile; ?>
    <?php endif; ?>
</main>

<?php get_footer(); ?>
