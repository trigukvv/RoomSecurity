<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use triguk\AuthorizationBundle\Entity\HasAuthRoles;


class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {

        if (($user=$this->getUser()) instanceOf HasAuthRoles)
        {
            $machines=$user->getMachines();
            
            $machineService=$this->get('AppBundle\Service\MachineService');
            $sensorService=$this->get('AppBundle\Service\SensorService');
            
            return $this->render('AppBundle:Default:index.html.twig',
            [
                'machines'=>$machines,
                'machineService'=>$machineService,
                'sensorService'=>$sensorService
            ]);
        }
        else
        {
            return $this->redirectToRoute('login');
        }
    }
}
