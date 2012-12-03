<?php

namespace InfinityGames\InfinityBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MessageInterneType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titreMessage','text', array("label"=>"Objet de votre message", 'required'=>'true'))
            ->add('contenuMessage','textarea', array("label"=>"Votre message", 'required'=>'true'))
            ->add('destinataire', 'entity', array('class'=>'InfinityGamesInfinityBundle:Utilisateur','label'=>'Destinataire de votre message','required'=>'true'))
            //->add('expediteur')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'InfinityGames\InfinityBundle\Entity\MessageInterne'
        ));
    }

    public function getName()
    {
        return 'infinitygames_infinitybundle_messageinternetype';
    }
}
