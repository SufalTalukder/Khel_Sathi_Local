@extends( 'layouts/admin_layout' )
@section( 'content' )

<div class="pageheader" id="menu-margin">
	<h4 class="mb-0">Create Eklavya Competition
	</h4>
</div>
<div class="card">
	<div class="card-body">
		<form action="{{ asset('assets_admin/eklavya_competition') }}" class="needs-validation " id="reload" novalidate method="post">
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label for="name">Eklavya Competition</label>
						<input type="text" class="form-control alphanumeric" id="name" name="name" required>
						<div class="invalid-feedback">
							Please provide a Eklavya Competition name.
						</div>
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group d-grid">
						<label>&nbsp;</label>
						<button class="btn btn-primary" type="submit">Submit/दर्ज करे</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>
<div class="pageheader" id="menu-margin">
	<h4 class="mb-0">State List
		<a title="State List" class="btn btn-sm btn-success float-end alphanumeric" onclick="ExportToExcel('xlsx')"><i class="fa fa-file-excel"></i> Export to Excel
		</a>
	</h4>
</div>
<div class="card">
	<div class="card-body">
		<div class="">
			<div class="table-responsive">
				<table id="dataTable" class="table table-bordred table-hover bg-white datatable">
					<thead>
						<tr>
							<th style="width: 5%;">S.No.</th>
							<th>Competition Name</th>
							<th style="width: 8%;" class="text-center">Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach($eklavya_competition as $key=>$item)
						<tr>
							<td>{{ $key+1 }}</td>
							<td>{{ $item->name }}</td>
							<td></td>
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
	function showButton(id) {
		$(".state" + id).show();
		$(".stateup" + id).hide();
	}
</script>


@push( 'custom-scripts' )
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
			XLSX.writeFile(wb, fn || ('State List.' + (type || 'xlsx')));
	}
</script>
@endpush
