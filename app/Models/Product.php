<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Product extends Model
{
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = ['name', 'category', 'price', 'quantity'];

    protected static function boot()
    {
        parent::boot();
        static::creating(function ($model) {
            if (empty($model->id)) {
                $model->id = (string) Str::uuid();
            }
        });
    }
}
