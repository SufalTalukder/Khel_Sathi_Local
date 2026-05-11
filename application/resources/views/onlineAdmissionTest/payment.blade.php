@extends('layouts.onlineAdmissionTestNav')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="pageheader pb-2">
            <h5>Payment/भुगतान
                <a href="{{ route('onlineAdmissionTest.applicationPreview') }}" class="btn btn-outline-secondary btn-sm float-end rounded-pill">← Back/वापस</a>
            </h5>
        </div>
    </div>
</div>

<div class="card mt-2">
    <div class="card-body">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="text-center mb-3">
                    <h5 class="fw-bold">Pay Application Fee/आवेदन शुल्क का भुगतान करें <span class="text-danger">₹{{ $amount }}</span></h5>
                </div>

                <table class="table table-bordered table-sm mb-4" style="font-size:13px;">
                    <tr>
                        <td><b>Registration No./पंजीकरण संख्या</b></td>
                        <td>{{ $data->application_no ?? 'NA' }}</td>
                        <td><b>Applicant's Name/आवेदक का नाम</b></td>
                        <td>{{ $data->fullname ?? 'NA' }}</td>
                    </tr>
                    <tr>
                        <td><b>Aadhaar No./आधार संख्या</b></td>
                        <td>{{ $data->aadhar_no ?? 'NA' }}</td>
                        <td><b>Date of Birth/जन्मतिथि</b></td>
                        <td>{{ $data->dob ? date('d-m-Y', strtotime($data->dob)) : 'NA' }}</td>
                    </tr>
                    <tr>
                        <td><b>Email ID/ईमेल</b></td>
                        <td>{{ $data->email ?? 'NA' }}</td>
                        <td><b>Mobile No./मोबाइल</b></td>
                        <td>{{ $data->mobile ?? 'NA' }}</td>
                    </tr>
                    <tr>
                        <td><b>Sports Name/खेल का नाम</b></td>
                        <td>{{ $data->sport_name ?? 'NA' }}</td>
                        <td><b>District/जनपद</b></td>
                        <td>{{ $data->district_name ?? 'NA' }}</td>
                    </tr>
                </table>

                <div class="text-center">
                    {{-- SabPaisa Payment Gateway form --}}
                    <form method="post" action="https://securepay.sabpaisa.in/SabPaisa/sabPaisaInit?v=1" id="paymentGatewayForm">
                        <input type="hidden" name="clientCode" value="{{ $clientCode }}">
                        <input type="hidden" name="transUserName" value="nishant.jha_8637">
                        <input type="hidden" name="transUserPassword" value="GGSSC_SP8637">
                        <input type="hidden" name="payerName" value="{{ $data->fullname ?? '' }}">
                        <input type="hidden" name="payerEmail" value="{{ $data->email ?? '' }}">
                        <input type="hidden" name="payerMobile" value="{{ $data->mobile ?? '' }}">
                        <input type="hidden" name="payerAddress" value="">
                        <input type="hidden" name="clientTxnId" value="{{ $clientTxnId }}">
                        <input type="hidden" name="amount" value="{{ $amount }}">
                        <input type="hidden" name="amountType" value="INR">
                        <input type="hidden" name="mcc" value="5137">
                        <input type="hidden" name="channelId" value="W">
                        <input type="hidden" name="callbackUrl" value="{{ route('gatewayResponse') }}">
                        <input type="hidden" name="udf6" value="{{ $data->challan_no ?? '' }}">
                        <input type="hidden" name="encData" value="{{ $paymentdata }}">

                        <button type="submit" class="btn btn-success btn-lg rounded-pill px-5">
                            <i class="fa fa-credit-card"></i> Online Payment/ऑनलाइन भुगतान करें
                        </button>
                    </form>
                </div>

                <p class="text-muted text-center mt-3 small">
                    <i class="fa fa-lock"></i> Secure payment powered by SabPaisa. You will be redirected to the payment gateway.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
