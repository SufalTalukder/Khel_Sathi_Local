@extends('layouts/admin_layout')
@section('content')

<!-- <div class="pagebody removebg-color"> -->
<!-- <div class="pageheader"> -->
<!-- <div class="row"> -->
<!-- <div class="col-md-10">
                                <h4 class="mb-0">Dashboard / Online Request For Direct Recruitment of Players as Gazetted Officers</h4>
                            </div>
                            <div class="col-md-2 d-grid">
                                <a class="btn btn-sm btn-dark" href="ApplicationForm.html"><i class="fa fa-plus"></i>&nbsp;&nbsp; Application Form</a>
                            </div> -->
<!-- <nav aria-label="breadcrumb">
                                <ol class="breadcrumb">
                                    <li class="breadcrumb-item"><a href="{{route('ad')}}">Dashboard</a></li>
                                    <li class="breadcrumb-item active" aria-current="page">List of Applications</li>
                                </ol>
                            </nav> -->
<!-- </div> -->
<!-- </div> -->
<!-- <div class="col-md-12"> -->
<div class="row">
    <div class="col-md-12">
        <div class="pageheader" id="menu-margin">
            <h4 class="mb-0">List of Applications<!-- <a class="btn btn-sm btn-success" href="{{ route('exportExcel',3) }}"> -->
                <a class="btn btn-success btn-sm float-end" id="exportExcel">
                    <i class="fa fa-file-excel"></i> Export to Excel
                </a>

                <!-- <a class="btn btn-sm btn-danger" href="{{ route('exportPdf',3) }}"> -->
                <a class="btn btn-sm btn-success float-end" id="exportPdf">
                    <i class="fa fa-file-pdf"></i> Export to PDF
                </a></h5>
        </div>
        <div class="card">


            <div class="card-body">
                <div class="mb-4">
                    <form class="row">
                        <div class="col-md-3">
                            <input type="hidden" value="6" id="form_type">
                            <input type="hidden" id="seg4" value="{{$seg4}}">
                            <input type="hidden" value="{{$seg}}" id="seg">
                            <label for="project_filter">Sport</label>
                            <select class="form-select" id="project_filter" name="project_filter" onchange="handeChange(this)">
                                <option value="all">--All--</option>
                                @foreach($sports as $sport)
                                <option value="{{ $sport->id }}">{{ $sport->name }}</option>
                                </option>
                                @endforeach
                            </select>

                        </div>

                        

                        <div class="col-md-3">
                            <label for="city_filter">District</label>
                            <select class="form-select" id="city_filter" name="city_filter" onchange="handeChange(this)">
                                <option value="all">--All--</option>
                                @foreach($cities as $city)
                                <option value="{{ $city->id }}">{{ $city->city }}</option>
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-2">
                            <label for="status_filter">Application Status</label>
                            <select class="form-select" id="status_filter" name="status_filter" onchange="handeChange(this)">
                                <option value="all">--All--</option>
                                <option {{$seg==0 ? 'selected' : ""}} value="0">Pending</option>
                                <option {{$seg==1 ? 'selected' : ""}} value="1">Accepted</option>
                                <option {{$seg==2 ? 'selected' : ""}} value="2">Rejected</option>
                            </select>
                        </div>

                        <div class="col-md-2">
                            <label for="from_date">From Date</label>
                            <input readonly name="from_date" onchange="handeChange(this)" id="from_date" type="text" required class="form-control dateTime" placeholder="From Date" data-language="en">
                        </div>
                        <div class="col-md-2">
                            <label for="to_date">To Date</label>
                            <input readonly name="to_date" id="to_date" onchange="handeChange(this)" type="text" required class="form-control dateTime" placeholder="To Date" data-language="en">
                        </div>
                        <!--- new filter -->
                        <p></p>
                        <div class="col-md-3">
                            <label for="project_filter">Sports Competition</label>
                            <select class="form-select" id="sports_comp" name="sports_comp" onchange="handeChange(this)">
                                <option value="all">--All--</option>
                                @foreach($sport_event as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                </option>
                                @endforeach
                            </select>

                        </div>

                        

                        <div class="col-md-2">
                            <label for="city_filter">Post Name</label>
                            <select class="form-select" id="post_name" name="post_name" onchange="handeChange(this)">
                                <option value="all">--All--</option>
                                @foreach($post_master as $item)
                                <option value="{{ $item->id }}">{{ $item->name }}</option>
                                </option>
                                @endforeach
                            </select>
                        </div>
                        
                        <div class="col-md-2">
                            <label for="status_filter">Position / Medal</label>
                            <select class="form-select" id="position_medal" name="position_medal" onchange="handeChange(this)">
                                <option value="all">--All--</option>
                                <option value="Gold">Gold</option>
                                <option value="Silver">Silver</option>
                                <option value="Bronze">Bronze</option>
                            </select>
                        </div>

                        <div class="col-md-2">
                            <label for="from_date" style="font-size: 13px;">Competition From Date</label>
                            <input readonly name="comp_from_date" onchange="handeChange(this)" id="comp_from_date" type="text" required class="form-control dateTime" placeholder="From Date" data-language="en">
                        </div>
                        <div class="col-md-2">
                            <label for="to_date">Competition To Date</label>
                            <input readonly name="comp_to_date" id="comp_to_date" onchange="handeChange(this)" type="text" required class="form-control dateTime" placeholder="To Date" data-language="en">
                        </div>

                        <!---- end filter new --->

                        <div class="col-md-1">
                            <label for="reset">&nbsp;</label>
                            <button type="reset" class="btn btn-info  btn-block" onclick="resetButton()">
                                Reset
                            </button>
                        </div>
                    </form>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label>Show
                            <select name="table_length" id="table_length" class="table-form-control">
                                <option value="100000">All</option>
                                <option value="5">5</option>
                                <option value="10">10</option>
                                <option value="25">25</option>
                                <option value="50">50</option>
                                <option value="100">100</option>
                                <option value="200">200</option>
                                <!--option value="-1">All</option--->
                            </select> entries
                        </label>
                    </div>
                    <div class="col-md-6 text-end">
                        <label>Search:
                            <input type="search" placeholder="Search..." onchange="searchCollection(this.value);" onkeyup="this.onchange();" onpaste="this.onchange();" oncut="this.onchange();" oninput="this.onchange();" name="table_search" id="table_search" class="table-form-control">
                        </label>
                    </div>
                </div>
                <div id="table_data_department"></div>
            </div>
        </div>
    </div>
</div>
</div>

@endsection


<!--Release Button-->
<div class="modal fade" id="releasebtn1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Amount to be Released</h5>
                <!--<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
            </div>
            <form action="{{route('direct_released_amount')}}" method="post">
                @csrf
                <div class="modal-body">
                    <h3 class="text-center">
                        <div class="form-group">
                            <label for="amount">Release Amount in Rupees</label>
                            <input type="hidden" class="financial_released" name="id" value="" />
                            <input type="hidden" name="form_type" value="6">
                            <input type="number" class="form-control " min="0" name="amount_release" id="release">
                        </div>
                    </h3>
                </div>
                <div class="modal-footer">
                    <!--<button type="button" class="btn btn btn-outline-danger"><span class="icons icon-cloud-download"></span> Download</button>-->
                    <button type="submit" class="btn btn-info">Yes</button>
                    <button type="button" class="btn btn-success" data-bs-dismiss="modal">No</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!--Forwarded Button-->
<div class="modal fade" id="forwardedbtn1" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Forward to <span id="tt_ile"> Dealing Assistance</span></h5>
                <!--<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
            </div>
            <form action="{{route('direct_forward_directorate')}}" method="post" enctype="multipart/form-data">
				<div class="modal-body">
					@csrf
					<input type="hidden" class="financial_forward" name="id" value="" />
					<input type="hidden" class="application_no" name="application_no" value="" />
					<input type="hidden" name="form_type" value="6">
                    <input type="hidden" id="forward_to" name="forward_to" value="4">

					<label class="placeholder">Remark <span class="text-danger">*</span></label>
					<textarea class="form-control" required name="remark" id="is_mark_query" cols="95" rows="2"></textarea>

					<label id="verification_document">Upload Relevant application verification document <span class="text-danger remove_danger">*</span></label></br>
					<span class="text-danger">(If you have more than one supporting document then make please a single PDF for all then upload.)</span>
					<div class="input-group">
						<input type="file" required name="verification_document" class="form-control remove_danger" onchange="getfileext(this.value,10)" id="File10" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
					</div>
				</div>
				<div class="modal-footer">
					<div>
						<input type="submit" class="btn btn-info" value="Yes">
						<button type="button" class="btn btn-success" data-bs-dismiss="modal">No</button>
					</div>
				</div>
			</form>
        </div>
    </div>
</div>





@push('custom-scripts')
<script type="text/javascript">

</script>
@endpush
