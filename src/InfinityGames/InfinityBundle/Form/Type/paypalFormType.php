<?php

namespace InfinityGames\InfinityBundle\Form\Type;

use Symfony\Component\Form\FormBuilderInterface;

class paypalForm extends AbstractType
{
	public function buildForm(FormBuilderInterface $builder, array $options)
	{
		parent::buildForm($builder, $options);

		
		$builder->add('nom', 'text', array('label'=>'Votre nom'));
		$builder->add('prenom', 'text', array('label'=>'Votre prenom'));
		
	}

	public function getName()
	{
		return 'paypalForm';
	}
}
