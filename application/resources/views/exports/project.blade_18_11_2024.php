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
    if ($form_type == 4 || $form_type==5) {
        $col_span = 10;
    }
   
?>
<body>
    <div id="prodiv" style="width: 100%; margin: 0 auto;">
        <table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
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
             <thead>
                                @if ($form_type != 6)
                                <tr>
                                    <th>S.No.</th>
                                    <th>Application No.</th>
                                    <th>Applicant's/ <br> Father Name</th>
                                    <th>Address & Contact Details</th>
                                    {{-- <th>Father Name</th> --}}
                                    {{-- <th>Address</th>
                                    <th>District</th> --}}
                                    @if($form_type == 4  || $form_type == 5 )
                                    <th>Date of Birth </th>
                                    @endif
                                    <th>Sports Name</th>
                                    @if($form_type == 1 || $form_type == 2 || $form_type == 3 || $form_type == 7)
                                    <th>Sports Competition Name</th>
                                    @if($form_type == 3 || $form_type == 7)
                                    <th>Event type</th>
                                    <th width="20%">Event Name</th>
                                    @endif
                                    <th>Position / Medal</th>
                                    <th width="20%">Period Of Competition</th>
                                    @endif
                                    @if($form_type == 4 )
                                    <th>Achievement Level</th>
                                    @endif
                                    @if($form_type == 5 )
                                    <th>Award Category</th>
                                    @endif
                                    <th>Amount(in INR)</th>
                                    <th>Remark</th>
                                    
                                    {{-- <th>Date of Application</th> --}}
                                    <th>Application Status</th>
                                    {{-- <th>Query Status</th> --}}
                                    {{-- <th>Amount Status</th> --}}
                                </tr>
                                @else
                                <tr>
                                    <th>Sr No.</th>
                                    <th>Application No.</th>
                                    <th>Applicant's/ <br> Father Name</th>
                                    <th>Post Name</th>
                                    <th>Address & Contact Details</th>
                                    {{-- <th>Father Name</th> --}}
                                    {{-- <th>Address</th>
                                    <th>District</th> --}}
                                    <th>Sports </th>
                                    <th>Sports Competition Name</th>
                                    <th>Position / Medal</th>
                                    <th width="20%">Period Of Competition</th>
                                    <th> Application Status</th>
                                    {{-- <th>Query Status</th> --}}
                                </tr>
                                @endif
                            </thead>
                            <tbody>
                                @php
                                $rowCounts = 0;
                               
                                
                                @endphp
                               
                                {{-- @php
                                    $summary =[];
                                @endphp --}}
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
                                @if($form_type !=6)
                                <tr style="@if ($rowCounts == $row_count) page-break-before: always @endif">
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $list->application_no }}</td>
                                    @if ($form_type == 6)
                                    <td>{{ ucwords(strtolower(AppliedPostName($list->user_id))) }}</td>
                                    @endif
                                    <td style="text-transform: capitalize;">{{ ucwords(strtolower($list->fullname ))}} / <br>{{ ucwords(strtolower($list->father_name ))}}</td>
                                    <td>
                                        {{ $list->permanent_address }},
                                        {{ districtName($list->permanent_district) }}<br>
                                        Email : - {{ $list->email }}<br>
                                        Mobile : - {{ $list->mobile }}
                                    </td>
                                    @if($form_type == 4  || $form_type == 5 )
                                    <td>{{ $list->dob }}</td>
                                    @endif
                                    <td>{{ $list->sportName }}</td>
                                    @if($form_type == 1 || $form_type == 2)
                                    <?php $data = AllCompetition($list->application_no, $form_type); ?>
                                    <td>
                                        {{-- {{dd($data)}} --}}
                                        @if(count($data)>0)
                                        @foreach($data as $key=>$item)
                                        @if($key!=0)<br><hr>@endif
                                        {{sportEventName($item->sport_achievement)}} 
                                        @endforeach
                                        @endif
                                    </td>
                                    <td>
                                        @if(count($data)>0)
                                        @foreach($data as $key=>$item)
                                        @if($key!=0)<br><hr>@endif
                                        {{$item->sport_achievement_position}}
                                        @endforeach
                                        @endif
                                    </td>
                                    <td>
                                        @if(count($data)>0)
                                        @foreach($data as $key=>$item)
                                        @if($key!=0)<br><hr>@endif
                                        <span>{{$item->competition_from_date}} to {{$item->competition_to_date}}</span> 
                                        @endforeach
                                        @endif
                                    </td>
                                    @endif
                                    @if($form_type == 3 || $form_type == 7)
                                    <?php $data = PosiCompetition($list->application_no,$form_type); ?>
                                    <td>
                                        {{-- {{dd($data)}} --}}
                                        @if(count($data)>0)
                                        @foreach($data as $key=>$item)
                                        @if($key!=0)<br><hr>@endif
                                        {{PosiEventName($item->competition_name)}} 
                                        @endforeach
                                        @endif
                                    </td>
                                    <td>
                                        @if(count($data)>0)
                                        @foreach($data as $key=>$item)
                                        @if($key!=0)<br><hr>@endif
                                        @if($item->event_type ==1) Individual @elseif($item->event_type ==2)
                                        Team @elseif($item->event_type ==3)Both @else -- @endif
                                        @endforeach
                                        @endif
                                    </td>
                                    <td>
                                        @if(count($data)>0)
                                        @foreach($data as $key=>$item)
                                        @if($key!=0)<br><hr>@endif
                                        {{PosiEventMaster($item->event_name)}} 
                                        @endforeach
                                        @endif
                                    </td>
                                    <td>
                                        @if(count($data)>0)
                                        @foreach($data as $key=>$item)
                                        @if($key!=0)<br><hr>@endif
                                        {{$item->earned_medals}} 
                                        @endforeach
                                        @endif
                                    </td>
                                    <td>
                                        @if(count($data)>0)
                                        @foreach($data as $key=>$item)
                                        @if($key!=0)<br><hr>@endif
                                        <span>{{$item->competition_from_date}} to {{$item->competition_to_date}}</span>
                                        @endforeach
                                        @endif
                                    </td>
                                    @endif
                                    @if($form_type == 4 )
                                    <td>{{ $list->level_of_report }}</td>
                                    @endif
                                    @if($form_type == 5 )
                                    <td>{{ $list->honoured_award }}</td>
                                    @endif
                                    
                                    <td>@if($list->amount_release_status == 1)
                                        {{ $list->amount_release }}
                                        @endif
                                    </td>
                                    <td>{{ $list->remark }}</td>
                                    
                                    {{-- <td>{{ date('d-m-Y', strtotime($list->created_at)) }}</td> --}}
                                    <td>
                                        <?php if ($list->form_status == 1) { ?>
                                            <span class="btn btn-success">Accepted</span>
                                        <?php } elseif ($list->form_status == 3) { ?>
                                            <span class="btn btn-danger">Pending</span>
                                        <?php } elseif ($list->form_status == 2) { ?>
                                            <span class="btn btn-danger">Declined</span>
                                        <?php } else { ?>
                                            <span class="btn btn-warning">Pending</span>
                                        <?php } ?>
                                    </td>
                                    <?php $abc = marked_status($list->user_id, 3); ?>
                                    {{-- <td>
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
                                    </td> --}}
                                    {{-- <td>
                                        <?php if ($list->amount_release_status == 1) { ?>
                                            <strong class="badge bg-success text-white rounded-pill disabled">Released</strong>
                                        <?php } else { ?>
                                            <a href="#" class="btn btn-info btn-xs btn-block show_released_id" data-id="{{$list->id}}" onclick="released({{$list->id}})" data-bs-toggle="modal" data-bs-target="#releasebtn1">Release</a>
                                        <?php } ?>
                                    </td> --}}
                                </tr>
                                @else
                                <tr style="@if ($rowCounts == $row_count) page-break-before: always @endif">
                                    <td>{{ $key + 1 }}</td>
                                    <td>{{ $list->application_no }}</td>
                                    <td style="text-transform: capitalize;">{{ ucwords(strtolower($list->fullname ))}} / <br>{{ ucwords(strtolower($list->father_name ))}}</td>
                                    <td>{{ ucwords(strtolower(AllAppliedPost($list->application_no))) }}</td>
                                    <td>
                                        {{ $list->permanent_address }},
                                        {{ districtName($list->permanent_district) }}<br>
                                        Email : - {{ $list->email }}<br>
                                        Mobile : - {{ $list->mobile }}
                                    </td>
                                    {{-- <td style="text-transform: capitalize;">{{ ucwords(strtolower($list->father_name ))}}</td> --}}
                                    {{-- <td>{{ $list->permanent_address }}</td>
                                    <td>{{ districtName($list->permanent_district) }}</td> --}}
                                    <?php $data = AllCom($list->application_no); ?>
                                    <td>
                                        {{($list->sportName)}}
                                    </td>
                                    <td>
                                        @if(count($data)>0)
                                        @foreach($data as $item)
                                        {{sportNEventName($item->sport_event)}} <br>
                                        @endforeach
                                        @endif
                                    </td>
                                    <td>
                                        @if(count($data)>0)
                                        @foreach($data as $item)
                                        {{$item->medal}} <br>
                                        @endforeach
                                        @endif
                                    </td>
                                    <td>
                                        @if(count($data)>0)
                                        @foreach($data as $item)
                                        <span>{{$item->competition_from_date}} to {{$item->competition_to_date}}</span> <br>
                                        @endforeach
                                        @endif
                                    </td>
                                    <td>
                                        <?php if ($list->form_status == 1) { ?>

                                            <span class="btn btn-success">Accepted</span>
                                        <?php } elseif ($list->form_status == 3) { ?>
                                            <span class="btn btn-danger">Pending</span>
                                        <?php } elseif ($list->form_status == 2) { ?>
                                            <span class="btn btn-danger">Declined</span>
                                        <?php } else { ?>
                                            <span class="btn btn-warning">Pending</span>
                                        <?php } ?>
                                    </td>
                                    {{-- <?php $abc = marked_status($list->user_id, 3); ?> --}}
                                    {{-- <td>
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
                                    </td> --}}
                                </tr>
                                @endif
                                @endforeach
                                @else
                                <tr>
                                    <td colspan="{{$col_span}}">
                                        <h4 style="text-align: center;"> No records Found!.</h4>
                                    </td>
                                </tr>
                                @endif
                            </tbody>
            
<!--
            <tbody>
                <tr>
                    <td colspan="2">
                        <table class="table" border="1" cellspacing="0" cellpadding="5" style="width: 100%;">
                           
                        </table>
                    </td>
                </tr>
            </tbody>
-->
        </table>
    </div>
</body>

</html>