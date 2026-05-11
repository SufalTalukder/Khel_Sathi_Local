@extends( 'layouts\player_layout_dashboard' )
@section('content')
{{-- 
<div class="container-fluid pagecontentbody">
    <div class="pagebody removebg-color">
        <div class="row">
            <div class="col-12">
                <div class="pageheader" id="menu-margin">
                    <h4 class="mb-0">
                        Application Preview
                        <button type="button" data-print="modal" class="btn btn-sm  btn-outline-primary ms-2 float-end rounded-pill" onclick="PrintDoc()"><span class="icons icon-printer"></span> Print</button>
                        <a href="{{route('playerdashboard')}}" class="btn btn-outline-danger btn-sm backbtn float-end rounded-pill"><span class="icons icon-arrow-left"></span>Back to Dashboard</a>
                    </h4>
                </div>
                <div class="bhoechie-tab-container">
                    <div class="form-scroll">
                        <div class="nano-content">
                            <div class="card">

                                <div class="card-body">
                                    <form action="{{url('player/final_submit')}}" method="post">
                                        @csrf
                                        <div id="prodiv">

                                            <table class="dn" style="width: 100%; margin-bottom: 5px;" border="0">
                                                <tr>
                                                    <td colspan="2" align="center" style="position: relative; border: 0; padding-bottom: 5px;">
                                                        <div style="border-bottom: 0px solid #000; padding-bottom: 2vw;">
                                                            <img src="{{ asset('player/images/logo.png')}}" style="position: absolute; width: 80px; top: 5px; left: 0;" />
                                                            <div style="font-size: 3vw; font-weight: bold;"> Department
                                                                of Sports </div>
                                                            <div style="font-size: 2vw; font-weight: bold;"> GOVERNMENT
                                                                OF UTTAR PRADESH </div>
                                                            <div style="font-size: 2vw; font-weight: bold;"> Application
                                                                Form </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="text-align: left; font-size: 12px; padding-top: 5px;">
                                                    </td>
                                                    <td style="text-align: right; font-size: 12px; padding-top: 5px;">
                                                        <b>Print Date :</b> <?php echo date("d/m/Y");    ; ?>
                                                    </td>
                                                </tr>
                                            </table>
                                            <?php if (!empty($player_applicationview[0])) { ?>
                                                <table class="table table-bordered datatable" border="1" style="border-collapse: collapse; width: 100%;">
                                                    <tr>
                                                        <td colspan="6" class="bg-light"><strong>Applicant Details</strong>
                                                        </td>
                                                        <!--Basic Details-->
                                                    </tr>
                                                    <tr>
                                                        <?php //dd($playersummary_view); dd($player_applicationview[0]->blood_group_applicant);
                                                        ?>
                                                        <td style="width: 15%"><b>Applicant Name</b></td>
                                                        <td style="width: 20%">
                                                            {{isset($playersummary_view->name) ? $playersummary_view->name : old('name')}}
                                                        </td>
                                                        <td style="width: 15%"><b>Date of Birth</b></td>
                                                        <td style="width: 20%">{{dmy($playersummary_view->dob)}}</td>
                                                        <td rowspan="4" colspan="2">
                                                            <div class="text-center" style="padding: 5px;" align="center">
                                                                <?php if (!empty($player_applicationview[0]->profile_image)) { ?>
                                                                    <img src="{{ asset('playerapplicant/profile_image/')}}/<?php echo $player_applicationview[0]->profile_image; ?>" class="img-fluid" style="width: 140px;" />
                                                                <?php } else { ?>
                                                                    <img src="{{ asset('player/images/profile2.jpg')}}" class="img-fluid" style="width: 140px;" />
                                                                <?php } ?>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <?php //dd($player_applicationview); ?>
                                                    <tr>
                                                        <td><b>Email ID</b></td>
                                                        <td>{{$playersummary_view->email}}</td>
                                                        <td><b>Mobile Number</b></td>
                                                        <td>{{$playersummary_view->mobile}}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Blood Group</b></td>
                                                        <td><?php echo $player_applicationview[0]->blood_group_applicant; ?>
                                                        </td>
                                                        <td><b>Father Name </b></td>
                                                        <td><?php echo $player_applicationview[0]->father_name; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Applying for Sport</b></td>
                                                        <td>{{sport_name($player_applicationview[0]->sports_type)}}</td>
                                                        <td><b>Address</b></td>
                                                        <td><?php echo $player_applicationview[0]->address; ?></td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>District</b></td>
                                                        <td>{{!empty(districtName($player_applicationview[0]->district_id)) ? districtName($player_applicationview[0]->district_id) : 'N/A' }}</td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Nationality </b></td>
                                                        <td><?php echo $player_applicationview[0]->nationality; ?></td>
                                                        <td><b>Aadhar Number</b></td>
                                                        <td><?php echo $player_applicationview[0]->aadhar_card; ?></td>
                                                        <td rowspan="2" colspan="2">
                                                            <div class="text-center" style="padding: 5px;" align="center">
                                                                <?php if (!empty($player_applicationview[0]->applicant_sign)) { ?>
                                                                    <img src="{{ asset('playerapplicant/applicant_sign/')}}/<?php echo $player_applicationview[0]->applicant_sign; ?>" class="img-fluid" style="width: 140px;" />
                                                                <?php } else { ?>
                                                                    <img src="{{ asset('player/images/signature.png')}}" class="img-fluid" style="width: 140px;" />
                                                                <?php } ?>

                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <td><b>Religion</b></td>
                                                        <td><?php echo $player_applicationview[0]->religion; ?></td>
                                                        <td><b>Vehicle Number</b></td>
                                                        <td><?php
                                                            if (!empty($player_applicationview[0]->vehicle_number)) {
                                                                echo $player_applicationview[0]->vehicle_number;
                                                            } else {
                                                                echo 'N/A';
                                                            }   ?>
                                                        </td>
                                                    </tr>

                                                    <tr>
                                                        <td colspan="6" class="bg-light"><strong>Declaration</strong></td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="6">I declare that the above particulars are true to the
                                                            best of my knowledge. If any of my facts are found to be wrong,
                                                            my admission should be canceled, for which all responsibility
                                                            will be mine. I have read all the facts thoroughly and after
                                                            admission I will strictly follow the hostel rules. </td>
                                                    </tr>
                                                    <tr>
                                                        <td colspan="6" align="center">
                                                            <?php if (isset($player_applicationview[0]->submit_status) && ($player_applicationview[0]->submit_status == 2)) { ?>
                                                                <input class="check-final" type="checkbox" name="checked" id="checked" disabled checked="checked" />
                                                                &nbsp; <b>I Agree</b>
                                                            <?php } else { ?>
                                                                <input class="check-final" type="checkbox" name="checked" id="checked" required />
                                                                &nbsp; <b>I Agree</b>

                                                            <?php } ?>

                                                        </td>
                                                    </tr>


                                                    <!--<tr>
                                                        <td colspan="3" align="center">
                                                            <span>-</span><br />
                                                            <b>Guardian Full Name</b>
                                                        </td>
                                                        <td colspan="3" align="center">
                                                            <img src="images/signature.png" class="img-fluid" style="width: 140px;" /><br />
                                                            <b>Guardian Signature</b>
                                                        </td>
                                                    </tr>-->
                                                </table>

                                        </div>
                                        <hr />

                                        <div class="row justify-content-center">
                                            <?php if (isset($player_applicationview[0]->submit_status) && ($player_applicationview[0]->submit_status == 1)) { ?>
                                                <div class="col-md-2 d-grid">
                                                        <a href="{{route('playerapplication')}}" class="btn btn-outline-info rounded-pill">Edit</a>
                                                    </div>
                                                    <div class="col-md-2 d-grid">
                                                    <button class="btn btn-outline-danger rounded-pill" type="submit">Final
                                                        Submit</button>
                                            </div>

                                            <?php } elseif(isset($player_applicationview[0]->submit_status) && ($player_applicationview[0]->submit_status == 2)) { ?>
                                                 <div class="col-md-2 d-grid">
                                                 <a class="btn btn-outline-info rounded-pill" href="{{route('playerapplicantpayment')}}">Pay
                                                     Registration Fee</a>
                                             </div>

                                           <?php } ?>




                                        </div>
                                    </form>


                                <?php } else { ?>
                                    <div class="test-player-preview">
                                        <p>No data available...</p>
                                    </div>
                                <?php } ?>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



<!-- Modal -->

<div class="modal fade" id="Final" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">

                <h3> Are you sure?</h3>
                <p>Application Submitted Successfully.</p>

                <p>
                    <a href="button" class="btn btn-outline-success rounded-pill">Yes</a>
                    <a type="button" class="btn btn-outline-danger rounded-pill">No</a>
                </p>
            </div>

        </div>
    </div>
</div> --}}


