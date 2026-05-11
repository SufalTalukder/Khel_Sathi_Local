@extends('layouts/admin_layout')
@section('content')

<div class="row">
    <div class="col-12">
        <div class="bhoechie-tab-container">
            <div class="row">
                <h4 class="mb-2"> &nbsp;
                    <button type="button" data-print="modal" class="btn btn-sm  btn-outline-primary ms-2 float-end " onclick="PrintDoc()" style="width: auto;"><span class="icons icon-printer"></span></button>
                </h4>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="bhoechie-tab-menu">
                        <div class="list-group">
                            <a class="list-group-item active" style="width: 100%;">
                                <span class="fas fa-file-pdf"></span>
                                Application to Seek Financial Assistance
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
                                <div class="col-md-12" id="prodiv">
                                    <table class="dn" style="width: 100%; margin-bottom: 5px;" border="0">
                                        <tr>
                                            <td colspan="2" align="center" style="position: relative; border: 0; padding-bottom: 5px;">
                                                <div style="border-bottom: 0px solid #000; padding-bottom: 2vw;">
                                                <img id="logo" src="{{ asset('') }}/assets_admin/images/logo.png" style="display:none;position: absolute; width: 70px; top: -7px; left: 0;"/> 
                                                    <div style="font-size: 25px; font-weight: bold;">
                                                        Khel Sathi Portal/खेल साथी पोर्टल
                                                    </div>
                                                    <div style="font-size: 18px; font-weight: bold;">
                                                        Government of Uttar Pradesh/उत्तर प्रदेश सरकार
                                                    </div>
                                                    <div style="font-size: 18px; font-weight: bold;">Online System for Former Sportspersons of UP to Seek Financial Assistance/Monthly Pension <br> वित्तीय ससहायता /मासिक पेंशन प्राप्त करने हेतु उत्तर प्रदेश के पूर्व खिलाड़ियों के लिए ऑनलाइन प्रणाली</div>
                                                </div>
                                            </td>
                                        </tr>
                                    </table>
                                    @foreach($articles as $article)
                                    <p class="bg-light"><strong>Application no. / आवेदन क्रमांक:-</strong> <b>{{$article->application_no}}</b>
                                    <table id="dataTable" class="table table-bordered" border="1" style="border-collapse: collapse; width: 100%;">
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
                                            <td colspan="2" rowspan="5"><b>Photograph of Applicant<br>आवेदक की फोटो</b><br />
                                                <div class="text-center" style="padding: 5px;" align="center">
                                                    <img src="{{asset('storage/award/').'/'.$article->photograph_doc}}" class="img-fluid" style="width: 140px; height: 150px;" />
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
                                            <td colspan="4" class="bg-light">
                                                <strong>Applicant's Details/आवेदक का विवरण</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><b>Date of Birth<br>जन्म तिथि</b></td>
                                            <td>{{$article->dob}}</td>
                                            <td><b>Place of Birth<br>जन्म स्थान</bvr></b></td>
                                            <td>{{districtName($article->place_of_birth)}}</td>
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
                                            </td>
                                            <td><b>Mother’s Name<br>माता का नाम</b></td>
                                            <td>{{$article->mother_name}}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Father’s Name<br>पिता का नाम</b></td>
                                            <td>{{$article->father_name}}</td>
                                            <td><b>Gender<br>लिंग</b></td>
                                            <td colspan="3">{{$article->gender}}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" class="bg-light">
                                                <strong>Financial Assistance Details/वित्तीय ससहायता संबंधी विवरण</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><b>Monthly Income through personal sources (INR)<br>निजी स्त्रोतों द्वारा मासिक आय (भारतीय रुपया)</b></td>
                                            <td>{{$article->monthly_income_personal}}</td>
                                            <td><b>Name of Sport used to play?<br>कौन सा खेल खेलते थे?</b></td>
                                            <td>{{$article->sport_name}}</td>
                                            <td><b>Level of Sport<br>खेल स्तर</b></td>
                                            <td>{{$article->level_of_report}}</td>
                                        </tr>
                                        <tr>
                                            <td><b>Details of Total Professional Experience<br>कुल व्यावसायिक अनुभव</b></td>
                                            <td>{{$article->total_professional_experience}}</td>
                                            <td><b>Details, if hold the experience of Sports Association<br>विवरण, यदि खेल संघ का अनुभव रखते हैं</b></td>
                                            <td>{{$article->experience_sports_association}}</td>
                                            <td><b>Details of Income from other Sources<br>अन्य स्रोतों से आय का विवरण</b></td>
                                            <td>{{$article->income_other_sources}}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"><b>Details of Assistance being taken benefits<br>सहायता को न्यायोचित ठहराते हुए प्रासंगिक दस्तावेज अपलोड करें</b></td>
                                            <td>{{$article->details_of_assistance_benefits}}</td>
                                            <td colspan="2"><b>Is Applicant Physically Challenged ?<br>क्या आवेदक शारीरिक रूप से अक्षम है?</b></td>
                                            <td>{{$article->physical_condition}}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" class="bg-light">
                                                <strong>Current Address/वर्तमान पता</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><b>Flat No. / House No.<br>फ्लैट संख्या / मकान संख्या</b>
                                            </td>
                                            <td>{{$article->present_flat_no}}</td>
                                            <td><b>Complete Address<br>पूरा पता</b>
                                            </td>
                                            <td>{{$article->present_address}}</td>
                                            <td><b>District<br>जनपद</b>
                                            </td>
                                            <td>{{districtName($article->present_district)}}</td>
                                        </tr>
                                        <tr>
                                            <td><b>State<br>राज्य</b>
                                            </td>
                                            <td>{{stateName($article->present_state)}}</td>
                                            <td><b>Pin Code<br>पिन कोड</b>
                                            </td>
                                            <td colspan="5">{{($article->present_pincode )}}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" class="bg-light">
                                                <strong>Permanent Address/स्थायी पता</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><b>Flat No. / House No.<br>फ्लैट संख्या / मकान संख्या</b>
                                            </td>
                                            <td>{{$article->permanent_flat_no}}</td>
                                            <td><b>Complete Address<br>पूरा पता</b>
                                            </td>
                                            <td>{{$article->permanent_address}}</td>
                                            <td><b>District<br>जनपद</b>
                                            </td>
                                            <td>{{districtName($article->permanent_district)}}</td>
                                            
                                        </tr>
                                        <tr>
                                        <td><b>State<br>राज्य</b>
                                            </td>
                                            <td>Uttar Pradesh</td>
                                            <td><b>Pin Code<br>पिन कोड</b>
                                            </td>
                                            <td colspan="5">{{($article->permanent_pincode )}}</td>
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
                                            <td colspan="2"><b>Mobile No. (registered with Bank Account)<br>मोबाइल नंबर (बैंक खाते के साथ जो पंजीकृत है)</b></td>
                                            <td>{{$article->mobile_registered_in_bank}}</td>
                                            <td colspan="2"><b>Any other relevant information applicant wants to furnish?<br>कोई अन्य प्रासंगिक जानकारी आवेदक निर्दिष्ट करना चाहते हैं?</b></td>
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
                                                <!-- <strong class="btn btn-success btn-xs">Uploaded</strong> -->
                                                <!-- <a href="{{url('storage/financial_assistance',$item->sport_achievement_docs)}}" target="_blank">
                                                    <span class="btn btn-success btn-xs">Uploaded</span>
                                                </a> -->
                                                <a href="{{url('storage/financial_assistance',$item->sport_achievement_docs)}}" download target="_blank">
                                                    <!-- <span class="btn btn-success btn-xs"><i class="fa fa-download" aria-hidden="true"></i></span> -->
                                                    <i class="fa fa-download"></i>
                                                </a>
                                                @else
                                                <strong class="btn btn-danger btn-xs"> Not Uploaded</strong>
                                                @endif
                                            </td>
                                        </tr>
                                        @endforeach
                                        <tr>
                                            <td colspan="6" class="bg-light"><strong>Documents/दस्तावेज़</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><b>Certificate of Highest Educational Qualification<br>उच्चतम शैक्षणिक योग्यता का प्रमाणपत्र </b></td>
                                            <td>
                                                @if($article->qualification_doc !='')
                                                <!-- <a href="{{url('storage/financial_assistance',$article->qualification_doc)}}" target="_blank">
                                                    <span class="btn btn-success btn-xs">Uploaded</span>
                                                </a> -->
                                                <a href="{{url('storage/financial_assistance',$article->qualification_doc)}}" download target="_blank">
                                                    <!-- <span class="btn btn-success btn-xs"><i class="fa fa-download" aria-hidden="true"></i></span> -->
                                                    <i class="fa fa-download"></i>
                                                </a>
                                                @else
                                                <strong class="btn btn-danger btn-xs">Not Uploaded</strong>
                                                @endif
                                            </td>
                                            <td><b>Domicile Certificate of UP<br>उत्तर प्रदेश का मूल निवास प्रमाण पत्र </b></td>
                                            <td>
                                                @if($article->domicile_certificate !='')
                                                <!-- <a href="{{url('storage/financial_assistance',$article->domicile_certificate)}}" target="_blank">
                                                    <span class="btn btn-success btn-xs">Uploaded</span>
                                                </a> -->
                                                <a href="{{url('storage/financial_assistance',$article->domicile_certificate)}}" download target="_blank">
                                                    <!-- <span class="btn btn-success btn-xs"><i class="fa fa-download" aria-hidden="true"></i></span> -->
                                                    <i class="fa fa-download"></i>

                                                </a>
                                                @else
                                                <strong class="btn btn-danger btn-xs">Not Uploaded</strong>
                                                @endif
                                            </td>
                                            <td><b>Income Certificate<br>आय प्रमाणपत्र </b></td>
                                            <td>
                                                @if($article->income_certificate !='')
                                                <!-- <a href="{{url('storage/financial_assistance',$article->income_certificate)}}" target="_blank">
                                                    <span class="btn btn-success btn-xs">Uploaded</span>
                                                </a> -->
                                                <a href="{{url('storage/financial_assistance',$article->income_certificate)}}" download target="_blank">
                                                    <!-- <span class="btn btn-success btn-xs"><i class="fa fa-download" aria-hidden="true"></i></span> -->
                                                    <i class="fa fa-download"></i>

                                                </a>
                                                @else
                                                <strong class="btn btn-danger btn-xs">Not Uploaded</strong>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><b>Relevant Documents Justifying the Experience<br>अनुभव को सही ठहराते हुए प्रासंगिक दस्तावेज</b></td>
                                            <td>
                                                @if($article->document_justifying_experience !='')
                                                <!-- <a href="{{url('storage/financial_assistance',$article->document_justifying_experience)}}" target="_blank">
                                                    <span class="btn btn-success btn-xs">Uploaded</span>
                                                </a> -->
                                                <a href="{{url('storage/financial_assistance',$article->document_justifying_experience)}}" download target="_blank">
                                                    <!-- <span class="btn btn-success btn-xs"><i class="fa fa-download" aria-hidden="true"></i></span> -->
                                                    <i class="fa fa-download"></i>
                                                </a>
                                                @else
                                                <strong class="btn btn-danger btn-xs">Not Uploaded</strong>
                                                @endif
                                            </td>
                                            <td><b>Relevant Documents Justifying the Income<br>आय को न्यायोचित ठहराते हुए प्रासंगिक दस्तावेज</b></td>
                                            <td>
                                                @if($article->income_document_other_sources !='')
                                                <!-- <a href="{{url('storage/financial_assistance',$article->income_document_other_sources)}}" target="_blank">
                                                    <span class="btn btn-success btn-xs">Uploaded</span>
                                                </a> -->
                                                <a href="{{url('storage/financial_assistance',$article->income_document_other_sources)}}" download target="_blank">
                                                    <!-- <span class="btn btn-success btn-xs"><i class="fa fa-download" aria-hidden="true"></i></span> -->
                                                    <i class="fa fa-download"></i>
                                                </a>
                                                @else
                                                <strong class="btn btn-danger btn-xs">Not Uploaded</strong>
                                                @endif
                                            </td>
                                            <td><b>Relevant Documents Justifying the Assistance<br>सहायता को न्यायोचित ठहराते हुए प्रासंगिक दस्तावेज</b></td>
                                            <td>
                                                @if($article->relevant_documents_justifing_assistance !='')
                                                <!-- <a href="{{url('storage/financial_assistance',$article->relevant_documents_justifing_assistance)}}" target="_blank">
                                                    <span class="btn btn-success btn-xs">Uploaded</span>
                                                </a> -->
                                                <a href="{{url('storage/financial_assistance',$article->relevant_documents_justifing_assistance)}}" download target="_blank">
                                                    <!-- <span class="btn btn-success btn-xs"><i class="fa fa-download" aria-hidden="true"></i></span> -->
                                                    <i class="fa fa-download"></i>
                                                </a>
                                                @else
                                                <strong class="btn btn-danger btn-xs">Not Uploaded</strong>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3"><b>Medical Certificate if the applicant is unfit or disabled<br>यदि आवेदक अक्षम अथवा दिव्यांग है तो चिकित्सा प्रमाणपत्र</b></td>
                                            <td colspan="3">
                                                @if($article->medical_certificate !='')
                                                <!-- <a href="{{url('storage/financial_assistance',$article->medical_certificate)}}" title="View" target="_blank">
                                                    <span class="btn btn-success btn-xs"><i class="fa fa-eye" aria-hidden="true"></i></span>
                                                </a> -->
                                                <a href="{{url('storage/financial_assistance',$article->medical_certificate)}}" title="Download" download target="_blank">
                                                    <!-- <span class="btn btn-success btn-xs"><i class="fa fa-download" aria-hidden="true"></i></span> -->
                                                    <i class="fa fa-download"></i>
                                                </a>
                                                @else
                                                <strong class="btn btn-danger btn-xs">Not Uploaded</strong>
                                                @endif
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="6" class="bg-light">
                                                <strong>Declaration/घोषणा</strong>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="1" align="center">
                                                <input {{  ($article->final_submit == 1 ? 'disabled' : '') }} {{  ($article->final_submit == 1 ? 'checked' : '') }} type="checkbox" id="checkbox" />
                                                &nbsp; <b>I Agree/मैं सहमत हूं</b>
                                            </td>
                                            <td colspan="5">I hereby certify that all the above facts are true and correct to the best of my knowledge. If any particulars given by me are found to be incorrect, I shall be held liable to refund the entire amount of Financial Assistance which has been/will be sanctioned to me on the basis of incorrect facts.<br>मैं एतद्द्वारा घोषणा करता/करती हूं कि मैंने आवेदन से संबंधित सभी नियम और शर्तें, पात्रता मानदंड और अन्य प्रासंगिक जानकारी पढ़ ली हैं एवं उनका पालन करता/करती हूं। मैं यह भी घोषणा करता/करती हूं कि उपरोक्त सभी विवरण मेरे अनुसार सत्य व सही हैं। यदि मेरा कोई भी तथ्य गलत अथवा असत्य पाया जाता है, तो मेरा आवेदन अस्वीकृत किया जा सकता है और इसके लिए पूर्णतः मैं स्वयं उत्तरदायी ठहराया जाऊंगा/जाऊंगी।
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="3" align="center">
                                                <span>Date/तिथि</span><br>
                                                <b>{{ dmy($article->created_at) }}</b>
                                            </td>
                                            <td colspan="3" align="center">
                                                <img src="{{asset('storage/award/').'/'.$article->signature_doc}}" class="img-fluid" style="width: 140px; height: 50px;"><br>
                                                <b>Signature<br>हस्ताक्षर</b>
                                            </td>
                                        </tr>
                                        <tr>
                                            <?php
                                            if ($article->form_status == 1 || $article->form_status == 2 || $query_s != 0) { ?>
                                                @if($article->form_status == 1)
                                                <td colspan="6" align="center">
                                                    <b>Form Status :-</b> <span class="btn btn-success disabled btn-sm ml-5">Accepted</span>
                                                </td>
                                                @elseif($article->form_status == 2)
                                                <td colspan="6" align="center">
                                                    <b>Form Status :-</b> <span class="btn btn-danger btn-sm ml-5">Rejected</span>
                                                </td>
                                                @else
                                                <td colspan="3" class="noprint" align="center">
                                                    <b>Form Status :-</b> <span class="btn btn-danger btn-sm ml-5">Pending</span>
                                                </td>
                                                <td colspan="3" class="noprint" align="center">
                                                    <b>Action:- </b> &nbsp;
                                                    @if(Auth::guard('admin')->user()->admin_role != 1 && Auth::guard('admin')->user()->admin_role !=18)
                                                    <a href="#" class="btn btn-info btn-sm @if($query_s ==1) disabled @endif" data-bs-toggle="modal" data-bs-target="#query_form_marked">Mark Query</a>
                                                    @endif
                                                    @if(Auth::guard('admin')->user()->admin_role == 1 || Auth::guard('admin')->user()->admin_role ==18)
                                                    <?php $da="disabled";
																			if(isset($article->is_forwarded_by_association) && $article->is_forwarded_by_association == 1){
																				$da="";
																			}?>
                                                    <a href="#" class="btn btn-success disabled btn-sm {{$da}}" data-bs-toggle="modal" data-bs-target="#Subapp">Accept</a>
                                                    <a href="#" class="btn btn-danger disabled btn-sm {{$da}}" data-bs-toggle="modal" data-bs-target="#Rejectapp">Reject</a>
                                                    @endif
                                                </td>
                                                @endif
                                            <?php } else { ?>
                                                <td colspan="3" class="noprint" align="center">
                                                    <b>Form Status :-</b> <span class="btn btn-danger btn-sm ml-5">Pending</span>
                                                </td>
                                                <td colspan="3" class="noprint" align="center">
                                                    <b>Action:- </b> &nbsp;
                                                    @if(Auth::guard('admin')->user()->admin_role != 1 && Auth::guard('admin')->user()->admin_role !=18)
                                                    <a href="#" class="btn btn-info btn-sm @if($query_s ==1) disabled @endif" data-bs-toggle="modal" data-bs-target="#query_form_marked">Mark Query</a>
                                                    @endif
                                                    @if(Auth::guard('admin')->user()->admin_role != 1 && Auth::guard('admin')->user()->admin_role !=18)
                                                    <?php $da="disabled";
																			if(isset($article->is_forwarded_by_association) && $article->is_forwarded_by_association == 1){
																				$da="";
																			}?>
                                                    <a href="#" class="btn btn-success btn-sm {{$da}}" data-bs-toggle="modal" data-bs-target="#Subapp">Accept</a>
                                                    <a href="#" class="btn btn-danger btn-sm {{$da}}" data-bs-toggle="modal" data-bs-target="#Rejectapp">Reject</a>
                                                    @endif
                                                </td>
                                            <?php } ?>
                                        </tr>
                                    </table>
                                    <div class="accordion" id="accordionChat">
                                        <div class="accordion-item">
                                            <?php
                                            $check_name = 0;
                                            $class = "out";
                                            ?>
                                            @foreach($comment_data as $key=>$item)
                                            @if($key==0)
                                            <h2 class="accordion-header" id="headingOne">
                                                <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#collapseOne" aria-expanded="false" aria-controls="collapseOne">
                                                    <div class="subj">
                                                        <h6 class="text-uppercase fw-bold mb-1">
                                                            Supporting Document By Association
                                                        </h6>
                                                    </div>
                                                </button>
                                            </h2>
                                            <div id="collapseOne" class="accordion-collapse collapse show" aria-labelledby="headingOne" data-bs-parent="#accordionChat">
                                                <div class="accordion-body">
                                                    @endif
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            <ul class="chat-list">

                                                                @if( !empty($item->comments))
                                                                <?php
                                                                if ($item->sender_id != $check_name && $class == "in")
                                                                    $class = "out";
                                                                elseif ($item->sender_id == $check_name && $class == "in")
                                                                    $class = "in";
                                                                elseif ($item->sender_id == $check_name && $class == "out")
                                                                    $class = "out";
                                                                else
                                                                    $class = "in";
                                                                ?>

                                                                <li class={{$class}}>

                                                                    <div class="chat-img">
                                                                        <img alt="Avtar" src="{{asset('storage/direct_recruitment/profile.jpg')}}">
                                                                    </div>
                                                                    @php $check_name=$item->sender_id; @endphp
                                                                    <div class="chat-body">
                                                                        <div class="chat-message">
                                                                            <h5 class="name">{{rsoName($item->sender_id)}} @if(!empty($item->doc))<a class="doc_download" href="{{url('public/verification_document', $item->doc)}}" download target="_blank"><i class="fa fa-download attachfile"></i></a>@endif</h5>
                                                                            <p class="comment">{{$item->comments}}</p>
                                                                        </div>
                                                                        <div>
                                                                            <small class="text-muted"><b>Reply On: {{dmyHi($item->created_at)}}</b></small>
                                                                        </div>
                                                                    </div>
                                                                </li>
                                                                <!-- <li class="out">
                                                    <div class="chat-img">
                                                        <img alt="Avtar" src="{{asset('storage/direct_recruitment/').'/'.$article->photograph_doc}}">
                                                    </div>
                                                    <div class="chat-body">
                                                        <div class="chat-message">
                                                            <h5><a  href="{{url('public/verification_document', $item->doc)}}" download target="_blank"><i class="fa fa-download attachfile"></i></a> {{rsoName($item->sender_id)}}</h5>
                                                            <p>{{$item->comments}}</p>
                                                        </div>
                                                        <div>
                                                            <small class="text-muted"><b>Reply On: 19 February, 2023 16:39 PM</b></small>
                                                        </div>
                                                    </div>
                                                </li> -->
                                                                @else
                                                                <div class="text-danger"> Not Uploaded</div>
                                                                @endif
                                                            </ul>
                                                        </div>
                                                    </div>
                                                    <div class="separator-dashed"></div>
                                                    @endforeach
                                                    <?php 
                                                        $sss=0;
                                                        if(Auth::guard('admin')->user()->admin_role==3 && ($article->form_status == 1 || $article->form_status == 2)){
                                                            $sss=1;
                                                        }
                                                        $tt=get_last_reply($article->application_no);
                                                    ?>
                                                    @if(isset($article->form_status) && $article->form_status == 0 )
                                                    @if($tt && (Auth::guard('admin')->user()->id != $tt->sender_id) && $sss==0)
                                                    @if($tt->type != 2)
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
                                                    {{-- @if(Auth::guard('admin')->user()->admin_role != 1 && Auth::guard('admin')->user()->admin_role != 4)
                                            @if($article->form_status == 1 || $article->form_status == 2) --}}
                                                    @if(count($queryData) > 0)
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
@endsection
<x-marked-query :id="$id" :type="4" />
<!--For Reject Application-->
<div class="modal fade" id="Rejectapp" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Reject Application</h5>
                <!--<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
            </div>
            <form action="{{route('financial_is_rejected')}}" method="post">
                @csrf
                <div class="modal-body">
                    <h3 class="text-center">Are you sure to Reject the Application? Action once taken cannot be reverted.</h3>
                    <input type="hidden" name="user_id" @if(isset($articles[0]->application_no) )value="{{$articles[0]->application_no}}" @endif>
                    <input type="hidden" name="form_type" value="4">
                    <div class="form-group">
                        <label class="placeholder">Remark</label>
                        <textarea required name="remark" rows="3" class="form-control" cols="40"></textarea>
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
<div class="modal fade" id="Subapp" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Accept Application</h5>
                <!--<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
            </div>
            <form action="{{route('financial_is_accepted')}}" method="post">
                @csrf
                <div class="modal-body">
                    <h3 class="text-center">Are you sure to Accept the Application? Action once taken cannot be reverted.</h3>
                    <input type="hidden" name="user_id" @if(isset($articles[0]->application_no) )value="{{$articles[0]->application_no}}" @endif>
                    <input type="hidden" name="form_type" value="4">
                    <div class="form-group">
                        <label class="placeholder">Remark</label>
                        <textarea name="remark" rows="3" class="form-control" cols="40"></textarea>
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
<!--Query Document By Adminstrator-->
<div class="modal fade" id="query_form_admin" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Query For Supporting Document</h5>
                <!--<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
            </div>
            <form action="{{route('save_query_for_supporting_document')}}" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="user_id" @if(isset($articles[0]->application_no) )value="{{$articles[0]->application_no}}" @endif />
                    <input type="hidden" name="form_type" value="4">
                    <input type="hidden" class="sender_id" name="sender_id" value="">
                    <input type="hidden"  class="reciever_id" name="reciever_id" value="">
                    <div class="form-group">
                        <label class="placeholder">Remark <span class="text-danger">*</span></label>
                        <textarea class="form-control" required name="remark" id="is_mark_query" cols="95" rows="2"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Query Document <span class="text-danger remove_danger">*</span></label>
                        <div class="input-group">
                            <input type="file" required name="query_doc_by_admin" class="form-control remove_danger" onchange="getfileext(this.value,10)" id="File10" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
                        </div>
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
<div class="modal fade" id="reply_of_query" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Reply of Query</h5>
                <!--<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
            </div>
            <form action="{{route('query_reply_for_supporting_document')}}" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="user_id" @if(isset($articles[0]->application_no)) value="{{$articles[0]->application_no}}" @endif />
                    <input type="hidden" name="form_type" value="4">
                    <input type="hidden" class="sender_id" name="sender_id" value="">
                    <input type="hidden"  class="reciever_id" name="reciever_id" value="">
                    <div class="form-group">
                        <label class="placeholder">Remark <span class="text-danger">*</span></label>
                        <textarea class="form-control" required name="remark" id="is_mark_query" cols="95" rows="2"></textarea>
                    </div>
                    <div class="form-group">
                        <label>Query Document <span class="text-danger remove_danger">*</span></label>
                        <div class="input-group">
                            <input type="file" required name="forward_verification_document" class="form-control remove_danger" onchange="getfileext(this.value,10)" id="File10" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
                        </div>
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
