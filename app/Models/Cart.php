<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'total'
    ];

    public function cart_item()
    {
        return $this->hasMany(Cart_item::class);
    }

}
