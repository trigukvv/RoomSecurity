<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Machine;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use triguk\AuthorizationBundle\Controller\AuthBaseController;

/**
 * Machine controller.
 *
 * @Route("machineadmin")
 */
class MachineAdminController extends AuthBaseController
{

    public function __construct()
    {
        $this->entityClass=Machine::class;
        $this->templatePrefix='machine';
        $this->indexTitle='Список аппаратных комплексов';
        $this->showTitle='Просмотр сведений об аппаратном комплексе';
        $this->editTitle='Редактирование сведений об аппаратном комплексе';
        $this->setDefaultPaths();
        
        $this->entityProperties=
        [
            [
                "name"=>"title",
                "label"=>"Название"
            ],
            [
                "name"=>"description",
                "label"=>"описание"
            ],
            [
                "name"=>"user",
                "label"=>"Владелец"
            ],
            [
                "name"=>"sensors",
                "label"=>"Сенсоры"
            ]
        ];     
    }


    /**
     * Lists all machine entities.
     *
     * @Route("/index/{page}", defaults={"page" = 1}, name="machine_index")
     * @Method("GET")
     */
    public function indexAction(Request $request, $page)
    {
        return $this->baseIndexAction($request, $page);
    }

    /**
     * Creates a new machine entity.
     *
     * @Route("/new", name="machine_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        return $this->baseNewAction($request);
    }

    /**
     * Finds and displays a machine entity.
     *
     * @Route("/{id}", name="machine_show")
     * @Method("GET")
     */
    public function showAction(Machine $machine)
    {
        return $this->baseShowAction($machine);
    }

    /**
     * Displays a form to edit an existing machine entity.
     *
     * @Route("/{id}/edit", name="machine_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Machine $machine)
    {
        return $this->baseEditAction($request, $machine);
    }

    /**
     * Deletes a machine entity.
     *
     * @Route("/{id}", name="machine_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Machine $machine)
    {
        return $this->baseDeleteAction($reqest, $machine);
    }


}
