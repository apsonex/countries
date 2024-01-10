<?php

namespace Apsonex\Countries;

use Apsonex\Countries\Models\Country;
use Illuminate\Support\Collection;

class Countries
{

    public function dropdownListByIso2($isoName, $withProvinces = false): \Illuminate\Database\Eloquent\Collection|array
    {
        return Country::query()->select('id', 'currency_code', 'currency_symbol', 'name', 'iso_3166_2', 'flag')
            ->where('iso_3166_2', $isoName)
            ->when($withProvinces, fn($query) => $query->with('provinces:id,country_id,name,abbreviation,slug'))
            ->get();
    }

    public function dropdownList($withProvinces = false): \Illuminate\Database\Eloquent\Collection|array
    {
        return Country::query()->select('id', 'currency_code', 'currency_symbol', 'name', 'iso_3166_2', 'flag')
            ->when($withProvinces, fn($query) => $query->with('provinces:id,country_id,name,abbreviation,slug'))
            ->get();
    }

    public function provincesAbbreviationsByCountryIso2($isoName): Collection
    {
        return $this->dropdownListByIso2($isoName, true)?->first()->provinces->pluck('abbreviation');
    }

}
