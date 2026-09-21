<?php
if (!defined('ABSPATH')) {
    exit;
}

$tags = get_the_tags();
if (empty($tags)) {
    return;
}
?>

<div class="single-tags mt-4 pt-3 border-top">
    <div class="d-flex flex-wrap gap-2">
        <?php foreach ($tags as $tag) : ?>
            <a class="btn btn-sm btn-light rounded-pill" href="<?php echo esc_url(get_tag_link($tag->term_id)); ?>">
                <?php echo esc_html($tag->name); ?>
            </a>
        <?php endforeach; ?>
    </div>
</div>
