<?php

namespace App\Http\Controllers\Modules\Model;

use App\Models\BaseModel;

class View extends BaseModel
{
	protected $table = 'views';
    public $timestamps = false; 
    
    public function module()
    {
        return $this->belongsTo(Module::class, 'module_id');
    }
}
