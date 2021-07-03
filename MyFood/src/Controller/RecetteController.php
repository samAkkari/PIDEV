<?php

namespace App\Controller;

use App\Entity\CategoryIngredient;
use App\Entity\Recette;
use App\Entity\User;
use App\Repository\RecetteRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\AbstractObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;

/**
    * @Route("/recette")
    */
class RecetteController extends AbstractController
{
    /**
     * @Route("/index", name="index")
     */
    public function index(): Response
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/RecetteController.php',
        ]);
    }

    /**
     * @Route("/listRecettes", name="recettes", methods={"get"})
     */
    public function findAll(RecetteRepository  $recetteRepository)
    {
        $list = $recetteRepository->findAll();
       // $encoders = array(new JsonEncoder());
        $encoders = new JsonEncoder();
        $defaultContext = [
            AbstractNormalizer::CIRCULAR_REFERENCE_HANDLER => function ($list, $format, $context) {
                return $list->getLibelle();
            },
        ];
        $normalizer = new ObjectNormalizer(null, null, null, null, null, null, $defaultContext);
        $serializer = new Serializer([$normalizer], [$encoders]);
      //  var_dump($serializer->serialize($org, 'json'));
        $data = $serializer->serialize($list, 'json',[AbstractObjectNormalizer::ENABLE_MAX_DEPTH => true]);
        ///$serializer = new Serializer([new ObjectNormalizer()], $encoders);
        $response = new Response($data,200);
        $response->headers->set('content-type','application/json');
        //Allow all websites
        $response->headers->set('Access-Control-Allow-Origin', '*');
        // You can set the allowed methods too, if you want
        $response->headers->set('Access-Control-Allow-Methods', 'GET');
        return $response;
    }

    /**
     * @Route("/addRecette", name="addRecette", methods={"post"})
     */
    public function addRecette(Request $request){
        $data = $request->getContent();
        $encoders = array(new JsonEncoder());
        $serializer = new Serializer([new ObjectNormalizer()], $encoders);
        $u = $serializer->deserialize($data, 'App\Entity\Recette', 'json');
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
     * @Route("/updateRecette/{id}", name="updateRecette", methods={"put"})
     */
    public  function updateRecette(Recette $recette,Request $request, EntityManagerInterface $em,SerializerInterface $serializer): Response
    {
        $serializer->deserialize($request->getContent(),
            Recette::class, 'json', [AbstractNormalizer::OBJECT_TO_POPULATE => $recette]
        );
        $em->flush();
        return new JsonResponse(
            $serializer->serialize($recette, "json"),
            JsonResponse::HTTP_OK,
            [],
            true
        );
    }

    /**
     * @Route("/{id}/deleteRecette", name="deleteRecette", methods={"delete"})
     * @return Response
     *
     */
    public function deleteRecette($id): Response
    {
        $em = $this->getDoctrine()->getManager();
        $recette = $em->getRepository(Recette::class)->find($id);
        $em->remove($recette);
        $em->flush();
        $response = new Response('', Response::HTTP_OK);
        //Allow all websites
        $response->headers->set('Access-Control-Allow-Origin','*');
        // You can set the allowed methods too, if you want
        $response->headers->set('Access-Control-Allow-Methods', 'DELETE');
        return $response;
    }


}
