<?php

namespace App\Http\Controllers\Customers\Models;

use App\Models\BaseModel;
use Illuminate\Database\Eloquent\SoftDeletes;

class Customer extends BaseModel {
    use SoftDeletes;
    protected $table = 'customers';
    protected $fillable = [
        'name',
        'email',
        'phone',
        'created_by',
        'company_id',
        'created_at',
        'updated_at'
    ];
}