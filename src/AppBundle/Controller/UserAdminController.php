<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\HttpFoundation\Request;
use triguk\AuthorizationBundle\Controller\AuthBaseController;

/**
 * User controller.
 *
 * @Route("useradmin")
 */
class UserAdminController extends AuthBaseController
{

    public function __construct()
    {
        $this->entityClass=User::class;
        $this->templatePrefix='user';
        $this->indexTitle='Список пользователей';
        $this->showTitle='Просмотр сведений о пользователе';
        $this->editTitle='Редактирование сведений о пользователе';
        $this->setDefaultPaths();
        
        $this->entityProperties=
        [
            [
                "name"=>"username",
                "label"=>"Логин"
            ],
            [
                "name"=>"isActive",
                "label"=>"Не заблокирован"
            ],
            [
                "name"=>"password",
                "label"=>"Пароль",
                "doNotShowInIndex"=>true
            ],
            [
                "name"=>"email",
                "label"=>"E-Mail",
                "doNotShowInIndex"=>true
            ],
            [
                "name"=>"authRoles",
                "label"=>"Роли",
                "doNotShowInIndex"=>false
            ],
            [
                "name"=>"machines",
                "label"=>"Владеет комплексами",
            ],
        ];     
    }


    /**
     * Lists all user entities.
     *
     * @Route("/index/{page}", defaults={"page" = 1}, name="user_index")
     * @Method("GET")
     */
    public function indexAction(Request $request, $page)
    {
        return $this->baseIndexAction($request, $page);
    }

    /**
     * Creates a new user entity.
     *
     * @Route("/new", name="user_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        return $this->baseNewAction($request);
    }

    /**
     * Finds and displays a user entity.
     *
     * @Route("/{id}", name="user_show")
     * @Method("GET")
     */
    public function showAction(User $user)
    {
        return $this->baseShowAction($user);
    }

    /**
     * Displays a form to edit an existing user entity.
     *
     * @Route("/{id}/edit", name="user_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, User $user)
    {
        return $this->baseEditAction($request, $user);
    }

    /**
     * Deletes a user entity.
     *
     * @Route("/{id}", name="user_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, User $user)
    {
        return $this->baseDeleteAction($reqest, $user);
    }


}
