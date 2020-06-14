<?php

namespace EleveBundle\Controller;

use ClubBundle\Entity\Events;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class EleveController extends Controller
{
    public function afficheAction()
    {
        $em=$this->getDoctrine()->getManager();
        $clubs=$em->getRepository("ClubBundle:Club")->findAll();
        return $this->render("EleveBundle:Club:affichage.html.twig",array('clubs'=>$clubs));

    }
    public function afficheEAction()
    {
        $em=$this->getDoctrine()->getManager();
        $events=$em->getRepository("ClubBundle:Events")->findAll();
        return $this->render("EleveBundle:Event:afficheEvent.html.twig",array('events'=>$events));

    }
    public function imprimerAction()
    {
        return $this->render("EleveBundle:Club:imprimer.html.twig");
    }



}
