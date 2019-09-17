<?php

namespace App\Form;

use App\Entity\Tricks;
use App\Entity\Category;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\FileType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
use Symfony\Component\Form\FormView;


class addTricksFormType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('name', TextType::class, [
                'help' => 'Choose a name for your exceptional tricks!'
            ])
            ->add('description', TextType::class, [
                'help' => 'Make a description'
            ])
            ->add('categoryTricks', EntityType::class, [
                'class' => Category::class,
                'help' => 'select a category',
                'placeholder' => 'different category',
                'choice_label' => function(Category $category) {
                    return sprintf('(%d) %s', $category->getId(), $category->getName());
                },

            ])

            ->add('Illustration', CollectionType::class, [
                'entry_type' => PictureFormType::class,
                'allow_add' => true,
                'allow_delete' => true,
                'required'   => false,
                'prototype' => true,

            ])

            ->add('Embed', CollectionType::class, [
                'entry_type' => EmbedType::class,
                /*'help' => ' example : <embed src="https://www.youtube.com/watch?v=1BjgBoummtE" autostart="false" height="30%" width="40%" />',*/
                'required' => false,
                'prototype' => true,
                'allow_add' => true,
                'allow_delete' => true,
                'mapped' => false,

            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => Tricks::class
        ]);
    }

}


