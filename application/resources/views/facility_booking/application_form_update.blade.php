@extends('layouts/facility_booking_auth')
@section('content')

<div class="container-fluid pagecontentbody">
    <div class="pagebody removebg-color">
        <div class="row">
            <div class="col-12">
                <div class="pageheader" id="menu-margin">
                    <h4 class="mb-0">
                        Application Details
                        <a href="{{route('facility_booking_dashboard')}}" class="btn btn-outline-success btn-sm backbtn float-end">
                            <span class="icons icon-arrow-left"></span>Back to Dashboard
                        </a>
                    </h4>
                </div>
            </div>
            <div class="col-12">
                <div class="bhoechie-tab-container">
                    <div class="row">

                        <form action="{{route('facility_booking_application_update', $application->id)}}" id="preregister"  class="mt-2 needs-validation" novalidate
                        method="post" enctype="multipart/form-data" >
                        @csrf

                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bhoechie-tab">
                            <div class="bhoechie-tab-content active">
                                <div class="form-scroll">
                                    <div class="nano-content">
                                        <fieldset>
                                            <legend>Registration Details/पंजीकरण के विवरण</legend>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group mb-3">
                                                        <label class="placeholder">
                                                            1. Full Name/पूरा नाम<span class="text-danger">*</span>
                                                        </label>
                                                        <input type="text" class="form-control" value="{{Auth::guard('facility_booking')->user()->name}}" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group mb-3">
                                                        <label class="placeholder">
                                                            2. Father's Name/पिता का नाम<span class="text-danger">*</span>
                                                        </label>
                                                        <input type="text" class="form-control" value="{{Auth::guard('facility_booking')->user()->fathername}}" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group mb-3">
                                                        <label class="placeholder">
                                                            3. Mother's Name/मां का नाम<span class="text-danger">*</span>
                                                        </label>
                                                        <input type="text" class="form-control" value="{{Auth::guard('facility_booking')->user()->mothername}}" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group mb-3">
                                                        <label class="placeholder">
                                                            4. Nationality/राष्ट्रीयता<span class="text-danger">*</span>
                                                        </label>
                                                        <input type="text" class="form-control" value="{{Auth::guard('facility_booking')->user()->nationality}}" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group mb-3">
                                                        <label class="placeholder">
                                                            5. Date of Birth/जन्मतिथि <span class="text-danger">*</span>
                                                        </label>
                                                        <input type="text" class="form-control " value="{{dmy(Auth::guard('facility_booking')->user()->dob)}}" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group mb-3">
                                                        <label class="placeholder">
                                                            6. Email ID/ईमेल आईडी <span class="text-danger">*</span>
                                                        </label>
                                                        <input type="text" class="form-control" value="{{Auth::guard('facility_booking')->user()->email}}" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group mb-3">
                                                        <label class="placeholder">7. Age/आयु <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" value="{{Auth::guard('facility_booking')->user()->age}}" disabled>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group mb-3">
                                                        <label class="placeholder">
                                                            8. Mobile No./मोबाइल नंबर <span class="text-danger">*</span>
                                                        </label>
                                                        <input type="text" class="form-control" value="{{Auth::guard('facility_booking')->user()->mobile}}" disabled>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <fieldset>
                                            <legend>Booking Type/बुकिंग का प्रकार</legend>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group mb-3">
                                                        <div class="form-control">
                                                            <input type="hidden" value="{{$application->booking_type}}" id="booking_typeeeee">
                                                            <label class="mb-0 d-inline-block me-3">1. &nbsp;<input type="radio" id="selfdetails" name="booking_type" class="form-check-input" value="1" @if($application->booking_type == 1) checked @endif required> &nbsp;For Self</label>
                                                            <label class="mb-0 d-inline-block me-3">2. &nbsp;<input type="radio" id="showfamilydetails" class="form-check-input"  name="booking_type" value="2" @if($application->booking_type == 2) checked @endif  required > &nbsp;For Family Members</label>
                                                            <label class="mb-0 d-inline-block me-3">3. &nbsp;<input type="radio" id="showorgdetails" class="form-check-input"  name="booking_type" value="3" @if($application->booking_type == 3) checked @endif  required> &nbsp;For Organization</label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <fieldset class="familydetails">
                                            <legend>Family Details/परिवार का विवरण</legend>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group mb-3">
                                                        <label class="placeholder">
                                                            1. Name/नाम <span class="text-danger">*</span>
                                                        </label>
                                                        <input type="text"  onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))'
                                                        pattern="^[A-Za-z -]+$" maxlength="255" required class="form-control familydetailvalidate" name="family_member_name" @if($application->booking_type == 2)value="{{$application->family_member_name}}"  @endif>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group mb-3">
                                                        <label class="placeholder">
                                                            2. Date of Birth/जन्मतिथि <span class="text-danger">*</span>
                                                        </label>
                                                        <input type="date" class="form-control familydetailvalidate" min="1960-04-01" max="{{date('Y-m-d')}}" id="dateOfBirth"  name="family_member_dob"  @if($application->booking_type == 2)value="{{$application->family_member_dob}}"  @endif >
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group mb-3">
                                                        <label class="placeholder">
                                                            3. Relation/संबंध <span class="text-danger">*</span>
                                                        </label>
                                                        <input type="text"  onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))'
                                                        pattern="^[A-Za-z -]+$" maxlength="255" required class="form-control familydetailvalidate" value="" name="family_member_relation" @if($application->booking_type == 2)value="{{$application->family_member_relation}}"  @endif>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <fieldset class="orgdetails">
                                            <legend>Organization Details/संगठन का विवरण</legend>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group mb-3">
                                                        <label class="placeholder">
                                                            1. Organization Name/संगठन का नाम <span class="text-danger">*</span>
                                                        </label>
                                                        <input type="text" class="form-control orgdetailvalidate" value=""  onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))'
                                                        pattern="^[A-Za-z -]+$" maxlength="255" name="organisation_name" @if($application->booking_type == 3)value="{{$application->organisation_name}}"  @endif>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group mb-3">
                                                        <label class="placeholder">
                                                            2. Organization Registration Number/संगठन पंजीकरण संख्या <span class="text-danger">*</span>
                                                        </label>
                                                        <input type="text" class="form-control orgdetailvalidate"
                                                         maxlength="255"  @if($application->booking_type == 3)value="{{$application->organisation_registration_no}}"  @endif   name="organisation_registration_no">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group mb-3">
                                                        <label class="placeholder">
                                                            3. Upload Organization Document/संगठन दस्तावेज़ अपलोड करें<span class="text-danger">*</span>
                                                        </label>


                                                        <div class="input-group">
                                                            <input type="file" class="form-control orgdetailvalidate" value=""  onchange="getfileext(this)" name="organisation_document" id="dfgsdfsdfsdfsd">
                                                            @if($application->booking_type == 3 && $application->organisation_document)
                                                            <a href="{{asset('facility_booking_storage/organisation_document')}}/{{$application->organisation_document}}" class="btn btn-primary"><i class="fa fa-download"></i></a>
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group mb-3">
                                                        <label class="placeholder">4. Fee Exemption/शुल्क में छूट <span class="text-danger">*</span></label>
                                                        <div class="form-control">
                                                            <label class="mb-0"><input type="radio" name="organisation_fee_exemption" class="form-check-input orgdetailvalidate"  value="1"  @if($application->booking_type == 3 && $application->organisation_fee_exemption == 1) checked @endif /> Yes  &nbsp; &nbsp; <input class="form-check-input orgdetailvalidate"  type="radio" name="organisation_fee_exemption" value="2" @if($application->booking_type == 3 && $application->organisation_fee_exemption == 2) checked @endif /> No </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <fieldset>
                                            <legend>Address Details/पते का विवरण</legend>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group mb-3">
                                                        <label class="placeholder">1. Address/पता</label>
                                                        <input type="text" name="address" class="form-control" required value="{{$application->address}}">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group mb-3">
                                                        <label>2. State/राज्य</label>
                                                        <select class="form-select form-control" required  name="state" >
                                                            <option value="" >Select State</option>
                                                            <option value="23" selected>Uttar Pradesh</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group mb-3">
                                                        <label class="placeholder">3. City/शहर </label>
                                                        <select class="form-control" required name="city">
                                                            <option value="">Select District</option>
                                                            @foreach ($districts as $item)
                                                            <option value="{{$item->id}}"@if ($item->id == $application->city) selected @endif>{{$item->city}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group mb-3">
                                                        <label class="placeholder">4. Pincode/पिन कोड</label>
                                                        <input type="text"  class="form-control" value="{{$application->pin}}" pattern="[0-9][0-9]{5}$" required maxlength="6" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" class="form-control" name="pin">
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <div class="row" id="hockey">
                                            <div class="col-md-4 mb-4">
                                                <div class="form-group">


                                                    <input type="hidden" value="{{$application->service}}" id="chdecjhcjcjcfjcf">
                                                    <label>1. Service/सेवा का चयन करें</label>
                                                    <select  class="form-select form-control" onchange="showHide(this)" id="servidfgdfgd" required name="service">
                                                        <option value="">Select</option>
                                                        <option value="4" @if($application->service == 4) selected @endif>Gymnasium</option>
                                                        <option value="2" @if($application->service == 2) selected @endif>Guest Room</option>
                                                        <option value="1" @if($application->service == 1) selected @endif>Swimming Pool (Mini)</option>
                                                        <option value="3" @if($application->service == 3) selected @endif>Swimming Pool (Adult) </option>
                                                        <option value="5" @if($application->service == 5) selected @endif>Stadium</option>
                                                    </select>


                                                </div>
                                            </div>
                                            <div class="show-hide col-12" id="gymnasium">
                                                <fieldset>
                                                    <legend>Service/सेवा</legend>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group mb-3">
                                                                <label class="placeholder">
                                                                    2. Select Location/स्थान चुनें<span class="text-danger">*</span>
                                                                </label>

                                                                <select class="form-select form-control gymnasium" name="location" id="location11"  onchange="stadium_list(this.value, 'gymnasiummm')">
                                                                    <option value="">Select </option>
                                                                    @foreach ($districts as $item)
                                                                    <option value="{{$item->id}}"  @if($service_detail->service_type == 1 && $service_detail->location == $item->id) selected @endif>{{$item->city}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group mb-3">
                                                                <label class="placeholder">
                                                                    3. Select Stadium/स्टेडियम का चयन करें<span class="text-danger">*</span>
                                                                </label>
                                                                <input type="hidden" value="{{$service_detail->stadium}}" id="stadium_iddd">
                                                                <select class="form-select form-control gymnasium" name="stadium" id="gymnasiummm">
                                                                    <option value="">Select</option>
                                                                    <option value="Location 1" @if($service_detail->service_type == 1 && $service_detail->stadium == 'Location 1') selected @endif>Location 1</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group mb-3">
                                                                <label class="placeholder">
                                                                    4. Purpose/उद्देश्य <span class="text-danger">*</span>
                                                                </label>
                                                                <input type="text"  onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))'
                                                                pattern="^[A-Za-z -]+$" maxlength="255"  class="gymnasium form-control"  name="purpose" @if($service_detail->service_type ==  1) value="{{$service_detail->purpose}}" @endif >
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="placeholder">
                                                                5. 	Date Range/दिनांक सीमा <span class="text-danger">*</span>
                                                            </label>
                                                            <div class="input-group mb-3">
                                                                <span class="input-group-text">From</span>
                                                                <input type="date" class="form-control gymnasium" name="booking_date_from"  placeholder="" onblur="enddate(this.value, 'enddate1')" aria-label=""  @if($service_detail->service_type ==  1) value="{{$service_detail->booking_date_from}}" @endif  >
                                                                <span class="input-group-text">To</span>
                                                                <input type="date" class="form-control gymnasium" name="booking_date_to" placeholder="" id="enddate1" aria-label=""  @if($service_detail->service_type ==  1) value="{{$service_detail->booking_date_to}}" @endif  >
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="placeholder">
                                                                6. 	Time Range/समय सीमा <span class="text-danger">*</span>
                                                            </label>
                                                            <div class="input-group mb-3">
                                                                <span class="input-group-text">From</span>
                                                                <input type="time" class="form-control gymnasium" name="booking_time_from"  onblur="endtime(this.value, 'endtime1')" placeholder="" aria-label="" @if($service_detail->service_type ==  1) value="{{$service_detail->booking_time_from}}" @endif>
                                                                <span class="input-group-text">To</span>
                                                                <input type="time" id="endtime1" class="form-control gymnasium" name="booking_time_to" @if($service_detail->service_type ==  1) value="{{$service_detail->booking_time_to}}" @endif placeholder="" aria-label="" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                                <fieldset>
                                                    <legend>Attachments/संलग्नक</legend>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group mb-3">
                                                                <label>1. Applicant Photo/आवेदक फोटो<span class="text-danger">*</span></label>
                                                                <div class="input-group">
                                                                    <input type="file" class="form-control gymnasium" name="applicant_photo" onchange="getfileextt(this)" value="" >
                                                                    @if($attachment->service_type ==  1)
                                                                    <a href="{{asset('facility_booking_storage/applicant_photo')}}/{{$attachment->applicant_photo}}" class="btn btn-primary"><i class="fa fa-download"></i></a>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group mb-3">
                                                                <label>2. Applicant Aadhar Card/बच्चे का आधार कार्ड </label>
                                                                <div class="input-group">
                                                                    <input type="file" class="form-control gymnasium" onchange="getfileext(this)" value=""  name="applicant_aadhaar">
                                                                    @if($attachment->service_type ==  1)
                                                                    <a href="{{asset('facility_booking_storage/applicant_aadhaar')}}/{{$attachment->applicant_aadhaar}}" class="btn btn-primary"><i class="fa fa-download"></i></a>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group mb-3">
                                                                <label>3. Parent Aadhar/अभिभावक आधार<span class="text-danger">*</span></label>
                                                                <div class="input-group">
                                                                    <input type="file"  onchange="getfileext(this)" class="form-control gymnasium" value="" name="applicant_parent_aadhaar" >
                                                                    @if($attachment->service_type ==  1)
                                                                    <a href="{{asset('facility_booking_storage/applicant_parent_aadhaar')}}/{{$attachment->applicant_parent_aadhaar}} -download"></i></a>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group mb-3">
                                                                <label>4. Parent Signature/मूल दस्तखत<span class="text-danger">*</span></label>
                                                                <div class="input-group">
                                                                    <input type="file" class="form-control gymnasium" value=""   name="applicant_parent_signature"  onchange="getfileextt(this)">
                                                                    @if($attachment->service_type ==  1)
                                                                    <a href="{{asset('facility_booking_storage/applicant_parent_signature')}}/{{$attachment->applicant_parent_signature}}" class="btn btn-primary"><i class="fa fa-download"></i></a>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group mb-3">
                                                                <label>5. Age Proof/आयु प्रमाण<span class="text-danger">*</span></label>
                                                                <div class="input-group">
                                                                    <input type="file" onchange="getfileext(this)" class="form-control gymnasium" value="" name="applicant_age_proof">
                                                                    @if($attachment->service_type ==  1)
                                                                    <a href="{{asset('facility_booking_storage/applicant_age_proof')}}/{{$attachment->applicant_age_proof}}" class="btn btn-primary"><i class="fa fa-download"></i></a>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group mb-3 position-relative">
                                                                <label>
                                                                    6. M.B.B.S Doctor Certificate/एम.बी.बी.एस डॉक्टर प्रमाणपत्र<span class="text-danger">*</span>
                                                                </label>
                                                                <div class="input-group">
                                                                    <input type="file" onchange="getfileext(this)" class="form-control gymnasium" value="" name="mbbs_doctor_certificate">
                                                                    @if($attachment->service_type ==  1)
                                                                    <a href="{{asset('facility_booking_storage/mbbs_doctor_certificate')}}/{{$attachment->mbbs_doctor_certificate}}" class="btn btn-primary"><i class="fa fa-download"></i></a>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group mb-3">
                                                                <label>7. Address Proof/निवास प्रमाण पत्र<span class="text-danger">*</span></label>
                                                                <div class="input-group">
                                                                    <input type="file"  onchange="getfileext(this)" class="form-control gymnasium" value="" name="address_proof">
                                                                    @if($attachment->service_type ==  1)
                                                                    <a href="{{asset('facility_booking_storage/address_proof')}}/{{$attachment->address_proof}}" class="btn btn-primary"><i class="fa fa-download"></i></a>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </fieldset>

                                            </div>
                                            <div class="show-hide col-12" id="swimmingPoolMini">
                                                <fieldset>
                                                    <legend>Service/सेवा</legend>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group mb-3">
                                                                <label class="placeholder">
                                                                    2. Select Location/स्थान चुनें<span class="text-danger">*</span>
                                                                </label>

                                                                <select class="form-select form-control swimmingPoolMini" name="location_spm"  id="location22"  onchange="stadium_list(this.value, 'swimmingPoolMiniiii')">
                                                                   <option value="">Select</option>
                                                                    @foreach ($districts as $item)
                                                                    <option value="{{$item->id}}"  @if($service_detail->service_type == 3 && $service_detail->location == $item->id) selected @endif>{{$item->city}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group mb-3">
                                                                <label class="placeholder">
                                                                    3. Select Stadium/स्टेडियम का चयन करें<span class="text-danger">*</span>
                                                                </label>
                                                                <select class="form-select form-control swimmingPoolMini" id="swimmingPoolMiniiii"  name="stadium_spm">
                                                                    <option value="">Select</option>

                                                                    @foreach ($districts as $item)
                                                                    <option value="{{$item->id}}"  @if($service_detail->service_type == 3 && $service_detail->location == $item->id) selected @endif>{{$item->city}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group mb-3">
                                                                <label class="placeholder">
                                                                    4. Purpose/उद्देश्य <span class="text-danger">*</span>
                                                                </label>
                                                                <input type="text" class="form-control swimmingPoolMini"  onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))'
                                                                pattern="^[A-Za-z -]+$" maxlength="255"  name="purpose_spm"  @if($service_detail->service_type == 3) value="{{$service_detail->purpose}}" @endif>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="placeholder">
                                                                5. 	Date Range/दिनांक सीमा <span class="text-danger">*</span>
                                                            </label>
                                                            <div class="input-group mb-3">
                                                                <span class="input-group-text">From</span>
                                                                <input type="date" class="form-control swimmingPoolMini" name="booking_date_from_spm" placeholder="" min="{{ date('Y-m-d') }}" aria-label=""  onblur="enddate(this.value, 'enddate2')"  @if($service_detail->service_type == 3) value="{{$service_detail->booking_date_from}}" @endif>
                                                                <span class="input-group-text">To</span>
                                                                <input type="date" id="enddate2" class="form-control " name="booking_date_to_spm" placeholder="" aria-label=""  @if($service_detail->service_type == 3) value="{{$service_detail->booking_date_to}}" @endif>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                                <fieldset>
                                                    <legend>Attachments/संलग्नक</legend>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group mb-3">
                                                                <label>1. Applicant Photo/आवेदक फोटो<span class="text-danger">*</span></label>
                                                                <div class="input-group">
                                                                    <input type="file" onchange="getfileextt(this)" class="form-control swimmingPoolMini" value="" name="applicant_photo_spm">
                                                                    @if($attachment->service_type ==  3)
                                                                    <a href="{{asset('facility_booking_storage/applicant_photo')}}/{{$attachment->applicant_photo}}" class="btn btn-primary"><i class="fa fa-download"></i></a>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group mb-3">
                                                                <label>2. Aadhar Card/आधार कार्ड<span class="text-danger">*</span></label>
                                                                <div class="input-group">
                                                                    <input type="file" class="form-control swimmingPoolMini" value="" name="applicant_aadhaar_spm">
                                                                    @if($attachment->service_type ==  3)
                                                                    <a href="{{asset('facility_booking_storage/applicant_aadhaar')}}/{{$attachment->applicant_aadhaar}}" class="btn btn-primary"><i class="fa fa-download"></i></a>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group mb-3">
                                                                <label>3. Signature/हस्ताक्षर<span class="text-danger">*</span></label>
                                                                <div class="input-group">
                                                                    <input type="file"  onchange="getfileextt(this)"class="form-control swimmingPoolMini" value="" name="applicant_signature_spm">
                                                                    @if($attachment->service_type ==  3)
                                                                    <a href="{{asset('facility_booking_storage/applicant_signature')}}/{{$attachment->applicant_signature}}" class="btn btn-primary"><i class="fa fa-download"></i></a>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group mb-3 position-relative">
                                                                <label>4. M.B.B.S Doctor Certificate/एम.बी.बी.एस डॉक्टर प्रमाणपत्र<span class="text-danger">*</span></label>
                                                                <div class="input-group">
                                                                    <input type="file" onchange="getfileext(this)" class="form-control swimmingPoolMini" value="" name="mbbs_doctor_certificate_spm">
                                                                    @if($attachment->service_type ==  3)
                                                                    <a href="{{asset('facility_booking_storage/mbbs_doctor_certificate')}}/{{$attachment->mbbs_doctor_certificate}}" class="btn btn-primary"><i class="fa fa-download"></i></a>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group mb-3">
                                                                <label>5. Address Proof/निवास प्रमाण पत्र<span class="text-danger">*</span></label>
                                                                <div class="input-group">
                                                                    <input type="file" onchange="getfileext(this)" class="form-control swimmingPoolMini" value="" name="address_proof_spm">
                                                                    @if($attachment->service_type ==  3)
                                                                    <a href="{{asset('facility_booking_storage/address_proof')}}/{{$attachment->address_proof}}" class="btn btn-primary"><i class="fa fa-download"></i></a>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </fieldset>

                                            </div>
                                            <div class="show-hide col-12" id="swimmingPoolAdult">
                                                <fieldset>
                                                    <legend>Service/सेवा</legend>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group mb-3">
                                                                <label class="placeholder">
                                                                    2. Select Location/स्थान चुनें<span class="text-danger">*</span>
                                                                </label>
                                                                <select class="form-select form-control swimmingPoolAdult" name="location_spa"  id="location33"   onchange="stadium_list(this.value, 'swimmingPoolAdultttt')">
                                                                    <option value="">Select</option>
                                                                    @foreach ($districts as $item)
                                                                    <option value="{{$item->id}}" @if($service_detail->service_type == 4 && $service_detail->location == $item->id) selected @endif>{{$item->city}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group mb-3">
                                                                <label class="placeholder">
                                                                    3. Select Stadium/स्टेडियम का चयन करें<span class="text-danger">*</span>
                                                                </label>
                                                                <select class="form-select form-control swimmingPoolAdult" name="stadium_spa" id="swimmingPoolAdultttt" >
                                                                    <option value="">Select</option>
                                                                    <option value="Location 1"  @if($service_detail->service_type == 4 && $service_detail->location == 'Location 1') selected @endif>Location 1</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group mb-3">
                                                                <label class="placeholder">
                                                                    4. Purpose/उद्देश्य <span class="text-danger">*</span>
                                                                </label>
                                                                <input type="text" class="form-control swimmingPoolAdult"  onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))'
                                                                pattern="^[A-Za-z -]+$" maxlength="255"    name="purpose_spa" @if($service_detail->service_type == 4 )  value="{{$service_detail->purpose}}" @endif>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="placeholder">
                                                                5. 	Date Range/दिनांक सीमा <span class="text-danger">*</span>
                                                            </label>
                                                            <div class="input-group mb-3">
                                                                <span class="input-group-text">From</span>
                                                                <input type="date"  onblur="enddate(this.value, 'enddate3')"  min="{{ date('Y-m-d') }}" name="booking_date_from_spa" class="form-control swimmingPoolAdult" placeholder="" aria-label=""  @if($service_detail->service_type == 4 )  value="{{$service_detail->booking_date_from}}" @endif>
                                                                <span class="input-group-text">To</span>
                                                                <input type="date" id="enddate3"  class="form-control swimmingPoolAdult" name="booking_date_to_spa" placeholder="" aria-label="" @if($service_detail->service_type == 4 )  value="{{$service_detail->booking_date_to}}" @endif>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                                <fieldset>
                                                    <legend>Attachments/संलग्नक</legend>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group mb-3">
                                                                <label>1. Applicant Photo/आवेदक फोटो<span class="text-danger">*</span></label>
                                                                <div class="input-group">
                                                                    <input type="file"  onchange="getfileextt(this)" class="form-control swimmingPoolAdult" value="" name="applicant_photo_spa">

                                                                    @if($attachment->service_type ==  4)
                                                                    <a href="{{asset('facility_booking_storage/applicant_photo')}}/{{$attachment->applicant_photo}}" class="btn btn-primary"><i class="fa fa-download"></i></a>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group mb-3">
                                                                <label>2. Aadhar Card/आधार कार्ड<span class="text-danger">*</span></label>
                                                                <div class="input-group">
                                                                    <input type="file" onchange="getfileext(this)"class="form-control swimmingPoolAdult" value="" name="applicant_aadhaar_spa">
                                                                    @if($attachment->service_type ==  4)
                                                                    <a href="{{asset('facility_booking_storage/applicant_aadhaar')}}/{{$attachment->applicant_aadhaar}}" class="btn btn-primary"><i class="fa fa-download"></i></a>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group mb-3">
                                                                <label>3. Signature/हस्ताक्षर<span class="text-danger">*</span></label>
                                                                <div class="input-group">
                                                                    <input type="file"  onchange="getfileextt(this)"class="form-control swimmingPoolAdult" value="" name="applicant_signature_spa">
                                                                    @if($attachment->service_type ==  4)
                                                                    <a href="{{asset('facility_booking_storage/applicant_signature')}}/{{$attachment->applicant_signature}}" class="btn btn-primary"><i class="fa fa-download"></i></a>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </fieldset>

                                            </div>
                                            <div class="show-hide col-12" id="guestRoom">
                                                <fieldset>
                                                    <legend>Service/सेवा</legend>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group mb-3">
                                                                <label class="placeholder">
                                                                    2. Select Location/स्थान चुनें<span class="text-danger">*</span>
                                                                </label>
                                                                <select class="form-select form-control guestRoom" name="location_gr"   id="location44"   onchange="stadium_list(this.value, 'guestRoommmm')" >
                                                                    <option value="">Select</option>
                                                                    @foreach ($districts as $item)
                                                                    <option value="{{$item->id}}"  @if($service_detail->service_type == 2 && $service_detail->location == $item->id) selected @endif>{{$item->city}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group mb-3">
                                                                <label class="placeholder">
                                                                    3. Select Stadium/स्टेडियम का चयन करें<span class="text-danger">*</span>
                                                                </label>
                                                                <select class="form-select form-control guestRoom" id="guestRoommmm" name="stadium_gr" >
                                                                    <option value="">Select</option>




                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="placeholder">
                                                                4. Rooms Selection/कमरों का चयन <span class="text-danger">*</span>
                                                            </label>
                                                            <select class="form-select form-control guestRoom" name="room_type_gr">
                                                                <option value="">Select</option>

                                                                <option value="Large Room"  @if($service_detail->service_type == 2 && $service_detail->room_type == 'Large Room') selected @endif>Large Room</option>
                                                                <option value="Medium Room"@if($service_detail->service_type == 2 && $service_detail->room_type == 'Medium Room') selected @endif> Medium Room</option>
                                                                <option value="Small Room" @if($service_detail->service_type == 2 && $service_detail->room_type == 'Small Room') selected @endif >Small Room</option>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group mb-3">
                                                                <label class="placeholder">
                                                                    5. Purpose/उद्देश्य <span class="text-danger">*</span>
                                                                </label>
                                                                <input type="text" class="form-control guestRoom"  onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))'
                                                                pattern="^[A-Za-z -]+$" maxlength="255" name="purpose_gr"  @if($service_detail->service_type == 2 ) value="{{$service_detail->purpose}}" @endif>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group mb-3">
                                                                <label>6. Members/सदस्य</label>
                                                                <input type="number" class="form-control guestRoom" min="1" name="member_gr"  @if($service_detail->service_type == 2 ) value="{{$service_detail->member}}" @endif >
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="placeholder">
                                                                7. 	Date Range/दिनांक सीमा <span class="text-danger">*</span>
                                                            </label>
                                                            <div class="input-group mb-3">
                                                                <span class="input-group-text">From</span>
                                                                <input type="date" class="form-control guestRoom" name="booking_date_from_gr"  min="{{ date('Y-m-d') }}" onblur="enddate(this.value, 'enddate4')" placeholder="" aria-label=""  @if($service_detail->service_type == 2 ) value="{{$service_detail->booking_date_from}}" @endif>
                                                                <span class="input-group-text">To</span>
                                                                <input type="date"  class="form-control guestRoom" name="booking_date_to_gr" id="enddate4" @if($service_detail->service_type == 2 ) value="{{$service_detail->booking_date_to}}" @endif placeholder="" aria-label="">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="placeholder">
                                                                8. 	Time Range/समय सीमा <span class="text-danger">*</span>
                                                            </label>
                                                            <div class="input-group mb-3">
                                                                <span class="input-group-text">From</span>
                                                                <input type="time" class="form-control guestRoom" name="booking_time_from_gr" onblur="endtime(this.value, 'endtime2')" placeholder="" @if($service_detail->service_type == 2 ) value="{{$service_detail->booking_time_from}}" @endif aria-label="" >
                                                                <span class="input-group-text">To</span>
                                                                <input type="time" id="endtime2" class="form-control guestRoom" name="booking_time_to_gr" placeholder=""  @if($service_detail->service_type == 2 ) value="{{$service_detail->booking_time_to}}" @endif  aria-label="" >
                                                            </div>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                                <fieldset>
                                                    <legend>Attachments/संलग्नक</legend>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group mb-3">
                                                                <label class="placeholder">
                                                                    1. Applicant Photo/आवेदक फोटो <span class="text-danger">*</span>
                                                                </label>
                                                                <div class="input-group">
                                                                    <input type="file" onchange="getfileextt(this)" class="form-control guestRoom" name="applicant_photo_gr" value="" >
                                                                    @if($attachment->service_type ==  2)
                                                                    <a href="{{asset('facility_booking_storage/applicant_photo')}}/{{$attachment->applicant_photo}}" class="btn btn-primary"><i class="fa fa-download"></i></a>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group mb-3">
                                                                <label class="placeholder">
                                                                    2. Aadhaar Card/आधार कार्ड <span class="text-danger">*</span>
                                                                </label>
                                                                <div class="input-group">
                                                                    <input type="file" onchange="getfileext(this)" class="form-control guestRoom" name="applicant_aadhaar_gr" value="" >
                                                                    @if($attachment->service_type ==  2)
                                                                    <a href="{{asset('facility_booking_storage/applicant_aadhaar')}}/{{$attachment->applicant_aadhaar}}" class="btn btn-primary"><i class="fa fa-download"></i></a>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group mb-3">
                                                                <label class="placeholder">
                                                                    3. Signature/हस्ताक्षर <span class="text-danger">*</span>
                                                                </label>
                                                                <div class="input-group">
                                                                    <input type="file"  onchange="getfileextt(this)" class="form-control guestRoom" name="applicant_signature_gr" value="" >
                                                                    @if($attachment->service_type ==  2)
                                                                    <a href="{{asset('facility_booking_storage/applicant_signature')}}/{{$attachment->applicant_signature}}" class="btn btn-primary"><i class="fa fa-download"></i></a>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </fieldset>

                                            </div>
                                            <div class="show-hide col-12" id="stadium">
                                                <fieldset>
                                                    <legend>Service/सेवा</legend>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group mb-3">
                                                                <label class="placeholder">
                                                                    2. Select Location/स्थान चुनें<span class="text-danger">*</span>
                                                                </label>
                                                                <select class="form-select form-control stadium" name="location_s"  id="location55"  onchange="stadium_list(this.value, 'stadiumjhk')">
                                                                     <option value="">Select</option>
                                                                    @foreach ($districts as $item)
                                                                    <option value="{{$item->id}}" @if($service_detail->service_type == 5 && $service_detail->location == $item->id) selected @endif>{{$item->city}}</option>
                                                                    @endforeach

                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group mb-3">
                                                                <label class="placeholder">
                                                                    3. Select Stadium/स्टेडियम का चयन करें<span class="text-danger">*</span>
                                                                </label>
                                                                <select class="form-select form-control stadium" id="stadiumjhk" name="stadium_s">
                                                                    <option value="">Select</option>
                                                                    <option value="Location 1"  @if($service_detail->service_type == 5 && $service_detail->stadium == 'Location 1') selected @endif>Location 1</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group mb-3">
                                                                <label class="placeholder">
                                                                    4. Sport Name/खेल का नाम <span class="text-danger">*</span>
                                                                </label>
                                                                <select class="form-select form-control stadium" name="sport_id_s">
                                                                    <option value="">Select</option>
                                                                    @foreach ($sports as $item)
                                                                    <option value="{{$item->id}}" @if($service_detail->service_type == 5 && $service_detail->sport_id == $item->id) selected @endif>{{$item->name}}</option>
                                                                    @endforeach
                                                                         </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group mb-3">
                                                                <label class="placeholder">
                                                                    5. Purpose/उद्देश्य <span class="text-danger">*</span>
                                                                </label>
                                                                <input type="text" class="form-control stadium"  onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))'
                                                                pattern="^[A-Za-z -]+$" maxlength="255"  name="purpose_s"    @if($service_detail->service_type == 5 ) value="{{$service_detail->purpose}}" @endif>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="placeholder">
                                                                6. 	Date Range/दिनांक सीमा <span class="text-danger">*</span>
                                                            </label>
                                                            <div class="input-group mb-3">
                                                                <span class="input-group-text">From</span>
                                                                <input type="date" class="form-control stadium" name="booking_date_from_s" onblur="enddate(this.value, 'enddate6')" placeholder="" aria-label="" @if($service_detail->service_type == 5 ) value="{{$service_detail->booking_date_from}}" @endif>
                                                                <span class="input-group-text">To</span>
                                                                <input type="date" class="form-control stadium" name="booking_date_to_s" id="enddate6" @if($service_detail->service_type == 5) value="{{$service_detail->booking_date_to}}" @endif placeholder="" aria-label="" >
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <label class="placeholder">
                                                                7. 	Time Range/समय सीमा <span class="text-danger">*</span>
                                                            </label>
                                                            <div class="input-group mb-3">
                                                                <span class="input-group-text">From</span>
                                                                <input type="time" class="form-control stadium" name="booking_time_from_s" onblur="enddate(this.value, 'endtime3')"  placeholder="" aria-label="" @if($service_detail->service_type == 5 ) value="{{$service_detail->booking_time_from}}" @endif>
                                                                <span class="input-group-text">To</span>
                                                                <input type="time" class="form-control stadium" id="endtime3" name="booking_time_to_s"  @if($service_detail->service_type == 5 ) value="{{$service_detail->booking_time_to}}" @endif placeholder="" aria-label="">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </fieldset>
                                                <fieldset>
                                                    <legend>Attachments/संलग्नक</legend>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            <div class="form-group mb-3">
                                                                <label class="placeholder">
                                                                    1. Applicant Photo/आवेदक फोटो <span class="text-danger">*</span>
                                                                </label>
                                                                <div class="input-group">
                                                                    <input type="file" onchange="getfileextt(this)" class="form-control stadium" name="applicant_photo_s" value="" >
                                                                    @if($attachment->service_type ==  5)
                                                                    <a href="{{asset('facility_booking_storage/applicant_photo')}}/{{$attachment->applicant_photo}}" class="btn btn-primary"><i class="fa fa-download"></i></a>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group mb-3">
                                                                <label class="placeholder">
                                                                    2. Aadhaar Card/आधार कार्ड <span class="text-danger">*</span>
                                                                </label>
                                                                <div class="input-group">
                                                                    <input type="file" onchange="getfileext(this)"class="form-control stadium" name="applicant_aadhaar_s" value="" >
                                                                    @if($attachment->service_type ==  5)
                                                                    <a href="{{asset('facility_booking_storage/applicant_photo')}}/{{$attachment->applicant_photo}}" class="btn btn-primary"><i class="fa fa-download"></i></a>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-4">
                                                            <div class="form-group mb-3">
                                                                <label class="placeholder">
                                                                    3. Signature/हस्ताक्षर <span class="text-danger">*</span>
                                                                </label>
                                                                <div class="input-group">
                                                                    <input type="file" onchange="getfileextt(this)" class="form-control stadium" name="applicant_signature_s" value="" >
                                                                    @if($attachment->service_type ==  5)
                                                                    <a href="{{asset('facility_booking_storage/applicant_photo')}}/{{$attachment->applicant_photo}}" class="btn btn-primary"><i class="fa fa-download"></i></a>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </fieldset>

                                            </div>

                                            <div class="row justify-content-center w-100">


                                                <div class="col-md-2 d-grid">
                                                    <button type="submit" class="btn btn-outline-success ">Save and Next</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


@endsection



<script>

//
// function stadium_list(value,id){
//
// let location = value;
// let option=`<option value=''>Select Stadium</option>`;
// $.ajax({
//     type: "POST",
//     url: "{{url('facility_booking/stadium')}}",
//     data: {location:location},
//     success: function (response) {
//
//         response.forEach((item)=>{
//            option +=`<option value="${item.id}"  >${item.studium_name}</option>`;
//         })
//
//
//         $(`#${id}`).empty();
//     $(`#${id}`).append(option);
//
//
//     }
//
// })
//
// }






    function enddate(value , id){



$(`#${id}`).attr({
"min" : value
});
}



function endtime(value , id){



$(`#${id}`).attr({
"min" : value
});
}





</script>
