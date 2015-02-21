<?php
/**
 *
 * @author Steve Rhoades
 * @see http://www.stephenrhoades.com
 */
class Default_Bootstrap extends Zend_Application_Module_Bootstrap
{
	
	public function _initPluginBrokers()
	{
		$front = Zend_Controller_Front::getInstance();
		$front->registerPlugin(new Default_Plugin_CssHelper());
	}
	
	public function _initAutoload()
	{
	    $this->identity = Zend_Auth::getInstance()->getIdentity();
	    
	    return $this->identity;
	}
	


}