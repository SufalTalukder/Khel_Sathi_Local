@extends('layouts/admin_layout')
@section('content')


<div class="pageheader" id="menu-margin">
	<h4 class="mb-0">Module List
		<a href="{{ route('moduleForm') }}" class="btn btn-primary btn-sm float-end">
			<i class="fas fa-plus"></i>
			&nbsp;&nbsp;Add Module
		</a>
		<a title="Module List" class="btn btn-sm btn-success float-end" onclick="ExportToExcel('xlsx')">
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
						<th>S.No.</th>
						<th>Module Name</th>
						<th>Module URL</th>
						<th>Menu Order</th>
						<th>Is Menu</th>
						<!-- <th>Status</th> -->
						<th class="text-center">Action</th>
						<th class="text-center">Edit</th>
					</tr>
				</thead>
				<tbody>
					@foreach($module as $key=>$item)
					<tr>

						<td>{{ $key+1 }}</td>
						<td>{{ $item->module_name }}</td>
						<td>{{ $item->module_url }}</td>
						<td>{{ $item->menu_order }}</td>
						<td>{{ $item->is_menu==1?'Yes':'No' }}</td>
						<!-- <td>{{ $item->module_status==0?'Active':'Active' }}</td> -->

						<td class="text-center" width="20%">
							<div class="btn-group">
								@if($item->module_status==0)
								<div class="form-control2">
									<label class="switch">
										<input type="checkbox" id="themeskin{{ $key+1 }}">
										<div class="slider round" onclick="moduleStatus('{{$item->id}}')">
											<span class="off">Inactive</span>
											<span class="on">Active</span>
										</div>
									</label>
								</div>
								@else
								<div class="form-control2">
									<label class="switch">
										<input type="checkbox" id="themeskin{{ $key+1 }}" checked>
										<div class="slider round" onclick="moduleStatus('{{$item->id}}')">
											<span class="off">Inactive</span>
											<span class="on">Active</span>
										</div>
									</label>
								</div>
								@endif


							</div>
						</td>
						<td>
							<a class="btn btn-sm btn-dark pointer bt" href="{{ route('editModule' , $item->id) }}">
								<i class="fa fa-edit"></i>
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
		var wb = XLSX.utils.table_to_book(elt, {
			sheet: "sheet1"
		});
		return dl ?
			XLSX.write(wb, {
				bookType: type,
				bookSST: true,
				type: 'base64'
			}) :
			XLSX.writeFile(wb, fn || ('UserList.' + (type || 'xlsx')));
	}
</script>
@endpush
