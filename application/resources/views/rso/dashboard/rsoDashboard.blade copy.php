@extends('layouts/rso_layout')
@section('content')


                <div class="pagebody removebg-color">
                    <div class="pageheader">
                        <div class="row">
                            <div class="col-md-10">
                                <h4 class="mb-0">RSO Dashboard</h4>
                            </div>
                            <div class="col-md-2 d-grid">
                                <!-- <a class="btn btn-sm btn-dark" href="dashboard.html"><i class="fa fa-plus"></i>&nbsp;&nbsp; List of Applicant</a> -->
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3 modulename">
                            <a href="{{ route('direct_rect') }}" class="intentbtn bluecolor">
                                <span class="intentdata"><b class="intentno">Online Request For Direct Recruitment of Players as Gazetted Officers</b></span>
                            </a>
                            <div class="dataoverlay">
                                <div class="card card-default">
                                    <div class="card-header py-2">
                                        <h5>Reports</h5>
                                    </div>
                                    <div class="card-body p-0">
                                        <div class="list-group">
                                            <a class="list-group-item" href="#">
                                                Total Application Received
                                                <span class="pull-right text-muted small">
                                                    <em>
                                                        <span>300</span>
                                                    </em>
                                                </span>
                                            </a>
                                            <a class="list-group-item" href="#">
                                                Total Application Forwarded
                                                <span class="pull-right text-muted small">
                                                    <em>
                                                        <span>10</span>
                                                    </em>
                                                </span>
                                            </a>
                                            <a class="list-group-item" href="#">
                                                Total Pending Applications
                                                <span class="pull-right text-muted small">
                                                    <em>
                                                        <span>50</span>
                                                    </em>
                                                </span>
                                            </a>
                                            <a class="list-group-item" href="#">
                                                Total Accepted Applications
                                                <span class="pull-right text-muted small">
                                                    <em>
                                                        <span>20</span>
                                                    </em>
                                                </span>
                                            </a>
                                            <a class="list-group-item" href="#">
                                                Total Rejected Applications
                                                <span class="pull-right text-muted small">
                                                    <em>
                                                        <span>10</span>
                                                    </em>
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 modulename">
                            <a href="{{ route('financial_assis') }}" class="intentbtn greencolor">
                                <span class="intentdata"><b class="intentno">Online Request For Financial Assistance to Former Sports Person of UP</b></span>
                            </a>
                            <div class="dataoverlay">
                                <div class="card card-default">
                                    <div class="card-header py-2">
                                        <h5>Reports</h5>
                                    </div>
                                    <div class="card-body p-0">
                                        <div class="list-group">
                                            <a class="list-group-item" href="#">
                                                Total Application Received
                                                <span class="pull-right text-muted small">
                                                    <em>
                                                        <span>300</span>
                                                    </em>
                                                </span>
                                            </a>
                                            <a class="list-group-item" href="#">
                                                Total Application Forwarded
                                                <span class="pull-right text-muted small">
                                                    <em>
                                                        <span>10</span>
                                                    </em>
                                                </span>
                                            </a>
                                            <a class="list-group-item" href="#">
                                                Total Pending Applications
                                                <span class="pull-right text-muted small">
                                                    <em>
                                                        <span>50</span>
                                                    </em>
                                                </span>
                                            </a>
                                            <a class="list-group-item" href="#">
                                                Total Accepted Applications
                                                <span class="pull-right text-muted small">
                                                    <em>
                                                        <span>20</span>
                                                    </em>
                                                </span>
                                            </a>
                                            <a class="list-group-item" href="#">
                                                Total Rejected Applications
                                                <span class="pull-right text-muted small">
                                                    <em>
                                                        <span>10</span>
                                                    </em>
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 modulename">
                            <a href="{{ route('laxman') }}" class="intentbtn pinkcolor">
                                <span class="intentdata">
                                    <b class="intentno">Laxman/Rani Laxmi Bai Award</b>
                                </span>
                            </a>
                            <div class="dataoverlay">
                                <div class="card card-default">
                                    <div class="card-header py-2">
                                        <h5>Reports</h5>
                                    </div>
                                    <div class="card-body p-0">
                                        <div class="list-group">
                                            <a class="list-group-item" href="#">
                                                Total Application Received
                                                <span class="pull-right text-muted small">
                                                    <em>
                                                        <span>300</span>
                                                    </em>
                                                </span>
                                            </a>
                                            <a class="list-group-item" href="#">
                                                Total Application Forwarded
                                                <span class="pull-right text-muted small">
                                                    <em>
                                                        <span>10</span>
                                                    </em>
                                                </span>
                                            </a>
                                            <a class="list-group-item" href="#">
                                                Total Pending Applications
                                                <span class="pull-right text-muted small">
                                                    <em>
                                                        <span>50</span>
                                                    </em>
                                                </span>
                                            </a>
                                            <a class="list-group-item" href="#">
                                                Total Accepted Applications
                                                <span class="pull-right text-muted small">
                                                    <em>
                                                        <span>20</span>
                                                    </em>
                                                </span>
                                            </a>
                                            <a class="list-group-item" href="#">
                                                Total Rejected Applications
                                                <span class="pull-right text-muted small">
                                                    <em>
                                                        <span>10</span>
                                                    </em>
                                                </span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-3 modulename">
                            <a href="{{ route('award') }}" class="intentbtn pinkcolor">
                                <span class="intentdata">
                                    <b class="intentno">Award to 1st, 2nd & 3rd Position Holders at National/International Level</b>
                                </span>
                            </a>
                            <div class="dataoverlay">
                                <div class="card card-default">
                                    <div class="card-header py-2">
                                        <h5>Reports</h5>
                                    </div>
                                    <div class="card-body p-0">
                                        <div class="list-group">
                                            <a class="list-group-item" href="#">
                                                Total Application Received
                                                <span class="pull-right text-muted small">
                                                    <em>
                                                        <span>300</span>
                                                    </em>
                                                </span>
                                            </a>
                                            <a class="list-group-item" href="#">
                                                Total Application Forwarded
                                                <span class="pull-right text-muted small">
                                                    <em>
                                                        <span>10</span>
                                                    </em>
                                                </span>
                                            </a>
                                            <a class="list-group-item" href="#">
                                                Total Pending Applications
                                                <span class="pull-right text-muted small">
                                                    <em>
                                                        <span>50</span>
                                                    </em>
                                                </span>
                                            </a>
                                            <a class="list-group-item" href="#">
                                                Total Accepted Applications
                                                <span class="pull-right text-muted small">
                                                    <em>
                                                        <span>20</span>
                                                    </em>
                                                </span>
                                            </a>
                                            <a class="list-group-item" href="#">
                                                Total Rejected Applications
                                                <span class="pull-right text-muted small">
                                                    <em>
                                                        <span>10</span>
                                                    </em>
                                                </span>
                                            </a>
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
<script type="text/javascript">

</script>
@endpush