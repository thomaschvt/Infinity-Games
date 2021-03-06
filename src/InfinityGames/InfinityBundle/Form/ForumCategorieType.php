<?php

namespace InfinityGames\InfinityBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class ForumCategorieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('intitule')
            ->add('descriptif')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'InfinityGames\InfinityBundle\Entity\ForumCategorie'
        ));
    }

    public function getName()
    {
        return 'infinitygames_infinitybundle_forumcategorietype';
    }
}
