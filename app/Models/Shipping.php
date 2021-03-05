<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;

/**
 * Class Shipping
 * @package App\Models
 * @method static \Illuminate\Database\Eloquent\Builder active()
 */
class Shipping extends Model
{
    use HasFactory;

    public function scopeActive(Builder $builder): Builder
    {
        return $builder->where('is_active', true);
    }
}
