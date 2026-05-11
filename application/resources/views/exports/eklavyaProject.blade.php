<!DOCTYPE html>
<html>

<head>
    <title>Khel Sathi</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <style>
        .subheading {
            color: #000;
            margin: 10px 0px 10px 0px;
            padding-bottom: 10px;
            border-bottom: 1px solid #ccc;
            font-size: 16px;
            font-weight: 600;
        }
    </style>
    <style>
        @import url('https://fonts.googleapis.com/css2?family=Open+Sans:ital,wght@0,300..800;1,300..800&display=swap');

        @font-face {
            font-family: 'Open Sans', sans-serif;
            font-weight: normal;
            font-style: normal;
        }

        body {
            font-family: 'Open Sans', sans-serif
        }

        table tr td {
            font-family: 'Open Sans', sans-serif;
            font-weight: normal;
            font-size: 10pt
        }

        table tr th {
            font-family: 'Open Sans', sans-serif;
            font-weight: bold;
            font-size: 10pt
        }

        .dn {
            display: none;
        }


        h1,
        h2,
        h5,
        h6 {
            font-weight: bolder;
            line-height: 0.85, font-family: 'Open Sans', sans-serif;
        }

        .table tr td,
        .table tr th {
            border: 1px solid #000;
            padding: 5px 3px;
            font-family: 'Open Sans', sans-serif;
        }

        @page {
            size: A4 landscape;
            margin: 10pt 10pt 20pt 10pt;
        }
    </style>
</head>
<?php
$col_span = 11;
?>

