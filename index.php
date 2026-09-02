<?php
if (!defined('ABSPATH')) {
    exit;
}

get_header();
?>
<main id="main" class="site-main" role="main">
    <div class="container py-4">
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <?php the_content(); ?>
            <?php endwhile; ?>
        <?php else : ?>
            <p><?php esc_html_e('No content found.', 'szpnew-wp-theme'); ?></p>
        <?php endif; ?>
    </div>
</main>
<?php
get_footer();
