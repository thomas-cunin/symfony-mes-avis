<?php

namespace App\Form;

use App\Entity\Subscription;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

class SubscriptionType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $label = 'Créer';
        if ($options['sub']) {
            $label = 'Modifier';
        }
        $builder
            ->add('label', TextType::class, [
                'label' => 'Nom de l\'offre'
            ])
            ->add('capacity', TextType::class, [
                'label' => 'Capacité de l\'offre'
            ])
            ->add('price', NumberType::class, [
                'label' => 'Prix de l\'offre'
            ])
            ->add('submit', SubmitType::class, [
                'label' => $label
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Subscription::class,
            'sub' => null,
        ]);
    }
}
