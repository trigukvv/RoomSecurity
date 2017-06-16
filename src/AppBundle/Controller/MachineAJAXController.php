<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\Machine;

/**
 * Machine controller.
 *
 * @Route("machine_ajax")
 */
class MachineAJAXController extends Controller
{
    /**
     *  
     *
     * @Route("/status/{machine}", name="machine_ajax_status")
     * @Method("GET")
     */
    public function statusAction(Request $request, Machine $machine)
    {
            $machineService=$this->get('AppBundle\Service\MachineService');
            $sensorService=$this->get('AppBundle\Service\SensorService');
            
            return $this->render('AppBundle:MachineAJAX:status.html.twig',
            [
                'machine'=>$machine,
                'machineService'=>$machineService,
                'sensorService'=>$sensorService
            ]);
    }
}
