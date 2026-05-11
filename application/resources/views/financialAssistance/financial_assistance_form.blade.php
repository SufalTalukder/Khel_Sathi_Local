@extends('layouts/layout')
@section('content')
<div class="row">
    <!-- <div class="col-md-2">
        <a href="{{route('fadashboard')}}" class="btn btn-outline-info backbtn float-end"><span class="icons icon-arrow-left"></span>Back/पीछे</a>
        <div class="left-sidebar">
            <div>
                <ul>
                    <li><a href="{{ route('faprofile') }}"><span class="icons icon-arrow-left"></span>Profile Detail</a></li>
                    <li><a href="{{ route('faapplyFor') }}"><span class="icons icon-arrow-left"></span>Am applying for</a></li>
                    <li><a class="active"><span class="icons icon-arrow-right"></span>Application Form</a></li>
                </ul>
            </div>
        </div>
    </div> -->
    <div class="col-md-12">
        <div class="bhoechie-tab-container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="bhoechie-tab-content">
                        <div class="form-scroll">
                            <form action="{{route('save_financial_assistance')}}" method="post"  id="ajxReload"  enctype="multipart/form-data" class="needs-validation" novalidate="">
                                @csrf
                                <div>
                                    <div class="row">
                                        <!-- <div class="col-md-12">
                                            <h5 class="subheading">A. Applicant's Details/आवेदक का विवरण</h5>
                                        </div> -->
                                        <div class="col-md-12">
                                            <h5 class="subheading">Nomination Form for Financial Assistance / वित्तीय सहायता हेतु नामांकन</h5>
                                        </div>
                                        <!-- basic Detail -->
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>1. Name / नाम</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" value="{{$user->fullname}}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>2. Aadhar Number / आधार कार्ड</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" value="{{$user->aadhar_no}}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>3. Mobile Number / मोबाइल नंबर</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" value="{{$user->mobile}}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label>4. Email ID / ईमेल आईडी</label>
                                                <div class="input-group">
                                                    <input type="text" class="form-control" value="{{$user->email}}" readonly>
                                                </div>
                                            </div>
                                        </div>
                                        <!-- end basic detail -->
                                        <div class="col-md-12">
                                            <h5 class="subheading">A. Basic Details/सामान्य विवरण</h5>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="placeholder">Which Sport did/do you play?<br>कौन सा खेल खेलते थे/हैं?*<span class="text-danger">*</span></label>
                                                <select class="form-select sport_type" name="sport_type" required>
                                                    <option value="">Select</option>
                                                    @foreach ($sport_type as $type)
                                                    <option value="{{$type->id}}" {{ $selected_sport == $type->id ? 'selected' : '' }} {{ old('sport_type') === $type->id ? 'selected' : '' }}>{{$type->name}}</option>
                                                    @endforeach

                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Upload Domicile Certificate of UP<br>उत्तर प्रदेश का मूल निवास प्रमाण पत्र अपलोड करें<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="file" value="{{old('domicile_certificate') }}" name="domicile_certificate" class="form-control" onchange="getfileext(this.value,1)" id="File1" aria-describedby="inputGroupFileAddon05" aria-label="Upload" required>
                                                    <!-- <a  class="btn btn-secondary" id="A4">View</a> -->
                                                </div>
                                                <span class="note">(File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)<br>(फाइल का प्रारूप: JPEG/JPG/PDF | फाइल का अधिकतम साइज़: 2 MB)</span>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="placeholder">Highest Educational Qualification<br>उच्चतम शैक्षणिक योग्यता<span class="text-danger">*</span></label>
                                                <select class="form-control form-select dropdown" required id="qualification" name="qualification">
                                                    <option value="" selected="selected" disabled="disabled">Select</option>
                                                    <option {{ old('qualification') === "10" ? 'selected' : '' }} value="10">10th / High School</option>
                                                    <option {{ old('qualification') === "12" ? 'selected' : '' }} value="12">12th / Intermediate</option>
                                                    <option {{  old('qualification') === "graduation" ? 'selected' : '' }} value="graduation">Graduation</option>
                                                    <option {{  old('qualification') === "master_degree" ? 'selected' : '' }} value="master_degree">Master Degree</option>
                                                    <option {{ old('qualification') === "other" ? 'selected' : '' }} value="other">Other</option>
                                                </select>
                                                <!-- <input type="text" value="{{old('qualification') }}" class="form-control" name="qualification"  required> -->
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Upload Certificate of Highest Educational Qualification<br>उच्चतम शैक्षणिक योग्यता का प्रमाणपत्र अपलोड करें<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="file" name="qualification_doc" class="form-control" onchange="getfileext(this.value,2)" id="File2" aria-describedby="inputGroupFileAddon05" aria-label="Upload" required>
                                                    <!-- <a  class="btn btn-secondary" id="A4">View</a> -->
                                                </div>
                                                <span class="note">(File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)<br>(फाइल का प्रारूप: JPEG/JPG/PDF | फाइल का अधिकतम साइज़: 2 MB)</span>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <h5 class="subheading">B. Application form for Financial Assistance/वित्तीय सहायता हेतु आवेदन पत्र</h5>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="placeholder">Monthly Income through personal sources (INR)<br>निजी स्त्रोतों द्वारा मासिक आय (भारतीय रुपया)<span class="text-danger">*</span></label>
                                                <input type="text" value="{{old('monthly_income_personal') }}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" name="monthly_income_personal" required class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Upload Income Certificate<br>आय प्रमाणपत्र अपलोड करें<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="file" name="income_certificate" required class="form-control" onchange="getfileext(this.value,3)" id="File3" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
                                                    <!-- <a href="#" class="btn btn-secondary" id="A4">View</a> -->
                                                </div>
                                                <span class="note">(File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)<br>(फाइल का प्रारूप: JPEG/JPG/PDF | फाइल का अधिकतम साइज़: 2 MB)</span>
                                            </div>
                                        </div>
                                        <!-- <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Upload the District Magistrate's certificate for Income Verification  <span class="text-danger">*</span></label>
                                                            <div class="input-group">
                                                                <input type="file" name="dmc_income_verification" required  class="form-control" onchange="getfileext(this.value,4)" id="File4" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
                                                                <a href="#" class="btn btn-secondary" id="A4">View</a>
                                                            </div>
                                                            <span class="note">(File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)<br>(फाइल का प्रारूप: JPEG/JPG/PDF | फाइल का अधिकतम साइज़: 2 MB)</span>
                                                        </div>
                                                    </div> -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Level of Sport<br>खेल स्तर<span class="text-danger">*</span></label>
                                                <select name="level_of_report" required class="form-select">
                                                    <option value="">Select</option>
                                                    <!-- <option value="State level" {{ old('level_of_report') === "State level level" ? 'selected' : '' }}>State level</option> -->
                                                    <option value="National level" {{ old('level_of_report') === "National level" ? 'selected' : '' }}>National level</option>
                                                    <option value="International level" {{ old('level_of_report') === "International level" ? 'selected' : '' }}>International level</option>
                                                    <option value="State level" {{ old('level_of_report') === "State level" ? 'selected' : '' }}>State level</option>
                                                    <!-- <option value="Other level" {{ old('level_of_report') === "Other level" ? 'selected' : '' }}>Other level</option> -->
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Upload Relevant Certificate<br>प्रासंगिक प्रमाणपत्र अपलोड करें<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="file" name="relevant_certificate" required class="form-control" onchange="getfileext(this.value,5)" id="File5" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
                                                    <!-- <a href="#" class="btn btn-secondary" id="A4">View</a> -->
                                                </div>
                                                <span class="note">(File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)<br>(फाइल का प्रारूप: JPEG/JPG/PDF | फाइल का अधिकतम साइज़: 2 MB)</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="placeholder">Details of Other Achievements/Awards<br>अन्य उपलब्धियों/पुरस्कारों का विवरण</label>
                                                <input type="text" value="{{old('other_achievements') }}" name="other_achievements" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Upload Relevant Documents of Other Achievements/Awards<br>अन्य उपलब्धियों/पुरस्कारों के प्रासंगिक दस्तावेज अपलोड करें</label>
                                                <div class="input-group">
                                                    <input type="file" name="document_other_achievements" class="form-control" id="File4" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
                                                    <!-- <a href="#" class="btn btn-secondary" id="A4">View</a> -->
                                                </div>
                                                <span class="note">(File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)<br>(फाइल का प्रारूप: JPEG/JPG/PDF | फाइल का अधिकतम साइज़: 2 MB)</span>
                                            </div>
                                        </div>
                                        <!-- <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Upload Relevant Documents Justifying Achievements</label>
                                                            <div class="input-group">
                                                                <input type="file" name="document_justifying_achievements" required  class="form-control" id="File4" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
                                                                <a href="#" class="btn btn-secondary" id="A4">View</a>
                                                            </div>
                                                            <span class="note">(File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)<br>(फाइल का प्रारूप: JPEG/JPG/PDF | फाइल का अधिकतम साइज़: 2 MB)</span>
                                                        </div>
                                                    </div> -->
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="placeholder">Details of Total Professional Experience<br>कुल व्यावसायिक अनुभव का विवरण<span class="text-danger">*</span></label>
                                                <!-- <input placeholder="In months" type="text" value="{{old('total_professional_experience') }}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" name="total_professional_experience" required class="form-control"> -->
                                                <select name="total_professional_experience" required class="form-select">
                                                    <option value="">Select </option>
                                                    <option value="0 to 2 Years" {{ old('total_professional_experience') === "0 to 2 Years" ? 'selected' : '' }}>0 to 2 Years</option>
                                                    <option value="2 to 5 Years" {{ old('total_professional_experience') === "2 to 5 Years" ? 'selected' : '' }}>2 to 5 Years</option>
                                                    <option value="5 to 10 Years" {{ old('total_professional_experience') === "5 to 10 Years" ? 'selected' : '' }}>5 to 10 Years</option>
                                                    <option value="10+ Years" {{ old('total_professional_experience') === "10+ Years" ? 'selected' : '' }}>10+ Years</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="placeholder">If hold the experience of Sports Association<br>विवरण, यदि खेल संघ का अनुभव रखते हैं<span class="text-danger">*</span></label>
                                                <!-- <input type="text" value="{{old('experience_sports_association') }}" name="experience_sports_association"  class="form-control"> -->
                                                <select name="experience_sports_association" required id="experience_sports_association" class="form-select">
                                                    <option value="">Select</option>
                                                    <option value="Yes" {{old('experience_sports_association') === "Yes" ? 'selected' : '' }}>Yes</option>
                                                    <option value="No" {{ old('experience_sports_association') === "No" ? 'selected' : '' }}>No</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6" id="file6Div">
                                            <div class="form-group">
                                                <label>Upload Relevant Documents Justifying the Experience<br>अनुभव को सही ठहराते हुए प्रासंगिक दस्तावेज अपलोड करें </label>
                                                <div class="input-group">
                                                    <input type="file" name="document_justifying_experience" class="form-control" onchange="getfileext(this.value,6)" id="File6" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
                                                    <!-- <a href="#" class="btn btn-secondary" id="A4">View</a> -->
                                                </div>
                                                <span class="note">(File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)<br>(फाइल का प्रारूप: JPEG/JPG/PDF | फाइल का अधिकतम साइज़: 2 MB)</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="placeholder">Details of Income from other Sources<br>अन्य स्रोतों से आय का विवरण</label>
                                                <input type="text" value="{{old('income_other_sources') }}" name="income_other_sources" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Upload Relevant Documents Justifying the Income<br>आय को न्यायोचित ठहराते हुए प्रासंगिक दस्तावेज अपलोड करें</label>
                                                <div class="input-group">
                                                    <input type="file" name="income_document_other_sources" class="form-control" onchange="getfileext(this.value,7)" id="File7" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
                                                    <!-- <a href="#" class="btn btn-secondary" id="A4">View</a> -->
                                                </div>
                                                <span class="note">(File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)<br>(फाइल का प्रारूप: JPEG/JPG/PDF | फाइल का अधिकतम साइज़: 2 MB)</span>
                                            </div>
                                        </div>
                                        {{-- <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="placeholder">Details of Assistance being taken benefits of<br>प्राप्त की जा रही सहायता का विवरण<span class="text-danger">*</span></label>
                                                <input type="text" value="{{old('details_of_assistance_benefits') }}" name="details_of_assistance_benefits"   class="form-control">
                                            </div>
                                        </div> --}}
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>Upload Relevant Documents Justifying the Assistance<br>हायता को न्यायोचित ठहराते हुए प्रासंगिक दस्तावेज अपलोड करें </label>
                                                <div class="input-group">
                                                    <input type="file" name="relevant_documents_justifing_assistance"  class="form-control" onchange="getfileext(this.value,8)" id="File8" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
                                                    <!-- <a href="#" class="btn btn-secondary" id="A4">View</a> -->
                                                </div>
                                                <span class="note">(File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)<br>(फाइल का प्रारूप: JPEG/JPG/PDF | फाइल का अधिकतम साइज़: 2 MB)</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label class="placeholder">Is Applicant Physically Challenged ?<br>क्या आवेदक शारीरिक रूप से अक्षम है?<span class="text-danger">*</span></label>
                                                <!-- <input type="text" value="{{old('physical_condition') }}"  name="physical_condition" required class="form-control"> -->
                                                <select name="physical_condition" required id="physical_condition" class="form-select">
                                                    <option value="">Select</option>
                                                    <option value="Yes" {{ old('physical_condition') === "Yes" ? 'selected' : '' }}>Yes</option>
                                                    <option value="No" {{ old('physical_condition') === "No" ? 'selected' : '' }}>No</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-6" id="physical_condition_docs">
                                            <div class="form-group">
                                                <label>Upload Medical Certificate if the applicant is unfit or disabled<br>यदि आवेदक अक्षम अथवा दिव्यांग है तो चिकित्सा प्रमाणपत्र अपलोड करें</label>
                                                <div class="input-group">
                                                    <input type="file" name="medical_certificate" class="form-control" onchange="getfileext(this.value,9)" id="File9" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
                                                    <!-- <a href="#" class="btn btn-secondary" id="A4">View</a> -->
                                                </div>
                                                <span class="note">(File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)<br>(फाइल का प्रारूप: JPEG/JPG/PDF | फाइल का अधिकतम साइज़: 2 MB)</span>
                                            </div>
                                        </div>
                                        <!-- <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Upload Guardian Signature</label>
                                                            <div class="input-group">
                                                                <input type="file" required name="guardian_signature" class="form-control" id="File4" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
                                                                
                                                            </div>
                                                            <span class="note">(File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)<br>(फाइल का प्रारूप: JPEG/JPG/PDF | फाइल का अधिकतम साइज़: 2 MB)</span>
                                                        </div>
                                                    </div> -->
                                        <div class="col-md-12">
                                            <h5 class="subheading">C. Bank Account Details/बैंक खाते का विवरण</h5>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="placeholder">IFSC<br>आईएफएससी<span class="text-danger">*</span></label>
                                                <input type="text" value="{{old('bank_ifsc') }}" onblur="getBankDetails(this.value)" pattern="[A-Z]{4}0[A-Z0-9]{6}" name="bank_ifsc" required class="form-control" id="ifscupper">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="placeholder">Name of Bank<br>बैंक का नाम<span class="text-danger">*</span></label>
                                                <input name="bank_name" onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))' pattern="^[A-Za-z -]+$" value="{{old('bank_name') }}" required type="text" class="form-control" id="bankName">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="placeholder">Branch<br>शाखा<span class="text-danger">*</span></label>
                                                <input name="bank_branch" onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))' value="{{old('bank_branch') }}" required type="text" class="form-control" id="bank_branch">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="placeholder">Bank Account No.<br>बैंक खाता संख्या<span class="text-danger">*</span></label>
                                                <input type="text" value="{{old('bank_acc_no') }}" pattern=".{9,18}" minlength="9" maxlength="18" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" name="bank_acc_no" required class="form-control">
                                            </div>
                                        </div>
                                      
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="placeholder">Account Holder Name<br>खाता धारक का नाम<span class="text-danger">*</span></label>
                                                <input type="text" value="{{old('acc_holder_name') }}" onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))' pattern="^[A-Za-z -]+$" name="acc_holder_name" required class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="placeholder">PAN<br>पैन कार्ड<span class="text-danger">*</span></label>
                                                <input type="text" value="{{old('pan') }}" style="text-transform:uppercase" pattern="[a-zA-Z]{5}[0-9]{4}[a-zA-Z]{1}" name="pan" required class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="placeholder">Mobile No. (registered with Bank Account)<br>मोबाइल नंबर (बैंक खाते के साथ जो पंजीकृत है)<span class="text-danger">*</span></label>
                                                <input type="text" value="{{old('mobile_registered_in_bank') }}" pattern="[6-9][0-9]{9}$" required maxlength="10" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" name="mobile_registered_in_bank" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-5">
                                            <div class="form-group">
                                                <label class="placeholder">Any other relevant information applicant wants to specify?<br>कोई अन्य प्रासंगिक जानकारी आवेदक निर्दिष्ट करना चाहते हैं?</label>
                                                <input value="{{old('other_relevant_information_applicant') }}" name="other_relevant_information_applicant" type="text" class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <h5 class="subheading">D. Sports Achievements/खेल संबंधी उपलब्धियां</h5>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <form name="add_name1" id="add_name1">
                                                    <table class="table table-bordered" id="dynamic_field1">
                                                        <thead>
                                                            <tr>
                                                                <td style="font-weight: bold;">Level of Sport<br>खेल स्तर</td>
                                                                <td style="font-weight: bold;">Position<br>पद</td>
                                                                <td style="font-weight: bold;"><span class="note"><b style="color:#212529">Docs</b> (File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)</span><br><span class="note"><b style="color:#212529">दस्तावेज</b> (फाइल का प्रारूप: JPEG/JPG/PDF | फाइल का अधिकतम साइज़: 2 MB)</span></td>
                                                                <td></td>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                <td>
                                                                    <select name="sport_achievement[]" required class="form-select">
                                                                        <option value="">Select</option>
                                                                        <option {{old('sport_achievement')=='National'?'Selected':''}} value="National">National</option>
                                                                        <option {{old('sport_achievement')=='International'?'Selected':''}} value="International">International</option>
                                                                        <option {{old('sport_achievement')=='State'?'Selected':''}} value="State">State</option>
                                                                    </select>
                                                                </td>
                                                                <td><input type="text" required value="{{old('sport_achievement_docs[]') }}" name="sport_achievement_name[]" onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))' placeholder="Name of the Position" class="form-control name_email"></td>
                                                                <td>
                                                                    <div class="input-group"><input required name="sport_achievement_docs[]" type="file" class="form-control" onchange="getfileext(this.value,10)" id="File10" aria-describedby="inputGroupFileAddon05" aria-label="Upload"></div>
                                                                </td>
                                                                <td><button type="button" name="add" id="add1" class="btn btn-primary mt-1">Add More</button></td>
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="bhoechie-footer">
                                            <div class="row justify-content-center">
                                                <div class="col-md-3 d-grid">
                                                    <button type="submit" class="btn btn-info">Save & Proceed/दर्ज करें व आगे बढ़ें</button>
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
@endsection
@push('custom-scripts')
<script>
    $(document).ready(function() {
        // $('.sport_type').attr("style", "pointer-events: none;");
$('#physical_condition_docs').hide();
        var i = 1;
        var length;

        $("#add1").click(function() {

            i++;
            $('#dynamic_field1').append('<tr id="row' + i + '"><td><select class="form-select" required name="sport_achievement[]" class="form-control name_list"><option value="">Select</option><option  value="National">National</option><option  value="International">International</option><option value="State">State</option></td><td><input type="text" required name="sport_achievement_name[]" onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))" placeholder="Name of the Position" class="form-control name_email"/></td><td><div class="input-group"><input type="file" class="form-control" required name="sport_achievement_docs[]"  onchange="getfileext(this.value,2' + i + ')" id="File2' + i + '" aria-describedby="inputGroupFileAddon05" aria-label="Upload"></div></td><td><button type="button" name="remove" id="' + i + '" class="btn btn-danger mt-1 px-2 btn_remove"><span class="far fa-trash-alt"></span></button></td></tr>');
        });

        $(document).on('click', '.btn_remove', function() {
            var button_id = $(this).attr("id");
            $('#row' + button_id + '').remove();
        });


        $("#physical_condition").on('change', function() {
            if (this.value == "Yes") {
                $("#File9").attr('required', true);
                $('#physical_condition_docs').show();
                
            } else {
                $("#File9").attr('required', false);
                $('#physical_condition_docs').hide();
            }

        });
        $("#experience_sports_association").on('change', function() {
            if (this.value == "Yes") {
                $("#File6").attr('required', true);
                $('#file6Div').show();
            } else {
                $("#File6").attr('required', false);
                $('#file6Div').hide();

            }

        });



    });

    
//     jQuery('#ifscupper').keyup(function() {
// 		$(this).val($(this).val().toUpperCase());
// 	});
//     function getBankDetails(bankifsc){
          
//           $.ajax({
//                   type: 'GET',
//                   url: ajaxUrl + "/financial-assistance/ifsc",
//                   data: {
                        
//                           ifsc: bankifsc
//                   },
//                   dataType: "json",
//                   success: function(res) {
//                           if(res.error == false){
//                            console.log(res.data);
//                            $("#bankName").val(res.data.BANK);
//                            $('#bank_branch').val(res.data.BRANCH);
//                         }
//                   }
//           });
//   };

</script>
@endpush
