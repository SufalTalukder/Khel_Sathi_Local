@extends( 'layouts.onlineAdmissionnav' )
@section('content')
<div class="container-fluid pagecontentbody">
    <div class="pagebody removebg-color">
        <div class="row">
            <div class="col-12">
                <div class="pageheader">
                    <h4 class="mb-0">
                        Payment/भुगतान
                        <a href="{{ route('onlineAdmission.dashboard') }}" class="btn btn-outline-danger btn-sm backbtn float-end rounded-pill"><span class="icons icon-arrow-left"></span>Back to Dashboard/डैशबोर्ड पर वापस जाएं</a>
                    </h4>
                </div>
                
                <div class="card mt-3">
                    <div class="card-body">
                        <div class="row justify-content-center">
                            <div class="col-md-8 text-center">
                                <h3 class="mb-4">Application Fee Payment/आवेदन शुल्क भुगतान</h3>
                                <div class="alert alert-info">
                                    <p><strong>Applicant Name/आवेदक का नाम:</strong> {{ $data->name }}</p>
                                    <p><strong>Application No./आवेदन संख्या:</strong> {{ $data->application_no }}</p>
                                    <p><strong>Fee Amount/शुल्क राशि:</strong> ₹ 500.00</p>
                                </div>
                                
                                <div class="mt-4">
                                    <form action="{{ route('onlineAdmission.applicationfinalSubmit') }}" method="post" id="paymentForm">
                                        @csrf
                                        <div class="row justify-content-center mb-3">
                                            <div class="col-md-6">
                                                <label class="form-label">Select Payment Mode/भुगतान का प्रकार चुनें</label>
                                                <select name="payment_mode" class="form-select" required>
                                                    <option value="">--Select--</option>
                                                    <option value="online">Online Payment/ऑनलाइन भुगतान</option>
                                                    <option value="offline">Offline Payment (Trial)/ऑफलाइन भुगतान (परीक्षण)</option>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <button type="submit" class="btn btn-lg btn-success rounded-pill px-5">Proceed to Final Submit & Pay/अंतिम जमा और भुगतान के लिए आगे बढ़ें</button>
                                    </form>
                                </div>
                                
                                <p class="text-muted mt-3">
                                    <small>Note: This is a reconstructed view. Please ensure the payment gateway integration is checked separately.</small>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('custom-scripts')
<script>
$(document).ready(function() {
    $('#paymentForm').submit(function(e) {
        // e.preventDefault(); // Let it submit if it's a standard form
        if(!confirm('Are you sure you want to proceed with the payment and final submission?\nक्या आप सुनिश्चित हैं कि आप भुगतान और अंतिम जमा के साथ आगे बढ़ना चाहते हैं?')) {
            e.preventDefault();
            return;
        }
    });
});
</script>
@endpush
