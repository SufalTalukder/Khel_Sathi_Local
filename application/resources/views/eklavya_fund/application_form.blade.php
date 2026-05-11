@extends( 'layouts\eklavya_fund_dashboard_layout' )
@section('content')
 <!-- InstanceBeginEditable name="Content Area" -->
 <div class="container-fluid">
    <div class="bhoechie-tab-container">
        <div class="row">
            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <div class="bhoechie-tab-content">
                    <div class="form-scroll">
                        <div class="nano-content">
                            <form action="{{ url('eklavyaFund/application_form') }}" method="post" id="ajxReload" class="needs-validation" novalidate>
                            <div class="row">
                                <div class="col-md-12">
                                    <h5 class="subheading">Registration Details/पंजीकरण विवरण</h5>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="placeholder">Name of Sports Club/Academy<br />खेल क्लब/एकेडमी का नाम</label>
                                        <input type="text" class="form-control" value="{{ Auth::guard('EklavyaFund')->user()->academy_name  }}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="placeholder">Name of the Sport<br />खेल का नाम</label>
                                        <input type="text" class="form-control" value="{{ sport_name(Auth::guard('EklavyaFund')->user()->sport_id)  }}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="placeholder">Mobile Number<br />मोबाइल नंबर</label>
                                        <input type="text" class="form-control" value="{{ Auth::guard('EklavyaFund')->user()->mobile  }}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="placeholder">Email ID<br />ईमेल आईडी</label>
                                        <input type="email" class="form-control" value="{{ Auth::guard('EklavyaFund')->user()->email  }}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="placeholder">Location of the Sports Club/Academy within the state boundary<br />खेल क्लब/अकादमी उत्तर प्रदेश राज्य के सीमा क्षेत्र में स्थापित एवं कार्यरत हो</label>
                                        <div class="form-control">
                                            <div class="form-check form-check-inline m-0">
                                                <input disabled class="form-check-input native_check" checked type="radio" name="native_of_up" required id="inlineRadio1" value="1">
                                                <label class="form-check-label" for="inlineRadio1">Yes</label>
                                            </div>
                                            <div class="form-check form-check-inline m-0">
                                                <input disabled class="form-check-input native_check" type="radio" name="native_of_up" id="inlineRadio2" value="2">
                                                <label class="form-check-label" for="inlineRadio2">No</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="placeholder">TAN Number/PAN Number<br />TAN नंबर/PAN नंबर</label>
                                        <input type="text" class="form-control" value="{{ Auth::guard('EklavyaFund')->user()->pan  }}" disabled>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <h5 class="subheading">Applicant Details/आवेदक का विवरण</h5>
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Registration Certificate under Society Act<br />सोसाइटी अधिनियम के तहत पंजीकरण प्रमाणपत्र</label>
                                            <div class="input-group">
                                                <input type="file" name="registration_certificate_doc" {{isset($fund_data->registration_certificate_doc) ? '' : 'required'}} class="form-control" onchange="getfileext(this.value,4)" id="File4" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
                                                @if(isset($fund_data->registration_certificate_doc))
                                                <a target="_blank" href="{{url('public/eklavya_fund/registration_certificate_doc')}}/{{$fund_data->registration_certificate_doc}}" class="btn btn-secondary" id="A4">View</a>
                                                @endif
                                            </div>
                                            <span class="note">(File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)</span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label class="placeholder">Correspondence Address<br />पत्राचार का पता</label>
                                            <input type="text" value="{{isset($fund_data->correspondence_address) ? $fund_data->correspondence_address : ''}}" required id="correspondence_address" name="correspondence_address" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label class="placeholder">State<br />राज्य </label>
                                            <select class="form-select" id="state" required name="state" onchange="get_city(this.value,'district')">
                                                <option>Select</option>
                                                @foreach($state as $value)
                                                    <option @if(isset($fund_data->state) && $fund_data->state == $value->id) selected @endif value="{{$value->id}}" >{{$value->name}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label class="placeholder">District<br />जनपद </label>
                                            <input type="hidden" id="district5" value="{{isset($fund_data->district) ? $fund_data->district : ''}}">
                                            <select class="form-select" required name="district" id="district">
                                                <option>Select</option>
                                                @foreach($city as $value)
                                                    <option value="{{$value->id}}" >{{$value->city}}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label class="placeholder">PIN Code<br />पिन कोड</label>
                                            <input type="text" required value="{{isset($fund_data->pincode) ? $fund_data->pincode : ''}}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" class="form-control" maxlength="6" minlength="6" name="pincode" id="pincode" pattern="[0-9]{6}" value="">
                                        </div>
                                    </div>
                                    <p></p>
                                   
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label>Accreditation Certificate from Sports Authority of India (SAI)/भारतीय खेल प्राधिकरण (SAI) से मान्यता प्रमाणपत्र</label>
                                            <div class="input-group">
                                                <input type="file"  name="accreditation_certificate_doc" onchange="getfileext(this.value,14)" id="File14" {{isset($fund_data->accreditation_certificate_doc) || isset($fund_data->notarized_affidavit_180_doc)  ? '' : 'required'}} class="form-control"  aria-describedby="inputGroupFileAddon05" aria-label="Upload">
                                                @if(isset($fund_data->accreditation_certificate_doc))
                                                <a target="_blank" href="{{url('public/eklavya_fund/accreditation_certificate_doc')}}/{{$fund_data->accreditation_certificate_doc}}" class="btn btn-secondary" id="A4">View</a>
                                                @endif
                                            </div>
                                            <span class="note">(File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)</span>
                                        </div>
                                    </div>
                                    <div class="col-md-1">
                                        <div class="form-group text-center">
                                            <label>OR/या</label>
                                        </div>
                                    </div>
                                    <div class="col-md-7">
                                        <div class="form-group">
                                            <label>Notarized Affidavit for providing at least 180 days of training to Olympic/Paralympic medalist athletes/<br>ओलंपिक/पैरालंपिक पदक विजेता एथलीटों को कम से कम 180 दिनों का प्रशिक्षण प्रदान करने के लिए नोटरीकृत शपथ पत्र</label>
                                            <div class="input-group">
                                                <input type="file"  name="notarized_affidavit_180_doc" {{isset($fund_data->accreditation_certificate_doc) || isset($fund_data->notarized_affidavit_180_doc)  ? '' : 'required'}} class="form-control" onchange="getfileext(this.value,5)" id="File5" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
                                                @if(isset($fund_data->notarized_affidavit_180_doc))
                                                <a target="_blank" href="{{url('public/eklavya_fund/notarized_affidavit_180_doc')}}/{{$fund_data->notarized_affidavit_180_doc}}" class="btn btn-secondary" id="A4">View</a>
                                                @endif
                                            </div>
                                            <span class="note">(File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)</span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label class="placeholder">Affiliation with Provincial Sports Association<br />खेल क्लब/अकादमी का संबंधित प्रदेशीय खेल संघ से मान्यता है अथवा नहीं  </label>
                                            <div class="form-control">
                                                <div class="form-check form-check-inline me-2">
                                                    <input class="form-check-input native_check" @if(isset($fund_data->affiliation) && $fund_data->affiliation == 1) checked @endif  type="radio" name="affiliation" required id="inlineRadio1" value="1">
                                                    <label class="form-check-label" for="inlineRadio1">Yes</label>
                                                </div>
                                                <div class="form-check form-check-inline m-0">
                                                    <input class="form-check-input native_check" @if(isset($fund_data->affiliation) && $fund_data->affiliation == 2) checked @endif  type="radio" name="affiliation" id="inlineRadio2" value="2">
                                                    <label class="form-check-label" for="inlineRadio2">No</label>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label class="placeholder">Details of the club/academy’s constitution/charter<br />खेल क्लब/अकादमी के संविधान/ज्ञान पत्र की प्रति</label>
                                            <div class="input-group">
                                                <input type="file" class="form-control" name="constitution_charter_doc" {{isset($fund_data->constitution_charter_doc) ? '' : 'required'}}  onchange="getfileext(this.value,6)" id="File6" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
                                                @if(isset($fund_data->constitution_charter_doc))
                                                <a target="_blank" href="{{url('public/eklavya_fund/constitution_charter_doc')}}/{{$fund_data->constitution_charter_doc}}" class="btn btn-secondary" id="A4">View</a>
                                                @endif
                                            </div>
                                            <span class="note">(File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)</span>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group mb-1">
                                            <b>Contact Details (Mobile number and permanent position details of officials)/संपर्क विवरण (अधिकारियों का मोबाइल नंबर और स्थायी पद का विवरण)</b>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table table-bordered" id="dynamic_field3">
                                                <thead>
                                                    <tr>
                                                        <th style="width:8%;">S. No./क्र. सं.</th>
                                                        <th>Name/नाम</th>
                                                        <th>Mobile Number/मोबाइल नंबर</th>
                                                        <th>Address/पता</th>
                                                        <th style="width:10%;">Action/कार्रवाई</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if(count($officer_data) == 0)
                                                    <tr>
                                                        <td align="center">1</td>
                                                        <td><input name="office_name[]" required type="text" class="form-control" /></td>
                                                        <td><input minlength="10" maxlength="10" pattern="[6-9][0-9]{9}$" name="office_mobile[]" required type="text" class="form-control" /></td>
                                                        <td><input name="office_address[]" required type="text" class="form-control" /></td>
                                                        <td align="center"><button type="button" name="add" id="add3"  class="btn btn-success"><i class="fa fa-plus"></i></button></td>
                                                    </tr>
                                                    @else
                                                        @foreach($officer_data as $key=>$item)
                                                        <tr id="row{{$key}}">
                                                            <td align="center">{{$key+1}}</td>
                                                            <td><input name="office_name[]" required type="text" value="{{$item->office_name}}" class="form-control" /></td>
                                                            <td><input pattern="[6-9][0-9]{9}$" name="office_mobile[]" value="{{$item->office_mobile}}" required type="text" class="form-control" /></td>
                                                            <td><input name="office_address[]" value="{{$item->office_address}}" required type="text" class="form-control" /></td>
                                                            @if($key==0)
                                                            <td align="center"><button type="button" name="add" id="add3"  class="btn btn-success"><i class="fa fa-plus"></i></button></td>
                                                            @else
                                                            <td align="center"><button type="button" name="remove" id="{{$key}}" class="btn btn-danger mt-1 px-2 btn_remove"><span class="far fa-trash-alt"></span></button></td>
                                                            @endif
                                                        </tr>
                                                        @endforeach
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label class="placeholder">Email ID of the Sports Club/Academy<br />खेल क्लब/अकादमी की ई-मेल आईडी</label>
                                            <input required  type="email" pattern="[a-z0-9._%+-]+@[a-z0-9.-]+\.[a-z]{2,4}$" name="email_sports_club" value="{{isset($fund_data->email_sports_club) ? $fund_data->email_sports_club : ''}}" class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label class="placeholder">Description of Sports Ground/Hall/Facilities<br />खेल क्लब/अकादमी के खेल मैदान/हॉल परिसर का विवरण</label>
                                            <input type="text" value="{{isset($fund_data->ground_description) ? $fund_data->ground_description : ''}}" name="ground_description" required class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group mb-1">
                                            <b>List of players available in the club/academy (minimum 5 players per month)/क्लब/अकादमी में उपलब्ध खिलाड़ियों की सूची (प्रति माह न्यूनतम 5 खिलाड़ी)</b>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="table-responsive">
                                            <table class="table table-bordered"  id="dynamic_field2">
                                                <thead>
                                                    <tr>
                                                        <th style="width:8%;">S. No./क्र. सं.</th>
                                                        <th>Name/नाम</th>
                                                        <th>Mobile Number/मोबाइल नंबर</th>
                                                        <th>Aadhaar Number/आधार संख्या</th>
                                                        <th style="width:10%;">Action/कार्रवाई</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @if(count($player_data) == 0)
                                                        <tr>
                                                            <td align="center">1</td>
                                                            <td><input type="text" name="player_name[]" required class="form-control" /></td>
                                                            <td><input type="text" pattern="[6-9][0-9]{9}$" name="player_mobile[]" required class="form-control" /></td>
                                                            <td><input type="text" pattern="[0-9]{12}" name="player_aadhar[]" required class="form-control" /></td>
                                                            <td align="center"></td>
                                                        </tr>
                                                        <tr>
                                                            <td align="center">2</td>
                                                            <td><input type="text" name="player_name[]" required class="form-control" /></td>
                                                            <td><input type="text" pattern="[6-9][0-9]{9}$" name="player_mobile[]" required class="form-control" /></td>
                                                            <td><input type="text" pattern="[0-9]{12}" name="player_aadhar[]" required class="form-control" /></td>
                                                            <td align="center"></td>
                                                        </tr>
                                                        <tr>
                                                            <td align="center">3</td>
                                                            <td><input type="text" name="player_name[]" required class="form-control" /></td>
                                                            <td><input type="text" pattern="[6-9][0-9]{9}$" name="player_mobile[]" required class="form-control" /></td>
                                                            <td><input type="text" pattern="[0-9]{12}" name="player_aadhar[]" required class="form-control" /></td>
                                                            <td align="center"></td>
                                                        </tr>
                                                        <tr>
                                                            <td align="center">4</td>
                                                            <td><input type="text" name="player_name[]" required class="form-control" /></td>
                                                            <td><input type="text" pattern="[6-9][0-9]{9}$" name="player_mobile[]" required class="form-control" /></td>
                                                            <td><input type="text" pattern="[0-9]{12}" name="player_aadhar[]" required class="form-control" /></td>
                                                            <td align="center"></td>
                                                        </tr>
                                                        <tr>
                                                        <td align="center">5</td>
                                                        <td><input type="text" name="player_name[]" required class="form-control" /></td>
                                                        <td><input type="text" pattern="[6-9][0-9]{9}$" name="player_mobile[]" required class="form-control" /></td>
                                                        <td><input type="text" pattern="[0-9]{12}" name="player_aadhar[]" required class="form-control" /></td>
                                                        <td align="center"><button type="button" name="add" id="add2"  class="btn btn-success"><i class="fa fa-plus"></i></button></td>
                                                        </tr>
                                                    @else
                                                        @foreach($player_data as $key =>$itemm)
                                                            <tr id="row{{$key}}">
                                                            <td align="center">{{$key+1}}</td>
                                                            <td><input type="text" value="{{$itemm->player_name}}" name="player_name[]" required class="form-control" /></td>
                                                            <td><input type="text" value="{{$itemm->player_mobile}}" pattern="[6-9][0-9]{9}$" name="player_mobile[]" required class="form-control" /></td>
                                                            <td><input type="text" value="{{$itemm->player_aadhar}}" pattern="[0-9]{12}" name="player_aadhar[]" required class="form-control" /></td>

                                                            @if($key==4)
                                                                <td align="center"><button type="button" name="add" id="add2"  class="btn btn-success"><i class="fa fa-plus"></i></button></td>
                                                            @elseif($key > 4)
                                                            <td align="center"><button type="button" name="remove" id="{{$key}}" class="btn btn-danger mt-1 px-2 btn_remove"><span class="far fa-trash-alt"></span></button></td>
                                                            @else
                                                            <td></td>
                                                            @endif
                                                            </tr>
                                                        @endforeach
                                                    @endif
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="placeholder">Approval/Accreditation Letter from State Sports Association<br />प्रदेशीय खेल संघ का खेल विभाग से मान्यता/समझौता पत्र संलग्न करें</label>
                                            <div class="input-group">
                                                <input type="file" name="accreditation_letter_doc" {{isset($fund_data->accreditation_letter_doc) ? '' : 'required'}}  class="form-control" onchange="getfileext(this.value,7)" id="File7" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
                                                @if(isset($fund_data->accreditation_letter_doc))
                                                <a target="_blank" href="{{url('public/eklavya_fund/accreditation_letter_doc')}}/{{$fund_data->accreditation_letter_doc}}" class="btn btn-secondary" id="A4">View</a>
                                                @endif
                                            </div>
                                            <span class="note">(File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="placeholder">Dispute status in the State Sports Association (if any)<br />प्रदेशीय खेल संघ में विवाद की स्थिति (यदि कोई हो)</label>
                                            <div class="input-group">
                                                <input type="file" name="dispute_status_doc" class="form-control" onchange="getfileext(this.value,8)" id="File8" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
                                                @if(isset($fund_data->dispute_status_doc))
                                                <a target="_blank" href="{{url('public/eklavya_fund/dispute_status_doc')}}/{{$fund_data->dispute_status_doc}}" class="btn btn-secondary" id="A4">View</a>
                                                @endif
                                            </div>
                                            <span class="note">(File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="placeholder">Details of the premises operated by the club/academy (owned/rented)<br />खेल क्लब/अकादमी द्वारा संचालित परिसर का विवरण (स्वामित्व/किराए पर) </label>
                                            <div class="input-group">
                                                <input type="file" name="premises_operated_doc" {{isset($fund_data->premises_operated_doc) ? '' : 'required'}}  class="form-control" onchange="getfileext(this.value,9)" id="File9" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
                                                @if(isset($fund_data->premises_operated_doc))
                                                <a target="_blank" href="{{url('public/eklavya_fund/premises_operated_doc')}}/{{$fund_data->premises_operated_doc}}" class="btn btn-secondary" id="A4">View</a>
                                                @endif
                                            </div>
                                            <span class="note">(File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)</span>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group mb-3">
                                            <label class="placeholder">Notarized Affidavit for non-receipt of financial aid from other departments<br />आर्थिक सहायता किसी अन्य श्रेणी/विभाग से प्राप्त न होने का नोटरी शपथ पत्र की मूल प्रति</label>
                                            <div class="input-group">
                                                <input type="file" name="notarized_affidavit_doc" {{isset($fund_data->notarized_affidavit_doc) ? '' : 'required'}}  class="form-control" onchange="getfileext(this.value,10)" id="File10" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
                                                @if(isset($fund_data->notarized_affidavit_doc))
                                                <a target="_blank" href="{{url('public/eklavya_fund/notarized_affidavit_doc')}}/{{$fund_data->notarized_affidavit_doc}}" class="btn btn-secondary" id="A4">View</a>
                                                @endif
                                            </div>
                                            <span class="note">(File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)</span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label class="placeholder">Description of financial aid expected<br />खेल क्लब/अकादमी को प्राप्त होने वाली आय का विवरण</label>
                                            <input type="text" value="{{isset($fund_data->financial_aid_details) ? $fund_data->financial_aid_details : ''}}" name="financial_aid_details" required class="form-control">
                                        </div>
                                    </div>
                                    <input type="hidden" name="id" value="{{isset($fund_data->id) ? $fund_data->id : ''}}">
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label class="placeholder">Certificate for the appropriate use of approved funds<br />खेल क्लब/अकादमी को स्वीकृत धनराशि का प्रमाणित उपयोगिता प्रमाण-पत्र</label>
                                            <div class="input-group">
                                                <input type="file" name="appropriate_approved_funds_doc" {{isset($fund_data->appropriate_approved_funds_doc) ? '' : 'required'}}  class="form-control" onchange="getfileext(this.value,11)" id="File11" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
                                                @if(isset($fund_data->appropriate_approved_funds_doc))
                                                <a target="_blank" href="{{url('public/eklavya_fund/appropriate_approved_funds_doc')}}/{{$fund_data->appropriate_approved_funds_doc}}" class="btn btn-secondary" id="A4">View</a>
                                                @endif
                                            </div>
                                            <span class="note">(File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)</span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label class="placeholder">Report of the training provided by the sports club/academy<br />खेल क्लब/अकादमी में संचालित प्रशिक्षण शिविर की रिपोर्ट</label>
                                            <div class="input-group">
                                                <input type="file" name="report_training_provided_doc" {{isset($fund_data->report_training_provided_doc) ? '' : 'required'}}  class="form-control" onchange="getfileext(this.value,12)" id="File12" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
                                                @if(isset($fund_data->report_training_provided_doc))
                                                <a target="_blank" href="{{url('public/eklavya_fund/report_training_provided_doc')}}/{{$fund_data->report_training_provided_doc}}" class="btn btn-secondary" id="A4">View</a>
                                                @endif
                                            </div>
                                            <span class="note">(File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)</span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label class="placeholder">Audit report of accounts related to the grant<br />खेल क्लब/अकादमी का निर्मित अनुबंध का प्रमाण संलग्न करें</label>
                                            <div class="input-group">
                                                <input type="file" name="audit_report_accounts_doc" {{isset($fund_data->audit_report_accounts_doc) ? '' : 'required'}}  class="form-control" onchange="getfileext(this.value,13)" id="File13" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
                                                @if(isset($fund_data->audit_report_accounts_doc))
                                                <a target="_blank" href="{{url('public/eklavya_fund/audit_report_accounts_doc')}}/{{$fund_data->audit_report_accounts_doc}}" class="btn btn-secondary" id="A4">View</a>
                                                @endif
                                            </div>
                                            <span class="note">(File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)</span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            {{-- <label class="placeholder">Branch Code/IFSC Code<br />शाखा कोड/IFSC कोड</label> --}}
                                            <label class="placeholder">IFSC No.<br />IFSC संख्या</label>
                                            <input type="text" value="{{isset($fund_data->bank_ifsc) ? $fund_data->bank_ifsc : ''}}" pattern="[A-Z]{4}0[A-Z0-9]{6}" name="bank_ifsc" required class="form-control" onblur="getBankDetails(this.value)" id="ifscupper">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label class="placeholder">Bank Name<br />बैंक का नाम</label>
                                            <input type="text" value="{{isset($fund_data->bank_name) ? $fund_data->bank_name : ''}}" id="bank_name" name="bank_name" required class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label class="placeholder">Bank Account Number<br />बैंक खाता संख्या</label>
                                            <input type="text" value="{{isset($fund_data->acc_no) ? $fund_data->acc_no : ''}}" pattern=".{9,18}" minlength="9" maxlength="18" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" id="acc_no" name="acc_no" required class="form-control">
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label class="placeholder">Recommendation of District/Provincial Sports Officer<br />खेल विभाग के मंडलीय/जनपदीय अधिकारी की संस्तुति</label>
                                            <div class="input-group">
                                                <input type="file" name="recommendation_of_district_doc" {{isset($fund_data->recommendation_of_district_doc) ? '' : 'required'}}  class="form-control" onchange="getfileext(this.value,141)" id="File141" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
                                                @if(isset($fund_data->recommendation_of_district_doc))
                                                <a target="_blank" href="{{url('public/eklavya_fund/recommendation_of_district_doc')}}/{{$fund_data->recommendation_of_district_doc}}" class="btn btn-secondary" id="A4">View</a>
                                                @endif
                                            </div>
                                            <span class="note">(File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)</span>
                                        </div>
                                    </div>
                                    <div class="col-md-4">
                                        <div class="form-group mb-3">
                                            <label class="placeholder">Recommendation of the relevant State Sports Association<br />संबंधित प्रदेशीय खेल संघ की संस्तुति</label>
                                            <div class="input-group">
                                                <input type="file" name="recommendation_of_state_sports_doc" {{isset($fund_data->recommendation_of_state_sports_doc) ? '' : 'required'}}  class="form-control" onchange="getfileext(this.value,15)" id="File15" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
                                                @if(isset($fund_data->recommendation_of_state_sports_doc))
                                                <a target="_blank" href="{{url('public/eklavya_fund/recommendation_of_state_sports_doc')}}/{{$fund_data->recommendation_of_state_sports_doc}}" class="btn btn-secondary" id="A4">View</a>
                                                @endif
                                            </div>
                                            <span class="note">(File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)</span>
                                        </div>
                                    </div>
                                </div>


                                <div class="bhoechie-footer">
                                    <div class="row justify-content-center">
                                        <div class="col-md-2 d-grid">
                                            <button type="submit" class="btn btn-info">Save and Next</button>
                                        </div>
                                        @if(!isset($fund_data->id))
                                        <div class="col-md-2 d-grid">
                                            <button type="reset" class="btn btn-danger">Reset</button>
                                        </div>
                                        @endif
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
<!-- InstanceEndEditable -->


@endsection
@push('custom-scripts')
<script>
	$(document).ready(function() {
		var i = 1;
		var j = 5;
		var length;
		$("#add3").click(function() {
			i++;
			$('#dynamic_field3').append('<tr id="row' + i + '"><td align="center">' + i + '</td><td><input name="office_name[]" required type="text" class="form-control" /></td><td><input pattern="[6-9][0-9]{9}$" name="office_mobile[]" required type="text" class="form-control" /></td><td><input name="office_address[]" required type="text" class="form-control" /></td><td align="center"><button type="button" name="remove" id="' + i + '" class="btn btn-danger mt-1 px-2 btn_remove"><span class="far fa-trash-alt"></span></button></td></tr>');                                        
        });
        $("#add2").click(function() {
			j++;
			$('#dynamic_field2').append('<tr id="row' + j + '"><td align="center">' + j + '</td><td><input name="player_name[]" required type="text" class="form-control" /></td><td><input pattern="[6-9][0-9]{9}$" name="player_mobile[]" required type="text" class="form-control" /></td><td><input type="text" pattern="[0-9]{12}" name="player_aadhar[]" required class="form-control" /></td><td align="center"><button type="button" name="remove" id="' + j + '" class="btn btn-danger mt-1 px-2 btn_remove"><span class="far fa-trash-alt"></span></button></td></tr>');                                        
        });
		$(document).on('click', '.btn_remove', function() {
			var button_id = $(this).attr("id");
			$('#row' + button_id + '').remove();
		});
		$("#submit").on('click', function(event) {
			var formdata = $("#add_name3").serialize();
			// console.log( formdata );
			event.preventDefault()
			$.ajax({
				url: "action.php",
				type: "POST",
				data: formdata,
				cache: false,
				success: function(result) {
					alert(result);
					$("#add_name3")[0].reset();
				}
			});
		});
        $('#File14, #File5').on('change', function () {
            var File4 = $('#File14')[0].files.length > 0;
            var File5 = $('#File5')[0].files.length > 0;

            if (File5) {
                $('#File14').removeAttr('required');
            } else {
                $('#File14').attr('required', 'required');
            }

            if (File4) {
                $('#File5').removeAttr('required');
            } else {
                $('#File5').attr('required', 'required');
            }
        });
        
	});
    function get_city(value,id)
        {
        let district5=$("#district5").val();
        let h_city = $("#district1").val();
        let option=`<option value=''>Select District</option>`;
        $.ajax({
        type: "POST",
        url: "{{url('get_city')}}",
        data: {value},

        success: function (response) {
            response.forEach((item)=>{
            //   if (h_city && id == "district2") {
            //         option += `<option value="${item.id}" ${item.id==h_city?'selected':''}>${item.city}</option>`;
            //     }else{
                    option +=`<option ${item.id == district5 ? 'selected':''} value="${item.id}" >${item.city}</option>`;
                // }
            });
            $("#"+id).empty();
            $("#"+id).append(option);
        }
        });
        }
</script>
@endpush
