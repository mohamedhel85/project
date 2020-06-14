<?php

namespace ClubBundle\Controller;
//include("imageUploader.php");
//use Cloudinary\Utils\Singleton;
use ClubBundle\Entity\Club;
use ClubBundle\Form\ClubType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\File\UploadedFile;

//use App\Service\ImageUploader;
class ClubController extends Controller
{
    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function addClubAction(\Symfony\Component\HttpFoundation\Request $request)
    {
        $club = new Club();
        $form = $this->createForm(ClubType::class,$club);
        $form->handleRequest($request);

        if($form->isSubmitted())
        {
            $em= $this->getDoctrine()->getManager();
            $club->uploadLogo();
            $em->persist($club);
            $em->flush();

        }
        return $this->render("@Club/Club/addClub.html.twig",array('form'=>$form->createView()));
    }
    public function viewAction()
    {
        $em=$this->getDoctrine()->getManager();
        $clubs=$em->getRepository("ClubBundle:Club")->findAll();
        return $this->render("ClubBundle:Club:view.html.twig",array('clubs'=>$clubs));

    }
}
