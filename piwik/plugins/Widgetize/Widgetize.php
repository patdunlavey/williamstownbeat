<?php
/**
 * Piwik - Open source web analytics
 * 
 * @link http://piwik.org
 * @license http://www.gnu.org/licenses/gpl-3.0.html Gpl v3 or later
 * @version $Id: Widgetize.php 2264 2010-06-03 16:53:43Z vipsoft $
 * 
 * @category Piwik_Plugins
 * @package Piwik_Widgetize
 */

/**
 * 
 * @package Piwik_Widgetize
 */
class Piwik_Widgetize extends Piwik_Plugin
{
	public function getInformation()
	{
		return array(
			'description' => Piwik_Translate('Widgetize_PluginDescription'),
			'author' => 'Piwik',
			'author_homepage' => 'http://piwik.org/',
			'version' => Piwik_Version::VERSION,
		);
	}
}
