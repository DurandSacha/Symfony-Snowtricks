<?php

namespace App\Form\TypeExtension;

use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormTypeExtensionInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;


/**
 * @method iterable getExtendedTypes()
 */
class TextareaSizeExtension implements FormTypeExtensionInterface
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // TODO: Implement buildForm() method.
    }

    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['attr']['rows'] = 10;
    }

    public function finishView(FormView $view, FormInterface $form, array $options)
    {
        // TODO: Implement finishView() method.
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        // TODO: Implement configureOptions() method.
    }

    public function getExtendedType()
    {
        return TextareaType::class;
    }

    public function __call($name, $arguments)
    {
        // TODO: Implement @method iterable getExtendedTypes()
    }
}
