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
        
       
        $session = $event->getRequest()->getSession();         
        $appmanager = $event->getManagerFactory()->createAppManager($event->getContainer());       
        $trassession = $session->get("transactionid");
        
        /**
         * retrieve variable from request object
         */
        $beneficiaryname = $event->getRequest()->get("beneficiaryname");
        $beneficiaryaccount = $event->getRequest()->get("beneficiaryaccount");
        $orderamount = $event->getRequest()->get("orderamount");
        $banknote = $event->getRequest()->get("banknote");
        $transactionID = $event->getRequest()->get("transactionID");        
        
        
        
        /**
         * check post data and execute the transaction
         */
        if (($beneficiaryname != "") &&
                ($beneficiaryaccount != "") &&
                ($orderamount != "") &&
                ($banknote != "") &&
                ($transactionID == $trassession)) {

            
            /**
             * check post data and execute the call to the users's bank
             * the bank return the operation id reference
             */
            $user = $appmanager->verifySecretCode($session->get("user"), $session->get("email"));
            $bankoperationID = $appmanager->executeTransaction($user,
                    $beneficiaryname,
                    $beneficiaryaccount,
                    $orderamount,
                    $banknote,
                    $transactionID);
            

            if ($bankoperationID) {
                                                
                $session->set("operationid", $bankoperationID);
                
                
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
        $event->setResponse($response);
    }

    

    
        
   

}
