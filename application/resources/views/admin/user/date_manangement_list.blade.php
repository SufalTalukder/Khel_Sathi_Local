@extends( 'layouts/admin_layout' )
@section( 'content' )


		<div class="pageheader" id="menu-margin">
			<h4 class="mb-0">Date Management
				<a href="{{route('dateManangementAdd')}}" class="btn btn-primary btn-sm float-end" >Add Record</a>
				  <a  title="Date Management" class="btn btn-sm btn-success float-end" onclick="ExportToExcel('xlsx')">
			                            <i class="fa fa-file-excel"></i> Export to Excel
			                        </a>
					</h4>
		</div>
		<div class="card">
		<div class="card-body">
		<div class="table-responsive">
			<table  id="dataTable" class="table table-bordred table-hover bg-white datatable" >
				<thead>
					<tr>
						<th>S.No.</th>
						<th>Form Name</th>
						<th>Start Date</th>
						<th>End Date</th>
						<th>Action</th>
					</tr>
				</thead>
				<tbody>
					@foreach($date_list as $key=>$item)
					<tr>
						<td>{{ $key+1 }}</td>
						<td>{{ $item->name }}</td>
						<td>{{ dmy($item->start_date) }}</td>
						<td>{{ dmy($item->end_date) }}</td>
						<td><a href="{{ route('editDateMmanangement',$item->id) }}" class="btn btn-primary btn-xs btn-block">
							<i class="fas fa-edit"></i>
							</a>
							<a href="{{ route('editDateMmanangement',$item->id) }}" class="btn btn-primary btn-xs btn-block">
							<i class="fas fa-eye"></i>
							</a>
						</td>
					</tr>
					@endforeach
				</tbody>
			</table>
		</div>
		</div>
		</div>
	

@endsection

@push('custom-scripts')
<script type="text/javascript" src="{{ asset('js/xlsx.full.min.js') }}"></script>
<script>
    function ExportToExcel(type, fn, dl) {
       var elt = document.getElementById('dataTable');
       var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
       return dl ?
         XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }):
         XLSX.writeFile(wb, fn || ('Post Manager.' + (type || 'xlsx')));
    }
</script> 
@endpush
