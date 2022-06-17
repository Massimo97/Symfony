<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Post;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PostType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'attr' => [
                    'placeholder' => 'Titre',
                    'class' => 'nm-inset-gray-50 rounded-md py-2 px-4 w-full'
                ],
                'label' => false,
            ])
            ->add('category', EntityType::class, [
                'class' => Category::class,
                'choice_label' => 'name',
                'choice_value' => 'id',
                'label' => false,
                'attr' => [
                    'class' => 'nm-inset-gray-50 rounded-md py-2 px-4 w-64'
                ],
            ])
            ->add('text', TextareaType::class, [
                'attr' => [
                    'placeholder' => 'Contenu',
                    'class' => 'nm-inset-gray-50 rounded-md py-2 px-4 w-full'
                ],
                'label' => false,
            ])
            ->add('save', SubmitType::class, [
                'attr' => [
                    'class' => 'nm-convex-green-400-sm hover:nm-concave-green-400-sm rounded-xl py-2 px-4 w-5/20 font-extrabold text-white font-roboto self-end',
                ],
                'label' => 'Créer',
            ])
            ;
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Post::class,
        ]);
    }
}
