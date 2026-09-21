<?php
if (!defined('ABSPATH')) {
    exit;
}

$url = urlencode(get_permalink());
$title = urlencode(get_the_title());
?>

<div class="single-share mt-4 pt-3 border-top">
    <div class="d-flex flex-wrap align-items-center gap-2">
        <span class="fw-semibold me-2"><?php esc_html_e('Udostępnij:', 'szpnew-wp-theme'); ?></span>
        <a class="btn btn-secondary btn-sm" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo esc_attr($url); ?>" target="_blank" rel="noopener noreferrer">Facebook</a>
        <a class="btn btn-secondary btn-sm" href="https://twitter.com/intent/tweet?url=<?php echo esc_attr($url); ?>&text=<?php echo esc_attr($title); ?>" target="_blank" rel="noopener noreferrer">X</a>
        <a class="btn btn-secondary btn-sm" href="https://www.linkedin.com/sharing/share-offsite/?url=<?php echo esc_attr($url); ?>" target="_blank" rel="noopener noreferrer">LinkedIn</a>
    </div>
</div>
