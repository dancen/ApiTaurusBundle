<?php

namespace Api\TaurusBundle\Model;
use Api\TaurusBundle\Model\AppConstants;
use Api\TaurusBundle\Model\AppManagerInterface;


/**
 *Api\TaurusBundle\Model\AppManager
 *
 * @author Daniele Centamore <daniele.centamore@gmail.com>
 */
abstract class AppManager extends Manager implements AppConstants , AppManagerInterface {
    

    /**
    * verify secret code credential
    * @abstract
    */
    abstract public function verifySecretCode($secretcode,
            $email);
    
    
    /**
    * verify secret code credential
    * @abstract
    */
    abstract public function getBankInfobyUser($user);
    
      
    /**
    * execute the transaction
    * @abstract
    */
    abstract public function executeTransaction($user,
            $beneficiaryname,
            $beneficiaryaccount,
            $orderamount,
            $banknote,
            $transactionid);

    /**
    * save transaction to db 
    * @abstract
    */
    abstract public function saveTransaction($beneficiary,$transaction);
    
    
    
    /**
    * within 8 hours the transaction can be cancelled
    * @abstract
    */
    abstract public function cancelTransaction($transactionid);
    
    
    /**
    * transaction id generator
    * @abstract
    */
    public function generateTransactionID($session){
        $token = $session->getId()."-".rand(1000,9999);
        return $token;
    }
    
    /**
    * authorization code generator
    * @abstract
    */
    public function generateAuthorizationCode(){
        $token = rand(100000000000,999999999999);
        // test value 999999999999
        $token = "999999999999";
        return $token;
    }
    
    /**
    * send the authorization code to the user's smartphone 
    * @abstract
    */
    public function sendAuthorizationCode($authorizationcode){
        
        // implement here the code to send the authorization code to the user's smartphone
        return AppConstants::SUCCESS_RESPONSE;        
    }
    
    /**
    * send the operation code to the user's smartphone 
    * @abstract
    */
    public function sendOperationCode($operationcode,$user){
        
        // implement here the code to send the operation reference number to the user's email
        return AppConstants::SUCCESS_RESPONSE;        
    }
    

}
