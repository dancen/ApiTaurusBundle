<?php

namespace Api\TaurusBundle\Model;

/**
 *Api\TaurusBundle\Model\ManagerFactory
 *
 * @author Daniele Centamore <daniele.centamore@gmail.com>
 */
class ManagerFactory {
        
    /**
     * Get createAppManager
     *
     * @return Api\TaurusBundle\Model\AppManager
     */
    public function createAppManager( $container ) {        
        
        return $container->get('apitaurus.app_manager');
        
    }
       

     /**
     * Get createEntityManager
     *
     * @return Api\TaurusBundle\Model\EntManager
     */
     public function createEntityManager( $container ) {        
        
        return $container->get('apitaurus.ent_manager');
        
     }
        
       

    

}
