@extends('layouts/financelayout')
@section('content')
<div class="row">
    <!-- <div class="col-md-2">
        <a href="{{ route('fadashboard') }}" class="btn btn-outline-primary backbtn"><span class="icons icon-arrow-left"></span> Dashboard</a>
        <div class="left-sidebar">
            <div>
                <ul>
                    <li><a class="active"><span class="icons icon-arrow-right"></span>Profile Detail</a></li>
                </ul>
            </div>
        </div>
    </div> -->
    <div class="col-md-12">
        <div class="bhoechie-tab-container">
            <div class="row">
                <form action="{{url('/financial-assistance/updateProfile')}}" method="post" enctype="multipart/form-data" class="needs-validation mt-4 " novalidate>
                    @csrf
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="bhoechie-tab-content">
                            <div class="form-scroll">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h5 class="subheading">Profile Details</h5>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="placeholder">Applicant Full Name </label>
                                            <input type="text" class="form-control" name="full_name" value="{{$user->fullname}}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="placeholder">Mobile Number</label>
                                            <input type="text" class="form-control" name="contact_no" value="{{$user->mobile}}" readonly>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="placeholder">Email ID </label>
                                            <input type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" class="form-control" name="email_id" value="{{$user->email}}" readonly>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <h5 class="subheading">Applicant Details</h5>
                                        <?php $iso_detail = isp_common_detail(Auth::User()->id, Auth::User()->email, 'FINANCIAL'); ?>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="placeholder">Date of Birth <span class="text-danger">*</span></label>
                                            <input type="text" onkeypress="return false" autocomplete="off" required @if(isset($iso_detail) && $iso_detail->dob) class="form-control dis_check" value="{{isodate($iso_detail->dob)}}" @else value="{{old('dob')}}{{$user->dob}}" id="dob" @endif class="form-control" name="dob" data-language="en" placeholder="DD/MM/YYYY">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="placeholder">Place of Birth <span class="text-danger">*</span></label>
                                            <input type="text" onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))' class="form-control" required data-language="en" name="place_of_birth" value="{{old('place_of_birth')}}{{$user->place_of_birth}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Gender <span class="text-danger">*</span></label>
                                            <select class="form-select @if(isset($iso_detail) && $iso_detail->gender) dis_check @endif" required name="gender">
                                                <option value="">Select</option>
                                                <option value="Male" {{ old('gender') ==  'Male'?'Selected':'' }} {{$user->gender=='Male'?'Selected':''}}>Male</option>
                                                <option value="Female" {{ old('gender') ==  'Female'?'Selected':'' }} {{$user->gender=='Female'?'Selected':''}}>Female</option>
                                                <!-- <option value="Transgender" {{ old('gender') ==  'Transgender'?'Selected':'' }} {{$user->gender=='Transgender'?'Selected':''}}>Transgender</option> -->
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Marital status <span class="text-danger">*</span></label>
                                            <select class="form-select  @if(isset($iso_detail) && $iso_detail->marital_status) dis_check @endif" required name="marital_status">
                                                <option value="">Select</option>
                                                <option value="Married" {{ old('marital_status') ==  'Married'?'Selected':'' }} {{$user->marital_status=='Married'?'Selected':''}}>Married</option>
                                                <option value="Single" {{ old('marital_status') ==  'Single'?'Selected':'' }} {{$user->marital_status=='Single'?'Selected':''}}>Single</option>
                                                <option value="Divorced" {{ $user->marital_status === "Divorced" ? 'selected' : '' }} {{old('marital_status')=='Divorced'?'Selected':''}}>Divorced</option>
                                                <option value="Widow" {{ $user->marital_status === "Widow" ? 'selected' : '' }} {{old('marital_status')=='Widow'?'Selected':''}}>Widow</option>
                                                <option value="Widower" {{ $user->marital_status === "Widower" ? 'selected' : '' }} {{old('marital_status')=='Widower'?'Selected':''}}>Widower</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="placeholder">Nationality <span class="text-danger">*</span></label>
                                            <select class="form-select" required name="nationality">
                                                <option value="">Select</option>
                                                <option value="Indian" {{ old('nationality') ==  'Indian'?'Selected':'' }} {{$user->nationality=='Indian'?'Selected':''}}>Indian</option>
                                            </select>
                                        </div>
                                    </div>
                                    <!-- <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="placeholder">Religion <span class="text-danger">*</span></label>
                                            <select class="form-select" required name="religion">
                                                <option value="">Select</option>
                                                <option value="Hindu" {{$user->religion=='Hindu'?'Selected':''}}>Hindu</option>
                                                <option value="Muslim" {{$user->religion=='Muslim'?'Selected':''}}>Muslim</option>
                                                <option value="Christian" {{$user->religion=='Christian'?'Selected':''}}>Christian</option>
                                                <option value="Sikh" {{$user->religion=='Sikh'?'Selected':''}}>Sikh</option>
                                                <option value="Buddha " {{$user->religion=='Buddha '?'Selected':''}}>Buddha </option>
                                                <option value="Jain" {{$user->religion=='Jain'?'Selected':''}}>Jain</option>
                                                <option value="Other" {{ old('religion') ==  'Other'?'Selected':'' }} {{$user->religion=='Other'?'Selected':''}}>Other</option>
                                            </select>
                                        </div>
                                    </div> -->
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="placeholder">Mother’s Name <span class="text-danger">*</span></label>
                                            <input type="text" required onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))' class="form-control @if(isset($iso_detail) && $iso_detail->mother_name_eng) dis_check @endif" name="mother_name" value="{{old('mother_name')}}{{$user->mother_name}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="placeholder">Father’s Name <span class="text-danger">*</span></label>
                                            <input type="text" required onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))' class="form-control @if(isset($iso_detail) && $iso_detail->father_or_husband_or_guardian_name_eng) dis_check @endif" name="father_name" value="{{old('father_name')}}{{$user->father_name}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="placeholder">Which Sport do/did you play? <span class="text-danger">*</span></label>
                                            <select class="form-select" name="sport_type" required>
                                                <option value="">Select</option>
                                                @foreach ($sport_type as $type)
                                                <option value="{{$type->id}}" {{ $user->sport_type === $type->id ? 'selected' : '' }}>{{$type->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Category <span class="text-danger">*</span></label>
                                            <select required name="category" class="form-select">
                                                <option value="">Select</option>
                                                <option value="1" {{ $user->category === "1" ? 'selected' : '' }}>General</option>
                                                <option value="2" {{ $user->category === "2" ? 'selected' : '' }}>OBC</option>
                                                <option value="3" {{ $user->category === "3" ? 'selected' : '' }}>SC</option>
                                                <option value="4" {{ $user->category === "4" ? 'selected' : '' }}>ST</option>
                                                <option value="5" {{ $user->category === "5" ? 'selected' : '' }}>Other</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label class="placeholder">Aadhaar Number <span class="text-danger">*</span></label>
                                            <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" required class="form-control" pattern="[0-9]{12}" name="aadhar_no" maxlength="12" minlength="12" value="{{old('aadhar_no')}}{{$user->aadhar_no}}">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Upload your Aadhaar card <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <input type="file" name="aadhar_card" class="form-control FilUploader111" onchange="getfileext(this.value,1)" id="File1" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
                                                <input type="hidden" value="{{$user->aadhar_doc}}" name="aadhar_card1">
                                                @if($user->aadhar_doc !='')
                                                @php
                                                $img = url('storage/award').'/'.$user->aadhar_doc;
                                                $img1 = url('public/images/view.jpg');
                                                $doc = explode('.',$user->aadhar_doc);
                                                @endphp
                                                <img src="{{$img1}}" role="button" onclick="appendImage('{{$img}}','{{$doc[1]}}')" class="img-fluid" />
                                                @endif
                                            </div>
                                            <span class="note">(File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)</span>
                                        </div>
                                    </div>
                                    <div class="col-md-4" style=" display: none; ">
                                        <div class="form-group">
                                            <label class="placeholder">Do you have association approved certificate?<span class="text-danger">*</span></label>
                                            <select name="association_certificate"  required id="association_certificate" class="form-select">
                                                <option value="">Select</option>
                                                <option value="1" {{$user->association_certificate ==  "1" ? 'Selected':''}} {{ old('association_certificate') === "1" ? 'selected' : '' }}>Yes</option>
                                                <option value="2" selected {{$user->association_certificate=="2" ? 'Selected':''}} {{ old('association_certificate') === "2" ? 'selected' : '' }}>No</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4"  style=" display: none; ">
                                        <div class="form-group">
                                            <label>Upload association approved certificate</label>
                                            <div class="input-group">
                                                <input type="file" name="association_certificate_upload" class="form-control" onchange="getfileext(this.value,9)" id="association_certificate_upload" aria-describedby="inputGroupFileAddon05" aria-label="Upload" >
                                                <input type="hidden" name="association_certificate1" id="association_certificate1" value="{{$user->association_certificate_upload}}">
                                            </div>
                                            <span class="note">(File Format/फाइल का प्रारूप: JPEG/JPG/PDF | Max File Size/फाइल का अधिकतम साइज़: 2 MB)</span>
                                        </div>
                                    </div>
                                    <div class="clearfix"></div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Upload your Photograph <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <input type="file" name="photograph" class="form-control" onchange="getfileext3(this,'T4')" id="FileT4" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
                                                <input type="hidden" name="photograph1" value="{{$user->photograph_doc}}">
                                                @if($user->photograph_doc !='')
                                                @php
                                                $img = url('storage/award').'/'.$user->photograph_doc;
                                                $img1 = url('public/images/view.jpg');
                                                $doc = explode('.',$user->photograph_doc);
                                                @endphp
                                                <img src="{{$img1}}" role="button" onclick="appendImage('{{$img}}','{{$doc[1]}}')" class="img-fluid" />
                                                @endif
                                            </div>
                                            <span class="note">(File Format: jpeg, jpg | Max File Size: 2 MB)</span>
                                        </div>
                                        <img id="photo" src="#" alt="your image" style="display:none;height: 80px; width: 100px; margin-top: 10px;" />
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Upload your Signature <span class="text-danger">*</span></label>
                                            <div class="input-group">
                                                <input type="file" name="signature" class="form-control" onchange="getfileext25(this,'T3')" id="FileT3" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
                                                <input type="hidden" name="signature1" value="{{$user->signature_doc}}">
                                                @if($user->signature_doc !='')
                                                @php
                                                $img = url('storage/award').'/'.$user->signature_doc;
                                                $img1 = url('public/images/view.jpg');
                                                $doc = explode('.',$user->signature_doc);
                                                @endphp
                                                <img src="{{$img1}}" role="button" onclick="appendImage('{{$img}}','{{$doc[1]}}')" class="img-fluid" />
                                                @endif
                                            </div>
                                            <span class="note">(File Format: jpeg, jpg| Max File Size: 2 MB)</span>
                                        </div>
                                        <img id="sign" src="#" alt="your image" style="display:none;height: 80px; width: 100px; margin-top: 10px;" />
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <h5 class="subheading">Correspondence Address
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="placeholder">Address <span class="text-danger">*</span></label>
                                            <textarea id="address1" required name="present_address" rows="1" class="form-control" cols="25">{{old('present_address')}}{{$user->present_address}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="placeholder">State </label>
                                            <select class="form-select  @if(isset($iso_detail) && $iso_detail->residential_state) dis_check @endif" required name="present_state" id="state1" onchange="get_city(this.value,'district1')">
                                                <option value="">Select State</option>
                                                @foreach($state as $value)
                                                <option value="{{$value->id}}" {{$user->present_state==$value->id?'Selected':''}}>{{$value->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="placeholder">District <span class="text-danger">*</span></label>
                                            <input type="hidden" id="h_district1" value="{{$user->present_district}}" />
                                            <select class="form-select  @if(isset($iso_detail) && $iso_detail->residential_district) dis_check @endif" required name="present_district" id="district1">
                                                <option value="">Select</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="placeholder">Pin Code <span class="text-danger">*</span></label>
                                            <input type="text" required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" class="form-control  @if(isset($iso_detail) && $iso_detail->residential_pin) dis_check @endif" maxlength="6" minlength="6" name="present_pincode" id="present_pincode" pattern="[0-9]{6}" value="{{old('present_pincode')}}{{$user->present_pincode}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <h5 class="subheading">Permanent Address &nbsp;
                                           <small class="ms-3 text-dark"> <input type="checkbox" class="me-1" name="" value="yes" id="same">same as correspondence address</small>
                                        </h5>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="placeholder">Address <span class="text-danger">*</span></label>
                                            <textarea id="permanent_address" required name="permanent_address" rows="1" class="form-control dis_check" cols="25">{{old('permanent_address')}}{{$user->permanent_address}}</textarea>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                                        <div class="form-group">
                                                            <label class="placeholder">State <span class="text-danger">*</span></label>
                                                            <select class="form-select dis_check" disabled required name="permanent_state" style="pointer-events: none" id="state" onchange="get_city(this.value,'district')">
                                                                <option value="">Select State</option>
                                                               @foreach($state as $value)
                                                               <option value="{{$value->id}}" {{23==$value->id?'Selected':''}}>{{$value->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="placeholder dis_check">District <span class="text-danger">*</span></label>
                                            <input type="hidden" id="h_district" value="{{$user->permanent_district}}" />
                                            <select class="form-select  @if(isset($iso_detail) && $iso_detail->permanent_district) dis_check @endif" required name="permanent_district" id="district">
                                                <option value="">Select</option>
                                                @foreach($all_city as $value)
                                                <option value="{{$value->id}}" {{ $user->permanent_district === $value->id ? 'selected' : '' }}>{{$value->city}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label class="placeholder">Pin Code <span class="text-danger">*</span></label>
                                            <input type="text" required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" class="form-control  @if(isset($iso_detail) && $iso_detail->permanent_pin) dis_check @endif" pattern="[0-9]{6}" minlength="6" maxlength="6" name="permanent_pincode" id="permanent_pincode" value="{{old('permanent_pincode')}}{{$user->permanent_pincode}}">
                                        </div>
                                    </div>
                                </div>
                                <div class="bhoechie-footer">
                                    <div class="row justify-content-center">
                                        <div class="col-md-3 d-grid">
                                            <button type="submit" id="reg-submit" class="btn btn-info">Update</button>
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



@endsection

@push('custom-scripts')

<script type="text/javascript">
    $('.dis_check').attr("style", "pointer-events: none;");

    function showMsg() {
        info("Please Complete Your Profile");
    }

    function get_city(value, id) {

        // if (value != 23) {
        //     $("#same").attr("disabled", true);
        // } else {
        //     $("#same").removeAttr("disabled");
        // }
        let city = $("#district1").val();
        let same = $("#same").prop('checked') == true;
        let h_city = $("#h_district").val();
        let h_city1 = $("#h_district1").val();
        let option = `<option value=''>Select City</option>`;
        console.log(city, same)
        $.ajax({
            type: "POST",
            url: "{{url('get_city')}}",
            data: {
                value
            },

            success: function(response) {
                response.forEach((item) => {
                    ///setTimeout(() => {
                    if (h_city && id == "district" && $("#same").prop('checked') == false) {
                        option += `<option value="${item.id}" ${item.id==h_city?'selected':''}>${item.city}</option>`;
                    } else if (h_city1 && id == "district1" && $("#same").prop('checked') == false) {
                        option += `<option value="${item.id}" ${item.id==h_city1?'selected':''}>${item.city}</option>`;
                    } else if (city && id == "district") {
                        option += `<option value="${item.id}" ${item.id==city ? 'selected':''}>${item.city}</option>`;
                    } else {
                        option += `<option value="${item.id}" >${item.city}</option>`;
                    }
                    ///}, 20)
                });
                $("#" + id).empty();
                $("#" + id).append(option);
            }
        });
    }

    $("#same").change((e) => {
        let state = $("#state1").val();
            if (state == 23) {
        if ($("#same").is(":checked")) {
            let address1 = $("#address1").val();
            let state = $("#state1").val();
            let permanent_pincode = $("#present_pincode").val();
            let city = $("#district1").val();
            $("#state").val(state);
            $("#permanent_address").val(address1);
            $("#permanent_pincode").val(permanent_pincode);
            $("#district").val(city);
            // $('#state').trigger('change');
            $('.dis_check').attr("style", "pointer-events: none;");



        } else {
            $("#permanent_address").val('');
           // $("#state").val('');
            $("#district").val('');
            $("#permanent_pincode").val('');
            $('.dis_check').attr("style", "");

        }
    }else {
                error("Permanent Address Must Be Uttar Pradesh");
                $("#same").prop("checked", false);
              }
    })

    //new column add
    // $("#association_certificate").on('change', function() {

    //              if( $("#association_certificate").val() == "1" && $("#association_certificate1").val() != ''){

    //                  $("#association_certificate_upload").attr('required',true);
    //              }
    //              else{
    //                  $("#association_certificate_upload").attr('required',false);
    //              }

    //          });


    // //new column add
    //    $("#association_certificate").on('change', function() {
    //                 if(this.value =="1"){

    //                     $("#association_certificate_upload").attr('required',true);
    //                 }
    //                 else{
    //                     $("#association_certificate_upload").attr('required',false);
    //                 }

    //             });

    window.onload = () => {
        get_city();
    }
    var start = (new Date()).getFullYear() - 100;
    var end = (new Date()).getFullYear() - 40;
    var yrRange = start + ":" + end;
    $("#dob").datepicker({
        changeMonth: true,
        changeYear: true,
        minDate: '-60Y',
        yearRange: yrRange,
        dateFormat: 'dd/mm/yy',
        maxDate: '0'
    });

    //  $("#dob").datepicker( { changeMonth: true, changeYear: true, minDate: '-60Y',yearRange: '-100:+0',maxDate: '0',dateFormat: 'dd/mm/yy' });
</script>
@endpush
