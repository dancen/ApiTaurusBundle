<?php

namespace Api\TaurusBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Api\TaurusBundle\User
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Api\TaurusBundle\Entity\UserRepository")
 */
class User {

    /**
     * @var bigint $id
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @var string $secretcode
     *
     * @ORM\Column(name="secretcode", type="string", length=6, nullable=false)
     */
    protected $secretcode;
    
    
   /**
     * @var string $email
     *
     * @ORM\Column(name="email", type="string", length=100, nullable=false)
     */
    protected $email;
    
    
    /**
     * @var string $location
     *
     * @ORM\Column(name="location", type="string", length=100, nullable=false)
     */
    protected $location;
    
    
    /**
     * @var date $created_at
     *
     * @ORM\Column(name="created_at",  type="datetime", nullable=false)
     */
    private $created_at;
    
    
    /**
     * @ORM\ManyToOne(targetEntity="Bank", inversedBy="users")
     * @ORM\JoinColumn(name="bank_id", referencedColumnName="id")
     */
     protected $bank;
     
     
     /**
     * @ORM\OneToMany(targetEntity="Beneficiary", mappedBy="user")
     * @ORM\OrderBy({"beneficiaryname" = "ASC", "id" = "ASC"})
     */
    protected $beneficiaries;
    
    
    /**
     * @var date $lastaccess
     *
     * @ORM\Column(name="lastaccess",  type="datetime", nullable=false)
     */
    private $lastaccess;

    
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
     * Set secretcode
     *
     * @param string $secretcode
     * @return User
     */
    public function setSecretcode($secretcode)
    {
        $this->secretcode = $secretcode;
    
        return $this;
    }

    /**
     * Get secretcode
     *
     * @return string 
     */
    public function getSecretcode()
    {
        return $this->secretcode;
    }

    /**
     * Set email
     *
     * @param string $email
     * @return User
     */
    public function setEmail($email)
    {
        $this->email = $email;
    
        return $this;
    }

    /**
     * Get email
     *
     * @return string 
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set location
     *
     * @param string $location
     * @return User
     */
    public function setLocation($location)
    {
        $this->location = $location;
    
        return $this;
    }

    /**
     * Get location
     *
     * @return string 
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return User
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
     * Set lastaccess
     *
     * @param \DateTime $lastaccess
     * @return User
     */
    public function setLastaccess($lastaccess)
    {
        $this->lastaccess = $lastaccess;
    
        return $this;
    }

    /**
     * Get lastaccess
     *
     * @return \DateTime 
     */
    public function getLastaccess()
    {
        return $this->lastaccess;
    }

    /**
     * Set bank
     *
     * @param \Api\TaurusBundle\Entity\Bank $bank
     * @return User
     */
    public function setBank(\Api\TaurusBundle\Entity\Bank $bank = null)
    {
        $this->bank = $bank;
    
        return $this;
    }

    /**
     * Get bank
     *
     * @return \Api\TaurusBundle\Entity\Bank 
     */
    public function getBank()
    {
        return $this->bank;
    }

    /**
     * Add beneficiaries
     *
     * @param \Api\TaurusBundle\Entity\Beneficiary $beneficiaries
     * @return User
     */
    public function addBeneficiarie(\Api\TaurusBundle\Entity\Beneficiary $beneficiaries)
    {
        $this->beneficiaries[] = $beneficiaries;
    
        return $this;
    }

    /**
     * Remove beneficiaries
     *
     * @param \Api\TaurusBundle\Entity\Beneficiary $beneficiaries
     */
    public function removeBeneficiarie(\Api\TaurusBundle\Entity\Beneficiary $beneficiaries)
    {
        $this->beneficiaries->removeElement($beneficiaries);
    }

    /**
     * Get beneficiaries
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getBeneficiaries()
    {
        return $this->beneficiaries;
    }
}