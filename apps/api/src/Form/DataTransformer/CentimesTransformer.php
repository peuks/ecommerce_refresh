<?php

namespace App\Form\DataTransformer;

use Symfony\Component\Form\DataTransformerInterface;

/**
 * Permet de convertir les centimes en € et inversement lorsqu'on intérragit avec la BDD
 * La monnaie est stockée en centimes et affichée € grace à la  transform() et inversement avec trverseTransforme 
 */
class CentimesTransformer implements DataTransformerInterface
{
    public function transform($value)
    {
        // Si je reçois quelque chose , diviser par 100 pour l'afficher en €
        return (null === $value) ?: $value / 100;
    }

    public function reverseTransform($value)
    {

        return (null === $value) ?: $value * 100;
    }
}
