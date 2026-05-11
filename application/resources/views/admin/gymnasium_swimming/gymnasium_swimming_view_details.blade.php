
@extends( 'layouts/admin_layout' )
@section( 'content' )
<div class="container-fluid pagecontentbody">
    <div class="pagebody removebg-color">
        <div class="row">
            <div class="col-12">
                <div class="pageheader" id="menu-margin">
                    <h4 class="mb-0">
                    Application Preview
                         <button type="button" data-print="modal" class="btn btn-sm  btn-outline-primary ms-2 float-end rounded-pill" onclick="PrintDoc()"><span class="icons icon-printer"></span> Print</button>
                        <a href="{{ route('gymnasium_swimming_list') }}" class="btn btn-outline-danger btn-sm backbtn float-end rounded-pill"><span class="icons icon-arrow-left"></span>Back to List</a>
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
                                                <?php // dd($applicationview); ?>
                                                <td><b>Registered as</b></td>
                                                <?php if($applicationview[0]->type ==1){ ?>
                                                <td >Gymnasium</td>
                                                <?php }else{ ?>
                                                <td >Swimming</td>
                                                <?php } ?>
                                                <td><b>Applicant Name</b></td>
                                                <td>name</td>
                                                <td rowspan="5" colspan="2" style="width: 15% !important;">
                                                    <div class="text-center" style="padding: 5px;" align="center">
                                                        <img src="{{ asset('gymnasium_swimming/profile_picture/')}}/{{$applicationview[0]->profile_picture}}" class="img-fluid" style="width: 100%;height: 140px;" /><br>
                                                        <img src="{{ asset('gymnasium_swimming/signature/')}}/{{$applicationview[0]->signature}}"  style="width: 100%;height: 40px; margin-top:5px" /> </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><b>Date of Birth</b></td>
                                                <td>{{$applicationview[0]->dob}}</td>
                                                <td><b>Gender </b></td>
                                                <?php if($applicationview[0]->gender == '1'){ ?>
                                                    <td>Male</td>
                                                <?php }else{ ?>
                                                    <td>Female</td>
                                                <?php } ?>
                                            </tr>
                                            <tr>
                                                <td><b>Email ID</b></td>
                                                <td>email</td>
                                                <td><b>Mobile Number</b></td>
                                                <td>mobile</td>
                                            </tr>
                                            <tr>
                                                <td><b>Father Name </b></td>
                                                <td>{{ $applicationview[0]->father_name   }}</td>
                                                <td><b>Nationality </b></td>
                                                <td>{{ $applicationview[0]->nationality }}</td>
                                            </tr>
                                            <tr>
                                                <td><b>Aadhar Number</b></td>
                                                <td>{{$applicationview[0]->aadhar}}</td>
                                                <td><b>Religion</b></td>
                                                <td>{{$applicationview[0]->religion}}</td>
                                            </tr>
                                            <tr>

                                                <td><b>Vehicle Number</b></td>
                                                <td>@if ($applicationview[0]->vehicle_no)
                                                     {{ $applicationview[0]->vehicle_no }}@else
                                                     NA
                                                @endif</td>

                                                <td><b>Blood Group</b></td>
                                                <td >{{$applicationview[0]->blood_group}}</td>
                                                <td rowspan="2" colspan="2">&nbsp;</td>
                                            </tr>

                                            <tr>
                                                <td colspan="6" class="bg-light"><strong>Communication</strong></td>
                                            </tr>
                                            <tr>
                                                <td><b>Address</b></td>
                                                <td>{{$applicationview[0]->address}}</td>
                                                <td><b>District</b></td>
                                                <td>{{ districtName($applicationview[0]->district_id) }}</td>
                                                <td><b>Pincode</b></td>
                                                <td>{{$applicationview[0]->pin_code  }}</td>
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
                                           
                                           
                                          
                                        </table>
                                    </div>
                                    <hr />
                                    
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
