<?php

namespace Api\TaurusBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Api\TaurusBundle\Transaction
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Api\TaurusBundle\Entity\TransactionRepository")
 */
class Transaction {

    /**
     * @var bigint $id
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @var string $transactionid
     *
     * @ORM\Column(name="transactionid", type="string", length=100, nullable=false)
     */
    protected $transactionid;
    
    
   /**
     * @var string $authorizationcode
     *
     * @ORM\Column(name="authorizationcode", type="string", length=100, nullable=false)
     */
    protected $authorizationcode;
       
    
    /**
     * @var string $bankresponsecode
     *
     * @ORM\Column(name="bankresponsecode", type="string", length=10, nullable=false)
     */
    protected $bankresponsecode;
    
    /**
     * @var decimal $amount
     *
     * @ORM\Column(name="amount", type="decimal", precision=8, scale=2, nullable=false)
     */
    protected $amount;
    
    /**
     * @var string $statusmessage
     *
     * @ORM\Column(name="statusmessage", type="string", length=100, nullable=false)
     */
    protected $statusmessage;
    
    
    /**
     * @ORM\ManyToOne(targetEntity="Beneficiary", inversedBy="transactions")
     * @ORM\JoinColumn(name="beneficiary_id", referencedColumnName="id")
     */
     protected $beneficiary;
    
    
    /**
     * @var date $created_at
     *
     * @ORM\Column(name="created_at",  type="datetime", nullable=false)
     */
    private $created_at;
    
    
    /**
     * @var date $updated_at
     *
     * @ORM\Column(name="updated_at",  type="datetime", nullable=false)
     */
    private $updated_at;
    
    
        
    /**
     * Constructor
     */
    public function __construct()
    {
       
    }

   

    /**
     * Get id
     *
     * @return integer 
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set transactionid
     *
     * @param string $transactionid
     * @return Transaction
     */
    public function setTransactionid($transactionid)
    {
        $this->transactionid = $transactionid;
    
        return $this;
    }

    /**
     * Get transactionid
     *
     * @return string 
     */
    public function getTransactionid()
    {
        return $this->transactionid;
    }

    /**
     * Set authorizationcode
     *
     * @param string $authorizationcode
     * @return Transaction
     */
    public function setAuthorizationcode($authorizationcode)
    {
        $this->authorizationcode = $authorizationcode;
    
        return $this;
    }

    /**
     * Get authorizationcode
     *
     * @return string 
     */
    public function getAuthorizationcode()
    {
        return $this->authorizationcode;
    }

    
    /**
     * Set bankresponsecode
     *
     * @param string $bankresponsecode
     * @return Transaction
     */
    public function setBankresponsecode($bankresponsecode)
    {
        $this->bankresponsecode = $bankresponsecode;
    
        return $this;
    }

    /**
     * Get bankresponsecode
     *
     * @return string 
     */
    public function getBankresponsecode()
    {
        return $this->bankresponsecode;
    }

    /**
     * Set transactionstatus
     *
     * @param string $transactionstatus
     * @return Transaction
     */
    public function setTransactionstatus($transactionstatus)
    {
        $this->transactionstatus = $transactionstatus;
    
        return $this;
    }

    /**
     * Get transactionstatus
     *
     * @return string 
     */
    public function getTransactionstatus()
    {
        return $this->transactionstatus;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return Transaction
     */
    public function setCreatedAt($createdAt)
    {
        $this->created_at = $createdAt;
    
        return $this;
    }

    /**
     * Get created_at
     *
     * @return \DateTime 
     */
    public function getCreatedAt()
    {
        return $this->created_at;
    }

    /**
     * Set beneficiary
     *
     * @param \Api\TaurusBundle\Entity\Beneficiary $beneficiary
     * @return Transaction
     */
    public function setBeneficiary(\Api\TaurusBundle\Entity\Beneficiary $beneficiary = null)
    {
        $this->beneficiary = $beneficiary;
    
        return $this;
    }

    /**
     * Get beneficiary
     *
     * @return \Api\TaurusBundle\Entity\Beneficiary 
     */
    public function getBeneficiary()
    {
        return $this->beneficiary;
    }

    /**
     * Set statusmessage
     *
     * @param string $statusmessage
     * @return Transaction
     */
    public function setStatusmessage($statusmessage)
    {
        $this->statusmessage = $statusmessage;
    
        return $this;
    }

    /**
     * Get statusmessage
     *
     * @return string 
     */
    public function getStatusmessage()
    {
        return $this->statusmessage;
    }

    /**
     * Set amount
     *
     * @param float $amount
     * @return Transaction
     */
    public function setAmount($amount)
    {
        $this->amount = $amount;
    
        return $this;
    }

    /**
     * Get amount
     *
     * @return float 
     */
    public function getAmount()
    {
        return $this->amount;
    }

    /**
     * Set updated_at
     *
     * @param \DateTime $updatedAt
     * @return Transaction
     */
    public function setUpdatedAt($updatedAt)
    {
        $this->updated_at = $updatedAt;
    
        return $this;
    }

    /**
     * Get updated_at
     *
     * @return \DateTime 
     */
    public function getUpdatedAt()
    {
        return $this->updated_at;
    }
}