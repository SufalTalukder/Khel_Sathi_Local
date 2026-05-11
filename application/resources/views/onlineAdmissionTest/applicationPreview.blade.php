@extends('layouts.onlineAdmissionTestNav')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="pageheader pb-2">
            <h5>Preview Online Application / उ.प्र. के स्पोर्ट्स कॉलेज में प्रवेश हेतु ऑनलाइन आवेदन का पूर्वावलोकन
                <div class="float-end">
                    @if(($data->final_status ?? 0) != 1)
                    <a href="{{ route('onlineAdmissionTest.applicationForm') }}" class="btn btn-outline-secondary btn-sm rounded-pill me-2">← Edit/संपादित करें</a>
                    @endif
                    <a href="{{ route('onlineAdmissionTest.dashboard') }}" class="btn btn-outline-info btn-sm rounded-pill me-2">← Dashboard</a>
                    <button onclick="window.print()" class="btn btn-outline-primary btn-sm rounded-pill">🖨 Print</button>
                </div>
            </h5>
        </div>
    </div>
</div>

<div class="card mt-2" id="prodiv">
    <div class="card-body p-2">
        <table class="table table-bordered table-sm" style="font-size:13px; border-collapse:collapse; width:100%">

            {{-- ── Basic / Registration Details ── --}}
            <tr class="table-success">
                <td colspan="6"><strong>Basic Details/मूल विवरण</strong></td>
            </tr>
            <tr>
                <td><b>Registration No./पंजीकरण संख्या</b></td>
                <td>{{ $data->application_no ?? 'NA' }}</td>
                <td><b>Application No./आवेदन संख्या</b></td>
                <td>{{ $data->application_no ?? 'NA' }}</td>
                <td rowspan="6" colspan="2" style="width:15%; text-align:center; vertical-align:middle;">
                    @if($data && $data->applicant_photograph)
                        <img src="{{ asset('onlineAdmission_storage/images/'.$data->applicant_photograph) }}" style="width:100%; max-height:130px; object-fit:cover;" class="border mb-1"><br>
                        <small>Photograph/फोटो</small><br>
                    @else
                        <div style="height:100px; border:1px dashed #ccc; display:flex; align-items:center; justify-content:center;">No Photo</div>
                    @endif
                    @if($data && $data->applicant_signature)
                        <img src="{{ asset('onlineAdmission_storage/images/'.$data->applicant_signature) }}" style="width:100%; max-height:40px;" class="border mt-1"><br>
                        <small>Signature/हस्ताक्षर</small>
                    @endif
                </td>
            </tr>
            <tr>
                <td><b>Applicant Name/आवेदक का नाम</b></td>
                <td>{{ $data->fullname ?? 'NA' }}</td>
                <td><b>Date of Birth/जन्मतिथि</b></td>
                <td>{{ $data->dob ? date('d-m-Y', strtotime($data->dob)) : 'NA' }}</td>
            </tr>
            <tr>
                <td><b>Aadhaar No./आधार संख्या</b></td>
                <td>{{ $data->aadhar_no ?? 'NA' }}</td>
                <td><b>Mobile No./मोबाइल नंबर</b></td>
                <td>{{ $data->mobile ?? 'NA' }}</td>
            </tr>
            <tr>
                <td><b>Email ID/ईमेल</b></td>
                <td>{{ $data->email ?? 'NA' }}</td>
                <td><b>PEN No./व्यक्तिगत शिक्षा संख्या</b></td>
                <td>{{ $data->pen_no ?? 'NA' }}</td>
            </tr>
            <tr>
                <td><b>Gender/लिंग</b></td>
                <td>{{ ($data->gender ?? '') == 1 ? 'Male/पुरुष' : (($data->gender ?? '') == 2 ? 'Female/महिला' : 'NA') }}</td>
                <td><b>Native of UP?/उ.प्र. मूल निवासी?</b></td>
                <td>{{ ($data->native_of_up ?? '') == 1 ? 'Yes/हाँ' : 'No/नहीं' }}</td>
            </tr>
            <tr>
                <td><b>District/जनपद</b></td>
                <td>{{ $data->p_district_name ?? 'NA' }}</td>
                <td><b>Sports College/स्पोर्ट्स कॉलेज</b></td>
                <td>{{ implode(', ', $collegeNames) ?: 'NA' }}</td>
            </tr>

            {{-- Applicant Details --}}
            <tr>
                <td><b>Sports Name/खेल का नाम</b></td>
                <td>{{ $data->sport_name ?? 'NA' }}</td>
                <td><b>Sub-Sport/उप खेल</b></td>
                <td>{{ $subSportName ?? 'NA' }}</td>
                <td><b>Category/श्रेणी</b></td>
                <td>{{ ['1'=>'General','2'=>'OBC','3'=>'SC','4'=>'ST'][$data->category ?? ''] ?? 'NA' }}</td>
            </tr>
            <tr>
                <td><b>Sub-Category/उप-श्रेणी</b></td>
                <td>{{ $data->sub_category ?? 'NA' }}</td>
                <td><b>PEN No./व्यक्तिगत शिक्षा संख्या</b></td>
                <td>{{ $data->pen_no ?? 'NA' }}</td>
                <td><b>Class Seeking/कक्षा</b></td>
                <td>{{ $data->admission_seeking ?? 'NA' }}</td>
            </tr>
            <tr>
                <td><b>Height/लंबाई (cm)</b></td>
                <td>{{ $data->height ?? 'NA' }}</td>
                <td><b>Weight/वजन (kg)</b></td>
                <td>{{ $data->weight ?? 'NA' }}</td>
                <td><b>Blood Group/रक्त समूह</b></td>
                <td>{{ $data->blood_group ?? 'NA' }}</td>
            </tr>
            <tr>
                <td><b>Identification Mark/पहचान चिह्न</b></td>
                <td colspan="3">{{ $data->identification_marks ?? 'NA' }}</td>
                <td><b>Disease/रोग</b></td>
                <td>{{ ($data->disease ?? '') == 1 ? 'Yes/हाँ' : 'No/नहीं' }}</td>
            </tr>

            {{-- Parents --}}
            <tr>
                <td><b>Father Name/पिता का नाम</b></td>
                <td>{{ $data->father_name ?? 'NA' }}</td>
                <td><b>Father Occupation/व्यवसाय</b></td>
                <td>{{ $data->father_occupation ?? 'NA' }}</td>
                <td><b>Father Aadhaar/आधार</b></td>
                <td>{{ $data->father_aadhar ? 'Uploaded ✓' : 'NA' }}</td>
            </tr>
            <tr>
                <td><b>Mother Name/माता का नाम</b></td>
                <td>{{ $data->mother_name ?? 'NA' }}</td>
                <td><b>Mother Occupation/व्यवसाय</b></td>
                <td>{{ $data->mother_occupation ?? 'NA' }}</td>
                <td><b>Mother Aadhaar/आधार</b></td>
                <td>{{ $data->mother_aadhar ? 'Uploaded ✓' : 'NA' }}</td>
            </tr>

            {{-- Communication --}}
            <tr class="table-success">
                <td colspan="6"><strong>Communication Details/संचार विवरण</strong></td>
            </tr>
            <tr>
                <td><b>Permanent Address/स्थायी पता</b></td>
                <td colspan="2">{{ $data->p_gram ?? '' }}, {{ $data->p_post ?? '' }}, {{ $data->p_thana ?? '' }}</td>
                <td><b>State/District</b></td>
                <td colspan="2">{{ $data->p_state_name ?? 'NA' }} / {{ $data->p_district_name ?? 'NA' }}</td>
            </tr>
            <tr>
                <td><b>PIN Code/पिन कोड</b></td>
                <td>{{ $data->p_pin ?? 'NA' }}</td>
                <td><b>Mobile/मोबाइल</b></td>
                <td>{{ $data->p_mobile ?? 'NA' }}</td>
                <td><b>Alt. Mobile/वैकल्पिक</b></td>
                <td>{{ $data->p_alternate_mobile ?? 'NA' }}</td>
            </tr>
            <tr>
                <td><b>Email/ईमेल</b></td>
                <td colspan="5">{{ $data->p_email ?? 'NA' }}</td>
            </tr>
            <tr>
                <td><b>Correspondence Address/पत्राचार पता</b></td>
                <td colspan="2">{{ $data->c_gram ?? '' }}, {{ $data->c_post ?? '' }}, {{ $data->c_thana ?? '' }}</td>
                <td><b>State/District</b></td>
                <td colspan="2">{{ $data->c_state_name ?? 'NA' }} / {{ $data->c_district_name ?? 'NA' }}</td>
            </tr>
            <tr>
                <td><b>PIN Code/पिन कोड</b></td>
                <td colspan="5">{{ $data->c_pin ?? 'NA' }}</td>
            </tr>

            {{-- Education --}}
            <tr class="table-success">
                <td colspan="6"><strong>Educational Qualification/शैक्षिक योग्यता विवरण</strong></td>
            </tr>
            <tr>
                <td><b>UDISE Code</b></td>
                <td>{{ $data->updise_code ?? 'NA' }}</td>
                <td><b>School Name/विद्यालय</b></td>
                <td>{{ $data->school ?? 'NA' }}</td>
                <td><b>Previously Studied in Class/पूर्व में अध्ययन की कक्षा</b></td>
                <td>{{ $data->class ?? 'NA' }}</td>
            </tr>
            <tr>
                <td><b>Year of Passing/उत्तीर्ण वर्ष</b></td>
                <td>{{ $data->year_of_passing ?? 'NA' }}</td>
                <td><b>Maximum Marks/अधिकतम अंक</b></td>
                <td>{{ $data->maximum_marks ?? 'NA' }}</td>
                <td><b>Obtained Marks/प्राप्त अंक</b></td>
                <td>{{ $data->obtained_marks ?? 'NA' }}</td>
            </tr>
            <tr>
                <td><b>Grade/Percentage/ग्रेड</b></td>
                <td>{{ $data->grade_percentage ?? 'NA' }}</td>
                <td><b>Educational Certificate</b></td>
                <td>{{ ($data->education_certificate ?? '') ? 'Uploaded ✓' : 'NA' }}</td>
                <td><b>Aadhaar Card</b></td>
                <td>{{ ($data->applicant_aadhar_birth_certificate ?? '') ? 'Uploaded ✓' : 'NA' }}</td>
            </tr>
            <tr>
                <td><b>Birth Certificate/जन्म प्रमाणपत्र</b></td>
                <td>{{ ($data->applicant_birth_certificate ?? '') ? 'Uploaded ✓' : 'NA' }}</td>
            </tr>
            <tr>
                <td><b>Gap/Repeater Affidavit/गैप शपथ पत्र</b></td>
                <td>{{ ($data->affidavit ?? '') ? 'Uploaded ✓' : 'Not Uploaded (Optional)' }}</td>
                <td></td><td></td>
            </tr>
            {{-- Trial Venue --}}
            <tr class="table-success">
                <td colspan="6"><strong>Trial Venue Details / परीक्षण स्थल का विवरण</strong></td>
            </tr>
            <tr>
                @php
                    $from = \Carbon\Carbon::parse($data->trial_from_date);
                    $to   = ($data->trial_to_date && $data->trial_to_date !== '0000-00-00' && $data->trial_to_date !== $data->trial_from_date)
                            ? \Carbon\Carbon::parse($data->trial_to_date)
                            : null;
                @endphp
                <td><b>Trial Venue / परीक्षण स्थल</b></td>
                <td>{{ $data->trial_location ?? 'NA' }}</td>
                <td><b>Trial Date / परीक्षण तिथि</b></td>
                <td>{{ $from->format('jS F Y') }}
                    @if($to) &amp; {{ $to->format('jS F Y') }} @endif</td>
                <td><b>Trial Time / परीक्षण समय</b></td>
                <td>{{ $data->trial_time ?? 'NA' }}</td>
            </tr>
            {{-- Declaration --}}
            <tr class="table-success">
                <td colspan="6"><strong>Declaration/घोषणा</strong></td>
            </tr>
            <tr>
                <td colspan="6" class="small">
                    1. I hereby certify that I have read and understood all Terms &amp; Conditions for filling this online Application Form and abide by them.<br>
                    2. I also certify that all the information provided above is true and correct to the best of my knowledge.<br>
                    3. I understand that if any of the above mentioned facts is found to be incorrect, my ward shall be liable for disqualification from admission in the Sports Colleges under Department of Sports, UP.<br>
                    4. I hereby declare that I have submitted the required affidavit in case of any gap in my education or if I am a repeating student. I understand that failure to submit the affidavit may result in the cancellation of my application form. / मैं यह घोषित करता/करती हूँ कि यदि मेरी शिक्षा में कोई अंतराल (गैप) है या मैं पुनरावृत्ति (रीपीट) छात्र हूँ, तो मैंने आवश्यक शपथ पत्र जमा कर दिया है। मैं समझता/समझती हूँ कि शपथ पत्र जमा न करने पर मेरा आवेदन पत्र निरस्त किया जा सकता है।<br>
                    5. I hereby declare that I understand that under the centralized process, my biological age test will be conducted based on the merit list of the main selection examination, with the consent of my parent/guardian. I further understand that in case of عدم consent from my parent/guardian, my candidature will be cancelled. / मैं यह घोषित करता/करती हूँ कि मुख्य चयन परीक्षा की श्रेष्ठता सूची के आधार पर केंद्रीय व्यवस्था के अंतर्गत, अभिभावक की सहमति से मेरी जैविक आयु जांच करायी जाएगी। मैं यह भी समझता/समझती हूँ कि यदि अभिभावक की असहमति होती है, तो मेरा अभ्यर्थन निरस्त कर दिया जाएगा।<br>
            <br>
                    <b>☑ I Agree/मैं सहमत हूँ</b>
                </td>
            </tr>
        </table>
    </div>
