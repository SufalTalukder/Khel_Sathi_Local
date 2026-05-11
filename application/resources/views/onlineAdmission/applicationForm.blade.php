@extends( 'layouts.onlineAdmissionnav' )
@section('content')
<div class="row">
    <div class="col-12">
        <div class="pageheader">
            <h4>Online Admission Application/ऑनलाइन प्रवेश आवेदन</h4>
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-body">
                <ul class="nav nav-pills mb-3" id="pills-tab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <button class="nav-link active" id="pills-basic-tab" data-bs-toggle="pill" data-bs-target="#pills-basic" type="button" role="tab">Basic Details/मूल विवरण</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-communication-tab" data-bs-toggle="pill" data-bs-target="#pills-communication" type="button" role="tab">Communication/संचार</button>
                    </li>
                    <li class="nav-item" role="presentation">
                        <button class="nav-link" id="pills-education-tab" data-bs-toggle="pill" data-bs-target="#pills-education" type="button" role="tab">Education & Documents/शिक्षा और दस्तावेज</button>
                    </li>
                </ul>

                <div class="tab-content" id="pills-tabContent">
                    <!-- Basic Details -->
                    <div class="tab-pane fade show active" id="pills-basic" role="tabpanel">
                        <form action="{{ route('onlineAdmissionTest.saveBasic') }}" method="post" class="ajax-form needs-validation" novalidate>
                            @csrf
                            <div class="row">
                                <div class="col-md-4 mb-3">
                                    <label>Full Name/पूरा नाम</label>
                                    <input type="text" class="form-control" value="{{ Auth::guard('OnlineAdmission')->user()->name }}" disabled>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label>Father's Name/पिता का नाम</label>
                                    <input type="text" name="father_name" class="form-control" value="{{ $basic_detail->father_name ?? '' }}" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label>Mother's Name/माता का नाम</label>
                                    <input type="text" name="mother_name" class="form-control" value="{{ $basic_detail->mother_name ?? '' }}" required>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label>College/कॉलेज</label>
                                    <select name="college_id" class="form-control" required>
                                        <option value="">Select College</option>
                                        @foreach($sport_college as $college)
                                            <option value="{{ $college->id }}" {{ ($basic_detail->college_id ?? '') == $college->id ? 'selected' : '' }}>{{ $college->college_name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-4 mb-3">
                                    <label>Sport/खेल</label>
                                    <select name="sport_id" class="form-control" required>
                                        <option value="">Select Sport</option>
                                        @foreach($sport_type as $sport)
                                            <option value="{{ $sport->id }}" {{ ($basic_detail->sport_id ?? '') == $sport->id ? 'selected' : '' }}>{{ $sport->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Save and Next/सहेजें और आगे बढ़ें</button>
                        </form>
                    </div>

                    <!-- Communication -->
                    <div class="tab-pane fade" id="pills-communication" role="tabpanel">
                        <form action="{{ route('onlineAdmissionTest.saveCommunication') }}" method="post" class="ajax-form needs-validation" novalidate>
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label>Address/पता</label>
                                    <textarea name="address" class="form-control" required>{{ $commun_detail->address ?? '' }}</textarea>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label>State/राज्य</label>
                                    <select name="state_id" class="form-control" required>
                                        <option value="">Select State</option>
                                        @foreach($state as $s)
                                            <option value="{{ $s->id }}" {{ ($commun_detail->state_id ?? '') == $s->id ? 'selected' : '' }}>{{ $s->name }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3 mb-3">
                                    <label>City/शहर</label>
                                    <select name="city_id" class="form-control" required>
                                        <option value="">Select City</option>
                                        @foreach($city as $c)
                                            <option value="{{ $c->id }}" {{ ($commun_detail->city_id ?? '') == $c->id ? 'selected' : '' }}>{{ $c->city }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Save and Next/सहेजें और आगे बढ़ें</button>
                        </form>
                    </div>

                    <!-- Education -->
                    <div class="tab-pane fade" id="pills-education" role="tabpanel">
                        <form action="{{ route('onlineAdmissionTest.saveEducation') }}" method="post" class="ajax-form needs-validation" novalidate>
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label>Last Qualification/अंतिम योग्यता</label>
                                    <input type="text" name="qualification" class="form-control" value="{{ $education_detail->qualification ?? '' }}" required>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Percentage/प्रतिशत</label>
                                    <input type="number" step="0.01" name="percentage" class="form-control" value="{{ $education_detail->percentage ?? '' }}" required>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-primary">Save and Next/सहेजें और आगे बढ़ें</button>
                        </form>
                        
                        <hr>
                        
                        <form action="{{ route('onlineAdmissionTest.saveDocuments') }}" method="post" class="ajax-form needs-validation" novalidate enctype="multipart/form-data">
                            @csrf
                            <div class="row">
                                <div class="col-md-6 mb-3">
                                    <label>Photograph/फोटोग्राफ</label>
                                    <input type="file" name="photograph" class="form-control" {{ ($education_detail->photograph ?? '') ? '' : 'required' }}>
                                </div>
                                <div class="col-md-6 mb-3">
                                    <label>Signature/हस्ताक्षर</label>
                                    <input type="file" name="signature" class="form-control" {{ ($education_detail->signature ?? '') ? '' : 'required' }}>
                                </div>
                            </div>
                            <button type="submit" class="btn btn-success">Upload and Preview/अपलोड और पूर्वावलोकन</button>
                        </form>
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
    $('.ajax-form').submit(function(e) {
        e.preventDefault();
        var form = $(this);
        if (form[0].checkValidity() === false) {
            e.stopPropagation();
            form.addClass('was-validated');
            return;
        }
        
        var formData = new FormData(this);
        $.ajax({
            type: "POST",
            url: form.attr('action'),
            data: formData,
            processData: false,
            contentType: false,
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
