<?php namespace App\Http\Controllers\Modules\Enums;

use App\Helpers\Enum;

class DynamicFilterEnum extends Enum
    {
        const IS_EQUAL          = 1; 
        const IS_NOT_EQUAL      = 2; 
        const CONTAIN           = 3; 
        const DOSE_NOT_CONTAIN  = 4; 
        const START_WITH        = 5; 
        const END_WITH          = 6; 
        const IS_EMPTY          = 7; 
        const IS_NOT_EMPTY      = 8; 
    }
?>
