<?php

namespace App\Http\Controllers\Modules\Enums;

use App\Helpers\Enum;

class DashboardWidgetEnum extends Enum
{
    const DEPOSIT_BY_DAYS                       = 1;
    const LATEST_ACTIVITIES                     = 2;
    const DEPOSITS_BY_ASSIGNEES                 = 3;
    const CLIENTS_BY_STATUS                     = 4;
    const LEADS_BY_STATUS                       = 5;
    const FTD_TOP_COUNTRIES                     = 6;
    const NET_DEPOSITS_TOP_COUNTRIES            = 7;
    const MONTHLY_DEPOSITS_AND_WITHDRAWALS      = 8;
    const SAMPLE_WIDGET                         = 9;
    const FOREX_DASHBOARD_STAT_CARDS            = 12;
    const TOP_WINNERS                           = 13;
    const TOP_LOOSERS                           = 14;
    const NET_DEPOSITS_BY_ASSIGNEES             = 15;
    const POS_STATS_OVERVIEW                    = 16;
}
