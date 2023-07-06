<?php

namespace App\Http\Controllers\Modules\Model;

use App\Http\Controllers\Acl\Models\Permission;
use App\Http\Controllers\Transactions\Models\Transaction;
use App\Models\BaseModel;

class Module extends BaseModel
{
    // Transactions Relation
	protected $table = 'modules';
    public $timestamps = false; 
    public function transactions()
    {
        return $this->hasMany(Transaction::class, 'transaction_module_id');
    }

    public function permissions() {
        return $this->hasMany(Permission::class);
    }

    public function views() {
        return $this->hasMany(View::class);
    }
}
