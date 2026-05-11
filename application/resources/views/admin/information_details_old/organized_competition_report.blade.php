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
                संगठित प्रतियोगिता प्रपत्र
                <a title="Print" class="btn btn btn-outline-success float-end" data-print="modal" onclick="PrintDoc()"><i class="icons icon-printer"></i> प्रिंट</a>
            </h4>
				

				</div>
			</div>
			<div class="col-12">
			<form method="POST" action="{{url('admin/information/organized_competition_list_filter')}}">
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
								</div>
									<div class="row mb-2">
									<div class="col-md-3">
										<div class="form-group d-grid">
											<label for="reset">&nbsp;</label>
											<button type="submit" class="btn btn-primary">
												Submit
											</button>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group d-grid">
										<label for="reset">&nbsp;</label>
											<a href="{{url('admin/information/sports_infrastructure')}}" class="btn btn-danger">
												Reset
											</a>
										</div>
									</div>
								</div>
							</form>
			<div class="card">
			<div class="card-body">
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
																		    संगठित प्रतियोगिता प्रपत्र
																		</div>
																	</div>
																</td>
															</tr>
														</table>
														<table class="table table-bordred table-hover bg-white datatable mb-3" id="dataTable">
															<thead>
																<tr>
																	<th rowspan="2"><strong>क्र.सं.</strong>
																	</th>
																	<th rowspan="2"><strong>मण्डल</strong><strong> का नाम</strong>
																	</th>
																	<th rowspan="2"><strong>जनपद का नाम</strong>
																	</th>
																	<th rowspan="2">
																		<p align="center"><strong>तहसील</strong> <strong>का नाम</strong>
																		</p>
																	</th>
																	<th colspan="3" class="text-center"><strong>आयोजित प्रति. का नाम</strong>
																	</th>
																	<th rowspan="2"><strong>व्यय धनराशि</strong>
																	</th>
																	<th rowspan="2"><strong>आयोजन का वर्ष</strong>
																	</th>
																</tr>
																<tr>
																	<th><strong>मण्डल</strong> <strong>स्तर</strong>
																	</th>
																	<th>
																		<p align="center"><strong>जिला</strong><strong> स्तर</strong>
																		</p>
																	</th>

																	<th>
																		<p align="center"><strong>तहसील</strong> <strong> स्तर</strong>
																		</p>
																	</th>

																</tr>
															</thead>
															<tbody>
																@foreach($organizedCompetition as $key=>$item)
																<tr>
																	<td>{{ $key+1 }}</td>
																	<?php
																	//1 District
																	if ( $item->status == 0 ) {
																		?>
																	<td>{{!empty(divisionName($item->division_id)) ? divisionName($item->division_id) : '-' }}</td>
																	<td>-</td>
																	<td>-</td>
																	<td>{{isset($item->organized_competition_name) ? $item->organized_competition_name : '-' }}</td>
																	<td>-</td>
																	<td>-</td>
																	<td>{{isset($item->spending_amount) ? $item->spending_amount : '-' }}</td>
																	<td>{{isset($item->year_of_event) ? $item->year_of_event : '-' }}</td>

																	<?php } ?>

																	<?php
																	//1 District
																	if ( $item->status == 1 ) {
																		?>
																	<td>-</td>

																	<td>{{!empty(districtName($item->district_id)) ? districtName($item->district_id) : '-' }} </td>
																	<td>-</td>
																	<td>-</td>
																	<td>{{isset($item->organized_competition_name) ? $item->organized_competition_name : '-' }}</td>
																	<td>-</td>

																	<td>{{isset($item->spending_amount) ? $item->spending_amount : '-' }}</td>

																	<td>{{isset($item->year_of_event) ? $item->year_of_event : '-' }}</td>
																	<?php } ?>
																	<?php
																	//2 tehsil name
																	if ( $item->status == 2 ) {
																		?>
																	<td>-</td>
																	<td>-</td>

																	<td>{{!empty(tehsiltName($item->tehsil_id)) ? tehsiltName($item->tehsil_id) : '-' }}</td>
																	<td>-</td>
																	<td>-</td>
																	<td>{{isset($item->organized_competition_name) ? $item->organized_competition_name : '-' }}</td>




																	<td>{{isset($item->spending_amount) ? $item->spending_amount : '-' }}</td>
																	<td>{{isset($item->year_of_event) ? $item->year_of_event : '-' }}</td>
																	<?php } ?>









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

<footer>
	<div class="row">
		<div class="col-md-10">
			<ul class="foot-list">
				<li>Copyright &copy; Department of Sports</li>
			</ul>
		</div>
		<div class="col-md-2">
			<ul class="foot-list">
				<li>Powered by <a href="http://otpl.co.in/" target="_blank">VTPL</a>
				</li>
			</ul>
		</div>
	</div>
</footer>
</div>

@endsection

@push( 'custom-scripts' )
	<script>
		function PrintDoc() {
			$( '#dataTable' ).DataTable().destroy();
			var toPrint = document.getElementById( 'prodiv' );

			var popupWin = window.open( '', '_blank', 'left=100,top=100,width=1100,height=600,tollbar=0,scrollbars=1,status=0,resizable=1' );

			popupWin.document.open();

			popupWin.document.write( '<html><title>::Preview::</title><head><style>body{font-family:Arial} .noprint{display: none;} table{width:100%; border-collapse:collapse;} .table tr th, .table tr td{border:1px solid #000; padding:3px 5px; font-size: 12px;} .table > thead > tr > th{background-color: #eee;}</style></head><body onload="window.print()">' )

			popupWin.document.write( toPrint.innerHTML );

			popupWin.document.write( '</body></html>' );

			popupWin.document.close();

			$( '#dataTable' ).DataTable();

		}
	</script>
<script type="text/javascript">
	$( function () {
		var table = $( '.yajra-datatable' ).DataTable( {
			processing: true,
			serverSide: true,
			ajax: "{{ route('projectlist') }}",
			columns: [ {
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
		} );
	} );
</script>
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
			XLSX.writeFile( wb, fn || ( 'Sports Infrastructure List.' + ( type || 'xlsx' ) ) );
	}
</script>
<script type="text/javascript">
	$( 'input[name="identified_the_department"]' ).click( function () {
		var identified_the_department = $( this ).val();
		if ( identified_the_department == 1 ) {
			$( '#district_name_selected' ).show();
			$( '#tehsil_name_selected' ).hide();
			$( "#district_name" ).prop( 'required', true );
			$( "#tehsil_name" ).prop( 'required', false );
		} else if ( identified_the_department == 2 ) {
			$( '#tehsil_name_selected' ).show();
			$( '#district_name_selected' ).hide();
			$( "#district_name" ).prop( 'required', false );
			$( "#tehsil_name" ).prop( 'required', true );
			//$("#um_land_remarks").prop('required', false);
		}
	} );
</script>

@endpush
