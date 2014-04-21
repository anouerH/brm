<?php
namespace Star\AnnoncesBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Star\AnnoncesBundle\Entity\Brand;
 
class SeuilAdmin extends Admin
{
	// setup the defaut sort column and order
    protected $datagridValues = array(
        '_sort_order' => 'DESC',
        '_sort_by' => 'id'
    );

	protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('nbPointsPerInscription', null, array('label' => 'Nombre de points pour chaque inscription'))
            ->add('nbPointsPerConnexion', null, array('label' => 'Nombre de points pour chaque connexion'))
            ->add('nbPointsPerAdds', null, array('label' => 'Nombre de points pour chaque ajout d\'annonce'))
            ->add('nbPointsPerImage', null, array('label' => 'Nombre de points pour ajout d\'image annonce '))

            
            ->add('nbPointsPerMessage', null, array('label' => 'Nombre de points pour chaque envoi de message'))
            ->add('nbPointsInboxMessage', null, array('label' => 'Nombre de points pour chaque réeption de message'))
            ->add('nbPointsForOneStar', null, array('label' => 'Nombre de point équivalent à un point star '))
            ->add('period', null, array('label' => 'Temps d\'affichage de l\'annonce dans la page d\'accuiel'))
            
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            //->add('nbPointsPerInscription')
            //->add('nbPointsPerConnexion')
            
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('nbPointsPerInscription')
            ->add('nbPointsPerConnexion')
            ->add('nbPointsPerAdds')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'view' => array(),
                    'edit' => array(),
                    //'delete' => array(),
                )
            ))
        ;
    }

    protected function configureShowField(ShowMapper $showMapper)
    {
        $showMapper
            ->add('nbPointsPerInscription', null, array('label' => 'Nombre de points pour chaque inscription'))
            ->add('nbPointsPerConnexion', null, array('label' => 'Nombre de points pour chaque connexion'))
            ->add('nbPointsPerAdds', null, array('label' => 'Nombre de points pour chaque ajout d\'annonce'))
            ->add('nbPointsPerImage', null, array('label' => 'Nombre de points pour ajout d\'image annonce '))

            
            ->add('nbPointsPerMessage', null, array('label' => 'Nombre de points pour chaque envoi de message'))
            ->add('nbPointsInboxMessage', null, array('label' => 'Nombre de points pour chaque réeption de message'))
            ->add('nbPointsForOneStar', null, array('label' => 'Nombre de point équivalent à un point star '))
            ->add('period', null, array('label' => 'Temps d\'affichage de l\'annonce dans la page d\'accueil'))
            
            
        ;
    }

}