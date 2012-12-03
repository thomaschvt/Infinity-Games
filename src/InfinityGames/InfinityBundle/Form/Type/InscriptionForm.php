<?php

namespace InfinityGames\InfinityBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;

class InscriptionForm extends BaseType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        parent::buildForm($builder, $options);

        // add your custom field
        $builder->add('nom', 'text', array('label'=>'Votre nom'));
        $builder->add('prenom', 'text', array('label'=>'Votre prenom'));
        $builder->add('avatarUrl', 'file', array('label'=>'Votre avatar'));
    }

    public function getName()
    {
        return 'InscriptionForm';
    }
}
