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
                        <a href="{{ route('eklavya_kreeda_kendra_list') }}" class="btn btn-outline-danger btn-sm backbtn float-end rounded-pill"><span class="icons icon-arrow-left"></span>Back to List</a>
                    </h4>
                </div>
                <div class="bhoechie-tab-container">
                    <div class="form-scroll">
                        <div class="nano-content">
                            <div class="card">
                                <div class="card-body">
                                    <div id="prodiv">
                                        <table class="dn" style="width: 100%; margin-bottom: 5px;">
                                            <tr>
                                                <td colspan="2" align="center" style="position: relative; border: 0; padding-bottom: 5px;">
                                                    <div style="border-bottom: 0px solid #000; padding-bottom: 2vw;">
                                                        <img src="{{ asset('') }}/player/images/logo.png" style="position: absolute; width: 80px; top: 5px; left: 0;" />
                                                        <div style="font-size: 3vw; font-weight: bold;"> Department of Sports </div>
                                                        <div style="font-size: 2vw; font-weight: bold;"> GOVERNMENT OF UTTAR PRADESH </div>
                                                        <div style="font-size: 2vw; font-weight: bold;"> Application Form for  Eklavya Krida Kosh</div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: left; font-size: 12px; padding-top: 5px;"></td>
                                                <td style="text-align: right; font-size: 12px; padding-top: 5px;"><b>Print Date :</b> {{ date('d-m-Y ') }}</td>
                                            </tr>
                                        </table>




<table class="table table-bordered" style="border-collapse: collapse; width: 100%;">
<tr>
<td colspan="6" class="bg-light"><strong>Registration Details</strong></td>
<!--Basic Details-->
</tr>
<tr>
  <?php //sdd($applicationview); ?>
<td style="width: 15%"><strong> Purpose</strong></td>
<td style="width: 20%">@if ($applicationview[0]->purpose == 1)
    Provide fellowships to athletes to enhance their performance and motivation.
        @elseif ($applicationview[0]->purpose == '2')
           Prepare athletes for National and International competitions.


        @elseif ($applicationview[0]->purpose == 3)
           Offer International Training opportunities and expertise to both Athletes and Coaches.

        @elseif ($applicationview[0]->purpose == 4)
      Ensure that athletes have access to comprehensive Health Insurance coverage.

        @elseif ($applicationview[0]->purpose == 5)
        Fund “Sports Research Projects” through financial grants.

        @elseif ($applicationview[0]->purpose == 6)
        Allocate additional incentives for athletes with disabilities, transgender athletes, and female athletes.

        @elseif ($applicationview[0]->purpose == 7)
        Organize promotional visits for sports organizations to districts in UP for talent hunting.

        @elseif ($applicationview[0]->purpose == 8)
        Supply athletes with the necessary sports equipment they require.
    @endif</td>
<td style="width: 15%"><strong>Full Name</strong></td>
<td style="width: 20%">{{!empty($applicationview[0]->name) ? $applicationview[0]->name : 'N/A' }}</td>
<td rowspan="5" colspan="2"><div class="text-center" style="padding: 5px;" align="center"> <img src="{{ asset('eklavya_krida_kosh/profile_picture/')}}/{{$applicationview[0]->profile_picture}}" class="img-fluid" style="width: 140px;" /> </div></td>

</tr>
<tr>
<td><strong>Email ID </strong></td>
<td>{{!empty($applicationview[0]->email) ? $applicationview[0]->email : 'N/A' }}</td>
<td><strong>Mobile Number</strong></td>
<td>{{!empty($applicationview[0]->mobile) ? $applicationview[0]->mobile : 'N/A' }}</td>

</tr>
<tr>
<td colspan="4" class="bg-light"><strong>Personal Details</strong></td>
</tr>
<tr>
<td><strong>Father Name</strong></td>
<td>{{ $applicationview[0]->father_name }}</td>
<td><strong>Mother Name</strong></td>
<td>{{ $applicationview[0]->mother_name}}</td>
</tr>
<tr>
<td><strong>Gender</strong></td>
<td>@if ($applicationview[0]->gender == 1)
    Male
@else
    Female
@endif</td>
<td><strong>Date of Birth</strong></td>
<td>{{dmy($applicationview[0]->dob) }}</td>
</tr>
<tr>
<td><strong>Aadhaar No.</strong></td>
<td>{{ $applicationview[0]->aadhaar }}</td>
<td><strong>Nationality</strong></td>
<td>{{ $applicationview[0]->nationality }}</td>
<td rowspan="2" colspan="2" align="center"><img src="{{ asset('eklavya_krida_kosh/signature/')}}/{{$applicationview[0]->signature}}" style="width: 90px;margin: auto;"></td>
</tr>



<tr>
<td><strong>Alternate Phone   Number</strong></td>
<td>{{ $applicationview[0]->phone }}</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>

