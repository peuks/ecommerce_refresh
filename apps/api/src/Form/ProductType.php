<?php

namespace App\Form;

use App\Entity\Category;
use App\Entity\Product;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\MoneyType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\UrlType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProductType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('label', TextType::class, [
                'label' => 'Nom du Produit',
                // Tous les attributs html
                'attr' => [
                    'placeholder' => 'Tapez le nom du produit',
                ]
            ])
            ->add('shortDescription', TextareaType::class, [
                'attr' => [
                    'placeholder' => 'Tapez une description assez courte.'
                ]
            ])
            ->add('price', MoneyType::class, [
                'label' => 'Prix du produit ',
                'attr' => [
                    'placeholder' => 'Inscrivez le montant en € '
                ],
                'divisor' => 100
            ])
            ->add('mainPicture', UrlType::class, [
                'label' => 'Url de la photo ',
                'attr' => [
                    'placeholder' => 'Insérer l\'url de votre image'
                ]
            ])
            ->add('category', EntityType::class, [
                'label' => 'Catégorie',
                'attr' => ['class' => 'form-control'],
                'placeholder' => '--Choisir une catégorie--',
                'class' => Category::class,
                'choice_label' => 'label'

            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Product::class,
        ]);
    }
}
