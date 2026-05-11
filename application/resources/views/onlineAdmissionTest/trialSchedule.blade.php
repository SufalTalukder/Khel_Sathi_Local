@extends('layouts.onlineAdmissionTestNav')
@section('content')

<div class="row">
    <div class="col-12">
        <div class="pageheader pb-2">
            <h5>Trial Venue / चयन परीक्षा स्थल
                <div class="float-end d-flex gap-2">
                    @if($trialInfo)
                    <button onclick="window.print()" class="btn btn-outline-primary btn-sm rounded-pill">Print</button>
                    @endif
                    <a href="{{ route('onlineAdmissionTest.dashboard') }}" class="btn btn-outline-secondary btn-sm rounded-pill">← Dashboard</a>
                </div>
            </h5>
        </div>
    </div>
</div>

@if(!$trialInfo)

    <div class="card mt-3">
        <div class="card-body text-center py-5">
            @if(!$districtName)
                <i class="fas fa-map-marker-alt fa-3x text-muted mb-3"></i>
                <h5 class="text-muted">District not found in your application.</h5>
                <p class="text-muted small">Please complete the Communication Details section of your application form first.</p>
                <a href="{{ route('onlineAdmissionTest.applicationForm') }}" class="btn btn-primary rounded-pill px-4 mt-2">Complete Application</a>
            @else
                <i class="fas fa-info-circle fa-3x text-warning mb-3"></i>
                <h5 class="text-muted">Trial venue details are not yet available for <strong>{{ $districtName }}</strong>.</h5>
                <p class="text-muted small">Please check back later or contact the Department of Sports.</p>
            @endif
        </div>
    </div>

@else

    <div class="row justify-content-center mt-3">
        <div class="col-lg-7 col-md-10">

            <div class="card">
                <div class="card-header table-success">
                    <strong>Your Trial Venue Details / आपके चयन परीक्षा का विवरण</strong>
                </div>
                <div class="card-body p-0">
                    <table class="table table-bordered table-sm mb-0" style="font-size:14px;">
                        <tbody>
                            <tr>
                                <td style="width:45%;" class="bg-light"><b>Your District / आपका जनपद</b></td>
                                <td><strong>{{ $districtName }}</strong></td>
                            </tr>
                            @if($divisionName)
                            <tr>
                                <td class="bg-light"><b>Your Division / आपका मंडल</b></td>
                                <td><strong>{{ $divisionName }}</strong></td>
                            </tr>
                            @endif
                            <tr>
                                <td class="bg-light"><b>Trial Venue / परीक्षा स्थल</b></td>
                                <td><strong>{{ $trialInfo->trial_location }}</strong></td>
                            </tr>
                            <tr>
                                <td class="bg-light"><b>Trial Date / परीक्षा तिथि</b></td>
                                <td>
                                    @if($trialInfo->trial_from_date && $trialInfo->trial_from_date !== '0000-00-00')
                                        @php
                                            $from = \Carbon\Carbon::parse($trialInfo->trial_from_date);
                                            $to   = ($trialInfo->trial_to_date && $trialInfo->trial_to_date !== '0000-00-00' && $trialInfo->trial_to_date !== $trialInfo->trial_from_date)
                                                    ? \Carbon\Carbon::parse($trialInfo->trial_to_date)
                                                    : null;
                                        @endphp
                                        <strong>
                                            {{ $from->format('jS F Y') }}
                                            @if($to) &amp; {{ $to->format('jS F Y') }} @endif
                                        </strong>
                                    @else
                                        <span class="text-muted">To be announced / शीघ्र घोषित होगा</span>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <td class="bg-light"><b>Trial Time / परीक्षा समय</b></td>
                                <td>
                                    @if($trialInfo->trial_time)
                                        <strong>{{ $trialInfo->trial_time }}</strong>
                                    @else
                                        <span class="text-muted">To be announced / शीघ्र घोषित होगा</span>
                                    @endif
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="alert alert-info small mt-3 no-print">
                <i class="fas fa-info-circle"></i>
                Applicants must carry their Admit Card and original documents on the day of the trial.
                / अभ्यर्थी चयन परीक्षा के दिन अपना प्रवेश पत्र एवं मूल दस्तावेज अवश्य लाएं।
            </div>

            @if($finalStatus == 1)
            <div class="text-center mt-3 no-print">
                @if($paymentStatus == 0)
                    <a href="{{ route('onlineAdmissionTest.payment') }}" class="btn btn-success rounded-pill px-5">
                        Proceed to Payment / भुगतान करें ₹200 →
                    </a>
                @else
                    <span class="badge bg-success fs-6 rounded-pill px-4 py-2">Payment Done ✓</span>
                @endif
            </div>
            @endif

        </div>
    </div>

@endif

@endsection
