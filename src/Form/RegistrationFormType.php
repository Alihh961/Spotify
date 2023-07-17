<?php

namespace App\Form;

use App\Entity\User;
use App\Form\Type\CompleteAddressType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\CheckboxType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
// use Symfony\Component\Form\Extension\Core\Type\RadioType;
use Symfony\Component\Form\Extension\Core\Type\RepeatedType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Choice;
use Symfony\Component\Validator\Constraints\Email;
// use Symfony\Component\Validator\Constraints\EqualTo;
use Symfony\Component\Validator\Constraints\IsTrue;
// use Symfony\Component\Validator\Constraints\Length;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Regex;

class RegistrationFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email' , EmailType::class, [
                'constraints' => [
                    new Email([
                        'message' => 'Invalid email Format',
                    ])
                ],
            ])
            ->add('userName' , TextType::class, [
                'constraints' => [
                    new Regex([
                        'pattern' => '/^.{3,}$/',
                        'message' => 'The input must contain at least 3 characters.',
                    ]),
                ],
            ])
            ->add('agreeTerms', CheckboxType::class, [
                'mapped' => false, // mapped used to say that data wont be send to database , no column existed to this field
                'constraints' => [
                    new IsTrue([
                        'message' => 'You should agree to our terms.',
                    ]),
                ],
            ])
            ->add('password', RepeatedType::class ,  [
                "type" => PasswordType::class ,
                // instead of being set onto the object directly,
                // this is read and encoded in the controller
                'mapped' => false,
                'first_options'  => ['label' => 'Password'],
                'second_options' => ['label' => 'Repeat Password'],
                "invalid_message" => "passwords dont match",

                'constraints' => [
                    new NotBlank([
                        'message' => 'Please enter a password',
                    ]),
                    
                    new Regex([
                        "pattern" => '/^(?=.*?[A-Z])(?=.*?[a-z])(?=.*?[0-9])(?=.*?[#?!@$ %^&*-]).{8,}$/' ,
                        "message" => 'Password format is invalid.'
                    ])
                ],
            ])
            ->add("gender" , ChoiceType::class ,[
                "constraints" =>  [
                    new NotBlank([
                        "message" => "Field is required"
                    ]),
                    new Choice([
                        "choices" => ["male" ,"female"],
                        "message" => "Enter a valid gender"
                    ])
                    ],
                "choices"=>[
                    "Male" => "male", // Label => Value
                    "Female" => "female"
                ],
                "expanded" => "true" , // render radio type buttons
                // "multiple" => "false"// it is false in default so only one choise can be chosen
                
            ])
            // ->add("test" , CompleteAddressType::class ,
            // ["help" => "looooool"])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
