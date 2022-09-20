<?php

namespace App\Form;

use App\Entity\Competence;
use App\Entity\Examen;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CompetenceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Examen', EntityType::class, [
                'class'  => Examen::class,
                'choice_label' => 'ville' // choice_label correspond au nom de chacun de mes choix  
            ]);

            // ->add('ville', TextType::class, ['mapped' => false])
            // ->add('date', DateType::class, ['mapped' => false]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Competence::class
        ]);
    }
}
