@extends('layouts\admin_layout')
@section('content')
    <div class="container-fluid pagecontentbody">
        <div class="pagebody removebg-color">
            <div class="row">
                <div class="col-12">
                    <div class="pageheader" id="menu-margin">
                        <h4 class="mb-0">

                            Application Preview
                            <button type="button" data-print="modal"
                                class="btn btn-sm  btn-outline-primary ms-2 float-end rounded-pill"
                                onclick="PrintDoc()"><span class="icons icon-printer"></span> Print</button>

                            <a href="{{ asset('assets_admin/private_coaching/academy_list') }}"
                                class="btn btn-outline-danger btn-sm backbtn float-end rounded-pill"><span
                                    class="icons icon-arrow-left"></span>Back to List</a>
                            @if ($application->status == 1 && $application->final_submit == 1)
                                <button type="button" class="btn btn-outline-success btn-sm float-end"> Accepted</button>
                            @elseif ($application->status == 2 && $application->final_submit == 1)
                                <button type="button" class="btn btn-outline-danger btn-sm float-end"> Rejected</button>
                            @elseif (
                                $application->final_submit == 1 &&
                                    $application->query_status == 2 &&
                                    Auth::guard('admin')->user()->admin_role != 17)
                                <button type="button" class="btn btn-outline-primary btn-sm float-end">
                                    Re-Submitted</button>
                                <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#rejectModal"
                                    class="btn btn-outline-danger btn-xs backbtn me-1 float-end">
                                    Reject
                                </a>
                                <a href="#" data-bs-toggle="modal" data-bs-target="#queryModal"
                                    class="btn btn-outline-info btn-xs backbtn me-1 float-end">
                                    Query Marked
                                </a>
                            @elseif($application->final_submit == 1 && $application->query_status == 1)
                                <button type="button" data-bs-toggle="modal" data-bs-target="#queryModal"
                                    class="btn btn-outline-warning btn-sm float-end"> Query
                                    Marked</button>
                            @else
                                {{-- @if (Auth::guard('admin')->user()->admin_role == 17) --}}
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#acceptModal"
                                        class="btn btn-outline-success btn-xs backbtn me-1 float-end">
                                        Accept
                                    </a>
                                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#rejectModal"
                                        class="btn btn-outline-danger btn-xs backbtn me-1 float-end">
                                        Reject
                                    </a>
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#queryModal"
                                        class="btn btn-outline-info btn-xs backbtn me-1 float-end">
                                        Query
                                    </a>
                                {{-- @else
                                    <a href="#" data-bs-toggle="modal" data-bs-target="#queryModal"
                                        class="btn btn-outline-info btn-xs backbtn me-1 float-end">
                                        Query
                                    </a>
                                    <a href="javascript:void(0)" data-bs-toggle="modal" data-bs-target="#rejectModal"
                                        class="btn btn-outline-danger btn-xs backbtn me-1 float-end">
                                        Reject
                                    </a>
                                @endif --}}
                            @endif

                        </h4>


                    </div>
                    <div class="bhoechie-tab-container">
                        <div class="form-scroll">
                            <div class="nano-content">
                                <div class="card">
                                    <div class="card-body">
                                        <div id="prodiv">
                                            <table border="0" cellspacing="0" cellpadding="4" width="100%"
                                                style="border-collapse:collapse;">
                                                <thead class="dn">
                                                    <tr>
                                                        <th colspan="2">
                                                            <div
                                                                style="padding: 0 15px 3px; margin-bottom: 10px; border-bottom: 2px solid #000; position: relative;">
                                                                <img src="{{ url('public/assets_admin/images/logo.png') }}"
                                                                    style="width: 75px; height: auto; position: absolute; top: 0px; left: 20px;">
                                                                <h1
                                                                    style="text-align: center; font-size: 20pt; margin: 0px 0px 0px 0px; padding: 0px 0 0; color: #383838; font-weight: bold;">
                                                                    Sports Directorate, Govt. of Uttar Pradesh
                                                                </h1>
                                                                <h2
                                                                    style="text-align: center; margin:0px 0px 0px 0px; font-size:11pt; padding: 0px; color:#383838; font-weight: bold;">
                                                                    Khel Bhawan Hazratganj Lucknow, Uttar Pradesh 226001
                                                                </h2>
                                                                <h5
                                                                    style="text-align: center; margin:10px 0px 0px 0px; font-size:16pt; padding: 0px; color:#383838; font-weight: bold;">
                                                                    Registration of Pvt. Coaching Academies / Associations
                                                                    ,Gyms, Swimming Pools
                                                                </h5>
                                                            </div>
                                                            <h6
                                                                style="text-align: center; margin:10px 0px 15px 0px; font-size:12pt; padding: 0px; color:#383838; font-weight: bold; text-decoration:underline;">
                                                                Details of Academy Application
                                                            </h6>
                                                        </th>
                                                    </tr>
                                                    <tr>
                                                        <th style="font-size: 10pt; text-align:left">
                                                            <!--<strong>Report Period : </strong> 29/01/2024 to 29/01/2024-->
                                                        </th>
                                                        <th style="text-align: right; font-size: 10pt;">
                                                            <strong>Report Generated On : </strong> {{ date('d-m-Y') }}
                                                        </th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <tr>
                                                        <td colspan="2">
                                                            <table class="table table-bordered" border="1"
                                                                style="border-collapse: collapse; width: 100%;">
                                                                <tr
                                                                    @if ($application->final_submit != 1) style="display: none" @endif>
                                                                    <td colspan="3"><strong>Application no. / आवेदन
                                                                            संख्या</strong></td>
                                                                    <td colspan="2">{{ $application->application_no }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="5" style="background-color:#eee;">
                                                                        <strong>A. Registration Details/पंजीकरण के
                                                                            विवरण</strong></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><strong>1.) Full Name/पूरा नाम</strong></td>
                                                                    <td>{{ $application->name }}</td>
                                                                    <td><strong>2. Designation/पदनाम</strong></td>
                                                                    <td>{{ $application->designation }}</td>
                                                                    <td rowspan="4"
                                                                        style="vertical-align:top; width:155px;">
                                                                        <strong>Photo/फोटो</strong><br />
                                                                        <img src="{{ asset('public/private_coaching_storage/photo/' . $application->photo) }}"
                                                                            style="height: 145px; width: 100%; border: 1px solid #ccc; padding: 5px; margin-bottom: 10px;" />
                                                                        <strong>Signature/हस्ताक्षर</strong><br />
                                                                        <img src="{{ asset('public/private_coaching_storage/signature/' . $application->signature) }}"
                                                                            style="height: 50px; width: 100%; border: 1px solid #ccc; padding: 5px; margin-bottom: 5px; " />
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td><strong>3.) Email ID/ईमेल आईडी </strong></td>
                                                                    <td>{{ $application->email }}</td>
                                                                    <td><strong>4.) Mobile No./मोबाइल नंबर </strong></td>
                                                                    <td>{{ $application->mobile }}</td>
                                                                </tr>
                                                                @if ($trainers->isNotEmpty())
                                                                    <tr>
                                                                        <td colspan="4" style="background-color:#eee;">
                                                                            <strong>D. Is there a trainer?/प्रशिक्षक यदि है
                                                                                तो?</strong> Yes
                                                                        </td>
                                                                    </tr>

                                                                    @foreach ($trainers as $trainer)
                                                                        <tr>
                                                                            <td><strong>1.) Trainer's Name<br />प्रशिक्षक का
                                                                                    नाम</strong></td>
                                                                            <td>{{ $trainer->name }}</td>
                                                                            <td><strong>2.) Trainer's Address<br />प्रशिक्षक
                                                                                    का पता</strong></td>
                                                                            <td >{{ $trainer->address }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><strong>3.) Mobile Number<br />मोबाइल
                                                                                    नंबर</strong></td>
                                                                            <td>{{ $trainer->mobile }}</td>
                                                                            <td><strong>4.) Trainer’s Photo<br />प्रशिक्षक
                                                                                    का फोटो</strong></td>
                                                                            <td colspan="2">
                                                                                @if ($trainer->photo)
                                                                                    <a href="{{ asset('public/private_coaching_storage/trainer_photo/' . $trainer->photo) }}"
                                                                                        target="_blank"
                                                                                        class="rounded-pill btn btn-outline-danger btn-xs">Uploaded</a>
                                                                                @else
                                                                                    <span class="text-muted">Not
                                                                                        Uploaded</span>
                                                                                @endif
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><strong>5.) Trainer's Certification
                                                                                    Documents<br />प्रशिक्षक सम्बंधित प्रमाण
                                                                                    पत्र</strong></td>
                                                                            <td colspan="4">
                                                                                @if ($trainer->certificate)
                                                                                    <a href="{{ asset('public/private_coaching_storage/trainer_certificate/' . $trainer->certificate) }}"
                                                                                        target="_blank"
                                                                                        class="rounded-pill btn btn-outline-danger btn-xs">Uploaded</a>
                                                                                @else
                                                                                    <span class="text-muted">Not
                                                                                        Uploaded</span>
                                                                                @endif
                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                @else
                                                                    <tr>
                                                                        <td colspan="5" style="background-color:#eee;">
                                                                            <strong>D. Is there a trainer?/प्रशिक्षक यदि है
                                                                                तो?</strong> No
                                                                        </td>
                                                                    </tr>
                                                                @endif

                                                                @if ($staffs->isNotEmpty())
                                                                    <tr>
                                                                        <td colspan="5" style="background-color:#eee;">
                                                                            <strong>E. Is there support staff?/सपोर्ट स्टाफ
                                                                                यदि है तो?</strong> Yes
                                                                        </td>
                                                                    </tr>

                                                                    @foreach ($staffs as $staff)
                                                                        <tr>
                                                                            <td><strong>1.) Support Staff's Name<br />सपोर्ट
                                                                                    स्टाफ का नाम</strong></td>
                                                                            <td>{{ $staff->name }}</td>
                                                                            <td><strong>2.) Support Staff's
                                                                                    Address<br />सपोर्ट स्टाफ का
                                                                                    पता</strong></td>
                                                                            <td colspan="2">{{ $staff->address }}</td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><strong>3.) Mobile Number<br />मोबाइल
                                                                                    नंबर</strong></td>
                                                                            <td>{{ $staff->mobile }}</td>
                                                                            <td><strong>4.) Support Staff’s
                                                                                    Photo<br />सपोर्ट स्टाफ का फोटो</strong>
                                                                            </td>
                                                                            <td colspan="2">

                                                                                @if ($staff->photo)
                                                                                    <a href="{{ asset('public/private_coaching_storage/support_photo/' . $staff->photo) }}"
                                                                                        target="_blank"
                                                                                        class="rounded-pill btn btn-outline-danger btn-xs">Uploaded</a>
                                                                                @else
                                                                                    <span class="text-muted">Not
                                                                                        Uploaded</span>
                                                                                @endif
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><strong>5.) Support Staff's Certification
                                                                                    Documents<br />सपोर्ट स्टाफ सम्बंधित
                                                                                    प्रमाण पत्र</strong></td>
                                                                            <td colspan="4">
                                                                                @if ($staff->certificate)
                                                                                    <a href="{{ asset('public/private_coaching_storage/support_certificate/' . $staff->certificate) }}"
                                                                                        target="_blank"
                                                                                        class="rounded-pill btn btn-outline-danger btn-xs">Uploaded</a>
                                                                                @else
                                                                                    <span class="text-muted">Not
                                                                                        Uploaded</span>
                                                                                @endif

                                                                            </td>
                                                                        </tr>
                                                                    @endforeach
                                                                @else
                                                                    <tr>
                                                                        <td colspan="5" style="background-color:#eee;">
                                                                            <strong>E. Is there support staff?/सपोर्ट स्टाफ
                                                                                यदि है तो?</strong> No
                                                                        </td>
                                                                    </tr>
                                                                @endif

                                                                <tr>
                                                                    <td colspan="5" style="background-color:#eee;">
                                                                        <strong>F. No Objection/Approval
                                                                            Certificates/अनापत्ति/अनुमति प्रमाण
                                                                            पत्र</strong></td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="3">
                                                                        <label>1.)No Objection Certificate/ Approval from
                                                                            District Administration <br>
                                                                            स्वीमिंग पूल के निर्माण हेतु जिला प्रशासन एवं
                                                                            अन्य सम्बन्धित विभागों से प्राप्त की गयी
                                                                            अनापत्ति/अनुमति प्रमाण पत्र की
                                                                            छायाप्रतियाँ</label>
                                                                    </td>
                                                                    <td colspan="2">
                                                                        @if ($application->noc_certificate)
                                                                            <a href="{{ asset('public/private_coaching_storage/noc_certificate/' . $application->noc_certificate) }}"
                                                                                target="_blank"
                                                                                class="rounded-pill btn btn-outline-danger btn-xs">Uploaded</a>
                                                                        @else
                                                                            <span class="text-muted">Not Uploaded</span>
                                                                        @endif
                                                                    </td>
                                                                </tr>

                                                                <tr>
                                                                    <td colspan="5" style="background-color:#eee;">
                                                                        <strong>G. Private Sports Coaching/Academy
                                                                            Construction Details/ प्राइवेट खेल कोचिंग/अकेडमी
                                                                            निर्माण विवरण </strong></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><label>1.) Attach a copy of the Private Sports
                                                                            Coaching/Academy Map/प्राइवेट खेल कोचिंग/अकेडमी
                                                                            के नक्शे की छायाप्रति</label></td>
                                                                    <td colspan="4">
                                                                        @if ($application->academy_map)
                                                                            <a href="{{ asset('public/private_coaching_storage/academy_map/' . $application->academy_map) }}"
                                                                                target="_blank"
                                                                                class="rounded-pill btn btn-outline-danger btn-xs">Uploaded</a>
                                                                        @else
                                                                            <span class="text-muted">Not Uploaded</span>
                                                                        @endif
                                                                    </td>
                                                                </tr>

                                                                <tr>
                                                                    <td colspan="5" style="background-color:#eee;">
                                                                        <strong>H. Facility and Equipment Details/सुविधा और
                                                                            उपकरण का विवरण </strong></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><strong>1.) Is medical facility available?//सुविधा
                                                                            और उपकरण का विवरण ?</strong></td>
                                                                    <td> {{ $application->medical_facility_available == 1 ? 'Yes' : 'No' }}
                                                                    </td>
                                                                    <td><strong>2.) Nearest Hospital’s Name/नजदीकी अस्पताल
                                                                            का नाम </strong></td>
                                                                    <td colspan="2">
                                                                        {{ $application->nearest_hospital_name ?? '-' }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td><strong>3.) Nearest Hospital’s Number/नजदीकी अस्पताल
                                                                            का दूरभाष नम्बर </strong></td>
                                                                    <td>{{ $application->nearest_hospital_contact_number ?? '-' }}
                                                                    </td>
                                                                    <td><strong>4.) Is there an attendance register for
                                                                            trainees?/प्राइवेट खेल कोचिंग/एकेडमी के
                                                                            प्रशिक्षणार्थियों का उपस्थिति रजिस्टर है अथवा
                                                                            नहीं?</strong></td>
                                                                    <td colspan="2">
                                                                        {{ $application->attendance_register_available == 1 ? 'Yes' : 'No' }}
                                                                    </td>

                                                                </tr>
                                                                <tr>
                                                                    <td><strong>5.) Is there a board displaying the rules
                                                                            and regulations?/प्राइवेट खेल कोचिंग/एकेडमी
                                                                            प्रयोग करने वाले नियमो की जानकारी का बोर्ड लगा
                                                                            है अथवा नहीं</strong></td>
                                                                    <td>{{ $application->rules_display_board_available == 1 ? 'Yes' : 'No' }}
                                                                    </td>


                                                                </tr>

                                                                <tr>
                                                                    <td colspan="5" style="background-color:#eee;">
                                                                        <strong>I. Operational Details/परिचालन का विवरण
                                                                        </strong></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><strong>1.) Operating Hours/संचालन का समय</strong>
                                                                    </td>
                                                                    <td>{{ $application->operating_hours ?? '-' }}</td>
                                                                    <td><strong>2.) Applicant’s Name/आवेदन कर्ता का
                                                                            नाम</strong></td>
                                                                    <td colspan="2">
                                                                        {{ $application->applicant_name ?? '-' }}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td><strong>3.) Applicant’s Address/आवेदन कर्ता का पता
                                                                        </strong></td>
                                                                    <td>{{ $application->applicant_address ?? '-' }}</td>
                                                                    <td><strong>4.) Applicant’s Mobile Number/आवेदन कर्ता का
                                                                            मोबाइल नंबर </strong></td>
                                                                    <td colspan="2">
                                                                        {{ $application->applicant_mobile ?? '-' }}</td>
                                                                </tr>

                                                                <tr>
                                                                    <td colspan="5" style="background-color:#eee;">
                                                                        <strong>J. Supporting Documents and
                                                                            Declarations/सहायक दस्तावेज़ और घोषणाएँ
                                                                        </strong></td>
                                                                </tr>
                                                                <tr>
                                                                    <td><strong>1.) Previous Year’s NOC/पिछले वर्ष की
                                                                            अनापत्ति प्रमाण-पत्र की छायाप्रति</strong></td>
                                                                    <td>
                                                                        @if ($application->previous_year_noc)
                                                                            <a href="{{ asset('public/private_coaching_storage/previous_year_noc/' . $application->previous_year_noc) }}"
                                                                                target="_blank"
                                                                                class="rounded-pill btn btn-outline-danger btn-xs">Uploaded</a>
                                                                        @else
                                                                            <span class="text-muted">Not Uploaded</span>
                                                                        @endif
                                                                    </td>
                                                                    <td><strong>2.1) Upload photo of the Private Sports
                                                                            Coaching/Academy<br />प्राइवेट खेल कोचिंग /
                                                                            एकेडमी की फोटो</strong></td>
                                                                    <td colspan="2">
                                                                        @if ($application->academy_photo_1)
                                                                            <a href="{{ asset('public/private_coaching_storage/academy_photo_1/' . $application->academy_photo_1) }}"
                                                                                target="_blank"
                                                                                class="rounded-pill btn btn-outline-danger btn-xs">Uploaded</a>
                                                                        @else
                                                                            <span class="text-muted">Not Uploaded</span>
                                                                        @endif
                                                                    </td>
                                                                </tr>


                                                                <tr>
                                                                    <td><strong>2.3) Upload photo of the Private Sports
                                                                            Coaching/Academy<br />प्राइवेट खेल कोचिंग /
                                                                            एकेडमी की फोटो</strong></td>

                                                                    <td>
                                                                        @if ($application->academy_photo_2)
                                                                            <a href="{{ asset('public/private_coaching_storage/academy_photo_2/' . $application->academy_photo_2) }}"
                                                                                target="_blank"
                                                                                class="rounded-pill btn btn-outline-danger btn-xs">Uploaded</a>
                                                                        @else
                                                                            <span class="text-muted">Not Uploaded</span>
                                                                        @endif
                                                                    </td>
                                                                    <td><strong>2.3) Upload photo of the Private Sports
                                                                            Coaching/Academy<br />प्राइवेट खेल कोचिंग /
                                                                            एकेडमी की फोटो</strong></td>
                                                                    <td colspan="2">
                                                                        @if ($application->academy_photo_3)
                                                                            <a href="{{ asset('public/private_coaching_storage/academy_photo_3/' . $application->academy_photo_3) }}"
                                                                                target="_blank"
                                                                                class="rounded-pill btn btn-outline-danger btn-xs">Uploaded</a>
                                                                        @else
                                                                            <span class="text-muted">Not Uploaded</span>
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                                <tr>

                                                                    <td><strong>2.4) Upload photo of the Private Sports
                                                                            Coaching/Academy<br />प्राइवेट खेल कोचिंग /
                                                                            एकेडमी की फोटो</strong></td>

                                                                    <td>
                                                                        @if ($application->academy_photo_4)
                                                                            <a href="{{ asset('public/private_coaching_storage/academy_photo_4/' . $application->academy_photo_4) }}"
                                                                                target="_blank"
                                                                                class="rounded-pill btn btn-outline-danger btn-xs">Uploaded</a>
                                                                        @else
                                                                            <span class="text-muted">Not Uploaded</span>
                                                                        @endif
                                                                    </td>
                                                                    <td><strong>3.) Affidavit regarding compliance with the
                                                                            terms/फॉर्म के पीछे अंकित शर्तो का अनुपालन
                                                                            सम्बन्धी शपथ पत्र</strong></td>
                                                                    <td colspan="2">
                                                                        @if ($application->affidavit_compliance)
                                                                            <a href="{{ asset('public/private_coaching_storage/affidavit_compliance/' . $application->affidavit_compliance) }}"
                                                                                target="_blank"
                                                                                class="rounded-pill btn btn-outline-danger btn-xs">Uploaded</a>
                                                                        @else
                                                                            <span class="text-muted">Not Uploaded</span>
                                                                        @endif
                                                                    </td>
                                                                </tr>



                                                                <tr>
                                                                    <td colspan="5" class="bg-light">
                                                                        <strong>Declaration</strong></td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="5">I hereby declare that all the
                                                                        particulars provided in this application for
                                                                        institutional registration are true and correct to
                                                                        the best of my knowledge and belief. I understand
                                                                        that any discrepancies or false information may lead
                                                                        to the rejection of this application and I accept
                                                                        full responsibility for such consequences.<br>मैं
                                                                        घोषणा करता हूं कि संस्थागत पंजीकरण के लिए इस आवेदन
                                                                        में दिए गए सभी विवरण मेरी सर्वोत्तम जानकारी और
                                                                        विश्वास के अनुसार सत्य और सही हैं। मैं समझता हूं कि
                                                                        किसी भी विसंगति या गलत जानकारी के कारण इस आवेदन को
                                                                        अस्वीकार किया जा सकता है जिसकी समस्त जिम्मेदारी मेरी
                                                                        होगी।</td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="5" align="center">
                                                                        <input type="checkbox" id="coachingChecked"
                                                                            @if ($application->final_submit == 1) disabled checked @endif />
                                                                        &nbsp; <b>I Agree/मैं सहमत हूं</b>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                        </td>
                                                    </tr>
                                                </tbody>
                                            </table>
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
    <div class="modal fade" id="onlineFinalWarning" tabindex="-1" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body text-center">

                    <h3> Are you sure want to submit the form?</h3>




                    <p>
                        <button class="btn btn-outline-danger rounded-pill"
                            onclick="final_submit({{ $application->id }})">Yes</button>
                        <a type="button" class="btn btn-danger rounded-pill" data-bs-dismiss="modal"
                            aria-label="Close">No</a>
                    </p>
                </div>

            </div>
        </div>
    </div>
    <div class="accordion" id="accordionChat">
        <div class="accordion-item">
            <?php
            $check_name = 0;
            $class = 'out';
            ?>

            @foreach ($forward_data as $key => $item)
                @if ($key == 0)
                    <h2 class="accordion-header" id="headingOne">
                        <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse"
                            data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                            <div class="subj">
                                <h6 class="text-uppercase fw-bold mb-1">
                                    Supporting Document By
                                    @if (Auth::guard('admin')->user()->admin_role == 3)
                                        Association
                                    @else
                                        SO/RSO
                                    @endif
                                </h6>
                            </div>
                        </button>
                    </h2>
                    <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne"
                        data-bs-parent="#accordionChat">
                        <div class="accordion-body">
                @endif
                <div class="row">
                    <div class="col-md-12">
                        <ul class="chat-list">

                            @if (!empty($item->comments))
                                <?php
                                if ($item->created_by != $check_name && $class == 'in') {
                                    $class = 'out';
                                } elseif ($item->created_by == $check_name && $class == 'in') {
                                    $class = 'in';
                                } elseif ($item->created_by == $check_name && $class == 'out') {
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
                                    @php $check_name=$item->created_by; @endphp
                                    <div class="chat-body">
                                        <div class="chat-message">
                                            <h5 class="name">
                                                {{ rsoName($item->created_by) }}
                                                @if (!empty($item->doc))
                                                    <a class="doc_download"
                                                        href="{{ url('public/verification_document', $item->doc) }}"
                                                        download target="_blank"><i
                                                            class="fa fa-download attachfile"></i></a>
                                                @endif
                                            </h5>
                                            <p class="comment">
                                                {{ $item->comments }}
                                            </p>
                                        </div>
                                        <div>
                                            <small class="text-muted"><b>Reply
                                                    On:
                                                    {{ dmyHi($item->created_at) }}</b></small>
                                        </div>
                                    </div>
                                </li>
                            @else
                                <div class="text-danger"> Not
                                    Uploaded</div>
                            @endif
                        </ul>
                    </div>
                </div>
                <div class="separator-dashed"></div>
            @endforeach
        </div>
    </div>
    </div>
    </div>

@endsection


@push('custom-scripts')

    <div class="modal fade" id="acceptModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="forwrdedLabel" aria-hidden="true">

        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Accept</h5>

                </div>
                <form action="{{ route('admin_private_coaching_accepted_reject_status') }}" id="preregisterrr"
                    method="post" class="needs-validation" novalidate enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">

                            <input type="hidden" name="application_id" value="{{ last(request()->segments()) }}">
                            <input type="hidden" name="status" value="1">
                            <input type="hidden" name="value" value="3">
                            <div class="col-md-12 mb-3">
                                <label>Remarks</label>
                                <input type="text" class="form-control" name="remark" required>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn btn-outline-danger" data-bs-dismiss="modal">Close</button>

                        <button type="submit" class="btn btn-outline-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="rejectModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="forwrdedLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Reject</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <form action="{{ route('admin_private_coaching_accepted_reject_status') }}" id="preregisterr"
                    method="post" class="needs-validation" novalidate enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="modal-body">
                            <div class="row">
                                <input type="hidden" name="application_id" value="{{ last(request()->segments()) }}">
                                <input type="hidden" name="status" value="2">
                                <input type="hidden" name="value" value="3">
                                <div class="col-md-12 mb-3">
                                    <label>Remarks</label>
                                    <input type="text" class="form-control" name="remark" required>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="modal-footer">

                        <button type="submit" class="btn btn-outline-success">Submit</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div class="modal fade" id="queryModal" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="forwrdedLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Query Marked</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                @if (count($query_mark) > 0)
                    <div class="modal-body">
                        @if (Auth::guard('admin')->user()->admin_role == 17)
                            <form action="{{ route('admin_private_coaching_query_mark') }}" id="preregister"
                                method="post" class="needs-validation" novalidate enctype="multipart/form-data">
                                @csrf
                                <div class="modal-body">
                                    <div class="modal-body">

                                        <input type="hidden" name="application_no"
                                            value="{{ $application->application_no }}">
                                        <input type="hidden" name="application_id"
                                            value="{{ $application->id_application }}">
                                        <input type="hidden" name="value" value="3">


                                        <div class="row">
                                            <div class="col-md-12 mb-3">
                                                <label>Query</label>
                                                <input type="text" name="remark" class="form-control" required>
                                            </div>
                                            <div class="col-md-12 mb-3">
                                                <label>Upload File</label>
                                                <div class="input-group">
                                                    <input type="file" name="query_upload" class="form-control">

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="submit" class="btn btn-outline-success">Submit</button>
                                </div>
                            </form>
                        @endif
                        <table class="table table-bordered">
                            <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Query</th>
                                    <th>Query Date</th>
                                    <th>File</th>
                                    <th>Query By</th>

                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($query_mark as $key => $item)
                                    <tr>
                                        <td><b>{{ $key + 1 }}</b></td>
                                        <td>{{ $item->comments }}</td>
                                        <td>{{ dmy($item->created_at) }}</td>
                                        @if ($item->doc)
                                            <td><a class="btn btn-primary btn-sm"
                                                    href="{{ asset('public/private_coaching_storage/query_upload') }}/{{ $item->doc }}"
                                                    title="View File">Uploaded</a></td>
                                        @else
                                            <td>NA</td>
                                        @endif
                                        <td>{{ rsoName($item->created_by) }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <form action="{{ route('admin_private_coaching_query_mark') }}" id="preregister" method="post"
                        class="needs-validation" novalidate enctype="multipart/form-data">
                        @csrf
                        <div class="modal-body">
                            <div class="modal-body">

                                <input type="hidden" name="application_no" value="{{ $application->application_no }}">
                                <input type="hidden" name="application_id" value="{{ $application->id_application }}">
                                <input type="hidden" name="value" value="3">


                                <div class="row">
                                    <div class="col-md-12 mb-3">
                                        <label>Query</label>
                                        <input type="text" name="remark" class="form-control" required>
                                    </div>
                                    <div class="col-md-12 mb-3">
                                        <label>Upload File</label>
                                        <div class="input-group">
                                            <input type="file" name="query_upload" class="form-control">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-outline-success">Submit</button>
                        </div>
                    </form>
                @endif
            </div>
        </div>
    </div>
    <script>

         $("#preregister").submit(function(e) {

            e.preventDefault();
            if ($("#preregister")[0].checkValidity() === false) {
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
                            success(res.msg);
                            window.location.reload();
                            // window.location.href = res.url;
                        } else {
                            error(res.msg);
                        }
                    },
                });
            }
            $("#preregister").addClass("was-validated");
        });
        $("#preregisterr").submit(function(e) {

            e.preventDefault();
            if ($("#preregisterr")[0].checkValidity() === false) {
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
                            success(res.msg);
                            window.location.reload();
                            // window.location.href = res.url;
                        } else {
                            error(res.msg);
                        }
                    },
                });
            }
            $("#preregisterr").addClass("was-validated");
        });
        $("#preregisterrr").submit(function(e) {

            e.preventDefault();
            if ($("#preregisterrr")[0].checkValidity() === false) {
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
                            success(res.msg);
                            window.location.reload();
                            // window.location.href = res.url;
                        } else {
                            error(res.msg);
                        }
                    },
                });
            }
            $("#preregisterrr").addClass("was-validated");
        });
        $('#coachingFinal').click(function() {
            var content = document.createElement('div');
            content.innerHTML =
                '<h3>Please click on the Declaration Checkbox and then proceed to submit.<br>कृपया घोषणा के चेकबॉक्स पर क्लिक करें एवं तदोपरांत आगे बढ़ें।</h3>';
            if ($('#coachingChecked').is(':checked')) {
                $('#onlineFinalWarning').modal('toggle');


            } else
                swal(content, {

                });
            return false;
        });




        const ajaxUrll = '{{ url('') }}';


        function final_submit(id) {


            var actionUrl = ajaxUrll + "/private_coaching/gyms_application_finalSubmit/" + id;

            $.ajax({
                type: "GET",
                url: actionUrl,


                success: function(res) {
                    if (res.error == false) {

                        success(res.msg);

                        window.location.href = res.url;
                    } else {
                        error(res.msg);
                    }
                },
            });

        };
    </script>
@endpush
