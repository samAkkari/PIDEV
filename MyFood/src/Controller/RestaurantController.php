<?php

namespace App\Controller;

use App\Entity\Restaurant;
use App\Repository\MenuRepository;
use App\Repository\RestaurantRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\SerializerInterface;


/**
 * @Route("/restaurant", name="reclamation")
 */
class RestaurantController extends AbstractController
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
     * @Route("/getAll", name="pageRestaurant", methods ={"get"})
     */
    public function getAllRestaurant(RestaurantRepository $repository): Response
    {
        return $this->restService->getAllAction($repository);
    }
    /**
     * @Route("/add", name="add_Restaurant", methods={"post"})
     * @param Request $request
     * @return Response
     */
    public function createAction(Request $request): Response
    {
        return $this->restService->createAction($request,
            "App\Entity\Restaurant");



    }
    /**
     * @Route("/update/{id}", name="Restaurant_update", methods={"PUT"})
     * @return Response
     */
    public function updateAction(Restaurant $reclamation, Request $request): Response
    {
        return $this->restService->updateAction($reclamation, $request);
    }

    /**
     * @Route("/delete/{id}", name="restaurant_delete", methods={"DELETE"})
     * @param int $id
     * @param RestaurantRepository $repository
     * @return Response
     */
    public function deleteAction($id, RestaurantRepository $repository): Response
    {
        return $this->restService->deleteAction($id, $repository);
    }


   /**
     * @Route("/{id}", name="chapter_getByCourses", methods={"GET"})
     * @param MenuRepository $repository
     * @return Response
     */
   /**
    public function getChapterAction(MenuRepository  $menuRepository, RestaurantRepository $restaurantRepository, $id, SerializerInterface $serializer): Response
    {
        $restaurant=$restaurantRepository->find($id);
        $menus= $menuRepository->findBy((array)$restaurant);
        $data = $serializer->serialize($menus, 'json',[
            'circular_reference_handler' => function ($object) {
                return $object->getId();
            }
        ]);
        $response = new Response($data, Response::HTTP_OK);
        return $this->restService->prepareResponse($response);
    }*/




}
