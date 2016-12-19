<?php

namespace AppBundle\Form;

use AppBundle\Entity\Superpower;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class SuperpowerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, ['label' => 'Názov'])
            ->add('description', TextareaType::class, ['label' => 'Popis'])
            ->add('submit', SubmitType::class, ['label' => 'Uložiť']);

        return $builder;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(['data_class' => Superpower::class]);
    }

    public function getName()
    {
        return 'app_bundle_superpower_type';
    }
}
