<?php

namespace AppBundle\Service;


use AppBundle\Entity\Machine;
use AppBundle\Entity\Sensor;
use AppBundle\Entity\SensorStatus;
use Doctrine\ORM\EntityManager;

class SensorService
{

    protected $manager;
    
    protected $sensorStatusRepository;
    
    protected $statusCache;
    
    
    public function __construct(EntityManager $manager)
    {
        $this->manager=$manager;
        
        $this->sensorStatusRepository=$manager->getRepository(SensorStatus::class);
        $this->statusCache=[];
        
    }   
/*
    public function getMachineStatusText($machine)
    {
        $status=$this->machineStatusRepository->getLatestStatus($machine);
        $alarmIsTriggered=$status->getAlarmTriggered();
        $alarmIsEnabled=$status->getAlarmEnabled();
        if ($alarmIsTriggered)
            return 'triggered'
        elseif ($alarmIsTriggered)
        return $status->getAlarmEnabled();
    }  
*/
    
    protected function getLatestStatus($sensor)
    {
        if (array_key_exists($sensor->getId(), $this->statusCache))
        {
            $status=$this->statusCache[$sensor->getId()];
        }
        else
        {
            $status=$this->sensorStatusRepository->getLatestStatus($sensor);
        }
        return $status;
    }
    
    public function sensorAlarmIsTriggered($sensor)
    {
        $status=$this->getLatestStatus($sensor);
        return $status->getAlarmTriggered();
    }    
    
  
    

     
    public function toggleTriggeredAlarm(Sensor $sensor, bool $newState)
    {
        $oldStatus=$this->getLatestStatus($sensor);
        
        $newStatus=new SensorStatus;
        $newStatus->setSensor($sensor);
        $newStatus->setCreatedAt(new \DateTime);
        $newStatus->setAlarmTriggered($newState);
        $this->manager->persist($newStatus);
        $this->manager->flush();
        $this->statusCache=[];        
    }

}
