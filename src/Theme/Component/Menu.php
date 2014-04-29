<?php
/**
 * @category Blogwerk
 * @package Blogwerk_Theme
 * @subpackage Component
 * @author Tom Forrer <tom.forrer@blogwerk.com
 * @copyright Copyright (c) 2014 Blogwerk AG (http://blogwerk.com)
 */

namespace Blogwerk\Theme\Component;

use \Blogwerk\Theme\Component\AbstractComponent;

/**
 * Class MenuComponent
 *
 * This component provides helper functions to retreive cached versions of requested menus (if they exist) and remember the
 * cache keys: if the menu changes somehow, the cache contents are invalidated.
 *
 * @category Blogwerk
 * @package Blogwerk_Theme
 * @subpackage Component
 * @author Tom Forrer <tom.forrer@blogwerk.com
 * @copyright Copyright (c) 2014 Blogwerk AG (http://blogwerk.com)
 */
class Menu extends AbstractComponent
{
  const CACHE_KEY_MENUS = 'menus_cached';

  /**
   * register hooks
   */
  public function init()
  {
    if(is_admin()){
      // clear the cached menus, whenever a menu item is created, updated or deleted
      add_action('wp_update_nav_menu_item', array($this, 'clearCachedMenus'));
      add_action('wp_delete_nav_menu', array($this, 'clearCachedMenus'));
    }
  }

  /**
   * View helper function: get a menu based on arguments, but cache the results:
   * wp_nav_menu can get quite expensive, if there are many menu items
   *
   * @param array $arguments
   * @return bool|mixed|string|void
   */
  public function getCachedMenu($arguments)
  {
    $arguments['currentPageLocation'] = $_SERVER["REQUEST_URI"];
    // json_encode is faster than serialize... http://stackoverflow.com/a/7723730
    $cacheKey = 'menu_' . hash('md5', json_encode($arguments));
    $menu = wp_cache_get($cacheKey);
    if ($menu===false) {
      // do not output the menu directly
      $arguments['echo'] = false;

      // this is time-expensive if there are many menu items
      $menu = wp_nav_menu($arguments);

      // store the result and remember the cache key
      wp_cache_set($cacheKey, $menu);
      $this->addCachedMenuKey($cacheKey);
    }
    return $menu;
  }

  /**
   * add a key to the CACHE_KEY_MENUS cache array, which stores all menu cache keys.
   * This is necessary in order to remember which menus are cached and should be updated,
   * when the menu content is changed.
   *
   * @param string $key
   */
  protected function addCachedMenuKey($key)
  {
    $cachedMenus = wp_cache_get(static::CACHE_KEY_MENUS);

    // initialize the key structure to an array
    if ($cachedMenus === false || !is_array($cachedMenus)) {
      $cachedMenus = array();
    }

    // add the key, uniquely
    $cachedMenus[] = $key;
    $cachedMenus = array_unique($cachedMenus);

    // and store
    wp_cache_set(static::CACHE_KEY_MENUS, $cachedMenus);
  }

  /**
   * clear the cached menus, based on the keys stored at CACHE_KEY_MENUS:
   * whenever a menu is created, updated or deleted, we accept the penalty of the menu construction once.
   */
  public function clearCachedMenus()
  {
    // get all the keys of cached menus
    $cachedMenus = wp_cache_get(static::CACHE_KEY_MENUS);
    if ($cachedMenus !== false && is_array($cachedMenus)) {

      // delete them
      foreach ($cachedMenus as $cachedMenu) {
        wp_cache_delete($cachedMenu);
      }

      // and reset the keys
      wp_cache_set(static::CACHE_KEY_MENUS, array());
    }
  }

} 