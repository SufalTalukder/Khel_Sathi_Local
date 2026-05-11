@extends( 'layouts/admin_layout' )
@section( 'content' )
<div class="container-fluid pagecontentbody">
    <div class="pagebody removebg-color">
        <div class="row">
            <div class="col-12">
                <div class="pageheader" id="menu-margin">
                    <h4 class="mb-0">
                        @if ($application->service == 1)

                        Swimming Pool (Mini)
                    @elseif ($application->service == 2)
                    Guest Room
                    @elseif ($application->service == 3)
                  Swimming Pool (Adult)
                    @elseif ($application->service == 4)

                    Gymnasium
                    @elseif ($application->service == 5)
                    Stadium
                    @endif    Application Preview
                        <button type="button" data-print="modal" class="btn btn-sm  btn-outline-primary ms-2 float-end rounded-pill" onclick="PrintDoc()"><span class="icons icon-printer"></span> Print</button>

 <a
                        @if ($application->service == 1)
                            href="{{route('admin_facility_booking_dashboard',1)}}"
                                                    @elseif ($application->service == 2)
                                      href="{{route('admin_facility_booking_dashboard',2)}}"
                                                    @elseif ($application->service == 3)
                                            href="{{route('admin_facility_booking_dashboard',3)}}"
                                                    @elseif ($application->service == 4)

                                            href="{{route('admin_facility_booking_dashboard',4)}}"
                                                    @elseif ($application->service == 5)
                                         href="{{route('admin_facility_booking_dashboard',5)}}"
                                                    @endif class="btn btn-outline-danger btn-sm backbtn float-end rounded-pill"><span class="icons icon-arrow-left"></span>Back to List</a>
                                                  @if ($application->status == 1)
                                                  <a href="javascript:void(0)"class="btn btn-outline-success btn-xs backbtn me-1 float-end">
                                                    Accepted
                                                </a>
                                                @elseif ($application->status == 2)
                                                <a href="javascript:void(0)"  class="btn btn-outline-danger btn-xs backbtn me-1 float-end">
                                                    Rejected
                                                </a>
                                                  @else
                                                  @if(Auth::guard('admin')->user()->admin_role != 1 && Auth::guard('admin')->user()->admin_role !=18)

                                                  <a href="#" data-bs-toggle="modal" data-bs-target="#queryModal" class="btn btn-outline-info btn-xs backbtn me-1 float-end">
                                                    Query
                                                </a>
                                                  <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#rejectModal" class="btn btn-outline-danger btn-xs backbtn me-1 float-end">
                                                    Reject
                                                </a>
                                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#acceptModal" class="btn btn-outline-success btn-xs backbtn me-1 float-end">
                                                    Accept
                                                </a>
                                                @endif
                                                  @endif




                    </h4>

                </div>
                <div class="bhoechie-tab-container">
                    <div class="form-scroll">
                        <div class="nano-content">
                            <div class="card">
                                <div class="card-body">
                                    <div id="prodiv">



                                         <table border="0" cellspacing="0" cellpadding="4" width="100%" style="border-collapse:collapse;">
                                            <thead class="dn">
                                                <tr>
                                                    <th colspan="2">
                                                        <div style="padding: 0 15px 10px; margin-bottom: 10px; border-bottom: 2px solid #000; position: relative;">
                                                            <img src="{{ asset('facility_booking_storage') }}/images/logo.png"
                                                                 style="width: 70px; height: auto; position: absolute; top: 0px; left: 5px;">
                                                            <h1 style="text-align: center; font-size: 20pt; margin: 0px 0px 0px 0px; padding: 0px 0 0; color: #383838; font-weight: bold;">
                                                                Sports Directorate, Govt. of Uttar Pradesh
                                                            </h1>
                                                            <h5 style="text-align: center; margin:10px 0px 0px 0px; font-size:12pt; padding: 0px; color:#383838; font-weight: bold;">
                                                                Khel Bhawan Hazratganj Lucknow, Uttar Pradesh 226001
                                                            </h5>
                                                        </div>
                                                        <h6 style="text-align: center; margin:10px 0px 15px 0px; font-size:12pt; padding: 0px; color:#383838; font-weight: bold; text-decoration:underline;">
                                                            @if ($application->service == 1)

                                                            Swimming Pool (Mini)
                                                        @elseif ($application->service == 2)
                                                        Guest Room
                                                        @elseif ($application->service == 3)
                                                      Swimming Pool (Adult)
                                                        @elseif ($application->service == 4)

                                                        Gymnasium
                                                        @elseif ($application->service == 5)
                                                        Stadium
                                                        @endif Booking Application Form
                                                        </h6>
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th style="font-size: 10pt; text-align:left">
                                                    </th>
                                                    <th style="text-align: right; font-size: 10pt;">
                                                        <b>Print Date :</b> {{ date('d-m-Y ') }}

                                                    </th>
                                                </tr>
                                            </thead>

                                        </table>
                                        <table class="table table-bordered" border="0" cellspacing="0" cellpadding="3" width="100%" style="border-collapse:collapse; font-size:10pt;">
                                            <tbody>
                                                <tr>
                                                    <td><b>Full Name/पूरा नाम</b></td>
                                                    <td colspan="3">{{$user->name}}</td>
                                                    <td rowspan="6" style="width:15%;">
                                                        <div class="text-center" style="padding: 0px;" align="center">@if($attachment->applicant_photo) <img src="{{asset('facility_booking_storage/applicant_photo')}}/{{$attachment->applicant_photo}}" class="img-fluid" style="width: 140px; border: 1px solid #ccc;height: 140px;" /> @endif </div>
                                                        <div class="text-center" style="padding: 5px;" align="center">@if($attachment->applicant_signature) <img src="{{asset('facility_booking_storage/applicant_signature')}}/{{$attachment->applicant_signature}}" class="img-fluid" style="width: 140px; border:1px solid #ccc;height: 40px;" />@endif  </div>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td><b>Email ID/ईमेल आईडी</b></td>
                                                    <td colspan="3">{{$user->email}}</td>
                                                </tr>
                                                <tr>
                                                    <td><b>Moblie No./मोबाइल नंबर</b></td>
                                                    <td colspan="3">{{$user->mobile}}</td>
                                                </tr>
                                                <tr>
                                                    <td><b>Father's Name/पिता का नाम</b></td>
                                                    <td colspan="3">{{$user->fathername}}</td>
                                                </tr>
                                                <tr>
                                                    <td><b>Mother's Name/मां का नाम</b></td>
                                                    <td colspan="3">{{$user->mothername}}</td>
                                                </tr>
                                                <tr>
                                                    <td><b>Nationality/राष्ट्रीयता</b></td>
                                                    <td colspan="3">{{$user->nationality}}</td>
                                                </tr>
                                                <tr>
                                                    <td><b>Date of Birth/जन्मतिथि</b></td>
                                                    <td colspan="4">{{dmy($user->dob)}}</td>
                                                </tr>
                                                <tr>
                                                    <td><b>Age/आयु</b></td>
                                                    <td colspan="4">{{$user->age}}</td>
                                                </tr>
                                                <tr>
                                                    <td colspan="5" style="background-color:#eee;"><b>Address Details/पते का विवरण</b></td>
                                                </tr>
                                                <tr>
                                                    <input type="hidden" value="{{$application->id}}" id="application_oidddd">
                                                    <td><b> Address/पता</b></td>
                                                    <td colspan="4">{{$application->address}}</td>
                                                </tr>
                                                <tr>
                                                    <td><b>State/राज्य</b></td>
                                                    <td colspan="4">Uttar Pradesh</td>
                                                </tr>
                                                <tr>
                                                    <td style="width:22%"><b>City/शहर</b></td>
                                                    <td style="width:25%">{{districtName($application->city)}}</td>
                                                    <td style="width:22%"><b>PIN Code/पिन कोड</b></td>
                                                    <td colspan="2">{{$application->pin}}</td>
                                                </tr>

                                                <tr>
                                                    <td colspan="5" style="background-color:#eee;"><b>Booking Type/बुकिंग का प्रकार</b></td>
                                                </tr>
                                                <tr>
                                                    <td style="width:22%"><b>Booking Type/बुकिंग का प्रकार</b></td>
                                                    <td style="width:25%">@if ($application->booking_type == 2 )
                                                        Family Member
                                                    @elseif  ($application->booking_type == 3 )
                                                    Organization
                                                     @else
                                                     Self
                                                    @endif</td>

                                                </tr>

                                                @if($application->booking_type == 2 )

                                                <tr>
                                                    <td colspan="5" style="background-color:#eee;"><b>Family Details/परिवार का विवरण</b></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Name<br /> नाम</b></td>
                                                    <td>{{$application->family_member_name}}</td>
                                                    <td><b>Date of Birth<br />जन्मतिथि </b></td>
                                                    <td colspan="2">{{dmy($application->family_member_dob)}}</td>
                                                </tr>
                                                <tr>
                                                    <td><b>Relation<br />/संगठन का दस्तावेज़ </b></td>
                                                    <td colspan="4">{{$application->family_member_relation}}</td>

                                                </tr>
                                                @endif

                                                @if($application->booking_type == 3 )

                                                <tr>
                                                    <td colspan="5" style="background-color:#eee;"><b>Organization Details(Optional)/संगठन का विवरण(वैकल्पिक)</b></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Organization Name<br />संगठन का नाम</b></td>
                                                    <td>{{$application->organisation_name}}</td>
                                                    <td><b>Organization Registration Number<br />संगठन पंजीकरण संख्या</b></td>
                                                    <td colspan="2">{{$application->organisation_registration_no}}</td>
                                                </tr>
                                                <tr>
                                                    <td><b>Organization Document<br />/संगठन का दस्तावेज़ </b></td>
                                                    <td><a href="{{asset('facility_booking_storage/organisation_document')}}/{{$application->organisation_document}}" class="btn btn-primary btn-sm">Uploaded</a></td>
                                                    <td><b>Fee Exemption<br />शुल्क में छूट</b></td>
                                                    <td colspan="2"> @if($application->organisation_fee_exemption == 1) Yes @else No @endif </td>
                                                </tr>
                                                @endif
                                                <tr>
                                                    <td colspan="5" style="background-color:#eee;"><b>Service Details/सेवा का विवरण</b></td>
                                                </tr>
                                                <tr>
                                                    <td><b>Service/सेवा</b></td>
                                                    <td>@if ($application->service == 1)

                                                        Swimming Pool (Mini)
                                                    @elseif ($application->service == 2)
                                                    Guest Room
                                                    @elseif ($application->service == 3)
                                                  Swimming Pool (Adult)
                                                    @elseif ($application->service == 4)

                                                    Gymnasium
                                                    @elseif ($application->service == 5)
                                                    Stadium
                                                    @endif</td>
                                                    <td><b>Location/स्थान </b></td>
                                                    <td colspan="2">{{districtName($service_detail->location)}}</td>
                                                </tr>
                                                <tr>
                                                    <td><b>Stadium/स्टेडियम  </b></td>
                                                    <td>{{stadium_name($service_detail->stadium)}}</td>
                                                    @if ($application->service == 5)
                                                    <td><b>Sport Name/खेल का नाम</b></td>
                                                    <td colspan="2"> @if ( $application->service == 5){{sport_name($service_detail->sport_id)}} @else NA @endif</td>
                                                    @elseif ($application->service == 2)
                                                    <td><b>Rooms Selection/कमरों का चयन</b></td>
                                                    <td colspan="2"> @if ( $application->service == 2){{$service_detail->room_type}} @else NA @endif</td>
                                                    @else
                                                    <td><b>&nbsp;</b></td>
                                                    <td colspan="2">&nbsp;</td>
                                                    @endif
                                                </tr>
                                                <tr>
                                                    <td><b>Purpose/उद्देश्य </b></td>
                                                    <td>{{$service_detail->purpose}}</td>
                                                    <td><b>Date Range/दिनांक सीमा</b></td>
                                                    <td colspan="2">{{dmy($service_detail->booking_date_from)}} to {{dmy($service_detail->booking_date_to)}}</td>
                                                </tr>

                                                @if ($application->service == 2 || $application->service == 1 || $application->service == 5)
                                                <tr>
                                                    <td><b>Time Range/समय सीमा</b></td>
                                                    <td colspan="4">{{$service_detail->booking_time_from}} - {{$service_detail->booking_time_to}}</td>
                                                </tr>

                                                @endif

                                                @if ($application->service == 2 || $application->service == 1 || $application->service == 5)
                                                <tr>
                                                    @if ($application->service == 2)

                                                    <td><b>Members/सदस्य</b></td>
                                                    <td>@if ( $application->service == 2){{$service_detail->member}} @else NA @endif</td>
                                                   @endif
                                                    <td><b>Time Range/समय सीमा</b></td>
                                                    <td colspan="2">{{$service_detail->booking_time_from}} - {{$service_detail->booking_time_to}}</td>
                                                </tr>
                                                @endif


                                                <tr>
                                                    <td colspan="5" style="background-color:#eee;"><b>Attachments/संलग्नक</b></td>
                                                </tr>


                                                @if ($application->service == 1 || $application->service == 2 || $application->service == 3 || $application->service == 4|| $application->service == 5)


                                                <tr>
                                                    <td><b>Applicant Photo/आवेदक फोटो</b></td>
                                                    <td colspan="4"><a href="{{asset('facility_booking_storage/applicant_photo')}}/{{$attachment->applicant_photo}}" class="btn btn-primary btn-sm">Uploaded</a></td>
                                                </tr>

                                                @endif

                                                @if ($application->service == 4 || $application->service == 2 || $application->service == 3 || $application->service == 4|| $application->service == 5)
                                                                                            <tr>
                                                    <td><b>Aadhaar Card/आधार कार्ड</b></td>
                                                    <td colspan="4"><a href="{{asset('facility_booking_storage/applicant_aadhaar')}}/{{$attachment->applicant_aadhaar}}" class="btn btn-primary btn-sm">Uploaded</a></td>
                                                </tr>
                                                @endif

                                                @if ($application->service == 2|| $application->service == 3||$application->service == 4||$application->service == 5)
                                                <tr>
                                                    <td><b> Signature/दस्तखत</b></td>
                                                    <td colspan="4"><a href="{{asset('facility_booking_storage/applicant_signature')}}/{{$attachment->applicant_signature}}" class="btn btn-primary btn-sm">Uploaded</a></td>
                                                </tr>
                                                @endif
                                                @if ( $application->service == 1  )
                                                <tr>
                                                    <td><b>Parent Aadhar/अभिभावक आधार</b></td>
                                                    <td colspan="4"><a href="{{asset('facility_booking_storage/applicant_parent_aadhaar')}}/{{$attachment->applicant_parent_aadhaar}}" class="btn btn-primary btn-sm">Uploaded</a></td>
                                                </tr>
                                                @endif
                                                @if ($application->service == 1 )
                                                <tr>
                                                    <td><b>Parent Signature/मूल दस्तखत</b></td>
                                                    <td colspan="4"><a href="{{asset('facility_booking_storage/applicant_parent_signature')}}/{{$attachment->applicant_parent_signature}}" class="btn btn-primary btn-sm">Uploaded</a></td>
                                                </tr>
                                                @endif
                                                @if ($application->service == 1 )
                                                <tr>
                                                    <td><b>Age Proof/आयु प्रमाण</b></td>
                                                    <td colspan="4"><a href="{{asset('facility_booking_storage/applicant_age_proof')}}/{{$attachment->applicant_age_proof}}" class="btn btn-primary btn-sm">Uploaded</a></td>
                                                </tr>


                                                @endif
                                                @if ( $application->service == 1 || $application->service == 3 )
                                                <tr>
                                                    <td><b> M.B.B.S Doctor Certificate/एम.बी.बी.एस डॉक्टर प्रमाणपत्र</b></td>
                                                    <td colspan="4"><a href="{{asset('facility_booking_storage/mbbs_doctor_certificate')}}/{{$attachment->mbbs_doctor_certificate}}" class="btn btn-primary btn-sm">Uploaded</a></td>
                                                </tr>
                                                @endif
                                                @if ( $application->service == 1 ||  $application->service == 3 )
                                                <tr>
                                                    <td><b>Address Proof/निवास प्रमाण पत्र</b></td>
                                                    <td colspan="4"><a href="{{asset('facility_booking_storage/address_proof')}}/{{$attachment->address_proof}}" class="btn btn-primary btn-sm">Uploaded</a></td>
                                                </tr>
                                                @endif

                                                <tr>
                                                    <td colspan="5" style="background-color:#eee;"><strong>Declaration/घोषणा</strong></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="5">I declare that the above particulars are true to the best of my knowledge. If any of my facts are found to be wrong, my admission should be canceled, for which all responsibility will be mine. I have read all the facts thoroughly.<br>मैं घोषणा करता हूं कि उपरोक्त विवरण मेरी सर्वोत्तम जानकारी के अनुसार सत्य हैं। यदि मेरा कोई भी तथ्य गलत पाया जाये तो मेरा प्रवेश निरस्त कर दिया जाये, जिसकी समस्त जिम्मेदारी मेरी होगी। मैंने सभी तथ्यों को अच्छी तरह से पढ़ लिया है। </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="5" align="center">




                                                        <input type="checkbox" id="player_coachChecked"     checked  disabled />
                                                        &nbsp; <b>I Agree/मैं सहमत हूं</b>
                                                    </td>
                                                </tr>
                                            </tbody>
                                            <tfoot class="dn">
                                                <tr>
                                                    <td colspan="5" style="border:0; height:30px;">&nbsp;</td>
                                                </tr>
                                            </tfoot>
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


