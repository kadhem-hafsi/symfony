<?php

namespace App\Form;

use App\Entity\Departement;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;


class DepartementType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('name')   
            ->add('domain',ChoiceType::class, array(
                    'choices' => array(
                        'informatique' => 'info',
                        'mecanique' => 'mec',
                        'gestion' => 'gest',
                    ),
                    'expanded' => false,
                    'multiple' => false
                    ))
                    

            ->add('ajouter_departement',SubmitType::class)
            ->add('Moddifer_departement',SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Departement::class,
        ]);
    }
}
