@extends('layouts/facility_booking_auth')
@section('content')
<div class="container-fluid pagecontentbody">
    <div class="pagebody removebg-color">
        <div class="row">
            <div class="col-12">
                <div class="pageheader" id="menu-margin">
                    <h4 class="mb-0">
                        Preview/पूर्वावलोकन
                        <a href="{{route('facility_booking_dashboard')}}" class="btn btn-outline-success btn-sm backbtn float-end ">
                            <span class="icons icon-arrow-left"></span>Back to Dashboard
                        </a>
                        @if($application->final_submit == 1 && $application->query_status == 1)
                        <a class="btn btn-outline-info backbtn btn-sm float-end me-1" data-bs-toggle="modal" data-bs-target="#viewQuery" href="#"></i> View Query</a>
                        @endif
                        @if($application->status == 1)
                        <a href="{{route('facility_booking_payment_request',$application->id)}}" class="btn btn-outline-warning btn-sm backbtn float-end ">
                            <span class="icons icon-arrow-left"></span>Update Payment Status
                           </a>
                        @endif

                        <button type="button" class="btn btn-outline-primary backbtn btn-sm float-end me-1" data-print="modal" onclick="PrintDoc()"><i class="fa fa-print"></i> Print</button>
                    </h4>
                </div>
            </div>
            <div class="col-12">
                <div class="bhoechie-tab-container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bhoechie-tab">
                            <div class="bhoechie-tab-content active" id="prodiv">
                                <div id="content" style="position:relative;">
                                    <table border="0" cellspacing="0" cellpadding="4" width="100%" style="border-collapse:collapse;">
                                        <thead class="dn">
                                            <tr>
                                                <th colspan="2">
                                                    <div style="padding: 0 15px 10px; margin-bottom: 10px; border-bottom: 2px solid #000; position: relative;">
                                                        <img src="{{ asset('facility_booking_storage/') }}/images/logo.png"
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
                                                    <strong>Generated On : </strong> {{date('d-m-Y')}}
                                                </th>
                                            </tr>
                                        </thead>
                                    </table>
                                    <table class="table table-bordered" border="0" cellspacing="0" cellpadding="3" width="100%" style="border-collapse:collapse; font-size:10pt;">
                                        <tbody>
                                            <tr>
                                                <td><b>Full Name/पूरा नाम</b></td>
                                                <td colspan="3">{{Auth::guard('facility_booking')->user()->name}}</td>
                                                <td rowspan="6" style="width:15%;">
                                                    <div class="text-center" style="padding: 0px;" align="center">@if($attachment->applicant_photo) <img src="{{asset('facility_booking_storage/applicant_photo')}}/{{$attachment->applicant_photo}}" class="img-fluid" style="width: 140px; border: 1px solid #ccc;height: 140px;" /> @endif </div>
                                                    <div class="text-center" style="padding: 5px;" align="center">@if($attachment->applicant_signature) <img src="{{asset('facility_booking_storage/applicant_signature')}}/{{$attachment->applicant_signature}}" class="img-fluid" style="width: 140px; border:1px solid #ccc;height: 40px;" />@endif </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><b>Father's Name/पिता का नाम</b></td>
                                                <td colspan="3">{{Auth::guard('facility_booking')->user()->fathername}}</td>
                                            </tr>
                                            <tr>
                                                <td><b>Mother's Name/मां का नाम</b></td>
                                                <td colspan="3">{{Auth::guard('facility_booking')->user()->mothername}}</td>
                                            </tr>
                                            <tr>
                                                <td><b>Nationality/राष्ट्रीयता</b></td>
                                                <td colspan="3">{{Auth::guard('facility_booking')->user()->nationality}}</td>
                                            </tr>
                                            <tr>
                                                <td><b>Email ID/ईमेल आईडी</b></td>
                                                <td colspan="3">{{Auth::guard('facility_booking')->user()->email}}</td>
                                            </tr>
                                            <tr>
                                                <td><b>Moblie No./मोबाइल नंबर</b></td>
                                                <td colspan="3">{{Auth::guard('facility_booking')->user()->mobile}}</td>
                                            </tr>
                                            <tr>
                                                <td><b>Date of Birth/जन्मतिथि</b></td>
                                                <td colspan="4">{{dmy(Auth::guard('facility_booking')->user()->dob)}}</td>
                                            </tr>
                                            <tr>
                                                <td><b>Age/आयु</b></td>
                                                <td colspan="4">{{Auth::guard('facility_booking')->user()->age}}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="5" style="background-color:#eee;"><b>Booking Type/बुकिंग का प्रकार</b></td>
                                            </tr>
                                            <tr>
                                                <td style="width:22%"><b>Booking Type/बुकिंग का प्रकार</b></td>
                                                <td colspan="4" style="width:25%">@if ($application->booking_type == 2 )
                                                    Family Member
                                                    @elseif ($application->booking_type == 3 )
                                                    Organization
                                                    @else
                                                    Self
                                                    @endif
                                                </td>
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
                                                <td><b>Relation<br />संगठन का दस्तावेज़ </b></td>
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
                                                <td colspan="5" style="background-color:#eee;"><b>Service Details/सेवा का विवरण</b></td>
                                            </tr>
                                            <tr>
                                                <td><b>Service/सेवा</b></td>
                                                <td>
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
                                                    @endif
                                                </td>
                                                <td><b>Location/स्थान </b></td>
                                                <td colspan="2">{{districtName($service_detail->location)}}</td>
                                            </tr>
                                            <tr>
                                                <td><b>Stadium/स्टेडियम </b></td>
                                                <td>{{stadium_name($service_detail->stadium)}}</td>
                                                @if ($application->service == 5)
                                                <td><b>Sport Name/खेल का नाम</b></td>
                                                <td colspan="2"> @if ( $application->service == 5){{sport_name($service_detail->sport_id)}} @else NA @endif</td>
                                                @elseif ($application->service == 2)
                                                <td><b>Rooms Selection/कमरों का चयन</b></td>
                                                <td colspan="2"> @if ( $application->service == 2){{sport_name($service_detail->sport_id)}} @else NA @endif</td>
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
                                                @if ($application->service == 2)

                                                <td><b>Members/सदस्य</b></td>
                                                <td>@if ( $application->service == 2){{$service_detail->member}} @else NA @endif</td>
                                               @endif
                                                    </tr>
                                            @endif
                                            @if ($application->service == 1 || $application->service == 5)
                                            <tr>
                                                <td><b>Time Range/समय सीमा</b></td>
                                                <td colspan="4">{{$service_detail->booking_time_from}} - {{$service_detail->booking_time_to}}</td>
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
                                                <td><b>Applicant Signature/आवेदक दस्तखत</b></td>
                                                <td colspan="4"><a href="{{asset('facility_booking_storage/applicant_signature')}}/{{$attachment->applicant_signature}}" class="btn btn-primary btn-sm">Uploaded</a></td>
                                            </tr>
                                            @endif
                                            @if ( $application->service == 1 )
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
                                            @if ( $application->service == 1 || $application->service == 3 )
                                            <tr>
                                                <td><b>Address Proof/निवास प्रमाण पत्र</b></td>
                                                <td colspan="4"><a href="{{asset('facility_booking_storage/address_proof')}}/{{$attachment->address_proof}}" class="btn btn-primary btn-sm">Uploaded</a></td>
                                            </tr>
                                            @endif
                                            <tr>
                                                <td colspan="5" style="background-color:#eee;"><strong>Declaration/घोषणा</strong></td>
                                            </tr>
                                            <tr>
                                                <td colspan="5">I declare that the above particulars are true to the best of my knowledge. If any of my facts are found to be wrong, my admission should be canceled, for which all responsibility will be mine. I have read all the facts thoroughly.<br>मैं घोषणा करता हूं कि उपरोक्त विवरण मेरी सर्वोत्तम जानकारी के अनुसार सत्य हैं। यदि मेरा कोई भी तथ्य गलत पाया जाये तो मेरा प्रवेश निरस्त कर दिया जाये, जिसकी समस्त जिम्मेदारी मेरी होगी। मैंने सभी तथ्यों को अच्छी तरह से पढ़ लिया है । </td>
                                            </tr>
                                            <tr>
                                                <td colspan="5" align="center">
                                                    <input type="checkbox" id="player_coachChecked" @if (($application->final_submit == 1 && $application->query_status == 2) || ($application->final_submit == 1 && $application->query_status == null)) checked disabled @endif />
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
                            @if ($application->final_submit != 1 || ($application->final_submit == 1 && $application->query_status == 1))
                            <div class="bhoechie-footer">
                                <div class="row justify-content-center">
                                    <div class="col-md-3 text-center">
                                        <a href="{{route('facility_booking_application_update', $application->id)}}" class="btn btn-outline-warning">Update</a>
                                        <button class="btn btn-outline-info" id="checkFinal">Submit Application</button>
                                    </div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>
