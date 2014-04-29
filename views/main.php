<?php
/**
 * @category   Blogwerk
 * @package    Blogwerk_Theme
 * @subpackage Views
 * @author Tom Forrer <tom.forrer@blogwerk.com>
 * @copyright  Copyright (c) 2014 Blogwerk AG (http://blogwerk.com)
 */

get_template_part('header');

if (have_posts()):
  while (have_posts()):
    the_post();
    ?>
    <article <?php post_class(); ?>>
      <header>
        <h1><?php the_title(); ?></h1>
      </header>
      <?php the_content(); ?>
    </article>
  <?php
  endwhile;
endif;

get_template_part('sidebar');

get_template_part('footer'); ?>