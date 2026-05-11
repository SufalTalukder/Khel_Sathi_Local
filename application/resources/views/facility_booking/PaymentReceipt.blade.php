<!doctype html>
<html>

<head>
    <meta charset="utf-8">
    <title>Payment Receipt</title>
    <style>
        @import url("https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap");

        @font-face {
            font-family: "Open Sans", sans-serif;
            font-weight: normal;
            font-style: normal;
        }

        body {
            font-family: "Open Sans", sans-serif;
            font-size: 10px;
            margin: 0px;
            padding: 0px;
        }

        .table-responsive {
            overflow-x: auto;
        }

        .dn {
            display: none;
        }

        .table tr th,
        .table tr td {
            border: 1px solid #000;
            padding: 3px 3px;
            font-size: 9pt;
        }
    </style>
</head>

<body>

    <div  style="width:1000px; margin:0 auto;">
        <div id="content" style="position:relative;">
            <table border="0" cellspacing="0" cellpadding="4" width="100%" style="border-collapse:collapse;">
                <thead>
                    <tr>
                        <th colspan="2">
                            <div style="padding: 0 15px 10px; margin-bottom: 10px; border-bottom: 2px solid #000; position: relative;">
                                <img src="{{asset('facility_booking_storage/')}}/images/logo.png"
                                     style="width: 60px; height: auto; position: absolute; top: 0px; left: 20px;">
                                <h1 style="text-align: center; font-size: 20pt; margin: 0px 0px 0px 0px; padding: 0px 0 0; color: #383838; font-weight: bold;">
                                    Sports Directorate, Govt. of Uttar Pradesh
                                </h1>
                                <h2 style="text-align: center; margin:0px 0px 0px 0px; font-size:11pt; padding: 0px; color:#383838; font-weight: bold;">
                                    Khel Bhawan Hazratganj Lucknow, Uttar Pradesh 226001
                                </h2>
                            </div>
                            <h6 style="text-align: center; margin:10px 0px 15px 0px; font-size:12pt; padding: 0px; color:#383838; font-weight: bold; text-decoration:underline;">
                                >@if ($application->service == 1)

                                                    Swimming Pool (Mini)
                                                @elseif ($application->service == 2)
                                                Guest Room
                                                @elseif ($application->service == 3)
                                              Swimming Pool (Adult)
                                                @elseif ($application->service == 4)

                                                Gymnasium
                                                @elseif ($application->service == 5)
                                                Stadium
                                                @endif Payment Receipt
                            </h6>
                        </th>
                    </tr>
                    <tr>
                        <th style="font-size: 10pt; text-align:left">
                            <strong>Application No. : </strong> {{$application->application_no}}
                        </th>
                        <th style="text-align: right; font-size: 10pt;">
                            <strong>Department Code : </strong> EDU
                        </th>
                    </tr>
                    <tr>
                        <th style="font-size: 10pt; text-align:left">
                            <strong>Name : </strong> {{$application->name}}
                        </th>
                        <th style="text-align: right; font-size: 10pt;">
                            <strong>Reference ID : </strong> {{$application->ref_no}}
                        </th>
                    </tr>
                    <tr>
                        <th style="font-size: 10pt; text-align:left">
                            <strong>Mobile No. : </strong> {{$application->mobile}}
                        </th>
                        <th style="text-align: right; font-size: 10pt;">
                            <strong>Challan No. : </strong> {{$application->Depchallan}}
                        </th>
                    </tr>
                    <tr>
                        <th style="font-size: 10pt; text-align:left">
                            <strong>Email ID : </strong> {{$application->email}}
                        </th>
                        <th style="text-align: right; font-size: 10pt;">
                            <strong>Date : </strong> {{dmy($application->date_of_payment_attempt)}}
                        </th>
                    </tr>
                    <tr>
                        <th colspan="2" style="font-size: 10pt; text-align:left">
                            <strong>Year : </strong> 2024-2025
                        </th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td colspan="2">
                            <div class="table-responsive">
                                <table class="table" border="0" cellspacing="0" cellpadding="3" width="100%"
                                       style="border-collapse:collapse; font-size:10pt;">
                                    <thead>
                                        <tr>
                                            <th>S.No.</th>
                                            <th>Stadium</th>
                                            <th>Sport</th>
                                            <th>Fee (Rs.)</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td align="center">1</td>
                                            <td>{{stadium_name($application->stadium)}}</td>
                                            <td>
                                                @if ($application->sport_id)
                                                {{sport_name($application->sport_id)}}
                                                @else
                                                    NA
                                                @endif</td>

                                            <td align="right">{{$application->AMOUNT}}</td>
                                        </tr>
                                        <tr>
                                            <td align="right" colspan="3"><b>Total</b></td>
                                            <td align="right"><b>{{$application->AMOUNT}}</b></td>
                                        </tr>
                                    </tbody>
                                    <tfoot class="dn">
                                        <tr>
                                            <td colspan="4" style="border:0; height:30px;">&nbsp;</td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <p style="font-size:14px; color:#f00;"><b>Note:-</b> Applicant get their ID Card Offline by showing payment receipt to RSO/SO</p>
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>

    <script>
        function PrintDoc() {
            var toPrint = document.getElementById('prodiv');

            var popupWin = window.open('', '_blank', 'left=100,top=100,width=1100,height=600,tollbar=0,scrollbars=1,status=0,resizable=1');

            popupWin.document.open();

            popupWin.document.write('<html><title>Readiness_Report</title><head><style>body{font-family: "Open Sans", sans-serif;} .noprint{display: none;} table{width:100%; border-collapse:collapse;} .table tr th, .table tr td{border:1px solid #000; padding:3px 3px; font-size: 10pt;} @page {size: A4 landscape; margin: 10pt 10pt 20pt 10pt;}</style></head><body onload="window.print()">')

            popupWin.document.write(toPrint.innerHTML);

            popupWin.document.write('<div style="text-align:center; width:98%; font-size:9pt; padding:0px; position:fixed; bottom:0;">This is a Software Generated Report.</div></body></html>');

            popupWin.document.close();
        }
    </script>
</body>

</html>
