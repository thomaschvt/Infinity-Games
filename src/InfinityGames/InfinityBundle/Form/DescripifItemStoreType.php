<?php

namespace InfinityGames\InfinityBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class DescripifItemStoreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('intitule')
            ->add('statut')
            ->add('descriptif')
            ->add('prix','text', array('label'=>'Prix de l\'objet en crédits'))
            ->add('dureeTemps')
            ->add('typeItem', 'entity', array('class'=>'InfinityGamesInfinityBundle:TypeItemStore','label'=>'Type :','required'=>'true'))
            //->add('idUtilisateur')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'InfinityGames\InfinityBundle\Entity\DescripifItemStore'
        ));
    }

    public function getName()
    {
        return 'infinitygames_infinitybundle_descripifitemstoretype';
    }
}
