<?php
/**
 * Functions.php: WordPress loads this file
 *
 * @category   Blogwerk
 * @package    Blogwerk_Theme
 * @author Tom Forrer <tom.forrer@blogwerk.com>
 * @copyright  Copyright (c) 2014 Blogwerk AG (http://blogwerk.com)
 */

require_once ABSPATH . '/vendor/autoload.php';

use Blogwerk\Theme\WordPressWrapper;
use Blogwerk\Theme\Example;

if (!is_child_theme()) {
  $wordpressWrapper = new WordPressWrapper();

  // instantiate our theme
  $exampleTheme = new Example($wordpressWrapper);
  $exampleTheme->register();
}