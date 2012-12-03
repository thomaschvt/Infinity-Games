<?php

namespace InfinityGames\InfinityBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ReponseTopicForumType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            //->add('titre')
            ->add('contenu', 'textarea', array('label'=>'Votre texte'))
            //->add('date')
            //->add('statut')
            //->add('utilisateur')
            //->add('forum')
            //->add('idParent')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'InfinityGames\InfinityBundle\Entity\MessageForum'
        ));
    }

    public function getName()
    {
        return 'infinitygames_infinitybundle_reponsetopictype';
    }
}
