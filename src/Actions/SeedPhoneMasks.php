<?php

namespace Apsonex\Countries\Actions;

use Apsonex\Countries\Models\Country;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class SeedPhoneMasks
{

    public static function seed()
    {
        collect(File::json(__DIR__ . '/../../database/data/phone-masks.json'))
            ->each(function ($mask, $iso2) {
                Country::query()->where('', $iso2)->update([
                    'phone_mask' => $mask
                ]);
            });
    }
}
