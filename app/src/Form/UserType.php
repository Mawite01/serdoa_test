<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\NotBlank;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
        ->add('first_name', TextType::class, [
            'label' => 'First Name',
            'constraints' => [
                new NotBlank([
                    'message' => 'Please enter your first name',
                ]),
            ],
        ])
        ->add('last_name', TextType::class, [
            'label' => 'Last Name',
            'constraints' => [
                new NotBlank([
                    'message' => 'Please enter your last name',
                ]),
            ],
        ])
        ->add('address', TextType::class, [
            'label' => 'Address',
            'constraints' => [
                new NotBlank([
                    'message' => 'Please enter your address',
                ]),
            ],
        ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
