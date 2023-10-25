<?php

namespace App\Form;

use App\Entity\OrderFood;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\DateTimeType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class OrderFoodType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('Bill')
            ->add('Food')
            ->add('OrderDate', DateTimeType::class, [
                'years' => range(2023, 2100)
            ])
            ->add('Quantity', IntegerType::class, ['data' => 1])
            ->add('OrderPrice');
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => OrderFood::class,
        ]);
    }
}
