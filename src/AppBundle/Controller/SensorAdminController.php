<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Sensor;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use triguk\AuthorizationBundle\Controller\AuthBaseController;

/**
 * Sensor controller.
 *
 * @Route("sensor")
 */
class SensorAdminController extends AuthBaseController
{

    public function __construct()
    {
        $this->entityClass=Sensor::class;
        $this->templatePrefix='sensor';
        $this->indexTitle='Список сенсоров';
        $this->showTitle='Просмотр сведений о сенсоре';
        $this->editTitle='Редактирование сведений о сенсоре';
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
                "name"=>"sensorType",
                "label"=>"Тип сенсора"
            ],
            [
                "name"=>"machine",
                "label"=>"Аппаратный комплекс"
            ],
        ];     
    }


    /**
     * Lists all sensor entities.
     *
     * @Route("/index/{page}", defaults={"page" = 1}, name="sensor_index")
     * @Method("GET")
     */
    public function indexAction(Request $request, $page)
    {
        return $this->baseIndexAction($request, $page);
    }

    /**
     * Creates a new sensor entity.
     *
     * @Route("/new", name="sensor_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        return $this->baseNewAction($request);
    }

    /**
     * Finds and displays a sensor entity.
     *
     * @Route("/{id}", name="sensor_show")
     * @Method("GET")
     */
    public function showAction(Sensor $sensor)
    {
        return $this->baseShowAction($sensor);
    }

    /**
     * Displays a form to edit an existing sensor entity.
     *
     * @Route("/{id}/edit", name="sensor_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Sensor $sensor)
    {
        return $this->baseEditAction($request, $sensor);
    }

    /**
     * Deletes a sensor entity.
     *
     * @Route("/{id}", name="sensor_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Sensor $sensor)
    {
        return $this->baseDeleteAction($reqest, $sensor);
    }


}