<div class="modal fade" id="acceptModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="forwrdedLabel" aria-hidden="true">

    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Accept</h5>

            </div>
            <form action="{{ route('admin_facility_booking_accepted_reject_status') }}" id="preregister" method="post" class="needs-validation" novalidate enctype="multipart/form-data" >
                @csrf
            <div class="modal-body">
                <div class="row">

                    <div class="col-md-6 mb-3">
                        <label>Fee Exemption</label>
                        <div class="form-control">
                            <input type="checkbox" class="form-check-input" name="fee_exemption_status" value="1"> Fee Exemption
                        </div>
                    </div>
                    <div class="col-md-6 mb-3">
                        <label>Upload File</label>
                        <div class="input-group">
                            <input type="file" class="form-control" name="upload_file_accept" id="upload_file_acceptttt">

                        </div>
                    </div>
                    <div class="col-md-12 mb-3" id="amount_to_be_paiddddddddddd">
                        <input type="hidden" name="status" value="1">
                        <input type="hidden" name="application_id" value="{{$application->id}}">
                        <label>Enter Ammount To Be Paid</label>
                        <input type="number" name="amount_to_be_paid" min="1" max="100000" required class="form-control" id="amount_to_be_paidddd">
                    </div>

                    <div class="col-md-12 mb-3">
                        <label>Remarks</label>
                        <input type="text" class="form-control" name="remark" required>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn btn-outline-danger" data-bs-dismiss="modal">Close</button>

                <button type="submit" class="btn btn-outline-success">Approved</button>
            </div>
          </form>
        </div>
    </div>
