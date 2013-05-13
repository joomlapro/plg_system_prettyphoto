<?php
/**
 * @package     Joomla.Plugin
 * @subpackage  System.Prettyphoto
 * @copyright   Copyright (C) 2013 AtomTech, Inc. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

// No direct access.
defined('JPATH_BASE') or die;

/**
 * Joomla Prettyphoto plugin.
 *
 * @package     Joomla.Plugin
 * @subpackage  System.Prettyphoto
 * @since       3.1
 */
class PlgSystemPrettyphoto extends JPlugin
{
	/**
	 * Method to catch the onAfterDispatch event.
	 *
	 * @return  boolean  True on success
	 *
	 * @since   3.1
	 */
	public function onAfterDispatch()
	{
		// Check that we are in the site application.
		if (JFactory::getApplication()->isAdmin())
		{
			return true;
		}

		// Register dependent classes.
		JLoader::register('JHtmlPrettyphoto', __DIR__ . '/helpers/html/prettyphoto.php');

		// Register a function.
		JHtml::register('jquery.prettyphoto', array('JHtmlPrettyphoto', 'prettyphoto'));

		// Force load script.
		if ($this->params->get('force'))
		{
			// Load the prettyphoto jquery script.
			JHtml::_('jquery.prettyphoto', $this->params->get('selector', 'a[rel^="prettyPhoto"]'));
		}

		return true;
	}
}
