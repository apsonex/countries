<?php

namespace Apsonex\Countries\Actions;

class SeedCountryAction
{

    public static function execute(string $country)
    {
        $class = str("seed {$country} Action")->studly()->prepend("\Apsonex\Countries\Actions\\")->toString();

        if (class_exists($class)) {
            $class::seed();
        }
    }

}