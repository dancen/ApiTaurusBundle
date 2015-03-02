<?php

namespace Api\TaurusBundle\EventListener;

use Api\TaurusBundle\Event\FilterManagerEvent;
use Api\TaurusBundle\Model\AppConstants;


/**
 * Api\TaurusBundle\EventListener\SendAuthorizationCodeListener
 *
 * @author Daniele Centamore <daniele.centamore@gmail.com>
 */
class SendAuthorizationCodeListener implements AppConstants {



    public function onProcess(FilterManagerEvent $event) {

        /**
         * 
         * @param Api\TaurusBundle\Event\FilterManagerEvent $event
         * @return void
         */
        $appmanager = $event->getManagerFactory()->createAppManager($event->getContainer());
        $session = $event->getRequest()->getSession();
        $authorizationcode = $appmanager->generateAuthorizationCode();
        $session->set("authorizationcode", $authorizationcode);
        $response = $appmanager->sendAuthorizationCode($authorizationcode);
        if ($response == AppConstants::ERROR_RESPONSE) {
            $event->setMessage(AppConstants::ERROR_RESPONSE);
        }

           
    }

   
   

}
