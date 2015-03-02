<?php

namespace Api\TaurusBundle\EventListener;

use Api\TaurusBundle\Event\FilterManagerEvent;
use Api\TaurusBundle\Model\AppConstants;
use Api\TaurusBundle\Model\AppFactory;

/**
 * Api\TaurusBundle\EventListener\SaveTransactionListener
 *
 * @author Daniele Centamore <daniele.centamore@gmail.com>
 */
class SaveTransactionListener implements AppConstants {

       
    
    public function onProcess(FilterManagerEvent $event){
        
        
        /**
         * 
         * @param Api\TaurusBundle\Event\FilterManagerEvent $event
         * @return void
         */
        
        /**
          *  init parameters
          */
        $session = $event->getRequest()->getSession();
        $appmanager = $event->getManagerFactory()->createAppManager($event->getContainer());
        $user = $appmanager->verifySecretCode($session->get("user"), $session->get("email"));
        $beneficiaryname = $event->getRequest()->get("beneficiaryname");
        $beneficiaryaccount = $event->getRequest()->get("beneficiaryaccount");
        $banknote = $event->getRequest()->get("banknote");
        $orderamount = $this->normalizeAmount($event->getRequest()->get("orderamount"));
        $transactionID = $event->getRequest()->get("transactionID");
        $authorizaioncode = $session->get("authorizationcode");        
        $bankoperationID = $session->get("operationid");
        
        
                /**
                 * create a Beneficiary object
                 */
                $beneficiary = AppFactory::createBeneficiary();
                $beneficiary->setCreatedAt(new \DateTime("now"));
                $beneficiary->setBeneficiaryname($beneficiaryname);
                $beneficiary->setBeneficiaryaccount($beneficiaryaccount);
                $beneficiary->setBanknote($banknote);
                $beneficiary->setUser($user);
                $event->setData($beneficiary); 
        
                /**
                 * create a transaction object
                 */
                $transaction = AppFactory::createTransaction();        
                $transaction->setCreatedAt(new \DateTime("now"));
                $transaction->setUpdatedAt(new \DateTime("now"));
                $transaction->setTransactionid($transactionID);
                $transaction->setAuthorizationcode($authorizaioncode);
                $transaction->setBankresponsecode($bankoperationID);
                $transaction->setBeneficiary($beneficiary);
                $transaction->setAmount(floatval($orderamount));
                $transaction->setStatusmessage(AppConstants::STATUS_TRANSACTION_COMPLETED);            
        
        
        /**
         * save data to db
         */
        $appmanager->saveTransaction($beneficiary,$transaction); 
        
        /**
         * clear all attributes in session
         */
        $session->clear();
        
        
    }
    
    
    private function normalizeAmount($orderamount){
        $orderamount = str_replace(".","",$orderamount);
        if(strpos(",", $orderamount)<0){
              $euro = str_subsring($orderamount,0,count($orderamount)-3);
              $cents = str_subsring($orderamount,count($orderamount)-3,2);
              $orderamount = $euro.".".$cents;
        } else {
              $orderamount = str_replace(",",".",$orderamount);
        }
        return $orderamount;
    }

        
   

}
