@extends( 'layouts/admin_layout' )
@section( 'content' )


<div class="tab-content">
    <div class="pageheader">
        <h4 class="mb-0"> Application for Prize Money
            <button type="button" data-print="modal" class="btn btn-sm  btn-outline-primary ms-2 float-end " onclick="PrintDoc()" style="width: auto;"><span class="icons icon-printer"></span></button>
        </h4>
    </div>
    <div class="card">
        <div class="card-body" id="prodiv">
            <table class="dn" style="width: 100%; margin-bottom: 5px;" border="0">
                <tr>
                    <td colspan="2" align="center" style="position: relative; border: 0; padding-bottom: 5px;">
                        <div style="border-bottom: 0px solid #000; padding-bottom: 2vw;">
                        <img id="logo" src="{{ asset('') }}/assets_admin/images/logo.png" style="display:none;position: absolute; width: 70px; top: -7px; left: 0;"/> 
                            <div style="font-size: 25px; font-weight: bold;">
                                <!-- Department of Sports -->
                                Khel Sathi Portal / खेल साथी पोर्टल
                            </div>
                            <div style="font-size: 18px; font-weight: bold;">
                                Government of Uttar Pradesh/उत्तर प्रदेश सरकार
                            </div>
                            <div style="font-size: 18px; font-weight: bold;">Nomination Form to Seek Reward from Government of UP <br>उ0प्र0 सरकार से पुरस्कार प्राप्त करने हेतु नामांकन प्रपत्र</div>
                        </div>
                    </td>
                </tr>
            </table>
            @foreach($articles as $article)
            <p class="bg-light"><strong>Application no. / आवेदन क्रमांक:-</strong> <b>{{$article->application_no}}</b></p>
            <table id="dataTable" class="table table-bordered" border="1" style="border-collapse: collapse; width: 100%;">
                <tr>
                    <td colspan="6" class="bg-light">
                        <strong>Basic Details/सामान्य विवरण</strong>
                    </td>
                </tr>
                <tr>
                    <td style="width: 20%;"><b>Applicant Full Name<br>आवेदक का पूरा नाम</b></td>
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
                    <td><b>Mother’s Name<br>माता का नाम</b></td>
                    <td>{{$article->mother_name}}</td>
                    <td><b>Father’s Name<br>पिता का नाम</b></td>
                    <td>{{$article->father_name}}</td>
                </tr>
                <tr>
                    <td><b>Highest Educational Qualification<br>उच्चतम शैक्षणिक योग्यता</b></td>
                    <td>
                    @if($article->qualification == '10') 10th / High School @elseif($article->qualification == '12') 12th / Intermediate @elseif($article->qualification == 'graduation') Graduation @elseif($article->qualification == 'post_graduation') Post-Graduation @elseif($article->qualification == 'master_degree') Master Degree @elseif($article->qualification == 'phd') PhD @else Other @endif
                    </td>
                    <td><b>Gender<br>लिंग</b></td>
                    <td>{{$article->gender}}</td>
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
                        <strong>Competition Details/प्रतियोगिता का विवरण</strong>
                    </td>
                </tr>
                {{-- <tr>
                    <td><b>Type of Competition<br>प्रतियोगिता का प्रकार</b></td>
                    <td>{{$article->competition_type}}</td>
                    <td><b>Venue Name<br>स्थान का नाम</b></td>
                    <td>{{$article->venue_name}}</td>
                    <td><b>Event Type<br>प्रकार</b></td>
                    <td>{{$article->event_type}}</td>

                </tr>

                <tr>
                    <td><b>Earned Achievement<br>उपलब्धि (प्राप्त स्थान)</b></td>
                    <td>{{$article->earned_achievement}}</td>

                    <td><b>Start Date of Competition<br>प्रतियोगिता आरंभ होने की तिथि</b></td>
                    <td>{{$article->competition_from_date}}</td>
                    <td><b>End Date of Competition<br>प्रतियोगिता समाप्त होने की तिथि</b></td>
                    <td>{{$article->competition_to_date}}</td>

                </tr>
                <tr>
                    @if($article->award_certificate_affidavit !='')
                    <td><b>Upload Affidavit of Award Certificate<br>पुरुस्कार प्रमाणपत्र का शपथ पत्र अपलोड करें</b></td>
                    <td>
                        <!-- <a href="{{url('storage/position_holder',$article->award_certificate_affidavit)}}" target="_blank">
                            <span class="btn btn-success btn-xs">Uploaded</span>
                        </a> -->
                        <a href="{{url('storage/position_holder',$article->award_certificate_affidavit)}}" download target="_blank">
                            <!-- <span class="btn btn-success btn-xs"><i class="fa fa-download" aria-hidden="true"></i></span> -->
                            <i class="fa fa-download"></i>
                        </a>
                    </td>
                    @endif
                </tr>
                <tr>
                    <td colspan="6"><b>Upload Self-attested Copy of Award Certificate / पुरुस्कार प्रमाणपत्र की स्व सत्यापित प्रति अपलोड करें</b></td>
                </tr>
                @foreach($competition_award_docs as $key=>$item)
                <tr>
                    <td>{{$key + 1}}.</td>
                    <td colspan="4">
                        @if($item->award_certificate !='')
                        <a download href="{{url('storage/position_holder',$item->award_certificate)}}" target="_blank">
                            <!-- <span class="btn btn-success btn-xs">Uploaded</span> -->
                            <i class="fa fa-download"></i>
                        </a>
                        <!-- <a href="{{url('storage/position_holder',$item->award_certificate)}}" download target="_blank">
                            <span class="btn btn-success btn-xs"><i class="fa fa-download" aria-hidden="true"></i></span>
                        </a> -->
                        @else
                        <strong class="btn btn-danger btn-xs">Not Uploaded</strong>
                        @endif
                    </td>
                </tr>
                @endforeach --}}

                @foreach($competition_award_docs as $key=>$item)
                           
                <tr>
                    <td><b>Type of Competition<br>प्रतियोगिता का प्रकार</b></td>
                    <td>{{$item->comp}}</td>
                    <td><b>Event Type<br>आयोजन का प्रकार</b></td>
                    <td>@if($item->event_type==1)Individual @elseif($item->event_type==2)Team @else Both @endif</td>
                    <td><b>Event Name<br>आयोजन का नाम</b></td>
                    <td>{{$item->event}}</td>
                </tr>
                <tr>
                    <td><b>Earned Medals<br>अर्जित पदक</b></td>
                    <td>{{$item->earned_medals}}</td>
                    <td><b>Period of Competition<br>प्रतियोगिता की अवधि</b></td>
                    <td><b>From :-</b> {{$item->competition_from_date}} </br><b> To :-</b> {{$item->competition_to_date}}</td>
                    <td><b>Venue Name<br>स्थल का नाम</b></td>
                    <td>{{$item->place}}</td>
                    
                </tr>
                <tr>
                    <td><b>Event Detail<br>आयोजन का विवरण</b></td>
                    <td>{{$item->event_details}}</td>
                    <td><b>Relevant Certificate<br>प्रासंगिक प्रमाण पत्र</b></td>
                    <td>
                        @if($item->award_certificate !='')
                        <a download href="{{url('storage/position_holder',$item->award_certificate)}}" target="_blank">
                            <!-- <span class="btn btn-success btn-xs">Uploaded</span> -->
                            <i class="fa fa-download"></i>
                        </a>
                        @else
                        <strong class="btn btn-danger btn-xs">Not Uploaded</strong>
                        @endif
                    </td>
                </tr>
                @endforeach

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

                </tr>
                <tr>
                    <td colspan="2"><b>Mobile No. (registered with Bank Account)<br>मोबाइल नंबर (बैंक खाते के साथ जो पंजीकृत है)</b></td>
                    <td colspan="4">{{$article->mobile_registered_in_bank}}</td>
                </tr>
                <tr>
                    <td colspan="6" class="bg-light">
                        <strong>Documents/दस्तावेज़ </strong>
                    </td>
                </tr>
                <tr>
                    <td><b>PAN<br>पैन</b></td>
                    <td>
                        @if($article->pan_doc !='')
                        <!-- <a href="{{url('storage/position_holder',$article->pan_doc)}}" target="_blank">
                            <span class="btn btn-success btn-xs">Uploaded</span>
                        </a> -->
                        <a href="{{url('storage/position_holder',$article->pan_doc)}}" download target="_blank">
                            <!-- <span class="btn btn-success btn-xs"><i class="fa fa-download" aria-hidden="true"></i></span> -->
                            <i class="fa fa-download"></i>
                        </a>
                        @else
                        <strong class="btn btn-danger btn-xs">Not Uploaded</strong>
                        @endif
                    </td>

                    <td><b>Sports certificate issued by the general secretary of the concerned sports association.<br>संबंधित खेल संघ के महासचिव द्वारा जारी खेल प्रमाणपत्र</b></td>
                    <td>
                        @if($article->sport_certificate !='')

                        <!-- <a href="{{url('storage/position_holder',$article->sport_certificate)}}" target="_blank">
                            <span class="btn btn-success btn-xs">Uploaded</span>
                        </a> -->
                        <a href="{{url('storage/position_holder',$article->sport_certificate)}}" download target="_blank">
                            <!-- <span class="btn btn-success btn-xs"><i class="fa fa-download" aria-hidden="true"></i></span> -->
                            <i class="fa fa-download"></i>
                        </a>
                        @else
                        <strong class="btn btn-danger btn-xs">Not Uploaded</strong>
                        @endif
                    </td>

                    <td><b>First Page of Bank Passbook<br>बैंक पासबुक का प्रथम पृष्ठ</b></td>
                    <td>
                        @if($article->passbook_doc !='')
                        <!-- <a href="{{url('storage/position_holder',$article->passbook_doc)}}" target="_blank">
                            <span class="btn btn-success btn-xs">Uploaded</span>
                        </a> -->
                        <a href="{{url('storage/position_holder',$article->passbook_doc)}}" download target="_blank">
                            <!-- <span class="btn btn-success btn-xs"><i class="fa fa-download" aria-hidden="true"></i></span> -->
                            <i class="fa fa-download"></i>
                        </a>
                        @else
                        <strong class="btn btn-danger btn-xs">Not Uploaded</strong>
                        @endif
                    </td>
                </tr>
                <tr>
                    <td><b>Certificate of Highest Educational Qualification<br>उच्चतम शैक्षणिक योग्यता का प्रमाणपत्र </b></td>
                    <td>
                        @if($article->qualification_doc !='')
                        <!-- <a href="{{url('storage/position_holder',$article->qualification_doc)}}" target="_blank">
                            <span class="btn btn-success btn-xs">Uploaded</span>
                        </a> -->
                        <a href="{{url('storage/position_holder',$article->qualification_doc)}}" download target="_blank">
                            <!-- <span class="btn btn-success btn-xs"><i class="fa fa-download" aria-hidden="true"></i></span> -->
                            <i class="fa fa-download"></i>
                        </a>
                        @else
                        <strong class="btn btn-danger btn-xs">Not Uploaded</strong>
                        @endif
                    </td>
                    <td><b>Domicile Certificate of UP<br>उत्तर प्रदेश का मूल निवास प्रमाण पत्र</b></td>
                    <td>
                        @if($article->domicile_certificate !='')
                        <!-- <a href="{{url('storage/position_holder',$article->domicile_certificate)}}" target="_blank">
                            <span class="btn btn-success btn-xs">Uploaded</span>
                        </a> -->
                        <a href="{{url('storage/position_holder',$article->domicile_certificate)}}" download target="_blank">
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
                        &nbsp; <b>I Agree<br>मैं सहमत हूं</b>
                    </td>
                    <td colspan="5">I hereby declare that I have read all terms & conditions, eligibility criteria and other relevant information related to the Application and abide by them. I also declare that all the above particulars are true to the best of my knowledge. If any of my facts are found to be wrong or incorrect, my application shall be liable for rejection and I shall be solely held responsible for it.<br>मैं एतद्द्वारा घोषणा करता/करती हूं कि मैंने आवेदन से संबंधित सभी नियम और शर्तें, पात्रता मानदंड और अन्य प्रासंगिक जानकारी पढ़ ली हैं एवं उनका पालन करता/करती हूं। मैं यह भी घोषणा करता/करती हूं कि उपरोक्त सभी विवरण मेरे अनुसार सत्य व सही हैं। यदि मेरा कोई भी तथ्य गलत अथवा असत्य पाया जाता है, तो मेरा आवेदन अस्वीकृत किया जा सकता है और इसके लिए पूर्णतः मैं स्वयं उत्तरदायी ठहराया जाऊंगा/जाऊंगी।
                    </td>
                </tr>
                <tr>
                    <td colspan="3" align="center">
                        <span>Date/तिथि</span><br>
                        <b>{{ dmy($article->created_at) }}</b>
                    </td>
                    <td colspan="3" align="center">
                        <img src="{{asset('storage/award/').'/'.$article->signature_doc}}" class="img-fluid" style="width: 140px; height: 50px;"><br>
                        <b>Signature/हस्ताक्षर</b>
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
                            <!-- <a href="#" class="btn btn-info disabled btn-sm" data-bs-toggle="modal" data-bs-target="#query_form_marked">Mark Query</a> -->
                        </td>
                        <td colspan="3" class="noprint" align="center">
                        @if(Auth::guard('admin')->user()->admin_role ==3 || Auth::guard('admin')->user()->admin_role ==1 || Auth::guard('admin')->user()->admin_role ==18)

                            <b>Action:- </b> &nbsp;
                            @if(Auth::guard('admin')->user()->admin_role ==3)
                                <a href="#" class="btn btn-info btn-sm @if($query_s ==1) disabled @endif" data-bs-toggle="modal" data-bs-target="#query_form_marked">Mark Query</a>
                            @endif
                            @if(Auth::guard('admin')->user()->admin_role == 2)
                            <a href="#" class="btn btn-success disabled btn-sm" data-bs-toggle="modal" data-bs-target="#Subapp">Accept</a>

                            <a href="#" class="btn btn-danger  btn-sm" data-bs-toggle="modal" data-bs-target="#Rejectapp">Reject</a>
                            @endif
                            @endif
                        </td>
                        <!-- <td colspan="2" align="center">
                            <a href="#"  class="btn btn-danger disabled btn-sm" data-bs-toggle="modal" data-bs-target="#Rejectapp">Reject</a>
                        </td> -->
                        @endif


                    <?php } else { ?>
                        <td colspan="3" class="noprint" align="center">
                            <b>Form Status :-</b> <span class="btn btn-danger btn-sm ml-5">Pending</span>
                            <!-- <a href="#" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#query_form_marked">Mark Query</a> -->
                        </td>
                        <td colspan="3" class="noprint" align="center">
                        @if(Auth::guard('admin')->user()->admin_role ==3 || Auth::guard('admin')->user()->admin_role ==1 || Auth::guard('admin')->user()->admin_role ==18)
                            <b>Action:- </b> &nbsp;
                            @if(Auth::guard('admin')->user()->admin_role ==3)
                                <a href="#" class="btn btn-info btn-sm @if($query_s ==1) disabled @endif" data-bs-toggle="modal" data-bs-target="#query_form_marked">Mark Query</a>
                            @endif
                            @if(Auth::guard('admin')->user()->admin_role != 1 && Auth::guard('admin')->user()->admin_role !=18)
                            <?php $da="disabled";
                            if(isset($article->is_forwarded_by_rso) && $article->is_forwarded_by_rso ==1){
                                $da="";
                            }?>
                            <a href="#" class="btn btn-success btn-sm {{$da}}" data-bs-toggle="modal" data-bs-target="#Subapp">Accept</a>

                            <a href="#" class="btn btn-danger btn-sm {{$da}}" data-bs-toggle="modal" data-bs-target="#Rejectapp">Reject</a>
                            @endif
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
                                                                        $sss = 0;
                                                                        if (Auth::guard('admin')->user()->admin_role == 3 && $article->is_forwarded_by_rso > 2) {
                                                                            $sss = 1;
                                                                        }
                                                                        if (Auth::guard('admin')->user()->admin_role == 11 && $article->is_forwarded_by_rso > 3) {
                                                                            $sss = 1;
                                                                        }
                                                                        $tt = get_last_reply($article->application_no);
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
                                                                        @if((count($queryData) > 0) && (Auth::guard('admin')->user()->admin_role != 2))
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
@endsection


<x-marked-query :id="$id" :type="3" />

<!--For Reject Application-->
<div class="modal fade" id="Rejectapp" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Reject Application</h5>
                <!--<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
            </div>
            <form action="{{route('award_is_rejected')}}" method="post">
                @csrf
                <div class="modal-body">
                    <h3 class="text-center">Are you sure to Reject the Application? Action once taken cannot be reverted.</h3>
                    <input type="hidden" name="user_id" @if(isset($articles[0]->application_no)) value="{{$article->application_no}}" @endif >
                    <input type="hidden" name="form_type" value="3">
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
            <form action="{{route('award_is_accepted')}}" method="post">
                @csrf
                <div class="modal-body">
                    <h3 class="text-center">Are you sure to Accept the Application? Action once taken cannot be reverted.</h3>
                    <input type="hidden" name="user_id"  @if(isset($articles[0]->application_no)) value="{{$article->application_no}}" @endif >
                    <input type="hidden" name="form_type" value="3">
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
                    <input type="hidden" name="form_type" value="3">
                    <input type="hidden" class="sender_id" name="sender_id" value="">
                    <input type="hidden"  class="reciever_id" name="reciever_id" value="">

                    <label class="placeholder">Remark <span class="text-danger">*</span></label>
                    <textarea class="form-control" required name="remark" id="is_mark_query" cols="95" rows="2"></textarea>

                    <label>Query Document <span class="text-danger remove_danger">*</span></label>
                    <div class="input-group">
                        <input type="file" required name="query_doc_by_admin" class="form-control remove_danger" onchange="getfileext(this.value,103)" id="File103" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
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
                    <input type="hidden" name="form_type" value="3">
                    <input type="hidden" name="is_rso" value="1">
                    <input type="hidden" class="sender_id" name="sender_id" value="">
                    <input type="hidden"  class="reciever_id" name="reciever_id" value="">

                    <label class="placeholder">Remark <span class="text-danger">*</span></label>
                    <textarea class="form-control" required name="remark" id="is_mark_query" cols="95" rows="2"></textarea>

                    <label id="verification_document">Query Document <span class="text-danger remove_danger">*</span></label>
                    <div class="input-group">
                        <input type="file" required name="forward_verification_document" class="form-control remove_danger" onchange="getfileext(this.value,102)" id="File102" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
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
<!--Query reply  By RSO-->
<div class="modal fade" id="reply_of_asso_query" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Query for Supporting Document</h5>
                <!--<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
            </div>
            <form action="{{route('query_reply_for_supporting_document')}}" method="post" enctype="multipart/form-data">
                <div class="modal-body">
                    @csrf
                    <input type="hidden" name="user_id" @if(isset($articles[0]->application_no)) value="{{$articles[0]->application_no}}" @endif />
                    <input type="hidden" name="form_type" value="3">
                    <input type="hidden" name="is_rso" value="2">
                    <input type="hidden" class="sender_id" name="sender_id" value="">
                    <input type="hidden"  class="reciever_id" name="reciever_id" value="">

                    <label class="placeholder">Remark <span class="text-danger">*</span></label>
                    <textarea class="form-control" required name="remark" id="is_mark_query" cols="95" rows="2"></textarea>

                    <label >Query Document <span class="text-danger remove_danger">*</span></label>
                    <div class="input-group">
                        <input type="file" required name="forward_verification_document" class="form-control remove_danger" onchange="getfileext(this.value,101)" id="File101" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
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
<!--Query reply  By RSO to admin-->
<div class="modal fade" id="reply_of_admin_query" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                    <input type="hidden" name="form_type" value="3">
                    <input type="hidden" name="is_rso" value="3">
                    <input type="hidden" class="sender_id" name="sender_id" value="">
                    <input type="hidden"  class="reciever_id" name="reciever_id" value="">

                    <label class="placeholder">Remark <span class="text-danger">*</span></label>
                    <textarea class="form-control" required name="remark" id="is_mark_query" cols="95" rows="2"></textarea>

                    <label>Query Document <span class="text-danger remove_danger">*</span></label>
                    <div class="input-group">
                        <input type="file" required name="forward_verification_document" class="form-control remove_danger" onchange="getfileext(this.value,104)" id="File104" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
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
