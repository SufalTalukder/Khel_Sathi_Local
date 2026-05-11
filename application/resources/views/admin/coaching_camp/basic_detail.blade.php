@extends('layouts/admin_layout')
@section('content')

    <style>
        .nowraptd {
            white-space: nowrap;
        }

        .dn {
            display: none;
        }
    </style>

    <div class="container-fluid pagecontentbody">
        <div class="pagebody removebg-color">
            <div class="row">
                <div class="col-12">
                    <div class="pageheader" id="menu-margin">
                        <h4 class="mb-0">
                            Application Preview
                            <button type="button" data-print="modal"
                                class="btn btn-sm  btn-outline-primary ms-2 float-end rounded-pill"
                                onclick="PrintDoc()"><span class="icons icon-printer"></span> Print</button>
                            <a href="{{ route('coaching_camp_list') }}"
                                class="btn btn-outline-danger btn-sm backbtn float-end rounded-pill"><span
                                    class="icons icon-arrow-left"></span>Back to List</a>
                        </h4>
                    </div>
                    <div class="bhoechie-tab-container">
                        <div class="form-scroll">
                            <div class="nano-content">
                                <div class="card">
                                    <div class="card-body">
                                       <div id="prodiv" class="container-fluid">
    <table class="dn table" style="width: 100%; margin-bottom: 5px;">
        <tr>
            <td colspan="2" align="center" style="position: relative; border: 0; padding-bottom: 5px;">
                <div style="border-bottom: 0px solid #000; padding-bottom: 2vw; position: relative;">
                    <img src="{{ asset('public/coaching_camp/images/logo.png') }}" 
                         style="position: absolute; width: 80px; top: 5px; left: 0;" />
                    <div class="text-center">
                        <div style="font-size: 2vw; font-weight: bold;">Khel Sathi Portal/खेल साथी पोर्टल</div>
                        <div style="font-size: 1.5vw; font-weight: bold;">
                            Department of Sports, Government of Uttar Pradesh<br>
                            खेल विभाग, उत्तर प्रदेश सरकार
                        </div>
                    </div>
                </div>
            </td>
        </tr>
        <tr>
            <td style="text-align: left; font-size: 12px; padding-top: 5px;"></td>
            <td style="text-align: right; font-size: 12px; padding-top: 5px;">
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
            <td width="20%"><strong>{{ $srNo++ }}. Application No.</strong></td>
            <td width="20%">{{ $applicationview->application_no }}</td>
            <td rowspan="6" colspan="2" width="20%" class="text-center">
                <div class="d-flex flex-column align-items-center">
                    <div class="mb-2">
                        <img src="{{ asset('public/coaching_camp/profile_picture') }}/{{ $applicationview->profile_picture }}" 
                             class="img-fluid" style="max-height: 150px;" />
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
            <td>{{ $applicationview->name }}</td>
        </tr>
    
        <tr>
            <td><strong>{{ $srNo++ }}. Father's Name/पिता का नाम</strong></td>
            <td>{{ $applicationview->father_name }}</td>
       
        </tr>
        <tr>
            <td><strong>{{ $srNo++ }}. Mothers Name/माता का नाम</strong></td>
            <td>{{ $applicationview->mother_name }}</td>

        </tr>
         <tr>
                 <td><strong>{{ $srNo++ }}. Date of Birth/जन्मतिथि</strong></td>
            <td >{{ $applicationview->dob ? dmy($applicationview->regdob) : '' }}</td>

        </tr>
        <tr>
            <td><strong>{{ $srNo++ }}. मोबाइल नंबर/Mobile Number</strong></td>
            <td>{{ $applicationview->mobile }}</td>
            <td><strong>{{ $srNo++ }}. Aadhar Number/आधार नं0</strong></td>
            <td colspan="2">{{ $applicationview->aadhar }}</td>
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

                        @if ($applicationview->status != 1 && $applicationview->final_submit != 0)
                            <div class="col-md-2 d-grid">
                                <button class="btn btn-outline-danger rounded-pill" id="onlineAdmissionFinal">Status </button>
                            </div>
                        @endif


                    </div>


                </div>
            </div>
        </div>
    </div>



    <!-- Modal -->


    <script>
        function showMe(e) {
            var t = e.value;
            e.value = t.indexOf(".") >= 0 ? t.slice(0, t.indexOf(".") + 2) : t;
        }


        function PrintDoc() {
            // $('#dataTable_player').DataTable().destroy();
            var toPrint = document.getElementById('player_prodiv');
            //alert(toPrint);
            var popupWin = window.open('', '_blank', 'left=100,top=100,width=1100,height=600,tollbar=0,scrollbars=1,status=0,resizable=1');
            popupWin.document.open();
            popupWin.document.write('<html><title>::Preview::</title><head><style>body{font-family:Arial} .noprint{display: none;} table{width:100%; border-collapse:collapse;} .table tr th, .table tr td{border:1px solid #000; padding:3px 5px; font-size: 12px; text-align: left;} th.table-warning{background-color: #dbdbdb;} .table-warning h3{margin: 0;}</style></head><body onload="window.print()">')
            popupWin.document.write(toPrint.innerHTML);
            popupWin.document.write('</body></html>');
            popupWin.document.close();
            // $('#dataTable_player').DataTable();
        }
    </script>
    <script type="text/javascript" src="{{ asset('js/xlsx.full.min.js') }}"></script>

    <script>
        function ExportToExcel(type, fn, dl) {
            var elt = document.getElementById('dataTable_player_dashboard');
            var wb = XLSX.utils.table_to_book(elt, {
                sheet: "sheet1"
            });
            return dl ?
                XLSX.write(wb, {
                    bookType: type,
                    bookSST: true,
                    type: 'base64'
                }) :
                XLSX.writeFile(wb, fn || ('Applicant Report.' + (type || 'xlsx')));
        }


        $('#onlineAdmissionFinal').click(function () {

            $('#onlineFinalWarning').modal('toggle');



        });
        const ajaxUrl = "{{ url('') }}";

        $(document).ready(function () {

            // Show/hide payment input based on selection
            $('input[name="status"]').change(function () {
                const selectedStatus = $('input[name="status"]:checked').val();
                if (selectedStatus === '1') {
                    $('#paymentAmountWrapper').removeClass('d-none');
                } else {
                    $('#paymentAmountWrapper').addClass('d-none');
                }
            });

            // Submit handler
            $('#decisionForm').on('submit', function (e) {
                e.preventDefault();

                const status = $('input[name="status"]:checked').val();
                const paymentAmount = $('#paymentAmount').val().trim();
                const remark = $('#remark').val().trim();

                // Basic validation
                if (typeof status === 'undefined') {
                    alert("Please select Accept or Reject.");
                    return;
                }

                if (remark === '') {
                    alert("Please enter a remark.");
                    return;
                }

                if (status === '1' && (paymentAmount === '' || isNaN(paymentAmount) || parseFloat(paymentAmount) <= 0)) {
                    alert("Please enter a valid payment amount.");
                    return;
                }

                const actionUrl = ajaxUrl + "/admin/coaching_camp/applicationUpdateStatus/{{ $applicationview->id }}";

                $.ajax({
                    type: "POST", // use POST if modifying data
                    url: actionUrl,
                    data: {
                        status: status,
                        payment_amount: status === '1' ? paymentAmount : '',
                        remark: remark,
                    },
                    success: function (res) {
                        if (res.error === false) {
                            success(res.msg); // or custom success handler
                            window.location.href = res.url;
                        } else {
                            error(res.msg); // or custom error handler
                        }
                    },
                    error: function () {
                        error("Something went wrong. Please try again.");
                    }
                });

            });
        });
    </script>

