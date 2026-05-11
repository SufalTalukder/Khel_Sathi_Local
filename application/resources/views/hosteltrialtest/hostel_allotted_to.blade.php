@extends('layouts/admin_layout')
@section('content')
    <div class="pageheader" id="menu-margin">
        <h4 class="mb-0"> List of competition
            <!-- <a class="btn btn-sm btn-success" href="{{ route('exportExcel', 5) }}"> -->
                <a title="Application Details ExportToExcel" class="btn btn-sm btn-success float-end" href="{{route('download_hostel_pdf',6)}}">
					<i class="fa fa-file-excel"></i> Export to PDF
				</a>
          
          
                <a title="Sport Wise Count" class="btn btn-sm btn-success float-end" onclick="ExportToExcel('xlsx')">
                <i class="fa fa-file-excel"></i> Export to Excel
            </a>
        </h4>
    </div>

    <div class="card">

        <div class="card-body">
            <div class="mb-4">
                <form class="row" method="post" action="{{ route('hostel_allotted_to') }}">
                    @csrf


                    <div class="col-md-3">

                        <label for="project_filter">Hostel</label>
                        <select class="form-control" id="sport_filter" name="hostel_master" >
                            <option value="">--All--</option>
                            @foreach ($hostel_master as $item)
                                <option value="{{ $item->id }}"
                                    {{ request()->segment(3) == $item->id ? 'selected' : '' }}{{ request()->input('hostel_master') == $item->id ? 'selected' : '' }}>
                                    {{ $item->hostel_name }}</option>
                            @endforeach

                        </select>

                    </div>

                      <div class="col-md-2">
			<div class="form-group">
				<label for="status_filter">Session Year </label>
				<select class="form-select" name="session_year">
					<option value="">--All--</option>
                    <option value="2025" {{ request()->input('session_year') == 2025 ? 'selected' : '' }}>2025-26</option>
				    <option value="2024" {{ request()->input('session_year') == 2024 ? 'selected' : '' }}>2024-25</option>


					</select>
			</div>
		</div>
                    <div class="col-md-3">

                        <label for="project_filter">Sport</label>
                        <select class="form-control" id="sport_filter" name="sport_id" >
                            <option value="">--All--</option>
                            @foreach ($sports as $item)
                                <option value="{{ $item->id }}"
                                    {{ request()->input('sport_id') == $item->id ? 'selected' : '' }}>
                                    {{ $item->name }}</option>
                            @endforeach

                        </select>

                    </div>



         

                    <div class="col-md-2">
                        <label for="status_filter">Gender</label>
                        <select class="form-control" name="gender">
                            <option value="">--Select Gender--</option>
                            <option value="1" {{ request()->input('gender') == 1 ? 'selected' : '' }}>Male</option>
                            <option value="2" {{ request()->input('gender') == 2 ? 'selected' : '' }}>Female</option>

                        </select>
                    </div>


                    <div class="col-md-1">
                        <label for="reset">&nbsp;</label>
                        <button type="submit" class="btn btn-info  btn-block">
                            Submit
                        </button>
                    </div>
                    <div class="col-md-1">
                        <label for="reset">&nbsp;</label>
                        <a href="{{ route('hostel_allotted_to') }}" class="btn btn-success  btn-block">
                            Reset
                        </a>
                    </div>






                </form>
            </div>


            <div id="hostelapplication" class="table-responsive">

                <table id="dataTable" class="table table-striped table-bordered dataTable datatable">
                    <thead>
                        <tr>
                            <th>S.No.</th>
                            <th>Application No.</th>
                            <th>Applicant’s Name</th>
                            <th>Email ID</th>
                            <th>Mobile</th>
                            <th>Gender</th>
                            <th>District</th>
                            <th>Sports</th>
                            <th>Hostel</th>

                            <th class="text-center">Allotment Letter</th>
                            <th class="text-center">Allotment Fees</th>


                        </tr>
                    </thead>
                    <tbody id="hostelapplicant">
                        @foreach ($hostelList as $key => $item)
                            <tr>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $item->application_no }}</td>
                                <td>{{ $item->name }}</td>
                                <td>{{ $item->email }}</td>
                                <td>{{ $item->mobile }}</td>
                                <td>
                                    @if ($item->gender == 1)
                                        Male
                                    @else
                                        Female
                                    @endif
                                </td>

                                <td>{{ districtName($item->district_id) }} </td>
                                <td>{{ sport_name_hostel($item->sports) }} </td>
                                <td>{{ hostelName($item->hostel_alloted_id) }} </td>
                                <td>
                                 {{--    <a class="btn btn-sm btn-dark" href="{{ route('hostelView', $item->id) }}"><i
                                            class="fa fa-eye"></i> </a> --}}
                                            <a class="btn btn-sm btn-warning" href="javascript:void(0)"
                                        onclick="allotment_letter({{ $item->id }})"><i class="fa fa-upload" aria-hidden="true"></i> </a>
                                            @if (isset($item->hostel_allotment_letter))


                                            <a class="btn btn-sm btn-primary" href="{{ url('public/hostel/allotment_letter') }}/{{ $item->hostel_allotment_letter }}" target="_blank"
                                            ><i
                                            class="fa fa-eye"></i> </a>
                                            @endif

                                </td>

                                <td>

                                  
						
                                    @if ($item->payment_allotment_fee_status == 1)
                                 
                                   
                                       2500 INR                                   
                                    @else
                                        Pending
                                    @endif
                                    
                                </td>

                            </tr>
                        @endforeach

                    </tbody>
                </table>


            </div>


        </div>
    </div>

    <div class="modal" id="exampleModalLabellllll2" style="margin-top: 32px;" >
        <div class="modal-dialog modal-lg mb-3">

            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Hostel Allotment Letter</h5>
                    <!--<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
                </div>

        <form action="{{ route('hostel_allotment_letter') }}" method="post" class="needs-validation" novalidate enctype="multipart/form-data">
                    @csrf
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group mb-3">
                                    <input type="hidden" name="user_id" id="user_idd" value="">
                                    <label class="placeholder">Allotment Letter<span class="text-danger">*</span></label>
                                    <input class="form-control" type="file" name="letter"  onchange="getfileext111(this,10)" id="File10"  required>
                                </div>
                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="submit" class="btn btn-info">Submit</button>
                            <button type="button" class="btn btn-danger" onclick="closetrialll()">No</button>
                        </div>
                </form>
            </div>
        </div>
    </div>
    <script type="text/javascript" src="{{ asset('js/xlsx.full.min.js') }}"></script>
    <script>
        function closetrialll() {
            $("#exampleModalLabellllll2").hide();
        }



        function allotment_letter(id) {
            $("#exampleModalLabellllll2").show();
            $("#user_idd").val(id);
        }
