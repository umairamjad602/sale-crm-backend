<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>UDEX AWB</title>
</head>
<style>
    *, h1, h2, h3, h4, h5, h6, p {
        padding: 0;
        margin: 0;
        box-sizing: border-box;
        font-family: Arial, Helvetica, sans-serif;
    }
    .wrapper {
        width: 97%;
        padding: 20px;
    }
    .header {
        width: 100%;
    }
    .main-heading {
        font-size: 26px;
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
        padding: 5px 0px ;
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
    }
    p {
        font-size:10px !important;
    }
    h4 {
        font-size: 11px !important;
    }
    h3 {
        font-size: 12px !important;
    }
    .content{
        font-size: 9px !important;
        text-align: justify;
        text-overflow: break-word !important;
    }
</style>
<body class="p-1" style="margin-right: 20px;">
    <div class="wrapper">
        <div class="header">
            <img src="{{url('assets/images/logo.png')}}" width="250" alt="">
            <div class="float-right">
                <h1 class="main-heading text-center" >AIR WAYBILL</h1>
                <div class="">
                    {!! DNS1D::getBarcodeHTML($dataAwb->id, 'CODABAR') !!}
                    <p class="text-center">{{$dataAwb->id}}</p>
                </div>
            </div>
        </div>

        <div class="box-wrapper w-100" style="height: 50px;">
            <table border="1" class="data-table w-100">
                <tr>
                    <td>
                        <p>Account No:</p>
                        <h4>{{$from->id + 1500}}</h4>
                    </td>
                    <td>
                        <p>Reference:</p>
                        <h4>{{$dataAwb->refference}}</h4>
                    </td>
                    <td>
                        <p>Origin:</p>
                        <h4>{{$from->city}}</h4>
                    </td>
                    <td>
                        <p>Service:</p>
                        <h4>{{$service->name}}</h4>
                    </td>
                    <td>
                        <p>Destination:</p>
                        <h4>{{$to->city}}</h4>
                    </td>
                </tr>
            </table>
        </div>
        <div class="" style="margin-top: 0;">
            <div class="float-left" style="width: 38%;">
                <div class="black-border-1">
                    <h3 class="bg-black p-2">SHIPPER</h3>
                    <p class="p-1">
                        <span class="fw-bold">{{$from->company_name}}</span>
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
                <div class="black-border-1" style="height: 80px;">
                    <div class="float-left" style="width: 50%; border-right: 1px solid black; height: 80px;">
                        <p class="p-1">
                            <small>Attention Name:</small>
                            <br>
                            <span class="fw-bold">{{$from->name}}</span>
                            <br>
                            <br>
                            <small>Telephone / Mobile</small>
                            <br>
                            <span class="fw-bold">{{$from->mobile}}</span>
                        </p>
                    </div>
                    <div class="float-right" style="width: 50%; line-break: anywhere;">
                        <p class="p-1">
                            <small>Email</small>
                            <br>
                            <span class="fw-bold" style="font-size: 9px;">{{$from->email}}</span>
                            <br>
                            <br>
                            <small>CNIC</small>
                            <br>
                            <span class="fw-bold">{{$from->identification_num}}</span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="float-left black-border-1" style="width: 20%; margin-left:15px;">
                <div class="" style="border-bottom: 1px solid black;">
                    <p class="text-center">Total Pieces</p>
                </div>
                <div class="" style="border-bottom: 1px solid black;">
                    <h3 class="text-center fw-bold">{{$dataAwb->total_packets}}</h3>
                </div>
                <div class="" style="border-bottom: 1px solid black;">
                    <p class="text-center">Actual Weight ( KGs)</p>
                </div>
                <div class="" style="border-bottom: 1px solid black;">
                    <h3 class="text-center fw-bold">{{$dataAwb->total_weight}}</h3>
                </div>
                <div class="" style="border-bottom: 1px solid black;">
                    <p class="text-center" style="font-size: 12px;">Declared Value</p>
                </div>
                <div class="" style="border-bottom: 1px solid black;">
                    <h3 class="text-center fw-bold">
                        {{(int)$dataAwb->declared_value}} {{$dataAwb->currencyData->name}}
                    </h3>
                </div>
                <div class="" style="border-bottom: 1px solid black;">
                    <p class="text-center">Chargeable Weight</p>
                </div>
                <div class="" style="border-bottom: 1px solid black;">
                    <h3 class="text-center fw-bold">
                    @if ($dataAwb->total_weight > $dataAwb->dimentions)
                        {{$dataAwb->total_weight}}
                    @elseif($dataAwb->total_weight < $dataAwb->dimentions)
                        {{$dataAwb->dimentions}}
                    @endif
                    </h3>
                </div>
                <div class="" style="margin-bottom: 6px">
                    <div class="" style="margin-top: 6px; margin-left: 40px;" >
                        {!! DNS2D::getBarcodeHTML("$dataAwb->id", 'QRCODE', 3, 3) !!}
                    </div>
                </div>
            </div>
            <div class="float-right" style="width: 38%;">
                <div class="w-100 black-border-1">
                    <h3 class="bg-black p-2">COSIGNEE</h3>
                    <p class="p-1">
                        <span class="fw-bold">{{$to->company_name}}</span>
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
                <div class="black-border-1" style="height: 80px;">
                    <div class="float-left" style="width: 50%; border-right: 1px solid black; height: 80px;">
                        <p class="p-1">
                            <small>Attention Name:</small>
                            <br>
                            <span class="fw-bold">{{$to->name}}</span>
                            <br>
                            <br>
                            <small>Telephone / Mobile</small>
                            <br>
                            <span class="fw-bold">{{$to->mobile}}</span>
                        </p>
                    </div>
                    <div class="float-right" style="width: 50%; line-break: anywhere;">
                        <p class="p-1">
                            <small>Email</small>
                            <br>
                            <span class="fw-bold" style="font-size: 9px;">{{$to->email}}</span>
                            <br>
                            <br>
                            <small>EORI</small>
                            <br>
                            <span class="fw-bold">{{$to->identification_num}}</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="" style="margin-top: 210px;">
            <table border="1" class="w-100" style="border: 1px solid black;">
                <tr>
                    <td class="text-center"><p>Dimension</p></td>
                    <td class="text-center"><p>Description of shipment</p></td>
                    <td class="text-center"><p>PU Date</p></td>
                </tr>
                <tr>
                    <td class="text-center" rowspan="2" style="vertical-align:top;">
                        <p style="font-size: 10px !important; line-height: 0.6;">
                            <span>H x W x L</span>
                            <br><br>
                            @foreach($packets as $packet)
                            <span style="margin-top: 7px; margin-bottom: 7px; line-height: 1;">{{$packet->height}} x {{$packet->width}} x {{$packet->length}}</span><br>
                            @endforeach
                        </p>
                    </td>
                    <td rowspan="2" style="vertical-align:top;">
                        <p>{{$dataAwb->description}}</p>
                    </td>
                    <td class="text-center">{{date('d-m-Y', strtotime($dataAwb->created_at))}}</td>
                </tr>
                <tr>
                    <td width="250px" >
                        <p style="font-size: 10px;">Shipper warrants that all information furnished is true
                            and correct and that he / she / they have read and
                            clearly understand the standard conditions of carriage
                            of UDEX Pakistan</p>
                        <p class="text-right"><b>Shipper Sign:</b></p>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="box-wrapper">
        <table class="w-100 float-left" style="margin-right: 15px; margin-left: 15px;">
            <tr>
                <td style="width: 47%;">
                    <p class="content">
                        In tendering the shipment for carriage, the customer agrees to these terms and conditions of carriage and
                        that this airway bill is NON-NEGOTIABLE andhas been prepared by the customer or on the customer's behalf by
                        UDEX. As used in these conditions, UDEX includes UDEX Pakistan (Pvt.) Ltd., alloperating divisions and
                        subsidiaries of
                        UDEX Pakistan (Pvt.) Ltd and their respective agents, servants, officers and employees.
                        SCOPE OF CONDITIONS
                        These conditions shall govern and apply to all services provided by UDEX, BY SIGNING THIS AIRBILL,and THE
                        CUSTOMER ACKNOWLEDGES THAT HE/SHE HAS READ THESE CONDITIONS AND AGREES TO BE BOUND BYEACH OF THEM. UDEX
                        shall not be bound by any agreement which varies from these conditions, unless such agreement is in
                        writingand signed by an authorized officer of UDEX. In the absence of such written agreement, these
                        conditions shall constitute the entireagreement between UDEX and each of its customers. NO employee of
                        UDEX shall have the authority to alter or waive these terms andconditions, except as stated herein.
                        UDEX’S OBLIGATIONS
                        UDEX agrees, subject to payment of applicable rates and charges in effect on the date of acceptance by
                        UDEX ofa customer's shipment, to arrange for the transportation of the shipment between the locations
                        agreed upon by UDEX and the customer.UDEX reserves the right to transport the customer's shipment by any
                        route and procedure and by successive carriers and according to itsown handling, storage and
                        transportation methods.
                        SERVICE RESTRICTION
                        a. UDEX reserves the right to refuse any documents or parcels from any person, firm, or company at its
                        owndiscretion.
                        b. UDEX reserves the right to abandon carriage of any shipment at any time after acceptance when such
                        shipment couldpossibly cause damage or delay to other shipments, equipment or personnel, or when any
                        such carriage is prohibited by law or is inviolation of any of the rules contained herein.
                        c. UDEX reserves the right to open and inspect any shipment consigned by a customer toensure that it is
                        capable of carriage to the state or country of destination within the standard customs procedures and
                        handling methods ofUDEX. In exercising this right, UDEX does not warrant that any particular item to be
                        carried is capable of carriage, without infringing thelaw of any country or state through which the item
                        may be carried.
                        LIMITATION OF LIABILITY
                        Subject to Section 5 and 6 hereof:
                        a. UDEX will be responsible for the customer's shipment only while it iswithin UDEX custody and control.
                        UDEX shall not be liable for loss or damage of a shipment while shipment is out of UDEX's custody
                        orcontrol. UDEX’S LIABILITY IS IN ANY EVENT LIMITED TO ONE HUNDRED DOLLARS (US$100/=) or its equivalent
                        pershipment. Incase of high value shipments, customer should opt for INSURANCE.
                        b. The actual value of a shipment shall be ascertainedby reference to its replacement, reconstitution or
                        reconstruction value at the time and place of shipment, whichever is less, withoutreference to its
                        commercial utility to the customer or to other items of consequential loss.
                        CONEQUENTIAL DAMAGES EXCLUDED 5
                        UDEX SHALL NOT BE LIABLE, IN ANY EVENT,, FOR ANY CONSEQUENTIALOR SPECIAL OR INCIDENTAL DAMAGE OR OTHER
                        INDIRECT LOSS HOWEVER ARISING, WHETHER OR NOT UDEX HADKNOWLEDGE THAT SUCH DAMAGE MIGHT BE INCURRED,
                        INCLUDING, BUT NOT LIMITED TO LOSS OF INCOME,PROFITS, INTEREST, UTILITY OR LOSS OF MARKET.
                        MATERIALS NOT ACCEPTABLE FOR TRANSPORT:
                        a. UDEX will notify customer from time to time as to certain classes ofmaterials which are not accepted
                        by UDEX for carriage. It is the customer's responsibility to accurately describe the shipment on
                        thisAirway bill and to ensure that no material is delivered to UDEX which has been declared to be
                        unacceptable by UDEX.
                        checks,money orders, travelers’ checks, industrial carbon and diamonds, antiques, plants, and animals.
                    </p>
                </td>
                <td style="width: 45%; overflow:wrap">
                    <p class="content">
                        b. UDEX will notcarry:
                        property, the carriage of which is prohibited by any law, regulation or state or local government of any
                        country from, to or throughwhich the property maybe carried: and firearms, bullion, works of art,
                        negotiable instruments in bearer form, jewelry, precious metals,precious stones, lewd obscene or
                        pornographic material, currency, stamps, deeds, hazardous or combustible material, cashier's
                        c. In the event that any customer shouldconsign to UDEX any such item, as described above, or any item
                        which the customer has undervalued for customs purposes ormisdiscribed, whether intentionally or
                        otherwise the customer shall indemnify and hold UDEX harmless from all claims, damages, finesand expenses
                        arising in connection therewith, and UDEX shall have the right to abandon such property and / or release
                        possession of saidproperty to any agent or employee of any national or local government claiming
                        jurisdiction over such materials. Immediately uponUDEX’s obtaining knowledge that such materials
                        infringing these conditions have been turned over to UDEX shall be free to exercise anyof its rights
                        reserved to it under this section without incurring liability whatsoever to the customer.
                        PACKAGING:
                        The packaging of the customer's documents or goods for transportation is the customer's sole
                        responsibility, including theplacing of the goods or documents in any container which may be supplied by
                        the customer to UDEX. UDEX accepts no responsibility forloss or damage to documents or goods caused by
                        inadequate or inappropriate packaging. It is the sole responsibility of the customer toaddress
                        adequately each consignment of documents or goods to enable effective delivery to be made. UDEX shall not
                        be liable for delay inforwarding or delivery resulting from the customer's failure to comply with its
                        obligations in this respect.
                        NEGLIGENCE:
                        The customer is liable for all losses, damages and expenses arising as a result of its failure to comply
                        with its obligationsunder this agreement as a result of its negligence
                        CHARGES:
                        Any rates quoted by UDEX for carriage are inclusive of local airport taxes, but exclusive of any value
                        added taxes, duties,levies, imposts, deposits or outlays incurred in respect of carriage of the
                        customer's goods. Should the customer indicate by endorsementin the space provided on the airway bill
                        that the receiver shall be liable for any customs duty, the customer shall be liable for suchcustoms
                        duty in the event of a default in payment by the receiver. UDEX will not be liable for any penalties
                        imposed or loss or damageincurred due to the customer's documents or goods being impounded by customs or
                        similar authorities and the customer herebyindemnifies UDEX against such penalty or loss.
                        PROPERTY:
                        UDEX will only carry documents or goods which are the property of the customer and the customer warrants
                        that it isauthorized to accept and is accepting these conditions not only on behalf of itself but as
                        agent and on behalf of all other persons who areor may hereafter be interested in the documents or
                        goods. The customer hereby undertakes to indemnify UDEX against any damages,costs and expenses resulting
                        from any breach of this warranty.
                        CLAIMS
                        ANY CLAIMS AGAINST UDEX MUST BE SUBMITTED IN WRITING TO THE OFFICE OF UDEX NEAREST THELOCATION WHERE THE
                        SHIPMENT WAS ACCEPTED, WITHIN FIFTEEN (15 DAYS) OF THE DATE OF ACCEPTANCE BYUDEX.
                        NON-DELIVERY OF SHIPMENT
                        Notwithstanding the shipper's instruction to the contrary, the shipper shall be liable for all costs
                        andexpenses related to the shipment of the package, and for costs incurred in either returning the
                        shipment or warehousing the shipmentpending disposition.
                    </p>
                </td>
            </tr>
        </table>
    </div>
