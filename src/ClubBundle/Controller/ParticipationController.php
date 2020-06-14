<?php

namespace ClubBundle\Controller;

use ClubBundle\Entity\Events;
use ClubBundle\Entity\Participation;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;


class ParticipationController extends Controller
{
    public function ParticiperAction(Request $request)
    {

        $em= $this->getDoctrine()->getManager();
        $user=$this->getUser();
        $idu=$user->getId();

        $id=$request->get('id');

        $Event=$em->getRepository('ClubBundle:Events')->find($id);
        $participation=$em->getRepository('ClubBundle:Participation')->findOneBy(array('iduser'=>$idu,'idevent'=>$id));
//        $enseignes = $em->getRepository("ClientBundle:Participation")->findAll();




        if(empty($participation)){
            $msg='done';
            $participation=new Participation();
            $Event->setNbreparticipation($Event->getNbreparticipation() + 1);
            $participation-> setIduser($user);
            $participation-> setIdevent($Event);
            $em->persist($participation);
            $em->persist($Event);
            $em->flush();
            return $this->redirectToRoute('AfficheLivreF');

            //  $em=$this->getDoctrine()->getManager();
         //   return $this->render('ClubBundle:Default:Evenement.html.twig',array('MessageEvent'=>$msg,'events'=>$events));

        }



        $msg  =  'Vous avez déjà annuler votre participation!';


        $em=$this->getDoctrine()->getManager();
        $em->remove($participation);
        $Event->setNbreparticipation($Event->getNbreparticipation() - 1);
        $em->persist($Event);
        $em->flush();
        return $this->redirectToRoute('AfficheLivreF');

        // return $this->render('ClientBundle:Default:Evenement.html.twig',array('MessageEvent'=>$msg,'events'=>$events));


    }

}
