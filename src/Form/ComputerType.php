<?php

namespace App\Form;

use App\Entity\Computer;
use App\Entity\Departement;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\TextType;


class ComputerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder

            ->add('macAdress', TextType::class, array('attr' => array(
            'placeholder' => 'macAdress here'
            )))

            ->add('model')
            ->add('system')
            ->add('purchase')
            /*
            ->add('idDepartement',EntityType::class,[
                'class'=>Departement::class,
                'choice_label'=> 'domain',
                'multiple' => false,
                'expanded' => true
            ])
            */
            ->add('ajouter_computer',SubmitType::class)
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Computer::class,
        ]);
    }

   
}
