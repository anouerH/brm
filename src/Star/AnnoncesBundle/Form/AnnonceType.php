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

             ->add('brand', 'shtumi_dependent_filtered_entity'
                , array('entity_alias' => 'brand_by_nature'
                      , 'empty_value'=> ''
                      , 'parent_field'=>'nature'))

             ->add('model', 'shtumi_dependent_filtered_entity'
                , array('entity_alias' => 'model_by_brand'
                      , 'empty_value'=> ''
                      , 'parent_field'=>'brand'))
              
            
            ->add('energy', 'entity', array('class'      => 'StarAnnoncesBundle:Energy'
                                   , 'required'   => false
                                   , 'empty_value'=> ''))
            
            ->add('power')
            ->add('mileage')
            //->add('release')
            ->add('release', 'date', array(
                'widget' => 'single_text',
                
                // this is actually the default format for single_text
                'format' => 'yyyy-MM-dd',
            ))
            ->add('totalArea')
                
                ->add('livingArea')
                ->add('numberRooms')
                ->add('numberBathRooms')
                ->add('parckingPlaces')
                ->add('constructionYear')
                ->add('floorNumber')
                
            ->add('title')
            ->add('description')
            ->add('price')
            //->add('fixedPrice')
            ->add('fixedPrice', 'choice', array(
                'choices' => array('1' => 'Fixe', '0' => 'Négociable'),
                'multiple' => false,
                'expanded' => true,
                'required' => true,
                //'data' => 'OFFRE',
            ))
                
            ->add('showPhoneNumber', 'choice', array(
                'choices' => array('0' => 'Non', '1' => 'Oui'),
                'multiple' => false,
                'expanded' => true,
                'required' => true,
                //'data' => 'OFFRE',
            ))
            
            ->add('convertStars', 'choice', array(
                'choices' => array('0' => 'Non', '1' => 'Oui'),
                'multiple' => false,
                'expanded' => true,
                'required' => true,
                //'data' => 'OFFRE',
            ))

            ->add('validity', 'choice', array(
                'choices'   => array(
                    "7"    => '1 semaine',
                    "15"    => '2 semaines',
                    "30"   => '1 mois',
                    "60"   => '2 mois',
                    "90"   => '3 mois',
                    "180"   => '2 mois',

                )
                ,'required' => true
                , 'empty_value'=> ''
            ))      
                
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
