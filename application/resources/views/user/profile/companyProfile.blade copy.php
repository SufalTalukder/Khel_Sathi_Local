@extends('layouts/layout')
@section('content')

<div class="row">
    <div class="col-md-2">
        <a href="{{ route('dashboard') }}" class="btn btn-outline-primary backbtn"><span class="icons icon-arrow-left"></span> Dashboard</a>
        <div class="left-sidebar">
            <div >
                <ul>
                    <li>
                        <a href="{{ route('cp') }}" class="active">
                            <span class="icons icon-arrow-right"></span>Company Profile/Basic Details
                        </a> 
                    </li>
                    <li>
                        @if(Auth::user()->profile_complete==1)
                        <a href="{{ url('registered-project') }}">
                            <span class="icons icon-arrow-right"></span>Project Details
                        </a>
                        @else
                        <a href="javascript:void(0)" onclick="showMsg()">
                            <span class="icons icon-arrow-right"></span>Project Details
                        </a>
                        @endif
                    </li>
                    <!-- <li>
                        <a href="{{ route('uploadDpr') }}">
                            <span class="icons icon-arrow-right"></span>Upload Detailed Project Report (DPR)
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('viewDetails') }}"><span class="icons icon-arrow-right"></span>
                            View Project Status
                        </a>
                    </li> -->
                </ul>
            </div>
        </div>
    </div>
    <div class="col-md-10">
        <div class="col-md-12 pageheader mb-0">
            <div class="row">
                <div class="col-md-12">
                    <h4>Company Profile</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Company Profile</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
        <div class="tab-content border-all-side">
            <div class="pagebody sidepage-pading pt-3 pb-3">
                <div class="emp-profile">
                    <div class="row"> 
                        <div class="col-md-12">
                            <div class="profile-head">
                                <ul class="nav nav-tabs" id="myTab" role="tablist">
                                    <li class="nav-item"><a class="nav-link active" id="home-tab" data-toggle="tab" href="javascript:void(0)" role="tab" aria-controls="home" aria-selected="true">Registration Basic Details</a> </li>
                                </ul>
                                <div class="tab-content profile-tab" id="myTabContent">
                                    <div class="tab-pane fade show active" id="home" role="tabpanel" aria-labelledby="home-tab">
                                        <input type="hidden" value="{{$item->district}}" id="district_id" />
                                        <form action="{{ route('updateProfile') }}" method="post" id="preregistration" class="needs-validation" enctype="multipart/form-data" novalidate>

                                            <input type="hidden" required id="investor_type" name="investor_type" value="{{ $item->investor_type }}">

                                            <div class="row">
                                                @if($item->investor_type!='Individual')
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="name">1. Organisation/Company/Firm Name</label>
                                                        <input type="text" readonly class="form-control attrs" required id="ocfname" name="ocfname" value="{{ $item->company_name }}">
                                                        <div class="invalid-feedback">
                                                            Please Please enter name. name.
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="name"><?= $item->investor_type == 'Individual' ? 1 : 2; ?>. Authorize Person</label>
                                                        <input type="text" readonly class="form-control" id="ownername" name="ownername" required value="{{ $item->fullname }}">
                                                        <div class="invalid-feedback">
                                                            Please enter name.
                                                        </div>
                                                    </div>
                                                </div>
                                                @if($item->investor_type!='Individual')
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="legalstatus">3. Legal Status</label>
                                                        <select class="form-control attrs" disabled id="legalstatus" name="legalstatus">
                                                            <option selected disabled value="">Select Status</option>
                                                            <option value="1" @if($item->legal_status=='Limited (Ltd)') selected @endif >Limited (Ltd)</option>
                                                            <option value="2" @if($item->legal_status=='Pvt. Ltd.') selected @endif >Pvt. Ltd.</option>
                                                            <option value="3" @if($item->legal_status=='Proprietor') selected @endif >Proprietor</option>
                                                            <option value="4" @if($item->legal_status=='Partnership') selected @endif >Partnership</option>
                                                            <option value="5" @if($item->legal_status=='Limited Liability (LLP)') selected @endif >Limited Liability (LLP)</option>
                                                        </select>
                                                        <div class="invalid-feedback">
                                                            Please select a legal status.
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif

                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="email"><?= $item->investor_type == 'Individual' ? 2 : 4; ?>. Email ID</label>
                                                        <input type="email" name="email" readonly id="email" class="form-control" required value="{{ $item->email }}">
                                                        <div class="invalid-feedback">
                                                            Please provide a email.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="mobile"><?= $item->investor_type == 'Individual' ? 3 : 5; ?>. Mobile Number</label>
                                                        <input type="text" name="mobile" readonly id="mobile" class="form-control" required value="{{ $item->mobile }}">
                                                        <div class="invalid-feedback">
                                                            Please provide a mobile no.
                                                        </div>
                                                    </div>
                                                </div>
                                                @if($item->investor_type!='Individual')
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="gstno"><?= $item->investor_type == 'Individual' ? 4 : 6; ?>. GST No.</label>
                                                        <input type="text" name="gstno" id="gstno" class="form-control" required value="{{ $item->gstin_no }}">
                                                        <div class="invalid-feedback">
                                                            Please provide a GST No.
                                                        </div>
                                                    </div>
                                                </div>
                                                @endif
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="gstno"><?= $item->investor_type == 'Individual' ? 4 : 7; ?>. PAN Card No.</label>
                                                        <input type="text" name="pancardno" id="pancardno" class="form-control" required value="{{ $item->pan_no }}">
                                                        <div class="invalid-feedback">
                                                            Please provide a PAN Card No.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="username"><?= $item->investor_type == 'Individual' ? 5 : 8; ?>. Country <strong class="text-danger">*</strong></label>
                                                        <select id="country" name="country" class="form-control" required data-id="{{$item->state}}">
                                                            <option value="">Select Country</option>
                                                            @foreach($country as $items)
                                                            <option value="{{ $items->id }}" @if($items->id==$item->country) selected @endif> {{ $items->name }} </option>
                                                            @endforeach
                                                        </select>
                                                        <div class="invalid-feedback">
                                                            Please Select Country.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="username"><?= $item->investor_type == 'Individual' ? 6 : 9; ?>. State <strong class="text-danger">*</strong></label>
                                                        <select id="state" name="state" class="form-control" required data-id="{{$item->district}}">
                                                            <option value="">Select State</option>
                                                        </select>
                                                        <div class="invalid-feedback">
                                                            Please Select State.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="username"><?= $item->investor_type == 'Individual' ? 7 : 10; ?>. District <strong class="text-danger">*</strong></label>
                                                        <select id="district" name="district" class="form-control" required>
                                                            <option value="">Select District</option>
                                                        </select>
                                                        <div class="invalid-feedback">
                                                            Please Select District.
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <label><?= $item->investor_type == 'Individual' ? 8 : 11; ?>. Upload PAN Card</label>
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <input type="file" name="pancardfile" class="form-control" id="pancardfile" aria-describedby="inputGroupFileAddon05" aria-label="Upload">


                                                            @if($item->pan_card_doc!='')

                                                            <a target="_blank" class="btn btn-secondary" id="A3" href="{{ url('') }}/public/doc/{{ $item->pan_card_doc}}">View</a>

                                                            @endif



                                                        </div>
                                                        <span class="note">(File Format: jpeg, jpg ,pdf | Max File Size: 2 MB)</span>
                                                    </div>
                                                </div>
                                                @if($item->investor_type!='Individual')
                                                <div class="col-md-4">
                                                    <label><?= $item->investor_type == 'Individual' ? 10 : 12; ?>. Upload GST Registration Certificate</label>
                                                    <div class="form-group">
                                                        <div class="input-group">
                                                            <input type="file" class="form-control" name="gstcertificate" id="gstcertificate" aria-describedby="inputGroupFileAddon05" aria-label="Upload">

                                                            @if($item->gst_file!='')

                                                            <a target="_blank" class="btn btn-secondary" id="A3" href="{{ url('') }}/public/doc/{{ $item->gst_file}}">View</a>

                                                            @endif

                                                        </div>
                                                        <span class="note">(File Format: jpeg, jpg ,pdf | Max File Size: 2 MB)</span>
                                                    </div>
                                                </div>

                                                <div class="col-md-8">
                                                    <div class="form-group">
                                                        <label><?= $item->investor_type == 'Individual' ? 11 : 13; ?>. Certified copy of bye-laws of Company Memorandum and Articles of Association/Registered Society</label>
                                                        <div class="input-group">
                                                            <input type="file" class="form-control" name="byelawsfile" id="byelawsfile" aria-describedby="inputGroupFileAddon05" aria-label="Upload">

                                                            @if($item->byelawsfile!='')

                                                            <a target="_blank" class="btn btn-secondary" id="A3" href="{{ url('') }}/public/doc/{{ $item->byelawsfile}}">View</a>

                                                            @endif




                                                        </div>
                                                        <span class="note">(File Format: jpeg, jpg ,pdf | Max File Size: 2 MB)</span>
                                                    </div>
                                                </div>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label><?= $item->investor_type == 'Individual' ? 12 : 14; ?>. Certified copy of Partnership Deed / Incorporation Docs(if applicable)</label>
                                                        <div class="input-group">
                                                            <input type="file" class="form-control" name="certifiedcopyfile" id="certifiedcopyfile" aria-describedby="inputGroupFileAddon05" aria-label="Upload">


                                                            @if($item->company_id_proof_doc!='')

                                                            <a target="_blank" class="btn btn-secondary" id="A5" href="{{ url('') }}/public/doc/{{ $item->company_id_proof_doc}}">View</a>

                                                            @endif


                                                        </div>
                                                        <span class="note">(File Format: jpeg, jpg ,pdf | Max File Size: 2 MB)</span>
                                                    </div>
                                                </div>
                                                @endif
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label for="gstno"><?= $item->investor_type == 'Individual' ? 9 : 15; ?>. Address</label>
                                                        <textarea rows="3" name="address" id="address" class="form-control" required>{{ $item->address }}</textarea>
                                                        <div class="invalid-feedback">
                                                            Please provide a address.
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="bhoechie-footer">
                                                <div class="row justify-content-center">
                                                    <div class="col-md-2 d-grid">
                                                        <button type="submit" class="btn btn-primary">Save and Next</button>
                                                    </div>
                                                    <!-- <div class="col-md-2 d-grid">
                                                        <button type="reset" class="btn btn-light">Reset</button>
                                                    </div> -->
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="card" style="display:none;">
                                        <div class="card-body">
                                            <div class="col-md-12 row">
                                                @if($item->pan_card_doc!='')
                                                <div class="col-md-3">
                                                    <label>Upload PAN Card</label>
                                                    <div class="form-group">
                                                        <a target="_blank" class="btn btn-light" href="{{ url('') }}/public/doc/{{ $item->pan_card_doc}}">View</a>
                                                    </div>
                                                </div>
                                                @endif
                                                @if($item->gst_file!='')
                                                <div class="col-md-3">
                                                    <label>Upload GST Registration Certificate</label>
                                                    <div class="form-group">
                                                        <a target="_blank" class="btn btn-light" href="{{ url('') }}/public/doc/{{ $item->gst_file}}">View</a>
                                                    </div>
                                                </div>
                                                @endif
                                                @if($item->byelawsfile!='')
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <!-- <img src="{{ url('') }}/public/doc/{{ $item->byelawsfile}}" class="card-img-top" alt="..."> -->
                                                        <a target="_blank" class="btn btn-light" href="{{ url('') }}/public/doc/{{ $item->byelawsfile}}">View</a>
                                                    </div>
                                                    <label>Certified copy of bye-laws of Company Memorandum and Articles of Association/Registered Society</label>
                                                </div>
                                                @endif
                                                @if($item->company_id_proof_doc!='')
                                                <div class="col-md-3">
                                                    <div class="form-group">
                                                        <a target="_blank" class="btn btn-light" href="{{ url('') }}/public/doc/{{ $item->company_id_proof_doc}}">View</a>
                                                    </div>
                                                    <label>Certified copy of Partnership Deed (if applicable)</label>
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
            </div>
        </div>
    </div>
</div>
</div>

@endsection

@push('custom-scripts')
<script type="text/javascript">
         function showMsg()
         {
            info("Please Complete Your Profile");
         }
</script>
@endpush

