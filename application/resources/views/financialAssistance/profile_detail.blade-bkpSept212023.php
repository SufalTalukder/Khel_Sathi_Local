
@extends('layouts/financelayout')
@section('content')


<div class="row">

	<div class="col-md-12">
		<div class="pageheader" id="menu-margin">
			<div class="row">
				<h4 class="mb-0">Applicant’s Profile <a href="{{ route('faprofile') }}" class="btn btn-outline-primary backbtn float-end" style="width: auto;"><span class="icons icon-arrow-right"></span>Applicant’s Profile</a></h4>

			</div>
		</div>


		<div class="card">
			<div class="card-body">


                <?php $iso_detail=isp_common_detail(Auth::User()->id,Auth::User()->email, "FINANCIAL");?>

                            <form action="{{route('facompProfile')}}"  enctype="multipart/form-data"  method="post" class="needs-validation mt-4 " novalidate>
                             @csrf
                         <div class="row">
                                                <div class="col-md-12">
                                                     <h5 class="subheading">A. Nomination Form / नामांकन पत्र</h5>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="placeholder">1. Applicant's Full Name<br>आवेदक का पूरा नाम </label>
                                                        <input type="text" class="form-control" name="full_name" value="{{$user->fullname}}" readonly >
                                                    </div>
                                                </div>

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="placeholder">3. Mobile Number<br>मोबाइल नंबर </label>
                                                        <input type="text" class="form-control" name="contact_no" value="{{$user->mobile}}" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="placeholder">4. Email ID<br>ईमेल आईडी</label>
                                                        <input type="email" class="form-control" name="email_id" value="{{$user->email}}" readonly >
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <h5 class="subheading">B. Applicant's Details/आवेदक का विवरण</h5>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="placeholder">1. Mother’s Name<br>माता का नाम<span class="text-danger">*</span></label>
                                                            <input type="text" onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))' pattern="^[A-Za-z -]+$" required  @if(isset($iso_detail) && $iso_detail->mother_name_eng) value="{{ $iso_detail->mother_name_eng }}" class="form-control dis_check" @endif  class="form-control" name="mother_name" value="{{old('mother_name') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="placeholder">2. Father’s Name<br>पिता का नाम<span class="text-danger">*</span></label>
                                                            <input type="text" onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))' pattern="^[A-Za-z -]+$" required  @if(isset($iso_detail) && $iso_detail->father_or_husband_or_guardian_name_eng) value="{{ $iso_detail->father_or_husband_or_guardian_name_eng }}" class="form-control dis_check" @endif class="form-control" name="father_name" value="{{old('father_name') }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="placeholder">3. Which Sport did/do you play?<br>कौन सा खेल खेलते थे/हैं?*<span class="text-danger">*</span></label>
                                                            <select class="form-select" name="sport_type" required>
                                                                <option value="">Select</option>
                                                                @foreach ($sport_type as $type)
                                                                <option  value="{{$type->id}}" {{ old('sport_type') === $type->id ? 'selected' : '' }}>{{$type->name}}</option>
                                                                @endforeach

                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>4. Category<br>श्रेणी<span class="text-danger">*</span></label>
                                                            <select required name="category" class="form-select">
                                                                <option value="">Select</option>
                                                                <option value="1"  {{ old('category') === "1" ? 'selected' : '' }}>General</option>
                                                                <option value="2"  {{ old('category') === "2" ? 'selected' : '' }}>OBC</option>
                                                                <option value="3"  {{ old('category') === "3" ? 'selected' : '' }}>SC</option>
                                                                <option value="4"  {{ old('category') === "4" ? 'selected' : '' }}>ST</option>
                                                                <option value="5"  {{ old('category') === "5" ? 'selected' : '' }}>Other</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                    <!-- {{$user->dob==$user->dob?date('d/m/Y',strtotime($user->dob)):''}} -->
                                                        <div class="form-group">
                                                            <label class="placeholder">5. Date of Birth<br>जन्म तिथि<span class="text-danger">*</span></label>

                                                                <input type="text" onkeypress="return false" required        @if(isset($iso_detail) && $iso_detail->dob) class="form-control dis_check"  value="{{isodate($iso_detail->dob)}}"  @else  value="{{old('dob') }}" @endif class="form-control" name="dob" autocomplete="off" id="dob" data-language="en" placeholder="DD/MM/YYYY" >


                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="placeholder">6. Place of Birth<br>जन्म स्थान<span class="text-danger">*</span></label>
                                                            <input type="text"  onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))' class="form-control" required data-language="en" name="place_of_birth" value="{{old('place_of_birth')}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>7. Gender<br>लिंग<span class="text-danger">*</span></label>
                                                            <select class="form-select @if(isset($iso_detail) && $iso_detail->gender ) dis_check @endif " required name="gender">
                                                                <option value="">Select</option>
                                                                <option value="Male" @if(isset($iso_detail) && $iso_detail->gender && $iso_detail->gender == "M") Selected @else {{old('gender') =='Male'?'Selected':''}}@endif >Male</option>
                                                                <option value="Female" @if(isset($iso_detail) && $iso_detail->gender && $iso_detail->gender == "F") Selected @else {{old('gender')=='Female'?'Selected':''}}@endif>Female</option>
                                                                <option value="Transgender" @if(isset($iso_detail) && $iso_detail->gender && $iso_detail->gender == "T") Selected @else {{old('gender')=='Transgender'?'Selected':''}}@endif>Transgender</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>8. Marital Status<br>वैवाहिक स्थिति<span class="text-danger">*</span></label>
                                                            <select class="form-select @if(isset($iso_detail) && $iso_detail->marital_status) dis_check @endif" required name="marital_status">
                                                            <option value="">Select</option>
                                                                <option value="Married" @if(isset($iso_detail) && $iso_detail->marital_status && $iso_detail->marital_status == "2") Selected @else  {{old('marital_status')=='Married'?'Selected':''}} @endif>Married</option>
                                                                <option value="Single" @if(isset($iso_detail) && $iso_detail->marital_status && $iso_detail->marital_status == "1") Selected @else  {{old('marital_status')=='Single'?'Selected':''}} @endif>Single</option>
                                                                <option value="Divorced" @if(isset($iso_detail) && $iso_detail->marital_status && $iso_detail->marital_status == "3") Selected @else   {{old('marital_status')=='Divorced'?'Selected':''}} @endif>Divorced</option>
                                                                <option value="Widow" @if(isset($iso_detail) && $iso_detail->marital_status && $iso_detail->marital_status == "4") Selected @else  {{old('marital_status')=='Widow'?'Selected':''}} @endif>Widow</option>
                                                                <option value="Widower" @if(isset($iso_detail) && $iso_detail->marital_status && $iso_detail->marital_status == "5") Selected @else  {{old('marital_status')=='Widower'?'Selected':''}} @endif>Widower</option>
                                                                <!-- <option value="Other" {{old('marital_status')=='Other'?'Selected':''}}>Other</option> -->

                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="placeholder">9. Nationality<br>राष्ट्रीयता <span class="text-danger">*</span></label>
                                                            <select class="form-select" required name="nationality">
                                                            <option value="">Select</option>
                                                                <option value="Indian" {{old('nationality')=='Indian'?'Selected':''}}>Indian</option>
                                                                <!-- <option value="Other" {{old('nationality')=='Other'?'Selected':''}}>Other</option> -->

                                                            </select>
                                                            <!-- <input type="text" class="form-control" name="nationality" value="{{$user->nationality}}"> -->
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="placeholder">10. Religion<br>धर्म <span class="text-danger">*</span></label>
                                                            <select class="form-select" required name="religion">
                                                            <option value="">Select</option>
                                                            <option value="Hindu" {{$user->religion=='Hindu'?'Selected':''}}>Hindu</option>
                                                            <option value="Muslim" {{$user->religion=='Muslim'?'Selected':''}}>Muslim</option>
                                                            <option value="Christian" {{$user->religion=='Christian'?'Selected':''}}>Christian</option>
                                                            <option value="Sikh" {{$user->religion=='Sikh'?'Selected':''}}>Sikh</option>
                                                            <option value="Buddha " {{$user->religion=='Buddha '?'Selected':''}}>Buddha </option>
                                                            <option value="Jain" {{$user->religion=='Jain'?'Selected':''}}>Jain</option>
                                                            <option value="Other" {{old('religion')=='Other'?'Selected':''}}>Other</option>
                                                            </select>
                                                            <!-- <input type="text" class="form-control" name="religion" value="{{$user->religion}}"> -->
                                                        </div>
                                                    </div>
                                                    <!-- <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="placeholder">Sports Achievement </label>
                                                                <textarea name="achievement" required rows="1" class="form-control" cols="40">{{old('achievement')}}</textarea>
                                                        </div>
                                                    </div> -->
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="placeholder">11. Aadhaar Number<br>आधार नंबर<span class="text-danger">*</span></label>
                                                            <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" required class="form-control"pattern="[0-9]{12}"  name="aadhar_no" maxlength="12" minlength="12" value="{{old('aadhar_no')}}">
                                                        </div>
                                                    </div>
                                                    <!-- <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Upload Certificate of Highest Educational Qualification </label>
                                                            <div class="input-group">
                                                                <input type="file" required name="qualification_doc" class="form-control" id="File4" aria-describedby="inputGroupFileAddon05" aria-label="Upload">

                                                            </div>
                                                            <span class="note">(File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)</span>
                                                        </div>
                                                    </div> -->
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>13. Aadhaar Card<br>आधार कार्ड<span class="text-danger">*</span></label>
                                                            <div class="input-group">
                                                                <input type="file" required name="aadhar_card" class="form-control" onchange="getfileext(this.value,1)" id="File1" aria-describedby="inputGroupFileAddon05" aria-label="Upload">

                                                            </div>
                                                            <span class="note">(File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)<br>(फाइल का प्रारूप: JPEG/JPG/PDF | फाइल का अधिकतम साइज़: 2 MB)</span>
                                                        </div>
                                                    </div>
                                                    <!-- <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Domicile Certificate issued by the Competent Authority</label>
                                                            <div class="input-group">
                                                                <input name="domicile_certificate" required type="file" class="form-control" id="File4" aria-describedby="inputGroupFileAddon05" aria-label="Upload">

                                                            </div>
                                                            <span class="note">(File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)</span>
                                                        </div>
                                                    </div> -->

                                                     <!--  aaa-->
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label class="placeholder">14. Do you have association approved certificate?<br>
                                                            क्या आपके पास एसोसिएशन द्वारा अनुमोदित प्रमाणपत्र है?<span class="text-danger">*</span></label>
                                                            <select name="association_certificate" required id="association_certificate" class="form-select">
                                                                <option value="">Select</option>
                                                                <option value="1" {{$user->association_certificate ==  "1" ? 'Selected':''}} {{ old('association_certificate') === "1" ? 'selected' : '' }}>Yes</option>
                                                                <option value="2" {{$user->association_certificate=="2" ? 'Selected':''}}  {{ old('association_certificate') === "2" ? 'selected' : '' }}>No</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>15. Upload association approved certificate<br>एसोसिएशन द्वारा अनुमोदित प्रमाणपत्र अपलोड करें !</label>
                                                            <div class="input-group">
                                                                <input type="file"  name="association_certificate_upload"  class="form-control" onchange="getfileext(this.value,9)" id="association_certificate_upload" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
                                                               <!--  <input type="hidden"  name="association_certificate1" id="association_certificate1" value="{{$user->association_certificate_upload}}"> -->
                                                                <!-- <a href="#" class="btn btn-secondary" id="A4">View</a> -->
                                                            </div>
                                                            <span class="note">(File Format/फाइल का प्रारूप: JPEG/JPG/PDF | Max File Size/फाइल का अधिकतम साइज़: 2 MB)</span>
                                                        </div>
                                                    </div>
                                                    <!--aaaa  -->
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>16. Photograph<br>फोटो<span class="text-danger">*</span></label>
                                                            <div class="input-group">
                                                                <input type="file" required name="photograph" class="form-control"  onchange="getfileext3(this,'T4')" id="FileT4" aria-describedby="inputGroupFileAddon05" aria-label="Upload">

                                                            </div>
                                                            <span class="note">(File Format: jpeg, jpg | Max File Size: 2 MB)<br>(फाइल का प्रारूप: JPEG/JPG | फाइल का अधिकतम साइज़: 2 MB)</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                    <img id="photo" src="#" alt="your image" style="display:none;height: 80px; width: 100px; " />

                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>17. Signature<br>हस्ताक्षर<span class="text-danger">*</span></label>
                                                            <div class="input-group">
                                                                <input type="file" required name="signature" class="form-control" onchange="getfileext2(this,'T3')" id="FileT3" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
                                                            </div>
                                                            <span class="note">(File Format: jpeg, jpg| Max File Size: 2 MB)<br>(फाइल का प्रारूप: JPEG/JPG | फाइल का अधिकतम साइज़: 2 MB)</span>
                                                        </div>

                                                    </div>
                                                    <div class="col-md-6">
                                                    <img id="sign" src="#" alt="your image" style="display:none;height: 80px; width: 100px; " />

                                                    </div>

                                                    <!-- <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Upload Guardian Signature</label>
                                                            <div class="input-group">
                                                                <input type="file" required name="guardian_signature" class="form-control" id="File4" aria-describedby="inputGroupFileAddon05" aria-label="Upload">

                                                            </div>
                                                            <span class="note">(File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)</span>
                                                        </div>
                                                    </div> -->
                                                </div>
                                                <div class="col-md-12">
                                                    <h5 class="subheading">C. Current Address/वर्तमान पता
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="placeholder">1. Address<br>पता<span class="text-danger">*</span></label>
                                                            <textarea id="address1" required name="present_address" rows="1" class="form-select" cols="25">{{old('present_address')}}</textarea>
                                                            <!-- <input type="text" required class="form-control" name="present_address" id="address1" value="{{$user->present_address}}"> -->
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="placeholder">2. State<br>राज्य <span class="text-danger">*</span></label>
                                                            <select class="form-select @if(isset($iso_detail) && $iso_detail->residential_state) dis_check @endif" required name="present_state" id="state1" onchange="get_city(this.value,'district1')">
                                                            <option value="">Select State</option>
                                                               @foreach($state as $value)
                                                               <option value="{{$value->id}}" @if(isset($iso_detail) && $iso_detail->residential_state && $iso_detail->residential_state == $value->isp_state_code ) Selected @else {{old('present_state')==$value->id?'Selected':''}}@endif >{{$value->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="placeholder">3. District<br>जनपद <span class="text-danger">*</span></label>
                                                            <input type="hidden" id="h_district12" value="@if(isset($iso_detail) && $iso_detail->residential_district){{$iso_detail->residential_district}} @endif"/>
                                                            <input type="hidden" id="h_district1" value="{{$user->present_district}}"/>
                                                            <select class="form-select @if(isset($iso_detail) && $iso_detail->residential_district) dis_check @endif" required name="present_district" id="district1">
                                                                <option  value="">Select</option>
                                                                @foreach($all_city as $value)
                                                               <option value="{{$value->id}}" {{ old('present_district') === $value->id ? 'selected' : '' }} {{$user->present_district==$value->id?'Selected':''}}>{{$value->city}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="placeholder">4. PIN Code<br>पिन कोड<span class="text-danger">*</span></label>
                                                            <input type="text" required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" class="form-control" maxlength="6" minlength="6" name="present_pincode" id="present_pincode" pattern="[0-9]{6}"  @if(isset($iso_detail) && $iso_detail->residential_pin ) class="dis_check" value="{{ $iso_detail->residential_pin}}"  @else value="{{old('present_pincode')}}"@endif >
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">

                                                    <h5 class="subheading">D. Permanent Address/स्थायी पता&nbsp;<br><input type="checkbox" name="" value="yes"id="same">Same as current Address/वर्तमान पते के समान
                                                        </h5>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="placeholder">1. Address<br>पता <span class="text-danger">*</span></label>
                                                            <!-- <input type="text" required class="form-control dis_check" name="permanent_address" id="permanent_address" value="{{$user->permanent_address}}"> -->
                                                            <textarea id="permanent_address" required name="permanent_address" rows="1" class="form-select" cols="25">{{old('permanent_address')}}</textarea>
                                                        </div>
                                                    </div>
                                                    <!-- <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="placeholder">State <span class="text-danger">*</span></label>
                                                            <select class="form-select dis_check" required name="permanent_state" id="state" onchange="get_city(this.value,'district')">
                                                                <option value="">Select State</option>
                                                               @foreach($state as $value)
                                                               <option value="{{$value->id}}" {{old('permanent_state')==$value->id?'Selected':''}}>{{$value->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div> -->
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="placeholder dis_check">2. District<br>जनपद <span class="text-danger">*</span></label>
                                                            <input type="hidden" id="h_district" value="{{old('permanent_district')}}"/>
                                                            <select class="form-select @if(isset($iso_detail) && $iso_detail->residential_distric ) dis_check @endif " required name="permanent_district" id="district">
                                                           <option  value="">Select</option>
                                                            @foreach($all_city as $value)
                                                               <option value="{{$value->id}}"@if(isset($iso_detail) && $iso_detail->residential_district && $iso_detail->permanent_district == $value->isp_dist_code ) Selected @else {{ old('permanent_district') === $value->id ? 'selected' : '' }} {{$user->permanent_district==$value->id?'Selected':''}} @endif >{{$value->city}}</option>
                                                                @endforeach


                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label class="placeholder">3. PIN Code<br>पिन कोड<span class="text-danger">*</span></label>
                                                            <input type="text" required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" class="form-control dis_check" pattern="[0-9]{6}" minlength="6" maxlength="6" name="permanent_pincode" id="permanent_pincode" @if(isset($iso_detail) && $iso_detail->permanent_pin ) class="form-control dis_check" value="{{ $iso_detail->permanent_pin}}"  @else value="{{old('permanent_pincode')}}" @endif>
                                                        </div>
                                                    </div>
                                                </div>




                                            <div class="bhoechie-footer">
                                                <div class="row justify-content-center">
                                                    <div class="col-md-3 d-grid">
                                                        <button type="submit" id="reg-submit"  class="btn btn-info">Save & Proceed/दर्ज करें व आगे बढ़ें</button>
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                       </form>
                        </div>
                    </div>
                </div>
    </div>



@endsection

@push('custom-scripts')

<script type="text/javascript">
 $('.dis_check').attr("style", "pointer-events: none;");
         function showMsg()
         {
            info("Please Complete Your Profile");
         }

         function get_city(value,id)
         {
            if(value != 23){
                $("#same").attr("disabled", true);
            }else{
                $("#same").removeAttr("disabled");
            }
            let city=$("#district1").val();
            let same=$("#same").prop('checked') == true;
            let h_city=$("#h_district").val();
            let h_city1=$("#h_district1").val();
            let h_district12=$("#h_district12").val();
            let option=`<option value=''>Select City</option>`;
            console.log(city,same)
           $.ajax({
            type: "POST",
            url: "{{url('get_city')}}",
            data: {value},

            success: function (response) {
                response.forEach((item)=>{
                    ///setTimeout(() => {
                        if(h_city && id =="district" && $("#same").prop('checked') == false) {
                     option +=`<option value="${item.id}" ${item.id==h_city?'selected':''}>${item.city}</option>`;
                   }
                  else if( h_city1 && id =="district1" && $("#same").prop('checked') == false) {
                     option +=`<option value="${item.id}" ${item.id==h_city1?'selected':''}>${item.city}</option>`;
                   }
                   else if(city && id =="district") {
                     option +=`<option value="${item.id}" ${item.id==city ? 'selected':''}>${item.city}</option>`;
                   }
                   else if(h_district12 && id =="district1") {
                     option +=`<option value="${item.id}" ${item.isp_dist_code==h_district12 ? 'selected':''}>${item.city}</option>`;
                   }
                   else{
                    option +=`<option value="${item.id}" >${item.city}</option>`;
                   }
///}, 20)
                });
                $("#"+id).empty();
                $("#"+id).append(option);
            }
           });
         }

         $("#same").change((e)=>{
            if($("#same").is(":checked"))
            {
               let district1=$("#district1").val();
               let address1=$("#address1").val();
               let state=$("#state1").val();
               let permanent_pincode=$("#present_pincode").val();
                $("#state").val(state);
               $("#permanent_address").val(address1);
               $("#permanent_pincode").val(permanent_pincode);
                // $('#state').trigger('change');
                $("#district").val(district1);
                $('.dis_check').attr("style", "pointer-events: none;");



            }
            else{
                $("#permanent_address").val('');
                $("#state").val('');
                $("#district").val('');
                $("#permanent_pincode").val('');
                $('.dis_check').attr("style", "");

            }
         })

         window.onload=()=>{
            get_city();
         }
//         $(function () {
//     $('#dob').datepicker({
//         changeMonth: true,
//         changeYear: true,
//         dateFormat: 'dd/mm/yy', maxDate: '18Y',
//         onClose: function (dateText, inst) {
//             var month = $("#ui-datepicker-div .ui-datepicker-month :selected").val();
//             var year = $("#ui-datepicker-div .ui-datepicker-year :selected").val();
//             $(this).datepicker('setDate', new Date(year, month, 1));
//         }
//     });
// });
var start=(new Date()).getFullYear() - 99;
var end=(new Date()).getFullYear();
var yrRange = start + ":" + end;
console.log(start)
$("#dob").datepicker(
    { changeMonth: true,
        changeYear: true,
        yearRange: yrRange,
        dateFormat: 'dd/mm/yy',
        maxDate: '-40Y' });

// $("#dob").datepicker( { changeMonth: true, changeYear: true,yearRange: "-100:+0",maxDate: '0',dateFormat: 'dd/mm/yy'});
        //  $("#dob").datepicker( { changeMonth: true, changeYear: true,yearRange: '1960:3025', minDate: '-60Y',dateFormat: 'dd/mm/yy', maxDate: '-18Y' });

</script>
<script>
        $(document).ready(function(){

    var i = 1;
        var length;

    $("#add").click(function(){


        i++;
        $('#dynamic_field').append('<tr id="row'+i+'"><td><select  name="post_type[]" class="form-select" class="form-control name_list"><option value="">Select</option><option value="Select 1">Select 1</option></select></td><td><input type="text" name="post_name[]" placeholder="Name of the Post" class="form-control name_email"/></td><td><button type="button" name="remove" id="'+i+'" class="btn btn-danger btn_remove">X</button></td></tr>');
        });

    $(document).on('click', '.btn_remove', function(){


        var button_id = $(this).attr("id");
        $('#row'+button_id+'').remove();
        });

        //new column add
           $("#association_certificate").on('change', function() {
                        if(this.value =="1"){

                            $("#association_certificate_upload").attr('required',true);
                        }
                        else{
                            $("#association_certificate_upload").attr('required',false);
                        }

                    });


        $("#submit").on('click',function(event){
        var formdata = $("#add_name").serialize();

        event.preventDefault()



        });
    });
    </script>
@endpush

