<?php

namespace InfinityGames\InfinityBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class JeuType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('nom', 'text', array('label'=>'Nom du jeu'))
            //->add('note')
            //->add('createdat')
            //->add('updateda')
            ->add('visuelImg','file', array('label'=>'Visuel du jeu'))
            ->add('destIndex', 'text', array('label'=>'Url de la page du jeu'))
            ->add('utilisateurUtilisateur','entity', array('class'=>'InfinityGamesInfinityBundle:Utilisateur','label'=>'Auteur du jeu','required'=>'true'))
            ->add('genreJeuGenreJeu','entity', array('class'=>'InfinityGamesInfinityBundle:GenreJeu','label'=>'Type du jeu','required'=>'true'))
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'InfinityGames\InfinityBundle\Entity\Jeu'
        ));
    }

    public function getName()
    {
        return 'infinitygames_infinitybundle_jeutype';
    }
}