<body>

    <div style="text-align: right; padding: 5px 0; width: 90%; margin: 0 auto;">
        <button type="button" class="btn btn-default btn-primary" data-print="modal" onclick="PrintDoc()">Print</button>
    </div>
    <div id="prodiv" style="width: 100%; margin: 0 auto;">
        <table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
            <thead>
                <tr>
                    <th colspan="2">
                        <div
                            style="padding: 0 15px 3px; margin-bottom: 5px; margin-top:10px; border-bottom: 2px solid #000; position: relative; line-height: 1;">
                            <img src="{{ asset('') }}/assets_admin/images/logo.png"
                                style="width: 75px; height: auto; position: absolute; top: 0px; left: 20px;">
                            <h1
                                style="text-align: center; font-size: 20pt; margin: 0px 0px 0px 0px; padding: 0px 0 0; color: #000;">
                                Sports Directorate, Uttar Pradesh
                            </h1>
                            <h2
                                style="text-align: center; margin:3px 0px 10px 0px; font-size:11pt; padding: 0px; color:#000;">
                                Khel Bhawan, Hazratganj, Lucknow, Uttar Pradesh 226001
                            </h2>
                            <h5
                                style="text-align: center; margin:0px 0px 0px 0px; font-size:16pt; padding: 0px; color:#000;">
                                Khel Sathi Portal
                            </h5>

                        </div>
                        <h6
                            style="text-align: center; margin:0px 0px 0px 0px; font-weight: 700; font-size:14pt; padding: 0px; color:#000; ">
                            {{ $form_name }}
                        </h6>
                        <h6
                            style="text-align: center; margin:0px 0px 8px 0px; font-size:12pt; font-weight: 700; padding: 0px; color:#000; text-decoration:underline;">
                            {{ $name }}
                        </h6>
                    </th>
                </tr>
                <tr>
                    <th style="font-size: 10pt; text-align:left">&nbsp;

                    </th>
                    <th style="text-align: right; font-size: 10pt;">
                        <b>Report Code : {{ $report_code }}</b>
                    </th>
                </tr>
                <tr>
                    <th style="font-size: 10pt; text-align:left">
                        <b>Report Period : </b>
                        @if ($from_date)
                            {{ dmy($from_date) }}
                        @else
                            01-04-2023
                            @endif To @if ($to_date)
                                {{ dmy($to_date) }}
                            @else
                                {{ dmy(now()) }}
                            @endif
                    </th>
                    <th style="text-align: right; font-size: 10pt;">
                        <b>Report Generated On : </b>
                        {{ now()->format('d-m-Y h:i A') }}
                    </th>
                </tr>
            </thead>
        </table>
        <table class="table" border="0" cellspacing="0" cellpadding="5" style="width: 100%;">
            <thead>
                
                    <th>S.No.</th>
                    <th>Application No.</th>
                    <th>Applicant’s / Father Name</th>
                    <th>Address & Contact Details</th>
                    <th>Sports Name</th>
                    <th>Name of Competition</th>
                    <th>Position / Medal</th>
                    <th>Purpose</th>
                    <th>Government Order regarding Financial Assistance / Fellowship / Honorarium</th>
                    <th>Qualified / Disqualified</th>
                    <th>Previously approved</th>
               
            </thead>
            <tbody>
                @php
                    $rowCounts = 0;

                @endphp
                @if (count($summary) > 0)
                    @foreach ($summary as $key => $list)
                        @php
                            $rowCounts++;
                            $pageBreak = 'na';
                            if ($rowCounts > $row_count) {
                                $rowCounts = 1;
                                $pageBreak = '';
                            }
                        @endphp

                        <tr>

                            <td>{{ $key + 1 }}</td>
                            <td>{{ $list->application_no }}</td>

                            <td style="text-transform: capitalize;">{{ ucwords(strtolower($list->fullname)) }}, Son of
                                {{ ucwords(strtolower($list->father_name)) }}</td>

                            <td>{{ $list->permanent_address }} {{ districtName($list->permanent_district) }}<br>
                                <b>Email</b> : - {{ $list->email }}<br>
                                <b>Mobile</b> : - {{ $list->mobile }}
                            </td>
                            <td>{{ $list->sportName }}</td>



                            <?php $data = PosiCompetition($list->application_no); ?>
                            <td>

                                @if (count($data) > 0)
                                    @foreach ($data as $item)
                                        {{-- {{ PosiEventMaster($item->event_name) }}, --}}
                                        {{$item->event_details}},
                                        {{-- {{ PosiEventName($item->competition_name) }}, --}}
                                        <b>Venue-</b>{{ $item->sport_place }},<br>
                                        <b>Date-</b> {{ $item->competition_from_date }} to
                                        {{ $item->competition_to_date }},<br>
                                        @if ($item->event_type == 1)
                                            Individual
                                        @elseif($item->event_type == 2)
                                            Team
                                        @elseif($item->event_type == 3)
                                            Both
                                        @endif
                                        <br> <br>
                                    @endforeach
                                @endif
                            </td>
                            <td>
                                @if (count($data) > 0)
                                    @foreach ($data as $item)
                                        {{ $item->earned_medals }} <br> <br>
                                    @endforeach
                                @endif
                            </td>
                            <td>{{ $list->purpose }}</td>
                            <td></td>
                            <td></td>
                            <td></td>


                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="11">
                            <h4 style="text-align: center;"> No records Found!.</h4>
                        </td>
                    </tr>
                @endif


            </tbody>
            <tfoot class="dn">
                <tr>
                    <td colspan="11" style="border:0 !important; height:30px;">&nbsp;</td>
                </tr>
            </tfoot>

        </table>
    </div>




    <script>
        function PrintDoc() {
            var toPrint = document.getElementById('prodiv');

            var popupWin = window.open('', '_blank',
                'left=100,top=100,width=1100,height=600,tollbar=0,scrollbars=1,status=0,resizable=1');

            popupWin.document.open();

            popupWin.document.write(
                '<html><head><style>body{font-family:Arial; counter-reset: page;} .noprint{display: none;} table{width:100%; border-collapse:collapse;} .table tr th, .table tr td{border:1px solid #000; padding:3px 3px; font-size: 10pt;} @page {size: A4 landscape; margin: 10pt 10pt 20pt 10pt;}</style></head><body onload="window.print()">'
                )

            popupWin.document.write(toPrint.innerHTML);

            popupWin.document.write(
                '<div style="text-align:center; width:98%; font-size:9pt; padding:0px; position:fixed; bottom:0;">This is a Software Generated Report.</div></body></html>'
                );

            popupWin.document.close();
        }
    </script>
</body>

</html>
