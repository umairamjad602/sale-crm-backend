<?php

namespace App\Http\Controllers\Categories\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends BaseModel  {
    use SoftDeletes;

    protected $table = 'categories';
    protected $fillable = [
        'name',
        'color',
        'company_id',
        'created_by',
        'created_at',
        'updated_at'
    ];
}