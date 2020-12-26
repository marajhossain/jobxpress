<?php

namespace App\Form;

use App\Entity\JobPost;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use App\DependencyInjection\SystemConfigHelper;

class JobPostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $config = new SystemConfigHelper();
        $builder
            ->add('category')
            ->add('company_name')
            ->add('type', ChoiceType::class, [
                'choices' => array_flip($config->getJobType())
            ])
            ->add('position')
            ->add('location')
            ->add('description')
            ->add('logo')
            ->add('total_applied')
            ->add('total_view')
            ->add('poster_email')
            ->add('status', ChoiceType::class, [
                'choices' => array_flip($config->getStatus())
            ])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => JobPost::class,
        ]);
    }
}
