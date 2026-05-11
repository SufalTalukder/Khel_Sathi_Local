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
                                            Khel Sathi Portal / खेल साथी पोर्टल
                                        </div>
                                        <div style="font-size: 18px; font-weight: bold;">
                                            Government of Uttar Pradesh/उत्तर प्रदेश सरकार
                                        </div>
                                        <div style="font-size: 18px; font-weight: bold;">Application for Nomination for Reward being given to the Winners of 1st, 2nd and 3rd Positions<br>प्रथम, द्वितीय और तृतीय स्थान के विजेताओं को दिए जाने वाले पुरस्कार के लिए नामांकन हेतु आवेदन</div>
                                    </div>
                                </td>
                            </tr>
                        </table>
                        @foreach($articles as $article)
                        <p @if($article->final_submit != 1) style="display: none" @endif class="bg-light"><strong>Application no. / आवेदन संख्या :-</strong> <b id="application_no">{{$article->application_no}}</b></p>
                        <p @if($article->amount_release_status != 1) style="display: none" @endif class="bg-light"><strong>Amount Released/धनराशि :-</strong> <b>{{$article->amount_release}}</b></p>

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
                                <td><b>Mother’s Name<br>माता का नाम</b></td>
                                <td>{{$article->mother_name}}</td>
                                <td><b>Father’s Name<br>पिता का नाम</b></td>
                                <td>{{$article->father_name}}</td>
                            </tr>
                            <tr>
                                <td><b>Gender<br>लिंग</b></td>
                                <td>{{$article->gender}}</td>
                                <td><b>Highest Educational Qualification<br>उच्चतम शैक्षणिक योग्यता</b></td>
                                <td colspan="3">
                                    @if($article->qualification == '10') 10th / High School
                                    @elseif($article->qualification == '12') 12th / Intermediate
                                    @elseif($article->qualification == 'graduation') Graduation
                                    @elseif($article->qualification == 'master_degree') Master Degree
                                    @elseif($article->qualification == 'phd') PhD
                                    @elseif($article->qualification == 'post_graduation') Post-Graduation 
                                    @else Other
                                    @endif
                                </td>
                            </tr>
                            {{-- <tr>
                                <td colspan="6" class="bg-light">
                                    <strong>Current Address/वर्तमान पता</strong>
                                </td>
                            </tr> --}}
                            <tr>
                                <td colspan="6" class="bg-light">
                                    <strong>Current Address/वर्तमान पता</strong>
                                </td>
                            </tr>
                            <tr>
                                {{-- <td><b>Flat No. / House No.<br>फ्लैट संख्या / मकान संख्या</b>
                                </td>
                                <td>{{$article->present_flat_no}}</td> --}}
                                <td><b>Complete Address<br>पूरा पता</b>
                                </td>
                                <td colspan="3">{{$article->present_address}}</td>
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
                                {{-- <td><b>Flat No. / House No.<br>फ्लैट संख्या / मकान संख्या</b>
                                </td>
                                <td>{{$article->permanent_flat_no}}</td> --}}
                                <td><b>Complete Address<br>पूरा पता</b>
                                <td colspan="3">{{$article->permanent_address}}</td>
                                <td><b>District<br>जनपद</b>
                                </td>
                                <td>{{districtName($article->permanent_district)}}</td>
                                
                            </tr>
                            <tr>
                            <td><b>State<br>राज्य</b>
                                </td>
                                <td>UTTAR PRADESH</td>
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
                                <input type="hidden" id="date_end" value="{{$article->competition_to_date}}" />
                                <td>{{$article->competition_to_date}}</td>
                            </tr>
                            <tr id="affidavit">
                            </tr>
                            <tr>
                                <td colspan="6"><b>Upload Self-attested Copy of Award Certificate / पुरुस्कार प्रमाणपत्र की स्व सत्यापित प्रति अपलोड करें</b></td>
                            </tr> --}}
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
                                <td><b>Mobile No. (registered with Bank Account)<br>मोबाइल नंबर (बैंक खाते के साथ जो पंजीकृत है)</b></td>
                                <td>{{$article->mobile_registered_in_bank}}</td>
                            </tr>
                            <tr>
                                <td colspan="6" class="bg-light">
                                    <strong>Documents/दस्तावेज़ </strong>
                                </td>
                            </tr>
                            <tr>
                                <td><b>PAN<br>पैन </b></td>
                                <td>
                                    @if($article->pan_doc !='')
                                    <a download href="{{url('storage/position_holder',$article->pan_doc)}}" target="_blank">
                                        <!-- <span class="btn btn-success btn-xs">Uploaded</span> -->
                                        <i class="fa fa-download"></i>
                                    </a>
                                    @else
                                    <strong class="btn btn-danger btn-xs">Not Uploaded</strong>
                                    @endif
                                </td>
                                <td><b>Sports certificate issued by the general secretary of the concerned sports association.<br>संबंधित खेल संघ के महासचिव द्वारा जारी खेल प्रमाणपत्र</b></td>
                                <td>
                                    @if($article->sport_certificate !='')
                                    <a download href="{{url('storage/position_holder',$article->sport_certificate)}}" target="_blank">
                                        <!-- <span class="btn btn-success btn-xs">Uploaded</span> -->
                                        <i class="fa fa-download"></i>
                                    </a>

                                    @else
                                    <strong class="btn btn-danger btn-xs">Not Uploaded</strong>
                                    @endif
                                </td>
                                <td><b>First Page of Bank Passbook<br>बैंक पासबुक का प्रथम पृष्ठ</b></td>
                                <td>
                                    @if($article->passbook_doc !='')
                                    <a download href="{{url('storage/position_holder',$article->passbook_doc)}}" target="_blank">
                                        <!-- <span class="btn btn-success btn-xs">Uploaded</span> -->
                                        <i class="fa fa-download"></i>
                                    </a>

                                    @else
                                    <strong class="btn btn-danger btn-xs">Not Uploaded</strong>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td><b>Upload Certificate of Highest Educational Qualification<br>उच्चतम शैक्षणिक योग्यता का प्रमाणपत्र अपलोड करें</b></td>
                                <td>
                                    @if($article->qualification_doc !='')
                                    <a download href="{{url('storage/position_holder',$article->qualification_doc)}}" target="_blank">
                                        <!-- <span class="btn btn-success btn-xs">Uploaded</span> -->
                                        <i class="fa fa-download"></i>
                                    </a>
                                    @else
                                    <strong class="btn btn-danger btn-xs">Not Uploaded</strong>
                                    @endif
                                </td>
                                <td><b>Domicile Certificate of UP<br>उत्तर प्रदेश का मूल निवास प्रमाण पत्र अपलोड करें</b></td>
                                <td>
                                    @if($article->domicile_certificate !='')
                                    <a download href="{{url('storage/position_holder',$article->domicile_certificate)}}" target="_blank">
                                        <!-- <span class="btn btn-success btn-xs">Uploaded</span> -->
                                        <i class="fa fa-download"></i>
                                    </a>
                                    @else
                                    <strong class="btn btn-danger btn-xs">Not Uploaded</strong>
                                    @endif
                                </td>
                                <!-- <td><b>Association approved certificate<br>एसोसिएशन द्वारा अनुमोदित प्रमाणपत्र !</b>
                                </td>
                                <td>
                                    @if($article->association_certificate_upload !='')
                                    <a href="{{url('storage/award',$article->association_certificate_upload)}}" target="_blank">
                                        <span class="btn btn-success btn-xs">Uploaded</span>
                                    </a>
                                    @else
                                    <strong class="btn btn-danger btn-xs">Not Uploaded</strong> @endif
                                </td> -->
                            </tr>
                            <tr>
                                @if($article->award_certificate_affidavit !='')
                                <td><b>Upload Affidavit of Award Certificate<br>पुरुस्कार प्रमाणपत्र का शपथ पत्र अपलोड करें</b></td>
                                <td colspan="5">
                                    <a download href="{{url('storage/position_holder',$article->award_certificate_affidavit)}}" target="_blank">
                                        <!-- <span class="btn btn-success btn-xs">Uploaded</span> -->
                                        <i class="fa fa-download"></i>
                                    </a>
                                </td>
                                @endif
                            </tr>
                            <tr>
                                <td colspan="6" class="bg-light">
                                    <strong>Declaration/घोषणा</strong>
                                </td>
                            </tr>
                            <tr>
                                <td align="center">
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
                                    <img src="{{asset('storage/award/').'/'.$article->signature_doc}}" class="img-fluid" style="width: 140px;"><br>
                                    <b>Signature/हस्ताक्षर</b>
                                </td>
                            </tr>
                            @if($article->final_submit != 1 || $article->is_editable != 2)
                            <script type="text/javascript">
                                function preventBack() {
                                    window.history.forward();
                                }
                                setTimeout("preventBack()", 0);
                                window.onunload = function() {
                                    null
                                };
                            </script>
                            <?php $checkk=form_date_status(3);?>
                            @if( $checkk == 0)
                                <tr>
                                    <td colspan="6" align="center">
                                        <h3 class="text-danger"> Form Not Available</h3>
                                    </td>
                                </tr>
                            @else
                            <tr>
                                <td colspan="6" align="center">
                                    <a  href="Javascript:void(0)" class="btn btn-info btn-sm me-2" id="check1">Submit/अंतिम रूप से दर्ज करें</a>
                               
                                    <a href="{{ url('edit_position_holder')}}/{{$article->application_no }}" class="btn btn-primary  btn-sm">
                                        Edit/संपादित करें
                                    </a>
                                    <!-- <button type="Edit" onclick="location.href = 'SubmitApplicationForm.html';" class="btn btn-danger">Edit</button> -->
                                </td>
                            </tr>
                            @endif
                            @endif
                        </table>
                        @endforeach
                        @if(isset($articles[0]->form_status) && ($articles[0]->form_status == 1 || $articles[0]->form_status == 2))
                        {{-- @if($article->form_status == 1 || $article->form_status == 2) --}}
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
                <h5>Are you sure to submit the Application? No changes will be allowed after final submission.<br>
                    क्या आप सुनिश्चित करते हैं कि आपको आवेदन पत्र दर्ज करना है? अंतिम रूप से दर्ज करने के पश्चात आवेदन में किसी भी प्रकार के संशोधन की अनुमति नहीं होगी।</h5>

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


<script>
    // var year = $("#date_end").val().split('/');
    // var date_chekk = '04/01/' + year[2];
    // var date = new Date(date_chekk);
    // var endDay = new Date();
    // var millisBetween = endDay.getTime() - date.getTime();
    // var days = millisBetween / (1000 * 3600 * 24);
    // if (days > 1095) {
    //     $('#affidavit').show();
    // } else {
    //     $('#affidavit').hide();
    // }

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
        console.log("hello")
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
        // alert($( "#application_no" ).first().text());
        var application_no = $("#application_no").first().text();
        // var form = $(this);
        var actionUrl = ajaxUrl + "/finalSubmit_position_holder/" + application_no;
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
