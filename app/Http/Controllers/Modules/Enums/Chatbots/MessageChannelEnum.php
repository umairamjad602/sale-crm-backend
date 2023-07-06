<?php

namespace App\Http\Controllers\Modules\Enums\Chatbots;

use App\Helpers\Enum;

class MessageChannelEnum extends Enum
{
    const INTERNAL            = 'Internal';
    const FACEBOOK            = 'Facebook';
    const TELEGRAM            = 'Telegram';
    const WHATSAPP_OFFICIAL   = 'Whatsapp Official';
    const INSTAGRAM           = 'Instagram';
    const WHATSAPP_UNOFFICIAL = 'Whatsapp Unofficial';
    const PRIVATE_CHAT = 'Private Chat';
}
