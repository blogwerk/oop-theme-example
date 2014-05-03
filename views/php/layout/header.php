<?php
/**
 * @category   Blogwerk
 * @package    Blogwerk_Theme
 * @subpackage Views
 * @author Tom Forrer <tom.forrer@blogwerk.com>
 * @copyright  Copyright (c) 2014 Blogwerk AG (http://blogwerk.com)
 */

use Blogwerk\Theme\Example;
use Blogwerk\Theme\Component\Menu;

/**
 * @var Example $this
 */

/**
 * @var Menu $menuComponent
 */
$menuComponent = $this->getComponent('\\Blogwerk\\Theme\\Component\\Menu');

?><!DOCTYPE html>
<!--[if lt IE 7]>
<html class="no-js lt-ie9 lt-ie8 lt-ie7" <?php language_attributes()?>> <![endif]-->
<!--[if IE 7]>
<html class="no-js lt-ie9 lt-ie8" <?php language_attributes()?>> <![endif]-->
<!--[if IE 8]>
<html class="no-js lt-ie9" <?php language_attributes()?>> <![endif]-->
<!--[if gt IE 8]><!-->
<html class="no-js" <?php language_attributes() ?>> <!--<![endif]-->
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">

  <meta name="description" content="<?php bloginfo('description'); ?>">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<header>

  <h1><?php bloginfo('name'); ?></h1>

  <h2><?php bloginfo('description'); ?></h2>

  <nav role="navigation" class="main-menu">
    <ul class="clearfix">
      <?php
      if (has_nav_menu(Example::SLUG_MENU)):
        $mainMenuArguments = array(
          'theme_location' => Example::SLUG_MENU,
          'container' => false,
          'items_wrap' => '%3$s',
          'depth' => 1,
        );
        echo $menuComponent->getCachedMenu($mainMenuArguments);
      endif;
      ?>
    </ul>
  </nav>

</header>

<div class="container">