function getfileext111(value, id) {
var fileExtension = ["pdf"];
var file_size = value.files[0].size;
var filevalue = value.value;
if (
    $.inArray(filevalue.split(".").pop().toLowerCase(), fileExtension) == -1
) {
    $("#File" + id).val("");
    $("#sign").attr("src", "");
    error("Please Upload File in PDF Format.");
} else if (file_size > 500000) {
    $("#File" + id).val("");
    $("#sign").attr("src", "");
    error("File Size should not exceed 500 kb.");
}
}


        function approvedchecked() {
            var arr = [];
            $('input.approvedcheck:checkbox:checked').each(function() {
                arr.push($(this).val());
            });
            $.ajax({
                type: "POST",
                data: {
                    arr
                },
                url: ajaxUrl + '/hosteladmin/competition_level_approved_store',
                dataType: "json",
                success: function(res) {
                    success(res.msg);
                    window.location.reload();
                },
            });

        }




        function ExportToExcel(type, fn, dl) {
            var elt = document.getElementById('dataTable');
            var wb = XLSX.utils.table_to_book(elt, {
                sheet: "sheet1"
            });
            return dl ?
                XLSX.write(wb, {
                    bookType: type,
                    bookSST: true,
                    type: 'base64'
                }) :
                XLSX.writeFile(wb, fn || ('Applicant List.' + (type || 'xlsx')));
        }
    </script>
@endsection
