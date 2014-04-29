<?php
/**
 * @category Blogwerk
 * @package Blogwerk_Theme
 * @author Tom Forrer <tom.forrer@blogwerk.com
 * @copyright Copyright (c) 2014 Blogwerk AG (http://blogwerk.com)
 */

namespace Blogwerk\Theme;

use Blogwerk\Theme\AbstractTheme;

/**
 * Class Example
 *
 * @category Blogwerk
 * @package Blogwerk_Theme
 * @author Tom Forrer <tom.forrer@blogwerk.com
 * @copyright Copyright (c) 2014 Blogwerk AG (http://blogwerk.com)
 */
class Example extends AbstractTheme
{
  const SLUG_SIDEBAR = 'sidebar';
  const SLUG_MENU = 'menu';

  public function setup()
  {
    $this->registerViews(array(

      // main entry points
      'index' => 'views/main.php',
      'home' => 'views/main.php',
      'frontpage' => 'views/main.php',

      // layout
      'header' => 'views/layout/header.php',
      'footer' => 'views/layout/footer.php',
      'sidebar' => 'views/layout/sidebar.php',
    ));

    // register sidebar
    register_sidebar(array(
      'name' => 'Sidebar',
      'description' => __('Sidebar', $this->getTextDomain()),
      'id' => static::SLUG_SIDEBAR,
      'before_widget' => '<section class="widget %2$s clearfix">',
      'after_widget' => '</section>',
      'before_title' => '<h2 class="widget-title">',
      'after_title' => '</h2>',
    ));

    // register menu
    register_nav_menus(array(
      static::SLUG_MENU => 'Main Menu',
    ));
  }

  public function setupComponents()
  {
    $this->registerComponents(array(
      // Menu Component
      '\\Blogwerk\\Theme\\Component\\Menu',
    ));
  }

  /**
   * register widgets at widgets_init(10)
   */
  public function widgets()
  {
    register_widget('\\Blogwerk\\Widget\\Image');
  }

  /**
   * Registers assets
   */
  public function assets()
  {
    wp_enqueue_style('blogwerk-theme-css', $this->resolveUri('resources/styles/styles.css'), array(), $this->getVersion());
  }
} 