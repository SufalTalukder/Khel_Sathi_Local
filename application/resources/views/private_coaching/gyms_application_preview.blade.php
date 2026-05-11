@extends( 'layouts\private_coaching_auth_layout' )
@section('content')
<div class="container-fluid pagecontentbody">
            <div class="pagebody removebg-color">
                <div class="row">
                    <div class="col-12">
                        <div class="pageheader" id="menu-margin">
                            <h4 class="mb-0">
                                Application Preview
                                <a href="#" data-print="modal" class="btn btn-sm btn-outline-primary ms-2 float-end " onclick="PrintDoc()"><span class="icons icon-printer"></span> Print</a>
                                @if($application->final_submit == 1 && $application->query_status == 1)
                                <a class="btn btn-outline-info btn-sm  float-end" data-bs-toggle="modal" data-bs-target="#viewQuery" href="#"><i class="fa fa-question"></i> View Query</a>

                                @endif
                                <a href="{{ route('private_coaching_dashboard') }}" class="btn btn-outline-success btn-sm float-end "><span class="icons icon-arrow-left"></span>Back to Dashboard</a>
                            </h4>
                            {{-- <div class="row">
                                <div class="col-md-9">
                                    <h4 class="mb-0">Gyms Application Preview</h4>
                                </div>
                                <div class="col-md-3 text-end">
                                    <a href="#" data-print="modal" class="btn btn-outline-primary me-2" onclick="PrintDoc()"><span class="icons icon-printer"></span> Print</a>
                                    @if($application->final_submit == 1 && $application->query_status == 1)
                                        <a class="btn btn-outline-info btn-sm  float-end" data-bs-toggle="modal" data-bs-target="#viewQuery" href="#"><i class="fa fa-question"></i> View Query</a>
                                    @endif
                                    <a href="{{route('private_coaching_dashboard')}}" class="btn btn-outline-success ">
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
                                                <table border="0" cellspacing="0" cellpadding="4" width="100%" style="border-collapse:collapse;">
                                                    <thead class="dn">
                                                        <tr>
                                                            <th colspan="2">
                                                                <div style="padding: 0 15px 3px; margin-bottom: 10px; border-bottom: 2px solid #000; position: relative;">
                                                                    <img src="{{url('public/assets_admin/images/logo.png')}}"
                                                                         style="width: 75px; height: auto; position: absolute; top: 0px; left: 20px;">
                                                                    <h1 style="text-align: center; font-size: 20pt; margin: 0px 0px 0px 0px; padding: 0px 0 0; color: #383838; font-weight: bold;">
                                                                        Sports Directorate, Govt. of Uttar Pradesh
                                                                    </h1>
                                                                    <h2 style="text-align: center; margin:0px 0px 0px 0px; font-size:11pt; padding: 0px; color:#383838; font-weight: bold;">
                                                                        Khel Bhawan Hazratganj Lucknow, Uttar Pradesh 226001
                                                                    </h2>
                                                                    <h5 style="text-align: center; margin:10px 0px 0px 0px; font-size:16pt; padding: 0px; color:#383838; font-weight: bold;">
                                                                        Registration of Pvt. Coaching Academies / Associations ,Gyms, Swimming Pools
                                                                    </h5>
                                                                </div>
                                                                <h6 style="text-align: center; margin:10px 0px 15px 0px; font-size:12pt; padding: 0px; color:#383838; font-weight: bold; text-decoration:underline;">
                                                                    Details of Gym Application 
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
                                                                <table class="table table-bordered" border="1" style="border-collapse: collapse; width: 100%;">
                                                                   <tr @if ($application->final_submit != 1) style="display: none" @endif>
                                                                        <td colspan="3"><strong>Application no. / आवेदन संख्या</strong></td> <td  colspan="2" >{{ $application->application_no }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="5" style="background-color:#eee;"><strong>A. Registration Details/पंजीकरण के विवरण</strong></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><strong>1.) Full Name<br />पूरा नाम</strong></td>
                                                                        <td>{{Auth::guard('PrivateCoaching')->user()->name }}</td>
                                                                        <td><strong>2.) Designation<br />पदनाम</strong></td>
                                                                        <td>{{Auth::guard('PrivateCoaching')->user()->designation }}</td>
                                                                        <td rowspan="5" style="vertical-align:top; width:155px;">
                                                                            <strong>Photo/फोटो</strong><br />
                                                                            <img src="{{ asset('public/private_coaching_storage/photo/'.$application->photo) }}" style="height: 145px; width: 100%; border: 1px solid #ccc; padding: 5px; margin-bottom: 10px;" />
                                                                            <strong>Signature/हस्ताक्षर</strong><br />
                                                                            <img src="{{ asset('public/private_coaching_storage/signature/'.$application->signature) }}" style="height: 50px; width: 100%; border: 1px solid #ccc; padding: 5px; margin-bottom: 5px; " />
                                                                        </td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td><strong>3.) Email ID<br />ईमेल आईडी </strong></td>
                                                                        <td>{{Auth::guard('PrivateCoaching')->user()->email }}</td>
                                                                        <td><strong>4.) Mobile No.<br />मोबाइल नंबर </strong></td>
                                                                        <td>{{Auth::guard('PrivateCoaching')->user()->mobile }}</td>
                                                                    </tr>
                                                                   <tr>
                                                                        <td colspan="4" style="background-color:#eee;"><strong>B. Gym Details/जिम का विवरण</strong></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <strong>
                                                                                1.) Gym Owner’s Name<br />
                                                                                जिम के मालिक का नाम
                                                                            </strong>
                                                                        </td>
                                                                        <td>{{$application->owner_name ?? 'N/A'}}</td>
                                                                        <td>
                                                                            <strong>
                                                                                2.) Gym Owner’s Address<br />
                                                                                जिम के मालिक का पता
                                                                            </strong>
                                                                        </td>
                                                                        <td>{{$application->owner_address ?? 'N/A'}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <strong>
                                                                                3.) Mobile Number<br />
                                                                                मोबाइल नंबर
                                                                            </strong>
                                                                        </td>
                                                                        <td>{{$application->owner_mobile ?? 'N/A'}}</td>
                                                                        <td>
                                                                            <strong>
                                                                                4.) Organization/Academy/Others Operating the Gym<br />
                                                                                जिम संचालन करने वाली संस्था/एकेडमी/अन्य
                                                                            </strong>
                                                                        </td>
                                                                        <td>{{$application->operating_entity ?? 'N\A'}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="5" style="background-color:#eee;"><strong>C. Manager Details/प्रबंधक विवरण</strong></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <strong>
                                                                                1.) Manager's Name<br />
                                                                                प्रबन्धक का नाम
                                                                            </strong>
                                                                        </td>
                                                                        <td>{{$application->manager_name ?? 'N\A'}}</td>
                                                                        <td>
                                                                            <strong>
                                                                                2.) Manager's Address<br />
                                                                                प्रबन्धक का पता
                                                                            </strong>
                                                                        </td>
                                                                        <td colspan="2">{{$application->manager_address ?? 'N\A'}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <strong>
                                                                                3.) Mobile Number<br />
                                                                                मोबाइल नंबर
                                                                            </strong>
                                                                        </td>
                                                                        <td>{{$application->manager_mobile ?? 'N\A'}}</td>
                                                                        <td>
                                                                            <strong>
                                                                                4.) Email ID<br />
                                                                                ईमेल आईडी
                                                                            </strong>
                                                                        </td>
                                                                        <td colspan="2">{{$application->manager_email ?? 'N\A'}}</td>
                                                                    </tr>
                                                                   
   
                                                               @if($trainers->isNotEmpty())
                                                                
                                                                    <tr>
                                                                        <td colspan="5" style="background-color:#eee;"><strong>D. If there is a Trainer/प्रशिक्षक यदि है तो</strong> Yes</td>
                                                                    </tr>
                                                                    @foreach($trainers as $trainer)

                                                                    <tr>
                                                                        <td>
                                                                            <strong>
                                                                                  1.) Trainer’s Name<br />
                                                                                प्रशिक्षक का नाम
                                                                            </strong>
                                                                        </td>
                                                                        <td>{{ $trainer->name }}</td>
                                                                        <td>
                                                                            <strong>
                                                                                 2.) Trainer’s Address<br />
                                                                                प्रशिक्षक का पता
                                                                            </strong>
                                                                        </td>
                                                                        <td colspan="2">{{ $trainer->address }}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <strong>
                                                                              3.) Mobile Number<br />
                                                                                मोबाइल नंबर
                                                                            </strong>
                                                                        </td>
                                                                        <td>{{ $trainer->mobile }}</td>
                                                                        <td>
                                                                            <strong>
                                                                            4.) Trainer’s Photo<br />
                                                                                प्रशिक्षक का फोटो
                                                                            </strong>
                                                                        </td>
                                                                        <td colspan="2"> @if($trainer->photo)
                                                                    <a href="{{ asset('public/private_coaching_storage/trainer_photo/' . $trainer->photo) }}" target="_blank" class="rounded-pill btn btn-outline-danger btn-xs">Uploaded</a>

                                                                    @else
                                                                    <span class="text-muted">Not Uploaded</span>
                                                                    @endif</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <strong>
                                                                               5.) Trainer’s Certification<br />
                                                                                प्रशिक्षक का प्रमाण पत्र
                                                                            </strong>
                                                                        </td>
                                                                        <td colspan="4">                                          @if($trainer->certificate)
                                                                    <a href="{{ asset('public/private_coaching_storage/trainer_certificate/' . $trainer->certificate) }}" target="_blank" class="rounded-pill btn btn-outline-danger btn-xs">Uploaded</a>
                                                                    @else
                                                                    <span class="text-muted">Not Uploaded</span>
                                                                    @endif</td>
                                                                    </tr>

                                                                    @endforeach


                                                                    @else
                                                               <tr>
                                                                
                                                                     
                                                                        <td colspan="5" style="background-color:#eee;"><strong>D. If there is a Trainer/प्रशिक्षक यदि है तो</strong> No</td>
                                                               
                                                          
                                                               </tr>
                                                               @endif
                                                                                                                                 
                                                                    <tr>
                                                                        <td colspan="5" style="background-color:#eee;"><strong>E. No Objection/Approval Certificates/अनापत्ति/अनुमति प्रमाण पत्र</strong></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="3">
                                                                            <label>1.) Copies of No Objection/Approval Certificates Obtained from District Administration & Other Relevant Departments for Gym Construction<br />जिम के निर्माण हेतु जिला प्रशासन एवं अन्य सम्बंधित विभागों से प्राप्त की गयी अनापत्ति / अनुमति प्रमाण पत्र की छायाप्रतियाँ</label>
                                                                        </td>
                                                                        <td colspan="2">                     @if($application->noc_certificate)
                                                                    <a href="{{ asset('public/private_coaching_storage/noc_certificate/' . $application->noc_certificate) }}" target="_blank" class="rounded-pill btn btn-outline-danger btn-xs">Uploaded</a>
                                                                    @else
                                                                    <span class="text-muted">Not Uploaded</span>
                                                                    @endif</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="5" style="background-color:#eee;"><strong>F. Gym Construction Details/जिम निर्माण विवरण</strong></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <label>
                                                                                1.) Copy of Gym Layout Plan<br />
                                                                                जिम के नक्शे की छायाप्रति
                                                                            </label>
                                                                        </td>
                                                                        <td>     @if($application->gym_layout_plan_copy)
                                                                    <a href="{{ asset('public/private_coaching_storage/gym_layout_plan_copy/' . $application->gym_layout_plan_copy) }}" target="_blank" class="rounded-pill btn btn-outline-danger btn-xs">Uploaded</a>
                                                                    @else
                                                                    <span class="text-muted">Not Uploaded</span>
                                                                    @endif</td>
                                                                        <td>
                                                                            <strong>
                                                                                2.) Number of Gym Stations<br />
                                                                                जिम कितने स्टेशन का है
                                                                            </strong>
                                                                        </td>
                                                                        <td colspan="2">{{$application->gym_station_count ?? 'N/A'}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <strong>
                                                                                3.) Gym Size (Length)<br />
                                                                                जिम का साइज (लम्बाई)
                                                                            </strong>
                                                                        </td>
                                                                        <td>{{$application->gym_length ?? 'N/A'}}</td>
                                                                        <td>
                                                                            <strong>
                                                                                4.)  Gym Size (Width)<br />
                                                                                जिम का साइज (चौड़ाई)
                                                                            </strong>
                                                                        </td>
                                                                        <td colspan="2">{{$application->gym_width ?? 'N/A'}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <strong>
                                                                                5.) Details of Safety Equipment in the Gym<br />
                                                                                जिम में सुरक्षा हेतु उपकरण का विवरण
                                                                            </strong>
                                                                        </td>
                                                                        <td>{{$application->gym_safety_equipment_details ?? 'N/A'}}</td>
                                                                        <td>
                                                                            <strong>
                                                                                6.) Gym Entrance (Gate) Details<br />
                                                                                जिम आवागमन (गेट) का विवरण
                                                                            </strong>
                                                                        </td>
                                                                        <td colspan="2">{{$application->gym_entrance_details ?? 'N/A'}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="5" style="background-color:#eee;"><strong>G. Facility and Equipment Details/सुविधा और उपकरण का विवरण</strong></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <strong>
                                                                                1.) Is Medical Facility Available?<br />
                                                                                चिकित्सा सुविधा उपलब्ध है अथवा नहीं
                                                                            </strong>
                                                                        </td>
                                                                        <td>{{$application->medical_facility_available == 1 ? 'Yes':'No'}}</td>
                                                                        <td>
                                                                            <strong>
                                                                                2.) Is a First Aid Box Available in the Gym?<br />
                                                                                जिम में फर्स्ट एड बॉक्स है अथवा नहीं
                                                                            </strong>
                                                                        </td>
                                                                        <td colspan="2">{{$application->first_aid_box_available == 1 ? 'Yes':'No'}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <strong>
                                                                                3.) Is there a Register for Gym Users?<br />
                                                                                जिम करने वाले व्यक्तियों का रजिस्टर है अथवा नहीं
                                                                            </strong>
                                                                        </td>
                                                                           <td>{{$application->user_register_available == 1 ? 'Yes':'No'}}</td>
                                                                        <td>
                                                                            <strong>
                                                                                4.) Nearest Hospital’s Name<br />
                                                                                जिम के नजदीकी अस्पताल का नाम
                                                                            </strong>
                                                                        </td>
                                                                        <td colspan="2">{{$application->nearest_hospital_name  ?? 'N/A'}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <strong>
                                                                                5.) Nearest Hospital’s Phone Number<br />
                                                                                जिम के नजदीकी अस्पताल का दूरभाष नंबर
                                                                            </strong>
                                                                        </td>
                                                                        <td>{{$application->nearest_hospital_contact_number  ?? 'N/A'}}</td>
                                                                        <td>
                                                                            <strong>
                                                                                6.) Is There a Board Displaying Rules for Equipment Usage?<br />
                                                                                जिम में उपकरण प्रयोग करने वाले नियमों की जानकारी का बोर्ड लगा है अथवा नहीं
                                                                            </strong>
                                                                        </td>
                                                                        <td colspan="2">{{$application->equipment_rules_board == 1 ? 'Yes':'No'}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <strong>
                                                                                7.) Is an Artificial Respiration Device Available?<br />
                                                                                कृत्रिम साँस लेने सम्बन्धी उपकरण है अथवा नहीं
                                                                            </strong>
                                                                        </td>
                                                                        <td colspan="4">{{$application->respiration_device_available == 1 ? 'Yes':'No'}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="5" style="background-color:#eee;"><strong>H. Operational Details/परिचालन का विवरण</strong></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <strong>
                                                                                1.) Operating Hours<br />
                                                                                संचालन का समय
                                                                            </strong>
                                                                        </td>
                                                                        <td>{{$application->operating_hours}}</td>
                                                                        <td>
                                                                            <strong>
                                                                                2.) Applicant’s  Name<br />
                                                                                आवेदन कर्ता का नाम
                                                                            </strong>
                                                                        </td>
                                                                        <td colspan="2">{{$application->applicant_name}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <strong>
                                                                                3.) Applicant’s  Address<br />
                                                                                आवेदन कर्ता का पता
                                                                            </strong>
                                                                        </td>
                                                                        <td>{{$application->applicant_address}}</td>
                                                                        <td>
                                                                            <strong>
                                                                                4.) Applicant’s  Mobile Number<br />
                                                                                आवेदन कर्ता का मोबाइल नंबर
                                                                            </strong>
                                                                        </td>
                                                                        <td colspan="2">{{$application->applicant_mobile}}</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="5" style="background-color:#eee;"><strong>I. Supporting Documents and Declarations/सहायक दस्तावेज़ और घोषणाएँ</strong></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td>
                                                                            <strong>
                                                                                1.) Copy of Last Year’s No Objection Certificate<br />
                                                                                पिछले वर्ष की अनापत्ति प्रमाण-पत्र की छायाप्रति
                                                                            </strong>
                                                                        </td>
                                                                        <td> @if($application->previous_year_noc)
                                                                    <a href="{{ asset('public/private_coaching_storage/previous_year_noc/' . $application->previous_year_noc) }}" target="_blank" class="rounded-pill btn btn-outline-danger btn-xs">Uploaded</a>
                                                                    @else
                                                                    <span class="text-muted">Not Uploaded</span>
                                                                    @endif</td>
                                                                        <td>
                                                                            <strong>
                                                                                2.1) Photo of Gym<br />
                                                                                जिम की फोटो
                                                                            </strong>
                                                                        </td>
                                                                        <td colspan="2"> @if($application->gym_photo_1)
                                                                    <a href="{{ asset('public/private_coaching_storage/gym_photo_1/' . $application->gym_photo_1) }}" target="_blank" class="rounded-pill btn btn-outline-danger btn-xs">Uploaded</a>
                                                                    @else
                                                                    <span class="text-muted">Not Uploaded</span>
                                                                    @endif</td>
                                                                    </tr>


                                                                       <tr>
                                                                     <td>
                                                                            <strong>
                                                                                2.2) Photo of Gym<br />
                                                                                जिम की फोटो
                                                                            </strong>
                                                                        </td>
                                                                        <td > @if($application->gym_photo_2)
                                                                    <a href="{{ asset('public/private_coaching_storage/gym_photo_2/' . $application->gym_photo_2) }}" target="_blank" class="rounded-pill btn btn-outline-danger btn-xs">Uploaded</a>
                                                                    @else
                                                                    <span class="text-muted">Not Uploaded</span>
                                                                    @endif</td>


                                                                      <td>
                                                                            <strong>
                                                                                2.3) Photo of Gym<br />
                                                                                जिम की फोटो
                                                                            </strong>
                                                                        </td>
                                                                        <td colspan="2"> @if($application->gym_photo_3)
                                                                    <a href="{{ asset('public/private_coaching_storage/gym_photo_3/' . $application->gym_photo_3) }}" target="_blank" class="rounded-pill btn btn-outline-danger btn-xs">Uploaded</a>
                                                                    @else
                                                                    <span class="text-muted">Not Uploaded</span>
                                                                    @endif</td>
                                                                    </tr>
                                                                    <tr>


                                                                          <tr>
                                                                     <td>
                                                                            <strong>
                                                                                2.4) Photo of Gym<br />
                                                                                जिम की फोटो
                                                                            </strong>
                                                                        </td>
                                                                        <td > @if($application->gym_photo_4)
                                                                    <a href="{{ asset('public/private_coaching_storage/gym_photo_4/' . $application->gym_photo_4) }}" target="_blank" class="rounded-pill btn btn-outline-danger btn-xs">Uploaded</a>
                                                                    @else
                                                                    <span class="text-muted">Not Uploaded</span>
                                                                    @endif</td>
                                                                        <td >
                                                                            <strong>
                                                                                3.) Affidavit Regarding Compliance with Terms Mentioned on the Back of the Form<br />
                                                                                फॉर्म के पीछे अंकित शर्तो का अनुपालन सम्बन्धी शपथ पत्र
                                                                            </strong>
                                                                        </td>
                                                                        <td colspan="2"><strong class="rounded-pill btn btn-outline-danger btn-xs ">Uploaded</strong></td>
                                                                     </tr>
                                                                    <tr>
                                                                        <td colspan="5" class="bg-light"><strong>Declaration</strong></td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="5">I hereby declare that all the particulars provided in this application for institutional registration are true and correct to the best of my knowledge and belief. I understand that any discrepancies or false information may lead to the rejection of this application and I accept full responsibility for such consequences.<br>मैं घोषणा करता हूं कि संस्थागत पंजीकरण के लिए इस आवेदन में दिए गए सभी विवरण मेरी सर्वोत्तम जानकारी और विश्वास के अनुसार सत्य और सही हैं। मैं समझता हूं कि किसी भी विसंगति या गलत जानकारी के कारण इस आवेदन को अस्वीकार किया जा सकता है जिसकी समस्त जिम्मेदारी मेरी होगी।</td>
                                                                    </tr>
                                                                    <tr>
                                                                        <td colspan="5" align="center">
                                                                        <input type="checkbox" id="coachingChecked" @if ($application->final_submit == 1)disabled checked @endif/>
                                                                 
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
                                                        <a href="{{ route('private_coaching_gyms', $application->id) }}" class="btn btn-outline-light ">Back</a>
                                                    </div>
                                                    <div class="col-md-2 d-grid">
                                                        <button class="btn btn-outline-success " id="coachingFinal">Final Submit</button>
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
<div class="modal fade" id="onlineFinalWarning" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">

                <h3> Are you sure  want to submit the form?</h3>




                <p>
                    <button class="btn btn-outline-danger rounded-pill" onclick="final_submit({{ $application->id }})" >Yes</button>
                    <a type="button" class="btn btn-danger rounded-pill" data-bs-dismiss="modal" aria-label="Close">No</a>
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
          content.innerHTML = '<h3>Please click on the Declaration Checkbox and then proceed to submit.<br>कृपया घोषणा के चेकबॉक्स पर क्लिक करें एवं तदोपरांत आगे बढ़ें।</h3>';
          if($('#coachingChecked').is(':checked') ){
            $('#onlineFinalWarning').modal('toggle');


          }
          else
          swal(content, {

          });
              return false;
      });




const ajaxUrll = '{{ url('') }}';


    function final_submit(id) {


var actionUrl = ajaxUrll+"/private_coaching/gyms_application_finalSubmit/"+id;

$.ajax({
    type: "GET",
    url: actionUrl,

 
    success: function (res) {
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
