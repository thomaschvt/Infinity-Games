<?php

namespace InfinityGames\InfinityBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ArticlesTodoListType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('contenu','textarea')
            ->add('categorie','choice', array('choices' => array('plateforme' => 'Plate-forme', 'game_logic' => 'Game-Logic','flex' => 'Application Flex','crea' => 'Module de création')))
            ->add('priorite','choice', array('choices' => array('haute' => 'Haute', 'normal' => 'Normal','Basse' => 'Basse')))
            ->add('utilisateur', 'checkbox', array(
            		'label'     => 'Assignation de la tache à soi-même?',
            		'required'  => false,
            ))
            //->add('statut','choice', array('choices' => array('a' => 'Assigné', 'na' => 'Non-assigné')))
            //->add('date')
           // ->add('utilisateur')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'InfinityGames\InfinityBundle\Entity\ArticlesTodoList'
        ));
    }

    public function getName()
    {
        return 'infinitygames_infinitybundle_articlestodolisttype';
    }
}
