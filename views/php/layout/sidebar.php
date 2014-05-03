<?php
/**
 * @category   Blogwerk
 * @package    Blogwerk_Theme
 * @subpackage Views
 * @author Tom Forrer <tom.forrer@blogwerk.com>
 * @copyright  Copyright (c) 2014 Blogwerk AG (http://blogwerk.com)
 */

use \Blogwerk\Theme\Example;

if (is_active_sidebar(Example::SLUG_SIDEBAR)): ?>
  <aside role="complementary" class="sidebar col-md-3 col-md-pull-9 col-sm-3 col-sm-pull-9">
    <?php dynamic_sidebar(Example::SLUG_SIDEBAR); ?>
  </aside>
<?php endif;