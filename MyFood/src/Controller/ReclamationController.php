<?php

namespace App\Controller;

use App\Entity\Reclamation;
use App\Repository\ReclamationRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;


/**
 * @Route("/reclamation", name="reclamation")
 */
class ReclamationController extends AbstractController
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
     * @Route("/getAll", name="pageReclamation", methods ={"get"})
     */
    public function getAllReclamation(ReclamationRepository $repository): Response
    {
        return $this->restService->getAllAction($repository);
    }
    /**
     * @Route("/add", name="add_Reclamation", methods={"post"})
     * @param Request $request
     * @return Response
     */
    public function createAction(Request $request): Response
    {
        return $this->restService->createAction($request,
            "App\Entity\Reclamation");



    }
    /**
     * @Route("/update/{id}", name="reclamation_update", methods={"PUT"})
     * @return Response
     */
    public function updateAction(Reclamation $reclamation, Request $request): Response
    {
        return $this->restService->updateAction($reclamation, $request);
    }

    /**
     * @Route("/delete/{id}", name="courses_delete", methods={"DELETE"})
     * @param int $id
     * @param ReclamationRepository $repository
     * @return Response
     */
    public function deleteAction($id, ReclamationRepository $repository): Response
    {
        return $this->restService->deleteAction($id, $repository);
    }



}
