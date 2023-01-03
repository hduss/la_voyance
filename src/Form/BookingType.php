<?php

namespace App\Form;

use App\Entity\Reservation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\EmailType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\TelType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TimeType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Validator\Constraints\Email;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Range;

class BookingType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {

        $now = new \DateTime('now');
        $builder
            ->add('name', TextType::class, [
                'required' => true,
                'label' => 'Prénom',
                'constraints' => [new NotBlank()]
            ])
            ->add('lastname', TextType::class, [
                'required' => true,
                'label' => 'Nom de Famille',
                'constraints' => [new NotBlank()]

            ])
            ->add('email', EmailType::class, [
                'required' => true,
                'label' => 'Adresse mail',
                'constraints' => [
                    new NotBlank(),
                    new Email([
                    'mode' => 'strict',
                ])]
            ])
            ->add('phone', TelType::class, [
                'required' => true,
                'label' => 'Numéro de téléphone'
            ])
            ->add('timeTest', TimeType::class, [
                'mapped' => false
            ])
            ->add('dateTest', DateType::class, [
                'mapped' => false
            ])
            ->add('date', DateTimeType::class, [
                'data' => $now,
                'attr' => ['min' => $now],
                'constraints' => [
                    new NotBlank(),
                    new Range(['max' => 'today'])
                ],
                'date_widget' => 'single_text',
                'date_label' => 'Date',
                'time_widget' => 'choice',
                'time_label' => 'Heure',
                'view_timezone' => 'Europe/Paris',
                'required' => true
            ])
//            ->add('prestation')
            ->add('submit', SubmitType::class, [
                'label' => 'Réserver la consultation'
//                'mapped' => false
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Reservation::class,
        ]);
    }
}
