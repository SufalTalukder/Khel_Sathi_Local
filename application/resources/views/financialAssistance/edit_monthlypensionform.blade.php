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
                            <form action="{{route('updatemonthlypensionform')}}" method="post" enctype="multipart/form-data"  id="ajxReload"  class="needs-validation" novalidate="">
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <h5 class="subheading">Nomination Form for Monthly Pension  / मासिक पेंशन हेतु नामांकन</h5>
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
                                            <label class="placeholder">Which Sport do/did you play?<br>कौन सा खेल खेलते थे/हैं?<span class="text-danger">*</span></label>
                                            <select class="form-select sport_type" name="sport_type" required>
                                                <option value="">Select</option>
                                                @foreach ($sport_type as $type)
                                                <option {{ $item->sport_type === $type->id ? 'selected' : '' }} value="{{$type->id}}" {{ old('sport_type') === $type->id ? 'selected' : '' }}>{{$type->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Honoured with which Award?<br>किस पुरस्कार से सम्मानित किया गया?<span class="text-danger">*</span></label>
                                            <select class="form-select" name="honoured_award" required>
                                                <option value="">Select</option>
                                                <option {{ $item->honoured_award == "Padma Shri" ? 'selected' : '' }} value="Padma Shri">Padma Shri</option>
                                                <option {{ $item->honoured_award == "Padma Bhushan" ? 'selected' : '' }} value="Padma Bhushan">Padma Bhushan</option>
                                                <option {{ $item->honoured_award == "Padma Vibhushan" ? 'selected' : '' }} value="Padma Vibhushan">Padma Vibhushan</option>
                                                <option {{ $item->honoured_award == "Arjuna" ? 'selected' : '' }} value="Arjuna">Arjuna</option>
                                                <option {{ $item->honoured_award == "Dronacharya" ? 'selected' : '' }} value="Dronacharya">Dronacharya</option>
                                                <option {{ $item->honoured_award == "Major Dhyan Chand Award" ? 'selected' : '' }} value="Major Dhyan Chand Award"> Major Dhyan Chand Award</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Upload Self-attested Copy of Award Certificate<br>पुरस्कार प्रमाण पत्र की स्व-सत्यापित प्रति अपलोड करें<span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <input type="hidden" value="{{$item->award_certificate}}" name="award_certificate1">
                                                <input type="file" name="award_certificate" class="form-control FilUploader111" onchange="getfileext(this.value,4)" id="File4" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
                                                <!-- <a  class="btn btn-secondary" id="A4">View</a> -->
                                                @if($item->award_certificate !='')
                                                @php
                                                $img = url('storage/financial_assistance').'/'.$item->award_certificate;
                                                $img1 = url('public/images/view.jpg');
                                                $doc = explode('.',$item->award_certificate);
                                                @endphp
                                                <img src="{{$img1}}" role="button" onclick="appendImage('{{$img}}','{{$doc[1]}}')" class="img-fluid" />
                                                @endif
                                            </div>
                                            <span class="note">(File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)<br>(फाइल का प्रारूप: JPEG/JPG | फाइल का अधिकतम साइज़: 2 MB)</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Upload Domicile Certificate of UP<br>उत्तर प्रदेश का मूल निवास प्रमाण पत्र अपलोड करें<span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <input type="hidden" value="{{$item->domicile_certificate}}" name="domicile_certificate1">
                                                <input type="file" name="domicile_certificate" class="form-control FilUploader111" onchange="getfileext(this.value,4)" id="File4" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
                                                <!-- <a  class="btn btn-secondary" id="A4">View</a> -->
                                                @if($item->domicile_certificate !='')
                                                @php
                                                $img = url('storage/domicile_certificate').'/'.$item->domicile_certificate;
                                                $img1 = url('public/images/view.jpg');
                                                $doc = explode('.',$item->domicile_certificate);
                                                @endphp
                                                <img src="{{$img1}}" role="button" onclick="appendImage('{{$img}}','{{$doc[1]}}')" class="img-fluid" />
                                                @endif
                                            </div>
                                            <span class="note">(File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)<br>(फाइल का प्रारूप: JPEG/JPG | फाइल का अधिकतम साइज़: 2 MB)</span>
                                        </div>
                                    </div>

                                    <input type="hidden" id="dob" value="{{$dob}}">
                                    <input type="hidden" id="award_year1" value="{{$item->award_year}}">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label>Year in which won the Award<br>किस वर्ष में अवार्ड जीता था?<span class="text-danger">*</span></label>
                                            <select name="award_year" required class="form-control form-select" id="dropdownYear" id="File4" onchange="getProjectReportFunc()"></select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <h5 class="subheading">B. Bank Account Details/बैंक खाते का विवरण</h5>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="placeholder">IFSC<br>आईएफएससी<span class="text-danger">*</span></label>
                                            <input type="text" pattern="[A-Z]{4}0[A-Z0-9]{6}" value="{{$item->bank_ifsc}}" name="bank_ifsc" required class="form-control" onblur="getBankDetails(this.value)" id="ifscupper">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="placeholder">Name of Bank<br>बैंक का नाम<span class="text-danger">*</span></label>
                                            <input name="bank_name" onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))' pattern="^[A-Za-z -]+$" value="{{$item->bank_name}}" required type="text" class="form-control" id="bankName">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="placeholder">Branch<br>शाखा<span class="text-danger">*</span></label>
                                            <input name="bank_branch" onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))' pattern="^[A-Za-z -]+$" value="{{$item->bank_branch}}" required type="text" class="form-control" id="bank_branch">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="placeholder">Bank Account No.<br>बैंक खाता संख्या<span class="text-danger">*</span></label>
                                            <input type="text" pattern=".{9,18}" minlength="9" maxlength="18" value="{{$item->bank_acc_no}}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" name="bank_acc_no" required class="form-control">
                                        </div>
                                    </div>
                                    
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="placeholder">Account Holder Name<br>खाता धारक का नाम<span class="text-danger">*</span></label>
                                            <input type="text" onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))' pattern="^[A-Za-z -]+$" value="{{$item->acc_holder_name}}" name="acc_holder_name" required class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="placeholder">PAN<br>पैन कार्ड<span class="text-danger">*</span></label>
                                            <input type="text" value="{{$item->pan}}" pattern="[a-zA-Z]{5}[0-9]{4}[a-zA-Z]{1}" style="text-transform:uppercase" name="pan" required class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="placeholder">Mobile No. (registered with Bank Account)<br>मोबाइल नंबर (बैंक खाते के साथ जो पंजीकृत है)<span class="text-danger">*</span></label>
                                            <input type="text" value="{{$item->mobile_registered_in_bank}}" pattern="[6-9][0-9]{9}$" required maxlength="10" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" name="mobile_registered_in_bank" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label class="placeholder">Any other relevant information applicant wants to specify?<br>कोई अन्य प्रासंगिक जानकारी आवेदक निर्दिष्ट करना चाहते हैं?</label>
                                            <input value="{{$item->other_relevant_information_applicant}}" name="other_relevant_information_applicant" type="text" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="bhoechie-footer">
                                    <div class="row justify-content-center">
                                        <div class="col-md-3 d-grid">
                                            <button type="submit" class="btn btn-info">Save and Next/दर्ज करें व आगे बढ़ें</button>
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
            $('#dynamic_field1').append('<tr id="row' + i + '"><td><select class="form-select"  name="sport_achievement[]" class="form-control name_list"><option value="">Select</option><option  value="National">National</option><option  value="International">International</option></select></td><td><input type="text" name="sport_achievement_name[]" placeholder="Name of the Post" class="form-control name_email"/></td><td><div class="input-group"><input type="file" class="form-control" name="sport_achievement_docs[]"  onchange="getfileext(this.value,2' + i + ')" id="File2' + i + '" aria-describedby="inputGroupFileAddon05" aria-label="Upload"><a href="#" class="btn btn-secondary" id="A4">View</a></div></td><td><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove">X</button></td></tr>');
        });

        $(document).on('click', '.btn_remove', function() {
            var button_id = $(this).attr("id");
            $('#row' + button_id + '').remove();
        });

        $('#dropdownYear').each(function() {
            var dob_year = $("#dob").val();
            var award_year1 = $("#award_year1").val();
            var year = (new Date()).getFullYear();
            var current = year;
            gap_year = year - dob_year;
            year -= gap_year;
            console.log(dob_year);
            // console.log(current);
            var chh = parseInt(dob_year);
            yearlist = '<option selected value="">Select</option>';
            for (var i = 9; i <= gap_year; i++) {
                if ((year + i) == award_year1)
                    yearlist += '<option selected value="' + (chh + i) + '">' + (chh + i) + '</option>';
                else
                    yearlist += '<option value="' + (chh + i) + '">' + (chh + i) + '</option>';
            }
            $(this).append(yearlist);
        })

    });
</script>
@endpush
