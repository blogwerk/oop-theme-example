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

use Blogwerk\Theme\SocialMediaKitWrapper;
use Blogwerk\Theme\Example;

if (!is_child_theme()) {
  $socialMediaKitWrapper = new SocialMediaKitWrapper();

  // instantiate our theme
  $exampleTheme = new Example($socialMediaKitWrapper);
  $exampleTheme->register();
}