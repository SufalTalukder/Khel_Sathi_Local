@extends( 'layouts.onlineAdmissionnav' )
@section('content')
<div class="row">
    <div class="col-12">
        <div class="pageheader">
            <h4 class="mb-0">
                Application Preview/आवेदन पूर्वावलोकन
                <a href="{{ route('onlineAdmission.dashboard') }}" class="btn btn-outline-danger btn-sm backbtn float-end rounded-pill"><span class="icons icon-arrow-left"></span>Back to Dashboard/डैशबोर्ड पर वापस जाएं</a>
            </h4>
        </div>
        
        <div class="card mt-3">
            <div class="card-body">
                <div id="prodiv">
                    <table class="table table-bordered" border="1" style="border-collapse: collapse; width: 100%;">
                        <tr>
                            <td colspan="6" class="bg-light"><strong>Applicant Details/आवेदक का विवरण</strong></td>
                        </tr>
                        <tr>
                            <td><b>Application No./आवेदन संख्या</b></td>
                            <td>{{ $data->application_no ?? 'NA' }}</td>
                            <td><b>Applicant Name/आवेदक का नाम</b></td>
                            <td>{{ $data->fullname }}</td>
                            <td rowspan="5" colspan="2" style="width: 15% !important;">
                                <div class="text-center" style="padding: 5px;" align="center">
                                    @if($data->photograph)
                                        <img src="{{ asset('onlineAdmission_storage/photograph/')}}/{{$data->photograph}}" class="img-fluid" style="width: 100%;height: 140px;" /><br>
                                    @else
                                        <div style="width: 100%;height: 140px; border: 1px solid #ccc; display: flex; align-items: center; justify-content: center;">No Photo</div>
                                    @endif
                                    
                                    @if($data->signature)
                                        <img src="{{ asset('onlineAdmission_storage/signature/')}}/{{$data->signature}}"  style="width: 100%;height: 40px; margin-top:5px" />
                                    @else
                                        <div style="width: 100%;height: 40px; border: 1px solid #ccc; margin-top:5px; display: flex; align-items: center; justify-content: center;">No Sign</div>
                                    @endif
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><b>Father Name/पिता का नाम</b></td>
                            <td>{{ $data->father_name ?? 'NA' }}</td>
                            <td><b>Mother Name/माता का नाम</b></td>
                            <td>{{ $data->mother_name ?? 'NA' }}</td>
                        </tr>
                        <tr>
                            <td><b>Email ID/ईमेल</b></td>
                            <td>{{ $data->email }}</td>
                            <td><b>Mobile Number/मोबाइल</b></td>
                            <td>{{ $data->mobile }}</td>
                        </tr>
                        <tr>
                            <td><b>College/कॉलेज</b></td>
                            <td>{{ $data->college_name ?? 'NA' }}</td>
                            <td><b>Sport/खेल</b></td>
                            <td>{{ $data->sport_name ?? 'NA' }}</td>
                        </tr>
                        
                        <tr>
                            <td colspan="6" class="bg-light"><strong>Communication Details/संचार विवरण</strong></td>
                        </tr>
                        <tr>
                            <td><b>Address/पता</b></td>
                            <td colspan="2">{{ $data->address ?? 'NA' }}</td>
                            <td><b>City/State</b></td>
                            <td colspan="2">{{ $data->city_name ?? 'NA' }}, {{ $data->state_name ?? 'NA' }}</td>
                        </tr>

                        <tr>
                            <td colspan="6" class="bg-light"><strong>Education Details/शिक्षा विवरण</strong></td>
                        </tr>
                        <tr>
                            <td><b>Qualification/योग्यता</b></td>
                            <td colspan="2">{{ $data->qualification ?? 'NA' }}</td>
                            <td><b>Percentage/प्रतिशत</b></td>
                            <td colspan="2">{{ $data->percentage ?? 'NA' }}%</td>
                        </tr>
                    </table>
                </div>
                
                <hr />
                
                <div class="row justify-content-center">
                    @if (($data->form_status ?? 0) != 1)
                    <div class="col-md-2 d-grid">
                        <a href="{{ route('onlineAdmission.applicationForm') }}" class="btn btn-outline-light rounded-pill">Back to Edit/संपादित करें</a>
                    </div>
                    <div class="col-md-3 d-grid">
                        <form action="{{ route('onlineAdmission.applicationsubmit') }}" method="post" id="finalSubmitForm">
                            @csrf
                            <button type="submit" class="btn btn-outline-danger rounded-pill w-100">Final Submit/अंतिम जमा करें</button>
                        </form>
                    </div>
                    @else
                        <div class="col-md-4 text-center">
                            <h4 class="text-success">Application Submitted Successfully!/आवेदन सफलतापूर्वक जमा किया गया!</h4>
                            @if(($data->final_status ?? 0) == 0)
                                <a href="{{ route('onlineAdmission.payment') }}" class="btn btn-primary mt-2">Proceed to Payment/भुगतान के लिए आगे बढ़ें</a>
                            @endif
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@push('custom-scripts')
<script>
$(document).ready(function() {
    $('#finalSubmitForm').submit(function(e) {
        e.preventDefault();
        if(!confirm('Are you sure you want to final submit? No changes will be allowed after this.\nक्या आप सुनिश्चित हैं कि आप अंतिम रूप से जमा करना चाहते हैं? इसके बाद किसी भी बदलाव की अनुमति नहीं होगी।')) {
            return;
        }
        
        var form = $(this);
        $.ajax({
            type: "POST",
            url: form.attr('action'),
            data: form.serialize(),
            success: function(res) {
                if (res.error == false) {
                    success(res.msg);
                    if (res.url) {
                        window.location.href = res.url;
                    }
                } else {
                    error(res.msg);
                }
            }
        });
    });
});
</script>
@endpush
