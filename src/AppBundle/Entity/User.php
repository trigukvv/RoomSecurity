<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;
use triguk\AuthorizationBundle\Entity\HasAuthRoles;


/**
 * User
 *
 * @ORM\Table(name="users")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\UserRepository")
 */
class User implements UserInterface, HasAuthRoles, \Serializable
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="username", type="string", length=255, unique=true)
     */
    private $username;

    /**
     * @var string
     *
     * @ORM\Column(name="password", type="string", length=255)
     */
    private $password;

    /**
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255, unique=true)
     */
    private $email;



    /**
     * @ORM\ManyToMany(targetEntity="\triguk\AuthorizationBundle\Entity\AuthRole", inversedBy="users")
     */
    private $authRoles;
    
    /**
     * @var bool
     *
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive;
    
    
    /**
     * @ORM\OneToMany(targetEntity="Machine", mappedBy="user")
     */
    private $machines;    

    
  

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
     * Set username
     *
     * @param string $username
     *
     * @return User
     */
    public function setUsername($username)
    {
        $this->username = $username;

        return $this;
    }

    /**
     * Get username
     *
     * @return string
     */
    public function getUsername()
    {
        return $this->username;
    }

    /**
     * Set password
     *
     * @param string $password
     *
     * @return User
     */
    public function setPassword($password)
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Get password
     *
     * @return string
     */
    public function getPassword()
    {
        return $this->password;
    }

    /**
     * Set email
     *
     * @param string $email
     *
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
     * Set isActive
     *
     * @param boolean $isActive
     *
     * @return User
     */
    public function setIsActive($isActive)
    {
        $this->isActive = $isActive;

        return $this;
    }

    /**
     * Get isActive
     *
     * @return boolean
     */
    public function getIsActive()
    {
        return $this->isActive;
    }




    /**
     * Add authRole
     *
     * @param \triguk\AuthorizationBundle\Entity\AuthRole $authRole
     *
     * @return User
     */
    public function addAuthRole(\triguk\AuthorizationBundle\Entity\AuthRole $authRole)
    {
        $this->authRoles[] = $authRole;

        return $this;
    }

    /**
     * Remove authRole
     *
     * @param \triguk\AuthorizationBundle\Entity\AuthRole $authRole
     */
    public function removeAuthRole(\triguk\AuthorizationBundle\Entity\AuthRole $authRole)
    {
        $this->authRoles->removeElement($authRole);
    }

    /**
     * Get authRoles
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getAuthRoles()
    {
        return $this->authRoles;
    }

    public function getSalt()
    {
        return null;
    }
        
    public function getRoles()
    {
        return array('ROLE_USER');
    }

    public function eraseCredentials()
    {
    }
    

    /** @see \Serializable::serialize() */
    public function serialize()
    {
        return serialize(array(
            $this->id,
            $this->username,
            $this->password,
        ));
    }

    /** @see \Serializable::unserialize() */
    public function unserialize($serialized)
    {
        list (
            $this->id,
            $this->username,
            $this->password,
        ) = unserialize($serialized);
    }


    
    

    
    
    public function getGroups()
    {

    }

    public function __toString()
    {
        return $this->getUsername();
    }  

    /**
     * Add machine
     *
     * @param \AppBundle\Entity\Machine $machine
     *
     * @return User
     */
    public function addMachine(\AppBundle\Entity\Machine $machine)
    {
        $this->machines[] = $machine;

        return $this;
    }

    /**
     * Remove machine
     *
     * @param \AppBundle\Entity\Machine $machine
     */
    public function removeMachine(\AppBundle\Entity\Machine $machine)
    {
        $this->machines->removeElement($machine);
    }

    /**
     * Get machines
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMachines()
    {
        return $this->machines;
    }
}
