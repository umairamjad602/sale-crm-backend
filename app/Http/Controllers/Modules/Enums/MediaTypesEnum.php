<?php namespace App\Http\Controllers\Modules\Enums;

use App\Helpers\Enum;

class MediaTypesEnum extends Enum
    {
        const GeneralFiles     = 1;
        const Logo             = 2;
        const InvoicesPDF      = 3;
        const InvoiceLogo      = 4;
        const CompanyLogo      = 5;
        const ProfilePicture   = 6;
        const PayslipPDF       = 7;
    }
?>
