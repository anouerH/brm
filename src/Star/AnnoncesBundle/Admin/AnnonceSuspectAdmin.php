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
 
class AnnonceSuspectAdmin extends Admin
{
    protected $baseRouteName = 'adds_admin';
    
	// setup the defaut sort column and order
    protected $datagridValues = array(
        '_sort_order' => 'DESC',
        '_sort_by' => 'created_at'
    );

	protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('title')
            ->add('price')
            ->add('gouv')
            ->add('isEnabled')
            ->add('isDisabled')
            
        ;
    }

    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
    {
        $datagridMapper
            ->add('title')
            ->add('price')
            ->add('gouv')
            
        ;
    }

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            ->addIdentifier('title')
            ->add('gouv')
            ->add('createdAt')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'view' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
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

    public function createQuery($context = 'list')
	{
	    $query = parent::createQuery($context);
	    $query->andWhere($query->getRootAlias() . '.validatedAt IS NULL'
	        //$query->expr()->eq($query->getRootAlias() . '.validatedAt', ':my_param')
	    );
	    //$query->setParameter('my_param', NULL);
	    return $query;
	}

    protected function configureRoutes(RouteCollection $collection)
    {
        $collection->add('myCustom'); #Action gets added automaticly
        //$collection->add('view', $this->getRouterIdParameter().'/view');
        $collection->remove('create');
    }



}