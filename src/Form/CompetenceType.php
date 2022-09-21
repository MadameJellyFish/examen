<?php

namespace App\Form;

use App\Entity\Competence;
use App\Entity\Examen;
use App\Entity\Inscription;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class CompetenceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('id', HiddenType::class,)
            ->add('Examen', EntityType::class, [
                'class'  => Examen::class, 
                'mapped' => false,
                'choice_label' => 'ville', // choice_label correspond au nom de chacun de mes choix  
                // une fonction calllback qui affiche que les examens (ville et date) associe à la competence et test 
              
                'query_builder' => function (EntityRepository $er) {
                    return $er->createQueryBuilder('u')
                        ->orderBy('u.username', 'ASC');
                },

                // 'choices' => [
                //     $examen->getVille() => [
                //         'Date' => $examen->getDate(), 
                //     ],

                    //  'choice_label' => function(?Examen $examen) {
                    //    return $examen ? strtoupper($examen->getVille()): '';
                    // },

                

                    // 'choice_label' => function(?Competence $competence) {
                    // return $competence ? strtoupper($competence->getExamens()): '';
                    // }
                    ]);

                //     'choices' => function(?Examen $examen) {
                //        return  [
                //             $examen->getVille() => [
                //                 'Date' => $examen->getDate(), 
                //             ]];
                //     }

                // 'choice_label' => function(?Examen $examen) {
                //     return $examen ? strtoupper($examen->getVille(), $examen->getDate()) : '';
                // },
                
                // 'choice_label' => function(?Examen $examen) {
                //     return $examen ? strtoupper($examen->getDate()) format : 'yyyy-MM-dd';
                // },
            // ]);

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
