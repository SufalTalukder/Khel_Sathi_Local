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
				व्ययाधिक्य बचत की सूचना
				<a title="Print" class="btn btn btn-outline-success float-end" data-print="modal" onclick="PrintDoc()"><i class="icons icon-printer"></i> प्रिंट</a>
			</h4>
			<form method="POST" action="{{url('admin/information/financial_list_filter')}}">
				@csrf
				<div class="row mb-3">
					<div class="col-md-3">
						<div class="form-group">
							<label for="division_filter">मण्डल</label>
							<select class="form-select" name="division_id">
								<option value="">--All--</option>
								@foreach ($divisions as $item)
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
								@foreach ($districts as $item)
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
								@foreach ($tehsils as $item)
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
									<a href="{{url('admin/information/financial_report')}}" class="btn btn-danger">
										Reset
									</a>
								</div>
							</div>
						</div>
					</div>
				</div>
			</form>
		</div>
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
								व्ययाधिक्य बचत की सूचना
							</div>
						</div>
					</td>
				</tr>
			</table>
			<table class="table table-bordered table-hover bg-white datatable mb-3" id="dataTable">
				<thead>
					<tr>
						<th>क्र.सं.</th>
						<th><strong>मण्डल</strong><strong> का नाम</strong></th>
						<th><strong>जिला </strong><strong> का नाम</strong></th>
						<th><strong>तहसील</strong><strong> का नाम</strong></th>
						<th><strong>मद का नाम </strong></th>
						<th>निदेशालय सत्तर पर आवंटित धन राशि रुपये में</th>
						<th>व्यय की गयी धन राशि रुपये में</th>
						<th>बचत</th>
						<th>राजस्वा लेखा </th>
						<th>अभ्युक्ति</th>
						<th>जमा करने की तिथि</th>
					</tr>
				</thead>
				<tbody>
					@foreach($financialInformation as $key=>$item)
					<tr>
						<td class="text-center">{{ $key+1 }}</td>
						<td>{{!empty(districtName($item->district_id)) ? districtName($item->district_id) : '-' }} </td>
						<td>{{!empty(districtName($item->district_id)) ? districtName($item->district_id) : '-' }} </td>
						<td>{{!empty(tehsiltName($item->tehsil_id)) ? tehsiltName($item->tehsil_id) : '-' }}</td>
						<td class="text-center">
							<?php if ($item->item_name == 1) { ?>
								2013-मंत्रि परिशद 105-मंत्रियों द्वारा विवेकाधीन अनुदान 03-क्रीड़ा मंत्री द्वारा विवेकाधीन अनुदान 42-अन्य व्यय
							<?php } else if ($item->item_name == 2) { ?>
								2059.लोक निर्माण कार्य 80.सामान्य 053.रखरखाव तथा मरम्मत 03.मेयोहाल इलाहाबाद के अनावासीय भवनों का अनुरक्षण 29-अनुरक्षण
							<?php } else if ($item->item_name == 3) { ?>
								2204-खेलकूद तथा युवा सेवायें 001-निदेषन तथा प्रषासन 03-खेलकूद निदेषालय
							<?php } else if ($item->item_name == 4) { ?>
								104-खेलकूद
							<?php } else { ?>
								-
							<?php } ?>
						</td>
						<td>{{isset($item->directorate_seventy) ? $item->directorate_seventy : '-' }}</td>
						<td>{{isset($item->amount_of_money_spent) ? $item->amount_of_money_spent : '-' }}</td>
						<td>{{isset($item->savings) ? $item->savings : '-' }}</td>
						<td>
							<?php if ($item->item_name == 3) { ?>
								<?php if ($item->revenue_accounting == 1) { ?>
									01-वेतन
								<?php } else if ($item->revenue_accounting == 2) { ?>
									03-मंहगाई भत्ता
								<?php } else if ($item->revenue_accounting == 3) { ?>
									04-यात्रा व्यय
								<?php } else if ($item->revenue_accounting == 4) { ?>
									05-स्थानान्तरण यात्रा व्यय
								<?php } else if ($item->revenue_accounting == 5) { ?>
									06-अन्य भत्ते
								<?php } else if ($item->revenue_accounting == 6) { ?>
									07-मानदेय
								<?php } else if ($item->revenue_accounting == 7) { ?>
									08-कार्यालय व्यय
								<?php } else if ($item->revenue_accounting == 8) { ?>
									09-विद्युत देय
								<?php } else if ($item->revenue_accounting == 9) { ?>
									10-जलकर/जल प्रभार
								<?php } else if ($item->revenue_accounting == 10) { ?>
									11-लेखन सामग्री और फार्मो की छपाई
								<?php } else if ($item->revenue_accounting == 11) { ?>
									12-कार्यालय फर्नीचर एवं उपकरण
								<?php } else if ($item->revenue_accounting == 12) { ?>
									13-टेलीफोन पर व्यय
								<?php } else if ($item->revenue_accounting == 13) { ?>
									15-गाड़ियो का अनुरक्षण और पेट्रोल आदि की खरीद
								<?php } else if ($item->revenue_accounting == 14) { ?>
									16-व्यावसायिक तथा विषेश सेवाओं के लिए भुगतान
								<?php } else if ($item->revenue_accounting == 15) { ?>
									17-किराया, उपषुल्क और कर स्वामित्व
								<?php } else if ($item->revenue_accounting == 16) { ?>
									22-आतिथ्य व्यय/व्यय विशयक भत्ता आदि
								<?php } else if ($item->revenue_accounting == 17) { ?>
									26-मषीने और सज्जा/उपकरण और संयंत्र
								<?php } else if ($item->revenue_accounting == 18) { ?>
									42-अन्य व्यय
								<?php } else if ($item->revenue_accounting == 19) { ?>
									44-प्रषिक्षण हेतु यात्रा एवं अन्य प्रासंगिक व्यय
								<?php } else if ($item->revenue_accounting == 20) { ?>
									45-अवकाष यात्रा व्यय
								<?php } else if ($item->revenue_accounting == 21) { ?>
									46-कम्प्यूटर हार्डवेयर/साफ्टवेयर का क्रय
								<?php } else if ($item->revenue_accounting == 22) { ?>
									47-कम्प्यूटर अनुरक्षण/तत्सम्बन्धी स्टेषनरी का क्रय
								<?php } else if ($item->revenue_accounting == 23) { ?>
									49-चिकित्सा व्यय
								<?php } else if ($item->revenue_accounting == 24) { ?>
									51-वर्दी व्यय
								<?php } else if ($item->revenue_accounting == 25) { ?>
									55-मकान किराया भत्ता
								<?php } else if ($item->revenue_accounting == 26) { ?>
									56-नगर प्रतिकर भत्ता
								<?php } else if ($item->revenue_accounting == 27) { ?>
									58-आउट सोर्सिंग सेवाओं हेतु भुगतान
								<?php } else if ($item->revenue_accounting == 28) { ?>
									59-एकमुश्त नियोक्ता अंशदान/ब्याज
								<?php } ?>
								-
							<?php
							} else if ($item->item_name == 4) {
							?>

								<?php if ($item->revenue_accounting == 1) { ?>
									03-सरकारी कर्मचारियों तथा उनके परिवारों के कल्याण सम्बन्धी कार्यकलाप 20-सहायता अनुदान-सामान्य (गैर वेतन)
								<?php } else if ($item->revenue_accounting == 2) { ?>
									04-क्रीड़ा छात्रावास के आवासीय खिलाड़ियों पर व्यय (बालिकाओं हेतु) 12-कार्यालय फर्नीचर एवं उपकरण
								<?php } else if ($item->revenue_accounting == 3) { ?>
									42-अन्य व्यय
								<?php } else if ($item->revenue_accounting == 4) { ?>
									05-भूतपूर्व प्रसिद्ध खिलाड़ियों तथा पहलवानों को वित्तीय सहायता 20-सहायता अनुदान-सामान्य (गैर वेतन)
								<?php } else if ($item->revenue_accounting == 5) { ?>
									06-क्रीड़ा छात्रावास के आवासीय खिलाड़ियों पर व्यय (बालको हेतु) 12-कार्यालय फर्नीचर एवं उपकरण
								<?php } else if ($item->revenue_accounting == 6) { ?>
									42-अन्य व्यय
								<?php } else if ($item->revenue_accounting == 7) { ?>
								<b>07-उत्तर प्रदेश खेल विकास एवं प्रोत्साहन योजना 42-अन्य व्यय</b>
									<br>
								<?php 
								if($item->uttar_pradesh_sports_development == 1){ ?>
								&nbsp > &nbsp 08-मेयोहाल इलाहाबाद में स्थापित क्रीड़ा स्थल
								<?php }else if($item->uttar_pradesh_sports_development == 2){ ?>
									&nbsp > &nbsp 01-वेतन
								<?php }else if($item->uttar_pradesh_sports_development == 3){ ?>
									&nbsp > &nbsp 03-मंहगाई भत्ता
								<?php }else if($item->uttar_pradesh_sports_development == 4){ ?>
									&nbsp > &nbsp 04-यात्रा व्यय
								<?php }else if($item->uttar_pradesh_sports_development == 5){ ?>
									&nbsp > &nbsp 05-स्थानान्तरण यात्रा व्यय
								<?php }else if($item->uttar_pradesh_sports_development == 6){ ?>
									&nbsp > &nbsp 06-अन्य भत्ते 
								<?php }else if($item->uttar_pradesh_sports_development == 7){ ?>
									&nbsp > &nbsp 08-कार्यालय व्यय
								<?php }else if($item->uttar_pradesh_sports_development == 8){ ?>
									&nbsp > &nbsp 09-विद्युत देय
								<?php }else if($item->uttar_pradesh_sports_development == 9){ ?>
									&nbsp > &nbsp 10-जलकर/जल प्रभार
								<?php }else if($item->uttar_pradesh_sports_development == 10){ ?>
									&nbsp > &nbsp 11-लेखन सामग्री और फार्मो की छपाई
								<?php }else if($item->uttar_pradesh_sports_development == 11){ ?>
									&nbsp > &nbsp 12-कार्यालय फर्नीचर एवं उपकरण
								<?php }else if($item->uttar_pradesh_sports_development == 12){ ?>
									&nbsp > &nbsp 13-टेलीफोन पर व्यय
								<?php }else if($item->uttar_pradesh_sports_development == 13){ ?>
									&nbsp > &nbsp 43-सामग्री एवं सम्पूर्ति
								<?php }else if($item->uttar_pradesh_sports_development == 14){ ?>
									&nbsp > &nbsp 44-प्रषिक्षण हेतु यात्रा एवं अन्य प्रासंगिक व्यय
								<?php }else if($item->uttar_pradesh_sports_development == 15){ ?>
									&nbsp > &nbsp 45-अवकाष यात्रा व्यय
								<?php }else if($item->uttar_pradesh_sports_development == 16){ ?>
									&nbsp > &nbsp 47-कम्प्यूटर अनुरक्षण/तत्सम्बन्धी स्टेषनरी का क्रय
								<?php }else if($item->uttar_pradesh_sports_development == 17){ ?>
									&nbsp > &nbsp 49-चिकित्सा व्यय
								<?php }else if($item->uttar_pradesh_sports_development == 18){ ?>
									&nbsp > &nbsp 51-वर्दी व्यय
								<?php }else if($item->uttar_pradesh_sports_development == 19){ ?>
									&nbsp > &nbsp 55-मकान किराया भत्ता
								<?php }else if($item->uttar_pradesh_sports_development == 20){ ?>
									&nbsp > &nbsp 56-नगर प्रतिकर भत्ता
								<?php } ?>

								<?php } else if ($item->revenue_accounting == 8) { ?>
									09-क्रीड़ागनों/स्टेडियमों/बहुउद्देषीय हालों/तरणतालांे/छात्रावासों एवं भवनों का अनुरक्षण 29-अनुरक्षण
								<?php } else if ($item->revenue_accounting == 9) { ?>
									10-विषिश्ट खिलाड़ियों को प्रदेषीय पुरस्कार 20-सहायता अनुदान-सामान्य (गैर वेतन)
								<?php } else if ($item->revenue_accounting == 10) { ?>
									11-क्रीड़ा एवं खेलकूद प्रतियोगिताओं का आयोजन (राज्य से.) 42-अन्य व्यय
								<?php } else if ($item->revenue_accounting == 11) { ?>
									12-खेलकूद उपकरण सामग्री की सम्पूर्ति 43-सामग्री एवं सम्पूर्ति
								<?php } else if ($item->revenue_accounting == 12) { ?>
									16-प्रत्येक क्रीड़ांगन में एक फिजियोथैरेपी केन्द्र की स्थापना 42-अन्य व्यय
								<?php } else if ($item->revenue_accounting == 13) { ?>
									18-प्रषिक्षण (राज्य सेक्टर)- 42-अन्य व्यय
								<?php } else if ($item->revenue_accounting == 14) { ?>
									21-राश्ट्रीय प्रतियोगिताओं में भाग लेने वाली प्रदेषीय टीम के खिलाड़ियों हेतु किट की व्यवस्था 20-सहायता अनुदान-सामान्य (गैर वेतन)
								<?php } else if ($item->revenue_accounting == 15) { ?>
									29-राश्ट्रीय एवं अन्तर्राश्ट्रीय स्तर की खेल प्रतियोगिताओं का आयोजन-20-सहायता अनुदान-सामान्य (गैर वेतन)
								<?php } else if ($item->revenue_accounting == 16) { ?>
									30-पंडित दीन दयाल उपाध्याय जी की जन्म षताब्दी के अवसर पर खेल प्रतियोगिताओं का आयोजन 20-सहायता अनुदान-सामान्य (गैर वेतन)
								<?php } else if ($item->revenue_accounting == 17) { ?>
									30-पंडित दीन दयाल उपाध्याय जी की जन्म षताब्दी के अवसर पर खेल प्रतियोगिताओं का आयोजन 20-सहायता अनुदान-सामान्य (गैर वेतन)
								<?php } else if ($item->revenue_accounting == 18) { ?>
									30-पंडित दीन दयाल उपाध्याय जी की जन्म षताब्दी के अवसर पर खेल प्रतियोगिताओं का आयोजन 20-सहायता अनुदान-सामान्य (गैर वेतन)
							<?php }
							}
							?></td>
							<td>{{isset($item->allegation) ? repairHindi($item->allegation) : '-' }}</td>
						<td>({{date('d-m-Y', strtotime(isset($item->created_on))) ? date('d-m-Y', strtotime( $item->created_on)) : '-' }})</td>
					</tr>
					@endforeach
				</tbody>
			</table>
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
			XLSX.writeFile(wb, fn || ('Monthly Information List.' + (type || 'xlsx')));
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
<script type="text/javascript">
	$(document).ready(function() {
		$('#reset').click(function() {
			$('#district_name_selected').hide();

		});
	});
</script>
@endpush
