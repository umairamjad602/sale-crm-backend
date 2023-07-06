<?php namespace App\Http\Controllers\Modules\Enums;

use App\Helpers\Enum;

class NotificationDeliveryStatusEnum extends Enum
    {
        const Pending   = 'Pending';
        const Picked    = 'Picked';
        const Delivered = 'Delivered';
        const Failed    = 'Failed';
    }
?>
