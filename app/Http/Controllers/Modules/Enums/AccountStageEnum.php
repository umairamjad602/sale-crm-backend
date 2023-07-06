<?php

namespace App\Http\Controllers\Modules\Enums;

use App\Helpers\Enum;

class AccountStageEnum extends Enum
{
    const Registered      = 242;
    const Deposited       = 243;
    const Traded          = 244;
}
