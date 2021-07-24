<?php

namespace App\Controller;

use App\Entity\Facture;
use App\Repository\FactureRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/facture", name="facture")
 */
class FactureController extends AbstractController
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
     * @Route("/getAll", name="Facture_getAll", methods={"GET"})
     * @param FactureRepository $repository
     * @return Response
     */
    public function getAllAction(FactureRepository $repository): Response
    {
        return $this->restService->getAllAction($repository);
    }

    /**
     * @Route("/create", name="Facture_create", methods={"POST"})
     * @param Request $request
     * @return Response
     */
    public function createAction(Request $request): Response
    {
        return $this->restService->createAction($request, "App\Entity\Facture");
    }

    /**
     * @Route("/update/{id}", name="Facture_update", methods={"PUT"})
     * @return Response
     */
    public function updateAction(Facture $Facture, Request $request): Response
    {
        return $this->restService->updateAction($Facture, $request);
    }

    /**
     * @Route("/delete/{id}", name="Facture_delete", methods={"DELETE"})
     * @param int $id
     * @param FactureRepository $repository
     * @return Response
     */
    public function deleteAction($id, FactureRepository $repository): Response
    {
        return $this->restService->deleteAction($id, $repository);
    }
}