</div>

<div class="d-flex justify-content-center gap-3 mt-3 mb-5">
    @if(($data->final_status ?? 0) != 1)
    <a href="{{ route('onlineAdmissionTest.applicationForm') }}" class="btn btn-outline-secondary rounded-pill px-4">← Edit/संपादित करें</a>
    <button type="button" class="btn btn-danger rounded-pill px-4" data-bs-toggle="modal" data-bs-target="#onlineFinalWarning">
        Final Submit/अंतिम जमा करें
    </button>
    @else
        <div class="text-center">
            <h5 class="text-success">Application Submitted Successfully!/आवेदन सफलतापूर्वक जमा हुआ!</h5>
            @if(($data->payment_status ?? 0) == 0)
                <a href="{{ route('onlineAdmissionTest.trialSchedule') }}" class="btn btn-primary mt-2 rounded-pill px-4">View Trial Venue &amp; Pay/परीक्षा स्थल देखें और भुगतान करें</a>
            @else
                <span class="badge bg-success fs-6 rounded-pill px-4">Payment Done ✓</span>
            @endif
        </div>
    @endif
</div>
@endsection

@push('custom-scripts')
<script>
document.getElementById("final_submit") && document.getElementById("final_submit").addEventListener("click", function(){
    $.ajax({
        type:"POST", url:"{{ route('onlineAdmissionTest.finalSubmit') }}",
        data:{ _token:"{{ csrf_token() }}" }, dataType:"json",
        success: function(res){
            if(res.error==false){ success(res.msg); setTimeout(()=>{ window.location.href=res.url; },1000); }
            else{ error(res.msg); }
        }
    });
    $('#onlineFinalWarning').modal('hide');
});
</script>
@endpush
