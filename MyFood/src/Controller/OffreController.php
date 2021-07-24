<?php

namespace App\Controller;

use App\Entity\Offre;
use App\Repository\OffreRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
/**
 * @Route("/offre", name="offre")
 */
class OffreController extends AbstractController
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
     * @Route("/getAll", name="pageOffre", methods ={"get"})
     */
    public function getAllOffre(OffreRepository $repository): Response
    {
        return $this->restService->getAllAction($repository);
    }
    /**
     * @Route("/add", name="add_Offre", methods={"post"})
     * @param Request $request
     * @return Response
     */
    public function createAction(Request $request): Response
    {
        return $this->restService->createAction($request,
            "App\Entity\Offre");



    }
    /**
     * @Route("/update/{id}", name="Offre_update", methods={"PUT"})
     * @return Response
     */
    public function updateAction(Offre $reclamation, Request $request): Response
    {
        return $this->restService->updateAction($reclamation, $request);
    }

    /**
     * @Route("/delete/{id}", name="courses_delete", methods={"DELETE"})
     * @param int $id
     * @param OffreRepository $repository
     * @return Response
     */
    public function deleteAction($id, OffreRepository $repository): Response
    {
        return $this->restService->deleteAction($id, $repository);
    }

}
