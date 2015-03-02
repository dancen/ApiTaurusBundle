<?php

namespace Api\TaurusBundle\Model;

/**
 *Api\TaurusBundle\Model\AppManagerInterface
 *
 * @author Daniele Centamore <daniele.centamore@gmail.com>
 */
interface AppManagerInterface {   
    
  /**
    * method all AppManager class must implement
    */  
   

   public function verifySecretCode($secretcode,$email);
   
   public function getBankInfobyUser($user);
   
   public function sendAuthorizationCode($authorizationcode);
   
   public function executeTransaction($user,$beneficiaryname,$beneficiaryaccount,$orderamount,$banknote,$transactionid);

   public function saveTransaction($beneficiary,$transaction);
   
   public function cancelTransaction($transactionid);
   
   public function sendOperationCode($operationcode,$user);
    

}
