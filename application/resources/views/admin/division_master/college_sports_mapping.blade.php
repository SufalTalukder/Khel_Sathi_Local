@extends( 'layouts/admin_layout' )
@section( 'content' )

<div class="row">
	<div class="col-md-12">
		<div class="pageheader" id="menu-margin">
			<h4 class="mb-0">Create Sport College Map</h4>
		</div>
		<div class="card mb-3">
			<div class="card-body">
				<form action="{{ route('saveSportCollegeMap') }}" class="needs-validation" method="post" autocomplete="off">
					@csrf
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="name">College Name</label>
								<div id="list1" class="dropdown-check-list">
									<select class="js-select2 form-select" name="college_name" id="dropdownid" required="">
										<option value="" data-badge="">Select College Name</option>
										@foreach($colleges as $key=>$college)
										<option value="{{ $college->id }}" data-badge="">
											{{$college->college_name}}
										</option>
										@endforeach
									</select>
								</div>
							</div>
						</div>
						<div class="col-md-6">
							<div class="form-group">
								<label for="name">Sports Name</label>
								<div id="list1" class="dropdown-check-list">
									<select class="js-select2 form-select" multiple="multiple" name="sport_id[]" id="dropdownid" required="">
										<option value="" data-badge="">Select Sport Name</option>
										@foreach($sports as $key=>$sport)
										<option value="{{ $sport->id }}" data-badge=""> {{$sport->name}}</option>
										@endforeach
									</select>
								</div>
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="gender">Gender*</label>
								<div class="form-control">
									<input type="radio" name="gender" value="1" required=""> Male &nbsp;
									<input type="radio" name="gender" value="2" required=""> Female &nbsp;
									<input type="radio" name="gender" value="3" required=""> Male & Female
								</div>
							</div>
							@if ($errors->has('gender'))
							<span class="error_mess">{{ $errors->first('gender') }}</span>
							@endif
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
			<h4 class="mb-0">Sport College Map List <a title="Sport College Map List" class="btn btn-sm btn-success float-end" onclick="ExportToExcel('xlsx')">
					<i class="fa fa-file-excel"></i> Export to Excel
				</a></h4>
		</div>

		<div class="card">

			<div class="card-body">

				<div class="table-responsive">
					<table id="dataTable" class="table table-bordred table-hover bg-white datatable">
						<thead>
							<tr>
								<th width="6%">S.No.</th>
								<th>College Name</th>
								<th>Gender</th>
								<th width="20%">Sport Name</th>
								<!-- <th class="text-center">Edit</th> -->
								<th width="50px" class="text-center">Delete</th>
							</tr>
						</thead>
						<tbody>
							@foreach($lists as $key=>$list)
							<tr>
								<td>{{ $key+1 }}</td>
								<td>{{ $list->college_name }}</td>
								<td>
									@if($list->gender == 1)
									Male
									@elseif($list->gender == 2)
									Female
									@elseif($list->gender == 3)
									Male & Female
									@endif
								</td>
								<td>{{ $list->name }}</td>
								<!--  <td class="text-center">
                                                    <a class="btn btn-sm btn-dark pointer bt role_manager_id"
                                                        href="javascript:void(0)" data-toggle="modal"
                                                        data-target="#exampleModal" data-id="{{$list->id}}"
                                                        data-name="{{$list->college_name}}">
                                                        <i class="far fa-edit"></i>
                                                    </a>
                                                </td> -->
								<td class="text-center">
									<a class="btn btn-sm btn-danger pointer bt" href="{{url('/admin/delete-sport-college-map/')}}/{{$list->id}}" onclick="return confirm('Are you sure you want to delete ?')">
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

@endsection

@push( 'custom-scripts' )



<link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
<link href="{{ asset('admin') }}/css/select2-container.css" rel="stylesheet" />

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.4/js/select2.min.js"></script>

<script type="text/javascript">
	$(".js-select2").select2({
		closeOnSelect: false,
		placeholder: "Select",
		allowClear: true,
	});


	//Delete Hostel Division
	function deleteSportCollege(id) {
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
					url: ajaxUrl + "/delete-sport-college-map/" + id,
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
			url: ajaxUrl + "/admin/college-sports-map-list/" + id,
			dataType: "text",
			success: function(res) {

				$('#city-dd').html('<option value="">Select Sports Name</option>');
				$.each(res.cities, function(key, value) {

					$("#city-dd").append(`<option value="${value.district_id}" ${value.district_id==h_city ? 'selected':''}>${value.city}</option>`);
				});
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
			XLSX.writeFile(wb, fn || ('Sport College Map List.' + (type || 'xlsx')));
	}
</script>
@endpush
