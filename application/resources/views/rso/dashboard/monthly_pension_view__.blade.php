@extends('layouts/admin_layout')
@section('content')

<!-- <div class="row">
                <div class="col-2">
                    <div class="fixed-sidebar">
                        <a href="{{url('admin/monthly_pension')}}" class="btn btn-outline-info backbtn float-end"><span class="icons icon-arrow-left"></span>Back/पीछे</a>
                        <div class="left-sidebar">
                            <div >
                                <ul>
                                    <li>
                                        <button type="button" data-print="modal" class="btn btn-outline-primary float-end"  onclick="PrintDoc()"><span class="icons icon-arrow-right"></span>Print</button></li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div> -->
    <div class="pageheader" id="menu-margin">
        <h4 class="mb-0"> &nbsp;
        <a href="{{ asset('assets_admin/monthly_pension') }}"  class="btn btn-sm  btn-outline-primary ms-2 float-end " ><span class="icons icon-list"></span> Back to Dashboard</a>
            <button type="button" data-print="modal" class="btn btn-sm  btn-outline-primary ms-2 float-end "   onclick="PrintDoc()"><span class="icons icon-printer"></span> Print/प्रिंट</button>
        </h4>
    </div>
                <!-- <div class="col-10"> -->
                    <div class="bhoechie-tab-container">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                                <div class="bhoechie-tab-menu">
                                    <div class="list-group">
                                        <a  class="list-group-item active" style="width: 100%;">
                                            <span class="fas fa-file-pdf"></span>
                                            Application to Seek Monthly Pension 
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
                                                                                        <!-- <img src="images/logo.png" style="position: absolute; width: 70px; top: 5px; left: 0;"/> -->
                                                                                        <div style="font-size: 3vw; font-weight: bold;">
                                                                                            <!-- Department of Sports -->
                                                                                            Khel Sathi Portal / खेल साथी पोर्टल
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
												                        </p>
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
                                                                                <td colspan="2" class="text-center" rowspan="2"><b>Photograph of Applicant<br>आवेदक की फोटो</b><br />
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
                                                                                <td><b>Year in which won the Award<br>किस वर्ष में अवार्ड जीता था?</b></td>
                                                                                <td>{{$article->award_year}}</td>

                                                                                <td><b>Honoured with which Award?<br>किस पुरस्कार से सम्मानित किया गया?</b></td>
                                                                                <td>{{$article->honoured_award}}</td>

                                                                                <td><b>Upload Self-attested Copy of Award Certificate<br>पुरस्कार प्रमाण पत्र की स्व-सत्यापित प्रति अपलोड करें</b></td>
                                                                                <td>
                                                                                    @if($article->award_certificate !='')
                                                                                    @php
                                                                                    $img = url('storage/financial_assistance').'/'.$article->award_certificate;
                                                                                    $img1 = url('public/images/images.svg');
                                                                                    $doc = explode('.',$article->award_certificate);
                                                                                    if($doc[1]=='pdf')
                                                                                    $img1 = url('public/images/pdf.svg');
                                                                                    @endphp
                                                                                    <!-- <strong class="btn btn-success btn-xs">Uploaded</strong>
                                                                                        <a href="{{url('storage/financial_assistance',$article->award_certificate)}}" target="_blank">
                                                                                            <span class="btn btn-success btn-xs">View</span>
                                                                                        </a> -->
                                                                                        @php
                                                                                        $img = url('storage/financial_assistance').'/'.$article->award_certificate;
                                                                                        $img1 = url('public/images/images.svg');
                                                                                        $doc = explode('.',$article->award_certificate);
                                                                                        if($doc[1]=='pdf')
                                                                                        $img1 = url('public/images/pdf.svg');
                                                                                        @endphp
                                                                                        <img role="button" src="{{$img1}}" onclick="appendImage('{{$img}}','{{$doc[1]}}')" class="img-fluid img-query" />
                                                                                    
                                                                                    @else
                                                                                        <strong class="btn btn-danger btn-xs"> Not Uploaded</strong>
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
                                                                                <td>Uttar Pardesh</td>
                                                                              
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
                                                                                <td colspan="6" class="bg-light">
                                                                                    <strong>Declaration/घोषणा</strong>
                                                                                </td>
                                                                            </tr>
                                                                            <tr>
                                                                                <td colspan="1" align="center">
                                                                                    <input {{  ($article->final_submit == 1 ? 'disabled' : '') }}  {{  ($article->final_submit == 1 ? 'checked' : '') }} type="checkbox" id="checkbox"  />
                                                                                    &nbsp; <b>I Agree</b>
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


<x-marked-query :id="$id" :type="5" />

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
                        <input type="hidden" name="form_type" value="5"> 
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
                        <input type="hidden" name="form_type" value="5"> 
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

       
