<?php
App::uses('AppleTouchAppHelper', 'AppleTouch.View/Helper');

/**
 * Apple Touch Helper.
 *
 * Support Safari on iOS by allowing some customization to the Apple Touch UI.
 *
 * PHP versions 5
 *
 * Copyright 2012, Buildingo Inc (http://buildingo.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2012, Buildingo, Inc. (http://buildingo.com)
 * @link http://buildingo.com
 * @package apple_touch
 * @subpackage apple_touch.view.helper
 * @since AppleTouch 1.0
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @see http://developer.apple.com/library/IOs/documentation/AppleApplications/Reference/SafariWebContent/Introduction/Introduction.html#//apple_ref/doc/uid/TP40002051-CH1-SW1
 */
class AppleTouchHelper extends AppleTouchAppHelper {
	/**
	 * Helpers.
	 *
	 * @var array
	 */
	public $helpers = array('Html');
	/**
	 * Default startup image to use.
	 *
	 * @var string
	 */
	public $startupImage = 'apple-touch-startup.png';
	/**
	 * Format to attribute.
	 *
	 * @var string
	 */
	protected $_attributeFormat = '%s="%s"';
	/**
	 * Format to META link.
	 *
	 * @var string
	 */
	protected $_metalink = '<link href="%s"%s/>';
	/**
	 * Icons.
	 *
	 * @param array $icons
	 * @param boolean $precomposed
	 * @return string
	 * @see http://developer.apple.com/library/IOs/documentation/AppleApplications/Reference/SafariWebContent/ConfiguringWebApplications/ConfiguringWebApplications.html#//apple_ref/doc/uid/TP40002051-CH3-SW3
	 */
	public function icons($icons = array(), $precomposed = false) {
		if (empty($icons)) {
			$icons = array(
				'57x57' => 'apple-touch-icon-57.png', // iPhone
				'72x72' => 'apple-touch-icon-72.png', // iPad
				'114x114' => 'apple-touch-icon-114.png', // iPhone retina
				'144x144' => 'apple-touch-icon-144.png', // iPad retina
			);
		}

		$link = '<link rel="%s" sizes="%s" href="%s" />';
		$rel = 'apple-touch-icon';
		if ($precomposed) {
			$rel .= '-precomposed';
		}

		$out = array();
		foreach ($icons as $sizes => $href) {
			$out[] = sprintf($this->_metalink, $href, $this->_parseAttributes(compact('rel', 'sizes')));
		}

		return implode("\n", $out);
	}
	/**
	 * Show/Hide user interface components in Safari.
	 *
	 * @param boolean $show
	 * @return void
	 * @see http://developer.apple.com/library/IOs/documentation/AppleApplications/Reference/SafariWebContent/ConfiguringWebApplications/ConfiguringWebApplications.html#//apple_ref/doc/uid/TP40002051-CH3-SW3
	 */
	public function safariUI($show = false) {
		$meta = array('name' => 'apple-mobile-web-app-capable', 'content' => $show ? 'no' : 'yes');
		return $this->Html->meta($meta);
	}
	/**
	 * Specify a startup image.
	 *
	 * On iOS, similar to native applications, you can specify a startup image that is
	 * displayed while your web application launches. This is especially useful when
	 * your web application is offline. By default, a screenshot of the web application
	 * the last time it was launched is used.
	 *
	 * @param string $img
	 * @return string
	 * @see http://developer.apple.com/library/IOs/documentation/AppleApplications/Reference/SafariWebContent/ConfiguringWebApplications/ConfiguringWebApplications.html#//apple_ref/doc/uid/TP40002051-CH3-SW3
	 */
	public function startupImage($img = null) {
		if (empty($img)) {
			$img = $this->startupImage;
		}

		return sprintf($this->_metalink, $img, $this->_parseAttributes(array('rel' => 'apple-touch-startup-image')));
	}
	/**
	 * Change the status bar appearance.
	 *
	 * If your web application displays in standalone mode like that of a native application,
	 * you can minimize the status bar that is displayed at the top of the screen on iOS. Do
	 * so using the status-bar-style meta tag.
	 *
	 * NOTE: This calls `AppleTouchHelper::safariUI()`. No need to call it by itself.
	 *
	 * @param string $color
	 * @return string
	 * @see http://developer.apple.com/library/IOs/documentation/AppleApplications/Reference/SafariWebContent/ConfiguringWebApplications/ConfiguringWebApplications.html#//apple_ref/doc/uid/TP40002051-CH3-SW3
	 */
	public function statusBar($color = 'black') {
		$meta = array('name' => 'apple-mobile-web-app-status-bar-style', 'content' => $color);
		return $this->safariUI(false) . $this->Html->meta($meta);
	}
	/**
	 * Configure the viewport.
	 *
	 * Improve the presentation of your web content on iOS. Typically, you use the viewport
	 * meta tag to set the width and initial scale of the viewport. For example, if your
	 * webpage is narrower than 980 pixels, then you should set the width of the viewport to
	 * fit your web content. If you are designing an iPhone or iPod touch-specific web
	 * application, then set the width to the width of the device.
	 *
	 * @param array $options
	 * @return string
	 * @see http://developer.apple.com/library/IOs/documentation/AppleApplications/Reference/SafariWebContent/UsingtheViewport/UsingtheViewport.html#//apple_ref/doc/uid/TP40006509-SW1
	 */
	public function viewport($options = array()) {
		$options = array_merge(
			array(
				'height' => 'device-height',
				'initial-scale' => '1.0',
				'user-scalable' => false,
				'width' => 'device-width',
			),
			$options
		);

		$content = array();
		foreach ($options as $option => $value) {
			if ('user-scalable' == $option) {
				$value = $value ? 'yes' : 'no';
			}
			$content[] = "$option=$value";
		}

		$meta = array('name' => 'viewport', 'content' => implode(',', $content));
		return $this->Html->meta($meta);
	}
}
