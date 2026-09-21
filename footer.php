<?php
if (!defined('ABSPATH')) {
    exit;
}
?>
<?php
// Render footer widget areas (footer-1..footer-4).
get_template_part('footer', 'widget');
?>
<?php
// Global campaign layer (optional) rendered at the very end of page layout.
if (is_active_sidebar('layer-campaign')) {
    dynamic_sidebar('layer-campaign');
}
?>
<?php wp_footer(); ?>
</body>
</html>
