<?php

namespace App\Controller;

use App\Entity\CategoryIngredient;
use App\Repository\CategoryIngredientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

/**
    * @Route("/categoryIngredient")
    */
class CategoryIngredientController extends AbstractController
{
    /**
     * @Route("/index", name="index")
     */
    public function index(): Response
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/CategoryIngredientController.php',
        ]);
    }

    /**
     * @Route("/listCategorys", name="categorys", methods={"get"})
     * @return Response
     */
    public function findAll(CategoryIngredientRepository  $categoryIngredientRepository)
    {
        $list = $categoryIngredientRepository->findAll();

        $encoders = array(new JsonEncoder());
        $serializer = new Serializer([new ObjectNormalizer()], $encoders);
        $data = $serializer->serialize($list, 'json');
        $response = new Response($data,200);

        $response->headers->set('content-type','application/json');
        //Allow all websites
        $response->headers->set('Access-Control-Allow-Origin', '*');
        // You can set the allowed methods too, if you want
        $response->headers->set('Access-Control-Allow-Methods', 'GET');
        return $response;


    }

    /**
     * @Route("/addCategoryIng", name="addCategoryIng", methods={"post"})
     */
    public function addCategoryIng(Request $request){
        $data = $request->getContent();
        $encoders = array(new JsonEncoder());
        $serializer = new Serializer([new ObjectNormalizer()], $encoders);
        $u = $serializer->deserialize($data, 'App\Entity\CategoryIngredient', 'json');
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
    public  function updateCategoryIng(CategoryIngredient $categoryIngredient,Request $request, EntityManagerInterface $em,SerializerInterface $serializer): Response
    {
        $serializer->deserialize($request->getContent(),
            CategoryIngredient::class, 'json', [AbstractNormalizer::OBJECT_TO_POPULATE => $categoryIngredient]
        );
        $em->flush();
        return new JsonResponse(
            $serializer->serialize($categoryIngredient, "json"),
            JsonResponse::HTTP_OK,
            [],
            true
        );
    }


    /**
     * @Route("/{id}/deleteCategoryIng", name="deleteCategoryIng", methods={"delete"})
     * @return Response
     *
     */
    public function deleteCategoryIng($id): Response
    {
        $em = $this->getDoctrine()->getManager();
        $cat = $em->getRepository(CategoryIngredient::class)->find($id);
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
