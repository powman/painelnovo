<?php

class Default_Model_Membro extends Zend_Db_Table_Abstract
{
    protected $_name = 'membro';
    
    public $id = null;
    
    public function save(array $data)
    {
        $id = $data['id'];
        if ($this->_dataExists($id) && $id) {
             unset($data['id']);
             $result = $this->update($data, "id = {$id}");
             return  $result === 0 || $result === true || $result >= 1 ? true : false;
        } else {
            $this->insert($data);
            return $this->getAdapter()->lastInsertId();
        }
    }
    
    private function _dataExists($id)
    {
        $sql = $this->getAdapter()->select()->from(array('m' => 'membro'), 'count(id) as qtd');
        $res = $this->getAdapter()->fetchRow($sql);
        if (isset($res['qtd']) && $res['qtd'] > 0) {
            return true;
        } else {
            return false;
        }
    }
}