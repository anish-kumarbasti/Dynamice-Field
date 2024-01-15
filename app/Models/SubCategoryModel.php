<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategoryModel extends Model
{
    use HasFactory;
    protected $table = "sub_category";
    protected $fillable = ['name', 'category_id'];

    public function category()
    {
        return $this->belongsTo('App\Models\CategoryModel', 'category_id', 'id');
    }
}
