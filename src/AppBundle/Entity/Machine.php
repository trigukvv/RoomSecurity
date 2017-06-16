<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use triguk\AuthorizationBundle\Entity\HasOwner;

/**
 * Machine
 *
 * @ORM\Table(name="machines")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MachineRepository")
 */
class Machine
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
     * @ORM\Column(name="title", type="string", length=255, unique=true)
     */
    private $title;

    /**
     * @var string
     *
     * @ORM\Column(name="description", type="text",  unique=false, nullable=true)
     */
    private $description;
    
    /**
     * @var string
     *
     * @ORM\Column(name="security_code", type="string", length=255, unique=false)
     */
    private $securityCode;
    
    /**
     * @ORM\OneToMany(targetEntity="MachineStatus", mappedBy="machine")
     */
    private $machineStatuses;
    
    /**
     * @ORM\OneToMany(targetEntity="Sensor", mappedBy="machine")
     */
    private $sensors;
    
    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="machines")
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id")
     */
    private $user; 
    
    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set title
     *
     * @param string $title
     *
     * @return Machine
     */
    public function setTitle($title)
    {
        $this->title = $title;

        return $this;
    }

    /**
     * Get title
     *
     * @return string
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * Set description
     *
     * @param string $description
     *
     * @return Machine
     */
    public function setDescription($description)
    {
        $this->description = $description;

        return $this;
    }

    /**
     * Get description
     *
     * @return string
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * Set securityCode
     *
     * @param string $securityCode
     *
     * @return Machine
     */
    public function setSecurityCode($securityCode)
    {
        $this->securityCode = $securityCode;

        return $this;
    }

    /**
     * Get securityCode
     *
     * @return string
     */
    public function getSecurityCode()
    {
        return $this->securityCode;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->machineStatuses = new \Doctrine\Common\Collections\ArrayCollection();
        $this->sensorStatuses = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add machineStatus
     *
     * @param \AppBundle\Entity\MachineStatus $machineStatus
     *
     * @return Machine
     */
    public function addMachineStatus(\AppBundle\Entity\MachineStatus $machineStatus)
    {
        $this->machineStatuses[] = $machineStatus;

        return $this;
    }

    /**
     * Remove machineStatus
     *
     * @param \AppBundle\Entity\MachineStatus $machineStatus
     */
    public function removeMachineStatus(\AppBundle\Entity\MachineStatus $machineStatus)
    {
        $this->machineStatuses->removeElement($machineStatus);
    }

    /**
     * Get machineStatuses
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getMachineStatuses()
    {
        return $this->machineStatuses;
    }

    /**
     * Add sensorStatus
     *
     * @param \AppBundle\Entity\SensorStatus $sensorStatus
     *
     * @return Machine
     */
    public function addSensorStatus(\AppBundle\Entity\SensorStatus $sensorStatus)
    {
        $this->sensorStatuses[] = $sensorStatus;

        return $this;
    }

    /**
     * Remove sensorStatus
     *
     * @param \AppBundle\Entity\SensorStatus $sensorStatus
     */
    public function removeSensorStatus(\AppBundle\Entity\SensorStatus $sensorStatus)
    {
        $this->sensorStatuses->removeElement($sensorStatus);
    }

    /**
     * Get sensorStatuses
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSensorStatuses()
    {
        return $this->sensorStatuses;
    }

    /**
     * Add sensor
     *
     * @param \AppBundle\Entity\Sensor $sensor
     *
     * @return Machine
     */
    public function addSensor(\AppBundle\Entity\Sensor $sensor)
    {
        $this->sensors[] = $sensor;

        return $this;
    }

    /**
     * Remove sensor
     *
     * @param \AppBundle\Entity\Sensor $sensor
     */
    public function removeSensor(\AppBundle\Entity\Sensor $sensor)
    {
        $this->sensors->removeElement($sensor);
    }

    /**
     * Get sensors
     *
     * @return \Doctrine\Common\Collections\Collection
     */
    public function getSensors()
    {
        return $this->sensors;
    }

    /**
     * Set user
     *
     * @param \AppBundle\Entity\User $user
     *
     * @return Machine
     */
    public function setUser(\AppBundle\Entity\User $user = null)
    {
        $this->user = $user;

        return $this;
    }

    /**
     * Get user
     *
     * @return \AppBundle\Entity\User
     */
    public function getUser()
    {
        return $this->user;
    }
    
    public function getOwner()
    {
        return $this->getUser();
    }
    
    public function __toString()
    {
        return $this->getTitle();
    }  
}
