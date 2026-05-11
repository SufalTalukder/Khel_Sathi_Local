@extends( 'layouts/admin_layout' )
@section( 'content' )
<style>
	.dn {
		display: none;
	}
</style>

<div class="row">
	<div class="col-12">
		<div class="pageheader" id="menu-margin">
			<h4 class="mb-0">
				स्पोर्ट्स इन्फ्रास्ट्रक्चर फॉर्म
				<a title="Print" class="btn btn btn-outline-success float-end" data-print="modal" onclick="PrintDoc()"><i class="icons icon-printer"></i> प्रिंट</a>
			</h4>
		</div>
	</div>
	<div class="col-12">
		<div class="bhoechie-tab-container">
			<div class="row">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bhoechie-tab">
					<div class="bhoechie-tab-content active">
						<div class="form-scroll">
							<div class="nano-content">
								<div class="row">
									<form method="POST" action="{{url('admin/information/infrastructure_list_filter')}}">
										@csrf
										<div class="row mb-3">
											<div class="col-md-3">
												<div class="form-group">
													<label for="division_filter">मण्डल</label>
													<select class="form-select" name="division_id">
														<option value="">--All--</option>
														@foreach ($division_list as $item)
														<option value="{{$item->id}}" {{request()->input('id') == $item->id ? 'selected' : ''}}>{{$item->division_name}}</option>
														@endforeach
													</select>
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<label for="city_filter">जनपद</label>
													<select class="form-select" name="district_id">
														<option value="">--All--</option>
														@foreach ($districts_list as $item)
														<option value="{{$item->id}}" {{request()->input('district_id') == $item->id ? 'selected' : ''}}>{{$item->city}}</option>
														@endforeach
													</select>
												</div>
											</div>
											<div class="col-md-3">
												<div class="form-group">
													<label for="city_filter">तहसील</label>
													<select class="form-select" name="tehsil_id">
														<option value="">--All--</option>
														@foreach ($tehsils_list as $item)
														<option value="{{$item->id}}" {{request()->input('id') == $item->id ? 'selected' : ''}}>{{$item->Tehsil_Name}}</option>
														@endforeach
													</select>
												</div>
											</div>
											<div class="col-md-3">
												<div class="row">
													<div class="col-md-6">
														<div class="form-group d-grid">
															<label for="reset">&nbsp;</label>
															<button type="submit" class="btn btn-primary">
																Submit
															</button>
														</div>
													</div>
													<div class="col-md-6">
														<div class="form-group d-grid">
															<label for="reset">&nbsp;</label>
															<a href="{{url('admin/information/sports_infrastructure')}}" class="btn btn-danger">
																Reset
															</a>
														</div>
													</div>
												</div>
											</div>
										</div>
									</form>
									<form <?php if ($admin_id == 1) { ?> style="display:none" <?php } ?> action="{{url('admin/information/create_sportsinfra')}}" class="needs-validation" novalidate method="post" autocomplete="off"> @csrf
										<div class="col-12">
											<fieldset>
												<div class="row">
													<?php if (!empty($district_id_sports)) { ?>
														<div class="col-md-4">
															<div class="form-group">
																<label class="placeholder">Type <span class="text-danger">*</span></label>
																<div class="form-control">
																	<div class=" form-check-inline">
																		<input class="form-check-input" type="radio" name="identified_the_department" id="department_yes" value="1" required>
																		<label class="form-check-label mb-0" for="inlineCheckbox1">District</label>
																	</div>
																	<div class=" form-check-inline">
																		<input class="form-check-input" type="radio" name="identified_the_department" id="department_no" value="2" required>
																		<label class="form-check-label mb-0" for="inlineCheckbox2">Tehsil</label>
																	</div>
																</div>
															</div>
															@error('district_name')
															<div class="text-danger">{{ $message }}</div>
															@enderror
														</div>
														<div class="col-md-4" id="district_name_selected" style="display: none;">
															<div class="form-group mb-3">
																<label class="placeholder">District Name <span class="text-danger">*</span></label>
																<select name="district_name" id="district_name" class="form-control form-select" required>
																	@foreach($districts as $key=>$district)
																	<option {{$district->id == 23 ? 'selected' : ''}} value="{{ $district->id }}" data-badge="">{{$district->city}}</option>
																	@endforeach
																</select>
															</div>
															@error('district_name')
															<div class="text-danger">{{ $message }}</div>
															@enderror
														</div>
														<div class="col-md-4" id="tehsil_name_selected" style="display: none;">
															<div class="form-group mb-3">
																<label class="placeholder">Tehsil Name <span class="text-danger">*</span></label>
																<select name="tehsil_name" id="tehsil_name" class="form-control form-select" required>
																	<option selected="" disabled="" value="">Select Tehsil</option>
																	<?php // print_r($tehsils); die;
																	?> @foreach($tehsils as $key=>$tehsil)
																	<option {{$tehsil->id == 561 ? 'selected' : ''}} value="{{ $tehsil->id }}" data-badge="">{{$tehsil->Tehsil_Name}}</option>
																	@endforeach
																</select>
															</div>
															@error('tehsil_name')
															<div class="text-danger">{{ $message }}</div>
															@enderror
														</div>
													<?php } ?>
													<div class="col-md-4">
														<div class="form-group mb-3">
															<label class="placeholder">Name of Installed Game Setup <span class="text-danger">*</span></label>
															<input type="text" id="name_of_game_setup" onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))" pattern="^[A-Za-z -]+$" maxlength="150" name="name_of_game_setup" class="form-control" required>
														</div>
														@error('name_of_game_setup')
														<div class="text-danger">{{ $message }}</div>
														@enderror
													</div>
													<div class="col-md-4">
														<div class="form-group mb-3">
															<label class="placeholder">Year of Establishment <span class="text-danger">*</span></label>
															<input type="number" max="9999" min="0" id="year_of_establishment" name="year_of_establishment" class="form-control" required>
														</div>
														@error('year_of_establishment')
														<div class="text-danger">{{ $message }}</div>
														@enderror
													</div>
													<div class="col-md-4">
														<div class="form-group mb-3">
															<label class="placeholder">Sports Infrastructure Cost <span class="text-danger">*</span></label>
															<input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/(\.\d{2}).+/g, '$1');" id="sports_infrastructure_cost" name="sports_infrastructure_cost" class="form-control" required>
														</div>
														@error('sports_infrastructure_cost')
														<div class="text-danger">{{ $message }}</div>
														@enderror
													</div>
													<div class="col-md-4">
														<div class="form-group mb-3">
															<label class="placeholder">Name of Executing Agency <span class="text-danger">*</span></label>
															<input type="text" onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))" pattern="^[A-Za-z -]+$" maxlength="150" id="name_of_executing_agency" pattern=" ^[A-Za-z]+$" name="name_of_executing_agency" class="form-control" required>
														</div>
														@error('name_of_executing_agency')
														<div class="text-danger">{{ $message }}</div>
														@enderror
													</div>
												</div>
												<div class="bhoechie-footer">
													<div class="row justify-content-center">
														<!-- <div class="col-md-2 d-grid">
                                                                    <button type="reset" class="btn btn-outline-info rounded-pill">Back</button>
                                                                </div> -->
														<div class="col-md-2 d-grid">
															<button id="reset" type="reset" class="btn btn-outline-info rounded-pill">Reset</button>
														</div>
														<div class="col-md-2 d-grid">
															<button type="submit" class="btn btn-outline-danger rounded-pill">Save</button>
														</div>
													</div>
												</div>
												<input type="hidden" name="division_id" id="division_id" value="{{!empty($division_id) ? $division_id : 'null' }}">
											</fieldset>
										</div>
									</form>
								</div>
								<div class="col-12">
									<div class="table-responsive" id="prodiv">
										<table style="width: 100%;" class="dn">
											<tr>
												<td align="center" style="position: relative; border: 0; padding-bottom: 5px;">
													<div style="border-bottom: 0px solid #000; padding-bottom: 2vw;">
														<!-- <img src="{{ url('onlineAdmission') }}/images/logo.png" style="position: absolute; width: 70px; top: 5px; left: 0;"/> -->
														<!-- <img src="images/logo.png" style="position: absolute; width: 70px; top: 5px; left: 0;"/> -->
														<div style="font-size: 18px; font-weight: bold;">
															<!-- Department of Sports -->
															खेल साथी पोर्टल
														</div>
														<div style="font-size: 14px; font-weight: bold;">
															उत्तर प्रदेश सरकार
														</div>
														<div style="font-size: 18px; font-weight: bold;">
															स्पोर्ट्स इन्फ्रास्ट्रक्चर फॉर्म
														</div>
													</div>
												</td>
											</tr>
										</table>
										<table class="table table-bordered table-hover bg-white datatable mb-3" id="dataTable">
											<thead>
												<tr>
													<th><strong>क्र.सं.</strong></th>
													<th>
														<p align="center"><strong>मण्डल का नाम</strong></p>
													</th>
													<th><strong>जनपद का नाम</strong></th>
													<th>
														<p align="center"><strong>तहसील </strong><strong>का नाम</strong></p>
													</th>
													<th><strong>स्थापित खेल अवस्थापना का नाम</strong></th>
													<th><strong>स्थापित किये जाने का वर्ष</strong></th>
													<th><strong>खेल अवस्थापना लागत</strong></th>
													<th><strong>निष्पादन एजेंसी का नाम</strong></th>
												</tr>
											</thead>
											<tbody>
												@foreach($search_collection as $key=>$item)
												<tr>
													<td>{{ $key+1 }}</td>
													<?php if ($item->status == 0) { ?>
														<td>{{!empty(divisionName($item->division_id)) ? divisionName($item->division_id) : '-' }} </td>
														<td>-</td>
														<td>-</td>
													<?php } ?>
													<?php if ($item->status == 1) { ?>
														<td>-</td>
														<td>{{!empty(districtName($item->district_id)) ? districtName($item->district_id) : '-' }} </td>
														<td>-</td>
													<?php } ?>
													<?php if ($item->status == 2) { ?>
														<td>-</td>
														<td>-</td>
														<td>{{!empty(tehsiltName($item->tehsil_id)) ? tehsiltName($item->tehsil_id) : '-' }}</td>
													<?php } ?>
													<!-- //2 tehsil name -->

													<td>{{isset($item->name_of_game_setup) ? $item->name_of_game_setup : '-' }}</td>
													<td>{{isset($item->year_of_establishment) ? $item->year_of_establishment : '-' }}</td>
													<td>{{isset($item->sports_infrastructure_cost) ? $item->sports_infrastructure_cost : '-' }}</td>
													<td>{{isset($item->name_of_executing_agency) ? $item->name_of_executing_agency : '-' }}</td>
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
			</div>
		</div>
	</div>
