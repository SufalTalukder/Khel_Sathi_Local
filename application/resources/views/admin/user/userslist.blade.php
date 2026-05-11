@extends( 'layouts/admin_layout' )
@section( 'content' )

<div class="pageheader" id="menu-margin">
	<h4 class="mb-0">User List
		<a href="{{route('user_manager_add')}}" class="btn btn-primary btn-sm float-end">Add User</a>
		<a title="User List" class="btn btn-sm btn-success float-end" onclick="ExportToExcel('xlsx')">
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
						<th width="20%">Role</th>
						<th width="20%">Name</th>
						<th width="20%">User Name</th>
						<th width="20%">Email Id</th>
						<th width="20%">Phone</th>
						<th width="20%">Designation</th>
						<th class="text-center">Status</th>
						<th class="text-center">Login Detail</th>
						<th class="text-center">Edit</th>
						<th class="text-center">Delete</th>
					</tr>
				</thead>
				<tbody>
					@foreach($users as $key=>$item)
					<tr>
						<td>{{ $key+1 }}</td>
						<td>{{ roleName($item->admin_role) }}</td>
						<td>{{ $item->name }}</td>
						<td>{{ $item->username }}</td>
						<td>{{ $item->email }}</td>
						<td>{{ $item->mobile }}</td>
						<td>{{ $item->designation }}</td>
						<td class="text-center">
							<div class="form-control2">
								<label class="switch">
									<input type="checkbox" id="themeskin{{ $key+1 }}" <?php if ($item->status == 1) {
																							echo "checked";
																						} elseif ($item->status == 0) {
																							echo "";
																						} else {
																							echo "checked";
																						} ?>>
									<div class="slider round" onclick="userManagerStatus('{{$item->id}}')">
										<span class="off">Disable</span>
										<span class="on">Enable</span>
									</div>
								</label>
							</div>
						</td>
						<td class="text-center">
							<a class="btn btn-sm btn-primary pointer bt" href="{{ route('logDetail',$item->id) }}">
								<i class="fa fa-eye"></i>
							</a>
						</td>
						<td class="text-center">
							<a class="btn btn-sm btn-dark pointer bt" href="{{ route('edituser',$item->id) }}">
								<i class="fa fa-edit"></i>
							</a>
						</td>
						<td class="text-center">
							<a class="btn btn-sm btn-danger pointer bt px-2" href="{{url('/admin/deleteUser')}}/{{$item->id}}" onclick="return confirm('Are you sure you want to delete ?')">
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
