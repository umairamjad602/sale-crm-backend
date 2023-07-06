<?php

namespace App\Http\Controllers\Modules\Enums;

use App\Helpers\Enum;

class ClientTypesEnum extends Enum
{
    const Individual      = 245;
    const CorporateAccount       = 246;
    const CommonAccount          = 247;
}
