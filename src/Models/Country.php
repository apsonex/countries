<?php

namespace Apsonex\Countries\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

/**
 * @property int    id
 * @property string capital
 * @property string citizenship
 * @property string country_code
 * @property string currency
 * @property string currency_code
 * @property string currency_sub_unit
 * @property string currency_symbol
 * @property string full_name
 * @property string iso_3166_2
 * @property string iso_3166_3
 * @property string name
 * @property string region_code
 * @property string sub_region_code
 * @property string calling_code
 * @property string flag
 * @property bool   eea
 */
class Country extends Model
{
    use HasFactory;

    protected $guarded = ['id'];

    public function provinces(): \Illuminate\Database\Eloquent\Relations\HasMany
    {
        return $this->hasMany(Province::class);
    }
}
