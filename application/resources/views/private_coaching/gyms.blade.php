@extends('layouts.private_coaching_auth_layout')
@section('content')
    <div class="container-fluid pagecontentbody">
        <div class="pagebody removebg-color">
            <div class="row">
                <div class="col-12">
                    <div class="pageheader" id="menu-margin">
                        <div class="row">
                            <div class="col-md-10">
                                <h4 class="mb-0">Gym Operation Application Form</h4>
                                @if (isset($application) && $application->id)
                                    <small>Editing existing application</small>
                                @endif
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
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bhoechie-tab">
                                <div class="bhoechie-tab-content active">

                                    <form
                                        action="@if (isset($application)) {{ route('gyms_form_store', $application->id) }}@else {{ route('gyms_form_store') }} @endif"
                                        method="post" class="needs-validation" id="submitform" novalidate
                                        enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-scroll">
                                            <div class="nano-content">
                                                <div class="row">
                                                    <div class="col-md-10">
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <h5 class="subheading">A. Registration Details/पंजीकरण के
                                                                    विवरण</h5>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group mb-3">
                                                                    <label class="placeholder">
                                                                        1.) Full Name/पूरा नाम <span
                                                                            class="text-danger">*</span>
                                                                    </label>
                                                                    <input type="text" class="form-control"
                                                                        value="{{ Auth::guard('PrivateCoaching')->user()->name }}"
                                                                        disabled>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group mb-3">
                                                                    <label class="placeholder">
                                                                        2.) Designation/पदनाम <span
                                                                            class="text-danger">*</span>
                                                                    </label>
                                                                    <input type="text" class="form-control"
                                                                        value="{{ Auth::guard('PrivateCoaching')->user()->designation }}"
                                                                        disabled>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group mb-3">
                                                                    <label class="placeholder">
                                                                        3.) Email ID/ईमेल आईडी <span
                                                                            class="text-danger">*</span>
                                                                    </label>
                                                                    <input type="text" class="form-control"
                                                                        value="{{ Auth::guard('PrivateCoaching')->user()->email }}"
                                                                        disabled>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group mb-3">
                                                                    <label class="placeholder">
                                                                        4.) Mobile No./मोबाइल नंबर <span
                                                                            class="text-danger">*</span>
                                                                    </label>
                                                                    <input type="text" class="form-control"
                                                                        value="{{ Auth::guard('PrivateCoaching')->user()->mobile }}"
                                                                        disabled>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="row">
                                                            <div class="col-md-12">
                                                                <h5 class="subheading">B. Gym Details/जिम का विवरण</h5>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group mb-3">
                                                                    <label class="placeholder">1.) Gym Owner's Name<br />जिम
                                                                        के मालिक का नाम <span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="text" class="form-control"
                                                                        name="owner_name"
                                                                        value="{{ $application->owner_name ?? old('owner_name') }}"
                                                                        required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group mb-3">
                                                                    <label>2.) Gym Owner's Address<br />जिम के मालिक का पता
                                                                        <span class="text-danger">*</span></label>
                                                                    <input type="text" class="form-control"
                                                                        name="owner_address"
                                                                        value="{{ $application->owner_address ?? old('owner_address') }}"
                                                                        required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group mb-3">
                                                                    <label class="placeholder">3.) Mobile Number<br />मोबाइल
                                                                        नंबर <span class="text-danger">*</span></label>
                                                                    <input type="text" class="form-control"
                                                                        name="owner_mobile"
                                                                        value="{{ $application->owner_mobile ?? old('owner_mobile') }}"
                                                                        required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group mb-3">
                                                                    <label class="placeholder">4.)
                                                                        Organization/Academy/Others Operating the
                                                                        Gym<br />जिम संचालन करने वाली संस्था/एकेडमी/अन्य
                                                                        <span class="text-danger">*</span></label>
                                                                    <input type="text" class="form-control"
                                                                        name="operating_entity"
                                                                        value="{{ $application->operating_entity ?? old('operating_entity') }}"
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
                                                                    <label>1.) Manager's Name<br />प्रबन्धक का नाम <span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="text" class="form-control"
                                                                        name="manager_name"
                                                                        value="{{ $application->manager_name ?? old('manager_name') }}"
                                                                        required />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group mb-3">
                                                                    <label>2.) Manager's Address<br />प्रबन्धक का पता <span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="text" class="form-control"
                                                                        name="manager_address"
                                                                        value="{{ $application->manager_address ?? old('manager_address') }}"
                                                                        required />
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group mb-3">
                                                                    <label class="placeholder">3.) Mobile
                                                                        Number<br />मोबाइल नंबर <span
                                                                            class="text-danger">*</span></label>
                                                                    <input type="text" class="form-control"
                                                                        name="manager_mobile"
                                                                        value="{{ $application->manager_mobile ?? old('manager_mobile') }}"
                                                                        required>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-3">
                                                                <div class="form-group mb-3">
                                                                    <label class="placeholder">4.) Email ID<br />ईमेल आईडी
                                                                        <span class="text-danger">*</span></label>
                                                                    <input type="email" class="form-control"
                                                                        name="manager_email"
                                                                        value="{{ $application->manager_email ?? old('manager_email') }}"
                                                                        required>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <div class="form-group">
                                                            <label>Photo/फोटो <span class="text-danger">*</span></label>
                                                            @if (isset($application) && $application->photo)
                                                                <img src="{{ asset('public/private_coaching_storage/photo/' . $application->photo) }}"
                                                                    style="height: 180px; width: 100%; border: 1px solid #ccc; padding: 5px; margin-bottom: 5px;" />
                                                            @else
                                                                <div
                                                                    style="height: 180px; width: 100%; border: 1px solid #ccc; padding: 5px; margin-bottom: 5px; background-color: #f8f9fa;">
                                                                </div>
                                                            @endif
                                                            <input type="file" onchange="getfileext11(this.value,1)"
                                                                id="File1" class="form-control" name="photo"
                                                                accept="image/jpeg,image/jpg"
                                                                {{ !isset($application) ? 'required' : '' }} />
                                                            <small class="note">(File Format: jpeg, jpg | Max File Size:
                                                                2 MB)</small>
                                                        </div>
                                                        <div class="form-group">
                                                            <label>Signature/हस्ताक्षर <span
                                                                    class="text-danger">*</span></label>
                                                            @if (isset($application) && $application->signature)
                                                                <img src="{{ asset('public/private_coaching_storage/signature/' . $application->signature) }}"
                                                                    style="height: 50px; width: 100%; border: 1px solid #ccc; padding: 5px; margin-bottom: 5px;" />
                                                            @else
                                                                <div
                                                                    style="height: 50px; width: 100%; border: 1px solid #ccc; padding: 5px; margin-bottom: 5px; background-color: #f8f9fa;">
                                                                </div>
                                                            @endif
                                                            <input type="file" onchange="getfileext11(this.value,2)"
                                                                id="File2" class="form-control" name="signature"
                                                                accept="image/jpeg,image/jpg"
                                                                {{ !isset($application) ? 'required' : '' }} />
                                                            <small class="note">(File Format: jpeg, jpg | Max File Size:
                                                                2 MB)</small>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Trainer Section -->
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <h5 class="subheading">
                                                            D. If there is a Trainer/प्रशिक्षक यदि है तो
                                                            <label class="form-check form-check-inline ms-2 me-2">
                                                                <input class="form-check-input" type="radio" required
                                                                    name="has_trainer" id="hasTrainerYes" value="1"
                                                                    {{ (isset($application) && $application->has_trainer == 1) || old('has_trainer') == '1' ? 'checked' : '' }}>
                                                                <span class="form-check-label">Yes</span>
                                                            </label>
                                                            <label class="form-check form-check-inline">
                                                                <input class="form-check-input" type="radio"
                                                                    name="has_trainer" id="hasTrainerNo" value="0"
                                                                    {{ (isset($application) && $application->has_trainer == 0) || old('has_trainer') == '0' ? 'checked' : '' }}>
                                                                <span class="form-check-label">No</span>
                                                            </label>
                                                        </h5>
                                                    </div>
                                                </div>

                                                <div id="trainerSection"
                                                    style="{{ (isset($application) && $application->has_trainer == 1) || old('has_trainer') == '1' ? '' : 'display:none;' }}">
                                                    @if (isset($application) && $trainers->count() > 0)
                                                        @foreach ($trainers as $index => $trainer)
                                                            <div class="trainer-entry border p-3 mb-3">
                                                                <div class="row">
                                                                    <div class="col-md-3">
                                                                        <div class="form-group mb-3">
                                                                            <label class="placeholder">1.) Trainer's
                                                                                Name<br />प्रशिक्षक का नाम <span
                                                                                    class="text-danger">*</span></label>
                                                                            <input type="text" class="form-control"
                                                                                name="trainer_name[]"
                                                                                value="{{ $trainer->name }}" required />
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group mb-3">
                                                                            <label class="placeholder">2.) Trainer's
                                                                                Address<br />प्रशिक्षक का पता <span
                                                                                    class="text-danger">*</span></label>
                                                                            <input type="text" class="form-control"
                                                                                name="trainer_address[]"
                                                                                value="{{ $trainer->address }}"
                                                                                required />
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group mb-3">
                                                                            <label class="placeholder">3.) Mobile
                                                                                Number<br />मोबाइल नंबर <span
                                                                                    class="text-danger">*</span></label>
                                                                            <input type="text" class="form-control"
                                                                                name="trainer_mobile[]"
                                                                                value="{{ $trainer->mobile }}" required />
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group mb-3">
                                                                            <label>4.) Trainer's Photo<br />प्रशिक्षक का
                                                                                फोटो <span
                                                                                    class="text-danger">*</span></label>
                                                                            <div class="input-group">
                                                                                <input type="file" class="form-control"
                                                                                    name="trainer_photo[]"
                                                                                    accept="image/jpeg,image/jpg" />
                                                                                @if ($trainer->photo)
                                                                                    <input type="hidden"
                                                                                        name="existing_trainer_photo[]"
                                                                                        value="{{ $trainer->photo }}">
                                                                                    <a href="{{ asset('public/private_coaching_storage/trainer_photo/' . $trainer->photo) }}"
                                                                                        target="_blank"
                                                                                        class="btn btn-secondary">View</a>
                                                                                @endif
                                                                            </div>
                                                                            <small class="note">(File Format: jpeg, jpg |
                                                                                Max File Size: 2 MB)</small>
                                                                        </div>
                                                                    </div>
                                                                    <div class="col-md-3">
                                                                        <div class="form-group mb-3">
                                                                            <label>5.) Trainer's
                                                                                Certification<br />प्रशिक्षक का प्रमाण पत्र
                                                                                <span class="text-danger">*</span></label>
                                                                            <div class="input-group">
                                                                                <input type="file" class="form-control"
                                                                                    name="trainer_certificate[]"
                                                                                    accept="image/jpeg,image/jpg,application/pdf" />
                                                                                @if ($trainer->certificate)
                                                                                    <input type="hidden"
                                                                                        name="existing_trainer_certificate[]"
                                                                                        value="{{ $trainer->certificate }}">
                                                                                    <a href="{{ asset('public/private_coaching_storage/trainer_certificate/' . $trainer->certificate) }}"
                                                                                        target="_blank"
                                                                                        class="btn btn-secondary">View</a>
                                                                                @endif
                                                                            </div>
                                                                            <small class="note">(File Format: pdf, jpeg,
                                                                                jpg | Max File Size: 2 MB)</small>
                                                                        </div>
                                                                    </div>
                                                                    @if (!$loop->first)
                                                                        <div class="col-md-12 text-end">
                                                                            <button type="button"
                                                                                class="btn btn-danger btn-sm remove-trainer">Remove
                                                                                Trainer</button>
                                                                        </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        @endforeach
                                                    @else
                                                        <div class="trainer-entry border p-3 mb-3">
                                                            <div class="row">
                                                                <div class="col-md-3">
                                                                    <div class="form-group mb-3">
                                                                        <label class="placeholder">1.) Trainer's
                                                                            Name<br />प्रशिक्षक का नाम <span
                                                                                class="text-danger">*</span></label>
                                                                        <input type="text" class="form-control"
                                                                            name="trainer_name[]"
                                                                            value="{{ old('trainer_name.0') }}"
                                                                            required />
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group mb-3">
                                                                        <label class="placeholder">2.) Trainer's
                                                                            Address<br />प्रशिक्षक का पता <span
                                                                                class="text-danger">*</span></label>
                                                                        <input type="text" class="form-control"
                                                                            name="trainer_address[]"
                                                                            value="{{ old('trainer_address.0') }}"
                                                                            required />
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group mb-3">
                                                                        <label class="placeholder">3.) Mobile
                                                                            Number<br />मोबाइल नंबर <span
                                                                                class="text-danger">*</span></label>
                                                                        <input type="text" class="form-control"
                                                                            name="trainer_mobile[]"
                                                                            value="{{ old('trainer_mobile.0') }}"
                                                                            required />
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group mb-3">
                                                                        <label>4.) Trainer's Photo<br />प्रशिक्षक का फोटो
                                                                            <span class="text-danger">*</span></label>
                                                                        <div class="input-group">
                                                                            <input type="file" class="form-control"
                                                                                name="trainer_photo[]"
                                                                                accept="image/jpeg,image/jpg" required />
                                                                        </div>
                                                                        <small class="note">(File Format: jpeg, jpg | Max
                                                                            File Size: 2 MB)</small>
                                                                    </div>
                                                                </div>
                                                                <div class="col-md-3">
                                                                    <div class="form-group mb-3">
                                                                        <label>5.) Trainer's Certification<br />प्रशिक्षक का
                                                                            प्रमाण पत्र <span
                                                                                class="text-danger">*</span></label>
                                                                        <div class="input-group">
                                                                            <input type="file" class="form-control"
                                                                                name="trainer_certificate[]"
                                                                                accept="image/jpeg,image/jpg,application/pdf"
                                                                                required />
                                                                        </div>
                                                                        <small class="note">(File Format: pdf, jpeg, jpg
                                                                            | Max File Size: 2 MB)</small>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    @endif

                                                    <button type="button" class="btn btn-primary btn-sm mb-3"
                                                        id="addTrainer">Add Another Trainer</button>
                                                </div>

                                                <!-- No Objection Certificates -->
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <h5 class="subheading">
                                                            E. No Objection/Approval Certificates/अनापत्ति/अनुमति प्रमाण
                                                            पत्र
                                                        </h5>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group mb-3">
                                                            <label>1.) Copies of No Objection/Approval Certificates Obtained
                                                                from District Administration & Other Relevant Departments
                                                                for Gym Construction/जिम के निर्माण हेतु जिला प्रशासन एवं
                                                                अन्य सम्बंधित विभागों से प्राप्त की गयी अनापत्ति / अनुमति
                                                                प्रमाण पत्र की छायाप्रतियाँ <span
                                                                    class="text-danger">*</span></label>
                                                            <div class="input-group">
                                                                <input type="file" onchange="getfileext25(this,7)"
                                                                    id="File7" class="form-control"
                                                                    name="noc_certificate"
                                                                    accept="image/jpeg,image/jpg,application/pdf"
                                                                    {{ !isset($application) ? 'required' : '' }} />
                                                                @if (isset($application) && $application->noc_certificate)
                                                                    <a href="{{ asset('public/private_coaching_storage/noc_certificate/' . $application->noc_certificate) }}"
                                                                        target="_blank" class="btn btn-secondary">View</a>
                                                                @endif
                                                            </div>
                                                            <small class="note">(File Format: pdf, jpeg, jpg | Max File
                                                                Size: 2 MB)</small>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Gym Construction Details -->
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <h5 class="subheading">
                                                            F. Gym Construction Details/जिम निर्माण विवरण
                                                        </h5>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mb-3">
                                                            <label>1.) Copy of Gym Layout Plan<br />जिम के नक्शे की
                                                                छायाप्रति <span class="text-danger">*</span></label>
                                                            <div class="input-group">
                                                                <input type="file" onchange="getfileext25(this,8)"
                                                                    id="File8" class="form-control"
                                                                    name="gym_layout_plan_copy"
                                                                    accept="image/jpeg,image/jpg,application/pdf"
                                                                    {{ !isset($application) ? 'required' : '' }} />
                                                                @if (isset($application) && $application->gym_layout_plan_copy)
                                                                    <a href="{{ asset('public/private_coaching_storage/gym_layout_plan_copy/' . $application->gym_layout_plan_copy) }}"
                                                                        target="_blank" class="btn btn-secondary">View</a>
                                                                @endif
                                                            </div>
                                                            <small class="note">(File Format: pdf, jpeg, jpg | Max File
                                                                Size: 2 MB)</small>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mb-3">
                                                            <label class="placeholder">2.) Number of Gym Stations<br />जिम
                                                                कितने स्टेशन का है <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="number" min="1" class="form-control"
                                                                name="gym_station_count"
                                                                value="{{ $application->gym_station_count ?? old('gym_station_count') }}"
                                                                required />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mb-3">
                                                            <label class="placeholder">3.) Gym Size (Length)<br />जिम का
                                                                साइज (लम्बाई) <span class="text-danger">*</span></label>
                                                            <input type="number" min="1" step="0.001"
                                                                class="form-control" name="gym_length"
                                                                value="{{ $application->gym_length ?? old('gym_length') }}"
                                                                required />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mb-3">
                                                            <label class="placeholder">4.) Gym Size (Width)<br />जिम का
                                                                साइज (चौड़ाई) <span class="text-danger">*</span></label>
                                                            <input type="number" min="1" step="0.001"
                                                                class="form-control" name="gym_width"
                                                                value="{{ $application->gym_width ?? old('gym_width') }}"
                                                                required />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label>5.) Details of Safety Equipment in the Gym<br />जिम में
                                                                सुरक्षा हेतु उपकरण का विवरण <span
                                                                    class="text-danger">*</span></label>
                                                            <textarea class="form-control" name="gym_safety_equipment_details" rows="3" required>{{ $application->gym_safety_equipment_details ?? old('gym_safety_equipment_details') }}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group mb-3">
                                                            <label>6.) Gym Entrance (Gate) Details<br />जिम आवागमन (गेट) का
                                                                विवरण <span class="text-danger">*</span></label>
                                                            <textarea class="form-control" name="gym_entrance_details" rows="3" required>{{ $application->gym_entrance_details ?? old('gym_entrance_details') }}</textarea>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Facility and Equipment Details -->
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <h5 class="subheading">
                                                            G. Facility and Equipment Details/सुविधा और उपकरण का विवरण
                                                        </h5>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label>1.) Is Medical Facility Available?<br />चिकित्सा सुविधा
                                                                उपलब्ध है अथवा नहीं <span
                                                                    class="text-danger">*</span></label>
                                                            <div class="form-control">
                                                                <label class="form-check-inline ms-2 me-2 mb-0">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="medical_facility_available" value="1"
                                                                        {{ (isset($application) && $application->medical_facility_available == 1) || old('medical_facility_available') == '1' ? 'checked' : '' }}
                                                                        required>
                                                                    <span class="form-check-label">Yes</span>
                                                                </label>
                                                                <label class="form-check-inline mb-0">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="medical_facility_available" value="0"
                                                                        {{ (isset($application) && $application->medical_facility_available == 0) || old('medical_facility_available') == '0' ? 'checked' : '' }}>
                                                                    <span class="form-check-label">No</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label>2.) Is a First Aid Box Available in the Gym?<br />जिम में
                                                                फर्स्ट एड बॉक्स है अथवा नहीं <span
                                                                    class="text-danger">*</span></label>
                                                            <div class="form-control">
                                                                <label class="form-check-inline ms-2 me-2 mb-0">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="first_aid_box_available" value="1"
                                                                        {{ (isset($application) && $application->first_aid_box_available == 1) || old('first_aid_box_available') == '1' ? 'checked' : '' }}
                                                                        required>
                                                                    <span class="form-check-label">Yes</span>
                                                                </label>
                                                                <label class="form-check-inline mb-0">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="first_aid_box_available" value="0"
                                                                        {{ (isset($application) && $application->first_aid_box_available == 0) || old('first_aid_box_available') == '0' ? 'checked' : '' }}>
                                                                    <span class="form-check-label">No</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label>3.) Is there a Register for Gym Users?<br />जिम करने वाले
                                                                व्यक्तियों का रजिस्टर है अथवा नहीं <span
                                                                    class="text-danger">*</span></label>
                                                            <div class="form-control">
                                                                <label class="form-check-inline ms-2 me-2 mb-0">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="user_register_available" value="1"
                                                                        {{ (isset($application) && $application->user_register_available == 1) || old('user_register_available') == '1' ? 'checked' : '' }}
                                                                        required>
                                                                    <span class="form-check-label">Yes</span>
                                                                </label>
                                                                <label class="form-check-inline mb-0">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="user_register_available" value="0"
                                                                        {{ (isset($application) && $application->user_register_available == 0) || old('user_register_available') == '0' ? 'checked' : '' }}>
                                                                    <span class="form-check-label">No</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label>4.) Nearest Hospital's Name<br />जिम के नजदीकी अस्पताल का
                                                                नाम <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" required
                                                                name="nearest_hospital_name"
                                                                value="{{ $application->nearest_hospital_name ?? old('nearest_hospital_name') }}" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label>5.) Nearest Hospital's Phone Number<br />जिम के नजदीकी
                                                                अस्पताल का दूरभाष नंबर <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" class="form-control" required
                                                                name="nearest_hospital_contact_number"
                                                                value="{{ $application->nearest_hospital_contact_number ?? old('nearest_hospital_contact_number') }}" />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label>6.) Is There a Board Displaying Rules for Equipment
                                                                Usage?<br />जिम में उपकरण प्रयोग करने वाले नियमों की जानकारी
                                                                का बोर्ड लगा है अथवा नहीं <span
                                                                    class="text-danger">*</span></label>
                                                            <div class="form-control">
                                                                <label class="form-check-inline ms-2 me-2 mb-0">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="equipment_rules_board" value="1"
                                                                        {{ (isset($application) && $application->equipment_rules_board == 1) || old('equipment_rules_board') == '1' ? 'checked' : '' }}
                                                                        required>
                                                                    <span class="form-check-label">Yes</span>
                                                                </label>
                                                                <label class="form-check-inline mb-0">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="equipment_rules_board" value="0"
                                                                        {{ (isset($application) && $application->equipment_rules_board == 0) || old('equipment_rules_board') == '0' ? 'checked' : '' }}>
                                                                    <span class="form-check-label">No</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label>7.) Is an Artificial Respiration Device
                                                                Available?<br />कृत्रिम साँस लेने सम्बन्धी उपकरण है अथवा
                                                                नहीं <span class="text-danger">*</span></label>
                                                            <div class="form-control">
                                                                <label class="form-check-inline ms-2 me-2 mb-0">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="respiration_device_available" value="1"
                                                                        {{ (isset($application) && $application->respiration_device_available == 1) || old('respiration_device_available') == '1' ? 'checked' : '' }}
                                                                        required>
                                                                    <span class="form-check-label">Yes</span>
                                                                </label>
                                                                <label class="form-check-inline mb-0">
                                                                    <input class="form-check-input" type="radio"
                                                                        name="respiration_device_available" value="0"
                                                                        {{ (isset($application) && $application->respiration_device_available == 0) || old('respiration_device_available') == '0' ? 'checked' : '' }}>
                                                                    <span class="form-check-label">No</span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Operational Details -->
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <h5 class="subheading">
                                                            H. Operational Details/परिचालन का विवरण
                                                        </h5>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mb-3">
                                                            <label>1.) Operating Hours<br />संचालन का समय <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" class="form-control"
                                                                name="operating_hours"
                                                                value="{{ $application->operating_hours ?? old('operating_hours') }}"
                                                                required />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mb-3">
                                                            <label>2.) Applicant's Name<br />आवेदन कर्ता का नाम <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" class="form-control"
                                                                name="applicant_name"
                                                                value="{{ $application->applicant_name ?? old('applicant_name') }}"
                                                                required />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mb-3">
                                                            <label>3.) Applicant's Address<br />आवेदन कर्ता का पता <span
                                                                    class="text-danger">*</span></label>
                                                            <input type="text" class="form-control"
                                                                name="applicant_address"
                                                                value="{{ $application->applicant_address ?? old('applicant_address') }}"
                                                                required />
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mb-3">
                                                            <label>4.) Applicant's Mobile Number<br />आवेदन कर्ता का मोबाइल
                                                                नंबर <span class="text-danger">*</span></label>
                                                            <input type="text" class="form-control"
                                                                name="applicant_mobile"
                                                                value="{{ $application->applicant_mobile ?? old('applicant_mobile') }}"
                                                                required />
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Supporting Documents -->
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <h5 class="subheading">
                                                            I. Supporting Documents and Declarations/सहायक दस्तावेज़ और
                                                            घोषणाएँ
                                                        </h5>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label>1.) Copy of Last Year's No Objection
                                                                Certificate<br />पिछले वर्ष की अनापत्ति प्रमाण-पत्र की
                                                                छायाप्रति <span class="text-danger">*</span></label>
                                                            <div class="input-group">
                                                                <input type="file" onchange="getfileext25(this,9)"
                                                                    id="File9" class="form-control"
                                                                    name="previous_year_noc"
                                                                    {{ !isset($application) ? 'required' : '' }}
                                                                    accept="image/jpeg,image/jpg,application/pdf" />
                                                                @if (isset($application) && $application->previous_year_noc)
                                                                    <a href="{{ asset('public/private_coaching_storage/previous_year_noc/' . $application->previous_year_noc) }}"
                                                                        target="_blank" class="btn btn-secondary">View</a>
                                                                @endif
                                                            </div>
                                                            <small class="note">(File Format: pdf, jpeg, jpg | Max File
                                                                Size: 2 MB)</small>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label>2.) Photo of Gym (1)<br />जिम की फोटो (1) <span
                                                                    class="text-danger">*</span></label>
                                                            <div class="input-group">
                                                                <input type="file"
                                                                    onchange="getfileext11(this.value,10)" id="File10"
                                                                    class="form-control" name="gym_photo_1"
                                                                    accept="image/jpeg,image/jpg"
                                                                    {{ !isset($application) ? 'required' : '' }} />
                                                                @if (isset($application) && $application->gym_photo_1)
                                                                    <a href="{{ asset('public/private_coaching_storage/gym_photo_1/' . $application->gym_photo_1) }}"
                                                                        target="_blank" class="btn btn-secondary">View</a>
                                                                @endif
                                                            </div>
                                                            <small class="note">(File Format: jpeg, jpg | Max File Size:
                                                                2 MB)</small>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label>3.) Photo of Gym (2)<br />जिम की फोटो (2) <span
                                                                    class="text-danger">*</span></label>
                                                            <div class="input-group">
                                                                <input type="file"
                                                                    onchange="getfileext11(this.value,11)" id="File11"
                                                                    class="form-control" name="gym_photo_2"
                                                                    accept="image/jpeg,image/jpg"
                                                                    {{ !isset($application) ? 'required' : '' }} />
                                                                @if (isset($application) && $application->gym_photo_2)
                                                                    <a href="{{ asset('public/private_coaching_storage/gym_photo_2/' . $application->gym_photo_2) }}"
                                                                        target="_blank" class="btn btn-secondary">View</a>
                                                                @endif
                                                            </div>
                                                            <small class="note">(File Format: jpeg, jpg | Max File Size:
                                                                2 MB)</small>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label>4.) Photo of Gym (3)<br />जिम की फोटो (3) <span
                                                                    class="text-danger">*</span></label>
                                                            <div class="input-group">
                                                                <input type="file"
                                                                    onchange="getfileext11(this.value,12)" id="File12"
                                                                    class="form-control" name="gym_photo_3"
                                                                    accept="image/jpeg,image/jpg"
                                                                    {{ !isset($application) ? 'required' : '' }} />
                                                                @if (isset($application) && $application->gym_photo_3)
                                                                    <a href="{{ asset('public/private_coaching_storage/gym_photo_3/' . $application->gym_photo_3) }}"
                                                                        target="_blank" class="btn btn-secondary">View</a>
                                                                @endif
                                                            </div>
                                                            <small class="note">(File Format: jpeg, jpg | Max File Size:
                                                                2 MB)</small>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label>5.) Photo of Gym (4)<br />जिम की फोटो (4) <span
                                                                    class="text-danger">*</span></label>
                                                            <div class="input-group">
                                                                <input type="file"
                                                                    onchange="getfileext11(this.value,13)" id="File13"
                                                                    class="form-control" name="gym_photo_4"
                                                                    accept="image/jpeg,image/jpg"
                                                                    {{ !isset($application) ? 'required' : '' }} />
                                                                @if (isset($application) && $application->gym_photo_4)
                                                                    <a href="{{ asset('public/private_coaching_storage/gym_photo_4/' . $application->gym_photo_4) }}"
                                                                        target="_blank" class="btn btn-secondary">View</a>
                                                                @endif
                                                            </div>
                                                            <small class="note">(File Format: jpeg, jpg | Max File Size:
                                                                2 MB)</small>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label>6.) Affidavit Regarding Compliance with Terms Mentioned
                                                                on the Back of the Form<br />फॉर्म के पीछे अंकित शर्तो का
                                                                अनुपालन सम्बन्धी शपथ पत्र <span
                                                                    class="text-danger">*</span></label>
                                                            <div class="input-group">
                                                                <input type="file" onchange="getfileext25(this,14)"
                                                                    id="File14" class="form-control"
                                                                    name="affidavit_compliance"
                                                                    accept="image/jpeg,image/jpg,application/pdf"
                                                                    {{ !isset($application) ? 'required' : '' }} />
                                                                @if (isset($application) && $application->affidavit_compliance)
                                                                    <a href="{{ asset('public/private_coaching_storage/affidavit_compliance/' . $application->affidavit_compliance) }}"
                                                                        target="_blank" class="btn btn-secondary">View</a>
                                                                @endif
                                                            </div>
                                                            <small class="note">(File Format: pdf, jpeg, jpg | Max File
                                                                Size: 2 MB)</small>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Declaration -->
                                                <div class="card mb-4">
                                                    <div class="card-header bg-light">
                                                        <h5 class="mb-0">Declaration / घोषणा</h5>
                                                    </div>
                                                    <div class="card-body">
                                                        <p>I hereby declare that all the particulars provided in this
                                                            application for institutional registration are true and correct
                                                            to the best of my knowledge and belief. I understand that any
                                                            discrepancies or false information may lead to the rejection of
                                                            this application and I accept full responsibility for such
                                                            consequences.</p>
                                                        <p>मैं घोषणा करता हूं कि संस्थागत पंजीकरण के लिए इस आवेदन में दिए गए
                                                            सभी विवरण मेरी सर्वोत्तम जानकारी और विश्वास के अनुसार सत्य और
                                                            सही हैं। मैं समझता हूं कि किसी भी विसंगति या गलत जानकारी के कारण
                                                            इस आवेदन को अस्वीकार किया जा सकता है जिसकी समस्त जिम्मेदारी मेरी
                                                            होगी।</p>

                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                id="declarationCheck" name="declaration" required>
                                                            <label class="form-check-label" for="declarationCheck">
                                                                I Agree / मैं सहमत हूं <span class="text-danger">*</span>
                                                            </label>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Form Actions -->
                                                <div class="bhoechie-footer">
                                                    <div class="row justify-content-center">
                                                        <div class="col-md-2 d-grid">
                                                            <button type="submit" class="btn btn-outline-success">
                                                                {{ isset($application) ? 'Update' : 'Save and Next' }}
                                                            </button>
                                                        </div>
                                                        <div class="col-md-2 d-grid">
                                                            <button type="reset"
                                                                class="btn btn-outline-danger">Reset</button>
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
    </div>
