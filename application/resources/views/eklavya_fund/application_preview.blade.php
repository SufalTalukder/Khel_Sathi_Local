@extends( 'layouts\eklavya_fund_dashboard_layout' )
@section('content')
    <!-- InstanceBeginEditable name="Content Area" -->
    <div class="container-fluid">
        <div class="bhoechie-tab-container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <div class="pageheader" id="menu-margin">
                    <h4 class="mb-0">
                        Application Preview
                        <button type="button" data-print="modal"
                            class="btn btn-sm  btn-outline-primary ms-2 float-end rounded-pill"
                            onclick="PrintDoc()"><span class="icons icon-printer"></span> Print</button>
                        <a href="{{ route('dashboard') }}"
                            class="btn btn-outline-danger btn-sm backbtn float-end rounded-pill"><span
                                class="icons icon-arrow-left"></span>Back to Dashboard</a>
                    </h4>
                </div>
                    <div class="bhoechie-tab-content">
                        <div class="form-scroll">
                            <div class="nano-content">
                                <div class="row">
                                    <div class="col-md-12" id="prodiv">
                                        <table class="dn" style="width: 100%; margin-bottom: 5px;" border="0">
                                            <tr>
                                                <td colspan="2" align="center"
                                                    style="position: relative; border: 0; padding-bottom: 5px;">
                                                    <div style="border-bottom: 0px solid #000; padding-bottom: 2vw;">
                                                        <img id="logo"
                                                            src="{{ asset('') }}/assets_admin/images/logo.png"
                                                            style="display:none;position: absolute; width: 70px; top: -7px; left: 0;" />
                                                        <div style="font-size: 25px; font-weight: bold;">
                                                            <!-- Department of Sports -->
                                                            Khel Sathi Portal / खेल साथी पोर्टल
                                                        </div>
                                                        <div style="font-size: 18px; font-weight: bold;">
                                                            Government of Uttar Pradesh/उत्तर प्रदेश सरकार
                                                        </div>
                                                        <div style="font-size: 18px; font-weight: bold;">Application
                                                            Form for Eklavya Krida Kosh/एकलव्य क्रीड़ा कोष के लिए
                                                            नामांकन हेतु आवेदन </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>


                                        <p class="bg-light"
                                            @if ($fund_data->final_submit != 1) style="display: none" @endif>
                                            <strong>Application no. / आवेदन संख्या -</strong> <b
                                                id="application_no">{{ $fund_data->application_no }}</b>
                                        </p>
                                        
                                        <table class="table table-bordered" border="1" style="border-collapse: collapse; width: 100%;">
                                            <tr>
                                                <td colspan="4" class="bg-light">
                                                    <strong>Registration Details/पंजीकरण विवरण</strong>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="width:25%"><b>Name of Sports Club/Academy<br />खेल क्लब/एकेडमी का नाम</b></td>
                                                <td style="width:25%">{{ Auth::guard('EklavyaFund')->user()->academy_name  }}</td>
                                                <td style="width:25%"><b>Name of the Sport<br />खेल का नाम</b></td>
                                                <td style="width:25%">{{ sport_name(Auth::guard('EklavyaFund')->user()->sport_id)  }}</td>
                                            </tr>
                                            <tr>
                                                <td><b>Mobile Number<br />मोबाइल नंबर</b></td>
                                                <td>{{ Auth::guard('EklavyaFund')->user()->mobile  }}</td>
                                                <td><b>Email ID<br />ईमेल आईडी</b></td>
                                                <td>{{ Auth::guard('EklavyaFund')->user()->email  }}</td>
                                            </tr>
                                            <tr>
                                                <td><b>Location of the Sports Club/Academy within the state boundary<br />खेल क्लब/अकादमी उत्तर प्रदेश राज्य के सीमा क्षेत्र में स्थापित एवं कार्यरत हो</b></td>
                                                <td>Yes</td>
                                                <td><b>TAN Number/PAN Number<br />TAN नंबर/PAN नंबर</b></td>
                                                <td>{{ Auth::guard('EklavyaFund')->user()->pan  }}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="4" class="bg-light">
                                                    <strong>Applicant Details/आवेदक का विवरण</strong>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><b>Registration Certificate under Society Act<br />सोसाइटी अधिनियम के तहत पंजीकरण प्रमाणपत्र</b></td>
                                                <td><strong><a class="btn btn-success btn-xs" target="_blank" href="{{url('public/eklavya_fund/registration_certificate_doc')}}/{{$fund_data->registration_certificate_doc}}" >Uploaded</a></strong></td>
                                                <td><b>Correspondence Address<br />पत्राचार का पता</b></td>
                                                <td>{{$fund_data->correspondence_address}}</td>
                                            </tr>
                                            <tr>
                                                <td>
                                                    <b>Accreditation Certificate from Sports Authority of India (SAI)<br />भारतीय खेल प्राधिकरण (SAI) से मान्यता प्रमाणपत्र</b><br />OR/या<br />
                                                    <b>Notarized Affidavit for providing at least 180 days of training to Olympic/Paralympic medalist athletes<br />ओलंपिक/पैरालंपिक पदक विजेता एथलीटों को कम से कम 180 दिनों का प्रशिक्षण प्रदान करने के लिए नोटरीकृत शपथ पत्र</b>
                                                </td>
                                                <td><strong>
                                                    @if($fund_data->accreditation_certificate_doc)
                                                    <a class="btn btn-success btn-xs" target="_blank" href="{{url('public/eklavya_fund/accreditation_certificate_doc')}}/{{$fund_data->accreditation_certificate_doc}}" >Uploaded</a>
                                                    @else
                                                    <a class="btn btn-success btn-xs" target="_blank" href="{{url('public/eklavya_fund/notarized_affidavit_180_doc')}}/{{$fund_data->notarized_affidavit_180_doc}}" >Uploaded</a>
                                                    @endif
                                                </strong></td>
                                                <td><b>Affiliation with Provincial Sports Association<br />खेल क्लब/अकादमी का संबंधित प्रदेशीय खेल संघ से मान्यता है अथवा नहीं</b></td>
                                                <td>@if($fund_data->affiliation == 1)YES @else NO @endif</td>
                                            </tr>
                                            <tr>
                                                <td><b>Details of the club/academy’s constitution/charter<br />खेल क्लब/अकादमी के संविधान/ज्ञान पत्र की प्रति</b></td>
                                                <td colspan="3"><strong><a class="btn btn-success btn-xs" target="_blank" href="{{url('public/eklavya_fund/constitution_charter_doc')}}/{{$fund_data->constitution_charter_doc}}" >Uploaded</a></strong></td>
                                            </tr>
                                            <tr>
                                                <td colspan="4">
                                                    <b>Contact Details (Mobile number and permanent position details of officials)/संपर्क विवरण (अधिकारियों का मोबाइल नंबर और स्थायी पद का विवरण)</b><br />
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th style="width:8%;">S. No./क्र. सं.</th>
                                                                <th>Name/नाम</th>
                                                                <th>Mobile Number/मोबाइल नंबर</th>
                                                                <th>Address/पता</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($officer_data as $key=>$item)
                                                            <tr>
                                                                <td align="center">{{$key+1}}</td>
                                                                <td>{{$item->office_name}}</td>
                                                                <td>{{$item->office_mobile}}</td>
                                                                <td>{{$item->office_address}}</td>
                                                            </tr>
                                                           @endforeach
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><b>Email ID of the Sports Club/Academy<br />खेल क्लब/अकादमी की ई-मेल आईडी</b></td>
                                                <td>{{$fund_data->email_sports_club}}</td>
                                                <td><b>Description of Sports Ground/Hall/Facilities<br />खेल क्लब/अकादमी के खेल मैदान/हॉल परिसर का विवरण</b></td>
                                                <td>{{$fund_data->ground_description}}</td>
                                            </tr>
                                            <tr>
                                                <td colspan="4">
                                                    <b>List of players available in the club/academy (minimum 5 players per month)/क्लब/अकादमी में उपलब्ध खिलाड़ियों की सूची (प्रति माह न्यूनतम 5 खिलाड़ी)</b><br />
                                                    <table class="table table-bordered">
                                                        <thead>
                                                            <tr>
                                                                <th style="width:8%;">S. No./क्र. सं.</th>
                                                                <th>Name/नाम</th>
                                                                <th>Mobile Number/मोबाइल नंबर</th>
                                                                <th>Aadhaar Number/आधार संख्या</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            @foreach($player_data as $key =>$itemm)
                                                            <tr>
                                                                <td align="center">{{$key+1}}</td>
                                                                <td>{{$itemm->player_name}}</td>
                                                                <td>{{$itemm->player_mobile}}</td>
                                                                <td>{{$itemm->player_aadhar}}</td>
                                                            </tr>
                                                            @endforeach
                                                            
                                                        </tbody>
                                                    </table>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><b>Approval/Accreditation Letter from State Sports Association<br />प्रदेशीय खेल संघ का खेल विभाग से मान्यता/समझौता पत्र संलग्न करें</b></td>
                                                <td><strong><a class="btn btn-success btn-xs" target="_blank" href="{{url('public/eklavya_fund/accreditation_letter_doc')}}/{{$fund_data->accreditation_letter_doc}}" >Uploaded</a></strong></td>
                                                <td><b>Dispute status in the State Sports Association (if any)<br />प्रदेशीय खेल संघ में विवाद की स्थिति (यदि कोई हो)</b></td>
                                                <td><strong>
                                                    @if($fund_data->dispute_status_doc)<a class="btn btn-success btn-xs" target="_blank" href="{{url('public/eklavya_fund/dispute_status_doc')}}/{{$fund_data->dispute_status_doc}}" >Uploaded</a>
                                                @else Not Uploaded @endif
                                                </strong></td>
                                            </tr>
                                            <tr>
                                                <td><b>Details of the premises operated by the club/academy (owned/rented)<br />खेल क्लब/अकादमी द्वारा संचालित परिसर का विवरण (स्वामित्व/किराए पर)</b></td>
                                                <td><strong><a class="btn btn-success btn-xs" target="_blank" href="{{url('public/eklavya_fund/premises_operated_doc')}}/{{$fund_data->premises_operated_doc}}" >Uploaded</a></strong></td>
                                                <td><b>Notarized Affidavit for non-receipt of financial aid from other departments<br />आर्थिक सहायता किसी अन्य श्रेणी/विभाग से प्राप्त न होने का नोटरी शपथ पत्र की मूल प्रति</b></td>
                                                <td><strong><a class="btn btn-success btn-xs" target="_blank" href="{{url('public/eklavya_fund/notarized_affidavit_doc')}}/{{$fund_data->notarized_affidavit_doc}}" >Uploaded</a></strong></td>
                                            </tr>
                                            <tr>
                                                <td><b>Description of financial aid expected<br />खेल क्लब/अकादमी को प्राप्त होने वाली आय का विवरण</b></td>
                                                <td>{{$fund_data->financial_aid_details}}</td>
                                                <td><b>Certificate for the appropriate use of approved funds<br />खेल क्लब/अकादमी को स्वीकृत धनराशि का प्रमाणित उपयोगिता प्रमाण-पत्र</b></td>
                                                <td><strong><a class="btn btn-success btn-xs" target="_blank" href="{{url('public/eklavya_fund/appropriate_approved_funds_doc')}}/{{$fund_data->appropriate_approved_funds_doc}}" >Uploaded</a></strong></td>
                                            </tr>
                                            <tr>
                                                <td><b>Report of the training provided by the sports club/academy<br />खेल क्लब/अकादमी में संचालित प्रशिक्षण शिविर की रिपोर्ट</b></td>
                                                <td><strong><a class="btn btn-success btn-xs" target="_blank" href="{{url('public/eklavya_fund/report_training_provided_doc')}}/{{$fund_data->report_training_provided_doc}}" >Uploaded</a></strong></td>
                                                <td><b>Audit report of accounts related to the grant<br />खेल क्लब/अकादमी का निर्मित अनुबंध का प्रमाण संलग्न करें</b></td>
                                                <td><strong><a class="btn btn-success btn-xs" target="_blank" href="{{url('public/eklavya_fund/audit_report_accounts_doc')}}/{{$fund_data->audit_report_accounts_doc}}" >Uploaded</a></strong></td>
                                            </tr>
                                            <tr>
                                                <td><b>Bank Name<br />बैंक का नाम</b></td>
                                                <td>{{$fund_data->bank_name}}</td>
                                                <td><b>Bank Account Number<br />बैंक खाता संख्या</b></td>
                                                <td>{{$fund_data->acc_no}}</td>
                                            </tr>
                                            <tr>
                                                <td><b>Branch Code/IFSC Code<br />शाखा कोड/IFSC कोड</b></td>
                                                <td>{{$fund_data->bank_ifsc}}</td>
                                                <td><b>Recommendation of District/Provincial Sports Officer<br />खेल विभाग के मंडलीय/जनपदीय अधिकारी की संस्तुति</b></td>
                                                <td><strong><a class="btn btn-success btn-xs" target="_blank" href="{{url('public/eklavya_fund/recommendation_of_district_doc')}}/{{$fund_data->recommendation_of_district_doc}}" >Uploaded</a></strong></td>
                                            </tr>
                                            <tr>
                                                <td><b>Recommendation of the relevant State Sports Association<br />संबंधित प्रदेशीय खेल संघ की संस्तुति</b></td>
                                                <td colspan="3"><strong><a class="btn btn-success btn-xs" target="_blank" href="{{url('public/eklavya_fund/recommendation_of_state_sports_doc')}}/{{$fund_data->recommendation_of_state_sports_doc}}" >Uploaded</a></strong></td>
                                            </tr>
                                            <tr>
                                                    <td colspan="6" class="bg-light"><strong>Declaration</strong></td>
                                                </tr>
                                                <tr>
                                                    <td colspan="6">I hereby declare that I have read all terms & conditions, eligibility criteria and other relevant information related to the Application and abide by them. I also declare that all the above particulars are true to the best of my knowledge. If any of my facts are found to be wrong or incorrect, my application shall be liable for rejection and I shall be solely held responsible for it.<br>मैं एतद्द्वारा घोषणा करता/करती हूं कि मैंने आवेदन से संबंधित सभी नियम और शर्तें, पात्रता मानदंड और अन्य प्रासंगिक जानकारी पढ़ ली हैं एवं उनका पालन करता/करती हूं। मैं यह भी घोषणा करता/करती हूं कि उपरोक्त सभी विवरण मेरे अनुसार सत्य व सही हैं। यदि मेरा कोई भी तथ्य गलत अथवा असत्य पाया जाता है, तो मेरा आवेदन अस्वीकृत किया जा सकता है और इसके लिए पूर्णतः मैं स्वयं उत्तरदायी ठहराया जाऊंगा/जाऊंगी।
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td colspan="6" align="center">
                                                        <input type="checkbox" @if ($fund_data->is_editable == 1) disabled checked="checked" @endif id="player_coachChecked" />
                                                        &nbsp; <b>I Agree</b>
                                                    </td>
                                                </tr>
                                        </table>
                                    </div>
                                </div>
                                @if($fund_data->final_submit !=1)
                                <div class="bhoechie-footer">
                                    <div class="row justify-content-center">
                                        <div class="col-md-2 d-grid">
                                            <button type="submit" id="check1" class="btn btn-info">Final Submit</button>
                                        </div>
                                        <div class="col-md-2 d-grid">
                                            <a href="{{url('eklavyaFund/application_form')}}/{{$fund_data->id}}"  class="btn btn-warning">Edit</a>
                                        </div>
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
    <!-- InstanceEndEditable -->

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
@endsection

