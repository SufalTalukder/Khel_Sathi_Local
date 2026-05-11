<!DOCTYPE html>
<html>

<head>
    <title>Khel Sathi</title>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />

    <style>
        .tblbrdr {
            width: 100%;
            border-collapse: collapse;
        }

        .tblbrdr tr td {
            border: 1px solid #000;
            font-size: 14px;
        }

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
            font-weight: bold
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
            padding: 5px;
            font-family: 'Open Sans', sans-serif;
        }

        @page {
            size: A4 landscape;
            margin: 15pt 15pt 15pt 15pt;
        }
    </style>


</head>

<body>

    <div id="prodiv" style="width: 100%; margin: 0 auto;">
        <table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
            {{-- <thead>
                <tr>

                    <td style="text-align: center;">
                        <!-- <img width="61" height="62" src="{{ url('/public') }}/admin/images/logo.png" align="left" hspace="5" /> -->
                        <strong style="font-size: 15pt;">Khel Sathi Portal</strong><br />
                        <strong>
                            Government of Uttar Pradesh
                        </strong>
                        <p style="text-align: center; font-weight: 600; font-size: 18px; margin:5px 0;">
                            {{$form_name}}
                        </p>
                    </td>
                </tr>
                <!-- <tr> -->
                <!-- <td align="right" style="border-bottom: 1px solid #000;">
                        <strong>Print Date : </strong><?= date('d-m-Y') ?>
                    </td> -->
                <!-- <td style="border-bottom: 1px solid #000;">
                        <strong>Report Period : </strong>{{$from_date}} to {{$to_date}}
                        <div style="text-align:right;"><strong>Print Date : </strong><?= date('d-m-Y') ?></div>
                    </td>
                </tr> -->
                <tr style="background-color: #fdf8f8;">
                    <td>
                        <strong>Report Period :</strong> {{$from_date}} to {{$to_date}} &nbsp;<span
                            style="float:right;"><strong> Report Printed on :</strong>
                            <?= date('d-m-Y') ?>
                        </span>
                    </td>
                    <!-- <td style="width: 50%;" >
                    <strong> Print Date :</strong> <?= date('d-m-Y') ?>
                    </td> -->
                </tr>
            </thead> --}}


            <thead>
                <tr>
                    <th colspan="2">
                        <div
                            style="padding: 0 15px 3px; margin-bottom: 10px; margin-top:10px; border-bottom: 2px solid #000; position: relative; line-height: 1;">
                            <img src="{{ url('/public') }}/admin/images/logo.png"
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
                            style="text-align: center; margin:0px 0px 0px 0px; font-size:14pt; padding: 0px; color:#000; ">
                            {{ $form_name }}
                        </h6>
                        <h6
                            style="text-align: center; margin:0px 0px 15px 0px; font-size:12pt; padding: 0px; color:#000; text-decoration:underline;">
                            {{ $name }}
                        </h6>
                    </th>
                </tr>
                <tr>


                </tr>
                <tr>
                    <th style="font-size: 10pt; text-align:left">
                        &nbsp;
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

            <tbody>
                <tr>
                    <td colspan="2">
                        <table class="table" border="1" cellspacing="0" cellpadding="5" style="width: 100%;">
                            <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Application No.</th>
                                    @if ($form_type == 6)
                                        <th>Post Name</th>
                                    @endif
                                    <th>Applicant’s Name</th>
                                    <th>Email ID</th>
                                    <th>Sport Name</th>
                                    <th>Date of Application</th>
                                    <th>Application Status</th>
                                    <th>Query Status</th>
                                    @if ($form_type != 6)
                                        <th>Amount (In INR)</th>
                                    @endif
                                </tr>
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
                                                $rowCounts = 0;
                                                $pageBreak = '';
                                            }
                                        @endphp

                                        <tr style="@if ($rowCounts == $row_count) page-break-after: always @endif">

                                            <td>{{ $key + 1 }}</td>
                                            <td>{{ $list->application_no }}</td>
                                            @if ($form_type == 6)
                                                <td>{{ ucwords(strtolower(AppliedPostName($list->user_id))) }}</td>
                                            @endif
                                            <td style="text-transform: capitalize;">{{ ucwords(strtolower($list->fullname ))}}</td>
                                            <td>{{ $list->email }}</td>
                                            <td>{{ $list->sportName }}</td>
                                            <td>{{ date('d-m-Y', strtotime($list->created_at)) }}</td>
                                            <td>
                                                <?php if($list->form_status == 1) { ?>
                                                <span class="btn btn-success">Accepted</span>
                                                <?php } elseif($list->form_status == 3) { ?>
                                                <span class="btn btn-danger">Pending</span>
                                                <?php } elseif($list->form_status == 2) { ?>
                                                <span class="btn btn-danger">Declined</span>
                                                <?php } else { ?>
                                                <span class="btn btn-warning">Pending</span>
                                                <?php } ?>
                                            </td>
                                            <?php $abc = marked_status($list->user_id, 3); ?>
                                            <td>
                                                @if (isset($abc) && $list->form_status == 0 && $abc->is_closed == 0)
                                                    @if ($abc->query_status == 0)
                                                        <span class="btn btn-primary btn-xs btn-block">Marked</span>
                                                    @else
                                                        <span class="btn btn-primary btn-xs btn-block">
                                                            @if ($abc->current_status == 'User')
                                                                User
                                                            @endif Replied
                                                        </span>
                                                    @endif
                                                @else
                                                    <span class="btn btn-danger btn-xs disabled">Not Marked</span>
                                                @endif
                                            </td>
                                            @if ($form_type != 6)
                                                <td>
                                                    <?php if($list->is_forwarded_by_rso == 1) { ?>
                                                    <?php if($list->amount_release_status == 1) { ?>
                                                    <strong
                                                        class="btn btn-success btn-xs disabled btn-block">Released</strong>
                                                    <?php } else { ?>
                                               
                                                    <strong
                                                    class="btn btn-success btn-xs disabled btn-block">Release</strong>
                                          
                                                <?php } ?>
                                                <?php } else { ?>
                                                <strong class="btn btn-info btn-xs disabled btn-block">Not
                                                    Released</strong>
                                                <?php } ?>
                                    </td>
                    @endif
                </tr>
                @endforeach
            @else
                <tr>
                    <td colspan="9">
                        <h4 style="text-align: center;"> No records Found!.</h4>
                    </td>
                </tr>
                @endif
            </tbody>
        </table>
        </td>
        </tr>
        </tbody>
        </table>
    </div>
</body>

</html>
