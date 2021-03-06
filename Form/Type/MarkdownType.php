<?php

namespace Ornj\Bundle\MarkdownBundle\Form\Type;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;

class MarkdownType extends AbstractType
{
    /**
     * {@inheritdoc}
     */
    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars = array_replace($view->vars, array(
            'show_help' => $options['show_help']
        ));
    }

    /**
     * {@inheritdoc}
     */
    public function configureOptions(OptionsResolver $resolver) {
        $this->setDefaultOptions($resolver);
    }
    /**
     * {@inheritdoc}
     */
    public function setDefaultOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'attr'              => array(
                'class'         => '',
                'data-provide'  => 'markdown',
                'rows'          => 15,
            ),
            'show_help' => false
        ));
    }

    public function getParent()
    {
        if (!method_exists('Symfony\Component\Form\AbstractType', 'getBlockPrefix')) {
            return 'textarea';
        } else {
            return TextareaType::class;
        }
    }

    public function getBlockPrefix()
    {
        return 'markdown';
    }
    public function getName() {
        return $this->getBlockPrefix();
    }
}
