@extends('layouts/admin_layout')
@section('content')

<div class="row">
    <div class="col-12">
        <div class="bhoechie-tab-container">
            <div class="row">
                <h4 class="mb-2">
                    <button type="button" data-print="modal" class="btn btn-sm  btn-outline-primary ms-2 float-end " onclick="PrintDoc()" style="width: auto;"><span class="icons icon-printer"></span></button>
                </h4>
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="bhoechie-tab-menu">
                        <div class="list-group">
                            <a class="list-group-item active" style="width: 100%;">
                                <span class="fas fa-file-pdf"></span>
                                Application Preview For Direct Recruitment
                            </a>
                        </div>
                        <div class="text-center" style="background: #fff; padding: 10px;">
                            @if(session()->has('success_marked'))
                            <div id="hide_data" class="alert alert-success" style="width: 300px;margin: 0 auto;" role="alert">
                                {{session()->get('success_marked')}}  
                            </diV>
                            @endif
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
                                                <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                                    <div class="row">
                                                        <div class="col-md-12" id="prodiv">
                                                            <table class="dn" style="width: 100%; margin-bottom: 5px;" border="0">
                                                                <tr>
                                                                    <td colspan="2" align="center" style="position: relative; border: 0; padding-bottom: 5px;">
                                                                        <div style="border-bottom: 0px solid #000; padding-bottom: 2vw;">
                                                                        <img id="logo" src="{{ asset('') }}/assets_admin/images/logo.png" style="display:none;position: absolute; width: 70px; top: -7px; left: 0;"/> 
                                                                            <div style="font-size: 25px; font-weight: bold;">
                                                                                <!-- Department of Sports -->
                                                                                Khel Sathi Portal/खेल साथी पोर्टल
                                                                            </div>
                                                                            <div style="font-size: 18px; font-weight: bold;">
                                                                                Government of Uttar Pradesh/उत्तर प्रदेश सरकार
                                                                            </div>
                                                                            <div style="font-size: 18px; font-weight: bold;">
                                                                                Application Form of Direct Recruitment as Gazetted Officer<br>राजपत्रित अधिकारी के रूप में सीधी भर्ती हेतु ऑनलाइन आवेदन
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                            </table>
                                                            @foreach($details as $article)
                                                            <p class="bg-light"><strong>Applicant's Details/आवेदक का विवरण :-</strong> <b>{{$article->application_no}}</b></p>
                                                            <table id="dataTable" class="table table-bordered" border="1" style="border-collapse: collapse; width: 100%;">
                                                                <tr>
                                                                    <td colspan="8" class="bg-light">
                                                                        <strong style=" font-size: 1.5vw; font-weight: bold; ">Basic Details</strong>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td><b>Applicant Name</b></td>
                                                                    <td>{{$article->fullname}}</td>
                                                                    <td><b>Which Sport did/do you play?</td>
					                                                <td>{{$article->sport_name}}</td>
                                                                    <td><b>Mobile Number</b></td>
                                                                    <td>{{$article->mobile}}</td>
                                                                   
                                                                    <td rowspan="2" colspan="2"><b>Photograph of Applicant</b><br />
                                                                        <div class="text-center" style="padding: 5px;" align="center">
                                                                            <img src="{{asset('storage/award/').'/'.$article->photograph_doc}}" class="img-fluid" style="width: 140px;" />
                                                                        </div>
                                                                    </td>
                                                                </tr>
                                                               
                                                                <tr>
                                                                <td><b>Email ID</b></td>
                                                                    <td>{{$article->email}}</td>
                                                                    <td><b>Mother’s Name</b></td>
                                                                    <td>{{$article->mother_name}}</td>
                                                                    <td><b>Father’s Name</b></td>
                                                                    <td>{{$article->father_name}}</td>
                                                                </tr>
                                                                <tr>
                                                                    <td><b>Date of Birth</b></td>
                                                                    <td>{{$article->dob}}</td>
                                                                    <td><b>Place of Birth</b></td>
                                                                    <td>{{districtName($article->place_of_birth)}}</td>
                                                                    <td><b>Gender</b></td>
                                                                    <td>{{$article->gender}}</td>
                                                                    <td><b>Aadhar Number</b></td>
                                                                    <td>{{$article->aadhar_no}}</td>
                                                                </tr>
                                                                <tr>
                                                                    
                                                                    <td style="width: 15%"><b>Marital Status</b></td>
                                                                    <td style="width: 20%">{{$article->marital_status}}</td>
                                                                    <td><b>Category</b></td>
                                                                    <td>
                                                                        <!-- {{$article->category}} -->
                                                                    @if($article->catt == 1) General @endif
                                                                        @if($article->catt == 2) OBC @endif
                                                                        @if($article->catt == 3) SC @endif
                                                                        @if($article->catt == 4) ST @endif
                                                                        @if($article->catt == 5) Other @endif
                                                                    </td>
                                                                    <td style="width: 15%"><b>Religion</b></td>
                                                                    <td style="width: 20%">{{$article->religiii}}</td>
                                                                    <td style="width: 15%"><b>Nationality</b></td>
                                                                    <td style="width: 15%">{{$article->nationality}}</td>
                                                                </tr>
                                                                <tr>
                                                                
                                                                </tr>
                                                                <tr>
																<td colspan="8" class="bg-light">
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
                                                                <td><b>State<br>राज्य</b>
																</td>
																<td>{{stateName($article->present_state)}}</td>
															</tr>
															<tr>
																<td><b>Pin Code<br>पिन कोड</b>
																</td>
																<td colspan="5">{{($article->present_pincode )}}</td>
															</tr>
															<tr>
																<td colspan="8" class="bg-light">
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
																<td><b>State<br>राज्य</b>
																</td>
																<td>Uttar Pradesh</td>
															</tr>
															<tr>
															
																<td><b>Pin Code<br>पिन कोड</b>
																</td>
																<td colspan="5">{{($article->permanent_pincode )}}</td>
															</tr>
                                                                <tr>
                                                                    <td colspan="8" class="bg-light">
                                                                        <strong style=" font-size: 1.5vw; font-weight: bold; ">Posts Details</strong>
                                                                    </td>
                                                                </tr>
                                                                @foreach( $post as $key=>$post)
                                                                <tr>
                                                                    <td><b>
                                                                            @if($post->post_type == '1') Prefrence 1
                                                                            @elseif($post->post_type == '2') Prefrence 2
                                                                            @elseif($post->post_type == '3') Prefrence 3
                                                                            @elseif($post->post_type == '4') Prefrence 4
                                                                            @else Prefrence 5
                                                                            @endif
                                                                        </b></td>

                                                                    <td colspan="8">

                                                                        <span>{{postName($post->post_name)}}</span>

                                                                    </td>

                                                                </tr>

                                                                @endforeach

                                                                <tr>
                                                                    <td colspan="8" class="bg-light">
                                                                        <strong>Sports Achievements/खेल क्षेत्र में उपलब्धियां</strong>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td rowspan="2"><label>Sports Competition Name <br>खेलकूद प्रतियोगिता का नाम</label> <span class="text-danger">*</span>
                                                                    </td>
                                                                    <td rowspan="2"><label>Sport Name<br>खेल का नाम</label> <span class="text-danger">*</span>
                                                                    </td>
                                                                    <td rowspan="2"><label>Position / Medal<br>पद का नाम / पदक</label> <span class="text-danger">*</span>
                                                                    </td>
                                                                    <td colspan="2" class="text-center"><label>Period of Competition<br>प्रतियोगिता की अवधि</label> <span class="text-danger">*</span>
                                                                    </td>
                                                                    <td rowspan="2"><label>Venue Name</br>स्थल का नाम</label> <span class="text-danger">*</span< /td>
                                                                    <td rowspan="2"><label>Upload Relevant Certificate<br>प्रासंगिक प्रमाण पत्र अपलोड करें<span class="text-danger">*</span>
                                                                        </label>
                                                                    </td>
                                                                    <td rowspan="2"><label>Sport Event Detail</br>खेलकूद प्रतियोगिता का विवरण<span class="text-danger">*</span></label> </td>
                                                                    
                                                                </tr>
                                                                <tr>
                                                                    <td><label>From </label>
                                                                    </td>
                                                                    <td><label>To </label>
                                                                    </td>
                                                                </tr>
                                                                @foreach($sportAchievement as $item)
                                                                <tr>
                                                                    <td class="form-group">
                                                                    {{sportNEventName($item->sport_event)}}
                                                                    </td>
                                                                    <td>
                                                                    {{sport_name($item->sport_name)}}
                                                                    </td>
                                                                    <td>
                                                                    {{$item->medal}}
                                                                    </td>
                                                                    <!--  -->
                                                                    <td>
                                                                    {{$item->competition_from_date}}
                                                                    </td>
                                                                    <td>
                                                                    {{$item->competition_to_date}}
                                                                    </td>
                                                                    <td>
                                                                    {{$item->sport_place}}
                                                                    </td>
                                                                    <td style="text-align:center">
                                                                        @if($item->sport_achievement_docs !='')
                                                                            <a  download href="{{url('storage/direct_recruitment',$item->sport_achievement_docs)}}" target="_blank">
                                                                                <!-- <span class="btn btn-success btn-xs"> Uploaded</span> -->
                                                                                <i class="fa fa-eye"></i>
                                                                            </a>
                                                                        @else
                                                                            <strong class="btn btn-danger btn-xs">Not Uploaded</strong>
                                                                        @endif
                                                                    </td>
                                                                    <td>
                                                                    {{$item->event_details}}
                                                                    </td>
                                                                    <!--  -->
                                                                </tr>
                                                                @endforeach
                                                                <tr>
                                                                    <td colspan="8" class="bg-light">
                                                                        <strong style=" font-size: 1.5vw; font-weight: bold; ">Documents/दस्तावेज़</strong>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td><b>Aadhar Card</b></td>
                                                                    <td>
                                                                        @if($article->aadhar_doc !='')
                                                                        <a download href="{{url('storage/award',$article->aadhar_doc)}}" target="_blank">
                                                                            <!-- <span class="btn btn-success btn-xs"> Uploaded</span> -->
                                                                            <i class="fa fa-download"></i>
                                                                        </a>
                                                                        @else
                                                                        <strong class="btn btn-danger btn-xs">Not Uploaded</strong>
                                                                        @endif
                                                                    </td>
                                                                    
                                                                    <td><b>Highest Educational Qualification</b></td>
                                                                    <td>
                                                                        @if($article->qualification_doc !='')
                                                                        <a download href="{{url('storage/direct_recruitment',$article->qualification_doc)}}" target="_blank">
                                                                            <!-- <span class="btn btn-success btn-xs"> Uploaded</span> -->
                                                                            <i class="fa fa-download"></i>
                                                                        </a>
                                                                        @else
                                                                        <strong class="btn btn-danger btn-xs">Not Uploaded</strong>
                                                                        @endif
                                                                    </td>

                                                                    <td><b>Domicile Certificate issued by the Competent Authority</b></td>
                                                                    <td>
                                                                        @if($article->domicile_certificate !='')
                                                                        <!-- <strong class="btn btn-success btn-xs">Uploaded</strong> -->
                                                                        <a download href="{{url('storage/direct_recruitment',$article->domicile_certificate)}}" target="_blank">
                                                                            <!-- <span class="btn btn-success btn-xs"> Uploaded</span> -->
                                                                            <i class="fa fa-download"></i>
                                                                        </a>
                                                                        @else
                                                                        <strong class="btn btn-danger btn-xs">Not Uploaded</strong>
                                                                        @endif
                                                                    </td>
                                                                    <td><b>Sport Achievement Doc</b></td>
                                                                        <td>
                                                                            @if($article->achievement_doc !='')
                                                                            <!-- <strong class="btn btn-success btn-xs">Uploaded</strong> -->
                                                                            <a download href="{{url('storage/direct_recruitment',$article->achievement_doc)}}" target="_blank">
                                                                                <!-- <span class="btn btn-success btn-xs"> Uploaded</span> -->
                                                                                <i class="fa fa-download"></i>
                                                                            </a>
                                                                            @else
                                                                        <strong class="btn btn-danger btn-xs">Not Uploaded</strong>
                                                                        @endif
                                                                    </td>
                                                                
                                                                </tr>
                                                                <tr>
                                                                    <td><b>Birth Certificate</b></td>
                                                                    <td>
                                                                        @if($article->birth_certificate !='')
                                                                        <a download href="{{url('storage/award',$article->birth_certificate)}}" target="_blank">
                                                                            <!-- <span class="btn btn-success btn-xs"> Uploaded</span> -->
                                                                            <i class="fa fa-download"></i>
                                                                        </a>
                                                                        @else
                                                                        <strong class="btn btn-danger btn-xs">Not Uploaded</strong>
                                                                        @endif
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="8" class="bg-light">
                                                                        <strong style=" font-size: 1.5vw; font-weight: bold; ">Declaration</strong>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="2" align="center">

                                                                        <input type="checkbox" id="checkbox" disabled checked="checked" />
                                                                        &nbsp; <b>I Agree</b>

                                                                    </td>
                                                                    <td colspan="6">I do hereby undertake that the above information given by me is correct and true to the best of my knowledge and belief and nothing has been concealed.
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <td colspan="4" align="center">
                                                                        <strong>Date</strong><br>
                                                                        <b>{{ dmy($article->created_at)}}</b>
                                                                    </td>
                                                                    <td colspan="4" align="center">
                                                                        <img src="{{asset('storage/award/').'/'.$article->signature_doc}}" class="img-fluid" style="width: 140px;" /><br />
                                                                        <b>Signature</b>
                                                                    </td>
                                                                </tr>
                                                                <tr>
                                                                    <?php

                                                                    if ($article->form_status == 1 || $article->form_status == 2 || $query_s != 0) { ?>
                                                                        <!-- <td colspan="2" align="center">
                                                                                    <a href="#"  class="btn btn-info disabled btn-sm" data-bs-toggle="modal" data-bs-target="#query_form_marked">Mark Query</a>
                                                                                </td>
                                                                                <td colspan="2" align="center">
                                                                                    <a href="#" class="btn btn-success disabled btn-sm" data-bs-toggle="modal" data-bs-target="#Subapp">Accept</a>
                                                                                </td>
                                                                                <td colspan="2" align="center">
                                                                                    <a href="#"  class="btn btn-danger disabled btn-sm" data-bs-toggle="modal" data-bs-target="#Rejectapp">Reject</a>
                                                                                </td> -->
                                                                        @if($article->form_status == 1)
                                                                        <td colspan="8" align="center">
                                                                            <b>Form Status :-</b> <span class="btn btn-success disabled btn-sm ml-5">Accepted</span>
                                                                        </td>
                                                                        @elseif($article->form_status == 2)
                                                                        <td colspan="8" align="center">
                                                                            <b>Form Status :-</b> <span class="btn btn-danger btn-sm ml-5">Rejected</span>
                                                                        </td>
                                                                        @else
                                                                        <td colspan="4" class="noprint" align="center">
                                                                            <b>Form Status :-</b> <span class="btn btn-danger btn-sm ml-5">Pending</span>
                                                                            <!-- <a href="#" class="btn btn-info disabled btn-sm" data-bs-toggle="modal" data-bs-target="#query_form_marked">Mark Query</a> -->
                                                                        </td>
                                                                        @if(Auth::guard('admin')->user()->admin_role !=18)
                                                                        <td colspan="4" class="noprint" align="center">
                                                                            <b>Action:- </b> &nbsp;
                                                                            @if(Auth::guard('admin')->user()->admin_role != 4)
                                                                            <a href="#" class="btn btn-info disabled btn-sm" data-bs-toggle="modal" data-bs-target="#query_form_marked">Mark Query</a>
                                                                            @endif
                                                                            
                                                                            @if(Auth::guard('admin')->user()->admin_role == 4 || Auth::guard('admin')->user()->admin_role == 2)
                                                                            <a href="#" class="btn btn-success disabled btn-sm" data-bs-toggle="modal" data-bs-target="#Subapp">Accept</a>
                                                                            <a href="#" class="btn btn-danger disabled btn-sm" data-bs-toggle="modal" data-bs-target="#Rejectapp">Reject</a>
                                                                            @endif
                                                                        </td>
                                                                        @endif
                                                                        @endif


                                                                    <?php } else { ?>
                                                                        <td colspan="4" class="noprint" align="center">
                                                                            <b>Form Status :-</b> <span class="btn btn-danger btn-sm ml-5">Pending</span>
                                                                            <!-- <a href="#" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#query_form_marked">Mark Query</a> -->
                                                                        </td>
                                                                        <td colspan="4" class="noprint" align="center">
                                                                            @if(Auth::guard('admin')->user()->admin_role == 11)
                                                                            <b>Action:- </b> &nbsp;
                                                                            <a href="#" class="btn btn-info btn-sm" data-bs-toggle="modal" data-bs-target="#query_form_marked">Mark Query</a>
                                                                            @endif
                                                                            <!-- @if(Auth::guard('admin')->user()->admin_role != 4)
                                                                            <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#Rejectapp">Reject</a>
                                                                            @endif -->


                                                                            @if(Auth::guard('admin')->user()->admin_role == 1 || Auth::guard('admin')->user()->admin_role == 8)
                                                                            <b>Action:- </b> &nbsp;
                                                                            @if(Auth::guard('admin')->user()->admin_role == 1)
                                                                            <a href="#" class="btn btn-success btn-sm" data-bs-toggle="modal" data-bs-target="#Subapp">Accept</a>
                                                                            @endif
                                                                            <a href="#" class="btn btn-danger btn-sm" data-bs-toggle="modal" data-bs-target="#Rejectapp">Reject</a>
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
                                                                            @if($article->form_status == 0)
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
                                                                            @endif
                                                                            @endforeach
                                                                            {{-- @if(Auth::guard('admin')->user()->admin_role != 1 && Auth::guard('admin')->user()->admin_role != 4)
                                                                    @if($article->form_status == 1 || $article->form_status == 2) --}}
                                                                    {{-- @if(Auth::guard('admin')->user()->admin_role == 1 || Auth::guard('admin')->user()->admin_role == 11) --}}
                                                                            @if(count($queryData) > 0)
                                                                            <x-query-details :queryData="$queryData" />
                                                                            @endif
                                                                    {{-- @endif --}}
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
</div>

@endsection

<x-marked-query :id="$id" :type="6" />

<!--For Reject Application-->
<div class="modal fade" id="Rejectapp" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Reject Application</h5>
                <!--<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
            </div>
            <form action="{{route('direct_is_rejected')}}" method="post">
                @csrf
                <div class="modal-body">
                    <h3 class="text-center">Reject Application</h3>
                    <input type="hidden" name="user_id" value="{{$article->user_id}}">
                    <input type="hidden" name="form_type" value="6">
                    <h3 class="text-center">Are you sure to Reject the Application? Action once taken cannot be reverted.</h3>
                    <div class="form-group">
                        <label class="placeholder">Remark</label>
                        <textarea name="remark" required rows="3" class="form-control" cols="40"></textarea>
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
                <h5 class="modal-title" id="exampleModalLabel">Submit Application</h5>
                <!--<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
            </div>
            <div class="modal-body">
                <h3 class="text-center">Successfully Submit Application</h3>
            </div>
            <form action="{{route('direct_is_accepted')}}" method="post">
                @csrf
                <div class="modal-footer">
                    <input type="hidden" name="user_id" value="{{$article->user_id}}">
                    <input type="hidden" name="form_type" value="6">
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
                    <input type="hidden" name="user_id" @if(isset($details[0]->application_no) )value="{{$details[0]->application_no}}" @endif />
                    <input type="hidden" name="form_type" value="6">
                    <input type="hidden" class="sender_id" name="sender_id" value="">
                    <input type="hidden" class="reciever_id" name="reciever_id" value="">

                    <label class="placeholder">Remark <span class="text-danger">*</span></label>
                    <textarea class="form-control" required name="remark" id="is_mark_query" cols="95" rows="2"></textarea>

                    <label>Query Document <span class="text-danger remove_danger">*</span></label>
                    <div class="input-group">
                        <input type="file" required name="query_doc_by_admin" class="form-control remove_danger" onchange="getfileext(this.value,10)" id="File10" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
                    </div>
                </div>
                <div class="modal-footer">
                    <div>
                        <input type="submit" class="btn btn-info" value="Send">
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
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
                    <input type="hidden" name="user_id" @if(isset($details[0]->application_no) )value="{{$details[0]->application_no}}" @endif/>
                    <input type="hidden" name="form_type" value="6">
                    <input type="hidden" class="sender_id" name="sender_id" value="">
                    <input type="hidden" class="reciever_id" name="reciever_id" value="">
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
                        <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
