@extends('layouts/admin_layout')
@section('content')
    <div class="row">
        <div class="col-12">
            <div class="bhoechie-tab-container">
                <div class="row">
                    <h4 class="mb-2"> &nbsp;
                        <button type="button" data-print="modal" class="btn btn-sm  btn-outline-primary ms-2 float-end "
                            onclick="PrintDoc()" style="width: auto;"><span class="icons icon-printer"></span></button>
                    </h4>
                    <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                        <div class="bhoechie-tab-menu">
                            <div class="list-group">
                                <a class="list-group-item active" style="width: 100%;">
                                    <span class="fas fa-file-pdf"></span>
                                    Application to Eklavya Krida Kosh
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bhoechie-tab">
                    <div class="bhoechie-tab-content active">
                        <div class="form-scroll">
                            <div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="profile-head">
                                            <div class="tab-content profile-tab" id="myTabContent">
                                                <div class="tab-pane fade show active" id="home" role="tabpanel"
                                                    aria-labelledby="home-tab">
                                                    <div class="row">
                                                        <div class="col-md-12" id="prodiv">
                                                            <table class="dn" style="width: 100%; margin-bottom: 5px;"
                                                                border="0">
                                                                <tr>
                                                                    <td colspan="2" align="center"
                                                                        style="position: relative; border: 0; padding-bottom: 5px;">
                                                                        <div
                                                                            style="border-bottom: 0px solid #000; padding-bottom: 2vw;">
                                                                            <img id="logo"
                                                                                src="{{ asset('') }}/assets_admin/images/logo.png"
                                                                                style="display:none;position: absolute; width: 70px; top: -7px; left: 0;" />
                                                                            <div
                                                                                style="font-size: 25px; font-weight: bold;">
                                                                                <!-- Department of Sports -->
                                                                                Khel Sathi Portal / खेल साथी पोर्टल
                                                                            </div>
                                                                            <div
                                                                                style="font-size: 18px; font-weight: bold;">
                                                                                Government of Uttar Pradesh/उत्तर प्रदेश
                                                                                सरकार
                                                                            </div>
                                                                            <div
                                                                                style="font-size: 18px; font-weight: bold;">
                                                                                Application Form for Eklavya Krida Kosh/एकलव्य क्रीड़ा कोष के लिए नामांकन हेतु आवेदन </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                            
                                                            @foreach ($articles as $article)
                                                                <p class="bg-light"><strong>Application no. / आवेदन
                                                                        क्रमांक:-</strong>
                                                                    <b>{{ $article->application_no }}</b>
                                                                </p>
                                                                <table id="dataTable" class="table table-bordered"
                                                                    border="1"
                                                                    style="border-collapse: collapse; width: 100%;">
                                                                    <tr>
                                                                        <td colspan="6" class="bg-light">
                                                                            <strong>Basic Details/सामान्य विवरण</strong>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td style="width: 15%"><strong> Purpose/उद्देश्य</strong>
                                                                        </td>
                                                                        <td style="width: 20%">{{ $article->purpose }}</td>
                                                                        <td style="width: 15%"><strong>Full Name/पूरा नाम</strong>
                                                                        </td>
                                                                        <td style="width: 20%">{{ $article->fullname }}</td>
                                                                        <td rowspan="4" colspan="2">
                                                                            <div class="text-center" style="padding: 5px;"
                                                                                align="center"> <img
                                                                                    src="{{ asset('storage/award') . '/' . $article->photograph_doc }}"
                                                                                    class="img-fluid"
                                                                                    style="width: 140px;" /> </div>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><strong>Email ID/ईमेल पता </strong></td>
                                                                        <td>{{ $article->email }}</td>
                                                                        <td><strong>Mobile Number/मोबाइल नंबर</strong></td>
                                                                        <td>{{ $article->mobile }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="4" class="bg-light"><strong>Personal
                                                                                Details/व्यक्तिगत विवरण</strong>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><strong>Father Name/पिता का नाम</strong></td>
                                                                        <td>{{ $article->father_name }}</td>
                                                                        <td><strong>Mother Name/माता का नाम</strong></td>
                                                                        <td>{{ $article->mother_name }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><strong>Gender/लिंग</strong></td>
                                                                        <td>{{$article->gender}} </td>
                                                                        <td><strong>Date of Birth/जन्म तिथि</strong></td>
                                                                        <td>{{ $article->dob }}</td>
                                                                        <td><strong>Aadhaar No./आधार कार्ड</strong></td>
                                                                        <td>{{ $article->aadhar_no }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                       
                                                                        <td><strong>Nationality/राष्ट्रीयता</strong></td>
                                                                        <td>{{ $article->nationality }}</td>
                                                                        <td><strong>Alternate Phone Number/वैकल्पिक फ़ोन नंबर</strong></td>
                                                                        <td>{{ $article->mobile }}</td>
                                                                        <td><strong>Sports Name/खेल का नाम</strong></td>
                                                                        <td>{{ $article->sport_name }}</td>

                                                                    </tr>





                                                                    <tr>
                                                                        <td colspan="6" class="bg-light"><strong>Permanent Address</strong>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><b>Flat No. / House No. / फ़्लैट नं./मकान नं.</td>
                                                                        <td>{{$article->permanent_flat_no}}</td>
                                                                        <td><b>Complete Address / पूर्ण पता</td>
                                                                        <td>{{ $article->permanent_address }}</td>
                                                                        <td><b>District / ज़िला</b></td>
                                                                        <td>{{ districtName($article->permanent_district) }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><b>Pincode / पिन कोड</b></td>
                                                                        <td>{{ $article->permanent_pincode }}</td>
                                                                        <td><b>State/राज्य</b></td>
                                                                        <td>Uttar Pradesh</td>
                                                                    </tr>

                                                                    <td colspan="6"><strong>Correspondence
                                                                            Address</strong></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><b>Flat No. / House No. / फ़्लैट नं./मकान नं.</td>
                                                                        <td>{{$article->present_flat_no}}</td>
                                                                        <td><b>Complete Address / पूर्ण पता</td>
                                                                        <td>{{ $article->present_address }}</td>
                                                                        <td><b>District / ज़िला</b></td>
                                                                        <td>{{ districtName($article->present_district) }}</td>
                    
                                                                    </tr>
                                                                    <tr>
                                                                        <td><b>Pincode / पिन कोड</b></td>
                                                                        <td>{{ $article->present_pincode }}</td>
                                                                        <td><strong>State/राज्य</strong></td>
                                                                        <td>{{ stateName($article->present_state) }}</td>
                                                                        <td>&nbsp;</td>
                                                                        <td>&nbsp;</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="6" class="bg-light"><strong>Educational
                                                                                Qualification & Certificate/शिक्षात्मक & योग्यता प्रमाण पत्र</strong></td>
                                                                    </tr>


                                                                    <tr>
                                                                        <td colspan="6">
                                                                            <table class="table table-bordered table-sm">
                                                                                <thead>
                                                                                    <tr style="background-color: #dfdacd;">
                                                                                        <th style="width:5%">S.No. / क्र.सं.</th>
                                                                                        <th>Class / कक्षा</th>
                                                                                        <th style="width:10%">Upload</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td>1</td>
                                                                                        <td>High School Certificate/हाई स्कूल प्रमाण पत्र</td>
                                                                                        <td><a href="{{ asset('eklavya_krida_kosh/high_school_certificate/') }}/{{ $article->high_school_certificate }}"
                                                                                                target="_blank" download
                                                                                                class="btn btn-success btn-xs">Uploaded</a>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>2</td>
                                                                                        <td>Highest Education Qualification/उच्चतम शैक्षणिक योग्यता</td>
                                                                                        <td>
                                                                                            @if ($article->qualification == '10')
                                                                                                10th/High School
                                                                                            @elseif($article->qualification == '12')
                                                                                                12th / Intermediate
                                                                                            @elseif($article->qualification == 'graduation')
                                                                                                Graduation
                                                                                            @elseif($article->qualification == 'post_graduation')
                                                                                                Post-Graduation
                                                                                            @elseif($article->qualification == 'diploma')
                                                                                                Diploma (NIS/LNIPE)
                                                                                            @elseif($article->qualification == 'researcher')
                                                                                                Researcher
                                                                                                 @elseif($article->qualification == 'other')
                                                                        Other
                                                                                            @endif
                                                                                            @if($article->qualification == 'other') </br> {{$article->other_qualification}}  @endif


                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>3</td>
                                                                                        <td>Highest Education Qualification Certificate/उच्चतम शैक्षणिक योग्यता प्रमाण पत्र</td>
                                                                                        <td><a href="{{ asset('eklavya_krida_kosh/highest_qualification_certificate/') }}/{{ $article->highest_qualification_certificate }}"
                                                                                                target="_blank" download
                                                                                                class="btn btn-success btn-xs">Uploaded</a>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>4</td>
                                                                                        <td>Domicile Certificate of UP/यूपी का निवास प्रमाण पत्र</td>
                                                                                        <td><a href="{{ asset('eklavya_krida_kosh/domicile_certificate/') }}/{{ $article->domicile_certificate }}"
                                                                                                target="_blank" download
                                                                                                class="btn btn-success btn-xs">Uploaded</a>
                                                                                        </td>
                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td>5</td>
                                                                                        <td> Notary Affidavit/ नोटरी शपथ पत्र 
                                                                                        </td>
                                                                                        <td>@if(isset($article->notary_affidavit_doc))
                                                                                            <a href="{{ asset('eklavya_krida_kosh/notary_affidavit_doc/') }}/{{ $article->notary_affidavit_doc }}"
                                                                                                target="_blank" download
                                                                                                class="btn btn-success btn-xs">Uploaded</a>
                                                                                                @endif
                                                                                            </td>
                                                                                    </tr>
                                                                                </tbody>
                                                                            </table>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="6" class="bg-light"><strong>Awards &
                                                                                Achievements/पुरस्कार और उपलब्धियां</strong></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="6">
                                                                            <table
                                                                                class="table table-bordered table-sm awardtable">
                                                                                <thead>
                                                                                    <tr>
                                                                                        <td rowspan="2"><label>Type of
                                                                                                Competition
                                                                                                <br>प्रतियोगिता का
                                                                                                प्रकार</label> <span
                                                                                                class="text-danger">*</span>
                                                                                        </td>
                                                                                        <td rowspan="2"><label>Event
                                                                                                Type<br>आयोजन का
                                                                                                प्रकार</label> <span
                                                                                                class="text-danger">*</span>
                                                                                        </td>
                                                                                        <td rowspan="2"><label>Event
                                                                                                Name<br>आयोजन का नाम</label>
                                                                                            <span
                                                                                                class="text-danger">*</span>
                                                                                        </td>
                                                                                        <td rowspan="2"><label>Earned
                                                                                                Medals<br>अर्जित पदक</label>
                                                                                            <span
                                                                                                class="text-danger">*</span>
                                                                                        </td>
                                                                                        <td colspan="2"
                                                                                            class="text-center">
                                                                                            <label>Period of
                                                                                                Competition<br>प्रतियोगिता
                                                                                                की अवधि</label> <span
                                                                                                class="text-danger">*</span>
                                                                                        </td>
                                                                                        <td rowspan="2"><label>Venue
                                                                                                Name</br>स्थल का
                                                                                                नाम</label> <span
                                                                                                class="text-danger">*
                                                                                                </span< /td>
                                                                                        <td rowspan="2"><label>Upload
                                                                                                Relevant
                                                                                                Certificate<br>प्रासंगिक
                                                                                                प्रमाण पत्र अपलोड
                                                                                                करें<span
                                                                                                    class="text-danger">*</span>
                                                                                            </label>
                                                                                        </td>
                                                                                        <td rowspan="2"><label>Sport
                                                                                                Event Detail</br>खेलकूद
                                                                                                प्रतियोगिता का विवरण<span
                                                                                                    class="text-danger">*</span></label>
                                                                                        </td>

                                                                                    </tr>
                                                                                    <tr>
                                                                                        <td><label>From </label>
                                                                                        </td>
                                                                                        <td><label>To </label>
                                                                                        </td>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>

                                                                                    @foreach ($sport_achievement as $item)
                                                                                        <tr>
                                                                                            <td class="form-group">
                                                                                                {{ $item->comp }}
                                                                                            </td>
                                                                                            <td>
                                                                                                @if ($item->event_type == 1)
                                                                                                    Individual
                                                                                                @elseif($item->event_type == 2)
                                                                                                    Team
                                                                                                @else
                                                                                                    Both
                                                                                                @endif
                                                                                            </td>
                                                                                            <td>{{ $item->event }}</td>
                                                                                            <td>{{ $item->earned_medals }}
                                                                                            </td>
                                                                                            <!--  -->
                                                                                            <td>
                                                                                                {{ $item->competition_from_date }}
                                                                                            </td>
                                                                                            <td>
                                                                                                {{ $item->competition_to_date }}
                                                                                            </td>
                                                                                            <td>
                                                                                                {{ $item->sport_place }}
                                                                                            </td>
                                                                                            <td style="text-align:center">
                                                                                                @if ($item->sport_achievement_docs != '')
                                                                                                    <a href="{{ url('storage/eklavya_kreeda_kosh', $item->sport_achievement_docs) }}"
                                                                                                        download target="_blank">
                                                                                                        <!-- <span class="btn btn-success btn-xs"> Uploaded</span> -->
                                                                                                        <i
                                                                                                            class="fa fa-download"></i>
                                                                                                    </a>
                                                                                                @else
                                                                                                    <strong
                                                                                                        class="btn btn-danger btn-xs">Not
                                                                                                        Uploaded</strong>
                                                                                                @endif
                                                                                            </td>
                                                                                            <td>
                                                                                                {{ $item->event_details }}
                                                                                            </td>
                                                                                            <!--  -->
                                                                                        </tr>
                                                                                    @endforeach

                                                                                </tbody>
                                                                            </table>


                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="6" class="bg-light">
                                                                            <strong>Bank Details/बैंक खाते का विवरण</strong>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="6">
                                                                            <table class="table table-bordered table-sm">
                                                                                <thead>
                                                                                    <tr style="background-color: #dfdacd;">
                                                                                        <th style="width:25%">Bank Name/बैंक का नाम </th>
                                                                                        <th style="width:25%">IFSC Code/आईएफएससी कोड</th>
                                                                                        <th style="width:25%">Branch/शाखा</th>
                                                                                        <th style="width:25%">Bank Account Number/बैंक खाता संख्या</th>
                                                                                        <th style="width:25%">Front page of Passbook/पासबुक का फ्रंट पेज</th>
                                                                                    </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    <tr>
                                                                                        <td>{{ $article->bank_name }}</td>
                                                                                        <td>{{ $article->ifsc_code }}</td>
                                                                                        <td>{{ $article->bank_branch }}</td>
                                                                                        <td>{{ $article->account_no }}</td>
                                                                                        <td><a href="{{ asset('eklavya_krida_kosh/front_page_of_passbook/') }}/{{ $article->front_page_of_passbook }}"
                                                                                                target="_blank" download
                                                                                                class="btn btn-success btn-xs">Uploaded</a>
                                                                                        </td>
                                                                                    </tr>

                                                                                </tbody>
                                                                            </table>
                                                                        </td>
                                                                    </tr>

                                                                    <tr>
                                                                        <td colspan="6" class="bg-light">
                                                                            <strong>Declaration/घोषणा</strong>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td align="center">
                                                                            <input
                                                                                {{ $article->final_submit == 1 ? 'disabled' : '' }}
                                                                                {{ $article->final_submit == 1 ? 'checked' : '' }}
                                                                                type="checkbox" id="checkbox" />
                                                                            &nbsp; <b>I Agree</b>
                                                                        </td>
                                                                        <td colspan="5">I hereby certify that all the
                                                                            above facts are true and correct to the best of
                                                                            my knowledge. If any particulars given by me are
                                                                            found to be incorrect, I shall be held liable to
                                                                            refund the entire amount of Financial Assistance
                                                                            which has been/will be sanctioned to me on the
                                                                            basis of incorrect facts.<br>मैं एतद्द्वारा
                                                                            घोषणा करता/करती हूं कि मैंने आवेदन से संबंधित
                                                                            सभी नियम और शर्तें, पात्रता मानदंड और अन्य
                                                                            प्रासंगिक जानकारी पढ़ ली हैं एवं उनका पालन
                                                                            करता/करती हूं। मैं यह भी घोषणा करता/करती हूं कि
                                                                            उपरोक्त सभी विवरण मेरे अनुसार सत्य व सही हैं।
                                                                            यदि मेरा कोई भी तथ्य गलत अथवा असत्य पाया जाता
                                                                            है, तो मेरा आवेदन अस्वीकृत किया जा सकता है और
                                                                            इसके लिए पूर्णतः मैं स्वयं उत्तरदायी ठहराया
                                                                            जाऊंगा/जाऊंगी।
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="3" align="center">
                                                                            <span>Date/तिथि</span><br>
                                                                            <b>{{ dmy($article->created_at) }}</b>
                                                                        </td>
                                                                        <td colspan="3" align="center">
                                                                            <img src="{{ asset('storage/award') . '/' . $article->signature_doc }}"
                                                                                class="img-fluid"
                                                                                style="width: 140px; height: 50px;"><br>
                                                                            <b>Signature/हस्ताक्षर</b>
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <?php
                                                                if ($article->form_status == 1 || $article->form_status == 2 || $query_s != 0) { ?>
                                                                        @if ($article->form_status == 1)
                                                                            <td colspan="6" align="center">
                                                                                <b>Form Status :-</b> <span
                                                                                    class="btn btn-success disabled btn-sm ml-5">Accepted</span>
                                                                            </td>
                                                                        @elseif($article->form_status == 2)
                                                                            <td colspan="6" align="center">
                                                                                <b>Form Status :-</b> <span
                                                                                    class="btn btn-danger btn-sm ml-5">Rejected</span> by 
                                                                                    @if($article->is_forwarded_by_association ==0) Association 
                                                                                    @elseif($article->is_forwarded_by_association ==1 && $article->is_forwarded_by_rso==0) SO/RSO
                                                                                    @else Prize Money Admin @endif
                                                                            </td>
                                                                        @else
                                                                            <td colspan="3" class="noprint"
                                                                                align="center">
                                                                                <b>Form Status :-</b> <span
                                                                                    class="btn btn-danger btn-sm ml-5">Pending</span>
                                                                            </td>
                                                                            <td colspan="3" class="noprint"
                                                                                align="center">
                                                                                <b>Action:- </b> &nbsp;
                                                                                @if (Auth::guard('admin')->user()->admin_role == 1 || Auth::guard('admin')->user()->admin_role == 17 || Auth::guard('admin')->user()->admin_role == 9  || Auth::guard('admin')->user()->admin_role == 2)
                                                                                    <a href="#"
                                                                                        class="btn btn-info btn-sm @if ($query_s == 1) disabled @endif"
                                                                                        data-bs-toggle="modal"
                                                                                        data-bs-target="#query_form_marked">Mark
                                                                                        Query</a>
                                                                                @endif
                                                                                @if (Auth::guard('admin')->user()->admin_role == 1 || Auth::guard('admin')->user()->admin_role == 17 )
                                                                                    <?php $da = 'disabled';
                                                                                    if (isset($article->is_forwarded_by_rso) && $article->is_forwarded_by_rso == 1) {
                                                                                        $da = '';
                                                                                    } ?>
                                                                                    <a href="#"
                                                                                        class="btn btn-success disabled btn-sm {{ $da }}"
                                                                                        data-bs-toggle="modal"
                                                                                        data-bs-target="#Subapp">Accept</a>
                                                                                    <a href="#"
                                                                                        class="btn btn-danger disabled btn-sm {{ $da }}"
                                                                                        data-bs-toggle="modal"
                                                                                        data-bs-target="#Rejectapp">Reject</a>
                                                                                @endif
                                                                            </td>
                                                                        @endif
                                                                        <?php } else { ?>
                                                                        <td colspan="3" class="noprint"
                                                                            align="center">
                                                                            <b>Form Status :-</b> <span
                                                                                class="btn btn-danger btn-sm ml-5">Pending</span>
                                                                        </td>
                                                                        @if(Auth::guard('admin')->user()->admin_role !=18)
                                                                        <td colspan="3" class="noprint"
                                                                            align="center">
                                                                            @if (Auth::guard('admin')->user()->admin_role == 1 || Auth::guard('admin')->user()->admin_role == 17|| Auth::guard('admin')->user()->admin_role == 3 || Auth::guard('admin')->user()->admin_role == 9  || Auth::guard('admin')->user()->admin_role == 2)
                                                                            <b>Action:- </b> &nbsp; 
                                                                            <?php $da = '';
                                                                                if (isset($article->is_forwarded_by_association) && $article->is_forwarded_by_association == 1 && (Auth::guard('admin')->user()->admin_role == 3)) {
                                                                                    $da = 'disabled';
                                                                                 }elseif(isset($article->is_forwarded_by_rso) && $article->is_forwarded_by_rso == 1 && (Auth::guard('admin')->user()->admin_role == 2 || Auth::guard('admin')->user()->admin_role == 9)){
                                                                                    $da = 'disabled';
                                                                                 } 
                                                                                ?> 
                                                                            <a href="#"
                                                                                    class="btn btn-info btn-sm {{$da}} @if ($query_s == 1) disabled @endif"
                                                                                    data-bs-toggle="modal"
                                                                                    data-bs-target="#query_form_marked">Mark
                                                                                    Query</a>
                                                                                    <a href="#"
                                                                                        class="btn btn-danger btn-sm {{$da}} "
                                                                                        data-bs-toggle="modal"
                                                                                        data-bs-target="#Rejectapp">Reject</a>
                                                                            @endif
                                                                            @if (Auth::guard('admin')->user()->admin_role == 17 )
                                                                                <?php $da = 'disabled';
                                                                                if (isset($article->is_forwarded_by_rso) && $article->is_forwarded_by_rso == 1) {
                                                                                    $da = '';
                                                                                } ?>
                                                                                {{-- <b>Action:- </b> &nbsp; --}}
                                                                                <a href="#"
                                                                                    class="btn btn-success btn-sm {{ $da }}"
                                                                                    data-bs-toggle="modal"
                                                                                    data-bs-target="#Subapp">Accept</a>
                                                                               
                                                                            @endif
                                                                        </td>
                                                                        @endif
                                                                        <?php } ?>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="6">@if($article->form_status == 1 || $article->form_status == 2)Remark :- <span class="{{ $article->form_status == 1 ? 'text-success' : 'text-danger' }}">{!!$article->remark!!} <br> {!!$article->other_remark!!}</span>@endif</td>
                                                                    </tr>

                                                                </table>
                                                                <div class="accordion" id="accordionChat">
                                                                    <div class="accordion-item">
                                                                        <?php
                                                                        $check_name = 0;
                                                                        $class = 'out';
                                                                        ?>
                                                                        {{-- {{dd(Auth::guard('admin')->user())}} --}}
                                                                        @foreach ($comment_data as $key => $item)
                                                                            @if ($key == 0)
                                                                                <h2 class="accordion-header"
                                                                                    id="headingOne">
                                                                                    <button
                                                                                        class="accordion-button collapsed"
                                                                                        type="button"
                                                                                        data-bs-toggle="collapse"
                                                                                        data-bs-target="#collapseOne"
                                                                                        aria-expanded="false"
                                                                                        aria-controls="collapseOne">
                                                                                        <div class="subj">
                                                                                            <h6
                                                                                                class="text-uppercase fw-bold mb-1">
                                                                                                Supporting Document By
                                                                                                Association
                                                                                            </h6>
                                                                                        </div>
                                                                                    </button>
                                                                                </h2>
                                                                                <div id="collapseOne"
                                                                                    class="accordion-collapse collapse show"
                                                                                    aria-labelledby="headingOne"
                                                                                    data-bs-parent="#accordionChat">
                                                                                    <div class="accordion-body">
                                                                            @endif
                                                                            <div class="row">
                                                                                <div class="col-md-12">
                                                                                    <ul class="chat-list">

                                                                                        @if (!empty($item->comments))
                                                                                            <?php
                                                                                            if ($item->sender_id != $check_name && $class == 'in') {
                                                                                                $class = 'out';
                                                                                            } elseif ($item->sender_id == $check_name && $class == 'in') {
                                                                                                $class = 'in';
                                                                                            } elseif ($item->sender_id == $check_name && $class == 'out') {
                                                                                                $class = 'out';
                                                                                            } else {
                                                                                                $class = 'in';
                                                                                            }
                                                                                            ?>

                                                                                            <li class={{ $class }}>

                                                                                                <div class="chat-img">
                                                                                                    <img alt="Avtar"
                                                                                                        src="{{ asset('storage/direct_recruitment/profile.jpg') }}">
                                                                                                </div>
                                                                                                @php $check_name=$item->sender_id; @endphp
                                                                                                <div class="chat-body">
                                                                                                    <div
                                                                                                        class="chat-message">
                                                                                                        <h5 class="name">
                                                                                                            {{ rsoName($item->sender_id) }}
                                                                                                            @if (!empty($item->doc))
                                                                                                                <a class="doc_download"
                                                                                                                    href="{{ url('public/verification_document', $item->doc) }}"
                                                                                                                    download
                                                                                                                    target="_blank"><i
                                                                                                                        class="fa fa-download attachfile"></i></a>
                                                                                                            @endif
                                                                                                        </h5>
                                                                                                        <p class="comment">
                                                                                                            {{ $item->comments }}
                                                                                                        </p>
                                                                                                    </div>
                                                                                                    <div>
                                                                                                        <small
                                                                                                            class="text-muted"><b>Reply
                                                                                                                On:
                                                                                                                {{ dmyHi($item->created_at) }}</b></small>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </li>
                                                                                            <!-- <li class="out">
                                                                                                <div class="chat-img">
                                                                                                    <img alt="Avtar" src="{{ asset('storage/direct_recruitment/') . '/' . $article->photograph_doc }}">
                                                                                                </div>
                                                                                                <div class="chat-body">
                                                                                                    <div class="chat-message">
                                                                                                        <h5><a  href="{{ url('public/verification_document', $item->doc) }}" download target="_blank"><i class="fa fa-download attachfile"></i></a> {{ rsoName($item->sender_id) }}</h5>
                                                                                                        <p>{{ $item->comments }}</p>
                                                                                                    </div>
                                                                                                    <div>
                                                                                                        <small class="text-muted"><b>Reply On: 19 February, 2023 16:39 PM</b></small>
                                                                                                    </div>
                                                                                                </div>
                                                                                            </li> -->
                                                                                        @else
                                                                                            <div class="text-danger"> Not
                                                                                                Uploaded</div>
                                                                                        @endif
                                                                                    </ul>
                                                                                </div>
                                                                            </div>
                                                                            <div class="separator-dashed"></div>
                                                                        @endforeach
                                                                        
                                                                        <?php
                                                                        $sss = 0;
                                                                        if (Auth::guard('admin')->user()->admin_role == 3 && $article->is_forwarded_by_association >= 1) {
                                                                            $sss = 1;
                                                                        }
                                                                        $tt = get_last_reply($article->application_no);
                                                                        ?>
                                                                        
                                                                        @if (isset($article->form_status) && $article->form_status == 0)
                                                                            @if ($tt && Auth::guard('admin')->user()->id != $tt->sender_id )
                                                                                {{-- @if ($tt->type == 2) --}}
                                                                                @if ($tt->type != 2)
                                                                                <div class="row mb-3">
                                                                                    <div class="col-md-12 text-end">
                                                                                        <a class="btn btn-primary btn-xs rplbtn reply" onclick="set_reply_data({{$tt->sender_id}},{{$tt->reciever_id}})" data-bs-toggle="modal" data-bs-target="#query_form_admin""><span class=" fa fa-reply fa-1x"></span> Reply </a>
                                                                                    </div>
                                                                                </div>
                                                                                @else
                                                                                <div class="row mb-3">
                                                                                    <div class="col-md-12 text-end">
                                                                                        <a class="btn btn-primary btn-xs rplbtn reply" onclick="set_reply_data({{$tt->sender_id}},{{$tt->reciever_id}})" data-bs-toggle="modal" data-bs-target="#reply_of_query"><span class="fa fa-reply fa-1x"></span> Reply </a>
                                                                                    </div>
                                                                                </div>
                                                                                @endif
                                                                            @endif
                                                                        @endif
                                                            @endforeach
                                                            {{-- @if (Auth::guard('admin')->user()->admin_role != 1 && Auth::guard('admin')->user()->admin_role != 4)
                                                                @if ($article->form_status == 1 || $article->form_status == 2) --}}
                                                            @if (count($queryData) > 0)
                                                                <x-query-details :queryData="$queryData" />
                                                            @endif
                                                            {{-- @else
                                                                <x-query-details :queryData="$queryData" />
                                                                @endif
                                                                @endif --}}
                                                            {{-- <x-query-details :queryData="$queryData" /> --}}
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
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


<x-marked-query :id="$id" :type="7" />

<!--For Reject Application-->
<div class="modal fade" id="Rejectapp" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Reject Application</h5>
                <!--<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
            </div>
            <form action="{{ route('financial_is_rejected') }}" method="post">
                @csrf
                <div class="modal-body">
                    <h3 class="text-center">Are you sure to Reject the Application? Action once taken cannot be
                        reverted.</h3>
                    <input type="hidden" name="user_id"
                        @if (isset($articles[0]->application_no)) value="{{ $articles[0]->application_no }}" @endif>
                    <input type="hidden" name="form_type" value="7">
                    <div class="form-group">
                        <label class="placeholder">Remark</label>
                        <select required multiple name="remark[]" id="remark">
                            {{-- <option value="">--select--</option> --}}
                            <option value="निवास प्रमाण पत्र संलग्न नहीं है।">1.	निवास प्रमाण पत्र संलग्न नहीं है।</option>
                            <option value="शपथ पत्र संलग्न नहीं है।">2.	शपथ पत्र संलग्न नहीं है।</option>
                            <option value="खेल प्रमाण पत्र संलग्न नहीं है।">3.	खेल प्रमाण पत्र संलग्न नहीं है।</option>
                            <option value="खेल प्रमाण पत्र पर अर्जित उपलब्धि शासनादेश दिनांक 30/12/2021 से पूर्व की है।">4.	खेल प्रमाण पत्र पर अर्जित उपलब्धि शासनादेश दिनांक 30/12/2021 से पूर्व की है।</option>
                            <option value="आवेदनकर्ता द्वारा केवल प्रतिभाग किया गया है, उपलब्धि अर्जित नहीं है।">5.	आवेदनकर्ता द्वारा केवल प्रतिभाग किया गया है, उपलब्धि अर्जित नहीं है।</option>
                            <option value="शासनाादेश के अनुसार प्रतियोगिता अनुमन्य नहीं है।">6.	शासनाादेश के अनुसार प्रतियोगिता अनुमन्य नहीं है।</option>
                            <option value="other">Other</option>
                        </select>

                        <!-- Hidden input field for custom remark -->
                        <input type="text" name="other_remark" id="other_remark" class="form-control mt-2" style="display:none;" placeholder="Enter your remark here">
                        {{-- <textarea required name="remark" rows="3" class="form-control" cols="40"></textarea> --}}
                    </div>
                </div>
                <div class="modal-footer">
                    <!--<button type="button" class="btn btn btn-outline-danger"><span class="icons icon-cloud-download"></span> Download</button>-->
                    <button type="submit" class="btn btn-info">Yes</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--For Submit Application-->
<div class="modal fade" id="Subapp" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Accept Application</h5>
                <!--<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
            </div>
            <form action="{{ route('financial_is_accepted') }}" method="post">
                @csrf
                <div class="modal-body">
                    <h3 class="text-center">Are you sure to Accept the Application? Action once taken cannot be
                        reverted.</h3>
                    <input type="hidden" name="user_id"
                        @if (isset($articles[0]->application_no)) value="{{ $articles[0]->application_no }}" @endif>
                    <input type="hidden" name="form_type" value="7">
                    <div class="form-group">
                        <label class="placeholder">Remark</label>
                        <select required name="remark" id="remark">
                            <option value="सभी पात्रताएं पूर्ण है, आर्थिक सहायता प्रदान किये जाने हेतु संस्तुति प्रदान की जाती है |">1.	सभी पात्रताएं पूर्ण है, आर्थिक सहायता प्रदान किये जाने हेतु संस्तुति प्रदान की जाती है |</option>
                        </select>
                        {{-- <textarea name="remark" rows="3" class="form-control" cols="40"></textarea> --}}
                    </div>
                </div>
                <div class="modal-footer">
                    <!--<button type="button" class="btn btn btn-outline-danger"><span class="icons icon-cloud-download"></span> Download</button>-->
                    <button type="submit" class="btn btn-info">Yes</button>
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!--Query Document By Adminstrator-->
<div class="modal fade" id="query_form_admin" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Query For Supporting Document</h5>
                <!--<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
            </div>
            <form action="{{ route('save_query_for_supporting_document') }}" method="post"
                enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="user_id"
                        @if (isset($articles[0]->application_no)) value="{{ $articles[0]->application_no }}" @endif />
                    <input type="hidden" name="form_type" value="7">
                    <input type="hidden" class="sender_id" name="sender_id" value="">
                    <input type="hidden" class="reciever_id" name="reciever_id" value="">

                    <label class="placeholder">Remark <span class="text-danger">*</span></label>
                    <textarea class="form-control" required name="remark" id="is_mark_query" cols="95" rows="2"></textarea>

                    <label>Query Document <span class="text-danger remove_danger">*</span></label>
                    <div class="input-group">
                        <input type="file" required name="query_doc_by_admin" class="form-control remove_danger"
                            onchange="getfileext(this.value,10)" id="File10"
                            aria-describedby="inputGroupFileAddon05" aria-label="Upload">
                    </div>
                </div>
                <div class="modal-footer">
                    <div>
                        <input type="submit" class="btn btn-info" value="Send">
                        <button type="button" class="btn btn-success" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
<!--Query reply  By Association-->
<div class="modal fade" id="reply_of_query" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Reply of Query</h5>
                <!--<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
            </div>
            <form action="{{ route('query_reply_for_supporting_document') }}" method="post"
                enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="user_id"
                        @if (isset($articles[0]->application_no)) value="{{ $articles[0]->application_no }}" @endif />
                    <input type="hidden" name="form_type" value="7">
                    <input type="hidden" class="sender_id" name="sender_id" value="">
                    <input type="hidden" class="reciever_id" name="reciever_id" value="">

                    <label class="placeholder">Remark <span class="text-danger">*</span></label>
                    <textarea class="form-control" required name="remark" id="is_mark_query" cols="95" rows="2"></textarea>

                    <label>Query Document <span class="text-danger remove_danger">*</span></label>
                    <div class="input-group">
                        <input type="file" required name="forward_verification_document"
                            class="form-control remove_danger" onchange="getfileext(this.value,10)" id="File10"
                            aria-describedby="inputGroupFileAddon05" aria-label="Upload">
                    </div>
                </div>
                <div class="modal-footer">
                    <div>
                        <input type="submit" class="btn btn-info" value="Send">
                        <button type="button" class="btn btn-success" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

@push('custom-scripts')
<script>

    $(document).ready(function() {
        $('#remark').select2({
            placeholder: "Select remarks",
            allowClear: true
        });
    });
    $('#remark').change(function () {
    let selected = $(this).val() || [];
    if (selected.includes('other')) {
        $('#other_remark').show().attr('required', true);
    } else {
        $('#other_remark').hide().removeAttr('required').val('');
    }
});
</script>
@endpush
