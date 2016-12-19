<?php

namespace AppBundle\Form;

use AppBundle\Entity\Astronaut;
use AppBundle\Entity\Superpower;
use Doctrine\Bundle\DoctrineBundle\Registry;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\CallbackTransformer;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class AstronautType extends AbstractType
{

    protected $doctrine;

    public function __construct(Registry $doctrine)
    {
        $this->doctrine = $doctrine;
    }

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('first_name', TextType::class)
            ->add('last_name', TextType::class)
            ->add('date_of_birth', DateType::class, ['years' => range(1960, 2000)])
            ->add('superpower', EntityType::class, [
                'class' => Superpower::class,
                'choice_label' => 'name',
                'expanded' => false,
                'multiple' => false,
                'choices' => $this->doctrine->getRepository(Superpower::class)->findBy(['deleted' => false])
            ])
            ->add('deleted', CheckboxType::class, ['required' => false])
            ->add('in_service', CheckboxType::class, ['required' => false])
            ->add('submit', SubmitType::class, ['label' => 'Uložiť'])
            ->getForm();

        return $builder;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(['data_class' => Astronaut::class]);
    }

    public function getName()
    {
        return 'app_bundle_astronaut_type';
    }
}
