<?php

namespace InfinityGames\InfinityBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class TypeItemStoreType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('intitule')
            ->add('descriptif')
            // ->add('id_parent', 'entity', array('class'=>'InfinityGamesInfinityBundle:TypeItemStore','label'=>'Destinataire de votre message','required'=>'false'))
            
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'InfinityGames\InfinityBundle\Entity\TypeItemStore'
        ));
    }

    public function getName()
    {
        return 'infinitygames_infinitybundle_typeitemstoretype';
    }
}
