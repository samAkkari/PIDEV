<?php

namespace App\Controller;

use App\Entity\Menu;
use App\Repository\MenuRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/menu", name="menu")
 */
class MenuController extends AbstractController
{
    /**
     * @var RestServiceController
     */
    private $restService;

    public function __construct(RestServiceController  $restService)
    {
        $this->restService = $restService;
    }


    /**
     * @Route("/getAll", name="pageMenu", methods ={"get"})
     */
    public function getAllMenu(MenuRepository $repository): Response
    {
        return $this->restService->getAllAction($repository);
    }
    /**
     * @Route("/add", name="add_Menu", methods={"post"})
     * @param Request $request
     * @return Response
     */
    public function createAction(Request $request): Response
    {
        return $this->restService->createAction($request,
            "App\Entity\Menu");



    }
    /**
     * @Route("/update/{id}", name="Menu_update", methods={"PUT"})
     * @return Response
     */
    public function updateAction(Menu $reclamation, Request $request): Response
    {
        return $this->restService->updateAction($reclamation, $request);
    }

    /**
     * @Route("/delete/{id}", name="courses_delete", methods={"DELETE"})
     * @param int $id
     * @param MenuRepository $repository
     * @return Response
     */
    public function deleteAction($id, MenuRepository $repository): Response
    {
        return $this->restService->deleteAction($id, $repository);
    }

}
