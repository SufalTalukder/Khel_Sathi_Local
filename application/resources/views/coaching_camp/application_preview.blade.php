@extends('layouts/coaching_camp_auth')
@section('content')
<div class="container-fluid pagecontentbody">
    <div class="pagebody removebg-color">
        <div class="row">
            <div class="col-12">
                <div class="pageheader" id="menu-margin">
                    <h4 class="mb-0">
                        Preview & Final Save The Form/प्रपत्र का पूर्वावलोकन करें और अंतिम रूप से सहेजें
                        <button type="button" data-print="modal" class="btn btn-sm  btn-primary ms-2 float-end rounded-pill" onclick="PrintDoc()">
                            <span class="icons icon-printer"></span> Print
                        </button>
                        <a href="{{ route('coaching_camp_dashboard') }}" class="btn btn-danger btn-sm backbtn float-end rounded-pill">
                            <span class="icons icon-arrow-left"></span>Back to Dashboard
                        </a>
                    </h4>
                </div>
                <div class="bhoechie-tab-container">
                    <div class="form-scroll">
                        <div class="nano-content">
                            <div class="card">
                                <div class="card-body">
                                    <div id="prodiv" class="container-fluid">
                                        <table class="dn table" style="width: 100%; margin-bottom: 0px;">
                                            <tr>
                                                <td colspan="2" align="center" style="position: relative; border: 0; padding-bottom: 5px;">
                                                    <div style="border-bottom: 0px solid #000; padding-bottom: 0vw; position: relative;">
                                                        <img src="{{ asset('public/coaching_camp/images/logo.png') }}"
                                                            style="position: absolute; width: 80px; top: 5px; left: 0;" />
                                                        <div class="text-center">
                                                            <div style="font-size: 20pt; font-weight: bold;">Khel Sathi Portal/खेल साथी पोर्टल</div>
                                                            <div style="font-size: 14pt; font-weight: bold;">
                                                                Department of Sports, Government of Uttar Pradesh<br>
                                                                खेल विभाग, उत्तर प्रदेश सरकार
                                                            </div>
                                                            <div style="font-size: 12pt; font-weight: bold;">
                                                                Application form for Sports Training/खेल प्रशिक्षण हेतु आवेदन-पत्र
                                                            </div>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: left; font-size: 12px; padding-top: 5px; border: 0;"></td>
                                                <td style="text-align: right; font-size: 12px; padding-top: 5px; border: 0;">
                                                    <b>Print Date :</b>{{ dmy(now()) }}
                                                </td>
                                            </tr>
                                        </table>

                                        <?php $srNo = 1; ?>

                                        <table class="table table-bordered" style="width: 100%;">
                                            <tr class="bg-light">
                                                <th colspan="5"><strong>Registration Details/पंजीकरण का विवरण</strong></th>
                                            </tr>
                                            <tr>
                                                <td width="20%"><strong>{{ $srNo++ }}. Serial No./क्रमांक सं0</strong></td>
                                                <td width="20%">{{ $applicationview->application_no }}</td>
                                                <td rowspan="6" colspan="2" width="20%" class="text-center" align="center">
                                                    <div class="d-flex flex-column align-items-center">
                                                        <div class="mb-2">
                                                            <img src="{{ asset('public/coaching_camp/profile_picture') }}/{{ $applicationview->profile_picture }}"
                                                                class="img-fluid" style="max-height: 120px;" />
                                                        </div>
                                                        <div>
                                                            <img src="{{ asset('public/coaching_camp/signature') }}/{{ $applicationview->signature }}"
                                                                style="height: 50px;" />
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>{{ $srNo++ }}. Stadium Name/स्टेडियम का नाम</strong></td>
                                                <td>{{ $applicationview->stadium_name }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>{{ $srNo++ }}. Sports Name/खेल का नाम</strong></td>
                                                <td>
                                                    @php
                                                    $sportIds = explode(',', optional($applicationview)->sport ?? '');
                                                    $sportNames = array_map(function($id) {
                                                    return sport_name($id);
                                                    }, $sportIds);
                                                    @endphp
                                                    {{ implode(', ', $sportNames) }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>{{ $srNo++ }}. Name/नाम</strong></td>
                                                <td>{{ Auth::guard('CoachingCamp')->user()->name }}</td>
                                            </tr>

                                            <tr>

                                            </tr>
                                            <tr>
                                                <td><strong>{{ $srNo++ }}. Father's Name/पिता का नाम</strong></td>
                                                <td>{{ $applicationview->father_name }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>{{ $srNo++ }}. Mothers Name/माता का नाम</strong></td>
                                                <td>{{ $applicationview->mother_name }}</td>
                                                <td><strong>{{ $srNo++ }}. Date of Birth/जन्मतिथि</strong></td>
                                                <td colspan="2">{{ Auth::guard('CoachingCamp')->user()->dob ? dmy(Auth::guard('CoachingCamp')->user()->dob) : '' }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>{{ $srNo++ }}. मोबाइल नंबर/Mobile Number</strong></td>
                                                <td>{{ Auth::guard('CoachingCamp')->user()->mobile }}</td>
                                                <td><strong>{{ $srNo++ }}. Aadhar Number/आधार नं0</strong></td>
                                                <td colspan="2">{{ Auth::guard('CoachingCamp')->user()->aadhar }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>{{ $srNo++ }}. Religion/धर्म</strong></td>
                                                <td>{{ $applicationview->religion }}</td>
                                                <td><strong>{{ $srNo++ }}. Category/वर्ग</strong></td>
                                                <td colspan="2">{{ $applicationview->category }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>{{ $srNo++ }}. Height (in Centimetre)/लंबाई (सेंटीमीटर में)</strong></td>
                                                <td>{{ $applicationview->height }} CM</td>
                                                <td><strong>{{ $srNo++ }}. Weight (in KG)/वजन (किलोग्राम में)</strong></td>
                                                <td colspan="2">{{ $applicationview->weight }} KG</td>
                                            </tr>
                                            <tr>
                                                <td><strong>{{ $srNo++ }}. Is applicant suffering from Skin Disease/Fits/Other Disease?<br>क्या आवेदक चर्म रोग/मिर्गी/अन्य किसी रोग से ग्रसित है?</strong></td>
                                                <td>{{ $applicationview->is_applicant_suffering_disease == 1 ? 'Yes' : 'No' }}</td>
                                                <td rowspan="2" colspan="3" class="text-center">
                                                    @if ($applicationview->is_applicant_suffering_disease == 1)
                                                    <div class="text-center">
                                                        <strong>{{ $srNo++ }}. Medical Certificate</strong>
                                                        <div class="mt-2">
                                                            <img src="{{ asset('public/coaching_camp/medical_certificate') }}/{{ $applicationview->medical_certificate }}"
                                                                class="img-fluid" style="max-height: 200px;" />
                                                        </div>
                                                    </div>
                                                    @endif
                                                </td>
                                            </tr>
                                            <tr>
                                                <td><strong>{{ $srNo++ }}. Visible Identification Mark/पहचान चिह्न</strong></td>
                                                <td>{{ $applicationview->visible_identification_mark }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>{{ $srNo++ }}. Aadhar Card Photo/आधार कार्ड फोटो</strong></td>
                                                <td colspan="4">
                                                    @if (!empty($applicationview->aadhar_card_photo))
                                                    <a href="{{ asset('public/coaching_camp/aadhar_card_photo/' . $applicationview->aadhar_card_photo) }}"
                                                        target="_blank" class="btn btn-sm btn-outline-primary">
                                                        View Aadhar Card
                                                        <i class="bi bi-download ms-1"></i>
                                                    </a>
                                                    @endif
                                                </td>
                                            </tr>

                                            <tr class="bg-light">
                                                <th colspan="5"><strong>Communication Address/संचार पता</strong></th>
                                            </tr>
                                            <tr>
                                                <th colspan="5">Permanent Address/स्थायी पता</th>
                                            </tr>
                                            <tr>
                                                <td><strong>1. Address/पता</strong></td>
                                                <td colspan="4">{{ $applicationview->permanent_address }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>2. District/ज़िला</strong></td>
                                                <td>{{ districtName($applicationview->permanent_district) }}</td>
                                                <td><strong>3. State/राज्य</strong></td>
                                                <td colspan="2">Uttar Pradesh</td>
                                            </tr>
                                            <tr>
                                                <td><strong>4. Pincode/पिन कोड</strong></td>
                                                <td>{{ $applicationview->permanent_pin }}</td>
                                                <td></td>
                                                <td colspan="2"></td>
                                            </tr>
                                            <tr>
                                                <th colspan="5">Correspondence Address/स्थायी पता</th>
                                            </tr>
                                            <tr>
                                                <td><strong>1. Address/पता</strong></td>
                                                <td colspan="4">{{ $applicationview->correspondence_address }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>2. District/ज़िला</strong></td>
                                                <td>{{ districtName($applicationview->correspondence_district) }}</td>
                                                <td><strong>3. State/राज्य</strong></td>
                                                <td colspan="2">{{ stateName($applicationview->correspondence_state) }}</td>
                                            </tr>
                                            <tr>
                                                <td><strong>4. Pincode/पिन कोड</strong></td>
                                                <td>{{ $applicationview->correspondence_pin }}</td>
                                                <td></td>
                                                <td colspan="2"></td>
                                            </tr>

                                            <tr class="bg-light">
                                                <th colspan="5"><strong>घोषणा/Declaration</strong></th>
                                            </tr>
                                            <tr>
                                                <td colspan="5">
                                                    <div class="form-check">
                                                        <input class="form-check-input" type="checkbox" id="onlineChecked"
                                                            @if ($applicationview->final_submit == 1) checked disabled @endif>
                                                        <label class="form-check-label fw-bold" for="onlineChecked">
                                                            I Agree / मैं सहमत हूं
                                                        </label>
                                                    </div>
                                                </td>
                                            </tr>
                                            <tr>
                                                <td colspan="5">
                                                    <p class="mb-0">
                                                        I declare that I will undergo training in discipline, following all the rules of the stadium.
                                                        I will not have any objection to termination of my membership in the stadium for any kind of
                                                        indiscipline and I will be personally responsible for any injury etc. caused during the training
                                                        session and no claim will be made on the Sports Department for any kind of compensation.
                                                    </p>
                                                    <p class="mb-0">
                                                        मै घोषणा करता/करती हूँ कि स्टेडियम के सभी नियमों का पालन करते हुये अनुशासन में रहकर प्रशिक्षण
                                                        प्राप्त करूँगा/करूँगी। किसी भी प्रकार की अनुशासनहीनता पर मेरे स्टेडियम में सदस्यता समाप्त करने पर
                                                        मुझे किसी भी प्रकार की आपत्ति नहीं होगी तथा प्रशिक्षण सत्र में चोट इत्यादि लगने पर उसका में स्वयं
                                                        उत्तरदायी होऊँगा/होऊँगी तथा खेल विभाग पर किसी प्रकार की पूर्ति हेतु दावा नही किया जायेगा।
                                                    </p>
                                                </td>
                                            </tr>
                                        </table>

                                        <div class="row mt-4">
                                            <div class="col-md-6">
                                                <p>
                                                    Date / दिनाँक : {{ dmy(now()) }}
                                                </p>
                                            </div>
                                            <div class="col-md-6 text-end">
                                                <p>
                                                    Player Signature / खिलाड़ी का हस्ताक्षर
                                                </p>
                                            </div>
                                        </div>
                                    </div>


                                </div>
                            </div>




                        </div>
                    </div>
                </div>
                <div class="row mt-3 justify-content-center">
                    @if ($applicationview->final_submit != 1)
                    <div class="col-md-2 d-grid">
                        <a href="{{ route('coaching_camp_application_form') }}"
                            class="btn btn-outline-light rounded-pill">Edit</a>
                    </div>
                    <div class="col-md-2 d-grid">
                        <button class="btn btn-outline-danger rounded-pill" id="onlineAdmissionFinal"> Final Submit
                        </button>


                    </div>



                    @endif


                    @if($applicationview->final_submit == 1 && $applicationview->payment_status != 1)
                    <div class="col-md-2 d-grid">
                        <a href="{{ route('coaching_camp_application_registration_fee') }}"
                            class="btn btn-outline-success">Pay {{ count($sportIds)* 10}} INR (Registration Fees )</a>
                    </div>
                    @endif

                </div>
            </div>
        </div>
    </div>
</div>



<!-- Modal -->

<div class="modal fade" id="onlineFinalWarning" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header border-0">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">

                <h3> Are you sure?</h3>
                <p>Application Submitted Successfully.</p>

                <p>
                    <button class="btn btn-outline-danger rounded-pill" id="final_submit">Yes</button>
                    <a type="button" class="btn btn-danger rounded-pill" data-bs-dismiss="modal"
                        aria-label="Close">No</a>
                    {{-- <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close">No</button> --}}

                </p>
            </div>

        </div>
    </div>
</div>
@endsection
@push('custom-scripts')
<script>
    $('#onlineAdmissionFinal').click(function() {
        var content = document.createElement('div');
        content.innerHTML =
            '<h3>Please click on the Declaration Checkbox and then proceed to submit.<br>कृपया घोषणा के चेकबॉक्स पर क्लिक करें एवं तदोपरांत आगे बढ़ें।</h3>';
        if ($('#onlineChecked').is(':checked')) {
            $('#onlineFinalWarning').modal('toggle');


        } else
            swal(content, {

            });
        return false;
    });

    $('#final_submit').click(function() {


        var actionUrl = ajaxUrl + "/coaching_camp/applicationfinalSubmit";

        $.ajax({
            type: "GET",
            url: actionUrl,

            data: {
                // <-- the $ sign in the parameter name seems unusual, I would avoid it
            }, // serializes the form's elements.
            success: function(res) {
                if (res.error == false) {

                    success(res.msg);

                    window.location.href = res.url;
                } else {
                    error(res.msg);
                }
            },
        });

    });


    function feedetails() {
        swal({
                title: "Are you sure?",
                text: "Application Submitted Successfully./आवेदन सफलतापूर्वक दर्ज हो गया है।",
                type: "warning",
                confirmButtonColor: "#DD6B55",
                confirmButtonText: "Yes/हाँ ",
                showCancelButton: true,
                cancelButtonText: "No/नहीं",
                closeOnConfirm: false
            },
            function() {
                window.location = "Payment.html";
                //swal({
                //  title: "Successful!",
                //  text: "Your Choice has been submited.",
                //  type: "success"
                //  }, function () {
                //         window.location = "dashboard.html";
                //   });
            })
    }
</script>
@endpush
