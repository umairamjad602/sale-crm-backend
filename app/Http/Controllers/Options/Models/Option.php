<?php

namespace App\Http\Controllers\Options\Models;

use App\Models\BaseModel;

class Option extends BaseModel
{
	protected $table = 'options';
	public static $snakeAttributes = false;

	protected $fillable = [
		'name',
		'value',
		'autoload'
	];

}
