@extends('layouts.onlineAdmissionTestNav')
@section('content')
<style>
    .bwizard-steps { display: flex; width: 100%; }
    .bwizard-steps li { flex: 1; text-align: center; padding: 12px 8px 10px 30px; }
    .bwizard-steps li:first-child { padding-left: 12px; }
    .bwizard-steps .label {
        display: inline-flex !important; align-items: center !important; justify-content: center !important;
        width: 22px !important; height: 22px !important; border-radius: 50% !important;
        background: #888; color: #fff !important; font-weight: bold; font-size: 12px;
        margin: 0 6px 0 0 !important; padding: 0 !important; position: static !important; top: auto !important;
        vertical-align: middle; line-height: 1 !important;
    }
    .bwizard-steps .active .label { background: #333 !important; }
    .bwizard-steps li.disabled-tab { opacity: 0.45; cursor: not-allowed; }
    .section-box { border: 1px solid #ccc; border-radius: 4px; padding: 15px; margin-bottom: 20px; position: relative; }
    .section-box .section-legend { position: absolute; top: -11px; left: 12px; background: #fff; padding: 0 8px; font-weight: bold; font-size: 14px; }
    .parent-box { border: 1px solid #ccc; border-radius: 4px; padding: 12px; }
    .parent-box .parent-legend { font-weight: bold; margin-bottom: 10px; border-bottom: 1px solid #eee; padding-bottom: 6px; }
</style>

<div class="row">
    <div class="col-12">
        <div class="pageheader pb-1">
            <h5 class="mb-1">Online Application to Seek Admission in Sports College of UP / उ.प्र. के स्पोर्ट्स कॉलेज में प्रवेश हेतु ऑनलाइन आवेदन</h5>
        </div>
    </div>
</div>

@php
    $tab = request('tab','basic');
    $formStatus = Auth::guard('OnlineAdmission')->user()->form_status ?? 0;
@endphp

<div class="card">
  <div class="card-body">
    <ul class="bwizard-steps clickable mb-3">
        {{-- Tab 1: always accessible --}}
        <li class="{{ $tab=='basic' ? 'active' : '' }}" style="cursor:pointer"
            onclick="window.location='?tab=basic'">
            <span class="label">1</span> Basic Details
        </li>
        {{-- Tab 2: requires form_status >= 2 --}}
        <li class="{{ $tab=='communication' ? 'active' : ($formStatus < 2 ? 'disabled-tab' : '') }}"
            style="cursor:{{ $formStatus >= 2 ? 'pointer' : 'not-allowed' }}"
            onclick="{{ $formStatus >= 2 ? 'window.location=\'?tab=communication\'' : 'alert(\'Please save Basic Details first./पहले मूल विवरण सहेजें।\')' }}">
            <span class="label">2</span> Communication
        </li>
        {{-- Tab 3: requires form_status >= 3 --}}
        <li class="{{ $tab=='education' ? 'active' : ($formStatus < 3 ? 'disabled-tab' : '') }}"
            style="cursor:{{ $formStatus >= 3 ? 'pointer' : 'not-allowed' }}"
            onclick="{{ $formStatus >= 3 ? 'window.location=\'?tab=education\'' : 'alert(\'Please save Communication details first./पहले संचार विवरण सहेजें।\')' }}">
            <span class="label">3</span> Educational
        </li>
        {{-- Tab 4: requires form_status >= 4 --}}
        <li class="{{ $tab=='documents' ? 'active' : ($formStatus < 4 ? 'disabled-tab' : '') }}"
            style="cursor:{{ $formStatus >= 4 ? 'pointer' : 'not-allowed' }}"
            onclick="{{ $formStatus >= 4 ? 'window.location=\'?tab=documents\'' : 'alert(\'Please save Education details first./पहले शिक्षा विवरण सहेजें।\')' }}">
            <span class="label">4</span> Documents
        </li>
        {{-- Tab 5: requires form_status >= 5 --}}
        <li class="{{ $tab=='declaration' ? 'active' : ($formStatus < 5 ? 'disabled-tab' : '') }}"
            style="cursor:{{ $formStatus >= 5 ? 'pointer' : 'not-allowed' }}"
            onclick="{{ $formStatus >= 5 ? 'window.location=\'?tab=declaration\'' : 'alert(\'Please upload all Documents first./पहले सभी दस्तावेज़ अपलोड करें।\')' }}">
            <span class="label">5</span> Declaration & Submit
        </li>
    </ul>

    {{-- ═══════════════════ TAB: BASIC DETAILS ═══════════════════ --}}
    @if($tab == 'basic')
    <form action="{{ route('onlineAdmissionTest.saveBasic') }}" method="post" id="basicForm" class="needs-validation" novalidate enctype="multipart/form-data">
        @csrf

        {{-- A. Registration Details --}}
        <div class="section-box">
            <span class="section-legend">A. Registration Details/पंजीकरण विवरण</span>
            <div class="row g-3 mt-1">
                <div class="col-md-3">
                    <label class="placeholder">1. Registration No./पंजीकरण संख्या</label>
                    <input type="text" class="form-control bg-light" value="{{ $user->application_no }}" readonly>
                </div>
                <div class="col-md-3">
                    <label class="placeholder">2. Full Name/पूरा नाम</label>
                    <input type="text" class="form-control bg-light" value="{{ $user->fullname }}" readonly>
                </div>
                <div class="col-md-2">
                    <label class="placeholder">3. Date of Birth/जन्मतिथि</label>
                    <input type="text" class="form-control bg-light" value="{{ $user->dob ? date('d-m-Y',strtotime($user->dob)) : '' }}" readonly>
                </div>
                <div class="col-md-2">
                    <label class="placeholder">4. Aadhaar No./आधार संख्या</label>
                    <input type="text" class="form-control bg-light" value="{{ $user->aadhar_no }}" readonly>
                </div>
                <div class="col-md-2">
                    <label class="placeholder">5. PEN No./व्यक्तिगत शिक्षा संख्या <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="pen_no" required value="{{ $user->pen_no }}">
                </div>
                <div class="col-md-3">
                    <label class="placeholder">6. Mobile No./मोबाइल नंबर</label>
                    <input type="text" class="form-control bg-light" value="{{ $user->mobile }}" readonly>
                </div>
                <div class="col-md-3">
                    <label class="placeholder">7. Email ID/ईमेल आईडी</label>
                    <input type="text" class="form-control bg-light" value="{{ $user->email }}" readonly>
                </div>
                <div class="col-md-3">
                    <label class="placeholder">8. Are you a native of Uttar Pradesh?/क्या आप उत्तर प्रदेश के मूल निवासी हैं?</label>
                    <input type="text" class="form-control bg-light" value="{{ $user->native_of_up == 1 ? 'Yes' : 'No' }}" readonly>
                </div>
                <div class="col-md-2">
                    <label class="placeholder">9. Gender/लिंग</label>
                    <input type="text" class="form-control bg-light" value="{{ $user->gender == 1 ? 'Male/पुरुष' : ($user->gender == 2 ? 'Female/महिला' : 'Other/अन्य') }}" readonly>
                </div>
            </div>
        </div>
        <input type="hidden" name="gender" id="gender" value="{{ $user->gender }}">

        {{-- B. Applicant Details --}}
        <div class="section-box">
            <span class="section-legend">B. Applicant Details/आवेदक का विवरण</span>
            <div class="row g-3 mt-1">

                <div class="col-md-3">
                    <label class="placeholder">1. Class Seeking Admission/कक्षा <span class="text-danger">*</span></label>
                    <select class="form-control form-select" name="admission_seeking" id="admission_seeking" required onchange="onClassChange(this.value)">
                        <option value="">Select/चुनें</option>
                        <option value="6"  {{ ($basic_detail->admission_seeking ?? '') == '6'  ? 'selected' : '' }}>Class 6th</option>
                        <option value="9"  {{ ($basic_detail->admission_seeking ?? '') == '9'  ? 'selected' : '' }}>Class 9th</option>
                        <option value="11" {{ ($basic_detail->admission_seeking ?? '') == '11' ? 'selected' : '' }}>Class 11th</option>
                    </select>
                    <div id="dob_class_error" class="text-danger small mt-1" style="display:none"></div>
                </div>

                <div class="col-md-3">
                    <label class="placeholder">2. Name of Sport/खेल का नाम <span class="text-danger">*</span></label>
                    <select class="form-control form-select" name="sport_type" id="sport_type" required>
                        <option value="">Select Sport/खेल चुनें</option>
                        @foreach($availableSports as $sport)
                        <option value="{{ $sport->id }}" {{ ($basic_detail->sport_type ?? '') == $sport->id ? 'selected' : '' }}>{{ $sport->name }}</option>
                        @endforeach
                    </select>
                </div>

                @php
                    $subSports = ($basic_detail && $basic_detail->sport_type)
                        ? DB::table('sub_sport_type')->where('sport_id', $basic_detail->sport_type)->get()
                        : collect();
                    $hasSubSports = $subSports->isNotEmpty();
                @endphp
                <div class="col-md-3" id="sub_sport_div" style="{{ $hasSubSports ? '' : 'display:none' }}">
                    <label class="placeholder">Sub Sport/उप खेल <span class="text-danger" id="sub_sport_required_star" style="{{ $hasSubSports ? '' : 'display:none' }}">*</span></label>
                    <select class="form-control form-select" name="sub_type" id="sub_type" {{ $hasSubSports ? 'required' : '' }}>
                        <option value="">Select/चुनें</option>
                        @foreach($subSports as $sub)
                        <option value="{{ $sub->id }}" {{ ($basic_detail->sub_sport_type ?? '') == $sub->id ? 'selected' : '' }}>{{ $sub->sub_type }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-12">
                    <label class="placeholder">3. In which college are you seeking admission?/किस विद्यालय में आप प्रवेश चाह रहे हैं? <span class="text-danger">*</span></label>
                    @php
                        $savedCollegeIds = $basic_detail && $basic_detail->sport_college ? array_values(array_filter(explode(',', $basic_detail->sport_college), fn($v) => $v !== '')) : [];
                    @endphp
                    <div class="row g-2" id="college_prefs_container">
                        <div class="col-12" id="college_prefs_placeholder">
                            <em class="text-muted small">Please select Class and Sport first to see available colleges. / कक्षा और खेल चुनें।</em>
                        </div>
                    </div>
                </div>

                <div class="col-md-2">
                    <label class="placeholder">4. Category/श्रेणी <span class="text-danger">*</span></label>
                    <select class="form-control form-select" name="category" required>
                        <option value="">Select/चुनें</option>
                        <option value="1" {{ ($basic_detail->category ?? '') == 1 ? 'selected' : '' }}>General/सामान्य</option>
                        <option value="2" {{ ($basic_detail->category ?? '') == 2 ? 'selected' : '' }}>OBC</option>
                        <option value="3" {{ ($basic_detail->category ?? '') == 3 ? 'selected' : '' }}>SC</option>
                        <option value="4" {{ ($basic_detail->category ?? '') == 4 ? 'selected' : '' }}>ST</option>
                    </select>
                </div>

                <div class="col-md-2">
                    <label class="placeholder">5. Sub-Category/उप-श्रेणी</label>
                    <input type="text" class="form-control" name="sub_category" value="{{ $basic_detail->sub_category ?? '' }}">
                </div>

                <div class="col-md-2">
                    <label class="placeholder">6. Height (cm)/लंबाई (सेंटीमीटर में) <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" name="height" required value="{{ $basic_detail->height ?? '' }}" min="100" max="250">
                </div>

                <div class="col-md-2">
                    <label class="placeholder">7. Weight (kg)/वजन (किलोग्राम में) <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" name="weight" required value="{{ $basic_detail->weight ?? '' }}" min="20" max="200">
                </div>

                <div class="col-md-2">
                    <label class="placeholder">8. Blood Group/ब्लड ग्रुप <span class="text-danger">*</span></label>
                    <select class="form-control form-select" name="blood_group" required>
                        <option value="">Select/चुनें</option>
                        @foreach(['A+','A-','B+','B-','O+','O-','AB+','AB-'] as $bg)
                        <option value="{{ $bg }}" {{ ($basic_detail->blood_group ?? '') == $bg ? 'selected' : '' }}>{{ $bg }}</option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-4">
                    <label class="placeholder">9. Visible Identification Mark/पहचान चिह्न <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="identification_marks" required value="{{ $basic_detail->identification_marks ?? '' }}" placeholder="e.g. Scar/Mole on Right Hand">
                </div>

                <div class="col-md-12">
                    <label class="placeholder">10. Is applicant suffering from Skin Disease/Fits/Other Disease?/क्या आवेदक चर्म रोग/मिर्गी/अन्य किसी रोग से ग्रसित है? <span class="text-danger">*</span></label>
                    <div class="mt-1">
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="disease" id="disease_yes" value="1" required {{ ($basic_detail->disease ?? '') == 1 ? 'checked' : '' }}>
                            <label class="form-check-label" for="disease_yes">Yes/हाँ</label>
                        </div>
                        <div class="form-check form-check-inline">
                            <input class="form-check-input" type="radio" name="disease" id="disease_no" value="0" {{ isset($basic_detail->disease) && $basic_detail->disease == 0 ? 'checked' : '' }}>
                            <label class="form-check-label" for="disease_no">No/नहीं</label>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- C. Parents Details --}}
        <div class="section-box">
            <span class="section-legend">C. Parents' Details/अभिभावक का विवरण</span>
            <div class="row g-3 mt-1">
                <div class="col-md-6">
                    <div class="parent-box">
                        <div class="parent-legend">Mother Details/माता का विवरण</div>
                        <div class="row g-2">
                            <div class="col-md-4"><label class="placeholder">1. Name/नाम <span class="text-danger">*</span></label></div>
                            <div class="col-md-8"><input type="text" class="form-control" name="mother_name" required value="{{ $basic_detail->mother_name ?? '' }}"></div>

                            <div class="col-md-4"><label class="placeholder">2. Occupation/व्यवसाय <span class="text-danger">*</span></label></div>
                            <div class="col-md-8">
                                <select class="form-control form-select" name="mother_occupation" required>
                                    <option value="">Select/चुनें</option>
                                    @foreach(['Service/सेवा','Business/व्यवसाय','Farmer/कृषक','Housewife/गृहिणी','Other/अन्य'] as $occ)
                                    <option value="{{ $occ }}" {{ ($basic_detail->mother_occupation ?? '') == $occ ? 'selected' : '' }}>{{ $occ }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4"><label class="placeholder">3. Aadhaar Card/आधार कार्ड</label></div>
                            <div class="col-md-8">
                                <input type="hidden" name="mother_aadhar1" value="{{ $basic_detail->mother_aadhar ?? '' }}">
                                <div class="input-group">
                                    <input type="file" class="form-control" name="mother_aadhar" accept=".jpg,.jpeg,.png,.pdf">
                                    @if($basic_detail && $basic_detail->mother_aadhar)
                                    <a href="{{ asset('onlineAdmission_storage/images/'.$basic_detail->mother_aadhar) }}" target="_blank" class="btn btn-outline-secondary btn-sm">View</a>
                                    @endif
                                </div>
                                <small class="text-muted">Max 2MB (JPG/PNG/PDF)</small>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="parent-box">
                        <div class="parent-legend">Father Details/पिता का विवरण</div>
                        <div class="row g-2">
                            <div class="col-md-4"><label class="placeholder">1. Name/नाम <span class="text-danger">*</span></label></div>
                            <div class="col-md-8"><input type="text" class="form-control" name="father_name" required value="{{ $basic_detail->father_name ?? '' }}"></div>

                            <div class="col-md-4"><label class="placeholder">2. Occupation/व्यवसाय <span class="text-danger">*</span></label></div>
                            <div class="col-md-8">
                                <select class="form-control form-select" name="father_occupation" required>
                                    <option value="">Select/चुनें</option>
                                    @foreach(['Service/सेवा','Business/व्यवसाय','Farmer/कृषक','Other/अन्य'] as $occ)
                                    <option value="{{ $occ }}" {{ ($basic_detail->father_occupation ?? '') == $occ ? 'selected' : '' }}>{{ $occ }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-4"><label class="placeholder">3. Aadhaar Card/आधार कार्ड</label></div>
                            <div class="col-md-8">
                                <input type="hidden" name="father_aadhar1" value="{{ $basic_detail->father_aadhar ?? '' }}">
                                <div class="input-group">
                                    <input type="file" class="form-control" name="father_aadhar" accept=".jpg,.jpeg,.png,.pdf">
                                    @if($basic_detail && $basic_detail->father_aadhar)
                                    <a href="{{ asset('onlineAdmission_storage/images/'.$basic_detail->father_aadhar) }}" target="_blank" class="btn btn-outline-secondary btn-sm">View</a>
                                    @endif
                                </div>
                                <small class="text-muted">Max 2MB (JPG/PNG/PDF)</small>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-end gap-2 mt-2">
            <button type="submit" class="btn btn-success rounded-pill px-4">Save and Next/सहेजें और आगे बढ़ें →</button>
        </div>
    </form>

    {{-- ═══════════════════ TAB: COMMUNICATION ═══════════════════ --}}
    @elseif($tab == 'communication')
    <form action="{{ route('onlineAdmissionTest.saveCommunication') }}" method="post" id="commForm" class="needs-validation" novalidate>
        @csrf
        <div class="row g-3">
            {{-- Permanent Address --}}
            <div class="col-md-6">
                <div class="section-box">
                    <span class="section-legend">A. Permanent Address/स्थायी पता</span>
                    <div class="row g-2 mt-1">
                        <div class="col-md-12">
                            <label class="placeholder">1. Street/Village/मोहल्ला/ग्राम <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="p_gram" required value="{{ $commun_detail->p_gram ?? '' }}">
                            <small class="text-muted">As per Aadhaar Card / आधार कार्ड के अनुसार</small>
                        </div>
                        <div class="col-md-6">
                            <label class="placeholder">2. Post Office/डाक घर <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="p_post" required value="{{ $commun_detail->p_post ?? '' }}">
                        </div>
                        <div class="col-md-6">
                            <label class="placeholder">3. Police Station/पुलिस थाना <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="p_thana" required value="{{ $commun_detail->p_thana ?? '' }}">
                        </div>
                        <div class="col-md-6">
                            <label class="placeholder">4. State/राज्य <span class="text-danger">*</span></label>
                            <input type="text" class="form-control bg-light" value="Uttar Pradesh/उत्तर प्रदेश" readonly>
                            <input type="hidden" name="p_state" id="p_state" value="23">
                        </div>
                        <div class="col-md-6">
                            <label class="placeholder">5. District/जनपद <span class="text-danger">*</span></label>
                            <select class="form-control form-select" name="p_district" id="p_district" required>
                                <option value="">Select District</option>
                                @foreach($city as $c)
                                <option value="{{ $c->id }}" {{ ($commun_detail->p_district ?? '') == $c->id ? 'selected' : '' }}>{{ $c->city }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="placeholder">6. PIN Code/पिन कोड <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="p_pin" required maxlength="6" minlength="6"
                                pattern="[0-9]{6}" value="{{ $commun_detail->p_pin ?? '' }}"
                                oninput="this.value=this.value.replace(/[^0-9]/g,'')">
                        </div>
                        <div class="col-md-6">
                            <label class="placeholder">7. Mobile No./मोबाइल नंबर <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="p_mobile" required value="{{ $commun_detail->p_mobile ?? '' }}" maxlength="10" oninput="this.value=this.value.replace(/[^0-9]/g,'')">
                        </div>
                        <div class="col-md-6">
                            <label class="placeholder">8. Alternate Mobile/वैकल्पिक मोबाइल <span class="text-danger">*</span></label>
                            <input type="text" class="form-control" name="p_alternate_mobile" required value="{{ $commun_detail->p_alternate_mobile ?? '' }}" maxlength="10" oninput="this.value=this.value.replace(/[^0-9]/g,'')">
                        </div>
                        <div class="col-md-12">
                            <label class="placeholder">9. Email ID/ईमेल आईडी <span class="text-danger">*</span></label>
                            <input type="email" class="form-control" name="p_email" required value="{{ $commun_detail->p_email ?? '' }}">
                        </div>
                    </div>
                </div>
            </div>

            {{-- Correspondence Address --}}
            <div class="col-md-6">
                <div class="section-box">
                    <span class="section-legend">B. Correspondence Address/पत्राचार पता</span>
                    <div class="form-check mt-2 mb-2">
                        <input class="form-check-input" type="checkbox" id="sameAsAbove">
                        <label class="form-check-label">Same as Permanent Address/स्थायी पते के समान</label>
                    </div>
                    <div class="row g-2">
                        <div class="col-md-12">
                            <label class="placeholder">1. Street/Village/मोहल्ला/ग्राम <span class="text-danger">*</span></label>
                            <input type="text" class="form-control corr" name="c_gram" required value="{{ $commun_detail->c_gram ?? '' }}">
                            <small class="text-muted">As per Aadhaar Card / आधार कार्ड के अनुसार</small>
                        </div>
                        <div class="col-md-6">
                            <label class="placeholder">2. Post Office/डाक घर <span class="text-danger">*</span></label>
                            <input type="text" class="form-control corr" name="c_post" required value="{{ $commun_detail->c_post ?? '' }}">
                        </div>
                        <div class="col-md-6">
                            <label class="placeholder">3. Police Station/पुलिस थाना <span class="text-danger">*</span></label>
                            <input type="text" class="form-control corr" name="c_thana" required value="{{ $commun_detail->c_thana ?? '' }}">
                        </div>
                        <div class="col-md-6">
                            <label class="placeholder">4. State/राज्य <span class="text-danger">*</span></label>
                            <input type="text" class="form-control bg-light corr" value="Uttar Pradesh/उत्तर प्रदेश" readonly>
                            <input type="hidden" name="c_state" id="c_state" value="23">
                        </div>
                        <div class="col-md-6">
                            <label class="placeholder">5. District/जनपद <span class="text-danger">*</span></label>
                            <select class="form-control form-select corr" name="c_district" id="c_district" required>
                                <option value="">Select District</option>
                                @foreach($city as $c)
                                <option value="{{ $c->id }}" {{ ($commun_detail->c_district ?? '') == $c->id ? 'selected' : '' }}>{{ $c->city }}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="col-md-6">
                            <label class="placeholder">6. PIN Code/पिन कोड <span class="text-danger">*</span></label>
                            <input type="text" class="form-control corr" name="c_pin" required maxlength="6" minlength="6"
                                pattern="[0-9]{6}" value="{{ $commun_detail->c_pin ?? '' }}"
                                oninput="this.value=this.value.replace(/[^0-9]/g,'')">
                        </div>
                        <div class="col-md-6">
                            <label class="placeholder">7. Mobile No./मोबाइल नंबर <span class="text-danger">*</span></label>
                            <input type="text" class="form-control corr" name="c_mobile" required value="{{ $commun_detail->c_mobile ?? '' }}" maxlength="10" oninput="this.value=this.value.replace(/[^0-9]/g,'')">
                        </div>
                        <div class="col-md-6">
                            <label class="placeholder">8. Alternate Mobile/वैकल्पिक मोबाइल <span class="text-danger">*</span></label>
                            <input type="text" class="form-control corr" name="c_alternate_mobile" required value="{{ $commun_detail->c_alternate_mobile ?? '' }}" maxlength="10" oninput="this.value=this.value.replace(/[^0-9]/g,'')">
                        </div>
                        <div class="col-md-12">
                            <label class="placeholder">9. Email ID/ईमेल आईडी <span class="text-danger">*</span></label>
                            <input type="email" class="form-control corr" name="c_email" required value="{{ $commun_detail->c_email ?? '' }}">
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-between mt-3">
            <a href="{{ route('onlineAdmissionTest.applicationForm') }}?tab=basic" class="btn btn-outline-secondary rounded-pill px-4">← Back</a>
            <button type="submit" class="btn btn-success rounded-pill px-4">Save and Next/सहेजें और आगे बढ़ें →</button>
        </div>
    </form>

    {{-- ═══════════════════ TAB: EDUCATION ═══════════════════ --}}
    @elseif($tab == 'education')
    <form action="{{ route('onlineAdmissionTest.saveEducation') }}" method="post" id="eduForm" class="needs-validation" novalidate>
        @csrf
        <div class="section-box">
            <span class="section-legend">A. Educational Qualification Details/शैक्षिक योग्यता विवरण</span>
            <div class="row g-3 mt-1">
                <div class="col-md-3">
                    <label class="placeholder">1. UDISE Code/यूडाइस कोड <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="updise_code" required value="{{ $edu_detail->updise_code ?? '' }}">
                </div>
                <div class="col-md-5">
                    <label class="placeholder">2. School/Vidyalaya Name/विद्यालय का नाम <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="school" required value="{{ $edu_detail->school ?? '' }}">
                </div>
                <div class="col-md-2">
                    <label class="placeholder">3. Previously Studied in Class/पूर्व में अध्ययन की कक्षा <span class="text-danger">*</span></label>
                    @php
                        $seekingClass = $basic_detail->admission_seeking ?? '';
                        $eduClassMap  = ['6' => ['5th','6th'], '9' => ['8th','9th'], '11' => ['10th','11th']];
                        $eduClasses   = $eduClassMap[$seekingClass] ?? ['5th','6th','8th','9th','10th','11th'];
                    @endphp
                    <select class="form-control form-select" name="class" required>
                        <option value="">Select</option>
                        @foreach($eduClasses as $cl)
                        <option value="{{ $cl }}" {{ ($edu_detail->class ?? '') == $cl ? 'selected' : '' }}>{{ $cl }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="placeholder">4. Year of Passing/उत्तीर्ण वर्ष <span class="text-danger">*</span></label>
                    <select class="form-control form-select" name="year_of_passing" required>
                        <option value="">Select</option>
                        @foreach([date('Y'), date('Y')-1] as $y)
                        <option value="{{ $y }}" {{ ($edu_detail->year_of_passing ?? '') == $y ? 'selected' : '' }}>{{ $y }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="col-md-2">
                    <label class="placeholder">5. Maximum Marks/अधिकतम अंक <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" name="maximum_marks" id="maximum_marks" required value="{{ $edu_detail->maximum_marks ?? '' }}" min="1">
                </div>
                <div class="col-md-2">
                    <label class="placeholder">6. Obtained Marks/प्राप्त अंक <span class="text-danger">*</span></label>
                    <input type="number" class="form-control" name="obtained_marks" id="obtained_marks" required value="{{ $edu_detail->obtained_marks ?? '' }}" min="0">
                    <small class="text-danger" id="marks_error" style="display:none">Obtained marks cannot exceed maximum marks.</small>
                </div>
                <div class="col-md-3">
                    <label class="placeholder">7. Grade/Percentage/ग्रेड/प्रतिशत <span class="text-danger">*</span></label>
                    <input type="text" class="form-control" name="grade_percentage" id="grade_percentage" required value="{{ $edu_detail->grade_percentage ?? '' }}" placeholder="Grade or Percentage">
                </div>
            </div>
        </div>
        <div class="d-flex justify-content-between mt-2">
            <a href="{{ route('onlineAdmissionTest.applicationForm') }}?tab=communication" class="btn btn-outline-secondary rounded-pill px-4">← Back</a>
            <button type="submit" class="btn btn-success rounded-pill px-4">Save and Next/सहेजें और आगे बढ़ें →</button>
        </div>
    </form>

    {{-- ═══════════════════ TAB: DOCUMENTS ═══════════════════ --}}
    @elseif($tab == 'documents')
    <form action="{{ route('onlineAdmissionTest.saveDocuments') }}" method="post" id="docForm" class="needs-validation" novalidate enctype="multipart/form-data">
        @csrf
        <div class="section-box">
            <span class="section-legend">Documents/दस्तावेज़</span>
            <div class="row g-3 mt-1">
                <div class="col-md-6">
                    <label class="placeholder">1. Photo of Applicant/आवेदक की फोटो <span class="text-danger">*</span></label>
                    @if($edu_detail && $edu_detail->applicant_photograph)
                        <div class="mb-1"><img src="{{ asset('onlineAdmission_storage/images/'.$edu_detail->applicant_photograph) }}" style="height:60px;" class="border"><br><small class="text-success">Uploaded ✓</small></div>
                    @endif
                    <input type="file" class="form-control file-input" name="applicant_photograph" id="applicant_photograph"
                        accept=".jpg,.jpeg,.png" data-max-size="2097152" data-max-label="2 MB"
                        {{ !($edu_detail->applicant_photograph ?? '') ? 'required' : '' }}>
                    <small class="text-muted">Max <strong>2 MB</strong> (JPG/PNG)</small>
                </div>
                <div class="col-md-6">
                    <label class="placeholder">2. Signature of Applicant/आवेदक के हस्ताक्षर <span class="text-danger">*</span></label>
                    @if($edu_detail && $edu_detail->applicant_signature)
                        <div class="mb-1"><img src="{{ asset('onlineAdmission_storage/images/'.$edu_detail->applicant_signature) }}" style="height:40px;" class="border"><br><small class="text-success">Uploaded ✓</small></div>
                    @endif
                    <input type="file" class="form-control file-input" name="applicant_signature" id="applicant_signature"
                        accept=".jpg,.jpeg,.png" data-max-size="2097152" data-max-label="2 MB"
                        {{ !($edu_detail->applicant_signature ?? '') ? 'required' : '' }}>
                    <small class="text-muted">Max <strong>2 MB</strong> (JPG/PNG)</small>
                </div>
                <div class="col-md-6">
                    <label class="placeholder">3. Previous Year Marksheet / पिछले वर्ष की अंकतालिका <span class="text-danger">*</span></label>
                    @if($edu_detail && $edu_detail->education_certificate)
                        <div class="mb-1"><small class="text-success">Uploaded ✓</small></div>
                    @endif
                    <input type="file" class="form-control file-input" name="education_certificate" id="education_certificate"
                        accept=".jpg,.jpeg,.png,.pdf" data-max-size="10485760" data-max-label="10 MB"
                        {{ !($edu_detail->education_certificate ?? '') ? 'required' : '' }}>
                    <small class="text-muted">Max <strong>10 MB</strong> (JPG/PNG/PDF)</small>
                </div>
                <div class="col-md-6">
                    <label class="placeholder">4. Aadhaar Card/आधार कार्ड <span class="text-danger">*</span></label>
                    @if($edu_detail && $edu_detail->applicant_aadhar_birth_certificate)
                        <div class="mb-1"><small class="text-success">Uploaded ✓</small></div>
                    @endif
                    <input type="file" class="form-control file-input" name="applicant_aadhar" id="applicant_aadhar"
                        accept=".jpg,.jpeg,.png,.pdf" data-max-size="10485760" data-max-label="10 MB"
                        {{ !($edu_detail->applicant_aadhar_birth_certificate ?? '') ? 'required' : '' }}>
                    <small class="text-muted">Max <strong>10 MB</strong> (JPG/PNG/PDF)</small>
                </div>
                <div class="col-md-6">
                    <label class="placeholder">5. Birth Certificate/जन्म प्रमाणपत्र <span class="text-danger">*</span></label>
                    @if($edu_detail && $edu_detail->applicant_birth_certificate)
                        <div class="mb-1"><small class="text-success">Uploaded ✓</small></div>
                    @endif
                    <input type="file" class="form-control file-input" name="applicant_birth_certificate" id="applicant_birth_certificate"
                        accept=".jpg,.jpeg,.png,.pdf" data-max-size="10485760" data-max-label="10 MB"
                        {{ !($edu_detail->applicant_birth_certificate ?? '') ? 'required' : '' }}>
                    <small class="text-muted">Max <strong>10 MB</strong> (JPG/PNG/PDF)</small>
                </div>
                <div class="col-md-6">
                    <label class="placeholder">6. Gap/Repeater Affidavit/गैप/रिपीटर शपथ पत्र <span class="text-muted small">(Optional/वैकल्पिक)</span></label>
                    @if($edu_detail && $edu_detail->affidavit)
                        <div class="mb-1"><small class="text-success">Uploaded ✓</small></div>
                    @endif
                    <input type="file" class="form-control file-input" name="affidavit" id="affidavit"
                        accept=".jpg,.jpeg,.png,.pdf" data-max-size="10485760" data-max-label="10 MB">
                    <small class="text-muted">Max <strong>10 MB</strong> (JPG/PNG/PDF)</small>
                </div>
            </div>
            <div>
                <h5><b>NOTE:</b></h5>
                <p>1. An affidavit is required from a student who has repeated a class, to be submitted on a stamp paper of ₹100. / जिस छात्र ने कक्षा दोहराई है, उससे ₹100 के स्टाम्प पेपर पर शपथ पत्र आवश्यक है।</p>
                <p>2. An affidavit is required from a student who has a gap in their education, to be submitted on a stamp paper of ₹10. / जिस छात्र की शिक्षा में अंतराल (गैप) है, उससे ₹10 के स्टाम्प पेपर पर शपथ पत्र आवश्यक है।</p>
            </div>
        </div>
        <div class="d-flex justify-content-between mt-2">
            <a href="{{ route('onlineAdmissionTest.applicationForm') }}?tab=education" class="btn btn-outline-secondary rounded-pill px-4">← Back</a>
            <button type="submit" class="btn btn-success rounded-pill px-4">Save and Next/सहेजें और आगे बढ़ें →</button>
        </div>
    </form>

    {{-- ═══════════════════ TAB: DECLARATION ═══════════════════ --}}
    @elseif($tab == 'declaration')
    <form action="{{ route('onlineAdmissionTest.saveDeclaration') }}" method="post" id="declForm" class="needs-validation" novalidate>
        @csrf
        <div class="section-box">
            <span class="section-legend">Declaration by Parents/अभिभावक द्वारा घोषणा</span>
            <div class="mt-2">
                <p>1. I hereby certify that I have read and understood all Terms &amp; Conditions for filling this online Application Form and abide by them. / मैं प्रमाणित करता/करती हूँ कि मैंने इस ऑनलाइन आवेदन पत्र को भरने के लिए सभी नियम व शर्तों को पढ़ और समझ लिया है तथा उनका पालन करूँगा/करूँगी।</p>
                <p>2. I also certify that all the information provided above is true and correct to the best of my knowledge. / मैं यह भी प्रमाणित करता/करती हूँ कि ऊपर दी गई सभी जानकारी मेरी जानकारी के अनुसार सत्य एवं सही है।</p>
                <p>3. I understand that if any of the above mentioned facts is found to be incorrect, my ward shall be liable for disqualification from admission in the Sports Colleges under Department of Sports, UP. / मैं समझता/समझती हूँ कि यदि उपर्युक्त में से कोई भी तथ्य असत्य पाया जाता है, तो मेरे वार्ड को खेल विभाग, उ.प्र. के अंतर्गत स्पोर्ट्स कॉलेज में प्रवेश से अयोग्य घोषित किया जा सकता है।</p>
                <p>4. I hereby declare that I have submitted the required affidavit in case of any gap in my education or if I am a repeating student. I understand that failure to submit the affidavit may result in the cancellation of my application form. / मैं यह घोषित करता/करती हूँ कि यदि मेरी शिक्षा में कोई अंतराल (गैप) है या मैं पुनरावृत्ति (रीपीट) छात्र हूँ, तो मैंने आवश्यक शपथ पत्र जमा कर दिया है। मैं समझता/समझती हूँ कि शपथ पत्र जमा न करने पर मेरा आवेदन पत्र निरस्त किया जा सकता है।</p>
                <p>5. I hereby declare that I understand that under the centralized process, my biological age test will be conducted based on the merit list of the main selection examination, with the consent of my parent/guardian. I further understand that in case of عدم consent from my parent/guardian, my candidature will be cancelled. / मैं यह घोषित करता/करती हूँ कि मुख्य चयन परीक्षा की श्रेष्ठता सूची के आधार पर केंद्रीय व्यवस्था के अंतर्गत, अभिभावक की सहमति से मेरी जैविक आयु जांच करायी जाएगी। मैं यह भी समझता/समझती हूँ कि यदि अभिभावक की असहमति होती है, तो मेरा अभ्यर्थन निरस्त कर दिया जाएगा।</p>
            </div>
        </div>
        <div class="form-check mb-4">
            <input class="form-check-input" type="checkbox" name="i_agree" id="i_agree" value="1" required>
            <label class="form-check-label fw-bold" for="i_agree">I Agree/मैं सहमत हूँ</label>
            <div class="invalid-feedback">You must agree to the declaration.</div>
        </div>
        <div class="d-flex justify-content-between">
            <a href="{{ route('onlineAdmissionTest.applicationForm') }}?tab=documents" class="btn btn-outline-secondary rounded-pill px-4">← Back</a>
            <button type="submit" class="btn btn-danger rounded-pill px-4">Save and Preview/सहेजें और पूर्वावलोकन करें →</button>
        </div>
    </form>
    @endif

  </div>
</div>
@php $savedCollegeIds = $savedCollegeIds ?? []; @endphp
@endsection

@push('custom-scripts')
<script>
var userDob = "{{ $user->dob ?? '' }}"; // Y-m-d format

function ajaxSubmit(formId) {
    $("#"+formId).submit(function(e){
        e.preventDefault();
        if(!this.checkValidity()){ $(this).addClass('was-validated'); return; }
        $.ajax({
            type:"POST", url:$(this).attr("action"),
            data: new FormData(this),
            dataType:"json", contentType:false, cache:false, processData:false,
            success: function(res){
                if(res.error==false){ success(res.msg); setTimeout(()=>{ window.location.href=res.url; },800); }
                else{ error(res.msg); }
            }
        });
    });
}
ajaxSubmit('basicForm');
ajaxSubmit('commForm');
ajaxSubmit('declForm');

// Education form with obtained_marks validation
$("#eduForm").submit(function(e){
    e.preventDefault();
    if(!this.checkValidity()){ $(this).addClass('was-validated'); return; }
    var maxM = parseFloat($("#maximum_marks").val()) || 0;
    var obtM = parseFloat($("#obtained_marks").val()) || 0;
    if(obtM > maxM){ $("#marks_error").show(); $("#obtained_marks").focus(); return; }
    $("#marks_error").hide();
    $.ajax({
        type:"POST", url:$(this).attr("action"),
        data: new FormData(this),
        dataType:"json", contentType:false, cache:false, processData:false,
        success: function(res){
            if(res.error==false){ success(res.msg); setTimeout(()=>{ window.location.href=res.url; },800); }
            else{ error(res.msg); }
        }
    });
});
function calcPercentage(){
    var maxM = parseFloat($("#maximum_marks").val()) || 0;
    var obtM = parseFloat($("#obtained_marks").val()) || 0;
    if(maxM > 0 && obtM >= 0){
        $("#grade_percentage").val(((obtM / maxM) * 100).toFixed(2));
    } else {
        $("#grade_percentage").val('');
    }
}
$("#obtained_marks, #maximum_marks").on("input", function(){
    calcPercentage();
});
$("#obtained_marks").on("input", function(){
    var maxM = parseFloat($("#maximum_marks").val()) || 0;
    var obtM = parseFloat($(this).val()) || 0;
    $("#marks_error").toggle(obtM > maxM);
});

// Document form with file size validation
$("#docForm").submit(function(e){
    e.preventDefault();
    if(!this.checkValidity()){ $(this).addClass('was-validated'); return; }
    var valid = true;
    $(".file-input").each(function(){
        if(this.files.length > 0){
            var maxSize = parseInt($(this).data('max-size'));
            var label = $(this).data('max-label');
            if(this.files[0].size > maxSize){
                error($(this).attr('name').replace(/_/g,' ') + ' must be less than ' + label);
                valid = false; return false;
            }
        }
    });
    if(!valid) return;
    $.ajax({
        type:"POST", url:$(this).attr("action"),
        data: new FormData(this),
        dataType:"json", contentType:false, cache:false, processData:false,
        success: function(res){
            if(res.error==false){ success(res.msg); setTimeout(()=>{ window.location.href=res.url; },800); }
            else{ error(res.msg); }
        }
    });
});
$(".file-input").on("change", function(){
    var maxSize = parseInt($(this).data('max-size'));
    var label = $(this).data('max-label');
    if(this.files.length > 0 && this.files[0].size > maxSize){
        error('File too large. Maximum allowed size is ' + label + '.');
        this.value = '';
    }
});

// ── Embedded datasets (no AJAX needed for sport/college filtering) ──
var _allSports    = @json($jsSports);
var _allSubSports = @json($jsSubSports);
var _matrix       = @json($jsMatrix);
var _userGender   = parseInt("{{ $user->gender ?? 0 }}") || 0;

// ── Pure-JS filter helpers ──
function getSportsForClass(cls) {
    if (!cls) return [];
    var classVal = cls + 'th';
    var seen = {};
    _matrix.forEach(function(row) {
        if (row.class === classVal) {
            if (_userGender === 1 || _userGender === 2) {
                if (parseInt(row.gender) !== _userGender) return;
            }
            seen[row.sport_id] = true;
        }
    });
    return _allSports.filter(function(s) { return seen[s.id]; });
}

function getSubSportsForSport(sportId) {
    return _allSubSports.filter(function(s) { return String(s.sport_id) === String(sportId); });
}

function getCollegesForSelection(sportId, cls, subTypeId) {
    if (!sportId || !cls) return [];
    var classVal = cls + 'th';
    var seen = {}, result = [];
    _matrix.forEach(function(row) {
        if (String(row.sport_id) !== String(sportId)) return;
        if (row.class !== classVal) return;
        if (_userGender === 1 || _userGender === 2) {
            if (parseInt(row.gender) !== _userGender) return;
        }
        if (subTypeId && String(row.sub_sport_id) !== String(subTypeId)) return;
        if (!seen[row.college_id]) {
            seen[row.college_id] = true;
            result.push({ id: row.college_id, college_name: row.college_name });
        }
    });
    return result;
}

// ── Preference boxes ──
var _lastCollegeList = [];

function buildPreferenceBoxes(colleges, savedSelections) {
    var $container = $("#college_prefs_container");
    $container.empty();
    var n = colleges.length;
    if (n === 0) {
        $container.html('<div class="col-12"><em class="text-muted small">No colleges available for the selected sport/class. / इस खेल/कक्षा के लिए कोई कॉलेज उपलब्ध नहीं है।</em></div>');
        return;
    }
    var colClass = n === 1 ? 'col-md-6' : (n === 2 ? 'col-md-5' : 'col-md-4');
    for (var i = 0; i < n; i++) {
        var prefNum = i + 1;
        var isRequired = (i === 0);
        var labelHtml = 'Preference ' + prefNum + '/प्राथमिकता ' + prefNum +
            (isRequired ? ' <span class="text-danger">*</span>' : ' <small class="text-muted fw-normal">(Optional)</small>');
        var $div = $('<div class="college-pref-col ' + colClass + '"></div>');
        $div.append($('<label class="placeholder small text-muted"></label>').html(labelHtml));
        var $sel = $('<select class="form-control form-select college-pref-select" name="sport_college[]"></select>')
            .attr('id', 'college_pref_' + prefNum)
            .attr('data-pref-index', i);
        if (isRequired) $sel.attr('required', 'required');
        $div.append($sel);
        $container.append($div);
    }
    refreshAllPreferenceOptions(colleges, savedSelections);
}

function refreshAllPreferenceOptions(colleges, savedSelections) {
    var $selects = $(".college-pref-select");
    var currentValues = [];
    $selects.each(function(i) {
        if (savedSelections && i < savedSelections.length && savedSelections[i]) {
            currentValues.push(String(savedSelections[i]));
        } else {
            currentValues.push($(this).val() || '');
        }
    });
    $selects.each(function(i) {
        var $sel = $(this);
        var isRequired = (i === 0);
        var placeholder = isRequired ? 'Select College/कॉलेज चुनें' : 'Select College (optional)';
        var otherSelected = currentValues.filter(function(v, idx) { return idx !== i && v !== ''; });
        var opts = '<option value="">' + placeholder + '</option>';
        $.each(colleges, function(j, c) {
            if (otherSelected.indexOf(String(c.id)) === -1) {
                opts += '<option value="' + c.id + '">' + c.college_name + '</option>';
            }
        });
        $sel.html(opts);
        if (currentValues[i]) $sel.val(currentValues[i]);
    });
}

$(document).on("change", ".college-pref-select", function() {
    refreshAllPreferenceOptions(_lastCollegeList, null);
});

// ── Sport change: rebuild sub-sports + colleges via JS ──
$("#sport_type").change(function(){
    var id = $(this).val();
    if (!id) {
        $("#sub_sport_div").hide(); $("#sub_sport_required_star").hide();
        $("#sub_type").val('').removeAttr("required");
        _lastCollegeList = [];
        buildPreferenceBoxes([], []);
        return;
    }
    var subs = getSubSportsForSport(id);
    if (subs.length > 0) {
        var opts = '<option value="">Select/चुनें</option>';
        subs.forEach(function(s){ opts += '<option value="'+s.id+'">'+s.sub_type+'</option>'; });
        $("#sub_type").html(opts).attr("required", "required");
        $("#sub_sport_div").show(); $("#sub_sport_required_star").show();
    } else {
        $("#sub_sport_div").hide(); $("#sub_sport_required_star").hide();
        $("#sub_type").val('').removeAttr("required");
    }
    loadColleges([]);
});

// ── Sub-sport change ──
$("#sub_type").change(function(){ loadColleges([]); });

// ── Class change: rebuild sport list via JS ──
function loadAvailableSports(cls, preselectSport) {
    var sports = getSportsForClass(cls);
    var opts = '<option value="">Select Sport/खेल चुनें</option>';
    sports.forEach(function(s){ opts += '<option value="'+s.id+'">'+s.name+'</option>'; });
    $("#sport_type").html(opts);
    if (preselectSport) $("#sport_type").val(preselectSport);
    $("#sub_sport_div").hide(); $("#sub_sport_required_star").hide();
    $("#sub_type").val('').removeAttr("required");
    $("#college_prefs_container").html('<div class="col-12"><em class="text-muted small">Please select Sport to see available colleges. / खेल चुनें।</em></div>');
    _lastCollegeList = [];
}

function onClassChange(cls){
    if (!cls) {
        $("#sport_type").html('<option value="">Select Sport/खेल चुनें</option>');
        return;
    }
    if (userDob) {
        var dob = new Date(userDob);
        var ranges = {
            '6':  { min: new Date('2014-04-01'), max: new Date('2017-03-31') },
            '9':  { min: new Date('2011-04-01'), max: new Date('2014-03-31') },
            '11': { min: new Date('2009-04-01'), max: new Date('2011-03-31') }
        };
        var r = ranges[cls];
        if (r && (dob < r.min || dob > r.max)) {
            $("#dob_class_error").text('आपकी आयु Class ' + cls + 'वीं के लिए मान्य नहीं है। / Your age is not eligible for Class ' + cls + 'th admission.').show();
            $("#admission_seeking").val('');
            $("#sport_type").html('<option value="">Select Sport/खेल चुनें</option>');
            return;
        }
        $("#dob_class_error").hide();
    }
    loadAvailableSports(cls);
}
$("#admission_seeking").change(function(){ onClassChange($(this).val()); });

// ── Load + render college preference boxes ──
function loadColleges(savedSelections) {
    var sport   = $("#sport_type").val();
    var cls     = $("#admission_seeking").val();
    var subType = $("#sub_type").val();
    if (!sport || !cls) return;
    _lastCollegeList = getCollegesForSelection(sport, cls, subType);
    buildPreferenceBoxes(_lastCollegeList, savedSelections || []);
}

// ── Page-load init: restore saved sport/sub-sport/colleges without AJAX ──
$(document).ready(function(){
    var _preselectedSportId = "{{ $basic_detail->sport_type ?? '' }}";
    var _preselectedSubType = "{{ $basic_detail->sub_sport_type ?? '' }}";

    if (_preselectedSportId) {
        var subs = getSubSportsForSport(_preselectedSportId);
        if (subs.length > 0) {
            var opts = '<option value="">Select/चुनें</option>';
            subs.forEach(function(s){ opts += '<option value="'+s.id+'">'+s.sub_type+'</option>'; });
            $("#sub_type").html(opts).attr("required", "required");
            $("#sub_sport_div").show(); $("#sub_sport_required_star").show();
            if (_preselectedSubType) $("#sub_type").val(_preselectedSubType);
        } else {
            $("#sub_sport_div").hide(); $("#sub_sport_required_star").hide();
            $("#sub_type").removeAttr("required");
        }
        if ($("#admission_seeking").val()) {
            var savedColIds = @json($savedCollegeIds);
            loadColleges(savedColIds);
        }
    }
});

// Same as above checkbox
$("#sameAsAbove").change(function(){
    if($(this).is(":checked")){
        $(".corr[name=c_gram]").val($("input[name=p_gram]").val());
        $(".corr[name=c_post]").val($("input[name=p_post]").val());
        $(".corr[name=c_thana]").val($("input[name=p_thana]").val());
        // c_state is fixed to UP (value=23) — no state change needed
        $(".corr[name=c_pin]").val($("input[name=p_pin]").val());
        $(".corr[name=c_mobile]").val($("input[name=p_mobile]").val());
        $(".corr[name=c_alternate_mobile]").val($("input[name=p_alternate_mobile]").val());
        $(".corr[name=c_email]").val($("input[name=p_email]").val());
        $(".corr[name=c_district]").val($("select[name=p_district]").val());
    }
});
</script>
@endpush
