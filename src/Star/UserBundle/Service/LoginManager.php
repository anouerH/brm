<?php
namespace Star\UserBundle\Service;

use Symfony\Component\Security\Core\SecurityContext;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\Security\Http\SecurityEvents;

use Doctrine\Bundle\DoctrineBundle\Registry as Doctrine; 
use Star\UserBundle\Entity\User;
use Star\UserBundle\Entity\Seuil;
use FOS\UserBundle\FOSUserEvents;
use FOS\UserBundle\Event\FormEvent;
use FOS\UserBundle\FOSUserBundle;

use FOS\UserBundle\Event\UserEvent;
use FOS\UserBundle\Event\FilterUserResponseEvent;

use Symfony\Component\HttpFoundation\Session\Session;




class LoginManager implements EventSubscriberInterface
{
    /** @var \Symfony\Component\Security\Core\SecurityContext */
    private $securityContext;

    /** @var \Doctrine\ORM\EntityManager */
    private $em;

    /**
     * Constructor
     *
     * @param SecurityContext $securityContext
     * @param Doctrine        $doctrine
     */
    public function __construct(SecurityContext $securityContext, Doctrine $doctrine)
    {
    	$this->securityContext = $securityContext;
        $this->em = $doctrine->getEntityManager();
    }

    /**
     * {@inheritDoc}
     */
    public static function getSubscribedEvents()
    {

        return array(
                FOSUserEvents::SECURITY_IMPLICIT_LOGIN => 'onImplicitLoginManager',
                SecurityEvents::INTERACTIVE_LOGIN => 'onSecurityInteractiveLoginManager'
        );
    }

    public function onImplicitLoginManager(UserEvent $event)
    {
    	$user = $event->getUser();

        $user->setStars(10);

        $this->em->persist($user);
        $this->em->flush();
	}

    public function onSecurityInteractiveLoginManager(InteractiveLoginEvent $event)
    {
    	$user = $event->getAuthenticationToken()->getUser();
		// If first connection in this day
    	$today = new \DateTime('');
    	$lastLogin = $user->getLastLogin();

    	$session = new Session();
		//$session->start();
		$session->set('isFirstCnx', false);

    	if($today->format('Y-m-d') > $lastLogin->format('Y-m-d')){
    		$session->set('isFirstCnx', true);
    		$seuil = $this->em->getRepository('StarAnnoncesBundle:Seuil')->find(1);
	        if ($seuil) {
	        	
		    	$user->incrementStars($seuil->getNbPointsPerConnexion());

		        $this->em->persist($user);
		        $this->em->flush();
	        }

    	}
    	
    }


     
}