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
            ->add('gouv', 'entity', array('class' => 'StarAnnoncesBundle:Gouv','empty_value' => ''))
            ->add('deleg', 'entity', array('class' => 'StarAnnoncesBundle:Deleg','empty_value' => ''))
            ->add('locality', 'entity', array('class' => 'StarAnnoncesBundle:Locality','empty_value' => ''))
            ->add('title')
            ->add('description')
            ->add('price')
            
            // ->add('createdAt')
            //->add('updatedAt')
        ;
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
