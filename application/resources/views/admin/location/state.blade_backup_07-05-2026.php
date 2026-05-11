@extends( 'layouts/admin_layout' )
@section( 'content' )

<div class="pageheader" id="menu-margin">
	<h4 class="mb-0">Create State
	</h4>
</div>
<div class="card">
	<div class="card-body">
		<form action="{{ asset('assets_admin/addState') }}" class="needs-validation " id="reload" novalidate method="post">
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label for="name">State</label>
						<input type="text" class="form-control alphanumeric" id="name" name="name" required>
						<div class="invalid-feedback">
							Please provide a state name.
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
							<th>State Name</th>
							<th style="width: 10%;" class="text-center">Status</th>
							<th style="width: 8%;" class="text-center">Action</th>
						</tr>
					</thead>
					<tbody>
						@foreach($states as $key=>$item)
						<tr>
							<td>{{ $key+1 }}</td>
							<td>
								<span id="stateup{{$item->id}}" class="stateup{{$item->id}}">{{ $item->name }}</span>
								<input style="display:none;" type="email" class="form-control state{{$item->id}} alphanumeric" id="state{{$item->id}}" value="{{ $item->name }}">
							</td>
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
										<div class="slider round" onclick="stateStatus('{{$item->id}}')">
											<?php if ($item->status == 1) {
												echo "<span class='on'>Enable</span>";
											}
											if ($item->status == 0) {
												echo "<span class='off'>Disable</span>";
											}  ?>
										</div>
									</label>
								</div>
							</td>
							<td class="text-center">
								<a class="btn btn-sm btn-dark stateup{{$item->id}}" href="javascript:void(0)" onclick="showButton('{{$item->id}}')">
									<i class="far fa-edit"></i>
								</a>
								<a style="display:none;" class="btn btn-sm btn-info state{{$item->id}}" href="javascript:void(0)" onclick="updateState('{{$item->id}}')">
									Update
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
