<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

/**
 * 
 * @property int year
 * @property boolean concluded
 * 
 * @method static Builder active()
 * 
 */
class Season extends Model
{
    use HasFactory;

    /* PROPERTIES */

    protected $guarded = ['id'];

    /* RELATIONS */

    public function fixtures(): HasMany
    {
        return $this->hasMany(Fixture::class);
    }

    /* SCOPES */

    public static function scopeActive(Builder $query): Builder
    {
        return $query->where(['concluded' => false]);
    }
}
