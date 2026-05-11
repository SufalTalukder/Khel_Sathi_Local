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
                            <form action="{{route('updatefinancialform')}}" method="post"  id="ajxReload"  enctype="multipart/form-data" class="needs-validation" novalidate="">
                                @csrf
                                <div class="row">
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
                                    @foreach($financial_assistance as $item)
                                    <div class="col-md-6">
                                    <input type="hidden" name="application_no" value="{{$item->application_no}}">
                                        <div class="form-group">
                                            <label class="placeholder">1. Which Sport do/did you play?<br>कौन सा खेल खेलते थे/हैं?<span class="text-danger">*</span></label>
                                            <select class="form-select sport_type" name="sport_type" required>
                                                <option value="">Select</option>
                                                @foreach ($sport_type as $type)
                                                <option value="{{$type->id}}" {{ $item->sport_type === $type->id ? 'selected' : '' }}>{{$type->name}}</option>
                                                @endforeach

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>2. Upload Domicile Certificate of UP<br>उत्तर प्रदेश का मूल निवास प्रमाण पत्र अपलोड करें<span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <input type="file" name="domicile_certificate" class="form-control" onchange="getfileext(this.value,3)" id="File3" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
                                                <input type="hidden" value="{{$item->domicile_certificate}}" name="domicile_certificate1">
                                                <!-- <a  class="btn btn-secondary" id="A4">View</a> -->
                                                @if($item->domicile_certificate !='')
                                                @php
                                                $img = url('storage/financial_assistance').'/'.$item->domicile_certificate;
                                                $img1 = url('public/images/view.jpg');
                                                $doc = explode('.',$item->domicile_certificate);

                                                @endphp
                                                <img src="{{$img1}}" role="button" onclick="appendImage('{{$img}}','{{$doc[1]}}')" class="img-fluid" />

                                                <!-- <a class="btn btn-success" href="{{url('storage/direct_recruitment',$item->domicile_certificate)}}" target="_blank">
                                                                    View
                                                                </a> -->
                                                @endif
                                            </div>
                                            <span class="note">(File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)<br>(फाइल का प्रारूप: JPEG/JPG/PDF | फाइल का अधिकतम साइज़: 2 MB)</span>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="placeholder">3. Highest Educational Qualification<br>उच्चतम शैक्षणिक योग्यता <span class="text-danger">*</span></label>
                                            <select class="form-control form-select dropdown" required id="qualification" name="qualification">
                                                    <option value="" selected="selected" disabled="disabled">Select</option>
                                                    <option {{ $item->qualification === "10" ? 'selected' : '' }} value="10">10th / High School</option>
                                                    <option {{ $item->qualification === "12" ? 'selected' : '' }} value="12">12th / Intermediate</option>
                                                    <option {{  $item->qualification === "graduation" ? 'selected' : '' }} value="graduation">Graduation</option>
                                                    <option {{  $item->qualification === "master_degree" ? 'selected' : '' }} value="master_degree">Master Degree</option>
                                                    <option {{ $item->qualification === "other" ? 'selected' : '' }} value="other">Other</option>
                                                </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>4. Upload Certificate of Highest Educational Qualification<br>उच्चतम शैक्षणिक योग्यता का प्रमाणपत्र अपलोड करें<span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <input type="file" name="qualification_doc" class="form-control" onchange="getfileext(this.value,4)" id="File4" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
                                                <input type="hidden" value="{{$item->qualification_doc}}" name="qualification_doc1" class="form-control">
                                                <!-- <a  class="btn btn-secondary" id="A4">View</a> -->
                                                @if($item->qualification_doc !='')
                                                <!-- <a class="btn btn-success" href="{{url('storage/direct_recruitment',$item->qualification_doc)}}" target="_blank">
                                                                    View
                                                                </a> -->
                                                @php
                                                $img = url('storage/financial_assistance').'/'.$item->qualification_doc;
                                                $img1 = url('public/images/view.jpg');
                                                $doc = explode('.',$item->qualification_doc);

                                                @endphp
                                                <img src="{{$img1}}" role="button" onclick="appendImage('{{$img}}','{{$doc[1]}}')" class="img-fluid" />

                                                @endif
                                            </div>
                                            <span class="note">(File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)<br>(फाइल का प्रारूप: JPEG/JPG/PDF | फाइल का अधिकतम साइज़: 2 MB)</span>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <h5 class="subheading">B. Financial Assistance Details/वित्तीय सहायता संबंधी विवरण <span class="text-danger">*</span></h5>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="placeholder">1. Monthly Income through personal sources (INR)<br>निजी स्त्रोतों द्वारा मासिक आय (भारतीय रुपया)<span class="text-danger">*</span></label>
                                            <input type="text" value="{{$item->monthly_income_personal}}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" name="monthly_income_personal" required class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>2. Upload Income Certificate<br>आय प्रमाणपत्र अपलोड करें<span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <input type="file" name="income_certificate" class="form-control" onchange="getfileext(this.value,5)" id="File5" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
                                                <input type="hidden" value="{{$item->income_certificate}}" name="income_certificate1" class="form-control">
                                                <!-- <a href="#" class="btn btn-secondary" id="A4">View</a> -->
                                                @if($item->income_certificate !='')
                                                <!-- <a class="btn btn-success" href="{{url('storage/direct_recruitment',$item->income_certificate)}}" target="_blank">
                                                                    View
                                                                </a> -->
                                                @php
                                                $img = url('storage/financial_assistance').'/'.$item->income_certificate;
                                                $img1 = url('public/images/view.jpg');
                                                $doc = explode('.',$item->income_certificate);

                                                @endphp
                                                <img src="{{$img1}}" role="button" onclick="appendImage('{{$img}}','{{$doc[1]}}')" class="img-fluid" />

                                                @endif
                                            </div>
                                            <span class="note">(File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)<br>(फाइल का प्रारूप: JPEG/JPG/PDF | फाइल का अधिकतम साइज़: 2 MB)</span>
                                        </div>
                                    </div>
                                    <!-- <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Upload the District Magistrate's certificate for Income Verification <span class="text-danger">*</span></label>
                                                            <div class="input-group">
                                                                <input type="file" name="dmc_income_verification"   class="form-control" onchange="getfileext(this.value,6)" id="File6" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
                                                                <input type="hidden"  value="{{$item->dmc_income_verification}}" name="dmc_income_verification1" class="form-control" >
                                                               
                                                                @if($item->dmc_income_verification !='')
                                                                <a class="btn btn-success" href="{{url('storage/direct_recruitment',$item->dmc_income_verification)}}" target="_blank">
                                                                    View
                                                                </a>
                                                                @endif
                                                            </div>
                                                            <span class="note">(File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)<br>(फाइल का प्रारूप: JPEG/JPG/PDF | फाइल का अधिकतम साइज़: 2 MB)</span>
                                                        </div>
                                                    </div> -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>3. Level of Sport<br>खेल स्तर<span class="text-danger">*</span></label>
                                            <select name="level_of_report" required class="form-select">
                                                <option value="">Select</option>
                                                <option value="State level" {{ $item->level_of_report === "State level" ? 'selected' : '' }}>State level</option>
                                                <option value="National level" {{ $item->level_of_report === "National level" ? 'selected' : '' }}>National level</option>
                                                <option value="International level" {{ $item->level_of_report === "International level" ? 'selected' : '' }}>International level</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>4. Upload Relevant Certificate<br>प्रासंगिक प्रमाणपत्र अपलोड करें<span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <input type="file" name="relevant_certificate" class="form-control" onchange="getfileext(this.value,7)" id="File7" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
                                                <input type="hidden" value="{{$item->relevant_certificate}}" name="relevant_certificate1" class="form-control">
                                                <!-- <a href="#" class="btn btn-secondary" id="A4">View</a> -->
                                                @if($item->relevant_certificate !='')
                                                <!-- <a class="btn btn-success" href="{{url('storage/direct_recruitment',$item->relevant_certificate)}}" target="_blank">
                                                                    View
                                                                </a> -->
                                                @php
                                                $img = url('storage/financial_assistance').'/'.$item->relevant_certificate;
                                                $img1 = url('public/images/view.jpg');
                                                $doc = explode('.',$item->relevant_certificate);

                                                @endphp
                                                <img src="{{$img1}}" role="button" onclick="appendImage('{{$img}}','{{$doc[1]}}')" class="img-fluid" />

                                                @endif
                                            </div>
                                            <span class="note">(File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)<br>(फाइल का प्रारूप: JPEG/JPG/PDF | फाइल का अधिकतम साइज़: 2 MB)</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="placeholder">5. Details of Other Achievements/Awards<br>अन्य उपलब्धियों/पुरस्कारों का विवरण</label>
                                            <input type="text" value="{{$item->other_achievements}}" name="other_achievements" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>6. Upload Relevant Documents of Other Achievements/Awards<br>अन्य उपलब्धियों/पुरस्कारों के प्रासंगिक दस्तावेज अपलोड करें</label>
                                            <div class="input-group">
                                                <input type="file" name="document_other_achievements" class="form-control" onchange="getfileext(this.value,8)" id="File8" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
                                                <input type="hidden" value="{{$item->document_other_achievements}}" name="document_other_achievements1" class="form-control">
                                                <!-- <a href="#" class="btn btn-secondary" id="A4">View</a> -->
                                                @if($item->document_other_achievements !='')
                                                <!-- <a class="btn btn-success" href="{{url('storage/direct_recruitment',$item->document_other_achievements)}}" target="_blank">
                                                                    View
                                                                </a> -->
                                                @php
                                                $img = url('storage/financial_assistance').'/'.$item->document_other_achievements;
                                                $img1 = url('public/images/view.jpg');
                                                $doc = explode('.',$item->document_other_achievements);

                                                @endphp
                                                <img src="{{$img1}}" role="button" onclick="appendImage('{{$img}}','{{$doc[1]}}')" class="img-fluid" />

                                                @endif

                                            </div>
                                            <span class="note">(File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)<br>(फाइल का प्रारूप: JPEG/JPG/PDF | फाइल का अधिकतम साइज़: 2 MB)</span>
                                        </div>
                                    </div>
                                    <!-- <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Upload Relevant Documents Justifying Achievements <span class="text-danger">*</span></label>
                                                            <div class="input-group">
                                                                <input type="file" name="document_justifying_achievements"   class="form-control" onchange="getfileext(this.value,9)" id="File9" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
                                                                <input type="hidden"  value="{{$item->document_justifying_achievements}}" name="document_justifying_achievements1" class="form-control" >
                                                                
                                                                <a href="#" class="btn btn-secondary" id="A4">View</a>
                                                            </div>
                                                            <span class="note">(File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)<br>(फाइल का प्रारूप: JPEG/JPG/PDF | फाइल का अधिकतम साइज़: 2 MB)</span>
                                                        </div>
                                                    </div> -->
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="placeholder">7. Details of Total Professional Experience<br>कुल व्यावसायिक अनुभव<span class="text-danger">*</span></label>
                                            <input type="text" value="{{$item->total_professional_experience }}" name="total_professional_experience" required class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="placeholder">8. If hold the experience of Sports Association<br>विवरण, यदि खेल संघ का अनुभव रखते हैं<span class="text-danger">*</span></label>
                                            <select name="experience_sports_association" required id="experience_sports_association" class="form-select">
                                                <option value="">Select</option>
                                                <option value="Yes" {{ $item->experience_sports_association === "Yes" ? 'selected' : '' }}>Yes</option>
                                                <option value="No" {{ $item->experience_sports_association === "No" ? 'selected' : '' }}>No</option>
                                            </select>
                                            <!-- <input type="text" value="{{$item->experience_sports_association}}" name="experience_sports_association"  class="form-control"> -->
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>9. Upload Relevant Documents Justifying the Experience<br>अनुभव को सही ठहराते हुए प्रासंगिक दस्तावेज अपलोड करें</label>
                                            <div class="input-group">
                                                <input type="file" name="document_justifying_experience" class="form-control" onchange="getfileext(this.value,10)" id="File10" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
                                                <input type="hidden" value="{{$item->document_justifying_experience}}" name="document_justifying_experience1" class="form-control">
                                                @if($item->document_justifying_experience !='')
                                                <!-- <a class="btn btn-success" href="{{url('storage/direct_recruitment',$item->document_justifying_experience)}}" target="_blank">
                                                                    View
                                                                </a> -->
                                                @php
                                                $img = url('storage/financial_assistance').'/'.$item->document_justifying_experience;
                                                $img1 = url('public/images/view.jpg');
                                                $doc = explode('.',$item->document_justifying_experience);

                                                @endphp
                                                <img src="{{$img1}}" role="button" onclick="appendImage('{{$img}}','{{$doc[1]}}')" class="img-fluid" />

                                                @endif
                                                <!-- <a href="#" class="btn btn-secondary" id="A4">View</a> -->
                                            </div>
                                            <span class="note">(File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)<br>(फाइल का प्रारूप: JPEG/JPG/PDF | फाइल का अधिकतम साइज़: 2 MB)</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="placeholder">10. Details of Income from other Sources<br>अन्य स्रोतों से आय का विवरण</label>
                                            <input type="text" value="{{$item->income_other_sources }}" name="income_other_sources" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>11. Upload Relevant Documents Justifying the Income<br>आय को न्यायोचित ठहराते हुए प्रासंगिक दस्तावेज अपलोड करें</label>
                                            <div class="input-group">
                                                <input type="file" name="income_document_other_sources" class="form-control" onchange="getfileext(this.value,11)" id="File11" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
                                                <input type="hidden" value="{{$item->income_document_other_sources}}" name="income_document_other_sources1" class="form-control">
                                                @if($item->income_document_other_sources !='')
                                                <!-- <a class="btn btn-success" href="{{url('storage/direct_recruitment',$item->income_document_other_sources)}}" target="_blank">
                                                                    View
                                                                </a> -->
                                                @php
                                                $img = url('storage/financial_assistance').'/'.$item->income_document_other_sources;
                                                $img1 = url('public/images/view.jpg');
                                                $doc = explode('.',$item->income_document_other_sources);

                                                @endphp
                                                <img src="{{$img1}}" role="button" onclick="appendImage('{{$img}}','{{$doc[1]}}')" class="img-fluid" />

                                                @endif
                                                <!-- <a href="#" class="btn btn-secondary" id="A4">View</a> -->
                                            </div>
                                            <span class="note">(File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)<br>(फाइल का प्रारूप: JPEG/JPG/PDF | फाइल का अधिकतम साइज़: 2 MB)</span>
                                        </div>
                                    </div>
                                    {{-- <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="placeholder">12. Details of Assistance being taken benefits<br>हायता को न्यायोचित ठहराते हुए प्रासंगिक दस्तावेज अपलोड करें<span class="text-danger">*</span></label>
                                            <input type="text" value="{{$item->details_of_assistance_benefits}}" name="details_of_assistance_benefits" required class="form-control">
                                        </div>
                                    </div> --}}
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>13. Upload Relevant Documents Justifying the Assistance <br>हायता को न्यायोचित ठहराते हुए प्रासंगिक दस्तावेज अपलोड करें<span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <input type="file" name="relevant_documents_justifing_assistance" class="form-control" onchange="getfileext(this.value,12)" id="File12" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
                                                <input type="hidden" value="{{$item->relevant_documents_justifing_assistance}}" name="relevant_documents_justifing_assistance1" class="form-control">
                                                @if($item->relevant_documents_justifing_assistance !='')
                                                <!-- <a class="btn btn-success" href="{{url('storage/direct_recruitment',$item->relevant_documents_justifing_assistance)}}" target="_blank">
                                                                    View
                                                                </a> -->
                                                @php
                                                $img = url('storage/financial_assistance').'/'.$item->relevant_documents_justifing_assistance;
                                                $img1 = url('public/images/view.jpg');
                                                $doc = explode('.',$item->relevant_documents_justifing_assistance);

                                                @endphp
                                                <img src="{{$img1}}" role="button" onclick="appendImage('{{$img}}','{{$doc[1]}}')" class="img-fluid" />

                                                @endif
                                                <!-- <a href="#" class="btn btn-secondary" id="A4">View</a> -->
                                            </div>
                                            <span class="note">(File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)<br>(फाइल का प्रारूप: JPEG/JPG/PDF | फाइल का अधिकतम साइज़: 2 MB)</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="placeholder">14. Is Applicant Physically Challenged?<br>क्या आवेदक शारीरिक रूप से अक्षम है? <span class="text-danger">*</span></label>
                                            <!-- <input type="text" value="{{$item->physical_condition}}"  name="physical_condition" required class="form-control"> -->
                                            <select name="physical_condition" required id="physical_condition" class="form-select">
                                                <option value="">Select</option>
                                                <option value="Yes" {{ $item->physical_condition === "Yes" ? 'selected' : '' }}>Yes</option>
                                                <option value="No" {{ $item->physical_condition === "No" ? 'selected' : '' }}>No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>15. Upload Medical Certificate if the applicant is unfit or disabled<br>यदि आवेदक अक्षम अथवा दिव्यांग है तो चिकित्सा प्रमाणपत्र अपलोड करें</label>
                                            <div class="input-group">
                                                <input type="file" onchange="getfileext(this.value,14)" id="File14 medical_certificate" name="medical_certificate" class="form-control" onchange="getfileext(this.value,13)" id="File13" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
                                                <input type="hidden" value="{{$item->medical_certificate}}" name="medical_certificate1" class="form-control">
                                                <!-- <a href="#" class="btn btn-secondary" id="A4">View</a> -->
                                                @if($item->medical_certificate !='')
                                                <!-- <a class="btn btn-success" href="{{url('storage/direct_recruitment',$item->medical_certificate)}}" target="_blank">
                                                                    View
                                                                </a> -->
                                                @php
                                                $img = url('storage/financial_assistance').'/'.$item->medical_certificate;
                                                $img1 = url('public/images/view.jpg');
                                                $doc = explode('.',$item->medical_certificate);

                                                @endphp
                                                <img src="{{$img1}}" role="button" onclick="appendImage('{{$img}}','{{$doc[1]}}')" class="img-fluid" />


                                                @endif
                                            </div>
                                            <span class="note">(File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)<br>(फाइल का प्रारूप: JPEG/JPG/PDF | फाइल का अधिकतम साइज़: 2 MB)</span>
                                        </div>
                                    </div>
                                    <!-- <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Upload Signature <span class="text-danger">*</span></label>
                                                            <div class="input-group">
                                                                <input type="file"  name="guardian_signature" class="form-control" onchange="getfileext(this.value,15)"id="File15" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
                                                                <input type="hidden"  value="{{$item->guardian_signature}}" name="guardian_signature1" class="form-control" >
                                                                
                                                            </div>
                                                            <span class="note">(File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)<br>(फाइल का प्रारूप: JPEG/JPG/PDF | फाइल का अधिकतम साइज़: 2 MB)</span>
                                                        </div>
                                                    </div> -->
                                    <div class="col-md-12">
                                        <h5 class="subheading">C. Bank Account Details/बैंक खाते का विवरण</h5>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="placeholder">1. IFSC<br>आईएफएससी<span class="text-danger">*</span></label>
                                            <input type="text" value="{{$item->bank_ifsc}}"onblur="getBankDetails(this.value)" pattern="[A-Z]{4}0[A-Z0-9]{6}" name="bank_ifsc" required class="form-control" id="ifscupper">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="placeholder">2. Name of Bank<br>बैंक का नाम<span class="text-danger">*</span></label>
                                            <input name="bank_name" onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))' pattern="^[A-Za-z -]+$" value="{{$item->bank_name}}" required type="text" class="form-control" id="bankName">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="placeholder">3. Branch<br>शाखा<span class="text-danger">*</span></label>
                                            <input name="bank_branch" onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))' pattern="^[A-Za-z -]+$" value="{{$item->bank_branch}}" required type="text" class="form-control" id="bank_branch">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="placeholder">4. Bank Account No.<br>बैंक खाता संख्या<span class="text-danger">*</span></label>
                                            <input type="text" value="{{$item->bank_acc_no}}" pattern=".{9,18}" minlength="9" maxlength="18" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" name="bank_acc_no" required class="form-control">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="placeholder">5. Account Holder Name<br>खाता धारक का नाम<span class="text-danger">*</span></label>
                                            <input type="text" onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))' pattern="^[A-Za-z -]+$" value="{{$item->acc_holder_name}}" name="acc_holder_name" required class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="placeholder">6. PAN<br>पैन कार्ड<span class="text-danger">*</span></label>
                                            <input type="text" value="{{$item->pan}}" pattern="[a-zA-Z]{5}[0-9]{4}[a-zA-Z]{1}" style="text-transform:uppercase" name="pan" required class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="placeholder">7. Mobile No. (registered with Bank Account)<br>मोबाइल नंबर (बैंक खाते के साथ जो पंजीकृत है)<span class="text-danger">*</span></label>
                                            <input type="text" value="{{$item->mobile_registered_in_bank}}" pattern="[6-9][0-9]{9}$" required maxlength="10" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" name="mobile_registered_in_bank" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-5">
                                        <div class="form-group">
                                            <label class="placeholder">8. Any other relevant information applicant wants to specify?<br>कोई अन्य प्रासंगिक जानकारी आवेदक निर्दिष्ट करना चाहते हैं?</label>
                                            <input value="{{$item->other_relevant_information_applicant}}" name="other_relevant_information_applicant" type="text" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <h5 class="subheading">D. Sports Achievements/वित्तीय सहायता हेतु आवेदन पत्र <span class="text-danger">*</span></h5>
                                    </div>

                                    <div class="col-md-12">
                                        <div class="form-group">
                                                <table  class="table table-bordered" id="dynamic_field1">
                                                    <thead>
                                                        <tr>
                                                            <td>Level of Sport<br>खेल स्तर</td>
                                                            <td>Position<br>पद</td>
                                                            <td style="font-weight: bold;"><span class="note"><b style="color:#212529">Docs</b> (File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)</span><br><span class="note"><b style="color:#212529">दस्तावेज</b> (फाइल का प्रारूप: JPEG/JPG/PDF | फाइल का अधिकतम साइज़: 2 MB)</span></td>
                                                            <td></td>
                                                        </tr>
                                                    </thead>
                                                    @foreach( $sport_achievement as $key=>$post)
                                                    <tbody>
                                                        <tr id="row{{$key}}">
                                                            <td>
                                                                <select name="sport_achievement[]" required class="form-select">
                                                                    <option value="">Select</option>
                                                                    <option {{$post->sport_achievement=='National'?'Selected':''}} value="National">National</option>
                                                                    <option {{$post->sport_achievement=='International'?'Selected':''}} value="International">International</option>
                                                                    <option {{$post->sport_achievement=='State'?'Selected':''}} value="State">State</option>
                                                                    <!-- <option {{$post->sport_achievement=='Other'?'Selected':''}} value="Other">Other</option> -->
                                                                </select>
                                                            </td>
                                                            <td><input type="text" value="{{$post->sport_achievement_name }}" onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))" name="sport_achievement_name[]" placeholder="Name of the Position" class="form-control name_email"></td>
                                                            <td>
                                                                <div class="input-group">
                                                                    <input name="sport_achievement_docs[]" type="file" class="form-control" onchange="getfileext(this.value,1)" id="File1" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
                                                                    <input value="{{$post->sport_achievement_docs}}" name="sport_achievement_docs1[]" type="hidden">
                                                                    @if($post->sport_achievement_docs !='')
                                                                    <!-- <a class="btn btn-success" href="{{url('storage/direct_recruitment',$post->sport_achievement_docs)}}" target="_blank">
                                                                    View
                                                                </a> -->
                                                                    @php
                                                                    $img = url('storage/financial_assistance').'/'.$post->sport_achievement_docs;
                                                                    $img1 = url('public/images/view.jpg');
                                                                    $doc = explode('.',$post->sport_achievement_docs);

                                                                    @endphp
                                                                    <img src="{{$img1}}" role="button" onclick="appendImage('{{$img}}','{{$doc[1]}}')" class="img-fluid" />

                                                                    @endif
                                                                </div>
                                                            </td>
                                                            @if(!isset($sport_achievement) || ($key == 0))
                                                            <td><button type="button" name="add" id="add1" class="btn btn-primary mt-1">Add More</button></td>
                                                            @else
                                                            <td><button type="button" name="remove" id="{{$key}}" class="btn btn-danger btn_remove">X</button></td>
                                                            @endif
                                                        </tr>
                                                    </tbody>
                                                    @endforeach
                                                </table>
                                                <!--<input type="submit" class="btn btn-success" name="submit" id="submit" value="Submit">-->
                                          
                                        </div>
                                    </div>
                                </div>
                                <div class="bhoechie-footer">
                                    <div class="row justify-content-center">
                                        <div class="col-md-3 d-grid">
                                            <button type="submit" class="btn btn-info">Save & Proceed/दर्ज करें व आगे बढ़ें</button>
                                        </div>

                                    </div>
                                </div>
                                @endforeach
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
        var i = 1;
        var length;

        $("#add1").click(function() {
            i++;
            $('#dynamic_field1').append('<tr id="row' + i + '"><td><select class="form-select"  required name="sport_achievement[]" class="form-control name_list"><option value="">Select</option><option  value="National">National</option><option  value="International">International</option><option  value="State">State</option></select></td><td><input required type="text" onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))" name="sport_achievement_name[]" placeholder="Name of the Position" class="form-control name_email"/></td><td><div class="input-group"><input type="file" required class="form-control" name="sport_achievement_docs[]"  onchange="getfileext(this.value,2' + i + ')" id="File2' + i + '" aria-describedby="inputGroupFileAddon05" aria-label="Upload"></div></td><td><button type="button" name="remove" id="' + i + '" class="btn btn-danger mt-1 px-2 btn_remove"><span class="far fa-trash-alt"></span></button></td></tr>');
        });
        $(document).on('click', '.btn_remove', function() {
            var button_id = $(this).attr("id");
            $('#row' + button_id + '').remove();
        });
        $("#physical_condition").on('change', function() {
            if (this.value == "Yes") {
                $("#File9").attr('required', true);
            } else {
                $("#File9").attr('required', false);
            }
        });
        $("#experience_sports_association").on('change', function() {
            if (this.value == "Yes") {
                $("#File10").attr('required', true);
            } else {
                $("#File10").attr('required', false);
            }
        });
    });
</script>
@endpush
