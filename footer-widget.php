<?php
if (!defined('ABSPATH')) {
    exit;
}
?>

<?php // Footer widgets wrapper. ?>
<section class="footer-widgets py-5" aria-label="<?php esc_attr_e('Footer widgets', 'szpnew-wp-theme'); ?>">
    <div class="container">
        <div class="row g-4">
            <?php // Footer column 1: widget area footer-1. ?>
            <div class="col-12 col-md-6 col-lg-3">
                <?php if (is_active_sidebar('footer-1')) : ?>
                    <?php dynamic_sidebar('footer-1'); ?>
                <?php endif; ?>
            </div>

            <?php // Footer column 2: widget area footer-2. ?>
            <div class="col-12 col-md-6 col-lg-3">
                <?php if (is_active_sidebar('footer-2')) : ?>
                    <?php dynamic_sidebar('footer-2'); ?>
                <?php endif; ?>
            </div>

            <?php // Footer column 3: widget area footer-3. ?>
            <div class="col-12 col-md-6 col-lg-3">
                <?php if (is_active_sidebar('footer-3')) : ?>
                    <?php dynamic_sidebar('footer-3'); ?>
                <?php endif; ?>
            </div>

            <?php // Footer column 4: widget area footer-4. ?>
            <div class="col-12 col-md-6 col-lg-3">
                <?php if (is_active_sidebar('footer-4')) : ?>
                    <?php dynamic_sidebar('footer-4'); ?>
                <?php endif; ?>
            </div>
        </div>
    </div>
</section>
