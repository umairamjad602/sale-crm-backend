<?php

namespace App\Http\Controllers\Modules\Enums;

use App\Helpers\Enum;

class FinancialTransactionsStatusEnum extends Enum
{
    const Pending           = 707;
    const Failed            = 708;
    const Completed         = 709;
    const Cacelled          = 710;
}
