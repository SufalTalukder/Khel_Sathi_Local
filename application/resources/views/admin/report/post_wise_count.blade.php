@extends( 'layouts/admin_layout' )
@section( 'content' )


		<div class="pageheader" id="menu-margin">
			<h4 class="mb-0">Post Wise Count</h4>
		</div>
		
		<div class="card">
		<div class="pageheader" >
				<a title="State List" class="btn btn-sm btn-success float-end" onclick="ExportToExcel('xlsx')"><i class="fa fa-file-excel"></i> Export to Excel 
                 </a>	
		</div>


			<div class="card-body">
				<div class="">
								<div class="table-responsive">
						<table  id="dataTable" class="table table-bordred table-hover bg-white datatable" >
							<thead>
								<tr>
									<th>S.No.</th>
									<th>Post Name</th>
									<th>Male</th>
									<th>Female</th>
									<th>Forwarded By Examination Committee</th>
									<th>Forwarded By Recruitment Authority</th>
									<th>Total</th>
								</tr>
							</thead>
							<tbody>
								@foreach($post_count as $key=>$item)
								<tr>
									<td>{{ $key+1 }}</td>
									<td>{{ $item->post_name }}</td>
									<td><a href="{{ route('direct_rect_spe',$item->id) }}/11">{{ $item->Male }}</a></td>
									<td><a href="{{ route('direct_rect_spe',$item->id) }}/12">{{ $item->Female }}</a></td>
									<td><a href="{{ route('direct_rect_spe',$item->id) }}/13">{{ $item->is_forwarded_by_examination }}</a></td>
									<td><a href="{{ route('direct_rect_spe',$item->id) }}/14">{{ $item->is_forwarded_by_comiittee }}</a></td>
									<td><a href="{{ route('direct_rect_spe',$item->id) }}/15">{{ $item->total }}</a></td>
									
								</tr>
								@endforeach
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	

@endsection

<script type="text/javascript">
	function showButton( id ) {
		$( ".state" + id ).show();
		$( ".stateup" + id ).hide();
	}
</script>


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
			XLSX.writeFile( wb, fn || ( 'Post Wise Count List.' + ( type || 'xlsx' ) ) );
	}
</script>
@endpush
