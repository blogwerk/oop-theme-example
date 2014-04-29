<?php
/**
 * @category   Blogwerk
 * @package    Blogwerk_Widget
 * @author Tom Forrer <tom.forrer@blogwerk.com>
 * @copyright  Copyright (c) 2014 Blogwerk AG (http://blogwerk.com)
 */

namespace Blogwerk\Widget;

use Blogwerk\Widget\AbstractWidget;
use \Blogwerk\Theme\MigrosBankTheme;

/**
 * Class Image
 *
 * @category   Blogwerk
 * @package    Blogwerk_Widget
 * @author Tom Forrer <tom.forrer@blogwerk.com>
 * @copyright  Copyright (c) 2014 Blogwerk AG (http://blogwerk.com)
 */
class Image extends AbstractWidget
{
  protected $textDomain = 'blogwerk';

  protected $baseId = 'ImageWidget';

  protected $widgetName = 'Bild Widget';

  public function init()
  {
    $this->options = array(
      'classname' => $this->getBaseId(),
      'description' => 'Bild Widget mit Titel und verlinktem Bild',
    );

    $this->registerAttachmentFormField('attachmentId', array(
      'label' => 'Bild wählen',
    ));
    $this->registerTextFormField('title', array(
      'label' => 'Titel',
    ));
    $this->registerTextFormField('href', array(
      'label' => 'Link',
      'sanitize' => 'esc_url'
    ));
  }

  /**
   * Widget output
   * @param array $args
   * @param array $instance
   * @return string
   */
  public function html($args, $instance)
  {
    $html = '';
    if (isset($instance['attachmentId']) && $attachment = get_post(intval($instance['attachmentId']))) {
      list($url, $width, $height, $crop) = wp_get_attachment_image_src($attachment->ID, MigrosBankTheme::IMAGE_SIZE_KEY_TEASER);

      if ($wrapInsideAnchor = (isset($instance['href']) && $instance['href'] != '')) {
        $html .= '<a href="' . $instance['href'] . '" title="' . $instance['title'] . '" class="teaser-link">';
      }
      if (isset($instance['title']) && $instance['title'] != '') {
        $html .= $args['before_title'] . $instance['title'] . $args['after_title'];
      }
      $html .= '<img src="' . $url . '" alt="' . $instance['title'] . '" />';

      if ($wrapInsideAnchor) {
        $html .= '</a>';
      }
    }
    return $html;
  }
}
