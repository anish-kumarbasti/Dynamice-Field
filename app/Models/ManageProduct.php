<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ManageProduct extends Model
{
    use HasFactory;
    protected $table = "product_managment";
    protected $fillable = ['category_id', 'sub_category_id', 'product_name', 'image', 'price', 'discount', 'final_price'];

    public function category()
    {
        return $this->belongsTo('App\Models\CategoryModel', 'category_id');
    }
    public function subcategory()
    {
        return $this->belongsTo('App\Models\SubCategoryModel', 'sub_category_id');
    }
}
