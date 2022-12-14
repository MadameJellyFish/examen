<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom', options: [
                "label" => "Nom : ",
                "attr" => ["class" => "inputStyle inputClassic form-control-mb4"],
                'label_attr' => ["class" => ""]
            ])
            ->add('prenom', options: [
                "label" => "Prenom : ",
                "attr" => ["class" => "inputStyle inputClassic form-control-mb4"],
                "label_attr" => ["class" => ""]
            ])
            ->add('date', options: [
                "label" => "Date de naissance : ",
                "attr" => ["class" => "form-control-mb4"],
                "label_attr" => ["class" => ""],
                "years"=>range(date('Y'), date('Y')-100)
            ])
            ->add('telephone', options: [
                "label" => "Téléphone : ",
                "attr" => ["class" => "inputStyle inputClassic"],
                "label_attr" => ["class" => ""]
            ])
            ->add('email', options: [
                "label" => "Email : ",
                "attr" => ["class" => "inputStyle inputClassic form-control-mb4 mail"],
                "label_attr" => ["class" => ""]
            ])

            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'Tu dois accepter nos conditions.',
                    ]),
                ],
            ])
            ->add('plainPassword', PasswordType::class, [
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'attr' => ['autocomplete' => 'Nouveau-mot-de-passe'],
                'constraints' => [
                    new NotBlank([
                        'message' => 'Veuillez entrer un mot de passe',
                    ]),
                    new Length([
                        'min' => 6,
                        'minMessage' => 'Ton mot de passe doit être au moins {{ limit }} caractères',
                        // max length allowed by Symfony for security reasons
                        'max' => 4096,
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
