<?php

namespace AppBundle\Controller;

use AppBundle\Entity\MachineStatus;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use triguk\AuthorizationBundle\Controller\AuthBaseController;

/**
 * MachineStatus controller.
 *
 * @Route("machinestatus")
 */
class MachineStatusAdminController extends AuthBaseController
{

    public function __construct()
    {
        $this->entityClass=MachineStatus::class;
        $this->templatePrefix='machine_status';
        $this->indexTitle='Список состояний аппаратных комплексов';
        $this->showTitle='Просмотр сведений о состоянии аппаратного комплекса';
        $this->editTitle='Редактирование сведений о состоянии аппаратного комплекса';
        $this->setDefaultPaths();
        
        $this->entityProperties=
        [
            [
                "name"=>"machine",
                "label"=>"Аппаратный комплекс"
            ],
            [
                "name"=>"alarmEnabled",
                "label"=>"Сигнализация включена"
            ],
            [
                "name"=>"alarmTriggered",
                "label"=>"Тревога включена"
            ],
            [
                "name"=>"publicCode",
                "label"=>"Открытый код"
            ],
            [
                "name"=>"createdAt",
                "label"=>"Дата/время"
            ]
        ];     
    }


    /**
     * Lists all machineStatus entities.
     *
     * @Route("/index/{page}", defaults={"page" = 1}, name="machine_status_index")
     * @Method("GET")
     */
    public function indexAction(Request $request, $page)
    {
        return $this->baseIndexAction($request, $page);
    }

    /**
     * Creates a new machineStatus entity.
     *
     * @Route("/new", name="machine_status_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        return $this->baseNewAction($request);
    }

    /**
     * Finds and displays a machineStatus entity.
     *
     * @Route("/{id}", name="machine_status_show")
     * @Method("GET")
     */
    public function showAction(MachineStatus $machineStatus)
    {
        return $this->baseShowAction($machineStatus);
    }

    /**
     * Displays a form to edit an existing machineStatus entity.
     *
     * @Route("/{id}/edit", name="machine_status_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, MachineStatus $machineStatus)
    {
        return $this->baseEditAction($request, $machineStatus);
    }

    /**
     * Deletes a machineStatus entity.
     *
     * @Route("/{id}", name="machine_status_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, MachineStatus $machineStatus)
    {
        return $this->baseDeleteAction($reqest, $machineStatus);
    }


}
