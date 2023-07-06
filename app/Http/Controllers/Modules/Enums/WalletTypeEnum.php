<?php namespace App\Http\Controllers\Modules\Enums;

use App\Helpers\Enum;

class WalletTypeEnum extends Enum {
    const InvestmentWallet                = 1;
    const BinaryWallet                    = 2;
    const ROIWallet                       = 3;
    const DollarWallet                    = 4;
    const EuroWallet                      = 5;
    const KWDWallet                       = 6;
    const CryptoWallet                    = 7;
}
?>
