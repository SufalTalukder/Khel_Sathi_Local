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

</head>

<body>

    <div id="prodiv" style="width: 100%; margin: 0 auto;">
        <table border="0" cellspacing="0" cellpadding="0" style="width: 100%;">
            <thead>
                <tr>
                    
                    <td colspan="8"style="text-align: center;">
                        <!-- <img width="61" height="62" src="{{ asset('') }}/assets_admin/images/logo.png" align="left" hspace="5" /> -->
                        <strong style="font-size: 15pt;">Khel Sathi Portal</strong><br />
                        <strong>
                        Government of Uttar Pradesh
                        </strong>
                        <p style="text-align: center; font-weight: 600; font-size: 18px; margin:5px 0;">
                        Hostel Application
                        </p>
                    </td>
                </tr>

                <tr style="background-color: #fdf8f8;">
                    <td>
                   
                    </td>
                    <td style="width: 50%;" >
                    <strong> Print Date :</strong> <?= date('d-m-Y'); ?>
                    </td>
                 </tr>
            </thead>
           
            <tbody>
                <tr>
                    <td>
                        <h5 class="subheading">Applicant’s Details</h5>
                        <table class="tblbrdr" border="1" cellspacing="0" cellpadding="5" style="width: 100%;">
                         <tbody>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Application No.</th>
                                    <th>Applicant’s Name</th>
                                    <th>Email ID</th>
                                    <th>District</th>
                                    <th>Sport</th>
                                    <th>Application Status</th>
                                    <th>Payment Verification</th>
                                </tr>
                                <tbody id="hostelapplicant">
                                @foreach ($hostelList as $key=>$item)
                                <tr>
                                    <td>{{$key + 1}}</td>
                                    <td>{{$item->application_no}}</td>
                                    <td>{{$item->name}}</td>
                                    <td>{{$item->email}}</td>
                                    <td>{{districtName($item->district_id)}} </td>
                                    <td>{{sport_name($item->sports)}} </td>

                                    <td>@if ($item->status == 3) Pending @elseif ($item->status == 1) Provisionally Accepted @else Rejected @endif
                                    </td>
                                    <td>
                                    <?php if($item->payment_status==1){ ?>
                                        Pending
                                    <?php } ?>
                                    <?php if($item->payment_status==2){ ?>
                                        Accepted
                                    <?php } ?>
                                    <?php if($item->payment_status==3){ ?>
                                        Rejected
                                    <?php } ?>
                                    </td>
                                   

                                </tr>
                                @endforeach

                            </tbody>
                        </table>                           
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</body>

</html>
