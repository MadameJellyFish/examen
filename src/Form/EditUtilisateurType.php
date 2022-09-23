<?php

namespace App\Form;

use App\Entity\User;
use DateTime;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditUtilisateurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $majorYear = (new DateTime())->format('Y')-18;
        $lastYear = (new DateTime())->format('Y')-70;

        $builder
            ->add('email', TextType::class, [
                "disabled" => true,
                'attr' => [
                    'class' => 'my-1',
                    'id' => 'email_input'
                ]
            ])
            ->add('nom', TextType::class, [
                "disabled" => true,
                'attr' => [
                    'class' => 'my-1',
                    'id' => 'nom_input'
                ]
            ])
            ->add('prenom', TextType::class, [
                "disabled" => true,
                'attr' => [
                    'class' => 'my-1',
                    'id' => 'prenom_input'
                ]
            ])
            ->add('date', DateType::class, [
                'years' => range($lastYear, $majorYear),
                'format' => 'dd MM yyyy',
                "disabled" => true,
                'attr' => [
                    'class' => 'my-1',
                    'id' => 'date_input'
                ]
            ])
            ->add('telephone', TextType::class, [
                "disabled" => true,
                'attr' => [
                    'class' => 'my-1',
                    'id' => 'telephone_input'
                ]
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Modifier mon profil',
                'attr' => [
                    "data-id" => "modifier",
                    "class" => "btn btn-outline-secondary"
                ]
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
