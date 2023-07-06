<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UDEX AWB</title>
</head>
<style>
    * {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
        font-family: Arial, Helvetica, sans-serif;
    }
    .wrapper {
        width: 100%;
        padding: 10px;
    }
    .header {
        width: 100%;
    }
    .main-heading {
        font-size: 36px;
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
        display: inline;
    }
    .black-border-1 {
        border: 1px solid black;
    }
    .fw-bold {
        font-weight: bold;
    }
    .p-1 {
        padding: 5px;
    }
    .p-2 {
        padding: 7px;
    }
    .bg-black {
        background-color: black;
        color: white;
    }
    table {
        border-collapse: collapse;
    }
    td {
        padding: 5px;
        text-align: center;
    }
    .content{
        font-size: 8px;
    }
    .list-heading {
        background-color: black;
        color: white;
    }
    .list-heading th{
        padding: 5px;
    }
    .box-title {
        background-color: black;
        color: white;
    }
    .detail {
        text-align: left;
        width: 350px;
    }
    p {
        font-size:12px !important;
    }
    h4 {
        font-size: 13px !important;
    }
    h3 {
        font-size: 14px !important;
    }
</style>
<body class="p-1" style="margin-right: 20px;">
    <div class="wrapper">
        <div class="header">
            <img src="{{url('assets/images/logo.png')}}" width="200" alt="">
            <h1 class="float-right main-heading" >INVOICE</h1>
        </div>
        <div class="box-wrapper" style="height: 80px;">
            <div class="float-left" style="margin-left: 40px;">
                {!! DNS1D::getBarcodeHTML($dataAwb->id, 'CODABAR') !!}
                <p class="text-center">{{$dataAwb->id}}</p>
            </div>
            <table border="1" class="data-table float-right">
                <tr>
                    <td>
                        Mode of Transport
                    </td>
                    <td>
                         <b>Air</b>
                    </td>
                </tr>
                <tr>
                    <td>
                        Airway Bill
                    </td>
                    <td>
                        <b>
                            {{$dataAwb->id}}
                        </b>
                    </td>
                </tr>
                <tr>
                    <td>
                        Total Gross Weight (KGs)
                    </td>
                    <td>
                        <b>{{$dataAwb->total_weight}}</b>
                    </td>
                </tr>
            </table>
        </div>
        <div class="" style="margin-top: -20px;">
            <div class="float-left" style="width: 50%;">
                <div class="black-border-1">
                    <p class="p-1">Date: <span class="fw-bold">{{date('d-m-Y', strtotime($dataAwb->created_at))}}</span></p>
                    <h3 class="bg-black p-2">SHIPPER</h3>
                    <p class="p-1">
                        <span class="fw-bold">{{$from->name}}</span>
                        <br>
                        {{$from->address}} <br>
                        <br>
                        {{$from->postal_code}}
                        <br>
                        {{$from->city}}
                        <br>
                        {{$from->country}}
                    </p>
                </div>
                <div class="black-border-1 p-1">
                    <p class="p-1">
                        NTN/CNIC
                        <br>
                        <span class="fw-bold">{{$from->identification_num}}</span>
                        <br>
                        <br>
                        Telephone/Mobile
                        <br>
                        <span class="fw-bold">{{$from->mobile}}</span>
                    </p>
                </div>
            </div>
            <div class="float-left" style="width: 50%; margin-top: 70px; height: 200px">
                <div class="w-100 black-border-1" style="height: 100%;">
                    <h3 class="bg-black p-2">COSIGNEE</h3>
                    <p class="p-1">
                        <span class="fw-bold">{{$to->name}}</span>
                        <br>
                        {{$to->address}}<br>
                        <br>
                        {{$to->postal_code}}
                        <br>
                        {{$to->city}}
                        <br>
                        {{$to->country}}
                    </p>
                </div>
            </div>
        </div>
        <table border="1" class="w-100" style="margin-top: 290px;">
            <tr class="list-heading">
                <th>No#</th>
                <th class="detail">Description</th>
                <th>Quantity</th>
                <th>UnitPrice</th>
                <th>Total Price</th>
            </tr>
            <!-- <tr class="box-title">
                <td>1</td>
                <td class="detail">BOX 1</td>
                <td>Weight</td>
                <td>5 KG</td>
                <td></td>
            </tr> -->
            @foreach ($items as $data)
            <tr>
                <td>{{$loop->index + 1}}</td>
                <td class="detail">{{$data->description}}</td>
                <td>{{$data->quantity}}</td>
                <td>{{$data->unit_price}}</td>
                <td>{{$data->sub_total_price}}</td>
            </tr>
            @endforeach
            <tr>
                <td colspan="4" style="text-align: right;"><b>Total</b></td>
                <th><b>{{$total_value}}</b></th>
            </tr>
        </table>
        <br>
        <div class="w-100">
            <p>Reason For Export  ___________________________________________________________________________________________</p> <br>
            <p>I declare that the information is true and correct to the best of my knowledge and the goods are of PAKISTAN origin. <br>
            WE, <span style="text-transform: uppercase;">{{$from->name}}</span> certify the particulars and quantity of the goods specified in this documents are the goods which are submitted for clearance for export out of PAKISTAB.</p>
            <p>
                ___________________________________ <br>
                Designation of Authorised Signatory
            </p>
            <br>
            <br>
            <p>
            ___________________________________ <br>
            Signature / Stamp
            </p>
        </div>
    </div>
</body>
</html>