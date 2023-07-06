<?php namespace App\Http\Controllers\Modules\Enums;

use App\Helpers\Enum;

class TransactionsTypeEnum extends Enum {
    const Deposit                       = 1;
    const Withdrawal                    = 2;
    const AddDailyIncome                = 3;
    const RemoveDailyIncome             = 4;
    const AddReferralIncome             = 5;
    const RemoveReferralIncome          = 6;
    const AddBalanceTreeIncome          = 7;
    const RemoveBalanceTreeIncome       = 8;
}
?>
