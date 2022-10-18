<?php

namespace Sashagm\Payment\Actions;

class CheckBonus
{
    public function getBonus($sum)
    {
        if($sum > 499 AND $sum < 1000 ){
            $sum = $this->percent_rate($sum, 5); //от 500 +5%
        }
        elseif($sum > 999 AND $sum < 2000 ){
            $sum = $this->percent_rate($sum, 10); //от 1к +10%
        }
        elseif($sum > 1999 AND $sum < 3500 ){
            $sum = $this->percent_rate($sum, 15); //от 2к +15%
        }
        elseif($sum > 3499 AND $sum < 5000 ){
            $sum = $this->percent_rate($sum, 20); //от 2к +20%
        }
        elseif($sum > 4999 AND $sum < 7500 ){
            $sum = $this->percent_rate($sum, 25); //от 5k +25%
        }
        elseif($sum > 7499 AND $sum < 10000 ){
            $sum = $this->percent_rate($sum, 30); //от 7.5k +30%
        }
        elseif($sum > 9999 AND $sum < 12500 ){
            $sum = $this->percent_rate($sum, 35); //от 10k +35%
        }
        elseif($sum > 12499 AND $sum < 15000){
            $sum = $this->percent_rate($sum, 40); //от 12.5k +40%
        }
        elseif($sum > 14999 AND $sum < 95000){
            $sum = $this->percent_rate($sum, 50); //от 15к +50%
        }				
        else {
            $sum = $sum; // до 500 +0%
        }        
    }

    public function percent_rate($number, $percent) 
    {
        // Подсчёт бонуса 
        $number_percent = $number / 100 * $percent;
        return $number + $number_percent;
        
    }

}