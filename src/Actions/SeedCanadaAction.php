<?php

namespace Apsonex\Countries\Actions;

use Apsonex\Countries\Models\Country;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;

class SeedCanadaAction
{

    public static function seed(): bool
    {
        $self = new static();

        $self->seedCountryFromDir(__DIR__ . '/../../seeders/countries-data/canada');

        return true;
    }

    protected function seedCountryFromDir(string $dir)
    {
        $country = json_decode(File::get($dir . "/country.json"), true);

        DB::table('countries')->insert([
            'capital'           => $country['capital'] ?? null,
            'citizenship'       => $country['citizenship'] ?? null,
            'country_code'      => $country['country-code'] ?? null,
            'currency'          => $country['currency'] ?? null,
            'currency_code'     => $country['currency_code'] ?? null,
            'currency_sub_unit' => $country['currency_sub_unit'] ?? null,
            'full_name'         => $country['full_name'] ?? null,
            'iso_3166_2'        => $country['iso_3166_2'] ?? null,
            'iso_3166_3'        => $country['iso_3166_3'] ?? null,
            'name'              => $country['name'] ?? null,
            'region_code'       => $country['region-code'] ?? null,
            'sub_region_code'   => $country['sub-region-code'] ?? null,
            'eea'               => (bool)$country['eea'],
            'calling_code'      => $country['calling_code'] ?? null,
            'currency_symbol'   => $country['currency_symbol'] ?? null,
            'flag'              => $country['flag'] ?? null,
        ]);

        $country = \Apsonex\Countries\Models\Country::where('iso_3166_2', $country['iso_3166_2'])->firstOrFail();

        $this->seedProvinces($dir, $country);
    }

    protected function seedProvinces(string $dir, Country $country)
    {
        foreach (json_decode(File::get($dir . "/tax-rates.json"), true) as $abbreviation => $data) {
            $country->provinces()->create([
                'name'         => $data['name'],
                'abbreviation' => $abbreviation,
                'taxes'        => $data['taxes'],
                'slug'         => str($data['name'])->slug(),
            ]);
        }
    }

}