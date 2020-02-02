<?php

namespace App\Form;

use App\Entity\Activitys;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\IsTrue;
use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;

class ActivityFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $user = new \App\Entity\User();
        $builder
            ->add('title')
            ->add('description')
            ->add('link')
            ->add('prices')
            ->add('address') 
            ->add('ville') 
            ->add('img')
            ->add('postcode')
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false,
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Activitys::class,
        ]);
    }
}
