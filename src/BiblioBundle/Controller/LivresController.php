<?php

namespace BiblioBundle\Controller;

use BiblioBundle\Entity\Reservationlivre;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use BiblioBundle\Entity\Livres;
use BiblioBundle\Form\LivresType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use CMEN\GoogleChartsBundle\GoogleCharts\Charts\PieChart;
use BiblioBundle\Repository\ReservationlivreRepository;
use UserBundle\Entity\User;
use BiblioBundle\Entity\AvisLivre;
use BiblioBundle\Entity\AvisNeg;
class LivresController extends Controller
{
    public function AjoutLivreAction(Request $request)
    {


        {

                //1-form
                //1-a:objet vide
                $livre=new Livres();
                //1-b:create form
                $form=$this->createForm(LivresType::class,$livre)
                    ->add('image',FileType::class,array('label'=>'Image'));
                //2-les données
                $form=$form->handleRequest($request);
                $nom=$livre->getNom();
                $auteur=$livre->getAuteur();
                $nbpersonnes=$livre->getNbpersonnes();
                $quantite=$livre->getQuantite();
                $description=$livre->getDescription();

                if($form->isSubmitted())
                {

                    //$valid =1;
                    //die('here');
                    /**
                     * @var UploadedFile $file
                     */
                    $file=$livre->getImage();
                    $fileName=md5(uniqid()).'.'.$file->guessExtension();
                    $file->move($this->getParameter('image_directory'),$fileName);
                    $livre->setImage($fileName);
                    //3-cnx avec BD
                    $em=$this->getDoctrine()->getManager();
                    $livre->setNbpersonnes(0);
                    $em->persist($livre);
                    $em->flush();

                    return $this->redirectToRoute('AfficheLivre');
                }

                //1-c:envoi du form
                return $this->render('@Biblio/Livres/AjoutLivre.html.twig', array(
                    "f"=>$form->createView()
                ));
            }

        }


    public function AfficheLivreAction(Request $request)
    {
        //les donnée de bdd
        $livre=$this->getDoctrine()
            ->getRepository(Livres::class)
            ->findAll();

           return $this->render("@Biblio/Livres/AfficheLivre.html.twig", array("list"=>$livre));
    }

    public function AfficheLivreFAction(Request $request)
    {
        //les donnée de bdd
        $livre=$this->getDoctrine()
            ->getRepository(Livres::class)
            ->findAll();

        return $this->render("@Biblio/LivresFront/AfficheLivre.html.twig", array("list"=>$livre));
    }


    function UpdateLivreAction(Request $request,$id){


        {

                $em = $this->getDoctrine()->getManager();
                $livre = $this->getDoctrine()
                    ->getRepository(Livres::class)
                    ->find($id);
                $Form = $this->createForm(LivresType::class, $livre);
                $Form->handleRequest($request);

                if ($Form->isSubmitted()) {
                    $em->flush();
                    return $this->redirectToRoute('AfficheLivre');

                }
                return $this->render('@Biblio/Livres/UpdateLivre.html.twig',
                    array('f' => $Form->createView()));


        }

    }

    function DeleteLivreAction($id){
        $em=$this->getDoctrine()->getManager();
        $livre=$this->getDoctrine()->getRepository(Livres::class)
            ->find($id);
        $em->remove($livre);
        $em->flush();
        return $this->redirectToRoute('AfficheLivre');
    }




public function  ReservationLivreAction(Request $request,$idLivre )
    {
        $user = $this->getUser();

        if($user != null)
        {
            if($user->getRoles()[0] == 'ELEVE')
            {
                $idUser = $user->getId();
                //$idEvent = $event->getIdevent();
                //die('id event'.$idEvent);
                $verify = $this->getDoctrine()
                    ->getRepository(Reservationlivre::class)
                    ->myfindMe($idUser, $idLivre);

                if($verify == null)
                {
                    $error = 1;
                    $reservation = new Reservationlivre();
                    $reservation->setIdeleve($idUser);
                    $reservation->setIdlivre($idLivre);
                    //die($idUser. ' ra: ' . $idRando);
                    $em = $this->getDoctrine()->getManager();
                    //updating place available in randonne table
                    $nbPersonnes = $em->getRepository(Livres::class)->findOneByidLivre($idLivre);
                    $quantite = $em->getRepository(Livres::class)->findOneByidLivre($idLivre);

                    $qte=$quantite->getQuantite();
                    $nb = $nbPersonnes->getNbpersonnes();
                    if($nb == null) {
                        $nb = 0;
                    }
                    //die('nn: '.$nbrePersonnes->getCapevent().' nbtr: '.$nbre);

                    //verification of number of inscriptions vs capacity
                    if(((int)$nbPersonnes->getQuantite()) > (int)$nb )
                    {
                        $new = (int)$nb+1;
                        $newqte = (int)$qte-1;
                        //
                        $nbPersonnes->setNbpersonnes($new);
                        $quantite->setQuantite($newqte);
                        //$event->setNbrepersonnes($new);
                        //die('nbre actuel: '.$nbrClient[0]->getNbreclient().' new one: '.$new );
                        //die('success');
                    }
                    else
                    {
                        $error = 2;
                    }
                    //Saving in new data DB

                    $em->persist($reservation);
                    $em->flush();
                    return $this->redirectToRoute('AfficheLivreF');
                }

                else
                {

                }$error = 2;
                return $this->redirectToRoute('AfficheLivreF', array(
                    'error' => $error
                ));
            }
            else
                return $this->redirectToRoute('AfficheLivreF');
        }
        return $this->redirectToRoute('fos_user_security_login');
    }

