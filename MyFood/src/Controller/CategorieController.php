<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Repository\CategorieRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/categorie", name="categorie")
 */
class CategorieController extends AbstractController
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
     * @Route("/getAll", name="categorie_getAll", methods={"GET"})
     * @param CategorieRepository $repository
     * @return Response
     */
    public function getAllAction(CategorieRepository $repository): Response
    {
        return $this->restService->getAllAction($repository);
    }

    /**
     * @Route("/add", name="categorie_create", methods={"POST"})
     * @param Request $request
     * @return Response
     */
    public function createAction(Request $request): Response
    {
        return $this->restService->createAction($request, "App\Entity\Categorie");
    }

    /**
     * @Route("/update/{id}", name="categorie_update", methods={"PUT"})
     * @return Response
     */

    public function updateAction(Categorie $categorie, Request $request): Response
    {
        return $this->restService->updateAction($categorie, $request);
    }

    /**
     * @Route("/delete/{id}", name="categorie_delete", methods={"DELETE"})
     * @param int $id
     * @param CategorieRepository $repository
     * @return Response
     */

    public function deleteAction($id, CategorieRepository $repository): Response
    {
        return $this->restService->deleteAction($id, $repository);
    }

}
