@extends('layouts/admin_layout')
@section('content')

<!-- <div class="row">
                <div class="col-2">
                    <div class="fixed-sidebar">
                        <a href="{{url('admin/financial_assis')}}" class="btn btn-outline-info backbtn float-end"><span class="icons icon-arrow-left"></span>Back/पीछे</a>
                        <div class="left-sidebar">
                            <div >
                                <ul>
                                    <li><a href="ApplicationPreview.html" class="active"><span class="icons icon-arrow-right"></span>Application Preview</a></li>
                                    <li>
                                        <button type="button" data-print="modal" class="btn btn-outline-primary float-end"  onclick="PrintDoc()"><span class="icons icon-arrow-right"></span>Print</button></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div> -->
                <div class="pageheader" id="menu-margin">
                    <h4 class="mb-0"> &nbsp;
                    
                    <a href="{{ asset('assets_admin/financial_assis') }}"  class="btn btn-sm  btn-outline-primary ms-2 float-end " ><span class="icons icon-list"></span> Back to Dashboard</a>
                        
                        
                        <button type="button" data-print="modal" class="btn btn-sm  btn-outline-primary ms-2 float-end "   onclick="PrintDoc()"><span class="icons icon-printer"></span> Print/प्रिंट</button>
                        
                    </h4>
                </div>
                <!-- <div class="col-10"> -->
                    <div class="bhoechie-tab-container">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="bhoechie-tab-menu">
                                    <div class="list-group">
                                        <a href="#" class="list-group-item active" style="width: 100%;">
                                            <span class="fas fa-file-pdf"></span>
                                            Application to Seek Financial Assistance 
                                        </a>
                                    </div>
                                    <!-- <div class="text-center" style="background: #fff; padding: 10px;">
                                    @if(session()->has('success_marked'))
                                    <div id="hide_data"  class="alert alert-success" style="width: 300px;margin: 0 auto;" role="alert">
                                        {{session()->get('success_marked')}}
                                     </diV>
                                    @endif
                                    </div> -->
                                    </div>
                                </div>
                            </div>
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bhoechie-tab">
                                <div class="bhoechie-tab-content active">
                                    <div class="form-scroll">
                                        <div >
                                        <div class="row">
                                                                    <div class="col-md-12" id="prodiv">
                                                                        <table class="dn" style="width: 100%; margin-bottom: 5px;" border="0">
                                                                            <tr>
                                                                                <td colspan="2" align="center" style="position: relative; border: 0; padding-bottom: 5px;">
                                                                                    <div style="border-bottom: 0px solid #000; padding-bottom: 2vw;">
                                                                                        <!-- <img src="images/logo.png" style="position: absolute; width: 70px; top: 5px; left: 0;"/> -->
                                                                                        <div style="font-size: 3vw; font-weight: bold;">
                                                                                            <!-- Department of Sports -->
                                                                                            Khel Sathi Portal/खेल साथी पोर्टल
                                                                                        </div>
                                                                                        <div style="font-size: 2vw; font-weight: bold;">
                                                                                            Government of Uttar Pradesh/उत्तर प्रदेश सरकार
                                                                                        </div>
                                                                                        <div style="font-size: 2vw; font-weight: bold;">Online System for Former Sportspersons of UP to Seek Financial Assistance/Monthly Pension वित्तीय सहायता/मासिक पेंशन प्राप्त करने हेतु उत्तर प्रदेश के पूर्व खिलाड़ियों के लिए ऑनलाइन प्रणाली</div>
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <!-- <tr>
                                                                                <td style="text-align: left; font-size: 12px; padding-top: 5px;"></td>
                                                                                <td style="text-align: right; font-size: 12px; padding-top: 5px;"><b>Date :</b> {{ date('d-m-Y')}}</td>
                                                                            </tr> -->
                                                                        </table>
                                                                        @foreach($articles as $article)
                                                                        <p class="bg-light"><strong>Application no. / आवेदन क्रमांक:-</strong> <b>{{$article->application_no}}</b>
                                                                        <table  id="dataTable" class="table table-bordered" border="1" style="border-collapse: collapse; width: 100%;">
                                                                            <tr>
                                                                                <td colspan="6" class="bg-light">
                                                                                    <strong>Basic Details/सामान्य विवरण</strong>
                                                                                </td>
                                                                            </tr>
                                                                            
                                                                            <tr>
                                                                                <td><b>Applicant Full Name<br>आवेदक का पूरा नाम</b></td>
                                                                                <td>{{$article->fullname}}</td>
                                                                                <td><b>Which Sport did/do you play?<br>कौन सा खेल खेलते थे/हैं?</b></td>
                                                                                <td>{{$article->sport_name}}</td>
                                                                                <td colspan="2" rowspan="2"><b>Photograph of Applicant<br>आवेदक की फोटो</b><br />
                                                                                    <div class="text-center" style="padding: 5px;" align="center">
                                                                                        <img src="{{asset('storage/award/').'/'.$article->photograph_doc}}" class="img-fluid" style="width: 140px;" />
                                                                                    </div>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td><b>Mobile Number<br>मोबाइल नंबर</b></td>
                                                                                <td>{{$article->mobile}}</td>
                                                                                <td><b>Email ID<br>ईमेल आईडी</b></td>
                                                                                <td>{{$article->email}}</td>
                                                                               
                                                                            </tr>
                                                                            <tr>
                                                                                <td colspan="6" class="bg-light">
                                                                                    <strong>Applicant's Details/आवेदक का विवरण</strong>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <!-- <td><b>Application no.<br>आवेदन क्रमांक</b></td>
                                                                                <td>{{$article->application_no }}</td> -->
                                                                                <td><b>Date of Birth<br>जन्म तिथि</b></td>
                                                                                <td>{{$article->dob}}</td>
                                                                                <td><b>Place of Birth<br>जन्म स्थान</bvr></b></td>
                                                                                <td>{{$article->place_of_birth}}</td>
                                                                               
                                                                                
                                                                            </tr>
                                                                            <tr>
                                                                                <td><b>Mother’s Name<br>माता का नाम</b></td>
                                                                                <td>{{$article->mother_name}}</td>
                                                                                <td><b>Father’s Name<br>पिता का नाम</b></td>
                                                                                <td>{{$article->father_name}}</td>
                                                                                <td><b>Gender<br>लिंग</b></td>
                                                                                <td>{{$article->gender}}</td>
                                                                            </tr>
                                                                            <tr>
                                                                            <td><b>Highest Educational Qualification<br>उच्चतम शैक्षणिक योग्यता</b></td>
                                                                                <td>
                                                                                @if($article->qualification == '10') 10th / High School
                                                                                @elseif($article->qualification == '12') 12th / Intermediate  
                                                                                @elseif($article->qualification == 'graduation') Graduation 
                                                                                @elseif($article->qualification == 'master_degree') Master Degree
                                                                                @else Other
                                                                                @endif  
                                                                                <!-- {{$article->qualification}} -->
                                                                            </td>
                                                                                <td><b>Upload Certificate of Highest Educational Qualification<br>उच्चतम शैक्षणिक योग्यता का प्रमाणपत्र अपलोड करें</b></td>
                                                                                <td>  
                                                                                    @if($article->qualification_doc !='')
                                                                                   <!-- <strong class="btn btn-success btn-xs">Uploaded</strong>
                                                                                     <a href="{{url('storage/financial_assistance',$article->qualification_doc)}}" target="_blank">
                                                                                        <span class="btn btn-success btn-xs">View</span>
                                                                                    </a> -->
                                                                                    @php
                                                                                        $img = url('storage/financial_assistance').'/'.$article->qualification_doc;
                                                                                        $img1 = url('public/images/images.svg');
                                                                                        $doc = explode('.',$article->qualification_doc);
                                                                                        if($doc[1]=='pdf')
                                                                                        $img1 = url('public/images/pdf.svg');
                                                                                        @endphp
                                                                                        <img role="button" src="{{$img1}}" onclick="appendImage('{{$img}}','{{$doc[1]}}')" class="img-fluid img-query" />
                                                                                    
                                                                                    @else
                                                                                        <strong class="btn btn-danger btn-xs">Not Uploaded</strong>
                                                                                    @endif
                                                                                </td>
                                                                                <td><b>Domicile Certificate of UP<br>उत्तर प्रदेश का अधिवास प्रमाणपत्र अपलोड करें</b></td>
                                                                                <td>
                                                                                @if($article->domicile_certificate !='')
                                                                                        <!-- <strong class="btn btn-success btn-xs">Uploaded</strong>
                                                                                    <a href="{{url('storage/financial_assistance',$article->domicile_certificate)}}" target="_blank">
                                                                                        <span class="btn btn-success btn-xs">View</span>
                                                                                    </a> -->
                                                                                    @php
                                                                                        $img = url('storage/financial_assistance').'/'.$article->domicile_certificate;
                                                                                        $img1 = url('public/images/images.svg');
                                                                                        $doc = explode('.',$article->domicile_certificate);
                                                                                        if($doc[1]=='pdf')
                                                                                        $img1 = url('public/images/pdf.svg');
                                                                                        @endphp
                                                                                        <img role="button" src="{{$img1}}" onclick="appendImage('{{$img}}','{{$doc[1]}}')" class="img-fluid img-query" />
                                                                                    
                                                                                @else
                                                                                    <strong class="btn btn-danger btn-xs">Not Uploaded</strong>
                                                                                @endif
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td colspan="6" class="bg-light">
                                                                                    <strong>Financial Assistance Details/वित्तीय सहायता संबंधी विवरण</strong>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td><b>Monthly Income through personal sources (INR)<br>निजी स्त्रोतों द्वारा मासिक आय (भारतीय रुपया)</b></td>
                                                                                <td>{{$article->monthly_income_personal}}</td>
                                                                                <td><b>Upload Income Certificate<br>आय प्रमाणपत्र अपलोड करें</b></td>
                                                                                <td>
                                                                                    @if($article->income_certificate !='')
                                                                                    <!-- <strong class="btn btn-success btn-xs">Uploaded</strong>
                                                                                            <a href="{{url('storage/financial_assistance',$article->income_certificate)}}" target="_blank">
                                                                                            <span class="btn btn-success btn-xs">View</span>
                                                                                        </a> -->
                                                                                        @php
                                                                                        $img = url('storage/financial_assistance').'/'.$article->income_certificate;
                                                                                        $img1 = url('public/images/images.svg');
                                                                                        $doc = explode('.',$article->income_certificate);
                                                                                        if($doc[1]=='pdf')
                                                                                        $img1 = url('public/images/pdf.svg');
                                                                                        @endphp
                                                                                        <img role="button" src="{{$img1}}" onclick="appendImage('{{$img}}','{{$doc[1]}}')" class="img-fluid img-query" />
                                                                                    
                                                                                    @else
                                                                                        <strong class="btn btn-danger btn-xs">Not Uploaded</strong>
                                                                                    @endif
                                                                                </td>
                                                                                <!-- <td><b>Upload the District Magistrate's certificate for Income Verification</b></td>
                                                                                <td>
                                                                                    @if($article->dmc_income_verification !='')
                                                                                    <strong class="btn btn-success btn-xs">Uploaded</strong>
                                                                                        <a href="{{url('storage/financial_assistance',$article->dmc_income_verification)}}" target="_blank">
                                                                                            <span class="btn btn-success btn-xs">View</span>
                                                                                        </a>
                                                                                    @else
                                                                                        <strong class="btn btn-danger btn-xs">Not Uploaded</strong>
                                                                                    @endif
                                                                                </td> -->
                                                                            </tr>
                                                                            <tr>
                                                                                <td><b>Name of Sport used to play?<br>कौन सा खेल खेलते थे?</b></td>
                                                                                <td>{{$article->sport_name}}</td>
                                                                                <td><b>Level of Sport<br>खेल स्तर</b></td>
                                                                                <td>{{$article->level_of_report}}</td>
                                                                                <td><b>Details of Total Professional Experience<br>कुल व्यावसायिक अनुभव</b></td>
                                                                                <td>{{$article->total_professional_experience}}</td>
                                                                            
                                                                            </tr>
                                                                            <tr>
                                                                                
                                                                               
                                                                                <td><b>Details, if hold the experience of Sports Association<br>विवरण, यदि खेल संघ का अनुभव रखते हैं</b></td>
                                                                                <td>{{$article->experience_sports_association}}</td>
                                                                                <td><b>Upload Relevant Documents Justifying the Experience<br>अनुभव को सही ठहराते हुए प्रासंगिक दस्तावेज अपलोड करें</b></td>
                                                                                <td>
                                                                                    @if($article->document_justifying_experience !='')
                                                                                    <!-- <strong class="btn btn-success btn-xs">Uploaded</strong>
                                                                                         <a href="{{url('storage/financial_assistance',$article->document_justifying_experience)}}" target="_blank">
                                                                                            <span class="btn btn-success btn-xs">View</span>
                                                                                        </a> -->

                                                                                        @php
                                                                                        $img = url('storage/financial_assistance').'/'.$article->document_justifying_experience;
                                                                                        $img1 = url('public/images/images.svg');
                                                                                        $doc = explode('.',$article->document_justifying_experience);
                                                                                        if($doc[1]=='pdf')
                                                                                        $img1 = url('public/images/pdf.svg');
                                                                                        @endphp
                                                                                        <img role="button" src="{{$img1}}" onclick="appendImage('{{$img}}','{{$doc[1]}}')" class="img-fluid img-query" />
                                                                                    
                                                                                    @else
                                                                                        <strong class="btn btn-danger btn-xs">Not Uploaded</strong>
                                                                                    @endif
                                                                                </td>
                                                                                <td><b>Details of Income from other Sources<br>अन्य स्रोतों से आय का विवरण</b></td>
                                                                                <td>{{$article->income_other_sources}}</td>
                                                                            </tr>
                                                                            <tr>
                                                                               
                                                                             
                                                                                <td><b>Upload Relevant Documents Justifying the Income<br>आय को न्यायोचित ठहराते हुए प्रासंगिक दस्तावेज अपलोड करें</b></td>
                                                                                <td>
                                                                                    @if($article->income_document_other_sources !='')
                                                                                    <!-- <strong class="btn btn-success btn-xs">Uploaded</strong>
                                                                                        <a href="{{url('storage/financial_assistance',$article->income_document_other_sources)}}" target="_blank">
                                                                                             <span class="btn btn-success btn-xs">View</span>
                                                                                        </a> -->
                                                                                        @php
                                                                                        $img = url('storage/financial_assistance').'/'.$article->income_document_other_sources;
                                                                                        $img1 = url('public/images/images.svg');
                                                                                        $doc = explode('.',$article->income_document_other_sources);
                                                                                        if($doc[1]=='pdf')
                                                                                        $img1 = url('public/images/pdf.svg');
                                                                                        @endphp
                                                                                        <img role="button" src="{{$img1}}" onclick="appendImage('{{$img}}','{{$doc[1]}}')" class="img-fluid img-query" />
                                                                                    
                                                                                    @else
                                                                                        <strong class="btn btn-danger btn-xs">Not Uploaded</strong>
                                                                                    @endif
                                                                                </td>
                                                                                <td><b>Details of Assistance being taken benefits<br>हायता को न्यायोचित ठहराते हुए प्रासंगिक दस्तावेज अपलोड करें</b></td>
                                                                                <td>{{$article->details_of_assistance_benefits}}</td>
                                                                                <td><b>Upload Relevant Documents Justifying the Assistance<br>हायता को न्यायोचित ठहराते हुए प्रासंगिक दस्तावेज अपलोड करें</b></td>
                                                                                <td>
                                                                                    @if($article->relevant_documents_justifing_assistance !='')
                                                                                    <!-- <strong class="btn btn-success btn-xs">Uploaded</strong>
                                                                                        <a href="{{url('storage/financial_assistance',$article->relevant_documents_justifing_assistance)}}" target="_blank">
                                                                                            <span class="btn btn-success btn-xs">View</span>
                                                                                        </a> -->
                                                                                        @php
                                                                                        $img = url('storage/financial_assistance').'/'.$article->relevant_documents_justifing_assistance;
                                                                                        $img1 = url('public/images/images.svg');
                                                                                        $doc = explode('.',$article->relevant_documents_justifing_assistance);
                                                                                        if($doc[1]=='pdf')
                                                                                        $img1 = url('public/images/pdf.svg');
                                                                                        @endphp
                                                                                        <img role="button" src="{{$img1}}" onclick="appendImage('{{$img}}','{{$doc[1]}}')" class="img-fluid img-query" />
                                                                                    
                                                                                    @else
                                                                                        <strong class="btn btn-danger btn-xs">Not Uploaded</strong>
                                                                                    @endif
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                
                                                                                <td><b>Is Applicant Physically Challenged ?<br>क्या आवेदक शारीरिक रूप से अक्षम है?</b></td>
                                                                                <td>{{$article->physical_condition}}</td>
                                                                                <td><b>Upload Medical Certificate if the applicant is unfit or disabled<br>यदि आवेदक अक्षम अथवा दिव्यांग है तो चिकित्सा प्रमाणपत्र अपलोड करें</b></td>
                                                                                <td>
                                                                                    @if($article->medical_certificate !='')
                                                                                    <!-- <strong class="btn btn-success btn-xs">Uploaded</strong>
                                                                                        <a href="{{url('storage/financial_assistance',$article->medical_certificate)}}" target="_blank">
                                                                                            <span class="btn btn-success btn-xs">View</span>
                                                                                        </a> -->
                                                                                        @php
                                                                                        $img = url('storage/financial_assistance').'/'.$article->medical_certificate;
                                                                                        $img1 = url('public/images/images.svg');
                                                                                        $doc = explode('.',$article->medical_certificate);
                                                                                        if($doc[1]=='pdf')
                                                                                        $img1 = url('public/images/pdf.svg');
                                                                                        @endphp
                                                                                        <img role="button" src="{{$img1}}" onclick="appendImage('{{$img}}','{{$doc[1]}}')" class="img-fluid img-query" />
                                                                                    
                                                                                    @else
                                                                                        <strong class="btn btn-danger btn-xs">Not Uploaded</strong>
                                                                                    @endif
                                                                                </td>
                                                                            </tr>
                                                                            
                                                                            <tr>
                                                                                <td colspan="6" class="bg-light">
                                                                                    <strong>Current Address<br>वर्तमान पता</strong>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td><b>Address<br>पता</b></td>
                                                                                <td>{{$article->present_address}}</td>
                                                                                <td><b>District<br>जनपद</b></td>
                                                                                <td>{{districtName($article->present_district)}}</td>
                                                                                <td><b>State<br>राज्य</b></td>
                                                                                <td>{{stateName($article->present_state)}}</td>
                                                                              
                                                                            </tr>
                                                                            <tr>
                                                                                <td colspan="6" class="bg-light">
                                                                                    <strong>Permanent Address/स्थायी पता</strong>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td><b>Address<br>पता</b></td>
                                                                                <td>{{$article->permanent_address}}</td>
                                                                                <td><b>District<br>जनपद</b></td>
                                                                                <td>{{districtName($article->permanent_district)}}</td>
                                                                                <td><b>State<br>राज्य</b></td>
                                                                                <td>Uttar Pradesh</td>
                                                                              
                                                                            </tr>
                                                                            <tr>
                                                                                <td colspan="6" class="bg-light">
                                                                                    <strong>Bank Details/बैंक खाते का विवरण</strong>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td><b>Name of Bank<br>बैंक का नाम</b></td>
                                                                                <td>{{$article->bank_name}}</td>
                                                                                <td><b>Branch<br>शाखा</b></td>
                                                                                <td>{{$article->bank_branch}}</td>
                                                                                <td><b>Bank Account No.<br>बैंक खाता संख्या</b></td>
                                                                                <td>{{$article->bank_acc_no}}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td><b>IFSC<br>आईएफएससी</b></td>
                                                                                <td>{{$article->bank_ifsc}}</td>
                                                                                <td><b>Account Holder Name<br>खाता धारक का नाम</b></td>
                                                                                <td>{{$article->acc_holder_name}}</td>
                                                                                <td><b>PAN<br>पैन कार्ड</b></td>
                                                                                <td>{{$article->pan}}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td><b>Mobile No. (registered with Bank Account)<br>मोबाइल नंबर (बैंक खाते के साथ जो पंजीकृत है)</b></td>
                                                                                <td>{{$article->mobile_registered_in_bank}}</td>
                                                                                <td><b>Any other relevant information applicant wants to furnish?<br>कोई अन्य प्रासंगिक जानकारी आवेदक निर्दिष्ट करना चाहते हैं?</b></td>
                                                                                <td>{{$article->other_relevant_information_applicant}}</td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td colspan="6" class="bg-light"><strong>Sports Achievements/खेल संबंधी उपलब्धियां</strong>
                                                                                </td>
                                                                            </tr>
                                                                            @foreach($sport_achievement as $item)
                                                                            <tr>
                                                                                <td><b>Achievements Level<br>उपलब्धि का स्तर</b></td>
                                                                                <td>{{$item->sport_achievement}}</td>
                                                                                <td><b>Name of the Post<br>पोस्ट का नाम</b></td>
                                                                                <td>{{$item->sport_achievement_name}}</td>
                                                                                <td><b>Documents<br></b></td>
                                                                                <td>
                                                                                    @if($item->sport_achievement_docs !='')
                                                                                    <!-- <strong class="btn btn-success btn-xs">Uploaded</strong>
                                                                                        <a href="{{url('storage/financial_assistance',$item->sport_achievement_docs)}}" target="_blank">
                                                                                             <span class="btn btn-success btn-xs">View</span>
                                                                                        </a> -->
                                                                                        @php
                                                                                        $img = url('storage/financial_assistance').'/'.$item->sport_achievement_docs;
                                                                                        $img1 = url('public/images/images.svg');
                                                                                        $doc = explode('.',$item->sport_achievement_docs);
                                                                                        if($doc[1]=='pdf')
                                                                                        $img1 = url('public/images/pdf.svg');
                                                                                        @endphp
                                                                                        <img role="button" src="{{$img1}}" onclick="appendImage('{{$img}}','{{$doc[1]}}')" class="img-fluid img-query" />
                                                                                    
                                                                                    @else
                                                                                        <strong class="btn btn-danger btn-xs"> Not Uploaded</strong>
                                                                                    @endif
                                                                                </td>
                                                                            </tr>
                                                                            @endforeach
                                                                            <tr>
                                                                                <td colspan="6" class="bg-light">
                                                                                    <strong>Declaration/घोषणा</strong>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td colspan="1" align="center">
                                                                                    <input {{  ($article->final_submit == 1 ? 'disabled' : '') }}  {{  ($article->final_submit == 1 ? 'checked' : '') }} type="checkbox" id="checkbox"  />
                                                                                    &nbsp; <b>I Agree/मैं सहमत हूं</b>
                                                                                </td>
                                                                                <td colspan="5">I hereby certify that all the above facts are true and correct to the best of my knowledge. If any particulars given by me are found to be incorrect, I shall be held liable to refund the entire amount of Financial Assistance which has been/will be sanctioned to me on the basis of incorrect facts.<br>मैं एतद्द्वारा घोषणा करता/करती हूं कि मैंने आवेदन से संबंधित सभी नियम और शर्तें, पात्रता मानदंड और अन्य प्रासंगिक जानकारी पढ़ ली हैं एवं उनका पालन करता/करती हूं। मैं यह भी घोषणा करता/करती हूं कि उपरोक्त सभी विवरण मेरे अनुसार सत्य व सही हैं। यदि मेरा कोई भी तथ्य गलत अथवा असत्य पाया जाता है, तो मेरा आवेदन अस्वीकृत किया जा सकता है और इसके लिए पूर्णतः मैं स्वयं उत्तरदायी ठहराया जाऊंगा/जाऊंगी।
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td colspan="3" align="center">
                                                                                    <span>Date<br>तिथि</span><br>
                                                                                    <b>{{ dmy($article->created_at) }}</b>
                                                                                </td>
                                                                                <td colspan="3" align="center">
                                                                                    <img src="{{asset('storage/award/').'/'.$article->signature_doc}}" class="img-fluid" style="width: 140px;"><br>
                                                                                    <b>Signature<br>हस्ताक्षर</b>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <?php 
                                                                                 
                                                                                if($article->form_status == 1 || $article->form_status == 2 || $query_s != 0){ ?>
                                                                                    
                                                                                    @if($article->form_status == 1)
                                                                               
                                                                                        <td colspan="6" align="center">
                                                                                        <b>Form Status :-</b> <span class="btn btn-success disabled btn-sm ml-5">Accepted</span>
                                                                                        </td>
                                                                                        @elseif($article->form_status == 2)
                                                                                        <td colspan="6" align="center">
                                                                                        <b>Form Status :-</b> <span class="btn btn-danger btn-sm ml-5">Rejected</span>
                                                                                        </td>
                                                                                @else
                                                                                <td colspan="3"  class="noprint" align="center">
                                                                                    <b>Form Status :-</b> <span class="btn btn-danger btn-sm ml-5">Pending</span>
                                                                                    <!-- <a href="#" class="btn btn-info disabled btn-sm" data-bs-toggle="modal" data-bs-target="#query_form_marked">Mark Query</a> -->
                                                                                </td>
                                                                                <td colspan="3"  class="noprint" align="center">
                                                                                    <b>Action:- </b> &nbsp;
                                                                                    <a href="#" class="btn btn-info disabled btn-sm" data-bs-toggle="modal" data-bs-target="#query_form_marked">Mark Query</a>
                                                                                    <a href="#" class="btn btn-success disabled btn-sm" data-bs-toggle="modal" data-bs-target="#Subapp">Accept</a>
                                                                                    <a href="#" class="btn btn-danger disabled btn-sm" data-bs-toggle="modal" data-bs-target="#Rejectapp">Reject</a>
                                                                                </td>
                                                                                @endif
                                                                                    <!-- <td colspan="2" align="center">
                                                                                    <a href="#"  class="btn btn-info disabled btn-sm" data-bs-toggle="modal" data-bs-target="#query_form_marked">Mark Query</a>
                                                                                </td>
                                                                                <td colspan="2" align="center">
                                                                                    <a href="#" class="btn btn-success disabled btn-sm" data-bs-toggle="modal" data-bs-target="#Subapp">Accept</a>
                                                                                </td>
                                                                                <td colspan="2" align="center">
                                                                                    <a href="#"  class="btn btn-danger disabled btn-sm" data-bs-toggle="modal" data-bs-target="#Rejectapp">Reject</a>
                                                                                </td> -->
                                                                               
                                                                               
                                                                           <?php } else {?>
                                                                            <td colspan="3" class="noprint" align="center">
                                                                                    <b>Form Status :-</b> <span class="btn btn-danger btn-sm ml-5">Pending</span>
                                                                                    <!-- <a href="#" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#query_form_marked">Mark Query</a> -->
                                                                            </td>
                                                                            <td colspan="3"  class="noprint" align="center">
                                                                                <b>Action:- </b> &nbsp;
                                                                                <a href="#" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#query_form_marked">Mark Query</a>
                                                                                <a href="#" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#Subapp">Accept</a>
                                                                                <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#Rejectapp">Reject</a>

                                                                            </td>
                                                                                <?php } ?>
                                                                                    

                                                                                
                                                                            </tr>
                                                                        </table>
                                                                        @endforeach
                                                                        @if($article->form_status == 1 || $article->form_status == 2)
                                                                            @if(count($queryData) > 0)
                                                                            <x-query-details :queryData="$queryData" />
                                                                            @endif
                                                                        @else
                                                                        <x-query-details :queryData="$queryData" />
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
                            </div>
                        </div>
                    </div>
                </div>
            </div>

