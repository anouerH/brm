<?php
namespace Star\UserBundle\Controller;

use FOS\UserBundle\Controller\RegistrationController as BaseController;
use Star\AnnoncesBundle\Entity\Seuil;

class RegistrationController extends BaseController
{
	/**
     * Tell the user to check his email provider
     */
    public function checkEmailAction()
    {
        $email = $this->container->get('session')->get('fos_user_send_confirmation_email/email');
        $this->container->get('session')->remove('fos_user_send_confirmation_email/email');
        $user = $this->container->get('fos_user.user_manager')->findUserByEmail($email);

        if (null === $user) {
            throw new NotFoundHttpException(sprintf('The user with email "%s" does not exist', $email));
        }
        // Increment nimber of stars for the current user
        // Firstlly we should get the number of stars by inscription

        //$em = $this->getDoctrine()->getManager();
        $em = $this->container->get('doctrine.orm.entity_manager');
        $seuil = $em->getRepository('StarAnnoncesBundle:Seuil')->find(1);

        if ($seuil) {
        	$user->setStars($seuil->getNbPointsPerInscription());
			$em->persist($user);
            $em->flush();
        }
        
        return $this->container->get('templating')->renderResponse('FOSUserBundle:Registration:checkEmail.html.'.$this->getEngine(), array(
            'user' => $user,
        ));
    }

}