</div>




    <div class="modal fade" id="rejectModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="forwrdedLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Reject</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <form action="{{ route('admin_facility_booking_accepted_reject_status') }}" id="preregisterr" method="post" class="needs-validation" novalidate enctype="multipart/form-data" >
                @csrf
            <div class="modal-body">
                <div class="modal-body">
                    <div class="row">
                        <input type="hidden" name="status" value="2" >
                        <input type="hidden" name="application_id" value="{{$application->id}}">
                        <div class="col-md-12 mb-3">
                            <label>Remarks</label>
                            <input type="text" class="form-control" name="remark" required>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-outline-success">Submit</button>
            </div>
          </form>
        </div>
    </div>
</div>








<div class="modal fade" id="queryModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="forwrdedLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Query Marked</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            @if($application->final_submit == 1 && $application->query_status == 1)

            <div class="modal-body">
                <table class="table table-bordered">
                    <thead>
                        <tr>
                            <th>S.No.</th>
                            <th>Query</th>
                            <th>Query Date</th>
                            <th>File</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td><b>1</b></td>
                            <td>{{$application->query}}</td>
                            <td>{{dmy($application->marked_on)}}</td>
                            @if ($application->query_upload)
                            <td><a class="btn btn-primary btn-sm" href="{{asset('facility_booking_storage/query_upload')}}/{{$application->query_upload}}" title="View File">Uploaded</a></td>
                            @else
                            <td>NA</td>
                            @endif

                        </tr>
                    </tbody>
                </table>
            </div>



          @else
          <form action="{{ route('admin_facility_booking_query_mark') }}" id="preregisterrr" method="post" class="needs-validation" novalidate enctype="multipart/form-data" >
            @csrf
        <div class="modal-body">
            <div class="modal-body">

                    <input type="hidden" name="application_id" value="{{$application->id}}">


                <div class="row">
                    <div class="col-md-12 mb-3">
                        <label>Query</label>
                       <input type="text" name="query_text" class="form-control" required>
                    </div>
                    <div class="col-md-12 mb-3">
                        <label>Upload File</label>
                        <div class="input-group">
                            <input type="file" name="query_upload" class="form-control">

                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
             <button type="submit" class="btn btn-outline-success">Submit</button>
        </div>
      </form>

          @endif
        </div>
    </div>
