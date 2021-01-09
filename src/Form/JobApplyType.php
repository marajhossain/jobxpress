<?php
namespace App\Form;

use App\Entity\JobApply;
use Symfony\Component\Form\AbstractType;
// use App\DependencyInjection\SystemConfigHelper;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\File;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\TextType;

class JobApplyType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
        ->add('name', TextType::class, [
            'required' => true,
        ])
        ->add('source', TextType::class, [
            'required' => true,
        ])
        ->add('email', TextType::class, [
            'required' => true,
        ])
        ->add('resume', FileType::class, [
            'mapped' => false,
            'required' => false,
            'constraints' => [
               new File([
                   'maxSize' => '1024k',
                   'mimeTypes' => [
                        'application/pdf',
                        'application/x-pdf',
                   ],
                   'mimeTypesMessage' => 'Please upload a valid file',
               ])
           ],
       ])
        ->add('phone', TextType::class, [
            'required' => true,
        ])
        ->add('employer')
        ->add('source')
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => JobApply::class,
        ]);
    }

}