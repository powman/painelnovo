<?php

class Login_IndexController extends Zend_Controller_Action 
{
    public function init(){
        $this->model = new Login_Model_Usuario();
        $this->view->cssHelper = Default_Plugin_CssHelper::CssHelper();
        $this->view->jsHelper = Default_Plugin_JavascriptHelper::JsHelper();
        $this->uteis = new App_AbstractController();
        
    }
	public function indexAction()
	{
	  
	}
	
	public function recuperarAction()
	{
	
	    $resposta = array();
	    $this->_helper->viewRenderer->setNoRender(true);
	    $this->_helper->layout()->disableLayout();
	
	    $where = array(
	            'email = ?' => $this->getRequest()->getParam('recuperaremail')
	    );
	     
	    $sql = $this->model->getAdapter()
	    ->select()
	    ->from('usuario')
	    ->where('email = ?', $this->getRequest()->getParam('recuperaremail'));
	    $usuario = $this->model->getAdapter()->fetchRow($sql);
	
	    if($usuario['email']){
	         
	        $aEmails = array($this->getRequest()->getParam('recuperaremail'));
	        $aMsg = array();
	        $novaSenha = rand(1500,15000000);
	        $aMsg[] = array(
	                'tipo' => 'Email',
	                'msg' =>  $this->getRequest()->getParam('recuperaremail'),
	        );
	        $aMsg[] = array(
	                'tipo' => 'Nova Senha',
	                'msg' =>  $novaSenha,
	        );
	         
	        $aDados = array(
	                'id' => $usuario['id'],
	                'senha' => md5($novaSenha),
	        );
	        $this->model->save($aDados);
	         
	        $this->uteis->enviaEmail($aEmails,$aMsg,null,'Recuperação de Senha');
	        
	        $this->_helper->flashMessenger->addMessage(array('success'=>"Sua senha foi enviada para o email: ".$this->getRequest()->getParam('recuperaremail')));
	        $this->_helper->redirector->gotoSimple('index','index','login');
	    } else {
	        $this->_helper->flashMessenger->addMessage(array('danger'=>"Este email não existe em nosso banco de dados."));
	        $this->_helper->redirector->gotoSimple('index','index','login');
	         
	    }
	     
	    echo json_encode($resposta);
	}
	
	
	public function logarAction()
	{
	
	    $resposta = array();
	    $this->_helper->layout()->disableLayout();
	
	    $dbAdapter = Zend_Db_Table_Abstract::getDefaultAdapter();
	    $authAdapter = new Zend_Auth_Adapter_DbTable($dbAdapter);
	
	    $authAdapter->setTableName('usuario')
	    ->setIdentityColumn('email')
	    ->setCredentialColumn('senha');
	
	    $authAdapter->setIdentity($this->getRequest()->getParam('email'))
	    ->setCredential($this->getRequest()->getParam('senha'))
	    ->setCredentialTreatment('MD5(?)');
	
	    //Realiza autenticacao
	    $result = $authAdapter->authenticate();
	    //Verifica se a autenticacao foi validada
	    if($result->isValid()){
	        //obtem os dados do usuario
	        $usuario = $authAdapter->getResultRowObject();
	        //Armazena seus dados na sessao
	        $storage = Zend_Auth::getInstance()->getStorage();
	        $storage->write($usuario);
	        //Redireciona para o Index
	        $this->_helper->redirector->gotoSimple('index','index','default');
	    }else{
	        $this->_helper->flashMessenger->addMessage(array('danger'=>'Usuario inativo ou senha incorreta, favor contate ao administrador'));
	        $this->_helper->redirector->gotoSimple('index','index','login');
	    }
	
	
	}
	
	public function sairAction()
	{
	    $this->_helper->viewRenderer->setNoRender(true);
	    $this->_helper->layout()->disableLayout();
	    Zend_Auth::getInstance()->clearIdentity();
	    $this->_helper->redirector->gotoSimple('index','index','login');
	
	
	}

}