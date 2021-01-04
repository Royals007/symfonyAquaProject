<?php


namespace AppBundle\Form;


use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;

class EditUserFormType extends AbstractType
{

	public function buildForm(FormBuilderInterface $builder, array $options){
		$builder
			->add('roles', ChoiceType::class,[
				'multiple' => true,
				'expanded' => true, // render check-boxes
				'choices' => ['Admin' => 'ROLE_ADMIN',
					'Manager' => 'ROLE_MANAGER'
				]
			])
			// fields add ...
		;
	}


}