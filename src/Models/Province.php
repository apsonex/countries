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

}