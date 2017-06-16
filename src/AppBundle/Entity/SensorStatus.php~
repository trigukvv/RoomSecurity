<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * SensorStatus
 *
 * @ORM\Table(name="sensor_statuses")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\SensorStatusRepository")
 */
class SensorStatus
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
     * @ORM\ManyToOne(targetEntity="Sensor", inversedBy="sensorStatuses"))
     * @ORM\JoinColumn(name="sensor_id", referencedColumnName="id")
     */
    private $sensor;      
    
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;     

    /**
     * @var bool
     *
     * @ORM\Column(name="alarm_triggered", type="boolean")
     */
    private $alarmTriggered;


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
     * @return bool
     */
    public function getAlarmTriggered()
    {
        return $this->alarmTriggered;
    }

    /**
     * Set sensor
     *
     * @param \AppBundle\Entity\Sensor $sensor
     *
     * @return SensorStatus
     */
    public function setSensor(\AppBundle\Entity\Sensor $sensor = null)
    {
        $this->sensor = $sensor;

        return $this;
    }

    /**
     * Get sensor
     *
     * @return \AppBundle\Entity\Sensor
     */
    public function getSensor()
    {
        return $this->sensor;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return SensorStatus
     */
    public function setCreatedAt($createdAt)
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    /**
     * Get createdAt
     *
     * @return \DateTime
     */
    public function getCreatedAt()
    {
        return $this->createdAt;
    }
}
