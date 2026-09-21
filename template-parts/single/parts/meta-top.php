<?php
if (!defined('ABSPATH')) {
    exit;
}

$categories = get_the_category();
$primary_category = !empty($categories) ? $categories[0]->name : '';
$reading_time_label = function_exists('szpnew_get_reading_time_label') ? szpnew_get_reading_time_label() : '';

$published_timestamp = get_post_time('U');
$modified_timestamp = get_post_modified_time('U');
$is_updated = $modified_timestamp && $modified_timestamp > $published_timestamp;
?>

<div class="single-meta-top d-flex flex-wrap align-items-center gap-2 mb-3 text-muted small">
    <span><?php echo esc_html(get_the_author()); ?></span>
    <span>&bull;</span>
    <span><?php echo esc_html(get_the_date()); ?></span>
    <?php if ($is_updated) : ?>
        <span>&bull;</span>
        <span><?php printf(esc_html__('Aktualizacja: %s', 'szpnew-wp-theme'), esc_html(get_the_modified_date())); ?></span>
    <?php endif; ?>
    <?php if (!empty($reading_time_label)) : ?>
        <span>&bull;</span>
        <span><?php echo esc_html($reading_time_label); ?></span>
    <?php endif; ?>
    <?php if (!empty($primary_category)) : ?>
        <span>&bull;</span>
        <span><?php echo esc_html($primary_category); ?></span>
    <?php endif; ?>
</div>
