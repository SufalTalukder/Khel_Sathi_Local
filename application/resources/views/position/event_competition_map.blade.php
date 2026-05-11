@extends( 'layouts/admin_layout' )
@section( 'content' )

<div class="row">
	<div class="col-md-12">
		<div class="pageheader" id="menu-margin">
			<h4 class="mb-0">Competition Event Map</h4>
		</div>
		<div class="card mb-3">
			<div class="card-body">
				<form action="{{ asset('assets_admin/mapCompEvent') }}" class="needs-validation" id="inventory" method="post" autocomplete="off">
					@csrf
					<div class="row">
						<div class="col-md-4">
							<div class="form-group">
								<label for="name">Competition Name <span class="text-danger">*</span></label>
								<select class="form-select" name="comp_name" value="{{ old('status') }}" required="">
									<option value="">--select--</option>
									@foreach($position_comp as $item)
									<option value="{{$item->id}}">{{$item->name}}</option>
									@endforeach
								</select>
								<div class="invalid-feedback">
									Please provide Competition Name.
								</div>
								@if ($errors->has('comp_name'))
								<span class="error_mess">{{ $errors->first('comp_name') }}</span> @endif
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="name">Event Name <span class="text-danger">*</span></label>
								<select class="form-select" name="event_name" value="{{ old('status') }}" required="">
									<option value="">--select--</option>
									@foreach($position_event as $item)
									<option value="{{$item->id}}">{{$item->name}}</option>
									@endforeach
								</select>
								<div class="invalid-feedback">
									Please provide Event Name.
								</div>
								@if ($errors->has('event_name'))
								<span class="error_mess">{{ $errors->first('event_name') }}</span> @endif
							</div>
						</div>
						<div class="col-md-4">
							<div class="form-group">
								<label for="name">Event Type <span class="text-danger">*</span></label>
								<select class="form-select" name="event_type" required="">
									<option selected="" disabled="" value="">--select--</option>
									<option value="1">Individual</option>
									<option value="2">Team</option>
									<option value="3">Both</option>
								</select>
							</div>
							@if ($errors->has('event_type'))
							<span class="error_mess">{{ $errors->first('event_type') }}</span> @endif
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
			<h4 class="mb-0">Competition Event Map List <a title="Division Manager List" class="btn btn-sm btn-success float-end" onclick="ExportToExcel('xlsx')"><i class="fa fa-file-excel"></i> Export to Excel
				</a></h4>
		</div>
		<div class="card">
			<div class="card-body">
				<div class="">
					<div class="table-responsive">
						<table id="dataTable" class="table table-bordred table-hover bg-white datatable">
							<thead>
								<tr>
									<th width="6%">S.No.</th>
									<th>Competition</th>
									<th>Event Name</th>
									<th>Event Type</th>
									<th width="8%" class="text-center">Delete</th>
								</tr>
							</thead>
							<tbody>
								@foreach($event_competition_master as $key=>$item)
								<tr>
									<td>{{ $key+1 }}</td>
									<td>{{ $item->comp }}</td>
									<td>{{ $item->event }}</td>
									<td>@if($item->event_type==1)Individual @elseif($item->event_type==2)Individual @else Both @endif</td>
									<td class="text-center">
										<a class="btn btn-sm btn-danger px-2 pointer bt" href="{{url('/admin/deleteComEvent/')}}/{{$item->id}}" onclick="return confirm('Are you sure you want to delete ?')">
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
			XLSX.writeFile(wb, fn || ('Division Manager List.' + (type || 'xlsx')));
	}
</script>

@endpush
