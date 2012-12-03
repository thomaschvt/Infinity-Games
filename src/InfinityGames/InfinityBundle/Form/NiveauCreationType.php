<?php

namespace InfinityGames\InfinityBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class NiveauCreationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('limiteHaute')
            ->add('intitule')
            ->add('visuNiveau')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'InfinityGames\InfinityBundle\Entity\NiveauCreation'
        ));
    }

    public function getName()
    {
        return 'infinitygames_infinitybundle_niveaucreationtype';
    }
}
