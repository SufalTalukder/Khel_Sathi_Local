@extends( 'layouts/admin_layout' )
@section( 'content' )

<div class="row">
	<div class="col-md-12">
		<div class="pageheader" id="menu-margin">
			<h4 class="mb-0">Create Sport</h4>
		</div>
		<div class="card mb-3">
			<div class="card-body">
				<form action="{{ route('saveSport_onlineAdmission') }}" class="needs-validation" method="post" novalidate>
					@csrf
					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<label for="name">Sport Name <span class="text-danger">*</span></label>
								<input type="text" class="form-control alphanumeric" id="name" name="name" value="{{ old('name') }}" placeholder="Enter Sport Name" required> @if ($errors->has('name'))
								<span class="error_mess">{{ $errors->first('name') }}</span> @endif
							</div>
						</div>
						<div class="col-md-2">
							<div class="form-group">
								<label for="name">Status <span class="text-danger">*</span></label>
								<select class="form-select" name="status" value="{{ old('status') }}" required>
									<option selected="" disabled="" value="">Select Status</option>
									<option value="1">Enable</option>
									<option value="0">Disable</option>
								</select>
							</div>
							@if ($errors->has('status'))
							<span class="error_mess">{{ $errors->first('status') }}</span> @endif
						</div>

						<div class="col-md-4">
							<div class="form-group">
								<label for="gender">Gender <span class="text-danger">*</span></label>
								<div class="form-control">
									<input type="radio" name="gender" value="1" class="form-check-input" required> Male &nbsp;
									<input type="radio" name="gender" value="2" class="form-check-input" required> Female &nbsp;
									<input type="radio" name="gender" value="3" class="form-check-input" required> Male & Female
								</div>
							</div>
							@if ($errors->has('gender'))
							<span class="error_mess">{{ $errors->first('gender') }}</span> @endif
						</div>
						<div class="col-md-1 d-grid">
							<label class="form-label">&nbsp;</label>
							<button class="btn btn-primary form-group" type="submit">Submit</button>
						</div>
						<!-- <div class="col-md-2 d-grid">
							<label class="form-label">&nbsp;</label>
							<div class="btn btn-success form-group add_form_field">Add Sub Sport</div>
						</div> -->
					</div>

				</form>

				{{--
				<>

					<span style="font-size:16px; font-weight:bold;">+ </span></button>
					<div><input type="text" name="mytext[]">
					</div>
			</div> --}}
			</div>
		</div>



		<div class="col-md-12">
			<div class="pageheader" id="menu-margin">
				<h4 class="mb-0">Sport List<a title="Sport List" class="btn btn-sm btn-success float-end" onclick="ExportToExcel('xlsx')">
						<i class="fa fa-file-excel"></i> Export to Excel
					</a>

				</h4>
			</div>
			<div class="card">

				<div class="card-body">

					<div class="table-responsive">
						<table id="dataTable" class="table table-bordred table-hover bg-white datatable">
							<thead>
								<tr>
									<th width="6%">S.No.</th>
									<th width="20%">Sport Name</th>
									<th class="text-center">Status</th>
									<th width="20%">Created At</th>
									<th width="20%">Updated At</th>
									<th width="20%">Sub Sport</th>
									<th width="20%">Gender</th>
									<th class="text-center">Edit</th>
								</tr>
							</thead>
							<tbody>
								@foreach($sports as $key=>$sport)
								<tr>

									<td>{{ $key+1 }}</td>
									<td>{{ $sport->name }}</td>
									<td class="text-center">
										<div class="form-control2">
											<label class="switch">
												<input type="checkbox" id="themeskin{{ $key+1 }}" <?php if ($sport->status == 1) {
																										echo "checked";
																									} elseif ($sport->status == 0) {
																										echo "";
																									} else {
																										echo "checked";
																									} ?>>
												<div class="slider round" onclick="sportStatus('{{$sport->id}}')">
													<?php if ($sport->status == 1) {
														echo "<span class='on'>Enable</span>";
													}
													if ($sport->status == 0) {
														echo "<span class='off'>Disable</span>";
													}  ?>
												</div>
											</label>

										</div>
									</td>
									<td>{{ $sport->created_at }}</td>
									<td>{{ $sport->updated_at }}</td>
									<td>@foreach (sub_sport_type($sport->id) as $item) {{$item->sub_type}}, @endforeach
									</td>
									<td>
										@if ($sport->gender == 1) Male @elseif ($sport->gender == 2) Female @elseif ($sport->gender == 3) Male & Female @else N/A @endif
									</td>
									<td class="text-center">
										<a class="btn btn-sm btn-dark pointer bt role_manager_id" href="javascript:void(0)" data-toggle="modal" data-target="#exampleModal" data-id="{{$sport->id}}" data-name="{{$sport->name}}" data-subsport="{{sub_sport_type($sport->id)}}" data-gender="{{$sport->gender}}">
											<i class="far fa-edit"></i>
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

	@endsection
	<!-- Modal -->
	<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title" id="exampleModalLabel">Update Sport Name</h5> {{-- <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
				--}}

				</div>
				<form action="{{ route('updateSport_onlineAdmission') }}" class="needs-validation" method="post" autocomplete="off">
					@csrf
					<div class="modal-body">
						<div class="form-group">
							<label for="name">Sport Name</label>
							<input type="hidden" class="form-control" id="sport_id" name="id">
							<input type="text" class="form-control" id="name" name="name" required>
							<div class="invalid-feedback">
								Please provide District.
							</div>
							@if ($errors->has('name'))
							<span class="error_mess">{{ $errors->first('name') }}</span> @endif
						</div>


						<div class="form-group">
							<label for="gender">Gender*</label><br>
							<input type="radio" name="gender" value="1" id="radiogender1" class="form-check-input" required> Male &nbsp;
							<input type="radio" name="gender" value="2" id="radiogender2" class="form-check-input" required> Female &nbsp;
							<input type="radio" name="gender" value="3" id="radiogender3" class="form-check-input" required> Male & Female &nbsp; @if ($errors->has('gender'))
							<span class="error_mess">{{ $errors->first('gender') }}</span> @endif
						</div>
						<div class="container2">

						</div>
					</div>
					<div class="modal-footer">
					<button type="button" class="btn btn-danger" onclick="reloadContainer()" data-dismiss="modal">Close</button>
						<button type="button" class="btn btn-secondary" id="addBtn">Add Sub Sport</button>						
						<button class="btn btn-primary" type="submit">Submit</button>
					</div>
				</form>
			</div>
		</div>
	</div>

	@push( 'custom-scripts' )
	<script type="text/javascript">
		//update==========================
		$('.role_manager_id').click(function() {
			var wrapper = $(".container2");
			var sport_id = $(this).data('id');
			var name = $(this).data('name');
			var gender = $(this).data('gender');
			var subsport = $(this).data('subsport');
			$('#sport_id').val(sport_id);
			$('#name').val(name);

			var add_button = $("#addBtn");
			if (gender == 1) {
				$("#radiogender1").attr("checked", "true");
			} else if (gender == 2) {
				$("#radiogender2").attr("checked", "true");
			} else if (gender == 3) {
				$("#radiogender3").attr("checked", "true");
			}

			$.each(subsport, function(key, value) {
				$(wrapper).append('<div class="input-group mb-3"><input type="text" class="form-control col-md-8"  name="sub_type[]" value="' + value.sub_type + '" placeholder="Enter Sub Sport Type" required><a href="#" class="btn btn-danger delete input-group-text" >Delete</a></div> ');
			});
			$(add_button).click(function(e) {
				$(wrapper).append('<div class="input-group mb-3"><input type="text" class="form-control col-md-12"  name="sub_type[]" value="{{ old('sub_type') }}" placeholder="Enter Sub Sport Type" required><a href="#" class="btn btn-danger delete input-group-text" >Delete</a></div> '); //add input box
			});

			$(wrapper).on("click", ".delete", function(e) {
				e.preventDefault();
				$(this).parent('div').remove();
			});

		});


		function reloadContainer() {

			window.location.href = "admin/sport-list-onlineAdmission";
		}

		//change sport status
		function sportStatus(id) {
			$.ajax({
				type: "GET",
				url: ajaxUrl + "/admin/sportStatus-onlineAdmission/" + id,
				dataType: "text",
				success: function(res) {
					success(res.msg);
					window.location.href = "admin/sport-list-onlineAdmission";

				},
			});
		}




		var wrapper = $(".container1");
		var add_button = $(".add_form_field");


		$(add_button).click(function(e) {
			$(wrapper).append('<div class="d-flex gap-4 mb-3"><input type="text" class="form-control col-md-12"  name="sub_type[]" value="{{ old('sub_type') }}" placeholder="Enter Sub Sport Type" required><a href="#" class="btn btn-danger delete" >Delete</a></div> '); //add input box

		});

		$(wrapper).on("click", ".delete", function(e) {
			e.preventDefault();
			$(this).parent('div').remove();

		});
	</script>
	<script type="text/javascript" src="{{ asset('js/xlsx.full.min.js') }}"></script>
	<script>
		function ExportToExcel(type, fn, dl) {
			var elt = document.getElementById('dataTable');
			var wb = XLSX.utils.table_to_book(elt, {
				sheet: "sheet1"
			});
			const ws = XLSX.WorkSheet = XLSX.utils.table_to_sheet(document.getElementById('dataTable'));
			ws['!cols'] = [];
			ws['!cols'][0] = {
				hidden: true
			};
			return dl ?
				XLSX.write(ws, {
					bookType: type,
					bookSST: true,
					type: 'base64'
				}) :
				XLSX.writeFile(wb, fn || ('Sport List.' + (type || 'xlsx')));
		}
	</script>
	@endpush
