@extends( 'layouts/admin_layout' )
@section( 'content' )

<div class="pageheader row" id="menu-margin">
	<div class="col-md-10">

		<h4>SMS Template List </h4>
	</div>
	<div class="col-md-2">
		<a href="{{ route('sms_template') }}" class="w-100 mb-0 btn btn-primary btn-sm ">
					<i class="fas fa-plus"></i>Add SMS Template
				</a>
	</div>
</div>



<div class="card">
	<div class="card-body">


		<div class="table-responsive">
			<table id="dataTable" class="table table-bordred table-hover bg-white datatable">
				<thead>
					<tr>
						<th>S.No.</th>
						<th>TEMPLATE ID</th>
						<th>TEMPLATE NAME</th>
						<th>CONTENT</th>
						<th>CREATED AT</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($sms_templates as $key=>$item)
					<tr>

						<td>{{ $key+1 }}</td>
						<td>{{ $item->template_id }}</td>
						<td>{{ $item->template_name }}</td>
						<td>{!! $item->content !!}</td>
						<td>{{ dmyHi($item->created_at)}}</td>
						<td>
							@if($item->lock_status == 0)
							<a class="btn btn-sm btn-dark pointer bt" href="{{ route('editSmsTemplate' , $item->id) }}">
												<i class="fa fa-edit"></i>
											</a>
						
							<a class="btn btn-sm btn-danger pointer bt" href="{{ route('deleteSmsTemplate' , $item->id) }}" onclick="return confirm('Are you sure you want to Delete ?')">
												<i class="fa fa-trash-o"></i>
											</a>
						
							<a class="btn btn-sm btn-danger pointer bt" href="{{ route('lockSmsTemplate' , $item->id) }}" onclick="return confirm('Are you sure you want to Lock ?')">
												<i class="fas fa-lock-open"></i>
											</a>
							@else
							<button class="btn btn-danger"><i class="fas fa-lock" style="width: 15px;" ></i></button> @endif
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>



	</div>
</div>


@endsection

@push( 'custom-scripts' )
	<script type="text/javascript" src="{{ asset('js/xlsx.full.min.js') }}"></script>
<script>
	function ExportToExcel( type, fn, dl ) {
		var elt = document.getElementById( 'dataTable' );
		var wb = XLSX.utils.table_to_book( elt, {
			sheet: "sheet1"
		} );
		return dl ?
			XLSX.write( wb, {
				bookType: type,
				bookSST: true,
				type: 'base64'
			} ) :
			XLSX.writeFile( wb, fn || ( 'UserList.' + ( type || 'xlsx' ) ) );
	}
</script>
@endpush
