@extends( 'layouts/admin_layout' )
@section( 'content' )

<div class="pageheader" id="menu-margin">
	<h4 class="mb-0">User Access Details <a title="User Access Details" class="btn btn-sm btn-success float-end" onclick="ExportToExcel('xlsx')">
			<i class="fa fa-file-excel"></i> Export to Excel
		</a>
	</h4>
</div>
<div class="row">
	<div class="col-md-12">
		<div class="card">
			<div class="card-body">
				<div class="table-responsive">
					<table id="dataTable" class="table table-bordered datatable v-align">
						<thead class="bg-info text-white">
							<tr>
								<th valign="top">S.No.</th>
								<th valign="top">User</th>
								<th valign="top">Modules</th>
								<th valign="top">Pages</th>
								<th valign="top">Updated By</th>
								<th valign="top">Updated Date</th>
							</tr>
						</thead>
						<tbody>
							<?php $i = 1; ?> @foreach($data as $key=>$value_arr)
							<tr>
								<td>{{ $i }}</td>
								<td>{{ $key }}</td>
								<td>
									@foreach($value_arr as $modules)
									<p style="height:<?php echo (count($modules['pages']) * 30); ?>px;display: block;"> {{ $modules['module_name'] }} </p>
									@endforeach
								</td>
								<td>
									<ul class="tablisting">
										@foreach($value_arr as $modules) @foreach($modules['pages'] as $page)

										<li> <span>@if(isset($page)){{ $page->page_name }} @endif</span></li>
										@endforeach @endforeach
									</ul>
								</td>
								<td>
									@foreach($value_arr as $modules)
									<span style="height:<?php echo (count($modules['pages']) * 30); ?>px;display: block;"> {{ $modules['updated_by'] }} </span><br> @endforeach
								</td>
								<td>
									@foreach($value_arr as $modules)
									<span style="height:<?php echo (count($modules['pages']) * 30); ?>px;display: block;"> {{ date('d-m-Y h:s A',strtotime($modules['dor'])) }} </span><br> @endforeach
								</td>
							</tr>
							<?php $i++;  ?> @endforeach

						</tbody>
					</table>
				</div>
			</div>
		</div>
	</div>


</div>


@endsection


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
			XLSX.writeFile(wb, fn || ('User Access Details.' + (type || 'xlsx')));
	}
</script>
@endpush
