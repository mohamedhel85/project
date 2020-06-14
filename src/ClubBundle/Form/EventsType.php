<?php

namespace ClubBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class EventsType extends AbstractType
{

    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder->add('nom')
                ->add('description',TextareaType::class)

                ->add('locationLongitude',HiddenType::class)
                ->add('locationLatitude',HiddenType::class)
                ->add('location', MapType::class, [
                'mapped' => false
            ])
                ->add('date_start',DateTimeType::class,[
                    'attr' => ['class' => 'datepicker'],
                ])
                ->add('date_end',DateTimeType::class)
                ->add('prix')
                ->add('file')
                ->add('maxPlaces');

    }
    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'ClubBundle\Entity\Events'
        ));
    }


    public function getBlockPrefix()
    {
        return 'clubbundle_events';
    }


}