@endsection


<x-marked-query :id="$id" :type="4" />

        <!--For Reject Application-->
        <div class="modal fade" id="Rejectapp" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Reject Application</h5>
                        <!--<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
                    </div>
                    <form action="{{route('financial_is_rejected')}}" method="post">
                        @csrf
                    <div class="modal-body">
                        <h3 class="text-center">Are you sure to Reject the Application? Action once taken cannot be reverted.</h3>
                        <input type="hidden" name="user_id" value="{{$article->user_id}}">  
                        <input type="hidden" name="form_type" value="4">  
                        <div class="form-group mb-3">
                            <label class="placeholder">Remark</label>
                            <textarea required name="remark"  rows="1" class="form-control" cols="40"></textarea>
                        </div>
                    </div>
                   
                    <div class="modal-footer">
                       
                        <!--<button type="button" class="btn btn btn-outline-danger"><span class="icons icon-cloud-download"></span> Download</button>-->
                        <button type="submit" class="btn btn-info" >Yes</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        <!--For Submit Application-->
        <div class="modal fade" id="Subapp" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="exampleModalLabel">Accept Application</h5>
                        <!--<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
                    </div>
                    <form action="{{route('financial_is_accepted')}}" method="post">
                        @csrf
                    <div class="modal-body">
                        <h3 class="text-center">Are you sure to Accept the Application? Action once taken cannot be reverted.</h3>
                        <input type="hidden" name="user_id" value="{{$article->user_id}}">  
                        <input type="hidden" name="form_type" value="4"> 
                        <div class="form-group mb-3">
                            <label class="placeholder">Remark</label>
                            <textarea  name="remark"  rows="1" class="form-control" cols="40"></textarea>
                        </div>
                    </div>
                   
                    <div class="modal-footer">
                   
                        <!--<button type="button" class="btn btn btn-outline-danger"><span class="icons icon-cloud-download"></span> Download</button>-->
                        <button type="submit" class="btn btn-info" >Yes</button>
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">No</button>
                    </div>
                    </form>
                </div>
            </div>
        </div>

        

        <div class="modal fade" id="SubmitFrm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <!--<div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Instructions</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>-->
                    <div class="modal-body text-center">
                        <p>
                            <img src="images/sent.png" alt="Sent" title="Sent">
                        </p>
                        <div class="clearfix"></div>
                        <!--<h5>Your OTP verification is done successfully. Kindly <b>Proceed to Pay</b> the Registration Fee. After Fee Payment, your Registration on Portal will be completed, and Password will be sent on your registered Mobile No. & Email ID.</h5>-->
                        <h5>Your Registration is completed and Password has been sent on your registered Mobile No. & Email ID. Kindly Login to proceed.</h5>
                    </div>
                    <div class="modal-footer justify-content-md-center">
                        <div class="col-4 d-grid">
                            <a class="btn btn-info" href="dashboard.html">Final Submit</a>
                        </div>
    
                    </div>
                </div>
            </div>
        </div>
