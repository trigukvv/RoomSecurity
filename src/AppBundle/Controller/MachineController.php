<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use AppBundle\Entity\Machine;
use AppBundle\Entity\Sensor;
use Psr\Log\LoggerInterface;



class MachineController extends Controller
{
    
    private $machineService;
    private $sensorService;
    

    
    /**
     * @Route("/user/alarm/enable/{machine}", name="enableAlarmByUser")
     */
    public function enableAlarmActionByUserAction(Machine $machine)
    {
        //$this->denyAccessUnlessGranted('create','AppBundle:MachineStatus');
        $this->machineService=$this->get('AppBundle\Service\MachineService');
        $this->machineService->enableAlarmByUser($machine);
        return $this->redirectToRoute('homepage');
    }
    
    /**
     * @Route("/user/alarm/disable/{machine}", name="disableAlarmByUser")
     */
    public function disableAlarmActionByUserAction(Machine $machine)
    {
        //$this->denyAccessUnlessGranted('create','AppBundle:MachineStatus');
        $this->machineService=$this->get('AppBundle\Service\MachineService');
        $this->machineService->disableAlarmByUser($machine);
        return $this->redirectToRoute('homepage');
    }

    /**
     * @Route("/user/triggered-alarm/disable/{machine}", name="disableTriggeredAlarmByUser")
     */
    public function disableTriggeredAlarmActionByUserAction(Machine $machine)
    {
        //$this->denyAccessUnlessGranted('create','AppBundle:MachineStatus');
        $this->machineService=$this->get('AppBundle\Service\MachineService');
        $this->machineService->disableTriggeredAlarmByUser($machine);
        return $this->redirectToRoute('homepage');
    }

    /**
     * @Route("/machine/get-code/{machine}", name="getCodeByMachine")
     */
    public function getMachineCodeAction(Machine $machine)
    {
        //$this->denyAccessUnlessGranted('create','AppBundle:MachineStatus');
        $this->machineService=$this->get('AppBundle\Service\MachineService');
        $text=$this->machineService->getMachineCode($machine);
        return new Response(
            $text,
            Response::HTTP_OK,
            array('content-type' => 'text/plain')
        );
    
    }

    /**
     * @Route("/machine/get-state/{machine}", name="getStateByMachine")
     */
    public function getStateByMachineAction(Machine $machine)
    {
        //$this->denyAccessUnlessGranted('create','AppBundle:MachineStatus');
        $this->machineService=$this->get('AppBundle\Service\MachineService');
        $text=$this->machineService->getMachineStatus($machine);
        return new Response(
            $text,
            Response::HTTP_OK,
            array('content-type' => 'text/plain')
        );
    
    }
        
    /**
     * @Route("/machine/server-request/{machine}", name="getRequestByMachine")
     */
    public function getRequestByMachineAction(Machine $machine)
    {
        //$this->denyAccessUnlessGranted('create','AppBundle:MachineStatus');
        $this->machineService=$this->get('AppBundle\Service\MachineService');
        $text=$this->machineService->getMachineRequest($machine);
        return new Response(
            $text,
            Response::HTTP_OK,
            array('content-type' => 'text/plain')
        );
    
    }
    
    
    protected function machine403()
    {
        return new Response(
            'Not authorized',
            Response::HTTP_FORBIDDEN,
            array('content-type' => 'text/plain')
        );
    }
    
    /**
     * @Route("/machine/post-data/{machine}", name="postDataByMachine")
     * @Method("POST")
     */
    public function postDataByMachine(Machine $machine, Request $request,LoggerInterface $logger)
    {
        $this->machineService=$this->get('AppBundle\Service\MachineService');
        $processedCode=$request->request->get('code');
        if ($processedCode && $this->machineService->verifyCode($machine,$processedCode))
        {
            $newTriggeredStatus=$request->request->get('alarm-triggered');
            if ($newTriggeredStatus=='1')
                $this->machineService->triggerAlarmByMachine($machine);
            
            $newAlarmStatus=$request->request->get('alarm-enabled');
            
            if ($newAlarmStatus=='1')
                $this->machineService->enableAlarmByMachine($machine);

            if ($newAlarmStatus=='0')
                $this->machineService->disableAlarmByMachine($machine);
            $this->sensorService=$this->get('AppBundle\Service\SensorService');                
            $sensors=$machine->getSensors();
            
            foreach ($sensors as $sensor)
            {
                $sensorName="sensor".$sensor->getId();
                $sensorValue=$request->request->get($sensorName);
                if ($sensorValue=='1')
                    $this->sensorService->toggleTriggeredAlarm($sensor,true);
                if ($sensorValue=='0')
                    $this->sensorService->toggleTriggeredAlarm($sensor,false);
            }
            
        }
        else
        {
            return $this->machine403();
        }
        $text='Ok';
        return new Response(
            $text,
            Response::HTTP_OK,
            array('content-type' => 'text/plain')
        );
    
    }

}
