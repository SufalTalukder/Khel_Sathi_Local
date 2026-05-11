@extends('layouts/layout')
@section('content')

<div class="container">
    <div class="pageheader">
        <div class="row">
            <div class="col-md-12">
                <h4 class="mb-0">Application Preview/एप्लिकेशन पूर्वावलोकन <a href="{{ route('dashboard') }}" class="btn btn-sm  btn-outline-dark  float-end"><span class="icons icon-arrow-left"></span> Dashboard</a>
                    @if(isset($articles[0]) && $articles[0]->final_submit == 1)
                    <button type="button" data-print="modal" class="btn btn-sm  btn-outline-primary ms-2 float-end " onclick="PrintDoc()" style="width: auto;"><span class="icons icon-printer"></span></button>
                    @endif
                </h4>
            </div>
        </div>
    </div>
    <div class="bhoechie-tab">
        <div class="bhoechie-tab-content active">
            <div class="form-scroll">
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
                                                                        <div style="font-size: 18px; font-weight: bold;">Online System for Former Sportspersons of UP to Seek Financial Assistance/Monthly Pension <br> वित्तीय सहायता /मासिक पेंशन प्राप्त करने हेतु उत्तर प्रदेश के पूर्व खिलाड़ियों के लिए ऑनलाइन प्रणाली</div>
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                        @foreach($articles as $article)
                                                        <p @if($article->final_submit != 1) style="display: none" @endif class="bg-light"><strong>Applicant's Details/आवेदक का विवरण :-</strong> <b id="application_no">{{$article->application_no}}</b></p>
                                                        <p @if($article->amount_release_status != 1) style="display: none" @endif class="bg-light"><strong>Amount Released/धनराशि :-</strong> <b>{{$article->amount_release}}</b></p>
                                                        <table id="dataTable" class="table table-bordered" border="1" style="border-collapse: collapse; width: 100%;">
                                                            <tr>
                                                                <td colspan="6" class="bg-light">
                                                                    <strong>Basic Details/सामान्य विवरण</strong>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td><b>Applicant Full Name/आवेदक का पूरा नाम</b></td>
                                                                <td>{{$article->fullname}}</td>
                                                                <td><b>Which Sport did/do you play?<br>कौन सा खेल खेलते थे/हैं?</b></td>
                                                                <td>{{$article->sport_name}}</td>
                                                                <td colspan="2" rowspan="4"><b>Photograph of Applicant<br>आवेदक की फोटो</b><br />
                                                                    <div class="text-center" style="padding: 5px;" align="center">
                                                                        <img src="{{asset('storage/award/').'/'.$article->photograph_doc}}" class="img-fluid" style="width: 140px;" />
                                                                    </div>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td><b>Mobile Number / मोबाइल नंबर</b></td>
                                                                <td>{{$article->mobile}}</td>
                                                                <td><b>Email ID/ईमेल आईडी</b></td>
                                                                <td>{{$article->email}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="4" class="bg-light">
                                                                    <strong>Applicant's Details/आवेदक का विवरण</strong>
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td><b>Date of Birth/जन्म तिथि</b></td>
                                                                <td>{{$article->dob}}</td>
                                                                <td><b>Place of Birth/जन्म स्थान
                                                                    </b>
                                                                </td>
                                                                <td>{{districtName($article->place_of_birth)}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td><b>Mother’s Name/माता का नाम</b></td>
                                                                <td>{{$article->mother_name}}</td>
                                                                <td><b>Father’s Name/पिता का नाम</b></td>
                                                                <td>{{$article->father_name}}</td>
                                                                <td><b>Gender<br>लिंग</b></td>
                                                                <td>{{$article->gender}}</td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="2"><b>Highest Educational Qualification<br>उच्चतम शैक्षणिक योग्यता</b></td>
                                                                <td colspan="4">
                                                                    @if($article->qualification == '10') 10th / High School
                                                                    @elseif($article->qualification == '12') 12th / Intermediate
                                                                    @elseif($article->qualification == 'graduation') Graduation
                                                                    @elseif($article->qualification == 'master_degree') Master Degree
                                                                    @else Other
                                                                    @endif
                                                                </td>
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
                                                                <td><b>Details of Assistance being taken benefits<br>सहायता को न्यायोचित ठहराते हुए प्रासंगिक दस्तावेज अपलोड करें</b></td>
                                                                <td>{{$article->details_of_assistance_benefits}}</td>
                                                                <td><b>Is Applicant Physically Challenged ?<br>क्या आवेदक शारीरिक रूप से अक्षम है? </b></td>
                                                                <td>{{$article->physical_condition}}</td>
                                                                <!--  no column-->
                                                                <!-- <td><b>Association approved certificate<br>एसोसिएशन द्वारा अनुमोदित प्रमाणपत्र</b>
                                                                </td>
                                                                <td>
                                                                    @if($article->association_certificate_upload !='')
                                                                    <a href="{{url('storage/financial_assistance',$article->association_certificate_upload)}}" target="_blank">
                                                                        <span class="btn btn-success btn-xs">Uploaded</span>
                                                                    </a>
                                                                    @else
                                                                    <strong class="btn btn-danger btn-xs">Not Uploaded</strong> @endif
                                                                </td> -->
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
                                                                <td colspan="6" class="bg-light"><strong>Sports Achievements/वित्तीय ससहायता हेतु आवेदन पत्र</strong>
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
                                                                    <a download href="{{url('storage/financial_assistance',$item->sport_achievement_docs)}}" target="_blank">
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
                                                                    <a download href="{{url('storage/financial_assistance',$article->qualification_doc)}}" target="_blank">
                                                                        <!-- <span class="btn btn-success btn-xs">Uploaded</span> -->
                                                                        <i class="fa fa-download"></i>
                                                                    </a>
                                                                    @else
                                                                    <strong class="btn btn-danger btn-xs">Not Uploaded</strong>
                                                                    @endif
                                                                </td>
                                                                <td><b>Domicile Certificate of UP<br>उत्तर प्रदेश का मूल निवास प्रमाण पत्र </b></td>
                                                                <td>
                                                                    @if($article->domicile_certificate !='')
                                                                    <a download href="{{url('storage/financial_assistance',$article->domicile_certificate)}}" target="_blank">
                                                                        <!-- <span class="btn btn-success btn-xs">Uploaded</span> -->
                                                                        <i class="fa fa-download"></i>
                                                                    </a>
                                                                    @else
                                                                    <strong class="btn btn-danger btn-xs">Not Uploaded</strong>
                                                                    @endif
                                                                </td>
                                                                <td><b>Income Certificate<br>आय प्रमाणपत्र </b></td>
                                                                <td>
                                                                    @if($article->income_certificate !='')
                                                                    <a download href="{{url('storage/financial_assistance',$article->income_certificate)}}" target="_blank">
                                                                        <!-- <span class="btn btn-success btn-xs">Uploaded</span> -->
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
                                                                    <a download href="{{url('storage/financial_assistance',$article->document_justifying_experience)}}" target="_blank">
                                                                        <!-- <span class="btn btn-success btn-xs">Uploaded</span> -->
                                                                        <i class="fa fa-download"></i>
                                                                    </a>
                                                                    @else
                                                                    <strong class="btn btn-danger btn-xs">Not Uploaded</strong>
                                                                    @endif
                                                                </td>
                                                                <td><b>Relevant Documents Justifying the Income<br>आय को न्यायोचित ठहराते हुए प्रासंगिक दस्तावेज</b></td>
                                                                <td>
                                                                    @if($article->income_document_other_sources !='')
                                                                    <a download href="{{url('storage/financial_assistance',$article->income_document_other_sources)}}" target="_blank">
                                                                        <!-- <span class="btn btn-success btn-xs">Uploaded</span> -->
                                                                        <i class="fa fa-download"></i>
                                                                    </a>
                                                                    @else
                                                                    <strong class="btn btn-danger btn-xs">Not Uploaded</strong>
                                                                    @endif
                                                                </td>
                                                                <td><b>Relevant Documents Justifying the Assistance<br>सहायता को न्यायोचित ठहराते हुए प्रासंगिक दस्तावेज</b></td>
                                                                <td>
                                                                    @if($article->relevant_documents_justifing_assistance !='')
                                                                    <a download href="{{url('storage/financial_assistance',$article->relevant_documents_justifing_assistance)}}" target="_blank">
                                                                        <!-- <span class="btn btn-success btn-xs">Uploaded</span> -->
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
                                                                    <a download href="{{url('storage/financial_assistance',$article->medical_certificate)}}" target="_blank">
                                                                        <!-- <span class="btn btn-success btn-xs">Uploaded</span> -->
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
                                                                <td align="center">
                                                                    <input {{  ($article->final_submit == 1 ? 'disabled' : '') }} {{  ($article->final_submit == 1 ? 'checked' : '') }} type="checkbox" id="checkbox" />
                                                                    &nbsp; <b>I Agree/मैं सहमत हूं</b>
                                                                </td>
                                                                <td colspan="5">I hereby certify that all the above facts are true and correct to the best of my knowledge. If any particulars given by me are found to be incorrect, I shall be held liable to refund the entire amount of Financial Assistance which has been/will be sanctioned to me on the basis of incorrect facts.<br>मैं एतद्द्वारा घोषणा करता/करती हूं कि मैंने आवेदन से संबंधित सभी नियम और शर्तें, पात्रता मानदंड और अन्य प्रासंगिक जानकारी पढ़ ली हैं एवं उनका पालन करता/करती हूं। मैं यह भी घोषणा करता/करती हूं कि उपरोक्त सभी विवरण मेरे अनुसार सत्य व सही हैं। यदि मेरा कोई भी तथ्य गलत अथवा असत्य पाया जाता है, तो मेरा आवेदन अस्वीकृत किया जा सकता है और इसके लिए पूर्णतः मैं स्वयं उत्तरदायी ठहराया जाऊंगा/जाऊंगी।
                                                                </td>
                                                            </tr>
                                                            <tr>
                                                                <td colspan="3" align="center">
                                                                    <span>Date / तिथि</span><br>
                                                                    <b>{{ dmy($article->created_at) }}</b>
                                                                </td>
                                                                <td colspan="3" align="center">
                                                                    <img src="{{asset('storage/award/').'/'.$article->signature_doc}}" class="img-fluid" style="width: 140px;"><br>
                                                                    <b>Signature / हस्ताक्षर</b>
                                                                </td>
                                                            </tr>
                                                            @if($article->is_editable != 2)
                                                                <script type="text/javascript">
                                                                    function preventBack() {
                                                                        window.history.forward();
                                                                    }
                                                                    setTimeout("preventBack()", 0);
                                                                    window.onunload = function() {
                                                                        null
                                                                    };
                                                                </script>
                                                                <?php $checkk=form_date_status(4);?>
                                                                @if( $checkk == 0)
                                                                    <tr>
                                                                        <td colspan="6" align="center">
                                                                            <h3 class="text-danger"> Form Not Available</h3>
                                                                        </td>
                                                                    </tr>
                                                                @else
                                                                    <tr>
                                                                        <td colspan="6" align="center">
                                                                            <a href="#" class="btn btn-info btn-sm me-3" id="check1">Final Submit/अंतिम रूप से दर्ज करें</a>
                                                                            <a href="{{ url('financial-assistance/edit_financialform')}}/{{$article->application_no }}" class="btn btn-primary btn-sm">Edit/संशोधन करें</a>
                                                                        </td>
                                                                    </tr>
                                                                @endif
                                                            @endif
                                                        </table>
                                                        @endforeach
                                                        @if(isset($articles[0]->form_status) && ($articles[0]->form_status == 1 || $articles[0]->form_status == 2))
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





@endsection
<div class="modal fade" id="AwardFrm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Instructions</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <p>
                    <img src="{{url('public/images/sent.png')}}" alt="Sent" title="Sent">
                </p>
                <div class="clearfix"></div>
                <!--<h5>Your OTP verification is done successfully. Kindly <b>Proceed to Pay</b> the Registration Fee. After Fee Payment, your Registration on Portal will be completed, and Password will be sent on your registered Mobile No. & Email ID.</h5>-->
                <h5>Are you sure to do the final submission of the Form? No changes will be allowed, once the final submission is done.<br>क्या आप सुनिश्चित करते हैं कि आपको आवेदन पत्र दर्ज करना है? अंतिम रूप से दर्ज करने के पश्चात आवेदन में किसी भी प्रकार के संशोधन की अनुमति नहीं होगी।</h5>

            </div>
            <div class="modal-footer justify-content-md-center">
                <div class="col-6 d-grid">
                    <a class="btn btn-info" id="final_submit" href="Javascript:void(0)">Final Submit/अंतिम रूप से दर्ज करें</a>
                </div>
            </div>
        </div>
    </div>
</div>
@push('custom-scripts')

<!-- InstanceBeginEditable name="for-javascript" -->
<script>
    function PrintDoc() {
        // $('#tableID').DataTable().destroy();
        $('.fa-download').text('Uploaded');
        var toPrint = document.getElementById('prodiv');

        var popupWin = window.open('', '_blank', 'left=100,top=100,width=1100,height=600,tollbar=0,scrollbars=1,status=0,resizable=1');

        popupWin.document.open();

        popupWin.document.write('<html><title>::Preview::</title><head><style>body{font-family:Arial} #logo{display:block !important; position: absolute; width: 70px; top: -7px; left: 0;} .img-query {width: 60px;   height: 60px; border-radius: 8px;} .bg-light{background-color: #dee2e6 !important; font-size: 14px !important;} .btn{display: none;} .noprint{display: none;} table{width:100%; border-collapse:collapse;} .table tr th, .table tr td{border:1px solid #000; padding:4px 5px; font-size: 12px;}</style></head><body onload="window.print()">')

        popupWin.document.write(toPrint.innerHTML);

        popupWin.document.write('</body></html>');

        popupWin.document.close();
        $('.fa-download').text('');

        // $('#tableID').DataTable();
    }
    $('#check1').click(function() {
        var content = document.createElement('div');
        content.innerHTML = '<h3>Please click on the Declaration Checkbox and then proceed to submit.<br>कृपया घोषणा के चेकबॉक्स पर क्लिक करें एवं तदोपरांत आगे बढ़ें।</h3>';
        if ($('#checkbox').is(':checked'))
            $('#AwardFrm').modal('toggle');
        else
            swal(content, {

            });
        return false;
    });
    $("#final_submit").click(function(e) {

        e.preventDefault(); // avoid to execute the actual submit of the form.

        // var form = $(this);
        var application_no = $("#application_no").first().text();
        var actionUrl = ajaxUrl + "/financial-assistance/finalSubmit/" + application_no;
        //    var court_case = $('input[name=court_case]:checked').val();
        //    var dope_test = $('input[name=dope_test]:checked').val();
        //    console.log($('input[name=court_case]:checked').val());
        //    console.log(dope_test);

        $.ajax({
            type: "POST",
            url: actionUrl,

            data: {
                // <-- the $ sign in the parameter name seems unusual, I would avoid it
            }, // serializes the form's elements.
            success: function(data) {
                if (data == 1) {
                    window.location.href = ajaxUrl + "/dashboard";
                } else {
                    $('#AwardFrm').modal('hide');
                    error("Something Error");
                }
            }
        });

    });
</script>

@endpush