<div class="container-fluid pagecontentbody">
    <div class="pagebody removebg-color">
        <div class="row">
            <div class="col-12">
                <div class="pageheader" id="menu-margin">
                    <h4 class="mb-0">
                        Application Preview
                        @if (Auth::guard('player')->user()->status_preview == 2)    <button type="button" data-print="modal" class="btn btn-sm  btn-outline-primary ms-2 float-end rounded-pill" onclick="PrintDoc()"><span class="icons icon-printer"></span> Print</button>@endif
                        <a href="{{ route('playerdashboard') }}" class="btn btn-outline-danger btn-sm backbtn float-end rounded-pill"><span class="icons icon-arrow-left"></span>Back to Dashboard</a>
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
                                                       {{-- <img src="images/logo.png" style="position: absolute; width: 80px; top: 5px; left: 0;" /> --}}
                                                        <div style="font-size: 3vw; font-weight: bold;"> Department of Sports </div>
                                                        <div style="font-size: 2vw; font-weight: bold;"> GOVERNMENT OF UTTAR PRADESH </div>
                                                        <div style="font-size: 2vw; font-weight: bold;"> Application Form </div>
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
                                                <td style="width: 20%">@if (Auth::guard('player')->user()->type == 1) Player @else Coach @endif</td>
                                                <td style="width: 15%"><b>Applicant Name</b></td>
                                                <td style="width: 20%">{{ Auth::guard('player')->user()->name }}</td>
                                                <td rowspan="5" colspan="2">
                                                    <div class="text-center" style="padding: 5px;" align="center"> <img src="{{ asset('player_coach_storage/profile_picture/')}}/{{$player_applicationview->profile_picture}}" class="img-fluid" style="width: 140px;" /> </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><b>Date of Birth</b></td>
                                                <td>{{ dmy( Auth::guard('player')->user()->dob) }}</td>
                                                <td><b>Gender </b></td>
                                                <td>@if (Auth::guard('player')->user()->gender == 1) Male @else Female @endif</td>
                                            </tr>
                                            <tr>
                                                <td><b>Email ID</b></td>
                                                <td>{{ Auth::guard('player')->user()->email }}</td>
                                                <td><b>Mobile Number</b></td>
                                                <td>{{ Auth::guard('player')->user()->mobile }}</td>
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
                                                @if (Auth::guard('player')->user()->type == 1)
                                                <td><b>Vehicle Number</b></td>
                                                <td>@if ($player_applicationview->vehicle_no)
                                                     {{ $player_applicationview->vehicle_no }}@else
                                                     NA
                                                @endif</td>
                                                @endif
                                                <td><b>Applying for Sport</b></td>
                                                <td>{{sport_name($player_applicationview->sport_id)}}</td>
                                                <td rowspan="2" colspan="2">
                                                    <div class="text-center" style="padding: 5px;" align="center"> <img src="{{ asset('player_coach_storage/signature/')}}/{{$player_applicationview->signature}}" class="img-fluid" style="width: 140px;" /> </div>
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
                                                <td>{{$player_applicationview->pin_code  }}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" class="bg-light"><strong>Educational Qualification</strong></td>
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
                                            <tr>
                                                <td colspan="6" class="bg-light"><strong>Declaration</strong></td>
                                            </tr>
                                            <tr>
                                                <td colspan="6">I declare that the above particulars are true to the best of my knowledge. If any of my facts are found to be wrong, my admission should be canceled, for which all responsibility will be mine. I have read all the facts thoroughly and after admission I will strictly follow the hostel rules. </td>
                                            </tr>
                                            <tr>
                                                <td colspan="6" align="center">
                                                    <input type="checkbox" @if (Auth::guard('player')->user()->status_preview == 2) disabled checked="checked" @endif id="player_coachChecked" />
                                                    &nbsp; <b>I Agree</b>
                                                </td>
                                            </tr>
                                            <td colspan="6" align="center">
                                                @if (Auth::guard('player')->user()->application_status == 3)
                                                  <h1 class="text-success blink_me ">
                                                      Application is  Accepted
                                                  </h1>
                                                @elseif(Auth::guard('player')->user()->application_status == 2)
                                                  <h1 class="text-danger blink_me ">
                                                      Application is   Rejected
                                                  </h1>
                                                @endif
                                             </td>
                                        </table>
                                    </div>
                                    <hr />
                                    <div class="row justify-content-center">
                                        @if (Auth::guard('player')->user()->status_preview != 2)


                                        <div class="col-md-2 d-grid">
                                            <a href="{{ route('playerapplication') }}" class="btn btn-outline-light rounded-pill">Back</a>
                                        </div>
                                        <div class="col-md-2 d-grid">
                                            <button class="btn btn-outline-danger rounded-pill"  id="player_coachFinal">Final Submit</button>
                                        </div>
                                        @endif
                                        {{-- <div class="col-md-2 d-grid">
                                            <a class="btn btn-outline-info rounded-pill" href="Payment.html">Pay Registration Fee</a>
                                        </div> --}}
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



