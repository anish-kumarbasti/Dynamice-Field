<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CardModel extends Model
{
    use HasFactory;
    protected $table = "shopping_card";
    protected $fillable = ['user_id', 'product_id', 'total_price'];

    public function product()
    {
        return $this->belongsTo('App\Models\ManageProduct', 'product_id');
    }
}
