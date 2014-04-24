<?php
namespace Star\AnnoncesBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Validator\ErrorElement;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;
use Star\AnnoncesBundle\Entity\Sector;
 
class SectorAdmin extends Admin
{
	// setup the defaut sort column and order
    protected $datagridValues = array(
        '_sort_order' => 'DESC',
        '_sort_by' => 'id'
    );

	protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('title', null, array('label' => 'label'))
            ->add('description', null, array('label' => 'Descritpion'))
            
            
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('title')
            //->add('nbPointsPerConnexion')
            
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('title')
            
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
            ->add('title', null, array('label' => 'label'))
            ->add('descritpion', null, array('label' => 'Descritpion'))
            
            
            
        ;
    }

}