@extends( 'layouts\layout' )
@section('content')

<div class="container-fluid pagecontentbody">
    <div class="pagebody removebg-color">
        <div class="row">
            <div class="col-12">
                <div class="pageheader" id="menu-margin">
                    <h4 class="mb-0">
                        Application Form/आवेदन फार्म
                        <a href="{{ route('dashboard') }}"
                            class="btn btn-outline-danger btn-sm backbtn float-end rounded-pill">
                            <span class="icons icon-arrow-left"></span>Back to Dashboard</a>
                    </h4>
                </div>
            </div>
            <div class="col-12">
                <div class="bhoechie-tab-content">
                    <div class="form-scroll">
                        <div class="nano-content">
                            <div class="row">
                                <div class="col-12">
                                    <fieldset>
                                        <div class="col-md-12">
                                            <h5 class="subheading">Eklavya Krida Kosh /एकलव्य क्रीड़ा कोष</h5>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="form-group mb-3">
                                                    <label class="placeholder">1. पूरा नाम/Full Name<span
                                                            class="text-danger">*</span></label>
                                                    <input type="text" class="form-control"
                                                        value="{{ Auth::user()->fullname  }}" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group mb-3">
                                                    <label class="placeholder">2. ईमेल पता/Email ID<span
                                                            class="text-danger">*</span></label>
                                                    <input type="email" class="form-control"
                                                        value="{{ Auth::user()->email  }}" disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group mb-3">
                                                    <label class="placeholder">3. मोबाइल नंबर/Mobile Number
                                                      <span class="text-danger">*</span></label>
                                                    <input type="number" class="form-control" value="{{ Auth::user()->mobile  }}"
                                                        disabled>
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group mb-3">
                                                    <label class="placeholder">4. Aadhar Number / आधार कार्ड
                                                      <span class="text-danger">*</span></label>
                                                      <input type="number" class="form-control" value="{{ Auth::user()->aadhar_no  }}"
                                                        disabled>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                                <div class="col-12">
                                @if(isset($eklavya_data->application_no) && !empty($eklavya_data->application_no))
                                <form action="{{ route('eklavya_kreeda_kosh_updateawardStore') }}" id="ajxReload" method="post" class="needs-validation" novalidate enctype="multipart/form-data" >
                                @else
                                <form action="{{ route('eklavya_kreeda_kosh_awardStore') }}" id="ajxReload" method="post" class="needs-validation" novalidate enctype="multipart/form-data" >
                                @endif      
                                <input type="hidden"  name="application_no" value="{{ isset($eklavya_data->application_no)  ? $eklavya_data->application_no : '' }}" /> 
                                    <div class="col-md-12">
                                        <fieldset>
                                            <div class="col-md-12">
                                                <h5 class="subheading">A. Basic Details/सामान्य विवरण</h5>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="placeholder">1. Which Sport did/do you play?/कौन सा खेल खेलते थे/हैं?<span class="text-danger">*</span></label>
                                                        <select class="form-select sport_type" name="sport_type" required>
                                                            <option value="">Select</option>
                                                            @foreach ($sports as $type)
                                                            <option value="{{$type->id}}" {{ $selected_sport==$type->id ? 'selected' : '' }} {{ old('sport_type') === $type->id ? 'selected' : '' }}>{{$type->name}}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                
                                                
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="placeholder">2. Highest Educational Qualification/उच्चतम शैक्षणिक योग्यता<span class="text-danger">*</span></label>
                                                        <select class="form-control form-select dropdown" required id="qualification" name="qualification">
                                                            <option value="" selected="selected" disabled="disabled">Select</option>
                                                            <option @if(isset($eklavya_data->qualification) && $eklavya_data->qualification == "10") selected="selected" @endif value="10">10th/High School</option>
                                                            <option @if(isset($eklavya_data->qualification) && $eklavya_data->qualification == "12") selected="selected" @endif value="12">12th / Intermediate</option>
                                                            <option @if(isset($eklavya_data->qualification) && $eklavya_data->qualification == "graduation") selected="selected" @endif value="graduation">Graduation</option>
                                                            <option @if(isset($eklavya_data->qualification) && $eklavya_data->qualification == "post_graduation") selected="selected" @endif value="post_graduation">Post-Graduation </option>
                                                            <option @if(isset($eklavya_data->qualification) && $eklavya_data->qualification == "diploma") selected="selected" @endif value="diploma">Diploma (NIS/LNIPE) </option>
                                                            <option @if(isset($eklavya_data->qualification) && $eklavya_data->qualification == "researcher") selected="selected" @endif value="researcher ">Researcher </option>
                                                            {{-- <option {{ old( 'qualification') === "phd" ? 'selected' : '' }} value="phd">PhD</option>--}}
                                                            <option @if(isset($eklavya_data->qualification) && $eklavya_data->qualification == "other") selected="selected" @endif value="other">Other</option> 
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-md-4" id="high_school_div">
                                                    <div class="form-group">
                                                        <input type="hidden" name="dob" value={{$dob}} id="dob" />
                                                        <label>3. High School Certificate/हाई स्कूल प्रमाण पत्र<span class="text-danger">*</span>
                                                            <br><span class="note" style="font-size: 11px;">(File Format/फाइल का प्रारूप: JPEG/JPG/PDF | Max File Size/फाइल का अधिकतम साइज़: 2 MB)</span>
                                                            </label>
                                                        <div class="input-group">
                                                            <input type="file" onchange="getfileext(this.value,103)" id="File103" class="form-control" name="high_school_certificate" {{ isset($eklavya_data->high_school_certificate)  ? '' : 'required'  }}>
                                                            <input type="hidden" name="high_school_certificate1" @if(isset($eklavya_data->high_school_certificate))  value="{{$eklavya_data->high_school_certificate}}" @endif />
                                                            @if(isset($eklavya_data->high_school_certificate))
                                                                @php
                                                                $img = url('public/eklavya_krida_kosh/high_school_certificate/').'/'.$eklavya_data->high_school_certificate;
                                                                $img1 = url('public/images/view.jpg');
                                                                $doc = explode('.',$eklavya_data->high_school_certificate);
                                                                @endphp
                                                            <img src="{{$img1}}" role="button" onclick="appendImage('{{$img}}','{{$doc[1] ?? ''}}')" class="img-fluid" />
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4" id="other_div">
                                                    <div class="form-group mb-3">
                                                        <label class="placeholder">3.Other Educational Qualification / अन्य शैक्षणिक योग्यता
                                                        <span class="text-danger">*</span></label>
                                                        <input type="text" id="other" class="form-control" name="other_qualification" @if(isset($eklavya_data->other_qualification))  value="{{$eklavya_data->other_qualification}}" @endif>
                                                    </div>
                                                </div>
                                            <div class="row">
                                                <div class="col-md-4" id="highest_qual_div">
                                                    <div class="form-group">
                                                        <label>4. Upload Certificate of Highest Educational Qualification/उच्चतम शैक्षणिक योग्यता का प्रमाणपत्र अपलोड करें
                                                            <span class="text-danger">*</span><br><span class="note" style="font-size: 11px;">(File Format/फाइल का प्रारूप: JPEG/JPG/PDF | Max File Size/फाइल का अधिकतम साइज़: 2 MB)</span></label>
                                                        <div class="input-group">
                                                            <input type="file" onchange="getfileext(this.value,101)" id="File101" class="form-control" name="highest_qualification_certificate" {{ isset($eklavya_data->highest_qualification_certificate)  ? '' : 'required'  }}>
                                                            <input type="hidden" name="highest_qualification_certificate1" @if(isset($eklavya_data->highest_qualification_certificate))  value="{{$eklavya_data->highest_qualification_certificate}}" @endif />
                                                            @if(isset($eklavya_data->highest_qualification_certificate))
                                                                @php
                                                                $img = url('public/eklavya_krida_kosh/highest_qualification_certificate/').'/'.$eklavya_data->highest_qualification_certificate;
                                                                $img1 = url('public/images/view.jpg');
                                                                $doc = explode('.',$eklavya_data->highest_qualification_certificate);
                                                                @endphp
                                                            <img src="{{$img1}}" role="button" onclick="appendImage('{{$img}}','{{$doc[1] ?? ''}}')" class="img-fluid" />
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label>5. Domicile Certificate of UP/यूपी का निवास प्रमाण पत्र
                                                            <span class="text-danger">*</span><br><span class="note" style="font-size: 11px;">(File Format/फाइल का प्रारूप: JPEG/JPG/PDF | Max File Size/फाइल का अधिकतम साइज़: 2 MB)</span></label>
                                                        <div class="input-group">
                                                            <input type="file" onchange="getfileext(this.value,102)" id="File102" class="form-control" name="domicile_certificate" {{ isset($eklavya_data->domicile_certificate)  ? '' : 'required'  }}>
                                                            <input type="hidden" name="domicile_certificate1" @if(isset($eklavya_data->domicile_certificate))  value="{{$eklavya_data->domicile_certificate}}" @endif />
                                                            @if(isset($eklavya_data->domicile_certificate))
                                                                @php
                                                                $img = url('public/eklavya_krida_kosh/domicile_certificate/').'/'.$eklavya_data->domicile_certificate;
                                                                $img1 = url('public/images/view.jpg');
                                                                $doc = explode('.',$eklavya_data->domicile_certificate);
                                                                @endphp
                                                            <img src="{{$img1}}" role="button" onclick="appendImage('{{$img}}','{{$doc[1] ?? ''}}')" class="img-fluid" />
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label class="placeholder">6. Purpose/उद्देश्य<span class="text-danger">*</span></label>
                                                        <select class="form-select" name="purpose" required>
                                                            <option value="">Select</option>
                                                            <option @if(isset($eklavya_data->purpose) && $eklavya_data->purpose == "For Training") selected="selected" @endif value="For Training">For  Training </option>
                                                            <option @if(isset($eklavya_data->purpose) && $eklavya_data->purpose == "For Physical improvement and Diet money") selected="selected" @endif value="For Physical improvement and Diet money">For Physical improvement and Diet money</option>
                                                            <option @if(isset($eklavya_data->purpose) && $eklavya_data->purpose == "For Financial Aid/Fellowship") selected="selected" @endif value="For Financial Aid/Fellowship">For Financial Aid/Fellowship</option>
                                                            <option @if(isset($eklavya_data->purpose) && $eklavya_data->purpose == "For Equipment") selected="selected" @endif value="For Equipment">For Equipment</option>
                                                            <option @if(isset($eklavya_data->purpose) && $eklavya_data->purpose == "Financial Aid for Olympic Games Qualified Sportsperson") selected="selected" @endif value="Financial Aid for Olympic Games Qualified Sportsperson">Financial Aid for Olympic Games Qualified Sportsperson</option>
                                                            <option @if(isset($eklavya_data->purpose) && $eklavya_data->purpose == "Financial Aid for Olympic Games/Coaching Camp Selected Sportsperson") selected="selected" @endif value="Financial Aid for Olympic Games/Coaching Camp Selected Sportsperson">Financial Aid for Olympic Games/Coaching Camp Selected Sportsperson</option>
                                                            <option @if(isset($eklavya_data->purpose) && $eklavya_data->purpose == "Financial Aid for Sports Injuries Treatment (During Competition/Training)") selected="selected" @endif value="Financial Aid for Sports Injuries Treatment (During Competition/Training)">Financial Aid for Sports Injuries Treatment (During Competition/Training)</option>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                        <fieldset class="position-relative">
                                            <div class="col-md-12">
                                                <h5 class="subheading">B. Awards & Achievements/पुरस्कार और उपलब्धियां</h5>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="table-responsive">
                                                    <table class="table table-bordered" id="dynamic_field">
                                                        <thead>
                                                            <tr>
                                                                <td rowspan="2"><label>Type of Competition <br>प्रतियोगिता का प्रकार</label> <span class="text-danger">*</span>
                                                                </td>
                                                                <td rowspan="2"><label>Event Type<br>आयोजन का प्रकार</label> <span class="text-danger">*</span>
                                                                </td>
                                                                <td rowspan="2"><label>Event Name<br>आयोजन का नाम</label> <span class="text-danger">*</span>
                                                                </td>
                                                                <td rowspan="2"><label> Earned Medals<br>अर्जित पदक</label> <span class="text-danger">*</span>
                                                                </td>
                                                                <td colspan="2" class="text-center"><label>Period of Competition<br>प्रतियोगिता की अवधि</label> <span class="text-danger">*</span>
                                                                </td>
                                                                <td rowspan="2"><label>Venue Name</br>स्थल का नाम</label> <span class="text-danger">*</span< /td>
                                                                <td rowspan="2"><label>Upload Relevant Certificate<br>प्रासंगिक प्रमाण पत्र अपलोड करें<span class="text-danger">*</span><br><span class="note">(File Format/फाइल का प्रारूप: JPEG/JPG/PDF | Max File Size/फाइल का अधिकतम साइज़: 2 MB)</span>
                                                                    </label>
                                                                </td>
                                                                <td rowspan="2"><label>Sport Event Detail</br>खेलकूद प्रतियोगिता का विवरण<span class="text-danger">*</span></label> </td>
                                                                <td rowspan="2"></td>
                                                            </tr>
                                                            <tr>
                                                                <td><label>From </label>
                                                                </td>
                                                                <td><label>To </label>
                                                                </td>
                                                            </tr>
                                                        </thead>
                                                        @if($award_data == "")
                                                        <tbody>
                                                            <tr id="row1">
                                                                <td>
                                                                    <select name="competition_name[]" onchange="get_event(1,2)" required  class="form-select competition_name">
                                                                        <option value="">Select</option>
                                                                        @foreach ($competition as $type)
                                                                        <option value="{{$type->id}}" >{{$type->name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <select class="form-select event_type" onchange="get_event(1,2)" name="event_type[]" required>
                                                                        <option value="">Select</option>
                                                                        <option value="1">Individual</option>
                                                                        <option value="2">Team</option>
                                                                        <option value="3">Both</option>
            
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <select class="form-select event_name" name="event_name[]" required>
                                                                        <option value="">Select</option>
                                                                        @foreach ($event as $type)
                                                                        <option value="{{$type->id}}" >{{$type->name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </td>
                                                                <td style="width: 135px;">
                                                                    <select class="form-select" name="earned_medals[]" required>
                                                                        <option value="">Select</option>
                                                                        <option value="1st / Gold">1st / Gold</option>
                                                                        <option value="2nd / Silver">2nd / Silver</option>
                                                                        <option value="3rd / Bronze">3rd / Bronze</option>
                                                                        <option value="4th">4th</option>
                                                                        <option value="5th">5th</option>
                                                                        <option value="6th">6th</option>
                                                                        <option value="Participant">Participant</option>
                                                                    </select>
                                                                </td>
                                                                <td style="width: 120px;">
                                                                    <input type="text" class="form-control firstDate " onpaste="return false;" ondrop="return false;" onkeypress="return false" id="doc" autocomplete="off" required value="{{old('competition_from_date')}}" name="competition_from_date[]" data-language="en" placeholder="dd-mm-yyyy" required>
                                                                </td>
                                                                <td style="width: 120px;"><input type="text" class="form-control to-to-to" onpaste="return false;" ondrop="return false;" onkeypress="return false" id="to" autocomplete="off" required value="{{old('competition_to_date')}}" name="competition_to_date[]" data-language="en" placeholder="dd-mm-yyyy" required>
                                                                </td>
                                                                <td><input type="text" required value="{{old('sport_place') }}" name="sport_place[]" placeholder="Place" class="form-control name_email">
                                                                </td>
                                                                <td>
                                                                    <div class="input-group">
                                                                        <input type="file" required name="sport_achievement_docs[]" class="form-control" onchange="getfileext(this.value,3)" id="File3" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
                                                                    </div>
                                                                </td>
                                                                <td><input type="text" required value="{{old('event_detail') }}" name="event_details[]" placeholder="47th Junior Boys National Handball Championship, 2025" class="form-control"></td>
                                                                <td><button type="button" name="add" id="add" class="btn btn-primary mt-1">Add</button>
                                                                </td>
                                                            </tr>
                                                        </tbody>
                                                        @else
                                                        <tbody>
                                                        @foreach( $award_data as $key=>$post)
                                                            <tr id="row{{$key}}">
                                                                <td>
                                                                    <select name="competition_name[]" onchange="get_event({{$key}},2)" required  class="form-select competition_name">
                                                                        <option value="">Select</option>
                                                                        @foreach ($competition as $type)
                                                                        <option {{$post->competition_name==$type->id ?'Selected':''}} value="{{$type->id}}" >{{$type->name}}</option>
                                                                        @endforeach
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <select class="form-select event_type" onchange="get_event({{$key}},2)" name="event_type[]" required>
                                                                        <option value="">Select</option>
                                                                        <option {{$post->event_type=='1'?'Selected':''}} value="1">Individual</option>
                                                                        <option {{$post->event_type=='2'?'Selected':''}} value="2">Team</option>
                                                                        <option {{$post->event_type=='3'?'Selected':''}} value="3">Both</option>
            
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <input type="hidden" id="event_sel{{$key}}" data-id="" value="{{$post->event_name}}">
                                                                    <select class="form-select event_name" name="event_name[]" required>
                                                                        <option value="">Select</option>
                                                                    </select>
                                                                </td>
                                                                <td style="width: 100px;">
                                                                    <select class="form-select" name="earned_medals[]" required>
                                                                        <option value="">Select</option>
                                                                        <option {{$post->earned_medals=='1st / Gold'?'Selected':''}} value="1st / Gold">1st / Gold</option>
                                                                        <option {{$post->earned_medals=='2nd / Silver'?'Selected':''}} value="2nd / Silver">2nd / Silver</option>
                                                                        <option {{$post->earned_medals=='3rd / Bronze'?'Selected':''}} value="3rd / Bronze">3rd / Bronze</option>
                                                                        <option {{$post->earned_medals=='4th'?'Selected':''}} value="4th">4th</option>
                                                                        <option {{$post->earned_medals=='5th'?'Selected':''}} value="5th">5th</option>
                                                                        <option {{$post->earned_medals=='6th'?'Selected':''}} value="6th">6th</option>
                                                                        <option {{$post->earned_medals=='Participant'?'Selected':''}} value="Participant">Participant</option>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <input type="text" id="doc{{$key}}" class="form-control firstDate dateTime" onchange="checkDate({{$key}})" onpaste="return false;" ondrop="return false;" onkeypress="return false" autocomplete="off" required value="{{$post->competition_from_date}}" name="competition_from_date[]" data-language="en" placeholder="dd-mm-yyYY" required>
                                                                </td>
                                                                <td><input type="text" id="{{$key}}to" class="form-control to-to-to dateTime" onchange="checkDate({{$key}})" onpaste="return false;" ondrop="return false;" onkeypress="return false" autocomplete="off" required value="{{$post->competition_to_date}}" name="competition_to_date[]" data-language="en" placeholder="dd-mm-yyYY" required></td>

                                                                <td><input type="text" required value="{{$post->sport_place }}" name="sport_place[]" placeholder="Place" class="form-control name_email"></td>
                                                                <td>
                                                                    <div class="input-group">
                                                                        <input type="file" name="sport_achievement_docs[]" class="form-control" onchange="getfileext(this.value,3)" id="File3" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
                                                                        <input type="hidden" value="{{$post->sport_achievement_docs }}" name="sport_achievement_docs1[]">
                                                                        <!-- <a href="#" class="btn btn-secondary" id="A4">View</a> -->
                                                                        @if($post->sport_achievement_docs !='')
                                                                        @php
                                                                        $img = url('storage/eklavya_kreeda_kosh').'/'.$post->sport_achievement_docs;
                                                                        $img1 = url('public/images/view.jpg');
                                                                        $doc = explode('.',$post->sport_achievement_docs);

                                                                        @endphp
                                                                        <img src="{{$img1}}" role="button" onclick="appendImage('{{$img}}','{{$doc[1] ?? ''}}')" class="img-fluid" />
                                                                        @endif
                                                                    </div>
                                                                </td>
                                                                <td><input type="text" required value="{{$post->event_details }}" name="event_details[]" placeholder="47th Junior Boys National Handball Championship, 2025" class="form-control"></td>
                                                                @if(!isset($award_data) || ($key == 0))
                                                                <td><button type="button" name="add" id="add" class="btn btn-primary mt-1">Add</button></td>
                                                                @else
                                                                <td><button type="button" name="remove" id="{{$key}}" class="btn btn-danger mt-1 px-2 btn_remove"><span class="far fa-trash-alt"></span></button></td>
                                                                @endif
                                                            </tr>
                                                        
                                                        @endforeach
                                                        </tbody>
                                                        @endif
                                                    </table>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                    <div class="col-md-12">
                                        <fieldset>
                                            <div class="col-md-12">
                                                <h5 class="subheading">C. Account Information/खाता संबंधी जानकारी</h5>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-3">
                                                    <div class="form-group mb-3">
                                                        <label class="placeholder">1. IFSC Code/आईएफएससी कोड
                                                        <span class="text-danger">*</span></label>
                                                        <input type="text" class="form-control" required onblur="getBankDetails(this.value)" pattern="^[A-Za-z]{4}0[A-Z0-9a-z]{6}$" name="ifsc_code" value="{{ isset($eklavya_data->ifsc_code)  ? $eklavya_data->ifsc_code : old('ifsc_code')  }}" />
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group mb-3">
                                                        <label class="placeholder">2. Bank Name/बैंक का नाम
                                                        <span class="text-danger">*</span></label>
                                                        <input type="text" id="bankName" class="form-control" onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))' pattern="^[A-Za-z -]+$"  maxlength="255" value="{{ isset($eklavya_data->bank_name)  ? $eklavya_data->bank_name : old('bank_name')  }}"  required name="bank_name"/>
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <label class="placeholder">3. Branch/ शाखा<span class="text-danger">*</span></label>
                                                        <input type="text" name="bank_branch" onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))' pattern="^[A-Za-z -]+$" value="{{ isset($eklavya_data->bank_branch)  ? $eklavya_data->bank_branch : old('ifsc_bank_branchcode')  }}" required class="form-control" id="bank_branch">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group mb-3">
                                                        <label class="placeholder">4. Bank Account Number
                                                            /बैंक खाता संख्या
                                                        <span class="text-danger">*</span></label>
                                                        <input type="number" class="form-control" min="999999999" max="100000000000000000000" required name="account_no" value="{{ isset($eklavya_data->account_no)  ? $eklavya_data->account_no : old('account_no')  }}" />

                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                    <div class="form-group mb-3">
                                                        <label class="placeholder">5. Front page of Passbook
                                                            /पासबुक का फ्रंट पेज
                                                        <span class="text-danger">*</span><br><span class="note" style="font-size: 11px;">(File Format/फाइल का प्रारूप: JPEG/JPG/PDF | Max File Size/फाइल का अधिकतम साइज़: 2 MB)</span></label>
                                                        <div class="input-group">
                                                        <input onchange="getfileext(this.value,104)" id="File104" class="form-control" type="file" id="formFile" {{ isset($eklavya_data->front_page_of_passbook)  ? '': 'required'  }} name="front_page_of_passbook">
                                                        <input type="hidden" value="{{ isset($eklavya_data->front_page_of_passbook)  ? $eklavya_data->front_page_of_passbook : old('front_page_of_passbook')  }}" name="front_page_of_passbook1">
                                                            @if(isset($eklavya_data->front_page_of_passbook))
                                                            @php
                                                            $img = url('public/eklavya_krida_kosh/front_page_of_passbook').'/'.$eklavya_data->front_page_of_passbook;
                                                            $img1 = url('public/images/view.jpg');
                                                            $doc = explode('.',$eklavya_data->front_page_of_passbook);

                                                            @endphp
                                                            <img src="{{$img1}}" role="button" onclick="appendImage('{{$img}}','{{$doc[1] ?? ''}}')" class="img-fluid" />
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                              
                                                <div class="col-md-4">
                                                    <div class="form-group mb-3">
                                                        <label class="placeholder">6. Upload Notary Affidavit
                                                            / नोटरी शपथ पत्र अपलोड करें
                                                        <span class="text-danger">*</span>
                                                         <a download href="{{url('public/eklavya_krida_kosh/affidavit_format.pdf')}}"><span class="text-danger">Sample File</span></a><br><span class="note" style="font-size: 11px;">(File Format/फाइल का प्रारूप: JPEG/JPG/PDF | Max File Size/फाइल का अधिकतम साइज़: 2 MB)</span></label>
                                                        <div class="input-group">
                                                        <input onchange="getfileext(this.value,1044)" id="File1044" class="form-control" type="file" id="formFile" {{ isset($eklavya_data->notary_affidavit_doc)  ? '': 'required'  }} name="notary_affidavit_doc">
                                                        <input type="hidden" value="{{ isset($eklavya_data->notary_affidavit_doc)  ? $eklavya_data->notary_affidavit_doc : old('notary_affidavit_doc')  }}" name="notary_affidavit_doc1">
                                                            @if(isset($eklavya_data->notary_affidavit_doc))
                                                            @php
                                                            $img = url('public/eklavya_krida_kosh/notary_affidavit_doc').'/'.$eklavya_data->notary_affidavit_doc;
                                                            $img1 = url('public/images/view.jpg');
                                                            $doc = explode('.',$eklavya_data->notary_affidavit_doc);

                                                            @endphp
                                                            <img src="{{$img1}}" role="button" onclick="appendImage('{{$img}}','{{$doc[1] ?? ''}}')" class="img-fluid" />
                                                            @endif
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="bhoechie-footer">
                                                <div class="row justify-content-center">
                                    

                                                    <div class="col-md-2">
                                                        <button type="submit"
                                                            class="btn btn-outline-danger rounded-pill w-100">Save & Proceed</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                </form>
                            </div>


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
        $("#other_div").hide();
        $("#qualification").trigger('change');

		var i = 1;
		var length;


		var start = $("#dob").val();
		var end = (new Date()).getFullYear();
		var yrRange = start + ":" + end;
		var checkkk = 0;
		

		$("#doc").datepicker({
			changeMonth: true,
			changeYear: true,
			minDate: '-60Y',
			yearRange: yrRange,
			maxDate: '0',
			dateFormat: 'dd-mm-yy'
		});
		$("#doc").change(function() {
			var min = new Date($("#doc").val());
			var st = $("#doc").datepicker('getDate');
			var start = new Date(st);
			if (checkkk == 0) {
				$("#to").datepicker({
					changeMonth: true,
					changeYear: true,
					minDate: start,
					yearRange: yrRange,
					maxDate: '0',
					dateFormat: 'dd-mm-yy'
				});
			} else {
				$("#to").datepicker('option', {
					minDate: start
				});
			}
			checkkk = 1;
			// }, 5);
		})

        $("#qualification").change(function() {
            let val = $("#qualification").val();
            if(val == "other"){
                $("#other_div").show();
                $("#other").attr('required',true);

                $("#high_school_div").hide();
                $("#File103").removeAttr('required');

                $("#highest_qual_div").show();
                $("#File101").attr('required',true);
            } else if(val == "10" || val == "12") {
                $("#other_div").hide();
                $("#other").removeAttr('required');

                $("#high_school_div").show();
                $("#File103").attr('required',true);

                $("#highest_qual_div").hide();
                $("#File101").removeAttr('required');
            } else if(val == "graduation" || val == "post_graduation" || val == "diploma" || val == "researcher") {
                $("#other_div").hide();
                $("#other").removeAttr('required');

                $("#high_school_div").hide();
                $("#File103").removeAttr('required');

                $("#highest_qual_div").show();
                $("#File101").attr('required',true);
            } else {
                $("#other_div").hide();
                $("#high_school_div").hide();
                $("#highest_qual_div").hide();
            }
        });
	});