</body>

<body  style="margin-right: 20px;">
<div class="wrapper">
        <div class="header">
            <img src="{{url('assets/images/logo.png')}}" width="250" alt="">
            <div class="float-right">
                <h1 class="main-heading text-center" >AIR WAYBILL</h1>
                <div class="">
                    {!! DNS1D::getBarcodeHTML($dataAwb->id, 'CODABAR') !!}
                    <p class="text-center">{{$dataAwb->id}}</p>
                </div>
            </div>
        </div>

        <div class="box-wrapper w-100" style="height: 50px;">
            <table border="1" class="data-table w-100">
                <tr>
                    <td>
                        <p>Account No:</p>
                        <h4>{{$from->id + 1500}}</h4>
                    </td>
                    <td>
                        <p>Reference:</p>
                        <h4>{{$dataAwb->refference}}</h4>
                    </td>
                    <td>
                        <p>Origin:</p>
                        <h4>{{$from->city}}</h4>
                    </td>
                    <td>
                        <p>Service:</p>
                        <h4>{{$service->name}}</h4>
                    </td>
                    <td>
                        <p>Destination:</p>
                        <h4>{{$to->city}}</h4>
                    </td>
                </tr>
            </table>
        </div>
        <div class="" style="margin-top: 0;">
            <div class="float-left" style="width: 38%;">
                <div class="black-border-1">
                    <h3 class="bg-black p-2">SHIPPER</h3>
                    <p class="p-1">
                        <span class="fw-bold">{{$from->company_name}}</span>
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
                <div class="black-border-1" style="height: 80px;">
                    <div class="float-left" style="width: 50%; border-right: 1px solid black; height: 80px;">
                        <p class="p-1">
                            <small>Attention Name:</small>
                            <br>
                            <span class="fw-bold">{{$from->name}}</span>
                            <br>
                            <br>
                            <small>Telephone / Mobile</small>
                            <br>
                            <span class="fw-bold">{{$from->mobile}}</span>
                        </p>
                    </div>
                    <div class="float-right" style="width: 50%; line-break: anywhere;">
                        <p class="p-1">
                            <small>Email</small>
                            <br>
                            <span class="fw-bold" style="font-size: 9px;">{{$from->email}}</span>
                            <br>
                            <br>
                            <small>CNIC</small>
                            <br>
                            <span class="fw-bold">{{$from->identification_num}}</span>
                        </p>
                    </div>
                </div>
            </div>
            <div class="float-left black-border-1" style="width: 20%; margin-left:15px;">
                <div class="" style="border-bottom: 1px solid black;">
                    <p class="text-center">Total Pieces</p>
                </div>
                <div class="" style="border-bottom: 1px solid black;">
                    <h3 class="text-center fw-bold">{{$dataAwb->total_packets}}</h3>
                </div>
                <div class="" style="border-bottom: 1px solid black;">
                    <p class="text-center">Actual Weight ( KGs)</p>
                </div>
                <div class="" style="border-bottom: 1px solid black;">
                    <h3 class="text-center fw-bold">{{$dataAwb->total_weight}}</h3>
                </div>
                <div class="" style="border-bottom: 1px solid black;">
                    <p class="text-center" style="font-size: 12px;">Declared Value</p>
                </div>
                <div class="" style="border-bottom: 1px solid black;">
                    <h3 class="text-center fw-bold">
                        {{(int)$dataAwb->declared_value}} {{$dataAwb->currencyData->name}}
                    </h3>
                </div>
                <div class="" style="border-bottom: 1px solid black;">
                    <p class="text-center">Chargeable Weight</p>
                </div>
                <div class="" style="border-bottom: 1px solid black;">
                    <h3 class="text-center fw-bold">
                    @if ($dataAwb->total_weight > $dataAwb->dimentions)
                        {{$dataAwb->total_weight}}
                    @elseif($dataAwb->total_weight < $dataAwb->dimentions)
                        {{$dataAwb->dimentions}}
                    @endif
                    </h3>
                </div>
                <div class="" style="margin-bottom: 6px">
                    <div class="" style="margin-top: 6px; margin-left: 40px;" >
                        {!! DNS2D::getBarcodeHTML("$dataAwb->id", 'QRCODE', 3, 3) !!}
                    </div>
                </div>
            </div>
            <div class="float-right" style="width: 38%;">
                <div class="w-100 black-border-1">
                    <h3 class="bg-black p-2">COSIGNEE</h3>
                    <p class="p-1">
                        <span class="fw-bold">{{$to->company_name}}</span>
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
                <div class="black-border-1" style="height: 80px;">
                    <div class="float-left" style="width: 50%; border-right: 1px solid black; height: 80px;">
                        <p class="p-1">
                            <small>Attention Name:</small>
                            <br>
                            <span class="fw-bold">{{$to->name}}</span>
                            <br>
                            <br>
                            <small>Telephone / Mobile</small>
                            <br>
                            <span class="fw-bold">{{$to->mobile}}</span>
                        </p>
                    </div>
                    <div class="float-right" style="width: 50%; line-break: anywhere;">
                        <p class="p-1">
                            <small>Email</small>
                            <br>
                            <span class="fw-bold" style="font-size: 9px;">{{$to->email}}</span>
                            <br>
                            <br>
                            <small>EORI</small>
                            <br>
                            <span class="fw-bold">{{$to->identification_num}}</span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="" style="margin-top: 210px;">
            <table border="1" class="w-100" style="border: 1px solid black;">
                <tr>
                    <td class="text-center"><p>Dimension</p></td>
                    <td class="text-center"><p>Description of shipment</p></td>
                    <td class="text-center"><p>PU Date</p></td>
                </tr>
                <tr>
                    <td class="text-center" rowspan="2" style="vertical-align:top;">
                        <p style="font-size: 10px !important; line-height: 0.6;">
                            <span>H x W x L</span>
                            <br><br>
                            @foreach($packets as $packet)
                            <span style="line-height: 1;">{{$packet->height}} x {{$packet->width}} x {{$packet->length}}</span><br>
                            @endforeach
                        </p>
                    </td>
                    <td rowspan="2" style="vertical-align:top;">
                        <p>{{$dataAwb->description}}</p>
                    </td>
                    <td class="text-center">{{date('d-m-Y', strtotime($dataAwb->created_at))}}</td>
                </tr>
                <tr>
                    <td width="250px" >
                        <p style="font-size: 10px;">Shipper warrants that all information furnished is true
                            and correct and that he / she / they have read and
                            clearly understand the standard conditions of carriage
                            of UDEX Pakistan</p>
                        <p class="text-right"><b>Shipper Sign:</b></p>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div style="position:relative;margin-right: 20px;" >
        <div class="wrapper">
            <div class="header">
                <img src="{{url('assets/images/logo.png')}}" width="250" alt="">
                <div class="float-right">
                    <h1 class="main-heading text-center" >AIR WAYBILL</h1>
                    <div class="">
                        {!! DNS1D::getBarcodeHTML($dataAwb->id, 'CODABAR') !!}
                        <p class="text-center">{{$dataAwb->id}}</p>
                    </div>
                </div>
            </div>

            <div class="box-wrapper w-100" style="height: 50px;">
                <table border="1" class="data-table w-100">
                    <tr>
                        <td>
                            <p>Account No:</p>
                            <h4>{{$from->id + 1500}}</h4>
                        </td>
                        <td>
                            <p>Reference:</p>
                            <h4>{{$dataAwb->refference}}</h4>
                        </td>
                        <td>
                            <p>Origin:</p>
                            <h4>{{$from->city}}</h4>
                        </td>
                        <td>
                            <p>Service:</p>
                            <h4>{{$service->name}}</h4>
                        </td>
                        <td>
                            <p>Destination:</p>
                            <h4>{{$to->city}}</h4>
                        </td>
                    </tr>
                </table>
            </div>
            <div class="" style="margin-top: 0;">
                <div class="float-left" style="width: 38%;">
                    <div class="black-border-1">
                        <h3 class="bg-black p-2">SHIPPER</h3>
                        <p class="p-1">
                            <span class="fw-bold">{{$from->company_name}}</span>
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
                    <div class="black-border-1" style="height: 80px;">
                        <div class="float-left" style="width: 50%; border-right: 1px solid black; height: 80px;">
                            <p class="p-1">
                                <small>Attention Name:</small>
                                <br>
                                <span class="fw-bold">{{$from->name}}</span>
                                <br>
                                <br>
                                <small>Telephone / Mobile</small>
                                <br>
                                <span class="fw-bold">{{$from->mobile}}</span>
                            </p>
                        </div>
                        <div class="float-right" style="width: 50%; line-break: anywhere;">
                            <p class="p-1">
                                <small>Email</small>
                                <br>
                                <span class="fw-bold" style="font-size: 9px;">{{$from->email}}</span>
                                <br>
                                <br>
                                <small>CNIC</small>
                                <br>
                                <span class="fw-bold">{{$from->identification_num}}</span>
                            </p>
                        </div>
                    </div>
                </div>
                <div class="float-left black-border-1" style="width: 20%; margin-left:15px;">
                    <div class="" style="border-bottom: 1px solid black;">
                        <p class="text-center">Total Pieces</p>
                    </div>
                    <div class="" style="border-bottom: 1px solid black;">
                        <h3 class="text-center fw-bold">{{$dataAwb->total_packets}}</h3>
                    </div>
                    <div class="" style="border-bottom: 1px solid black;">
                        <p class="text-center">Actual Weight ( KGs)</p>
                    </div>
                    <div class="" style="border-bottom: 1px solid black;">
                        <h3 class="text-center fw-bold">{{$dataAwb->total_weight}}</h3>
                    </div>
                    <div class="" style="border-bottom: 1px solid black;">
                        <p class="text-center" style="font-size: 12px;">Declared Value</p>
                    </div>
                    <div class="" style="border-bottom: 1px solid black;">
                        <h3 class="text-center fw-bold">
                            {{(int)$dataAwb->declared_value}} {{$dataAwb->currencyData->name}}
                        </h3>
                    </div>
                    <div class="" style="border-bottom: 1px solid black;">
                        <p class="text-center">Chargeable Weight</p>
                    </div>
                    <div class="" style="border-bottom: 1px solid black;">
                        <h3 class="text-center fw-bold">
                        @if ($dataAwb->total_weight > $dataAwb->dimentions)
                            {{$dataAwb->total_weight}}
                        @elseif($dataAwb->total_weight < $dataAwb->dimentions)
                            {{$dataAwb->dimentions}}
                        @endif
                        </h3>
                    </div>
                    <div class="" style="margin-bottom: 6px">
                        <div class="" style="margin-top: 6px; margin-left: 40px;" >
                            {!! DNS2D::getBarcodeHTML("$dataAwb->id", 'QRCODE', 3, 3) !!}
                        </div>
                    </div>
                </div>
                <div class="float-right" style="width: 38%;">
                    <div class="w-100 black-border-1">
                        <h3 class="bg-black p-2">COSIGNEE</h3>
                        <p class="p-1">
                            <span class="fw-bold">{{$to->company_name}}</span>
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
                    <div class="black-border-1" style="height: 80px;">
                        <div class="float-left" style="width: 50%; border-right: 1px solid black; height: 80px;">
                            <p class="p-1">
                                <small>Attention Name:</small>
                                <br>
                                <span class="fw-bold">{{$to->name}}</span>
                                <br>
                                <br>
                                <small>Telephone / Mobile</small>
                                <br>
                                <span class="fw-bold">{{$to->mobile}}</span>
                            </p>
                        </div>
                        <div class="float-right" style="width: 50%; line-break: anywhere;">
                            <p class="p-1">
                                <small>Email</small>
                                <br>
                                <span class="fw-bold" style="font-size: 9px;">{{$to->email}}</span>
                                <br>
                                <br>
                                <small>EORI</small>
                                <br>
                                <span class="fw-bold">{{$to->identification_num}}</span>
                            </p>
                        </div>
                    </div>
                </div>
            </div>
            <div class="" style="margin-top: 210px;">
                <table border="1" class="w-100" style="border: 1px solid black;">
                    <tr>
                        <td class="text-center"><p>Dimension</p></td>
                        <td class="text-center"><p>Description of shipment</p></td>
                        <td class="text-center"><p>PU Date</p></td>
                    </tr>
                    <tr>
                        <td class="text-center" rowspan="2" style="vertical-align:top;">
                            <p style="font-size: 10px !important; line-height: 0.6;">
                                <span>H x W x L</span>
                                <br><br>
                                @foreach($packets as $packet)
                                <span style="line-height: 1;">{{$packet->height}} x {{$packet->width}} x {{$packet->length}}</span><br>
                                @endforeach
                            </p>
                        </td>
                        <td rowspan="2" style="vertical-align:top;">
                            <p>{{$dataAwb->description}}</p>
                        </td>
                        <td class="text-center">{{date('d-m-Y', strtotime($dataAwb->created_at))}}</td>
                    </tr>
                    <tr>
                        <td width="250px" >
                            <p style="font-size: 10px;">Shipper warrants that all information furnished is true
                                and correct and that he / she / they have read and
                                clearly understand the standard conditions of carriage
                                of UDEX Pakistan</p>
                            <p class="text-right"><b>Shipper Sign:</b></p>
                        </td>
                    </tr>
                </table>
            </div>
        </div>
    </div>
</body>

</html>