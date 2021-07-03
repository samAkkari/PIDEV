<?php

namespace App\Controller;

use App\Entity\DetailsRecette;
use App\Entity\Recette;
use App\Entity\User;
use App\Repository\DetailsRecetteRepository;
use App\Repository\RecetteRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
    /**
     * @Route("/detailsRecette", name="detailsRecette")
    */
class DetailsRecetteController extends AbstractController
{
    /**
     * @Route("/index", name="index")
     */
    public function index(): Response
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/DetailsRecetteController.php',
        ]);
    }


    /**
     * @Route("/listDet", name="listDet", methods={"get"})
     */
    public function findAll(DetailsRecetteRepository  $detailsRecetteRepository)
    {
        $list = $detailsRecetteRepository->findAll();

        $encoders = array(new JsonEncoder());
        $serializer = new Serializer([new ObjectNormalizer()], $encoders);
        $data = $serializer->serialize($list, 'json',['ignored_attributes' => ['categoryIngredient']]);
        $response = new Response($data,200);

        $response->headers->set('content-type','application/json');
        //Allow all websites
        $response->headers->set('Access-Control-Allow-Origin', '*');
        // You can set the allowed methods too, if you want
        $response->headers->set('Access-Control-Allow-Methods', 'GET');
        return $response;


    }

    /**
     * @Route("/addDetRecette", name="addDetRecette", methods={"post"})
     */
    public function addDetRecette(Request $request){
        $data = $request->getContent();
        $encoders = array(new JsonEncoder());
        $serializer = new Serializer([new ObjectNormalizer()], $encoders);
        $u = $serializer->deserialize($data, 'App\Entity\DetailsRecette', 'json');
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
     * @Route("/updateDetRecette/{id}", name="updateDetRecette", methods={"put"})
     */
    public function updateDetRec (Request $request, $id)
    {
        $data = $request->getContent();
        $em= $this->getDoctrine()->getManager();
        $encoders = array(new JsonEncoder());
        $serializer = new Serializer([new ObjectNormalizer()], $encoders);
        $pV1 = $serializer->deserialize($data, 'App\Entity\DetailsRecette', 'json');
        $pV0 = $em->getRepository(User::class)->find($id);
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
     * @Route("/{id}/deleteDetRecette", name="deleteDetRecette", methods={"delete"})
     * @return Response
     */
    public function deleteDetRecette($id): Response
    {
        $em = $this->getDoctrine()->getManager();
        $det = $em->getRepository(DetailsRecette::class)->find($id);
        $em->remove($det);
        $em->flush();
        $response = new Response('', Response::HTTP_OK);
        //Allow all websites
        $response->headers->set('Access-Control-Allow-Origin','*');
        // You can set the allowed methods too, if you want
        $response->headers->set('Access-Control-Allow-Methods', 'DELETE');
        return $response;
    }

}
