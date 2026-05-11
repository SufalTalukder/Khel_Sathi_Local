@extends('layouts\private_coaching_auth_layout')
@section('content')


    <div class="container-fluid pagecontentbody">
        <div class="pagebody removebg-color">
            <div class="row">
                <div class="col-12">
                    <div class="pageheader" id="menu-margin">
                        <div class="row">
                            <div class="col-md-10">
                                <h4 class="mb-0"> Private Sports Coaching/Academy Operation Form</h4>
                            </div>
                            <div class="col-md-2 d-grid">
                                <a href="{{ route('private_coaching_dashboard') }}" class="btn btn-xs btn-outline-success">
                                    <span class="icons icon-arrow-left"></span>Back to Dashboard
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-12">
                    <div class="bhoechie-tab-container">



                        <form
                            action="@if (isset($application)) {{ route('academies_application_form_store', $application->id) }}@else {{ route('academies_application_form_store') }} @endif"
                            method="post" class="needs-validation" id="submitform" novalidate
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bhoechie-tab">
                                    <div class="bhoechie-tab-content active">
                                        <div class="form-scroll">
                                            <div class="nano-content">

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <h5 class="subheading">A. Registration Details/पंजीकरण के विवरण</h5>
                                                    </div>
                                                    <div class="col-md-3 mb-3">
                                                        <strong>1.) Full Name/पूरा
                                                            नाम</strong><br />{{ Auth::guard('PrivateCoaching')->user()->name }}
                                                    </div>
                                                    <div class="col-md-3 mb-3">
                                                        <strong>2.)
                                                            Designation/पदनाम</strong><br />{{ Auth::guard('PrivateCoaching')->user()->designation }}
                                                    </div>
                                                    <div class="col-md-3 mb-3">
                                                        <strong>3.) Email ID/ईमेल
                                                            आईडी</strong><br />{{ Auth::guard('PrivateCoaching')->user()->email }}
                                                    </div>
                                                    <div class="col-md-3 mb-3">
                                                        <strong>4.) Mobile No./मोबाइल
                                                            नंबर</strong><br />{{ Auth::guard('PrivateCoaching')->user()->mobile }}
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-10">


                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <h5 class="subheading">B. Private Sports Coaching/Academy
                                                                    Details/प्राइवेट खेल कोचिंग/अकेडमी का विवरण</h5>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group mb-3">
                                                                    <label class="placeholder">1.) Name of the head Private
                                                                        Sports Coaching/Academy<br />प्राइवेट खेल कोचिंग /
                                                                        अकेडमी के मालिक का नाम</label>
                                                                    <input type="text" class="form-control"
                                                                        onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || event.charCode === 32 || event.charCode === 45)"
                                                                        pattern="^[A-Za-z -]+$" required name="head_name"
                                                                        value="{{ isset($application->head_name) ? $application->head_name : '' }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group mb-3">
                                                                    <label>2.) Address<br />पता</label>
                                                                    <input type="text" class="form-control"
                                                                        onkeypress="return /[A-Za-z0-9 ,.-]/.test(String.fromCharCode(event.charCode))"
                                                                        pattern="^[A-Za-z0-9 ,.-]{5,100}$" required
                                                                        name="head_address"
                                                                        value="{{ isset($application->head_address) ? $application->head_address : '' }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group mb-3">
                                                                    <label class="placeholder">3.) Mobile Number<br />मोबाइल
                                                                        नंबर</label>
                                                                    <input type="text" class="form-control"
                                                                        maxlength="10" minlength="10" pattern="^[6-9]\d{9}$"
                                                                        onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                                                                        required name="head_mobile"
                                                                        value="{{ isset($application->head_mobile) ? $application->head_mobile : '' }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group mb-3">
                                                                    <label class="placeholder">4.) Email ID<br />ईमेल
                                                                        आईडी</label>
                                                                    <input type="email" class="form-control" required
                                                                        name="head_email"
                                                                        value="{{ isset($application->head_email) ? $application->head_email : '' }}">
                                                                </div>
                                                            </div>

                                                            <div class="col-md-4">
                                                                <div class="form-group mb-3">
                                                                    <label>5.) Sports Name<br />खेल का नाम</label>
                                                                    <select id="sportname" class="form-select form-control"
                                                                        name="sport[]" multiple placeholder="Select Sport">
                                                                        @foreach ($sport as $item)
                                                                            <option value="{{ $item->id }}"
                                                                                @if (
                                                                                    !empty($application) &&
                                                                                        !empty(explode(',', $application->sport)) &&
                                                                                        in_array($item->id, explode(',', $application->sport))) selected @endif>
                                                                                {{ $item->name }}
                                                                            </option>
                                                                        @endforeach
                                                                    </select>

                                                                </div>
                                                            </div>
                                                            <div class="col-md-8"> </div>
                                                            <div class="form-group mb-3">
                                                                <label class="placeholder">6.) Institution/Academy/Other
                                                                    Operating the Private Sports
                                                                    Coaching/Academy<br />प्राइवेट खेल कोचिंग / अकेडमी चलाने
                                                                    वाली संस्था / अकेडमी / अन्य</label>
                                                                <input type="text" class="form-control" required
                                                                    name="institution_type"
                                                                    value="{{ isset($application->institution_type) ? $application->institution_type : '' }}">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label>Photo/फोटो</label>
                                                            @if (isset($application) && $application->photo)
                                                                <img src="{{ asset('public/private_coaching_storage/photo/' . $application->photo) }}"
                                                                    style="height: 180px; width: 100%; border: 1px solid #ccc; padding: 5px; margin-bottom: 5px;" />
                                                            @endif
                                                            <input type="file" class="form-control"
                                                                onchange="getfileext11(this.value,1)" id="File1"
                                                                name="photo"
                                                                @empty($application) required @endempty />
                                                        </div>

                                                        <div class="form-group">
                                                            <label>Signature/हस्ताक्षर</label>
                                                            @if (isset($application) && $application->signature)
                                                                <img src="{{ asset('public/private_coaching_storage/signature/' . $application->signature) }}"
                                                                    style="height: 50px; width: 100%; border: 1px solid #ccc; padding: 5px; margin-bottom: 5px; " />
                                                            @endif
                                                            <input type="file" class="form-control"
                                                                onchange="getfileext11(this.value,2)" id="File2"
                                                                @empty($application) required @endempty
                                                                name="signature" />
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h5 class="subheading">C. Manager Details/प्रबंधक विवरण</h5>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group mb-3">
                                                        <label>1.) Manager's Name<br />प्रबन्धक का नाम</label>
                                                        <input type="text"
                                                            onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || event.charCode === 32 || event.charCode === 45)"
                                                            pattern="^[A-Za-z -]+$" class="form-control" required
                                                            name="manager_name"
                                                            value="{{ isset($application->manager_name) ? $application->manager_name : '' }}" />
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group mb-3">
                                                        <label>2.) Manager's Address<br />प्रबन्धक का पता</label>
                                                        <input type="text"
                                                            onkeypress="return /[A-Za-z0-9 ,.-]/.test(String.fromCharCode(event.charCode))"
                                                            pattern="^[A-Za-z0-9 ,.-]{5,100}$" class="form-control"
                                                            required name="manager_address"
                                                            value="{{ isset($application->manager_address) ? $application->manager_address : '' }}" />
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group mb-3">
                                                        <label class="placeholder">3.) Mobile Number<br />मोबाइल
                                                            नंबर</label>
                                                        <input type="text" maxlength="10" minlength="10"
                                                            pattern="^[6-9]\d{9}$"
                                                            onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                                                            class="form-control" required name="manager_mobile"
                                                            value="{{ isset($application->manager_mobile) ? $application->manager_mobile : '' }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group mb-3">
                                                        <label class="placeholder">4.) Email ID<br />ईमेल आईडी</label>
                                                        <input type="email" class="form-control" required
                                                            name="manager_email"
                                                            value="{{ isset($application->manager_email) ? $application->manager_email : '' }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h5 class="subheading">
                                                        D. Is there a trainer?/प्रशिक्षक यदि है तो?
                                                        <label class="form-check form-check-inline ms-2 me-2">
                                                            <input class="form-check-input" type="radio"
                                                                name="has_trainer" id="trainerYes" value="1"
                                                                required @if (isset($application) && $application->has_trainer == 1) checked @endif>
                                                            <span class="form-check-label" for="trainerYes">Yes</span>
                                                        </label>
                                                        <label class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio"
                                                                name="has_trainer" id="trainerNo" value="0" required
                                                                @if (isset($application) && $application->has_trainer == 0) checked @endif>
                                                            <span class="form-check-label" for="trainerNo">No</span>
                                                        </label>
                                                    </h5>
                                                </div>
                                            </div>

                                            <div class="container" id="trainerContent"
                                                @if (isset($application) && $application->has_trainer == 0) style="display:none;" @endif>
                                                <div id="trainerWrapper">
                                                    @if (isset($trainers) && count($trainers) > 0)
                                                        @foreach ($trainers as $index => $trainer)
                                                            <div class="row g-3 mb-4 border trainer-block">
                                                                <div class="col-md-2">
                                                                    <label class="form-label">1.) Trainer's
                                                                        Name<br><small>प्रशिक्षक का नाम</small></label>
                                                                    <input type="text"
                                                                        onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || event.charCode === 32 || event.charCode === 45)"
                                                                        pattern="^[A-Za-z -]+$" class="form-control"
                                                                        name="trainer_name[]" required
                                                                        value="{{ $trainer->name ?? old('trainer_name.' . $index) }}">
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <label class="form-label">2.) Trainer's
                                                                        Address<br><small>प्रशिक्षक का पता</small></label>
                                                                    <input
                                                                        onkeypress="return /[A-Za-z0-9 ,.-]/.test(String.fromCharCode(event.charCode))"
                                                                        pattern="^[A-Za-z0-9 ,.-]{5,100}$" type="text"
                                                                        class="form-control" name="trainer_address[]"
                                                                        required
                                                                        value="{{ $trainer->address ?? old('trainer_address.' . $index) }}">
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <label class="form-label">3.) Mobile
                                                                        Number<br><small>मोबाइल नंबर</small></label>
                                                                    <input type="text" maxlength="10" minlength="10"
                                                                        pattern="^[6-9]\d{9}$"
                                                                        onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                                                                        class="form-control" name="trainer_mobile[]"
                                                                        required
                                                                        value="{{ $trainer->mobile ?? old('trainer_mobile.' . $index) }}">
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <label class="form-label">4.) Trainer's
                                                                        Photo<br><small>प्रशिक्षक का फोटो</small></label>
                                                                    <div class="input-group">
                                                                        <input type="file" class="form-control"
                                                                            onchange="getfileext11(this.value,3)"
                                                                            id="File3" name="trainer_photo[]"
                                                                            @if (!isset($trainer)) required @endif>
                                                                        @if (isset($trainer) && $trainer->photo)
                                                                            <a href="{{ asset('public/private_coaching_storage/photo/' . $trainer->photo) }}"
                                                                                target="_blank"
                                                                                class="btn btn-outline-secondary">View</a>
                                                                            <input type="hidden"
                                                                                name="existing_trainer_photo[]"
                                                                                value="{{ $trainer->photo }}">
                                                                        @endif
                                                                    </div>
                                                                    <small class="text-muted">(jpeg, jpg | Max: 2
                                                                        MB)</small>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label class="form-label">5.) Certification
                                                                        Documents<br><small>प्रशिक्षक सम्बंधित प्रमाण
                                                                            पत्र</small></label>
                                                                    <div class="input-group">
                                                                        <input type="file"
                                                                            onchange="getfileext25(this,4)" id="File4"
                                                                            class="form-control"
                                                                            name="trainer_certificate[]"
                                                                            @if (!isset($trainer)) required @endif>
                                                                        @if (isset($trainer) && $trainer->certificate)
                                                                            <a href="{{ asset('public/private_coaching_storage/certificate/' . $trainer->certificate) }}"
                                                                                target="_blank"
                                                                                class="btn btn-outline-secondary">View</a>
                                                                            <input type="hidden"
                                                                                name="existing_trainer_certificate[]"
                                                                                value="{{ $trainer->certificate }}">
                                                                        @endif
                                                                    </div>
                                                                    <small class="text-muted">(pdf, jpeg, jpg | Max: 2
                                                                        MB)</small>
                                                                </div>
                                                                <div class="col-md-1 d-flex align-items-center">
                                                                    <label class="form-label">&nbsp;</label>
                                                                    @if ($index == 0)
                                                                        <button type="button" class="btn btn-primary"
                                                                            id="addTrainerBtn">
                                                                            <i class="fa fa-plus me-1"></i>
                                                                        </button>
                                                                    @else
                                                                        <button type="button"
                                                                            class="btn btn-danger removeTrainerBtn">
                                                                            <i class="fa fa-trash me-1"></i>
                                                                        </button>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @else
                                                        <!-- Default Trainer Block -->
                                                        <div class="row g-3 mb-4 border trainer-block">
                                                            <div class="col-md-2">
                                                                <label class="form-label">1.) Trainer's
                                                                    Name<br><small>प्रशिक्षक का नाम</small></label>
                                                                <input type="text"
                                                                    onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || event.charCode === 32 || event.charCode === 45)"
                                                                    pattern="^[A-Za-z -]+$" class="form-control"
                                                                    name="trainer_name[]">
                                                            </div>
                                                            <div class="col-md-2">
                                                                <label class="form-label">2.) Trainer's
                                                                    Address<br><small>प्रशिक्षक का पता</small></label>
                                                                <input
                                                                    onkeypress="return /[A-Za-z0-9 ,.-]/.test(String.fromCharCode(event.charCode))"
                                                                    pattern="^[A-Za-z0-9 ,.-]{5,100}$" type="text"
                                                                    class="form-control" name="trainer_address[]">
                                                            </div>
                                                            <div class="col-md-2">
                                                                <label class="form-label">3.) Mobile
                                                                    Number<br><small>मोबाइल नंबर</small></label>
                                                                <input
                                                                    onkeypress="return /[A-Za-z0-9 ,.-]/.test(String.fromCharCode(event.charCode))"
                                                                    maxlength="10" minlength="10" pattern="^[6-9]\d{9}$"
                                                                    type="text" class="form-control"
                                                                    name="trainer_mobile[]">
                                                            </div>
                                                            <div class="col-md-2">
                                                                <label class="form-label">4.) Trainer's
                                                                    Photo<br><small>प्रशिक्षक का फोटो</small></label>
                                                                <div class="input-group">
                                                                    <input type="file" class="form-control"
                                                                        name="trainer_photo[]">
                                                                </div>
                                                                <small class="text-muted">(jpeg, jpg | Max: 2 MB)</small>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label class="form-label">5.) Certification
                                                                    Documents<br><small>प्रशिक्षक सम्बंधित प्रमाण
                                                                        पत्र</small></label>
                                                                <div class="input-group">
                                                                    <input type="file" class="form-control"
                                                                        name="trainer_certificate[]">
                                                                </div>
                                                                <small class="text-muted">(pdf, jpeg, jpg | Max: 2
                                                                    MB)</small>
                                                            </div>
                                                            <div class="col-md-1 d-flex align-items-center">
                                                                <label class="form-label">&nbsp;</label>
                                                                <button type="button" class="btn btn-primary"
                                                                    id="addTrainerBtn">
                                                                    <i class="fa fa-plus me-1"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>


                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h5 class="subheading">
                                                        E. Is there support staff?/सपोर्ट स्टाफ यदि है तो?

                                                        <label class="form-check form-check-inline ms-2 me-2">
                                                            <input class="form-check-input" type="radio"
                                                                name="has_staff" id="supportYes" value="1" required
                                                                @if (isset($application) && $application->has_staff == 1) checked @endif>
                                                            <span class="form-check-label" for="supportYes">Yes</span>
                                                        </label>
                                                        <label class="form-check form-check-inline">
                                                            <input class="form-check-input" type="radio"
                                                                name="has_staff" id="supportNo" value="0" required
                                                                @if (isset($application) && $application->has_staff == 0) checked @endif>
                                                            <span class="form-check-label" for="supportNo">No</span>
                                                        </label>
                                                    </h5>
                                                </div>
                                            </div>




                                            <div class="container" id="supportStaffContent"
                                                @if (isset($application) && $application->has_staff == 0) style="display:none;" @endif>
                                                <div id="supportStaffWrapper">
                                                    @if (isset($staffs) && count($staffs) > 0)
                                                        @foreach ($staffs as $index => $staff)
                                                            <div class="row g-3 mb-4 border support-block">
                                                                <div class="col-md-2">
                                                                    <label class="form-label">1.) Support Staff's
                                                                        Name<br><small>सपोर्ट स्टाफ का नाम</small></label>
                                                                    <input type="text"
                                                                        onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || event.charCode === 32 || event.charCode === 45)"
                                                                        pattern="^[A-Za-z -]+$" class="form-control"
                                                                        name="support_name[]" required
                                                                        value="{{ $staff->name ?? old('support_name.' . $index) }}">
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <label class="form-label">2.) Support Staff's
                                                                        Address<br><small>सपोर्ट स्टाफ का
                                                                            पता</small></label>
                                                                    <input type="text"
                                                                        onkeypress="return /[A-Za-z0-9 ,.-]/.test(String.fromCharCode(event.charCode))"
                                                                        pattern="^[A-Za-z0-9 ,.-]{5,100}$"
                                                                        class="form-control" name="support_address[]"
                                                                        required
                                                                        value="{{ $staff->address ?? old('support_address.' . $index) }}">
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <label class="form-label">3.) Mobile
                                                                        Number<br><small>मोबाइल नंबर</small></label>
                                                                    <input type="text"
                                                                        onkeypress="return /[A-Za-z0-9 ,.-]/.test(String.fromCharCode(event.charCode))"
                                                                        pattern="^[A-Za-z0-9 ,.-]{5,100}$"
                                                                        class="form-control" name="support_mobile[]"
                                                                        required
                                                                        value="{{ $staff->mobile ?? old('support_mobile.' . $index) }}">
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <label class="form-label">4.) Support Staff's
                                                                        Photo<br><small>सपोर्ट स्टाफ का फोटो</small></label>
                                                                    <div class="input-group">
                                                                        <input type="file" class="form-control"
                                                                            name="support_photo[]"
                                                                            @if (!isset($staff)) required @endif>
                                                                        @if (isset($staff) && $staff->photo)
                                                                            <a href="{{ asset('public/private_coaching_storage/support_photo/' . $staff->photo) }}"
                                                                                target="_blank"
                                                                                class="btn btn-outline-secondary">View</a>

                                                                            <input type="hidden"
                                                                                name="existing_staff_photo[]"
                                                                                value="{{ $staff->photo }}">
                                                                        @endif
                                                                    </div>
                                                                    <small class="text-muted">(jpeg, jpg | Max: 2
                                                                        MB)</small>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label class="form-label">5.) Certification
                                                                        Documents<br><small>सपोर्ट स्टाफ सम्बंधित प्रमाण
                                                                            पत्र</small></label>
                                                                    <div class="input-group">
                                                                        <input type="file" class="form-control"
                                                                            name="support_certificate[]"
                                                                            @if (!isset($staff)) required @endif>
                                                                        @if (isset($staff) && $staff->certificate)
                                                                            <a href="{{ asset('public/private_coaching_storage/support_certificate/' . $staff->certificate) }}"
                                                                                target="_blank"
                                                                                class="btn btn-outline-secondary">View</a>
                                                                            <input type="hidden"
                                                                                name="existing_staff_certificate[]"
                                                                                value="{{ $staff->certificate }}">
                                                                        @endif
                                                                    </div>
                                                                    <small class="text-muted">(pdf, jpeg, jpg | Max: 2
                                                                        MB)</small>
                                                                </div>
                                                                <div class="col-md-1 d-flex align-items-center">
                                                                    <label class="form-label">&nbsp;</label>
                                                                    @if ($index == 0)
                                                                        <button type="button" class="btn btn-primary"
                                                                            id="addSupportBtn">
                                                                            <i class="fa fa-plus me-1"></i>
                                                                        </button>
                                                                    @else
                                                                        <button type="button"
                                                                            class="btn btn-danger removeSupportBtn">
                                                                            <i class="fa fa-trash me-1"></i>
                                                                        </button>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @else
                                                        <!-- Default Support Staff Block -->
                                                        <div class="row g-3 mb-4 border support-block">
                                                            <div class="col-md-2">
                                                                <label class="form-label">1.) Support Staff's
                                                                    Name<br><small>सपोर्ट स्टाफ का नाम</small></label>
                                                                <input type="text"
                                                                    onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || event.charCode === 32 || event.charCode === 45)"
                                                                    pattern="^[A-Za-z -]+$" class="form-control"
                                                                    name="support_name[]">
                                                            </div>
                                                            <div class="col-md-2">
                                                                <label class="form-label">2.) Support Staff's
                                                                    Address<br><small>सपोर्ट स्टाफ का पता</small></label>
                                                                <input type="text"
                                                                    onkeypress="return /[A-Za-z0-9 ,.-]/.test(String.fromCharCode(event.charCode))"
                                                                    pattern="^[A-Za-z0-9 ,.-]{5,100}$"
                                                                    class="form-control" name="support_address[]">
                                                            </div>
                                                            <div class="col-md-2">
                                                                <label class="form-label">3.) Mobile
                                                                    Number<br><small>मोबाइल नंबर</small></label>
                                                                <input type="text" maxlength="10" minlength="10"
                                                                    pattern="^[6-9]\d{9}$"
                                                                    onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                                                                    class="form-control" name="support_mobile[]">
                                                            </div>
                                                            <div class="col-md-2">
                                                                <label class="form-label">4.) Support Staff's
                                                                    Photo<br><small>सपोर्ट स्टाफ का फोटो</small></label>
                                                                <div class="input-group">
                                                                    <input type="file"
                                                                        onchange="getfileext11(this.value,10)"
                                                                        id="File10" class="form-control"
                                                                        name="support_photo[]">
                                                                </div>
                                                                <small class="text-muted">(jpeg, jpg | Max: 2 MB)</small>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <label class="form-label">5.) Certification
                                                                    Documents<br><small>सपोर्ट स्टाफ सम्बंधित प्रमाण
                                                                        पत्र</small></label>
                                                                <div class="input-group">
                                                                    <input type="file" onchange="getfileext25(this,11)"
                                                                        id="File11" class="form-control"
                                                                        name="support_certificate[]">
                                                                </div>
                                                                <small class="text-muted">(pdf, jpeg, jpg | Max: 2
                                                                    MB)</small>
                                                            </div>
                                                            <div class="col-md-1 d-flex align-items-center">
                                                                <label class="form-label">&nbsp;</label>
                                                                <button type="button" class="btn btn-primary"
                                                                    id="addSupportBtn">
                                                                    <i class="fa fa-plus me-1"></i>
                                                                </button>
                                                            </div>
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>




















                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h5 class="subheading">
                                                        F. No Objection/Approval Certificates/अनापत्ति/अनुमति प्रमाण पत्र
                                                    </h5>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group mb-3">
                                                        <label>1.) Attach a copy of the No Objection Certificate (NOC) or
                                                            Permission Certificate obtained from the District Administration
                                                            and other relevant departments for the construction of the
                                                            Private Sports Coaching/Academy/प्राइवेट खेल कोचिंग / अकेडमी के
                                                            निर्माण हेतु जिला प्रशासन एवं अन्य संबंधित विभागों से प्राप्त गई
                                                            अनापत्ति / अनुमति प्रमाण पत्र की छायाप्रति संलग्न करें</label>


                                                        <div class="input-group">
                                                            <input type="file" class="form-control"
                                                                onchange="getfileext25(this,12)" id="File12"
                                                                name="noc_certificate"
                                                                @empty($application)) required @endempty>
                                                            @if (isset($application) && $application->noc_certificate)
                                                                <a href="{{ asset('public/private_coaching_storage/noc_certificate/' . $application->noc_certificate) }}"
                                                                    target="_blank"
                                                                    class="btn btn-outline-secondary">View</a>
                                                            @endif
                                                        </div>
                                                        <span class="note">(File Format: pdf, jpeg, jpg | Max File Size:
                                                            2 MB)</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h5 class="subheading">
                                                        G. Private Sports Coaching/Academy Construction Details / प्राइवेट
                                                        खेल कोचिंग/अकेडमी निर्माण विवरण
                                                    </h5>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group mb-3">
                                                        <label>1.) Attach a copy of the Private Sports Coaching/Academy
                                                            Map<br />प्राइवेट खेल कोचिंग/अकेडमी के नक्शे की
                                                            छायाप्रति</label>
                                                        <div class="input-group">
                                                            <input type="file" class="form-control"
                                                                onchange="getfileext25(this,16)" id="File16"
                                                                name="academy_map"
                                                                @empty($application) required @endempty>
                                                            @if (isset($application) && $application->academy_map)
                                                                <a href="{{ asset('public/private_coaching_storage/academy_map/' . $application->academy_map) }}"
                                                                    target="_blank"
                                                                    class="btn btn-outline-secondary">View</a>
                                                            @endif
                                                        </div>
                                                        <span class="note">(File Format: pdf, jpeg, jpg | Max File Size:
                                                            2 MB)</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h5 class="subheading">
                                                        H. Facility and Equipment Details/सुविधा और उपकरण का विवरण
                                                    </h5>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group mb-3">
                                                        <label>1.) Is medical facility available? <br />चिकित्सा सुविधा
                                                            उपलब्ध है अथवा नहीं</label>
                                                        <div class="form-control">
                                                            <label class="form-check-inline ms-2 me-2 mb-0">
                                                                <input class="form-check-input" type="radio"
                                                                    name="medical_facility_available" value="1"
                                                                    required
                                                                    @if (isset($application) && $application->medical_facility_available == 1) checked @endif>
                                                                <span class="form-check-label">Yes</span>
                                                            </label>
                                                            <label class="form-check-inline mb-0">
                                                                <input class="form-check-input" type="radio"
                                                                    name="medical_facility_available" value="0"
                                                                    required
                                                                    @if (isset($application) && $application->medical_facility_available == 0) checked @endif>
                                                                <span class="form-check-label">No</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group mb-3">
                                                        <label>2.) Nearest Hospital’s Name <br />नजदीकी अस्पताल का नाम
                                                        </label>
                                                        <input type="text"
                                                            onkeypress="return /[A-Za-z0-9 ,.-]/.test(String.fromCharCode(event.charCode))"
                                                            pattern="^[A-Za-z0-9 ,.-]{5,100}$" class="form-control"
                                                            name="nearest_hospital_name" required
                                                            value="{{ isset($application->nearest_hospital_name) ? $application->nearest_hospital_name : '' }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group mb-3">
                                                        <label>3.) Nearest Hospital’s Number <br />नजदीकी अस्पताल का दूरभाष
                                                            नम्बर</label>
                                                        <input type="text" maxlength="10" minlength="10"
                                                            pattern="^[6-9]\d{9}$"
                                                            onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                                                            class="form-control" name="nearest_hospital_contact_number"
                                                            required
                                                            value="{{ isset($application->nearest_hospital_contact_number) ? $application->nearest_hospital_contact_number : '' }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-5">
                                                    <div class="form-group mb-3">
                                                        <label>4.) Is there an attendance register for trainees?
                                                            <br />प्राइवेट खेल कोचिंग/एकेडमी के प्रशिक्षणार्थियों का
                                                            उपस्थिति रजिस्टर है अथवा नहीं</label>
                                                        <div class="form-control">
                                                            <label class="form-check-inline ms-2 me-2 mb-0">
                                                                <input class="form-check-input" type="radio"
                                                                    name="attendance_register_available" value="1"
                                                                    required
                                                                    @if (isset($application) && $application->attendance_register_available == 1) checked @endif>
                                                                <span class="form-check-label">Yes</span>
                                                            </label>
                                                            <label class="form-check-inline mb-0">
                                                                <input class="form-check-input" type="radio"
                                                                    name="attendance_register_available" value="0"
                                                                    required
                                                                    @if (isset($application) && $application->attendance_register_available == 0) checked @endif>
                                                                <span class="form-check-label">No</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-7">
                                                    <div class="form-group mb-3">
                                                        <label>5.) Is there a board displaying the rules and regulations for
                                                            using the Private Sports Coaching/Academy? <br />प्राइवेट खेल
                                                            कोचिंग/एकेडमी प्रयोग करने वाले नियमो की जानकारी का बोर्ड लगा है
                                                            अथवा नहीं</label>
                                                        <div class="form-control">
                                                            <label class="form-check-inline ms-2 me-2 mb-0">
                                                                <input class="form-check-input" type="radio"
                                                                    name="rules_display_board_available" value="1"
                                                                    required
                                                                    @if (isset($application) && $application->rules_display_board_available == 1) checked @endif>
                                                                <span class="form-check-label">Yes</span>
                                                            </label>
                                                            <label class="form-check-inline mb-0">
                                                                <input class="form-check-input" type="radio"
                                                                    name="rules_display_board_available" value="0"
                                                                    required
                                                                    @if (isset($application) && $application->rules_display_board_available == 0) checked @endif>
                                                                <span class="form-check-label">No</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h5 class="subheading">
                                                        I. Operational Details/परिचालन का विवरण
                                                    </h5>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group mb-3">
                                                        <label>1.) Operating Hours<br />संचालन का समय</label>
                                                        <input type="text" class="form-control" name="operating_hours"
                                                            required
                                                            value="{{ isset($application->operating_hours) ? $application->operating_hours : '' }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group mb-3">
                                                        <label>2.) Applicant’s Name<br />आवेदन कर्ता का नाम</label>
                                                        <input type="text"
                                                            onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || event.charCode === 32 || event.charCode === 45)"
                                                            pattern="^[A-Za-z -]+$" class="form-control"
                                                            name="applicant_name" required
                                                            value="{{ isset($application->applicant_name) ? $application->applicant_name : '' }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group mb-3">
                                                        <label>3.) Applicant’s Address<br />आवेदन कर्ता का पता </label>
                                                        <input type="text"
                                                            onkeypress="return /[A-Za-z0-9 ,.-]/.test(String.fromCharCode(event.charCode))"
                                                            pattern="^[A-Za-z0-9 ,.-]{5,100}$" class="form-control"
                                                            name="applicant_address" required
                                                            value="{{ isset($application->applicant_address) ? $application->applicant_address : '' }}">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group mb-3">
                                                        <label>4.) Applicant’s Mobile Number<br />आवेदन कर्ता का मोबाइल नंबर
                                                        </label>
                                                        <input type="text" maxlength="10" minlength="10"
                                                            pattern="^[6-9]\d{9}$"
                                                            onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                                                            class="form-control" name="applicant_mobile" required
                                                            value="{{ isset($application->applicant_mobile) ? $application->applicant_mobile : '' }}">
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h5 class="subheading">
                                                        J. Supporting Documents and Declarations/सहायक दस्तावेज़ और घोषणाएँ
                                                    </h5>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group mb-3">
                                                        <label>1.) Previous Year’s NOC<br />पिछले वर्ष की अनापत्ति
                                                            प्रमाण-पत्र की छायाप्रति</label>
                                                        <div class="input-group">
                                                            <input type="file" class="form-control"
                                                                onchange="getfileext25(this,17)" id="File17"
                                                                name="previous_year_noc"
                                                                @empty($application) required @endempty>
                                                            @if (isset($application) && $application->previous_year_noc)
                                                                <a href="{{ asset('public/private_coaching_storage/previous_year_noc/' . $application->previous_year_noc) }}"
                                                                    target="_blank"
                                                                    class="btn btn-outline-secondary">View</a>
                                                            @endif
                                                        </div>
                                                        <span class="note">(File Format: pdf, jpeg, jpg | Max File Size:
                                                            2 MB)</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group mb-3">
                                                        <label>2.1) Upload photo of the Private Sports
                                                            Coaching/Academy<br />प्राइवेट खेल कोचिंग / एकेडमी की
                                                            फोटो</label>
                                                        <div class="input-group">
                                                            <input type="file" class="form-control"
                                                                name="academy_photo_1" onchange="getfileext11(this,18)"
                                                                id="File18"
                                                                @empty($application) required @endempty>
                                                            @if (isset($application) && $application->academy_photo_1)
                                                                <a href="{{ asset('public/private_coaching_storage/academy_photo_1/' . $application->academy_photo_1) }}"
                                                                    target="_blank"
                                                                    class="btn btn-outline-secondary">View</a>
                                                            @endif
                                                        </div>
                                                        <span class="note">(File Format: jpeg, jpg | Max File Size: 2
                                                            MB)</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group mb-3">
                                                        <label>2.2) Upload photo of the Private Sports
                                                            Coaching/Academy<br />प्राइवेट खेल कोचिंग / एकेडमी की
                                                            फोटो</label>
                                                        <div class="input-group">
                                                            <input type="file" class="form-control"
                                                                onchange="getfileext11(this,19)" id="File19"
                                                                name="academy_photo_2"
                                                                @empty($application) required @endempty>
                                                            @if (isset($application) && $application->academy_photo_2)
                                                                <a href="{{ asset('public/private_coaching_storage/academy_photo_2/' . $application->academy_photo_2) }}"
                                                                    target="_blank"
                                                                    class="btn btn-outline-secondary">View</a>
                                                            @endif
                                                        </div>
                                                        <span class="note">(File Format: jpeg, jpg | Max File Size: 2
                                                            MB)</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group mb-3">
                                                        <label>2.3) Upload photo of the Private Sports
                                                            Coaching/Academy<br />प्राइवेट खेल कोचिंग / एकेडमी की
                                                            फोटो</label>
                                                        <div class="input-group">
                                                            <input type="file" class="form-control"
                                                                onchange="getfileext25(this,20)" id="File20"
                                                                name="academy_photo_3"
                                                                @empty($application) required @endempty>
                                                            @if (isset($application) && $application->academy_photo_3)
                                                                <a href="{{ asset('public/private_coaching_storage/academy_photo_3/' . $application->academy_photo_3) }}"
                                                                    target="_blank"
                                                                    class="btn btn-outline-secondary">View</a>
                                                            @endif
                                                        </div>
                                                        <span class="note">(File Format: pdf, jpeg, jpg | Max File Size:
                                                            2 MB)</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group mb-3">
                                                        <label>2.4) Upload photo of the Private Sports
                                                            Coaching/Academy<br />प्राइवेट खेल कोचिंग / एकेडमी की
                                                            फोटो</label>
                                                        <div class="input-group">
                                                            <input type="file" class="form-control"
                                                                onchange="getfileext25(this,21)" id="File21"
                                                                name="academy_photo_4"
                                                                @empty($application) required @endempty>
                                                            @if (isset($application) && $application->academy_photo_4)
                                                                <a href="{{ asset('public/private_coaching_storage/academy_photo_4/' . $application->academy_photo_4) }}"
                                                                    target="_blank"
                                                                    class="btn btn-outline-secondary">View</a>
                                                            @endif
                                                        </div>
                                                        <span class="note">(File Format: pdf, jpeg, jpg | Max File Size:
                                                            2 MB)</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group mb-3">
                                                        <label>3.) Affidavit regarding compliance with the terms and
                                                            conditions mentioned on the back of the form<br />फॉर्म के पीछे
                                                            अंकित शर्तो का अनुपालन सम्बन्धी शपथ पत्र</label>
                                                        <div class="input-group">
                                                            <input type="file" class="form-control"
                                                                onchange="getfileext25(this,22)" id="File22"
                                                                name="affidavit_compliance"
                                                                @empty($application) required @endempty>
                                                            @if (isset($application) && $application->affidavit_compliance)
                                                                <a href="{{ asset('public/private_coaching_storage/affidavit_compliance/' . $application->affidavit_compliance) }}"
                                                                    target="_blank"
                                                                    class="btn btn-outline-secondary">View</a>
                                                            @endif
                                                        </div>
                                                        <span class="note">(File Format: pdf, jpeg, jpg | Max File Size:
                                                            2 MB)</span>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="bhoechie-footer">
                                                <div class="row justify-content-center">

                                                    <div class="col-md-2 d-grid">
                                                        <button type="submit" class="btn btn-outline-success">Save And
                                                            Next</button>
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
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#sportname').select2();
        });
    </script>

    <script>
        $(document).ready(function() {




            $("#submitform").submit(function(e) {

                e.preventDefault();
                if ($("#submitform")[0].checkValidity() === false) {
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
                        success: function(res) {
                            if (res.error == false) {
                                success(res.msg);

                                window.location.href = res.url;


                            } else {
                                error(res.msg);
                            }
                        },
                    });
                }
                $("#submitform").addClass("was-validated");
            });



            // function getfileext11(value, id) {


            //     var fileExtension = ["pdf"];
            //     var file_size = value.files[0].size;

            //     var filevalue = value.value;
            //     if (
            //         $.inArray(filevalue.split(".").pop().toLowerCase(), fileExtension) == -1
            //     ) {
            //         $("#File" + id).val("");
            //         $("#sign").attr("src", "");
            //         error("Please Upload File in pdf Format.");
            //     } else if (file_size > 5000000) {
            //         $("#File" + id).val("");
            //         $("#sign").attr("src", "");
            //         error("File Size should not exceed 5MB.");
            //     }

            // }









            // Toggle trainer content visibility based on radio selection
            $('input[name="has_trainer"]').change(function() {
                if ($('#trainerYes').is(':checked')) {
                    $('#trainerContent').show();

                    // Add 'required' to all trainer inputs
                    $('.trainer-block').find('input').each(function() {
                        $(this).attr('required', true);
                    });

                } else {
                    $('#trainerContent').hide();

                    // Remove 'required' from all trainer inputs
                    $('.trainer-block').find('input').each(function() {
                        $(this).removeAttr('required');
                    });
                }
            });

            // Toggle support staff content visibility based on radio selection
            $('input[name="has_staff"]').change(function() {
                if ($('#supportYes').is(':checked')) {
                    $('#supportStaffContent').show();

                    // Add 'required' to all trainer inputs
                    $('.support-block').find('input').each(function() {
                        $(this).attr('required', true);
                    });
                } else {
                    $('#supportStaffContent').hide();
                    $('.support-block').find('input').each(function() {
                        $(this).removeAttr('required');
                    });
                }
            });

            // Initially hide both sections if radio is not selected


            // Trainer section dynamic behavior
            let trainerCount = 1;
            $('#addTrainerBtn').click(function() {
                trainerCount++;
                const $original = $('.trainer-block:first');
                const $clone = $original.clone();

                // Clear input values and remove any existing view buttons
                $clone.find('input').val('');
                $clone.find('.btn-outline-secondary').remove();

                // Replace the add button with a remove button if it's not the first one
                $clone.find('#addTrainerBtn')
                    .replaceWith(
                        '<button type="button" class="btn btn-danger removeTrainerBtn"><i class="fa fa-trash me-1"></i></button>'
                    );

                // Ensure file inputs are required for new blocks
                $clone.find('input[type="file"]').prop('required', true);

                $('#trainerWrapper').append($clone);
                // Mobile number validation

                const mobileFields =
                    'input[name="owner_mobile"], input[name="nearest_hospital_contact_number"], input[name="manager_mobile"], input[name="applicant_mobile"], input[name="trainer_mobile[]"], input[name="support_mobile[]"]';

                // Only allow digits, max 10
                $(mobileFields).on('input', function() {
                    this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10);
                });

                // Validate on blur
                $(mobileFields).on('blur', function() {
                    const mobile = this.value;
                    const isValid = /^[6-9]\d{9}$/.test(mobile);

                    if (!isValid && mobile.length === 10) {
                        alert(
                            "Please enter a valid 10-digit mobile number starting with 6, 7, 8, or 9.");
                        $(this).focus().val('');
                    }
                });
            });


            // Mobile number validation

                const mobileFields =
                    'input[name="head_mobile"], input[name="nearest_hospital_contact_number"], input[name="manager_mobile"], input[name="applicant_mobile"], input[name="trainer_mobile[]"], input[name="support_mobile[]"]';

                // Only allow digits, max 10
                $(mobileFields).on('input', function() {
                    this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10);
                });

                // Validate on blur
                $(mobileFields).on('blur', function() {
                    const mobile = this.value;
                    const isValid = /^[6-9]\d{9}$/.test(mobile);

                    if (!isValid && mobile.length === 10) {
                        alert(
                            "Please enter a valid 10-digit mobile number starting with 6, 7, 8, or 9.");
                        $(this).focus().val('');
                    }
                });

            $(document).on('click', '.removeTrainerBtn', function() {
                $(this).closest('.trainer-block').remove();
            });

            // Support section dynamic behavior
            let supportCount = 1;
            $('#addSupportBtn').click(function() {
                supportCount++;
                const $original = $('.support-block:first');
                const $clone = $original.clone();

                // Clear input values and remove any existing view buttons
                $clone.find('input').val('');
                $clone.find('.btn-outline-secondary').remove();

                // Replace the add button with a remove button if it's not the first one
                $clone.find('#addSupportBtn')
                    .replaceWith(
                        '<button type="button" class="btn btn-danger removeSupportBtn"><i class="fa fa-trash me-1"></i></button>'
                    );

                // Ensure file inputs are required for new blocks
                $clone.find('input[type="file"]').prop('required', true);

                $('#supportStaffWrapper').append($clone);
                // Mobile number validation

                const mobileFields =
                    'input[name="head_mobile"], input[name="nearest_hospital_contact_number"], input[name="manager_mobile"], input[name="applicant_mobile"], input[name="trainer_mobile[]"], input[name="support_mobile[]"]';

                // Only allow digits, max 10
                $(mobileFields).on('input', function() {
                    this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10);
                });

                // Validate on blur
                $(mobileFields).on('blur', function() {
                    const mobile = this.value;
                    const isValid = /^[6-9]\d{9}$/.test(mobile);

                    if (!isValid && mobile.length === 10) {
                        alert(
                            "Please enter a valid 10-digit mobile number starting with 6, 7, 8, or 9.");
                        $(this).focus().val('');
                    }
                });
            });

            $(document).on('click', '.removeSupportBtn', function() {
                $(this).closest('.support-block').remove();
            });



            // Initialize visibility based on current selection
            if ($('#trainerNo').is(':checked')) {
                $('#trainerContent').hide();
            }
            if ($('#supportNo').is(':checked')) {
                $('#supportStaffContent').hide();
            }
        });
    </script>

@endsection
