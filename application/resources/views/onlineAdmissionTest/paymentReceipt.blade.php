@extends('layouts.onlineAdmissionTestNav')
@section('content')

<style>
@media print {
    .no-print { display: none !important; }
    header, footer { display: none !important; }
    .contentwraper { padding-top: 0 !important; }
    .receipt-box { border: 1px solid #000 !important; }
}
</style>

<div class="row mb-3 no-print">
    <div class="col-12">
        <div class="pageheader pb-2">
            <h4>Payment Receipt/भुगतान रसीद
                <button onclick="window.print()" class="btn btn-outline-success btn-sm float-end rounded-pill">
                    <i class="fa fa-print"></i> Print/प्रिंट करें
                </button>
                <a href="{{ route('onlineAdmissionTest.dashboard') }}" class="btn btn-outline-secondary btn-sm float-end rounded-pill me-2">
                    <i class="fa fa-arrow-left"></i> Back
                </a>
            </h4>
        </div>
    </div>
</div>

<div class="card receipt-box" style="max-width:800px; margin:0 auto;">
    <div class="card-body">

        {{-- Header --}}
        <div class="text-center border-bottom pb-3 mb-3">
            <img src="{{ asset('onlineAdmission_storage/images/dash-logo.png') }}" style="height:60px;" class="mb-2"><br>
            <h5 class="mb-0 fw-bold">Department of Sports, Government of Uttar Pradesh</h5>
            <p class="mb-0 text-muted">खेल विभाग, उत्तर प्रदेश सरकार</p>
            <h6 class="mt-1">Sports College Admission — Payment Receipt</h6>
            <h6>स्पोर्ट कॉलेज प्रवेश — भुगतान रसीद</h6>
        </div>

        {{-- Receipt Details --}}
        <table class="table table-bordered table-sm">
            <tr class="table-light">
                <th colspan="2" class="text-center bg-success text-white">Applicant Details / आवेदक विवरण</th>
            </tr>
            <tr>
                <td width="45%"><strong>Application No./आवेदन संख्या</strong></td>
                <td>{{ $data->application_no }}</td>
            </tr>
            <tr>
                <td><strong>Applicant Name/आवेदक का नाम</strong></td>
                <td>{{ $data->fullname }}</td>
            </tr>
            <tr>
                <td><strong>Mobile No./मोबाइल नंबर</strong></td>
                <td>{{ $data->mobile }}</td>
            </tr>
            <tr>
                <td><strong>Email ID/ईमेल</strong></td>
                <td>{{ $data->email }}</td>
            </tr>
            <tr>
                <td><strong>Sport/खेल</strong></td>
                <td>{{ $data->sport_name ?? 'NA' }}</td>
            </tr>
            <tr>
                <td><strong>Class/कक्षा</strong></td>
                <td>{{ $data->admission_seeking ? 'Class ' . $data->admission_seeking . 'th' : 'NA' }}</td>
            </tr>

            <tr class="table-light">
                <th colspan="2" class="text-center bg-success text-white">Payment Details / भुगतान विवरण</th>
            </tr>
            <tr>
                <td><strong>Challan No./चालान संख्या</strong></td>
                <td>{{ $payment->challanNumber ?? $payment->uniquechallan }}</td>
            </tr>
            <tr>
                <td><strong>Amount Paid/भुगतान राशि</strong></td>
                <td><strong>₹ {{ number_format($payment->paidAmount, 2) }}</strong></td>
            </tr>
            <tr>
                <td><strong>Payment Mode/भुगतान माध्यम</strong></td>
                <td>{{ $payment->paymentMode ?? 'NA' }}</td>
            </tr>
            <tr>
                <td><strong>Bank Name/बैंक का नाम</strong></td>
                <td>{{ $payment->bankName ?? 'NA' }}</td>
            </tr>
            <tr>
                <td><strong>Bank Transaction ID/बैंक लेनदेन संख्या</strong></td>
                <td>{{ $payment->bankTxnId ?? 'NA' }}</td>
            </tr>
            <tr>
                <td><strong>Gateway Transaction ID</strong></td>
                <td>{{ $payment->SabPaisaTxnId ?? 'NA' }}</td>
            </tr>
            <tr>
                <td><strong>Transaction Date/लेनदेन तिथि</strong></td>
                <td>{{ $payment->transDate ? date('d-m-Y H:i', strtotime($payment->transDate)) : 'NA' }}</td>
            </tr>
            <tr>
                <td><strong>Payment Status/भुगतान स्थिति</strong></td>
                <td><span class="badge bg-success">{{ $payment->status }}</span></td>
            </tr>
        </table>

        <p class="text-muted small text-center mt-3">
            This is a computer-generated receipt and does not require a signature.<br>
            यह एक कंप्यूटर जनित रसीद है और इस पर हस्ताक्षर की आवश्यकता नहीं है।
        </p>
    </div>
</div>

@endsection
