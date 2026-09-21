<?php
if (!defined('ABSPATH')) {
    exit;
}
?>

<main id="main" class="single-page single-default py-4 py-lg-5" role="main">
    <div class="container">
        <?php if (have_posts()) : ?>
            <?php while (have_posts()) : the_post(); ?>
                <article <?php post_class('p-3 p-lg-5 border rounded-4'); ?>>
                    <?php get_template_part('template-parts/single/parts/meta-top'); ?>
                    <h1 class="mb-4"><?php the_title(); ?></h1>
                    <div class="entry-content mb-4">
                        <?php the_content(); ?>
                    </div>
                    <?php get_template_part('template-parts/single/parts/tags-bottom'); ?>
                    <?php get_template_part('template-parts/single/parts/share'); ?>
                </article>
            <?php endwhile; ?>
        <?php endif; ?>
    </div>
</main>
