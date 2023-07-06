<?php

namespace App\Http\Controllers\Modules\Enums;

use App\Helpers\Enum;

class OrderPaymentTypesEnum extends Enum
{
    const Cash = 'Cash';
    const Credit = 'Credit';
    const Debit = 'Debit';
    const Visa = 'Visa';
    const Points = 'Points';
    const OnlinePayment = 'Online Payment';
}
