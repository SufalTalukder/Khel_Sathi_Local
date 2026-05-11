@extends( 'layouts/admin_layout' )
@section( 'content' )


<div class="pageheader" id="menu-margin">
	<h4 class="mb-0">
		Stadium Booking List
		<a title="Application Details ExportToExcel" class="btn btn-sm btn-success float-end" onclick="ExportToExcel('xlsx')">
			<i class="fa fa-file-excel"></i> Export to Excel
		</a>
	</h4>
</div>
<div class="card">
	<div class="card-body">
		<div class="table-responsive table-bordred">
			<table id="dataTable" class="table table_new datatable table-bordred table-hover bg-white">
				<thead>
					<tr>
						<th>S.No.</th>
                        <th>Booking No.</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Mobile</th>
                         <th>Date </th>
                         <th>Sport </th>
                         <th>Stadium </th>
                         <th>Institute </th>
                         <th>Registered On </th>
                         <th>Action</th>

						{{-- <th>Application No.</th> --}}

					</tr>
				</thead>
				<tbody>
					@if(!empty($booking_list)) @foreach($booking_list as $key=>$item)
					<tr>
						<td>{{ $key+1 }}</td>
                        <td>{{ $item->booking_no }}</td>
                        <td>{{ $item->name }}</td>
                        <td>{{ $item->email }}</td>
                        <td>{{ $item->mobile }}</td>
                        <td>{{ dmy($item->from_date) }} - {{ dmy($item->to_date) }}</td>
                        <td>{{ sport_name($item->sport) }}</td>
                        <td>{{ stadium_name($item->stadium) }}</td>
                        <td>{{ $item->institute }}</td>
                        <td>{{ dmy($item->created_on) }}</td>
						<td> <button class="btn btn-success" onclick="approved({{ $item->id }})">Approve</button></td>


					</tr>
					@endforeach @endif
				</tbody>
			</table>
		</div>
	</div>
</div>


@endsection

@push('custom-scripts')
<div class="modal" id="exampleModalLabellllll" >
    <div class="modal-dialog modal-lg">

        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Approve Booking</h5>
                <!--<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
            </div>



            <form  action="{{ route('stadium_booking_approved') }}" method="post" class="needs-validation" novalidate>
                @csrf
                <div class="modal-body">




                    <div class="row">
                        <div class="form-group mb-3">
                            <label>Status</label>
                            <input type="hidden" name="id" id="bookid" value="" >
                            <select class="form-select form-control" name="status" required >
                              <option value="">Select</option>
                              <option value="1">Approved </option>
                              <option value="2">Declined</option>
                            </select>
                          </div>

                        <div class="form-group mb-3">
                            <label class="placeholder">
                               Message
                            </label>
                            <input type="text" class="form-control" value="" name="status_message" required>
                        </div>
                </div>
                <div class="modal-footer">
                    <!--<button type="button" class="btn btn btn-outline-danger"><span class="icons icon-cloud-download"></span> Download</button>-->
                    <button type="submit" class="btn btn-info">Submit</button>
                    <button type="button" class="btn btn-danger" onclick="closetrial()">No</button>
                </div>
            </form>


        </div>
    </div>
</div>

<script type="text/javascript" src="{{ asset('js/xlsx.full.min.js') }}"></script>
<script>

function approved(id){
    alert(id);
    $("#bookid").val(id);

    $("#exampleModalLabellllll").show();



}


function closetrial(){
    $("#exampleModalLabellllll").hide();
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
			XLSX.writeFile(wb, fn || ('Application Details.' + (type || 'xlsx')));
	}








</script>
@endpush
