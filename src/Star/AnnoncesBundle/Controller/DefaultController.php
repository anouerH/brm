<?php

namespace Star\AnnoncesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
    	// $editId = sprintf('%09d', mt_rand(0, 1999999999));
    	// var_dump($editId);
        return $this->render('StarAnnoncesBundle:Default:index.html.twig');
    }

    public function menuAction(){
    	return $this->render('StarAnnoncesBundle:Default:menu.html.twig');
    }
    
    public function mapAction(){
        return $this->render('StarAnnoncesBundle:Default:map.html.twig');
    }
}