</script>
    <script>
        
	$(document).ready(function() {
		var i = 1;
		var length;
		//var addamount = 0;
		var addamount = 700;
		$("#add").click(function() {
			addamount += 700;
			console.log('amount: ' + addamount);
			i++;
			$('#dynamic_field').append('<tr id="row' + i + '"><td><select name="competition_name[]" onchange="get_event(' + i + ',2)" required class="form-select competition_name" class="form-control name_list"><option value="">Select</option>@foreach ($competition as $type) <option  value="{{$type->id}}">{{$type->name}}</option> @endforeach</td><td><select onchange="get_event(' + i + ',2)" class="form-select event_type" name="event_type[]" required=""><option value="">Select</option><option value="1">Individual</option><option value="2">Team</option><option value="3">Both</option></select></td><td><select class="form-select event_name" name="event_name[]" required=""> <option value="">Select</option>  </select></td><td><select class="form-select" name="earned_medals[]" required> <option value="">Select</option> <option   value="1st / Gold">1st / Gold</option> <option value="2nd / Silver">2nd / Silver</option> <option  value="3rd / Bronze">3rd / Bronze</option><option value="4th">4th</option><option value="5th">5th</option><option value="6th">6th</option><option value="Participant">Participant</option></select></td><td><input type="text" class="form-control firstDate dateTimeee" onchange="checkDate('+i+')" onpaste="return false;" ondrop="return false;" onkeypress="return false" id="doc' + i + '" autocomplete="off" required   name="competition_from_date[]" data-language="en" placeholder="dd-mm-yyyy" required></td><td><input type="text" class="form-control to-to-to dateTimeee"  onchange="checkDate('+i+')" onpaste="return false;" ondrop="return false;" onkeypress="return false" id="' + i + 'to" autocomplete="off" required  name="competition_to_date[]" data-language="en" placeholder="dd-mm-yyyy" required></td><td><input type="text" required  name="sport_place[]" placeholder="Place" class="form-control name_email"></td><td><div class="input-group"><input type="file" name="sport_achievement_docs[]" required class="form-control"   onchange="getfileext(this.value,2' + i + ')" id="File2' + i + '" aria-describedby="inputGroupFileAddon05" aria-label="Upload"></div></td><td><input type="text" required value="" name="event_details[]" placeholder="47th Junior Boys National Handball Championship, 2025" class="form-control"></td><td><button type="button" name="remove" id="' + i + '" class="btn btn-danger mt-1 px-2 btn_remove"><span class="far fa-trash-alt"></span></button></td></tr>');
            var start = $("#dob").val();
			var end = (new Date()).getFullYear();
			var yrRange = start + ":" + end;
			var checkkk = 0;
			$(".dateTimeee").datepicker({
				changeMonth: true,
				changeYear: true,
				minDate: '-60Y',
				minDate: new Date(start, 4 - 1, 1),
				yearRange: yrRange,
				maxDate: '0',
				dateFormat: 'dd-mm-yy'
			});
		});
		$(document).on('click', '.btn_remove', function() {
			addamount -= 700;
			console.log('amount: ' + addamount);
			var button_id = $(this).attr("id");
			$('#row' + button_id + '').remove();
		});
	});
</script>
    @endpush
