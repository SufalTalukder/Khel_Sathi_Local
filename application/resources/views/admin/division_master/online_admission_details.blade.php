@extends('layouts/admin_layout')
@section('content')
<div class="row">
            <div class="col-md-10">
               <div class="pageheader" id="menu-margin">
			<h4 class="mb-0">Admission Detail</h4>
		</div>
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="mb-0"> Admission Detail</h5>
                        <a title="Print"class="btn btn-warning float-end" id="print" onclick="printContent('examples')">Print</a>
                    </div>
                    <div class="col-md-12">
                    
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <div class="table-responsive" id="examples">
                        <table  id="dataTable" class="table table-bordred table-hover bg-white datatable"
                            >
                            <table  id="dataTable" class="table table-bordered" border="1" style="border-collapse: collapse; width: 100%;">
                              <tr>
                                <td colspan="6" class="bg-light"><strong>Basic Details</strong></td>
                              </tr>
                              <tr>
                                <td><b>Applicant Name</b></td>
                                <td>{{$data->application_no}}</td>
                                <td><b>Date of Birth</b></td>
                                <td>{{dmy($data->dob)}}</td>
                                <td rowspan="5" colspan="2"><!--<b>Photograph of Applicant</b><br />-->
                                  <div class="text-center" style="padding: 5px;" align="center"> <img src="{{ url('onlineAdmission') }}/images/{{$data->applicant_photograph}}" class="img-fluid" style="width: 140px;" /> </div></td>
                              </tr>
                              <tr>
                                <td><b>Aadhar Number</b></td>
                                <td>{{$data->aadhar_no}}</td>
                                <td><b>Aadhar Card</b></td>
                                <td><strong class="rounded-pill btn btn-outline-danger btn-xs disabled">Uploaded</strong></td>
                              </tr>
                              <tr>
                                <td><b>Mobile Number</b></td>
                                <td>{{$data->mobile}}</td>
                                <td><b>Email ID</b></td>
                                <td>{{$data->email}}</td>
                              </tr>
                              <tr>
                                <td><b>District</b></td>
                                <td>{{districtName($data->p_district)}}</td>
                                <td><b>Sports College</b></td>
                                <td>{{sportCollege($data->sport_college)}}</td>
                              </tr>
                              <tr>
                                <td><b>Sports Name</b></td>
                                <td>{{$data->name}}</td>
                                <td><b>Category</b></td>
                                <td>
                                  @if($data->category == '1') General
                                  @elseif($data->category == '2') OBC  
                                  @elseif($data->category == '3') SC 
                                  @elseif($data->category == '4') ST
                                  @else EWS
                                  @endif
                                </td>
                              </tr>
                              <tr>
                                <td><b>Sub Category</b></td>
                                <td>{{$data->sub_category}}</td>
                                <td><b>Father’s Name</b></td>
                                <td>{{$data->father_name}}</td>
                                <td rowspan="2" colspan="2"><!--<b>Signature  of Applicant</b><br />-->
                                  <div class="text-center" style="padding: 5px;" align="center"> <img src="{{ url('onlineAdmission') }}/images/{{$data->applicant_signature}}" class="img-fluid" style="width: 140px;" /> </div></td>
                              </tr>
                              <tr>
                                <td><b>Occupation</b></td>
                                <td>{{$data->father_occupation}}</td>
                                <td><b>Mother’s Name</b></td>
                                <td>{{$data->mother_name}}</td>
                              </tr>
                              <tr>
                                <td style="width: 15%"><b>Occupation</b></td>
                                <td style="width: 20%">{{$data->mother_occupation}}</td>
                                <td style="width: 15%"><b>Height (in centimeter)</b></td>
                                <td style="width: 20%">{{$data->height}}</td>
                                <td style="width: 15%"><b>Weight (in Kg)</b></td>
                                <td style="width: 15%">{{$data->weight}}</td>
                              </tr>
                              <tr>
                                <td><b>Blood Group</b></td>
                                <td>{{$data->blood_group}}</td>
                                <td><b>Domicile of Uttar Pradesh</b></td>
                                <td>Yes</td>
                                <td><b>Domicile Certificate</b></td>
                                <td><strong class="rounded-pill btn btn-outline-danger btn-xs disabled">Uploaded</strong></td>
                              </tr>
                              <tr>
                                <td><b>Identification Mark</b></td>
                                <td>{{$data->identification_marks}}</td>
                                <td><b>Number of Teeth</b></td>
                                <td>{{$data->no_teeth}}</td>
                                <td><b>Suffering from Skin Disease/Fits/Other Disease</b></td>
                                <td>
                                    @if($data->disease == '1') YES
                                      @else NO
                                      @endif
                                </td>
                              </tr>
                              <tr>
                                <td><b>Medical Certificate</b></td>
                                <td><strong class="rounded-pill btn btn-outline-danger btn-xs disabled">Uploaded</strong></td>
                                <td><b>Residential Certificate</b></td>
                                <td colspan="3"><strong class="rounded-pill btn btn-outline-danger btn-xs disabled">Uploaded</strong></td>
                              </tr>
                              <tr>
                                <td colspan="6" class="bg-light"><strong>Communication Details</strong></td>
                              </tr>
                              <tr>
                                <td colspan="6"><strong style="font-size: 14px;">Permanent Address</strong></td>
                              </tr>
                              <tr>
                                <td><b>Gram/Mohalla</b></td>
                                <td>{{$data->p_gram}}</td>
                                <td><b>Post</b></td>
                                <td>{{$data->p_post}}</td>
                                <td><b>Thana</b></td>
                                <td>{{$data->p_thana}}</td>
                              </tr>
                              <tr>
                                <td><b>State</b></td>
                                <td>{{stateName($data->p_state)}}</td>
                                <td><b>District</b></td>
                                <td>{{districtName($data->p_district)}}</td>
                                <td><b>Mobile No.</b></td>
                                <td>{{$data->p_mobile}}</td>
                              </tr>
                              <tr>
                                <td><b>Alternate Contact No.</b></td>
                                <td>{{$data->p_alternate_mobile}}</td>
                                <td><b>Email ID</b></td>
                                <td colspan="3">{{$data->p_email}}</td>
                              </tr>
                              <tr>
                                <td colspan="6"><strong style="font-size: 14px;">Correspondence Address</strong></td>
                              </tr>
                              <tr>
                                <td><b>Gram/Mohalla</b></td>
                                <td>{{$data->c_gram}}</td>
                                <td><b>Post</b></td>
                                <td>{{$data->c_post}}</td>
                                <td><b>Thana</b></td>
                                <td>{{$data->c_thana}}</td>
                              </tr>
                              <tr>
                                <td><b>State</b></td>
                                <td>{{stateName($data->c_state)}}</td>
                                <td><b>District</b></td>
                                <td>{{districtName($data->c_district)}}</td>
                                <td><b>Mobile No.</b></td>
                                <td>{{$data->c_mobile}}</td>
                              </tr>
                              <tr>
                                <td><b>Alternate Contact No.</b></td>
                                <td>{{$data->c_alternate_mobile}}</td>
                                <td><b>Email ID</b></td>
                                <td colspan="3">{{$data->c_email}}</td>
                              </tr>
                              <tr>
                                <td colspan="6" class="bg-light"><strong>Educational Qualification</strong></td>
                              </tr>
                              <tr>
                                <td><b>Class</b></td>
                                <td>{{$data->class}}</td>
                                <td><b>School Name</b></td>
                                <td>{{$data->school}}</td>
                                <td><b>Year of Passing</b></td>
                                <td>{{$data->year_of_passing}}</td>
                              </tr>
                              <tr>
                                <td><b>Obtained Marks</b></td>
                                <td>{{$data->obtained_marks}}</td>
                                <td><b>Maximum Marks</b></td>
                                <td>{{$data->maximum_marks}}</td>
                                <td><b>Grade / Percntage</b></td>
                                <td>{{$data->grade_percentage}}</td>
                              </tr>
                            </table>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('custom-scripts')
<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script type="text/javascript">
//=============================
function printContent(el) {
        var restorepage = document.body.innerHTML;
        var printcontent = document.getElementById(el).innerHTML;
        document.body.innerHTML = printcontent;
        window.print();
        document.body.innerHTML = restorepage;
    }

</script>
@endpush
