<?php

namespace Apsonex\Countries\Exceptions;

class CouldNotGeocode extends \Exception
{

    public static function couldNotConnect(): string
    {
        return 'Could not connect to googleapis.com/maps/api';
    }

    public static function serviceReturnedError(string $message): string
    {
        return "Geocoding failed because `{$message}`";
    }

}