<?php

namespace Star\UserBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('StarUserBundle:Default:index.html.twig', array('name' => $name));
    }
}
