<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Export Report</title>
    <style>
        table, th, td {
            border: 1px solid #000;
            border-collapse: collapse;
            font-size: 12px;
            padding: 5px;
        }
        th {
            background-color: #fdf8f8;
            text-align: center;
        }
    </style>
</head>
<body>

<table>
    <tbody>
        <tr>
            <th colspan="11" style="text-align:center; background-color: #fdf8f8; font-size: 13px;" height="55">
                <strong>Khel Sathi Portal / खेल साथी पोर्टल</strong><br>
                <strong>Government of Uttar Pradesh / उत्तर प्रदेश सरकार</strong><br>
                <strong>{{ $formName }}</strong>
            </th>
        </tr>

        <tr style="background-color: #fdf8f8;">
            <td colspan="6">
                <strong>Report Period:</strong> {{ $data['from_date'] }} to {{ $data['to_date'] }}
            </td>
            <td colspan="5" style="text-align:right;">
                <strong>Report Printed on:</strong> {{ date('d-m-Y') }}
            </td>
        </tr>

        <tr>
            <th>S.No.</th>
            <th>Application No.</th>
            <th>Applicant's / Father Name</th>
            <th>Address / Contact Details</th>
            <th>Sports Name</th>
            <th>Name of Competition</th>
            <th>Position / Medal</th>
            <th>Purpose</th>
            <th>Govt. Order - Financial Assistance / Fellowship / Honorarium</th>
            <th>Qualified / Disqualified</th>
            <th>Previously Approved</th>
        </tr>

        @if(count($collection) > 0)
            @foreach($collection as $key => $list)
                @php
                    $compData = PosiCompetition($list->application_no);
                @endphp

                <tr>
                    <td>{{ $key + 1 }}</td>
                    <td>{{ $list->application_no }}</td>
                    <td style="text-transform: capitalize;">
                        {{ ucwords(strtolower($list->fullname)) }}, Son of {{ ucwords(strtolower($list->father_name)) }}
                    </td>
                    <td>
                        {{ $list->permanent_address }} {{ districtName($list->permanent_district) }}<br>
                        <strong>Email:</strong> {{ $list->email }}<br>
                        <strong>Mobile:</strong> {{ $list->mobile }}
                    </td>
                    <td>{{ $list->sportName }}</td>

                    <td>
                        @if(count($compData) > 0)
                            @foreach($compData as $item)
                                {{-- {{ PosiEventMaster($item->event_name) }},
                                {{ PosiEventName($item->competition_name) }}, --}}
                                 {{$item->event_details}},
                                <strong>Venue:</strong> {{ $item->sport_place }}<br>
                                <strong>Date:</strong> {{ $item->competition_from_date }} to {{ $item->competition_to_date }}<br>
                                <strong>Type:</strong>
                                @if($item->event_type == 1) Individual
                                @elseif($item->event_type == 2) Team
                                @elseif($item->event_type == 3) Both
                                @endif
                                <br><br>
                            @endforeach
                        @endif
                    </td>

                    <td>
                        @if(count($compData) > 0)
                            @foreach($compData as $item)
                                {{ $item->earned_medals }}<br><br>
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
                <td colspan="11" style="text-align:center; font-weight:bold;">
                    No records found!
                </td>
            </tr>
        @endif
    </tbody>
</table>

</body>
</html>