</div>
<script>


$('input[name=fee_exemption_status]').change(function() {



    if ($('input[name=fee_exemption_status]').is(':checked')) {
           $('#upload_file_acceptttt').prop('required', true);
           $('#amount_to_be_paidddd').prop('required', false);
           $('#amount_to_be_paiddddddddddd').css("display", "none");

        }else{
            $('#upload_file_acceptttt').prop('required', false);
            $('#amount_to_be_paidddd').prop('required', true);
            $('#amount_to_be_paiddddddddddd').css("display", "");
        };
})



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




      $("#preregister").submit(function (e) {

e.preventDefault();
if ($("#preregister")[0].checkValidity() === false) {
    e.stopPropagation();
} else {
    $.ajax({
        type: "POST",
        url: $(this).attr("action"),
        data: new FormData(this),
        dataType: "json",
        contentType: false,
        cache: false,
        processData: false,
        success: function (res) {
            if (res.error == false) {
                success(res.msg);

                window.location.href = res.url;


            } else {
                error(res.msg);
            }
        },
    });
}
$("#preregister").addClass("was-validated");
});




$("#preregisterrr").submit(function (e) {

e.preventDefault();
if ($("#preregisterrr")[0].checkValidity() === false) {
    e.stopPropagation();
} else {
    $.ajax({
        type: "POST",
        url: $(this).attr("action"),
        data: new FormData(this),
        dataType: "json",
        contentType: false,
        cache: false,
        processData: false,
        success: function (res) {
            if (res.error == false) {
                success(res.msg);

                window.location.href = res.url;


            } else {
                error(res.msg);
            }
        },
    });
}
$("#preregisterrr").addClass("was-validated");
});


$("#preregisterr").submit(function (e) {

e.preventDefault();
if ($("#preregisterr")[0].checkValidity() === false) {
    e.stopPropagation();
} else {
    $.ajax({
        type: "POST",
        url: $(this).attr("action"),
        data: new FormData(this),
        dataType: "json",
        contentType: false,
        cache: false,
        processData: false,
        success: function (res) {
            if (res.error == false) {
                success(res.msg);

                window.location.href = res.url;


            } else {
                error(res.msg);
            }
        },
    });
}
$("#preregisterr").addClass("was-validated");
});

</script>

@endpush
