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
        $secretcode = $event->getRequest()->get("secretcode");
        $email = $event->getRequest()->get("email");

        if ($secretcode != "" && $email != "") {

            $user = $appmanager->verifySecretCode($secretcode, $email); 
            $authorizationcode = $appmanager->generateAuthorizationCode();
            $user->setAuthorizationid($authorizationcode);
            $appmanager->saveTokenByUser($user);
            $response = $appmanager->sendAuthorizationCode($authorizationcode);
            
             if ($response == AppConstants::ERROR_RESPONSE) {
                    $event->setMessage(AppConstants::ERROR_RESPONSE);
            }
        
        } else {
            $event->setMessage(AppConstants::ERROR_RESPONSE);
        } 
        
       

           
    }

   
   

}
