<?php
/**
 *
 * @author Steve Rhoades
 * @see http://www.stephenrhoades.com
 */
class Login_Bootstrap extends Zend_Application_Module_Bootstrap
{
		
	public function _initPluginBrokers()
	{
		$front = Zend_Controller_Front::getInstance();
		//$front->registerPlugin(new Login_Plugin_CssHelper());
	}
}