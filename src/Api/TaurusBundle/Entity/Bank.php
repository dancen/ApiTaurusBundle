<?php

namespace Api\TaurusBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Api\TaurusBundle\Bank
 *
 * @ORM\Table()
 * @ORM\Entity(repositoryClass="Api\TaurusBundle\Entity\BankRepository")
 */
class Bank {

    /**
     * @var bigint $id
     *
     * @ORM\Column(name="id", type="bigint", nullable=false)
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;
    
    /**
     * @var string $bankcode
     *
     * @ORM\Column(name="bankcode", type="string", length=50, nullable=false)
     */
    protected $bankcode;
    
    
   /**
     * @var string $bankurl
     *
     * @ORM\Column(name="bankurl", type="string", length=100, nullable=false)
     */
    protected $bankurl;
    
    
    /**
     * @var string $bankinfo
     *
     * @ORM\Column(name="bankinfo", type="string", length=255, nullable=false)
     */
    protected $bankinfo;
    
    
    /**
     * @var date $created_at
     *
     * @ORM\Column(name="created_at",  type="datetime", nullable=false)
     */
    private $created_at;
    
    
    /**
     * @ORM\OneToMany(targetEntity="User", mappedBy="bank")
     * @ORM\OrderBy({"email" = "ASC", "id" = "ASC"})
     */
    protected $users;
    
        
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
     * Set bankcode
     *
     * @param string $bankcode
     * @return Bank
     */
    public function setBankcode($bankcode)
    {
        $this->bankcode = $bankcode;
    
        return $this;
    }

    /**
     * Get bankcode
     *
     * @return string 
     */
    public function getBankcode()
    {
        return $this->bankcode;
    }

    /**
     * Set bankurl
     *
     * @param string $bankurl
     * @return Bank
     */
    public function setBankurl($bankurl)
    {
        $this->bankurl = $bankurl;
    
        return $this;
    }

    /**
     * Get bankurl
     *
     * @return string 
     */
    public function getBankurl()
    {
        return $this->bankurl;
    }

    /**
     * Set bankinfo
     *
     * @param string $bankinfo
     * @return Bank
     */
    public function setBankinfo($bankinfo)
    {
        $this->bankinfo = $bankinfo;
    
        return $this;
    }

    /**
     * Get bankinfo
     *
     * @return string 
     */
    public function getBankinfo()
    {
        return $this->bankinfo;
    }

    /**
     * Set created_at
     *
     * @param \DateTime $createdAt
     * @return Bank
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
     * Add users
     *
     * @param \Api\TaurusBundle\Entity\User $users
     * @return Bank
     */
    public function addUser(\Api\TaurusBundle\Entity\User $users)
    {
        $this->users[] = $users;
    
        return $this;
    }

    /**
     * Remove users
     *
     * @param \Api\TaurusBundle\Entity\User $users
     */
    public function removeUser(\Api\TaurusBundle\Entity\User $users)
    {
        $this->users->removeElement($users);
    }

    /**
     * Get users
     *
     * @return \Doctrine\Common\Collections\Collection 
     */
    public function getUsers()
    {
        return $this->users;
    }
}