@endsection
@push('custom-scripts')

    <div class="modal fade" id="onlineFinalWarning" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header border-0">
                    <h5 class="modal-title">Update Status and Payment Amount</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
                    <form id="decisionForm">

                        <!-- Accept / Reject Radios -->
                        <div class="mb-3">
                            <label class="form-label">Status</label>
                            <div class="form-check">
                                <input class="form-check-input decision-check" type="radio" id="acceptRadio" name="status"
                                    value="1">
                                <label class="form-check-label" for="acceptRadio">Accept</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input decision-check" type="radio" id="rejectRadio" name="status"
                                    value="0">
                                <label class="form-check-label" for="rejectRadio">Reject</label>
                            </div>
                        </div>

                        <!-- Payment Amount Field -->
                        <div class="mb-3 d-none" id="paymentAmountWrapper">
                            <label for="paymentAmount" class="form-label">Payment Amount</label>
                            <input type="number" class="form-control" id="paymentAmount" name="payment_amount"
                                placeholder="Enter amount" min="1">
                        </div>

                        <!-- Remark Field -->
                        <div class="mb-3">
                            <label for="remark" class="form-label">Remark</label>
                            <textarea class="form-control" id="remark" name="remark" rows="3"
                                placeholder="Enter remark..."></textarea>
                        </div>

                        <!-- Buttons -->
                        <div class="text-center">
                            <button type="submit" class="btn btn-outline-danger rounded-pill"
                                id="final_submit">Submit</button>
                            <button type="button" class="btn btn-danger rounded-pill"
                                data-bs-dismiss="modal">Cancel</button>
                        </div>

                    </form>
                </div>
            </div>
        </div>
    </div>



@endpush
