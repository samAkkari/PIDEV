<?php

namespace App\Controller;

use App\Entity\Ingredients;
use App\Repository\IngredientsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;

/**
    * @Route("/ingredients", name="ingredients")
    */
class IngredientsController extends AbstractController
{
    /**
     * @Route("/index", name="index")
     */
    public function index(): Response
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/IngredientsController.php',
        ]);
    }

    /**
     * @Route("/listIngredients", name="listIngredients", methods={"get"})
     * @return Response
     */
    public function findAll(IngredientsRepository  $ingredientsRepository)
    {
        $list = $ingredientsRepository->findAll();

        $encoders = array(new JsonEncoder());
        $serializer = new Serializer([new ObjectNormalizer()], $encoders);
        $data = $serializer->serialize($list, 'json', ['ignored_attributes' => ['categoryIngredient']]);

        $response = new Response($data,200);

        $response->headers->set('content-type','application/json');
        //Allow all websites
        $response->headers->set('Access-Control-Allow-Origin', '*');
        // You can set the allowed methods too, if you want
        $response->headers->set('Access-Control-Allow-Methods', 'GET');
        return $response;


    }

    /**
     * @Route("/addIngredient", name="addIngredient", methods={"post"})
     */
    public function addCategoryIng(Request $request){
        $data = $request->getContent();
        $encoders = array(new JsonEncoder());
        $serializer = new Serializer([new ObjectNormalizer()], $encoders);
        $u = $serializer->deserialize($data, 'App\Entity\Ingredients', 'json');
        $em= $this->getDoctrine()->getManager();
        $em->persist($u);
        $em->flush();
        $response = new Response('', Response::HTTP_CREATED);
        //Allow all websites
        $response->headers->set('Access-Control-Allow-Origin', '*');
        // You can set the allowed methods too, if you want
        $response->headers->set('Access-Control-Allow-Methods', 'POST, GET, PUT, DELETE, PATCH, OPTIONS');
        return $response;


    }

    /**
     * @Route("/updateCategoryIng/{id}", name="updateCategoryIng", methods={"put"})
     *
     */
    public  function updateCategoryIng(Request $request, $id)
    {
        $data = $request->getContent();
        $em= $this->getDoctrine()->getManager();
        $encoders = array(new JsonEncoder());
        $serializer = new Serializer([new ObjectNormalizer()], $encoders);
        $pV1 = $serializer->deserialize($data, 'App\Entity\Ingredients', 'json');
        $pV0 = $em->getRepository(Ingredients::class)->find($id);
        $pV0 = $pV1;
        $em->flush();
        $response = new Response('', Response::HTTP_OK);
        //Allow all websites
        $response->headers->set('Access-Control-Allow-Origin', '*');
        // You can set the allowed methods too, if you want
        $response->headers->set('Access-Control-Allow-Methods', 'POST, GET, PUT, DELETE, PATCH, OPTIONS');
        return $response;
    }


    /**
     * @Route("/{id}/deleteIngredient", name="deleteIngredient", methods={"delete"})
     * @return Response
     *
     */
    public function deleteIngredients($id): Response
    {
        $em = $this->getDoctrine()->getManager();
        $cat = $em->getRepository(Ingredients::class)->find($id);
        $em->remove($cat);
        $em->flush();
        $response = new Response('', Response::HTTP_OK);
        //Allow all websites
        $response->headers->set('Access-Control-Allow-Origin','*');
        // You can set the allowed methods too, if you want
        $response->headers->set('Access-Control-Allow-Methods', 'DELETE');
        return $response;
    }
}
