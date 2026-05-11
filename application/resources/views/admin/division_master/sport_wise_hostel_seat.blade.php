@extends( 'layouts/admin_layout' )
@section( 'content' )

<div class="row">

	<div class="col-md-12">

		<div class="pageheader" id="menu-margin">
			<h4 class="mb-0">Sports wise Hostel Seat</h4>
		</div>
		<div class="card mb-3">

			<div class="card-body">
				<form action="{{ route('sport_wise_hostel_seat_store') }}" class="needs-validation" method="post" novalidate>
					@csrf
					<div class="row">
						<div class="col-md-3">
							<div class="form-group">
								<label for="name">Sport Name *</label>
								<select class="form-control" name="sport_id" required>
									<option  value="">Select Sport</option>
                                         @foreach ($sports as $sport)
                                         <option value="{{ $sport->id }}">{{ $sport->name }}</option>
                                         @endforeach
								</select>
                                @if ($errors->has('sport_id'))
								<span class="error_mess">{{ $errors->first('sport_id') }}</span> @endif
							</div>
						</div>
						<div class="col-md-3">
							<div class="form-group">
								<label for="name">Hostel Seat (District)*</label>
                                <input type="number" min="0" class="form-control" id="hostel_seat_district" name="hostel_seat_district" value="{{ old('hostel_seat_district') }}" placeholder="Hostel Seat" required>

							</div>
							@if ($errors->has('hostel_seat_district'))
							<span class="error_mess">{{ $errors->first('hostel_seat_district') }}</span> @endif
						</div>

                        <div class="col-md-3">
							<div class="form-group">
								<label for="name">Hostel Seat (Division)*</label>
                                <input type="number" min="0" class="form-control" id="hostel_seat_division" name="hostel_seat_division" value="{{ old('hostel_seat_division') }}" placeholder="Hostel Seat" required>

							</div>
							@if ($errors->has('hostel_seat_division'))
							<span class="error_mess">{{ $errors->first('hostel_seat_division') }}</span> @endif
						</div>
						<div class="col-md-2 d-grid">
							<label class="form-label">&nbsp;</label>
							<button class="btn btn-primary form-group" type="submit">Submit/दर्ज करे</button>


						</div>

					</div>

				</form>


		</div>
	</div>



	<div class="col-md-12">
		<div class="pageheader" id="menu-margin">
			<h4 class="mb-0">Sport List<a  title="Sport List" class="btn btn-sm btn-success float-end" onclick="ExportToExcel('xlsx')">
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
								<th class="text-center">Seat (District) </th>
                                <th class="text-center">Seat (Division) </th>
                                <th class="text-center">Action</th>
                                <th >Created At </th>

							</tr>
						</thead>
						<tbody>
                            @foreach ($sportswiseseat as $key=>$item)
                                <tr>
                                <td>
                                {{ $key + 1 }}
                                </td >
                                <td >
                                {{ sport_name($item->sport_id)}}
                                </td>
                                <td class="text-center">
                                    {{ $item->hostel_seat_district}}
                                </td>
                                <td class="text-center">
                                    {{ $item->hostel_seat_division}}
                                </td>
                                <td class="text-center">
									<a class="btn btn-sm btn-dark pointer bt role_manager_id" href="javascript:void(0)" data-toggle="modal" data-target="#exampleModal" data-id="{{$item->id}}" data-distseat="{{ $item->hostel_seat_district}}" data-divseat="{{ $item->hostel_seat_division}}" data-sport="{{$item->sport_id}}">
                                                        <i class="far fa-edit"></i>
                                                    </a>
								</td>
                                <td >
                                    {{ dmy($item->created_at)}}
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
			<form action="{{ route('sport_wise_hostel_seat_update') }}" class="needs-validation" method="post" autocomplete="off">
				@csrf
				<div class="modal-body">
					<div class="form-group">
						<label for="name">Sport Name</label>
                        <input type="hidden" class="form-control" id="sid" name="id">

						<select class="form-control" name="sport_id" id="sport_id" required>
                            <option  value="">Select Sport</option>
                                 @foreach ($sports as $sport)
                                 <option value="{{ $sport->id }}">{{ $sport->name }}</option>
                                 @endforeach
                        </select>

						@if ($errors->has('sport_id'))
						<span class="error_mess">{{ $errors->first('sport_id') }}</span> @endif
					</div>
                    <div class="form-group">
						<label for="name">Hostel Seat (District)*</label>
                        <input type="number" min="0" class="form-control" id="hostel_seat_district" name="hostel_seat_district" value="{{ old('hostel_seat_district') }}" placeholder="Hostel Seat" required>


						@if ($errors->has('hostel_seat_district'))
						<span class="error_mess">{{ $errors->first('hostel_seat_district') }}</span> @endif
					</div>
                    <div class="form-group">
						<label for="name">Hostel Seat (Division)*</label>
                        <input type="number" min="0" class="form-control" id="hostel_seat_division" name="hostel_seat_division" value="{{ old('hostel_seat_division') }}" placeholder="Hostel Seat" required>


						@if ($errors->has('hostel_seat_division'))
						<span class="error_mess">{{ $errors->first('hostel_seat_division') }}</span> @endif
					</div>



				</div>
				<div class="modal-footer">

					<button type="button" class="btn btn-secondary" onclick="reloadContainer()" data-dismiss="modal">Close</button>
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
		var wrapper = $( ".container2" );
		var id = $( this ).data( 'id' );
		var distseat = $( this ).data( 'distseat' );
        var divseat = $( this ).data( 'divseat' );
        var sport = $( this ).data( 'sport' );

		$( '#hostel_seat_district' ).val( distseat );
		$( '#hostel_seat_division' ).val( divseat );
        $( '#sport_id' ).val( sport );
        $( '#sid' ).val( id );

		$( wrapper ).on( "click", ".delete", function ( e ) {
			e.preventDefault();
			$( this ).parent( 'div' ).remove();

		} );

	} );


	function reloadContainer() {

		window.location.href = "admin/sport_wise_hostel_seat_master";
	}

	//change sport status
	function sportStatus( id ) {
		$.ajax( {
			type: "GET",
			url: ajaxUrl + "/admin/sportStatus/" + id,
			dataType: "text",
			success: function ( res ) {
				success( res.msg );
				window.location.href = "admin/sport_wise_hostel_seat_master";

			},
		} );
	}




	var wrapper = $( ".container1" );
	var add_button = $( ".add_form_field" );


	$( add_button ).click( function ( e ) {
		$( wrapper ).append( '<div class="d-flex gap-4 mb-3"><input type="text" class="form-control col-md-12"  name="sub_type[]" value="{{ old('
			sub_type ') }}" placeholder="Enter Sub Sport Type" required><a href="#" class="btn btn-danger delete" >Delete</a></div> ' ); //add input box

	} );

	$( wrapper ).on( "click", ".delete", function ( e ) {
		e.preventDefault();
		$( this ).parent( 'div' ).remove();

	} );
</script>
<script type="text/javascript" src="{{ asset('js/xlsx.full.min.js') }}"></script>
<script>
	function ExportToExcel( type, fn, dl ) {
		var elt = document.getElementById( 'dataTable' );
		var wb = XLSX.utils.table_to_book( elt, {
			sheet: "sheet1"
		} );
		const ws = XLSX.WorkSheet = XLSX.utils.table_to_sheet( document.getElementById( 'dataTable' ) );
		ws[ '!cols' ] = [];
		ws[ '!cols' ][ 0 ] = {
			hidden: true
		};
		return dl ?
			XLSX.write( ws, {
				bookType: type,
				bookSST: true,
				type: 'base64'
			} ) :
			XLSX.writeFile( wb, fn || ( 'Sport wise hostel Seat.' + ( type || 'xlsx' ) ) );
	}
</script>
@endpush
