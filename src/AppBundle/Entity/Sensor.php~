<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SensorStatus
 *
 * @ORM\Table(name="sensors")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SensorStatusRepository")
 */
class Sensor
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
     * @ORM\ManyToOne(targetEntity="Machine", inversedBy="sensors")
     * @ORM\JoinColumn(name="machine_id", referencedColumnName="id")
     */
    private $machine;  
    
    /**
     * @ORM\ManyToOne(targetEntity="SensorType")
     * @ORM\JoinColumn(name="sensor_type_id", referencedColumnName="id")
     */
    private $sensorType; 
     
    /**
     * @ORM\OneToMany(targetEntity="SensorStatus", mappedBy="sensor")
     */
    private $sensorStatuses;    

    
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
     * Set number
     *
     * @param integer $number
     *
     * @return SensorStatus
     */
    public function setNumber($number)
    {
        $this->number = $number;

        return $this;
    }

    /**
     * Get number
     *
     * @return integer
     */
    public function getNumber()
    {
        return $this->number;
    }

    /**
     * Set machine
     *
     * @param \AppBundle\Entity\Machine $machine
     *
     * @return SensorStatus
     */
    public function setMachine(\AppBundle\Entity\Machine $machine = null)
    {
        $this->machine = $machine;

        return $this;
    }

    /**
     * Get machine
     *
     * @return \AppBundle\Entity\Machine
     */
    public function getMachine()
    {
        return $this->machine;
    }

    /**
     * Set sensorType
     *
     * @param \AppBundle\Entity\SensorType $sensorType
     *
     * @return SensorStatus
     */
    public function setSensorType(\AppBundle\Entity\SensorType $sensorType = null)
    {
        $this->sensorType = $sensorType;

        return $this;
    }

    /**
     * Get sensorType
     *
     * @return \AppBundle\Entity\SensorType
     */
    public function getSensorType()
    {
        return $this->sensorType;
    }

    /**
     * Set alarmTriggered
     *
     * @param boolean $alarmTriggered
     *
     * @return SensorStatus
     */
    public function setAlarmTriggered($alarmTriggered)
    {
        $this->alarmTriggered = $alarmTriggered;

        return $this;
    }

    /**
     * Get alarmTriggered
     *
     * @return boolean
     */
    public function getAlarmTriggered()
    {
        return $this->alarmTriggered;
    }
    /**
     * Constructor
     */
    public function __construct()
    {
        $this->sensorStatuses = new \Doctrine\Common\Collections\ArrayCollection();
    }

    /**
     * Add sensorStatus
     *
     * @param \AppBundle\Entity\SensorStatus $sensorStatus
     *
     * @return Sensor
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
     * Set title
     *
     * @param string $title
     *
     * @return Sensor
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
     * @return Sensor
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
    
    public function __toString()
    {
        return $this->getTitle();
    }  
}
