<?php
/**
 * Attachments plugins for content
 *
 * @package     Attachments
 * @subpackage  Attachments_Plugin_for_JEvents_save
 *
 * @author      Jonathan M. Cameron
 * @copyright   Copyright (C) 2015 Jonathan M. Cameron, All Rights Reserved
 * @license     http://www.gnu.org/licenses/gpl-3.0.html GNU/GPL
 * @link        http://jmcameron.net/attachments
 */

// No direct access
defined('_JEXEC') or die('Restricted access');

/** Load the attachments plugin class */
if (!JPluginHelper::importPlugin('attachments', 'attachments_plugin_framework'))
{
	// Fail gracefully if the Attachments plugin framework plugin is disabled
	return;
}


/**
 * The class for the Attachments plugin for regular Joomla! content (events, categories)
 *
 * @package  Attachments
 * @since    3.0
 */

class plgJEventsSave_Attachments extends JPlugin
{
	/**
	 * Constructor
	 *
	 * @param	object	&$subject  The object to observe
	 * @param	array	$config	   An array that holds the plugin configuration
	 *
	 * @access	protected
	 */
	public function __construct(&$subject, $config)
	{
		parent::__construct($subject, $config);
		
		$this->loadLanguage();
	}

	/*
	 * Set the parent_id for all attachments that were added to this
	 * content before it was saved the first time.
	 *
	 * This method is called right after the content is saved.
	 *
	 * @param string The context of the content being passed to the plugin.
	 * @param object $item A JTableContent object
	 * @param bool $isNew If the content is newly created
	 *
	 * @return	void
	 */
	public function onAfterSaveEvent($item)
	{
		if ($item->created == $item->_detail->modified) {
			require_once(JPATH_SITE . '/plugins/content/attachments/attachments.php'); // Probably not necessary
 			$item->id = $item->ev_id;
			plgContentAttachments::onContentAfterSave('com_jevents.jevent', $item, $isNew=true);
			}
	}

}
