<?php

namespace AppBundle\Controller;

use AppBundle\Entity\SensorType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use triguk\AuthorizationBundle\Controller\AuthBaseController;

/**
 * SensorType controller.
 *
 * @Route("sensortype")
 */
class SensorTypeAdminController extends AuthBaseController
{

    public function __construct()
    {
        $this->entityClass=SensorType::class;
        $this->templatePrefix='sensor_type';
        $this->indexTitle='Список типов сенсоров';
        $this->showTitle='Просмотр сведений о типе сенсора';
        $this->editTitle='Редактирование сведений о типе сенсора';
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
        ];     
    }


    /**
     * Lists all sensorType entities.
     *
     * @Route("/index/{page}", defaults={"page" = 1}, name="sensor_type_index")
     * @Method("GET")
     */
    public function indexAction(Request $request, $page)
    {
        return $this->baseIndexAction($request, $page);
    }

    /**
     * Creates a new sensorType entity.
     *
     * @Route("/new", name="sensor_type_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        return $this->baseNewAction($request);
    }

    /**
     * Finds and displays a sensorType entity.
     *
     * @Route("/{id}", name="sensor_type_show")
     * @Method("GET")
     */
    public function showAction(SensorType $sensorType)
    {
        return $this->baseShowAction($sensorType);
    }

    /**
     * Displays a form to edit an existing sensorType entity.
     *
     * @Route("/{id}/edit", name="sensor_type_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, SensorType $sensorType)
    {
        return $this->baseEditAction($request, $sensorType);
    }

    /**
     * Deletes a sensorType entity.
     *
     * @Route("/{id}", name="sensor_type_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, SensorType $sensorType)
    {
        return $this->baseDeleteAction($reqest, $sensorType);
    }


}
