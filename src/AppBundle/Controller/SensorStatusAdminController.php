<?php

namespace AppBundle\Controller;

use AppBundle\Entity\SensorStatus;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use triguk\AuthorizationBundle\Controller\AuthBaseController;

/**
 * SensorStatus controller.
 *
 * @Route("sensorstatus")
 */
class SensorStatusAdminController extends AuthBaseController
{

    public function __construct()
    {
        $this->entityClass=SensorStatus::class;
        $this->templatePrefix='sensor_status';
        $this->indexTitle='Состояния сенсоров';
        $this->showTitle='Просмотр сведений о состоянии сенсора';
        $this->editTitle='Редактирование сведений о состоянии сенсора';
        $this->setDefaultPaths();
        
        $this->entityProperties=
        [
            [
                "name"=>"sensor",
                "label"=>"Сенсор"
            ],
            [
                "name"=>"alarmTriggered",
                "label"=>"Тревога включена"
            ],
            [
                "name"=>"createdAt",
                "label"=>"Дата/время"
            ]
        ];     
    }


    /**
     * Lists all sensorStatus entities.
     *
     * @Route("/index/{page}", defaults={"page" = 1}, name="sensor_status_index")
     * @Method("GET")
     */
    public function indexAction(Request $request, $page)
    {
        return $this->baseIndexAction($request, $page);
    }

    /**
     * Creates a new sensorStatus entity.
     *
     * @Route("/new", name="sensor_status_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        return $this->baseNewAction($request);
    }

    /**
     * Finds and displays a sensorStatus entity.
     *
     * @Route("/{id}", name="sensor_status_show")
     * @Method("GET")
     */
    public function showAction(SensorStatus $sensorStatus)
    {
        return $this->baseShowAction($sensorStatus);
    }

    /**
     * Displays a form to edit an existing sensorStatus entity.
     *
     * @Route("/{id}/edit", name="sensor_status_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, SensorStatus $sensorStatus)
    {
        return $this->baseEditAction($request, $sensorStatus);
    }

    /**
     * Deletes a sensorStatus entity.
     *
     * @Route("/{id}", name="sensor_status_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, SensorStatus $sensorStatus)
    {
        return $this->baseDeleteAction($reqest, $sensorStatus);
    }


}
