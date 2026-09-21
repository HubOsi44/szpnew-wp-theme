<?php
if (!defined('ABSPATH')) {
    exit;
}

$header_image_field = function_exists('get_field') ? get_field('header_image') : '';
$header_content_field = function_exists('get_field') ? get_field('header_content') : '';

$header_image = '';
if (is_array($header_image_field)) {
    $header_image = $header_image_field['url'] ?? '';
} elseif (is_string($header_image_field)) {
    $header_image = $header_image_field;
}

$header_title = get_the_title();
$header_content = !empty($header_content_field) ? (string) $header_content_field : '';
?>

<div
    class="page-header-full-top"
    <?php if (!empty($header_image)) : ?>
        style="background-image: url('<?php echo esc_url($header_image); ?>');"
    <?php endif; ?>
>
    <div class="container py-5">
        <?php if (!empty($header_title)) : ?>
            <h1 class="mb-3"><?php echo esc_html($header_title); ?></h1>
        <?php endif; ?>

        <?php if (!empty($header_content)) : ?>
            <div class="page-header-content">
                <?php echo wp_kses_post($header_content); ?>
            </div>
        <?php endif; ?>
    </div>
</div>
