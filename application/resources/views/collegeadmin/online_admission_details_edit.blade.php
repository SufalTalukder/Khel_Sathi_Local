@extends('layouts/admin_layout')
@section('content')

               <div class="pageheader" id="menu-margin">
				    <h4> Admission Detail Edit


                        <a href="{{ url('collegeadmin/dashboard') }}" class="btn btn-outline-danger btn-sm backbtn float-end  mr-2"><span class="icons icon-arrow-left"></span>Back/पीछे</a>


                      </h4>

		</div>
        <form action="{{route('online_admission_update', $user->id)}}" id="basic_detail" method="post" class="needs-validation"  novalidate enctype="multipart/form-data">
            @csrf
        <div class="card">

            <div class="card-body">
                <div class="table-responsive" id="examples">   <table class="dn" style="width: 100%; margin-bottom: 5px;" border="0">
                    {{-- <tr>
                        <td colspan="2" align="center" style="position: relative; border: 0; padding-bottom: 5px;">
                            <div style="border-bottom: 0px solid #000; padding-bottom: 2vw;">
                            <!-- <img src="{{ url('onlineAdmission') }}/images/logo.png" style="position: absolute; width: 70px; top: 5px; left: 0;"/> -->
                                <!-- <img src="images/logo.png" style="position: absolute; width: 70px; top: 5px; left: 0;"/> -->
                                <div style="font-size: 3vw; font-weight: bold;">
                                    <!-- Department of Sports -->
                                    Khel Sathi Portal
                                </div>
                                <div style="font-size: 2vw; font-weight: bold;">
                                    Government of Uttar Pradesh
                                </div>
                                <div style="font-size: 2vw; font-weight: bold;">
                                  Sport College online application form 2024-25
                                </div>
                            </div>
                        </td>
                    </tr> --}}




                        <div class="form-scroll">
                            <div class="nano-content">
                              <fieldset>
                                <legend>A.	Registration Details/पंजीकरण विवरण</legend>
                                <div class="row">

                                  <div class="col-md-3">
                                      <div class="form-group mb-3">
                                        <label class="placeholder">1.	Registration No./पंजीकरण संख्या<span class="text-danger">*</span></label>
                                        <input type="native" class="form-control" value="{{$user->application_no}}" disabled>
                                      </div>
                                    </div>

                                  <div class="col-md-3">
                                    <div class="form-group mb-3">
                                      <label class="placeholder">2.	Full Name/पूरा नाम<span class="text-danger">*</span></label>
                                      <input type="text" class="form-control" value="{{$user->fullname}}" disabled>
                                    </div>
                                  </div>

                                  <div class="col-md-3">
                                    <div class="form-group mb-3">
                                      <label class="placeholder">3.	Date of Birth/जन्मतिथि<span class="text-danger">*</span></label>
                                      <input type="text" class="form-control datepicker-here" value="{{dmy($user->dob)}}" disabled>
                                    </div>
                                  </div>
                                  <div class="col-md-3">
                                    <div class="form-group mb-3">
                                      <label class="placeholder">4.	Aadhaar No./आधार नंबर <span class="text-danger">*</span></label>
                                      <input type="text" class="form-control" value="{{$user->aadhar_no}}" disabled>
                                    </div>
                                  </div>
                                  <div class="col-md-3">
                                    <div class="form-group mb-3">
                                      <label class="placeholder">5.	Permanent Education Number (PEN No.) / परमानेंट एजुकेशन नंबर </label>
                                      <input type="text" class="form-control" value="{{$user->pen_no}}" disabled>
                                    </div>
                                  </div>
                                  <div class="col-md-3">
                                    <div class="form-group mb-3">
                                      <label class="placeholder">6.	Mobile No./मोबाइल नंबर <span class="text-danger">*</span></label>
                                      <input type="text" class="form-control" value="{{$user->mobile}}" disabled>
                                    </div>
                                  </div>
                                  <div class="col-md-3">
                                    <div class="form-group mb-3">
                                      <label class="placeholder">7.	Email ID/ईमेल आईडी<span class="text-danger">*</span></label>
                                      <input type="email" class="form-control" value="{{$user->email}}" disabled>
                                    </div>
                                  </div>
                                  {{-- <div class="col-md-3">
                                    <div class="form-group mb-3">
                                      <label class="placeholder">6.	Gender/लिंग<span class="text-danger">*</span></label>
                                      <input type="gender" class="form-control"
                                      value="@if ($user->gender == 1) Male @else Female @endif" disabled>
                                    </div>
                                  </div> --}}
                                  <div class="col-md-3">
                                    <div class="form-group mb-3">
                                      <label class="placeholder">8.	Are you a native of Uttar Pradesh?/क्या आप उत्तर प्रदेश के मूल निवासी हैं?<span class="text-danger">*</span></label>
                                      <input type="native" class="form-control" value="Yes" disabled>
                                    </div>
                                  </div>





                                </div>
                              </fieldset>
                              <fieldset>
                                  <legend>B. Applicant Details</legend>
                                  <div class="row">
                                        <div class="col-md-3">
                                          <div class="form-group mb-3">
                                            <label class="placeholder">1.Trial Division/परीक्षण मंडल<span class="text-danger">*</span></label>
                                            <select class="form-select form-control" required name="trial_division" id="trial_division">
                                                <option value="">Select</option>
                                                @foreach ($division as $type)
                                                <option  value="{{$type->id}}"  @isset($basic_detail->trial_division) @if ($basic_detail->trial_division == $type->id) selected @endif @endisset>{{$type->division_name}}</option>
                                                @endforeach
                                            </select>
                                          </div>
                                        </div>

                                        <div class="col-md-3">
                                          <div class="form-group mb-3">
                                            <label for="username" class="placeholder">2.Gender/लिंग<span class="text-danger">*</span></label>
                                            <div class="form-control">
                                              <div class="form-check form-check-inline">
                                              {{-- <input class="form-check-input" required type="radio" onchange="get_college(this.value)" @isset($basic_detail->gender) @if ($basic_detail->gender == 1) checked @endif @endisset name="gender" id="Radio3" value="1"> --}}
                                                <input class="form-check-input" required type="radio"  onchange="sporttypee()" @isset($basic_detail->gender) @if ($basic_detail->gender == 1) checked @endif @endisset name="gender" id="Radio3" value="1">
                                                <label class="form-check-label" for="class1">Male</label>
                                              </div>
                                              <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio"  onchange="sporttypee()"  @isset($basic_detail->gender) @if ($basic_detail->gender == 2) checked @endif @endisset  name="gender" id="Radio4" value="2">
                                                {{-- <input class="form-check-input" type="radio"   onchange="get_college(this.value)" @isset($basic_detail->gender) @if ($basic_detail->gender == 2) checked @endif @endisset  name="gender" id="Radio4" value="2"> --}}
                                                <label class="form-check-label" for="class7">Female</label>
                                              </div>
                                            </div>
                                          </div>
                                        </div>

                                        <div class="col-md-3">
                                          <div class="form-group mb-3">
                                            <label class="placeholder">4.	Name of Sports in which you are seeking admission?/खेल का नाम जिसमें आप प्रवेश चाह रहे हैं?<span class="text-danger">*</span></label>
                                            <input type="hidden" id="sports_id" value="{{isset($basic_detail->sport_type) ? ($basic_detail->sport_type) : ''}}"/>
                                            <select class="form-select form-control" name="sport_type" id="sport_type" onchange="sporttype()" required>
                                           <option value="">Select</option>
                                                @foreach ($sport_type as $type)
                                                <option  value="{{$type->id}}" @isset($basic_detail) {{ $basic_detail->sport_type === $type->id ? 'selected' : '' }}@endisset>{{$type->name}}</option>
                                                @endforeach
                                            </select>
                                          </div>
                                        </div>
                                        <div class="col-md-3" id="subsport">
                                          <div class="form-group mb-3">
                                            <label>Select Sub Sport<span class="text-danger">*</span></label>
                                            <select class="form-select form-control container3" required name="sub_type" data-subsport="@isset($basic_detail->sub_sport_type ){{$basic_detail->sub_sport_type }}@endisset">
                                            </select>
                                          </div>
                                        </div>
                                        <div class="col-md-6">
                                          <div class="form-group mb-3">
                                            <label>3.	In which college are you seeking admission?/किस विद्यालय में आप प्रवेश चाह रहे हैं?</label>
                                            <input type="hidden" id="college_id1" value="{{isset($basic_detail->sport_college) ? (explode(",",$basic_detail->sport_college)[0]) : ''}}"/>
                                            @isset($basic_detail->gender)
                                              @if ( count(explode(",",$basic_detail->sport_college)) > 1)
                                                <input type="hidden" id="college_id2" value="{{isset($basic_detail->sport_college) ? (explode(",",$basic_detail->sport_college)[1]) : ''}}"/>
                                              @endif
                                            @endisset

                                            <div class="row">
                                              <div class="col-md-6">

                                                <label>Preference 1/प्राथमिकता 1 </label>
                                                <select  class="form-select form-control college_type" id="college_type1"  name="sport_college[]"  required>
                                                  <option value="" >Select</option>
                                                  {{-- @foreach ($sport_college as $type)
                                                    <option  value="{{$type->id}}"   @isset($basic_detail->sport_college) @if (explode(",",$basic_detail->sport_college)[0] == $type->id) selected @endif @endisset>{{$type->college_name}}</option>
                                                  @endforeach --}}
                                                </select>
                                              </div>

                                              <div class="col-md-6" id="forgirl">
                                                <label>Preference 2/प्राथमिकता  2 </label>
                                                <select  class="form-select form-control college_type" id="college_type2"  name="sport_college[]"  >
                                                  <option value="" >Select</option>
                                                  {{-- @foreach ($sport_college as $type)
                                                    <option  value="{{$type->id}}"  @isset($basic_detail->sport_college) @if ( count(explode(",",$basic_detail->sport_college)) > 1)   @if (explode(",",$basic_detail->sport_college)[1] == $type->id) selected @endif @endif @endisset>{{$type->college_name}}</option>
                                                  @endforeach --}}
                                                </select>
                                              </div>
                                            </div>
                                          </div>
                                        </div>




                                        {{-- <div class="col-md-3" id="subsport2">
                                          <div class="form-group mb-3">
                                            <label>Select Preference <span class="text-danger">*</span></label>

                                              <select class="form-select form-control" name="sub_type">

                                                @if(isset($basic_detail->sub_sport_type))
                                                @foreach ($basic_detail->sub_sport_type  as $key=>$item)

                                                <option  value="{{$item->id}}" {{ old('sub_type') === $item->id ? 'selected' : '' }}>{{$item->sub_type}}</option>
                                                @endforeach
                                                @endif
                                              </select>
                                      </div>

                                    </div>--}}

                                        <div class="col-md-3">
                                          <div class="form-group mb-3">
                                            <label>5.	Category/श्रेणी <span class="text-danger">*</span></label>
                                            <select required name="category" class="form-select form-control">
                                                <option value="">Select</option>
                                                <option value="1"   @isset($basic_detail->category) @if ($basic_detail->category == "1") selected @endif @endisset>General</option>
                                                <option value="2"   @isset($basic_detail->category) @if ($basic_detail->category == "2") selected @endif @endisset>OBC</option>
                                                <option value="3"   @isset($basic_detail->category) @if ($basic_detail->category == "3") selected @endif @endisset>SC</option>
                                                <option value="4"   @isset($basic_detail->category) @if ($basic_detail->category == "4") selected @endif @endisset>ST</option>
                                                <option value="5"  @isset($basic_detail->category) @if ($basic_detail->category == "5") selected @endif @endisset>EWS</option>
                                            </select>
                                          </div>
                                        </div>
                                        <div class="col-md-3">
                                          <div class="form-group mb-3">
                                            <label>6.	Sub-Category/उप-श्रेणी</label>
                                            <input type="text"  value="{{ isset($basic_detail->sub_category)  ? $basic_detail->sub_category : '' }}" onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))" name="sub_category" class="form-control">
                                          </div>
                                        </div>
                                        <div class="col-md-3">
                                          <div class="form-group mb-3">
                                            <label class="placeholder">7.	Height (in Centimetre)/लंबाई (सेंटीमीटर में) <span class="text-danger">*</span></label>
                                            <input required id="height" value="{{ isset($basic_detail->height)  ? $basic_detail->height : '' }}"  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" name="height" maxlength="3" type="number" class="form-control">
                                          </div>
                                        </div>
                                      <div class="col-md-3">
                                          <div class="form-group mb-3">
                                            <label class="placeholder">8.	Weight (in KG)/वजन (किलोग्राम में) <span class="text-danger">*</span></label>
                                            <input   value="{{ isset($basic_detail->weight)  ? $basic_detail->weight : '' }}" name="weight" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" type="text" maxlength="3" class="form-control"  required>
                                            {{--   <select required name="weight" class="form-control" id="weightadd">
                                              <option value=""  >Select Weight</option>
                                              <option value="38"  @isset($basic_detail->weight) @if ($basic_detail->weight == "38") selected @endif @endisset >38</option>
                                              <option value="41" @isset($basic_detail->weight) @if ($basic_detail->weight == "41") selected @endif @endisset >41</option>
                                              <option value="44" @isset($basic_detail->weight) @if ($basic_detail->weight == "44") selected @endif @endisset >44</option>
                                              <option value="48"  @isset($basic_detail->weight) @if ($basic_detail->weight == "48") selected @endif @endisset>48</option>
                                              <option value="52" @isset($basic_detail->weight) @if ($basic_detail->weight == "52") selected @endif @endisset >52</option>
                                              <option value="57"  @isset($basic_detail->weight) @if ($basic_detail->weight == "57") selected @endif @endisset>57</option>
                                              <option value="62"  @isset($basic_detail->weight) @if ($basic_detail->weight == "62") selected @endif @endisset>62</option>
                                               <option value="68" @isset($basic_detail->weight) @if ($basic_detail->weight == "68") selected @endif @endisset >68</option>
                                               <option value="75" @isset($basic_detail->weight) @if ($basic_detail->weight == "75") selected @endif @endisset >75</option>
                                            </select>
                                            <select required name="weight" class="form-control" id="weightaddgirl">
                                              <option value="">Select Weightt</option>
                                              <option value="33"    @isset($basic_detail->weight) @if ($basic_detail->weight == "33") selected @endif @endisset>33</option>
                                              <option value="36"    @isset($basic_detail->weight) @if ($basic_detail->weight == "36") selected @endif @endisset>36</option>
                                              <option value="39"    @isset($basic_detail->weight) @if ($basic_detail->weight == "39") selected @endif @endisset>39</option>
                                              <option value="42"    @isset($basic_detail->weight) @if ($basic_detail->weight == "42") selected @endif @endisset>42</option>
                                              <option value="46"    @isset($basic_detail->weight) @if ($basic_detail->weight == "46") selected @endif @endisset>46</option>
                                              <option value="50"    @isset($basic_detail->weight) @if ($basic_detail->weight == "50") selected @endif @endisset>50</option>
                                              <option value="54"    @isset($basic_detail->weight) @if ($basic_detail->weight == "54") selected @endif @endisset>54</option>
                                              <option value="58"    @isset($basic_detail->weight) @if ($basic_detail->weight == "58") selected @endif @endisset>58</option>

                                              <option value="62"    @isset($basic_detail->weight) @if ($basic_detail->weight == "62") selected @endif @endisset>62</option>

                                            </select>--}}
                                          </div>
                                        </div>
                                        <div class="col-md-3">
                                          <div class="form-group mb-3">
                                            <label class="placeholder">9.	Blood Group/ब्लड ग्रुप<span class="text-danger">*</span></label>
                                            <select required name="blood_group" class="form-control">
                                              <option value="" selected>Select</option>
                                              <option  @isset($basic_detail->blood_group) @if ($basic_detail->blood_group == "A+") selected @endif @endisset value="A+">A+</option>
                                              <option @isset($basic_detail->blood_group) @if ($basic_detail->blood_group == "A-") selected @endif @endisset  value="A-">A-</option>
                                              <option @isset($basic_detail->blood_group) @if ($basic_detail->blood_group == "B+") selected @endif @endisset  value="B+">B+</option>
                                              <option @isset($basic_detail->blood_group) @if ($basic_detail->blood_group == "B-") selected @endif @endisset  value="B-">B-</option>
                                              <option @isset($basic_detail->blood_group) @if ($basic_detail->blood_group == "AB+") selected @endif @endisset  value="AB+">AB+</option>
                                              <option @isset($basic_detail->blood_group) @if ($basic_detail->blood_group == "AB-") selected @endif @endisset  value="AB-">AB-</option>
                                              <option @isset($basic_detail->blood_group) @if ($basic_detail->blood_group == "O+") selected @endif @endisset  value="O+">O+</option>
                                              <option @isset($basic_detail->blood_group) @if ($basic_detail->blood_group == "O-") selected @endif @endisset  value="O-">O-</option>
                                            </select>
                                          </div>
                                        </div>

                                        <div class="col-md-3">
                                          <div class="form-group mb-3">
                                            <label class="placeholder">10. Visible	Identification Mark/पहचान चिह्न <span class="text-danger">*</span></label>
                                            <input type="text" required value="{{ isset($basic_detail->identification_marks) ? $basic_detail->identification_marks : ''}}" name="identification_marks" class="form-control">
                                          </div>
                                        </div>

                                        <div class="col-md-3">
                                          <div class="form-group mb-3">
                                            <label for="username" class="placeholder">11.	Is applicant suffering from Skin Disease/Fits/Other Disease?/क्या आवेदक चर्म रोग/मिर्गी/अन्य किसी रोग से ग्रसित है?<span class="text-danger">*</span></label>
                                            <div class="form-control">
                                              <div class="form-check form-check-inline">
                                                <input class="form-check-input" required type="radio"  @isset($basic_detail->disease) @if ($basic_detail->disease == 1) checked @endif @endisset name="disease" id="Radio3" value="1">
                                                <label class="form-check-label" for="class1">Yes</label>
                                              </div>
                                              <div class="form-check form-check-inline">
                                                <input class="form-check-input" type="radio"  @isset($basic_detail->disease) @if ($basic_detail->disease == 2) checked @endif @endisset  name="disease" id="Radio4" value="2">
                                                <label class="form-check-label" for="class7">No</label>
                                              </div>
                                            </div>
                                          </div>
                                        </div>

                                      </div>

                              </fieldset>

                              <fieldset>
                                <legend>C. Parents’ Details/अभिभावक का विवरण</legend>
                                <div class="row m-5">
                                  <div class="col-md-6">
                                    <fieldset>
                                      <legend>Mother Details/माता का विवरण</legend>
                                      <div class="mb-3 row">
                                          <label for="staticEmail" class="col-sm-4 col-form-label">1.	Name/नाम</label>
                                          <div class="col-sm-8">
                                            <input type="text" value="{{ isset($basic_detail->mother_name) ? $basic_detail->mother_name : ''}}" name="mother_name" required class="form-control"  onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))' pattern="^[A-Za-z -]+$"  maxlength="255">
                                          </div>
                                      </div>

                                      <div class="mb-3 row">
                                        <label for="staticEmail" class="col-sm-4 col-form-label">2.	Occupation/व्यवसाय</label>
                                        <div class="col-sm-8">
                                          <select class="form-select form-control"  required name="mother_occupation" aria-label="Default select example">
                                            <option value=""selected> Select </option>
                                            <option  @isset($basic_detail->mother_occupation) @if ($basic_detail->mother_occupation == "Business") selected @endif @endisset  value="Business">Business</option>
                                            <option  @isset($basic_detail->mother_occupation) @if ($basic_detail->mother_occupation == "Service") selected @endif @endisset  value="Service">Service</option>
                                            <option @isset($basic_detail->mother_occupation) @if ($basic_detail->mother_occupation == "Homemaker") selected @endif @endisset value="Homemaker">Homemaker</option>
                                            <option @isset($basic_detail->mother_occupation) @if ($basic_detail->mother_occupation == "Other") selected @endif @endisset value="Other">Other Occupation</option>
                                          </select>
                                        </div>
                                      </div>

                                        <div class="form-group mb-3 row">
                                          <label for="staticEmail" class="col-sm-4 col-form-label">3.	Aadhaar Card/आधार कार्ड</label>
                                          <div class="col-sm-8">
                                            <div class="input-group">
                                              <input type="file" name="mother_aadhar" {{ isset($basic_detail->mother_aadhar) ? '' : 'required' }}  class="form-control"  onchange="getfileext2(this,'T3')" id="FileT3" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
                                              <input type="hidden" value="{{ isset($basic_detail->mother_aadhar) ? $basic_detail->mother_aadhar : '' }}" name="mother_aadhar1" >
                                              @if(isset($basic_detail->mother_aadhar) && $basic_detail->mother_aadhar !='')
                                              @php
                                              $img10 = url('public/onlineAdmission/images').'/'.$basic_detail->mother_aadhar;
                                              $img1 = url('public/images/view.jpg');
                                              $doc = explode('.',$basic_detail->mother_aadhar);

                                              @endphp
                                                <a href="{{$img10}}" class="btn btn-outline-success btn-xs" target="_blank"> View</a>
                                              @endif
                                            </div>
                                          </div>
                                        </div>
                                    </fieldset>
                                  </div>
                                  <div class="col-md-6">
                                    <fieldset>
                                      <legend>Father Details/पिता का विवरण</legend>
                                      <div class="mb-3 row">
                                          <label for="staticEmail" class="col-sm-4 col-form-label"> 1.	Name/नाम</label>
                                          <div class="col-sm-8">
                                            <input type="text" value="{{ isset($basic_detail->father_name)  ? $basic_detail->father_name : ''}}" name="father_name"  required  class="form-control"  onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))' pattern="^[A-Za-z -]+$"  maxlength="255">
                                          </div>
                                      </div>

                                      <div class="mb-3 row">
                                        <label for="staticEmail" class="col-sm-4 col-form-label">2.	Occupation/व्यवसाय</label>
                                        <div class="col-sm-8">
                                          <select class="form-select form-control" required name="father_occupation" aria-label="Default select example">
                                            <option value=""selected> Select </option>
                                            <option  @isset($basic_detail->father_occupation) @if ($basic_detail->father_occupation == "Business") selected @endif @endisset value="Business">Business</option>
                                            <option  @isset($basic_detail->father_occupation) @if ($basic_detail->father_occupation == "Service") selected @endif @endisset value="Service">Service</option>
                                            <option @isset($basic_detail->father_occupation) @if ($basic_detail->father_occupation == "Homemaker") selected @endif @endisset value="Homemaker">Homemaker</option>
                                            <option @isset($basic_detail->father_occupation) @if ($basic_detail->father_occupation == "Other") selected @endif @endisset value="Other">Other Occupation</option>
                                          </select>
                                        </div>
                                      </div>
                                      <div class="form-group mb-3 row">
                                          <label for="staticEmail" class="col-sm-4 col-form-label">3.	Aadhaar Card/आधार कार्ड</label>
                                          <div class="col-sm-8">
                                            <div class="input-group">
                                              <input type="file" name="father_aadhar" {{ isset($basic_detail->father_aadhar) ? '' : 'required' }}  class="form-control"  onchange="getfileext2(this,'T33')" id="FileT33" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
                                              <input type="hidden" value="{{ isset($basic_detail->father_aadhar) ? $basic_detail->father_aadhar : '' }}" name="father_aadhar1" >
                                              @if(isset($basic_detail->father_aadhar) && $basic_detail->father_aadhar !='')
                                              @php
                                              $img10 = url('public/onlineAdmission/images').'/'.$basic_detail->father_aadhar;
                                              $img1 = url('public/images/view.jpg');
                                              $doc = explode('.',$basic_detail->father_aadhar);

                                              @endphp
                                                <a href="{{$img10}}" class="btn btn-outline-success btn-xs" target="_blank"> View</a>
                                              @endif
                                            </div>
                                          </div>
                                        </div>
                                    </fieldset>
                                  </div>
                                </div>
                              </fieldset>


                        </div>










                        <div class="form-scroll">
                            <div class="nano-content">
                              <fieldset>
                                <legend>A. Permanent Address/स्थायी पता</legend>
                                <div class="row">
                                  <div class="col-md-3"> </div>
                                </div>
                                <div class="row">
                                  <div class="col-md-3">
                                    <div class="form-group mb-3">
                                      <label class="placeholder">1. Street/Village/मोहल्ला/ग्राम <span class="text-danger">*</span></label>
                                      <input type="text"  value="{{ isset($commun_detail->p_gram) ? $commun_detail->p_gram : '' }}" name="p_gram" id="p_gram"  required class="form-control">
                                     {{-- <input onKeyPress="gram()" type="text"  value="{{ isset($commun_detail->p_gram) ? $commun_detail->p_gram : '' }}" name="p_gram"  required class="form-control"> --}}
                                    </div>
                                  </div>
                                  <div class="col-md-3">
                                    <div class="form-group mb-3">
                                      <label class="placeholder">2. Post Office/डाक घर <span class="text-danger">*</span></label>
                                      <input type="text" value="{{ isset($commun_detail->p_post) ? $commun_detail->p_post : ''}}" name="p_post" id="p_post" required class="form-control">
                                    </div>
                                  </div>
                                  <div class="col-md-3">
                                    <div class="form-group mb-3">
                                      <label class="placeholder">3.	Police Station/पुलिस थाना <span class="text-danger">*</span></label>
                                      <input type="text" value="{{ isset($commun_detail->p_thana) ? $commun_detail->p_thana : ''}}" name="p_thana"  id="p_thana" required class="form-control">
                                    </div>
                                  </div>
                                  <div class="col-md-3">
                                    <div class="form-group mb-3">
                                      <label class="placeholder">4. State/राज्य <span class="text-danger">*</span></label>
                                      <select class="form-select form-control" style="pointer-events: none;"required name="p_state" id="state1">
                                          <option value="23">UTTAR PRADESH</option>
                                      </select>
                                    </div>
                                  </div>
                                  <div class="col-md-3">
                                    <div class="form-group mb-3">
                                      <label class="placeholder">5.	District/जनपद<span class="text-danger">*</span></label>
                                      <select class="form-select form-control" required name="p_district" id="district1">
                                          <option value="">Select</option>
                                          @foreach ($city as $type)
                                          <option  value="{{$type->id}}"  @isset($commun_detail->p_district) @if ($commun_detail->p_district == $type->id) selected @endif @endisset>{{$type->city}}</option>
                                          @endforeach
                                      </select>
                                    </div>
                                  </div>
                                  <div class="col-md-3">
                                    <div class="form-group mb-3">
                                      <label class="placeholder">6. 	Mobile No./मोबाइल नंबर <span class="text-danger">*</span></label>
                                      <input type="text" pattern="[6-9][0-9]{9}$"  maxlength="10" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" value="{{ (isset($commun_detail->p_mobile) && $commun_detail->p_mobile != '') ? $commun_detail->p_mobile : $user->mobile}}" name="p_mobile" id="p_mobile"  required class="form-control">
                                    </div>
                                  </div>
                                  <div class="col-md-3">
                                    <div class="form-group mb-3">
                                      <label class="placeholder">7.	Alternate Mobile No./वैकल्पिक मोबाइल नंबर <span class="text-danger">*</span></label>
                                      <input type="text" pattern="[6-9][0-9]{9}$"  maxlength="10" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" value="{{ isset($commun_detail->p_alternate_mobile) ? $commun_detail->p_alternate_mobile : ''}}" name="p_alternate_mobile" id="p_alternate_mobile" required class="form-control">
                                    </div>
                                  </div>
                                  <div class="col-md-3">
                                    <div class="form-group mb-3">
                                      <label class="placeholder">8. Email ID/ईमेल आईडी<span class="text-danger">*</span></label>
                                      <input type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" value="{{ (isset($commun_detail->p_email) && $commun_detail->p_email != '') ? $commun_detail->p_email : $user->email }}" name="p_email" id="p_email" required class="form-control">
                                    </div>
                                  </div>
                                </div>
                              </fieldset>
                              <fieldset>
                                <legend>B. 	Correspondence Address/पत्राचार पता<small>
                                <input type="checkbox" name="" value="yes" id="myCheck"  onchange="myFunction()"/>
                                Same as above</small>  </legend>
                                <div class="row">
                                  <div class="col-md-3">
                                    <div class="form-group mb-3">
                                      <label class="placeholder">1. Street/Village/मोहल्ला/ग्राम <span class="text-danger">*</span></label>
                                      <input type="text" value="{{ isset($commun_detail->c_gram) ? $commun_detail->c_gram : ''}}" name="c_gram" id="c_gram"  required class="form-control dis_check">
                                    </div>
                                  </div>
                                  <div class="col-md-3">
                                    <div class="form-group mb-3">
                                      <label class="placeholder">2.	Post Office/डाक घर <span class="text-danger">*</span></label>
                                      <input type="text" value="{{ isset($commun_detail->c_post) ? $commun_detail->c_post : ''}}" name="c_post" id="c_post"  required class="form-control dis_check">
                                    </div>
                                  </div>
                                  <div class="col-md-3">
                                    <div class="form-group mb-3">
                                      <label class="placeholder">3.	Police Station/पुलिस थाना<span class="text-danger">*</span></label>
                                      <input type="text" value="{{ isset($commun_detail->c_thana) ? $commun_detail->c_thana : ''}}" name="c_thana"  id="c_thana" required class="form-control dis_check">
                                    </div>
                                  </div>
                                  <div class="col-md-3">
                                    <div class="form-group mb-3">
                                      <label class="placeholder">4. State/राज्य<span class="text-danger">*</span></label>
                                      <select class="form-select form-control dis_check" required name="c_state" id="state2" onchange="get_city(this.value,'district2')">
                                        <option value="">Select State</option>
                                          @foreach($state as $value)
                                          <option value="{{$value->id}}" @isset($commun_detail->c_state) @if ($commun_detail->c_state == $value->id) selected @endif @endisset>{{$value->name}}</option>
                                          @endforeach
                                      </select>
                                    </div>
                                  </div>
                                  <div class="col-md-3">
                                    <div class="form-group mb-3">
                                      <label class="placeholder">5. District/जनपद<span class="text-danger">*</span></label>
                                      <input type="hidden" id="district3" value="{{isset($commun_detail->c_district) ? $commun_detail->c_district : ''}}"/>
                                      <select class="form-select form-control dis_check" required name="c_district" id="district2">
                                      </select>
                                    </div>
                                  </div>
                                  <div class="col-md-3">
                                    <div class="form-group mb-3">
                                      <label class="placeholder">6. Mobile No./मोबाइल नंबर <span class="text-danger">*</span></label>
                                      <input type="text" pattern="[6-9][0-9]{9}$"  maxlength="10" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" value="{{ (isset($commun_detail->c_mobile) && $commun_detail->c_mobile !='') ? $commun_detail->c_mobile : $user->mobile }}" name="c_mobile"  id="c_mobile"  required class="form-control dis_check">
                                    </div>
                                  </div>
                                  <div class="col-md-3">
                                    <div class="form-group mb-3">
                                      <label class="placeholder">7.	Alternate Mobile No./वैकल्पिक मोबाइल नंबर <span class="text-danger">*</span></label>
                                      <input type="text" pattern="[6-9][0-9]{9}$"  maxlength="10" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" value="{{ isset($commun_detail->c_alternate_mobile)  ? $commun_detail->c_alternate_mobile : '' }}" name="c_alternate_mobile"  id="c_alternate_mobile"  required class="form-control dis_check">
                                    </div>
                                  </div>
                                  <div class="col-md-3">
                                    <div class="form-group mb-3">
                                      <label class="placeholder">8.	Email ID/ईमेल आईडी<span class="text-danger">*</span></label>
                                      <input type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" value="{{ (isset($commun_detail->c_email) && $commun_detail->c_email!='') ? $commun_detail->c_email : $user->email }}" name="c_email" id="c_email"   required  class="form-control dis_check">
                                    </div>
                                  </div>
                                </div>
                              </fieldset>

                            </div>
                          </div>





















                          <div class="form-scroll">
                            <div class="nano-content">
                              <fieldset>
                                <legend>A.	Educational Qualification Details/शैक्षिक योग्यता विवरण</legend>
                                <div class="row">
                                <div class="col-md-3">
                                  <div class="form-group">
                                      <label>1. UDISE Code of School</label>
                                      <input id="Text2" name="updise_code" value="{{ isset($education_detail->updise_code) ? $education_detail->updise_code : '' }}" type="text" required class="form-control" placeholder="Enter UDISE Code">
                                    </div>
                                  </div>
                                  <div class="col-md-3">
                                    <div class="form-group">
                                      <label>2. School/विद्यालय</label>
                                      <input id="Text2" value="{{ isset($education_detail->school) ? $education_detail->school : '' }}" name="school" type="text" required class="form-control" >
                                    </div>
                                  </div>
                                  <div class="col-md-3">
                                    <div class="form-group">
                                      <label>3. Class/कक्षा</label>
                                      {{-- <input id="Text2" name="class" readonly value="V" type="text" class="form-control" placeholder="V"> --}}
                                        <select required name="class" id="class_choose" class="form-select form-control">
                                        <option value="">Select</option>
                                        <option  @isset($education_detail->class) @if ($education_detail->class == "V Pass") selected @endif @endisset value="V Pass">V Pass</option>
                                        <option  @isset($education_detail->class) @if ($education_detail->class =="V Appearing") selected @endif @endisset value="V Appearing">V Appearing</option>
                                        </select>
                                      </div>
                                  </div>

                                  <div class="col-md-3">
                                    <div class="form-group">
                                      <label>4. Year of Passing/किस वर्ष में उत्तीर्ण किया</label>
                                      <?php
                                      $curr_year=date('Y');
                                      ?>

                                      <select required name="year_of_passing"class="form-select form-control">
                                        <option value="">Select</option>
                                        <option  @isset($education_detail->year_of_passing) @if ($education_detail->year_of_passing == $curr_year) selected @endif @endisset value="{{$curr_year}}">{{$curr_year}}</option>
                                        <option  @isset($education_detail->year_of_passing) @if ($education_detail->year_of_passing == $curr_year - 1) selected @endif @endisset value="{{$curr_year - 1}}">{{$curr_year - 1}}</option>

                                      </select>
                                      <span id="hidden_text" class="text-danger"> Please enter your previous class details</span>
                                    </div>
                                  </div>

                                  <div class="col-md-3">
                                    <div class="form-group">
                                      <label>5. Maximum Marks/अधिकतम अंक</label>
                                      <input id="maximum_marks" value="{{ isset($education_detail->maximum_marks) ? $education_detail->maximum_marks : '' }}"required  oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" name="maximum_marks" type="number" min="0" class="form-control">
                                    </div>
                                  </div>
                                  <div class="col-md-3">
                                    <div class="form-group">
                                      <label>6. Obtained Marks/प्राप्तांक</label>
                                      <input id="obtained_marks" value="{{ isset($education_detail->obtained_marks) ? $education_detail->obtained_marks : '' }}" required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" name="obtained_marks" type="number" min="0" class="form-control">
                                    </div>
                                  </div>
                                  <div class="col-md-3">
                                    <div class="form-group">
                                      <label>7. Grade/Percentage/ग्रेड/प्रतिशत</label>
                                      <input id="grade_percentage" value="{{ isset($education_detail->grade_percentage) ? $education_detail->grade_percentage : '' }}" required name="grade_percentage" type="text" class="form-control">
                                    </div>
                                  </div>
                                </div>
                              </fieldset>

                            </div>
                          </div>


















                          <div class="form-scroll">
                            <div class="nano-content">
                              <div class="row">
                                <div class="col-md-6">
                                  <div class="form-group mb-3 row">
                                    <label class="placeholder  col-6" style="text-align: right;">1.	Photo of Applicant/आवेदक की फोटो<span class="text-danger">*</span></label>
                                    <div class="col-6">
                                      <div class="input-group">
                                        <input type="file" name="applicant_photograph" {{ isset($education_detail->applicant_photograph) ? '' : 'required' }}  class="form-control"  onchange="getfileext2(this,'T3')" id="FileT3" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
                                        <input type="hidden" value="{{ isset($education_detail->applicant_photograph) ? $education_detail->applicant_photograph : '' }}" name="applicant_photograph1" >
                                        @if(isset($education_detail->applicant_photograph) && $education_detail->applicant_photograph !='')
                                        @php
                                        $img10 = url('public/onlineAdmission/images').'/'.$education_detail->applicant_photograph;
                                        $img1 = url('public/images/view.jpg');
                                        $doc = explode('.',$education_detail->applicant_photograph);

                                        @endphp
                                       <a href="{{$img10}}" class="btn btn-outline-success btn-xs" target="_blank"> View</a>
                                        @endif
                                        <!-- <a href="#" class="btn btn-secondary" id="A3">View</a>  -->
                                      </div>
                                      <span class="note">(File Format/फाइल का प्रारूप: JPEG/JPG ; Max File Size/फाइल का अधिकतम साईज़: 2 MB)</span> </div>
                                  </div>
                                </div>

                                <div class="col-md-6">
                                  <div class="form-group mb-3 row">
                                    <label class="placeholder  col-6" style="text-align: right;">2.	Signature of Applicant/आवेदक के हस्ताक्षर <span class="text-danger">*</span></label>
                                    <div class="col-6">
                                      <div class="input-group">
                                        <input type="file" name="applicant_signature" {{ isset($education_detail->applicant_signature) ? '' : 'required' }} class="form-control"  onchange="getfileext2(this,'T4')"id="FileT4" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
                                        <input type="hidden" value="{{ isset($education_detail->applicant_signature) ? $education_detail->applicant_signature : '' }}" name="applicant_signature1" >
                                        @if(isset($education_detail->applicant_signature) && $education_detail->applicant_signature !='')
                                        @php
                                        $img11 = url('public/onlineAdmission/images').'/'.$education_detail->applicant_signature;
                                        $img1 = url('public/images/view.jpg');
                                        $doc = explode('.',$education_detail->applicant_signature);

                                        @endphp
                                        <a href="{{$img11}}" class="btn btn-outline-success btn-xs" target="_blank"> View</a>
                                        @endif
                                        <!-- <a href="#" class="btn btn-secondary" id="A3">View</a>  -->
                                      </div>
                                      <span class="note">(File Format/फाइल का प्रारूप: JPEG/JPG ; Max File Size/फाइल का अधिकतम साईज़: 2 MB)</span> </div>
                                  </div>
                                </div>


                                {{-- <div class="col-md-6">
                                  <div class="form-group mb-3 row">
                                    <label class="placeholder  col-6" style="text-align: right;">4.	Domicile Certificate of UP/उत्तर प्रदेश का अधिवास प्रमाणपत्र<span class="text-danger">*</span></label>
                                    <div class="col-6">
                                      <div class="input-group">
                                        <input type="file" name="domicile_certificate" {{ isset($education_detail->domicile_certificate) ? '' : 'required' }} class="form-control"  onchange="getfileext(this,'2')" id="File2" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
                                          <input type="hidden" value="{{ isset($education_detail->domicile_certificate) ? $education_detail->domicile_certificate : '' }}" name="domicile_certificate1" >
                                          @if(isset($education_detail->domicile_certificate) && $education_detail->domicile_certificate !='')
                                          @php
                                          $img = url('public/onlineAdmission/images').'/'.$education_detail->domicile_certificate;
                                          $img1 = url('public/images/view.jpg');
                                          $doc = explode('.',$education_detail->domicile_certificate);

                                          @endphp
                                          <img src="{{$img1}}" role="button"  onclick="appendImage('{{$img}}','{{$doc[1]}}')" class="img-fluid" />
                                          @endif
                                        <!-- <a href="#" class="btn btn-secondary" id="A4">View</a> -->
                                       </div>
                                      <span class="note">(File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)</span> </div>
                                  </div>
                                </div> --}}

                                <div class="col-md-6">
                                  <div class="form-group mb-3 row">
                                    <label class="placeholder  col-6" style="text-align: right;">3.	Educational Certificate of Class 5/ स्कूल द्वारा निर्गत कक्षा 5 प्रमाण पत्र /अंक तालिका<span class="text-danger">*</span></label>
                                    <div class="col-6">
                                      <div class="input-group">
                                        <input type="file" name="education_certificate" {{ isset($education_detail->education_certificate) ? '' : 'required' }} class="form-control"  onchange="getfileext25(this,'T44')"id="FileT44"  aria-describedby="inputGroupFileAddon05" aria-label="Upload">
                                        <input type="hidden" value="{{ isset($education_detail->education_certificate) ? $education_detail->education_certificate : '' }}" name="education_certificate1" >
                                        @if(isset($education_detail->education_certificate) && $education_detail->education_certificate !='')
                                        @php
                                        $img12 = url('public/onlineAdmission/images').'/'.$education_detail->education_certificate;
                                        $img1 = url('public/images/view.jpg');
                                        $doc = explode('.',$education_detail->education_certificate);

                                        @endphp
                                        <a href="{{$img12}}" class="btn btn-outline-success btn-xs" target="_blank"> View</a>
                                        @endif
                                        <!-- <a href="#" class="btn btn-secondary" id="A5">View</a>  -->
                                      </div>
                                      <span class="note">(	File Format/फाइल का प्रारूप: PDF/JPEG/JPG ; Max File Size/फाइल का अधिकतम साईज़:  2 MB)</span> </div>
                                  </div>
                                </div>

                                <div class="col-md-6" >
                                  <div class="form-group mb-3 row">
                                    <label class="placeholder  col-6" style="text-align: right;" ><span >4. Applicant's Aadhaar</span><span class="text-danger">*</span></label>
                                    <div class="col-6">
                                      <div class="input-group">
                                        <input type="file" name="applicant_aadhar_birth_certificate" {{ isset($education_detail->applicant_aadhar_birth_certificate) ? '' : 'required' }} class="form-control"   onchange="getfileext25(this,'T444')"id="FileT444" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
                                        <input type="hidden" value="{{ isset($education_detail->applicant_aadhar_birth_certificate) ? $education_detail->applicant_aadhar_birth_certificate : '' }}" name="applicant_aadhar_birth_certificate1" >
                                        @if(isset($education_detail->applicant_aadhar_birth_certificate) && $education_detail->applicant_aadhar_birth_certificate !='')
                                        @php
                                        $img13 = url('public/onlineAdmission/images').'/'.$education_detail->applicant_aadhar_birth_certificate;
                                        $img1 = url('public/images/view.jpg');
                                        $doc = explode('.',$education_detail->applicant_aadhar_birth_certificate);

                                        @endphp
                                        <a href="{{$img13}}" class="btn btn-outline-success btn-xs" target="_blank"> View</a>
                                        @endif
                                        <!-- <a href="#" class="btn btn-secondary" id="A3">View</a> -->
                                       </div>
                                      <span class="note">(File Format/फाइल का प्रारूप: PDF/JPEG/JPG ; Max File Size/फाइल का अधिकतम साईज़:  2 MB 2 MB)</span> </div>
                                  </div>
                                </div>

                                <div class="col-md-6" >
                                  <div class="form-group mb-3 row">
                                    <label class="placeholder  col-6" style="text-align: right;" ><span >5. Applicant's DOB issued by School / Registrar</span><span class="text-danger">*</span></label>
                                    <div class="col-6">
                                      <div class="input-group">
                                        <input type="file" name="applicant_birth_certificate" {{ isset($education_detail->applicant_birth_certificate) ? '' : 'required' }} class="form-control"   onchange="getfileext25(this,'T444')"id="FileT444" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
                                        <input type="hidden" value="{{ isset($education_detail->applicant_birth_certificate) ? $education_detail->applicant_birth_certificate : '' }}" name="applicant_birth_certificate1" >
                                        @if(isset($education_detail->applicant_birth_certificate) && $education_detail->applicant_birth_certificate !='')
                                        @php
                                        $img14 = url('public/onlineAdmission/images').'/'.$education_detail->applicant_birth_certificate;
                                        $img1 = url('public/images/view.jpg');
                                        $doc = explode('.',$education_detail->applicant_birth_certificate);

                                        @endphp
                                        <a href="{{$img14}}" class="btn btn-outline-success btn-xs" target="_blank"> View</a>
                                        @endif
                                        <!-- <a href="#" class="btn btn-secondary" id="A3">View</a> -->
                                       </div>
                                      <span class="note">(File Format/फाइल का प्रारूप: PDF/JPEG/JPG ; Max File Size/फाइल का अधिकतम साईज़:  2 MB)</span> </div>
                                  </div>
                                </div>
                                {{-- <div class="col-md-6">
                                  <div class="form-group mb-3 row">
                                    <label class="placeholder  col-6" style="text-align: right;">4. Select Document<span class="text-danger">*</span></label>
                                    <div class="col-6">

                                        <select required name="document_type" class="form-select form-control" id="document_type" onchange="docType()" >
                                          <option value="">Select</option>
                                              <option  @isset($education_detail->document_type) @if ($education_detail->document_type == 'Birth Certificate attested by Principal') selected @endif @endisset value="Birth Certificate attested by Principal">Birth Certificate attested by Principal</option>
                                          <option  @isset($education_detail->document_type) @if ($education_detail->document_type == 'Birth Certificate issued by Registrar') selected @endif @endisset value="Birth Certificate issued by Registrar">Birth Certificate issued by Registrar</option>
                                      </select>
                                      </div>
                                  </div>
                                </div>
                                <div class="col-md-6" id="documentUpload">
                                  <div class="form-group mb-3 row">
                                    <label class="placeholder  col-6" style="text-align: right;" ><span id="docname"></span><span class="text-danger">*</span></label>
                                    <div class="col-6">
                                      <div class="input-group">
                                        <input type="file" name="applicant_aadhar_birth_certificate" {{ isset($education_detail->applicant_aadhar_birth_certificate) ? '' : 'required' }} class="form-control"   onchange="getfileext25(this,'T444')"id="FileT444" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
                                        <input type="hidden" value="{{ isset($education_detail->applicant_aadhar_birth_certificate) ? $education_detail->applicant_aadhar_birth_certificate : '' }}" name="applicant_aadhar_birth_certificate1" >
                                        @if(isset($education_detail->applicant_aadhar_birth_certificate) && $education_detail->applicant_aadhar_birth_certificate !='')
                                        @php
                                        $img13 = url('public/onlineAdmission/images').'/'.$education_detail->applicant_aadhar_birth_certificate;
                                        $img1 = url('public/images/view.jpg');
                                        $doc = explode('.',$education_detail->applicant_aadhar_birth_certificate);

                                        @endphp
                                        <a href="{{$img13}}" class="btn btn-outline-success btn-xs" target="_blank"> View</a>
                                        @endif

                                       </div>
                                      <span class="note">(File Format/फाइल का प्रारूप: PDF/JPEG/JPG ; Max File Size/फाइल का अधिकतम साईज़: 10 MB)</span> </div>
                                  </div>
                                </div> --}}
                                <?php
                                $curr_year=date('Y');
                                ?>
                                @isset($education_detail->year_of_passing) @if ($education_detail->year_of_passing == $curr_year - 1)

                                <div class="col-md-6">
                                  <div class="form-group mb-3 row">
                                    <label class="placeholder  col-6" style="text-align: right;">6.	Affidavit/घोषणा पत्र<span class="text-danger">*</span></label>
                                    <div class="col-6">
                                      <div class="input-group">
                                        <input type="file" name="affidavit" {{ isset($education_detail->affidavit) ? '' : 'required' }} class="form-control"   onchange="getfileext25(this,'T4444')"id="FileT4444" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
                                        <input type="hidden" value="{{ isset($education_detail->affidavit) ? $education_detail->affidavit : '' }}" name="affidavit" >
                                          @if(isset($education_detail->affidavit) && $education_detail->affidavit !='')
                                          @php
                                          $img14 = url('public/onlineAdmission/images').'/'.$education_detail->affidavit;
                                          $img1 = url('public/images/view.jpg');
                                          $doc = explode('.',$education_detail->affidavit);

                                          @endphp
                                        <a href="{{$img14}}" class="btn btn-outline-success btn-xs" target="_blank"> View</a>

                                          @endif
                                        <!-- <a href="#" class="btn btn-secondary" id="A5">View</a>  -->
                                      </div>
                                      <span class="note">(	File Format/फाइल का प्रारूप: PDF/JPEG/JPG ; Max File Size/फाइल का अधिकतम साईज़:  2 MB)</span> </div>
                                  </div>
                                </div>
                                @endif @endisset
                                {{-- @isset($basic_detail->disease) @if ($basic_detail->disease == 1)
                                <div class="col-md-6">
                                  <div class="form-group mb-3 row">
                                    <label class="placeholder  col-6" style="text-align: right;">6.	Fitness Certificate/स्वास्थ्य प्रमाणपत्र <span class="text-danger">*</span></label>
                                    <div class="col-6">
                                      <div class="input-group">
                                        <input type="file" name="medical_certificate" {{ isset($education_detail->medical_certificate) ? '' : 'required' }} class="form-control"  onchange="getfileext(this,'3')" id="File3" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
                                        <input type="hidden" value="{{ isset($education_detail->medical_certificate) ? $education_detail->medical_certificate : '' }}" name="medical_certificate1" >
                                          @if(isset($education_detail->medical_certificate) && $education_detail->medical_certificate !='')
                                          @php
                                          $img14 = url('public/onlineAdmission/images').'/'.$education_detail->medical_certificate;
                                          $img1 = url('public/images/view.jpg');
                                          $doc = explode('.',$education_detail->medical_certificate);

                                          @endphp
                                        <a href="{{$img14}}" class="btn btn-outline-success btn-xs" target="_blank"> View</a>

                                          @endif
                                        <!-- <a href="#" class="btn btn-secondary" id="A5">View</a>  -->
                                      </div>
                                      <span class="note">(File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)</span> </div>
                                  </div>
                                </div>
                                @endif @endisset --}}
                              </div>

                              <div class="bhoechie-footer">
                                <div class="row justify-content-center">

                                  <div class="col-md-2 d-grid">
                            {{-- <button type="reset" class="btn btn-outline-light rounded-pill">Reset/रीसेट</button> --}}
                                  </div>
                                  <div class="col-md-2 d-grid">
                                  <button type="submit" class="btn btn-outline-danger rounded-pill">Submit</button>
                                    <!-- <a href="#" class="btn btn-outline-danger rounded-pill">Save and Next</a> -->
                                   </div>
                                </div>
                              </div>
                            </div>
                          </div>













                    </div>
            </div>
        </div>


    </form>

