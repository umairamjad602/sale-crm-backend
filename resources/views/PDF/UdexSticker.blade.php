<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Sticker</title>
</head>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: Arial, Helvetica, sans-serif;
    }
    .wrapper {
        padding: 10px;
        padding-bottom: 0;
    }
    .header {
        width: 100%;
    }
    .main-heading {
        font-size: 30px;
        padding-top: 5px;
    }
    .float-right {
        float: right;
    }
    .float-left {
        float: left
    }
    .w-100 {
        width: 100%;
    }
    .data-table {
        border-collapse: collapse !important;
        border: 1px solid #000;
    }
    .data-table tr td {
        padding: 7px;
    }
    .box-wrapper {
        padding: 10px 0 5px 0;
    }
    .text-center {
        text-align: center;
    }
    .display-inline {
        display: inline-block;
    }
    .black-border-1 {
        border: 1px solid black;
    }
    .fw-bold {
        font-weight: bolder;
    }
    .p-1 {
        padding: 5px;
    }
    .text-vetical {
        transform: rotate(90deg);
    }
    .dark {
        background-color: #000;
        color: #fff;
    }
</style>
<body>
    <div class="wrapper">
        <div class="header">
            <img src="{{url('assets/images/logo.png')}}" width="150" alt="">
            <h1 class="float-right main-heading" >EXP</h1>
        </div>
        <div class="box-wrapper">
            <div class="float-left" style="width: 20%">
                <div class="text-vetical">
                    <div style="width: 40px; margin-left: 50px">
                        {!! DNS1D::getBarcodeHTML($dataAwb->id, 'CODABAR', 1, 30) !!}
                        <span class="text-center" style="margin-left: 15px">{{$dataAwb->id}}</span>
                    </div>
                </div>
            </div>
            <div class="float-left" style="width: 50%">

                <div class=" black-border-1" style="width: 100%; height: 90px; padding: 5px">
                    <p style="font-size: 10px;">
                        <b>{{$from->company_name}}</b> <br>
                        <b>{{$from->name}}</b> <br>
                        {{$from->address}} <br>
                        {{$from->city}} {{$from->postal_code}} <br>
                        {{$from->country}}<br>
                        {{$from->mobile}}
                    </p>
                </div>
                <div class="black-border-1" style="width: 100%; height: 120px; padding: 5px">
                    <p style="font-size: 13px;">
                        <b>{{$to->company_name}}</b> <br>
                        <b>{{$to->name}}</b> <br>
                        <span style="font-size:10px;">
                            {{$to->address}} <br>
                            {{$to->city}} {{$to->postal_code}} <br>
                            {{$to->country}}<br>
                        </span>
                        {{$to->mobile}}
                    </p>
                </div>
            </div>
            <div class="float-right" style="width: 20%; margin-top: 50px">
                <div class="float-right">
                    {!! DNS2D::getBarcodeHTML("$dataAwb->id", 'QRCODE', 4, 4) !!}
                </div>
            </div>
        </div>
        <div style="margin-top: 240px; padding: 5px">
            <table class="w-100 data-table" border="2">
                <tr >
                    <td class="dark" style="font-size: 12px;">
                        REFFERENCE
                    </td>
                    <td style="font-size: 12px" class="dark"> <span>ORIGIN:</span></td>
                    <td style="font-size: 12px"><span class="fw-bold">{{$from->country}}</span></td>
                </tr>
                <tr>
                    <td style=" font-size: 12px"><span class="fw-bold">{{$dataAwb->refference}}</span></td>
                    <td style="font-size: 12px" class="dark"><span>DEST:</span></td>
                    <td style="font-size: 12px"><span class="fw-bold">{{$to->country}}</span></td>
                </tr>
            </table>
        </div>
        <div style="margin: 5px;">
            <table class="w-100 data-table" border="2">
                <tr>
                    <td colspan="2" class="dark" style="padding: 2px 5px; font-size: 12px">
                        SERVICE
                    </td>
                    <td colspan="1" class="dark" style="padding: 2px 5px; font-size: 12px">
                        WEIGHT
                    </td>
                </tr>
                <tr>
                    <td colspan="2" class="fw-bold" style="padding: 2px 5px;">
                        {{$service->name}}
                    </td>
                    <td colspan="1" class="fw-bold" style="padding: 2px 5px;">
                        {{$dataAwb->total_weight}}
                    </td>
                </tr>
                <tr>
                    <td class="dark" style="padding: 2px 5px; width: 50%; font-size: 10px">
                        DECLARED VALUE FOR CUSTOMS
                    </td>
                    <td class="dark" style="padding: 2px 5px; width: 25%; font-size: 10px">
                        SHIPMENT TERM
                    </td>
                    <td class="dark" style="padding: 2px 5px; width: 25%; font-size: 12px">
                        PEICES
                    </td>
                </tr>
                <tr>
                    <td class="fw-bold" style="width: 50%;" style="padding: 2px 5px;">
                        {{$dataAwb->declared_value}} USD
                    </td>
                    <td class="fw-bold" style="width: 25%;" style="padding: 2px 5px;">
                        DAP
                    </td>
                    <td class="fw-bold" style="width: 25%;" style="padding: 2px 5px;">
                        {{$dataAwb->total_packets}}
                    </td>
                </tr>
                <tr>
                    <td colspan="4" class="dark" style="padding: 2px 5px; width: 50%; font-size: 12px">
                        SHIPMENT CONTENT
                    </td>
                </tr>
                <tr>
                    <td colspan="4" style="padding: 2px 5px;font-size: 10px">{{$dataAwb->description}}</td>
                </tr>
            </table>
        </div>
    </div>
</body>
</html>