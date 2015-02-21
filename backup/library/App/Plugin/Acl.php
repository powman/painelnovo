<?php
class App_Plugin_Acl extends Zend_Controller_Plugin_Abstract
{
    public function preDispatch(Zend_Controller_Request_Abstract $request)
    {

        if($request->getControllerName() != "auth" && $request->getControllerName() != "logs" && $request->getControllerName() != "error" ){
            $this->db             = Zend_Db_Table::getDefaultAdapter();
            $this->identification = Zend_Auth::getInstance()->getIdentity();
            if($request->getParam('instalar'))
                $this->modulos = $this->_getModulos();
            $this->modelresource = new Default_Model_Resource();
            $this->modelpermissao = new Default_Model_Permissao();
            
            if (Zend_Auth::getInstance()->getIdentity()) {
                $registry = Zend_Registry::getInstance();
                
                $errors = $request->getParam('error_handler');
                // pegar o role do usuario
                $sql = $this->db->select()->from('role');
                $sql->where('id = ?',$this->identification->role_id);
                $grupo = $this->db->fetchRow($sql);
    
                // verifica se tem erro
                if(!$errors){
                    
                    
                    // Lista de Controle de Acesso
                    $acl = new Zend_Acl();
                    
                    if($request->getParam('instalar')){
                        $result = $this->db->delete("permissao",'role_id = 2');
                        foreach ($this->modulos[$request->getModuleName()] as $key => $value){
                            
                            $sql = $this->db->select()->from('resource');
                            $sql->where('resource = ?',$key);
                            // total com a pesquisa
                            $resource = $this->db->fetchRow($sql);
                            
                            if(!$resource['id'] && $key != 'auth' && $key != 'logs' && $key != 'error' && $key != 'index'){
                                $aResource['id'] = '';
                                $aResource['resource'] = $key;
                                $this->modelresource->save($aResource);  
                            }
    
                            
                            if($grupo['role'] == "ROOT"){
                                foreach ($value as $valor){
                                    if($resource['id']){
                                        $sql = $this->db->select()->from('permissao');
                                        $sql->where('permissao = ?',$valor);
                                        $sql->where('role_id = ?',$this->identification->role_id);
                                        $sql->where('resource_id = ?',$resource['id']);
                                        // total com a pesquisa
                                        $permissao = $this->db->fetchRow($sql);
                                    
                                        if(!$permissao['id']){
                                            $aPermissao['permissao'] = $valor;
                                            $aPermissao['role_id'] = $this->identification->role_id;
                                            $aPermissao['resource_id'] = $resource['id'];
                                            $this->modelpermissao->save($aPermissao);
                                        }
                                    }
                                }
                            }
        
                        }
                    }
                    
                    $sql = $this->db->select()->from('role');
                    $modulos = $this->db->fetchAll($sql);
                    $aRole = array();
                    $aResource = array();
                    $aPermissao = array();
                    $resposta = array();
                    $acao = null;
                    
                    $acl->addRole(new Zend_Acl_Role('visitante'));
                    
                    $acl->add(new Zend_Acl_Resource('logs'));
                    $acl->add(new Zend_Acl_Resource('error'));
                    $acl->add(new Zend_Acl_Resource('index'));
                    $acl->allow('visitante','logs');
                    $acl->allow('visitante','error');
                    $acl->allow('visitante','index');
                    foreach ($modulos as $key => $value){
                        $aRole[] = $value['role'];
                        $acl->addRole(new Zend_Acl_Role($value['role']),'visitante');
                    }
                    
        
                    $sql = $this->db->select()->from('resource');
                    $sql->where('resource = ?',$request->getControllerName());
                    $resources = $this->db->fetchRow($sql);
                    
                    if($resources['id']){
                        $aResource[] = $resources['resource'];
                        $acl->add(new Zend_Acl_Resource($resources['resource']));
                        
                        $sql = $this->db->select()->from('permissao');
                        $sql->where('permissao = ?',$request->getActionName());
                        $sql->where('role_id = ?',$this->identification->role_id);
                        $sql->where('resource_id = ?',$resources['id']);
                        $permissao = $this->db->fetchRow($sql);
                        
                        if($permissao['permissao'])
                            $acl->allow($aRole,$aResource,$permissao['permissao']);
                        $acao = $request->getActionName();
                        if(!$acl->isAllowed($grupo['role'],$request->getControllerName(),$acao)){
                            if($request->getParam('type') == 'json'){
                                $resposta['situacao'] = "error";
            	                $resposta['msg'] = 'Você não tem permissão para este controlador '.$request->getControllerName().' ou esta ação '.$acao; 
            	                echo json_encode($resposta);
            	                exit();
                            }else{
                               echo "<script>alert('Você não tem permissão para este controlador ".$request->getControllerName()." ou esta ação ".$acao."')</script>";
                               $request->setModuleName('default')->setControllerName('index')->setActionName('index');
                            }
                            
                        }
                    
                    }
                    
                    $registry->set('acl', $acl);

                }
             
            }
        }
    }
    
    
    public function _getModulos(){
        $front = Zend_Controller_Front::getInstance();
        $acl = array();
        $matches = array();
        foreach ($front->getControllerDirectory() as $module => $path) {
        
            foreach (scandir($path) as $file) {
               
                if (strstr($file, "Controller.php") !== false) {
        
                    include_once $path . DIRECTORY_SEPARATOR . $file;
        
                    foreach (get_declared_classes() as $class) {
        
                        if (is_subclass_of($class, 'Zend_Controller_Action')) {
                            $controller = strtolower(substr($class, 0, strpos($class, "Controller")));
                            $actions = array();
        
                            foreach (get_class_methods($class) as $action) {
        
                                if (strstr($action, "Action") !== false) {
                                    $action = str_replace("Action", "", $action);
                                    $a = preg_match('/[A-Z]/', $action, $matches);
                                    $b = preg_replace("/[A-Z]/", "-".strtolower($matches[0]), $action);
                                    $actions[] = $b;
                                }
                            }
                        }
                    }
        
                    $acl[$module][$controller] = $actions;
                }
            }
        }
        
        return $acl;
    }
}