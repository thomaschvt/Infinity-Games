<?php

namespace InfinityGames\InfinityBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class CommandeType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('ref_commande')
            ->add('date_commande')
            ->add('px_total')
            ->add('date_transaction')
            ->add('retour_paypal')
            ->add('id_utilisateur')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'InfinityGames\InfinityBundle\Entity\Commande'
        ));
    }

    public function getName()
    {
        return 'infinitygames_infinitybundle_commandetype';
    }
}
