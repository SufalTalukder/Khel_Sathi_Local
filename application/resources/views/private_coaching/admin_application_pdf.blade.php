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
                        Registration of Pvt. Coaching Academies / Associations ,Gyms, Swimming Pools    </h6>
                        <h6
                            style="text-align: center; margin:0px 0px 15px 0px; font-size:12pt; padding: 0px; color:#000; text-decoration:underline;">
                            List of Applicants who applied for Associations
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
                    </th>

                </tr>
                <tr>
                    <th style="font-size: 10pt; text-align:left">
                        <b>Report Period : 01-04-2023 To {{dmy(now())}}</b>
                    </th>


                    <th style="text-align: right; font-size: 10pt;">
                        <b>Report Code : </b>
                        RS001 <br><br>
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
                                    <th>Application No.</th>

                                    <th>Name</th>
                                    <th>Designation</th>
                                    <th>Institution Name</th>
                                    <th>Email ID</th>
                                    <th >Mobile No.</th>
                                    <th >Sports Name</th>
                                    <th class="text-center">Status of Application</th>




                            </tr>
                            </thead>
                            <tbody>
                                @if (count($application) > 0)

                                @foreach ($application as $key=>$item )

                                <tr>
                                    <td>
                                        {{$key + 1}}
                                    </td>
                                    <td>
                                      {{$item->application_no}}
                                    </td>
                                    <td>
                                        {{$item->name}}
                                      </td>
                                      <td>
                                        {{$item->designation}}
                                      </td>
                                      <td>
                                        {{$item->institute_name}}
                                      </td>
                                      <td>
                                        {{$item->email}}
                                      </td>
                                      <td>
                                        {{$item->mobile}}
                                      </td>
                                      <td>
                                        {{sport_name($item->sport_id)}}
                                      </td>

                                      <td class="text-center">
                                        @if($item->final_submit == 1 && $item->query_status == 2)
                                        <button type="button" class="btn btn-outline-primary btn-sm">  Re-Submitted</button>
                                        @elseif( $item->final_submit == 1 && $item->query_status == 1)

                                        <button type="button" class="btn btn-outline-warning btn-sm">  Query Marked</button>
                                        @elseif ($item->status == 1 && $item->final_submit == 1)

                                        <span class="badge bg-success ">Accepted</span>

                                         @elseif ($item->status == 2 && $item->final_submit == 1)
                                         <span class="badge bg-danger ">Rejected</span>

                                        @else
                                     <span class="badge bg-primary ">Pending</span>

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
