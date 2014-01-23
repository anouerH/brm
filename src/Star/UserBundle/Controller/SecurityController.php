<?php

namespace Star\UserBundle\Controller;

use Symfony\Component\HttpFoundation\RedirectResponse;
use FOS\UserBundle\Controller\SecurityController as BaseController;


class SecurityController extends BaseController
{

    public function renderLogin(array $data) {
    
        $requestAttributes = $this->container->get('request')->attributes;
        if ($requestAttributes->get('_route') == 'admin_login') {
           
            //$template = sprintf('StarUserBundle:Security:login.html.twig');
            $template = sprintf('StarUserBundle:Security:login-admin.html.%s', $this->container->getParameter('fos_user.template.engine'));
            return $this->container->get('templating')->renderResponse($template, $data);
        } else {
           
            //$template = sprintf('FOSUserBundle:Security:login.html.%s', $this->container->getParameter('fos_user.template.engine'));
            return  parent::renderLogin($data);
        }
        
        
    }



   
    
}
