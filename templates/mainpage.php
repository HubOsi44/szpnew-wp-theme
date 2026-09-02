<?php
/**
 * Template Name: Mainpage Szlachetna Paczka
 * Template Post Type: page
 */

if (!defined('ABSPATH')) {
    exit;
}

get_header();

while (have_posts()) : the_post();

  if (have_rows('flex_sections')) :
    while (have_rows('flex_sections')) : the_row();
      get_template_part('template-parts/main/sections/section', get_row_layout());
    endwhile;
  endif;

endwhile;

get_footer();
