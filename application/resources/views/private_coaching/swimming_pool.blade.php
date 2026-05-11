@extends('layouts\private_coaching_auth_layout')
@section('content')

    <div class="container-fluid pagecontentbody">
        <div class="pagebody removebg-color">
            <div class="row">
                <div class="col-12">
                    <div class="pageheader" id="menu-margin">
                        <div class="row">
                            <div class="col-md-10">
                                <h4 class="mb-0"> Private Swimming Pool Registration Form</h4>
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
                            action="@if (isset($application)) {{ route('swimming_pool_form_store', $application->id) }}@else {{ route('swimming_pool_form_store') }} @endif"
                            method="post" class="needs-validation" id="submitform" novalidate
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bhoechie-tab">
                                    <div class="bhoechie-tab-content active">
                                        <div class="form-scroll">
                                            <div class="nano-content">
                                                <div class="col-md-12">
                                                    <h5 class="subheading">A. Registration Details/पंजीकरण के विवरण</h5>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <div class="row">

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
                                                            <div class="col-md-12">
                                                                <h5 class="subheading">B. Swimming Pool Details/स्वीमिंग पूल
                                                                    का विवरण</h5>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group mb-3">
                                                                    <label class="placeholder">1.) Name of the owner of
                                                                        Swimming Pool<br />स्वीमिंग पूल के मालिक का नाम
                                                                    </label>
                                                                    <input type="text"
                                                                        onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || event.charCode === 32 || event.charCode === 45)"
                                                                        pattern="^[A-Za-z -]+$" name="owner_name"
                                                                        class="form-control" required
                                                                        value="{{ isset($application->owner_name) ? $application->owner_name : '' }}">
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group mb-3">
                                                                    <label>2.) Address<br />पता</label>
                                                                    <input type="text"
                                                                        onkeypress="return /[A-Za-z0-9 ,.-]/.test(String.fromCharCode(event.charCode))"
                                                                        pattern="^[A-Za-z0-9 ,.-]{5,100}$"
                                                                        name="owner_address" class="form-control"
                                                                        value="{{ isset($application->owner_address) ? $application->owner_address : '' }}"
                                                                        required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group mb-3">
                                                                    <label class="placeholder">3.) Mobile Number<br />मोबाइल
                                                                        नंबर</label>
                                                                    <input type="text" maxlength="10" minlength="10"
                                                                        pattern="^[6-9]\d{9}$"
                                                                        onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                                                                        name="owner_mobile" class="form-control"
                                                                        value="{{ isset($application->owner_mobile) ? $application->owner_mobile : '' }}"
                                                                        required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group mb-3">
                                                                    <label class="placeholder">4.) Email ID<br />ईमेल
                                                                        आईडी</label>
                                                                    <input type="email" name="owner_email"
                                                                        class="form-control"
                                                                        value="{{ isset($application->owner_email) ? $application->owner_email : '' }}"
                                                                        required>
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
                                                                        pattern="^[A-Za-z -]+$" name="manager_name"
                                                                        class="form-control"
                                                                        value="{{ isset($application->manager_name) ? $application->manager_name : '' }}"
                                                                        required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group mb-3">
                                                                    <label>2.) Manager's Address<br />प्रबन्धक का
                                                                        पता</label>
                                                                    <input type="text"
                                                                        onkeypress="return /[A-Za-z0-9 ,.-]/.test(String.fromCharCode(event.charCode))"
                                                                        pattern="^[A-Za-z0-9 ,.-]{5,100}$"
                                                                        name="manager_address" class="form-control"
                                                                        value="{{ isset($application->manager_address) ? $application->manager_address : '' }}"
                                                                        required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group mb-3">
                                                                    <label class="placeholder">3.) Mobile Number<br />मोबाइल
                                                                        नंबर</label>
                                                                    <input type="text" maxlength="10" minlength="10"
                                                                        pattern="^[6-9]\d{9}$"
                                                                        onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                                                                        name="manager_mobile" class="form-control"
                                                                        value="{{ isset($application->manager_mobile) ? $application->manager_mobile : '' }}"
                                                                        required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group mb-3">
                                                                    <label class="placeholder">4.) Email ID<br />ईमेल
                                                                        आईडी</label>
                                                                    <input type="email" name="manager_email"
                                                                        class="form-control"
                                                                        value="{{ isset($application->manager_email) ? $application->manager_email : '' }}"
                                                                        required>
                                                                </div>
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
                                                            <input type="file" onchange="getfileext11(this.value,1)"
                                                                id="File1" class="form-control" name="photo"
                                                                @empty($application) required @endempty />

                                                        </div>
                                                        <div class="form-group">

                                                            <label>Signature/हस्ताक्षर</label>
                                                            @if (isset($application) && $application->signature)
                                                                <img src="{{ asset('public/private_coaching_storage/signature/' . $application->signature) }}"
                                                                    style="height: 50px; width: 100%; border: 1px solid #ccc; padding: 5px; margin-bottom: 5px; " />
                                                            @endif
                                                            <input type="file" onchange="getfileext11(this.value,2)"
                                                                id="File2" class="form-control"
                                                                @empty($application) required @endempty
                                                                name="signature" />

                                                        </div>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <h5 class="subheading">
                                                            D. Instructor's Details/प्रशिक्षक का विवरण
                                                            <label class="form-check form-check-inline ms-2 me-2">
                                                                <input class="form-check-input" type="radio"
                                                                    name="has_instructor" id="instructorYes"
                                                                    value="1"
                                                                    @if (isset($application) && $application->has_instructor == 1) checked @endif
                                                                    required>
                                                                <span class="form-check-label"
                                                                    for="instructorYes">Yes</span>
                                                            </label>
                                                            <label class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    name="has_instructor" id="instructorNo"
                                                                    value="0"
                                                                    @if (isset($application) && $application->has_instructor == 0) checked @endif
                                                                    required>
                                                                <span class="form-check-label"
                                                                    for="instructorNo">No</span>
                                                            </label>
                                                        </h5>
                                                    </div>
                                                </div>

                                                <div class="container" id="instructorContent"
                                                    @if (isset($application) && $application->has_instructor == 0) style="display:none;" @endif>
                                                    <div id="instructorWrapper">
                                                        @if (isset($instructors) && count($instructors) > 0)
                                                            @foreach ($instructors as $index => $instructor)
                                                                <div class="row g-3 mb-4 border instructor-block">
                                                                    <div class="col-md-2">
                                                                        <label class="form-label">1.) Instructor's
                                                                            Name<br><small>प्रशिक्षक का नाम</small></label>
                                                                        <input type="text"
                                                                            onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || event.charCode === 32 || event.charCode === 45)"
                                                                            pattern="^[A-Za-z -]+$" class="form-control"
                                                                            name="instructor_name[]" required
                                                                            value="{{ $instructor->name ?? old('instructor_name.' . $index) }}">
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <label class="form-label">2.) Instructor's
                                                                            Address<br><small>प्रशिक्षक का
                                                                                पता</small></label>
                                                                        <input type="text"
                                                                            onkeypress="return /[A-Za-z0-9 ,.-]/.test(String.fromCharCode(event.charCode))"
                                                                            pattern="^[A-Za-z0-9 ,.-]{5,100}$"
                                                                            class="form-control"
                                                                            name="instructor_address[]" required
                                                                            value="{{ $instructor->address ?? old('instructor_address.' . $index) }}">
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <label class="form-label">3.) Mobile
                                                                            Number<br><small>मोबाइल नंबर</small></label>
                                                                        <input type="text" maxlength="10"
                                                                            minlength="10" pattern="^[6-9]\d{9}$"
                                                                            onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                                                                            class="form-control"
                                                                            name="instructor_mobile[]" required
                                                                            value="{{ $instructor->mobile ?? old('instructor_mobile.' . $index) }}">
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <label class="form-label">4.) Instructor's
                                                                            Photo<br><small>प्रशिक्षक का
                                                                                फोटो</small></label>
                                                                        <div class="input-group">
                                                                            <input type="file"
                                                                                onchange="getfileext11(this,3)"
                                                                                id="File3" class="form-control"
                                                                                name="instructor_photo[]"
                                                                                @if (!isset($instructor)) required @endif>
                                                                            @if (isset($instructor) && $instructor->photo)
                                                                                <a href="{{ asset('public/private_coaching_storage/photo/' . $instructor->photo) }}"
                                                                                    target="_blank"
                                                                                    class="btn btn-outline-secondary">View</a>
                                                                                <input type="hidden"
                                                                                    name="existing_instructor_photo[]"
                                                                                    value="{{ $instructor->photo }}">
                                                                            @endif
                                                                        </div>
                                                                        <small class="text-muted">( jpeg, jpg | Max: 2
                                                                            MB)</small>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <label class="form-label">5.) Certification
                                                                            Documents<br><small>प्रशिक्षक सम्बंधित प्रमाण
                                                                                पत्र</small></label>
                                                                        <div class="input-group">
                                                                            <input type="file"
                                                                                onchange="getfileext25(this,4)"
                                                                                id="File4" class="form-control"
                                                                                name="instructor_certificate[]"
                                                                                @if (!isset($instructor)) required @endif>
                                                                            @if (isset($instructor) && $instructor->certificate)
                                                                                <a href="{{ asset('public/private_coaching_storage/certificate/' . $instructor->certificate) }}"
                                                                                    target="_blank"
                                                                                    class="btn btn-outline-secondary">View</a>
                                                                                <input type="hidden"
                                                                                    name="existing_instructor_certificate[]"
                                                                                    value="{{ $instructor->certificate }}">
                                                                            @endif
                                                                        </div>
                                                                        <small class="text-muted">(pdf, jpeg, jpg | Max: 2
                                                                            MB)</small>
                                                                    </div>
                                                                    <div class="col-md-1 d-flex align-items-center">
                                                                        <label class="form-label">&nbsp;</label>
                                                                        @if ($index == 0)
                                                                            <button type="button" class="btn btn-primary"
                                                                                id="addInstructorBtn">
                                                                                <i class="fa fa-plus me-1"></i>
                                                                            </button>
                                                                        @else
                                                                            <button type="button"
                                                                                class="btn btn-danger removeInstructorBtn">
                                                                                <i class="fa fa-trash me-1"></i>
                                                                            </button>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        @else
                                                            <!-- Default Instructor Block -->
                                                            <div class="row g-3 mb-4 border instructor-block">
                                                                <div class="col-md-2">
                                                                    <label class="form-label">1.) Instructor's
                                                                        Name<br><small>प्रशिक्षक का नाम</small></label>
                                                                    <input type="text"
                                                                        onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || event.charCode === 32 || event.charCode === 45)"
                                                                        pattern="^[A-Za-z -]+$" class="form-control"
                                                                        name="instructor_name[]">
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <label class="form-label">2.) Instructor's
                                                                        Address<br><small>प्रशिक्षक का पता</small></label>
                                                                    <input type="text"
                                                                        onkeypress="return /[A-Za-z0-9 ,.-]/.test(String.fromCharCode(event.charCode))"
                                                                        pattern="^[A-Za-z0-9 ,.-]{5,100}$"
                                                                        class="form-control" name="instructor_address[]">
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <label class="form-label">3.) Mobile
                                                                        Number<br><small>मोबाइल नंबर</small></label>
                                                                    <input type="text"
                                                                        onkeypress="return /[A-Za-z0-9 ,.-]/.test(String.fromCharCode(event.charCode))"
                                                                        pattern="^[A-Za-z0-9 ,.-]{5,100}$"
                                                                        class="form-control" name="instructor_mobile[]">
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <label class="form-label">4.) Instructor's
                                                                        Photo<br><small>प्रशिक्षक का फोटो</small></label>
                                                                    <div class="input-group">
                                                                        <input type="file" class="form-control"
                                                                            name="instructor_photo[]">
                                                                    </div>
                                                                    <small class="text-muted">( jpeg, jpg | Max: 2
                                                                        MB)</small>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label class="form-label">5.) Certification
                                                                        Documents<br><small>प्रशिक्षक सम्बंधित प्रमाण
                                                                            पत्र</small></label>
                                                                    <div class="input-group">
                                                                        <input type="file" class="form-control"
                                                                            name="instructor_certificate[]">
                                                                    </div>
                                                                    <small class="text-muted">(pdf, jpeg, jpg | Max: 2
                                                                        MB)</small>
                                                                </div>
                                                                <div class="col-md-1 d-flex align-items-center">
                                                                    <label class="form-label">&nbsp;</label>
                                                                    <button type="button" class="btn btn-primary"
                                                                        id="addInstructorBtn">
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
                                                            E. Lifeguard's Details/लाईफ गार्ड का विवरण
                                                            <label class="form-check form-check-inline ms-2 me-2">
                                                                <input class="form-check-input" type="radio"
                                                                    name="has_life_guard" id="lifeguardYes"
                                                                    value="1"
                                                                    @if (isset($application) && $application->has_life_guard == 1) checked @endif
                                                                    required>
                                                                <span class="form-check-label"
                                                                    for="lifeguardYes">Yes</span>
                                                            </label>
                                                            <label class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    name="has_life_guard" id="lifeguardNo" value="0"
                                                                    @if (isset($application) && $application->has_life_guard == 0) checked @endif
                                                                    required>
                                                                <span class="form-check-label" for="lifeguardNo">No</span>
                                                            </label>
                                                        </h5>
                                                    </div>
                                                </div>
                                                <div class="container" id="lifeguardContent"
                                                    @if (isset($application) && $application->has_life_guard == 0) style="display:none;" @endif>
                                                    <div id="lifeguardWrapper">
                                                        @if (isset($lifeguards) && count($lifeguards) > 0)
                                                            @foreach ($lifeguards as $index => $lifeguard)
                                                                <div class="row mb-4 border lifeguard-block">
                                                                    <div class="col-md-2">
                                                                        <label class="form-label">1.) Lifeguard's
                                                                            Name<br><small>जीवन रक्षक का नाम</small></label>
                                                                        <input type="text"
                                                                            onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || event.charCode === 32 || event.charCode === 45)"
                                                                            pattern="^[A-Za-z -]+$" class="form-control"
                                                                            name="lifeguard_name[]" required
                                                                            value="{{ $lifeguard->name ?? old('lifeguard_name.' . $index) }}">
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <label class="form-label">2.) Lifeguard's
                                                                            Address<br><small>जीवन रक्षक का
                                                                                पता</small></label>
                                                                        <input type="text"
                                                                            onkeypress="return /[A-Za-z0-9 ,.-]/.test(String.fromCharCode(event.charCode))"
                                                                            pattern="^[A-Za-z0-9 ,.-]{5,100}$"
                                                                            class="form-control"
                                                                            name="lifeguard_address[]" required
                                                                            value="{{ $lifeguard->address ?? old('lifeguard_address.' . $index) }}">
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <label class="form-label">3.) Mobile
                                                                            Number<br><small>मोबाइल नंबर</small></label>
                                                                        <input type="text" maxlength="10"
                                                                            minlength="10" pattern="^[6-9]\d{9}$"
                                                                            onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                                                                            class="form-control" name="lifeguard_mobile[]"
                                                                            required
                                                                            value="{{ $lifeguard->mobile ?? old('lifeguard_mobile.' . $index) }}">
                                                                    </div>
                                                                    <div class="col-md-2">
                                                                        <label class="form-label">4.) Lifeguard's
                                                                            Photo<br><small>फोटो</small></label>
                                                                        <div class="input-group">
                                                                            <input type="file" class="form-control"
                                                                                name="lifeguard_photo[]"
                                                                                @if (!isset($lifeguard)) required @endif>
                                                                            @if (isset($lifeguard) && $lifeguard->photo)
                                                                                <a href="{{ asset('public/private_coaching_storage/photo/' . $lifeguard->photo) }}"
                                                                                    target="_blank"
                                                                                    class="btn btn-outline-secondary">View</a>
                                                                                <input type="hidden"
                                                                                    name="existing_lifeguard_photo[]"
                                                                                    value="{{ $lifeguard->photo }}">
                                                                            @endif
                                                                        </div>
                                                                        <small class="text-muted">(pdf, jpeg, jpg | Max: 2
                                                                            MB)</small>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <label class="form-label">5.) Lifeguard's
                                                                            Certificate<br><small>प्रमाण
                                                                                पत्र</small></label>
                                                                        <div class="input-group">
                                                                            <input type="file" class="form-control"
                                                                                name="lifeguard_certificate[]"
                                                                                @if (!isset($lifeguard)) required @endif>
                                                                            @if (isset($lifeguard) && $lifeguard->certificate)
                                                                                <a href="{{ asset('public/private_coaching_storage/certificate/' . $lifeguard->certificate) }}"
                                                                                    target="_blank"
                                                                                    class="btn btn-outline-secondary">View</a>
                                                                                <input type="hidden"
                                                                                    name="existing_lifeguard_certificate[]"
                                                                                    value="{{ $lifeguard->certificate }}">
                                                                            @endif
                                                                        </div>
                                                                        <small class="text-muted">(pdf, jpeg, jpg | Max: 2
                                                                            MB)</small>
                                                                    </div>
                                                                    <div class="col-md-1 d-flex align-items-center">
                                                                        @if ($index == 0)
                                                                            <button type="button" class="btn btn-primary"
                                                                                id="addLifeguardBtn">
                                                                                <i class="fa fa-plus me-1"></i>
                                                                            </button>
                                                                        @else
                                                                            <button type="button"
                                                                                class="btn btn-danger removeLifeguardBtn">
                                                                                <i class="fa fa-trash me-1"></i>
                                                                            </button>
                                                                        @endif
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        @else
                                                            <!-- Default Lifeguard Block -->
                                                            <div class="row mb-4 border lifeguard-block">
                                                                <div class="col-md-2">
                                                                    <label class="form-label">1.) Lifeguard's
                                                                        Name<br><small>जीवन रक्षक का नाम</small></label>
                                                                    <input type="text"
                                                                        onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || event.charCode === 32 || event.charCode === 45)"
                                                                        pattern="^[A-Za-z -]+$" class="form-control"
                                                                        name="lifeguard_name[]">
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <label class="form-label">2.) Lifeguard's
                                                                        Address<br><small>जीवन रक्षक का पता</small></label>
                                                                    <input type="text"
                                                                        onkeypress="return /[A-Za-z0-9 ,.-]/.test(String.fromCharCode(event.charCode))"
                                                                        pattern="^[A-Za-z0-9 ,.-]{5,100}$"
                                                                        class="form-control" name="lifeguard_address[]">
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <label class="form-label">3.) Mobile
                                                                        Number<br><small>मोबाइल नंबर</small></label>
                                                                    <input type="text" maxlength="10" minlength="10"
                                                                        pattern="^[6-9]\d{9}$"
                                                                        onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                                                                        class="form-control" name="lifeguard_mobile[]">
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <label class="form-label">4.) Lifeguard's
                                                                        Photo<br><small>फोटो</small></label>
                                                                    <div class="input-group">
                                                                        <input type="file" class="form-control"
                                                                            name="lifeguard_photo[]">
                                                                    </div>
                                                                    <small class="text-muted">(pdf, jpeg, jpg | Max: 2
                                                                        MB)</small>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <label class="form-label">5.) Lifeguard's
                                                                        Certificate<br><small>प्रमाण पत्र</small></label>
                                                                    <div class="input-group">
                                                                        <input type="file" class="form-control"
                                                                            name="lifeguard_certificate[]">
                                                                    </div>
                                                                    <small class="text-muted">(pdf, jpeg, jpg | Max: 2
                                                                        MB)</small>
                                                                </div>
                                                                <div class="col-md-1 d-flex align-items-center">
                                                                    <button type="button" class="btn btn-primary"
                                                                        id="addLifeguardBtn">
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
                                                            G. Pool Construction Details/पूल निर्माण विवरण
                                                        </h5>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mb-3">
                                                            <label>1.) Pool Layout Map<br />स्विमिंग पूल के नक़्शे की छाया
                                                                प्रति</label>
                                                            <div class="input-group">
                                                                <input type="file" onchange="getfileext25(this,10)"
                                                                    id="File10" name="pool_layout_map"
                                                                    class="form-control"
                                                                    @empty($application) required @endempty>


                                                                @if (isset($application) && $application->pool_layout_map)
                                                                    <a href="{{ asset('public/private_coaching_storage/pool_layout_map/' . $application->pool_layout_map) }}"
                                                                        class="btn btn-secondary">View</a>
                                                                @endif


                                                            </div>
                                                            <span class="note">(File Format: pdf, jpeg, jpg | Max File
                                                                Size: 2 MB)</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mb-3">
                                                            <label class="placeholder">2.) Water Capacity (in
                                                                liters)<br />स्वीमिंग पूल में कितने लीटर पानी भरा जायेगा
                                                            </label>
                                                            <input type="number" min="1" name="water_capacity"
                                                                class="form-control"
                                                                value="{{ isset($application->water_capacity) ? $application->water_capacity : '' }}"
                                                                required />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mb-3">
                                                            <label class="placeholder">3.) Water Source<br />पानी भरने का
                                                                स्त्रोत </label>
                                                            <select name="water_source" id="watersource"
                                                                class="form-control form-select" required>
                                                                <option value="">Select</option>
                                                                <option value="Groundwater"
                                                                    {{ isset($application) && $application->water_source == 'Groundwater' ? 'selected' : '' }}>
                                                                    Groundwater</option>
                                                                <option value="Municipal"
                                                                    {{ isset($application) && $application->water_source == 'Municipal' ? 'selected' : '' }}>
                                                                    Municipal</option>
                                                                <option value="Other"
                                                                    {{ isset($application) && $application->water_source == 'Other' ? 'selected' : '' }}>
                                                                    Other</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 otherdiv">
                                                        <div class="form-group mb-3">
                                                            <label class="placeholder">Other<br />अन्य </label>
                                                            <input type="text"
                                                                onkeypress="return /[A-Za-z0-9 ,.-]/.test(String.fromCharCode(event.charCode))"
                                                                pattern="^[A-Za-z0-9 ,.-]{5,100}$" name="other"
                                                                class="form-control"
                                                                value="{{ isset($application->other) ? $application->other : '' }}" />
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-group mb-3">
                                                            <label class="placeholder">4.) Draining and Utilization
                                                                Process<br />जल निकासी और उपयोग प्रक्रिया</label>
                                                            <input type="text"
                                                                onkeypress="return /[A-Za-z0-9 ,.-]/.test(String.fromCharCode(event.charCode))"
                                                                pattern="^[A-Za-z0-9 ,.-]{5,100}$"
                                                                name="draining_utilization_process" class="form-control"
                                                                value="{{ isset($application->draining_utilization_process) ? $application->draining_utilization_process : '' }}"
                                                                required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mb-3">
                                                            <label>5.) Pool Size<br />स्वीमिंग पूल का साईज </label>
                                                            <input type="number" min="1" max="999"
                                                                name="pool_size" class="form-control"
                                                                value="{{ isset($application->pool_size) ? $application->pool_size : '' }}"
                                                                required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mb-3">
                                                            <label>6.) Pool Depth <br />पूल की गहराई </label>
                                                            <input type="number" min="1" max="999"
                                                                name="pool_depth" class="form-control"
                                                                value="{{ isset($application->pool_depth) ? $application->pool_depth : '' }}"
                                                                required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mb-3">
                                                            <label>7.) Height of Boundary Wall<br />स्वीमिंग पूल की
                                                                चारदीवारी की ऊँचाई / अन्य विवरण </label>
                                                            <input type="number" min="1" max="999"
                                                                name="height_boundary_wall" class="form-control"
                                                                value="{{ isset($application->height_boundary_wall) ? $application->height_boundary_wall : '' }}"
                                                                required>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mb-3">
                                                            <label>8.) Gate Access Details<br />स्वीमिंग पूल आवागमन (गेट) का
                                                                विवरण</label>
                                                            <input type="text"
                                                                onkeypress="return /[A-Za-z0-9 ,.-]/.test(String.fromCharCode(event.charCode))"
                                                                pattern="^[A-Za-z0-9 ,.-]{5,100}$"
                                                                name="gate_access_detail" class="form-control"
                                                                value="{{ isset($application->gate_access_detail) ? $application->gate_access_detail : '' }}"
                                                                required>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <h5 class="subheading">
                                                            H. Facility and Equipment Details/सुविधा और उपकरण का विवरण
                                                        </h5>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mb-3">
                                                            <label>1.) Availability of Filter Plant<br />फिल्टर प्लान्ट है
                                                                अथवा नही</label>
                                                            <div class="form-control">
                                                                <label class="form-check-inline ms-2 me-2 mb-0">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="available_filter_plant" value="1"
                                                                        @if (isset($application) && $application->available_filter_plant == 1) checked @endif
                                                                        id="filterPlantYes"required>
                                                                    <span class="form-check-label">Yes</span>
                                                                </label>
                                                                <label class="form-check-inline mb-0">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="available_filter_plant" value="0"
                                                                        id="filterPlantNo"
                                                                        @if (isset($application) && $application->available_filter_plant == 0) checked @endif
                                                                        required>
                                                                    <span class="form-check-label">No</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3 filterplant" style="display:none;">
                                                        <div class="form-group mb-3">
                                                            <label>Filter Plant Capacity<br />फिल्टर प्लान्ट की क्षमता
                                                            </label>
                                                            <input type="text"
                                                                onkeypress="return /[A-Za-z0-9 ,.-]/.test(String.fromCharCode(event.charCode))"
                                                                pattern="^[A-Za-z0-9 ,.-]{5,100}$"
                                                                name="filter_plant_capacity" class="form-control"
                                                                value="{{ isset($application->filter_plant_capacity) ? $application->filter_plant_capacity : '' }}" />
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-group mb-3">
                                                            <label>2.) Is There a Depth Marking or Not?<br />गहराई सम्बन्धित
                                                                चिन्ह अंकित है अथवा नहीं </label>
                                                            <div class="form-control">
                                                                <label class="form-check-inline ms-2 me-2 mb-0">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="depth_marking_available" value="1"
                                                                        required
                                                                        @if (isset($application) && $application->depth_marking_available == 1) checked @endif>
                                                                    <span class="form-check-label">Yes</span>
                                                                </label>
                                                                <label class="form-check-inline mb-0">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="depth_marking_available" value="0"
                                                                        required
                                                                        @if (isset($application) && $application->depth_marking_available == 0) checked @endif>
                                                                    <span class="form-check-label">No</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mb-3">
                                                            <label>3.) Medical Facility Available<br />चिकित्सा सुविधा
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
                                                    <div class="col-md-3">
                                                        <div class="form-group mb-3">
                                                            <label>4.) Life Jackets Available<br />लाईफ सेविंग जैकेट है अथवा
                                                                नही</label>
                                                            <div class="form-control">
                                                                <label class="form-check-inline ms-2 me-2 mb-0">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="life_jacket_available" value="1"
                                                                        required
                                                                        @if (isset($application) && $application->life_jacket_available == 1) checked @endif>
                                                                    <span class="form-check-label">Yes</span>
                                                                </label>
                                                                <label class="form-check-inline mb-0">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="life_jacket_available" value="0"
                                                                        required
                                                                        @if (isset($application) && $application->life_jacket_available == 0) checked @endif>
                                                                    <span class="form-check-label">No</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mb-3">
                                                            <label>5.) Whether There is a Register of Swimming Persons or
                                                                Not<br />स्वीमिंग करने वाले व्यक्तियों का रजिस्टर है अथवा
                                                                नहीं </label>
                                                            <div class="form-control">
                                                                <label class="form-check-inline ms-2 me-2 mb-0">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="swimmer_register_available" value="1"
                                                                        required
                                                                        @if (isset($application) && $application->swimmer_register_available == 1) checked @endif>
                                                                    <span class="form-check-label">Yes</span>
                                                                </label>
                                                                <label class="form-check-inline mb-0">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="swimmer_register_available" value="0"
                                                                        required
                                                                        @if (isset($application) && $application->swimmer_register_available == 0) checked @endif>
                                                                    <span class="form-check-label">No</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mb-3">
                                                            <label>6.) Nearest Hospital Name <br />स्वीमिंग पूल के नजदीकी
                                                                अस्पताल का नाम </label>
                                                            <input
                                                                onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || event.charCode === 32 || event.charCode === 45)"
                                                                pattern="^[A-Za-z -]+$" type="text"
                                                                name="nearest_hospital_name" class="form-control" required
                                                                value="{{ isset($application->nearest_hospital_name) ? $application->nearest_hospital_name : '' }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mb-3">
                                                            <label>7.) Nearest Hospital Number <br />स्वीमिंग पूल के नजदीकी
                                                                अस्पताल का दूरभाष नम्बर</label>
                                                            <input maxlength="10" minlength="10" pattern="^[6-9]\d{9}$"
                                                                onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                                                                type="text" name="nearest_hospital_number"
                                                                class="form-control" required
                                                                value="{{ isset($application->nearest_hospital_number) ? $application->nearest_hospital_number : '' }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mb-3">
                                                            <label>8.) Water Testing Kit<br />पानी की जाँच की किट है अथवा
                                                                नहीं </label>
                                                            <div class="form-control">
                                                                <label class="form-check-inline ms-2 me-2 mb-0">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="water_testing_kit_available" value="1"
                                                                        required
                                                                        @if (isset($application) && $application->water_testing_kit_available == 1) checked @endif>
                                                                    <span class="form-check-label">Yes</span>
                                                                </label>
                                                                <label class="form-check-inline mb-0">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="water_testing_kit_available" value="0"
                                                                        required
                                                                        @if (isset($application) && $application->water_testing_kit_available == 0) checked @endif>
                                                                    <span class="form-check-label">No</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mb-3">
                                                            <label>9.) Board Displaying Pool Rules<br />स्विमिंग पूल प्रयोग
                                                                करने वाले नियमों की जानकारी का बोर्ड लगा है अथवा
                                                                नहीं</label>
                                                            <div class="form-control">
                                                                <label class="form-check-inline ms-2 me-2 mb-0">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="pool_rules_board_available" value="1"
                                                                        required
                                                                        @if (isset($application) && $application->pool_rules_board_available == 1) checked @endif>
                                                                    <span class="form-check-label">Yes</span>
                                                                </label>
                                                                <label class="form-check-inline mb-0">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="pool_rules_board_available" value="0"
                                                                        required
                                                                        @if (isset($application) && $application->pool_rules_board_available == 0) checked @endif>
                                                                    <span class="form-check-label">No</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mb-3">
                                                            <label>10.) Artificial Respiration Equipment<br />कृत्रिम सास
                                                                लेने सम्बन्धी उपकरण है अथवा नहीं</label>
                                                            <div class="form-control">
                                                                <label class="form-check-inline ms-2 me-2 mb-0">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="respiration_equipment_available"
                                                                        value="1" required
                                                                        @if (isset($application) && $application->respiration_equipment_available == 1) checked @endif>
                                                                    <span class="form-check-label">Yes</span>
                                                                </label>
                                                                <label class="form-check-inline mb-0">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="respiration_equipment_available"
                                                                        value="0" required
                                                                        @if (isset($application) && $application->respiration_equipment_available == 0) checked @endif>
                                                                    <span class="form-check-label">No</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mb-3">
                                                            <label>11.) Safety Hook/Rope<br />सेफ्टी हुक/रस्सी है अथवा
                                                                नहीं</label>
                                                            <div class="form-control">
                                                                <label class="form-check-inline ms-2 me-2 mb-0">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="safety_hook_rope_available" value="1"
                                                                        required
                                                                        @if (isset($application) && $application->safety_hook_rope_available == 1) checked @endif>
                                                                    <span class="form-check-label">Yes</span>
                                                                </label>
                                                                <label class="form-check-inline mb-0">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="safety_hook_rope_available" value="0"
                                                                        required
                                                                        @if (isset($application) && $application->safety_hook_rope_available == 0) checked @endif>
                                                                    <span class="form-check-label">No</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mb-3">
                                                            <label>12.) Life-Saving Equipment<br />जीवन रक्षक उपकरण है अथवा
                                                                नहीं</label>
                                                            <div class="form-control">
                                                                <label class="form-check-inline ms-2 me-2 mb-0">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="life_saving_equipment_available"
                                                                        value="1" required
                                                                        @if (isset($application) && $application->life_saving_equipment_available == 1) checked @endif>
                                                                    <span class="form-check-label">Yes</span>
                                                                </label>
                                                                <label class="form-check-inline mb-0">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="life_saving_equipment_available"
                                                                        value="0" required
                                                                        @if (isset($application) && $application->life_saving_equipment_available == 0) checked @endif>
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
                                                            <input type="text" name="operating_hours"
                                                                class="form-control" required
                                                                value="{{ isset($application->operating_hours) ? $application->operating_hours : '' }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mb-3">
                                                            <label>2.) Applicant's Name<br />आवेदन कर्ता का नाम</label>
                                                            <input type="text"
                                                                onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || event.charCode === 32 || event.charCode === 45)"
                                                                pattern="^[A-Za-z -]+$" name="applicant_name"
                                                                class="form-control" required
                                                                value="{{ isset($application->applicant_name) ? $application->applicant_name : '' }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mb-3">
                                                            <label>3.) Applicant's Address<br />आवेदन कर्ता का पता </label>
                                                            <input type="text"
                                                                onkeypress="return /[A-Za-z0-9 ,.-]/.test(String.fromCharCode(event.charCode))"
                                                                pattern="^[A-Za-z0-9 ,.-]{5,100}$"
                                                                name="applicant_address" class="form-control" required
                                                                value="{{ isset($application->applicant_address) ? $application->applicant_address : '' }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mb-3">
                                                            <label>4.) Applicant's Mobile Number<br />आवेदन कर्ता का मोबाइल
                                                                नंबर </label>
                                                            <input type="text" maxlength="10" minlength="10"
                                                                pattern="^[6-9]\d{9}$"
                                                                onkeypress="return event.charCode >= 48 && event.charCode <= 57"
                                                                name="applicant_mobile" class="form-control" required
                                                                value="{{ isset($application->applicant_mobile) ? $application->applicant_mobile : '' }}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <h5 class="subheading">
                                                            J. Supporting Documents and Declarations/सहायक दस्तावेज़ और
                                                            घोषणाएँ
                                                        </h5>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mb-3">
                                                            <label>1.) Copy of Previous Year's NOC<br />पिछले वर्ष की
                                                                अनापत्ति प्रमाण-पत्र की छायाप्रति</label>
                                                            <div class="input-group">



                                                                <input type="file" onchange="getfileext25(this,11)"
                                                                    id="File11" name="previous_year_noc"
                                                                    class="form-control"
                                                                    @empty($application) required @endempty>


                                                                @if (isset($application) && $application->previous_year_noc)
                                                                    <a href="{{ asset('public/private_coaching_storage/previous_year_noc/' . $application->previous_year_noc) }}"
                                                                        class="btn btn-secondary">View</a>
                                                                @endif
                                                            </div>
                                                            <span class="note">(File Format: pdf, jpeg, jpg | Max File
                                                                Size: 2 MB)</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mb-3">
                                                            <label>2.) Water Testing Report<br />पानी की टेस्टिंग
                                                                रिपोर्ट</label>
                                                            <div class="input-group">



                                                                <input type="file" onchange="getfileext25(this,12)"
                                                                    id="File12" name="water_testing_report"
                                                                    class="form-control"
                                                                    @empty($application) required @endempty>


                                                                @if (isset($application) && $application->water_testing_report)
                                                                    <a href="{{ asset('public/private_coaching_storage/water_testing_report/' . $application->water_testing_report) }}"
                                                                        class="btn btn-secondary">View</a>
                                                                @endif
                                                            </div>
                                                            <span class="note">(File Format: pdf, jpeg, jpg | Max File
                                                                Size: 2 MB)</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mb-3">
                                                            <label>3.1)Photo of Pool<br />तरणताल की फोटो</label>
                                                            <div class="input-group">


                                                                <input type="file" onchange="getfileext11(this,13)"
                                                                    id="File13" name="photo_of_pool_1"
                                                                    class="form-control"
                                                                    @empty($application) required @endempty>


                                                                @if (isset($application) && $application->photo_of_pool_1)
                                                                    <a href="{{ asset('public/private_coaching_storage/photo_of_pool_1/' . $application->photo_of_pool_1) }}"
                                                                        class="btn btn-secondary">View</a>
                                                                @endif
                                                            </div>
                                                            <span class="note">(File Format:  jpeg, jpg | Max File
                                                                Size: 2 MB)</span>
                                                        </div>
                                                    </div>

                                                    <div class="col-md-3">
                                                        <div class="form-group mb-3">
                                                            <label>3.2)Photos of Pool<br />तरणताल की फोटो</label>
                                                            <div class="input-group">



                                                                <input type="file" onchange="getfileext11(this,14)"
                                                                    id="File14" name="photo_of_pool_2"
                                                                    class="form-control"
                                                                    @empty($application) required @endempty>


                                                                @if (isset($application) && $application->photo_of_pool_2)
                                                                    <a href="{{ asset('public/private_coaching_storage/photo_of_pool_2/' . $application->photo_of_pool_2) }}"
                                                                        class="btn btn-secondary">View</a>
                                                                @endif
                                                            </div>
                                                            <span class="note">(File Format:  jpeg, jpg | Max File
                                                                Size: 2 MB)</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mb-3">
                                                            <label>3.3)Photos of Pool<br />तरणताल की फोटो</label>
                                                            <div class="input-group">


                                                                <input type="file" onchange="getfileext11(this,15)"
                                                                    id="File15" name="photo_of_pool_3"
                                                                    class="form-control"
                                                                    @empty($application) required @endempty>


                                                                @if (isset($application) && $application->photo_of_pool_3)
                                                                    <a href="{{ asset('public/private_coaching_storage/photo_of_pool_3/' . $application->photo_of_pool_3) }}"
                                                                        class="btn btn-secondary">View</a>
                                                                @endif
                                                            </div>
                                                            <span class="note">(File Format:  jpeg, jpg | Max File
                                                                Size: 2 MB)</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mb-3">
                                                            <label>3.4)Photos of Pool<br />तरणताल की फोटो</label>
                                                            <div class="input-group">


                                                                <input type="file" onchange="getfileext11(this,16)"
                                                                    id="File16" name="photo_of_pool_4"
                                                                    class="form-control"
                                                                    @empty($application) required @endempty>


                                                                @if (isset($application) && $application->photo_of_pool_4)
                                                                    <a href="{{ asset('public/private_coaching_storage/photo_of_pool_4/' . $application->photo_of_pool_4) }}"
                                                                        class="btn btn-secondary">View</a>
                                                                @endif
                                                            </div>
                                                            <span class="note">(File Format:  jpeg, jpg | Max File
                                                                Size: 2 MB)</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mb-3">
                                                            <label>4.) Compliance Affidavit<br />अनुपालन शपथपत्र</label>
                                                            <div class="input-group">
                                                                <input type="file" onchange="getfileext25(this,17)"
                                                                    id="File17" name="affidavit_compliance"
                                                                    class="form-control"
                                                                    @empty($application) required @endempty>


                                                                @if (isset($application) && $application->affidavit_compliance)
                                                                    <a href="{{ asset('public/private_coaching_storage/affidavit_compliance/' . $application->affidavit_compliance) }}"
                                                                        class="btn btn-secondary">View</a>
                                                                @endif
                                                            </div>
                                                            <span class="note">(File Format: pdf, jpeg, jpg | Max File
                                                                Size: 2 MB)</span>
                                                        </div>
                                                    </div>
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
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>



    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        $(document).ready(function() {
            // Toggle instructor content visibility based on radio selection
            $('input[name="has_instructor"]').change(function() {
                if ($('#instructorYes').is(':checked')) {
                    $('#instructorContent').show();



                    $('.instructor-block').find('input').each(function() {
                        $(this).attr('required', true);
                    });
                } else {
                    $('#instructorContent').hide();

                    $('.instructor-block').find('input').each(function() {
                        $(this).removeAttr('required');
                    });
                }
            });

            // Toggle lifeguard content visibility based on radio selection
            $('input[name="has_life_guard"]').change(function() {
                if ($('#lifeguardYes').is(':checked')) {
                    $('#lifeguardContent').show();

                    $('.lifeguard-block').find('input').each(function() {
                        $(this).attr('required', true);
                    });
                } else {
                    $('#lifeguardContent').hide();

                    $('.lifeguard-block').find('input').each(function() {
                        $(this).removeAttr('required');
                    });
                }
            });

            // Instructor section dynamic behavior
            let instructorCount = 1;
            $('#addInstructorBtn').click(function() {
                instructorCount++;
                const $original = $('.instructor-block:first');
                const $clone = $original.clone();

                // Clear input values
                $clone.find('input').val('');

                $clone.find('.btn-outline-secondary').remove();
                // Replace the add button with a remove button if it's not the first one
                $clone.find('#addInstructorBtn')
                    .replaceWith(
                        '<button type="button" class="btn btn-danger removeInstructorBtn"><i class="fa fa-trash me-1"></i></button>'
                        );

                // Ensure file inputs are required for new blocks
                $clone.find('input[type="file"]').prop('required', true);

                $('#instructorWrapper').append($clone);
                // Mobile number validation

                const mobileFields =
                    'input[name="owner_mobile"], input[name="nearest_hospital_contact_number"], input[name="manager_mobile"], input[name="applicant_mobile"], input[name="instructor_mobile[]"], input[name="lifeguard_mobile[]"]';

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
                            "Please enter a valid 10-digit mobile number starting with 6, 7, 8, or 9."
                            );
                        $(this).focus().val('');
                    }
                });
            });

            $(document).on('click', '.removeInstructorBtn', function() {
                $(this).closest('.instructor-block').remove();
            });

            // Lifeguard section dynamic behavior
            let lifeguardCount = 1;
            $('#addLifeguardBtn').click(function() {
                lifeguardCount++;
                const $original = $('.lifeguard-block:first');
                const $clone = $original.clone();

                // Clear input values
                $clone.find('input').val('');
                $clone.find('.btn-outline-secondary').remove();
                // Replace the add button with a remove button if it's not the first one
                $clone.find('#addLifeguardBtn')
                    .replaceWith(
                        '<button type="button" class="btn btn-danger removeLifeguardBtn"><i class="fa fa-trash me-1"></i></button>'
                        );

                // Ensure file inputs are required for new blocks
                $clone.find('input[type="file"]').prop('required', true);
                $('#lifeguardWrapper').append($clone);
                // Mobile number validation

                const mobileFields =
                    'input[name="owner_mobile"], input[name="nearest_hospital_contact_number"], input[name="manager_mobile"], input[name="applicant_mobile"], input[name="instructor_mobile[]"], input[name="lifeguard_mobile[]"]';

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
                            "Please enter a valid 10-digit mobile number starting with 6, 7, 8, or 9."
                            );
                        $(this).focus().val('');
                    }
                });
            });

            $(document).on('click', '.removeLifeguardBtn', function() {
                $(this).closest('.lifeguard-block').remove();
            });
            // Mobile number validation

            const mobileFields =
                'input[name="owner_mobile"], input[name="nearest_hospital_contact_number"], input[name="manager_mobile"], input[name="applicant_mobile"], input[name="instructor_mobile[]"], input[name="lifeguard_mobile[]"]';

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


            $('#watersource').change(function() {
                if ($(this).val() === 'Other') {
                    $('.otherdiv').show();
                    $('input[name="other"]').attr('required', true); // Set required attribute
                } else {
                    $('.otherdiv').hide();
                    $('input[name="other"]').removeAttr('required'); // Remove required attribute
                }
            });


            $('input[name="available_filter_plant"]').change(function() {
                if ($('#filterPlantYes').is(':checked')) {
                    $('.filterplant').show();
                    $('input[name="filter_plant_capacity"]').attr('required',
                    true); // Set required attribute
                } else {
                    $('.filterplant').hide();
                    $('input[name="filter_plant_capacity"]').removeAttr(
                    'required'); // Remove required attribute
                }
            });

        });
    </script>

@endsection
