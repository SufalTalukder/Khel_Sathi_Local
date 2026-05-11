@extends('layouts\private_coaching_auth_layout')
@section('content')
    <div class="container-fluid pagecontentbody">
        <div class="pagebody removebg-color">
            <div class="row">
                <div class="col-12">
                    <div class="pageheader" id="menu-margin">
                        <h4 class="mb-0">
                                Swimming Pool Application Preview
                                <a href="#" data-print="modal" class="btn btn-sm btn-outline-primary ms-2 float-end " onclick="PrintDoc()"><span class="icons icon-printer"></span> Print</a>
                                @if($application->final_submit == 1 && $application->query_status == 1)
                                <a class="btn btn-outline-info btn-sm  float-end" data-bs-toggle="modal" data-bs-target="#viewQuery" href="#"><i class="fa fa-question"></i> View Query</a>

                                @endif
                                <a href="{{ route('private_coaching_dashboard') }}" class="btn btn-outline-success btn-sm float-end "><span class="icons icon-arrow-left"></span>Back to Dashboard</a>
                            </h4>
                        {{-- <div class="row">
                            <div class="col-md-9">
                                <h4 class="mb-0">Swimming Pool Application Preview</h4>
                            </div>
                            <div class="col-md-3 text-end">
                                <a href="#" data-print="modal" class="btn btn-outline-primary me-2"
                                    onclick="PrintDoc()"><span class="icons icon-printer"></span> Print</a>
                                <a href="{{ route('private_coaching_dashboard') }}" class="btn btn-outline-success ">
                                    <span class="icons icon-arrow-left"></span>Back to Dashboard
                                </a>
                            </div>
                        </div> --}}
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
                                                                Details of Swimming Pool Application
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
                                                                    <td><strong>1.) Full Name<br />पूरा नाम</strong></td>
                                                                    <td>{{ Auth::guard('PrivateCoaching')->user()->name }}
                                                                    </td>
                                                                    <td><strong>2. Designation<br />पदनाम</strong></td>
                                                                    <td>{{ Auth::guard('PrivateCoaching')->user()->designation }}
                                                                    </td>
                                                                    <td rowspan="5"
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
                                                                    <td><strong>2.) Email ID<br />ईमेल आईडी </strong></td>
                                                                    <td>{{ Auth::guard('PrivateCoaching')->user()->email }}
                                                                    </td>
                                                                    <td><strong>3.) Mobile No.<br />मोबाइल नंबर </strong>
                                                                    </td>
                                                                    <td>{{ Auth::guard('PrivateCoaching')->user()->mobile }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="4" style="background-color:#eee;">
                                                                        <strong>B. Swimming Pool Details/स्वीमिंग पूल का
                                                                            विवरण</strong></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <strong>
                                                                            1.) Name of the owner of Swimming Pool<br />
                                                                            स्वीमिंग पूल के मालिक का नाम
                                                                        </strong>
                                                                    </td>
                                                                    <td>{{ isset($application->owner_name) ? $application->owner_name : '' }}
                                                                    </td>
                                                                    <td>
                                                                        <strong>
                                                                            2.) Address<br />
                                                                            पता
                                                                        </strong>
                                                                    </td>
                                                                    <td>{{ isset($application->owner_address) ? $application->owner_address : '' }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <strong>
                                                                            3.) Mobile Number<br />
                                                                            मोबाइल नंबर
                                                                        </strong>
                                                                    </td>
                                                                    <td>{{ isset($application->owner_address) ? $application->owner_address : '' }}
                                                                    </td>
                                                                    <td>
                                                                        <strong>
                                                                            4.) Email ID<br />
                                                                            ईमेल आईडी
                                                                        </strong>
                                                                    </td>
                                                                    <td>{{ isset($application->owner_email) ? $application->owner_email : '' }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="5" style="background-color:#eee;">
                                                                        <strong>C. Manager Details/प्रबंधक विवरण</strong>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <strong>
                                                                            1.) Manager's Name<br />
                                                                            प्रबन्धक का नाम
                                                                        </strong>
                                                                    </td>
                                                                    <td>{{ isset($application->manager_name) ? $application->manager_name : '' }}
                                                                    </td>
                                                                    <td>
                                                                        <strong>
                                                                            2.) Manager's Address<br />
                                                                            प्रबन्धक का पता
                                                                        </strong>
                                                                    </td>
                                                                    <td colspan="2">
                                                                        {{ isset($application->manager_address) ? $application->manager_address : '' }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <strong>
                                                                            3.) Mobile Number<br />
                                                                            मोबाइल नंबर
                                                                        </strong>
                                                                    </td>
                                                                    <td>{{ isset($application->manager_mobile) ? $application->manager_mobile : '' }}
                                                                    </td>
                                                                    <td>
                                                                        <strong>
                                                                            4.) Email ID<br />
                                                                            ईमेल आईडी
                                                                        </strong>
                                                                    </td>
                                                                    <td colspan="2">
                                                                        {{ isset($application->manager_email) ? $application->manager_email : '' }}
                                                                    </td>
                                                                </tr>





                                                                @if ($instructors->isNotEmpty())
                                                                    <tr>
                                                                        <td colspan="5" style="background-color:#eee;">
                                                                            <strong>D. Instructor’s Details/प्रशिक्षक का
                                                                                विवरण</strong> Yes
                                                                        </td>
                                                                    </tr>

                                                                    @foreach ($instructors as $instructor)
                                                                        <tr>
                                                                            <td><strong>1.) Instructor's Name<br />प्रशिक्षक
                                                                                    का नाम</strong></td>
                                                                            <td>{{ $instructor->name }}</td>
                                                                            <td><strong>2.) Instructor's
                                                                                    Address<br />प्रशिक्षक का पता</strong>
                                                                            </td>
                                                                            <td colspan="2">{{ $instructor->address }}
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><strong>3.) Mobile Number<br />मोबाइल
                                                                                    नंबर</strong></td>
                                                                            <td>{{ $instructor->mobile }}</td>
                                                                            <td><strong>4.) Instructor Photo<br />प्रशिक्षक
                                                                                    का फोटो</strong></td>
                                                                            <td colspan="2">
                                                                                @if ($instructor->photo)
                                                                                    <a href="{{ asset('public/private_coaching_storage/instructor_photo/' . $instructor->photo) }}"
                                                                                        target="_blank"
                                                                                        class="rounded-pill btn btn-outline-danger btn-xs">Uploaded</a>
                                                                                @else
                                                                                    <span class="text-muted">Not
                                                                                        Uploaded</span>
                                                                                @endif
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td><strong>5.) Instructor's Certification
                                                                                    Documents<br />प्रशिक्षक सम्बंधित प्रमाण
                                                                                    पत्र</strong></td>
                                                                            <td colspan="4">
                                                                                @if ($instructor->certificate)
                                                                                    <a href="{{ asset('public/private_coaching_storage/instructor_certificate/' . $instructor->certificate) }}"
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

                                                                            <strong>D. Instructor Details/प्रशिक्षक का
                                                                                विवरण</strong> NO

                                                                        </td>
                                                                    </tr>
                                                                @endif

                                                                @if ($lifeguards->isNotEmpty())
                                                                    <tr>
                                                                        <td colspan="5" style="background-color:#eee;">
                                                                            <strong>E. Lifeguard’s Details/लाईफ गार्ड का
                                                                                विवरण </strong> Yes</td>
                                                                    </tr>
                                                                    @foreach ($lifeguards as $lifeguard)
                                                                        <tr>
                                                                            <td>
                                                                                <strong>
                                                                                    1.) Lifeguard’s Name<br />
                                                                                    जीवन रक्षक का नाम
                                                                                </strong>
                                                                            </td>
                                                                            <td>{{ $lifeguard->name }}</td>
                                                                            <td>
                                                                                <strong>
                                                                                    2.) Lifeguard’s Address<br />
                                                                                    जीवन रक्षक का पता
                                                                                </strong>
                                                                            </td>
                                                                            <td colspan="2">{{ $lifeguard->address }}
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <strong>
                                                                                    3.) Mobile Number<br />
                                                                                    मोबाइल नंबर
                                                                                </strong>
                                                                            </td>
                                                                            <td>{{ $lifeguard->mobile }}</td>
                                                                            <td>
                                                                                <strong>
                                                                                    4.) Lifeguard’s Photo<br />
                                                                                    जीवन रक्षक का फोटो
                                                                                </strong>
                                                                            </td>
                                                                            <td colspan="2">
                                                                                @if ($lifeguard->photo)
                                                                                    <a href="{{ asset('public/private_coaching_storage/lifeguard_photo/' . $lifeguard->photo) }}"
                                                                                        target="_blank"
                                                                                        class="rounded-pill btn btn-outline-danger btn-xs">Uploaded</a>
                                                                                @else
                                                                                    <span class="text-muted">Not
                                                                                        Uploaded</span>
                                                                                @endif
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                <strong>
                                                                                    5.) Lifeguard’s Certificate<br />
                                                                                    जीवन रक्षक का प्रमाण पत्र
                                                                                </strong>
                                                                            </td>
                                                                            <td colspan="4">
                                                                                @if ($lifeguard->certificate)
                                                                                    <a href="{{ asset('public/private_coaching_storage/lifeguard_certificate/' . $lifeguard->certificate) }}"
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
                                                                            <strong>E. Lifeguard’s Details/लाईफ गार्ड का
                                                                                विवरण </strong> NO</td>


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
                                                                        <label>1.) No Objection Certificate/ Approval from
                                                                            District Administration<br />स्वीमिंग पूल के
                                                                            निर्माण हेतु जिला प्रशासन एवं अन्य सम्बन्धित
                                                                            विभागों से प्राप्त की गयी अनापत्ति/अनुमति प्रमाण
                                                                            पत्र की छायाप्रतियाँ</label>
                                                                    </td>
                                                                    <td colspan="2"><strong
                                                                            class="rounded-pill btn btn-outline-danger btn-xs disabled">Uploaded</strong>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="5" style="background-color:#eee;">
                                                                        <strong>G. Pool Construction Details/पूल निर्माण
                                                                            विवरण</strong></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <label>
                                                                            1.) Pool Layout Map<br />
                                                                            स्विमिंग पूल के नक़्शे की छाया प्रति
                                                                        </label>
                                                                    </td>
                                                                    <td>
                                                                        @if ($application->pool_layout_map)
                                                                            <a href="{{ asset('public/private_coaching_storage/pool_layout_map/' . $application->pool_layout_map) }}"
                                                                                target="_blank"
                                                                                class="rounded-pill btn btn-outline-danger btn-xs">Uploaded</a>
                                                                        @else
                                                                            <span class="text-muted">Not Uploaded</span>
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        <strong>
                                                                            2.) Water Capacity (in liters)<br />
                                                                            स्वीमिंग पूल में कितने लीटर पानी भरा जायेगा
                                                                        </strong>
                                                                    </td>
                                                                    <td colspan="2">
                                                                        {{ isset($application->water_capacity) ? $application->water_capacity : '' }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <strong>
                                                                            3.) Water Source<br />
                                                                            पानी भरने का स्त्रोत
                                                                        </strong>
                                                                    </td>
                                                                    <td>{{ isset($application->water_source) ? $application->water_source : '' }}
                                                                    </td>
                                                                    <td>
                                                                        <strong>
                                                                            4.) Draining and Utilization Process<br />
                                                                            जल निकासी और उपयोग प्रक्रिया
                                                                        </strong>
                                                                    </td>
                                                                    <td colspan="2">
                                                                        {{ isset($application->draining_utilization_process) ? $application->draining_utilization_process : '' }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <strong>
                                                                            5.) Pool Size<br />
                                                                            स्वीमिंग पूल का साईज
                                                                        </strong>
                                                                    </td>
                                                                    <td>{{ isset($application->pool_size) ? $application->pool_size : '' }}
                                                                    </td>
                                                                    <td>
                                                                        <strong>
                                                                            6.) Pool Depth <br />
                                                                            पूल की गहराई
                                                                        </strong>
                                                                    </td>
                                                                    <td colspan="2">
                                                                        {{ isset($application->pool_depth) ? $application->pool_depth : '' }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <strong>
                                                                            7.) Height of Boundary Wall<br />
                                                                            स्वीमिंग पूल की चारदीवारी की ऊँचाई / अन्य विवरण
                                                                        </strong>
                                                                    </td>
                                                                    <td>{{ isset($application->height_boundary_wall) ? $application->height_boundary_wall : '' }}
                                                                    </td>
                                                                    <td>
                                                                        <strong>
                                                                            8.) Gate Access Details<br />
                                                                            स्वीमिंग पूल आवागमन (गेट) का विवरण
                                                                        </strong>
                                                                    </td>
                                                                    <td colspan="2">
                                                                        {{ isset($application->gate_access_detail) ? $application->gate_access_detail : '' }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="5" style="background-color:#eee;">
                                                                        <strong>H. Facility and Equipment Details/सुविधा और
                                                                            उपकरण का विवरण</strong></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <strong>
                                                                            1.) Availability of Filter Plant<br />
                                                                            फिल्टर प्लान्ट है अथवा नही
                                                                        </strong>
                                                                    </td>
                                                                    <td>
                                                                        @if (isset($application) && $application->available_filter_plant == 1)
                                                                            Yes
                                                                        @else
                                                                            No
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        <strong>
                                                                            Filter Plant Capacity<br />
                                                                            फिल्टर प्लान्ट की क्षमता
                                                                        </strong>
                                                                    </td>
                                                                    <td colspan="2">
                                                                        {{ isset($application->filter_plant_capacity) ? $application->filter_plant_capacity : 'NA' }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <strong>
                                                                            2.) Is There a Depth Marking or Not?<br />
                                                                            गहराई सम्बन्धित चिन्ह अंकित है अथवा नहीं
                                                                        </strong>
                                                                    </td>
                                                                    <td>
                                                                        @if (isset($application) && $application->depth_marking_available == 1)
                                                                            Yes
                                                                        @else
                                                                            No
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        <strong>
                                                                            3.) Medical Facility Available<br />
                                                                            चिकित्सा सुविधा उपलब्ध है अथवा नहीं
                                                                        </strong>
                                                                    </td>
                                                                    <td colspan="2">
                                                                        @if (isset($application) && $application->medical_facility_available == 1)
                                                                            Yes
                                                                        @else
                                                                            No
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <strong>
                                                                            4.) Life Jackets Available<br />
                                                                            लाईफ सेविंग जैकेट है अथवा नही
                                                                        </strong>
                                                                    </td>
                                                                    <td>
                                                                        @if (isset($application) && $application->life_jacket_available == 1)
                                                                            Yes
                                                                        @else
                                                                            No
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        <strong>
                                                                            5.) Whether There is a Register of Swimming
                                                                            Persons or Not<br />
                                                                            स्वीमिंग करने वाले व्यक्तियों का रजिस्टर है अथवा
                                                                            नहीं
                                                                        </strong>
                                                                    </td>
                                                                    <td colspan="2">
                                                                        @if (isset($application) && $application->swimmer_register_available == 1)
                                                                            Yes
                                                                        @else
                                                                            No
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <strong>
                                                                            6.) Nearest Hospital Name<br />
                                                                            स्वीमिंग पूल के नजदीकी अस्पताल का नाम
                                                                        </strong>
                                                                    </td>
                                                                    <td>{{ isset($application->nearest_hospital_name) ? $application->nearest_hospital_name : '' }}
                                                                    </td>
                                                                    <td>
                                                                        <strong>
                                                                            7.) Nearest Hospital Number<br />
                                                                            स्वीमिंग पूल के नजदीकी अस्पताल का दूरभाष नम्बर
                                                                        </strong>
                                                                    </td>
                                                                    <td>{{ isset($application->nearest_hospital_number) ? $application->nearest_hospital_number : '' }}
                                                                    </td>

                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <strong>
                                                                            8.) Water Testing Kit<br />
                                                                            पानी की जाँच की किट है अथवा नहीं
                                                                        </strong>
                                                                    </td>
                                                                    <td>
                                                                        @if (isset($application) && $application->water_testing_kit_available == 1)
                                                                            Yes
                                                                        @else
                                                                            No
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        <strong>
                                                                            9.) Board Displaying Pool Rules<br />
                                                                            स्विमिंग पूल प्रयोग करने वाले नियमों की जानकारी
                                                                            का बोर्ड लगा है अथवा नहीं
                                                                        </strong>
                                                                    </td>
                                                                    <td colspan="2">
                                                                        @if (isset($application) && $application->pool_rules_board_available == 1)
                                                                            Yes
                                                                        @else
                                                                            No
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <strong>
                                                                            10.) Artificial Respiration Equipment<br />
                                                                            कृत्रिम सास लेने सम्बन्धी उपकरण है अथवा नहीं
                                                                        </strong>
                                                                    </td>
                                                                    <td>
                                                                        @if (isset($application) && $application->respiration_equipment_available == 1)
                                                                            Yes
                                                                        @else
                                                                            No
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        <strong>
                                                                            11.) Safety Hook/Rope<br />
                                                                            सेफ्टी हुक/रस्सी है अथवा नहीं
                                                                        </strong>
                                                                    </td>
                                                                    <td colspan="2">
                                                                        @if (isset($application) && $application->safety_hook_rope_available == 1)
                                                                            Yes
                                                                        @else
                                                                            No
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <strong>
                                                                            12.) Life-Saving Equipment<br />
                                                                            जीवन रक्षक उपकरण है अथवा नहीं
                                                                        </strong>
                                                                    </td>
                                                                    <td colspan="4">
                                                                        @if (isset($application) && $application->life_saving_equipment_available == 1)
                                                                            Yes
                                                                        @else
                                                                            No
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="5" style="background-color:#eee;">
                                                                        <strong>I. Operational Details/परिचालन का
                                                                            विवरण</strong></td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <strong>
                                                                            1.) Operating Hours<br />
                                                                            संचालन का समय
                                                                        </strong>
                                                                    </td>
                                                                    <td>{{ isset($application->operating_hours) ? $application->operating_hours : '' }}
                                                                    </td>
                                                                    <td>
                                                                        <strong>
                                                                            2.) Applicant’s Name<br />
                                                                            आवेदन कर्ता का नाम
                                                                        </strong>
                                                                    </td>
                                                                    <td colspan="2">
                                                                        {{ isset($application->applicant_name) ? $application->applicant_name : '' }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <strong>
                                                                            3.) Applicant’s Address<br />
                                                                            आवेदन कर्ता का पता
                                                                        </strong>
                                                                    </td>
                                                                    <td>{{ isset($application->applicant_address) ? $application->applicant_address : '' }}
                                                                    </td>
                                                                    <td>
                                                                        <strong>
                                                                            4.) Applicant’s Mobile Number<br />
                                                                            आवेदन कर्ता का मोबाइल नंबर
                                                                        </strong>
                                                                    </td>
                                                                    <td colspan="2">
                                                                        {{ isset($application->applicant_mobile) ? $application->applicant_mobile : '' }}
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="5" style="background-color:#eee;">
                                                                        <strong>J. Supporting Documents and
                                                                            Declarations/सहायक दस्तावेज़ और घोषणाएँ</strong>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <strong>
                                                                            1.) Copy of Previous Year’s NOC<br />
                                                                            पिछले वर्ष की अनापत्ति प्रमाण-पत्र की छायाप्रति
                                                                        </strong>
                                                                    </td>
                                                                    <td>
                                                                        @if ($application->previous_year_noc)
                                                                            <a href="{{ asset('public/private_coaching_storage/previous_year_noc/' . $application->previous_year_noc) }}"
                                                                                target="_blank"
                                                                                class="rounded-pill btn btn-outline-danger btn-xs">Uploaded</a>
                                                                        @else
                                                                            <span class="text-muted">Not Uploaded</span>
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        <strong>
                                                                            2.) Water Testing Report<br />
                                                                            पानी की टेस्टिंग रिपोर्ट
                                                                        </strong>
                                                                    </td>
                                                                    <td colspan="2">
                                                                        @if ($application->water_testing_report)
                                                                            <a href="{{ asset('public/private_coaching_storage/water_testing_report/' . $application->water_testing_report) }}"
                                                                                target="_blank"
                                                                                class="rounded-pill btn btn-outline-danger btn-xs">Uploaded</a>
                                                                        @else
                                                                            <span class="text-muted">Not Uploaded</span>
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <strong>
                                                                            3.1)Photo of Pool<br />
                                                                            तरणताल की 04 फोटो
                                                                        </strong>
                                                                    </td>
                                                                    <td>
                                                                        @if ($application->photo_of_pool_1)
                                                                            <a href="{{ asset('public/private_coaching_storage/photo_of_pool_1/' . $application->photo_of_pool_1) }}"
                                                                                target="_blank"
                                                                                class="rounded-pill btn btn-outline-danger btn-xs">Uploaded</a>
                                                                        @else
                                                                            <span class="text-muted">Not Uploaded</span>
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        <strong>
                                                                            3.2)Photo of Pool<br />
                                                                            तरणताल की 04 फोटो
                                                                        </strong>
                                                                    </td>
                                                                    <td colspan="2">
                                                                        @if ($application->photo_of_pool_2)
                                                                            <a href="{{ asset('public/private_coaching_storage/photo_of_pool_2/' . $application->photo_of_pool_2) }}"
                                                                                target="_blank"
                                                                                class="rounded-pill btn btn-outline-danger btn-xs">Uploaded</a>
                                                                        @else
                                                                            <span class="text-muted">Not Uploaded</span>
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                                <tr>

                                                                <tr>
                                                                    <td>
                                                                        <strong>
                                                                            3.3)Photo of Pool<br />
                                                                            तरणताल की 04 फोटो
                                                                        </strong>
                                                                    </td>
                                                                    <td>
                                                                        @if ($application->photo_of_pool_3)
                                                                            <a href="{{ asset('public/private_coaching_storage/photo_of_pool_3/' . $application->photo_of_pool_3) }}"
                                                                                target="_blank"
                                                                                class="rounded-pill btn btn-outline-danger btn-xs">Uploaded</a>
                                                                        @else
                                                                            <span class="text-muted">Not Uploaded</span>
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                        <strong>
                                                                            3.4)Photo of Pool<br />
                                                                            तरणताल की 04 फोटो
                                                                        </strong>
                                                                    </td>
                                                                    <td colspan="2">
                                                                        @if ($application->photo_of_pool_4)
                                                                            <a href="{{ asset('public/private_coaching_storage/photo_of_pool_4/' . $application->photo_of_pool_4) }}"
                                                                                target="_blank"
                                                                                class="rounded-pill btn btn-outline-danger btn-xs">Uploaded</a>
                                                                        @else
                                                                            <span class="text-muted">Not Uploaded</span>
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td>
                                                                        <strong>
                                                                            4.) Compliance Affidavit<br />
                                                                            अनुपालन शपथपत्र
                                                                        </strong>
                                                                    </td>
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
                                        <hr />
                                        <div class="row justify-content-center">
                                             @if ($application->final_submit != 1  || ($application->final_submit == 1 && $application->query_status == 1))
                                                <div class="row justify-content-center">
                                                    <div class="col-md-2 d-grid">
                                                        <a href="{{ route('private_coaching_swimming_pool', $application->id) }}"
                                                            class="btn btn-outline-light ">Back</a>
                                                    </div>
                                                    <div class="col-md-2 d-grid">
                                                        <button class="btn btn-outline-success " id="coachingFinal">Final
                                                            Submit</button>
                                                    </div>
                                                </div>
                                            @endif
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
    <div class="modal fade" id="viewQuery" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Query Details</h5>
                <!--<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
            </div>
            <div class="modal-body">
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
                        @foreach($query_mark as $key=>$item)
                        <tr>
                            <td><b>{{$key+1}}</b></td>
                            <td>{{$item->comments}}</td>
                            <td>{{dmy($item->created_at)}}</td>
                            @if ($item->doc)
                            <td><a class="btn btn-primary btn-sm" href="{{asset('public/private_coaching_storage/query_upload')}}/{{$item->doc}}" title="View File">Uploaded</a></td>
                            @else
                            <td>NA</td>
                            @endif
                            <td>{{ rsoName($item->created_by) }}</td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn btn-outline-danger" data-bs-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

@endsection


@push('custom-scripts')
    <script>
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


            var actionUrl = ajaxUrll + "/private_coaching/swimming_pool_application_finalSubmit/" + id;

            $.ajax({
                type: "GET",
                url: actionUrl,

                data: {
                    // <-- the $ sign in the parameter name seems unusual, I would avoid it
                }, // serializes the form's elements.
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