<tr>
<td colspan="6" class="bg-light"><strong>Permanent Address</strong></td>
</tr>
<tr>
<td><b>Address</b></td>
<td>{{ $applicationview[0]->permanent_address }}</td>
<td><b>District</b></td>
<td>{{ districtName($applicationview[0]->permanent_district) }}</td>
<td><b>Pincode</b></td>
<td>{{ $applicationview[0]->permanent_pin }}</td>
</tr>

<td colspan="6"><strong>Correspondence Address</strong></td>
</tr><tr>
<td><b>Address</b></td>
<td>{{ $applicationview[0]->correspondance_address }}</td>
<td><b>District</b></td>
<td>{{districtName( $applicationview[0]->correspondance_district )}}</td>
<td><b>Pincode</b></td>
<td>{{ $applicationview[0]->correspondance_pin }}</td>
</tr>
<tr>
<td><strong>State</strong></td>
<td>{{ stateName($applicationview[0]->correspondance_state) }}</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
<td>&nbsp;</td>
</tr>
<tr>
<td colspan="6" class="bg-light"><strong>Educational Qualification</strong></td>
</tr>
<tr>
<td colspan="6"><table class="table table-bordered table-sm">
  <thead>
    <tr style="background-color: #dfdacd;">
      <th style="width:5%">S.No.</th>
      <th>Class</th>
      <th style="width:10%">Upload</th>
    </tr>
  </thead>
  <tbody>
    <tr>
      <td>1</td>
      <td>High School Certificate</td>
      <td><a  href="{{ asset('eklavya_krida_kosh/high_school_certificate/')}}/{{$applicationview[0]->high_school_certificate}}" target="_blank"  class="btn btn-success btn-xs">Uploaded</a></td>
    </tr>
    <tr>
      <td>2</td>
      <td>Domicile Certificate of UP</td>
      <td><a  href="{{ asset('eklavya_krida_kosh/domicile_certificate/')}}/{{$applicationview[0]->domicile_certificate}}" target="_blank" class="btn btn-success btn-xs">Uploaded</a></td>
    </tr>
    <tr>
      <td>3</td>
      <td>Highest Education Qualification</td>
      <td><a href="{{ asset('eklavya_krida_kosh/highest_qualification_certificate/')}}/{{$applicationview[0]->highest_qualification_certificate}}" target="_blank" class="btn btn-success btn-xs">Uploaded</a></td>
    </tr>
  </tbody>
</table></td>
</tr>
<tr>
<td colspan="6" class="bg-light"><strong>Awards & Achievements</strong></td>
</tr>
<tr>
<td colspan="6">
    <table class="table table-bordered table-sm awardtable">
        <thead>
          <tr style="background-color: #dfdacd;">
            <th style="width:5%">S.No.</th>
            <th style="width:18%">Sports Level</th>
            <th style="width:18%">Sport Name</th>
            <th style="width:18%">Championship Name</th>
            <th style="width:9%">Championship Date</th>
            <th style="width:8%">Document</th>
          </tr>
        </thead>
        <tbody>

            @foreach ($award as $key=>$item)


          <tr>
            <td>{{ $key+1 }}</td>
            <td>{{ $item->sport_level }}</td>
            <td>{{ sport_name($item->sport_id) }}</td>
            <td>{{ $item->award }}</td>
            <td>{{ dmy($item->champion_date)}}</td>

            <td>
                <a href="{{ asset('eklavya_krida_kosh/award/')}}/{{$item->upload_file}}" target="_blank" class="btn btn-success btn-xs">Uploaded</a>
               </td>
          </tr>
          @endforeach

        </tbody>
      </table>


</td>
</tr>
<tr>
<td colspan="6" class="bg-light"><strong>Account Information</strong></td>
</tr>
<tr>
<td colspan="6"><table class="table table-bordered table-sm">
  <thead>
    <tr style="background-color: #dfdacd;">
      <th style="width:25%">Bank Name</th>
      <th style="width:25%">IFSC Code</th>
      <th style="width:25%">Bank Account Number</th>
      <th style="width:25%">Front page of Passbook</th>
    </tr>
  </thead>
  <tbody>
    <tr>
        <td>{{ $applicationview[0]->bank_name }}</td>
        <td>{{ $applicationview[0]->ifsc_code }}</td>
        <td>{{ $applicationview[0]->account_no }}</td>
      <td><a href="{{ asset('eklavya_krida_kosh/front_page_of_passbook/')}}/{{$applicationview[0]->front_page_of_passbook}}" target="_blank" " class="btn btn-success btn-xs">Uploaded</a></td>
    </tr>

  </tbody>
</table></td>
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


              var actionUrl = ajaxUrl+"/eklavya_kreeda_kosh/final_submit";

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
