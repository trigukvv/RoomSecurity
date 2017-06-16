<?php

namespace AppBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * MachineStatus
 *
 * @ORM\Table(name="machine_statuses")
 * @ORM\Entity(repositoryClass="AppBundle\Repository\MachineStatusRepository")
 */
class MachineStatus
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
     * @ORM\ManyToOne(targetEntity="Machine", inversedBy="machineStatuses")
     * @ORM\JoinColumn(name="machine_id", referencedColumnName="id")
     */
    private $machine;  
    
    /**
     * @var bool
     *
     * @ORM\Column(name="alarm_enabled", type="boolean", nullable=false, options={"default" : 0})
     */
    private $alarmEnabled;
    
    /**
     * @var bool
     *
     * @ORM\Column(name="alarm_triggered", type="boolean", nullable=false, options={"default" : 0})
     */
    private $alarmTriggered;
    
    /**
     * @var bool
     *
     * @ORM\Column(name="is_request", type="boolean", nullable=false, options={"default" : 0})
     */
    private $isRequest;
    
    /**
     * @var string
     *
     * @ORM\Column(name="title", type="string", length=255, unique=false)
     */
    private $publicCode;
    
    /**
     * @var \DateTime
     *
     * @ORM\Column(name="created_at", type="datetime")
     */
    private $createdAt;     

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
     * Set alarmEnabled
     *
     * @param boolean $alarmEnabled
     *
     * @return MachineStatus
     */
    public function setAlarmEnabled($alarmEnabled)
    {
        $this->alarmEnabled = $alarmEnabled;

        return $this;
    }

    /**
     * Get alarmEnabled
     *
     * @return boolean
     */
    public function getAlarmEnabled()
    {
        return $this->alarmEnabled;
    }

    /**
     * Set alarmTriggered
     *
     * @param boolean $alarmTriggered
     *
     * @return MachineStatus
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
     * Set machine
     *
     * @param \AppBundle\Entity\Machine $machine
     *
     * @return MachineStatus
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
     * Set publicCode
     *
     * @param string $publicCode
     *
     * @return MachineStatus
     */
    public function setPublicCode($publicCode)
    {
        $this->publicCode = $publicCode;

        return $this;
    }

    /**
     * Get publicCode
     *
     * @return string
     */
    public function getPublicCode()
    {
        return $this->publicCode;
    }

    /**
     * Set createdAt
     *
     * @param \DateTime $createdAt
     *
     * @return MachineStatus
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

    /**
     * Set isRequest
     *
     * @param boolean $isRequest
     *
     * @return MachineStatus
     */
    public function setIsRequest($isRequest)
    {
        $this->isRequest = $isRequest;

        return $this;
    }

    /**
     * Get isRequest
     *
     * @return boolean
     */
    public function getIsRequest()
    {
        return $this->isRequest;
    }
}
