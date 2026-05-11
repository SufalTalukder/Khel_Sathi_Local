<!doctype html>
<html>

<head>
    <meta charset="utf-8">

    <style>
        @import url('https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,400;0,500;0,600;0,700;1,400;1,500;1,600;1,700&display=swap');

        @import url('https://fonts.googleapis.com/css2?family=Tiro+Devanagari+Sanskrit:ital@0;1&display=swap');

        .hi {
            font-family: 'Tiro Devanagari Sanskrit', serif;
        }

        .en {
            font-family: 'Open Sans', sans-serif;
        }

        body {
            font-family: 'Open Sans', sans-serif;
            font-size: 10px;
            margin: 0px;
            padding: 0px;
        }

        .tbl-brd-table {
            border-left: 0.01em solid #ccc;
            border-right: 0;
            border-top: 0.01em solid #ccc;
            border-bottom: 0;
            border-collapse: collapse;
        }

        .tbl-brd td,
        .tbl-brd th {
            border-left: 0;
            border-right: 0.01em solid #ccc;
            border-top: 0;
            border-bottom: 0.01em solid #ccc;
            border: 1px solid black;
            padding: 3px;
			font-size: 10px
        }


    </style>
<div class="container-fluid pagecontentbody">
    <div class="tab-content">
       <div id="prodiv" style="margin: 0 auto;width: 100%;font-size: 14px;">
            <div class="receipt-main" id="printableArea">

                <br>
                <table width="100%" border="1" class="receipt-header" style="border: 0;">
                    <tbody>
                        <tr>
                            <td class="receipt-left" style="width: 80px; border: 0;">
                                <img class="img-responsive" alt="iamgurdeeposahan" src="{{ asset('') }}/assets_admin/images/logo.png" style="width: 60px;"/>

                            </td>
                            <td style="border: 0; text-align: center; padding-right: 90px;">
                                <h2 style="margin: 0 0 5px;">Khel Sathi Portal</h2>
                                <p style="margin: 0;"> Government of Uttar Pradesh</p>

                            </td>
                        </tr>
                    </tbody>
                </table>
                <hr>
                <table width="100%" border="0" class="  receipt-header-mid" style="border: 0; font-size: 12px; margin-bottom: 5px;">
                    <tbody>
                        <tr>
                            <td colspan="4">
                                <div class="receipt-left">
                                    <h4 align="center" style="font-size: 16px;">Payment Receipt of Hostel Application</h4>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="font-size: 14px;">
                                <b> Name</b>
                            </td>
                            <td style="font-size: 14px;" colspan="3">
                                <b>: &nbsp;</b> <b>{{ $userDetails->name }}</b>
                            </td>
                        </tr>
                        @php
$challan =  DB::table('rajkosh_payment_response')
                       ->join('rajkosh_payment_request', 'rajkosh_payment_request.Depchallan', '=', 'rajkosh_payment_response.challan_no')
                       ->join('hostel_register', 'rajkosh_payment_request.application_no', '=', 'hostel_register.application_no')
                       ->where('hostel_register.application_no', $userDetails->application_no)
                       ->select('rajkosh_payment_request.Depchallan')
                       ->first()
@endphp
                        <tr>
                            <td style="width: 15%;"><b>Challan No.</b></td>
                            <td style="width: 45%;"><b>: &nbsp;</b>   @if($challan)

                                {{$challan->Depchallan}}
                                @endif </td>
                            <td style="width: 10%;"><b>Email</b></td>
                            <td><b>: &nbsp;</b> {{ $userDetails->email }}</td>
                        </tr>
                        <tr>
                            <td><b>Bank Name</b></td>
                            <td><b>: &nbsp;</b>State Bank Of India</td>
                            <td><b> Mobile No.</b></td>
                            <td><b>: &nbsp;</b> +91 {{$userDetails->mobile }}</td>


                        </tr>

                        <tr>
                            <td><b>Payment Date</b></td>
                            <td><b>: &nbsp;</b>{{date('d-m-Y',strtotime($userDetails->payment_date))}}</td>
                        </tr>
                    </tbody>
                </table>
                <table class="table tbl-brd tbl-brd-table" >
                    <thead>
                        <tr>
                            <th width="80" align="center">Sr. No.</th>
                            <th width="120">Application No.</th>
                            <th width="120">Aadhar Number</th>
                            <th width="120">Sports Name</th>
                            <th >Amount</th>
                        </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td align="center">1</td>
                            <td align="center">{{!empty($userDetails->application_no)? ($userDetails->application_no):'N/A'}}</td>
                            <td align="center">{{!empty($userDetails->aadhar)? ($userDetails->aadhar):'N/A'}}</td>
                            <td align="center">{{sport_name($userDetails->applicationBasicDetasils->sports)}}  </td>
                            <td align="right"> 10</td>
                        </tr>

                        <tr>
                            <td colspan="3" align="right" class="text-right h3">
                                <strong>Total</strong>
                            </td>
                            <td colspan="2" align="right" class="text-right text-success h3">
                                <strong>Rs.&nbsp;&nbsp;</strong>10
                            </td>
                        </tr>
                    </tbody>
                </table>

            </div>
        </div>
    </div>
</div>
