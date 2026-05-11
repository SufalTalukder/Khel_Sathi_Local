
@extends('layouts/layout')
@section('content')
 <div class="row">
 <div class="col-2">
        <a href="{{ route('dashboard') }}" class="btn btn-outline-primary backbtn"><span class="icons icon-arrow-left"></span> Back to Dashboard</a>
        <div class="left-sidebar">
            <div class="nano-content">
                <ul>
                    
                <li><a href="{{ url('profile') }}" class="active"><span class="icons icon-arrow-right"></span>Profile Detail</a></li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-10">
                    <div class="bhoechie-tab-container">
                        <div class="row">
                            
                            <form action="{{url('compProfile')}}" method="post" class="needs-validation mt-4 " novalidate class="mt-4" enctype="multipart/form-data">
                             @csrf
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="bhoechie-tab-content">
                                    <div class="form-scroll">
                                        <div class="nano-content">
                                            <div class="row">
                                                <div class="col-md-12">
                                                     <h5 class="subheading">Profile Details</h5>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group mb-3">
                                                        <label class="placeholder">Applicant Full Name <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" name="full_name" value="{{$user->fullname}}" readonly >
                                                    </div>
                                                </div>
                                           
                                                <div class="col-md-4">
                                                    <div class="form-group mb-3">
                                                        <label class="placeholder">Mobile Number <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" name="contact_no" value="{{$user->mobile}}" readonly>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group mb-3">
                                                        <label class="placeholder">Email ID <span class="text-danger">*</span></label>
                                                        <input type="email" class="form-control" name="email_id" value="{{$user->email}}" readonly >
                                                    </div>
                                                </div>

                                                <div class="col-md-12">
                                                    <h5 class="subheading">Applicant Details</h5>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-4">
                                                    <!-- {{$user->dob==$user->dob?date('d/m/Y',strtotime($user->dob)):''}} -->
                                                        <div class="form-group mb-3">
                                                            <label class="placeholder">Date of Birth</label>
                                                         
                                                                <input type="text" value="{{$user->dob}}" class="form-control" name="dob" id="dob1" placeholder="DD/MM/YYYY" required>

                                                                <input type="date" 
       value="{{ $user->dob ? date('Y-m-d',strtotime($user->dob)) : '' }}" 
       class="form-control" 
       name="dob" 
       id="dob1" 
       required>
                                                      
                                                           
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label class="placeholder">Place of Birth</label>
                                                            <input type="text" class="form-control" required data-language="en" name="place_of_birth" value="{{$user->place_of_birth}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label>Gender</label>
                                                            <select class="form-select" required name="gender">
                                                                <option value="">Select</option>
                                                                <option value="Male" {{$user->gender=='Male'?'Selected':''}} >Male</option>
                                                                <option value="Female" {{$user->gender=='Female'?'Selected':''}}>Female</option>
                                                                <option value="Transgender" {{$user->gender=='Transgender'?'Selected':''}}>Transgender</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label>Material status</label>
                                                            <select class="form-select" required name="marital_status">
                                                            <option value="">Select</option>
                                                                <option value="Married" {{$user->marital_status=='Married'?'Selected':''}}>Married</option>
                                                                <option value="Unmarried" {{$user->marital_status=='Unmarried'?'Selected':''}}>Unmarried</option>
                                                               
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label class="placeholder">Nationality </label>
                                                            <select class="form-select" required name="nationality">
                                                            <option value="">Select</option>
                                                                <option value="Indian" {{$user->nationality=='Indian'?'Selected':''}}>Indian</option>
                                                                <option value="Other" {{$user->nationality=='Other'?'Selected':''}}>Other</option>
                                                               
                                                            </select>
                                                            <!-- <input type="text" class="form-control" name="nationality" value="{{$user->nationality}}"> -->
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label class="placeholder">Religion </label>
                                                            <select class="form-select" required name="religion">
                                                            <option value="">Select</option>
                                                                <option value="Hinduism" {{$user->religion=='Hinduism'?'Selected':''}}>Hinduism</option>
                                                                <option value="Islam" {{$user->religion=='Islam'?'Selected':''}}>Islam</option>
                                                                <option value="Christianity" {{$user->religion=='Christianity'?'Selected':''}}>Christianity</option>
                                                                <option value="Sikhism" {{$user->religion=='Sikhism'?'Selected':''}}>Sikhism</option>
                                                                <option value="Buddhism " {{$user->religion=='Buddhism '?'Selected':''}}>Buddhism </option>
                                                                <option value="Jainism" {{$user->religion=='Jainism'?'Selected':''}}>Jainism</option>
                                                                <option value="Other" {{$user->religion=='Other'?'Selected':''}}>Other</option>
                                                            </select>
                                                            <!-- <input type="text" class="form-control" name="religion" value="{{$user->religion}}"> -->
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label class="placeholder">Mother’s Name </label>
                                                            <input type="text" required  onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))' class="form-control" name="mother_name" value="{{$user->mother_name}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label class="placeholder">Father’s Name </label>
                                                            <input type="text" required  onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))' class="form-control" name="father_name" value="{{$user->father_name}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label class="placeholder">Which Sport do/did you play? <span class="text-danger">*</span></label>
                                                            <select class="form-select" name="sport_type" required>
                                                                <option value="">Select</option>
                                                                @foreach ($sport_type as $type)
                                                                <option  value="{{$type->id}}" {{ old('sport_type') === $type->id ? 'selected' : '' }}>{{$type->name}}</option>
                                                                @endforeach
                                                                
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label>Category <span class="text-danger">*</span></label>
                                                            <select required name="category" class="form-select">
                                                                <option value="">Select</option>    
                                                                <option value="General"  {{ old('category') === "General" ? 'selected' : '' }}>General</option>
                                                                <option value="OBC"  {{ old('category') === "OBC" ? 'selected' : '' }}>OBC</option>
                                                                <option value="SC/ST"  {{ old('category') === "SC/ST" ? 'selected' : '' }}>SC/ST</option>
                                                                <option value="Other"  {{ old('category') === "Other" ? 'selected' : '' }}>Other</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label class="placeholder">Aadhar Number </label>
                                                            <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" required class="form-control"pattern="[0-9]{12}"  name="aadhar_no" maxlength="12" minlength="12" value="{{$user->aadhar_no}}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Upload your Aadhaar card <span class="text-danger">*</span></label>
                                                            <div class="input-group">
                                                            <input type="file"  name="document_other_achievements" required  class="form-control" id="File4" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
                                                                
                                                            </div>
                                                            <span class="note">(File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Upload your Photograph <span class="text-danger">*</span></label>
                                                            <div class="input-group">
                                                                <input type="file" required name="photograph" class="form-control" id="File4" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
                                                                
                                                            </div>
                                                            <span class="note">(File Format: jpeg, jpg | Max File Size: 2 MB)</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group">
                                                            <label>Upload your Signature <span class="text-danger">*</span></label>
                                                            <div class="input-group">
                                                                <input type="file" required name="signature" class="form-control" id="File4" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
                                                                
                                                            </div>
                                                            <span class="note">(File Format: jpeg, jpg| Max File Size: 2 MB)</span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <h5 class="subheading">Present Address 
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group mb-3">
                                                            <label class="placeholder">Address </label>
                                                            <textarea id="address1" required name="present_address" rows="1" class="form-select" cols="25">{{$user->present_address}}</textarea>
                                                            <!-- <input type="text" required class="form-control" name="present_address" id="address1" value="{{$user->present_address}}"> -->
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mb-3">
                                                            <label class="placeholder">State </label>
                                                            <select class="form-select" required name="present_state" id="state1" onchange="get_city(this.value,'district1')">
                                                            <option value="">Select State</option>
                                                               @foreach($state as $value)
                                                               <option value="{{$value->id}}" {{$user->present_state==$value->id?'Selected':''}}>{{$value->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mb-3">
                                                            <label class="placeholder">District </label>
                                                            <input type="hidden" id="h_district1" value="{{$user->present_district}}"/>
                                                            <select class="form-select" required name="present_district" id="district1">
                                                                <option  value="">Select</option>
                                                                <!-- <option value="{{$value->id}}" {{$user->present_district?'Selected':''}}>{{$value->name}}</option> -->
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mb-3">
                                                            <label class="placeholder">Pin Code </label>
                                                            <input type="text" required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" class="form-control" maxlength="6" minlength="6" name="present_pincode" id="present_pincode" pattern="[0-9]{6}" value="{{$user->present_pincode}}">
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <h5 class="subheading">Permanent Address &nbsp; 
                                                        <input type="checkbox" name="" value="yes"id="same">same as present address</h5>
                                                </div>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group mb-3">
                                                            <label class="placeholder">Permanent Address </label>
                                                            <!-- <input type="text" required class="form-control dis_check" name="permanent_address" id="permanent_address" value="{{$user->permanent_address}}"> -->
                                                            <textarea id="permanent_address" required name="permanent_address" rows="1" class="form-select" cols="25">{{$user->permanent_address}}</textarea>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mb-3">
                                                            <label class="placeholder">State </label>
                                                            <select class="form-select dis_check" required name="permanent_state" id="state" onchange="get_city(this.value,'district')">
                                                                <option value="">Select State</option>
                                                               @foreach($state as $value)
                                                               <option value="{{$value->id}}" {{$user->permanent_state==$value->id?'Selected':''}}>{{$value->name}}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mb-3">
                                                            <label class="placeholder dis_check">District </label>
                                                            <input type="hidden" id="h_district" value="{{$user->permanent_district}}"/>
                                                            <select class="form-select" required name="permanent_district" id="district">
                                                              
                                                            <!-- <option value="{{$value->id}}" required {{$user->permanent_district?'Selected':''}}>{{$value->name}}</option> -->
                                                          
                                                                
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mb-3">
                                                            <label class="placeholder">Pin Code </label>
                                                            <input type="text" required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" class="form-control dis_check" pattern="[0-9]{6}" minlength="6" maxlength="6" name="permanent_pincode" id="permanent_pincode" value="{{$user->permanent_pincode}}">
                                                        </div>
                                                    </div>
                                                </div>
                                                
                                                
                                                  
                                                
                                            <div class="bhoechie-footer">
                                                <div class="row justify-content-center">
                                                    <div class="col-md-3 d-grid">
                                                        <button type="submit" id="reg-submit"  class="btn btn-info">Save</button>
                                                    </div>
                                                
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



@endsection

@push('custom-scripts')

<script type="text/javascript">
         function showMsg()
         {
            info("Please Complete Your Profile");
         }

         function get_city(value,id)
         {
            let city=$("#district1").val();
            let same=$("#same").prop('checked') == true;
            let h_city=$("#h_district").val();
            let h_city1=$("#h_district1").val();
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
               let address1=$("#address1").val();
               let state=$("#state1").val();
               let permanent_pincode=$("#present_pincode").val();
                $("#state").val(state);
               $("#permanent_address").val(address1);
               $("#permanent_pincode").val(permanent_pincode);
                $('#state').trigger('change');
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

         //$("#dob").datepicker( { changeMonth: true, changeYear: true,yearRange: '1960:3025', minDate: '-60Y',dateFormat: 'dd/mm/yy', maxDate: '-18Y' });

</script>
@endpush


