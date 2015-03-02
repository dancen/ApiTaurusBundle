<?php

namespace Api\TaurusBundle\EventListener;

use Api\TaurusBundle\Event\FilterManagerEvent;
use Api\TaurusBundle\Model\AppConstants;
use Api\TaurusBundle\Model\AppFactory;
use Symfony\Component\HttpFoundation\Response;

/**
 * Api\TaurusBundle\EventListener\AppListener
 *
 * @author Daniele Centamore <daniele.centamore@gmail.com>
 */
class CheckAuthorizationCodeListener implements AppConstants {



    public function onProcess(FilterManagerEvent $event) {

        /**
         * 
         * @param Api\TaurusBundle\Event\FilterManagerEvent $event
         * @return void
         */
        $session = $event->getRequest()->getSession();
        $secretcode = $event->getRequest()->get("secretcode");
        $authCode = $event->getRequest()->get("authCode");
        $transactionID = $event->getRequest()->get("transactionID");

        if (($secretcode != "") &&
                ($authCode == $session->get("authorizationcode")) &&
                ($transactionID == $session->get("transactionid"))) {
            
            $response = new Response(json_encode(array(
                        "response" => "success",
            )));
            
            $event->setMessage(AppConstants::SUCCESS_RESPONSE);        
            
        } else {
            $response = new Response(json_encode(array("response" => "error")));
            $event->setMessage(AppConstants::ERROR_RESPONSE);
        }

        $response->headers->set('Content-Type', 'application/json');

        $event->setResponse($response);
    }

   
   

}
