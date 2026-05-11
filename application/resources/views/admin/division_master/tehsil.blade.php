@extends( 'layouts/admin_layout' )
@section( 'content' )

			<div class="row">

				<div class="col-md-12">

					<div class="pageheader" id="menu-margin">
						<h4 class="mb-0">Create Tehsil</h4>
					</div>
					<div class="card mb-3">

						<div class="card-body">
							<form action="{{ route('saveTehsil') }}" class="needs-validation" method="post" autocomplete="off">
								@csrf
								<div class="row">
                                <div class="col-md-4">
										<div class="form-group">
											<label for="name">District *</label>
											<select class="form-control" name="dist_id" value="{{ old('dist_id') }}" required="">
												<option selected="" disabled="" value="">Select district</option>
												@foreach ($cities as $item)
                                                <option  value="{{$item->id}}" >{{$item->city}}</option>
                                                @endforeach
											</select>
										</div>
										@if ($errors->has('dist_id'))
										<span class="error_mess">{{ $errors->first('dist_id') }}</span> @endif
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label for="name">Tehsil Name *</label>
											<input type="text alphanumeric" class="form-control" id="Tehsil_Name" name="Tehsil_Name" value="{{ old('Tehsil_Name') }}" placeholder="Enter Tehsil Name" required="">
											<div class="invalid-feedback">
												Please provide Tehsil Name.
											</div>
											@if ($errors->has('Tehsil_Name'))
											<span class="error_mess">{{ $errors->first('Tehsil_Name') }}</span> @endif
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
						<h4 class="mb-0">Tehsil Manager List <a  title="Tehsil Manager List" class="btn btn-sm btn-success float-end" onclick="ExportToExcel('xlsx')"><i class="fa fa-file-excel"></i> Export to Excel
			                        </a></h4>
					</div>
					<div class="card">

						<div class="card-body">
							<div class="">
								<div class="table-responsive">
									<table  id="dataTable" class="table table-bordred table-hover bg-white datatable" >
										<thead>
											<tr>
												<th width="6%">S.No.</th>
												<th width="20%">Tehsil Name</th>

												<th class="text-center">Edit</th>
												<th class="text-center">Delete</th>
											</tr>
										</thead>
										<tbody>
											@foreach($Tehsil_Name as $key=>$Tehsil)
											<tr>

												<td>{{ $key+1 }}</td>
												<td>{{ $Tehsil->Tehsil_Name }}</td>


												<td class="text-center">
													<a class="btn btn-sm btn-dark pointer bt role_manager_id" href="javascript:void(0)" data-toggle="modal" data-target="#exampleModal" data-id="{{$Tehsil->id}}" data-name="{{$Tehsil->Tehsil_Name}}">
                                                            <i class="far fa-edit"></i>
                                                        </a>

												</td>
												<td class="text-center">
													<a class="btn btn-sm btn-danger pointer bt" href="{{url('/admin/deleteTehsil/')}}/{{$Tehsil->id}}" onclick="return confirm('Are you sure you want to delete ?')">
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
				<h5 class="modal-title" id="exampleModalLabel">Update Tehsil Name</h5>
				<button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>

			</div>
			<form action="{{ route('updateTehsil') }}" class="needs-validation" method="post" autocomplete="off">
				@csrf
				<div class="modal-body">
					<div class="row">
						<div class="col-md-6">
							<div class="form-group">
								<label for="name">Tehsil Name</label>
								<input type="hidden" class="form-control" id="Tehsil_id" name="id">
								<input type="text" class="form-control alphanumeric" id="Tehsil_name" name="Tehsil_name" required>
								<div class="invalid-feedback">
									Please provide Tehsil.
								</div>
								@if ($errors->has('Tehsil_name'))
								<span class="error_mess">{{ $errors->first('Tehsil_name') }}</span> @endif
							</div>
						</div>

					</div>
				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
					<button class="btn btn-primary" type="submit">Submit/दर्ज करे</button>
				</div>
			</form>
		</div>
	</div>
</div>

@push( 'custom-scripts' )
	<script type="text/javascript">
		//update==========================
		$( '.role_manager_id' ).click( function () {
			var Tehsil_id = $( this ).data( 'id' );
			var Tehsil_status = $( this ).data( 'Tehsil_status' );
			var Tehsil_name = $( this ).data( 'name' );
			$( '#Tehsil_id' ).val( Tehsil_id );
			$( '#Tehsil_name' ).val( Tehsil_name );
			$( '#Tehsil_status' ).val( Tehsil_status );
		} );

		//change Tehsil status
		function TehsilStatus( id ) {
			$.ajax( {
				type: "GET",
				url: ajaxUrl + "/admin/TehsilStatus/" + id,
				dataType: "text",
				success: function ( res ) {
					success( res.msg );
					 window.location.href = "admin/create-Tehsil";
				},
			});
		}

		//Delete Hostel Tehsil
		function deleteTehsil( id ) {
			Swal.fire( {
				title: "Are you sure?",
				text: "You won't be able to revert this!",
				icon: "warning",
				showCancelButton: true,
				confirmButtonColor: "#3085d6",
				cancelButtonColor: "#d33",
				confirmButtonText: "Yes, delete it!",
			} ).then( ( result ) => {
				if ( result.isConfirmed ) {
					$.ajax( {
						type: "GET",
						url: ajaxUrl + "/deleteTehsil/" + id,
						dataType: "json",
						success: function ( res ) {
							success( res.msg );
							$( "#responsive" ).load( " #responsive" );
							tableRendor();
						},
					} );
				}
			} );
		}
	</script>
	<script type="text/javascript" src="{{ asset('js/xlsx.full.min.js') }}"></script>
	<script>
	    function ExportToExcel(type, fn, dl) {
	       var elt = document.getElementById('dataTable');
	       var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });

	       return dl ?
	         XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }):
	         XLSX.writeFile(wb, fn || ('Tehsil Manager List.' + (type || 'xlsx')));
	    }
	</script>

@endpush
