<?php

namespace AppBundle\Service;


use AppBundle\Entity\Machine;
use AppBundle\Entity\MachineStatus;
use Doctrine\ORM\EntityManager;

class MachineService
{

    protected $manager;
    
    protected $machineRepository, $machineStatusRepository;
    
    protected $statusCache;
    
    
    public function __construct(EntityManager $manager)
    {
        $this->manager=$manager;
        
        $this->machineRepository=$manager->getRepository(Machine::class);
        $this->machineStatusRepository=$manager->getRepository(MachineStatus::class);
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
    
    protected function getLatestStatus(Machine $machine)
    {
        if (array_key_exists($machine->getId(), $this->statusCache))
        {
            $status=$this->statusCache[$machine->getId()];
        }
        else
        {
            $status=$this->machineStatusRepository->getLatestStatus($machine);
        }
        return $status;
    }
    
    public function machineAlarmIsTriggered(Machine $machine)
    {
        $status=$this->getLatestStatus($machine);
        return $status->getAlarmTriggered();
    }
    
    public function machineAlarmIsEnabled(Machine $machine)
    {
        $status=$this->getLatestStatus($machine);
        return $status->getAlarmEnabled();
    }
    
    protected function generatePublicCode()
    {
        return sha1(rand(100000,900000));
    }
    
    public function enableAlarmByMachine(Machine $machine)
    {
        $this->toggleAlarm($machine,true,false);
    }
    
    public function disableAlarmByMachine(Machine $machine)
    {
        $this->toggleAlarm($machine,false,false);
    }    
    
    public function enableAlarmByUser(Machine $machine)
    {
        $this->toggleAlarm($machine,true,true);
    }
    
    public function disableAlarmByUser(Machine $machine)
    {
        $this->toggleAlarm($machine,false,true);
    } 
    protected function toggleAlarm(Machine $machine, bool $newState,bool $isRequest=true)
    {

        $oldStatus=$this->getLatestStatus($machine);
        
        $newStatus=new MachineStatus;
        $newStatus->setMachine($machine);
        $newStatus->setCreatedAt(new \DateTime);
        $newStatus->setAlarmEnabled($newState);
        $newStatus->setAlarmTriggered($oldStatus->getAlarmTriggered() && $newState);
        $newStatus->setIsRequest($isRequest);
        $newStatus->setPublicCode($this->generatePublicCode());
        $this->manager->persist($newStatus);
        $this->manager->flush();
        $this->statusCache=[];

        
    }
    protected function toggleTriggeredAlarm(Machine $machine, bool $newState,bool $isRequest=true)
    {
        $oldStatus=$this->getLatestStatus($machine);
        
        $newStatus=new MachineStatus;
        $newStatus->setMachine($machine);
        $newStatus->setCreatedAt(new \DateTime);
        $newStatus->setAlarmEnabled($oldStatus->getAlarmEnabled());
        $newStatus->setAlarmTriggered($newState);
        $newStatus->setIsRequest($isRequest);
        $newStatus->setPublicCode($this->generatePublicCode());
        $this->manager->persist($newStatus);
        $this->manager->flush();
        $this->statusCache=[];        
    }
    
    public function triggerAlarmByMachine(Machine $machine)
    {
        $this->toggleTriggeredAlarm($machine,true,false);
    }
    
    protected function disableTriggeredAlarmByMachine(Machine $machine)
    {
        $this->toggleTriggeredAlarm($machine,false,false);
    }
    

    
    protected function disableTriggeredAlarmByUser(Machine $machine)
    {
        $this->toggleTriggeredAlarm($machine,false,true);
    }
    
    public function verifyCode(Machine $machine, String $processedCode)
    {
        $status=$this->machineStatusRepository->getLatestStatusOrRequest($machine);
        $publicCode=$status->getPublicCode();
        $secretCode=$machine->getSecurityCode();
        $correctProcessedCode=sha1($secretCode.$publicCode);
        return strcmp($processedCode,$correctProcessedCode)===0;
    }

    public function getCorrectCode(Machine $machine)
    {
        $status=$this->machineStatusRepository->getLatestStatusOrRequest($machine);
        $publicCode=$status->getPublicCode();
        $secretCode=$machine->getSecurityCode();
        $correctProcessedCode=sha1($secretCode.$publicCode);
        return $correctProcessedCode;
    }

    
    public function getMachineCode(Machine $machine)
    {
        
        $status=$this->machineStatusRepository->getLatestStatusOrRequest($machine);
        $code=$status->getPublicCode();
        
        return $code;

    }
    public function getMachineStatus(Machine $machine)
    {
        
        $status=$this->machineStatusRepository->getLatestStatusOrRequest($machine);
        $enableAlarm=$status->getAlarmEnabled() ? '1' : '0';
        $alarmTriggered=$status->getAlarmTriggered() ? '1' : '0';
        $code=sha1($status->getPublicCode().$machine->getSecurityCode());
        return $enableAlarm.$alarmTriggered.$code;

    }
    public function getMachineRequest(Machine $machine)
    {
        
        $status=$this->machineStatusRepository->getLatestStatusOrRequest($machine);
        
        if ($status->getIsRequest())
        {
            $enableAlarm=$status->getAlarmEnabled() ? '1' : '0';
            $alarmTriggered=$status->getAlarmTriggered() ? '1' : '0';

        }
        else
        {
            $enableAlarm='-';
            $alarmTriggered='-';
        }
        $code=sha1($status->getPublicCode().$machine->getSecurityCode());
        return $enableAlarm.$alarmTriggered.$code;

    }
    
}
