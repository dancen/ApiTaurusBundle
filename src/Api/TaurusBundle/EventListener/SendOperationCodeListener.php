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
        
        $data = $event->getData();
        $bankoperationID = $data["bankoperationID"];
        $user = $data["user"];
        
        $appmanager = $event->getManagerFactory()->createAppManager($event->getContainer());   
        $appmanager->sendOperationCode($bankoperationID,$user);
        
    }
    
    
   

}
