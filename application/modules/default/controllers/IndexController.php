<?php

class IndexController extends Zend_Controller_Action 
{
    public function init(){
        $this->auth = Zend_Auth::getInstance();
        
        $this->view->cssHelper = Default_Plugin_CssHelper::CssHelper();
        $this->view->jsHelper = Default_Plugin_JavascriptHelper::JsHelper();
        $this->view->mostra_head_footer = true;
        
        
        if ( !Zend_Auth::getInstance()->hasIdentity() ) {
           $this->_helper->redirector->gotoSimple('index','index','login');
        }
    }
	public function indexAction()
	{
	    $this->view->identidade = $this->auth->getIdentity();
	    

	}
	
	public function saiAction(){
	    echo "fkdj";
	}
	
	public function sai2Action(){
	    echo "fkdj";
	}
	

}