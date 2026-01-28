<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'slug',
        'description',
        'price',
        'image',
        'status'
    ];

    public function flavors()
    {
        return $this->belongsToMany(Flavor::class);
    }
}
