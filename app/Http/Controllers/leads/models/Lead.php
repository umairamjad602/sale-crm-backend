<?php
namespace App\Http\Controllers\leads\models;

use Illuminate\Database\Eloquent\Model;

class Lead extends Model {
    protected $table = 'leads';
    protected $fillable = [
        'title',
        'first_name',
        'last_name',
        'primary_email',
        'primary_phone',
        'secondary_phone',
        'mobile',
        'description_details',
        'lead_source',
        'ip',
        'secondary_email',
        'lead_status',
        'created_by',
        'created_at',
        'updated_at'
    ];
}