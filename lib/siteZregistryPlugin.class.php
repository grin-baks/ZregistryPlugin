<?php

/**
* Plugin main class
*/

class siteZregistryPlugin extends sitePlugin
{

	/**
	* this method returns the car table to the interface
	*
	* @return string HTML
	*/
	public static function getMain()
	{
	$page_action = new siteZregistryPluginMainAction();
	$page_html = $page_action->display();
	return $page_html;	
	}



	/**
	* This method adds a menu item to the backend of the application Site with a link to the moderation page
	*/
	public static function backendSidebar(){
		return array(
		'menu_li' => '<li id="s-link-settings">
            <a href="'.wa()->getRootUrl(true).wa()->getConfig()->getBackendUrl().'/site/?plugin=zregistry&action=moderation">
                <i class="icon16 book-open"></i>Moderation Z-car</a>
        </li>',
		);
	}
}