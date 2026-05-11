@extends('layouts.onlineAdmissionTestNav')
@section('content')
<div class="row">
    <div class="col-12">
        <div class="pageheader pb-2">
            <h4>Dashboard/डैशबोर्ड
                <div class="float-end d-flex gap-2">
                    <a href="{{ route('onlineAdmissionTest.trialSchedule') }}" class="btn btn-outline-success btn-sm rounded-pill">
                        <i class="fa fa-map-marker-alt"></i> Trial Venue/परीक्षा स्थल
                    </a>
                    <a href="{{ route('onlineAdmissionTest.applicationPreview') }}" class="btn btn-outline-danger btn-sm rounded-pill">
                        <i class="fa fa-eye"></i> Application Preview/आवेदन पूर्वावलोकन
                    </a>
                </div>
            </h4>
        </div>
    </div>
</div>
@if(($data->final_status ?? 0) == 3)
<div class="alert alert-danger border-danger mb-3">
    <h6 class="fw-bold mb-1"><i class="fa fa-times-circle"></i> Application Rejected / आवेदन अस्वीकृत</h6>
    <p class="mb-2">Your application has been reviewed and rejected by the authority. Please read the reason below./आपका आवेदन प्राधिकारी द्वारा समीक्षा कर अस्वीकृत किया गया है। कृपया नीचे दिया गया कारण पढ़ें ।</p>
    @if(!empty($data->comment))
    <div class="p-2 bg-white rounded border">
        <strong>Reason/कारण:</strong> {{ $data->comment }}
    </div>
    @endif
</div>
@elseif(($data->query_status ?? 0) == 1)
<div class="alert alert-info border-info mb-3">
    <h6 class="fw-bold mb-1"><i class="fa fa-times-circle"></i>Query has been marked. / प्रश्न चिह्नित कर दिया गया है।</h6>
    <p class="mb-2">Your application has been reviewed and a query has been marked by the authority. Please read the reason below, update your application accordingly, and re-submit./आपके आवेदन की समीक्षा की गई है और प्राधिकारी द्वारा एक आपत्ति (क्वेरी) दर्ज की गई है। कृपया नीचे दिया गया कारण पढ़ें, अपने आवेदन को तदनुसार संशोधित करें और पुनः जमा करें।</p>
    @if(!empty($data->query_mark))
    <div class="p-2 bg-white rounded border">
        <strong>Reason/कारण:</strong> {{ $data->query_mark }}
    </div>
    @endif
    <a href="{{ route('onlineAdmissionTest.applicationForm') }}" class="btn btn-info btn-sm mt-2 rounded-pill">
        <i class="fa fa-edit"></i> Edit &amp; Re-submit Application / आवेदन संपादित करें और पुनः जमा करें
    </a>
</div>
@endif

<div class="card">
    <div class="card-header"><h5>Applicant Details/आवेदक का विवरण</h5></div>
    <div class="card-body">
        <table class="table table-bordered table-hover bg-white">
            <thead class="table-success">
                <tr>
                    <th>S.No.</th>
                    <th>Application No./आवेदन संख्या</th>
                    <th>Applicant Name/आवेदक का नाम</th>
                    <th>Sport/खेल</th>
                    <th>Mobile/मोबाइल</th>
                    <th>Payment Status/भुगतान स्थिति</th>
                    <th>Status/स्थिति</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td><b>{{ $data->application_no ?? 'NA' }}</b></td>
                    <td>{{ $data->fullname ?? 'NA' }}</td>
                    <td>{{ $data->sport_name ?? 'NA' }}</td>
                    <td>{{ $data->mobile ?? 'NA' }}</td>
                    <td>
                        @if(($data->payment_status ?? 0) == 1)
                            <span class="badge bg-success rounded-pill">Paid/भुगतान हुआ</span>
                            <br><a href="{{ route('onlineAdmissionTest.paymentReceipt') }}" class="btn btn-sm btn-outline-success mt-1 rounded-pill">
                                <i class="fa fa-download"></i> Receipt/रसीद
                            </a>
                        @elseif(($data->final_status ?? 0) != 3)
                            <span class="badge bg-warning text-dark rounded-pill">Pending/लंबित</span>
                            @if(($data->final_status ?? 0) == 1)
                                <br><a href="{{ route('onlineAdmissionTest.payment') }}" class="btn btn-sm btn-primary mt-1 rounded-pill">Pay Now/भुगतान करें</a>
                            @endif
                        @else
                            <span class="badge bg-warning text-dark rounded-pill">Pending/लंबित</span>
                        @endif
                    </td>
                    <td>
                        @if(($data->final_status ?? 0) == 3)
                            <span class="badge bg-danger rounded-pill">Rejected/अस्वीकृत</span>
                            
                        @elseif(($data->final_status ?? 0) == 1)
                            <span class="badge bg-success rounded-pill">Submitted/जमा किया गया</span>
                            @if(($data->query_status ?? 0) == 1)
                                <br><a href="{{ route('onlineAdmissionTest.applicationForm') }}" class="btn btn-sm btn-info mt-1 rounded-pill">
                                    <i class="fa fa-edit"></i> Edit Form/संपादित करें
                                </a>
                            @endif
                        @else
                            <span class="badge bg-warning text-dark rounded-pill">Form Incomplete/अपूर्ण</span>
                            <br><a href="{{ route('onlineAdmissionTest.applicationForm') }}" class="btn btn-sm btn-primary mt-1 rounded-pill">Complete Form</a>
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
