<?php

namespace Api\TaurusBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Api\TaurusBundle\ApiTaurusEvents;
use Api\TaurusBundle\Model\AppConstants;
use Symfony\Component\HttpFoundation\Response;

class DefaultController extends Controller {

    
    /*
     * APPLICATION STORYBOARD
     * the user is registered to the system
     * the user provide credential in order to obtain a transaction id
     * the system send the authorization code to the user's smartphone @_TODO_@
     * the user digit the authorization code received to complete the transaction
     * the user provide the transaction data to the system
     * the system call the bank's system to execute the transaction
     * the system receive the operation reference number from the bank and save data to db
     * the system return the response to the user's device
     * the system send a report to the user's email @_TODO_@
     */ 
    
    
    
    public function indexAction() {
        
         $response = new Response(json_encode(array(
            "application" => "Taurus Api 1.0",
            "release date" => "Feb 2015",
            "author" => "Daniele Centamore",
            "contact" => "daniele.centamore@gmail.com"
        )));

        $response->headers->set('Content-Type', 'application/json');
        
        return $response;
    }
    
    
    
    /*
     * APPLICATION STORYBOARD
     * the user is registered to the system by his bank
     * the user provide credential to obtain a transaction id
     * the system send the auhorization code to the user's smartphone   
     */   

    public function verifySecretCodeAction() {        
         
        /** @var $dispatcher \Symfony\Component\EventDispatcher\EventDispatcherInterface */
        $dispatcher = $this->container->get('event_dispatcher');
        $event = $this->get('apitaurus.filter_manager_event');

        $dispatcher->dispatch(ApiTaurusEvents::INIT_TRANSACTION, $event);
        
        if($event->getMessage() ==  AppConstants::SUCCESS_RESPONSE){
              $dispatcher->dispatch(ApiTaurusEvents::SEND_AUTHORIZATION_CODE, $event);
        }
        
        return $event->getResponse();
    }

    
    /*
     * APPLICATION STORYBOARD
     * the user digit the auhorization code received to complete the transaction 
     */     
    
    public function veryfyAuthorizationCodeAction() {

        /** @var $dispatcher \Symfony\Component\EventDispatcher\EventDispatcherInterface */
        $dispatcher = $this->container->get('event_dispatcher');
        $event = $this->get('apitaurus.filter_manager_event');

        $dispatcher->dispatch(ApiTaurusEvents::CHECK_AUTHORIZATION_CODE, $event);        
        return $event->getResponse();
    }

    
    
    
    /*
     * APPLICATION STORYBOARD
     * the user provide the transaction data to the system
     * the system call the bank's system to execute the transaction
     * the system save data to db
     * the system return the response to the user's device
     * the system send a report to the user's email 
     */ 
    
    public function executeTransactionAction() {

        /** @var $dispatcher \Symfony\Component\EventDispatcher\EventDispatcherInterface */
        $dispatcher = $this->container->get('event_dispatcher');
        $event = $this->get('apitaurus.filter_manager_event');

        $dispatcher->dispatch(ApiTaurusEvents::EXECUTE_TRANSACTION, $event);
        
        if($event->getMessage() ==  AppConstants::SUCCESS_RESPONSE){
              $dispatcher->dispatch(ApiTaurusEvents::SAVE_TRANSACTION, $event);
              $dispatcher->dispatch(ApiTaurusEvents::SEND_OPERATION_CODE, $event);
        }
        
        return $event->getResponse();
    }

}
