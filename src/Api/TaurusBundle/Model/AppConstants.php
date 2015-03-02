<?php

namespace Api\TaurusBundle\Model;


/**
 *Api\TaurusBundle\Model\AppConstants
 *
 * @author Daniele Centamore <daniele.centamore@gmail.com>
 */
interface AppConstants {
        
 
  /**
    * application constants 
    * BUNDLE - bundle name
    */
    const BUNDLE = "ApiTaurusBundle";
    const SUCCESS_RESPONSE = "success";
    const ERROR_RESPONSE = "error";    
    const STATUS_TRANSACTION_COMPLETED = "transacion-completed";
    const STATUS_TRANSACTION_CANCELLED = "transaction-cencelled";
   
    

}
