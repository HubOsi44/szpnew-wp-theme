<?php
if (!defined('ABSPATH')) {
    exit;
}

get_header();

if (in_category('aktualnosci')) {
    get_template_part('template-parts/single/single-aktualnosci');
} elseif (in_category('artykuly') || in_category('artykuly-wolontariat')) {
    get_template_part('template-parts/single/single-article');
} else {
    get_template_part('template-parts/single/single-default');
}

get_footer();
