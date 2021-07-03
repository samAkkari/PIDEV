<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\User;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
     /**
     * @Route("/user")
     */
class UserController extends AbstractController
{
    /**
     * @Route("/index", name="index")
     */
    public function index(): Response
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/UserController.php',
        ]);
    }

   /**
     * @Route("/listUsers", name="users", methods={"get"})
     */
    public function findAll(UserRepository $userRepository)
    {
        $list = $userRepository->findAll();

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
     * @Route("/addUser", name="addUser", methods={"post"})
     */
    public function addUser(Request $request){
        $data = $request->getContent();
        $encoders = array(new JsonEncoder());
        $serializer = new Serializer([new ObjectNormalizer()], $encoders);
        $u = $serializer->deserialize($data, 'App\Entity\User', 'json');
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
* @Route("/updateUser/{id}", name="updateUser", methods={"put"})
*
*/
public  function updateUser(Request $request, $id)
{  
    $data = $request->getContent();
    $em= $this->getDoctrine()->getManager();
    $encoders = array(new JsonEncoder());
    $serializer = new Serializer([new ObjectNormalizer()], $encoders);
    $pV1 = $serializer->deserialize($data, 'App\Entity\User', 'json');
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
* @Route("/{id}/deleteUser", name="deleteUser", methods={"delete"})
* @return Response
*
*/   
public function deleteUser($id): Response
{
   $em = $this->getDoctrine()->getManager();
   $user = $em->getRepository(User::class)->find($id);
   $em->remove($user);
   $em->flush();
   $response = new Response('', Response::HTTP_OK);
   //Allow all websites
   $response->headers->set('Access-Control-Allow-Origin','*');
   // You can set the allowed methods too, if you want
   $response->headers->set('Access-Control-Allow-Methods', 'DELETE');
   return $response;
}


}
