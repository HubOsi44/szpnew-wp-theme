<?php
/**
 * Template Name: Template Standard Copy
 * Template Post Type: page
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>

<main id="main" class="standard-copy-template" role="main">
    <?php
    while (have_posts()) : the_post();
        get_template_part('template-parts/header-image');
        ?>

        <section class="standard-copy-content py-4 py-lg-5">
            <div class="container">
                <?php the_content(); ?>
            </div>
        </section>
    <?php endwhile; ?>
</main>

<?php get_footer(); ?>
