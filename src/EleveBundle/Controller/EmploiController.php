<?php

namespace EleveBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class EmploiController extends Controller
{
    /**
     * @param \Symfony\Component\HttpFoundation\Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function emploiAction(\Symfony\Component\HttpFoundation\Request $request)
    {


        return $this->render("@Eleve/Emploi/emploi.html.twig");
    }

}