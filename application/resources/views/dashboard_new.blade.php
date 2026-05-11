@extends('layouts/layout')
@section('content')

    <!-- InstanceBeginEditable name="Content Area" -->
    <style>
        .menumarginleft {
            margin-left: 0;
        }

        .menuheader-width {
            left: 0;
        }

        .sub-title {
            margin: 10px 10px 0px 10px;
            font-weight: 600;
            font-size: 1em;
        }
    </style>

    <section>
        <div class="dashwrap container-fluid">
            <div class="row">
                <div class="col-md-9">
                    <div class="dash-title ">
                        <h1>Dashboard</h1>
                    </div>
                    <ul class="nav nav-tabs" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#home"
                                type="button" role="tab" aria-controls="home" aria-selected="true">All
                                Application</button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile"
                                type="button" role="tab" aria-controls="profile" aria-selected="false">Submitted
                                Application</button>
                        </li>
                    </ul>
                    @php
                        if (Session::get('sessDetails')) {
                            $sessDetails = Session::get('sessDetails');
                        }
                        if (Session::get('service_code')) {
                            $service_code = Session::get('service_code');
                        }
                    @endphp
                    <div class="tab-content" id="myTabContent">
                        <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                            <div id="counter">
                                <div class="row">
                                    @if (isset($sessDetails))
                                        @if (false)

                                            @if (isset($sessDetails) && $sessDetails['serviceCode'] == 16602)
                                                <div class="col-md-4 col-sm-4">
                                                    <div class="counter">
                                                        <svg version="1.0" id="Layer_1"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 64 64"
                                                            enable-background="new 0 0 64 64" xml:space="preserve">
                                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                                stroke-linejoin="round"></g>
                                                            <g id="SVGRepo_iconCarrier">
                                                                <g>
                                                                    <path
                                                                        d="M60,6h-7V4c0-2.212-1.789-4-4-4H15c-2.211,0-4,1.788-4,4v2H4c-2.211,0-4,1.788-4,4v8 c0,6.074,4.925,11,11,11h0.096C12.01,38.659,19.477,46.395,29,47.761V56h-7c-2.211,0-4,1.788-4,4v3c0,0.552,0.447,1,1,1h26 c0.553,0,1-0.448,1-1v-3c0-2.212-1.789-4-4-4h-7v-8.239c9.523-1.366,16.985-9.1,17.899-18.761H53c6.075,0,11-4.926,11-11v-8 C64,7.788,62.211,6,60,6z M11,23c-2.762,0-5-2.239-5-5v-6h5V23z M2,18v-8c0-1.105,0.896-2,2-2h7v2H5c-0.553,0-1,0.446-1,1v7 c0,3.865,3.134,7,7,7v2C6.029,27,2,22.97,2,18z M42,58c1.104,0,2,0.895,2,2v2H20v-2c0-1.105,0.896-2,2-2H42z M31,56v-8.052 C31.334,47.964,31.662,48,32,48s0.666-0.036,1-0.052V56H31z M51,27c0,10.492-8.507,19-19,19s-19-8.508-19-19V4c0-1.105,0.896-2,2-2 h34c1.104,0,2,0.895,2,2V27z M53,12h5v6c0,2.761-2.238,5-5,5V12z M62,18c0,4.97-4.029,9-9,9v-2c3.866,0,7-3.135,7-7v-7 c0-0.554-0.447-1-1-1h-6V8h7c1.104,0,2,0.895,2,2V18z">
                                                                    </path>
                                                                    <path
                                                                        d="M39.147,19.36l-4.309-0.658l-1.936-4.123c-0.165-0.352-0.518-0.575-0.905-0.575s-0.74,0.224-0.905,0.575 l-1.936,4.123l-4.309,0.658c-0.37,0.058-0.678,0.315-0.797,0.671s-0.029,0.747,0.232,1.016l3.146,3.227l-0.745,4.564 c-0.062,0.378,0.099,0.758,0.411,0.979s0.725,0.243,1.061,0.059l3.841-2.123l3.841,2.123C35.99,29.959,36.157,30,36.323,30 c0.202,0,0.404-0.062,0.576-0.184c0.312-0.221,0.473-0.601,0.411-0.979l-0.745-4.564l3.146-3.227 c0.262-0.269,0.352-0.66,0.232-1.016S39.518,19.418,39.147,19.36z M34.781,23.238c-0.222,0.228-0.322,0.546-0.271,0.859 l0.495,3.029l-2.522-1.395c-0.151-0.083-0.317-0.125-0.484-0.125s-0.333,0.042-0.484,0.125l-2.522,1.395l0.495-3.029 c0.051-0.313-0.05-0.632-0.271-0.859l-2.141-2.193l2.913-0.446c0.329-0.05,0.612-0.261,0.754-0.563l1.257-2.678l1.257,2.678 c0.142,0.303,0.425,0.514,0.754,0.563l2.913,0.446L34.781,23.238z">
                                                                    </path>
                                                                </g>
                                                            </g>
                                                        </svg>
                                                        <?php $check = status_check(3); ?>
                                                        <p class="sub-title">1st, 2nd & 3rd Position Holder</p>
                                                        @if ($checkk == 1)
                                                            <div id="ribbon-container">
                                                                <!-- <a data-bs-toggle="modal" data-bs-target="#PositionHolder" id="ribbon">Click Here for New Application</a> -->
                                                                <a href="{{ url('position_holder') }}" id="ribbon">Form
                                                                    Not Available</a>
                                                            </div>
                                                        @else
                                                            @if (empty($check) || (!empty($check) && $check->form_status == 2))
                                                                <div id="ribbon-container">
                                                                    <!-- <a data-bs-toggle="modal" data-bs-target="#PositionHolder" id="ribbon">Click Here for New Application</a> -->
                                                                    <a href="{{ url('position_holder') }}"
                                                                        id="ribbon">Click Here for New Application</a>
                                                                </div>
                                                            @else
                                                                <div id="ribbon-container">
                                                                    <a
                                                                        @if (!empty($check)) href="{{ url('positiondetailForm') }}/{{ $check->application_no }}" @endif>Form
                                                                        Already Filled</a>
                                                                </div>
                                                            @endif
                                                        @endif
                                                        <?php $sub = 'btn-default';
                                                        $in_pro = 'btn-default';
                                                        $in_pend = 'btn-default';
                                                        if (!empty($check) && $check->final_submit == 1) {
                                                            $sub = 'bg-success';
                                                            $in_pro = 'bg-info';
                                                        } ?>
                                                        <?php if (!empty($check)) {
                                                            $abc = marked_status($check->application_no, 3);
                                                            $in_pend = 'bg-warning';
                                                        } ?>
                                                        <p class="arrow">
                                                            @if (!empty($check) && $check->final_submit == 1)
                                                                <button type="button"
                                                                    class="btn {{ $sub }} btn-arrow-right">Submitted</button>
                                                            @else
                                                                <button type="button"
                                                                    class="btn {{ $in_pend }} btn-arrow-right">Pending</button>
                                                            @endif
                                                            @if (isset($abc) && isset($check) && $check->form_status == 0 && $abc->is_closed == 0)
                                                                @if ($abc->query_status == 0)
                                                                    <button type="button"
                                                                        class="btn {{ $in_pro }} btn-arrow-right">Query
                                                                        Marked</button>
                                                                @else
                                                                    <button type="button"
                                                                        class="btn {{ $in_pro }} btn-arrow-right">
                                                                        @if ($abc->current_status != 'User')
                                                                            Query Marked
                                                                        @else
                                                                            Replied
                                                                        @endif
                                                                    </button>
                                                                @endif
                                                            @else
                                                                <!-- <button type="button" class="btn {{ $in_pro }} btn-arrow-right">Query Closed</button> -->
                                                                <button type="button"
                                                                    class="btn {{ $in_pro }} btn-arrow-right">In
                                                                    Process</button>
                                                            @endif
                                                            @if (!empty($check) && $check->form_status == 1)
                                                                <button type="button"
                                                                    class="btn bg-secondary btn-default btn-arrow-right">Approved</button>
                                                                @if (!empty($check) && $check->amount_release_status == 1)
                                                                    <button type="button"
                                                                        class="btn bg-success btn-default btn-arrow-right display_none">Paid</button>
                                                                @else
                                                                    <button type="button"
                                                                        class="btn btn-default btn-arrow-right display_none">Paid</button>
                                                                @endif
                                                            @elseif(!empty($check) && $check->form_status == 2)
                                                                <button type="button"
                                                                    class="btn bg-danger btn-default btn-arrow-right display_none">Rejected</button>
                                                            @else
                                                                <button type="button"
                                                                    class="btn btn-default btn-arrow-right">Approved</button>
                                                                <button type="button"
                                                                    class="btn btn-default btn-arrow-right display_none">Paid</button>
                                                            @endif
                                                        </p>
                                                    </div>
                                                </div>
                                            @endif
                                            @if (isset($sessDetails) && $sessDetails['serviceCode'] == 16603)
                                                <div class="col-md-4 col-sm-4">
                                                    <div class="counter blue1">
                                                        <svg version="1.0" id="Layer_1"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 64 64"
                                                            enable-background="new 0 0 64 64" xml:space="preserve">
                                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                                stroke-linejoin="round"></g>
                                                            <g id="SVGRepo_iconCarrier">
                                                                <g>
                                                                    <path
                                                                        d="M60,6h-7V4c0-2.212-1.789-4-4-4H15c-2.211,0-4,1.788-4,4v2H4c-2.211,0-4,1.788-4,4v8 c0,6.074,4.925,11,11,11h0.096C12.01,38.659,19.477,46.395,29,47.761V56h-7c-2.211,0-4,1.788-4,4v3c0,0.552,0.447,1,1,1h26 c0.553,0,1-0.448,1-1v-3c0-2.212-1.789-4-4-4h-7v-8.239c9.523-1.366,16.985-9.1,17.899-18.761H53c6.075,0,11-4.926,11-11v-8 C64,7.788,62.211,6,60,6z M11,23c-2.762,0-5-2.239-5-5v-6h5V23z M2,18v-8c0-1.105,0.896-2,2-2h7v2H5c-0.553,0-1,0.446-1,1v7 c0,3.865,3.134,7,7,7v2C6.029,27,2,22.97,2,18z M42,58c1.104,0,2,0.895,2,2v2H20v-2c0-1.105,0.896-2,2-2H42z M31,56v-8.052 C31.334,47.964,31.662,48,32,48s0.666-0.036,1-0.052V56H31z M51,27c0,10.492-8.507,19-19,19s-19-8.508-19-19V4c0-1.105,0.896-2,2-2 h34c1.104,0,2,0.895,2,2V27z M53,12h5v6c0,2.761-2.238,5-5,5V12z M62,18c0,4.97-4.029,9-9,9v-2c3.866,0,7-3.135,7-7v-7 c0-0.554-0.447-1-1-1h-6V8h7c1.104,0,2,0.895,2,2V18z">
                                                                    </path>
                                                                    <path
                                                                        d="M39.147,19.36l-4.309-0.658l-1.936-4.123c-0.165-0.352-0.518-0.575-0.905-0.575s-0.74,0.224-0.905,0.575 l-1.936,4.123l-4.309,0.658c-0.37,0.058-0.678,0.315-0.797,0.671s-0.029,0.747,0.232,1.016l3.146,3.227l-0.745,4.564 c-0.062,0.378,0.099,0.758,0.411,0.979s0.725,0.243,1.061,0.059l3.841-2.123l3.841,2.123C35.99,29.959,36.157,30,36.323,30 c0.202,0,0.404-0.062,0.576-0.184c0.312-0.221,0.473-0.601,0.411-0.979l-0.745-4.564l3.146-3.227 c0.262-0.269,0.352-0.66,0.232-1.016S39.518,19.418,39.147,19.36z M34.781,23.238c-0.222,0.228-0.322,0.546-0.271,0.859 l0.495,3.029l-2.522-1.395c-0.151-0.083-0.317-0.125-0.484-0.125s-0.333,0.042-0.484,0.125l-2.522,1.395l0.495-3.029 c0.051-0.313-0.05-0.632-0.271-0.859l-2.141-2.193l2.913-0.446c0.329-0.05,0.612-0.261,0.754-0.563l1.257-2.678l1.257,2.678 c0.142,0.303,0.425,0.514,0.754,0.563l2.913,0.446L34.781,23.238z">
                                                                    </path>
                                                                </g>
                                                            </g>
                                                        </svg>
                                                        <p class="sub-title"> Laxman / Rani Laxmi Bai Award</p>
                                                        @if ($user->gender == 'Male')
                                                            <?php $check = status_check(1); ?>
                                                            <?php if (!empty($check)) {
                                                                $abc = marked_status($check->application_no, 1);
                                                            } ?>
                                                        @else
                                                            <?php $check = status_check(2); ?>
                                                        @endif
                                                        @if (empty($check) || (!empty($check) && $check->form_status == 2))
                                                            <div id="ribbon-container">
                                                                <!-- <a data-bs-toggle="modal" data-bs-target="#Laxman" id="ribbon">Click Here for New Application</a> -->
                                                                @if ($user->gender == 'Male')
                                                                    <a href="{{ url('laxman_award') }}"
                                                                        class="btn btn-primary">Click Here for New
                                                                        Application</a>
                                                                @else
                                                                    <a href="{{ url('rani_laxmi_bai_award') }}"
                                                                        class="btn btn-primary">Click Here for New
                                                                        Application</a>
                                                                @endif
                                                            </div>
                                                        @else
                                                            <div id="ribbon-container">
                                                                @if ($user->gender == 'Male')
                                                                    <a
                                                                        @if (!empty($check)) href="{{ url('laxmandetailForm') }}/{{ $check->application_no }}" @endif>
                                                                    @else
                                                                        <a
                                                                            @if (!empty($check)) href="{{ url('laxmibaidetailForm') }}/{{ $check->application_no }}" @endif>
                                                                @endif
                                                                Form Already Filled</a>
                                                            </div>
                                                        @endif
                                                        <?php $sub = 'btn-default';
                                                        $in_pro = 'btn-default';
                                                        $in_pend = 'btn-default';
                                                        if (!empty($check) && $check->final_submit == 1) {
                                                            $sub = 'bg-success';
                                                            $in_pro = 'bg-info';
                                                        } ?>
                                                        <?php if (!empty($check)) {
                                                            $abc = marked_status($check->application_no, 2);
                                                            $in_pend = 'bg-warning';
                                                        } ?>
                                                        <p class="arrow">
                                                            @if (!empty($check) && $check->final_submit == 1)
                                                                <button type="button"
                                                                    class="btn {{ $sub }} btn-arrow-right">Submitted</button>
                                                            @else
                                                                <button type="button"
                                                                    class="btn {{ $in_pend }} btn-arrow-right">Pending</button>
                                                            @endif
                                                            @if (isset($abc) && isset($check) && $check->form_status == 0 && $abc->is_closed == 0)
                                                                @if ($abc->query_status == 0)
                                                                    <button type="button"
                                                                        class="btn {{ $in_pro }} btn-arrow-right">Query
                                                                        Marked</button>
                                                                @else
                                                                    <button type="button"
                                                                        class="btn {{ $in_pro }} btn-arrow-right">
                                                                        @if ($abc->current_status != 'User')
                                                                            Query Marked
                                                                        @else
                                                                            Replied
                                                                        @endif
                                                                    </button>
                                                                @endif
                                                            @else
                                                                <!-- <button type="button" class="btn {{ $in_pro }} btn-arrow-right">Query Closed</button> -->
                                                                <button type="button"
                                                                    class="btn {{ $in_pro }} btn-arrow-right">In
                                                                    Process</button>
                                                            @endif
                                                            @if (!empty($check) && $check->form_status == 1)
                                                                <button type="button"
                                                                    class="btn bg-secondary btn-default btn-arrow-right">Approved</button>
                                                                @if (!empty($check) && $check->amount_release_status == 1)
                                                                    <button type="button"
                                                                        class="btn bg-success btn-default btn-arrow-right display_none">Paid</button>
                                                                @else
                                                                    <button type="button"
                                                                        class="btn btn-default btn-arrow-right display_none">Paid</button>
                                                                @endif
                                                            @elseif(!empty($check) && $check->form_status == 2)
                                                                <button type="button"
                                                                    class="btn bg-danger btn-default btn-arrow-right display_none">Rejected</button>
                                                            @else
                                                                <button type="button"
                                                                    class="btn btn-default btn-arrow-right">Approved</button>
                                                                <button type="button"
                                                                    class="btn btn-default btn-arrow-right display_none">Paid</button>
                                                            @endif
                                                        </p>
                                                    </div>
                                                </div>
                                            @endif
                                            @if (isset($sessDetails) && $sessDetails['serviceCode'] == 16601)
                                                <div class="col-md-4 col-sm-4">
                                                    <div class="counter pink1">
                                                        <svg version="1.1" id="Layer_1"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink"
                                                            viewBox="0 0 512 512" xml:space="preserve">
                                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                                stroke-linejoin="round"></g>
                                                            <g id="SVGRepo_iconCarrier">
                                                                <g>
                                                                    <g>
                                                                        <path
                                                                            d="M189.388,52.245h-62.694c-5.77,0-11.755,3.372-11.755,9.143v137.143H64c-5.77,0-11.755,3.372-11.755,9.143v208.98 c0,5.77,5.985,11.755,11.755,11.755h62.694h62.694c5.77,0,9.143-5.985,9.143-11.755V61.388 C198.531,55.617,195.158,52.245,189.388,52.245z M114.939,407.51H73.143V219.429h41.796V407.51z M177.633,407.51h-41.796V207.673 V73.143h41.796V407.51z">
                                                                        </path>
                                                                    </g>
                                                                </g>
                                                                <g>
                                                                    <g>
                                                                        <path
                                                                            d="M450.612,52.245h-62.694c-5.77,0-11.755,3.372-11.755,9.143v137.143h-50.939c-5.77,0-11.755,3.372-11.755,9.143v208.98 c0,5.77,5.985,11.755,11.755,11.755h62.694h62.694c5.77,0,9.143-5.985,9.143-11.755V61.388 C459.755,55.617,456.383,52.245,450.612,52.245z M376.163,407.51h-41.796V219.429h41.796V407.51z M438.857,407.51h-41.796V207.673 V73.143h41.796V407.51z">
                                                                        </path>
                                                                    </g>
                                                                </g>
                                                                <g>
                                                                    <g>
                                                                        <rect y="438.857" width="512" height="20.898">
                                                                        </rect>
                                                                    </g>
                                                                </g>
                                                            </g>
                                                        </svg>
                                                        <p class="sub-title"> Financial Assistance (State,National and
                                                            International Level) </p>
                                                        <?php $check = status_check(4); ?>
                                                        @if (empty($check) || (!empty($check) && $check->form_status == 2))
                                                            <div id="ribbon-container">
                                                                <!-- <a data-bs-toggle="modal" data-bs-target="#Financial" id="ribbon">Click Here for New Application</a> -->
                                                                <a href="{{ url('financial-assistance') }}"
                                                                    class="btn btn-primary">Click Here for New
                                                                    Application</a>
                                                            </div>
                                                        @else
                                                            <div id="ribbon-container">
                                                                <a
                                                                    @if (!empty($check)) href="{{ url('financialformPreview') }}/{{ $check->application_no }}" @endif>Form
                                                                    Already Filled</a>
                                                            </div>
                                                        @endif
                                                        <?php $sub = 'btn-default';
                                                        $in_pro = 'btn-default';
                                                        $in_pend = 'btn-default';

                                                        if (!empty($check) && $check->final_submit == 1) {
                                                            $sub = 'bg-success';
                                                            $in_pro = 'bg-info';
                                                        } ?>
                                                        <?php if (!empty($check)) {
                                                            $abc = marked_status($check->application_no, 4);
                                                            $in_pend = 'bg-warning';
                                                        } ?>
                                                        <p class="arrow">
                                                            @if (!empty($check) && $check->final_submit == 1)
                                                                <button type="button"
                                                                    class="btn {{ $sub }} btn-arrow-right">Submitted</button>
                                                            @else
                                                                <button type="button"
                                                                    class="btn {{ $in_pend }} btn-arrow-right">Pending</button>
                                                            @endif
                                                            @if (isset($abc) && isset($check) && $check->form_status == 0 && $abc->is_closed == 0)
                                                                @if ($abc->query_status == 0)
                                                                    <button type="button"
                                                                        class="btn {{ $in_pro }} btn-arrow-right">Query
                                                                        Marked</button>
                                                                @else
                                                                    <button type="button"
                                                                        class="btn {{ $in_pro }} btn-arrow-right">
                                                                        @if ($abc->current_status != 'User')
                                                                            Query Marked
                                                                        @else
                                                                            Replied
                                                                        @endif
                                                                    </button>
                                                                @endif
                                                            @else
                                                                <!-- <button type="button" class="btn {{ $in_pro }} btn-arrow-right">Query Closed</button> -->
                                                                <button type="button"
                                                                    class="btn {{ $in_pro }} btn-arrow-right">In
                                                                    Process</button>
                                                            @endif
                                                            @if (!empty($check) && $check->form_status == 1)
                                                                <button type="button"
                                                                    class="btn bg-secondary btn-default btn-arrow-right">Approved</button>
                                                                @if (!empty($check) && $check->amount_release_status == 1)
                                                                    <button type="button"
                                                                        class="btn bg-success btn-default btn-arrow-right display_none">Paid</button>
                                                                @else
                                                                    <button type="button"
                                                                        class="btn btn-default btn-arrow-right display_none">Paid</button>
                                                                @endif
                                                            @elseif(!empty($check) && $check->form_status == 2)
                                                                <button type="button"
                                                                    class="btn bg-danger btn-default btn-arrow-right display_none">Rejected</button>
                                                            @else
                                                                <button type="button"
                                                                    class="btn btn-default btn-arrow-right">Approved</button>
                                                                <button type="button"
                                                                    class="btn btn-default btn-arrow-right display_none">Paid</button>
                                                            @endif
                                                        </p>
                                                    </div>
                                                </div>
                                            @endif
                                            @if (isset($sessDetails) && $sessDetails['serviceCode'] == 16604)
                                                <div class="col-md-4 col-sm-4">
                                                    <div class="counter purple1">
                                                        <svg viewBox="0 0 32 32"
                                                            style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;"
                                                            version="1.1" xml:space="preserve"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:serif="http://www.serif.com/"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink">
                                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                                stroke-linejoin="round"></g>
                                                            <g id="SVGRepo_iconCarrier">
                                                                <g id="Layer1">
                                                                    <path
                                                                        d="M16,6l-13,0c-0.552,0 -1,0.448 -1,1l0,22c0,0.552 0.448,1 1,1l22,0c0.552,0 1,-0.448 1,-1l0,-13c0,-0.552 -0.448,-1 -1,-1c-0.552,-0 -1,0.448 -1,1l0,12c0,0 -20,0 -20,0c0,0 0,-20 0,-20c-0,0 12,0 12,0c0.552,0 1,-0.448 1,-1c0,-0.552 -0.448,-1 -1,-1Zm-9,19l14,-0c0.552,0 1,-0.448 1,-1c0,-0.552 -0.448,-1 -1,-1l-14,0c-0.552,0 -1,0.448 -1,1c0,0.552 0.448,1 1,1Zm-0,-4l4,0c0.552,-0 1,-0.448 1,-1c-0,-0.552 -0.448,-1 -1,-1l-4,0c-0.552,-0 -1,0.448 -1,1c-0,0.552 0.448,1 1,1Zm22.707,-13.293c0.391,-0.39 0.391,-1.024 0,-1.414l-4,-4c-0.39,-0.391 -1.024,-0.391 -1.414,-0l-10,10c-0.14,0.139 -0.235,0.317 -0.274,0.511l-1,5c-0.065,0.328 0.037,0.667 0.274,0.903c0.236,0.237 0.575,0.339 0.903,0.274l5,-1c0.194,-0.039 0.372,-0.134 0.511,-0.274l10,-10Zm-22.707,9.293l4,0c0.552,0 1,-0.448 1,-1c0,-0.552 -0.448,-1 -1,-1l-4,0c-0.552,0 -1,0.448 -1,1c0,0.552 0.448,1 1,1Zm0,-4l5,-0c0.552,0 1,-0.448 1,-1c0,-0.552 -0.448,-1 -1,-1l-5,-0c-0.552,0 -1,0.448 -1,1c0,0.552 0.448,1 1,1Z">
                                                                    </path>
                                                                </g>
                                                            </g>
                                                        </svg>
                                                        <p class="sub-title"> Direct Recruitment Various Posts </p>
                                                        <?php
                                                        $check = status_check(6); ?>
                                                        <?php $sub = 'btn-default';
                                                        $in_pro = 'btn-default';
                                                        $in_pend = 'btn-default';
                                                        if (!empty($check) && $check->final_submit == 1) {
                                                            $sub = 'bg-success';
                                                            $in_pro = 'bg-info';
                                                        } ?>
                                                        <?php if (!empty($check)) {
                                                            $abc = marked_status($check->application_no, 6);
                                                            $in_pend = 'bg-warning';
                                                        } ?>
                                                        @if (empty($check) || (!empty($check) && $check->form_status == 2))
                                                            <div id="ribbon-container">
                                                                <a href="{{ url('sport_achievement') }}"
                                                                    class="btn btn-primary">Click Here for New
                                                                    Application</a>
                                                                <!-- <a data-bs-toggle="modal" data-bs-target="#Recruitment" id="ribbon">Click Here for New Application</a> -->
                                                            </div>
                                                        @else
                                                            <div id="ribbon-container">
                                                                <a
                                                                    @if (!empty($check)) href="{{ url('direct-recruitment/formPreview') }}/{{ $check->application_no }}" @endif>Form
                                                                    Already Filled</a>
                                                            </div>
                                                        @endif
                                                        <p class="arrow">
                                                            @if (!empty($check) && $check->final_submit == 1)
                                                                <button type="button"
                                                                    class="btn {{ $sub }} btn-arrow-right">Submitted</button>
                                                            @else
                                                                <button type="button"
                                                                    class="btn {{ $in_pend }} btn-arrow-right">Pending</button>
                                                            @endif
                                                            @if (isset($abc) && isset($check) && $check->form_status == 0 && $abc->is_closed == 0)
                                                                @if ($abc->query_status == 0)
                                                                    <button type="button"
                                                                        class="btn {{ $in_pro }} btn-arrow-right">Query
                                                                        Marked</button>
                                                                @else
                                                                    <button type="button"
                                                                        class="btn {{ $in_pro }} btn-arrow-right">
                                                                        @if ($abc->current_status != 'User')
                                                                            Query Marked
                                                                        @else
                                                                            Replied
                                                                        @endif
                                                                    </button>
                                                                @endif
                                                            @else
                                                                <!-- <button type="button" class="btn {{ $in_pro }} btn-arrow-right">Query Closed</button> -->
                                                                <button type="button"
                                                                    class="btn {{ $in_pro }} btn-arrow-right">In
                                                                    Process</button>
                                                            @endif
                                                            @if (!empty($check) && $check->form_status == 1)
                                                                <button type="button"
                                                                    class="btn bg-secondary btn-default btn-arrow-right">Approved</button>
                                                                @if (!empty($check) && $check->amount_release_status == 1)
                                                                    <button type="button"
                                                                        class="btn bg-success btn-default btn-arrow-right display_none">Paid</button>
                                                                @else
                                                                    <button type="button"
                                                                        class="btn btn-default btn-arrow-right display_none">Paid</button>
                                                                @endif
                                                            @elseif(!empty($check) && $check->form_status == 2)
                                                                <button type="button"
                                                                    class="btn bg-danger btn-default btn-arrow-right display_none">Rejected</button>
                                                            @else
                                                                <button type="button"
                                                                    class="btn btn-default btn-arrow-right">Approved</button>
                                                                <button type="button"
                                                                    class="btn btn-default btn-arrow-right display_none">Paid</button>
                                                            @endif
                                                        </p>
                                                    </div>
                                                </div>
                                            @endif
                                        @endif
                                    @elseif(isset($service_code))
                                        @if (false)

                                            @if ($service_code == 'DDQ40')
                                                {{-- $data['type']= 'DIRECT RECRUITMENT';
                        }elseif($Data_dsc->service_code == 'LUO55'){
                        $data['type']= 'LAXMAN AND RANI LAXMIBAI AWARD';
                        }elseif ($Data_dsc->service_code == 'DDQ40') {
                        $data['type']= 'Financial Assistance (State,National and International Level)';
                        }elseif ($Data_dsc->service_code == 'DDQ40') {
                        $data['type']= 'Monthly Pension (Awarded with Padma Shri/Padma Bhushan/Arjuna/Dronacharya/Dhyan Chand Awards)';
                        }elseif ($Data_dsc->service_code == 'PLW78') {
                        $data['type']= 'PRIZE MONEY';
                        } --}}
                                                <div class="col-md-4 col-sm-4">
                                                    <div class="counter purple1">
                                                        <svg viewBox="0 0 32 32"
                                                            style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;"
                                                            version="1.1" xml:space="preserve"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:serif="http://www.serif.com/"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink">
                                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                                stroke-linejoin="round"></g>
                                                            <g id="SVGRepo_iconCarrier">
                                                                <g id="Layer1">
                                                                    <path
                                                                        d="M16,6l-13,0c-0.552,0 -1,0.448 -1,1l0,22c0,0.552 0.448,1 1,1l22,0c0.552,0 1,-0.448 1,-1l0,-13c0,-0.552 -0.448,-1 -1,-1c-0.552,-0 -1,0.448 -1,1l0,12c0,0 -20,0 -20,0c0,0 0,-20 0,-20c-0,0 12,0 12,0c0.552,0 1,-0.448 1,-1c0,-0.552 -0.448,-1 -1,-1Zm-9,19l14,-0c0.552,0 1,-0.448 1,-1c0,-0.552 -0.448,-1 -1,-1l-14,0c-0.552,0 -1,0.448 -1,1c0,0.552 0.448,1 1,1Zm-0,-4l4,0c0.552,-0 1,-0.448 1,-1c-0,-0.552 -0.448,-1 -1,-1l-4,0c-0.552,-0 -1,0.448 -1,1c-0,0.552 0.448,1 1,1Zm22.707,-13.293c0.391,-0.39 0.391,-1.024 0,-1.414l-4,-4c-0.39,-0.391 -1.024,-0.391 -1.414,-0l-10,10c-0.14,0.139 -0.235,0.317 -0.274,0.511l-1,5c-0.065,0.328 0.037,0.667 0.274,0.903c0.236,0.237 0.575,0.339 0.903,0.274l5,-1c0.194,-0.039 0.372,-0.134 0.511,-0.274l10,-10Zm-22.707,9.293l4,0c0.552,0 1,-0.448 1,-1c0,-0.552 -0.448,-1 -1,-1l-4,0c-0.552,0 -1,0.448 -1,1c0,0.552 0.448,1 1,1Zm0,-4l5,-0c0.552,0 1,-0.448 1,-1c0,-0.552 -0.448,-1 -1,-1l-5,-0c-0.552,0 -1,0.448 -1,1c0,0.552 0.448,1 1,1Z">
                                                                    </path>
                                                                </g>
                                                            </g>
                                                        </svg>
                                                        Direct Recruitment Various Posts
                                                        <?php
                                                        $check = status_check(6); ?>
                                                        <?php $sub = 'btn-default';
                                                        $in_pro = 'btn-default';
                                                        $in_pend = 'btn-default';
                                                        if (!empty($check) && $check->final_submit == 1) {
                                                            $sub = 'bg-success';
                                                            $in_pro = 'bg-info';
                                                        } ?>
                                                        <?php if (!empty($check)) {
                                                            $abc = marked_status($check->application_no, 6);
                                                            $in_pend = 'bg-warning';
                                                        } ?>
                                                        @if (empty($check) || (!empty($check) && $check->form_status == 2))
                                                            <div id="ribbon-container">
                                                                <a href="{{ url('sport_achievement') }}"
                                                                    class="btn btn-primary">Click Here for New
                                                                    Application</a>
                                                                <!-- <a data-bs-toggle="modal" data-bs-target="#Recruitment" id="ribbon">Click Here for New Application</a> -->
                                                            </div>
                                                        @else
                                                            <div id="ribbon-container">
                                                                <a
                                                                    @if (!empty($check)) href="{{ url('direct-recruitment/formPreview') }}/{{ $check->application_no }}" @endif>Form
                                                                    Already Filled</a>
                                                            </div>
                                                        @endif
                                                        <p class="arrow">
                                                            @if (!empty($check) && $check->final_submit == 1)
                                                                <button type="button"
                                                                    class="btn {{ $sub }} btn-arrow-right">Submitted</button>
                                                            @else
                                                                <button type="button"
                                                                    class="btn {{ $in_pend }} btn-arrow-right">Pending</button>
                                                            @endif
                                                            @if (isset($abc) && isset($check) && $check->form_status == 0 && $abc->is_closed == 0)
                                                                @if ($abc->query_status == 0)
                                                                    <button type="button"
                                                                        class="btn {{ $in_pro }} btn-arrow-right">Query
                                                                        Marked</button>
                                                                @else
                                                                    <button type="button"
                                                                        class="btn {{ $in_pro }} btn-arrow-right">
                                                                        @if ($abc->current_status != 'User')
                                                                            Query Marked
                                                                        @else
                                                                            Replied
                                                                        @endif
                                                                    </button>
                                                                @endif
                                                            @else
                                                                <!-- <button type="button" class="btn {{ $in_pro }} btn-arrow-right">Query Closed</button> -->
                                                                <button type="button"
                                                                    class="btn {{ $in_pro }} btn-arrow-right">In
                                                                    Process</button>
                                                            @endif
                                                            @if (!empty($check) && $check->form_status == 1)
                                                                <button type="button"
                                                                    class="btn bg-secondary btn-default btn-arrow-right">Approved</button>
                                                                @if (!empty($check) && $check->amount_release_status == 1)
                                                                    <button type="button"
                                                                        class="btn bg-success btn-default btn-arrow-right display_none">Paid</button>
                                                                @else
                                                                    <button type="button"
                                                                        class="btn btn-default btn-arrow-right display_none">Paid</button>
                                                                @endif
                                                            @elseif(!empty($check) && $check->form_status == 2)
                                                                <button type="button"
                                                                    class="btn bg-danger btn-default btn-arrow-right display_none">Rejected</button>
                                                            @else
                                                                <button type="button"
                                                                    class="btn btn-default btn-arrow-right">Approved</button>
                                                                <button type="button"
                                                                    class="btn btn-default btn-arrow-right display_none">Paid</button>
                                                            @endif
                                                        </p>
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($service_code == 'LUO55')
                                                <div class="col-md-4 col-sm-4">
                                                    <div class="counter blue1">
                                                        <svg version="1.0" id="Layer_1"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 64 64"
                                                            enable-background="new 0 0 64 64" xml:space="preserve">
                                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                                stroke-linejoin="round"></g>
                                                            <g id="SVGRepo_iconCarrier">
                                                                <g>
                                                                    <path
                                                                        d="M60,6h-7V4c0-2.212-1.789-4-4-4H15c-2.211,0-4,1.788-4,4v2H4c-2.211,0-4,1.788-4,4v8 c0,6.074,4.925,11,11,11h0.096C12.01,38.659,19.477,46.395,29,47.761V56h-7c-2.211,0-4,1.788-4,4v3c0,0.552,0.447,1,1,1h26 c0.553,0,1-0.448,1-1v-3c0-2.212-1.789-4-4-4h-7v-8.239c9.523-1.366,16.985-9.1,17.899-18.761H53c6.075,0,11-4.926,11-11v-8 C64,7.788,62.211,6,60,6z M11,23c-2.762,0-5-2.239-5-5v-6h5V23z M2,18v-8c0-1.105,0.896-2,2-2h7v2H5c-0.553,0-1,0.446-1,1v7 c0,3.865,3.134,7,7,7v2C6.029,27,2,22.97,2,18z M42,58c1.104,0,2,0.895,2,2v2H20v-2c0-1.105,0.896-2,2-2H42z M31,56v-8.052 C31.334,47.964,31.662,48,32,48s0.666-0.036,1-0.052V56H31z M51,27c0,10.492-8.507,19-19,19s-19-8.508-19-19V4c0-1.105,0.896-2,2-2 h34c1.104,0,2,0.895,2,2V27z M53,12h5v6c0,2.761-2.238,5-5,5V12z M62,18c0,4.97-4.029,9-9,9v-2c3.866,0,7-3.135,7-7v-7 c0-0.554-0.447-1-1-1h-6V8h7c1.104,0,2,0.895,2,2V18z">
                                                                    </path>
                                                                    <path
                                                                        d="M39.147,19.36l-4.309-0.658l-1.936-4.123c-0.165-0.352-0.518-0.575-0.905-0.575s-0.74,0.224-0.905,0.575 l-1.936,4.123l-4.309,0.658c-0.37,0.058-0.678,0.315-0.797,0.671s-0.029,0.747,0.232,1.016l3.146,3.227l-0.745,4.564 c-0.062,0.378,0.099,0.758,0.411,0.979s0.725,0.243,1.061,0.059l3.841-2.123l3.841,2.123C35.99,29.959,36.157,30,36.323,30 c0.202,0,0.404-0.062,0.576-0.184c0.312-0.221,0.473-0.601,0.411-0.979l-0.745-4.564l3.146-3.227 c0.262-0.269,0.352-0.66,0.232-1.016S39.518,19.418,39.147,19.36z M34.781,23.238c-0.222,0.228-0.322,0.546-0.271,0.859 l0.495,3.029l-2.522-1.395c-0.151-0.083-0.317-0.125-0.484-0.125s-0.333,0.042-0.484,0.125l-2.522,1.395l0.495-3.029 c0.051-0.313-0.05-0.632-0.271-0.859l-2.141-2.193l2.913-0.446c0.329-0.05,0.612-0.261,0.754-0.563l1.257-2.678l1.257,2.678 c0.142,0.303,0.425,0.514,0.754,0.563l2.913,0.446L34.781,23.238z">
                                                                    </path>
                                                                </g>
                                                            </g>
                                                        </svg>
                                                        <p class="sub-title"> Laxman / Rani Laxmi Bai Award </p>
                                                        @if ($user->gender == 'Male')
                                                            <?php $check = status_check(1); ?>
                                                            <?php if (!empty($check)) {
                                                                $abc = marked_status($check->application_no, 1);
                                                            } ?>
                                                        @else
                                                            <?php $check = status_check(2); ?>
                                                        @endif
                                                        @if (empty($check) || (!empty($check) && $check->form_status == 2))
                                                            <div id="ribbon-container">
                                                                <!-- <a data-bs-toggle="modal" data-bs-target="#Laxman" id="ribbon">Click Here for New Application</a> -->
                                                                @if ($user->gender == 'Male')
                                                                    <a href="{{ url('laxman_award') }}"
                                                                        class="btn btn-primary">Click Here for New
                                                                        Application</a>
                                                                @else
                                                                    <a href="{{ url('rani_laxmi_bai_award') }}"
                                                                        class="btn btn-primary">Click Here for New
                                                                        Application</a>
                                                                @endif
                                                            </div>
                                                        @else
                                                            <div id="ribbon-container">
                                                                @if ($user->gender == 'Male')
                                                                    <a
                                                                        @if (!empty($check)) href="{{ url('laxmandetailForm') }}/{{ $check->application_no }}" @endif>
                                                                    @else
                                                                        <a
                                                                            @if (!empty($check)) href="{{ url('laxmibaidetailForm') }}/{{ $check->application_no }}" @endif>
                                                                @endif
                                                                Form Already Filled</a>
                                                            </div>
                                                        @endif
                                                        <?php $sub = 'btn-default';
                                                        $in_pro = 'btn-default';
                                                        $in_pend = 'btn-default';
                                                        if (!empty($check) && $check->final_submit == 1) {
                                                            $sub = 'bg-success';
                                                            $in_pro = 'bg-info';
                                                        } ?>
                                                        <?php if (!empty($check)) {
                                                            $abc = marked_status($check->application_no, 2);
                                                            $in_pend = 'bg-warning';
                                                        } ?>
                                                        <p class="arrow">
                                                            @if (!empty($check) && $check->final_submit == 1)
                                                                <button type="button"
                                                                    class="btn {{ $sub }} btn-arrow-right">Submitted</button>
                                                            @else
                                                                <button type="button"
                                                                    class="btn {{ $in_pend }} btn-arrow-right">Pending</button>
                                                            @endif
                                                            @if (isset($abc) && isset($check) && $check->form_status == 0 && $abc->is_closed == 0)
                                                                @if ($abc->query_status == 0)
                                                                    <button type="button"
                                                                        class="btn {{ $in_pro }} btn-arrow-right">Query
                                                                        Marked</button>
                                                                @else
                                                                    <button type="button"
                                                                        class="btn {{ $in_pro }} btn-arrow-right">
                                                                        @if ($abc->current_status != 'User')
                                                                            Query Marked
                                                                        @else
                                                                            Replied
                                                                        @endif
                                                                    </button>
                                                                @endif
                                                            @else
                                                                <!-- <button type="button" class="btn {{ $in_pro }} btn-arrow-right">Query Closed</button> -->
                                                                <button type="button"
                                                                    class="btn {{ $in_pro }} btn-arrow-right">In
                                                                    Process</button>
                                                            @endif
                                                            @if (!empty($check) && $check->form_status == 1)
                                                                <button type="button"
                                                                    class="btn bg-secondary btn-default btn-arrow-right">Approved</button>
                                                                @if (!empty($check) && $check->amount_release_status == 1)
                                                                    <button type="button"
                                                                        class="btn bg-success btn-default btn-arrow-right display_none">Paid</button>
                                                                @else
                                                                    <button type="button"
                                                                        class="btn btn-default btn-arrow-right display_none">Paid</button>
                                                                @endif
                                                            @elseif(!empty($check) && $check->form_status == 2)
                                                                <button type="button"
                                                                    class="btn bg-danger btn-default btn-arrow-right display_none">Rejected</button>
                                                            @else
                                                                <button type="button"
                                                                    class="btn btn-default btn-arrow-right">Approved</button>
                                                                <button type="button"
                                                                    class="btn btn-default btn-arrow-right display_none">Paid</button>
                                                            @endif
                                                        </p>
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($service_code == 'PLW78')
                                                <div class="col-md-4 col-sm-4">
                                                    <div class="counter">
                                                        <svg version="1.0" id="Layer_1"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 64 64"
                                                            enable-background="new 0 0 64 64" xml:space="preserve">
                                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                                stroke-linejoin="round"></g>
                                                            <g id="SVGRepo_iconCarrier">
                                                                <g>
                                                                    <path
                                                                        d="M60,6h-7V4c0-2.212-1.789-4-4-4H15c-2.211,0-4,1.788-4,4v2H4c-2.211,0-4,1.788-4,4v8 c0,6.074,4.925,11,11,11h0.096C12.01,38.659,19.477,46.395,29,47.761V56h-7c-2.211,0-4,1.788-4,4v3c0,0.552,0.447,1,1,1h26 c0.553,0,1-0.448,1-1v-3c0-2.212-1.789-4-4-4h-7v-8.239c9.523-1.366,16.985-9.1,17.899-18.761H53c6.075,0,11-4.926,11-11v-8 C64,7.788,62.211,6,60,6z M11,23c-2.762,0-5-2.239-5-5v-6h5V23z M2,18v-8c0-1.105,0.896-2,2-2h7v2H5c-0.553,0-1,0.446-1,1v7 c0,3.865,3.134,7,7,7v2C6.029,27,2,22.97,2,18z M42,58c1.104,0,2,0.895,2,2v2H20v-2c0-1.105,0.896-2,2-2H42z M31,56v-8.052 C31.334,47.964,31.662,48,32,48s0.666-0.036,1-0.052V56H31z M51,27c0,10.492-8.507,19-19,19s-19-8.508-19-19V4c0-1.105,0.896-2,2-2 h34c1.104,0,2,0.895,2,2V27z M53,12h5v6c0,2.761-2.238,5-5,5V12z M62,18c0,4.97-4.029,9-9,9v-2c3.866,0,7-3.135,7-7v-7 c0-0.554-0.447-1-1-1h-6V8h7c1.104,0,2,0.895,2,2V18z">
                                                                    </path>
                                                                    <path
                                                                        d="M39.147,19.36l-4.309-0.658l-1.936-4.123c-0.165-0.352-0.518-0.575-0.905-0.575s-0.74,0.224-0.905,0.575 l-1.936,4.123l-4.309,0.658c-0.37,0.058-0.678,0.315-0.797,0.671s-0.029,0.747,0.232,1.016l3.146,3.227l-0.745,4.564 c-0.062,0.378,0.099,0.758,0.411,0.979s0.725,0.243,1.061,0.059l3.841-2.123l3.841,2.123C35.99,29.959,36.157,30,36.323,30 c0.202,0,0.404-0.062,0.576-0.184c0.312-0.221,0.473-0.601,0.411-0.979l-0.745-4.564l3.146-3.227 c0.262-0.269,0.352-0.66,0.232-1.016S39.518,19.418,39.147,19.36z M34.781,23.238c-0.222,0.228-0.322,0.546-0.271,0.859 l0.495,3.029l-2.522-1.395c-0.151-0.083-0.317-0.125-0.484-0.125s-0.333,0.042-0.484,0.125l-2.522,1.395l0.495-3.029 c0.051-0.313-0.05-0.632-0.271-0.859l-2.141-2.193l2.913-0.446c0.329-0.05,0.612-0.261,0.754-0.563l1.257-2.678l1.257,2.678 c0.142,0.303,0.425,0.514,0.754,0.563l2.913,0.446L34.781,23.238z">
                                                                    </path>
                                                                </g>
                                                            </g>
                                                        </svg>
                                                        <?php $check = status_check(3); ?>
                                                        <p class="sub-title"> 1st, 2nd & 3rd Position Holder </p>
                                                        @if (empty($check) || (!empty($check) && $check->form_status == 2))
                                                            <div id="ribbon-container">
                                                                <!-- <a data-bs-toggle="modal" data-bs-target="#PositionHolder" id="ribbon">Click Here for New Application</a> -->
                                                                <a href="{{ url('position_holder') }}"
                                                                    id="ribbon">Click Here for New Application</a>
                                                            </div>
                                                        @else
                                                            <div id="ribbon-container">
                                                                <a
                                                                    @if (!empty($check)) href="{{ url('positiondetailForm') }}/{{ $check->application_no }}" @endif>Form
                                                                    Already Filled</a>
                                                            </div>
                                                        @endif
                                                        <?php $sub = 'btn-default';
                                                        $in_pro = 'btn-default';
                                                        $in_pend = 'btn-default';
                                                        if (!empty($check) && $check->final_submit == 1) {
                                                            $sub = 'bg-success';
                                                            $in_pro = 'bg-info';
                                                        } ?>
                                                        <?php if (!empty($check)) {
                                                            $abc = marked_status($check->application_no, 3);
                                                            $in_pend = 'bg-warning';
                                                        } ?>
                                                        <p class="arrow">
                                                            @if (!empty($check) && $check->final_submit == 1)
                                                                <button type="button"
                                                                    class="btn {{ $sub }} btn-arrow-right">Submitted</button>
                                                            @else
                                                                <button type="button"
                                                                    class="btn {{ $in_pend }} btn-arrow-right">Pending</button>
                                                            @endif
                                                            @if (isset($abc) && isset($check) && $check->form_status == 0 && $abc->is_closed == 0)
                                                                @if ($abc->query_status == 0)
                                                                    <button type="button"
                                                                        class="btn {{ $in_pro }} btn-arrow-right">Query
                                                                        Marked</button>
                                                                @else
                                                                    <button type="button"
                                                                        class="btn {{ $in_pro }} btn-arrow-right">
                                                                        @if ($abc->current_status != 'User')
                                                                            Query Marked
                                                                        @else
                                                                            Replied
                                                                        @endif
                                                                    </button>
                                                                @endif
                                                            @else
                                                                <!-- <button type="button" class="btn {{ $in_pro }} btn-arrow-right">Query Closed</button> -->
                                                                <button type="button"
                                                                    class="btn {{ $in_pro }} btn-arrow-right">In
                                                                    Process</button>
                                                            @endif
                                                            @if (!empty($check) && $check->form_status == 1)
                                                                <button type="button"
                                                                    class="btn bg-secondary btn-default btn-arrow-right">Approved</button>
                                                                @if (!empty($check) && $check->amount_release_status == 1)
                                                                    <button type="button"
                                                                        class="btn bg-success btn-default btn-arrow-right display_none">Paid</button>
                                                                @else
                                                                    <button type="button"
                                                                        class="btn btn-default btn-arrow-right display_none">Paid</button>
                                                                @endif
                                                            @elseif(!empty($check) && $check->form_status == 2)
                                                                <button type="button"
                                                                    class="btn bg-danger btn-default btn-arrow-right display_none">Rejected</button>
                                                            @else
                                                                <button type="button"
                                                                    class="btn btn-default btn-arrow-right">Approved</button>
                                                                <button type="button"
                                                                    class="btn btn-default btn-arrow-right display_none">Paid</button>
                                                            @endif
                                                        </p>
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($service_code == 'FYI05')
                                                <div class="col-md-4 col-sm-4">
                                                    <div class="counter pink1">
                                                        <svg version="1.1" id="Layer_1"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink"
                                                            viewBox="0 0 512 512" xml:space="preserve">
                                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                                stroke-linejoin="round"></g>
                                                            <g id="SVGRepo_iconCarrier">
                                                                <g>
                                                                    <g>
                                                                        <path
                                                                            d="M189.388,52.245h-62.694c-5.77,0-11.755,3.372-11.755,9.143v137.143H64c-5.77,0-11.755,3.372-11.755,9.143v208.98 c0,5.77,5.985,11.755,11.755,11.755h62.694h62.694c5.77,0,9.143-5.985,9.143-11.755V61.388 C198.531,55.617,195.158,52.245,189.388,52.245z M114.939,407.51H73.143V219.429h41.796V407.51z M177.633,407.51h-41.796V207.673 V73.143h41.796V407.51z">
                                                                        </path>
                                                                    </g>
                                                                </g>
                                                                <g>
                                                                    <g>
                                                                        <path
                                                                            d="M450.612,52.245h-62.694c-5.77,0-11.755,3.372-11.755,9.143v137.143h-50.939c-5.77,0-11.755,3.372-11.755,9.143v208.98 c0,5.77,5.985,11.755,11.755,11.755h62.694h62.694c5.77,0,9.143-5.985,9.143-11.755V61.388 C459.755,55.617,456.383,52.245,450.612,52.245z M376.163,407.51h-41.796V219.429h41.796V407.51z M438.857,407.51h-41.796V207.673 V73.143h41.796V407.51z">
                                                                        </path>
                                                                    </g>
                                                                </g>
                                                                <g>
                                                                    <g>
                                                                        <rect y="438.857" width="512" height="20.898">
                                                                        </rect>
                                                                    </g>
                                                                </g>
                                                            </g>
                                                        </svg>
                                                        <p class="sub-title"> Financial Assistance (State,National and
                                                            International Level) </p>
                                                        <?php $check = status_check(4); ?>
                                                        @if (empty($check) || (!empty($check) && $check->form_status == 2))
                                                            <div id="ribbon-container">
                                                                <!-- <a data-bs-toggle="modal" data-bs-target="#Financial" id="ribbon">Click Here for New Application</a> -->
                                                                <a href="{{ url('financial-assistance') }}"
                                                                    class="btn btn-primary">Click Here for New
                                                                    Application</a>
                                                            </div>
                                                        @else
                                                            <div id="ribbon-container">
                                                                <a
                                                                    @if (!empty($check)) href="{{ url('financialformPreview') }}/{{ $check->application_no }}" @endif>Form
                                                                    Already Filled</a>
                                                            </div>
                                                        @endif
                                                        <?php $sub = 'btn-default';
                                                        $in_pro = 'btn-default';
                                                        $in_pend = 'btn-default';
                                                        if (!empty($check) && $check->final_submit == 1) {
                                                            $sub = 'bg-success';
                                                            $in_pro = 'bg-info';
                                                        } ?>
                                                        <?php if (!empty($check)) {
                                                            $abc = marked_status($check->application_no, 4);
                                                            $in_pend = 'bg-warning';
                                                        } ?>
                                                        <p class="arrow">
                                                            @if (!empty($check) && $check->final_submit == 1)
                                                                <button type="button"
                                                                    class="btn {{ $sub }} btn-arrow-right">Submitted</button>
                                                            @else
                                                                <button type="button"
                                                                    class="btn {{ $in_pend }} btn-arrow-right">Pending</button>
                                                            @endif
                                                            @if (isset($abc) && isset($check) && $check->form_status == 0 && $abc->is_closed == 0)
                                                                @if ($abc->query_status == 0)
                                                                    <button type="button"
                                                                        class="btn {{ $in_pro }} btn-arrow-right">Query
                                                                        Marked</button>
                                                                @else
                                                                    <button type="button"
                                                                        class="btn {{ $in_pro }} btn-arrow-right">
                                                                        @if ($abc->current_status != 'User')
                                                                            Query Marked
                                                                        @else
                                                                            Replied
                                                                        @endif
                                                                    </button>
                                                                @endif
                                                            @else
                                                                <!-- <button type="button" class="btn {{ $in_pro }} btn-arrow-right">Query Closed</button> -->
                                                                <button type="button"
                                                                    class="btn {{ $in_pro }} btn-arrow-right">In
                                                                    Process</button>
                                                            @endif
                                                            @if (!empty($check) && $check->form_status == 1)
                                                                <button type="button"
                                                                    class="btn bg-secondary btn-default btn-arrow-right">Approved</button>
                                                                @if (!empty($check) && $check->amount_release_status == 1)
                                                                    <button type="button"
                                                                        class="btn bg-success btn-default btn-arrow-right display_none">Paid</button>
                                                                @else
                                                                    <button type="button"
                                                                        class="btn btn-default btn-arrow-right display_none">Paid</button>
                                                                @endif
                                                            @elseif(!empty($check) && $check->form_status == 2)
                                                                <button type="button"
                                                                    class="btn bg-danger btn-default btn-arrow-right display_none">Rejected</button>
                                                            @else
                                                                <button type="button"
                                                                    class="btn btn-default btn-arrow-right">Approved</button>
                                                                <button type="button"
                                                                    class="btn btn-default btn-arrow-right display_none">Paid</button>
                                                            @endif
                                                        </p>
                                                    </div>
                                                </div>
                                            @endif
                                            @if ($service_code == 'MRZ51')
                                                <div class="col-md-4 col-sm-4">
                                                    <div class="counter purple1">
                                                        <svg version="1.1" id="Layer_1"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink"
                                                            viewBox="0 0 512 512" xml:space="preserve">
                                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                                stroke-linejoin="round"></g>
                                                            <g id="SVGRepo_iconCarrier">
                                                                <g>
                                                                    <g>
                                                                        <g>
                                                                            <path
                                                                                d="M458.666,42.67h-53.33V32c0-17.645-14.356-32-32.002-32c-17.644,0-31.999,14.355-31.999,32v10.67H170.664V32 c0-17.645-14.354-32-31.999-32s-32,14.355-32,32v10.67H53.334c-5.892,0-10.667,4.776-10.667,10.667v447.995 c0,5.89,4.776,10.667,10.667,10.667h405.332c5.891,0,10.667-4.778,10.667-10.667V53.337 C469.333,47.446,464.557,42.67,458.666,42.67z M362.67,53.337V32c0-5.882,4.784-10.665,10.666-10.665 c5.881,0,10.665,4.783,10.665,10.665v21.337V74.67c0,0.735-0.075,1.452-0.218,2.146c-0.996,4.855-5.303,8.517-10.45,8.517 c-5.881,0-10.664-4.783-10.664-10.663V53.337z M128,53.337V32c0-5.882,4.783-10.665,10.667-10.665 c5.88,0,10.662,4.783,10.662,10.665v21.337V74.67c0,1.469-0.299,2.871-0.838,4.146c-1.621,3.825-5.415,6.517-9.826,6.517 C132.783,85.333,128,80.55,128,74.67V53.337z M64.001,64.005h42.663V74.67c0,2.756,0.35,5.434,1.009,7.988 c3.557,13.791,16.103,24.01,30.991,24.01h0.002c17.643,0,31.997-14.355,31.997-31.998V64.005h170.67V74.67 c0,17.643,14.355,31.998,32.001,31.998c17.645,0,32-14.355,32-31.998V64.005h42.662v63.994H64.001V64.005z M447.999,490.665 H64.001v0v-21.328h68.657c5.891,0,10.667-4.778,10.667-10.667c0-5.892-4.777-10.667-10.667-10.667H64.001V149.334h383.997 V490.665z">
                                                                            </path>
                                                                            <path
                                                                                d="M141.432,249.712c1.736,0,4.342-0.868,6.37-2.896l10.134-12.742v160.764c0,6.661,7.528,10.134,15.347,10.134 c7.531,0,15.349-3.473,15.349-10.134v-191.41c-0.001-6.371-7.24-10.134-13.612-10.134c-3.474,0-5.792,1.159-7.818,3.185 l-30.115,28.907c-3.765,2.608-6.08,7.53-6.08,11.874C131.007,243.34,135.349,249.712,141.432,249.712z">
                                                                            </path>
                                                                            <path
                                                                                d="M316.134,406.711c36.486,0,64.866-16.506,64.866-59.652v-3.475c-0.001-29.827-13.321-46.913-33.303-54.154 c16.216-6.082,27.221-20.556,27.221-45.174c0-37.065-24.904-50.962-58.784-50.962c-33.881,0-58.784,13.896-58.784,50.962 c0,24.618,11.005,39.092,26.931,45.174c-19.98,7.24-33.301,24.327-33.301,54.154v3.475 C250.98,390.206,279.647,406.711,316.134,406.711z M316.134,218.774c18.245,0,28.959,8.398,28.959,28.958 c0,20.85-10.714,29.248-28.959,29.248c-18.242,0-28.958-8.398-28.958-29.248C287.175,227.173,297.892,218.774,316.134,218.774z M281.674,338.66c0-24.904,13.032-36.197,34.46-36.197c21.428,0,34.17,11.293,34.17,36.197v5.213 c0,25.191-12.451,37.353-34.17,37.353c-21.139,0-34.46-11.58-34.46-37.353V338.66z">
                                                                            </path>
                                                                            <path
                                                                                d="M163.556,448.006h-0.254c-5.892,0-10.667,4.776-10.667,10.667c0,5.889,4.776,10.667,10.667,10.667h0.254 c5.892,0,10.667-4.778,10.667-10.667C174.224,452.781,169.448,448.006,163.556,448.006z">
                                                                            </path>
                                                                        </g>
                                                                    </g>
                                                                </g>
                                                            </g>
                                                        </svg>
                                                        <p class="sub-title"> Monthly Pension (Awarded with Padma
                                                            Shri/Padma Bhushan/Arjuna/Dronacharya/Dhyan Chand Awards) </p>
                                                        <?php $check = status_check(5); ?>

                                                        @if (empty($check) || (!empty($check) && $check->form_status == 2))
                                                            <div id="ribbon-container">
                                                                <a href="{{ url('monthlyPension_form') }}"
                                                                    class="btn btn-primary">Click Here for New
                                                                    Application</a>
                                                                <!-- <a data-bs-toggle="modal" data-bs-target="#Monthly" id="ribbon">Click Here for New Application</a> -->
                                                            </div>
                                                        @else
                                                            <div id="ribbon-container">
                                                                <a
                                                                    @if (!empty($check)) href="{{ url('monthlypensionformpreview') }}/{{ $check->application_no }}" @endif>Form
                                                                    Already Filled</a>
                                                            </div>
                                                        @endif
                                                        <?php $sub = 'btn-default';
                                                        $in_pro = 'btn-default';
                                                        $in_pend = 'btn-default';
                                                        if (!empty($check) && $check->final_submit == 1) {
                                                            $sub = 'bg-success';
                                                            $in_pro = 'bg-info';
                                                        } ?>
                                                        <?php if (!empty($check)) {
                                                            $abc = marked_status($check->application_no, 5);
                                                            $in_pend = 'bg-warning';
                                                        } ?>
                                                        <p class="arrow">

                                                            @if (!empty($check) && $check->final_submit == 1)
                                                                <button type="button"
                                                                    class="btn {{ $sub }} btn-arrow-right">Submitted</button>
                                                            @else
                                                                <button type="button"
                                                                    class="btn {{ $in_pend }} btn-arrow-right">Pending</button>
                                                            @endif
                                                            @if (isset($abc) && isset($check) && $check->form_status == 0 && $abc->is_closed == 0)
                                                                @if ($abc->query_status == 0)
                                                                    <button type="button"
                                                                        class="btn {{ $in_pro }} btn-arrow-right">Query
                                                                        Marked</button>
                                                                @else
                                                                    <button type="button"
                                                                        class="btn {{ $in_pro }} btn-arrow-right">
                                                                        @if ($abc->current_status != 'User')
                                                                            Query Marked
                                                                        @else
                                                                            Replied
                                                                        @endif
                                                                    </button>
                                                                @endif
                                                            @else
                                                                <!-- <button type="button" class="btn {{ $in_pro }} btn-arrow-right">Query Closed</button> -->
                                                                <button type="button"
                                                                    class="btn {{ $in_pro }} btn-arrow-right">In
                                                                    Process</button>
                                                            @endif
                                                            @if (!empty($check) && $check->form_status == 1)
                                                                <button type="button"
                                                                    class="btn bg-secondary btn-default btn-arrow-right">Approved</button>
                                                                @if (!empty($check) && $check->amount_release_status == 1)
                                                                    <button type="button"
                                                                        class="btn bg-success btn-default btn-arrow-right display_none">Paid</button>
                                                                @else
                                                                    <button type="button"
                                                                        class="btn btn-default btn-arrow-right display_none">Paid</button>
                                                                @endif
                                                            @elseif(!empty($check) && $check->form_status == 2)
                                                                <button type="button"
                                                                    class="btn bg-danger btn-default btn-arrow-right display_none">Rejected</button>
                                                            @else
                                                                <button type="button"
                                                                    class="btn btn-default btn-arrow-right">Approved</button>
                                                                <button type="button"
                                                                    class="btn btn-default btn-arrow-right display_none">Paid</button>
                                                            @endif
                                                        </p>
                                                    </div>
                                                </div>

                                            @endif







                                        @endif
                                    @else
                                        @if (false)

                                            <div class="col-md-4 col-sm-4">
                                                <div class="counter">
                                                    <svg version="1.0" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 64 64"
                                                        enable-background="new 0 0 64 64" xml:space="preserve">
                                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                            stroke-linejoin="round"></g>
                                                        <g id="SVGRepo_iconCarrier">
                                                            <g>
                                                                <path
                                                                    d="M60,6h-7V4c0-2.212-1.789-4-4-4H15c-2.211,0-4,1.788-4,4v2H4c-2.211,0-4,1.788-4,4v8 c0,6.074,4.925,11,11,11h0.096C12.01,38.659,19.477,46.395,29,47.761V56h-7c-2.211,0-4,1.788-4,4v3c0,0.552,0.447,1,1,1h26 c0.553,0,1-0.448,1-1v-3c0-2.212-1.789-4-4-4h-7v-8.239c9.523-1.366,16.985-9.1,17.899-18.761H53c6.075,0,11-4.926,11-11v-8 C64,7.788,62.211,6,60,6z M11,23c-2.762,0-5-2.239-5-5v-6h5V23z M2,18v-8c0-1.105,0.896-2,2-2h7v2H5c-0.553,0-1,0.446-1,1v7 c0,3.865,3.134,7,7,7v2C6.029,27,2,22.97,2,18z M42,58c1.104,0,2,0.895,2,2v2H20v-2c0-1.105,0.896-2,2-2H42z M31,56v-8.052 C31.334,47.964,31.662,48,32,48s0.666-0.036,1-0.052V56H31z M51,27c0,10.492-8.507,19-19,19s-19-8.508-19-19V4c0-1.105,0.896-2,2-2 h34c1.104,0,2,0.895,2,2V27z M53,12h5v6c0,2.761-2.238,5-5,5V12z M62,18c0,4.97-4.029,9-9,9v-2c3.866,0,7-3.135,7-7v-7 c0-0.554-0.447-1-1-1h-6V8h7c1.104,0,2,0.895,2,2V18z">
                                                                </path>
                                                                <path
                                                                    d="M39.147,19.36l-4.309-0.658l-1.936-4.123c-0.165-0.352-0.518-0.575-0.905-0.575s-0.74,0.224-0.905,0.575 l-1.936,4.123l-4.309,0.658c-0.37,0.058-0.678,0.315-0.797,0.671s-0.029,0.747,0.232,1.016l3.146,3.227l-0.745,4.564 c-0.062,0.378,0.099,0.758,0.411,0.979s0.725,0.243,1.061,0.059l3.841-2.123l3.841,2.123C35.99,29.959,36.157,30,36.323,30 c0.202,0,0.404-0.062,0.576-0.184c0.312-0.221,0.473-0.601,0.411-0.979l-0.745-4.564l3.146-3.227 c0.262-0.269,0.352-0.66,0.232-1.016S39.518,19.418,39.147,19.36z M34.781,23.238c-0.222,0.228-0.322,0.546-0.271,0.859 l0.495,3.029l-2.522-1.395c-0.151-0.083-0.317-0.125-0.484-0.125s-0.333,0.042-0.484,0.125l-2.522,1.395l0.495-3.029 c0.051-0.313-0.05-0.632-0.271-0.859l-2.141-2.193l2.913-0.446c0.329-0.05,0.612-0.261,0.754-0.563l1.257-2.678l1.257,2.678 c0.142,0.303,0.425,0.514,0.754,0.563l2.913,0.446L34.781,23.238z">
                                                                </path>
                                                            </g>
                                                        </g>
                                                    </svg>
                                                    <?php $check = status_check(3); ?>
                                                    <?php $checkk = form_date_status(3); ?>


                                                    <p class="sub-title"> 1st, 2nd & 3rd Position Holder </p>
                                                    @if ($checkk == 0)
                                                        <div id="ribbon-container">
                                                            <a id="ribbon">Form Not Available</a>
                                                        </div>
                                                    @else
                                                        @if (empty($check) || (!empty($check) && $check->form_status == 2))
                                                            <div id="ribbon-container">
                                                                <!-- <a data-bs-toggle="modal" data-bs-target="#PositionHolder" id="ribbon">Click Here for New Application</a> -->
                                                                <a href="{{ url('position_holder') }}"
                                                                    id="ribbon">Click Here for New Application</a>
                                                            </div>
                                                        @else
                                                            <div id="ribbon-container">
                                                                <a
                                                                    @if (!empty($check)) href="{{ url('positiondetailForm') }}/{{ $check->application_no }}" @endif>Form
                                                                    Already Filled</a>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    <?php $sub = 'btn-default';
                                                    $in_pro = 'btn-default';
                                                    $in_pend = 'btn-default';

                                                    if (!empty($check) && $check->final_submit == 1) {
                                                        $sub = 'bg-success';
                                                        $in_pro = 'bg-info';
                                                    } ?>
                                                    <?php if (!empty($check)) {
                                                        $abc = marked_status($check->application_no, 3);
                                                        $in_pend = 'bg-warning';
                                                    } ?>
                                                    <p class="arrow">

                                                        @if (!empty($check) && $check->final_submit == 1)
                                                            <button type="button"
                                                                class="btn {{ $sub }} btn-arrow-right">Submitted</button>
                                                        @else
                                                            <button type="button"
                                                                class="btn {{ $in_pend }} btn-arrow-right">Pending</button>
                                                        @endif
                                                        @if (isset($abc) && isset($check) && $check->form_status == 0 && $abc->is_closed == 0)
                                                            @if ($abc->query_status == 0)
                                                                <button type="button"
                                                                    class="btn {{ $in_pro }} btn-arrow-right">Query
                                                                    Marked</button>
                                                            @else
                                                                <button type="button"
                                                                    class="btn {{ $in_pro }} btn-arrow-right">
                                                                    @if ($abc->current_status != 'User')
                                                                        Query Marked
                                                                    @else
                                                                        Replied
                                                                    @endif
                                                                </button>
                                                            @endif
                                                        @else
                                                            <!-- <button type="button" class="btn {{ $in_pro }} btn-arrow-right">Query Closed</button> -->
                                                            <button type="button"
                                                                class="btn {{ $in_pro }} btn-arrow-right">In
                                                                Process</button>
                                                        @endif
                                                        @if (!empty($check) && $check->form_status == 1)
                                                            <button type="button"
                                                                class="btn bg-secondary btn-default btn-arrow-right">Approved</button>
                                                            @if (!empty($check) && $check->amount_release_status == 1)
                                                                <button type="button"
                                                                    class="btn bg-success btn-default btn-arrow-right display_none">Paid</button>
                                                            @else
                                                                <button type="button"
                                                                    class="btn btn-default btn-arrow-right display_none">Paid</button>
                                                            @endif
                                                        @elseif(!empty($check) && $check->form_status == 2)
                                                            <button type="button"
                                                                class="btn bg-danger btn-default btn-arrow-right display_none">Rejected</button>
                                                        @else
                                                            <button type="button"
                                                                class="btn btn-default btn-arrow-right">Approved</button>
                                                            <button type="button"
                                                                class="btn btn-default btn-arrow-right display_none">Paid</button>
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>

                                            <div class="col-md-4 col-sm-4">
                                                <div class="counter blue1">
                                                    <svg version="1.0" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 64 64"
                                                        enable-background="new 0 0 64 64" xml:space="preserve">
                                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                            stroke-linejoin="round"></g>
                                                        <g id="SVGRepo_iconCarrier">
                                                            <g>
                                                                <path
                                                                    d="M60,6h-7V4c0-2.212-1.789-4-4-4H15c-2.211,0-4,1.788-4,4v2H4c-2.211,0-4,1.788-4,4v8 c0,6.074,4.925,11,11,11h0.096C12.01,38.659,19.477,46.395,29,47.761V56h-7c-2.211,0-4,1.788-4,4v3c0,0.552,0.447,1,1,1h26 c0.553,0,1-0.448,1-1v-3c0-2.212-1.789-4-4-4h-7v-8.239c9.523-1.366,16.985-9.1,17.899-18.761H53c6.075,0,11-4.926,11-11v-8 C64,7.788,62.211,6,60,6z M11,23c-2.762,0-5-2.239-5-5v-6h5V23z M2,18v-8c0-1.105,0.896-2,2-2h7v2H5c-0.553,0-1,0.446-1,1v7 c0,3.865,3.134,7,7,7v2C6.029,27,2,22.97,2,18z M42,58c1.104,0,2,0.895,2,2v2H20v-2c0-1.105,0.896-2,2-2H42z M31,56v-8.052 C31.334,47.964,31.662,48,32,48s0.666-0.036,1-0.052V56H31z M51,27c0,10.492-8.507,19-19,19s-19-8.508-19-19V4c0-1.105,0.896-2,2-2 h34c1.104,0,2,0.895,2,2V27z M53,12h5v6c0,2.761-2.238,5-5,5V12z M62,18c0,4.97-4.029,9-9,9v-2c3.866,0,7-3.135,7-7v-7 c0-0.554-0.447-1-1-1h-6V8h7c1.104,0,2,0.895,2,2V18z">
                                                                </path>
                                                                <path
                                                                    d="M39.147,19.36l-4.309-0.658l-1.936-4.123c-0.165-0.352-0.518-0.575-0.905-0.575s-0.74,0.224-0.905,0.575 l-1.936,4.123l-4.309,0.658c-0.37,0.058-0.678,0.315-0.797,0.671s-0.029,0.747,0.232,1.016l3.146,3.227l-0.745,4.564 c-0.062,0.378,0.099,0.758,0.411,0.979s0.725,0.243,1.061,0.059l3.841-2.123l3.841,2.123C35.99,29.959,36.157,30,36.323,30 c0.202,0,0.404-0.062,0.576-0.184c0.312-0.221,0.473-0.601,0.411-0.979l-0.745-4.564l3.146-3.227 c0.262-0.269,0.352-0.66,0.232-1.016S39.518,19.418,39.147,19.36z M34.781,23.238c-0.222,0.228-0.322,0.546-0.271,0.859 l0.495,3.029l-2.522-1.395c-0.151-0.083-0.317-0.125-0.484-0.125s-0.333,0.042-0.484,0.125l-2.522,1.395l0.495-3.029 c0.051-0.313-0.05-0.632-0.271-0.859l-2.141-2.193l2.913-0.446c0.329-0.05,0.612-0.261,0.754-0.563l1.257-2.678l1.257,2.678 c0.142,0.303,0.425,0.514,0.754,0.563l2.913,0.446L34.781,23.238z">
                                                                </path>
                                                            </g>
                                                        </g>
                                                    </svg>

                                                    <p class="sub-title"> Laxman / Rani Laxmi Bai Award </p>
                                                    @if ($user->gender == 'Male')
                                                        <?php $check = status_check(1); ?>
                                                        <?php $checkk = form_date_status(1); ?>
                                                        <?php if (!empty($check)) {
                                                            $abc = marked_status($check->application_no, 1);
                                                        } ?>
                                                    @else
                                                        <?php $check = status_check(2); ?>
                                                        <?php $checkk = form_date_status(2); ?>
                                                    @endif
                                                    @if ($checkk == 0)
                                                        <div id="ribbon-container">
                                                            <a id="ribbon">Form Not Available</a>
                                                        </div>
                                                    @else
                                                        @if (empty($check) || (!empty($check) && $check->form_status == 2))
                                                            <div id="ribbon-container">
                                                                <!-- <a data-bs-toggle="modal" data-bs-target="#Laxman" id="ribbon">Click Here for New Application</a> -->
                                                                @if ($user->gender == 'Male')
                                                                    <a href="{{ url('laxman_award') }}"
                                                                        class="btn btn-primary">Click Here for New
                                                                        Application</a>
                                                                @else
                                                                    <a href="{{ url('rani_laxmi_bai_award') }}"
                                                                        class="btn btn-primary">Click Here for New
                                                                        Application</a>
                                                                @endif
                                                            </div>
                                                        @else
                                                            <div id="ribbon-container">
                                                                @if ($user->gender == 'Male')
                                                                    <a
                                                                        @if (!empty($check)) href="{{ url('laxmandetailForm') }}/{{ $check->application_no }}" @endif>
                                                                    @else
                                                                        <a
                                                                            @if (!empty($check)) href="{{ url('laxmibaidetailForm') }}/{{ $check->application_no }}" @endif>
                                                                @endif
                                                                Form Already Filled</a>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    <?php $sub = 'btn-default';
                                                    $in_pro = 'btn-default';
                                                    $in_pend = 'btn-default';
                                                    if (!empty($check) && $check->final_submit == 1) {
                                                        $sub = 'bg-success';
                                                        $in_pro = 'bg-info';
                                                    } ?>
                                                    <?php if (!empty($check)) {
                                                        $abc = marked_status($check->application_no, 2);
                                                        $in_pend = 'bg-warning';
                                                    } ?>
                                                    <p class="arrow">

                                                        @if (!empty($check) && $check->final_submit == 1)
                                                            <button type="button"
                                                                class="btn {{ $sub }} btn-arrow-right">Submitted</button>
                                                        @else
                                                            <button type="button"
                                                                class="btn {{ $in_pend }} btn-arrow-right">Pending</button>
                                                        @endif
                                                        @if (isset($abc) && isset($check) && $check->form_status == 0 && $abc->is_closed == 0)
                                                            @if ($abc->query_status == 0)
                                                                <button type="button"
                                                                    class="btn {{ $in_pro }} btn-arrow-right">Query
                                                                    Marked</button>
                                                            @else
                                                                <button type="button"
                                                                    class="btn {{ $in_pro }} btn-arrow-right">
                                                                    @if ($abc->current_status != 'User')
                                                                        Query Marked
                                                                    @else
                                                                        Replied
                                                                    @endif
                                                                </button>
                                                            @endif
                                                        @else
                                                            <!-- <button type="button" class="btn {{ $in_pro }} btn-arrow-right">Query Closed</button> -->
                                                            <button type="button"
                                                                class="btn {{ $in_pro }} btn-arrow-right">In
                                                                Process</button>
                                                        @endif

                                                        @if (!empty($check) && $check->form_status == 1)
                                                            <button type="button"
                                                                class="btn bg-secondary btn-default btn-arrow-right">Approved</button>
                                                            @if (!empty($check) && $check->amount_release_status == 1)
                                                                <button type="button"
                                                                    class="btn bg-success btn-default btn-arrow-right display_none">Paid</button>
                                                            @else
                                                                <button type="button"
                                                                    class="btn btn-default btn-arrow-right display_none">Paid</button>
                                                            @endif
                                                        @elseif(!empty($check) && $check->form_status == 2)
                                                            <button type="button"
                                                                class="btn bg-danger btn-default btn-arrow-right display_none">Rejected</button>
                                                        @else
                                                            <button type="button"
                                                                class="btn btn-default btn-arrow-right">Approved</button>
                                                            <button type="button"
                                                                class="btn btn-default btn-arrow-right display_none">Paid</button>
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-4">
                                                <div class="counter pink1">
                                                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512"
                                                        xml:space="preserve">
                                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                            stroke-linejoin="round"></g>
                                                        <g id="SVGRepo_iconCarrier">
                                                            <g>
                                                                <g>
                                                                    <path
                                                                        d="M189.388,52.245h-62.694c-5.77,0-11.755,3.372-11.755,9.143v137.143H64c-5.77,0-11.755,3.372-11.755,9.143v208.98 c0,5.77,5.985,11.755,11.755,11.755h62.694h62.694c5.77,0,9.143-5.985,9.143-11.755V61.388 C198.531,55.617,195.158,52.245,189.388,52.245z M114.939,407.51H73.143V219.429h41.796V407.51z M177.633,407.51h-41.796V207.673 V73.143h41.796V407.51z">
                                                                    </path>
                                                                </g>
                                                            </g>
                                                            <g>
                                                                <g>
                                                                    <path
                                                                        d="M450.612,52.245h-62.694c-5.77,0-11.755,3.372-11.755,9.143v137.143h-50.939c-5.77,0-11.755,3.372-11.755,9.143v208.98 c0,5.77,5.985,11.755,11.755,11.755h62.694h62.694c5.77,0,9.143-5.985,9.143-11.755V61.388 C459.755,55.617,456.383,52.245,450.612,52.245z M376.163,407.51h-41.796V219.429h41.796V407.51z M438.857,407.51h-41.796V207.673 V73.143h41.796V407.51z">
                                                                    </path>
                                                                </g>
                                                            </g>
                                                            <g>
                                                                <g>
                                                                    <rect y="438.857" width="512" height="20.898">
                                                                    </rect>
                                                                </g>
                                                            </g>
                                                        </g>
                                                    </svg>
                                                    <p class="sub-title"> Financial Assistance (State,National and
                                                        International Level) </p>
                                                    <?php $check = status_check(4); ?>
                                                    <?php $checkk = form_date_status(4); ?>
                                                    @if ($checkk == 0)
                                                        <div id="ribbon-container">
                                                            <a id="ribbon">Form Not Available</a>
                                                        </div>
                                                    @else
                                                        @if (empty($check) || (!empty($check) && $check->form_status == 2))
                                                            <div id="ribbon-container">
                                                                <!-- <a data-bs-toggle="modal" data-bs-target="#Financial" id="ribbon">Click Here for New Application</a> -->
                                                                <a href="{{ url('financial-assistance') }}"
                                                                    class="btn btn-primary">Click Here for New
                                                                    Application</a>
                                                            </div>
                                                        @else
                                                            <div id="ribbon-container">
                                                                <a
                                                                    @if (!empty($check)) href="{{ url('financialformPreview') }}/{{ $check->application_no }}" @endif>Form
                                                                    Already Filled</a>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    <?php
                                                    $sub = 'btn-default';
                                                    $in_pro = 'btn-default';
                                                    $in_pend = 'btn-default';

                                                    if (!empty($check) && $check->final_submit == 1) {
                                                        $sub = 'bg-success';
                                                        $in_pro = 'bg-info';
                                                    } ?>
                                                    <?php if (!empty($check)) {
                                                        $abc = marked_status($check->application_no, 4);
                                                        $in_pend = 'bg-warning';
                                                    } ?>
                                                    <p class="arrow">

                                                        @if (!empty($check) && $check->final_submit == 1)
                                                            <button type="button"
                                                                class="btn {{ $sub }} btn-arrow-right">Submitted</button>
                                                        @else
                                                            <button type="button"
                                                                class="btn {{ $in_pend }} btn-arrow-right">Pending</button>
                                                        @endif
                                                        @if (isset($abc) && isset($check) && $check->form_status == 0 && $abc->is_closed == 0)
                                                            @if ($abc->query_status == 0)
                                                                <button type="button"
                                                                    class="btn {{ $in_pro }} btn-arrow-right">Query
                                                                    Marked</button>
                                                            @else
                                                                <button type="button"
                                                                    class="btn {{ $in_pro }} btn-arrow-right">
                                                                    @if ($abc->current_status != 'User')
                                                                        Query Marked
                                                                    @else
                                                                        Replied
                                                                    @endif
                                                                </button>
                                                            @endif
                                                        @else
                                                            <!-- <button type="button" class="btn {{ $in_pro }} btn-arrow-right">Query Closed</button> -->
                                                            <button type="button"
                                                                class="btn {{ $in_pro }} btn-arrow-right">In
                                                                Process</button>
                                                        @endif
                                                        @if (!empty($check) && $check->form_status == 1)
                                                            <button type="button"
                                                                class="btn bg-secondary btn-default btn-arrow-right">Approved</button>
                                                            @if (!empty($check) && $check->amount_release_status == 1)
                                                                <button type="button"
                                                                    class="btn bg-success btn-default btn-arrow-right display_none">Paid</button>
                                                            @else
                                                                <button type="button"
                                                                    class="btn btn-default btn-arrow-right display_none">Paid</button>
                                                            @endif
                                                        @elseif(!empty($check) && $check->form_status == 2)
                                                            <button type="button"
                                                                class="btn bg-danger btn-default btn-arrow-right display_none">Rejected</button>
                                                        @else
                                                            <button type="button"
                                                                class="btn btn-default btn-arrow-right">Approved</button>
                                                            <button type="button"
                                                                class="btn btn-default btn-arrow-right display_none">Paid</button>
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-4">
                                                <div class="counter purple1">
                                                    <svg version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 512 512"
                                                        xml:space="preserve">
                                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                            stroke-linejoin="round"></g>
                                                        <g id="SVGRepo_iconCarrier">
                                                            <g>
                                                                <g>
                                                                    <g>
                                                                        <path
                                                                            d="M458.666,42.67h-53.33V32c0-17.645-14.356-32-32.002-32c-17.644,0-31.999,14.355-31.999,32v10.67H170.664V32 c0-17.645-14.354-32-31.999-32s-32,14.355-32,32v10.67H53.334c-5.892,0-10.667,4.776-10.667,10.667v447.995 c0,5.89,4.776,10.667,10.667,10.667h405.332c5.891,0,10.667-4.778,10.667-10.667V53.337 C469.333,47.446,464.557,42.67,458.666,42.67z M362.67,53.337V32c0-5.882,4.784-10.665,10.666-10.665 c5.881,0,10.665,4.783,10.665,10.665v21.337V74.67c0,0.735-0.075,1.452-0.218,2.146c-0.996,4.855-5.303,8.517-10.45,8.517 c-5.881,0-10.664-4.783-10.664-10.663V53.337z M128,53.337V32c0-5.882,4.783-10.665,10.667-10.665 c5.88,0,10.662,4.783,10.662,10.665v21.337V74.67c0,1.469-0.299,2.871-0.838,4.146c-1.621,3.825-5.415,6.517-9.826,6.517 C132.783,85.333,128,80.55,128,74.67V53.337z M64.001,64.005h42.663V74.67c0,2.756,0.35,5.434,1.009,7.988 c3.557,13.791,16.103,24.01,30.991,24.01h0.002c17.643,0,31.997-14.355,31.997-31.998V64.005h170.67V74.67 c0,17.643,14.355,31.998,32.001,31.998c17.645,0,32-14.355,32-31.998V64.005h42.662v63.994H64.001V64.005z M447.999,490.665 H64.001v0v-21.328h68.657c5.891,0,10.667-4.778,10.667-10.667c0-5.892-4.777-10.667-10.667-10.667H64.001V149.334h383.997 V490.665z">
                                                                        </path>
                                                                        <path
                                                                            d="M141.432,249.712c1.736,0,4.342-0.868,6.37-2.896l10.134-12.742v160.764c0,6.661,7.528,10.134,15.347,10.134 c7.531,0,15.349-3.473,15.349-10.134v-191.41c-0.001-6.371-7.24-10.134-13.612-10.134c-3.474,0-5.792,1.159-7.818,3.185 l-30.115,28.907c-3.765,2.608-6.08,7.53-6.08,11.874C131.007,243.34,135.349,249.712,141.432,249.712z">
                                                                        </path>
                                                                        <path
                                                                            d="M316.134,406.711c36.486,0,64.866-16.506,64.866-59.652v-3.475c-0.001-29.827-13.321-46.913-33.303-54.154 c16.216-6.082,27.221-20.556,27.221-45.174c0-37.065-24.904-50.962-58.784-50.962c-33.881,0-58.784,13.896-58.784,50.962 c0,24.618,11.005,39.092,26.931,45.174c-19.98,7.24-33.301,24.327-33.301,54.154v3.475 C250.98,390.206,279.647,406.711,316.134,406.711z M316.134,218.774c18.245,0,28.959,8.398,28.959,28.958 c0,20.85-10.714,29.248-28.959,29.248c-18.242,0-28.958-8.398-28.958-29.248C287.175,227.173,297.892,218.774,316.134,218.774z M281.674,338.66c0-24.904,13.032-36.197,34.46-36.197c21.428,0,34.17,11.293,34.17,36.197v5.213 c0,25.191-12.451,37.353-34.17,37.353c-21.139,0-34.46-11.58-34.46-37.353V338.66z">
                                                                        </path>
                                                                        <path
                                                                            d="M163.556,448.006h-0.254c-5.892,0-10.667,4.776-10.667,10.667c0,5.889,4.776,10.667,10.667,10.667h0.254 c5.892,0,10.667-4.778,10.667-10.667C174.224,452.781,169.448,448.006,163.556,448.006z">
                                                                        </path>
                                                                    </g>
                                                                </g>
                                                            </g>
                                                        </g>
                                                    </svg>
                                                    <p class="sub-title"> Monthly Pension (Awarded with Padma Shri/Padma
                                                        Bhushan/Arjuna/Dronacharya/Dhyan Chand Awards) </p>
                                                    <?php $check = status_check(5); ?>
                                                    <?php $checkk = form_date_status(5); ?>
                                                    @if ($checkk == 0)
                                                        <div id="ribbon-container">
                                                            <a id="ribbon">Form Not Available</a>
                                                        </div>
                                                    @else
                                                        @if (empty($check) || (!empty($check) && $check->form_status == 2))
                                                            <div id="ribbon-container">
                                                                <a href="{{ url('monthlyPension_form') }}"
                                                                    class="btn btn-primary">Click Here for New
                                                                    Application</a>
                                                                <!-- <a data-bs-toggle="modal" data-bs-target="#Monthly" id="ribbon">Click Here for New Application</a> -->
                                                            </div>
                                                        @else
                                                            <div id="ribbon-container">
                                                                <a
                                                                    @if (!empty($check)) href="{{ url('monthlypensionformpreview') }}/{{ $check->application_no }}" @endif>Form
                                                                    Already Filled</a>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    <?php $sub = 'btn-default';
                                                    $in_pro = 'btn-default';
                                                    $in_pend = 'btn-default';
                                                    if (!empty($check) && $check->final_submit == 1) {
                                                        $sub = 'bg-success';
                                                        $in_pro = 'bg-info';
                                                    } ?>
                                                    <?php if (!empty($check)) {
                                                        $abc = marked_status($check->application_no, 5);
                                                        $in_pend = 'bg-warning';
                                                    } ?>
                                                    <p class="arrow">

                                                        @if (!empty($check) && $check->final_submit == 1)
                                                            <button type="button"
                                                                class="btn {{ $sub }} btn-arrow-right">Submitted</button>
                                                        @else
                                                            <button type="button"
                                                                class="btn {{ $in_pend }} btn-arrow-right">Pending</button>
                                                        @endif
                                                        @if (isset($abc) && isset($check) && $check->form_status == 0 && $abc->is_closed == 0)
                                                            @if ($abc->query_status == 0)
                                                                <button type="button"
                                                                    class="btn {{ $in_pro }} btn-arrow-right">Query
                                                                    Marked</button>
                                                            @else
                                                                <button type="button"
                                                                    class="btn {{ $in_pro }} btn-arrow-right">
                                                                    @if ($abc->current_status != 'User')
                                                                        Query Marked
                                                                    @else
                                                                        Replied
                                                                    @endif
                                                                </button>
                                                            @endif
                                                        @else
                                                            <!-- <button type="button" class="btn {{ $in_pro }} btn-arrow-right">Query Closed</button> -->
                                                            <button type="button"
                                                                class="btn {{ $in_pro }} btn-arrow-right">In
                                                                Process</button>
                                                        @endif
                                                        @if (!empty($check) && $check->form_status == 1)
                                                            <button type="button"
                                                                class="btn bg-secondary btn-default btn-arrow-right">Approved</button>
                                                            @if (!empty($check) && $check->amount_release_status == 1)
                                                                <button type="button"
                                                                    class="btn bg-success btn-default btn-arrow-right display_none">Paid</button>
                                                            @else
                                                                <button type="button"
                                                                    class="btn btn-default btn-arrow-right display_none">Paid</button>
                                                            @endif
                                                        @elseif(!empty($check) && $check->form_status == 2)
                                                            <button type="button"
                                                                class="btn bg-danger btn-default btn-arrow-right display_none">Rejected</button>
                                                        @else
                                                            <button type="button"
                                                                class="btn btn-default btn-arrow-right">Approved</button>
                                                            <button type="button"
                                                                class="btn btn-default btn-arrow-right display_none">Paid</button>
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                            <div class="col-md-4 col-sm-4">
                                                <div class="counter purple1">
                                                    <svg viewBox="0 0 32 32"
                                                        style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;"
                                                        version="1.1" xml:space="preserve"
                                                        xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:serif="http://www.serif.com/"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink">
                                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                            stroke-linejoin="round"></g>
                                                        <g id="SVGRepo_iconCarrier">
                                                            <g id="Layer1">
                                                                <path
                                                                    d="M16,6l-13,0c-0.552,0 -1,0.448 -1,1l0,22c0,0.552 0.448,1 1,1l22,0c0.552,0 1,-0.448 1,-1l0,-13c0,-0.552 -0.448,-1 -1,-1c-0.552,-0 -1,0.448 -1,1l0,12c0,0 -20,0 -20,0c0,0 0,-20 0,-20c-0,0 12,0 12,0c0.552,0 1,-0.448 1,-1c0,-0.552 -0.448,-1 -1,-1Zm-9,19l14,-0c0.552,0 1,-0.448 1,-1c0,-0.552 -0.448,-1 -1,-1l-14,0c-0.552,0 -1,0.448 -1,1c0,0.552 0.448,1 1,1Zm-0,-4l4,0c0.552,-0 1,-0.448 1,-1c-0,-0.552 -0.448,-1 -1,-1l-4,0c-0.552,-0 -1,0.448 -1,1c-0,0.552 0.448,1 1,1Zm22.707,-13.293c0.391,-0.39 0.391,-1.024 0,-1.414l-4,-4c-0.39,-0.391 -1.024,-0.391 -1.414,-0l-10,10c-0.14,0.139 -0.235,0.317 -0.274,0.511l-1,5c-0.065,0.328 0.037,0.667 0.274,0.903c0.236,0.237 0.575,0.339 0.903,0.274l5,-1c0.194,-0.039 0.372,-0.134 0.511,-0.274l10,-10Zm-22.707,9.293l4,0c0.552,0 1,-0.448 1,-1c0,-0.552 -0.448,-1 -1,-1l-4,0c-0.552,0 -1,0.448 -1,1c0,0.552 0.448,1 1,1Zm0,-4l5,-0c0.552,0 1,-0.448 1,-1c0,-0.552 -0.448,-1 -1,-1l-5,-0c-0.552,0 -1,0.448 -1,1c0,0.552 0.448,1 1,1Z">
                                                                </path>
                                                            </g>
                                                        </g>
                                                    </svg>
                                                    <p class="sub-title"> Direct Recruitment Various Posts </p>
                                                    <?php $check = status_check(6); ?>
                                                    <?php $checkk = form_date_status(6); ?>

                                                    <?php $sub = 'btn-default';
                                                    $in_pro = 'btn-default';
                                                    $in_pend = 'btn-default';
                                                    if (!empty($check) && $check->final_submit == 1) {
                                                        $sub = 'bg-success';
                                                        $in_pro = 'bg-info';
                                                    } ?>
                                                    <?php if (!empty($check)) {
                                                        $abc = marked_status($check->application_no, 6);
                                                        $in_pend = 'bg-warning';
                                                    } ?>
                                                    @if ($checkk == 0)
                                                        <div id="ribbon-container">
                                                            <a id="ribbon">Form Not Available</a>
                                                        </div>
                                                    @else
                                                        @if (empty($check) || (!empty($check) && $check->form_status == 2))
                                                            <div id="ribbon-container">
                                                                <a href="{{ url('sport_achievement') }}"
                                                                    class="btn btn-primary">Click Here for New
                                                                    Application</a>
                                                                <!-- <a data-bs-toggle="modal" data-bs-target="#Recruitment" id="ribbon">Click Here for New Application</a> -->
                                                            </div>
                                                        @else
                                                            <div id="ribbon-container">
                                                                <a
                                                                    @if (!empty($check)) href="{{ url('direct-recruitment/formPreview') }}/{{ $check->application_no }}" @endif>Form
                                                                    Already Filled</a>
                                                            </div>
                                                        @endif
                                                    @endif
                                                    <p class="arrow">
                                                        @if (!empty($check) && $check->final_submit == 1)
                                                            <button type="button"
                                                                class="btn {{ $sub }} btn-arrow-right">Submitted</button>
                                                        @else
                                                            <button type="button"
                                                                class="btn {{ $in_pend }} btn-arrow-right">Pending</button>
                                                        @endif
                                                        @if (isset($abc) && isset($check) && $check->form_status == 0 && $abc->is_closed == 0)
                                                            @if ($abc->query_status == 0)
                                                                <button type="button"
                                                                    class="btn {{ $in_pro }} btn-arrow-right">Query
                                                                    Marked</button>
                                                            @else
                                                                <button type="button"
                                                                    class="btn {{ $in_pro }} btn-arrow-right">
                                                                    @if ($abc->current_status != 'User')
                                                                        Query Marked
                                                                    @else
                                                                        Replied
                                                                    @endif
                                                                </button>
                                                            @endif
                                                        @else
                                                            <!-- <button type="button" class="btn {{ $in_pro }} btn-arrow-right">Query Closed</button> -->
                                                            <button type="button"
                                                                class="btn {{ $in_pro }} btn-arrow-right">In
                                                                Process</button>
                                                        @endif
                                                        @if (!empty($check) && $check->form_status == 1)
                                                            <button type="button"
                                                                class="btn bg-secondary btn-default btn-arrow-right">Approved</button>
                                                            @if (!empty($check) && $check->amount_release_status == 1)
                                                                <button type="button"
                                                                    class="btn bg-success btn-default btn-arrow-right display_none">Paid</button>
                                                            @else
                                                                <button type="button"
                                                                    class="btn btn-default btn-arrow-right display_none">Paid</button>
                                                            @endif
                                                        @elseif(!empty($check) && $check->form_status == 2)
                                                            <button type="button"
                                                                class="btn bg-danger btn-default btn-arrow-right display_none">Rejected</button>
                                                        @else
                                                            <button type="button"
                                                                class="btn btn-default btn-arrow-right">Approved</button>
                                                            <button type="button"
                                                                class="btn btn-default btn-arrow-right display_none">Paid</button>
                                                        @endif
                                                    </p>
                                                </div>
                                            </div>
                                        @endif

                                    @endif
                                    <div class="col-md-4 col-sm-4">

                                        <div class="counter">
                                            <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                    stroke-linejoin="round"></g>
                                                <g id="SVGRepo_iconCarrier">
                                                    <defs>
                                                        <style>
                                                            .cls-1,
                                                            .cls-2 {
                                                                fill: none;
                                                                stroke: #000;
                                                                stroke-linecap: round;
                                                                stroke-linejoin: round;
                                                                stroke-width: 1.5px;
                                                            }

                                                            .cls-2 {
                                                                fill-rule: evenodd;
                                                            }
                                                        </style>
                                                    </defs>
                                                    <g id="ic-sport-jump-rope">
                                                        <rect class="cls-1" x="4" y="14" width="4" height="8"
                                                            rx="2"></rect>
                                                        <rect class="cls-1" x="16" y="2" width="4" height="8"
                                                            rx="2"></rect>
                                                        <path class="cls-2"
                                                            d="M6,14V8A3,3,0,0,1,9,5H9a3,3,0,0,1,3,3v8a3,3,0,0,0,3,3h0a3,3,0,0,0,3-3V10">
                                                        </path>
                                                    </g>
                                                </g>
                                                <?php $check = status_check(7); ?>
                                                <?php $checkk = form_date_status(7); ?>

                                                <?php $sub = 'btn-default';
                                                $in_pro = 'btn-default';
                                                $in_pend = 'btn-default';
                                                if (!empty($check) && $check->final_submit == 1) {
                                                    $sub = 'bg-success';
                                                    $in_pro = 'bg-info';
                                                } ?>
                                                <?php if (!empty($check)) {
                                                    $abc = marked_status($check->application_no, 7);
                                                    $in_pend = 'bg-warning';
                                                } ?>
                                            </svg>
                                            <p class="sub-title"> Eklavya Krida Kosh </p>
                                            @if ($checkk == 0)
                                                <div id="ribbon-container">
                                                    <a id="ribbon">Form Not Available</a>
                                                </div>
                                            @else
                                                @if (empty($check) || (!empty($check) && $check->form_status == 2))
                                                    <div id="ribbon-container">
                                                        <a href="{{ url('eklavya_kreeda_kosh') }}"
                                                            class="btn btn-primary">Click Here for New Application</a>
                                                        <!-- <a data-bs-toggle="modal" data-bs-target="#Recruitment" id="ribbon">Click Here for New Application</a> -->
                                                    </div>
                                                @else
                                                    <div id="ribbon-container">
                                                        <a
                                                            @if (!empty($check)) href="{{ url('applicationpreview') }}/{{ $check->application_no }}" @endif>Form
                                                            Already Filled</a>
                                                    </div>
                                                @endif
                                            @endif
                                            <!-- <p class="arrow">
                                <button type="button" class="btn btn-default btn-arrow-right">Submitted</button>
                                <button type="button" class="btn btn-default btn-arrow-right">In Process</button>
                                <button type="button" class="btn btn-default btn-arrow-right">Approved</button>
                                <button type="button" class="btn btn-default btn-arrow-right display_none">Paid</button>
                              </p> -->
                                            <p class="arrow">
                                                @if (!empty($check) && $check->final_submit == 1)
                                                    <button type="button"
                                                        class="btn {{ $sub }} btn-arrow-right">Submitted</button>
                                                @else
                                                    <button type="button"
                                                        class="btn {{ $in_pend }} btn-arrow-right">Pending</button>
                                                @endif
                                                @if (isset($abc) && isset($check) && $check->form_status == 0 && $abc->is_closed == 0)
                                                    @if ($abc->query_status == 0)
                                                        <button type="button"
                                                            class="btn {{ $in_pro }} btn-arrow-right">Query
                                                            Marked</button>
                                                    @else
                                                        <button type="button"
                                                            class="btn {{ $in_pro }} btn-arrow-right">
                                                            @if ($abc->current_status != 'User')
                                                                Query Marked
                                                            @else
                                                                Replied
                                                            @endif
                                                        </button>
                                                    @endif
                                                @else
                                                    <!-- <button type="button" class="btn {{ $in_pro }} btn-arrow-right">Query Closed</button> -->
                                                    <button type="button"
                                                        class="btn {{ $in_pro }} btn-arrow-right">In
                                                        Process</button>
                                                @endif
                                                @if (!empty($check) && $check->form_status == 1)
                                                    <button type="button"
                                                        class="btn bg-secondary btn-default btn-arrow-right">Approved</button>
                                                    @if (!empty($check) && $check->amount_release_status == 1)
                                                        <button type="button"
                                                            class="btn bg-success btn-default btn-arrow-right display_none">Paid</button>
                                                    @else
                                                        <button type="button"
                                                            class="btn btn-default btn-arrow-right display_none">Paid</button>
                                                    @endif
                                                @elseif(!empty($check) && $check->form_status == 2)
                                                    <button type="button"
                                                        class="btn bg-danger btn-default btn-arrow-right display_none">Rejected</button>
                                                @else
                                                    <button type="button"
                                                        class="btn btn-default btn-arrow-right">Approved</button>
                                                    <button type="button"
                                                        class="btn btn-default btn-arrow-right display_none">Paid</button>
                                                @endif
                                            </p>
                                        </div>
                                    </div>



                                </div>


                            </div>


                        </div>
                        <div class="tab-pane fade" id="profile" role="tabpanel" aria-labelledby="profile-tab">


                            <div id="counter">
                                <div class="row">
                                    @if (false)
                                        @foreach ($position as $key => $item)
                                            <div class="col-md-4 col-sm-4">
                                                <a href="{{ url('positiondetailForm') }}/{{ $item->application_no }}">
                                                    <div class="counter">
                                                        <svg version="1.0" id="Layer_1"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 64 64"
                                                            enable-background="new 0 0 64 64" xml:space="preserve">
                                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                                stroke-linejoin="round"></g>
                                                            <g id="SVGRepo_iconCarrier">
                                                                <g>
                                                                    <path
                                                                        d="M60,6h-7V4c0-2.212-1.789-4-4-4H15c-2.211,0-4,1.788-4,4v2H4c-2.211,0-4,1.788-4,4v8 c0,6.074,4.925,11,11,11h0.096C12.01,38.659,19.477,46.395,29,47.761V56h-7c-2.211,0-4,1.788-4,4v3c0,0.552,0.447,1,1,1h26 c0.553,0,1-0.448,1-1v-3c0-2.212-1.789-4-4-4h-7v-8.239c9.523-1.366,16.985-9.1,17.899-18.761H53c6.075,0,11-4.926,11-11v-8 C64,7.788,62.211,6,60,6z M11,23c-2.762,0-5-2.239-5-5v-6h5V23z M2,18v-8c0-1.105,0.896-2,2-2h7v2H5c-0.553,0-1,0.446-1,1v7 c0,3.865,3.134,7,7,7v2C6.029,27,2,22.97,2,18z M42,58c1.104,0,2,0.895,2,2v2H20v-2c0-1.105,0.896-2,2-2H42z M31,56v-8.052 C31.334,47.964,31.662,48,32,48s0.666-0.036,1-0.052V56H31z M51,27c0,10.492-8.507,19-19,19s-19-8.508-19-19V4c0-1.105,0.896-2,2-2 h34c1.104,0,2,0.895,2,2V27z M53,12h5v6c0,2.761-2.238,5-5,5V12z M62,18c0,4.97-4.029,9-9,9v-2c3.866,0,7-3.135,7-7v-7 c0-0.554-0.447-1-1-1h-6V8h7c1.104,0,2,0.895,2,2V18z">
                                                                    </path>
                                                                    <path
                                                                        d="M39.147,19.36l-4.309-0.658l-1.936-4.123c-0.165-0.352-0.518-0.575-0.905-0.575s-0.74,0.224-0.905,0.575 l-1.936,4.123l-4.309,0.658c-0.37,0.058-0.678,0.315-0.797,0.671s-0.029,0.747,0.232,1.016l3.146,3.227l-0.745,4.564 c-0.062,0.378,0.099,0.758,0.411,0.979s0.725,0.243,1.061,0.059l3.841-2.123l3.841,2.123C35.99,29.959,36.157,30,36.323,30 c0.202,0,0.404-0.062,0.576-0.184c0.312-0.221,0.473-0.601,0.411-0.979l-0.745-4.564l3.146-3.227 c0.262-0.269,0.352-0.66,0.232-1.016S39.518,19.418,39.147,19.36z M34.781,23.238c-0.222,0.228-0.322,0.546-0.271,0.859 l0.495,3.029l-2.522-1.395c-0.151-0.083-0.317-0.125-0.484-0.125s-0.333,0.042-0.484,0.125l-2.522,1.395l0.495-3.029 c0.051-0.313-0.05-0.632-0.271-0.859l-2.141-2.193l2.913-0.446c0.329-0.05,0.612-0.261,0.754-0.563l1.257-2.678l1.257,2.678 c0.142,0.303,0.425,0.514,0.754,0.563l2.913,0.446L34.781,23.238z">
                                                                    </path>
                                                                </g>
                                                            </g>
                                                        </svg>
                                                        <p class="sub-title"> 1st, 2nd & 3rd Position Holder </p>
                                                        <ul class="list">
                                                            <li>
                                                                <div><span>Application Date
                                                                    </span><small>{{ dmy($item->created_at) }}</small>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div><span>Application
                                                                        Number</span><small>{{ $item->application_no }}</small>
                                                                </div>
                                                            </li>
                                                            <?php $abc = marked_status($item->application_no, 3); ?>
                                                            <li>
                                                                <div><span>Application Status</span>


                                                                    @if ($item->form_status == 0)
                                                                        @if (isset($abc) && isset($item) && $item->form_status == 0 && $abc->is_closed == 0)
                                                                            @if ($abc->query_status == 0)
                                                                                <small class="text-info"> Query Marked
                                                                                </small>
                                                                            @else
                                                                                <small class="text-info">
                                                                                    @if ($abc->current_status != 'User')
                                                                                        Query Marked
                                                                                    @else
                                                                                        Replied
                                                                                    @endif
                                                                                </small>
                                                                            @endif
                                                                        @elseif($item->final_submit == 1)
                                                                            <small class="text-info"> In Process </small>
                                                                        @else
                                                                            <small class="text-info"> Pending </small>
                                                                        @endif
                                                                    @elseif($item->form_status == 1)
                                                                        <small class="text-success"> Approved </small>
                                                                    @elseif($item->form_status == 2)
                                                                        <small class="text-danger"> Rejected </small>
                                                                    @else
                                                                        <small class="text-secondary"> Submitted </small>
                                                                    @endif
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </a>
                                            </div>
                                        @endforeach
                                    @endif

                                    @if (false)
                                        @foreach ($award as $key => $item)
                                            <div class="col-md-4 col-sm-4">
                                                @if ($user->gender == 'Male')
                                                    <a
                                                        href="{{ url('laxmandetailForm') }}/{{ $item->application_no }}">
                                                    @else
                                                        <a
                                                            href="{{ url('laxmibaidetailForm') }}/{{ $item->application_no }}">
                                                @endif
                                                <div class="counter blue1">
                                                    <svg version="1.0" id="Layer_1" xmlns="http://www.w3.org/2000/svg"
                                                        xmlns:xlink="http://www.w3.org/1999/xlink" viewBox="0 0 64 64"
                                                        enable-background="new 0 0 64 64" xml:space="preserve">
                                                        <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                        <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                            stroke-linejoin="round"></g>
                                                        <g id="SVGRepo_iconCarrier">
                                                            <g>
                                                                <path
                                                                    d="M60,6h-7V4c0-2.212-1.789-4-4-4H15c-2.211,0-4,1.788-4,4v2H4c-2.211,0-4,1.788-4,4v8 c0,6.074,4.925,11,11,11h0.096C12.01,38.659,19.477,46.395,29,47.761V56h-7c-2.211,0-4,1.788-4,4v3c0,0.552,0.447,1,1,1h26 c0.553,0,1-0.448,1-1v-3c0-2.212-1.789-4-4-4h-7v-8.239c9.523-1.366,16.985-9.1,17.899-18.761H53c6.075,0,11-4.926,11-11v-8 C64,7.788,62.211,6,60,6z M11,23c-2.762,0-5-2.239-5-5v-6h5V23z M2,18v-8c0-1.105,0.896-2,2-2h7v2H5c-0.553,0-1,0.446-1,1v7 c0,3.865,3.134,7,7,7v2C6.029,27,2,22.97,2,18z M42,58c1.104,0,2,0.895,2,2v2H20v-2c0-1.105,0.896-2,2-2H42z M31,56v-8.052 C31.334,47.964,31.662,48,32,48s0.666-0.036,1-0.052V56H31z M51,27c0,10.492-8.507,19-19,19s-19-8.508-19-19V4c0-1.105,0.896-2,2-2 h34c1.104,0,2,0.895,2,2V27z M53,12h5v6c0,2.761-2.238,5-5,5V12z M62,18c0,4.97-4.029,9-9,9v-2c3.866,0,7-3.135,7-7v-7 c0-0.554-0.447-1-1-1h-6V8h7c1.104,0,2,0.895,2,2V18z">
                                                                </path>
                                                                <path
                                                                    d="M39.147,19.36l-4.309-0.658l-1.936-4.123c-0.165-0.352-0.518-0.575-0.905-0.575s-0.74,0.224-0.905,0.575 l-1.936,4.123l-4.309,0.658c-0.37,0.058-0.678,0.315-0.797,0.671s-0.029,0.747,0.232,1.016l3.146,3.227l-0.745,4.564 c-0.062,0.378,0.099,0.758,0.411,0.979s0.725,0.243,1.061,0.059l3.841-2.123l3.841,2.123C35.99,29.959,36.157,30,36.323,30 c0.202,0,0.404-0.062,0.576-0.184c0.312-0.221,0.473-0.601,0.411-0.979l-0.745-4.564l3.146-3.227 c0.262-0.269,0.352-0.66,0.232-1.016S39.518,19.418,39.147,19.36z M34.781,23.238c-0.222,0.228-0.322,0.546-0.271,0.859 l0.495,3.029l-2.522-1.395c-0.151-0.083-0.317-0.125-0.484-0.125s-0.333,0.042-0.484,0.125l-2.522,1.395l0.495-3.029 c0.051-0.313-0.05-0.632-0.271-0.859l-2.141-2.193l2.913-0.446c0.329-0.05,0.612-0.261,0.754-0.563l1.257-2.678l1.257,2.678 c0.142,0.303,0.425,0.514,0.754,0.563l2.913,0.446L34.781,23.238z">
                                                                </path>
                                                            </g>
                                                        </g>
                                                    </svg>

                                                    <p class="sub-title"> Laxman / Rani Laxmi Bai Award </p>
                                                    <ul class="list">
                                                        <li>
                                                            <div><span>Application Date
                                                                </span><small>{{ dmy($item->created_at) }}</small></div>
                                                        </li>
                                                        <li>
                                                            <div><span>Application
                                                                    Number</span><small>{{ $item->application_no }}</small>
                                                            </div>
                                                        </li>
                                                        <?php $abc = marked_status($item->application_no, 1); ?>
                                                        <li>
                                                            <div><span>Application Status</span>
                                                                {{-- @if ($item->final_submit == 1 && $item->form_status == 0) --}}

                                                                @if ($item->form_status == 0)
                                                                    @if (isset($abc) && isset($item) && $item->form_status == 0 && $abc->is_closed == 0)
                                                                        @if ($abc->query_status == 0)
                                                                            <small class="text-info"> Query Marked </small>
                                                                        @else
                                                                            <small class="text-info">
                                                                                @if ($abc->current_status != 'User')
                                                                                    Query Marked
                                                                                @else
                                                                                    Replied
                                                                                @endif
                                                                            </small>
                                                                        @endif
                                                                    @elseif($item->final_submit == 1)
                                                                        <small class="text-info"> In Process </small>
                                                                    @else
                                                                        <small class="text-info"> Pending </small>
                                                                    @endif
                                                                @elseif($item->form_status == 1)
                                                                    <small class="text-success"> Approved </small>
                                                                @elseif($item->form_status == 2)
                                                                    <small class="text-danger"> Rejected </small>
                                                                @else
                                                                    <small class="text-secondary"> Submitted </small>
                                                                @endif
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                                </a>
                                            </div>
                                        @endforeach
                                    @endif

                                    @if (false)
                                        @foreach ($financial as $key => $item)
                                            <div class="col-md-4 col-sm-4">
                                                <a
                                                    href="{{ url('financialformPreview') }}/{{ $item->application_no }}">
                                                    <div class="counter pink1">
                                                        <svg version="1.1" id="Layer_1"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink"
                                                            viewBox="0 0 512 512" xml:space="preserve">
                                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                                stroke-linejoin="round"></g>
                                                            <g id="SVGRepo_iconCarrier">
                                                                <g>
                                                                    <g>
                                                                        <path
                                                                            d="M189.388,52.245h-62.694c-5.77,0-11.755,3.372-11.755,9.143v137.143H64c-5.77,0-11.755,3.372-11.755,9.143v208.98 c0,5.77,5.985,11.755,11.755,11.755h62.694h62.694c5.77,0,9.143-5.985,9.143-11.755V61.388 C198.531,55.617,195.158,52.245,189.388,52.245z M114.939,407.51H73.143V219.429h41.796V407.51z M177.633,407.51h-41.796V207.673 V73.143h41.796V407.51z">
                                                                        </path>
                                                                    </g>
                                                                </g>
                                                                <g>
                                                                    <g>
                                                                        <path
                                                                            d="M450.612,52.245h-62.694c-5.77,0-11.755,3.372-11.755,9.143v137.143h-50.939c-5.77,0-11.755,3.372-11.755,9.143v208.98 c0,5.77,5.985,11.755,11.755,11.755h62.694h62.694c5.77,0,9.143-5.985,9.143-11.755V61.388 C459.755,55.617,456.383,52.245,450.612,52.245z M376.163,407.51h-41.796V219.429h41.796V407.51z M438.857,407.51h-41.796V207.673 V73.143h41.796V407.51z">
                                                                        </path>
                                                                    </g>
                                                                </g>
                                                                <g>
                                                                    <g>
                                                                        <rect y="438.857" width="512" height="20.898">
                                                                        </rect>
                                                                    </g>
                                                                </g>
                                                            </g>
                                                        </svg>
                                                        <p class="sub-title"> Financial Assistance (State,National and
                                                            International Level) </p>
                                                        <ul class="list">
                                                            <li>
                                                                <div><span>Application Date
                                                                    </span><small>{{ dmy($item->created_at) }}</small>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div><span>Application
                                                                        Number</span><small>{{ $item->application_no }}</small>
                                                                </div>
                                                            </li>
                                                            <?php $abc = marked_status($item->application_no, 4); ?>

                                                            <li>
                                                                <div><span>Application Status</span>
                                                                    {{-- @if ($item->final_submit == 1 && $item->form_status == 0) --}}

                                                                    @if ($item->form_status == 0)
                                                                        @if (isset($abc) && isset($item) && $item->form_status == 0 && $abc->is_closed == 0)
                                                                            @if ($abc->query_status == 0)
                                                                                <small class="text-info"> Query Marked
                                                                                </small>
                                                                            @else
                                                                                <small class="text-info">
                                                                                    @if ($abc->current_status != 'User')
                                                                                        Query Marked
                                                                                    @else
                                                                                        Replied
                                                                                    @endif
                                                                                </small>
                                                                            @endif
                                                                        @elseif($item->final_submit == 1)
                                                                            <small class="text-info"> In Process </small>
                                                                        @else
                                                                            <small class="text-info"> Pending </small>
                                                                        @endif
                                                                    @elseif($item->form_status == 1)
                                                                        <small class="text-success"> Approved </small>
                                                                    @elseif($item->form_status == 2)
                                                                        <small class="text-danger"> Rejected </small>
                                                                    @else
                                                                        <small class="text-secondary"> Submitted </small>
                                                                    @endif
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </a>
                                            </div>
                                        @endforeach
                                    @endif

                                    @if (false)
                                        @foreach ($monthly as $key => $item)
                                            <div class="col-md-4 col-sm-4">
                                                <a
                                                    href="{{ url('monthlypensionformpreview') }}/{{ $item->application_no }}">
                                                    <div class="counter purple1">
                                                        <svg version="1.1" id="Layer_1"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink"
                                                            viewBox="0 0 512 512" xml:space="preserve">
                                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                                stroke-linejoin="round"></g>
                                                            <g id="SVGRepo_iconCarrier">
                                                                <g>
                                                                    <g>
                                                                        <g>
                                                                            <path
                                                                                d="M458.666,42.67h-53.33V32c0-17.645-14.356-32-32.002-32c-17.644,0-31.999,14.355-31.999,32v10.67H170.664V32 c0-17.645-14.354-32-31.999-32s-32,14.355-32,32v10.67H53.334c-5.892,0-10.667,4.776-10.667,10.667v447.995 c0,5.89,4.776,10.667,10.667,10.667h405.332c5.891,0,10.667-4.778,10.667-10.667V53.337 C469.333,47.446,464.557,42.67,458.666,42.67z M362.67,53.337V32c0-5.882,4.784-10.665,10.666-10.665 c5.881,0,10.665,4.783,10.665,10.665v21.337V74.67c0,0.735-0.075,1.452-0.218,2.146c-0.996,4.855-5.303,8.517-10.45,8.517 c-5.881,0-10.664-4.783-10.664-10.663V53.337z M128,53.337V32c0-5.882,4.783-10.665,10.667-10.665 c5.88,0,10.662,4.783,10.662,10.665v21.337V74.67c0,1.469-0.299,2.871-0.838,4.146c-1.621,3.825-5.415,6.517-9.826,6.517 C132.783,85.333,128,80.55,128,74.67V53.337z M64.001,64.005h42.663V74.67c0,2.756,0.35,5.434,1.009,7.988 c3.557,13.791,16.103,24.01,30.991,24.01h0.002c17.643,0,31.997-14.355,31.997-31.998V64.005h170.67V74.67 c0,17.643,14.355,31.998,32.001,31.998c17.645,0,32-14.355,32-31.998V64.005h42.662v63.994H64.001V64.005z M447.999,490.665 H64.001v0v-21.328h68.657c5.891,0,10.667-4.778,10.667-10.667c0-5.892-4.777-10.667-10.667-10.667H64.001V149.334h383.997 V490.665z">
                                                                            </path>
                                                                            <path
                                                                                d="M141.432,249.712c1.736,0,4.342-0.868,6.37-2.896l10.134-12.742v160.764c0,6.661,7.528,10.134,15.347,10.134 c7.531,0,15.349-3.473,15.349-10.134v-191.41c-0.001-6.371-7.24-10.134-13.612-10.134c-3.474,0-5.792,1.159-7.818,3.185 l-30.115,28.907c-3.765,2.608-6.08,7.53-6.08,11.874C131.007,243.34,135.349,249.712,141.432,249.712z">
                                                                            </path>
                                                                            <path
                                                                                d="M316.134,406.711c36.486,0,64.866-16.506,64.866-59.652v-3.475c-0.001-29.827-13.321-46.913-33.303-54.154 c16.216-6.082,27.221-20.556,27.221-45.174c0-37.065-24.904-50.962-58.784-50.962c-33.881,0-58.784,13.896-58.784,50.962 c0,24.618,11.005,39.092,26.931,45.174c-19.98,7.24-33.301,24.327-33.301,54.154v3.475 C250.98,390.206,279.647,406.711,316.134,406.711z M316.134,218.774c18.245,0,28.959,8.398,28.959,28.958 c0,20.85-10.714,29.248-28.959,29.248c-18.242,0-28.958-8.398-28.958-29.248C287.175,227.173,297.892,218.774,316.134,218.774z M281.674,338.66c0-24.904,13.032-36.197,34.46-36.197c21.428,0,34.17,11.293,34.17,36.197v5.213 c0,25.191-12.451,37.353-34.17,37.353c-21.139,0-34.46-11.58-34.46-37.353V338.66z">
                                                                            </path>
                                                                            <path
                                                                                d="M163.556,448.006h-0.254c-5.892,0-10.667,4.776-10.667,10.667c0,5.889,4.776,10.667,10.667,10.667h0.254 c5.892,0,10.667-4.778,10.667-10.667C174.224,452.781,169.448,448.006,163.556,448.006z">
                                                                            </path>
                                                                        </g>
                                                                    </g>
                                                                </g>
                                                            </g>
                                                        </svg>
                                                        <p class="sub-title"> Monthly Pension (Awarded with Padma
                                                            Shri/Padma Bhushan/Arjuna/Dronacharya/Dhyan Chand Awards) </p>
                                                        <ul class="list">
                                                            <li>
                                                                <div><span>Application Date
                                                                    </span><small>{{ dmy($item->created_at) }}</small>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div><span>Application
                                                                        Number</span><small>{{ $item->application_no }}</small>
                                                                </div>
                                                            </li>
                                                            <?php $abc = marked_status($item->application_no, 5); ?>
                                                            <li>
                                                                <div><span>Application Status</span>
                                                                    @if ($item->form_status == 0)
                                                                        @if (isset($abc) && isset($item) && $item->form_status == 0 && $abc->is_closed == 0)
                                                                            @if ($abc->query_status == 0)
                                                                                <small class="text-info"> Query Marked
                                                                                </small>
                                                                            @else
                                                                                <small class="text-info">
                                                                                    @if ($abc->current_status != 'User')
                                                                                        Query Marked
                                                                                    @else
                                                                                        Replied
                                                                                    @endif
                                                                                </small>
                                                                            @endif
                                                                        @elseif($item->final_submit == 1)
                                                                            <small class="text-info"> In Process </small>
                                                                        @else
                                                                            <small class="text-info"> Pending </small>
                                                                        @endif
                                                                    @elseif($item->form_status == 1)
                                                                        <small class="text-success"> Approved </small>
                                                                    @elseif($item->form_status == 2)
                                                                        <small class="text-danger"> Rejected </small>
                                                                    @else
                                                                        <small class="text-secondary"> Submitted </small>
                                                                    @endif
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </a>
                                            </div>
                                        @endforeach
                                    @endif

                                    @if (false)
                                        @foreach ($direct as $key => $item)
                                            <div class="col-md-4 col-sm-4">
                                                <a
                                                    href="{{ url('direct-recruitment/formPreview') }}/{{ $item->application_no }}">
                                                    <div class="counter purple1">
                                                        <svg viewBox="0 0 32 32"
                                                            style="fill-rule:evenodd;clip-rule:evenodd;stroke-linejoin:round;stroke-miterlimit:2;"
                                                            version="1.1" xml:space="preserve"
                                                            xmlns="http://www.w3.org/2000/svg"
                                                            xmlns:serif="http://www.serif.com/"
                                                            xmlns:xlink="http://www.w3.org/1999/xlink">
                                                            <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                            <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                                stroke-linejoin="round"></g>
                                                            <g id="SVGRepo_iconCarrier">
                                                                <g id="Layer1">
                                                                    <path
                                                                        d="M16,6l-13,0c-0.552,0 -1,0.448 -1,1l0,22c0,0.552 0.448,1 1,1l22,0c0.552,0 1,-0.448 1,-1l0,-13c0,-0.552 -0.448,-1 -1,-1c-0.552,-0 -1,0.448 -1,1l0,12c0,0 -20,0 -20,0c0,0 0,-20 0,-20c-0,0 12,0 12,0c0.552,0 1,-0.448 1,-1c0,-0.552 -0.448,-1 -1,-1Zm-9,19l14,-0c0.552,0 1,-0.448 1,-1c0,-0.552 -0.448,-1 -1,-1l-14,0c-0.552,0 -1,0.448 -1,1c0,0.552 0.448,1 1,1Zm-0,-4l4,0c0.552,-0 1,-0.448 1,-1c-0,-0.552 -0.448,-1 -1,-1l-4,0c-0.552,-0 -1,0.448 -1,1c-0,0.552 0.448,1 1,1Zm22.707,-13.293c0.391,-0.39 0.391,-1.024 0,-1.414l-4,-4c-0.39,-0.391 -1.024,-0.391 -1.414,-0l-10,10c-0.14,0.139 -0.235,0.317 -0.274,0.511l-1,5c-0.065,0.328 0.037,0.667 0.274,0.903c0.236,0.237 0.575,0.339 0.903,0.274l5,-1c0.194,-0.039 0.372,-0.134 0.511,-0.274l10,-10Zm-22.707,9.293l4,0c0.552,0 1,-0.448 1,-1c0,-0.552 -0.448,-1 -1,-1l-4,0c-0.552,0 -1,0.448 -1,1c0,0.552 0.448,1 1,1Zm0,-4l5,-0c0.552,0 1,-0.448 1,-1c0,-0.552 -0.448,-1 -1,-1l-5,-0c-0.552,0 -1,0.448 -1,1c0,0.552 0.448,1 1,1Z">
                                                                    </path>
                                                                </g>
                                                            </g>
                                                        </svg>
                                                        <p class="sub-title">Direct Recruitment Various Posts </p>
                                                        <ul class="list">
                                                            <li>
                                                                <div><span>Application Date
                                                                    </span><small>{{ dmy($item->created_at) }}</small>
                                                                </div>
                                                            </li>
                                                            <li>
                                                                <div><span>Application
                                                                        Number</span><small>{{ $item->application_no }}</small>
                                                                </div>
                                                            </li>
                                                            <?php $abc = marked_status($item->application_no, 6); ?>
                                                            <li>
                                                                <div><span>Application Status</span>
                                                                    @if ($item->form_status == 0)
                                                                        @if (isset($abc) && isset($item) && $item->form_status == 0 && $abc->is_closed == 0)
                                                                            @if ($abc->query_status == 0)
                                                                                <small class="text-info"> Query Marked
                                                                                </small>
                                                                            @else
                                                                                <small class="text-info">
                                                                                    @if ($abc->current_status != 'User')
                                                                                        Query Marked
                                                                                    @else
                                                                                        Replied
                                                                                    @endif
                                                                                </small>
                                                                            @endif
                                                                        @elseif($item->final_submit == 1)
                                                                            <small class="text-info"> In Process </small>
                                                                        @else
                                                                            <small class="text-info"> Pending </small>
                                                                        @endif
                                                                    @elseif($item->form_status == 1)
                                                                        <small class="text-success"> Approved </small>
                                                                    @elseif($item->form_status == 2)
                                                                        <small class="text-danger"> Rejected </small>
                                                                    @else
                                                                        <small class="text-secondary"> Submitted </small>
                                                                    @endif
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                </a>
                                            </div>
                                        @endforeach
                                    @endif
                                    @foreach ($eklavya as $key => $item)
                                        <div class="col-md-4 col-sm-4">
                                            <div class="counter">
                                                <svg viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                    <g id="SVGRepo_bgCarrier" stroke-width="0"></g>
                                                    <g id="SVGRepo_tracerCarrier" stroke-linecap="round"
                                                        stroke-linejoin="round"></g>
                                                    <g id="SVGRepo_iconCarrier">
                                                        <defs>
                                                            <style>
                                                                .cls-1,
                                                                .cls-2 {
                                                                    fill: none;
                                                                    stroke: #000;
                                                                    stroke-linecap: round;
                                                                    stroke-linejoin: round;
                                                                    stroke-width: 1.5px;
                                                                }

                                                                .cls-2 {
                                                                    fill-rule: evenodd;
                                                                }
                                                            </style>
                                                        </defs>
                                                        <g id="ic-sport-jump-rope">
                                                            <rect class="cls-1" x="4" y="14" width="4"
                                                                height="8" rx="2"></rect>
                                                            <rect class="cls-1" x="16" y="2" width="4"
                                                                height="8" rx="2"></rect>
                                                            <path class="cls-2"
                                                                d="M6,14V8A3,3,0,0,1,9,5H9a3,3,0,0,1,3,3v8a3,3,0,0,0,3,3h0a3,3,0,0,0,3-3V10">
                                                            </path>
                                                        </g>
                                                    </g>
                                                </svg>
                                                <p class="sub-title"> Eklavya Krida Kosh </p>
                                                <ul class="list">
                                                    <li>
                                                        <div><span>Application Date
                                                            </span><small>{{ dmy($item->created_at) }}</small></div>
                                                    </li>
                                                    <li>
                                                        <div><span>Application
                                                                Number</span><small>{{ $item->application_no }}</small>
                                                        </div>
                                                    </li>
                                                    <?php $abc = marked_status($item->application_no, 7); ?>
                                                    <li>
                                                        <div><span>Application Status</span>
                                                            @if ($item->form_status == 0)
                                                                @if (isset($abc) && isset($item) && $item->form_status == 0 && $abc->is_closed == 0)
                                                                    @if ($abc->query_status == 0)
                                                                        <small class="text-info"> Query Marked </small>
                                                                    @else
                                                                        <small class="text-info">
                                                                            @if ($abc->current_status != 'User')
                                                                                Query Marked
                                                                            @else
                                                                                Replied
                                                                            @endif
                                                                        </small>
                                                                    @endif
                                                                @elseif($item->final_submit == 1)
                                                                    <small class="text-info"> In Process </small>
                                                                @else
                                                                    <small class="text-info"> Pending </small>
                                                                @endif
                                                            @elseif($item->form_status == 1)
                                                                <small class="text-success"> Approved </small>
                                                            @elseif($item->form_status == 2)
                                                                <small class="text-danger"> Rejected </small>
                                                            @else
                                                                <small class="text-secondary"> Submitted </small>
                                                            @endif
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    @endforeach

                                </div>


                            </div>


                        </div>
                    </div>
                </div>
                <div class="col-md-3">

                    <div class="box">
                        <div class="dash-title ">
                            <h1>Important Links</h1>
                        </div>
                        <ul class="list2">
                            @if (false)
                                <li>
                                    <a href="{{ url('player_coach') }}"><span>Player Registration</span><small>For
                                            Financial Aid, Direct Recruitment and Awards
                                        </small></a>
                                </li>
                            @endif
                            <li>
                                <a href="{{ url('facility_booking/login') }}"><span>Facility Booking</span><small>


                                        For Gyms, Swimming Pools, Stadium
                                    </small></a>
                            </li>
                            <li>
                                <a href="{{ url('private_coaching') }}"><span>Online Registration</span><small>


                                        For Private Coaching, Academies, Associations
                                    </small></a>
                            </li>
                            {{-- TEMPORARILY DISABLED --}}
                            {{-- <li>
                  <a href="{{ url('onlineAdmission') }}"><span>Admission & Hostel Allotment </span><small> Sports College Admission,  Hostel Allotment</small></a>
                </li> --}}
                            <li style="position:relative; pointer-events:none; opacity:0.6;">
                                <a href="javascript:void(0)" style="cursor:not-allowed;"><span>Hostel
                                        Admission</span><small>Kreeda Chatravas / Hostel Allotment</small></a>
                                <span
                                    style="position:absolute;top:50%;right:10px;transform:translateY(-50%);background:#dc3545;color:#fff;font-size:10px;font-weight:700;padding:3px 8px;border-radius:12px;white-space:nowrap;">Applications
                                    Closed</span>
                            </li>
                            <li style="position:relative;">
                                <a href="{{ url('onlineAdmission/register') }}"><span>Sports College
                                        Admission</span><small>Online Admission Form</small></a>
                            </li>
                            <li>
                                <a href="{{ url('sports_calendar') }}"><span>Upcoming Events</span><small>


                                        For Coaching Camps & Sports Competitions
                                    </small></a>
                            </li>
                            <li>
                                <a href="{{ url('player_coach/login') }}"><span> Online Registration</span><small>


                                        For Players & Coaches
                                    </small></a>
                            </li>





                        </ul>


                    </div>

                </div>
            </div>

        </div>
    </section>
    <!-- InstanceEndEditable -->
