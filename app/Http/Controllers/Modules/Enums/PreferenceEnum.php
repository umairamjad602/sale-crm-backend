<?php

namespace App\Http\Controllers\Modules\Enums;

use App\Helpers\Enum;

class PreferenceEnum extends Enum
{
    const HIDDEN_WIDGETS = 710;
    const LAST_DASHBOARD_TIMEFRAME = 800;
    const LAST_DASHBOARD_CURRENCY = 801;
    const LEADS_GRID_COLUMN_ORDER = 802;
    const ACCOUNTS_GRID_COLUMN_ORDER = 803;
    const DEPOSITORS_GRID_COLUMN_ORDER = 804;
}
