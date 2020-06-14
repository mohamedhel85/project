<?php
namespace ClubBundle\Controller;

use AppBundle\Entity\User;
use ClubBundle\Entity\Events;
use ClubBundle\Entity\Participation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
/**
 * @Route("api/events")
 */
class APIController extends Controller {

    public function getEventsAction() {
        $events = $this->getDoctrine()->getManager()->getRepository('ClubBundle:Events')->findAll();
        $objectNormalizer = new ObjectNormalizer();
        $objectNormalizer->setCircularReferenceHandler(function ($object) {
            return $object->getId();
        });
        $serializer = new Serializer([new DateTimeNormalizer(), $objectNormalizer]);
        return new JsonResponse($serializer->normalize($events));
    }
    /**
     * @Route("/{id}", name="events_api_get")
     * @Method("GET")
     */
    public function getEventAction(Events $event) {
        $objectNormalizer = new ObjectNormalizer();
        $objectNormalizer->setCircularReferenceHandler(function ($object) {
            return $object->getId();
        });
        $serializer = new Serializer([new DateTimeNormalizer(), $objectNormalizer]);
        return new JsonResponse($serializer->normalize($event));
    }


    public function joinEventAction($iduser,$idevent) {
        {
            $em = $this->getDoctrine()->getManager();
            $part=$em->getRepository('ClubBundle:Participation')->findOneBy(array('iduser'=>$iduser,'idevent'=>$idevent));
            if(empty($part)){
                $part = new Participation();
                $part->setIduser($iduser);
                $part->setIdevent($idevent);

                $em->persist($part);
                $em->flush();
                $serializer = new Serializer([new ObjectNormalizer()]);
                $formatted = $serializer->normalize($part);
                return new JsonResponse($formatted);
            }
            $em->remove($part);
            $em->flush();
            $serializer=new Serializer([new ObjectNormalizer()]);
            $formatted=$serializer->normalize($part);
            return new JsonResponse($formatted);
        }
    }

}
