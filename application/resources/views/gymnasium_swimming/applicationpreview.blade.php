@extends( 'layouts\gymnasium_swimming_dashboard' )
@section('content')


<div class="container-fluid pagecontentbody">
    <div class="pagebody removebg-color">
        <div class="row">
            <div class="col-12">
                <div class="pageheader" id="menu-margin">
                    <h4 class="mb-0">
                        Application Preview
                        @if (Auth::guard('GymnasiumSwimming')->user()->status_preview == 2)    <button type="button" data-print="modal" class="btn btn-sm  btn-outline-primary ms-2 float-end rounded-pill" onclick="PrintDoc()"><span class="icons icon-printer"></span> Print</button>@endif
                        <a href="{{ route('gymnasium_swimming_dashboard') }}" class="btn btn-outline-danger btn-sm backbtn float-end rounded-pill"><span class="icons icon-arrow-left"></span>Back to Dashboard</a>
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
                                                <td><b>Registered as</b></td>
                                                <td >@if (Auth::guard('GymnasiumSwimming')->user()->type == 1) Gymnasium @else Swimming  @endif</td>
                                                <td><b>Applicant Name</b></td>
                                                <td >{{ Auth::guard('GymnasiumSwimming')->user()->name }}</td>
                                                <td rowspan="5" colspan="2" style="
                                                width: 15% !important;
                                            ">
                                                    <div class="text-center" style="padding: 5px;" align="center">
                                                        <img src="{{ asset('gymnasium_swimming/profile_picture/')}}/{{$applicationview->profile_picture}}" class="img-fluid" style="width: 100%;height: 140px;" /><br>
                                                        <img src="{{ asset('gymnasium_swimming/signature/')}}/{{$applicationview->signature}}"  style="width: 100%;height: 40px; margin-top:5px" /> </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><b>Date of Birth</b></td>
                                                <td>{{ dmy( Auth::guard('GymnasiumSwimming')->user()->dob) }}</td>
                                                <td><b>Gender </b></td>
                                                <td>@if (Auth::guard('GymnasiumSwimming')->user()->gender == 1) Male @else Female @endif</td>
                                            </tr>
                                            <tr>
                                                <td><b>Email ID</b></td>
                                                <td>{{ Auth::guard('GymnasiumSwimming')->user()->email }}</td>
                                                <td><b>Mobile Number</b></td>
                                                <td>{{ Auth::guard('GymnasiumSwimming')->user()->mobile }}</td>
                                            </tr>
                                            <tr>
                                                <td><b>Father Name </b></td>
                                                <td>{{ $applicationview->father_name   }}</td>
                                                <td><b>Nationality </b></td>
                                                <td>{{ $applicationview->nationality }}</td>
                                            </tr>
                                            <tr>
                                                <td><b>Aadhar Number</b></td>
                                                <td>{{$applicationview->aadhar}}</td>
                                                <td><b>Religion</b></td>
                                                <td>{{$applicationview->religion}}</td>
                                            </tr>
                                            <tr>

                                                <td><b>Vehicle Number</b></td>
                                                <td>@if ($applicationview->vehicle_no)
                                                     {{ $applicationview->vehicle_no }}@else
                                                     NA
                                                @endif</td>



                                                <td><b>Blood Group</b></td>
                                                <td >{{$applicationview->blood_group}}</td>
                                                <td rowspan="2" colspan="2">&nbsp;</td>
                                            </tr>

                                            <tr>
                                                <td colspan="6" class="bg-light"><strong>Communication</strong></td>
                                            </tr>
                                            <tr>
                                                <td><b>Address</b></td>
                                                <td>{{$applicationview->address}}</td>
                                                <td><b>District</b></td>
                                                <td>{{ districtName($applicationview->district_id) }}</td>
                                                <td><b>Pincode</b></td>
                                                <td>{{$applicationview->pin_code  }}</td>
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
                                                                <td><a href="{{url('public/gymnasium_swimming/award')."/".$item->upload_file }}" target="_blank" class="btn btn-success btn-xs"><i class="fa fa-download"></i></a></td>
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
                                                    <input type="checkbox" @if (Auth::guard('GymnasiumSwimming')->user()->status_preview == 2) disabled checked="checked" @endif id="player_coachChecked" />
                                                    &nbsp; <b>I Agree</b>
                                                </td>
                                            </tr>
                                            <td colspan="6" align="center">
                                                @if (Auth::guard('GymnasiumSwimming')->user()->application_status == 3)
                                                  <h1 class="text-success blink_me ">
                                                      Application is  Accepted
                                                  </h1>
                                                @elseif(Auth::guard('GymnasiumSwimming')->user()->application_status == 2)
                                                  <h1 class="text-danger blink_me ">
                                                      Application is   Rejected
                                                  </h1>
                                                @endif
                                             </td>
                                        </table>
                                    </div>
                                    <hr />
                                    <div class="row justify-content-center">
                                        @if (Auth::guard('GymnasiumSwimming')->user()->status_preview != 2)


                                        <div class="col-md-2 d-grid">
                                            <a href="{{ route('gymnasium_swimming_application') }}" class="btn btn-outline-light rounded-pill">Back</a>
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

                <h3> Are you sure  want to submit the form?</h3>




        <a href="javascript:void(0)" id="final_submit" class="btn btn-outline-success rounded-pill">Yes</a>
                    <a type="button" class="btn btn-outline-danger rounded-pill" data-bs-dismiss="modal" aria-label="Close">No</a>
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


              var actionUrl = ajaxUrl+"/gymnasium_swimming/final_submit";

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



