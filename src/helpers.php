<?php


if (!function_exists('countries')) {

    function countries(): \Apsonex\Countries\Countries
    {
        return app()->has(\Apsonex\Countries\Countries::class) ?
            app()->get(\Apsonex\Countries\Countries::class) :
            app()->make(\Apsonex\Countries\Countries::class);
    }

}