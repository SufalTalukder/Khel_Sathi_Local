@extends( 'layouts/admin_layout' )
@section( 'content' )

<div class="row">
	<div class="col-md-12">
		<div class="pageheader" id="menu-margin">
			<h4 class="mb-0">Create Division Map </h4>
		</div>
		<div class="card mb-3">
			<div class="card-body">
				<form action="{{ route('saveDivisionMap') }}" class="needs-validation" method="post" autocomplete="off">
					@csrf
					<div class="row">
						<div class="col-md-3">
							<div id="list1" class="dropdown-check-list">
								<label for="name">Division Name</label>
								<select class="js-select2" name="division_id" id="dropdownid">
									@foreach($divisions as $key=>$division)
									<option value="{{ $division->id }}" data-badge="">{{$division->division_name}}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-md-3">
							<div id="list1" class="dropdown-check-list">
								<label for="name">District Name</label>
								<select class="js-select2" multiple="multiple" name="district_id[]">
									@foreach($districts as $key=>$district)
									<option value="{{ $district->id }}" data-badge=""> {{$district->city}}</option>
									@endforeach
								</select>
							</div>
						</div>
						<div class="col-md-2 d-grid">
							<label class="form-label">&nbsp;</label>
							<button class="btn btn-primary form-group" type="submit">Submit/दर्ज करे</button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>


	<div class="col-md-12">
		<div class="pageheader" id="menu-margin">
			<h4 class="mb-0">Division Map List <a title="Division Map List" class="btn btn-sm btn-success float-end" onclick="ExportToExcel('xlsx')">
					<i class="fa fa-file-excel"></i> Export to Excel
				</a>
			</h4>
		</div>
		<div class="card">

			<div class="card-body">
				<div class="">
					<div class="table-responsive">
						<table id="dataTable" class="table table-bordred table-hover bg-white datatable">

							<thead>
								<tr>
									<th width="6%">S.No.</th>
									<th width="25%">Division Name</th>
									<th>District Name</th>
									<th width="8%" class="text-center">Delete</th>
								</tr>
							</thead>
							<tbody>
								@foreach($lists as $key=>$list)
								<tr>

									<td>{{ $key+1 }}</td>
									<td>{{ $list->division_name }}</td>
									<td>{{ $list->city }}</td>

									<td class="text-center">
										<a class="btn btn-sm btn-danger pointer bt px-2" href="{{url('/admin/delete-division-map/')}}/{{$list->id}}" onclick="return confirm('Are you sure you want to delete ?')">
											<i class="fa fa-trash"></i>
										</a>
									</td>
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	</div>


</div>


@endsection

@push( 'custom-scripts' )



<link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script>

<script type="text/javascript">
	$(".js-select2").select2({
		closeOnSelect: false,
		placeholder: "Select",
		allowClear: true,
	});


	//Delete Hostel Division
	function deleteDivisionMap(id) {
		Swal.fire({
			title: "Are you sure?",
			text: "You won't be able to revert this!",
			icon: "warning",
			showCancelButton: true,
			confirmButtonColor: "#3085d6",
			cancelButtonColor: "#d33",
			confirmButtonText: "Yes, delete it!",
		}).then((result) => {
			if (result.isConfirmed) {
				$.ajax({
					type: "GET",
					url: ajaxUrl + "/delete-division-map/" + id,
					dataType: "json",
					success: function(res) {
						success(res.msg);
						$("#responsive").load(" #responsive");
						tableRendor();
					},
				});
			}
		});
	}


	//find  value selected option

	$(document).on("change", "#dropdownid", function() {
		var id = ($(this).find("option:selected").val());
		$.ajax({
			type: "GET",
			url: ajaxUrl + "/admin/divisionMap/" + id,
			dataType: "text",
			success: function(res) {
				success(res.msg);
			},
		});
	});
</script>
<script type="text/javascript" src="{{ asset('js/xlsx.full.min.js') }}"></script>
<script>
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
			XLSX.writeFile(wb, fn || ('District List.' + (type || 'xlsx')));
	}
</script>
@endpush
