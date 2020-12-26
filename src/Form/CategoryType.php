<?php

namespace App\Form;

use App\Entity\Category;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use App\DependencyInjection\SystemConfigHelper;

class CategoryType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $config = new SystemConfigHelper();
        // print_r($config->getStatus());
        $builder
            ->add('name')
            ->add('status', ChoiceType::class, [
                'choices' => array_flip($config->getStatus())
            ])
            // ->add('created_by')
            // ->add('created_time')
            // ->add('updated_by')
            // ->add('updated_time')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Category::class,
        ]);
    }
}