@endsection

<!-- Modal -->
<div class="modal fade" id="PositionHolder" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">1st, 2nd & 3rd Position Holder</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="modal-data">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                        voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                        non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                        voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                        non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                        voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                        non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                        voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                        non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                        voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                        non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                        voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                        non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                        voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                        non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                        voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                        non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                        voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                        non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                        voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                        non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                        voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                        non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn btn-primary">Proceed</button> -->
                <a href="{{ url('position_holder') }}" class="btn btn-primary">Proceed</a>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="Laxman" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Laxman / Rani Laxmi Bai Award</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="modal-data">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                        voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                        non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                        voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                        non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                        voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                        non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                        voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                        non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                        voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                        non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                        voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                        non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                        voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                        non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                        voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                        non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                        voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                        non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                        voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                        non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                        voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                        non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                @if ($user->gender == 'Male')
                    <a href="{{ url('laxman_award') }}" class="btn btn-primary">Proceed</a>
                @else
                    <a href="{{ url('rani_laxmi_bai_award') }}" class="btn btn-primary">Proceed</a>
                @endif
                <!-- <button type="button" class="btn btn-primary">Proceed</button> -->
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="Financial" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Financial Assistance (State,National and
                    International Level)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="modal-data">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                        voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                        non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                        voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                        non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                        voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                        non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                        voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                        non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                        voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                        non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                        voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                        non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                        voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                        non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                        voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                        non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                        voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                        non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                        voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                        non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                        voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                        non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn btn-primary">Proceed</button> -->
                <a href="{{ url('financial-assistance') }}" class="btn btn-primary">Proceed</a>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="Monthly" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Monthly Pension (Awarded with Padma Shri/Padma
                    Bhushan/Arjuna/Dronacharya/Dhyan Chand Awards)</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="modal-data">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                        voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                        non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                        voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                        non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                        voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                        non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                        voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                        non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                        voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                        non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                        voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                        non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                        voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                        non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                        voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                        non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                        voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                        non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                        voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                        non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                        voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                        non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn btn-primary">Proceed</button> -->
                <a href="{{ url('monthlyPension_form') }}" class="btn btn-primary">Proceed</a>

            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="Recruitment" tabindex="-1" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Direct Recruitment Various Posts</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="modal-data">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                        voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                        non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                        voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                        non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                        voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                        non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                        voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                        non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                        voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                        non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                        voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                        non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                        voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                        non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                        voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                        non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                        voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                        non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                        voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                        non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                        voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                        non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn btn-primary">Proceed</button> -->
                <a href="{{ url('sport_achievement') }}" class="btn btn-primary">Proceed</a>


            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="Eklavya" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Eklavya Krida Kosh</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="modal-data">
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                        voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                        non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                        voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                        non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                        voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                        non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                        voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                        non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                        voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                        non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                        voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                        non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                        voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                        non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                        voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                        non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                        voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                        non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                        voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                        non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                    <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut
                        labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco
                        laboris nisi ut aliquip ex ea commodo consequat. Duis aute irure dolor in reprehenderit in
                        voluptate velit esse cillum dolore eu fugiat nulla pariatur. Excepteur sint occaecat cupidatat
                        non proident, sunt in culpa qui officia deserunt mollit anim id est laborum.</p>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                <!-- <button type="button" class="btn btn-primary">Proceed</button> -->
                <a href="{{ url('eklavya_kreeda_kosh') }}" class="btn btn-primary">Proceed</a>
            </div>
        </div>
    </div>
</div>
