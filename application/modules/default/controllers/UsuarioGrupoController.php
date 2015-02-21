<?php

class UsuarioGrupoController extends Zend_Controller_Action
{
    
//     public function init(){
//         $this->model = new Default_Model_UsuarioGrupo();
//         $this->modelUsuario = new Default_Model_Usuario();
//         $this->modelPermissao = new Default_Model_Permissao();
//         $this->modelResource = new Default_Model_Resource();
//         $this->modelLog = new Default_Model_Logs();
//         $this->view->cssHelper = Default_Plugin_CssHelper::CssHelper();
//         $this->view->jsHelper = Default_Plugin_JavascriptHelper::JsHelper();
//         $this->view->mostra_head_footer = true;
//         $this->uteis = new App_AbstractController(); 
        
//         if ( !Zend_Auth::getInstance()->hasIdentity() ) {
//             return $this->_helper->redirector->goToRoute( array('controller' => 'auth'), null, true);
//         }
//     }
	
// 	public function indexAction()
// 	{
	    
		
// 	}
	
// 	public function listarAction()
// 	{
	
//         $resposta = array();
//         $this->_helper->viewRenderer->setNoRender(true);
//         $this->_helper->layout()->disableLayout();
        
//         $sql = $this->model->getAdapter()->select()->from('role');
        
//         // Parametros para busca
//         if($this->getRequest()->getParam('role'))
//             $sql->where('role LIKE ?', "%".$this->getRequest()->getParam('role')."%");
        
//         if($this->getRequest()->getParam('id'))
//             $sql->where('id = ?', $this->getRequest()->getParam('id'));
        
//         $sql->where('role != ?','ROOT');
//         // fim Parametros para busca
        
//         // total com a pesquisa
//         $totalTudo = $this->model->getAdapter()->fetchAll($sql);

//         // Verifica a ordenacao
//         if($this->getRequest()->getParam('sort') && $this->getRequest()->getParam('order')){
//             $ordernar = $this->getRequest()->getParam('sort')." ".$this->getRequest()->getParam('order');
//             $sql->order($ordernar);
//         }
        
//         // Verifica o limit e o offset
//         if($this->getRequest()->getParam('limit') || $this->getRequest()->getParam('offset'))
//             $sql->limit($this->getRequest()->getParam('limit'),$this->getRequest()->getParam('offset'));
        
//         $logs = $this->model->getAdapter()->fetchAll($sql);
//         $total = count($logs);
//         $values['total'] = count($totalTudo);
        
//         for($i=0;$i<$total;$i++){
//             $values['rows'][$i]['id'] = $logs[$i]['id'];
//             $values['rows'][$i]['role'] = $logs[$i]['role'];
//         }
        
//         echo json_encode($values);
// 	}
// 	public function pesquisarAction()
// 	{
	    
// 	    $this->_helper->layout()->disableLayout();
// 	}
// 	public function excluirAction()
// 	{
	    
// 	    $resposta = array();
// 	    $this->_helper->viewRenderer->setNoRender(true);
// 	    $this->_helper->layout()->disableLayout();
	    
// 	    $sql = $this->modelUsuario->getAdapter()->select()->from('usuario');
	    
// 	    // Parametros para busca
// 	    if($this->getRequest()->getParam('id')){
// 	        $sql->where('role_id = ?',$this->getRequest()->getParam('id'));
// 	    }
// 	    // fim Parametros para busca
	    
// 	    // total com a pesquisa
// 	    $data = $this->modelUsuario->getAdapter()->fetchRow($sql);
// 	    if($data["id"]){
// 	        $resposta['situacao'] = "error";
// 	        $resposta['msg'] = "Erro ao Excluir, existem usuários neste grupo!";
// 	        echo json_encode($resposta);
// 	        exit();
// 	    }
	   
	
// 	    // total com a pesquisa
// 	    $result = $this->model->getAdapter()->delete("role",'id = '.$this->getRequest()->getParam('id'));
	     
// 	    if($result){
// 	        $resposta['situacao'] = "sucess";
// 	        $resposta['msg'] = "Excluido com sucesso!";
	        
// 	        // Grava Logo
// 	        $data = array();
// 	        $data['modulo'] = Zend_Controller_Front::getInstance()->getRequest()->getModuleName();
// 	        $data['controller'] = Zend_Controller_Front::getInstance()->getRequest()->getControllerName();
// 	        $data['metodo'] = Zend_Controller_Front::getInstance()->getRequest()->getActionName();
// 	        $data['ip'] = $_SERVER['REMOTE_ADDR'];
// 	        $data['data'] = time();
// 	        $data['usuario_id'] = Zend_Auth::getInstance()->getIdentity()->id;
// 	        $data['usuario_nome'] = Zend_Auth::getInstance()->getIdentity()->nome;
// 	        $data['descricao'] = "Exclusão do Grupo Usuário";
// 	        $this->modelLog->save($data);
// 	    }else{
// 	        $resposta['situacao'] = "error";
// 	        $resposta['msg'] = "Erro ao Excluir!";
// 	    }
	     
// 	    echo json_encode($resposta);
	     
	     
// 	}
// 	public function cadastroRapidoAction()
// 	{
	     
// 	    $this->_helper->layout()->disableLayout();
// 	}
// 	public function cadastroFormAction()
// 	{
	    
// 	    $sql = $this->modelResource->getAdapter()->select()->from('resource');
// 	    $resources = $this->modelPermissao->getAdapter()->fetchAll($sql);
// 	    $this->view->resources = $resources;
	    
	    
// 	    $sql = $this->modelPermissao->getAdapter()->select()->from('permissao')->joinLeft(
//                     'role',
//                     'role.id = permissao.role_id',
//                     array('role.role as grupo')
//                     )->joinLeft(
//                     'resource',
//                     'resource.id = permissao.resource_id',
//                     array('resource.resource as controle')
//                     )->order('resource.resource asc');
// 	    $sql->where('role_id = ?',2);
// 	    $permissao = $this->modelPermissao->getAdapter()->fetchAll($sql);
// 	    $this->view->permissao = $permissao;
// 	}
	
// 	public function cadastrarAcaoAction()
// 	{
// 	    $resposta = array();
// 	    $this->_helper->viewRenderer->setNoRender(true);
// 	    $this->_helper->layout()->disableLayout();
	     
// 	    $data['role'] = $this->getRequest()->getParam('role');
	     
// 	    $result = $this->model->save($data);

// 	    $data2 = $this->getRequest()->getPost();
// 	    unset($data2['role']);
// 	    unset($data2['selecionartodos']);
	    
// 	    if(count($data2['permissao']) > 0){
//     	    foreach ($data2['permissao'] as $key => $value){
//     	        list($roleId, $resourceId, $permissao) = explode(',',$value);
//     	        $aData['role_id'] = $result; 
//     	        $aData['resource_id'] = $resourceId; 
//     	        $aData['permissao'] = $permissao; 
    	        
//     	        $this->modelPermissao->save($aData);
//     	    }
// 	    }
	     
// 	    if($result){
// 	        $resposta['situacao'] = "sucess";
// 	        $resposta['msg'] = "Cadastrado com sucesso!";
	        
// 	        // Grava Logo
// 	        $data = array();
// 	        $data['modulo'] = Zend_Controller_Front::getInstance()->getRequest()->getModuleName();
// 	        $data['controller'] = Zend_Controller_Front::getInstance()->getRequest()->getControllerName();
// 	        $data['metodo'] = Zend_Controller_Front::getInstance()->getRequest()->getActionName();
// 	        $data['ip'] = $_SERVER['REMOTE_ADDR'];
// 	        $data['data'] = time();
// 	        $data['usuario_id'] = Zend_Auth::getInstance()->getIdentity()->id;
// 	        $data['usuario_nome'] = Zend_Auth::getInstance()->getIdentity()->nome;
// 	        $data['descricao'] = "Cadastro do Grupo Usuário";
// 	        $this->modelLog->save($data);
// 	    }else{
// 	        $resposta['situacao'] = "error";
// 	        $resposta['msg'] = "Erro ao Cadastrar!";
// 	    }
	
// 	    echo json_encode($resposta);
// 	}
// 	public function editarRapidoAction()
// 	{
	    
// 	    $sql = $this->model->getAdapter()->select()->from('role');
	     
// 	    // Parametros para busca
// 	    if($this->getRequest()->getParam('id')){
// 	        $sql->where('id = ?',$this->getRequest()->getParam('id'));
// 	        $sql->where('role != ?','ROOT');
// 	    }
// 	    // fim Parametros para busca
	     
// 	    // total com a pesquisa
// 	    $data = $this->model->getAdapter()->fetchRow($sql);
// 	    $this->view->usuario_grupo = $data;
	    
// 	    $this->_helper->layout()->disableLayout();
// 	}
	
// 	public function editarFormAction()
// 	{
// 	    $sql = $this->modelResource->getAdapter()->select()->from('resource');
// 	    $resources = $this->modelPermissao->getAdapter()->fetchAll($sql);
// 	    $this->view->resources = $resources;
	    
// 	    $sql = $this->model->getAdapter()->select()->from('role');
	    
// 	    // Parametros para busca
// 	    if($this->getRequest()->getParam('id')){
// 	        $sql->where('id = ?',$this->getRequest()->getParam('id'));
// 	        $sql->where('role != ?','ROOT');
// 	    }
// 	    // fim Parametros para busca
	    
// 	    // total com a pesquisa
// 	    $data = $this->model->getAdapter()->fetchRow($sql);
// 	    $this->view->usuario_grupo = $data;
	    
// 	    $sql = $this->modelPermissao->getAdapter()->select()->from('permissao')->joinLeft(
// 	            'role',
// 	            'role.id = permissao.role_id',
// 	            array('role.role as grupo')
// 	    )->joinLeft(
// 	            'resource',
// 	            'resource.id = permissao.resource_id',
// 	            array('resource.resource as controle')
// 	    )->order('resource.resource asc');
// 	    $sql->where('role_id = ?',2);
// 	    $permissao = $this->modelPermissao->getAdapter()->fetchAll($sql);
// 	    $this->view->permissao = $permissao;
	    
// 	    $sql = $this->modelPermissao->getAdapter()->select()->from('permissao')->joinLeft(
// 	            'role',
// 	            'role.id = permissao.role_id',
// 	            array('role.role as grupo')
// 	    )->joinLeft(
// 	            'resource',
// 	            'resource.id = permissao.resource_id',
// 	            array('resource.resource as controle')
// 	    )->order('resource.resource asc');
// 	    $sql->where('role_id = ?',$this->getRequest()->getParam('id'));
// 	    $permissaoGrupo = $this->modelPermissao->getAdapter()->fetchAll($sql);
	    
// 	    $this->view->permissaousuario = $permissaoGrupo;
// 	    $this->view->role_id = $this->getRequest()->getParam('id');
	    
	    
	    
// 	}
// 	public function editarAcaoAction()
// 	{

// 	    $resposta = array();
// 	    $this->_helper->viewRenderer->setNoRender(true);
// 	    $this->_helper->layout()->disableLayout();
	    
// 	    $data['id'] = $this->getRequest()->getParam('id');
// 	    $data['role'] = $this->getRequest()->getParam('role');
	    
// 	    $result = $this->model->save($data);
	    
// 	    $data2 = $this->getRequest()->getPost();
// 	    unset($data2['id']);
// 	    unset($data2['role']);
// 	    unset($data2['selecionartodos']);
	    
// 	    if(count($data2['permissao']) > 0){
// 	        $result = $this->model->getAdapter()->delete("permissao",'role_id = '.$this->getRequest()->getParam('id'));
//     	    foreach ($data2['permissao'] as $key => $value){
//     	        list($roleId, $resourceId, $permissao) = explode(',',$value);
//     	        $aData['role_id'] = $this->getRequest()->getParam('id');
//     	        $aData['resource_id'] = $resourceId;
//     	        $aData['permissao'] = $permissao;
    	         
//     	       $this->modelPermissao->save($aData);
// 	        }
	    
// 	     }
	    
// 	    if($result){
// 	        $resposta['situacao'] = "sucess";
// 	        $resposta['msg'] = "Editado com sucesso!";
	        
// 	        // Grava Logo
// 	        $data = array();
// 	        $data['modulo'] = Zend_Controller_Front::getInstance()->getRequest()->getModuleName();
// 	        $data['controller'] = Zend_Controller_Front::getInstance()->getRequest()->getControllerName();
// 	        $data['metodo'] = Zend_Controller_Front::getInstance()->getRequest()->getActionName();
// 	        $data['ip'] = $_SERVER['REMOTE_ADDR'];
// 	        $data['data'] = time();
// 	        $data['usuario_id'] = Zend_Auth::getInstance()->getIdentity()->id;
// 	        $data['usuario_nome'] = Zend_Auth::getInstance()->getIdentity()->nome;
// 	        $data['descricao'] = "Edição do Grupo Usuário";
// 	        $this->modelLog->save($data);
// 	    }else{
// 	        $resposta['situacao'] = "error";
// 	        $resposta['msg'] = "Erro ao Editar!";
// 	    }
	     
// 	    echo json_encode($resposta);
// 	}


}