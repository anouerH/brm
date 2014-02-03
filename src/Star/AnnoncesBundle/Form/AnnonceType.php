<?php

namespace Star\AnnoncesBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class AnnonceType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('annonce_type', 'choice', array(
                'choices' => array('OFFRE' => 'Offre', 'DEMANDE' => 'demande'),
                'multiple' => false,
                'expanded' => true,
                'required' => true,
                //'data' => 'OFFRE',
            ))
            ->add('demande_type', 'choice', array(
                'choices' => array('VENTE' => 'Vente', 'LOCATION' => 'Location'),
                'multiple' => false,
                'expanded' => true,
                'required' => true,
                //'data' => 'VENTE',
            ))
            //->add('gouv', 'entity', array('class' => 'StarAnnoncesBundle:Gouv','empty_value' => ''))
            ->add('gouv', 'entity', array('class'      => 'StarAnnoncesBundle:Gouv'
                                   , 'required'   => true
                                   , 'empty_value'=> ''))

            //->add('deleg', 'entity', array('class' => 'StarAnnoncesBundle:Deleg','empty_value' => ''))
            ->add('deleg', 'shtumi_dependent_filtered_entity'
                , array('entity_alias' => 'deleg_by_gouv'
                      , 'empty_value'=> ''
                      , 'parent_field'=>'gouv'))

            //->add('locality', 'entity', array('class' => 'StarAnnoncesBundle:Locality','empty_value' => ''))
            ->add('locality', 'shtumi_dependent_filtered_entity'
                , array('entity_alias' => 'locality_by_deleg'
                      , 'empty_value'=> ''
                      , 'parent_field'=>'deleg'))


             ->add('theme', 'entity', array('class'      => 'StarAnnoncesBundle:Theme'
                                   , 'required'   => true
                                   , 'empty_value'=> ''))

             ->add('nature', 'shtumi_dependent_filtered_entity'
                , array('entity_alias' => 'nature_by_theme'
                      , 'empty_value'=> ''
                      , 'parent_field'=>'theme'))
            
            ->add('title')
            ->add('description')
            ->add('price')
            
            // ->add('createdAt')
            //->add('updatedAt')
        ;
        $factory = $builder->getFormFactory();
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Star\AnnoncesBundle\Entity\Annonce'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'star_annoncesbundle_annonce';
    }
}
