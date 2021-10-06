<?php

namespace App\Services\Taxes;

/**
 * Simple TaxCalculator
 */
class Calculator
{
    protected $tva;

    public function __construct(float $tva = 20)
    {
        $this->tva = $tva;
    }

    /**
     * Renvoyer le montant de la taxe d'un prix TVA
     * Exemple: calcul(100)  120
     *
     * @param float $prix
     * @param float $tva
     * @return float prix HT
     */
    public function calcul(float $prix): float
    {
        return $prix * 20 / 100;
    }
}
