@extends( 'layouts\private_coaching_auth_layout' )
@section('content')

<div class="container-fluid pagecontentbody">
    <div class="pagebody removebg-color">
        <div class="row">
            <div class="col-12">
                <div class="pageheader" id="menu-margin">
                    <h4 class="mb-0">
                        Registration/पंजीकरण <a href="{{ route('private_coaching_dashboard') }}"
                                                class="btn btn-outline-success btn-sm backbtn float-end ">
                            <span class="icons icon-arrow-left"></span>Back to Dashboard
                        </a>
                    </h4>
                </div>
            </div>
            <div class="col-12">
                <div class="bhoechie-tab-container">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bhoechie-tab">
                            <div class="bhoechie-tab-content active">
                                <div class="form-scroll">



                                    <form action="@if(isset($application)){{route('private_coaching_application_form_store',$application->id)}}@else {{route('private_coaching_application_form_store')}} @endif" method="post" class="needs-validation" id="submitform" novalidate enctype="multipart/form-data">
                                        @csrf
                                        {{-- <div class="nano-content">
                                            <fieldset>
                                                <legend>Registration Details/पंजीकरण के विवरण</legend>
                                                <div class="row">
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label class="placeholder">
                                                                1. Name of Association/एसोसिएशनों का नाम<span class="text-danger">*</span>
                                                            </label>
                                                            <input type="text" class="form-control"  disabled value="{{ Auth::guard('PrivateCoaching')->user()->name }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label class="placeholder">
                                                                2. Email ID/ईमेल आईडी <span class="text-danger">*</span>
                                                            </label>
                                                            <input type="text" class="form-control" disabled value="{{ Auth::guard('PrivateCoaching')->user()->email }}">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <div class="form-group mb-3">
                                                            <label class="placeholder">
                                                                3. Mobile No./मोबाइल नंबर <span class="text-danger">*</span>
                                                            </label>
                                                            <input type="text" class="form-control" value="{{ Auth::guard('PrivateCoaching')->user()->mobile }}" disabled>
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <fieldset>
                                                <legend>Address Details/पते का विवरण</legend>
                                                <div class="row">
                                                    <div class="col-md-3">
                                                        <div class="form-group mb-3">
                                                            <label class="placeholder">4. Address/पता</label>
                                                            <input type="text" class="form-control" name="address" required value="@if(isset($application->address)){{ $application->address }}@endif">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mb-3">
                                                            <label>5. State/राज्य</label>
                                                            <select class="form-select form-control" required name="state" onchange="get_city(this.value)" >
                                                                <option value=""> Select State</option>
                                                                @foreach ($state as $item)
                                                                <option value="{{ $item->id }}" @if(isset($application->state) && $application->state == $item->id)selected @endif>{{ $item->name }}</option>
                                                                @endforeach
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mb-3">
                                                            <input type="hidden" value="@if(isset($application->city)) {{ $application->city }} @endif" id="district3">
                                                            <label class="placeholder">6. City/शहर </label>
                                                            <select class="form-control" required id="city_id" name="city">
                                                                <option value="">Select city</option>
                                                            </select>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-3">
                                                        <div class="form-group mb-3">
                                                            <label class="placeholder">7. Pincode/पिन कोड</label>
                                                            <input type="number" min="100000" max="999999" class="form-control" name="pincode" required value="@if(isset($application->pincode)){{ $application->pincode }}@endif">
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <fieldset>
                                                <legend>Sports/खेल</legend>
                                                <div class="row" id="hockey">
                                                    <div class="form-group w-25 mb-3">
                                                        <label>8. Sports Name/खेल का नाम</label>
                                                        <select name="sport" required class="form-select form-control" onchange="showHide(this)">
                                                            <option value="">Select Sport</option>

                                                            @foreach ($sport as  $item)
                                                            <option value="{{ $item->id }}"@if(isset($application->sport) && $application->sport == $item->id)selected @endif>{{ $item->name }}</option>

                                                            @endforeach


                                                        </select>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <fieldset>
                                                <legend>Upload Document/दस्तावेज़ अपलोड करें</legend>
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>9.) Copy of the form regarding recognition of Sports Federation of India/Federation of the concerned sport by the Ministry of Sports, Government of India.<br />सम्बन्धित खेल के भारतीय खेल फेडरेशन/महासंघ का खेल मंत्रालय भारत सरकार द्वारा मान्यता प्रदान किये जाने सम्बन्धी प्रपत्र की प्रति  </label>
                                                            <div class="input-group">
                                                                <input type="file" class="form-control"  onchange="getfileext11(this,136)" id="File136"aria-describedby="inputGroupFileAddon05" aria-label="Upload" name="sport_federation"  @if(!isset($application)) required @endif>

                                                                @if(isset($application->sport_federation))
                                                                <a href="{{ asset('public/private_coaching_storage/sport_federation/') }}/{{ $application->sport_federation }}" download  class="btn btn-secondary" id="inputGroupFileAddon05">View</a>
                                                                @endif

                                                            </div>
                                                            <span class="note">(File Format: pdf, jpeg, jpg | Max File Size: 5 MB)</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>10.) Copy of the form for granting recognition/affiliation to the State Sports Association of the respective sport by the Indian Federation/Federation and Uttar Pradesh Olympic Association.<br />सम्बन्धित खेल के प्रदेशीय क्रीड़ा संघ को भारतीय फेडरेशन/महासंघ एवं उत्तर प्रदेश ओलम्पिक संघ द्वारा मान्यता/सम्बद्धता प्रदान किये जाने सम्बन्धी प्रपत्र की प्रति  </label>
                                                            <div class="input-group">
                                                                <input type="file" class="form-control" onchange="getfileext11(this,135)" id="File135"aria-describedby="inputGroupFileAddon05" aria-label="Upload" name="granting_recognition"  @if(!isset($application)) required @endif>
                                                                @if(isset($application->granting_recognition))
                                                                <a href="{{ asset('public/private_coaching_storage/granting_recognition/') }}/{{ $application->granting_recognition }}" download  class="btn btn-secondary" id="inputGroupFileAddon05">View</a>
                                                                @endif
                                                            </div>
                                                            <span class="note">(File Format: pdf, jpeg, jpg | Max File Size: 5 MB)</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>11.) Certified copy of recognition from the Indian Olympic Association.<br />भारतीय ओलम्पिक संघ से मान्यता सम्बन्धित प्रमाणित प्रति।</label>
                                                            <div class="input-group">
                                                                <input type="file" class="form-control" onchange="getfileext11(this,134)" id="File134"aria-describedby="inputGroupFileAddon05" aria-label="Upload" name="certified_copy_of_recognition"  @if(!isset($application)) required @endif>
                                                                @if(isset($application->certified_copy_of_recognition))
                                                                <a href="{{ asset('public/private_coaching_storage/certified_copy_of_recognition/') }}/{{ $application->certified_copy_of_recognition }}" download  class="btn btn-secondary" id="inputGroupFileAddon05">View</a>
                                                                @endif
                                                            </div>
                                                            <span class="note">(File Format: pdf, jpeg, jpg | Max File Size: 5 MB)</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group mb-0">
                                                            <label>12.) Copy of the Registration Certificate of the concerned State Sports Association under the Society Registration Act.<br />सम्बन्धित प्रदेशीय क्रीड़ा संघ का सोसाइटी रजिस्ट्रेशन एक्ट के अन्तर्गत पंजीयन प्रमाण-पत्र की प्रति। </label>
                                                            <div class="row">
                                                                <div class="col-md-4 mb-3">
                                                                    <input type="date" class="form-control " data-language="en" placeholder="Date of Registration " name="date_of_registration" required value="@if(isset($application->date_of_registration)){{ $application->date_of_registration }}@endif" />
                                                                </div>
                                                                <div class="col-md-8 mb-3">
                                                                    <div class="input-group">
                                                                        <input type="file" class="form-control"  onchange="getfileext11(this,133)" id="File133"aria-describedby="inputGroupFileAddon05" aria-label="Upload" name="registration_certificate" @if(!isset($application)) required @endif>
                                                                        @if(isset($application->registration_certificate))
                                                                        <a href="{{ asset('public/private_coaching_storage/registration_certificate/') }}/{{ $application->registration_certificate }}" download  class="btn btn-secondary" id="inputGroupFileAddon05">View</a>
                                                                        @endif
                                                                    </div>
                                                                    <span class="note">(File Format: pdf, jpeg, jpg | Max File Size: 5 MB)</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>13.) Certified copy of the Constitution/Memorandum of the State Sports Association.<br />प्रदेशीय क्रीडा संघ के संविधान/ज्ञापन की प्रमाणित प्रति। </label>
                                                            <div class="input-group">
                                                                <input type="file" class="form-control"  onchange="getfileext11(this,132)" id="File132"aria-describedby="inputGroupFileAddon05" aria-label="Upload" name="certified_copy_of_the_constitution"  @if(!isset($application)) required @endif>
                                                                @if(isset($application->certified_copy_of_the_constitution))
                                                                        <a href="{{ asset('public/private_coaching_storage/certified_copy_of_the_constitution/') }}/{{ $application->certified_copy_of_the_constitution }}" download  class="btn btn-secondary" id="inputGroupFileAddon05">View</a>
                                                                        @endif
                                                            </div>
                                                            <span class="note">(File Format: pdf, jpeg, jpg | Max File Size: 5 MB)</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>14.) Copy of the selection form of the officials of the State Sports Association and the list of the officials along with their mobile numbers and permanent addresses.<br />प्रदेशीय क्रीडा संघ के पदाधिकारियों के चयन सम्बन्धी प्रपत्र की प्रति एवं पदाधिकारियों के मोबाइल नम्बर एवं स्थायी पता सहित सूची। </label>
                                                            <div class="input-group">
                                                                <input type="file" class="form-control"  onchange="getfileext11(this,131)" id="File131"aria-describedby="inputGroupFileAddon05" aria-label="Upload" name="copy_of_the_selection"  @if(!isset($application)) required @endif>
                                                                @if(isset($application->copy_of_the_selection))
                                                                <a href="{{ asset('public/private_coaching_storage/copy_of_the_selection/') }}/{{ $application->copy_of_the_selection }}" download  class="btn btn-secondary" id="inputGroupFileAddon05">View</a>
                                                                @endif
                                                            </div>
                                                            <span class="note">(File Format: pdf, jpeg, jpg | Max File Size: 5 MB)</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group mb-0">
                                                            <label>15.) Copy of the audited income and expenditure statement of the last three years of the concerned State Sports Association.<br />सम्बन्धित प्रदेशीय क्रीडा संघ के विगत तीन वर्षों का सम्परीक्षित आय-व्यय विवरण की प्रति। </label>
                                                            <div class="row">
                                                                <div class="col-md-4 mb-3">
                                                                    <div class="input-group">
                                                                        <input type="file" class="form-control" onchange="getfileext11(this,130)" id="File130" aria-describedby="inputGroupFileAddon05" aria-label="Upload" name="audited_income_first"  @if(!isset($application)) required @endif>
                                                                        @if(isset($application->audited_income_first))
                                                                        <a href="{{ asset('public/private_coaching_storage/audited_income_first/') }}/{{ $application->audited_income_first }}" download  class="btn btn-secondary" id="inputGroupFileAddon05">View</a>
                                                                        @endif
                                                                    </div>
                                                                    <span class="note">(File Format: pdf, jpeg, jpg | Max File Size: 5 MB)</span>
                                                                </div>
                                                                <div class="col-md-4 mb-3">
                                                                    <div class="input-group">
                                                                        <input type="file" class="form-control"  onchange="getfileext11(this,129)" id="File129"aria-describedby="inputGroupFileAddon05" aria-label="Upload" name="audited_income_second"  @if(!isset($application)) required @endif>
                                                                        @if(isset($application->audited_income_second))
                                                                        <a href="{{ asset('public/private_coaching_storage/audited_income_second/') }}/{{ $application->audited_income_second }}" download  class="btn btn-secondary" id="inputGroupFileAddon05">View</a>
                                                                        @endif
                                                                    </div>
                                                                    <span class="note">(File Format: pdf, jpeg, jpg | Max File Size: 5 MB)</span>
                                                                </div>
                                                                <div class="col-md-4 mb-3">
                                                                    <div class="input-group">
                                                                        <input type="file" class="form-control"  onchange="getfileext11(this,128)" id="File128"aria-describedby="inputGroupFileAddon05" aria-label="Upload" name="audited_income_third"  @if(!isset($application)) required @endif>
                                                                        @if(isset($application->audited_income_third))
                                                                        <a href="{{ asset('public/private_coaching_storage/audited_income_third/') }}/{{ $application->audited_income_third }}" download  class="btn btn-secondary" id="inputGroupFileAddon05">View</a>
                                                                        @endif
                                                                    </div>
                                                                    <span class="note">(File Format: pdf, jpeg, jpg | Max File Size: 5 MB)</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group">
                                                            <label>16.) Copy of the list including mobile/landline numbers and permanent addresses of 75 percent of the district units and their related officials related to the State Sports Association.<br />प्रदेशीय खेल संघ से सम्बन्धित 75 प्रतिशत जिला इकाईयों एवं उनसे सम्बन्धित पदाधिकारियों के मोबाइल / लैण्डलाइन नम्बर एवं स्थायी पता सहित सूची की प्रति।</label>
                                                            <div class="input-group">
                                                                <input type="file" class="form-control" onchange="getfileext11(this,127)" id="File127"aria-describedby="inputGroupFileAddon05" aria-label="Upload" name="copy_of_the_list_including_mobile"  @if(!isset($application)) required @endif>
                                                                @if(isset($application->copy_of_the_list_including_mobile))
                                                                <a href="{{ asset('public/private_coaching_storage/copy_of_the_list_including_mobile/') }}/{{ $application->copy_of_the_list_including_mobile }}" download  class="btn btn-secondary" id="inputGroupFileAddon05">View</a>
                                                                @endif
                                                            </div>
                                                            <span class="note">(File Format: pdf, jpeg, jpg | Max File Size: 5 MB)</span>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group mb-0">
                                                            <label>17.) Report of the activities of the concerned state sports for the last three years.<br />सम्बंधित प्रदेशीय खेल के विगत तीन वर्ष के कार्यकलापों की रिपोर्ट।  </label>
                                                            <div class="row">
                                                                <div class="col-md-4 mb-3">
                                                                    <div class="input-group">
                                                                        <input type="file" class="form-control"  onchange="getfileext11(this,126)" id="File126"aria-describedby="inputGroupFileAddon05" aria-label="Upload" name="report_activity_first"  @if(!isset($application)) required @endif>
                                                                        @if(isset($application->report_activity_first))
                                                                        <a href="{{ asset('public/private_coaching_storage/report_activity_first/') }}/{{ $application->report_activity_first }}" download  class="btn btn-secondary" id="inputGroupFileAddon05">View</a>
                                                                        @endif
                                                                    </div>
                                                                    <span class="note">(File Format: pdf, jpeg, jpg | Max File Size: 5 MB)</span>
                                                                </div>
                                                                <div class="col-md-4 mb-3">
                                                                    <div class="input-group">
                                                                        <input type="file" class="form-control" onchange="getfileext11(this,125)" id="File125"aria-describedby="inputGroupFileAddon05" aria-label="Upload" name="report_activity_second"  @if(!isset($application)) required @endif>
                                                                        @if(isset($application->report_activity_second))
                                                                        <a href="{{ asset('public/private_coaching_storage/report_activity_second/') }}/{{ $application->report_activity_second }}" download  class="btn btn-secondary" id="inputGroupFileAddon05">View</a>
                                                                        @endif
                                                                    </div>
                                                                    <span class="note">(File Format: pdf, jpeg, jpg | Max File Size: 5 MB)</span>
                                                                </div>
                                                                <div class="col-md-4 mb-3">
                                                                    <div class="input-group">
                                                                        <input type="file" class="form-control"  onchange="getfileext11(this,124)" id="File124"aria-describedby="inputGroupFileAddon05" aria-label="Upload" name="report_activity_third"  @if(!isset($application)) required @endif>
                                                                        @if(isset($application->report_activity_third))
                                                                        <a href="{{ asset('public/private_coaching_storage/report_activity_third/') }}/{{ $application->report_activity_third }}" download  class="btn btn-secondary" id="inputGroupFileAddon05">View</a>
                                                                        @endif
                                                                    </div>
                                                                    <span class="note">(File Format: pdf, jpeg, jpg | Max File Size: 5 MB)</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <div class="form-group mb-0">
                                                            <label>18.) Form of State Sports Association regarding organizing state level competitions of sub-junior/junior/senior category for the last three years.<br />प्रदेशीय खेल संघ का विगत तीन वर्षों तक सबजूनियर/जूनियर/सीनियर वर्ग की राज्यस्तरीय ✓ प्रतियोगिताओं के आयोजन सम्बंधी प्रपत्र। </label>
                                                            <div class="row">
                                                                <div class="col-md-4 mb-3">
                                                                    <div class="input-group">
                                                                        <input type="file" class="form-control"  onchange="getfileext11(this,123)" id="File123"aria-describedby="inputGroupFileAddon05" aria-label="Upload" name="state_sports_association_first"  @if(!isset($application)) required @endif>
                                                                        @if(isset($application->state_sports_association_first))
                                                                        <a href="{{ asset('public/private_coaching_storage/state_sports_association_first/') }}/{{ $application->state_sports_association_first }}" download  class="btn btn-secondary" id="inputGroupFileAddon05">View</a>
                                                                        @endif
                                                                    </div>
                                                                    <span class="note">(File Format: pdf, jpeg, jpg | Max File Size: 5 MB)</span>
                                                                </div>
                                                                <div class="col-md-4 mb-3">
                                                                    <div class="input-group">
                                                                        <input type="file" class="form-control"  onchange="getfileext11(this,122)" id="File122"aria-describedby="inputGroupFileAddon05" aria-label="Upload" name="state_sports_association_second"  @if(!isset($application)) required @endif  >
                                                                        @if(isset($application->state_sports_association_second))
                                                                        <a href="{{ asset('public/private_coaching_storage/state_sports_association_second/') }}/{{ $application->state_sports_association_second }}" download  class="btn btn-secondary" id="inputGroupFileAddon05">View</a>
                                                                        @endif
                                                                    </div>
                                                                    <span class="note">(File Format: pdf, jpeg, jpg | Max File Size: 5 MB)</span>
                                                                </div>
                                                                <div class="col-md-4 mb-3">
                                                                    <div class="input-group">
                                                                        <input type="file" class="form-control" id="inputGroupFile05" aria-describedby="inputGroupFileAddon05" aria-label="Upload" name="state_sports_association_third"  @if(!isset($application)) required @endif>
                                                                        @if(isset($application->state_sports_association_third))
                                                                        <a href="{{ asset('public/private_coaching_storage/state_sports_association_third/') }}/{{ $application->state_sports_association_third }}" download  class="btn btn-secondary" id="inputGroupFileAddon05">View</a>
                                                                        @endif
                                                                    </div>
                                                                    <span class="note">(File Format: pdf, jpeg, jpg | Max File Size: 5 MB)</span>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </fieldset>
                                            <div class="bhoechie-footer">
                                                <div class="row justify-content-center">


                                                    <div class="col-md-4 d-grid">
                                                        <button type="submit" class="btn btn-outline-success ">Save and Next</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div> --}}




                                        <div class="row">
                                            <div class="col-md-12">
                                                <h5 class="subheading">A. Registration Details/पंजीकरण के विवरण</h5>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <strong>1.) Full Name/पूरा नाम</strong><br />{{Auth::guard('PrivateCoaching')->user()->name }}
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <strong>2.) Designation/पदनाम</strong><br />{{Auth::guard('PrivateCoaching')->user()->designation  }}
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <strong>3.) Email ID/ईमेल आईडी</strong><br />{{Auth::guard('PrivateCoaching')->user()->email  }}
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <strong>4.) Mobile No./मोबाइल नंबर</strong><br />{{Auth::guard('PrivateCoaching')->user()->mobile  }}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h5 class="subheading">B. Address Details/पते का विवरण</h5>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <strong>1.) Office Address/कार्यालय का पता</strong><br />{{$profile->office_address}}
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <strong>2.) State/राज्य</strong><br />Uttar Pradesh
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <strong>3.) City/शहर</strong><br />{{districtName($profile->district)}}
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <strong>4.) Pincode/पिन कोड</strong><br />{{$profile->pin}}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h5 class="subheading">C. Sports/खेल</h5>
                                            </div>
                                         

                                                  <div class="col-md-4">
                                                            <div class="form-group mb-3">
                                                                <label>5.) Sports Name<br />खेल का नाम</label>
                                                                <select id="sportname" class="form-select form-control" name="sport" required>
                                                                    <option value="">Select</option>
                                                                    @foreach ($sport as $item)
                                                                    <option value="{{$item->id}}"{{isset($application->sport) && $application->sport == $item->id ? 'selected': ''}}>{{$item->name}}</option>
                                                                    @endforeach


                                                                </select>
                                                            </div>
                                                        </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h5 class="subheading">D. Institution /संस्थान</h5>
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <strong>1.) Type of Institution/संस्था का प्रकार</strong><br />{{$profile->type_institute}}
                                            </div>
                                            <div class="col-md-3 mb-3">
                                                <strong>2.) Institution Name/संस्था का नाम</strong><br />{{$profile->institute_name}}
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-md-12">
                                                <h5 class="subheading">E. Association Members/संघ के सदस्य</h5>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="table-responsive">
                                                    <table class="table table-sm table-bordered" id="dynamic_field">


                                                        <tbody>
                                                            <tr>

                                                                <td>
                                                                    <label>Name of Member/सदस्य का नाम</label>
                                                                </td>
                                                                <td>
                                                                    <label>Mobile No./मोबाइल नंबर</label>
                                                                </td>
                                                                <td>
                                                                    <label>Email ID/ईमेल आईडी</label>
                                                                </td>
                                                                <td>
                                                                    <label>Designation/पदनाम</label>
                                                                </td>
                                                                <td class="text-center" style="width:10%">
                                                                    <label>Action/कार्रवाई</label>
                                                                </td>
                                                            </tr>




                                                            @if(isset($associate_member) && count($associate_member)==0)

                                                            <tr>

                                                                <td>
                                                                    <input type="text" name="name_of_member[]"  class="form-control" onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))' pattern="^[A-Za-z -]+$" maxlength="255" required/>
                                                                </td>
                                                                <td>
                                                                    <input type="number" max="9999999999" min="6666666666" name="mobile[]" required  class="form-control" />
                                                                </td>
                                                                <td>
                                                                    <input type="email" name="email[]" required class="form-control" />
                                                                </td>
                                                                <td>
                                                                    <input type="text" name="designation[]" required  class="form-control" onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))' pattern="^[A-Za-z -]+$" maxlength="255" />
                                                                </td>
                                                                <td class="text-center">
                                                                    <button type="button" name="add" id="add" title="Add" class="btn btn-danger btn-xs local"><i class="fa fa-plus"></i></button>
                                                                </td>
                                                            </tr>

                                                            @else
                                                            @foreach( $associate_member as  $key=>$post)

                                                            <tr id="row{{$key}}">

                                                                <td>
                                                                    <input type="text" name="name_of_member[]" required class="form-control" @if(isset($post->name)) value="{{$post->name}}" @endif onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))' pattern="^[A-Za-z -]+$" maxlength="255" required/>
                                                                </td>
                                                                <td>
                                                                    <input name="mobile[]" type="number" max="9999999999" min="6666666666" required  class="form-control" @if(isset($post->mobile)) value="{{$post->mobile}}" @endif />
                                                                </td>
                                                                <td>
                                                                    <input type="email" name="email[]" required class="form-control" @if(isset($post->email)) value="{{$post->email}}" @endif/>
                                                                </td>
                                                                <td>
                                                                    <input type="text" name="designation[]" required  class="form-control" @if(isset($post->designation)) value="{{$post->designation}}"  @endif onkeypress='return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))' pattern="^[A-Za-z -]+$" maxlength="255" required/>
                                                                </td>


                                                                @if(!isset($associate_member) || ($key == 0))
                                                                <td class="text-center">
                                                                    <button type="button" name="add" id="add" title="Add" class="btn btn-danger btn-xs local"><i class="fa fa-plus"></i></button>
                                                                </td>
                                                                @else
                                                                <td class="text-center">
                                                                    <button type="button" name="remove" id="{{$key}}" class="btn btn-danger btn_remove"><i class="fa fa-trash"></i></button>
                                                                </td>
                                                                @endif
                                                            </tr>
                                                               @endforeach
                                                            @endif
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-12">
                                                <h5 class="subheading">F. Upload Document/दस्तावेज़ अपलोड करें</h5>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>1.) Copy of the form regarding recognition of Sports Federation of India/Federation of the concerned sport by the Ministry of Sports, Government of India.<br />सम्बन्धित खेल के भारतीय खेल फेडरेशन/महासंघ का खेल मंत्रालय भारत सरकार द्वारा मान्यता प्रदान किये जाने सम्बन्धी प्रपत्र की प्रति  </label>
                                                    <div class="input-group">
                                                        <input type="file" class="form-control"  onchange="getfileext11(this,136)" id="File136"aria-describedby="inputGroupFileAddon05" aria-label="Upload" name="sport_federation"  @if(!isset($application)) required @endif>

                                                        @if(isset($application->sport_federation))
                                                        <a href="{{ asset('public/private_coaching_storage/sport_federation/') }}/{{ $application->sport_federation }}" download  class="btn btn-secondary" id="inputGroupFileAddon05">View</a>
                                                        @endif
                                                    </div>
                                                    <span class="note">(File Format: pdf, jpeg, jpg | Max File Size: 5 MB)</span>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>2.) Copy of the form for granting recognition/affiliation to the State Sports Association of the respective sport by the Indian Federation/Federation and Uttar Pradesh Olympic Association.<br />सम्बन्धित खेल के प्रदेशीय क्रीड़ा संघ को भारतीय फेडरेशन/महासंघ एवं उत्तर प्रदेश ओलम्पिक संघ द्वारा मान्यता/सम्बद्धता प्रदान किये जाने सम्बन्धी प्रपत्र की प्रति  </label>
                                                    <div class="input-group">
                                                        <input type="file" class="form-control" onchange="getfileext11(this,135)" id="File135"aria-describedby="inputGroupFileAddon05" aria-label="Upload" name="granting_recognition"  @if(!isset($application)) required @endif>
                                                        @if(isset($application->granting_recognition))
                                                        <a href="{{ asset('public/private_coaching_storage/granting_recognition/') }}/{{ $application->granting_recognition }}" download  class="btn btn-secondary" id="inputGroupFileAddon05">View</a>
                                                        @endif
                                                    </div>
                                                    <span class="note">(File Format: pdf, jpeg, jpg | Max File Size: 5 MB)</span>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>3.) Certified copy of recognition from the Indian Sports Association/Federation of the concerned sport.<br />सम्बंधित खेल के भारतीय खेल संघ/ फेडरेशन द्वारा  प्रमाणित प्रति।</label>
                                                    <div class="input-group">
                                                        <input type="file" class="form-control" onchange="getfileext11(this,134)" id="File134"aria-describedby="inputGroupFileAddon05" aria-label="Upload" name="certified_copy_of_recognition"  @if(!isset($application)) required @endif>
                                                        @if(isset($application->certified_copy_of_recognition))
                                                        <a href="{{ asset('public/private_coaching_storage/certified_copy_of_recognition/') }}/{{ $application->certified_copy_of_recognition }}" download  class="btn btn-secondary" id="inputGroupFileAddon05">View</a>
                                                        @endif  </div>
                                                    <span class="note">(File Format: pdf, jpeg, jpg | Max File Size: 5 MB)</span>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group mb-0">
                                                    <label>4.) Copy of the Registration Certificate of the concerned State Sports Association under the Society Registration Act.<br />सम्बन्धित प्रदेशीय क्रीड़ा संघ का सोसाइटी रजिस्ट्रेशन एक्ट के अन्तर्गत पंजीयन प्रमाण-पत्र की प्रति। </label>
                                                    <div class="row">
                                                        <div class="col-md-4 mb-3">
                                                            <input type="date" class="form-control " data-language="en" placeholder="Date of Registration " name="date_of_registration" required value="@if(isset($application->date_of_registration)){{ $application->date_of_registration }}@endif" />
                                                        </div>
                                                        <div class="col-md-8 mb-3">
                                                            <div class="input-group">
                                                                <input type="file" class="form-control"  onchange="getfileext11(this,133)" id="File133"aria-describedby="inputGroupFileAddon05" aria-label="Upload" name="registration_certificate" @if(!isset($application)) required @endif>
                                                                        @if(isset($application->registration_certificate))
                                                                        <a href="{{ asset('public/private_coaching_storage/registration_certificate/') }}/{{ $application->registration_certificate }}" download  class="btn btn-secondary" id="inputGroupFileAddon05">View</a>
                                                                        @endif
                                                                       </div>
                                                            <span class="note">(File Format: pdf, jpeg, jpg | Max File Size: 5 MB)</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>5.) Certified copy of the Constitution/Memorandum of the State Sports Association.<br />प्रदेशीय क्रीडा संघ के संविधान/ज्ञापन की प्रमाणित प्रति। </label>
                                                    <div class="input-group">
                                                        <input type="file" class="form-control"  onchange="getfileext11(this,132)" id="File132"aria-describedby="inputGroupFileAddon05" aria-label="Upload" name="certified_copy_of_the_constitution"  @if(!isset($application)) required @endif>
                                                        @if(isset($application->certified_copy_of_the_constitution))
                                                                <a href="{{ asset('public/private_coaching_storage/certified_copy_of_the_constitution/') }}/{{ $application->certified_copy_of_the_constitution }}" download  class="btn btn-secondary" id="inputGroupFileAddon05">View</a>
                                                                @endif
                                                             </div>
                                                    <span class="note">(File Format: pdf, jpeg, jpg | Max File Size: 5 MB)</span>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>6.) Copy of the selection form of the officials of the State Sports Association and the list of the officials along with their mobile numbers and permanent addresses.<br />प्रदेशीय क्रीडा संघ के पदाधिकारियों के चयन सम्बन्धी प्रपत्र की प्रति एवं पदाधिकारियों के मोबाइल नम्बर एवं स्थायी पता सहित सूची। </label>
                                                    <div class="input-group">
                                                        <input type="file" class="form-control"  onchange="getfileext11(this,131)" id="File131"aria-describedby="inputGroupFileAddon05" aria-label="Upload" name="copy_of_the_selection"  @if(!isset($application)) required @endif>
                                                        @if(isset($application->copy_of_the_selection))
                                                        <a href="{{ asset('public/private_coaching_storage/copy_of_the_selection/') }}/{{ $application->copy_of_the_selection }}" download  class="btn btn-secondary" id="inputGroupFileAddon05">View</a>
                                                        @endif </div>
                                                    <span class="note">(File Format: pdf, jpeg, jpg | Max File Size: 5 MB)</span>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group mb-0">
                                                    <label>7.) Copy of the CA- Audit Report of income and expenditure statement of the last three years of the concerned State Sports Association.<br />सम्बन्धित प्रदेशीय क्रीडा संघ के विगत तीन वर्षों का सम्परीक्षित आय-व्यय विवरण की प्रति। </label>
                                                    <div class="row">
                                                        <div class="col-md-4 mb-3">
                                                            <div class="input-group">
                                                                <input type="file" class="form-control" onchange="getfileext11(this,130)" id="File130" aria-describedby="inputGroupFileAddon05" aria-label="Upload" name="audited_income_first"  @if(!isset($application)) required @endif>
                                                                @if(isset($application->audited_income_first))
                                                                <a href="{{ asset('public/private_coaching_storage/audited_income_first/') }}/{{ $application->audited_income_first }}" download  class="btn btn-secondary" id="inputGroupFileAddon05">View</a>
                                                                @endif  </div>
                                                            <span class="note">(File Format: pdf, jpeg, jpg | Max File Size: 5 MB)</span>
                                                        </div>
                                                        <div class="col-md-4 mb-3">
                                                            <div class="input-group">
                                                                <input type="file" class="form-control"  onchange="getfileext11(this,129)" id="File129"aria-describedby="inputGroupFileAddon05" aria-label="Upload" name="audited_income_second"  @if(!isset($application)) required @endif>
                                                                @if(isset($application->audited_income_second))
                                                                <a href="{{ asset('public/private_coaching_storage/audited_income_second/') }}/{{ $application->audited_income_second }}" download  class="btn btn-secondary" id="inputGroupFileAddon05">View</a>
                                                                @endif
                                                             </div>
                                                            <span class="note">(File Format: pdf, jpeg, jpg | Max File Size: 5 MB)</span>
                                                        </div>
                                                        <div class="col-md-4 mb-3">
                                                            <div class="input-group">
                                                                <input type="file" class="form-control"  onchange="getfileext11(this,128)" id="File128"aria-describedby="inputGroupFileAddon05" aria-label="Upload" name="audited_income_third"  @if(!isset($application)) required @endif>
                                                                @if(isset($application->audited_income_third))
                                                                <a href="{{ asset('public/private_coaching_storage/audited_income_third/') }}/{{ $application->audited_income_third }}" download  class="btn btn-secondary" id="inputGroupFileAddon05">View</a>
                                                                @endif
                                                   </div>
                                                            <span class="note">(File Format: pdf, jpeg, jpg | Max File Size: 5 MB)</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>8.) Copy of the list including mobile/landline numbers and permanent addresses of 75 percent of the district units and their related officials related to the State Sports Association.<br />प्रदेशीय खेल संघ से सम्बन्धित 75 प्रतिशत जिला इकाईयों एवं उनसे सम्बन्धित पदाधिकारियों के मोबाइल / लैण्डलाइन नम्बर एवं स्थायी पता सहित सूची की प्रति।</label>
                                                    <div class="input-group">
                                                        <input type="file" class="form-control" onchange="getfileext11(this,127)" id="File127"aria-describedby="inputGroupFileAddon05" aria-label="Upload" name="copy_of_the_list_including_mobile"  @if(!isset($application)) required @endif>
                                                        @if(isset($application->copy_of_the_list_including_mobile))
                                                        <a href="{{ asset('public/private_coaching_storage/copy_of_the_list_including_mobile/') }}/{{ $application->copy_of_the_list_including_mobile }}" download  class="btn btn-secondary" id="inputGroupFileAddon05">View</a>
                                                        @endif  </div>
                                                    <span class="note">(File Format: pdf, jpeg, jpg | Max File Size: 5 MB)</span>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group mb-0">
                                                    <label>9.) Report of the activities of the concerned state sports for the last three years.<br />सम्बंधित प्रदेशीय खेल के विगत तीन वर्ष के कार्यकलापों की रिपोर्ट।  </label>
                                                    <div class="row">
                                                        <div class="col-md-4 mb-3">
                                                            <div class="input-group">
                                                                <input type="file" class="form-control"  onchange="getfileext11(this,126)" id="File126"aria-describedby="inputGroupFileAddon05" aria-label="Upload" name="report_activity_first"  @if(!isset($application)) required @endif>
                                                                        @if(isset($application->report_activity_first))
                                                                        <a href="{{ asset('public/private_coaching_storage/report_activity_first/') }}/{{ $application->report_activity_first }}" download  class="btn btn-secondary" id="inputGroupFileAddon05">View</a>
                                                                        @endif
                                                                     </div>
                                                            <span class="note">(File Format: pdf, jpeg, jpg | Max File Size: 5 MB)</span>
                                                        </div>
                                                        <div class="col-md-4 mb-3">
                                                            <div class="input-group">
                                                                <input type="file" class="form-control" onchange="getfileext11(this,125)" id="File125"aria-describedby="inputGroupFileAddon05" aria-label="Upload" name="report_activity_second"  @if(!isset($application)) required @endif>
                                                                        @if(isset($application->report_activity_second))
                                                                        <a href="{{ asset('public/private_coaching_storage/report_activity_second/') }}/{{ $application->report_activity_second }}" download  class="btn btn-secondary" id="inputGroupFileAddon05">View</a>
                                                                        @endif
                                                                 </div>
                                                            <span class="note">(File Format: pdf, jpeg, jpg | Max File Size: 5 MB)</span>
                                                        </div>
                                                        <div class="col-md-4 mb-3">
                                                            <div class="input-group">
                                                                <input type="file" class="form-control"  onchange="getfileext11(this,124)" id="File124"aria-describedby="inputGroupFileAddon05" aria-label="Upload" name="report_activity_third"  @if(!isset($application)) required @endif>
                                                                @if(isset($application->report_activity_third))
                                                                <a href="{{ asset('public/private_coaching_storage/report_activity_third/') }}/{{ $application->report_activity_third }}" download  class="btn btn-secondary" id="inputGroupFileAddon05">View</a>
                                                                @endif
                                                          </div>
                                                            <span class="note">(File Format: pdf, jpeg, jpg | Max File Size: 5 MB)</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-12">
                                                <div class="form-group mb-0">
                                                    <label>10.) Form of State Sports Association regarding organizing state level competitions of sub-junior/junior/senior category for the last three years.<br />प्रदेशीय खेल संघ का विगत तीन वर्षों तक सबजूनियर/जूनियर/सीनियर वर्ग की राज्यस्तरीय ✓ प्रतियोगिताओं के आयोजन सम्बंधी प्रपत्र। </label>
                                                    <div class="row">
                                                        <div class="col-md-4 mb-3">
                                                            <div class="input-group">
                                                                <input type="file" class="form-control"  onchange="getfileext11(this,123)" id="File123"aria-describedby="inputGroupFileAddon05" aria-label="Upload" name="state_sports_association_first"  @if(!isset($application)) required @endif>
                                                                @if(isset($application->state_sports_association_first))
                                                                <a href="{{ asset('public/private_coaching_storage/state_sports_association_first/') }}/{{ $application->state_sports_association_first }}" download  class="btn btn-secondary" id="inputGroupFileAddon05">View</a>
                                                                @endif </div>
                                                            <span class="note">(File Format: pdf, jpeg, jpg | Max File Size: 5 MB)</span>
                                                        </div>
                                                        <div class="col-md-4 mb-3">
                                                            <div class="input-group">
                                                                <input type="file" class="form-control"  onchange="getfileext11(this,122)" id="File122"aria-describedby="inputGroupFileAddon05" aria-label="Upload" name="state_sports_association_second"  @if(!isset($application)) required @endif  >
                                                                @if(isset($application->state_sports_association_second))
                                                                <a href="{{ asset('public/private_coaching_storage/state_sports_association_second/') }}/{{ $application->state_sports_association_second }}" download  class="btn btn-secondary" id="inputGroupFileAddon05">View</a>
                                                                @endif      </div>
                                                            <span class="note">(File Format: pdf, jpeg, jpg | Max File Size: 5 MB)</span>
                                                        </div>
                                                        <div class="col-md-4 mb-3">
                                                            <div class="input-group">
                                                                <input type="file" class="form-control" id="inputGroupFile05" aria-describedby="inputGroupFileAddon05" aria-label="Upload" name="state_sports_association_third"  @if(!isset($application)) required @endif>
                                                                @if(isset($application->state_sports_association_third))
                                                                <a href="{{ asset('public/private_coaching_storage/state_sports_association_third/') }}/{{ $application->state_sports_association_third }}" download  class="btn btn-secondary" id="inputGroupFileAddon05">View</a>
                                                                @endif  </div>
                                                            <span class="note">(File Format: pdf, jpeg, jpg | Max File Size: 5 MB)</span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="bhoechie-footer">
                                                <div class="row justify-content-center">


                                                    <div class="col-md-4 d-grid">
                                                        <button type="submit" class="btn btn-outline-success ">Save and Next</button>
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
    </div>
