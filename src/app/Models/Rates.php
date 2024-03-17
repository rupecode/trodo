<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * @property integer $id
 * @property integer $ratesId
 * @property string $currency
 * @property float $rate
 */
class Rates extends Model
{
    protected $table = 'rates';

    public $timestamps = false;
    /**
     * @var array
     */
    protected $fillable = ['ratesId', 'currency', 'rate'];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function rate()
    {
        return $this->belongsTo('App\Models\Rate', 'ratesId');
    }
}
