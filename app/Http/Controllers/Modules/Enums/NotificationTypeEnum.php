<?php namespace App\Http\Controllers\Modules\Enums;

use App\Helpers\Enum;

class NotificationTypeEnum extends Enum
    {
        const Generic               = 698;
        const Deposit               = 699;
        const Withdrawal            = 700;
        const SMS                   = 701;
        const PushNotification      = 702;
        const Email                 = 703;
    }
?>
