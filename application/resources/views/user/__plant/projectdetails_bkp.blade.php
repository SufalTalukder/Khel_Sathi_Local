@extends('layouts/layout')
@section('content')
<style>
    .mr-2 {
        margin-right: 4px !important;
    }

    .pagebody.sidepage-pading {
        padding: 0px 0px 0px 0px !important;
    }
</style>
<div class="row">
    <div class="col-2">
        <a href="{{ route('dashboard') }}" class="btn btn-outline-primary backbtn"><span class="icons icon-arrow-left"></span> Back to Dashboard</a>
        <div class="left-sidebar">
            <div >
                <ul>
                    <li>
                        <a href="{{ route('cp') }}">
                            <span class="icons icon-arrow-right"></span>Company Profile/Basic Details
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('registered-project') }}">
                            <span class="icons icon-arrow-right"></span>Project Details
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-10">
        <div class="col-md-12 pageheader mb-0">
            <div class="row">
                <div class="col-md-12">
                    <h4>Project Details</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Project Details</li>
                            <li class="breadcrumb-item active" aria-current="page">{{ $project_name }}</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="tab-content border-all-side">
            <div class="pagebody sidepage-pading pt-3 pb-3">
                <div class="row">

                    <div class="col-md-12">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-7">
                                        <h5>Project Details</h5>
                                    </div>
                                    <div class="col-md-5" style="text-align: right;">
                                        <a href="{{ route('projectdeatilsExport',['id'=>$id,'type'=>$type])}}" class="btn btn-primary btn-sm float-end">
                                            &nbsp;&nbsp;Download PDF&nbsp;&nbsp;<i class="fa fa-arrow-down"></i>
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                @if($project_name!='')                                
                                <div class="row">
                                    @if($profile->company_name!='')
                                    <div class="mt-2 col-md-6 row">
                                        <div class="col-md-6">Organisation/Company/Firm Name</div>
                                        <div class="col-md-6">
                                            <b>:&nbsp;&nbsp;&nbsp;{{ $profile->company_name }}</b>
                                        </div>
                                    </div>
                                    @endif
                                    <div class="mt-2 col-md-6 row">
                                        <div class="col-md-6">Authorize Person</div>
                                        <div class="col-md-6">
                                            <b>:&nbsp;&nbsp;&nbsp;{{ $profile->fullname }}</b>
                                        </div>
                                    </div>
                                    @if($profile->legal_status!='')
                                    <div class="mt-2 col-md-6 row">
                                        <div class="col-md-6">Legal Status</div>
                                        <div class="col-md-4">
                                            <b>:&nbsp;&nbsp;&nbsp;{{ $profile->legal_status }}</b>
                                        </div>
                                    </div>
                                    @endif
                                    <div class="mt-2 col-md-6 row">
                                        <div class="col-md-6">Email ID</div>
                                        <div class="col-md-6">
                                            <b>:&nbsp;&nbsp;&nbsp;{{ $profile->email }}</b>
                                        </div>
                                    </div>
                                    <div class="mt-2 col-md-6 row">
                                        <div class="col-md-6">Mobile Number</div>
                                        <div class="col-md-4">
                                            <b>:&nbsp;&nbsp;&nbsp;{{ $profile->mobile }}</b>
                                        </div>
                                    </div>
                                    <div class="mt-2 col-md-6 row">
                                        <div class="col-md-6">GST No.</div>
                                        <div class="col-md-6">
                                            <b>:&nbsp;&nbsp;&nbsp;{{ $profile->gstin_no }}</b>
                                        </div>
                                    </div>
                                    <div class="mt-2 col-md-6 row">
                                        <div class="col-md-6">PAN Card No.</div>
                                        <div class="col-md-4">
                                            <b>:&nbsp;&nbsp;&nbsp;{{ $profile->pan_no }}</b>
                                        </div>
                                    </div>
                                    <div class="col-md-12 mb-4"></div>
                                    <div class="col-md-6 row">
                                        <div class="col-md-6">Preference 1 </div>
                                        <div class="col-md-4">
                                            @foreach($state as $item)
                                            @if($items->preference_first==$item->id)
                                            <b>:&nbsp;&nbsp;&nbsp;{{ $item->name}}</b>
                                            @endif
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-md-6 row">
                                        <div class="col-md-6">Preference 2 </div>
                                        <div class="col-md-4">
                                            @foreach($state as $item)
                                            @if($items->preference_second==$item->id)
                                            <b>:&nbsp;&nbsp;&nbsp;{{ $item->name}}</b>
                                            @endif
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="mt-2 col-md-6 row">
                                        <div class="col-md-6">Preference 3 </div>
                                        <div class="col-md-4">
                                            @foreach($state as $item)
                                            @if($items->preference_third==$item->id)
                                            <b>:&nbsp;&nbsp;&nbsp;{{ $item->name}}</b>
                                            @endif
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="mt-2 col-md-6 row">
                                        <div class="col-md-6">Proposed Area of Land (in Acre)</div>
                                        <div class="col-md-4">
                                            <b>:&nbsp;&nbsp;&nbsp;{{ $items->area_of_land }}</b>
                                        </div>
                                    </div>
                                    @if($type == 'SG004')
                                    <div class="mt-2 col-md-6 row">
                                        <div class="col-md-6">Connectivity</div>
                                        <div class="col-md-4">
                                            <b>:&nbsp;&nbsp;&nbsp;{{ $items->connectivity }}</b>
                                        </div>
                                    </div>
                                    <div class="mt-2 col-md-6 row">
                                        <div class="col-md-6">Do you want to setup for solar park MNRE</div>
                                        <div class="col-md-4">
                                            <b>:&nbsp;&nbsp;&nbsp;{{ $items->setup_for_solar_park_mnre }}</b>
                                        </div>
                                    </div>
                                    <div class="mt-2 col-md-6 row">
                                        <div class="col-md-6">Do you want status of solar park from MNRE </div>
                                        <div class="col-md-4">
                                            <b>:&nbsp;&nbsp;&nbsp;{{ $items->status_of_solar_park }}</b>
                                        </div>
                                    </div>
                                    <div class="mt-2 col-md-6 row">
                                        <div class="col-md-6">Do you want to avail grant form MNRE</div>
                                        <div class="col-md-4">
                                            <b>:&nbsp;&nbsp;&nbsp;{{ $items->grant_form_mnre }}</b>
                                        </div>
                                    </div>
                                    @endif
                                    @if($type == 'SG003' || $type == 'SG004')
                                    @if($type != 'SG004')
                                    <div class="mt-2 col-md-6 row">
                                        <div class="col-md-6">Have you received any approval of <br>Park from Government of India</div>
                                        <div class="col-md-4">
                                            <b>:&nbsp;&nbsp;&nbsp;{{ $items->approval_of_park }}</b>
                                        </div>
                                    </div>
                                    @endif
                                    <div class="mt-2 col-md-6 row">
                                        <div class="col-md-6">Sanction Number</div>
                                        <div class="col-md-4">
                                            <b>:&nbsp;&nbsp;&nbsp;{{ $items->sanction_number }}</b>
                                        </div>
                                    </div>
                                    <div class="mt-2 col-md-6 row">
                                        <div class="col-md-6">Sanction Date</div>
                                        <div class="col-md-4">
                                            <b>:&nbsp;&nbsp;&nbsp;{{ dmy($items->sanction_date) }}</b>
                                        </div>
                                    </div>
                                    <div class="mt-2 col-md-6 row">
                                        <div class="col-md-6">Sanction Capacity (Megawatt)</div>
                                        <div class="col-md-4">
                                            <b>:&nbsp;&nbsp;&nbsp;{{ $items->sanction_capacity }}</b>
                                        </div>
                                    </div>
                                    <div class="mt-2 col-md-6 row">
                                        <div class="col-md-6">Preferred Sub Station</div>
                                        <div class="col-md-4">
                                            @foreach($station as $item)
                                            @if($items->sub_station==$item->id)
                                            <b>:&nbsp;&nbsp;&nbsp;{{ $item->name}}</b>
                                            @endif
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="mt-2 col-md-6 row">
                                        <div class="col-md-6">Voltage (Kilowatt)</div>
                                        <div class="col-md-4">
                                            <b>:&nbsp;&nbsp;&nbsp;{{ $items->voltage }}</b>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                                @else
                                <div class="alert alert-danger" role="alert">
                                    No records Found!.
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