 public function RendreLivreAction($idLivre)
    {
        //die('id: '.$randonne->getIdrando())
        //die("here");
        $user = $this->getUser();
        if($user != null)
        {
            $idUser = $user->getId();
            //$idEvent = $event->getIdevent();

            $em = $this->getDoctrine()->getManager();
            $reservation =$em->getRepository(Reservationlivre::class)->myFindMe($idUser,$idLivre);
            $em->remove($reservation[0]);

            $nbPersonnes = $em->getRepository(Livres::class)->getAllAboutLivre($idLivre);
            $qte=$em->getRepository(Livres::class)->getAllAboutLivre($idLivre);
            //die('nb '.);
            $livre = $this->getDoctrine()->getRepository(Livres::class)->find($idLivre);
            $new = $nbPersonnes[0]->getNbpersonnes()-1;
            $newqte = $qte[0]->getQuantite()+1;
            //die('new '.$new);
            $livre->setNbpersonnes($new);
            $livre->setQuantite($newqte);
            //die('new : '.$randonne->getNbclient());
            $this->getDoctrine()->getManager()->flush();
            $em->flush();
            return $this->redirectToRoute('AfficheLivreF');
        }
        else
            return $this->redirectToRoute('fos_user_security_login');
    }

    public function reserveReadByUserAction(Request $request)
    {
        $user=$this->getUser();
        if($user != null)
        {
            if($user->getRoles()[0]!="ROLE_ELEVE") {

                $reservation=$this->getDoctrine()->getRepository(Reservationlivre::class)
                    ->findAll();
                $user=$this->getUser();
                $livre=$this->getDoctrine()->getRepository(Livres::class)
                    ->findAll();
                return $this->render("@Biblio/LivresFront/ReadMyReservation.html.twig", array("list"=>$reservation,"usr"=>$user,"livre"=>$livre));
            }
            else
            {return $this->redirectToRoute("fos_user_security_login");}
        }
        return $this->redirectToRoute("fos_user_security_login");
    }

    public  function LikeAction($id)
    {
        $avis=new AvisLivre();
        $user=$this->getUser()->getId();
        $livre=$this->getDoctrine()->getRepository(Livres::class)->find($id);
        $livre->setLikes($livre->getLikes()+1);
        if($livre->getDislikes()!=0)

        {
            $livre->setDislikes($livre->getDislikes()-1);}
        $livre->setRes($livre->getLikes()-$livre->getDislikes());
        $avis->setLivre($livre);
        $avis->setIdeleve($user);

        $em=$this->getDoctrine()->getManager();
        $em->persist($avis) ;
        $em->flush() ;

        $dislike=$this->getDoctrine()->getRepository(AvisNeg::class)->findvote($user,$livre);

        return $this->redirectToRoute('reservation_read_User');

    }
    public  function dislikeAction($id)
    {
        $avis=new AvisNeg();
        $user=$this->getUser()->getId();
        $livre=$this->getDoctrine()->getRepository(Livres::class)->find($id);
        $livre->setDislikes($livre->getDislikes()+1);
        if($livre->getLikes()!=0)
        {$livre->setLikes($livre->getLikes()-1);}
        $avis->setLivre($livre);
        $avis->setIdeleve($user);
        $em=$this->getDoctrine()->getManager();
        $em->persist($avis) ;
        $em->flush() ;

        $like=$this->getDoctrine()->getRepository(AvisLivre::class)->findvote($user,$livre);


        return $this->redirectToRoute('reservation_read_User');

    }


    public function impAction()
    {
        $em = $this->getDoctrine()->getManager();

        $livre = $em->getRepository(Livres::class)->findAll();

        return $this->render('@Biblio/Livres/imp.html.twig', array(
            'livre' => $livre,
        ));
    }

    public function StatAction()
    {
        $pieChart = new PieChart();

        $em= $this->getDoctrine();
        $livre = $em->getRepository(Livres::class)->findAll();
        $nbL=0;
        foreach($livre as $l) {
            $nbL=$nbL+$l->getQuantite();
        }

        $data= array();
        $stat=['livre', 'nbLivre'];
        $nb=0;
        array_push($data,$stat);
        foreach($livre as $l) {
            $stat=array();
            array_push($stat,$l->getNom(),($l->getNbpersonnes()));
            $nb=($l->getNbpersonnes());
            $stat=[$l->getNom(),$nb];
            array_push($data,$stat);

        }

        $pieChart->getData()->setArrayToDataTable(
            $data
        );

        $pieChart->getOptions()->setTitle('Livres les plus Empreintés ');
        $pieChart->getOptions()->setHeight(400);
        $pieChart->getOptions()->setWidth(800);
        $pieChart->getOptions()->setBackgroundColor('#719cfe');
        $pieChart->getOptions()->getTitleTextStyle()->setBold(true);
        $pieChart->getOptions()->getTitleTextStyle()->setColor( '#009900');
        $pieChart->getOptions()->getTitleTextStyle()->setItalic(true);
        $pieChart->getOptions()->getTitleTextStyle()->setFontName('Arial');
        $pieChart->getOptions()->getTitleTextStyle()->setFontSize(20);

        return $this->render('@Biblio/LivresFront/Stat.html.twig', array('piechart' => $pieChart));
    }

    public function showAction(Livres $livre)
    {


        return $this->render('@Biblio/Livres/show.html.twig', array(
            'livre' => $livre,

        ));
    }

}

