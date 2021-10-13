<?php

use App\Form\DataTransformer\CentimesTransformer;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class PriceType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        // si false ne rien faire , si vraie refaire 
        return ($options['divisor'] === false) ?: $builder->addModelTransformer(new CentimesTransformer);
    }

    public function getParent()
    {
        // On est en filliation avec Numbertype . Notre champ s'inspire de NumberType
        return NumberType::class;
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            // Set devide option from moneytype to true by default
            'divisor' => true
        ]);
    }
}
