<?php
if (!defined('ABSPATH')) {
    exit;
}
?>

<main id="main" class="archive-page archive-article py-4 py-lg-5" role="main">
    <div class="container">
        <header class="mb-4 mb-lg-5">
            <h1 class="mb-2"><?php single_cat_title(); ?></h1>
            <?php if (category_description()) : ?>
                <div class="text-muted"><?php echo wp_kses_post(category_description()); ?></div>
            <?php endif; ?>
        </header>

        <?php if (have_posts()) : ?>
            <div class="row g-4">
                <?php while (have_posts()) : the_post(); ?>
                    <article <?php post_class('col-12 col-lg-6'); ?>>
                        <div class="p-3 p-lg-4 border rounded-4 h-100">
                            <h2 class="h3 mb-3">
                                <a href="<?php the_permalink(); ?>" class="text-decoration-none"><?php the_title(); ?></a>
                            </h2>
                            <p class="mb-3"><?php echo esc_html(get_the_excerpt()); ?></p>
                            <a href="<?php the_permalink(); ?>" class="btn btn-secondary btn-sm"><?php esc_html_e('Czytaj więcej', 'szpnew-wp-theme'); ?></a>
                        </div>
                    </article>
                <?php endwhile; ?>
            </div>

            <div class="mt-4">
                <?php the_posts_pagination(); ?>
            </div>
        <?php else : ?>
            <p><?php esc_html_e('Brak wpisów w tej kategorii.', 'szpnew-wp-theme'); ?></p>
        <?php endif; ?>
    </div>
</main>
