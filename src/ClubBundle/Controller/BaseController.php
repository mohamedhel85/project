<?php

namespace ClubBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BaseController extends Controller
{
    public function baseAction()
    {
        return $this->render('@Club/base.html.twig');
    }
}