<!-- Modal -->

<div class="modal fade" id="player_coachFinalWarning" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">

                <h3> Are you sure?</h3>
                <p>Application Submitted Successfully.</p>

                <p>

        <a href="javascript:void(0)" id="final_submit" class="btn btn-outline-success rounded-pill">Yes</a>
                    <a type="button" class="btn btn-outline-danger rounded-pill">No</a>
                </p>
            </div>

        </div>
    </div>
</div>




@endsection
@push('custom-scripts')


<script>
      $('#player_coachFinal').click(function() {
          var content = document.createElement('div');
          content.innerHTML = '<h3>Please click on the Declaration Checkbox and then proceed to submit.<br>कृपया घोषणा के चेकबॉक्स पर क्लिक करें एवं तदोपरांत आगे बढ़ें।</h3>';
          if($('#player_coachChecked').is(':checked') ){
            $('#player_coachFinalWarning').modal('toggle');

          }
          else
          swal(content, {

          });
              return false;
      });

      $('#final_submit').click(function() {


              var actionUrl = ajaxUrl+"/player_coach/final_submit";

              $.ajax({
                  type: "GET",
                  url: actionUrl,


                  success: function (res) {
                if (res.error == false) {

                    success(res.msg);

                     window.location.href = res.url;
                } else {
                    error(res.msg);
                }
            },
              });

      });

</script>

@endpush
