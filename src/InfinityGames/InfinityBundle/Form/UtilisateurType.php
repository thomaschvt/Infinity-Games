<?php

namespace InfinityGames\InfinityBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;
use FOS\UserBundle\Form\Type\RegistrationFormType as BaseType;

class UtilisateurType extends BaseType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
    	parent::buildForm($builder, $options);
    	
        $builder
            ->add('username','text', array('label'=>'Votre identifiant'))
            //->add('usernameCanonical')
            ->add('email', 'email', array('label'=>'Votre e-mail'))
            //->add('enabled')
            //->add('salt')
            ->add('plainPassword', 'repeated', array(
                'type' => 'password',
                'options' => array('translation_domain' => 'FOSUserBundle'),
                'first_options' => array('label' => 'Votre mot de passe'),
                'second_options' => array('label' => 'Confirmation de votre mot de passe'),
                'invalid_message' => 'fos_user.password.mismatch',
            ))
            //->add('lastLogin')
            //->add('locked')
            //->add('expired')
			//->add('expiresAt')
            //->add('confirmationToken')
            //->add('passwordRequestedAt')
            //->add('roles')
            //->add('credentialsExpired')
//             ->add('credentialsExpireAt')
            ->add('prenom', 'text', array('label'=>'Votre prnom'))
            ->add('nom', 'text', array('label'=>'Votre nom'))
            ->add('avatarUrl', 'file', array('label'=>'Votre avatar'))
            //->add('highScore')
            //->add('experience')
            //->add('nbrCreation')
            //->add('mdp')
            //->add('credits')
            //->add('statutDeveloppeur')
            //->add('bonusBlasonId')
            //->add('idItemStore')
        ;
    }

    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'InfinityGames\InfinityBundle\Entity\Utilisateur'
        ));
    }

    public function getName()
    {
        return 'infinitygames_infinitybundle_utilisateurtype';
    }
}
