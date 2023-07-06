<?php namespace App\Http\Controllers\Modules\Enums;

use App\Helpers\Enum;

class FieldOptionTypeEnum extends Enum
    {
        const Currency              = 20;
        const TicketPriorities      = 22;
        const TicketStatuses        = 23;
        const TicketSeverities      = 24;
        const TicketCategories      = 26;
        const LeadsStatus           = 27;
        const AccountStatus         = 41;
        // Add more whenever you want, i am too lazy to add.
    }
?>
