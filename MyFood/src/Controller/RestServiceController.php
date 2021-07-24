<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\PropertyInfo\Extractor\ReflectionExtractor;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\AbstractNormalizer;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\GetSetMethodNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\SerializerInterface;


class RestServiceController extends AbstractController
{



    /**
     * @param mixed $objectRepository
     */
    public function getAllAction($objectRepository): Response
    {
        $list = $objectRepository->findAll();
        $serializer = $this->get('serializer');
        $data = $serializer->serialize($list, 'json',[
            'circular_reference_handler' => function ($object) {
                return $object->getId();

            }

        ]);
        $response = new Response($data, Response::HTTP_OK);

        return $this->prepareResponse($response);
    }
    /**
     * @param Request $request
     * @param string $className
     * @return Response
     */
    public function createAction(Request $request, string $className)

    {
        $normalizer = new ObjectNormalizer(null, null, null, new ReflectionExtractor());


        $data = $request->getContent();

            $encoders = array(new JsonEncoder());
            $serializer = new Serializer([new DateTimeNormalizer(), $normalizer], $encoders);
            $p = $serializer->deserialize($data, $className, 'json', []);
            $em = $this->getDoctrine()->getManager();
            $em->persist($p);
            $em->flush();
            $response = new Response('', Response::HTTP_CREATED);
            //Allow all websites
            $response->headers->set('Access-Control-Allow-Origin', '*');
            // You can set the allowed methods too, if you want
            $response->headers->set('Access-Control-Allow-Methods', 'POST, GET, PUT, DELETE, PATCH, OPTIONS');
            return $response;
        }


    /**
     * @param mixed $objectUpdate
     */
    public function updateAction($objectUpdate, Request $request): Response
    {

        $data = $request->getContent();
        $entityManager = $this->getDoctrine()->getManager();
        $serializer = $this->get('serializer');
        $serializer->deserialize($data, get_class($objectUpdate), 'json', [AbstractNormalizer::OBJECT_TO_POPULATE => $objectUpdate]);
        $entityManager->flush();

        $response = new Response('Instance of '.get_class($objectUpdate).' updated successfully.', Response::HTTP_OK);

        return $this->prepareResponse($response);
    }

    /**
     * @param $id
     * @param mixed $objectRepository
     */
    public function deleteAction($id, $objectRepository): Response
    {
        $objectToDelete = $objectRepository->find($id);
        if(!$objectToDelete)
        {
            $response = new Response('', Response::HTTP_NOT_FOUND);
            return $this->prepareResponse($response);
        }
        $entityManager= $this->getDoctrine()->getManager();
        $entityManager->remove($objectToDelete);
        $entityManager->flush();
        $response = new Response('', Response::HTTP_OK);
        //Allow all websites
        $response->headers->set('Access-Control-Allow-Origin', '*');
        // You can set the allowed methods too, if you want
        $response->headers->set('Access-Control-Allow-Methods', 'DELETE');
        return $response;
    }
    /**
     * @param mixed $objectRepository
     */
    public function getObjectAction($objectRepository, $id): Response
    {
        $object = $objectRepository->find($id);
        $serializer = $this->get('serializer');
        $data = $serializer->serialize($object, 'json',[
            'circular_reference_handler' => function ($object) {
                return $object->getId();
            }
        ]);
        $response = new Response($data, Response::HTTP_OK);

        return $this->prepareResponse($response);
    }
    //this is a private method used in this controller

    public function prepareResponse(Response $response) : Response
    {
        //set content Type
        $response->headers->set('Content-Type', 'application/json');
        //Allow all websites
        $response->headers->set('Access-Control-Allow-Origin', '*');
        // You can set the allowed methods too, if you want
        $response->headers->set("Access-Control-Allow-Methods", "*");

        return $response;
    }
    //this is a private method used in this controller

    public function returnNormalized($param, $entity)
    {
        $encoders = [new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);
        if ($entity == "") {
            return $serializer->serialize($param, 'json');
        } else
            return $serializer->deserialize($param, $entity, 'json');
    }
}
