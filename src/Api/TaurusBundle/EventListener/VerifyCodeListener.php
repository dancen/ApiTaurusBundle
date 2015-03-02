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

        $appmanager = $event->getManagerFactory()->createAppManager($event->getContainer());
        $session = $event->getRequest()->getSession();
        $secretcode = $event->getRequest()->get("secretcode");
        $email = $event->getRequest()->get("email");

        if ($secretcode != "" && $email != "") {

            $user = $appmanager->verifySecretCode($secretcode, $email);

            if ($user != null) {
                $session->set("user", $secretcode);
                $session->set("email", $email);
                $transactionid = $appmanager->generateTransactionID($session);
                $session->set("transactionid", $transactionid);
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


        $event->setResponse($response);
    }

   
        
   

}
