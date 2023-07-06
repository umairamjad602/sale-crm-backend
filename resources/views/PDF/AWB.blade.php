<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
        font-family: Arial, Helvetica, sans-serif;
        overflow-wrap: break-word;
    }
    .w-100 {
        width: 100%;
    }
    .logo {
        width: 110px;
    }
    table {
        border-collapse: collapse;
    }
    .font-bold {
        font-weight: bold;
    }
    .display-inline {
        display: inline-block;
    }
    .float-right {
        float: right;
    }
    .text-right {
        text-align: right;
    }
    td {
        padding: 5px;
    }
    .container {
        padding: 20px 0px;
    }
    .border {
        border: 1px solid black;
    }
    .text-center {
        text-align: center;
    }
    .content{
        font-size: 8px;
    }
</style>
<body style="padding: 0px 20px;">
    <div class="w-100 container">
        <img class="logo" src="{{url('assets/images/logo.jpeg')}}" alt="Test">
        <div class="float-right">
            <h1 class="text-right">AWB</h1>
            <table border="1">
                <tr>
                    <td>
                        <span>Oigin:</span>
                        <br>
                        <span class="font-bold">Karachi</span>
                    </td>
                    <td>
                        <span>Via:</span>
                        <br>
                        <span class="font-bold">Direct</span>
                    </td>
                    <td>
                        <span>Destination:</span>
                        <br>
                        <span class="font-bold">UAE</span>
                    </td>
                    <td>
                        <span>Country Code:</span>
                        <br>
                        <span class="font-bold">UAE</span>
                    </td>
                </tr>
            </table>
        </div>
    </div>
    <div class="w-100 container">
        <div class="border" style="width: 20%; height: 60px; padding: 5px; margin: -25px 0 0 0;">
            <span>Account No:</span>
            <br>
            <span class="font-bold">7767</span>
        </div>
        <div class="w-100" style="padding-top: 10px;">
        <div class="display-inline" style="width: 22%; padding: 5px; height: 50px; margin: 0 0 0 30px;">
            <div style="width: 30px; transform: rotate(90);">
                {!! DNS1D::getBarcodeHTML("4445645656", 'CODABAR') !!}
                <p style="padding: 5px 55px; margin: 0 auto; overflow-wrap: none;">4445645656</p>
            </div>
                
            </div>
            <div class="float-right" style="width: 83%; margin: -40px 0 0 0;">
                <div class="display-inline" style="width: 40%; padding-right: 10px;">
                    <div class="border w-100" style="padding: 5px; margin-top: -50;">
                        <p style="font-size: 20px; margin-left: 40px;">Shipper</p>
                        <br>
                        <p><b>Imraz Fiaz</b></p>
                        <p>HOUSE# 2076, HASSAN ALI MIR
                            MOHAMMAD ROAD NAWALINE LYARI PO
                        </p>
                        <p>CHAKIWARA</p>
                        <p>74200</p>
                        <p>Karachi</p>
                        <p>Pakistan</p>
                    </div>
                    <div class="border w-100" style="padding: 5px;">
                        <p>NTN / CNIC:</p>
                        <p><b>4230108650705</b></p>
                        <p style="margin-top: 5px;">Telephone / Mobile:</p>
                        <p><b>03472575881</b></p>
                    </div>
                </div>
                <div class="float-right" style="width: 55%; padding: 0 0 0 50px;">
                    <table border="1" class="w-100">
                        <tr>
                            <td>Total Pieces</td>
                            <td>Weight (KGs)</td>
                            <td>Description of shipment</td>
                        </tr>
                        <tr>
                            <td class="text-center"><b>1</b></td>
                            <td class="text-center"><b>12</b></td>
                            <td class="text-center"><b>Metal pieces box</b></td>
                        </tr>
                    </table>
                    <div class="w-100" style="padding-top: 10px; position: relative; z-index: 10;">
                        <div style="width: 78%; padding: 5px; margin-left: -49px;">
                            <div class="border display-inline" style="padding: 10px 5px; width: 40px; background-color: #fff; margin: 0 0 0 -35px;">
                                <p class="text-center">C</p>
                                <p class="text-center">O</p>
                                <p class="text-center">S</p>
                                <p class="text-center">I</p>
                                <p class="text-center">G</p>
                                <p class="text-center">N</p>
                                <p class="text-center">E</p>
                                <p class="text-center">E</p>
                            </div>
                            <div class="border float-right" style="width: 87%; padding: 10px; background-color: #fff;">
                                <p><b>Imraz Fiaz</b></p>
                                <p>HOUSE# 2076, HASSAN ALI MIR
                                    MOHAMMAD ROAD NAWALINE LYARI PO
                                </p>
                                <p>CHAKIWARA</p>
                                <p>74200</p>
                                <p>Karachi</p>
                                <p>Pakistan</p>
                            </div>
                            <div class="float-right" style="width: 15px; position: absolute; top: 50; right: 0;">
                                {!! DNS2D::getBarcodeHTML("4445645656", 'QRCODE', 5, 5) !!}
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="w-100" style="margin-top: 250px;">
            <table border="1" class="w-100">
                <tr>
                    <td class="text-center">Dimension</td>
                    <td class="text-center">Charges</td>
                    <td class="text-center">Discount</td>
                    <td class="text-center">GST</td>
                    <td class="text-center">PU Date</td>
                    <td class="text-center">PU Time</td>
                </tr>
                <tr>
                    <td class="text-center" style="padding: 5px 15px;">
                        <b>
                        7.8
                        </b>
                    </td>
                    <td class="text-center"><b>12</b></td>
                    <td class="text-center"><b>0</b></td>
                    <td class="text-center"><b>0</b></td>
                    <td class="text-center"><b>02-08-22</b></td>
                    <td class="text-center"><b>02-08-22</b></td>
                </tr>
                <tr>
                    <td colspan="2" style="padding: 10px;">
                        <p>Name of Recepient:</p>
                        <p style="margin-top: 10px;"><b>Khawar UEX</b></p>
                    </td>
                    <td width="30" colspan="3" style="padding: 10px; padding-right: 120px;">
                        <p style="font-size: 10px;">Shipper warrants that all information furnished is true
                            and correct and that he / she / they have read and
                            clearly understand the standard conditions of carriage
                            of WEX Paki</p>
                            <p class="text-right"><b>Shipper Sign:</b></p>
                    </td>
                    <td colspan="2" style="padding: 10px; vertical-align: baseline;">
                        <p>Courier’s Sig:</p>
                    </td>
                </tr>
            </table>
        </div>
    </div>

    <div class="content" style="float:left !important; width: 45%; line-height: 0.8; overflow-wrap: break-word; text-align: justify;">
        <p>In tendering the shipment for carriage, the customer agrees to these terms and conditions of carriage and
            that this airway bill is NON-NEGOTIABLE andhas been prepared by the customer or on the customer's behalf by
            WEX. As used in these conditions, WEX includes WEX Pakistan (Pvt.) Ltd., alloperating divisions and
            subsidiaries of
            WEX Pakistan (Pvt.) Ltd and their respective agents, servants, officers and employees.</p>
        <ol>
            <li>
                SCOPE OF CONDITIONS
                These conditions shall govern and apply to all services provided by WEX, BY SIGNING THIS AIRBILL,and THE
                CUSTOMER ACKNOWLEDGES THAT HE/SHE HAS READ THESE CONDITIONS AND AGREES TO BE BOUND BYEACH OF THEM. WEX
                shall not be bound by any agreement which varies from these conditions, unless such agreement is in
                writingand signed by an authorized officer of WEX. In the absence of such written agreement, these
                conditions shall constitute the entireagreement between WEX and each of its customers. NO employee of
                WEX shall have the authority to alter or waive these terms andconditions, except as stated herein.
            </li>
            <li>
                WEX’S OBLIGATIONS
                WEX agrees, subject to payment of applicable rates and charges in effect on the date of acceptance by
                WEX ofa customer's shipment, to arrange for the transportation of the shipment between the locations
                agreed upon by WEX and the customer.WEX reserves the right to transport the customer's shipment by any
                route and procedure and by successive carriers and according to itsown handling, storage and
                transportation methods.
            </li>
            <li>
                SERVICE RESTRICTION
                a. WEX reserves the right to refuse any documents or parcels from any person, firm, or company at its
                owndiscretion.
                b. WEX reserves the right to abandon carriage of any shipment at any time after acceptance when such
                shipment couldpossibly cause damage or delay to other shipments, equipment or personnel, or when any
                such carriage is prohibited by law or is inviolation of any of the rules contained herein.
                c. WEX reserves the right to open and inspect any shipment consigned by a customer toensure that it is
                capable of carriage to the state or country of destination within the standard customs procedures and
                handling methods ofWEX. In exercising this right, WEX does not warrant that any particular item to be
                carried is capable of carriage, without infringing thelaw of any country or state through which the item
                may be carried.
            </li>
            <li>
                LIMITATION OF LIABILITY
                Subject to Section 5 and 6 hereof:
                a. WEX will be responsible for the customer's shipment only while it iswithin WEX custody and control.
                WEX shall not be liable for loss or damage of a shipment while shipment is out of WEX's custody
                orcontrol. WEX’S LIABILITY IS IN ANY EVENT LIMITED TO ONE HUNDRED DOLLARS (US$100/=) or its equivalent
                pershipment. Incase of high value shipments, customer should opt for INSURANCE.
                b. The actual value of a shipment shall be ascertainedby reference to its replacement, reconstitution or
                reconstruction value at the time and place of shipment, whichever is less, withoutreference to its
                commercial utility to the customer or to other items of consequential loss.
            </li>
            <li>
                CONEQUENTIAL DAMAGES EXCLUDED 5
                WEX SHALL NOT BE LIABLE, IN ANY EVENT,, FOR ANY CONSEQUENTIALOR SPECIAL OR INCIDENTAL DAMAGE OR OTHER
                INDIRECT LOSS HOWEVER ARISING, WHETHER OR NOT WEX HADKNOWLEDGE THAT SUCH DAMAGE MIGHT BE INCURRED,
                INCLUDING, BUT NOT LIMITED TO LOSS OF INCOME,PROFITS, INTEREST, UTILITY OR LOSS OF MARKET.
            </li>
            <li>
                LIABILITY NOT ASSUMED:
                a. WEX shall be not liable for any loss, damage, delay, misdelivery, nondelivery not caused by its
                ownnegligence, or for any loss, damage, delay, misdelivery or non-delivery caused by:
                i. the act, default or omission the shipper or consigneeor any other party who claims an interest in the
                shipment.
                ii. The nature of the shipment or any defect, characteristic, or inherent vicethereof.
                iii. Violation by the shipper or consignee of any term or condition stated herein including, but not
                limited to, improper orinsufficient packing, securing, marking or addressing, misdescribing the contents
                of any shipment or failure to observe any of these rulesrelating to the shipments not acceptable for
                transportation whether such rules are now or hereafter promulgated by WEX.
                iv. Acts of God,perils of the air, enemies, public authorities acting with actual or apparent authority
                or law, acts or omission of postal, customs or othergovernment officials, riots, strikes, or other local
                disputes, hazard incidents to a state of war, weather conditions, temperature oratmospheric changes or
                conditions, mechanical or other delay, of any aircraft used in providing transportation services or any
                other causereasonably beyond the control of WEX.
                v. Acts or omissions of any postal service, forwarder, or any other entity to whom a shipment istendered
                by WEX for transportation, regardless of whether the shipper requested or had knowledge of such third
                party deliveryrequirement.
                vi. Electrical or magnetic injury, erasure, or other such damage to electronic or photographic images or
                recordings in anyform, or damage due to insects or vermin.
                b. While WEX will endeavour to exercise its best efforts to provide expeditious delivery inaccordance
                with regular delivery schedules, WEX will not under any circumstances be liable for delay in pickup,
                transportation ordelivery of any shipment regardless of the causes of such delay
            </li>
        </ol>

    </div>
    <div class="content" style="float: right !important; width: 45%; line-height: 0.8; overflow-wrap: break-word; text-align: justify;">
        <ol> 
            <li>
                MATERIALS NOT ACCEPTABLE FOR TRANSPORT:
                a. WEX will notify customer from time to time as to certain classes ofmaterials which are not accepted
                by WEX for carriage. It is the customer's responsibility to accurately describe the shipment on
                thisAirway bill and to ensure that no material is delivered to WEX which has been declared to be
                unacceptable by WEX.
                b. WEX will notcarry:
                property, the carriage of which is prohibited by any law, regulation or state or local government of any
                country from, to or throughwhich the property maybe carried: and firearms, bullion, works of art,
                negotiable instruments in bearer form, jewelry, precious metals,precious stones, lewd obscene or
                pornographic material, currency, stamps, deeds, hazardous or combustible material, cashier's
                checks,money orders, travelers’ checks, industrial carbon and diamonds, antiques, plants, and animals.
                c. In the event that any customer shouldconsign to WEX any such item, as described above, or any item
                which the customer has undervalued for customs purposes ormisdiscribed, whether intentionally or
                otherwise the customer shall indemnify and hold WEX harmless from all claims, damages, finesand expenses
                arising in connection therewith, and WEX shall have the right to abandon such property and / or release
                possession of saidproperty to any agent or employee of any national or local government claiming
                jurisdiction over such materials. Immediately uponWEX’s obtaining knowledge that such materials
                infringing these conditions have been turned over to WEX shall be free to exercise anyof its rights
                reserved to it under this section without incurring liability whatsoever to the customer.
            </li>
            <li>
                PACKAGING:
                The packaging of the customer's documents or goods for transportation is the customer's sole
                responsibility, including theplacing of the goods or documents in any container which may be supplied by
                the customer to WEX. WEX accepts no responsibility forloss or damage to documents or goods caused by
                inadequate or inappropriate packaging. It is the sole responsibility of the customer toaddress
                adequately each consignment of documents or goods to enable effective delivery to be made. WEX shall not
                be liable for delay inforwarding or delivery resulting from the customer's failure to comply with its
                obligations in this respect.
            </li>
            <li>
                NEGLIGENCE:
                The customer is liable for all losses, damages and expenses arising as a result of its failure to comply
                with its obligationsunder this agreement as a result of its negligence
            </li>
            <li>
                CHARGES:
                Any rates quoted by WEX for carriage are inclusive of local airport taxes, but exclusive of any value
                added taxes, duties,levies, imposts, deposits or outlays incurred in respect of carriage of the
                customer's goods. Should the customer indicate by endorsementin the space provided on the airway bill
                that the receiver shall be liable for any customs duty, the customer shall be liable for suchcustoms
                duty in the event of a default in payment by the receiver. WEX will not be liable for any penalties
                imposed or loss or damageincurred due to the customer's documents or goods being impounded by customs or
                similar authorities and the customer herebyindemnifies WEX against such penalty or loss.
            </li>
            <li>
                PROPERTY:
                WEX will only carry documents or goods which are the property of the customer and the customer warrants
                that it isauthorized to accept and is accepting these conditions not only on behalf of itself but as
                agent and on behalf of all other persons who areor may hereafter be interested in the documents or
                goods. The customer hereby undertakes to indemnify WEX against any damages,costs and expenses resulting
                from any breach of this warranty.
            </li>
            <li>
                CLAIMS
                ANY CLAIMS AGAINST WEX MUST BE SUBMITTED IN WRITING TO THE OFFICE OF WEX NEAREST THELOCATION WHERE THE
                SHIPMENT WAS ACCEPTED, WITHIN FIFTEEN (15 DAYS) OF THE DATE OF ACCEPTANCE BYWEX.
            </li>
            <li>
                NON-DELIVERY OF SHIPMENT
                Notwithstanding the shipper's instruction to the contrary, the shipper shall be liable for all costs
                andexpenses related to the shipment of the package, and for costs incurred in either returning the
                shipment or warehousing the shipmentpending disposition.
            </li>
            <li>
                INSURANCE:
                a. CONSEQUENTIAL DAMAGES AND LOSS OR DAMAGE RESULTING FROM DELAYS INTRANSPORTATION ARE NOT COVERED BY
                ANY SUCH POLICY OF INSURANCE
            </li>
            <li>
                WARSAW CONVENTION:
                "Where the rules relating to liability established by the Warsaw convention or the CMR convention
                apply,the carrier's liability is governed by and shall be limited in accordance with such rules. Subject
                to applicable law, where the Warsawconvention or the CMR conventions do not apply, liability to loss or
                damage is governed by these terms& conditions and shall be limitedto proven damages up to an amount not
                exceeding USD 100 / shipment."
                THIS IS A NON NEGOTIABLE AIRBILL. ALL SERVICESPROVIDED ARE SUBJECT TO THE TERMS AND CONDITIONS SET FORTH
                ON THE SHIPPER’’S COPY. BY SIGNING THISAIRBILL, THE SHIPPER ACKNOWLEDGES THAT HE/SHE HAS READ THESE
                CONDITIONS AND AGREES TO BE BOUNDBY EACH OF THEM. WEX’S LIABILITY IS LIMITED TO US$ 100.00 IN TENDERING
                THIS SHIPMENT SHIPPER AGREESTHAT WEX SHALL NOT BE LIABLE FOR SPECIAL INCIDENTIAL OR CONSEQUENTIAL
                DAMAGES ARISING FROM THECARRIAGE HEREOF, WEX DISCLAIMS ALL WARRANTIES. EXPRESS OR IMPLIED WITH RESPECT
                TO THIS SHIPMENT
            </li>
        </ol>
    </div>
</body>
</html>
