<?php
/**
 * @package     Joomla.Libraries
 * @subpackage  HTML
 * @copyright   Copyright (C) 2013 AtomTech, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access.
defined('JPATH_PLATFORM') or die;

/**
 * prettyPhoto Utility class for jQuery JavaScript behaviors.
 *
 * @package     Joomla.Libraries
 * @subpackage  HTML
 * @since       3.2
 */
abstract class JHtmlPrettyphoto extends JHtmlJquery
{
	/**
	 * Array containing information for loaded files.
	 *
	 * @var    array
	 * @since  3.2
	 */
	protected static $loaded = array();

	/**
	 * Method to load the jQuery prettyPhoto into the document head.
	 *
	 * @param   string  $selector  The HTML selector.
	 * @param   mixed   $debug     Is debugging mode on? [optional]
	 *
	 * @return  void
	 *
	 * @since   3.1
	 */
	public static function prettyPhoto($selector = 'a[rel^="prettyPhoto"]', $debug = null)
	{
		// Only load once
		if (isset(static::$loaded[__METHOD__][$selector]))
		{
			return;
		}

		// Include jQuery framework.
		static::framework();

		// If no debugging value is set, use the configuration setting.
		if ($debug === null)
		{
			$config = JFactory::getConfig();
			$debug  = (boolean) $config->get('debug');
		}

		// Add Stylesheet.
		JHtml::_('stylesheet', 'plg_system_prettyphoto/prettyPhoto.min.css', false, true, false, false, $debug);

		// Add JavaScript.
		JHtml::_('script', 'plg_system_prettyphoto/jquery.prettyPhoto.min.js', false, true, false, false, $debug);

		// Attach the prettyPhoto to the document.
		JFactory::getDocument()->addScriptDeclaration(
			"jQuery(document).ready(function() {
				jQuery('$selector').prettyPhoto();
			});"
		);

		static::$loaded[__METHOD__][$selector] = true;

		return;
	}
}
