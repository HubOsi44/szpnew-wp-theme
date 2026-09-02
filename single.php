<?php
if (!defined('ABSPATH')) {
    exit;
}

get_header();

while (have_posts()) :
    the_post();

    $post_id = get_the_ID();
    $categories = get_the_category($post_id);
    $published_date = get_the_date('j M Y');
    $current_lang = function_exists('pll_current_language') ? pll_current_language('slug') : 'pl';
    $latest_news_label = $current_lang === 'en' ? 'Latest news' : 'Najnowsze aktualności';
    $related_posts_args = [
        'post_type'           => 'post',
        'post_status'         => 'publish',
        'posts_per_page'      => 3,
        'post__not_in'        => [$post_id],
        'ignore_sticky_posts' => true,
    ];

    if ($categories) {
        $related_posts_args['category__in'] = wp_list_pluck($categories, 'term_id');
    }

    $related_posts = new WP_Query($related_posts_args);
    ?>

    <?php get_template_part('template-parts/common/page-top'); ?>

    <main class="rs-news-single section-space">
        <div class="container">
            <div class="row g-5">
                <div class="col-xl-8 col-lg-7">
                    <article <?php post_class('rs-news-single-article'); ?>>

                        <h1 class="rs-title-1 mb-5"><?php the_title(); ?></h1>

                        <?php if (has_excerpt()) : ?>
                            <div class="rs-news-single-excerpt">
                                <?php the_excerpt(); ?>
                            </div>
                        <?php endif; ?>

                        <div class="rs-news-single-content">
                            <?php the_content(__('Continue reading <span class="meta-nav">&rarr;</span>', 'szpnew-wp-theme')); ?>
                        </div>
                    </article>
                </div>

                <div class="col-xl-4 col-lg-5">
                    <aside class="rs-news-sidebar">
                        <?php if ($related_posts->have_posts()) : ?>
                            <div class="rs-news-sidebar-box">
                                <h3 class="rs-news-sidebar-title"><?php echo esc_html($latest_news_label); ?></h3>
                                <div class="rs-news-sidebar-posts">
                                    <?php while ($related_posts->have_posts()) : $related_posts->the_post(); ?>
                                        <?php get_template_part('template-parts/news/card'); ?>
                                    <?php endwhile; ?>
                                </div>
                                <?php wp_reset_postdata(); ?>
                            </div>
                        <?php endif; ?>
                    </aside>
                </div>
            </div>
        </div>
    </main>
<?php
endwhile;

get_footer();
