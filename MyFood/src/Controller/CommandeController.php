<?php

namespace App\Controller;

use App\Entity\Commande;
use App\Repository\CommandeRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/commande", name="commande")
 */
class CommandeController extends AbstractController
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
     * @Route("/getAll", name="Commande_getAll", methods={"GET"})
     * @param CommandeRepository $repository
     * @return Response
     */
    public function getAllAction(CommandeRepository $repository): Response
    {
        return $this->restService->getAllAction($repository);
    }

    /**
     * @Route("/add", name="Commande_create", methods={"POST"})
     * @param Request $request
     * @return Response
     */
    public function createAction(Request $request): Response
    {
        return $this->restService->createAction($request, "App\Entity\Commande");
    }

    /**
     * @Route("/update/{id}", name="Commande_update", methods={"PUT"})
     * @return Response
     */

    public function updateAction(Commande $Commande, Request $request): Response
    {
        return $this->restService->updateAction($Commande, $request);
    }

    /**
     * @Route("/delete/{id}", name="Commande_delete", methods={"DELETE"})
     * @param int $id
     * @param CommandeRepository $repository
     * @return Response
     */

    public function deleteAction($id, CommandeRepository $repository): Response
    {
        return $this->restService->deleteAction($id, $repository);
    }
}
