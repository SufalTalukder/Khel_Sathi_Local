@extends('layouts/financelayout')
@section('content')
<div class="row">
                <div class="col-md-2">
                        <a href="{{route('fadashboard')}}" class="btn btn-outline-info backbtn float-end"><span class="icons icon-arrow-left"></span>Back/पीछे</a>
                        <div class="left-sidebar">
                            <div >
                                <ul>
                                <li><a href="{{ route('faprofile') }}" ><span class="icons icon-arrow-left"></span>Profile Detail</a></li>
                                    <li><a href="{{ route('faapplyFor') }}" ><span class="icons icon-arrow-left"></span>Am applying for</a></li>
                                    <li><a  class="active"><span class="icons icon-arrow-right"></span>Application Form</a></li>
              
                             </ul>
                            </div>
                        </div>
                </div>
                <div class="col-md-10">
                    <div class="bhoechie-tab-container">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="bhoechie-tab-content">
                                    <div class="form-scroll">
                                        <form action="{{route('save_monthlyPension')}}" method="post" enctype="multipart/form-data" class="needs-validation mt-4" novalidate="">
                                            @csrf
                                        <div >
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <h5 class="subheading">A. Applicant's Details/आवेदक का विवरण</h5>
                                                </div>
        
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label class="placeholder">1. Which Sport do/did you play?<br>कौन सा खेल खेलते थे/हैं?<span class="text-danger">*</span></label>
                                                        <select class="form-select sport_type" name="sport_type" required>
                                                            <option value="">Select</option>
                                                            @foreach ($sport_type as $type)
                                                            <option  value="{{$type->id}}" {{ $selected_sport == $type->id ? 'selected' : '' }} {{ old('sport_type') === $type->id ? 'selected' : '' }}>{{$type->name}}</option>
                                                            @endforeach
                                                            
                                                        </select>
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>2. Honoured with which Award?<br>किस पुरस्कार से सम्मानित किया गया?<span class="text-danger">*</span></label>
                                                            <select class="form-select" name="honoured_award" required>
                                                                <option value="">Select</option>
                                                                <option {{ old('honoured_award') === "Padma Shri" ? 'selected' : '' }} value="Padma Shri">Padma Shri</option>
                                                                <option {{ old('honoured_award') === "Padma Bhushan" ? 'selected' : '' }}  value="Padma Bhushan">Padma Bhushan</option>
                                                                <option {{ old('honoured_award') === "Padma Vibhushan" ? 'selected' : '' }}  value="Padma Vibhushan">Padma Vibhushan</option>
                                                                <option  {{ old('honoured_award') === "Arjuna" ? 'selected' : '' }} value="Arjuna">Arjuna</option>
                                                                <option  {{ old('honoured_award') === "Dronacharya" ? 'selected' : '' }} value="Dronacharya">Dronacharya</option>
                                                                <option  {{ old('honoured_award') === "Major Dhyan Chand Award" ? 'selected' : '' }} value="Major Dhyan Chand Award">Major Dhyan Chand Award</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                   

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>3. Upload Self-attested Copy of Award Certificate<br>पुरस्कार प्रमाण पत्र की स्व-सत्यापित प्रति अपलोड करें<span class="text-danger">*</span></label>
                                                            <div class="input-group">
                                                                <input type="file" name="award_certificate" class="form-control FilUploader111"  onchange="getfileext(this.value,1)" id="File1" aria-describedby="inputGroupFileAddon05" aria-label="Upload" required>
                                                                <!-- <a  class="btn btn-secondary" id="A4">View</a> -->
                                                            </div>
                                                            <span class="note">(File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)<br>(फाइल का प्रारूप: JPEG/JPG | फाइल का अधिकतम साइज़: 2 MB)</span>
                                                        </div>
                                                    </div>
                                                    <input type="hidden" id="dob" value="{{$dob}}">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>4. Year in which won the Award<br>किस वर्ष में अवार्ड जीता था?<span class="text-danger">*</span></label>
                                                            <select name="award_year" required class="form-control" id="dropdownYear"  id="File4" onchange="getProjectReportFunc()"></select>
                                                        </div>
                                                    </div>
                                                   
                                                    <div class="col-md-12">
                                                        <h5 class="subheading">B. Bank Account Details/बैंक खाते का विवरण</h5>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="placeholder">1. Name of Bank<br>बैंक का नाम<span class="text-danger">*</span></label>
                                                            <input name="bank_name"  onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))' pattern="^[A-Za-z -]+$" value="{{old('bank_name') }}" required type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="placeholder">2. Branch<br>शाखा<span class="text-danger">*</span></label>
                                                            <input name="bank_branch"  onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))' pattern="^[A-Za-z -]+$" value="{{old('bank_branch') }}" required type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="placeholder">3. Bank Account No.<br>बैंक खाता संख्या<span class="text-danger">*</span></label>
                                                            <input type="text" value="{{old('bank_acc_no') }}" pattern=".{9,18}" minlength="9" maxlength="18" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" name="bank_acc_no" required class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="placeholder">4. IFSC<br>आईएफएससी<span class="text-danger">*</span></label>
                                                            <input type="text" value="{{old('bank_ifsc') }}" name="bank_ifsc" pattern="[A-Z]{4}0[A-Z0-9]{6}" required class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="placeholder">5. Account Holder Name<br>खाता धारक का नाम<span class="text-danger">*</span></label>
                                                            <input type="text"  onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))' value="{{old('acc_holder_name') }}" pattern="^[A-Za-z -]+$" name="acc_holder_name" required class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="placeholder">6. PAN<br>पैन कार्ड<span class="text-danger">*</span></label>
                                                            <input type="text" style="text-transform:uppercase" value="{{old('pan') }}" pattern="[a-zA-Z]{5}[0-9]{4}[a-zA-Z]{1}" name="pan" required class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="placeholder">7. Mobile No. (registered with Bank Account)<br>मोबाइल नंबर (बैंक खाते के साथ जो पंजीकृत है)<span class="text-danger">*</span></label>
                                                            <input type="text" value="{{old('mobile_registered_in_bank') }}" pattern="[6-9][0-9]{9}$" required maxlength="10" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" name="mobile_registered_in_bank"  class="form-control">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label  class="placeholder">8. Any other relevant information applicant wants to specify?<br>कोई अन्य प्रासंगिक जानकारी आवेदक निर्दिष्ट करना चाहते हैं?</label>
                                                            <input value="{{old('other_relevant_information_applicant') }}" name="other_relevant_information_applicant"  type="text" class="form-control">
                                                        </div>
                                                    </div>
                                                 
                                            <div class="bhoechie-footer">
                                                <div class="row justify-content-center">
                                                    <div class="col-md-3 d-grid">
                                                        <button type="submit"  class="btn btn-info">Save and Next/दर्ज करें व आगे बढ़ें</button>
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
                    $(document).ready(function(){
   
                var i = 1;
                    var length;
                
                $("#add1").click(function(){
                    
                    i++;
                    $('#dynamic_field1').append('<tr id="row'+i+'"><td><select class="form-select"  name="sport_achievement[]" class="form-control name_list"><option value="">Select</option><option  value="National">National</option><option  value="International">International</option></select></td><td><input type="text" name="sport_achievement_name[]" placeholder="Name of the Post" class="form-control name_email"/></td><td><div class="input-group"><input type="file" class="form-control" name="sport_achievement_docs[]"  onchange="getfileext(this.value,3'+i+')" id="File3'+i+'" aria-describedby="inputGroupFileAddon05" aria-label="Upload"><a href="#" class="btn btn-secondary" id="A4">View</a></div></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');  
                    });
                
                $(document).on('click', '.btn_remove', function(){  
                    var button_id = $(this).attr("id");     
                    $('#row'+button_id+'').remove();  
                    });
                    
                
                    $('#dropdownYear').each(function() {
                       var dob_year = $("#dob").val();
                        var year = (new Date()).getFullYear();
                        var current = year;
                        gap_year=year-dob_year;
                       
                        year -= gap_year;
                        // if(gap_year == 0){
                        //     gap_year=1; 
                        // }
                    // console.log(parseInt(dob_year)+1);
                    var chh=parseInt(dob_year);
                        // console.log(current);
                        yearlist = '<option selected value="">Select</option>';
                        for (var i = 9; i <= gap_year; i++) {
                        if ((chh+ i) == current)
                        yearlist+= '<option value="' + (chh+ i) + '">' + (chh+ i) + '</option>';
                        else
                        yearlist+=  '<option value="' + (chh + i) + '">' + (chh + i) + '</option>';
                        }
                        $(this).append(yearlist);
                        })
                 
                });
                </script>
                @endpush