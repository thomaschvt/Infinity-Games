<?php

namespace InfinityGames\InfinityBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class MessageForumType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre','text', array('label'=>'Titre du topic : '))
            ->add('contenu','textarea', array('label'=>'Contenu du topic : '))
            //->add('date')
            //->add('statut')
            //->add('utilisateur')
        	->add('forum', 'entity', array('class'=>'InfinityGamesInfinityBundle:ForumCategorie','label'=>'Categorie du forum :','required'=>'true'))
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
        return 'infinitygames_infinitybundle_messageforumtype';
    }
}
