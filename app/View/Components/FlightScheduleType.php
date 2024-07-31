<?php

// src/Form/FlightScheduleType.php
namespace App\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType; // إذا كنت تحتاج تاريخ
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FlightScheduleType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('origin', TextType::class, [
                'label' => 'Origin',
                'required' => true, // اجعل الحقل مطلوب
                'attr' => ['placeholder' => 'Enter origin location'], // إضافة نص توضيحي
            ])
            ->add('destination', TextType::class, [
                'label' => 'Destination',
                'required' => true, // اجعل الحقل مطلوب
                'attr' => ['placeholder' => 'Enter destination location'], // إضافة نص توضيحي
            ]);

        // يمكنك إضافة حقل لتاريخ الرحلة إذا لزم الأمر
        // $builder->add('date', DateType::class, [
        //     'label' => 'Date',
        //     'widget' => 'single_text',
        //     'required' => true,
        // ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => null, // تحديد نموذج البيانات إذا كنت تستخدمه
        ]);
    }
}
