@extends( 'layouts/admin_layout' )
@section( 'content' )
<style>
	.table tr th,
	.table tr td {
		padding: 3px 3px;
		font-size: 9pt;
	}
	.nowraptbl thead tr th {
        white-space: nowrap;
        text-align: center !important;
    }
</style>
<div class="row">
	<div class="col-12">
		<div class="pageheader" id="menu-margin">
			<h4 class="mb-0">
				विभागीय राजस्व प्रपत्र 56
			</h4>
		</div>
	</div>
	<div class="col-12">
		<div class="table-responsive">
			<table class="table table-bordered table-hover bg-white mb-3 nowraptbl">
				<thead>
					<tr>
						<th colspan="32" class="text-center"><strong>कार्यालय का नाम</strong></th>
						<th rowspan="4" class="text-center">माह में प्राप्त<br>कुल राजस्व प्राप्तियां<br>(कालम<br>6+12+16+20+24+30<br>का महायोग)</th>
					</tr>
					<tr>
						<th colspan="12" class="text-center"><strong>विभागीय राजस्व प्राप्तियों का विवरण</strong></th>
						<th colspan="7" class="text-center"><strong>माह </strong> - </th>
						<th colspan="5" class="text-center"><strong>वर्ष</strong> - </th>
						<th colspan="8" class="text-center"><strong>(धनराशि रू. में)</strong> -</th>
					</tr>
					<tr>
						<th colspan="4" class="text-center">विवरण</th>
						<th colspan="4" class="text-center">प्रशिक्षण मद से आय</th>
						<th colspan="6" class="text-center">आरक्षण मद से आय</th>
						<th colspan="4" class="text-center">तरणताल मद से आय</th>
						<th colspan="4" class="text-center">छात्रावास मद से आय</th>
						<th colspan="10" class="text-center">अन्य प्राप्तियों के मद से आय</th>
					</tr>
					<tr>
						<th>विभाग का नाम</th>
						<th>जनपद/संस्था का नाम</th>
						<th>तहसील का नाम</th>
						<th>खेल का नाम</th>

						<!-- प्रशिक्षण से आय -->
						<th>प्रशिक्षणार्थियों की संख्या</th>
						<th>निर्धारित शुल्क</th>
						<th>कुल आय</th>
						<th>विभागीय प्राप्ति रसीद संख्या व दिनाँक</th>

						<!-- आरक्षण से आय -->
						<th>कीडांगन/ग्राउण्ड से किराया</th>
						<th>बहुउद्देशीय हाल से किराया</th>
						<th>कमरे बुकिंग से किराया</th>
						<th>स्टेडियम के बुकिंग से किराया</th>
						<th>कुल आय</th>
						<th>विभागीय प्राप्ति रसीद संख्या व दिनाँक</th>


						<!-- तरणताल मद से आय -->
						<th>प्रशिक्षणार्थियों की संख्या</th>
						<th>निर्धारित शुल्क</th>
						<th>कुल आय</th>
						<th>विभागीय प्राप्ति रसीद संख्या व दिनाँक</th>

						<!-- छात्रावास मद से आय-->
						<th>छात्रों की संख्या</th>
						<th>निर्धारित शुल्क</th>
						<th>कुल आय</th>
						<th>विभागीय प्राप्ति रसीद संख्या व दिनाँक</th>

						<!-- अन्य प्राप्तियों के मद से आय -->
						<th>शौकिया खिलाड़ियों की संख्या</th>
						<th>निर्धारित शुल्क/खिलाड़ी</th>
						<th>कुल आय</th>
						<th>विभागीय प्राप्ति रसीद संख्या व दिनाँक</th>
						<th>कार/मोटर साइकिल/साइकिल स्टैण्ड से आय</th>
						<th>निष्प्रयोज्य सामानो की नीलामी से आय</th>
						<th>फार्मो की बिक्री से आय</th>
						<th>विभाग के अन्य आय के स्रोतो से आय</th>
						<th>कुल आय</th>
						<th>विभागीय प्राप्ति रसीद संख्या व दिनाँक</th>
					</tr>
					<tr>
						<th colspan="2">1</th>
						<th>2</th>
						<th>3</th>
						<th>4</th>
						<th>5</th>
						<th>6</th>
						<th>7</th>
						<th>8</th>
						<th>9</th>
						<th>10</th>
						<th>11</th>
						<th>12</th>
						<th>13</th>
						<th>14</th>
						<th>15</th>
						<th>16</th>
						<th>17</th>
						<th>18</th>
						<th>19</th>
						<th>20</th>
						<th>21</th>
						<th>22</th>
						<th>23</th>
						<th>24</th>
						<th>25</th>
						<th>26</th>
						<th>27</th>
						<th>28</th>
						<th>29</th>
						<th>30</th>
						<th>31</th>
						<th>32</th>
					</tr>
				</thead>
				<tbody>
					@foreach($departmentalInformation as $key=>$item)
					<tr>
						<?php if ($item->status == 0) { ?>
							<td>{{!empty(divisionName($item->division_id)) ? divisionName($item->division_id) : '-' }}</td>
							<td>-</td>
							<td>-</td>
							<td>{{!empty($item->name_of_sport) ? $item->name_of_sport : '-' }}</td>
						<?php } ?>
						<?php if ($item->status == 1) { ?>
							<td>-</td>
							<td>{{!empty(districtName($item->district_id)) ? districtName($item->district_id) : '-' }}</td>
							<td>-</td>
							<td>{{!empty($item->name_of_sport) ? $item->name_of_sport : '-' }}</td>
						<?php } ?>
						<?php if ($item->status == 2) { ?>
							<td>-</td>
							<td>-</td>
							<td>{{!empty(tehsiltName($item->tehsil_id)) ? tehsiltName($item->tehsil_id) : '-' }}</td>
							<td>{{!empty($item->name_of_sport) ? $item->name_of_sport : '-' }}</td>
						<?php } ?>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
						<td>&nbsp;</td>
					</tr>
					@endforeach					
					<tr>
						<td colspan="32">माह में राजस्व प्राप्तियां</td>
						<td></td>
					</tr>
					<tr>
						<td colspan="32">गत माह की राजस्व प्राप्तियां</td>
						<td></td>
					</tr>
					<tr>
						<td colspan="32">प्रगामी राजस्व प्राप्तियां</td>
						<td></td>
					</tr>
					<tr>
						<td colspan="32">गत वित्तीय वर्ष में इसी माह तक राजस्व प्राप्तियां</td>
						<td></td>
					</tr>
					<tr>
						<td colspan="32">राजस्व प्राप्तियां में प्रतिशत वृद्धि अथवा कमी</td>
						<td></td>
					</tr>
					<!-- <tr>
						<td colspan="31">प्रमाणित किया जाता है उपरोक्त सभी सूचनाएं मेरी जानकारी में सही हैं तथा प्राप्त राजस्व प्राप्तियों को विभागीय लेखाशीर्षक में जमा करा दिया गया है, गलत सूचना पाये जाने पर वसूली हेतु उत्तरदायी रहेंगे।</td>
					</tr> -->
				</tbody>
			</table>
		</div>
	</div>
	@endsection @push( 'custom-scripts' )
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
	@endpush