@endsection
@push('custom-scripts')

<!-- <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"> -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>

<script type="text/javascript">
$("#basic_detail").submit(function(e) {
    e.preventDefault();
    if ($("#basic_detail")[0].checkValidity() === false) {
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
                    window.location.href = res.url;
                } else {
                    error(res.msg);
                }
            },
        });
    }
    $("#basic_detail").addClass("was-validated");
});




//=============================
function printContent(el) {
        var restorepage = document.body.innerHTML;
        var printcontent = document.getElementById(el).innerHTML;
        document.body.innerHTML = printcontent;
        window.print();
        document.body.innerHTML = restorepage;
    }








    function sporttype(){
        var wrapper = $(".container3");
        var gender=$('input[name="gender"]:checked').val();
        var sport=$('#sport_type').val();
        var sportvalue = $( '#test1' ).data( 'sport' );
        var subsports_id = $(".container3").attr('data-subsport');

        get_college(sport,gender)

        let option=`<option value=''>Select Sub Sport</option>`;
        $.ajax({
            type: "POST",
            url: "{{url('admin/get_subsport_admin')}}",
            data: {sport},
            success: function (response) {
                $(".container3").empty();


               if(response.length > 0 && sportvalue != sport ){

                    $("#subsport").show();
                    $("#subsport2").css("display", "none");
                    $(".subtest").removeAttr("name");
                    $(".subtest").removeAttr("required");
                    $(".container3").attr("required", true);
                    let option=`<option value=''>Select Subsport</option>`;
                    $.each( response, function(key,item)   {

                      option+= ` <option value="${item.id}" ${item.id}" ${item.id==subsports_id?'selected':''}>${item.sub_type}</option>`;
                })
                $(".container3").append(option);
               }else if(sportvalue == sport){
                $("#subsport2").css("display", "block");
                $(".subtest").attr("name");


               } else{
                $("#subsport2").css("display", "none");
                $(".container3").removeAttr("required", true);
               }

            }
           });

        let male  = document.querySelector('#Radio3').value
   let female  = document.querySelector('#Radio4').value;
   var gender=$('input[name="gender"]:checked').val();
        console.log("gender1"+gender);
   if (sport == 10 && gender == 1) {
    document.querySelector('#subsport').style.display = 'none';
        $("#height").attr({
            // substitute your own
       "min" : 165          // values (or variables) here
    });

      }


      else if (sport == 44 && gender == 1) {
        document.querySelector('#subsport').style.display = 'none';
        document.querySelector('#weightadd').style.display = 'block';
        document.querySelector('#weightremove').style.display = 'none';
        document.querySelector('#weightaddgirl').style.display = 'none';
        $("#weightaddgirl").removeAttr("name");
        $("#weightremove").removeAttr("name");
        $("#weightadd").attr({
            // substitute your own
       "name" : "weight"          // values (or variables) here
    });

      }

      else if (sport == 44 && gender == 2) {
        document.querySelector('#subsport').style.display = 'none';
        document.querySelector('#weightaddgirl').style.display = 'block';
        document.querySelector('#weightremove').style.display = 'none';
        document.querySelector('#weightadd').style.display = 'none';
        $("#weightadd").removeAttr("name");
        $("#weightremove").removeAttr("name");
        $("#weightaddgirl").attr({
            // substitute your own
       "name" : "weight"          // values (or variables) here
    });
      }

      else if (sport == 10 && gender == 2) {
        document.querySelector('#subsport').style.display = 'none';
        $("#height").attr({
            // substitute your own
       "min" : 155          // values (or variables) here
    });

      }
      else{
        document.querySelector('#subsport').style.display = 'none';
        document.querySelector('#weightadd').style.display = 'none';
        document.querySelector('#weightremove').style.display = 'block';
        document.querySelector('#weightaddgirl').style.display = 'none';
        $("#weightadd").removeAttr("required");
        $("#weightadd").removeAttr("name");
        $("#weightaddgirl").removeAttr("name");
        $("#weightaddgirl").removeAttr("required");
        $("#height").attr({
            // substitute your own
       "min" : 0
      });
      }
      }

      function docType(){
        const type = document.querySelector('#document_type').value;
					if( type  == 'Birth Certificate attested by Principal'){

						document.querySelector('#documentUpload').style.display = 'block';
            document.querySelector('#docname').innerHTML = "5. Birth Certificate attested by Principal/प्राचार्य द्वारा प्रमाणित जन्म प्रमाण पत्र";

					}else if (type  == 'Birth Certificate issued by Registrar'){
            document.querySelector('#documentUpload').style.display = 'block';
            document.querySelector('#docname').innerHTML = "5. Birth Certificate issued by Registrar/रजिस्ट्रार द्वारा निर्गत जन्म प्रमाण पत्र";
					}
          else if (type  == 'Aadhaar Card'){
            document.querySelector('#documentUpload').style.display = 'block';
            document.querySelector('#docname').innerHTML = "5. Aadhaar Card/आधार कार्ड";
					}

					else{

						document.querySelector('#documentUpload').style.display = 'none';
					}
      }

       let sport=$('#sport_type').val();
       var gender=$('input[name="gender"]:checked').val();
          if(gender != null){
            get_college(sport,gender)
          }
          // let college=$('#college_id').val();
          // if(college != null){
          //   get_sport(college)
          // }
        function show1() {
            document.getElementById('pgetway').style.display = 'flex';
            document.getElementById('ddraft').style.display = 'none';
        }
        function show2() {
            document.getElementById('pgetway').style.display = 'none';
            document.getElementById('ddraft').style.display = 'flex';
        }
        function show3() {
            document.getElementById('laidemployee').style.display = 'block';
        }
        function show4() {
            document.getElementById('laidemployee').style.display = 'none';
        }
        function show5() {
            document.getElementById('imprisoned').style.display = 'block';
        }
        function show6() {
            document.getElementById('imprisoned').style.display = 'none';
        }
        $(document).ready(function () {


            // $('.select').select2();

            $('#landdocumentsyes').click(function () {
                $(".landdocuments").show();
                $(".requestland").hide();
            });
            $('#requestlandno').click(function () {
                $(".landdocuments").hide();
                $(".requestland").show();
            });

            $('#pwds').change(function () {
                if (!this.checked) {
                    $("#disabilityper").hide();
                    $("#disabilitynat").hide();
                }
                else {
                    $("#disabilityper").show();
                    $("#disabilitynat").show();
                }
            });
        });



        function show7() {
            document.getElementById('disabilityper').style.display = 'block';
            document.getElementById('disabilitynat').style.display = 'block';
        }
        $(document).ready(function () {
//anu
          $( "#p_mobile,#p_alternate_mobile,#c_mobile,#c_alternate_mobile" ).on( "blur", function() {
            if($('#p_mobile').val() == $('#p_alternate_mobile').val()){
              error("Permanent Address Mobile no. and Alternate mobile no. should not be same.");
              $('#btn_comm').prop('disabled', true);
            }else{
              $('#btn_comm').prop('disabled', false);
            }
            if($('#c_mobile').val() == $('#c_alternate_mobile').val()){
              error("Correspondence Address Mobile no. and Alternate mobile no. should not be same.");
              $('#btn_comm').prop('disabled', true);
            }else{
              $('#btn_comm').prop('disabled', false);
            }
          } );

          $("#class_choose").change(function(){
            if($('#class_choose').val() == "V Appearing"){
                $('#hidden_text').show();
            }else{
                $('#hidden_text').hide();
            }
          });

          $( "#maximum_marks,#obtained_marks" ).change(function() {
            console.log("dfg")
            if($('#maximum_marks').val() != "" && $('#obtained_marks').val() != ""){
              var obtained_marks=$('#obtained_marks').val();
              var maximum_marks=$('#maximum_marks').val();
              var perc= ((obtained_marks * 100) / maximum_marks);
              $('#grade_percentage').val(perc);
            }
          });

          //anu

            $("div.bhoechie-tab-menu>div.list-group>a").click(function (e) {

                e.preventDefault();
                $(this).siblings('a.active').removeClass("active");
                $(this).addClass("active");
                var index = $(this).index();
                $("div.bhoechie-tab>div.bhoechie-tab-content").removeClass("active");
                $("div.bhoechie-tab>div.bhoechie-tab-content").eq(index).addClass("active");
            });

            $('.requireland').click(function () {
                var inputValue = $(this).attr("value");
                var targetBox = $("." + inputValue);
                $(".hidebox").not(targetBox).hide();
                $(targetBox).show();
            });
            $('.requireland1').click(function () {
                var inputValue = $(this).attr("value");
                var targetBox = $("." + inputValue);
                $(".hidebox1").not(targetBox).hide();
                $(targetBox).show();
            });
            $('.requireland2').click(function () {
                var inputValue = $(this).attr("value");
                var targetBox = $("." + inputValue);
                $(".hidebox2").not(targetBox).hide();
                $(targetBox).show();
            });

            $('.requireland3').click(function () {
                var inputValue = $(this).attr("value");
                var targetBox = $("." + inputValue);
                $(".hidebox3").not(targetBox).hide();
                $(targetBox).show();
            });
            $('.requireland4').click(function () {
                var inputValue = $(this).attr("value");
                var targetBox = $("." + inputValue);
                $(".hidebox4").not(targetBox).hide();
                $(targetBox).show();
            });

            $('#nationality').on('change', function () {
                if (this.value == 'other') {
                    $("#countryname").show();
                }
                else {
                    $("#countryname").hide();
                }
            });

            $('#typeofApp').on('change', function () {
                if (this.value == 'individual') {
                    $("#individual").show();
                    $("#organization").hide();
                }
                else if (this.value == 'organization') {
                    $("#organization").show();
                    $("#individual").hide();
                }
                else {
                    $("#individual").hide();
                    $("#organization").hide();
                }
            });

            $('#divSlsct').on('change', function () {
                if (this.value == 'red') {
                    $(".red").show();
                    $(".green").hide();
                }
                else if (this.value == 'green') {
                    $(".green").show();
                    $(".red").hide();
                }
                else {
                    $(".red").hide();
                    $(".green").hide();
                }
            });

        });
        // $('.datepicker').datetimepicker({
        //     format: 'DD/MM/YYYY',
        // });
        $(".back").click(function () {
            window.history.go(-1);
            return false;
        });

        $(document).ready(function () {

            sporttypee()
            $("select").change(function () {
                $(this).find("option:selected").each(function () {
                    var optionValue = $(this).attr("value");
                    if (optionValue) {
                        $(".box").not("." + optionValue).hide();
                        $("." + optionValue).show();
                        // alert($("." + optionValue))
                    } else {
                        $(".box").hide();
                    }
                });
            }).change();
        });

        function get_city(value,id)
         {
            let district3=$("#district3").val();
            let h_city = $("#district1").val();
            let option=`<option value=''>Select District</option>`;
           $.ajax({
            type: "POST",
            url: "{{url('get_city')}}",
            data: {value},

            success: function (response) {
                response.forEach((item)=>{
                  if (h_city && id == "district2" && $("#myCheck").prop('checked') == true) {
                        option += `<option value="${item.id}" ${item.id==h_city?'selected':''}>${item.city}</option>`;
                    }else{
                      option +=`<option ${item.id == district3 ? 'selected':''} value="${item.id}" >${item.city}</option>`;
                    }
                });
                $("#"+id).empty();
                $("#"+id).append(option);
            }
           });
         }
         function get_college(sport,gender)
         {
            let college_id1=$("#college_id1").val();
            let college_id2=$("#college_id2").val();
            let option1=`<option value=''>Select College</option>`;
            let option2=`<option value=''>Select College</option>`;
            if(gender != '' && sport != '' ){

              $.ajax({
                type: "POST",
                url: "{{url('admin/get_college_admin')}}",
                data: {sport,gender},
                success: function (response) {


                    if (response.gender == 2) {
                      $('#forgirl').css("display", "none");
                      $("#college_type2").removeAttr("name");
                      // $("#college_type2").removeAttr("required", true);
                    }else{
                        $('#forgirl').css("display", "block");
                        $("#college_type2").attr("name","sport_college[]");
                      // $("#college_type2").attr("required", true);
                    }

                    response.all_college.forEach((item)=>{
                        option1 +=`<option ${item.id == college_id1 ? 'selected':''} value="${item.id}" >${item.college_name}</option>`;
                    });
                    $("#college_type1").empty();
                    $("#college_type1").append(option1);

                    response.all_college.forEach((item)=>{
                        option2 +=`<option ${item.id == college_id2 ? 'selected':''} value="${item.id}" >${item.college_name}</option>`;
                    });
                    $("#college_type2").empty();
                    $("#college_type2").append(option2);
                }
              });
            }
         }

        //  function get_subSport(value)
        //  {
        //     let college_id=$("#college_id").val();
        //     let option=`<option value=''>Select College</option>`;
        //    $.ajax({
        //     type: "POST",
        //     url: "{{url('onlineAdmission/get_college')}}",
        //     data: {value},
        //     success: function (response) {
        //         response.forEach((item)=>{
        //             option +=`<option ${item.id == college_id ? 'selected':''} value="${item.id}" >${item.college_name}</option>`;
        //         });
        //         $("#college_type").empty();
        //         $("#college_type").append(option);
        //     }
        //    });
        //  }

        //  function get_sport()
        //  {

        //     let sports_id=$("#sports_id").val();
        //     var college1= document.getElementById("college_type1").value;
        //     var college2= document.getElementById("college_type2").value;

        //     let gender=$('input[name="gender"]:checked').val();
        //     let option=`<option value=''>Select Sports</option>`;
        //    if(college1 != "" && college2 != ""){
        //     console.log("hello");
        //    }
        //     $.ajax({
        //     type: "POST",
        //     url: "{{url('onlineAdmission/get_sport')}}",
        //     data: {college1:college1,college2:college2},
        //     success: function (response) {
        //       console.log(response);
        //         response.forEach((item)=>{

        //           if (sports_id == 10 && gender == 2) {
        //                 $("#height").attr({
        //                     // substitute your own
        //               "min" : 155          // values (or variables) here
        //             });
        //           }
        //           if (sports_id == 10 && gender == 1) {
        //                 $("#height").attr({
        //                     // substitute your own
        //               "min" : 165          // values (or variables) here
        //             });
        //           }

        //               if (sports_id == 25 && gender == 2) {

        //             document.querySelector('#weightaddgirl').style.display = 'block';
        //             document.querySelector('#weightremove').style.display = 'none';
        //             document.querySelector('#weightadd').style.display = 'none';
        //             $("#weightadd").removeAttr("name");
        //             $("#weightremove").removeAttr("name");
        //             $("#weightaddgirl").attr({
        //                 // substitute your own
        //           "name" : "weight"          // values (or variables) here
        //         });
        //       }

        //       if (sports_id == 25 && gender == 1) {

        //         document.querySelector('#weightadd').style.display = 'block';
        //         document.querySelector('#weightremove').style.display = 'none';
        //         document.querySelector('#weightaddgirl').style.display = 'none';
        //         $("#weightaddgirl").removeAttr("name");
        //         $("#weightremove").removeAttr("name");
        //         $("#weightadd").attr({
        //             // substitute your own
        //       "name" : "weight"          // values (or variables) here
        //       });
        //       }

        //             option +=`<option ${item.sports_id == sports_id ? 'selected':''} value="${item.sports_id}" >${item.name}</option>`;
        //         });
        //         $("#sport_type").empty();
        //         $("#sport_type").append(option);
        //          $("#sport_type").trigger("change");
        //     }
        //    });
        //  }

         function document_type(){

					const type = document.querySelector('#documenttype').value;
					if( type == 1){

						document.querySelector('#documentUpload').style.display = 'block';

					}else if (type == 2){
						document.querySelector('#type_dd').style.display = 'block';
            document.querySelector('#documentUpload').style.display = 'block';


					}

					else{

						document.querySelector('#documentUpload').style.display = 'none';
					}
					}







      function myFunction() {
      var checkBox = document.getElementById("myCheck");

      if (checkBox.checked == true){


        console.log(document.getElementById("state1").value );


        document.getElementById("c_post").value = document.getElementById("p_post").value ;
        document.getElementById("c_gram").value = document.getElementById("p_gram").value ;
        document.getElementById("c_thana").value = document.getElementById("p_thana").value ;
        document.getElementById("c_mobile").value = document.getElementById("p_mobile").value ;
        document.getElementById("c_alternate_mobile").value = document.getElementById("p_alternate_mobile").value ;
        document.getElementById("c_email").value = document.getElementById("p_email").value ;
        document.getElementById("state2").value = document.getElementById("state1").value ;
        get_city(document.getElementById("state1").value,"district2");
        document.getElementById("district2").value = document.getElementById("district1").value ;
        $('.dis_check').attr("style", "pointer-events: none;");
      }
      else{
        document.getElementById("c_post").value = " " ;
        document.getElementById("c_gram").value = " " ;
        document.getElementById("c_thana").value = " " ;
        document.getElementById("c_mobile").value = " " ;
        document.getElementById("c_alternate_mobile").value = " " ;
        document.getElementById("c_email").value = " " ;
        document.getElementById("state2").value = " " ;
        document.getElementById("district2").value = " " ;
        $('.dis_check').attr("style", "");
      }
      }

      $(document.body).on('change', '.college_type', function () {




        if ( $('#Radio3').val() == 1) {


            var selecteditem = $(this);
            $('.college_type').each(function (index, value) {
            var item = $(this);


            if (item.val() != '' && (!selecteditem.is(item))) {
                if ( item.val() === selecteditem.val()  ) {

                    selecteditem.val("");
                    alert("College Already Selected");
                    return false;
                }
                else{
                  get_sport();
                }

            }
        });
        }else{
                  get_sport();
          }

    });



    function sporttypee(){
        let gender1=$('input[name="gender"]:checked').val();
        let option=`<option value=''>Select Sports</option>`;
        let sports_id = $('#sports_id').val();
        $.ajax({
            type: "POST",
            url: "{{url('admin/get_sport_admin')}}",
            data: {gender:gender1},
            success: function (response) {
                response.forEach((item)=>{
                   option +=`<option value="${item.id}" ${item.id == sports_id ? 'selected':''} >${item.name}</option>`;
                })


                $("#sport_type").empty();
            $("#sport_type").append(option);
            var gender=$('input[name="gender"]:checked').val();
        var sport=$('#sport_type').val();
        get_college(sport,gender) ;
            }

        })

    }




















</script>
@endpush
