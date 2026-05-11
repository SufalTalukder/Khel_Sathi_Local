@extends( 'layouts/admin_layout' )
@section( 'content' )

			<div class="row">

				<div class="col-md-12">

					<div class="pageheader" id="menu-margin">
						<h4 class="mb-0">@if(isset($punit)) Edit @else Create @endif Item Measurement Unit</h4>
					</div>
					<div class="card mb-3">

						<div class="card-body">
							<form action="{{ route('saveUnit') }}" id="inventory" class="needs-validation" method="post" autocomplete="off" novalidate>
								<div class="row">
									@if(isset($punit)) 
									<input type="hidden" name="id" value="{{ $punit->id }}">
									@endif
									<div class="col-md-4">
										<div class="form-group">
											<label for="name">Measurement Unit <span class="text-danger">*</span></label>
											<input type="text" class="form-control" id="name" name="name" @if(isset($punit)) value="{{ $punit->name }}" @else  value="{{ old('name') }}" @endif placeholder="Enter Measurement Unit" required="">
											<div class="invalid-feedback">
												Please provide Measurement Unit.
											</div>
											@if ($errors->has('name'))
											<span class="error_mess">{{ $errors->first('name') }}</span> @endif
										</div>
									</div>
									<div class="col-md-2 d-grid">
										<label class="form-label">&nbsp;</label>
										<button class="btn btn-primary form-group btn-sm" type="submit">@if(isset($punit)) Update @else Submit @endif</button>
									</div>
									<div class="col-md-2 d-grid">
										<label class="form-label">&nbsp;</label>
										<button type="reset" class="btn btn-danger btn-sm">Reset</button>
									</div>
								</div>
							</form>
						</div>
					</div>
				</div>


				<div class="col-md-12">
					<div class="card">
						<div class="card-header">
							<div class="row">
								<div class="col-md-12">
									 <a  title="Division Manager List" class="btn btn-sm btn-success float-end" onclick="ExportToExcel('xlsx')">
			                            <i class="fa fa-file-excel"></i> Export to Excel
			                        </a>
									<h5> Item Measurement Unit Master List</h5>
								</div>
							</div>
						</div>
						<div class="card-body">
							<div class="">
								<div class="table-responsive">
									<table  id="dataTable" class="table table-bordred table-hover bg-white datatable" >
										<thead>
											<tr>
												<th width="6%">S.No.</th>
												<th width="20%">Measurement Unit</th>
												<th  width="10%">Added By</th>
												<th class="text-center">Action</th>
											</tr>
										</thead>
										<tbody>
											@foreach($unit as $key=>$unit)
											<tr>

												<td>{{ $key+1 }}</td>
												<td>{{ $unit->name }}</td>
												<td>{{ rsoName($unit->added_by) }}</td>
												<td class="text-center">
												<a class="btn btn-sm btn-dark pointer bt" href="{{ route('editUnit' , $unit->id) }}">
													<i class="fa fa-edit"></i>
												</a>
												<a class="btn btn-sm btn-danger pointer bt"
													href="{{ route('deleteUnit' , $unit->id) }}" 
													onclick="return confirm('Are you sure you want to delete ?')">
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
	       var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
	     
	       return dl ?
	         XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }):
	         XLSX.writeFile(wb, fn || ('Item Measurement Unit Master List.' + (type || 'xlsx')));
	    }
	</script> 

@endpush
