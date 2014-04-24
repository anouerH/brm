<?php

namespace Star\UserBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\ProfileFormType as BaseType;

class ProfileFormType extends BaseType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        // add your custom field
        $builder
            ->add('civility', 'choice', array(
                'choices' => array('MR' => 'Mr', 'MLLE' => 'Mlle', 'MME' => 'Mme'),
                'multiple' => false,
                'expanded' => true,
            ));


        $builder->add('firstname');
        $builder->add('lastname');

        $builder->add('birthdate', 'date', array(
                'widget' => 'single_text',
                // this is actually the default format for single_text
                'format' => 'yyyy-MM-dd',
                'required'   => false
            ));

        $builder
            ->add('userType', 'choice', array(
                'choices' => array('PARTICULIER' => 'Particulier', 'PROFESSIONNEL' => 'Professionnel'),
                'multiple' => false,
                'expanded' => true,
                'required'   => false
            ));

        $builder->add('function');

        $builder->add('sector', 'entity', array('class'      => 'StarAnnoncesBundle:Sector'
                                   , 'required'   => false
                                   , 'empty_value'=> ''));
        

        $builder->add('adress');


        $builder->add('country', 'entity', array('class'      => 'StarAnnoncesBundle:Country'
                                   , 'required'   => false
                                   , 'empty_value'=> ''));



        $builder->add('mobile');
        $builder->add('phone');
        $builder->add('fax');
        
        
    }

    public function getName()
    {
        return 'star_user_profile';
    }
}