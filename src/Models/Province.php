<?php

namespace Apsonex\Countries\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property int    id
 * @property string name
 * @property string abbreviation
 * @property string slug
 * @property array  taxes
 * @property int    country_id
 */
class Province extends Model
{

    protected $guarded = ['id'];

    protected $casts = [
        'taxes' => 'array',
    ];

    public function country(): \Illuminate\Database\Eloquent\Relations\BelongsTo
    {
        return $this->belongsTo(Country::class);
    }

    public function taxesInfo(): string
    {
        $taxes = collect($this->taxes)->map(fn($item) => $item['code'] . ' ' . ($item['tax'] * 100 . '%'))->join(', ');
        return 'Tax: ' . $taxes;
    }

    public static function canadianSelectDropDown($addTaxInfo = false): array
    {
        return static::query()
            ->whereHas('country', fn($q) => $q->where('iso_3166_2', 'CA'))
            ->get()
            ->mapWithKeys(
                fn(Province $p) => [(string)$p->id => $p->name . ($addTaxInfo ? (' | ' . $p->taxesInfo()) : '')]
            )->toArray();
    }

    public static function getByCountryId($countryId, $addTaxInfo = false): array
    {
        return static::query()
            ->whereHas('country', fn($q) => $q->where('id', $countryId))
            ->get()
            ->mapWithKeys(
                fn(Province $p) => [(string)$p->id => $p->name . ($addTaxInfo ? (' | ' . $p->taxesInfo()) : '')]
            )->toArray();
    }
}
