<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = ['user_id', 'name', 'description', 'price', 'extension'];

    public function scopeLatest($query)
    {
        return $query->orderBy('id', 'desc');
    }
}
