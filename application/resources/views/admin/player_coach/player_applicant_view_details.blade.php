@extends( 'layouts/admin_layout' )
@section('content')
<style>
    td.player_name {
        text-transform: capitalize;
    }
</style>
<div class="container-fluid pagecontentbody">
    <div class="pagebody removebg-color">
        <div class="row">
            <div class="col-12">
                <div class="pageheader" id="menu-margin">
                    <h4 class="mb-0">
                        Application Preview
                        <button type="button" data-print="modal" class="btn btn-sm  btn-outline-primary ms-2 float-end rounded-pill" onclick="PrintDoc()"><span class="icons icon-printer"></span> Print</button>
                    </h4>
                </div>
                <div class="bhoechie-tab-container">
                    <div class="form-scroll">
                        <div class="nano-content">
                            <div class="card">
                                <div class="card-body">
                                    <div id="prodiv">
                                        <table class="dn" style="width: 100%; margin-bottom: 5px;" border="0">
                                            <tr>
                                                <td colspan="2" align="center" style="position: relative; border: 0; padding-bottom: 5px;">
                                                    <div style="border-bottom: 0px solid #000; padding-bottom: 2vw;">
                                                        <div style="font-size: 25px; font-weight: bold;">
                                                            Khel Sathi Portal
                                                        </div>
                                                        <div style="font-size: 18px; font-weight: bold;">
                                                            Government of Uttar Pradesh
                                                        </div>
                                                        <div style="font-size: 18px; font-weight: bold;">Application Form</div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: left; font-size: 12px; padding-top: 5px;"></td>
                                                <td style="text-align: right; font-size: 12px; padding-top: 5px;"><b>Print Date :</b> {{ dmy(date("Y/m/d")) }}</td>
                                            </tr>
                                        </table>
                                        <table class="table table-bordered" border="1" style="border-collapse: collapse; width: 100%;">
                                            <tr>
                                                <td colspan="6" class="bg-light"><strong>Applicant Details</strong></td><!--Basic Details-->
                                            </tr>
                                            <tr>
                                                <td style="width: 15%"><b>Registered as</b></td>
                                                <td style="width: 20%">@if ($player_applicationview->type == 1) Player @else Coach @endif</td>
                                                <td style="width: 15%"><b>Applicant Name</b></td>
                                                <td style="width: 20%">{{ $player_applicationview->name }}</td>
                                                <td rowspan="5" colspan="2">
                                                    <div class="text-center" style="padding: 5px;" align="center"> <img src="{{ asset('player_coach_storage/profile_picture/')}}/{{$player_applicationview->profile_picture}}" class="img-fluid" style="width: 140px; height: 150px;" /> </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><b>Date of Birth</b></td>
                                                <td>{{ dmy( $player_applicationview->dob) }}</td>
                                                <td><b>Gender </b></td>
                                                <td>@if ($player_applicationview->gender == 1) Male @else Female @endif</td>
                                            </tr>
                                            <tr>
                                                <td><b>Email ID</b></td>
                                                <td>{{ $player_applicationview->email }}</td>
                                                <td><b>Mobile Number</b></td>
                                                <td>{{ $player_applicationview->mobile }}</td>
                                            </tr>
                                            <tr>
                                                <td><b>Father Name </b></td>
                                                <td>{{ $player_applicationview->father_name   }}</td>
                                                <td><b>Nationality </b></td>
                                                <td>{{ $player_applicationview->nationality }}</td>
                                            </tr>
                                            <tr>
                                                <td><b>Aadhar Number</b></td>
                                                <td>{{$player_applicationview->aadhar}}</td>
                                                <td><b>Religion</b></td>
                                                <td>{{$player_applicationview->religion}}</td>
                                            </tr>
                                            <tr>
                                                @if ($player_applicationview->type == 1)
                                                <td><b>Vehicle Number</b></td>
                                                <td>@if ($player_applicationview->vehicle_no)
                                                    {{ $player_applicationview->vehicle_no }}@else
                                                    NA
                                                    @endif
                                                </td>
                                                @endif
                                                <td><b>Applying for Sport</b></td>
                                                <td>{{sport_name($player_applicationview->sport_id)}}</td>
                                                <td rowspan="2" colspan="2">
                                                    <div class="text-center" style="padding: 5px;" align="center"> <img src="{{ asset('player_coach_storage/signature/')}}/{{$player_applicationview->signature}}" class="img-fluid" style="width: 140px; height: 50px;" /> </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><b>Blood Group</b></td>
                                                <td colspan="4">{{$player_applicationview->blood_group}}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" class="bg-light"><strong>Communication</strong></td>
                                            </tr>
                                            <tr>
                                                <td><b>Address</b></td>
                                                <td>{{$player_applicationview->address}}</td>
                                                <td><b>District</b></td>
                                                <td>{{ districtName($player_applicationview->district_id) }}</td>
                                                <td><b>Pincode</b></td>
                                                <td>{{$player_applicationview->pin_code }}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" class="bg-light"><strong>Educational Qualifiaction</strong></td>
                                            </tr>
                                            <tr>
                                                <td colspan="6">
                                                    <table class="table table-bordered table-sm">
                                                        <thead>
                                                            <tr style="background-color: #dfdacd;">
                                                                <th style="width:7%">S.No.</th>
                                                                <th>Class</th>
                                                                <th style="width:10%">Upload</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach ($qualification as $key=>$item )
                                                            <tr>
                                                                <td>{{ $key + 1 }}</td>
                                                                <td>{{ $item->qualification }}</td>
                                                                <td><a href="{{url('public/qualification/images')."/".$item->upload_file }}" target="_blank" class="btn btn-success btn-xs"><i class="fa fa-download"></i></a></td>
                                                            </tr>
                                                            @endforeach


                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" class="bg-light"><strong>Award Details</strong></td>
                                            </tr>
                                            <tr>
                                                <td colspan="6">
                                                    <table class="table table-bordered table-sm">
                                                        <thead>
                                                            <tr style="background-color: #dfdacd;">
                                                                <th style="width:7%">S.No.</th>
                                                                <th>Award Name</th>
                                                                <th style="width:10%">Upload</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>

                                                            @foreach ($award as $key=>$item)
                                                            <tr>
                                                                <td>{{ $key + 1 }}</td>
                                                                <td>{{ $item->award }}</td>
                                                                <td><a href="{{url('public/award/images')."/".$item->upload_file }}" target="_blank" class="btn btn-success btn-xs"><i class="fa fa-download"></i></a></td>
                                                            </tr>
                                                            @endforeach

                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>

                                            <tr> @if ($player_applicationview->application_status == 2 || $player_applicationview->application_status == 3)
                                                <td colspan="6" align="center">
                                                    @if ($player_applicationview->application_status == 3)
                                                    <h1 class="text-success blink_me ">
                                                        Application is Accepted
                                                    </h1>
                                                    @elseif($player_applicationview->application_status == 2)
                                                    <h1 class="text-danger blink_me ">
                                                        Application is Rejected
                                                    </h1>
                                                    @endif
                                                </td>
                                                @else
                                                @if (Auth::guard('admin')->user()->admin_role != 18)
                                                <td colspan="3" align="center"><a href="{{ route('player_coach_application_status',[$player_applicationview->play_id,3] ) }}" class="btn btn-success">Accept</a></td>
                                                <td colspan="3" align="center"><a href="{{ route('player_coach_application_status',[$player_applicationview->play_id,2]) }}" class="btn btn-danger btn-sm">Reject</a></td>
                                                @endif
                                                @endif
                                            </tr>
                                            {{-- <tr>
                                                <td colspan="6" class="bg-light"><strong>Declaration</strong></td>
                                            </tr> --}}
                                            {{-- <tr>
                                                <td colspan="6">I declare that the above particulars are true to the best of my knowledge. If any of my facts are found to be wrong, my admission should be canceled, for which all responsibility will be mine. I have read all the facts thoroughly and after admission I will strictly follow the hostel rules. </td>
                                            </tr> --}}
                                            <tr>

                                            </tr>
                                        </table>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>




@endsection
@push('custom-scripts')
