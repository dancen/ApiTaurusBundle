<?php

namespace Api\TaurusBundle\Doctrine;
use Api\TaurusBundle\Model\AppManager;
use Api\TaurusBundle\Model\AppConstants;


/**
 *Api\TaurusBundle\Model\DoctrineAppManager
 *
 * @author Daniele Centamore <daniele.centamore@gmail.com>
 */
class DoctrineAppManager extends AppManager {
    

        
    
    /**
     * Get getInfosHistory
     *
     * @return array
     */
    public function verifySecretCode($secretcode,$email) {        
        $repository = $this->em_loader->getEntityManager()->getRepository('ApiTaurusBundle:User');
        $user = $repository->getUser($secretcode,$email);              
        return $user;
    }
    
    /**
     * Get getInfosHistory
     *s
     * @return array
     */
    public function getBankInfobyUser($user) {        
        $repository = $this->em_loader->getEntityManager()->getRepository('ApiTaurusBundle:User');
        $bank = $repository->getBankbyUser($user);              
        return $bank->getBankinfo();
    }
    
       
    /**
     * Get getLastInfoDatetimeByUserAndLocation
     *
     * @return \Datetime 
     */
    public function executeTransaction($user,$beneficiaryname,$beneficiaryaccount,$orderamount,$banknote,$transactionid) {
       $bank = $this->getBankInfobyUser($user);     
       
       // write here the code to bank calling
       // the bank return a transaction reference
       $operationID = "550000299292-838821000";       
       
        return $operationID;
    }

    /**
     * saveTransaction object to db o cache data
     *
     */
    public function saveTransaction( $beneficiary, $transaction ) {
        
        $this->em_loader->getEntityManager()->persist($beneficiary);
        $this->em_loader->getEntityManager()->persist($transaction);
        $this->em_loader->getEntityManager()->flush();
        
    }
    
        
    /**
     * cancelTransaction object to db o cache data
     *
     */
    public function cancelTransaction($transactionid) {       
        
        $repository = $this->em_loader->getEntityManager()->getRepository('ApiTaurusBundle:Transaction');
        $transaction = $repository->findBy($transactionid);
        $transaction->setStatusmessage(AppConstants::STATUS_TRANSACTION_CANCELLED);
        $transaction->setUpdatedAt(new \DateTime("now"));
        $this->em_loader->getEntityManager()->persist($transaction);
        $this->em_loader->getEntityManager()->flush();
    }
    
    
    
    
    

}