@endsection

@push('custom-scripts')
    <script>
        $(document).ready(function() {
            // Toggle trainer section based on has_trainer selection
            $('input[name="has_trainer"]').change(function() {
                if ($(this).val() == '1') {
                    $('#trainerSection').show();
                    $('.trainer-entry').find('input, textarea, select').prop('required', true);
                } else {
                    $('#trainerSection').hide();
                    $('.trainer-entry').find('input, textarea, select').prop('required', false);
                }
            });

            // Toggle hospital details based on medical facility availability
            $('input[name="medical_facility_available"]').change(function() {
                if ($(this).val() == '0') {
                    $('#nearest_hospital_name, #nearest_hospital_contact_number').prop('required', true);
                } else {
                    $('#nearest_hospital_name, #nearest_hospital_contact_number').prop('required', false);
                }
            });

            // Add new trainer
            $('#addTrainer').click(function() {
                var newEntry = $('.trainer-entry').first().clone();
                newEntry.find('input').val('');
                newEntry.find('textarea').val('');
                newEntry.find('.btn-secondary').remove(); // Remove view buttons
                newEntry.append(
                    '<div class="col-md-12 text-end"><button type="button" class="btn btn-danger btn-sm remove-trainer">Remove Trainer</button></div>'
                    );
                newEntry.insertBefore($(this));
                // Mobile number validation
                const mobileFields =
                    'input[name="owner_mobile"], input[name="nearest_hospital_contact_number"], input[name="manager_mobile"], input[name="applicant_mobile"], input[name="trainer_mobile[]"]';

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

            // Remove trainer
            $(document).on('click', '.remove-trainer', function() {
                if ($('.trainer-entry').length > 1) {
                    $(this).closest('.trainer-entry').remove();
                } else {
                    alert('At least one trainer entry is required.');
                }
            });

            // Mobile number validation

            const mobileFields =
                'input[name="owner_mobile"], input[name="nearest_hospital_contact_number"], input[name="manager_mobile"], input[name="applicant_mobile"], input[name="trainer_mobile[]"]';

            // Only allow digits, max 10
            $(mobileFields).on('input', function() {
                this.value = this.value.replace(/[^0-9]/g, '').slice(0, 10);
            });

            // Validate on blur
            $(mobileFields).on('blur', function() {
                const mobile = this.value;
                const isValid = /^[6-9]\d{9}$/.test(mobile);

                if (!isValid && mobile.length === 10) {
                    alert("Please enter a valid 10-digit mobile number starting with 6, 7, 8, or 9.");
                    $(this).focus().val('');
                }
            });



            // Form validation before submission
            $('form').submit(function(e) {
                if (!$('#declarationCheck').is(':checked')) {
                    e.preventDefault();
                    alert('Please accept the declaration to proceed.');
                    return false;
                }
            });
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
    </script>
@endpush
