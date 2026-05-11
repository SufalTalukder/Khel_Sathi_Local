@extends('layouts/rso_layout')
@section('content')

<style>
    .modulename .card-default .card-header {
        background-color: #eee;
    }

    .modulename .card-default .card-header h5 {
        color: #023554;
        font-size: 1em;
        font-weight: 800;
    }

    .list-group .list-group-item {
        color: #141e28;
        font-size: 0.8rem;
    }

    .dasicon {
        margin-right: 5px;
        color: #ababab;
        font-size: 1rem;
        width: 20px;
    }
</style>

<div class="pagebody removebg-color">
    <div class="pageheader">
        <div class="row">
            <div class="col-md-10">
                <h4 class="mb-0">Dashboard</h4>
            </div>
            <div class="col-md-2 d-grid">
                <!-- <a class="btn btn-sm btn-dark" href="{{route('applicantDashboard')}}"><i class="fa fa-plus"></i>&nbsp;&nbsp; List of Applicant</a> -->
            </div>
        </div>
    </div>

    <div class="row">
        {{--<div class="col-md-3 modulename">
            <!-- <a href="javascript://" class="intentbtn bluecolor">
                                <span class="intentdata"><b class="intentno">Online Request For Direct Recruitment of Players as Gazetted Officers</b></span>
                            </a> -->
            <div>
                <div class="card card-default">
                    <div class="card-header p-2">
                        <a href="{{ route('direct_rect') }}" class="">
                            <h5>Online Request For Direct Recruitment of Players as Gazetted Officers</h5>
                        </a>
                    </div>
                    @foreach($direct as $key=>$list)
                    <div class="card-body p-0">
                        <div class="list-group list-group-numbered">
                            <a href="{{ route('direct_rect') }}" class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="me-auto">
                                    <div class="fw-bold"><i class="fa fa-user-check dasicon"></i> Total Application Received</div>
                                </div>
                                <span class="badge bg-primary rounded-pill">{{$list->total}}</span>
                            </a>
                            <a href="{{ route('direct_rect_spe',3) }}" class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="me-auto">
                                    <div class="fw-bold"><i class="fa fa-clipboard-check dasicon"></i> Applications Forwarded</div>
                                </div>
                                <span class="badge bg-primary rounded-pill">{{$list->total_app_forward}}</span>
                            </a>
                            <a href="{{ route('direct_rect_spe',0) }}" class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="me-auto">
                                    <div class="fw-bold"><i class="fa fa-hourglass-start dasicon"></i> Applications Pending</div>
                                </div>
                                <span class="badge bg-primary rounded-pill">{{$list->total_pending}}</span>
                            </a>
                            <a href="{{ route('direct_rect_spe',1) }}" class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="me-auto">
                                    <div class="fw-bold"><i class="fa fa-check-double dasicon"></i> Applications Accepted</div>
                                </div>
                                <span class="badge bg-primary rounded-pill">{{$list->total_accepted}}</span>
                            </a>
                            <a href="{{ route('direct_rect_spe',2) }}" class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="me-auto">
                                    <div class="fw-bold"><i class="far fa-times-circle dasicon"></i> Applications Rejected</div>
                                </div>
                                <span class="badge bg-primary rounded-pill">{{$list->total_rejected}}</span>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>--}}
        @if(Auth::guard('rsouser')->user()->role == 0)
        <div class="col-md-3 modulename">
            <!-- <a href="javascript://" class="intentbtn greencolor">
                                <span class="intentdata"><b class="intentno">Online Request For Financial Assistance to Former Sports Person of UP</b></span>
                            </a> -->
            <div>
                <div class="card card-default">
                    <div class="card-header p-2">
                        <a href="{{ route('financial_assis') }}" class="">
                            <h5>Financial Assistance</h5>
                        </a>
                    </div>
                    @foreach($financial as $key=>$list)

                    <div class="card-body p-0">
                        <div class="list-group list-group-numbered">
                            <a href="{{ route('financial_assis') }}" class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="me-auto">
                                    <div class="fw-bold"><i class="fa fa-user-check dasicon"></i> Total Application Received</div>
                                </div>
                                <span class="badge bg-primary rounded-pill">{{($list->total) }}</span>
                            </a>
                            <a href="{{ route('financial_assis_spe',3) }}" class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="me-auto">
                                    <div class="fw-bold"><i class="fa fa-clipboard-check dasicon"></i> Applications Forwarded</div>
                                </div>
                                <span class="badge bg-primary rounded-pill">{{($list->total_app_forward)}}</span>
                            </a>
                            <a href="{{ route('financial_assis_spe',0) }}" class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="me-auto">
                                    <div class="fw-bold"><i class="fa fa-hourglass-start dasicon"></i> Applications Pending</div>
                                </div>
                                <span class="badge bg-primary rounded-pill">{{($list->total_pending)}}</span>
                            </a>
                            <a href="{{ route('financial_assis_spe',1) }}" class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="me-auto">
                                    <div class="fw-bold"><i class="fa fa-check-double dasicon"></i> Applications Accepted</div>
                                </div>
                                <span class="badge bg-primary rounded-pill">{{($list->total_accepted)}}</span>
                            </a>
                            <a href="{{ route('financial_assis_spe',2) }}" class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="me-auto">
                                    <div class="fw-bold"><i class="far fa-times-circle dasicon"></i> Applications Rejected</div>
                                </div>
                                <span class="badge bg-primary rounded-pill">{{($list->total_rejected)}}</span>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-3 modulename">
            <!-- <a href="javascript://" class="intentbtn greencolor">
                                <span class="intentdata"><b class="intentno">Online Request For Financial Assistance to Former Sports Person of UP</b></span>
                            </a> -->
            <div>
                <div class="card card-default">
                    <div class="card-header p-2">
                        <a href="{{ route('monthly_pension') }}" class="">
                            <h5>Monthly Pension</h5>
                        </a>
                    </div>
                    @foreach($monthly as $key=>$list)

                    <div class="card-body p-0">
                        <div class="list-group list-group-numbered">
                            <a href="{{ route('monthly_pension') }}" class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="me-auto">
                                    <div class="fw-bold"><i class="fa fa-user-check dasicon"></i> Total Application Received</div>
                                </div>
                                <span class="badge bg-primary rounded-pill">{{($list->total) }}</span>
                            </a>
                            <a href="{{ route('monthly_pension_spe',3) }}" class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="me-auto">
                                    <div class="fw-bold"><i class="fa fa-clipboard-check dasicon"></i> Applications Forwarded</div>
                                </div>
                                <span class="badge bg-primary rounded-pill">{{($list->total_app_forward)}}</span>
                            </a>
                            <a href="{{ route('monthly_pension_spe',0) }}" class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="me-auto">
                                    <div class="fw-bold"><i class="fa fa-hourglass-start dasicon"></i> Applications Pending</div>
                                </div>
                                <span class="badge bg-primary rounded-pill">{{($list->total_pending)}}</span>
                            </a>
                            <a href="{{ route('monthly_pension_spe',1) }}" class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="me-auto">
                                    <div class="fw-bold"><i class="fa fa-check-double dasicon"></i> Applications Accepted</div>
                                </div>
                                <span class="badge bg-primary rounded-pill">{{($list->total_accepted)}}</span>
                            </a>
                            <a href="{{ route('monthly_pension_spe',2) }}" class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="me-auto">
                                    <div class="fw-bold"><i class="far fa-times-circle dasicon"></i> Applications Rejected</div>
                                </div>
                                <span class="badge bg-primary rounded-pill">{{($list->total_rejected)}}</span>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-3 modulename">
            <!-- <a href="javascript://" class="intentbtn pinkcolor">
                                <span class="intentdata">
                                    <b class="intentno">Laxman/Rani Laxmi Bai Award</b>
                                </span>
                            </a> -->
            <div>
                <div class="card card-default">
                    <div class="card-header p-2">
                        <a href="{{ route('laxman') }}" class="">
                            <h5>Nomination for Laxman Award</h5>
                        </a>

                    </div>
                    @foreach($laxman as $key=>$list)
                    <div class="card-body p-0">
                        <div class="list-group list-group-numbered">
                            <a href="{{ route('laxman') }}" class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="me-auto">
                                    <div class="fw-bold"><i class="fa fa-user-check dasicon"></i> Total Application Received</div>
                                </div>
                                <span class="badge bg-primary rounded-pill">{{($list->total)}}</span>
                                {{-- <span class="badge bg-primary rounded-pill">{{($list->total) + ($ranilaxmibai->total)}}</span> --}}
                            </a>
                            <a href="{{ route('laxman_spe',3) }}" class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="me-auto">
                                    <div class="fw-bold"><i class="fa fa-clipboard-check dasicon"></i> Applications Forwarded</div>
                                </div>
                                <span class="badge bg-primary rounded-pill">{{($list->total_app_forward)}}</span>
                            </a>
                            <a href="{{ route('laxman_spe',0) }}" class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="me-auto">
                                    <div class="fw-bold"><i class="fa fa-hourglass-start dasicon"></i> Applications Pending</div>
                                </div>
                                <span class="badge bg-primary rounded-pill">{{($list->total_pending) }}</span>
                            </a>
                            <a href="{{ route('laxman_spe',1) }}" class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="me-auto">
                                    <div class="fw-bold"><i class="fa fa-check-double dasicon"></i> Applications Accepted</div>
                                </div>
                                <span class="badge bg-primary rounded-pill">{{($list->total_accepted) }}</span>
                            </a>
                            <a href="{{ route('laxman_spe',2) }}" class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="me-auto">
                                    <div class="fw-bold"><i class="far fa-times-circle dasicon"></i> Applications Rejected</div>
                                </div>
                                <span class="badge bg-primary rounded-pill">{{($list->total_rejected)}}</span>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        <div class="col-md-3 modulename">
            <!-- <a href="javascript://" class="intentbtn pinkcolor">
                                <span class="intentdata">
                                    <b class="intentno">Laxman/Rani Laxmi Bai Award</b>
                                </span>
                            </a> -->
            <div>
                <div class="card card-default">
                    <div class="card-header p-2">
                        <a href="{{ route('laxmibai') }}" class="">
                            <h5>Nomination for Rani Laxmibai Award</h5>
                        </a>

                    </div>
                    @foreach($ranilaxmibai as $key=>$list)
                    <div class="card-body p-0">
                        <div class="list-group list-group-numbered">
                            <a href="{{ route('laxmibai') }}" class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="me-auto">
                                    <div class="fw-bold"><i class="fa fa-user-check dasicon"></i> Total Application Received</div>
                                </div>
                                <span class="badge bg-primary rounded-pill">{{($list->total)}}</span>
                                {{-- <span class="badge bg-primary rounded-pill">{{($list->total) + ($ranilaxmibai->total)}}</span> --}}
                            </a>
                            <a href="{{ route('laxmibai_spe',3) }}" class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="me-auto">
                                    <div class="fw-bold"><i class="fa fa-clipboard-check dasicon"></i> Applications Forwarded</div>
                                </div>
                                <span class="badge bg-primary rounded-pill">{{($list->total_app_forward)}}</span>
                            </a>
                            <a href="{{ route('laxmibai_spe',0) }}" class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="me-auto">
                                    <div class="fw-bold"><i class="fa fa-hourglass-start dasicon"></i> Applications Pending</div>
                                </div>
                                <span class="badge bg-primary rounded-pill">{{($list->total_pending) }}</span>
                            </a>
                            <a href="{{ route('laxmibai_spe',1) }}" class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="me-auto">
                                    <div class="fw-bold"><i class="fa fa-check-double dasicon"></i> Applications Accepted</div>
                                </div>
                                <span class="badge bg-primary rounded-pill">{{($list->total_accepted) }}</span>
                            </a>
                            <a href="{{ route('laxmibai_spe',2) }}" class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="me-auto">
                                    <div class="fw-bold"><i class="far fa-times-circle dasicon"></i> Applications Rejected</div>
                                </div>
                                <span class="badge bg-primary rounded-pill">{{($list->total_rejected)}}</span>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
        @endif
        <div class="col-md-3 modulename">
            <div>
                <div class="card card-default">
                    <div class="card-header p-2">
                        <a href="{{ route('award') }}" class="">
                            <h5>Nomination for Prize Money</h5>
                        </a>
                    </div>
                    @foreach($position as $key=>$list)
                    <div class="card-body p-0">
                        <div class="list-group list-group-numbered">
                            <a href="{{ route('award') }}" class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="me-auto">
                                    <div class="fw-bold"><i class="fa fa-user-check dasicon"></i> Total Application Received</div>
                                </div>
                                <span class="badge bg-primary rounded-pill">{{$list->total}}</span>
                            </a>
                            <a href="{{ route('award_spe',3) }}" class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="me-auto">
                                    <div class="fw-bold"><i class="fa fa-clipboard-check dasicon"></i> Applications Forwarded</div>
                                </div>
                                <span class="badge bg-primary rounded-pill">{{$list->total_app_forward}}</span>
                            </a>
                            <a href="{{ route('award_spe',0) }}" class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="me-auto">
                                    <div class="fw-bold"><i class="fa fa-hourglass-start dasicon"></i> Applications Pending</div>
                                </div>
                                <span class="badge bg-primary rounded-pill">{{$list->total_pending}}</span>
                            </a>
                            <a href="{{ route('award_spe',1) }}" class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="me-auto">
                                    <div class="fw-bold"><i class="fa fa-check-double dasicon"></i> Applications Accepted</div>
                                </div>
                                <span class="badge bg-primary rounded-pill">{{$list->total_accepted}}</span>
                            </a>
                            <a href="{{ route('award_spe',2) }}" class="list-group-item d-flex justify-content-between align-items-start">
                                <div class="me-auto">
                                    <div class="fw-bold"><i class="far fa-times-circle dasicon"></i> Applications Rejected</div>
                                </div>
                                <span class="badge bg-primary rounded-pill">{{$list->total_rejected}}</span>
                            </a>
                        </div>
                    </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</div>
</div>


@endsection

@push('custom-scripts')
<script type="text/javascript">
    $(function() {
        var table = $('.yajra-datatable').DataTable({
            processing: true,
            serverSide: true,
            ajax: "{{ route('projectlist') }}",
            columns: [{
                    data: 'DT_RowIndex',
                    name: 'DT_RowIndex'
                },
                {
                    data: 'fullname',
                    name: 'fullname'
                },
                {
                    data: 'project_id',
                    name: 'project_id'
                },
                {
                    data: 'project_name',
                    name: 'project_name'
                },
                {
                    data: 'application_date',
                    name: 'application_date'
                },
                {
                    data: 'current_status',
                    name: 'current_status',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'view',
                    name: 'view',
                    orderable: false,
                    searchable: false
                },
            ]
        });
    });
</script>
@endpush
