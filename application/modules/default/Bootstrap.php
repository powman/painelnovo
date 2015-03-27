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
	
	protected function _initViewHelpers() {
	    $view = Zend_Layout::startMvc()->getView();
	    $this->moduloGrupo = Default_Model_ModuloGrupo::getDefaultAdapter();
	    $this->modulo = Default_Model_Modulo::getDefaultAdapter();
	    $this->resource = Default_Model_Resource::getDefaultAdapter();
	    
	    $sql = $this->moduloGrupo->select()->from('modulo_grupo')->where('status = ?','1');
	    $view->grupo = $this->moduloGrupo->fetchAll($sql);
	    
	    
	    foreach ($view->grupo as $grupo){
	        $sql = $this->modulo->select()->from('modulo')->where('modulo_grupo_id = ?',$grupo['id']);
	        $nome = 'modulo'.$grupo['id'];
	        $view->$nome = $this->modulo->fetchAll($sql);

	        foreach ($view->$nome as $modulo){
	            $sql = $this->resource->select()->from('resource')->where('modulo_id = ?',$modulo['id']);
	            $nome = 'resource'.$modulo['id'];
	            $view->$nome = $this->resource->fetchAll($sql);
	        }
	    }
	}
	


}