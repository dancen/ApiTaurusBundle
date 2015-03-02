<?php

namespace Api\TaurusBundle\Model;

/**
 *Api\TaurusBundle\Model\AppFactory
 *
 * @author Daniele Centamore <daniele.centamore@gmail.com>
 */
class AppFactory {
    

    public static function createDatetime(){
        
         /**
        * onSaveService() proxy method to save db data
        * 
        * @param Api\TaurusBundle\Event\FilterManagerEvente $event
        * @return void
        */
        
        return new \Datetime("now");
    }    
       
    public static function createDatetimeToday(){
        
         /**
        * onSaveService() proxy method to save db data
        * 
        * @param Api\TaurusBundle\Event\FilterManagerEvente $event
        * @return void
        */
        
        return new \DateTime("today");
    }    
    
    public static function createRedirectResponse( $url ){
        
         /**
        * onSaveService() proxy method to save db data
        * 
        * @param Api\TaurusBundle\Event\FilterManagerEvente $event
        * @return void
        */
        
        return new \Symfony\Component\HttpFoundation\RedirectResponse( $url , 301 );
    }    
        
    public static function createResponse(){
        
         /**
        * onSaveService() proxy method to save db data
        * 
        * @param Api\TaurusBundle\Event\FilterManagerEvente $event
        * @return void
        */
        
        return new \Symfony\Component\HttpFoundation\Response();
    }
    
    public static function createJsonResponse( $params ){
        
         /**
        * onSaveService() proxy method to save db data
        * 
        * @param Api\TaurusBundle\Event\FilterManagerEvente $event
        * @return void
        */
        
        return new \Symfony\Component\HttpFoundation\Response( $params );
    }
    
    public static function createCookie( $name, $value ){
        
         /**
        * onSaveService() proxy method to save db data
        * 
        * @param Api\TaurusBundle\Event\FilterManagerEvente $event
        * @return void
        */
        
        return new \Symfony\Component\HttpFoundation\Cookie( $name, $value , time() + (3600 * 48));
    }
    
    public static function createTransaction(){
        return new \Api\TaurusBundle\Entity\Transaction();
    }
    
    public static function createBeneficiary(){
        return new \Api\TaurusBundle\Entity\Beneficiary();
    }
    
    

}
