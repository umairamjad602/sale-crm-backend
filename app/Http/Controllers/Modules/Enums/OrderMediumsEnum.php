<?php

namespace App\Http\Controllers\Modules\Enums;

use App\Helpers\Enum;

class OrderMediumsEnum extends Enum
{
    const MobileApplication = 719;
    const Pos = 720;
    const Invoice = 721;
    const OnlineShop = 722;
}
