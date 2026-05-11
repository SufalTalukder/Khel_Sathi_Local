@extends('layouts/layout')
@section('content')
<div class="row">
    <!-- <div class="col-md-2">
        <div class="left-sidebar">
            <div>
                <ul>
                    <li> <a href="{{ route('dashboard') }}"><span class="icons icon-arrow-left"></span> Dashboard</a></li>
                    <li><a href="{{ route('profile') }}"><span class="icons icon-arrow-left"></span>Applicant’s Profile</a></li>
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
                            <form action="{{url('/update_position_holder')}}" method="post" id="ajxReload" enctype="multipart/form-data" class="needs-validation" novalidate="">
                                @csrf
                                <div>
                                    <div class="row">
                                        @foreach($position_holder as $item)
                                        <input type="hidden" name="application_no" value="{{$item->application_no}}">
                                        <!-- <div class="col-md-12">
                                            <h5 class="subheading">Nomination Form for Rani Laxmi Bai Award/रानी लक्ष्मी पुरस्कार हेतु नामांकन</h5>
                                        </div>
                                        <div class="col-md-12">
                                            <h5 class="subheading">A. Basic Details/सामान्य विवरण</h5>
                                        </div> -->
                                        <div class="col-md-12">
                                            <h5 class="subheading">Nomination Form for 1st, 2nd & 3rd Position Holder  / प्रथम, द्वितीय और तृतीय स्थान के विजेताओं को हेतु नामांकन</h5>
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
                                        <div class="col-md-6">
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
                                                <label class="placeholder">2. Highest Educational Qualification<br>उच्चतम शैक्षणिक योग्यता<span class="text-danger">*</span></label>
                                                <select class="form-control dropdown form-select" required id="qualification" name="qualification">
                                                    <option value="" selected="selected" disabled="disabled">Select</option>
                                                    <option {{ $item->qualification === "10" ? 'selected' : '' }} value="10">10th / High School</option>
                                                    <option {{ $item->qualification === "12" ? 'selected' : '' }} value="12">12th / Intermediate</option>
                                                    <option {{ $item->qualification === "graduation" ? 'selected' : '' }} value="graduation">Graduation</option>
                                                    <option {{ $item->qualification === "master_degree" ? 'selected' : '' }} value="master_degree">Master Degree</option>

                                                    <option {{ $item->qualification === "other" ? 'selected' : '' }} value="other">Other</option>
                                                </select>
                                                <!-- <input type="text" value="{{old('qualification') }}" class="form-control" name="qualification"  required> -->
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>3. Upload Certificate of Highest Educational Qualification<br>उच्चतम शैक्षणिक योग्यता का प्रमाणपत्र अपलोड करें<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="file" name="qualification_doc" class="form-control" onchange="getfileext(this.value,1)" id="File1" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
                                                    <input type="hidden" value="{{$item->qualification_doc}}" name="qualification_doc1">
                                                    <!-- <a  class="btn btn-secondary" id="A4">View</a> -->
                                                    @if($item->qualification_doc !='')
                                                    @php
                                                    $img = url('storage/position_holder').'/'.$item->qualification_doc;
                                                    $img1 = url('public/images/view.jpg');
                                                    $doc = explode('.',$item->qualification_doc);

                                                    @endphp
                                                    <img src="{{$img1}}" role="button" onclick="appendImage('{{$img}}','{{$doc[1]}}')" class="img-fluid" />
                                                    @endif
                                                </div>
                                                <span class="note">File Format: jpeg, jpg, Pdf | (Max File Size: 2 MB)<br>(फाइल का प्रारूप: JPEG/JPG | फाइल का अधिकतम साइज़: 2 MB)</span>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group">
                                                <label>4. Upload Domicile Certificate of UP<br>उत्तर प्रदेश का मूल निवास प्रमाण पत्र अपलोड करें<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="file" name="domicile_certificate" class="form-control" onchange="getfileext(this.value,2)" id="File2" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
                                                    <input type="hidden" value="{{$item->domicile_certificate}}" name="domicile_certificate1">
                                                    <!-- <a  class="btn btn-secondary" id="A4">View</a> -->
                                                    @if($item->domicile_certificate !='')
                                                    @php
                                                    $img = url('storage/position_holder').'/'.$item->domicile_certificate;
                                                    $img1 = url('public/images/view.jpg');
                                                    $doc = explode('.',$item->domicile_certificate);

                                                    @endphp
                                                    <img src="{{$img1}}" role="button" onclick="appendImage('{{$img}}','{{$doc[1]}}')" class="img-fluid" />
                                                    @endif
                                                </div>
                                                <span class="note">File Format: jpeg, jpg, Pdf | Max File Size: 2 MB<br>(फाइल का प्रारूप: JPEG/JPG | फाइल का अधिकतम साइज़: 2 MB)</span>
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <h5 class="subheading">B. Competition Details/प्रतियोगिता विवरण</h5>
                                        </div>
                                        
                                        <input type="hidden" name="dob" value={{$dob}} id="dob" />
                                        
                                        {{-- <div class="col-md-4" id="affidavit">
                                            <div class="form-group">
                                                <label>Upload Affidavit of Award Certificate<br>पुरुस्कार प्रमाणपत्र का शपथ पत्र अपलोड करें<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="file" name="award_certificate_affidavit" class="form-control" onchange="getfileext(this.value,5)" id="File5" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
                                                    <input type="hidden" name="award_certificate_affidavit1" id="award_certificate_affidavit1" value="{{$item->award_certificate_affidavit}}">
                                                    <!-- <a  class="btn btn-secondary" id="A4">View</a> -->
                                                    @if($item->award_certificate_affidavit !='')
                                                    @php
                                                    $img = url('storage/position_holder').'/'.$item->award_certificate_affidavit;
                                                    $img1 = url('public/images/view.jpg');
                                                    $doc = explode('.',$item->award_certificate_affidavit);

                                                    @endphp
                                                    <img src="{{$img1}}" role="button" onclick="appendImage('{{$img}}','{{$doc[1]}}')" class="img-fluid" />
                                                    @endif
                                                </div>
                                                <span class="note">(File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)<br>(फाइल का प्रारूप: JPEG/JPG | फाइल का अधिकतम साइज़: 2 MB)</span>
                                            </div>
                                        </div> --}}
                                      
                                        <div class="col-md-12">
                                            <div class="form-group">
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
                                                            <td rowspan="2"><label>Event Detail</br>आयोजन का विवरण<span class="text-danger">*</span></label> </td>
                                                            <td rowspan="2"></td>
                                                        </tr>
                                                        <tr>
                                                            <td><label>From </label>
                                                            </td>
                                                            <td><label>To </label>
                                                            </td>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach( $competition_award_docs as $key=>$post)
                                                        <tr id="row{{$key}}">
                                                            <td>
                                                                <select name="competition_name[]" onchange="get_event({{$key}})" required  class="form-select competition_name">
                                                                    <option value="">Select</option>
                                                                    @foreach ($competition as $type)
                                                                    <option {{ $post->competition_name === $type->id ? 'selected' : '' }} value="{{$type->id}}" >{{$type->name}}</option>
                                                                    @endforeach
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <select class="form-select event_type" onchange="get_event({{$key}})" name="event_type[]" required>
                                                                    <option value="">Select</option>
                                                                    <option {{ $post->event_type === "1" ? 'selected' : '' }} value="1">Individual</option>
                                                                    <option {{ $post->event_type === "2" ? 'selected' : '' }} value="2">Team</option>
                                                                    <option {{ $post->event_type === "3" ? 'selected' : '' }} value="3">Both</option>
                                                                    
                                                                </select>
                                                            </td>
                                                            <td>
                                                                <input type="hidden" id="event_sel{{$key}}" data-id="" value="{{$post->event_name}}">
                                                                <select class="form-select event_name" name="event_name[]" required>
                                                                    <option value="">Select</option>
                                                                   
                                                                </select>
                                                            </td>
                                                            <td style="width: 135px;">
                                                                <select class="form-select" name="earned_medals[]" required>
                                                                    <option value="">Select</option>
                                                                    <option  {{ $post->earned_medals ==="1st / Gold"  ? 'selected' : '' }} value="1st / Gold">1st / Gold</option>
                                                                    <option  {{ $post->earned_medals ==="2nd / Silver"  ? 'selected' : '' }} value="2nd / Silver">2nd / Silver</option>
                                                                    <option  {{ $post->earned_medals ==="3rd / Bronze"  ? 'selected' : '' }} value="3rd / Bronze">3rd / Bronze</option>
                                                                </select>
                                                            </td>
                                                            <td style="width: 120px;">
                                                                <input type="text"  class="form-control dateTime" id="doc{{$key}}" onchange="checkDate({{$key}})" onpaste="return false;" ondrop="return false;" onkeypress="return false" autocomplete="off" required value="{{$post->competition_from_date}}" name="competition_from_date[]" data-language="en" placeholder="dd-mm-yyyy" required>
                                                            </td>
                                                            <td style="width: 120px;">
                                                                <input type="text" class="form-control dateTime"  id="{{$key}}to" onchange="checkDate({{$key}})" onpaste="return false;" ondrop="return false;" onkeypress="return false"  autocomplete="off" required value="{{$post->competition_to_date}}" name="competition_to_date[]" data-language="en" placeholder="dd-mm-yyyy" required>
                                                            </td>
                                                            <td><input type="text" required  name="place[]" value="{{$post->place }}" placeholder="Place" class="form-control name_email">
                                                            </td>
                                                            <td>
                                                                <div class="input-group">
                                                                    <input type="hidden" value="{{$post->award_certificate }}" name="award_certificate1[]">
                                                                    <input type="file" name="award_certificate[]" class="form-control" onchange="getfileext(this.value,3)" id="File3" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
                                                                    @if($post->award_certificate !='')
                                                                    @php
                                                                    $img = url('storage/position_holder').'/'.$post->award_certificate;
                                                                    $img1 = url('public/images/view.jpg');
                                                                    $doc = explode('.',$post->award_certificate);
                                                                    @endphp
                                                                    <img src="{{$img1}}" role="button" onclick="appendImage('{{$img}}','{{$doc[1]}}')" class="img-fluid" />
                                                                    @endif
                                                                </div>
                                                            </td>
                                                            <td><input type="text" required value="{{$post->event_details }}" name="event_details[]" placeholder="Event Detail" class="form-control"></td>
                                                            @if(!isset($competition_award_docs) || ($key == 0))
                                                            <td><button type="button" name="add" id="add" class="btn btn-primary mt-1">Add award</button></td>
                                                            @else
                                                            <td><button type="button" name="remove" id="k{{$key}}" class="btn btn-danger mt-1 px-2 btn_remove"><span class="far fa-trash-alt"></span></button></td>
                                                            @endif
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                </table>
                                            </div>
                                        </div>
                                       
                                        
                                        <div class="col-md-12">
                                            <h5 class="subheading">C. Bank Account Details/बैंक खाते का विवरण</h5>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="placeholder">4. IFSC<br>आईएफएससी<span class="text-danger">*</span></label>
                                                <input type="text" value="{{$item->bank_ifsc}}" pattern="[A-Z]{4}0[A-Z0-9]{6}" name="bank_ifsc" required class="form-control" onblur="getBankDetails(this.value)" id="ifscupper">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="placeholder">1. Name of Bank<br>बैंक का नाम<span class="text-danger">*</span></label>
                                                <input name="bank_name" value="{{$item->bank_name}}" required type="text" class="form-control" id="bankName">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="placeholder">2. Branch<br>शाखा<span class="text-danger">*</span></label>
                                                <input name="bank_branch" value="{{$item->bank_branch}}" required type="text" class="form-control" id="bank_branch">
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="placeholder">3. Bank Account No.<br>बैंक खाता संख्या<span class="text-danger">*</span></label>
                                                <input type="text" value="{{$item->bank_acc_no}}" pattern=".{9,18}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" name="bank_acc_no" required class="form-control">
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="placeholder">5. Account Holder Name<br>खाता धारक का नाम<span class="text-danger">*</span></label>
                                                <input type="text" value="{{$item->acc_holder_name}}" name="acc_holder_name" required class="form-control">
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label class="placeholder">6. Mobile No. (registered with Bank Account)<br>मोबाइल नंबर (बैंक खाते के साथ जो पंजीकृत है)<span class="text-danger">*</span></label>
                                                <input type="text" value="{{$item->mobile_registered_in_bank}}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');" name="mobile_registered_in_bank" required class="form-control">
                                            </div>
                                        </div>
                                        <div class="col-md-12">
                                            <h5 class="subheading">D. Other Details/अन्य विवरण</h5>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>1. Upload PAN<br> पैन अपलोड करें <span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="file" name="pan_doc" class="form-control" onchange="getfileext(this.value,5)" id="File5" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
                                                    <input type="hidden" name="pan_doc1" value="{{$item->pan_doc}}">
                                                    <!-- <a  class="btn btn-secondary" id="A4">View</a> -->
                                                    @if($item->pan_doc !='')
                                                    @php
                                                    $img = url('storage/position_holder').'/'.$item->pan_doc;
                                                    $img1 = url('public/images/view.jpg');
                                                    $doc = explode('.',$item->pan_doc);

                                                    @endphp
                                                    <img src="{{$img1}}" role="button" onclick="appendImage('{{$img}}','{{$doc[1]}}')" class="img-fluid" />
                                                    @endif
                                                </div>
                                                <span class="note">File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)<br>(फाइल का प्रारूप: JPEG/JPG | फाइल का अधिकतम साइज़: 2 MB)</span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>2. Sports certificate issued by the general secretary of the concerned sports association<br>संबंधित खेल संघ के महासचिव द्वारा जारी खेल प्रमाणपत्र<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="file" name="sport_certificate" class="form-control" onchange="getfileext(this.value,6)" id="File6" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
                                                    <input type="hidden" name="sport_certificate1" value="{{$item->sport_certificate}}">
                                                    <!-- <a  class="btn btn-secondary" id="A4">View</a> -->
                                                    @if($item->sport_certificate !='')
                                                    @php
                                                    $img = url('storage/position_holder').'/'.$item->sport_certificate;
                                                    $img1 = url('public/images/view.jpg');
                                                    $doc = explode('.',$item->sport_certificate);

                                                    @endphp
                                                    <img src="{{$img1}}" role="button" onclick="appendImage('{{$img}}','{{$doc[1]}}')" class="img-fluid" />
                                                    @endif
                                                </div>
                                                <span class="note">File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)<br>(फाइल का प्रारूप: JPEG/JPG | फाइल का अधिकतम साइज़: 2 MB)</span>
                                            </div>
                                        </div>
                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label>3. First Page of Bank Passbook<br>बैंक पासबुक का प्रथम पृष्ठ<span class="text-danger">*</span></label>
                                                <div class="input-group">
                                                    <input type="file" name="passbook_doc" class="form-control" onchange="getfileext(this.value,7)" id="File7" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
                                                    <input type="hidden" name="passbook_doc1" value="{{$item->passbook_doc}}">
                                                    <!-- <a  class="btn btn-secondary" id="A4">View</a> -->
                                                    @if($item->passbook_doc !='')
                                                    @php
                                                    $img = url('storage/position_holder').'/'.$item->passbook_doc;
                                                    $img1 = url('public/images/view.jpg');
                                                    $doc = explode('.',$item->passbook_doc);

                                                    @endphp
                                                    <img src="{{$img1}}" role="button" onclick="appendImage('{{$img}}','{{$doc[1]}}')" class="img-fluid" />
                                                    @endif
                                                </div>
                                                <span class="note">File Format: jpeg, jpg, Pdf | Max File Size: 2 MB)<br>(फाइल का प्रारूप: JPEG/JPG | फाइल का अधिकतम साइज़: 2 MB)</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="bhoechie-footer">
                                        <div class="row justify-content-center">
                                            <div class="col-md-4 d-grid">
                                                <button type="submit" class="btn btn-info">Save & Proceed/दर्ज करें व आगे बढ़ें</button>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
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
    $(document).ready(function() {
        // var year = $("#to").val().split('/');
        // var date_chekk = '04/01/' + year[2];
        // var date = new Date(date_chekk);
        // var endDay = new Date();
        // var millisBetween = endDay.getTime() - date.getTime();
        // var days = millisBetween / (1000 * 3600 * 24);
        // if (days > 1095) {
        //     $('#affidavit').show();
        //     $('#note5').show();
        // } else {
        //     $('#affidavit').hide();
        //     $('#note5').hide();
        // }
        //   if($('award_certificate_affidavit1').val() !=""){
        //     $('#affidavit').show();
        //     $('#note5').show();
        //   }
        //   else{
        //     $('#affidavit').hide();
        //     $('#note5').hide();
        //   }
        // $('#affidavit').hide();
        $("#submit").on('click', function(event) {
            var formdata = $("#add_name3").serialize();
            console.log(formdata);
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
    });
</script>
<script>
      
    $(document).ready(function() {
        // var start=$("#dob").val();
        var start = $("#dob").val();
        var end = (new Date()).getFullYear();
        var yrRange = (start + 9) + ":" + end;
        // console.log($("#dob").val());
        // console.log((new Date()).getFullYear());
        var checkkk = 0;

        $(".dateTime").datepicker({
				changeMonth: true,
				changeYear: true,
				// minDate: '-60Y',
				minDate: new Date(start, 4 - 1, 1),
				yearRange: yrRange,
				maxDate: '0',
				dateFormat: 'dd-mm-yy'
			});
        
        var i = 100;
        
        //var addamount = 0;
        var addamount = 700;
        $("#add3").click(function() {
           
            i++;
            $('#dynamic_field3').append('<tr id="row' + i + '"><td><div class="input-group"><input type="file" name="award_certificate_add[]" class="form-control"  required onchange="getfileext(this.value,3' + i + ')" id="File3' + i + '" aria-describedby="inputGroupFileAddon05" aria-label="Upload" ></div></td><td><button type="button" name="remove" id="' + i + '" class="btn btn-danger mt-1 px-2 btn_remove"><span class="far fa-trash-alt"></span></button></td></tr>');
        });

        $("#add").click(function() {
			
			$('#dynamic_field').append('<tr id="row' + i + '"><td><select name="competition_name[]" onchange="get_event(' + i + ')" required class="form-select competition_name" class="form-control name_list"><option value="">Select</option>@foreach ($competition as $type) <option  value="{{$type->id}}">{{$type->name}}</option> @endforeach</td><td><select onchange="get_event(' + i + ')" class="form-select event_type" name="event_type[]" required=""><option value="">Select</option><option value="1">Individual</option><option value="2">Team</option><option value="3">Both</option></select></td><td><select class="form-select event_name" name="event_name[]" required=""> <option value="">Select</option>  </select></td><td><select class="form-select" name="earned_medals[]" required> <option value="">Select</option> <option   value="1st / Gold">1st / Gold</option> <option value="2nd / Silver">2nd / Silver</option> <option  value="3rd / Bronze">3rd / Bronze</option></select></td><td><input type="text" class="form-control firstDate dateTime" onchange="checkDate('+i+')" onpaste="return false;" ondrop="return false;" onkeypress="return false" id="doc' + i + '" autocomplete="off" required   name="competition_from_date[]" data-language="en" placeholder="dd-mm-yyyy" required></td><td><input type="text" class="form-control to-to-to dateTime"  onchange="checkDate('+i+')" onpaste="return false;" ondrop="return false;" onkeypress="return false" id="' + i + 'to" autocomplete="off" required  name="competition_to_date[]" data-language="en" placeholder="dd-mm-yyyy" required></td><td><input type="text" required  name="place[]" placeholder="Place" class="form-control name_email"></td><td><div class="input-group"><input type="file" name="award_certificate[]" required class="form-control"   onchange="getfileext(this.value,2' + i + ')" id="File2' + i + '" aria-describedby="inputGroupFileAddon05" aria-label="Upload"></div></td><td><input type="text" required value="" name="event_details[]" placeholder="Event Detail" class="form-control"></td><td><button type="button" name="remove" id="' + i + '" class="btn btn-danger mt-1 px-2 btn_remove"><span class="far fa-trash-alt"></span></button></td></tr>');
			var start = $("#dob").val();
			var end = (new Date()).getFullYear();
			var yrRange = start + ":" + end;
			var checkkk = 0;
			$(".dateTime").datepicker({
				changeMonth: true,
				changeYear: true,
				// minDate: '-60Y',
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
    function get_event(id) {
        // var attdata = $("#event_sel"+id).data('id');
        var data=$("#event_sel"+id).val();
        // if(attdata =="" || attdata != data ){
        //     $("#event_sel"+id).data(id);
        //     $("#event_sel"+id).data("id", id);
        //     console.log(id);
		var comp=$("#row"+id+" .competition_name").val();
		var event_type=$("#row"+id+" .event_type").val();
        let option = `<option value=''>Select</option>`;
        $.ajax({
            type: "POST",
            url: "{{url('get_position_event')}}",
            data: {
                comp:comp,event_type:event_type
            },
            success: function(response) {
                response.forEach((item) => {
                    ///setTimeout(() => {
                    if(data==item.id){
                        option += `<option selected value="${item.id}" >${item.name}</option>`;
                    }
                    else{
                        option += `<option value="${item.id}" >${item.name}</option>`;
                    }
                        
                   
                    ///}, 20)
                });
                $("#row"+id+" .event_name").empty();
                $("#row"+id+" .event_name").append(option);
            }
        });
        // }
		
        
       
    }

    
</script>
@endpush