</div>



@endsection












@push('custom-scripts')
<script type="text/javascript">
    $(document).ready(function() {


        var i = 2;
        $("#add").click(function() {

            $('#dynamic_field').append('<tr id="row' + i + '"><td> <input type="text" name="name_of_member[]" required class="form-control" onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))" pattern="^[A-Za-z -]+$" maxlength="255" required/> </td> <td> <input type="number" max="9999999999" min="6666666666" name="mobile[]" required  class="form-control" /> </td> <td> <input type="email" name="email[]" required class="form-control" /> </td> <td> <input type="text" name="designation[]" required onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))" pattern="^[A-Za-z -]+$" maxlength="255"  class="form-control" /> </td><td  class="text-center"><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn-xs btn_remove"><i class="fa fa-trash"></i></button></td></tr>');
            i++;
             // Mobile number validation
    $('input[name="owner_mobile"],input[name="nearest_hospital_contact_number"], input[name="manager_mobile"], input[name="applicant_mobile"], input[name="mobile[]"]').on('input', function() {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
        });

        $(document).on('click', '.btn_remove', function() {
            var button_id = $(this).attr("id");
            $('#row' + button_id + '').remove();
        });
         // Mobile number validation
    $('input[name="owner_mobile"],input[name="nearest_hospital_contact_number"], input[name="manager_mobile"], input[name="applicant_mobile"], input[name="mobile[]"]').on('input', function() {
        this.value = this.value.replace(/[^0-9]/g, '');
    });
    });
</script>

<script>

$("#submitform").submit(function (e) {

    e.preventDefault();
    if ($("#submitform")[0].checkValidity() === false) {
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
            success: function (res) {
                if (res.error == false) {
                    success(res.msg);

                    window.location.href = res.url;


                } else {
                    error(res.msg);
                }
            },
        });
    }
    $("#submitform").addClass("was-validated");
    });


function getfileext11(value, id) {


var fileExtension = ["pdf"];
var file_size = value.files[0].size;

var filevalue = value.value;
if (
    $.inArray(filevalue.split(".").pop().toLowerCase(), fileExtension) == -1
) {
    $("#File" + id).val("");
    $("#sign").attr("src", "");
    error("Please Upload File in pdf Format.");
} else if (file_size > 5000000) {
    $("#File" + id).val("");
    $("#sign").attr("src", "");
    error("File Size should not exceed 5MB.");
}

}





    function get_city(value)
         {
            let district3=$("#district3").val();
            let option=`<option value=''>Select City</option>`;
           $.ajax({
            type: "POST",
            url: "{{url('get_city')}}",
            data: {value},

            success: function (response) {
                response.forEach((item)=>{

                      option +=`<option ${item.id == district3 ? 'selected':''} value="${item.id}" >${item.city}</option>`;

                });
                $("#city_id").empty();
                $("#city_id").append(option);
            }
           });
         }



    </script>
    @endpush
