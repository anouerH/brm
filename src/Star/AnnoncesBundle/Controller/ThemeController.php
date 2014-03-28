<?php

namespace Star\AnnoncesBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;



class ThemeController extends Controller
{
	
	public function menuAction(){
            $em = $this->getDoctrine()->getManager();

            $entities = $em->getRepository('StarAnnoncesBundle:Theme')->findAll();
            foreach ($entities as $entity){
                $entity->setNatures($em->getRepository('StarAnnoncesBundle:Nature')->findBy(array('theme'=>$entity)) );
            }
            return $this->render('StarAnnoncesBundle:Theme:menu.html.twig', array(
                'entities' => $entities,
            ));
	}
        
        public function footerAction(){
            $em = $this->getDoctrine()->getManager();

            $entities = $em->getRepository('StarAnnoncesBundle:Theme')->findAll();
            
            return $this->render('StarAnnoncesBundle:Theme:footer.html.twig', array(
                'entities' => $entities,
            ));
	}
}