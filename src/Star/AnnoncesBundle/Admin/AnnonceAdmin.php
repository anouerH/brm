<?php
namespace Star\AnnoncesBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Star\AnnoncesBundle\Entity\Annonce;
use Sonata\AdminBundle\Route\RouteCollection;
use Symfony\Component\HttpFoundation\Response;
 
class AnnonceAdmin extends Admin
{
	// setup the defaut sort column and order
    protected $datagridValues = array(
        '_sort_order' => 'DESC',
        '_sort_by' => 'createdAt'
    );

	protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('title',null, array('label'=>'Titre'))
            ->add('description',null, array('label'=>'Description'))
            ->add('gouv',null, array('label'=>'Gouvernorat'))
            ->add('user',null, array('label'=>'Utilisateur'))
            ->add('isEnabled',null, array('label'=>'Valider'))
            ->add('isDisabled',null, array('label'=>'Rejeter'))
            // you can define help messages like this
            ->setHelps(array(
               'title' => $this->trans('help_post_title')
            ));
            
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            //->add('title')
            //->add('price')
            ->add('isEnabled',null, array('label'=>'les annonces validées ?'))
            ->add('isDisabled',null, array('label'=>'les annonces rejetées ?'))
            ->add('gouv')
            
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('title', null, array('label'=>'Titre'))
            ->add('isEnabled', null, array('label'=>'Validée'))
            ->add('isDisabled', null, array('label'=>'Rejetée'))
            ->add('gouv')
            ->add('user')
            ->add('createdAt', null, array('label'=>'Crée le','format'=>'d/m/Y'))
            ->add('_action', 'actions', array(
                'actions' => array(
                    'view' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
            // ->add('yourLink', null, array('template' => '::testfield.html.twig'))
        ;
    }

    protected function configureShowField(ShowMapper $showMapper)
    {
        $showMapper
            ->add('title')
            ->add('gouv')
            ->add('createdAt')
            
        ;
    }


    public function getEditTemplate()
    {
        return 'StarAnnoncesBundle:Sonata:base_edit.html.twig';
    }

    public function update($object)
    {
        parent::update($object);

        // send welcome email to new user
        $message = \Swift_Message::newInstance()
            ->setSubject('Votre annonce est validée')
            ->setFrom('no-reply@starannonces.tn')
            ->setTo($object->getUser()->getEmail())
            // ->setBody($this->renderView('StarAnnoncesBundle:EmailTemplates:annonce-validee.html.twig'))
            //->setBody("ddddd")
            ;
            
            $templating = $this->getConfigurationPool()->getContainer()->get('templating');
            $content = $templating->render(
                'StarAnnoncesBundle:EmailTemplates:annonce-validee.html.twig' ,
                array('entity' => $object)
            );
        $message->setBody($content, 'text/html');
        //$this->get('mailer')->send($message);
        $this->getConfigurationPool()->getContainer()->get('mailer')->send($message);

    }
    

    /*public function createQuery($context = 'list')
	{
	    $query = parent::createQuery($context);
	    $query->andWhere(
            $query->expr()->eq($query->getRootAlias() . '.isEnabled', ':my_param')
	    );
	    $query->setParameter('my_param', 1);
	    return $query;
	}*/


}