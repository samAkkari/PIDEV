<?php

namespace App\Controller;

use App\Entity\Livraison;
use App\Repository\LivraisonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/livraison", name="livraison")
 */
class LivraisonController extends AbstractController
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
     * @Route("/getAll", name="Livraison_getAll", methods={"GET"})
     * @param LivraisonRepository $repository
     * @return Response
     */
    public function getAllAction(LivraisonRepository $repository): Response
    {
        return $this->restService->getAllAction($repository);
    }

    /**
     * @Route("/create", name="Livraison_create", methods={"POST"})
     * @param Request $request
     * @return Response
     */
    public function createAction(Request $request): Response
    {
        return $this->restService->createAction($request, "App\Entity\Livraison");
    }

    /**
     * @Route("/update/{id}", name="Livraison_update", methods={"PUT"})
     * @return Response
     */
    public function updateAction(Livraison $Livraison, Request $request): Response
    {
        return $this->restService->updateAction($Livraison, $request);
    }

    /**
     * @Route("/delete/{id}", name="Livraison_delete", methods={"DELETE"})
     * @param int $id
     * @param LivraisonRepository $repository
     * @return Response
     */
    public function deleteAction($id, LivraisonRepository $repository): Response
    {
        return $this->restService->deleteAction($id, $repository);
    }
}
