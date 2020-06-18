<?php

namespace ClubBundle\Controller;

use ClubBundle\Entity\Events;
use ClubBundle\Form\EventsType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

/**
 * Event controller.
 *
 */
class EventsController extends Controller
{
    /**
     * Lists all event entities.
     *
     */
    public function indexAction()
    {


        $em = $this->getDoctrine()->getManager();

        $events = $em->getRepository('ClubBundle:Events')->findAll();

        return $this->render('events/index.html.twig', array(
            'events' => $events,
        ));
    }

    /**
     *
     *
     *
     */
    public function newAction(Request $request)
    {
        $event = new Events();
        $form = $this->createForm('ClubBundle\Form\EventsType', $event);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $event->uploadPoster();
            $em->persist($event);
            $em->flush();

            //return $this->redirectToRoute('events_show', array('id' => $event->getId()));
        }

        return $this->render("@Club/Events/events.html.twig", array(
            'event' => $event,
            'form' => $form->createView(),
        ));
        $this->render("@Club/Events/viewE.html.twig");

    }

    /**
     * Finds and displays a event entity.
     *
     */
    public function showAction()
    {
        $em=$this->getDoctrine()->getManager();
        $events=$em->getRepository("ClubBundle:Events")->findAll();
        return $this->render("ClubBundle:Events:viewE.html.twig",array('events'=>$events));

    }



    public function mapAction()
    {
        return $this->render("@Club/Events/map.html.twig");

    }

    function deleteEventAction($id){
        $em=$this->getDoctrine()->getManager();
        $event=$this->getDoctrine()->getRepository(Events::class)
            ->find($id);
        $em->remove($event);
        $em->flush();
        return $this->redirectToRoute('AfficheLivre');
    }


    public function editAction(Request $request,$id)
    {
        {

            $em = $this->getDoctrine()->getManager();
            $event = $this->getDoctrine()
                ->getRepository(Events::class)
                ->find($id);
            $Form = $this->createForm(EventsType::class, $event);
            $Form->handleRequest($request);

            if ($Form->isSubmitted()) {
                $em->flush();
                return $this->redirectToRoute('AfficheLivre');

            }
            return $this->render("ClubBundle:Events:edit.html.twig",
                array('f' => $Form->createView()));


        }
    }

    /**
     * @Route("/event/{id}", name="events_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Events $event)
    {
        $em = $this->getDoctrine()->getManager();
        $em->remove($event);
        $em->flush();
        return new Response();
    }


    /**
     * Creates a form to delete a event entity.
     *
     * @param Events $event The event entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Events $event)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('events_delete', array('id' => $event->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
