@extends( 'layouts/admin_layout' )
@section( 'content' )

			<div class="row">

				<div class="col-md-12">

					<div class="pageheader" id="menu-margin">
						<h4 class="mb-0">@if(isset($psection)) Edit @else Create @endif Section </h4>
					</div>
					<div class="card mb-3">

						<div class="card-body">
							<form action="{{ route('saveSection') }}" id="inventory" class="needs-validation" method="post" autocomplete="off" novalidate>
								<div class="row">
									@if(isset($psection))
									<input type="hidden" name="id" value="{{ $psection->id }}"> @endif
									<div class="col-md-4">
										<div class="form-group">
											<label for="name">1) Section Name (in Hindi) <span class="text-danger">*</span></label>
											<input type="text" class="form-control" id="hn_section_name" name="hn_section_name" @if(isset($psection)) value="{{ $psection->name_hn }}" @else value="{{ old('hn_section_name') }}" @endif placeholder="Enter Section Name (in Hindi)" required="">
											<div class="invalid-feedback">
												Please provide Section Name (in Hindi).
											</div>
											@if ($errors->has('hn_section_name'))
											<span class="error_mess">{{ $errors->first('hn_section_name') }}</span> @endif
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label for="name">2) Section Name (in English) <span class="text-danger">*</span></label>
											<input type="text" class="form-control" id="en_section_name" name="en_section_name" @if(isset($psection)) value="{{ $psection->name_en }}" @else value="{{ old('en_section_name') }}" @endif placeholder="Enter Section Name (in English)" required="">
											<div class="invalid-feedback">
												Please provide Section Name (in English).
											</div>
											@if ($errors->has('en_section_name'))
											<span class="error_mess">{{ $errors->first('en_section_name') }}</span> @endif
										</div>
									</div>
									<div class="col-md-4">
										<div class="form-group">
											<label for="name">Status <span class="text-danger">*</span></label>
											<select class="form-control" name="status" value="{{ old('status') }}" required="">
												<option selected="" disabled="" value="">Select Status</option>
												<option @if(isset($psection) && $psection->status==1) selected @endif value="1">Enable</option>
												<option @if(isset($psection) && $psection->status==0) selected @endif value="0">Disable</option>
											</select>
											<div class="invalid-feedback">
												Please Select status.
											</div>
											@if ($errors->has('status'))
											<span class="error_mess">{{ $errors->first('status') }}</span> @endif
										</div>

									</div>
									<div class="col-md-2 d-grid">
										<label class="form-label">&nbsp;</label>
										<button class="btn btn-primary form-group btn-sm" type="submit">@if(isset($psection)) Update @else Submit @endif</button>
									</div>
									<div class="col-md-2 d-grid">
										<label class="form-label">&nbsp;</label>
										<button type="reset" class="btn btn-danger form-group btn-sm">Reset</button>
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
									<a title="Division Manager List" class="btn btn-sm btn-success float-end" onclick="ExportToExcel('xlsx')">
			                            <i class="fa fa-file-excel"></i> Export to Excel
			                        </a>
								
									<h5>Section Master List</h5>
								</div>
							</div>
						</div>
						<div class="card-body">
							<div class="">
								<div class="table-responsive">
									<table id="dataTable" class="table table-bordred table-hover bg-white datatable">
										<thead>
											<tr>
												<th width="6%">S.No.</th>
												<th width="20%">Section Name (in Hindi)</th>
												<th width="20%">Section Name (in English)</th>
												<th  width="10%">Added By</th>
												<th class="text-center">Status</th>
												<th class="text-center">Action</th>
											</tr>
										</thead>
										<tbody>
											@foreach($section as $key=>$section)
											<tr>

												<td>{{ $key+1 }}</td>
												<td>{{ $section->name_hn }}</td>
												<td>{{ $section->name_en }}</td>
												<td>{{ rsoName($section->added_by) }}</td>
												<td class="text-center">
													@if ($section->status == 1) Enable @else Disable @endif
												</td>
												<td class="text-center">
													<a class="btn btn-sm btn-dark pointer bt" href="{{ route('editSection' , $section->id) }}">
													<i class="fa fa-edit"></i>
												</a>
												
													<a class="btn btn-sm btn-danger pointer bt" href="{{ route('deleteSection' , $section->id) }}" onclick="return confirm('Are you sure you want to delete ?')">
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
			XLSX.writeFile( wb, fn || ( 'Section Master List.' + ( type || 'xlsx' ) ) );
	}
</script>

@endpush
