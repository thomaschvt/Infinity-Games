<?php

namespace InfinityGames\InfinityBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class GenreJeuType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('intitule',  'text', array('label'=>'Nom du genre : '))
            ->add('descriptif',  'textarea', array('label'=>'Descriptif du genre : '))
            ->add('visuPicto', 'file', array('label'=>'Pictogramme lié : '))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'InfinityGames\InfinityBundle\Entity\GenreJeu'
        ));
    }

    public function getName()
    {
        return 'infinitygames_infinitybundle_genrejeutype';
    }
}
