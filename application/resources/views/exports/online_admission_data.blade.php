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
            font-size:  10pt
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
          

            <thead>
                <tr>
                    <th colspan="2">
                        <div
                            style="padding: 0 15px 3px; margin-bottom: 10px; margin-top:10px; border-bottom: 2px solid #000; position: relative; line-height: 1;">
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
                        style="text-align: center; margin:0px 0px 0px 0px; font-size:14pt; padding: 0px; color:#000; ">
                     {{$data['module_name']}} 
                    </h6>
                        <h6
                            style="text-align: center; margin:0px 0px 15px 0px; font-size:12pt; padding: 0px; color:#000; text-decoration:underline;">
                            {{$data['report_name']}} 
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
                        <b>Report Code :     {{$data['report_code']}} </b>
                    </th>

                </tr>
                <tr>
                    <th style="font-size: 10pt; text-align:left">
                        <b>Report Period : 01-04-2023 To {{dmy(now())}}</b> 
                    </th>


                    <th style="text-align: right; font-size: 10pt;">
                        <b>Report Generated On : </b>
                      {{now()->format('d-m-Y h:i A') }}
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
                                        <th>Registration No.</th>
                                   
                                        {{-- <th>Application No.</th> --}}
                                        <th>Applicant's Name</th>
                                        <th>Email ID</th>
                                        <th>Mobile No.</th>
                                        <th>Sports </th>
                                        <th>Sub Sports </th>
                                        <th class="text-center">Status</th>
                                        <th class="text-center">Trial 1 Status</th>
                                        <th class="text-center">Trial 2 Status</th>
                                    
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $rowCounts = 0;
                                @endphp
                                @if(count($registrations) > 0)
                                @foreach ($registrations as $key=>$registration)
                                @php
                                $rowCounts++;
                              $pageBreak = 'na'; 
                              if( $rowCounts >10){
                                $rowCounts = 1;
                                    $pageBreak = "";
                              }
                              @endphp
                        
                                    <tr style="@if($rowCounts == 10) page-break-after: always @endif">

                                
                                            <td>{{ $key+1 }}</td>
                                            <td>{{ $registration->application_no }}</td>
                                         
                                            {{-- <td>{{ $registration->enroll_no }}</td> --}}
                                            <td>{{ ucwords(strtolower($registration->fullname)) }}</td>
                          
                                        <td>{{ $registration->email }}</td>
                                            <td>{{ $registration->mobile }}</td>
                                  
                                            <td>{{ $registration->name }}</td>
                                            <td>
                                                @if ($registration->sub_type && $registration->sub_type != " ")
                                                {{$registration->sub_type }}
                                                @else
                                                NA
                                                @endif
                                            </td>
                                      
                                            <td class="text-center">
                                                @if ($registration->final_status == 1)
                                                <span class="badge bg-warning text-white rounded-pill">Pending</span> @elseif ($registration->final_status == 2)
                                                <span class="badge bg-primary text-white rounded-pill">Provisionally accepted</span> @else
                                                <span class="badge bg-danger rounded-pill">Rejected</span> @endif
                                            </td>
                                            <td>
                                                @if ($registration->trial_type == 1)
                                                NA
                                                @elseif ($registration->trial_type > 1 && $registration->trial_type <= 3 || $registration->trial_type == 5)
                                                    Pass
                                                    <br>
                                                    {{dmy(trial_date($registration->application_no, 2))}}
                                                    @elseif ($registration->trial_type == 4 )
                                                    Fail
                                                    <br>
                                                    {{dmy(trial_date($registration->application_no, 2))}}
                                                    @endif
                                            </td>
                                            <td>
                                                @if ($registration->trial_type == 1 || $registration->trial_type == 2 || $registration->trial_type == 4 )
                                                NA
                                                @elseif ($registration->trial_type == 3 )
                                                Pass
                                                <br>
                                                {{dmy(trial_date($registration->application_no, 2))}}
                                                @elseif ($registration->trial_type == 5 )
                                                Fail
                                                <br>
                                                {{dmy(trial_date($registration->application_no, 2))}}
                                                @endif
                                            </td>
                                           
                                                    
                    
                    
                    
                    
                    
                    
                              
                                
                
                </tr>
                @endforeach
                @else
                <tr>
                    <td colspan="10">
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
