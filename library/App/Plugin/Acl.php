 <?php
 // Instalar o banco de dados
 // http://_zend1.com/login/index/index/instalar/1
class App_Plugin_Acl extends Zend_Controller_Plugin_Abstract
{
public $acl;

public function __construct($db)
{

    // Instânciamos a ACL
    $this->acl = new Zend_Acl();
    
    
    
    // Primeiro vamos instânciar o Zend_Auth
    $auth = Zend_Auth::getInstance();
    $identity = $auth->getIdentity();

    // Criando o grupo visitante
    $modulos = $this->_listarModulo($db);
    $this->acl->addRole('visitante'); //Visitante
    
    // verifica se o usuario ta logado
    if(isset($identity) && $identity->role_id){
        foreach($modulos as $modulo){
            $this->acl->addResource($modulo['nome']); // Para sair do sistema
        }
        // adciona o role id do usuário logado
        $this->acl->addRole($identity->role_id,'visitante'); //Visitante
    
        //pega os metodos do role do usuario logado
        $resources = $this->_listarResource($db, $identity->role_id);
        $aNewsArray = array();
        // adciona as permissão do banco de dados, as actions.
        foreach ($resources as $resource){
            $aNewsArray = array($resource['resource']);
            $this->acl->allow($identity->role_id, 'default:index',$aNewsArray);
        }
    }

    // Funcionalidades
    // Definicao modulo:controller, action
    $this->acl->addResource('default:error'); // quando der erro no sistema
    $this->acl->addResource('login:index'); // quando der erro no sistema


    // Definir as permissões
    // perfil, modulo:controller, action
    // Metódo allow é de permissão
    // Metódo deny é de negação

    // Perfil: Operador
    // verifica se o usuario ta logado
    $this->acl->allow('visitante', 'default:error'); // Dando permissao para mostrar os erros
    $this->acl->allow('visitante', 'login:index'); // Dando permissão no login
}

 public function preDispatch(Zend_Controller_Request_Abstract $request)
 {
     // pega os modulos e cadastra no banco
     if($request->getParam('instalar')){
         $model = new Default_Model_Modulo();
         $modulos = $this->_getModulos();
         foreach ($modulos as $key => $modulo){
             
             foreach ($modulo as $key2 => $resource){
                 $data['id'] = '';
                 $data['nome'] = $key.":".$key2;
                 $sql = $model->select()->from('modulo');
                 $sql->where('nome = ?', $key.":".$key2);
                 // verifica se o modulo foi cadastrado
                 $verifica = $model->fetchRow($sql);
                 if(!$verifica['id'])
                    $model->save($data);
             }
         }
     }
     
     // Primeiro vamos instânciar o Zend_Auth
     $auth = Zend_Auth::getInstance();
     // Agora vamos descobri qual o modulo, controller e action que o usuário está acessando
     $module = $request->getModuleName();
     $controller = $request->getControllerName();
     $action = $request->getActionName();
     
     /* Agora que já capturamos a ação do usuário, vamos verificar se o usuário está logado, caso esteja vamos verificar se ele tem acesso a funcionalidade */
     if($auth->hasIdentity()) {
         // Beleza o cabra ta logado, agora vamos ver se ele tem permissão
         $identity = $auth->getIdentity();
     
         if(!$this->acl->isAllowed($identity->role_id, $module.':'.$controller, $action)) {
             /* Agora é so direcionar para outra página ou gerar o erro, eu faço o seguinte seto o controller de error e ação forbidden que é o erro 403, ficando assim.*/
           $request->setModuleName('default')->setControllerName('error')->setActionName('permissao')->setParams(array('modulo' => $module,'controle' => $controller, 'acao' => $action));
         }
     }
 }
 
 public function _listarModulo($db){
    $this->_db             = $db;
    $sql = $this->_db->select()->from('modulo');
    $dados = $this->_db->fetchAll($sql);
    return $dados;
 }
 
 public function _listarResource($db,$idRole){
    $this->_db             = $db;
    $sql = $this->_db->select()->from('resource');
    $sql->where('role_id = ?',$idRole);
    $dado = $this->_db->fetchAll($sql);
    return $dado;
 }

// pega os modulos scaneando os diretorios
public function _getModulos(){
    // Modulo para não cadastrar pois o mesmo ja existe
    $aNaoListar = array('default:error','login:index');
    
    $front = Zend_Controller_Front::getInstance();
    $acl = array();
    $matches = array();
    foreach ($front->getControllerDirectory() as $module => $path) {
        foreach (scandir($path) as $file) {
            
            if (strstr($file, "Controller.php") !== false) {
                $controller = strtolower(substr($file, 0, strpos($file, "Controller")));
                include_once $path . DIRECTORY_SEPARATOR . $file;
                
                foreach (get_declared_classes() as $class) {
                    
                    if (is_subclass_of($class, 'Zend_Controller_Action')) {
                        $actions = array();
    
                        foreach (get_class_methods($class) as $action) {
                            
                            if (strstr($action, "Action") !== false) {
                                $action = str_replace("Action", "", $action);
                                $a = preg_match('/[A-Z]/', $action, $matches);
                                if(count($matches) > 0){
                                    $b = preg_replace("/[A-Z]/", "-".strtolower($matches[0]), $action);
                                }else{
                                    $b = $action;
                                }
                                $actions[] = $b;
                            }
                        }
                    }
                }
                if(!in_array($module.":".$controller, $aNaoListar))
                    $acl[$module][$controller] = $actions;
            }
        }
        
    }
    
    return $acl;
}

}

