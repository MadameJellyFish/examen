<?php

namespace App\Form;

use App\Entity\User;
use DateTime;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EditUtilisateurType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $majorYear = (new DateTime())->format('Y')-18;
        $lastYear = (new DateTime())->format('Y')-70;

        $builder
            ->add('email')
            ->add('nom')
            ->add('prenom')
            ->add('date', DateType::class, [
                'help' => 'Note ici ta date de naissance',
                'years' => range($lastYear, $majorYear)
            ])
            ->add('telephone')
            ->add('submit', SubmitType::class, [
                'label' => 'Envoyer les modifications'
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
