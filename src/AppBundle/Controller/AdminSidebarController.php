<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use triguk\AuthorizationBundle\Entity\AuthObject;


class AdminSidebarController extends Controller
{


    public function indexAction()
    {

        $builder=$this->get('triguk.security.sidebar_menu_builder');
        
        return $this->render('AppBundle:AdminSidebar:index.html.twig', array(
            'listItems'=>$builder->buildMenu()
        ));
    }

}
