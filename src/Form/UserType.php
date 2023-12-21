<?php

namespace App\Form;

use App\Entity\User;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Validator\Constraints\Image;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\PasswordType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('nom',TextType::class,[
                'label' => 'Nom :'
                ])
            ->add('prenom',TextType::class,[
                'label' => 'Prenom :'
                ])
            ->add('email',EmailType::class,[
                'label' => 'Email :'
            ])
            ->add('password',  PasswordType::class,[
                'label' => 'Mot de Passe :', 
            ])
            ->add('telephone', NumberType::class, [
                'label' => 'Telephone:', 
            ])
            ->add('aPropos', TextareaType::class,[
                'label' => 'A propos de vous :', 
            ])
            ->add('instagram', TextType::class, [
                'label' => 'Instagram :', 
            ])
            ->add('picture', FileType::class,[
                'label' => 'Image de Profile :',
                // 'required' => $options['new_user'],
                'mapped' => false,
                'constraints' => [
                    new Image([
                        'mimeTypes' => [
                            'image/jpeg',
                            'image/png',
                            'image/gif',
                        ],
                        'mimeTypesMessage' => "Veuillez télécharger une image valide",
                        "maxSize" => '2M',
                        'maxSizeMessage' => "Votre image fait {{size}} {{suffix}}, La limite est de {{ limit }} {{suffix}}"
                        ]),
                    ]
                ])
            // ->add('roles')
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
