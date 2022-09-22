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
                "disabled" => true
            ])
            ->add('nom', TextType::class, [
                "disabled" => true
            ])
            ->add('prenom', TextType::class, [
                "disabled" => true
            ])
            ->add('date', DateType::class, [
                'years' => range($lastYear, $majorYear),
                'format' => 'dd MM yyyy',
                "disabled" => true
            ])
            ->add('telephone', TextType::class, [
                "disabled" => true
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Modifier mon profil',
                'attr' => [
                    "data-id" => "modifier"
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
