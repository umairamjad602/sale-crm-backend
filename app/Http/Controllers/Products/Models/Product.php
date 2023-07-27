<?php

namespace App\Http\Controllers\Products\Models;

use App\Http\Controllers\Categories\Models\Category;
use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends BaseModel {
    use SoftDeletes;
    protected $table = 'products';
    protected $fillable = [
        'media_id',
        'category_id',
        'name',
        'price',
        'description',
        'company_id',
        'created_by',
        'created_at',
        'updated_at',
        'deleted_at'
    ];

    public function category() {
        return $this->hasOne(Category::class, 'id', 'category_id');
    }

}