<?php

namespace  ClubBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\Form\FormView;
use Symfony\Component\OptionsResolver\OptionsResolver;

class MapType extends AbstractType
{

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'longitude' => null,
            'latitude' => null
        ]);

        $resolver->setAllowedTypes('longitude', ['null', 'float']);
        $resolver->setAllowedTypes('latitude', ['null', 'float']);
    }

    public function buildView(FormView $view, FormInterface $form, array $options)
    {
        $view->vars['longitude'] = $form->getParent()->get('locationLongitude')->getData();;
        $view->vars['latitude'] = $form->getParent()->get('locationLatitude')->getData();;
    }
}
