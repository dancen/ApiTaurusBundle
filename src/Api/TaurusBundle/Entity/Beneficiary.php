<?php

namespace Api\TaurusBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Api\TaurusBundle\Beneficiary
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Api\TaurusBundle\Entity\BeneficiaryRepository")
 */
class Beneficiary {

    /**
     * @var bigint $id
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @var string $beneficiaryname
     *
     * @ORM\Column(name="beneficiaryname", type="string", length=100, nullable=false)
     */
    protected $beneficiaryname;
    
    
   /**
     * @var string $beneficiaryaccount
     *
     * @ORM\Column(name="beneficiaryaccount", type="string", length=100, nullable=false)
     */
    protected $beneficiaryaccount;
    
    
    
    /**
     * @var string $banknote
     *
     * @ORM\Column(name="banknote", type="string", length=255, nullable=false)
     */
    protected $banknote;
    
    
    /**
     * @var date $created_at
     *
     * @ORM\Column(name="created_at",  type="datetime", nullable=false)
     */
    private $created_at;
    
    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="beneficiaries")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
     protected $user;
    
     
    /**
     * @ORM\OneToMany(targetEntity="Transaction", mappedBy="beneficiary")
     * @ORM\OrderBy({"transactionid" = "ASC", "id" = "ASC"})
     */
    protected $transactions;
    
        
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
     * Set beneficiaryname
     *
     * @param string $beneficiaryname
     * @return Beneficiary
     */
    public function setBeneficiaryname($beneficiaryname)
    {
        $this->beneficiaryname = $beneficiaryname;
    
        return $this;
    }

    /**
     * Get beneficiaryname
     *
     * @return string 
     */
    public function getBeneficiaryname()
    {
        return $this->beneficiaryname;
    }

    /**
     * Set beneficiaryaccount
     *
     * @param string $beneficiaryaccount
     * @return Beneficiary
     */
    public function setBeneficiaryaccount($beneficiaryaccount)
    {
        $this->beneficiaryaccount = $beneficiaryaccount;
    
        return $this;
    }

    /**
     * Get beneficiaryaccount
     *
     * @return string 
     */
    public function getBeneficiaryaccount()
    {
        return $this->beneficiaryaccount;
    }

    
    /**
     * Set banknote
     *
     * @param string $banknote
     * @return Beneficiary
     */
    public function setBanknote($banknote)
    {
        $this->banknote = $banknote;
    
        return $this;
    }

    /**
     * Get banknote
     *
     * @return string 
     */
    public function getBanknote()
    {
        return $this->banknote;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return Beneficiary
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
     * Set user
     *
     * @param \Api\TaurusBundle\Entity\User $user
     * @return Beneficiary
     */
    public function setUser(\Api\TaurusBundle\Entity\User $user = null)
    {
        $this->user = $user;
    
        return $this;
    }

    /**
     * Get user
     *
     * @return \Api\TaurusBundle\Entity\User 
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * Add transactions
     *
     * @param \Api\TaurusBundle\Entity\Transacion $transactions
     * @return Beneficiary
     */
    public function addTransaction(\Api\TaurusBundle\Entity\Transacion $transactions)
    {
        $this->transactions[] = $transactions;
    
        return $this;
    }

    /**
     * Remove transactions
     *
     * @param \Api\TaurusBundle\Entity\Transacion $transactions
     */
    public function removeTransaction(\Api\TaurusBundle\Entity\Transacion $transactions)
    {
        $this->transactions->removeElement($transactions);
    }

    /**
     * Get transactions
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getTransactions()
    {
        return $this->transactions;
    }
}