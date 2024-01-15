<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryModel extends Model
{
    use HasFactory;
    protected $table = "category";
    protected $fillable = ['name'];

    public function category()
    {
        return $this->belongsTo('App\Models\SubCategoryModel', 'category_id', 'id');
    }
}