@push('custom-scripts')
<script>
    function PrintDoc() {
        // $('#tableID').DataTable().destroy();
        var toPrint = document.getElementById('prodiv');

        var popupWin = window.open('', '_blank', 'left=100,top=100,width=1100,height=600,tollbar=0,scrollbars=1,status=0,resizable=1');

        popupWin.document.open();

        popupWin.document.write('<html><title>::Preview::</title><head><style>body{font-family:Arial} .bg-light{background-color: #dee2e6 !important; font-size: 14px !important;} .noprint{display: none;} table{width:100%; border-collapse:collapse;} .table tr th, .table tr td{border:1px solid #000; padding:4px 5px; font-size: 12px;}</style></head><body onload="window.print()">')

        popupWin.document.write(toPrint.innerHTML);

        popupWin.document.write('</body></html>');

        popupWin.document.close();

        // $('#tableID').DataTable();
    }
    function showmsg() {
            swal("Successful/सफल", "Your Application Submitted Successfully/आपका आवेदन सफलतापूर्वक सबमिट हो गया", "success");
        }
    $('#check1').click(function() {
        $('#AwardFrm').modal('toggle');
        return false;
    });
    $("#final_submit").click(function(e) {
        var id = {{$fund_data->id}};
        var actionUrl = ajaxUrl + "/eklavyaFund/application_preview/" + id;
        e.preventDefault(); // avoid to execute the actual submit of the form.
        $.ajax({
            type: "POST",
            url: actionUrl,
            success: function(res) {
                if (res.error == false) {
                    success(res.msg);
                    window.location.href = res.url;
                } else {
                    error(res.msg);
                }
            }
        });

    });
</script>
@endpush
