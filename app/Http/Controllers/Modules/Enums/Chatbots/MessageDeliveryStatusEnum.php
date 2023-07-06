<?php

namespace App\Http\Controllers\Modules\Enums\Chatbots;

use App\Helpers\Enum;

class MessageDeliveryStatusEnum extends Enum
{
    const PENDING = 'Pending';
    const PROCESSING = 'Processing';
    const DELIVERED = 'Delivered';
    const FAILED = 'Failed';
}
