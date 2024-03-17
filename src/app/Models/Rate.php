<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property string $lastUpdate
 * @property string $baseCurrency
 */
class Rate extends Model
{

    protected $table = 'rate';
    /**
     * @var array
     */
    protected $fillable = ['lastUpdate', 'baseCurrency'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rate()
    {
        return $this->belongsTo('App\Models\Rate', 'ratesId');
    }
}
