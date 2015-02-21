<?php 

class Zend_View_Helper_FlashMessenger extends Zend_View_Helper_Abstract
{
    public function flashMessenger()
    {
        $messages = Zend_Controller_Action_HelperBroker::getStaticHelper('FlashMessenger')->getMessages();
        $output = '';
        
        if (!empty($messages)) {
            foreach ($messages as $message) {
                $output = '<div class="alert alert-dismissible alert-'.key($message).'" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' . current($message) . '</div>';
            }
        }
        
        return $output;
    }
}