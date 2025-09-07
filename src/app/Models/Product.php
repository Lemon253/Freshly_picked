<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    //リレーションの設定
    public function seasons()
    {
        return $this->belongsToMany(Season::class, 'product_season')->withTimestamps();
    }
}
