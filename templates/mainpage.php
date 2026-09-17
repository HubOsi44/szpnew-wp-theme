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
            }
            ?>

            <?php if ($flex_field) : ?>
                <?php while (have_rows($flex_field)) : the_row(); ?>
                    <?php
                    $layout = get_row_layout();
                    $show_section_field = get_sub_field_object('show_section');

                    if ($show_section_field && empty($show_section_field['value'])) {
                        continue;
                    }
                    ?>

                    <?php if ($layout === 'hero') : ?>
                        <?php
                        $background_url = get_sub_field('background');
                        $content = get_sub_field('cnt');

                        if (is_array($background_url)) {
                            $background_url = $background_url['url'] ?? '';
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
                    <?php elseif ($layout === 'licznik_rodzin') : ?>
                        <?php
                        $licznik_cnt = get_sub_field('licznik_cnt');
                        ?>
                        <section class="mainpage-section mainpage-section-licznik-rodzin">
                            <div class="container py-5">
                                <?php if ($licznik_cnt) : ?>
                                    <div class="mainpage-section-content">
                                        <?php echo wp_kses_post($licznik_cnt); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </section>
                    <?php elseif ($layout === 'partnerzy_dla_paczki') : ?>
                        <?php
                        $partnerzy = get_sub_field('partnerzy');
                        ?>
                        <section class="mainpage-section mainpage-section-partnerzy-dla-paczki">
                            <div class="container py-5">
                                <?php if ($partnerzy) : ?>
                                    <div class="mainpage-section-content">
                                        <?php echo wp_kses_post($partnerzy); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </section>
                    <?php elseif ($layout === 'boxy_zaangazowania') : ?>
                        <?php
                        $boxy = get_sub_field('boxy');
                        ?>
                        <section class="mainpage-section mainpage-section-boxy-zaangazowania">
                            <div class="container py-5">
                                <?php if ($boxy) : ?>
                                    <div class="mainpage-section-content">
                                        <?php echo wp_kses_post($boxy); ?>
                                    </div>
                                <?php endif; ?>
                            </div>
                        </section>
                    <?php endif; ?>
                <?php endwhile; ?>
            <?php endif; ?>

            <div class="container py-4">
                <?php the_content(); ?>
            </div>
        <?php endwhile; ?>
    <?php endif; ?>
</main>

<?php get_footer(); ?>
