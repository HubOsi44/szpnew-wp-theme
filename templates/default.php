<?php
/**
 * Template Name: Default
 * Template Post Type: page
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();

$top_bg = get_field('top_bg');

?>

<main id="main" class="default-page py-4 py-lg-5" role="main">
    <div class="container">
        <?php
        while (have_posts()) : the_post();
            the_content(__('Continue reading <span class="meta-nav">&rarr;</span>', 'wp-bootstrap-starter'));
        endwhile;
        ?>
    </div>
</main>

<?php get_footer(); ?>