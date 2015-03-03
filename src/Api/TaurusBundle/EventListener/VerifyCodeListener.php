<?php

namespace Api\TaurusBundle\EventListener;

use Api\TaurusBundle\Event\FilterManagerEvent;
use Api\TaurusBundle\Model\AppConstants;
use Symfony\Component\HttpFoundation\Response;

/**
 * Api\TaurusBundle\EventListener\VerifyCodeListener
 *
 * @author Daniele Centamore <daniele.centamore@gmail.com>
 */
class VerifyCodeListener implements AppConstants {

    public function onProcess(FilterManagerEvent $event) {

        /**
         * 
         * @param Api\TaurusBundle\Event\FilterManagerEvent $event
         * @return void
         */
        // 

        
        $secretcode = $event->getRequest()->get("secretcode");
        $email = $event->getRequest()->get("email");
        
        
        $appmanager = $event->getManagerFactory()->createAppManager($event->getContainer());

        if ($secretcode != "" && $email != "") {

            $user = $appmanager->verifySecretCode($secretcode, $email);

            if ($user != null) {                
                $transactionid = $appmanager->generateTransactionID($secretcode,$email);
                $user->setLastaccess(new \DateTime("now"));
                $user->setTransactionid($transactionid);
                $appmanager->saveTokenByUser($user);
                $bankinfo = $appmanager->getBankInfobyUser($user);
                $response = new Response(json_encode(array(
                            "transactionid" => $transactionid,
                            "response" => "success",
                            "message" => "",
                            "bankinfo" => $bankinfo
                )));
                $event->setMessage(AppConstants::SUCCESS_RESPONSE);
            } else {
                $response = new Response(json_encode(array("response" => "error")));
                $event->setMessage(AppConstants::ERROR_RESPONSE);
            }
        } else {
            $response = new Response(json_encode(array("response" => "error", "email" => $email)));
            $event->setMessage(AppConstants::ERROR_RESPONSE);
        }

        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin','*');


        $event->setResponse($response);
    }

   
        
   

}