<!-- Modal -->
<div class="modal fade" id="viewQuery" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Query Details</h5>
                <!--<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
            </div>
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
            <div class="modal-footer">
                <button type="button" class="btn btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>







<div class="modal fade" id="player_coachFinalWarning" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">

                <h3> Are you sure want to submit the form?</h3>




                <a href="javascript:void(0)" id="final_submittttttttttttt" class="btn btn-outline-success rounded-pill">Yes</a>
                <a type="button" class="btn btn-outline-danger rounded-pill" data-bs-dismiss="modal" aria-label="Close">No</a>
                </p>
            </div>

        </div>
    </div>
</div>



<script>
    $('#checkFinal').click(function() {

        var content = document.createElement('div');
        content.innerHTML = '<h3>Please click on the Declaration Checkbox and then proceed to submit.<br>कृपया घोषणा के चेकबॉक्स पर क्लिक करें एवं तदोपरांत आगे बढ़ें।</h3>';
        if ($('#player_coachChecked').is(':checked')) {

            $('#player_coachFinalWarning').modal('toggle');

        }

        return false;
    });



    $('#checkFinal').click(function() {

        var content = document.createElement('div');
        content.innerHTML = '<h3>Please click on the Declaration Checkbox and then proceed to submit.<br>कृपया घोषणा के चेकबॉक्स पर क्लिक करें एवं तदोपरांत आगे बढ़ें।</h3>';
        if ($('#player_coachChecked').is(':checked')) {

            $('#player_coachFinalWarning').modal('toggle');

        } else
            swal(content, {

            });
        return false;
    });

    $('#final_submit').click(function() {


        var actionUrl = ajaxUrl + "/gymnasium_swimming/final_submit";

        $.ajax({
            type: "GET",
            url: actionUrl,


            success: function(res) {
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

@endsection