</div>
@endsection
@push( 'custom-scripts' )
<script>
	function PrintDoc() {
		$('#dataTable').DataTable().destroy();
		var toPrint = document.getElementById('prodiv');

		var popupWin = window.open('', '_blank', 'left=100,top=100,width=1100,height=600,tollbar=0,scrollbars=1,status=0,resizable=1');

		popupWin.document.open();

		popupWin.document.write('<html><title>::Preview::</title><head><style>body{font-family:Arial} .noprint{display: none;} table{width:100%; border-collapse:collapse;} .table tr th, .table tr td{border:1px solid #000; padding:3px 5px; font-size: 12px;} .table > thead > tr > th{background-color: #eee;}</style></head><body onload="window.print()">')

		popupWin.document.write(toPrint.innerHTML);

		popupWin.document.write('</body></html>');

		popupWin.document.close();

		$('#dataTable').DataTable();

	}
</script>
<script type="text/javascript">
	$(function() {
		var table = $('.yajra-datatable').DataTable({
			processing: true,
			serverSide: true,
			ajax: "{{ route('projectlist') }}",
			columns: [{
				data: 'DT_RowIndex',
				name: 'DT_RowIndex'
			}, {
				data: 'fullname',
				name: 'fullname'
			}, {
				data: 'project_id',
				name: 'project_id'
			}, {
				data: 'project_name',
				name: 'project_name'
			}, {
				data: 'application_date',
				name: 'application_date'
			}, {
				data: 'current_status',
				name: 'current_status',
				orderable: false,
				searchable: false
			}, {
				data: 'view',
				name: 'view',
				orderable: false,
				searchable: false
			}, ]
		});
	});
</script>
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
			XLSX.writeFile(wb, fn || ('Sports Infrastructure List.' + (type || 'xlsx')));
	}
</script>
<script type="text/javascript">
	$('input[name="identified_the_department"]').click(function() {
		var identified_the_department = $(this).val();
		if (identified_the_department == 1) {
			$('#district_name_selected').show();
			$('#tehsil_name_selected').hide();
			$("#district_name").prop('required', true);
			$("#tehsil_name").prop('required', false);
		} else if (identified_the_department == 2) {
			$('#tehsil_name_selected').show();
			$('#district_name_selected').hide();
			$("#district_name").prop('required', false);
			$("#tehsil_name").prop('required', true);
			//$("#um_land_remarks").prop('required', false);
		}
	});
</script>
@endpush
