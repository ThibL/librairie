<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                "label" => "Nom",
                "attr" => [
                    "placeholder" => "Entrez votre nom",
                    "class" => "form-control"
                ]
            ])
            ->add('email', EmailType::class, [
                "label" => "Email",
                "attr" => [
                    "placeholder" => "Entrez votre email",
                    "class" => "form-control"
                    ]
                ])
            ->add('hash', PasswordType::class, [
                "label" => "Mot de passe",
                "attr" => [
                    "placeholder" => "Mot de passe",
                    "class" => "form-control"
                ]
            ])
            ->add('passwordConfirm', PasswordType::class, [
                "label" => "Confirmez votre mot de passe",
                "attr" => [
                    "placeholder" => "Confirmez votre mot de passe",
                    "class" => "form-control"
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
