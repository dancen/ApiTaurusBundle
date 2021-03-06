<?php

namespace Api\TaurusBundle\EventListener;

use Api\TaurusBundle\Event\FilterManagerEvent;
use Api\TaurusBundle\Model\AppConstants;
use Symfony\Component\HttpFoundation\Response;

/**
 * Api\TaurusBundle\EventListener\ExecuteTransactionListener
 *
 * @author Daniele Centamore <daniele.centamore@gmail.com>
 */
class ExecuteTransactionListener implements AppConstants {



    public function onProcess(FilterManagerEvent $event) {

        /**
         * 
         * @param Api\TaurusBundle\Event\FilterManagerEvent $event
         * @return void
         */
        
        
        $secretcode = $event->getRequest()->get("secretcode");
        $beneficiaryname = $event->getRequest()->get("beneficiaryname");
        $beneficiaryaccount = $event->getRequest()->get("beneficiaryaccount");
        $orderamount = $event->getRequest()->get("orderamount");
        $banknote = $event->getRequest()->get("banknote");
        $transactionID = $event->getRequest()->get("transactionID");       
        
        
        $appmanager = $event->getManagerFactory()->createAppManager($event->getContainer());
        $user = $appmanager->getUserBySecretCode($secretcode);
        $lasttransactionID = $user->getTransactionid();
        $lasttauthorizationID = $user->getAuthorizationid();
        /**
         * check post data and execute the transaction
         */
        if (($beneficiaryname != "") && ($beneficiaryaccount != "") &&
                ($orderamount != "") && ($banknote != "") &&($transactionID == $lasttransactionID)) {

            
            /**
             * check post data and execute the call to the users's bank
             * the bank return the operation id reference
             */
            $bankoperationID = $appmanager->executeTransaction($user,
                    $beneficiaryname,
                    $beneficiaryaccount,
                    $orderamount,
                    $banknote,
                    $lasttransactionID);
            
            //$bankoperationID = "qwfqwiojcqoio";
            if ($bankoperationID) {
                                                
                                
                /**
                 * set the json response
                 */
                $response = new Response(json_encode(array(
                            "operationid" => $bankoperationID,
                            "response" => "success",
                            "message" => ""
                )));
                
                
                /**
                 * set the success system message
                 */
                $event->setData(array("bankoperationID"=>$bankoperationID,"lasttauthorizationID"=>$lasttauthorizationID));
                $event->setMessage(AppConstants::SUCCESS_RESPONSE);
                
            } else {
                
                /**
                 * set the error system message bank call fail
                 */
                
                $response = new Response(json_encode(array("response" => "error")));
                $event->setMessage(AppConstants::ERROR_RESPONSE);
            }
        } else {
            
            /**
                 * set the error system message user parameters fail
                 */
            
            $response = new Response(json_encode(array("response" => "error")));
            $event->setMessage(AppConstants::ERROR_RESPONSE);
        }

        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin','*');
        $event->setResponse($response);
    }

    

    
        
   

}
