<?php

namespace App\Form;

use App\Entity\JobPost;
use Symfony\Component\Form\AbstractType;
use App\DependencyInjection\SystemConfigHelper;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;

class JobPostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $config = new SystemConfigHelper();
        $builder
            ->add('company_name', TextType::class, [
                'required' => true,
            ])
            ->add('type', ChoiceType::class, [
                'choices' => array_flip($config->getJobType())
            ])
            ->add('logo', FileType::class, [
                // unmapped means that this field is not associated to any entity property
                'mapped' => false,
                'required' => false,
                'constraints' => [
                   new File([
                       'maxSize' => '1024k',
                       'mimeTypes' => [
                           'image/jpeg',
                           'image/png',
                       ],
                       'mimeTypesMessage' => 'Please upload a valid Image',
                   ])
               ],
           ])
            ->add('position')
            ->add('location')
            ->add('category')
            ->add('description')
            
            // ->add('total_applied')
            // ->add('total_view')
            ->add('poster_email')
            // ->add('status', ChoiceType::class, [
            //     'choices' => array_flip($config->getStatus())
            // ])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => JobPost::class,
        ]);
    }
}
