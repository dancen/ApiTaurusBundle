<?php

namespace Api\TaurusBundle\EventListener;

use Api\TaurusBundle\Event\FilterManagerEvent;
use Api\TaurusBundle\Model\AppConstants;

/**
 * Api\TaurusBundle\EventListener\SendOperationCodeListener
 *
 * @author Daniele Centamore <daniele.centamore@gmail.com>
 */
class SendOperationCodeListener implements AppConstants {


    public function onProcess(FilterManagerEvent $event) {

        /**
         * 
         * @param Api\TaurusBundle\Event\FilterManagerEvent $event
         * @return void
         */
        $session = $event->getRequest()->getSession();
        $appmanager = $event->getManagerFactory()->createAppManager($event->getContainer());
        $bankoperationID = $session->get("operationid");
        $user = $appmanager->verifySecretCode($session->get("user"), $session->get("email"));        
        $appmanager->sendOperationCode($bankoperationID,$user);
    }
    
    
   

}
