@extends( 'layouts.onlineAdmissionnav' )
@section('content')
<div class="col-md-12 pageheader pb-2">
    <div class="row">
        <div class="col-md-10">
            <h4 class="mb-0">Dashboard/डैशबोर्ड</h4>
        </div>
        <div class="col-md-2 d-grid">
            <a class="btn btn-outline-danger btn-sm  rounded-pill" href="{{ route('onlineAdmission.applicationPreview') }}"><i class="fa fa-plus"></i>&nbsp;&nbsp; Application Preview/आवेदन पूर्वावलोकन</a>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-11">
                <h5>Applicant Details/आवेदक का विवरण</h5>
            </div>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordred table-hover bg-white">
            <thead>
                <tr>
                    <th>S.No./क्र.सं.</th>
                    <th>Application No./आवेदन संख्या</th>
                    <th>Applicant Name/आवेदक का नाम</th>
                    <th>Sport/खेल</th>
                    <th>Gender/लिंग</th>
                    <th>Email/ईमेल</th>
                    <th>Mobile/मोबाइल</th>
                    <th>Form Submission Date/आवेदन तिथि</th>
                    <th class="text-center">Status/स्थिति</th>
                </tr>
            </thead>
            <tbody>
                <tr>
                    <td>1</td>
                    <td>{{ $data->application_no ?? 'NA' }}</td>
                    <td>{{ $data->fullname ?? 'NA' }}</td>
                    <td>{{ $data->sport_name ?? 'NA' }}</td>
                    <td>
                        @if(($data->gender ?? '') == 1) Male 
                        @elseif(($data->gender ?? '') == 2) Female 
                        @else NA 
                        @endif
                    </td>
                    <td>{{ $data->email ?? 'NA' }}</td>
                    <td>{{ $data->mobile ?? 'NA' }}</td>
                    <td>{{ $data->final_submit_date ? date('d-m-Y', strtotime($data->final_submit_date)) : 'NA' }}</td>
                    <td class="text-center">
                        @if(($data->form_status ?? 0) == 1)
                            <span class="badge bg-success rounded-pill">Submitted/जमा किया गया</span>
                        @else
                            <span class="badge bg-warning rounded-pill">Pending/लंबित</span>
                            <br>
                            <a href="{{ route('onlineAdmission.applicationForm') }}" class="btn btn-sm btn-primary mt-2">Complete Form/आवेदन पूरा करें</a>
                        @endif
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
@endsection
