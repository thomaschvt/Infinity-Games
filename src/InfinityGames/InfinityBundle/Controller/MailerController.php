<?php

namespace InfinityGames\InfinityBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Bundle\SwiftmailerBundle\SwiftmailerBundle;
use InfinityGames\InfinityBundle\Form\MailFormType;

use Symfony\Component\HttpFoundation\Request;



class MailerController extends Controller
{
    public function indexAction(Request $request)
    {
    	//appel la fonction de creation de mail
    	$formMail = $this->createMailForm();
    
    	
    	if ($this->getRequest()->getMethod() == 'POST') {
    		$formMail->bind($request);
    		
	    	if ($formMail->isValid()) {
	    		$name = "toto";
	    		$message = \Swift_Message::newInstance()
	    		->setSubject('Hello Email')
	    		->setFrom('send@example.com')
	    		->setTo('thomaschvt@gmail.com')
	    		->setBody(
	    				$name
	    		);
	    		
	    		$this->get('mailer')->send($message);
	    		 
	    		
	    		/*$mail = new sfMail();
	    		$mail->addAddress($this->getRequestParameter('thomaschvt@gmail.com'));
	    		$mail->setFrom('InfinityGames <bob.com>');
	    		$mail->setSubject('re');
	    		
	    		$mail->setPriority(1);	
	    		$this->mail = $mail;
	    		
	    		return $this->render('InfinityGamesInfinityBundle:Contact:contact.html.twig', array(
	    				'formMail' => $formMail->createView(),
	    		));*/
	    		
	    	}
    	}
    	
    	return $this->render('InfinityGamesInfinityBundle:Contact:contact.html.twig', array(          
            'formMail' => $formMail->createView(),
        ));
    	
    }
    
    private function createMailForm()
    {
    	return $this->createFormBuilder()
    	->add('nom', 'text', array('label'=>'Votre nom','attr'=> array('class'=>'inp_mail_form')))
        ->add('prenom', 'text', array('label'=>'Votre prénom','attr'=> array('class'=>'inp_mail_form')))
        ->add('email', 'text', array('label'=>'Votre email','attr'=> array('class'=>'inp_mail_form')))
        ->add('objet', 'text', array('label'=>'Objet','attr'=> array('class'=>'inp_mail_form')))
        ->add('contenu','textarea',array('label'=>'Votre message'))
    	->getForm()
    	
    	;
    }
}
