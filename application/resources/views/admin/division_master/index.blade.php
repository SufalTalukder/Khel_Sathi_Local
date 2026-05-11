@extends( 'layouts/admin_layout' )
@section( 'content' )

<div class="row">
	<div class="col-md-12">
		<div class="pageheader" id="menu-margin">
			<h4 class="mb-0">Create Division</h4>
		</div>
		<div class="card mb-3">
			<div class="card-body">
				<form action="{{ route('saveDivision') }}" class="needs-validation" method="post" autocomplete="off">
					@csrf
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="name">Division Name <span class="text-danger">*</span></label>
								<input type="text" class="form-control alphanumeric" id="division_name" name="division_name" value="{{ old('division_name') }}" placeholder="Enter Division Name" required="">
								<div class="invalid-feedback">
									Please provide Division Name.
								</div>
								@if ($errors->has('division_name'))
								<span class="error_mess">{{ $errors->first('division_name') }}</span> @endif
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="name">Status <span class="text-danger">*</span></label>
								<select class="form-select" name="status" value="{{ old('status') }}" required="">
									<option selected="" disabled="" value="">Select Status</option>
									<option value="1">Enable</option>
									<option value="0">Disable</option>
								</select>
							</div>
							@if ($errors->has('status'))
							<span class="error_mess">{{ $errors->first('status') }}</span> @endif
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
			<h4 class="mb-0">Division Manager List <a title="Division Manager List" class="btn btn-sm btn-success float-end" onclick="ExportToExcel('xlsx')"><i class="fa fa-file-excel"></i> Export to Excel
				</a></h4>
		</div>
		<div class="card">
			<div class="card-body">
				<div class="">
					<div class="table-responsive">
						<table id="dataTable" class="table table-bordred table-hover bg-white datatable">
							<thead>
								<tr>
									<th width="6%">S.No.</th>
									<th>Division Name</th>
									<th width="10%" class="text-center">Status</th>
									<th width="8%" class="text-center">Edit</th>
									<th width="8%" class="text-center">Delete</th>
								</tr>
							</thead>
							<tbody>
								@foreach($divisions as $key=>$division)
								<tr>
									<td>{{ $key+1 }}</td>
									<td>{{ $division->division_name }}</td>
									<td class="text-center">
										<div class="form-control2">
											<label class="switch">
												<input type="checkbox" id="themeskin{{ $key+1 }}" <?php if ($division->status == 1) {
																										echo "checked";
																									} elseif ($division->status == 0) {
																										echo "";
																									} else {
																										echo "checked";
																									} ?>>
												<div class="slider round" onclick="divisionStatus('{{$division->id}}')">
													<?php if ($division->status == 1) {
														echo "<span class='on'>Enable</span>";
													}
													if ($division->status == 0) {
														echo "<span class='off'>Disable</span>";
													}  ?>
												</div>
											</label>
										</div>
									</td>
									<td class="text-center">
										<a class="btn btn-sm btn-dark pointer bt role_manager_id" href="javascript:void(0)" data-toggle="modal" data-target="#exampleModal" data-id="{{$division->id}}" data-name="{{$division->division_name}}">
											<i class="far fa-edit"></i>
										</a>
									</td>
									<td class="text-center">
										<a class="btn btn-sm btn-danger px-2 pointer bt" href="{{url('/admin/deleteDivision/')}}/{{$division->id}}" onclick="return confirm('Are you sure you want to delete ?')">
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
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<h5 class="modal-title" id="exampleModalLabel">Update Division Name</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span></button>

			</div>
			<form action="{{ route('updateDivision') }}" class="needs-validation" method="post" autocomplete="off">
				@csrf
				<div class="modal-body">
					<div class="row">
						<div class="col-md-12">
							<div class="form-group">
								<label for="name">Division Name</label>
								<input type="hidden" class="form-control alphanumeric" id="division_id" name="id">
								<input type="text" class="form-control admin_layout" id="division_name" name="division_name" required>
								<div class="invalid-feedback">
									Please provide Division.
								</div>
								@if ($errors->has('division_name'))
								<span class="error_mess">{{ $errors->first('division_name') }}</span> @endif
							</div>
						</div>
						<!-- <div class="col-md-4">
                            <div class="form-group">
                                <label for="name">Status</label>
                                <select class="form-control" name="status" value="{{ old('status') }}" required="" id="division_status">
                                    <option selected="" disabled="" value="">Select Status</option>
                                    <option value="1">Enable</option>
                                    <option value="0">Disable</option>
                                </select>
                            </div>
                            @if ($errors->has('status'))
                                <span class="error_mess">{{ $errors->first('status') }}</span>
                            @endif
                        </div> -->
					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-danger" data-dismiss="modal">Close</button>
					<button class="btn btn-primary" type="submit">Submit/दर्ज करे</button>
				</div>
			</form>
		</div>
	</div>
</div>

@push( 'custom-scripts' )
<script type="text/javascript">
	//update==========================
	$('.role_manager_id').click(function() {
		var division_id = $(this).data('id');
		var division_status = $(this).data('division_status');
		var division_name = $(this).data('name');
		$('#division_id').val(division_id);
		$('#division_name').val(division_name);
		$('#division_status').val(division_status);
	});

	//change division status
	function divisionStatus(id) {
		$.ajax({
			type: "GET",
			url: ajaxUrl + "/admin/divisionStatus/" + id,
			dataType: "text",
			success: function(res) {
				success(res.msg);
				window.location.href = "admin/create-division";
			},
		});
	}

	//Delete Hostel Division
	function deleteDivision(id) {
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
					url: ajaxUrl + "/deleteDivision/" + id,
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
			XLSX.writeFile(wb, fn || ('Division Manager List.' + (type || 'xlsx')));
	}
</script>

@endpush
