<?php

namespace App\Controller;

use App\Entity\Produit;
use App\Repository\CategorieRepository;
use App\Repository\ProduitRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\SerializerInterface;


/**
 * @Route("/produit", name="produit")
 */
class ProduitController extends AbstractController
{


    /**
     * @Route("/index", name="produit")
     */
    public function index(): Response
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/ProduitController.php',
        ]);
    }

    /**
     * @Route("/getAll", name="pageproduit", methods ={"get"})
     */
    public function getAllProduct(ProduitRepository $repository): Response
    {
        $list = $repository->findAll();
        $encoders = array(new JsonEncoder());
        $serializer = new Serializer([new ObjectNormalizer()], $encoders);
        $data = $serializer->serialize($list, 'json');
        $response = new Response($data, 200);
        //content type
        $response->headers->set('Content-Type', 'application/json');
        //Allow all websites
        $response->headers->set('Access-Control-Allow-Origin', '*');
        // You can set the allowed methods too, if you want
        $response->headers->set('Access-Control-Allow-Methods', 'POST');
        return $response;
    }

    /**
     * @Route("/add", name="addProduct",methods ={"POST"})
     */
    public function addProduct(Request $request, CategorieRepository $c): Response
    {
        $data = $request->getContent();
        $encoders = array(new JsonEncoder());
        $serializer = new Serializer([new ObjectNormalizer()], $encoders);
        $p = $serializer->deserialize($data, 'App\Entity\Produit', 'json');
        $p->setCategorie($c->find(1));
        #dd($p);
        $pr= $this->getDoctrine()->getManager();
        $pr->persist($p);
        $pr->flush();
        $response = new Response('', Response::HTTP_CREATED);
        //Allow all websites
        $response->headers->set('Access-Control-Allow-Origin', '*');
        // You can set the allowed methods too, if you want
        $response->headers->set('Access-Control-Allow-Methods', 'POST');
        return $response;
    }

    /**
     * @Route("/modifier/{id}", name="Product_put", methods={"PUT"})
     */
    public function putProduct(
        Produit $product,
        Request $request,
        EntityManagerInterface $pr,
        SerializerInterface $serializer
    ): Response
    {
        $serializer->deserialize($request->getContent(),
            Produit::class, 'json', [AbstractNormalizer::OBJECT_TO_POPULATE => $product]
        );

        $pr->flush();

        return new JsonResponse(
            $serializer->serialize($product, "json"),
            JsonResponse::HTTP_NO_CONTENT,
            [],
            true
        );
    }

    /**
     * @Route("/{id}/delete", name="api_delete", methods={"delete"})
     * @return Response
     */
    public function deleteProduct($id): Response
    {
        $pr = $this->getDoctrine()->getManager();
        $produit =$pr->getRepository(Produit::class)->find($id);
        $pr->remove($produit);
        $pr->flush();
        $response = new Response('', Response::HTTP_OK);
        //Allow all websites
        $response->headers->set('Access-Control-Allow-Origin','*');
        // You can set the allowed methods too, if you want
        $response->headers->set('Access-Control-Allow-Methods', 'DELETE');
        return $response;
    }

}
