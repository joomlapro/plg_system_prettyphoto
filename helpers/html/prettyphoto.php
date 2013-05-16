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
 * Prettyphoto Utility class for jQuery JavaScript behaviors.
 *
 * @package     Joomla.Libraries
 * @subpackage  HTML
 * @since       3.0
 */
abstract class JHtmlPrettyphoto extends JHtmlJquery
{
	/**
	 * Method to load the jQuery Prettyphoto into the document head.
	 *
	 * @param   string  $selector  The HTML selector.
	 * @param   mixed   $debug     Is debugging mode on? [optional]
	 *
	 * @return  void
	 *
	 * @since   3.1
	 */
	public static function Prettyphoto($selector = 'a[rel^="prettyPhoto"]', $debug = null)
	{
		// Include jQuery.
		self::framework();

		// If no debugging value is set, use the configuration setting.
		if ($debug === null)
		{
			$config = JFactory::getConfig();
			$debug  = (boolean) $config->get('debug');
		}

		// Add Stylesheet.
		JHtml::stylesheet('plg_system_prettyphoto/prettyPhoto.css', false, true, false);

		// Add JavaScript.
		JHtml::script('plg_system_prettyphoto/jquery.prettyPhoto.min.js', false, true);

		// Get the document object.
		$doc = JFactory::getDocument();

		// Build the script.
		$script = array();
		$script[] = 'jQuery(document).ready(function() {';
		$script[] = '	jQuery(\'' . $selector . '\').prettyPhoto();';
		$script[] = '});';

		// Add the script to the document head.
		$doc->addScriptDeclaration(implode("\n", $script));

		return;
	}
}
