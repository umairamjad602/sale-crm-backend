<?php

namespace App\Http\Controllers\Modules\Enums\Chatbots;

use App\Helpers\Enum;

class MessageTypesEnum extends Enum
{
    const TEXT = 'Text';
    const VIDEO = 'Video';
    const VOICE = 'Voice';
    const LOCATION = 'Location';
    const POLL = 'Poll';
    const MEDIA = 'Media';
    const DOCUMENT = 'Document';
    const IMAGE = 'Image';
    const CONTACT = 'Contact';
    const NOTE = 'Note';
}
