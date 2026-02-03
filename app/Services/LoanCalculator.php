<?php

namespace App\Services;

class LoanCalculator
{
    public static function emi($principal, $rate, $months)
    {
        $r = $rate / 12 / 100;

        if ($r == 0) {
            return round($principal / $months, 2);
        }

        $emi = $principal * $r * pow(1 + $r, $months)
            / (pow(1 + $r, $months) - 1);

        return round($emi, 2);
    }
}
