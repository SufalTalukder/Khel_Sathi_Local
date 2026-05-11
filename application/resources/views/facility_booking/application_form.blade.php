@extends('layouts/facility_booking_auth')
@section('content')

<div class="container-fluid pagecontentbody">
    <div class="pagebody removebg-color">
        <div class="row">
            <div class="col-12">
                <div class="pageheader" id="menu-margin">
                    <h4 class="mb-0">
                       Application Details
                        <a href="{{route('facility_booking_dashboard')}}" class="btn btn-outline-success btn-sm backbtn float-end ">
                            <span class="icons icon-arrow-left"></span>Back to Dashboard
                        </a>
                    </h4>
                </div>
            </div>
            <div class="col-12">
                <div class="bhoechie-tab-container">
                    <div class="row">
                        <form action="{{route('facility_booking_application')}}" id="preregister" class="mt-2 needs-validation" novalidate
                            method="post" enctype="multipart/form-data">
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
                                                                5. Email ID/ईमेल आईडी <span class="text-danger">*</span>
                                                            </label>
                                                            <input type="text" class="form-control" value="{{Auth::guard('facility_booking')->user()->email}}" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mb-3">
                                                            <label class="placeholder">
                                                                6. Mobile No./मोबाइल नंबर <span class="text-danger">*</span>
                                                            </label>
                                                            <input type="text" class="form-control" value="{{Auth::guard('facility_booking')->user()->mobile}}" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mb-3">
                                                            <label class="placeholder">
                                                                7. Date of Birth/जन्मतिथि <span class="text-danger">*</span>
                                                            </label>
                                                            <input type="text" class="form-control " value="{{dmy(Auth::guard('facility_booking')->user()->dob)}}" disabled>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mb-3">
                                                            <label class="placeholder">8. Age/आयु <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" value="{{Auth::guard('facility_booking')->user()->age}}" disabled>
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
                                                                <input type="hidden" value="1" id="booking_typeeeee">

                                                                <label class="mb-0 d-inline-block me-3">1. &nbsp;<input type="radio" id="selfdetails" name="booking_type" class="form-check-input" value="1" checked required> &nbsp;For Self</label>
                                                                <label class="mb-0 d-inline-block me-3">2. &nbsp;<input type="radio" id="showfamilydetails" class="form-check-input" name="booking_type" value="2" required> &nbsp;For Family Members</label>
                                                                <label class="mb-0 d-inline-block me-3">3. &nbsp;<input type="radio" id="showorgdetails" class="form-check-input" name="booking_type" value="3" required> &nbsp;For Organization</label>
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
                                                            <input type="text" onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))'
                                                                pattern="^[A-Za-z -]+$" maxlength="255" required class="form-control familydetailvalidate" name="family_member_name">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label class="placeholder">
                                                                2. Date of Birth/जन्मतिथि <span class="text-danger">*</span>
                                                            </label>
                                                            <input type="date" class="form-control familydetailvalidate" min="1960-04-01" max="{{date('Y-m-d')}}" id="dateOfBirth" name="family_member_dob">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label class="placeholder">
                                                                3. Relation/संबंध <span class="text-danger">*</span>
                                                            </label>
                                                            <input type="text" onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))'
                                                                pattern="^[A-Za-z -]+$" maxlength="255" required class="form-control familydetailvalidate" value="" name="family_member_relation">
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
                                                            <input type="text" class="form-control orgdetailvalidate" value="" onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))'
                                                                pattern="^[A-Za-z -]+$" maxlength="255" name="organisation_name">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label class="placeholder">
                                                                2. Organization Registration Number/संगठन पंजीकरण संख्या <span class="text-danger">*</span>
                                                            </label>
                                                            <input type="text" class="form-control orgdetailvalidate" value="" name="organisation_registration_no">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label class="placeholder">
                                                                3. Upload Organization Document/संगठन दस्तावेज़ अपलोड करें<span class="text-danger">*</span>
                                                            </label>
                                                            <div class="input-group">
                                                                <input type="file" class="form-control orgdetailvalidate" value="" onchange="getfileext(this)" name="organisation_document">

                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label class="placeholder">4. Fee Exemption/शुल्क में छूट <span class="text-danger">*</span></label>
                                                            <div class="form-control">
                                                                <label class="mb-0"><input type="radio" name="organisation_fee_exemption" class="form-check-input orgdetailvalidate" value="1" /> Yes &nbsp; &nbsp; <input class="form-check-input orgdetailvalidate" type="radio" name="organisation_fee_exemption" value="2" /> No </label>
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
                                                            <input type="text" name="address" class="form-control" required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mb-3">
                                                            <label>2. State/राज्य</label>
                                                            <select class="form-select form-control" required name="state">
                                                                <option value="">Select State</option>
                                                                <option value="23">Uttar Pradesh</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mb-3">
                                                            <label class="placeholder">3. City/शहर </label>
                                                            <select class="form-control" required name="city">
                                                                <option value="">Select District</option>
                                                                @foreach ($districts as $item)
                                                                <option value="{{$item->id}}">{{$item->city}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mb-3">
                                                            <label class="placeholder">4. Pincode/पिन कोड</label>
                                                            <input type="text" class="form-control" pattern="[0-9][0-9]{5}$" required maxlength="6" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" class="form-control" name="pin">
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <fieldset>
                                                <legend>Service/सेवा</legend>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>1. Service/सेवा का चयन करें</label>
                                                            <select class="form-select form-control" onchange="showHide(this)" required name="service">
                                                                <option value="">Select</option>
                                                                <option value="4">Gymnasium</option>
                                                                <option value="2">Guest Room</option>
                                                                <option value="1">Swimming Pool (Mini)</option>
                                                                <option value="3">Swimming Pool (Adult) </option>
                                                                <option value="5">Stadium</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div id="hockey">
                                                    <div class="show-hide" id="gymnasium">
                                                        <div class="row mb-4">
                                                            <div class="col-md-4">
                                                                <div class="form-group mb-3">
                                                                    <label class="placeholder">
                                                                        2. Select Location/स्थान चुनें<span class="text-danger">*</span>
                                                                    </label>
                                                                    <select class="form-select form-control gymnasium" name="location" onchange="stadium_list(this.value, 'gymnasiummm')">
                                                                        <option value="">Select</option>
                                                                        @foreach ($districts as $item)
                                                                        <option value="{{$item->id}}">{{$item->city}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group mb-3">
                                                                    <label class="placeholder">
                                                                        3. Select Stadium/स्टेडियम का चयन करें<span class="text-danger">*</span>
                                                                    </label>
                                                                    <select class="form-select form-control gymnasium" id="gymnasiummm" name="stadium">
                                                                        <option value="">Select</option>

                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group mb-3">
                                                                    <label class="placeholder">
                                                                        4. Purpose/उद्देश्य <span class="text-danger">*</span>
                                                                    </label>
                                                                    <input type="text" onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))'
                                                                        pattern="^[A-Za-z -]+$" maxlength="255" class="gymnasium form-control" name="purpose">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label class="placeholder">
                                                                    5. Date Range/दिनांक सीमा <span class="text-danger">*</span>
                                                                </label>
                                                                <div class="input-group mb-3">
                                                                    <span class="input-group-text">From</span>
                                                                    <input type="date" class="form-control gymnasium" name="booking_date_from" placeholder="" onblur="enddate(this.value, 'enddate1')" aria-label="">
                                                                    <span class="input-group-text">To</span>
                                                                    <input type="date" class="form-control gymnasium" name="booking_date_to" placeholder="" id="enddate1" aria-label="">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label class="placeholder">
                                                                    6. Time Range/समय सीमा <span class="text-danger">*</span>
                                                                </label>
                                                                <div class="input-group mb-3">
                                                                    <span class="input-group-text">From</span>
                                                                    <input type="time" class="form-control gymnasium" name="booking_time_from" onblur="endtime(this.value, 'endtime1')" placeholder="" aria-label="">
                                                                    <span class="input-group-text">To</span>
                                                                    <input type="time" id="endtime1" class="form-control gymnasium" name="booking_time_to" placeholder="" aria-label="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <fieldset>
                                                            <legend>Attachments/संलग्नक</legend>
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <div class="form-group mb-3">
                                                                        <label>1. Applicant Photo/आवेदक फोटो<span class="text-danger">*</span></label>
                                                                        <div class="input-group">
                                                                            <input type="file" class="form-control gymnasium" name="applicant_photo" onchange="getfileextt(this)" value="">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group mb-3">
                                                                        <label>2. Applicant Aadhar Card/बच्चे का आधार कार्ड </label>
                                                                        <div class="input-group">
                                                                            <input type="file" class="form-control gymnasium" onchange="getfileext(this)" value="" name="applicant_aadhaar">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group mb-3">
                                                                        <label>3. Parent Aadhar/अभिभावक आधार<span class="text-danger">*</span></label>
                                                                        <div class="input-group">
                                                                            <input type="file" onchange="getfileext(this)" class="form-control gymnasium" value="" name="applicant_parent_aadhaar">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group mb-3">
                                                                        <label>4. Parent Signature/मूल दस्तखत<span class="text-danger">*</span></label>
                                                                        <div class="input-group">
                                                                            <input type="file" class="form-control gymnasium" value="" onchange="getfileextt(this)" required name="applicant_parent_signature">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group mb-3">
                                                                        <label>5. Age Proof/आयु प्रमाण<span class="text-danger">*</span></label>
                                                                        <div class="input-group">
                                                                            <input type="file" onchange="getfileext(this)" class="form-control gymnasium" value="" name="applicant_age_proof">
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
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group mb-3">
                                                                        <label>7. Address Proof/निवास प्रमाण पत्र<span class="text-danger">*</span></label>
                                                                        <div class="input-group">
                                                                            <input type="file" onchange="getfileext(this)" class="form-control gymnasium" value="" name="address_proof">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </fieldset>
                                                    </div>
                                                    <div class="show-hide" id="swimmingPoolMini">
                                                        <div class="row mb-4">
                                                            <div class="col-md-4">
                                                                <div class="form-group mb-3">
                                                                    <label class="placeholder">
                                                                        2. Select Location/स्थान चुनें<span class="text-danger">*</span>
                                                                    </label>
                                                                    <select class="form-select form-control swimmingPoolMini" onchange="stadium_list(this.value, 'swimmingPoolMiniiii')" name="location_spm">
                                                                        <option value="">Select</option>
                                                                        @foreach ($districts as $item)
                                                                        <option value="{{$item->id}}">{{$item->city}}</option>
                                                                        @endforeach

                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group mb-3">
                                                                    <label class="placeholder">
                                                                        3. Select Stadium/स्टेडियम का चयन करें<span class="text-danger">*</span>
                                                                    </label>
                                                                    <select class="form-select form-control swimmingPoolMini" id="swimmingPoolMiniiii" name="stadium_spm">
                                                                        <option value="">Select</option>

                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group mb-3">
                                                                    <label class="placeholder">
                                                                        4. Purpose/उद्देश्य <span class="text-danger">*</span>
                                                                    </label>
                                                                    <input type="text" class="form-control swimmingPoolMini" onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))'
                                                                        pattern="^[A-Za-z -]+$" maxlength="255" value="" name="purpose_spm">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label class="placeholder">
                                                                    5. Date Range/दिनांक सीमा <span class="text-danger">*</span>
                                                                </label>
                                                                <div class="input-group mb-3">
                                                                    <span class="input-group-text">From</span>
                                                                    <input type="date" class="form-control swimmingPoolMini" name="booking_date_from_spm" placeholder="" aria-label="" onblur="enddate(this.value, 'enddate2')">
                                                                    <span class="input-group-text">To</span>
                                                                    <input type="date" id="enddate2" class="form-control " name="booking_date_to_spm" placeholder="" aria-label="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <fieldset>
                                                            <legend>Attachments/संलग्नक</legend>
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <div class="form-group mb-3">
                                                                        <label>1. Applicant Photo/आवेदक फोटो<span class="text-danger">*</span></label>
                                                                        <div class="input-group">
                                                                            <input type="file" onchange="getfileextt(this)" class="form-control swimmingPoolMini" value="" name="applicant_photo_spm">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group mb-3">
                                                                        <label>2. Aadhar Card/आधार कार्ड<span class="text-danger">*</span></label>
                                                                        <div class="input-group">
                                                                            <input type="file" class="form-control swimmingPoolMini" value="" name="applicant_aadhaar_spm">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group mb-3">
                                                                        <label>3. Signature/हस्ताक्षर<span class="text-danger">*</span></label>
                                                                        <div class="input-group">
                                                                            <input type="file" onchange="getfileextt(this)" class="form-control swimmingPoolMini" value="" name="applicant_signature_spm">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group mb-3 position-relative">
                                                                        <label>4. M.B.B.S Doctor Certificate/एम.बी.बी.एस डॉक्टर प्रमाणपत्र<span class="text-danger">*</span></label>
                                                                        <div class="input-group">
                                                                            <input type="file" onchange="getfileext(this)" class="form-control swimmingPoolMini" value="" name="mbbs_doctor_certificate_spm">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group mb-3">
                                                                        <label>5. Address Proof/निवास प्रमाण पत्र<span class="text-danger">*</span></label>
                                                                        <div class="input-group">
                                                                            <input type="file" onchange="getfileext(this)" class="form-control swimmingPoolMini" value="" name="address_proof_spm">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </fieldset>
                                                    </div>
                                                    <div class="show-hide" id="swimmingPoolAdult">
                                                        <div class="row mb-4">
                                                            <div class="col-md-4">
                                                                <div class="form-group mb-3">
                                                                    <label class="placeholder">
                                                                        2. Select Location/स्थान चुनें<span class="text-danger">*</span>
                                                                    </label>
                                                                    <select class="form-select form-control swimmingPoolAdult" onchange="stadium_list(this.value, 'swimmingPoolAdultttt')" name="location_spa">
                                                                        <option value="">Select</option>
                                                                        @foreach ($districts as $item)
                                                                        <option value="{{$item->id}}">{{$item->city}}</option>
                                                                        @endforeach

                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group mb-3">
                                                                    <label class="placeholder">
                                                                        3. Select Stadium/स्टेडियम का चयन करें<span class="text-danger">*</span>
                                                                    </label>
                                                                    <select class="form-select form-control swimmingPoolAdult" id="swimmingPoolAdultttt" name="stadium_spa">
                                                                        <option value="">Select</option>

                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group mb-3">
                                                                    <label class="placeholder">
                                                                        4. Purpose/उद्देश्य <span class="text-danger">*</span>
                                                                    </label>
                                                                    <input type="text" class="form-control swimmingPoolAdult" onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))'
                                                                        pattern="^[A-Za-z -]+$" maxlength="255" value="" name="purpose_spa">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label class="placeholder">
                                                                    5. Date Range/दिनांक सीमा <span class="text-danger">*</span>
                                                                </label>
                                                                <div class="input-group mb-3">
                                                                    <span class="input-group-text">From</span>
                                                                    <input type="date" onblur="enddate(this.value, 'enddate3')" name="booking_date_from_spa" class="form-control swimmingPoolAdult" placeholder="" aria-label="">
                                                                    <span class="input-group-text">To</span>
                                                                    <input type="date" id="enddate3" class="form-control swimmingPoolAdult" name="booking_date_to_spa" placeholder="" aria-label="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <fieldset>
                                                            <legend>Attachments/संलग्नक</legend>
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <div class="form-group mb-3">
                                                                        <label>1. Applicant Photo/आवेदक फोटो<span class="text-danger">*</span></label>
                                                                        <div class="input-group">
                                                                            <input type="file" onchange="getfileextt(this)" class="form-control swimmingPoolAdult" value="" name="applicant_photo_spa">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group mb-3">
                                                                        <label>2. Aadhar Card/आधार कार्ड<span class="text-danger">*</span></label>
                                                                        <div class="input-group">
                                                                            <input type="file" onchange="getfileext(this)" class="form-control swimmingPoolAdult" value="" name="applicant_aadhaar_spa">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group mb-3">
                                                                        <label>3. Signature/हस्ताक्षर<span class="text-danger">*</span></label>
                                                                        <div class="input-group">
                                                                            <input type="file" onchange="getfileextt(this)" class="form-control swimmingPoolAdult" value="" name="applicant_signature_spa">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </fieldset>
                                                    </div>
                                                    <div class="show-hide" id="guestRoom">
                                                        <div class="row mb-4">
                                                            <div class="col-md-4">
                                                                <div class="form-group mb-3">
                                                                    <label class="placeholder">
                                                                        2. Select Location/स्थान चुनें<span class="text-danger">*</span>
                                                                    </label>
                                                                    <select class="form-select form-control guestRoom" name="location_gr" onchange="stadium_list(this.value, 'guestRoommmm')">
                                                                        <option value="">Select</option>
                                                                        @foreach ($districts as $item)
                                                                        <option value="{{$item->id}}">{{$item->city}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group mb-3">
                                                                    <label class="placeholder">
                                                                        3. Select Stadium/स्टेडियम का चयन करें<span class="text-danger">*</span>
                                                                    </label>
                                                                    <select class="form-select form-control guestRoom" id="guestRoommmm" name="stadium_gr">
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
                                                                    <option value="Large Room">Large Room</option>
                                                                    <option value=" Medium Room"> Medium Room</option>
                                                                    <option value="Small Room">Small Room</option>

                                                                </select>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group mb-3">
                                                                    <label class="placeholder">
                                                                        5. Purpose/उद्देश्य <span class="text-danger">*</span>
                                                                    </label>
                                                                    <input type="text" class="form-control guestRoom" onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))'
                                                                        pattern="^[A-Za-z -]+$" maxlength="255" value="" name="purpose_gr">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group mb-3">
                                                                    <label>6. Members/सदस्य</label>
                                                                    <input type="number" class="form-control guestRoom" min="1" name="member_gr" value="">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label class="placeholder">
                                                                    7. Date Range/दिनांक सीमा <span class="text-danger">*</span>
                                                                </label>
                                                                <div class="input-group mb-3">
                                                                    <span class="input-group-text">From</span>
                                                                    <input type="date" class="form-control guestRoom" name="booking_date_from_gr" onblur="enddate(this.value, 'enddate4')" placeholder="" aria-label="">
                                                                    <span class="input-group-text">To</span>
                                                                    <input type="date" class="form-control guestRoom" name="booking_date_to_gr" id="enddate4" placeholder="" aria-label="">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label class="placeholder">
                                                                    8. Time Range/समय सीमा <span class="text-danger">*</span>
                                                                </label>
                                                                <div class="input-group mb-3">
                                                                    <span class="input-group-text">From</span>
                                                                    <input type="time" class="form-control guestRoom" name="booking_time_from_gr" onblur="endtime(this.value, 'endtime2')" placeholder="" aria-label="">
                                                                    <span class="input-group-text">To</span>
                                                                    <input type="time" id="endtime2" class="form-control guestRoom" name="booking_time_to_gr" placeholder="" aria-label="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <fieldset>
                                                            <legend>Attachments/संलग्नक</legend>
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <div class="form-group mb-3">
                                                                        <label class="placeholder">
                                                                            1. Applicant Photo/आवेदक फोटो <span class="text-danger">*</span>
                                                                        </label>
                                                                        <div class="input-group">
                                                                            <input type="file" onchange="getfileextt(this)" class="form-control guestRoom" name="applicant_photo_gr" value="">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group mb-3">
                                                                        <label class="placeholder">
                                                                            2. Aadhaar Card/आधार कार्ड <span class="text-danger">*</span>
                                                                        </label>
                                                                        <div class="input-group">
                                                                            <input type="file" onchange="getfileext(this)" class="form-control guestRoom" name="applicant_aadhaar_gr" value="">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group mb-3">
                                                                        <label class="placeholder">
                                                                            3. Signature/हस्ताक्षर <span class="text-danger">*</span>
                                                                        </label>
                                                                        <div class="input-group">
                                                                            <input type="file" onchange="getfileextt(this)" class="form-control guestRoom" name="applicant_signature_gr" value="">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </fieldset>
                                                    </div>
                                                    <div class="show-hide" id="stadium">
                                                        <div class="row mb-4">
                                                            <div class="col-md-4">
                                                                <div class="form-group mb-3">
                                                                    <label class="placeholder">
                                                                        2. Select Location/स्थान चुनें<span class="text-danger">*</span>
                                                                    </label>
                                                                    <select class="form-select form-control stadium" name="location_s" onchange="stadium_list(this.value, 'stadiumjhk')">
                                                                        <option value="">Select</option>
                                                                        @foreach ($districts as $item)
                                                                        <option value="{{$item->id}}">{{$item->city}}</option>
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
                                                                        <option value="stadium1">stadium1</option>
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
                                                                        <option value="{{$item->id}}">{{$item->name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group mb-3">
                                                                    <label class="placeholder">
                                                                        5. Purpose/उद्देश्य <span class="text-danger">*</span>
                                                                    </label>
                                                                    <input type="text" class="form-control stadium" onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))'
                                                                        pattern="^[A-Za-z -]+$" maxlength="255" value="" name="purpose_s">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label class="placeholder">
                                                                    6. Date Range/दिनांक सीमा <span class="text-danger">*</span>
                                                                </label>
                                                                <div class="input-group mb-3">
                                                                    <span class="input-group-text">From</span>
                                                                    <input type="date" class="form-control stadium" name="booking_date_from_s" onblur="enddate(this.value, 'enddate6')" placeholder="" aria-label="">
                                                                    <span class="input-group-text">To</span>
                                                                    <input type="date" class="form-control stadium" name="booking_date_to_s" id="enddate6" placeholder="" aria-label="">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <label class="placeholder">
                                                                    7. Time Range/समय सीमा <span class="text-danger">*</span>
                                                                </label>
                                                                <div class="input-group mb-3">
                                                                    <span class="input-group-text">From</span>
                                                                    <input type="time" class="form-control stadium" name="booking_time_from_s" onblur="enddate(this.value, 'endtime3')" placeholder="" aria-label="">
                                                                    <span class="input-group-text">To</span>
                                                                    <input type="time" class="form-control stadium" id="endtime3" name="booking_time_to_s" placeholder="" aria-label="">
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <fieldset>
                                                            <legend>Attachments/संलग्नक</legend>
                                                            <div class="row">
                                                                <div class="col-md-4">
                                                                    <div class="form-group mb-3">
                                                                        <label class="placeholder">
                                                                            1. Applicant Photo/आवेदक फोटो <span class="text-danger">*</span>
                                                                        </label>
                                                                        <div class="input-group">
                                                                            <input type="file" onchange="getfileextt(this)" class="form-control stadium" name="applicant_photo_s" value="">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group mb-3">
                                                                        <label class="placeholder">
                                                                            2. Aadhaar Card/आधार कार्ड <span class="text-danger">*</span>
                                                                        </label>
                                                                        <div class="input-group">
                                                                            <input type="file" onchange="getfileext(this)" class="form-control stadium" name="applicant_aadhaar_s" value="">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-4">
                                                                    <div class="form-group mb-3">
                                                                        <label class="placeholder">
                                                                            3. Signature/हस्ताक्षर <span class="text-danger">*</span>
                                                                        </label>
                                                                        <div class="input-group">
                                                                            <input type="file" onchange="getfileextt(this)" class="form-control stadium" name="applicant_signature_s" value="">
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </fieldset>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <div class="row justify-content-center w-100">
                                                <div class="col-md-2 d-grid">
                                                    <button type="submit" class="btn btn-outline-success ">Save and Next</button>
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
    function enddate(value, id) {
        $(`#${id}`).attr({
            "min": value
        });
    }

    function endtime(value, id) {
        $(`#${id}`).attr({
            "min": value
        });
    }
</script>
