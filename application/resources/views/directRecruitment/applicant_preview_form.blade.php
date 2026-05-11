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
                                        <img id="logo" src="{{ asset('') }}/assets_admin/images/logo.png" style="display:none;position: absolute; width: 70px; top: -7px; left: 0;" />
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
                        @foreach($articles as $article)
                        <p @if($article->final_submit != 1) style="display: none" @endif class="bg-light"><strong>Application no. / आवेदन क्रमांक:-</strong> <b id="application_no">{{$app_no}}</b></p>
                        <div class="table-responsive">
                            <table id="dataTable" class="table table-bordered" border="1" style="border-collapse: collapse; width: 100%;">
                                <tr>
                                    <td colspan="8" class="bg-light">
                                        <strong>Basic Details/सामान्य विवरण</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td><b>Applicant's Full Name<br>आवेदक का पूरा नाम</b></td>
                                    <td>{{$article->fullname}}</td>
                                    <td><b>Which Sport did/do you play?<br>कौन सा खेल खेलते थे/हैं?</b>
                                    </td>
                                    <td>{{$article->sport_name}}</td>
                                    <td><b>Mobile Number<br>मोबाइल नंबर</b></td>
                                    <td>{{$article->mobile}}</td>

                                    <td rowspan="2" colspan="3"><b>Photograph of Applicant's
                                            <br>आवेदक की फोटो</b><br />
                                        <div class="text-center" style="padding: 5px;" align="center">
                                            <img src="{{asset('storage/award/').'/'.$article->photograph_doc}}" class="img-fluid" style="width: 140px;" />
                                        </div>
                                    </td>
                                </tr>
                                <tr>

                                    <td><b>Email ID<br>ईमेल आईडी</b></td>
                                    <td>{{$article->email}}</td>
                                    <td><b>Mother’s Name<br>माता का नाम</b></td>
                                    <td>{{$article->mother_name}}</td>
                                    <td><b>Father’s Name<br>पिता का नाम</b></td>
                                    <td>{{$article->father_name}}</td>
                                </tr>
                                <tr>
                                    <td><b>Date of Birth<br>जन्म तिथि</b></td>
                                    <td>{{$article->dob}}</td>
                                    <td><b>Place of Birth<br>जन्म स्थान</b></td>
                                    <td>{{districtName($article->place_of_birth)}}</td>
                                    <td><b>Gender<br>लिंग</b></td>
                                    <td>{{$article->gender}}</td>
                                    <td><b>Aadhaar Number</b></td>
                                    <td>{{$article->aadhar_no}}</td>
                                </tr>
                                {{-- <tr>
                        
                        <td style="width: 15%"><b>Religion<br>धर्म</b></td>
                        <td style="width: 20%">{{$article->religion}}</td>
                                <td><b>Category<br>श्रेणी</b></td>
                                <td>
                                    @if($article->category == 1) General @endif
                                    @if($article->category == 2) OBC @endif
                                    @if($article->category == 3) SC @endif
                                    @if($article->category == 4) ST @endif
                                    @if($article->category == 5) Other @endif

                                </td>
                                </tr>--}}
                                <tr>
                                    <td><b>Marital Status<br>वैवाहिक स्थिति</b></td>
                                    <td>{{$article->marital_status}}</td>
                                    <td><b>Category</b></td>
                                    <td>
                                        <!-- {{$article->category}} -->
                                        @if($article->category == 1) General @endif
                                        @if($article->category == 2) OBC @endif
                                        @if($article->category == 3) SC @endif
                                        @if($article->category == 4) ST @endif
                                        @if($article->category == 5) Other @endif
                                    </td>
                                    <td style="width: 15%"><b>Religion</b></td>
                                    <td style="width: 20%">{{$article->religionn}}</td>
                                    <td style="width: 15%"><b>Nationality<br>राष्ट्रीयता</b></td>
                                    <td style="width: 15%">{{$article->nationality}}</td>
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
                                        <strong>Posts Details/प्रकार</strong>
                                    </td>
                                </tr>
                                @foreach( $post as $key=>$post)
                                <tr>
                                    <td><b>
                                            <!-- {{$post->post_type}} -->
                                            @if($post->post_type == '1') Preference 1
                                            @elseif($post->post_type == '2') Preference 2
                                            @elseif($post->post_type == '3') Preference 3
                                            @elseif($post->post_type == '4') Preference 4
                                            @else Preference 5
                                            @endif
                                        </b></td>

                                    <td colspan="8">

                                        <span>
                                            {{postName($post->post_name)}}
                                            <!-- @if($post->post_name == 'Post_1') Post 1
                                                                                    @elseif($post->post_name == 'Post_2') Post 2  
                                                                                    @elseif($post->post_name == 'Post_3') Post 3 
                                                                                    @elseif($post->post_name == 'Post_4') Post 4
                                                                                    @else Post 5
                                                                                    @endif   -->
                                        </span>

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
                                        <a href="{{url('storage/direct_recruitment',$item->sport_achievement_docs)}}" target="_blank">
                                            <!-- <span class="btn btn-success btn-xs"> Uploaded</span> -->
                                            <i class="fa fa-download"></i>
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
                                        <strong style=" font-size: 1.5vw; font-weight: bold; ">Documents / दस्तावेज़</strong>
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
                                    {{-- <td><b>Sport Achievement Doc</b></td>
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
                                    </td> --}}
                                </tr>
                                {{-- <tr>
                        <!--  no column-->
                        <td colspan="2"><b>Association approved certificate<br>एसोसिएशन द्वारा अनुमोदित प्रमाणपत्र !</b>
                        </td>
                        <td colspan="4">
                            @if($article->association_certificate_upload !='')
                            <a download href="{{url('storage/direct_recruitment',$article->association_certificate_upload)}}" target="_blank">
                                <!-- <span class="btn btn-success btn-xs">Uploaded</span> -->
                                <i class="fa fa-download"></i>
                                </a>
                                @else
                                <strong class="btn btn-danger btn-xs">Not Uploaded</strong> @endif
                                </td>
                                </tr> --}}
                                <tr>
                                    <td colspan="8" class="bg-light">
                                        <strong>Declaration/घोषणा</strong>
                                    </td>
                                </tr>
                                <tr>
                                    <td align="center">
                                        @if($article->final_submit == 1)
                                        <input type="checkbox" id="checkbox" disabled checked="checked" />
                                        &nbsp; <b>I Agree/मैं सहमत हूं</b>
                                        @else
                                        <input type="checkbox" id="checkbox" />
                                        &nbsp; <b>I Agree/मैं सहमत हूं</b>
                                        @endif
                                    </td>
                                    <td colspan="7">I hereby declare that I have read all terms & conditions, eligibility criteria and other relevant information related to the Application and abide by them. I also declare that all the above particulars are true to the best of my knowledge. If any of my facts are found to be wrong or incorrect, my application shall be liable for rejection and I shall be solely held responsible for it.<br>
                                        मैं एतद्द्वारा घोषणा करता/करती हूं कि मैंने आवेदन से संबंधित सभी नियम और शर्तें, पात्रता मानदंड और अन्य प्रासंगिक जानकारी पढ़ ली हैं एवं उनका पालन करता/करती हूं। मैं यह भी घोषणा करता/करती हूं कि उपरोक्त सभी विवरण मेरे अनुसार सत्य व सही हैं। यदि मेरा कोई भी तथ्य गलत अथवा असत्य पाया जाता है, तो मेरा आवेदन अस्वीकृत किया जा सकता है और इसके लिए पूर्णतः मैं स्वयं उत्तरदायी ठहराया जाऊंगा/जाऊंगी।
                                    </td>
                                </tr>
                                <tr>
                                    <td colspan="4" align="center">
                                        <strong>Date/तिथि</strong><br>
                                        <b>{{ dmy($article->created_at)}}</b>
                                    </td>
                                    <td colspan="4" align="center">
                                        <img src="{{asset('storage/award/').'/'.$article->signature_doc}}" class="img-fluid" style="width: 140px;" /><br />
                                        <b>Signature/हस्ताक्षर</b>
                                    </td>
                                </tr>
                                @if($article->final_submit != 1)
                                <script type="text/javascript">
                                    function preventBack() {
                                        window.history.forward();
                                    }
                                    setTimeout("preventBack()", 0);
                                    window.onunload = function() {
                                        null
                                    };
                                </script>
                                @endif
                                <?php $checkk = form_date_status(6); ?>
                                @if( $checkk == 0)
                                <tr>
                                    <td colspan="6" align="center">
                                        <h3 class="text-danger"> Form Not Available</h3>
                                    </td>
                                </tr>
                                @else
                                <tr>
                                    <td colspan="8" align="center">
                                        @if($article->is_editable == 1)
                                        <a href="#" class="btn btn-info btn-sm" id="check1">Final Submit/अंतिम रूप से दर्ज करें</a>
                                        @endif
                                        @if($article->is_editable == 1)
                                        <a href="{{ url('direct-recruitment/edit_profile_detail')}}/{{$article->application_no }}" class="btn btn-primary btn-sm">
                                            Edit/संशोधन करें</a>
                                        @endif
                                    </td>
                                </tr>
                                @endif
                            </table>
                        </div>
                        @endforeach
                        {{-- <x-query-details :queryData="$queryData" /> --}}
                        @if(isset($articles[0]) && ($articles[0]->form_status == 1 || $articles[0]->form_status == 2))
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




        @endsection
        <div class="modal fade" id="DirectFrm" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                        <!-- <h5>Submit successfully</h5> -->
                        <h5>Are you sure to do the final submission of the Form? No changes will be allowed, once the final submission is done.<br>क्या आप सुनिश्चित करते हैं कि आपको आवेदन पत्र दर्ज करना है? अंतिम रूप से दर्ज करने के पश्चात आवेदन में किसी भी प्रकार के संशोधन की अनुमति नहीं होगी।</h5>

                    </div>
                    <div class="modal-footer justify-content-md-center">
                        <div class="col-4 d-grid">
                            <!-- drfinalSubmit -->
                            <a class="btn btn-info" id="final_submit" href="Javascript:void(0)">Final Submit</a>
                        </div>

                    </div>
                </div>
            </div>
        </div>
        @push('custom-scripts')

        <!-- InstanceBeginEditable name="for-javascript" -->
        <script>
            function PrintDoc() {
                $('.fa-download').text('Uploaded');
                // $('#tableID').DataTable().destroy();
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
                    $('#DirectFrm').modal('toggle');
                else
                    swal(content, {

                    });
                return false;
            });
            $("#final_submit").click(function(e) {

                e.preventDefault(); // avoid to execute the actual submit of the form.

                // var form = $(this);
                var application_no = $("#application_no").first().text();
                var actionUrl = ajaxUrl + "/direct-recruitment/finalSubmit/" + application_no;
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
                            $('#DirectFrm').modal('hide');
                            error("Something Error");
                        }
                    }
                });

            });
        </script>


        @endpush
