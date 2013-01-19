<?php

namespace InfinityGames\InfinityBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ArticlesFactoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('titre')
            ->add('contenu')
            ->add('id_categorie', 'entity', array('class'=>'InfinityGamesInfinityBundle:CategorieFactory','label'=>'Categorie :','required'=>'true'))
            ->add('statut', 'choice', array('choices' => array('actif' => 'Actif', 'inactif' => 'Inactif')));
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'InfinityGames\InfinityBundle\Entity\ArticlesFactory'
        ));
    }

    public function getName()
    {
        return 'infinitygames_infinitybundle_articlesfactorytype';
    }
}
