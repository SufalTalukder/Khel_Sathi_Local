@extends( 'layouts/admin_layout' )
@section( 'content' )

<style>
	table.dataTable>thead>tr>th:not(.sorting_),
	table.dataTable>thead>tr>td:not(.sorting_) {
		padding-right: 0;
	}

	table.table-bordered.dataTable tbody th,
	table.table-bordered.dataTable tbody td {
		border-color: #000;
	}

	.table>:not(caption)> *> * {
		padding: 0.1rem;
	}

	table.table-bordered.dataTable th,
	table.table-bordered.dataTable td {}

	div#DataTables_Table_0_filter input {
		border: 1px solid #ced4da;
	}

	table th {
		color: #000 !important;
		font-weight: 700;
		background: #dbdfe3 !important;
		border-color: #000;
	}

	.table>:not(:last-child)>:last-child> * {
		border-bottom: 1px solid #000000;
	}

	input::-webkit-outer-spin-button,
	input::-webkit-inner-spin-button {
		-webkit-appearance: none;
		margin: 0;
	}

	/* Firefox */
	input[type=number] {
		-moz-appearance: textfield;
	}

	.border {
		border : 2px solid #000000 !important;
	}
    .dn{display: none;}
	@media print {
		.pageheader, .card:not(.input_new), .btn, .float-end, form, .form-group, label, .mb-3, .mb-0, .backbtn {
			display: none !important;
		}
		.card {
			border: none !important;
			box-shadow: none !important;
		}
		.card-body {
			padding: 0 !important;
		}
		.table-responsive {
			overflow: visible !important;
		}
		table {
			width: 100% !important;
			border-collapse: collapse !important;
		}
		th, td {
			border: 1px solid #000 !important;
			padding: 2px !important;
		}
	}
</style>

<div class="row">
	<div class="col-md-12">
		<div class="pageheader" id="menu-margin">
			<h4 class="mb-0">



				


					<a href="{{ url('collegeadmin/dashboard') }}" class="btn btn-outline-danger btn-sm backbtn float-end  m-0"><span class="icons icon-arrow-left"></span>Back/पीछे</a>
					<a href="#" onclick="ExportToExcell('xlsx')" class="btn btn-success btn-sm float-end m-0 mx-2"><i class="fa fa-file-excel-o"></i> Export To Excel</a>
					<a href="#" onclick="PrintDoc()" class="btn btn-warning btn-sm float-end m-0"><i class="fa fa-file-pdf-o"></i> Print To PDF</a>


	</div>

		<div class="card">

			<div class="card-body">
				<form action="{{route('hosteladmintrialListfour')}}" method="post">
					@csrf
					<div class="row">
						<div class="mb-3 col-md-2">


							<label>Name of The Sport</label>
							<select class="form-control"  name="sport" id="sport" onchange="sportgender(this.value)" data-gender="@if(isset($filterData)){{$filterData['gender']}}@endif"    data-subsport="@if(isset($filterData)){{$filterData['subSport']}}@endif" >
								<option value="">select</option>
								@foreach ($sports as $sport)
								<option value="{{ data_get($sport, 'id') }}" @if(isset($filterData) && data_get($filterData, 'sport_id') == data_get($sport, 'id')) selected @endif>{{ data_get($sport, 'name') }}</option>
								@endforeach

							</select>


						</div>
                        <div class="mb-3 col-md-3" id="subsport_div">


							<label>Name of The Sub Sport</label>
							<select class="form-control"  id="subtype" name="subsport">
								<option value="">All (No Sub Sport)</option>
							</select>


						</div>

						<div class="mb-3 col-md-2">


							<label>Gender</label>
							<select class="form-control" name="gender" style="width: 100%;" data-gender="@if(isset($filterData)) {{$filterData['gender']}} @endif" data-division="@if(isset($filterData)) {{$filterData['division_id']}} @endif">
								<option >select</option>
								<option value="1" @if(isset($filterData) && data_get($filterData, 'gender') == 1) selected @endif >Male</option>
								<option value="2" @if(isset($filterData) && data_get($filterData, 'gender') == 2) selected @endif >Female</option>
								<option value="3" @if(isset($filterData) && data_get($filterData, 'gender') == 3) selected @endif >Male & Female</option>
							</select>
						</div>
                       <div class="mb-3 col-md-2">
							<label>Division</label>
							<select class="form-control" name="division_id" style="width: 100%;" >
                                <option value="" >select Division</option>
                                @foreach ( $division as $item)
                                <option value="{{ data_get($item, 'id')  }}" @if(isset($filterData) && data_get($filterData, 'division_id') == data_get($item, 'id')) selected @endif>{{ data_get($item, 'division_name') }}</option>
                                @endforeach
							</select>
						</div>
						<div class="mb-3 col-md-4">
							<label class="form-label">&nbsp;</label>
                            <button class="btn btn-primary form-group mt-4" type="submit">Filter Trial List</button>
                            <button class="btn btn-secondary form-group mt-4" type="button" onclick="PrintDoc()">Print to Pdf</button>
                            <button class="btn btn-success form-group mt-4" type="button" onclick="ExportToExcell('xlsx')">Export to Excel</button>
						</div>
					</div>
				</form>

<script>
(function(){
    var _subsports = @json($allSubSports ?? []);
    var _genderMap = {6:3,10:3,43:3,44:3,20:3,23:3,14:3,25:3,8:3,9:3,3:1,7:1,4:1};

    function sportgender(sport){
        sport = parseInt(sport);
        var savedSub = parseInt(document.getElementById('sport').getAttribute('data-subsport')) || 0;
        var savedGender = parseInt(document.getElementById('sport').getAttribute('data-gender')) || 0;
        var subSel = document.querySelector('select[name="subsport"]');
        var genSel = document.querySelector('select[name="gender"]');
        var subDiv = document.getElementById('subsport_div');

        var subs = _subsports.filter(function(s){ return parseInt(s.sport_id) === sport; });
        subSel.innerHTML = '<option value="">All (No Sub Sport)</option>';
        if(subs.length > 0){
            subDiv.style.display = '';
            subs.forEach(function(s){
                var o = document.createElement('option');
                o.value = s.id;
                o.text = s.sub_type;
                if(s.id == savedSub) o.selected = true;
                subSel.appendChild(o);
            });
        } else {
            subDiv.style.display = 'none';
        }

        var g = _genderMap[sport] || '';
        genSel.innerHTML = '<option value="">Select Gender</option>';
        if(g==3){ genSel.innerHTML += '<option value="1"'+(savedGender==1?' selected':'')+'>Male</option><option value="2"'+(savedGender==2?' selected':'')+'>Female</option><option value="3"'+(savedGender==3?' selected':'')+'>Male &amp; Female</option>'; }
        else if(g==1){ genSel.innerHTML += '<option value="1"'+(savedGender==1?' selected':'')+'>Male</option>'; }
        else if(g==2){ genSel.innerHTML += '<option value="2"'+(savedGender==2?' selected':'')+'>Female</option>'; }
        else if(g==4){ genSel.innerHTML += '<option value="1"'+(savedGender==1?' selected':'')+'>Male</option><option value="2"'+(savedGender==2?' selected':'')+'>Female</option>'; }
        else { genSel.innerHTML += '<option value="1">Male</option><option value="2">Female</option><option value="3">Male &amp; Female</option>'; }
    }

    window.sportgender = sportgender;

    document.addEventListener('DOMContentLoaded', function(){
        var s = document.getElementById('sport');
        if(s && s.value) sportgender(s.value);
    });
})();
</script>

			</div>
		</div>
    @if ($trialType != 18)


		<div class="card" >

			<div class="card-body input_new" id="prodiv">

				<!--h2 class="text-center  mb-2"><input type="text"   placeholder="Sports College, Lucknow" style="
    width: 100%;
    font-weight: 700;
">
</h2>
			<h4 class="text-center mb-2">Preliminary Selection Exam 2022-23</h4>
			<h5 class="text-center mb-2">Name of The Game - Cricket (<input type="text"   placeholder="Batsman" style="
    width: 160px;
    font-weight: 700;
">)&nbsp;&nbsp;&nbsp;&nbsp; Category - Boys


				</h5-->


				<div class="table-responsive">
					<table id="dataTablee" class="table text-center table-bordered" style="
    font-size: smaller;
">
							<thead>
                                <tr>
                                    <th rowspan="3" valign="top">क्रस
                                    </th>
                                    <th rowspan="3" valign="top">फार्म सं0<br> </th>
                                    <th valign="top">उम्मीदवार का नाम<br> </th>
                                    <th valign="top">जन्म तिथि<br>
                                    </th>
                                    <th rowspan="3" valign="top"> राज्य
                                    </th>

                                    <th rowspan="3" valign="top"> जनपद
                                    </th>

                                    <th rowspan="3" valign="top"> लिंग
                                    </th>
                                    <th colspan="12" valign="top">शारीरिक परीक्षा<span lang="en"><br>
                                       </span>
                                        <br> पूर्णांक- 50</th>

                                        @if ($trialType == 1)
                                    <th colspan="7" valign="top">खेल परीक्षा<br> पूर्णांक - 50</th>
                                     @elseif ($trialType == 2)

                                     <th colspan="8" valign="top">खेल परीक्षा<br> पूर्णांक - 50</th>

                                     @elseif ($trialType == 3)

                                     <th colspan="7" valign="top">खेल परीक्षा<br> पूर्णांक - 50</th>

                                     @elseif ($trialType == 4)

                                     <th colspan="7" valign="top">खेल परीक्षा<br> पूर्णांक - 50</th>
                                     @elseif ($trialType == 5)

                                     <th colspan="5" valign="top">खेल परीक्षा<br> पूर्णांक - 50</th>
                                     @elseif ($trialType == 6)

                                     <th colspan="9" valign="top">खेल परीक्षा<br> पूर्णांक - 50</th>
                                     @elseif ($trialType == 7)

                                     <th colspan="7" valign="top">खेल परीक्षा<br> पूर्णांक - 50</th>
                                     @elseif ($trialType == 8)

                                     <th colspan="7" valign="top">खेल परीक्षा<br> पूर्णांक - 50</th>

                                     @elseif ($trialType == 9)

                                     <th colspan="7" valign="top">खेल परीक्षा<br> पूर्णांक - 50</th>


                                     @elseif ($trialType == 10)

                                     <th colspan="7" valign="top">खेल परीक्षा<br> पूर्णांक - 50</th>


                                     @elseif ($trialType == 11)

                                     <th colspan="7" valign="top">खेल परीक्षा<br> पूर्णांक - 50</th>


                                     @elseif ($trialType == 12)

                                     <th colspan="7" valign="top">खेल परीक्षा<br> पूर्णांक - 50</th>

                                     @elseif ($trialType == 13)

                                     <th colspan="7" valign="top">खेल परीक्षा<br> पूर्णांक - 50</th>

                                     @elseif ($trialType == 14)

                                     <th colspan="7" valign="top">खेल परीक्षा<br> पूर्णांक - 50</th>


                                     @elseif ($trialType == 15)

                                     <th colspan="7" valign="top">खेल परीक्षा<br> पूर्णांक - 50</th>


                                     @elseif ($trialType == 16)

                                     <th colspan="9" valign="top">खेल परीक्षा<br> पूर्णांक - 50</th>

                                     @elseif ($trialType == 17)

                                     <th colspan="7" valign="top">खेल परीक्षा<br> पूर्णांक - 50</th>
                                     @elseif ($trialType == 19)

                                     <th colspan="7" valign="top">खेल परीक्षा<br> पूर्णांक - 50</th>
                                     @elseif ($trialType == 20)

                                     <th colspan="7" valign="top">खेल परीक्षा<br> पूर्णांक - 50</th>
                                     @elseif ($trialType == 21)

                                     <th colspan="7" valign="top">खेल परीक्षा<br> पूर्णांक - 50</th>
                                     @elseif ($trialType == 22)

                                     <th colspan="7" valign="top">खेल परीक्षा<br> पूर्णांक - 50</th>

                                     @elseif ($trialType == 23)

                                     <th colspan="7" valign="top">खेल परीक्षा<br> पूर्णांक - 50</th>



                                     @elseif ($trialType == 24)

                                     <th colspan="10" valign="top">खेल परीक्षा<br> पूर्णांक - 50</th>


                                     @endif


    {{-- End change on basis of subSport and gender --}}


                                    @if ($trialType != 25)
                                    <th rowspan="3" valign="top">कुल प्रा०
                                        <br> पूर्ण०
                                         100<br>
                                    </th>
                                    <th rowspan="3" valign="top">अभ्यु०
                                    </th>
                                    <th rowspan="3" valign="top"> एक्शन
                                    </th>
                                    @endif
                                </tr>
                                <tr>
                                    <th rowspan="2" valign="top">&nbsp;

                                    </th>
                                    <th rowspan="2" valign="top">&nbsp;

                                    </th>
                                    <th colspan="2" valign="top">100मी<br> 10 अंक</th>
                                    <th colspan="2" valign="top">800मी0<br> 10अंक
                                    </th>
                                    <th colspan="2" valign="top">ब्रॉड जम्प<br> 10अंक
                                    </th>
                                    <th colspan="2" valign="top">शटल रन<br> 10अंक
                                    </th>
                                    <th colspan="2" valign="top">बाल थ्रो<br> 10अंक
                                    </th>
                                    @if ($trialType != 25)
                                    <th rowspan="2" valign="top">कुल प्रा०<br>
                                    </th>
                                    <th rowspan="2" valign="top">एक्शन
                                    </th>
                                    @endif


    {{--  change on basis of subSport and gender --}}



                                    @if ($trialType == 1)
                                    <th colspan="4" valign="top">स्किल टेस्ट
                                        <br> (पूर्ण० - 30)</th>
                                    <th valign="top">&nbsp;
                                    @elseif ($trialType == 2)
                                    <th colspan="5" valign="top">स्किल टेस्ट
                                        <br> (पूर्ण० - 30)</th>
                                    <th valign="top">&nbsp;


                                        @elseif ($trialType == 3)
                                    <th colspan="4" valign="top">स्किल टेस्ट
                                        <br> (पूर्ण० - 30)</th>
                                    <th valign="top">&nbsp;

                                        @elseif ($trialType == 4)
                                        <th colspan="4" valign="top">स्किल टेस्ट
                                            <br> (पूर्ण० - 30)</th>
                                        <th valign="top">&nbsp;


                                    @elseif ($trialType == 5)
                                    <th colspan="2" valign="top">स्किल टेस्ट
                                        <br> (पूर्ण० - 30)</th>
                                    <th valign="top">&nbsp;

                                    @elseif ($trialType == 6)
                                    <th colspan="6" valign="top">स्किल टेस्ट
                                        <br> (पूर्ण० - 30)</th>
                                    <th valign="top">&nbsp;

                                        @elseif ($trialType == 7)
                                    <th colspan="4" valign="top">स्किल टेस्ट
                                        <br> (पूर्ण० - 30)</th>
                                    <th valign="top">&nbsp;

                                        @elseif ($trialType == 8)
                                    <th colspan="4" valign="top">स्किल टेस्ट
                                        <br> (पूर्ण० - 30)</th>
                                    <th valign="top">&nbsp;

                                        @elseif ($trialType == 9)
                                    <th colspan="4" valign="top">स्किल टेस्ट
                                        <br> (पूर्ण० - 30)</th>
                                    <th valign="top">&nbsp;

                                        @elseif ($trialType == 10)
                                        <th colspan="4" valign="top">स्किल टेस्ट
                                            <br> (पूर्ण० - 30)</th>
                                        <th valign="top">&nbsp;

                                            @elseif ($trialType == 11)
                                        <th colspan="4" valign="top">स्किल टेस्ट
                                            <br> (पूर्ण० - 30)</th>
                                        <th valign="top">&nbsp;


                                        @elseif ($trialType == 12)
                                        <th colspan="4" valign="top">स्किल टेस्ट
                                            <br> (पूर्ण० - 30)</th>
                                        <th valign="top">&nbsp;


                                    @elseif ($trialType == 13)
                                    <th colspan="4" valign="top">स्किल टेस्ट
                                        <br> (पूर्ण० - 30)</th>
                                    <th valign="top">&nbsp;

                                        @elseif ($trialType == 14)
                                        <th colspan="4" valign="top">स्किल टेस्ट
                                            <br> (पूर्ण० - 30)</th>
                                        <th valign="top">&nbsp;


                                            @elseif ($trialType == 15)
                                            <th colspan="4" valign="top">स्किल टेस्ट
                                                <br> (पूर्ण० - 30)</th>
                                            <th valign="top">&nbsp;


                                        @elseif ($trialType == 16)
                                        <th colspan="6" valign="top">स्किल टेस्ट
                                            <br> (पूर्ण० - 30)</th>
                                        <th valign="top">&nbsp;

                                            @elseif ($trialType == 17)
                                            <th colspan="4" valign="top">स्किल टेस्ट
                                                <br> (पूर्ण० - 30)</th>
                                            <th valign="top">&nbsp;

                                                @elseif ($trialType == 19)
                                        <th colspan="4" valign="top">स्किल टेस्ट
                                            <br> (पूर्ण० - 30)</th>
                                        <th valign="top">&nbsp;

                                            @elseif ($trialType == 20)
                                            <th colspan="4" valign="top">स्किल टेस्ट
                                                <br> (पूर्ण० - 30)</th>
                                            <th valign="top">&nbsp;

                                                @elseif ($trialType == 21)
                                                <th colspan="4" valign="top">स्किल टेस्ट
                                                    <br> (पूर्ण० - 30)</th>
                                                <th valign="top">&nbsp;


                                                    @elseif ($trialType == 22)
                                                    <th colspan="4" valign="top">स्किल टेस्ट
                                                        <br> (पूर्ण० - 30)</th>
                                                    <th valign="top">&nbsp;

                                                        @elseif ($trialType == 23)
                                                        <th colspan="4" valign="top">स्किल टेस्ट
                                                            <br> (पूर्ण० - 30)</th>
                                                        <th valign="top">&nbsp;
                                                            @elseif ($trialType == 24)
                                                            <th colspan="8" valign="top">स्किल टेस्ट
                                                                <br> (पूर्ण० - 50)</th>
                                                            <th valign="top">&nbsp;

                                    @endif

    {{-- End change on basis of subSport and gender --}}




                                    </th>

                                    @if ($trialType != 24 && $trialType != 25)
                                    <th rowspan="2" valign="top"><span jsaction="blur:Om5fgd; click:JUJgG; focus:kFg5W; mouseout:Om5fgd; mouseover:kFg5W;XIxNK:LOG0D;w02ePb:RzCLcc" jsname="gm7qse" data-term-type="tl" role="button" tabindex="0" data-sl="hi" data-tl="en">खेल</span><br> टे०
                                        <br> पूर्ण०
                                        <br> 20
                                    </th>
                                    @endif
                                    @if ($trialType != 25)
                                    <th rowspan="2" valign="top">प्रा०<br> 50
                                    </th>
                                    @endif
                                </tr>
                                <tr>
                                    <th valign="top">स०</th>
                                    <th valign="top">अं०</th>
                                    <th valign="top">स०</th>
                                    <th valign="top">
                                        अं०</th>
                                    <th valign="top">दू०</th>
                                    <th valign="top" class="border-dark">अं०</th>
                                    <th valign="top">स०</th>
                                    <th valign="top">अं०</th>
                                    <th valign="top">दू०</th>
                                    <th valign="top">अं०</th>



                                    {{-- change on basis of subSport and gender --}}





                                    @if ($trialType == 1)
                                    <th valign="top"> हिट<br> 7.5
                                    </th>
                                    <th valign="top">
                                        पुश
                                        <br> 7.5
                                        <br>
                                    </th>
                                    <th valign="top">स्कूप
                                        <br> 7.5
                                    </th>

                                    <th valign="top">
                                        <p>ड्रिब्लिंग
                                            <br> 7.5
                                        </p>
                                    </th>

                                    @elseif ($trialType == 2)
                                    <th valign="top"> किक<br> 6
                                    </th>
                                    <th valign="top">
                                        पैड <br> 6
                                        <br>
                                    </th>
                                    <th valign="top">स्टॉप
                                        <br> 6
                                    </th>

                                    <th valign="top">
                                        <p>हाई <br> पुश
                                            <br> 6
                                        </p>
                                    </th>
                                    <th valign="top">
                                        <p>	हिमात
                                            <br> 6
                                        </p>
                                    </th>



                                    @elseif ($trialType == 3)
                                    <th valign="top">हाई <br>सर्विस/
                                    <br>डबल <br>
                                        सर्विस <br>/टॉस <br> 7.5
                                    </th>
                                    <th valign="top">
                                        स्मैश

                                        <br>7.5
                                        <br>
                                    </th>
                                    <th valign="top">ड्राप
                                        <br> 7.5
                                    </th>

                                    <th valign="top">
                                        <p>बैकहैंड
                                            <br> 7.5
                                        </p>
                                    </th>


                                    @elseif ($trialType == 4)
                                    <th valign="top">अंडर<br> हैंड
                                         <br> 7.5
                                    </th>
                                    <th valign="top">
                                        उप्पेर <br> हैंड

                                        <br>7.5
                                        <br>
                                    </th>
                                    <th valign="top">सर्विस
                                        <br> 7.5
                                    </th>

                                    <th valign="top">
                                        <p>स्मैश

                                            <br> 7.5
                                        </p>
                                    </th>


                                    @elseif ($trialType == 5)
                                    <th valign="top">ग्रा॰ पो॰  <br>(फेस<br> टू फेस/बैक <br> पो॰)

                                         <br> 15
                                    </th>
                                    <th valign="top">
                                        स्टै॰ पो॰<br> (फ्रन्ट पो॰/<br>बैक पो॰)

                                        <br>15
                                        <br>
                                    </th>

                                    @elseif ($trialType == 6)
                                    <th valign="top">
                                        फ्री <br>स्टा॰

                                        <br>5
                                        <br>
                                    </th>
                                    <th valign="top">
                                        बैक<br>स्ट्रो

                                        <br>5
                                        <br>
                                    </th>
                                    <th valign="top">
                                        बे्रस्ट <br>स्ट्रो

                                        <br>5
                                        <br>
                                    </th>
                                   <th valign="top">
                                    बटर <br> फ्लाइ
                                       <br>5
                                       <br>
                                   </th>
                                   <th valign="top">
                                    ग्लाइडिंग
                                    <br> 5
                               </th>

                               <th valign="top">
                                स्टार्ट

                                <br> 5
                           </th>

                               @elseif ($trialType == 7)
                               <th valign="top">
                                ग्रिप

                                   <br>7.5
                                   <br>
                               </th>
                               <th valign="top">
                                डाइव

                                   <br>7.5
                                   <br>
                               </th>
                               <th valign="top">
                                पैच

                                   <br>7.5
                                   <br>
                               </th>
                              <th valign="top">
                                किक


                                  <br>7.5
                                  <br>
                              </th>

                              @elseif ($trialType == 8)
                              <th valign="top">
                                किक

                                  <br>7.5
                                  <br>
                              </th>
                              <th valign="top">
                                ड्रिब/ <br>टेक्ल <br>


                                  <br>7.5
                                  <br>
                              </th>
                              <th valign="top">
                                हेड
                                  <br>7.5
                                  <br>
                              </th>
                             <th valign="top">
                                कान्ट्रो/  <br>पैड/  <br>


                                 <br>7.5
                                 <br>
                             </th>

                             @elseif ($trialType == 9)
                             <th valign="top">
                                एप्रोच

                                 <br>7.5
                                 <br>
                             </th>
                             <th valign="top">
                                टे॰आ॰



                                 <br>7.5
                                 <br>
                             </th>
                             <th valign="top">
                                एक्शन


                                 <br>7.5
                                 <br>
                             </th>
                            <th valign="top">
                                लैण्डिंग


                                <br>7.5
                                <br>
                            </th>


                            @elseif ($trialType == 10)
                            <th valign="top">
                                ग्रिप/ <br> स्टान्स <br> बैकलिफ्ट


                                <br>7.5
                                <br>
                            </th>
                            <th valign="top">
                                बाल <br> सेलेक

                                <br>7.5
                                <br>
                            </th>
                            <th valign="top">
                                फ्रन्ट <br> फुट/ <br> बैक <br> फुट

                                <br>7.5
                                <br>
                            </th>
                           <th valign="top">
                            फ्रन्ट <br> फुट/ <br> बैक <br> फुट <br> ड्रा0/

                               <br>7.5
                               <br>
                           </th>


                           @elseif ($trialType == 11)
                            <th valign="top">
                                रनअप/<br>एक्शन/<br>फालोथ्रू<br>


                                <br>7.5
                                <br>
                            </th>
                            <th valign="top">
                                स्विंग/<br>स्पिन

                                <br>7.5
                                <br>
                            </th>
                            <th valign="top">
                                लाइन <br>लेन्थ

                                <br>7.5
                                <br>
                            </th>
                           <th valign="top">
                            स्पीड/<br>फ्लाइट

                               <br>7.5
                               <br>
                           </th>


                           @elseif ($trialType == 12)
                           <th valign="top">
                            स्टम्पिंग

                               <br>7.5
                               <br>
                           </th>
                           <th valign="top">
                            गैदरिंग
                               <br>7.5
                               <br>
                           </th>
                           <th valign="top">
                            आफ <br> स्टम्पिंग <br>गैदरिंग

                               <br>7.5
                               <br>
                           </th>
                          <th valign="top">
                            आन <br>स्टम्पिंग <br>गैदरिंग

                              <br>7.5
                              <br>
                          </th>


                          @elseif ($trialType == 13)
                          <th valign="top">
                            रेड

                              <br>7.5
                              <br>
                          </th>
                          <th valign="top">
                            किक/ <br>स्किल

                              <br>7.5
                              <br>
                          </th>
                          <th valign="top">
                            कवरिंग
                              <br>7.5
                              <br>
                          </th>
                         <th valign="top">
                            पकड़

                             <br>7.5
                             <br>
                         </th>

                         @elseif ($trialType == 14)
                         <th valign="top">
                            स्टै॰  <br> वर्क  <br>थ्रो
                             <br>7.5
                             <br>
                         </th>
                         <th valign="top">
                            हिप, <br> लेग, <br> हैण्ड  <br> टै॰
                         <br>7.5
                             <br>
                         </th>
                         <th valign="top">
                            थ्रो <br> का <br> काउ॰

                             <br>7.5
                             <br>
                         </th>
                        <th valign="top">
                            थ्रो 	<br> का 	<br>काप्बी॰

                            <br>7.5
                            <br>
                        </th>

                        @elseif ($trialType == 15)
                        <th valign="top">
                            स्टान्स

                            <br>7.5
                            <br>
                        </th>
                        <th valign="top">
                            स्टार्ट

                            <br>7.5
                            <br>
                        </th>
                        <th valign="top">
                            एक्शन


                            <br>7.5
                            <br>
                        </th>
                       <th valign="top">
                        फिनिश
                           <br>7.5
                           <br>
                       </th>


                       @elseif ($trialType == 16)
                       <th valign="top">
                        फ्लोर

                           <br>5
                           <br>
                       </th>
                       <th valign="top">
                        पामे    <br>हार्स

                           <br>5
                           <br>
                       </th>
                       <th valign="top">
                        रिंग

                           <br>5
                           <br>
                       </th>
                      <th valign="top">
                        वाल्विंग<br> हार्स

                          <br>5
                          <br>
                      </th>
                      <th valign="top">
                        पैरे  <br> बार

                        <br>5
                        <br>
                    </th>
                   <th valign="top">
                    हारि॰<br> बार

                       <br>5
                       <br>
                   </th>

                      @elseif ($trialType == 17)
                      <th valign="top">
                        बैल॰  <br> बी॰ / <br>

                          <br>7.5
                          <br>
                      </th>
                      <th valign="top">
                        अन<br> इवन <br>बार

                          <br>7.5
                          <br>
                      </th>
                      <th valign="top">
                        फ्लोर  <br> एक्स॰

                          <br>7.5
                          <br>
                      </th>
                     <th valign="top">
                        वाल्विंग <br> हार्स


                         <br>7.5
                         <br>
                     </th>


                     @elseif ($trialType == 19)
                     <th valign="top">
                     थ्रो
                     स्टान्स

                         <br>7.5
                         <br>
                     </th>
                     <th valign="top">
                     एक्शन
                         <br>7.5
                         <br>
                     </th>
                     <th valign="top">
                        क्यजीशन

                         <br>7.5
                         <br>
                     </th>
                    <th valign="top">
                     फालो थ्रो

                        <br>7.5
                        <br>
                    </th>


                    @elseif ($trialType == 20)
                    <th valign="top">
                        पंचिंग पैड
                        <br>7.5
                        <br>
                    </th>
                    <th valign="top">
                        शैडो   बॉक्सिंग
                        <br>7.5
                        <br>
                    </th>
                    <th valign="top">
                        स्कीपिंक
                     <br>
                      7.5
                        <br>
                    </th>
                   <th valign="top">
                    स्पैरिंग

                       <br>7.5
                       <br>
                   </th>

                   @elseif ($trialType == 19)
                   <th valign="top">
                   थ्रो
                   स्टान्स

                       <br>7.5
                       <br>
                   </th>
                   <th valign="top">
                   एक्शन

                       <br>7.5
                       <br>
                   </th>
                   <th valign="top">
                      क्यजीशन

                       <br>7.5
                       <br>
                   </th>
                  <th valign="top">
                   फालो थ्रो

                      <br>7.5
                      <br>
                  </th>


                  @elseif ($trialType == 21)
                  <th valign="top">
                    डिबलिंग
                      <br>7.5
                      <br>
                  </th>
                  <th valign="top">
                    पासिंग
                      <br>7.5
                      <br>
                  </th>
                  <th valign="top">
                    स्टैण्डिंग
                    7.5
                      <br>
                  </th>
                 <th valign="top">
                 जंप शॉट


                     <br>7.5
                     <br>
                 </th>


                 @elseif ($trialType == 22)
                 <th valign="top">
                    काउण्टर
                     <br>7.5
                     <br>
                 </th>
                 <th valign="top">
                    पुश

                     <br>7.5
                     <br>
                 </th>
                 <th valign="top">
                    ब्लाक
                  <br>
                   7.5
                     <br>
                 </th>
                <th valign="top">
                    सर्विस


                    <br>7.5
                    <br>
                </th>

                @elseif ($trialType == 23)
                <th valign="top">
                    कैच/पास

                    <br>7.5
                    <br>
                </th>
                <th valign="top">
                    डिबलिंग

                    <br>7.5
                    <br>
                </th>
                <th valign="top">
                    स्टेण्डिंगशाट
                 <br>
                  7.5
                    <br>
                </th>
               <th valign="top">
                जम्पशाट


                   <br>7.5
                   <br>
               </th>



               @elseif ($trialType == 24)
               <th valign="top">
                स्टांस

                   <br>5
                   <br>
               </th>
               <th valign="top">
                नाकिंग
                   <br>5
                   <br>
               </th>
               <th valign="top">
                एक्सटेंसिंग
                <br>
                 5
                   <br>
               </th>

               <th valign="top">
                ड्राइंग
                <br>
                 5
                   <br>
               </th>

               <th valign="top">
                एंकरिंग
                <br>
                 6
                   <br>
               </th>

               <th valign="top">
                टाइटेन होल्ड


                  <br>6
                  <br>
              </th>

               <th valign="top">
                एमिंग
                <br>
                 6
                   <br>
               </th>

               <th valign="top">
                टाइटेन रिलीज
                <br>
                 6
                   <br>
               </th>

               <th valign="top">
                आफ्टर होल्ड
                <br>
                 6
                   <br>
               </th>







                                    @endif





    {{-- End change on basis of subSport and gender --}}


                                @if ($trialType != 24)
                                    <th valign="top">
                                        <p>प्रा०<br> 30
                                        </p>
                                    </th>
                                    @endif
                                </tr>
                            </thead>
						<tbody>

@foreach ($applicants as $key=>$applicant)

	<tr>
<form action="{{route('hosteltrialListApplicantStore')}}"  method="POST" id="form_{{$applicant->id}}" class="needs-validation applicantData"  novalidate >

		@if(isset($applicant->application_no)) <?php $trial = hosteltrialData($applicant->application_no , 4);?>
		@if(isset($trial))

		@endif
		@endif
		<td valign="bottom">
		{{$key+1}}
		</td>
		<td valign="top">
			{{$applicant->application_no}}
		</td>
		<td valign="top">
			{{$applicant->fullname}}
		</td>
        <td valign="top">

			{{dmy($applicant->dob)}}
		</td>

        <td valign="top">

            Uttar Pradesh
        </td>
        <td valign="top">
            {{districtName($applicant->district_id)}}</td>
        <td valign="top">
            @if($applicant->gender == 1) Male @else Female @endif</td>

            <td><input type="hidden" name="application_no" value="{{$applicant->application_no}}">
                <input type="hidden" name="applicant_id" value="{{$applicant->id}}">
                <input type="hidden" name="gender" value="{{$applicant->gender}}">
                <input type="hidden" name="trial_type" value="4">
                <input type="hidden" name="sport_id" value="{{$filterData['sport_id']}}">
                <input type="hidden" name="subsport_id" value="{{$filterData['subSport']}}">

                <input type="number" name="hundred_mt_time" id="hundtime{{$applicant->id}}" @if(isset($trial) && $trial->hundred_mt_time != '') readonly @endif value="@if(isset($trial)){{($trial->hundred_mt_time)}}@endif"  oninput="hundred_mt_score({{$applicant->id}},{{$applicant->gender}},{{get_age($applicant->dob, config('app.session_year') . '-04-01')}})" required style="
                width: 50px;
                font-weight: 400;
                background: none;
                border: 1px solid #cdcdcd;
            ">
                      </td>
                      <td><input type="number" name="hundred_mt_mark" max="10"  id="hund{{$applicant->id}}"  oninput="allAdd({{$applicant->id}})" required @if(isset($trial) && $trial->hundred_mt_mark != '') readonly @endif  value="@if(isset($trial)){{($trial->hundred_mt_mark)}}@endif" style="
                width: 50px;
                font-weight: 400;
                background: none;
                border: 1px solid #cdcdcd;
            "></td>
                      <td class="d-flex"><input type="number" name="eight_hundred_mt_time" id="eighttime{{$applicant->id}}" required @if(isset($trial) && $trial->eight_hundred_mt_time != '') readonly @endif value="@if(isset($trial)){{($trial->eight_hundred_mt_time)}}@endif"  onblur="eight_mt_score({{$applicant->id}},{{$applicant->gender}},{{get_age($applicant->dob, config('app.session_year') . '-04-01')}})" style="
                width: 50px;
                font-weight: 400;
                background: none;
                border: 1px solid #cdcdcd;
            ">

        </td>

                      <td><input type="number" name="eight_hundred_mt_mark" max="10" id="eight{{$applicant->id}}" oninput="allAdd({{$applicant->id}})" required @if(isset($trial) && $trial->eight_hundred_mt_mark != '') readonly @endif value="@if(isset($trial)){{($trial->eight_hundred_mt_mark)}}@endif"  style="
                width: 50px;
                font-weight: 400;
                background: none;
                border: 1px solid #cdcdcd;
            "></td>
                      <td><input type="number" name="broad_jump_distance" max="10" id="jumpdist{{$applicant->id}}" required @if(isset($trial) && $trial->broad_jump_distance != '') readonly @endif value="@if(isset($trial)){{($trial->broad_jump_distance)}}@endif" oninput="jumpdist_score({{$applicant->id}},{{$applicant->gender}},{{get_age($applicant->dob, config('app.session_year') . '-04-01')}})" style="
                width: 50px;
                font-weight: 400;
                background: none;
                border: 1px solid #cdcdcd;
            "></td>
                      <td><input type="number" name="broad_jump_mark" max="10" id="jump{{$applicant->id}}" oninput="allAdd({{$applicant->id}})" required @if(isset($trial) && $trial->broad_jump_mark != '') readonly @endif value="@if(isset($trial)){{($trial->broad_jump_mark)}}@endif"  style="
                width: 50px;
                font-weight: 400;
                background: none;
                border: 1px solid #cdcdcd;
            "></td>
                      <td><input type="number" name="shuttle_run_time" max="10" id="shuttletime{{$applicant->id}}" required @if(isset($trial) && $trial->shuttle_run_time != '') readonly @endif value="@if(isset($trial)){{($trial->shuttle_run_time)}}@endif" oninput="shuttletime_score({{$applicant->id}},{{$applicant->gender}},{{get_age($applicant->dob, config('app.session_year') . '-04-01')}})"  style="
                width: 50px;
                font-weight: 400;
                background: none;
                border: 1px solid #cdcdcd;
            "></td>
                      <td><input type="number" name="shuttle_run_mark" max="10" id="shuttle{{$applicant->id}}" oninput="allAdd({{$applicant->id}})" required @if(isset($trial) && $trial->shuttle_run_mark != '') readonly @endif value="@if(isset($trial)){{($trial->shuttle_run_mark)}}@endif"   style="
                width: 50px;
                font-weight: 400;
                background: none;
                border: 1px solid #cdcdcd;
            "></td>
                      <td><input type="number" name="ball_throw_distance" max="10" id="balldist{{$applicant->id}}" required @if(isset($trial) && $trial->ball_throw_distance != '') readonly @endif value="@if(isset($trial)){{($trial->ball_throw_distance)}}@endif"  oninput="balldist_score({{$applicant->id}},{{$applicant->gender}},{{get_age($applicant->dob, config('app.session_year') . '-03-31')}})"  style="
                width: 50px;
                font-weight: 400;
                background: none;
                border: 1px solid #cdcdcd;
            "></td>
                      <td><input type="number" name="ball_throw_mark" max="10" id="ball{{$applicant->id}}" oninput="allAdd({{$applicant->id}})" required @if(isset($trial) && $trial->ball_throw_mark != '') readonly @endif value="@if(isset($trial)){{($trial->ball_throw_mark)}}@endif"  style="
                width: 50px;
                font-weight: 400;
                background: none;
                border: 1px solid #cdcdcd;
            "></td>
                      <td><input type="number" class="stop" data-id="{{$applicant->id}}"   name="physical_total_mark" max="50" id="phy{{$applicant->id}}" required @if(isset($trial) && $trial->physical_total_mark != '') readonly @endif value="@if(isset($trial)){{($trial->physical_total_mark)}}@endif" style="
                width: 50px;
                font-weight: 400;
                background: none;
                border: 2px solid #868686;
            "></td>
                      <td><input type="checkbox" @if(isset($trial)) disabled checked @endif id="check{{$applicant->id}}" onChange="myfunction({{$applicant->id}})" style="
                width: 50px;
                font-weight: 400;
                background: none;
                border: 1px solid #cdcdcd;
            "></td>



									</form>

{{-- change on basis of subSport and gender --}}

	                  @if ($trialType != 25)
	                  @if ($trialType == 1)

						<form action="{{route('hostelhockeytrialList')}}" id="hockey_{{$applicant->id}}" class="needs-validation hockeyData"  novalidate method="post">

							@if(isset($applicant->application_no)) <?php $trialhockey = hosteltrialhockeyData($applicant->application_no, 4);?>
							@if(isset($trialhockey))

							@endif
							@endif
						<td>
							<input type="hidden" name="application_no" value="{{$applicant->application_no}}">
							<input type="hidden" name="applicant_id" value="{{$applicant->id}}">
							<input type="hidden" name="sport_id" value="{{$filterData['sport_id']}}">
                            <input type="hidden" name="trial_type" value="4">
							<input type="number"  class="stop-{{$applicant->id}}" name="hit_mark"  @if(isset($trialhockey) && $trialhockey->hit_mark != '') readonly @endif  value="@if(isset($trialhockey)){{$trialhockey->hit_mark}}@endif"  oninput="hockeyskillTotal({{$applicant->id}})" id="hit_mark{{$applicant->id}}" style="
						width: 50px;
						font-weight: 400;
						background: none;
						border: 1px solid #cdcdcd;
						">
						</td>
						<td><input type="number"  class="stop-{{$applicant->id}}"  name="push_mark" @if(isset($trialhockey) && $trialhockey->push_mark != '') readonly @endif value="@if(isset($trialhockey)){{$trialhockey->push_mark}}@endif" id="push_mark{{$applicant->id}}"  oninput="hockeyskillTotal({{$applicant->id}})"  style="
						width: 50px;
						font-weight: 400;
						background: none;
						border: 1px solid #cdcdcd;
						">
						</td>
						<td><input type="number"  class="stop-{{$applicant->id}}"  name="scoop_mark" @if(isset($trialhockey) && $trialhockey->scoop_mark != '') readonly @endif value="@if(isset($trialhockey)){{$trialhockey->scoop_mark}}@endif"  id="scoop_mark{{$applicant->id}}"  oninput="hockeyskillTotal({{$applicant->id}})"  style="
						width: 50px;
						font-weight: 400;
						background: none;
						border: 1px solid #cdcdcd;
						">
						</td>
						<td><input type="number"  class="stop-{{$applicant->id}}" name="dribbling_mark" @if(isset($trialhockey) && $trialhockey->dribbling_mark != '') readonly @endif value="@if(isset($trialhockey)){{$trialhockey->dribbling_mark}}@endif"  id="dribbling_mark{{$applicant->id}}"  oninput="hockeyskillTotal({{$applicant->id}})"  style="
							width: 50px;
							font-weight: 400;
							background: none;
							border: 1px solid #cdcdcd;
							">
						</td>

						<td><input type="number"  class="stop-{{$applicant->id}}" name="test_score_mark"   @if(isset($trialhockey) && $trialhockey->test_score_mark != '') readonly @endif value="@if(isset($trialhockey)){{$trialhockey->test_score_mark}}@endif"  id="test_score_mark{{$applicant->id}}"    style="
						width: 50px;
						font-weight: 400;
						background: none;
						border: 2px solid #868686;
						">
						</td>
						<td><input type="number"  class="stop-{{$applicant->id}}" name="game_technique"   @if(isset($trialhockey) && $trialhockey->game_technique != '') readonly @endif   value="@if(isset($trialhockey)){{$trialhockey->game_technique}}@endif"  oninput="mainTotal({{$applicant->id}})" id="game_technique{{$applicant->id}}" style="
						width: 50px;
						font-weight: 400;
						background: none;
						border: 1px solid #cdcdcd;
						">
						</td>
						<td><input type="number"  class="stop-{{$applicant->id}}"   name="sport_test_mark" @if(isset($trialhockey) && $trialhockey->sport_test_mark != '') readonly @endif   value="@if(isset($trialhockey)){{$trialhockey->sport_test_mark}}@endif"  id="sport_test_mark{{$applicant->id}}" style="
						width: 50px;
						font-weight: 400;
						background: none;
						border: 2px solid #868686;
						">
						</td>
						<td><input type="number"  class="stop-{{$applicant->id}}"   name="total_obtain_mark"@if(isset($trialhockey) && $trialhockey->total_obtain_mark != '') readonly @endif value="@if(isset($trialhockey)){{$trialhockey->total_obtain_mark}}@endif"  id="total_obtain_mark{{$applicant->id}}" style="
							width: 50px;
							font-weight: 400;
							background: none;
							border: 2px solid #868686;
							">
							</td>
						<td><input type="text"  class="stop-{{$applicant->id}}" name="remark" @if(isset($trialhockey) && $trialhockey->remark != '') readonly @endif value="@if(isset($trialhockey)){{$trialhockey->remark}}@endif"  id="remark{{$applicant->id}}" style="
						width: 50px;
						font-weight: 400;
						background: none;
						border: 1px solid #cdcdcd;
						">
																													</td>
						<td><input type="checkbox"  class="stop-{{$applicant->id}}" id="checkhockey{{$applicant->id}}" @if(isset($trialhockey)) checked disabled @endif   onChange="hockeyData({{$applicant->id}})"  {{$applicant->id}}  style="
						width: 50px;
						font-weight: 400;
						background: none;
						border: 1px solid #cdcdcd;
						">
						</td>
						</form>



																									</td>
	@elseif ($trialType == 2)

					<form action="{{route('hostelhockeykeepertrialList')}}" id="hockeykeeper_{{$applicant->id}}" class="needs-validation hockeykeeperData"  novalidate method="post">

						@if(isset($applicant->application_no)) <?php $trialhockeykeeper = hosteltrialhockeykeeperData($applicant->application_no, 4);?>
						@if(isset($trialhockeykeeper))

						@endif
						@endif
					<td>
						<input type="hidden" name="application_no" value="{{$applicant->application_no}}">
						<input type="hidden" name="applicant_id" value="{{$applicant->id}}">
						<input type="hidden" name="sport_id" value="{{ data_get($filterData, 'sport_id') }}">
                        <input type="hidden" name="trial_type" value="4">
						<input type="number"  class="stop-{{$applicant->id}}" name="kick_mark"  @if(isset($trialhockeykeeper) && $trialhockeykeeper->kick_mark != '') readonly @endif  value="@if(isset($trialhockeykeeper)){{$trialhockeykeeper->kick_mark}}@endif"  oninput="hockeykeeperskillTotal({{$applicant->id}})" id="kick_mark{{$applicant->id}}" style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 1px solid #cdcdcd;
					">
					</td>
					<td><input type="number"  class="stop-{{$applicant->id}}" name="pad_mark" @if(isset($trialhockeykeeper) && $trialhockeykeeper->pad_mark != '') readonly @endif value="@if(isset($trialhockeykeeper)){{$trialhockeykeeper->pad_mark}}@endif" id="pad_mark{{$applicant->id}}"  oninput="hockeykeeperskillTotal({{$applicant->id}})"  style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 1px solid #cdcdcd;
					">
					</td>
					<td><input type="number"  class="stop-{{$applicant->id}}" name="stop_mark" @if(isset($trialhockeykeeper) && $trialhockeykeeper->stop_mark != '') readonly @endif value="@if(isset($trialhockeykeeper)){{$trialhockeykeeper->stop_mark}}@endif"  id="stop_mark{{$applicant->id}}"  oninput="hockeykeeperskillTotal({{$applicant->id}})"  style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 1px solid #cdcdcd;
					">
					</td>
					<td><input type="number"  class="stop-{{$applicant->id}}" name="high_push_mark" @if(isset($trialhockeykeeper) && $trialhockeykeeper->high_push_mark != '') readonly @endif value="@if(isset($trialhockeykeeper)){{$trialhockeykeeper->high_push_mark}}@endif"  id="high_push_mark{{$applicant->id}}"  oninput="hockeykeeperskillTotal({{$applicant->id}})"  style="
						width: 50px;
						font-weight: 400;
						background: none;
						border: 1px solid #cdcdcd;
						">
					</td>
					<td><input type="number"  class="stop-{{$applicant->id}}" name="himmat_mark" @if(isset($trialhockeykeeper) && $trialhockeykeeper->himmat_mark != '') readonly @endif value="@if(isset($trialhockeykeeper)){{$trialhockeykeeper->himmat_mark}}@endif"  id="himmat_mark{{$applicant->id}}"  oninput="hockeykeeperskillTotal({{$applicant->id}})"  style="
						width: 50px;
						font-weight: 400;
						background: none;
						border: 1px solid #cdcdcd;
						">
					</td>
					<td><input type="number"  class="stop-{{$applicant->id}}" name="test_score_mark"   @if(isset($trialhockeykeeper) && $trialhockeykeeper->test_score_mark != '') readonly @endif value="@if(isset($trialhockeykeeper)){{$trialhockeykeeper->test_score_mark}}@endif"  id="test_score_mark{{$applicant->id}}"    style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 2px solid #868686;
					">
					</td>
					<td><input type="number"  class="stop-{{$applicant->id}}" name="game_technique"   @if(isset($trialhockeykeeper) && $trialhockeykeeper->game_technique != '') readonly @endif   value="@if(isset($trialhockeykeeper)){{$trialhockeykeeper->game_technique}}@endif"  oninput="mainTotal({{$applicant->id}})" id="game_technique{{$applicant->id}}" style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 1px solid #cdcdcd;
					">
					</td>
					<td><input type="number"  class="stop-{{$applicant->id}}"   name="sport_test_mark" @if(isset($trialhockeykeeper) && $trialhockeykeeper->sport_test_mark != '') readonly @endif   value="@if(isset($trialhockeykeeper)){{$trialhockeykeeper->sport_test_mark}}@endif"  id="sport_test_mark{{$applicant->id}}" style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 2px solid #868686;
					">
					</td>
					<td><input type="number"  class="stop-{{$applicant->id}}"   name="total_obtain_mark"@if(isset($trialhockeykeeper) && $trialhockeykeeper->total_obtain_mark != '') readonly @endif value="@if(isset($trialhockeykeeper)){{$trialhockeykeeper->total_obtain_mark}}@endif"  id="total_obtain_mark{{$applicant->id}}" style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 2px solid #868686;
					">
					</td>
					<td><input type="text"  class="stop-{{$applicant->id}}" name="remark" @if(isset($trialhockeykeeper) && $trialhockeykeeper->remark != '') readonly @endif value="@if(isset($trialhockeykeeper)){{$trialhockeykeeper->remark}}@endif"  id="remark{{$applicant->id}}" style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 1px solid #cdcdcd;
					">
																												</td>
					<td><input type="checkbox"  class="stop-{{$applicant->id}}"  id="checkhockeykeeper{{$applicant->id}}" @if(isset($trialhockeykeeper) && $trialhockeykeeper->total_obtain_mark != '') checked disabled @endif   onChange="hockeykeeperData({{$applicant->id}})"  {{$applicant->id}}  style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 1px solid #cdcdcd;
					">
					</td>
					</form>



		            @elseif ($trialType == 3)


							<form action="{{route('hostelbadmintontrialList')}}" id="badmin_{{$applicant->id}}" class="needs-validation badminData"  novalidate method="post">

								@if(isset($applicant->application_no)) <?php $trialbadminton = hosteltrialBadmintonData($applicant->application_no , 4);?>
								@if(isset($trialbadminton))

								@endif
								@endif
							<td>
								<input type="hidden" name="application_no" value="{{$applicant->application_no}}">
								<input type="hidden" name="applicant_id" value="{{$applicant->id}}">
								<input type="hidden" name="sport_id" value="{{ data_get($filterData, 'sport_id') }}">
                                <input type="hidden" name="trial_type" value="4">
								<input type="number"  class="stop-{{$applicant->id}}" name="high_double_service_mark"  @if(isset($trialbadminton) && $trialbadminton->high_double_service_mark != '') readonly @endif  value="@if(isset($trialbadminton)){{($trialbadminton->high_double_service_mark)}}@endif"  oninput="badskillTotal({{$applicant->id}})" id="high_double_service_mark{{$applicant->id}}" style="
							width: 50px;
							font-weight: 400;
							background: none;
							border: 1px solid #cdcdcd;
							">
							</td>
							<td><input type="number"  class="stop-{{$applicant->id}}" name="smash_mark" @if(isset($trialbadminton) && $trialbadminton->smash_mark != '') readonly @endif value="@if(isset($trialbadminton)){{$trialbadminton->smash_mark}}@endif" id="smash_mark{{$applicant->id}}"  oninput="badskillTotal({{$applicant->id}})"  style="

							width: 50px;
							font-weight: 400;
							background: none;
							border: 1px solid #cdcdcd;
							">
							</td>

							<td><input type="number"  class="stop-{{$applicant->id}}" name="drop_mark" @if(isset($trialbadminton) && $trialbadminton->drop_mark != '') readonly @endif value="@if(isset($trialbadminton)){{$trialbadminton->drop_mark}}@endif"  id="drop_mark{{$applicant->id}}"  oninput="badskillTotal({{$applicant->id}})"  style="
							width: 50px;
							font-weight: 400;
							background: none;
							border: 1px solid #cdcdcd;
							">
							</td>
							<td><input type="number"  class="stop-{{$applicant->id}}" name="backhand_mark" @if(isset($trialbadminton) && $trialbadminton->backhand_mark != '') readonly @endif value="@if(isset($trialbadminton)){{$trialbadminton->backhand_mark}}@endif"  id="backhand_mark{{$applicant->id}}"  oninput="badskillTotal({{$applicant->id}})"  style="
							width: 50px;
							font-weight: 400;
							background: none;
							border: 1px solid #cdcdcd;
							">
							</td>
							<td><input type="number"  class="stop-{{$applicant->id}}" name="test_score_mark"   @if(isset($trialbadminton) && $trialbadminton->test_score_mark != '') readonly @endif value="@if(isset($trialbadminton)){{$trialbadminton->test_score_mark}}@endif"  id="test_score_mark{{$applicant->id}}"    style="
							width: 50px;
							font-weight: 400;
							background: none;
							border: 2px solid #868686;
							">
							</td>
							<td><input type="number"  class="stop-{{$applicant->id}}" name="game_technique"   @if(isset($trialbadminton) && $trialbadminton->game_technique != '') readonly @endif   value="@if(isset($trialbadminton)){{$trialbadminton->game_technique}}@endif"  oninput="mainTotal({{$applicant->id}})" id="game_technique{{$applicant->id}}" style="
							width: 50px;
							font-weight: 400;
							background: none;
							border: 1px solid #cdcdcd;
							">
							</td>
							<td><input type="number"  class="stop-{{$applicant->id}}"  name="sport_test_mark" @if(isset($trialbadminton) && $trialbadminton->sport_test_mark != '') readonly @endif   value="@if(isset($trialbadminton)){{$trialbadminton->sport_test_mark}}@endif"  id="sport_test_mark{{$applicant->id}}" style="
							width: 50px;
							font-weight: 400;
							background: none;
							border: 2px solid #868686;
							">
							</td>
							<td><input type="number"  class="stop-{{$applicant->id}}" name="total_obtain_mark"@if(isset($trialbadminton) && $trialbadminton->total_obtain_mark != '') readonly @endif value="@if(isset($trialbadminton)){{$trialbadminton->total_obtain_mark}}@endif"  id="total_obtain_mark{{$applicant->id}}" style="
							width: 50px;
							font-weight: 400;
							background: none;
							border: 2px solid #868686;
							">
							</td>
							<td><input type="text" name="remark"  class="stop-{{$applicant->id}}" @if(isset($trialbadminton) && $trialbadminton->remark != '') readonly @endif value="@if(isset($trialbadminton)){{$trialbadminton->remark}}@endif"  id="remark{{$applicant->id}}" style="
							width: 50px;
							font-weight: 400;
							background: none;
							border: 1px solid #cdcdcd;
							">
																														</td>
							<td><input type="checkbox"  class="stop-{{$applicant->id}}" id="checkbad{{$applicant->id}}" @if(isset($trialbadminton) && $trialbadminton->total_obtain_mark != '') checked disabled @endif   onChange="badminData({{$applicant->id}})"  {{$applicant->id}}  style="
							width: 50px;
							font-weight: 400;
							background: none;
							border: 1px solid #cdcdcd;
							">
							</td>


							</form>
	                    	@elseif ($trialType == 4)


							<form action="{{route('hostelvolleyBalltrialList')}}" id="volleyball_{{$applicant->id}}" class="needs-validation volleyballData"  novalidate method="post">

								@if(isset($applicant->application_no)) <?php $trialvolleyball = hosteltrialvolleyballData($applicant->application_no ,4);?>
								@if(isset($trialvolleyball))

								@endif
								@endif
							<td>
								<input type="hidden" name="application_no" value="{{$applicant->application_no}}">
								<input type="hidden" name="applicant_id" value="{{$applicant->id}}">
								<input type="hidden" name="sport_id" value="{{ data_get($filterData, 'sport_id') }}">
                                <input type="hidden" name="trial_type" value="4">
								<input type="number"  class="stop-{{$applicant->id}}" name="under_hand_mark"  @if(isset($trialvolleyball) && $trialvolleyball->under_hand_mark != '') readonly @endif  value="@if(isset($trialvolleyball)){{$trialvolleyball->under_hand_mark}}@endif"  oninput="volleyballskillTotal({{$applicant->id}})" id="under_hand_mark{{$applicant->id}}" style="
							width: 50px;
							font-weight: 400;
							background: none;
							border: 1px solid #cdcdcd;
							">
							</td>
							<td><input type="number"  class="stop-{{$applicant->id}}" name="upper_hand_mark" @if(isset($trialvolleyball) && $trialvolleyball->upper_hand_mark != '') readonly @endif value="@if(isset($trialvolleyball)){{$trialvolleyball->upper_hand_mark}}@endif" id="upper_hand_mark{{$applicant->id}}"  oninput="volleyballskillTotal({{$applicant->id}})"  style="
							width: 50px;
							font-weight: 400;
							background: none;
							border: 1px solid #cdcdcd;
							">
							</td>
							<td><input type="number"  class="stop-{{$applicant->id}}" name="service_mark" @if(isset($trialvolleyball) && $trialvolleyball->service_mark != '') readonly @endif value="@if(isset($trialvolleyball)){{$trialvolleyball->service_mark}}@endif"  id="service_mark{{$applicant->id}}"  oninput="volleyballskillTotal({{$applicant->id}})"  style="
							width: 50px;
							font-weight: 400;
							background: none;
							border: 1px solid #cdcdcd;
							">
							</td>
							<td><input type="number"  class="stop-{{$applicant->id}}"  name="smash_mark" @if(isset($trialvolleyball) && $trialvolleyball->smash_mark != '') readonly @endif value="@if(isset($trialvolleyball)){{$trialvolleyball->smash_mark}}@endif"  id="smash_mark{{$applicant->id}}"  oninput="volleyballskillTotal({{$applicant->id}})"  style="
							width: 50px;
							font-weight: 400;
							background: none;
							border: 1px solid #cdcdcd;
							">
							</td>
							<td><input type="number"  class="stop-{{$applicant->id}}" name="test_score_mark"   @if(isset($trialvolleyball) && $trialvolleyball->test_score_mark != '') readonly @endif value="@if(isset($trialvolleyball)){{$trialvolleyball->test_score_mark}}@endif"  id="test_score_mark{{$applicant->id}}"    style="
							width: 50px;
							font-weight: 400;
							background: none;
							border: 2px solid #868686;
							">
							</td>
							<td><input type="number"  class="stop-{{$applicant->id}}" name="game_technique"   @if(isset($trialvolleyball) && $trialvolleyball->game_technique != '') readonly @endif   value="@if(isset($trialvolleyball)){{$trialvolleyball->game_technique}}@endif"  oninput="mainTotal({{$applicant->id}})" id="game_technique{{$applicant->id}}" style="
							width: 50px;
							font-weight: 400;
							background: none;
							border: 1px solid #cdcdcd;
							">
							</td>
							<td><input type="number"  class="stop-{{$applicant->id}}"   name="sport_test_mark" @if(isset($trialvolleyball) && $trialvolleyball->sport_test_mark != '') readonly @endif   value="@if(isset($trialvolleyball)){{$trialvolleyball->sport_test_mark}}@endif"  id="sport_test_mark{{$applicant->id}}" style="
							width: 50px;
							font-weight: 400;
							background: none;
							border: 2px solid #868686;
							">
							</td>
							<td><input type="number"  class="stop-{{$applicant->id}}"   name="total_obtain_mark"@if(isset($trialvolleyball) && $trialvolleyball->total_obtain_mark != '') readonly @endif value="@if(isset($trialvolleyball)){{$trialvolleyball->total_obtain_mark}}@endif"  id="total_obtain_mark{{$applicant->id}}" style="
							width: 50px;
							font-weight: 400;
							background: none;
							border: 2px solid #868686;
							">
							</td>
							<td><input type="text"  class="stop-{{$applicant->id}}" name="remark" @if(isset($trialvolleyball) && $trialvolleyball->remark != '') readonly @endif value="@if(isset($trialvolleyball)){{$trialvolleyball->remark}}@endif"  id="remark{{$applicant->id}}" style="
							width: 50px;
							font-weight: 400;
							background: none;
							border: 1px solid #cdcdcd;
							">
																														</td>
							<td><input type="checkbox"  class="stop-{{$applicant->id}}"  id="checkvolleyball{{$applicant->id}}" @if(isset($trialvolleyball) && $trialvolleyball->total_obtain_mark != '') checked disabled @endif   onChange="volleyballData({{$applicant->id}})"  {{$applicant->id}}  style="
							width: 50px;
							font-weight: 400;
							background: none;
							border: 1px solid #cdcdcd;
							">
							</td>
						    </form>


			@elseif ($trialType == 5)


			<form action="{{route('hostelkustitrialList')}}" id="kusti_{{$applicant->id}}" class="needs-validation kustiData"  novalidate method="post">

				@if(isset($applicant->application_no)) <?php $trialkusti = hosteltrialkustiData($applicant->application_no ,4);?>
				@if(isset($trialkusti))

				@endif
				@endif
			<td>
				<input type="hidden" name="application_no" value="{{$applicant->application_no}}">
				<input type="hidden" name="applicant_id" value="{{$applicant->id}}">
				<input type="hidden" name="sport_id" value="{{ data_get($filterData, 'sport_id') }}">
				<input type="hidden" name="trial_type" value="4">
				<input type="number"  class="stop-{{$applicant->id}}" name="ground_position_mark"  @if(isset($trialkusti) && $trialkusti->ground_position_mark != '') readonly @endif  value="@if(isset($trialkusti)){{$trialkusti->ground_position_mark}}@endif"  oninput="kustiskillTotal({{$applicant->id}})" id="ground_position_mark{{$applicant->id}}" style="
			width: 50px;
			font-weight: 400;
			background: none;
			border: 1px solid #cdcdcd;
			">
			</td>
			<td><input type="number"  class="stop-{{$applicant->id}}" name="front_position_back_position_mark" @if(isset($trialkusti) && $trialkusti->front_position_back_position_mark != '') readonly  @endif value="@if(isset($trialkusti)){{$trialkusti->front_position_back_position_mark}}@endif" id="front_position_back_position_mark{{$applicant->id}}"  oninput="kustiskillTotal({{$applicant->id}})"  style="
			width: 50px;
			font-weight: 400;
			background: none;
			border: 1px solid #cdcdcd;
			">
			</td>

			<td><input type="number"  class="stop-{{$applicant->id}}" name="test_score_mark"  @if(isset($trialkusti) && $trialkusti->test_score_mark != '') readonly @endif  value="@if(isset($trialkusti)){{$trialkusti->test_score_mark}}@endif"  id="test_score_mark{{$applicant->id}}"    style="
			width: 50px;
			font-weight: 400;
			background: none;
			border: 2px solid #868686;
			">
			</td>
			<td><input type="number"  class="stop-{{$applicant->id}}" name="game_technique"   @if(isset($trialkusti) && $trialkusti->game_technique != '') readonly   @endif value="@if(isset($trialkusti)){{$trialkusti->game_technique}}@endif"  oninput="mainTotal({{$applicant->id}})" id="game_technique{{$applicant->id}}" style="
			width: 50px;
			font-weight: 400;
			background: none;
			border: 1px solid #cdcdcd;
			">
			</td>
			<td><input type="number"  class="stop-{{$applicant->id}}" readonly  name="sport_test_mark" @if(isset($trialkusti) && $trialkusti->sport_test_mark != '') readonly   @endif value="@if(isset($trialkusti)){{$trialkusti->sport_test_mark}}@endif"  id="sport_test_mark{{$applicant->id}}" style="
			width: 50px;
			font-weight: 400;
			background: none;
			border: 2px solid #868686;
			">
			</td>
			<td><input type="number"  class="stop-{{$applicant->id}}" readonly  name="total_obtain_mark"@if(isset($trialkusti) && $trialkusti->total_obtain_mark != '') readonly @endif value="@if(isset($trialkusti)){{$trialkusti->total_obtain_mark}}@endif"  id="total_obtain_mark{{$applicant->id}}" style="
			width: 50px;
			font-weight: 400;
			background: none;
			border: 2px solid #868686;
			">
			</td>
			<td><input type="text"  class="stop-{{$applicant->id}}" name="remark" @if(isset($trialkusti) && $trialkusti->remark != '') readonly @endif value="@if(isset($trialkusti)){{$trialkusti->remark}}@endif"  id="remark{{$applicant->id}}" style="
			width: 50px;
			font-weight: 400;
			background: none;
			border: 1px solid #cdcdcd;
			">
																										</td>
			<td><input type="checkbox"   class="stop-{{$applicant->id}}" id="checkkusti{{$applicant->id}}" @if(isset($trialkusti) && $trialkusti->total_obtain_mark != '') checked disabled @endif   onChange="kustiData({{$applicant->id}})"  {{$applicant->id}}  style="
			width: 50px;
			font-weight: 400;
			background: none;
			border: 1px solid #cdcdcd;
			">
			</td>
			</form>

			@elseif ($trialType == 6)

			<form action="{{route('hostelswimmingtrialList')}}" id="swimming_{{$applicant->id}}" class="needs-validation swimmingData"  novalidate method="post">

				@if(isset($applicant->application_no)) <?php $trialswimming = hosteltrialswimmingData($applicant->application_no , 4);?>
				@if(isset($trialswimming))

				@endif
				@endif
			<td>
				<input type="hidden" name="application_no" value="{{$applicant->application_no}}">
				<input type="hidden" name="applicant_id" value="{{$applicant->id}}">
				<input type="hidden" name="sport_id" value="{{ data_get($filterData, 'sport_id') }}">
                <input type="hidden" name="trial_type" value="4">
				<input type="number"  class="stop-{{$applicant->id}}" name="free_stroke_mark"  @if(isset($trialswimming) && $trialswimming->free_stroke_mark != '') readonly  @endif value="@if(isset($trialswimming)){{$trialswimming->free_stroke_mark}}@endif"  oninput="swimmingskillTotal({{$applicant->id}})" id="free_stroke_mark{{$applicant->id}}" style="
			width: 50px;
			font-weight: 400;
			background: none;
			border: 1px solid #cdcdcd;
			">
			</td>
			<td><input type="number"  class="stop-{{$applicant->id}}" name="back_stroke_mark" @if(isset($trialswimming) && $trialswimming->back_stroke_mark != '') readonly  @endif value="@if(isset($trialswimming)){{$trialswimming->back_stroke_mark}}@endif" id="back_stroke_mark{{$applicant->id}}"  oninput="swimmingskillTotal({{$applicant->id}})"  style="
			width: 50px;
			font-weight: 400;
			background: none;
			border: 1px solid #cdcdcd;
			">
			</td>
			<td><input type="number"  class="stop-{{$applicant->id}}" name="breast_stroke_mark" @if(isset($trialswimming) && $trialswimming->breast_stroke_mark != '') readonly  @endif value="@if(isset($trialswimming)){{$trialswimming->breast_stroke_mark}}@endif" id="breast_stroke_mark{{$applicant->id}}"  oninput="swimmingskillTotal({{$applicant->id}})"  style="
				width: 50px;
				font-weight: 400;
				background: none;
				border: 1px solid #cdcdcd;
				">
				</td>
            <td><input type="number"  class="stop-{{$applicant->id}}" name="butter_fly_mark" @if(isset($trialswimming) && $trialswimming->butter_fly_mark != '') readonly @endif value="@if(isset($trialswimming)){{$trialswimming->butter_fly_mark}}@endif" id="butter_fly_mark{{$applicant->id}}"  oninput="swimmingskillTotal({{$applicant->id}})"  style="
                width: 50px;
                font-weight: 400;
                background: none;
                border: 1px solid #cdcdcd;
                ">
			</td>
			<td><input type="number"  class="stop-{{$applicant->id}}" name="glaiding_mark" @if(isset($trialswimming) && $trialswimming->glaiding_mark != '') readonly @endif value="@if(isset($trialswimming)){{$trialswimming->glaiding_mark}}@endif"  id="glaiding_mark{{$applicant->id}}"  oninput="swimmingskillTotal({{$applicant->id}})"  style="
                width: 50px;
                font-weight: 400;
                background: none;
                border: 1px solid #cdcdcd;
                ">
			</td>
			<td><input type="number"  class="stop-{{$applicant->id}}"  name="start_mark" @if(isset($trialswimming) && $trialswimming->start_mark != '') readonly @endif value="@if(isset($trialswimming)){{$trialswimming->start_mark}}@endif"  id="start_mark{{$applicant->id}}"  oninput="swimmingskillTotal({{$applicant->id}})"  style="
			width: 50px;
			font-weight: 400;
			background: none;
			border: 1px solid #cdcdcd;
			">
			</td>
			<td><input type="number"  class="stop-{{$applicant->id}}"  name="test_score_mark"  @if(isset($trialswimming) && $trialswimming->test_score_mark != '') readonly @endif value="@if(isset($trialswimming)){{$trialswimming->test_score_mark}}@endif"  id="test_score_mark{{$applicant->id}}"    style="
			width: 50px;
			font-weight: 400;
			background: none;
			border: 2px solid #868686;
			">
			</td>
			<td><input type="number"  class="stop-{{$applicant->id}}" name="game_technique"   @if(isset($trialswimming) && $trialswimming->game_technique != '') readonly @endif   value="@if(isset($trialswimming)){{$trialswimming->game_technique}}@endif"  oninput="mainTotal({{$applicant->id}})" id="game_technique{{$applicant->id}}" style="
			width: 50px;
			font-weight: 400;
			background: none;
			border: 1px solid #cdcdcd;
			">
			</td>
			<td><input type="number"  class="stop-{{$applicant->id}}" readonly  name="sport_test_mark" @if(isset($trialswimming) && $trialswimming->sport_test_mark != '') readonly @endif   value="@if(isset($trialswimming)){{$trialswimming->sport_test_mark}}@endif"  id="sport_test_mark{{$applicant->id}}" style="
			width: 50px;
			font-weight: 400;
			background: none;
			border: 2px solid #868686;
			">
			</td>
			<td><input type="number"  class="stop-{{$applicant->id}}" readonly  name="total_obtain_mark"@if(isset($trialswimming) && $trialswimming->total_obtain_mark != '') readonly @endif value="@if(isset($trialswimming)){{$trialswimming->total_obtain_mark}}@endif"  id="total_obtain_mark{{$applicant->id}}" style="
			width: 50px;
			font-weight: 400;
			background: none;
			border: 2px solid #868686;
			">
			</td>
			<td><input type="text"  class="stop-{{$applicant->id}}" name="remark" @if(isset($trialswimming) && $trialswimming->remark != '') readonly @endif value="@if(isset($trialswimming)){{$trialswimming->remark}}@endif"  id="remark{{$applicant->id}}" style="
			width: 50px;
			font-weight: 400;
			background: none;
			border: 1px solid #cdcdcd;
			">
																										</td>
			<td><input type="checkbox"  class="stop-{{$applicant->id}}"  id="checkswimming{{$applicant->id}}" @if(isset($trialswimming) && $trialswimming->total_obtain_mark != '') checked disabled @endif   onChange="swimmingData({{$applicant->id}})"  {{$applicant->id}}  style="
			width: 50px;
			font-weight: 400;
			background: none;
			border: 1px solid #cdcdcd;
			">
			</td>
			</form>

			@elseif ($trialType == 7)


			<form action="{{route('hostelfootballkeepertrialList')}}" id="footballkeeper_{{$applicant->id}}" class="needs-validation footballkeeperData"  novalidate method="post">

				@if(isset($applicant->application_no)) <?php $trialfootballkeeper = hosteltrialfootballkeeperData($applicant->application_no, 4);?>
				@if(isset($trialfootballkeeper))

				@endif
				@endif
			<td>
				<input type="hidden" name="application_no" value="{{$applicant->application_no}}">
				<input type="hidden" name="applicant_id" value="{{$applicant->id}}">
				<input type="hidden" name="sport_id" value="{{ data_get($filterData, 'sport_id') }}">
                <input type="hidden" name="trial_type" value="4">
				<input type="number"  class="stop-{{$applicant->id}}" name="grip_mark"  @if(isset($trialfootballkeeper) && $trialfootballkeeper->grip_mark != '') readonly  @endif  value="@if(isset($trialfootballkeeper)){{$trialfootballkeeper->grip_mark}}@endif"  oninput="footballkeeperskillTotal({{$applicant->id}})" id="grip_mark{{$applicant->id}}" style="
			width: 50px;
			font-weight: 400;
			background: none;
			border: 1px solid #cdcdcd;
			">
			</td>
			<td><input type="number"  class="stop-{{$applicant->id}}" name="dive_mark" @if(isset($trialfootballkeeper) && $trialfootballkeeper->dive_mark != '') readonly  @endif value="@if(isset($trialfootballkeeper)){{$trialfootballkeeper->dive_mark}}@endif" id="dive_mark{{$applicant->id}}"  oninput="footballkeeperskillTotal({{$applicant->id}})"  style="
			width: 50px;
			font-weight: 400;
			background: none;
			border: 1px solid #cdcdcd;
			">
			</td>
			<td><input type="number"  class="stop-{{$applicant->id}}" name="patch_mark" @if(isset($trialfootballkeeper) && $trialfootballkeeper->patch_mark != '') readonly @endif value="@if(isset($trialfootballkeeper)){{$trialfootballkeeper->patch_mark}}@endif"  id="patch_mark{{$applicant->id}}"  oninput="footballkeeperskillTotal({{$applicant->id}})"  style="
			width: 50px;
			font-weight: 400;
			background: none;
			border: 1px solid #cdcdcd;
			">
			</td>
			<td><input type="number"  class="stop-{{$applicant->id}}"  name="kick_mark" @if(isset($trialfootballkeeper) && $trialfootballkeeper->kick_mark != '') readonly @endif value="@if(isset($trialfootballkeeper)){{$trialfootballkeeper->kick_mark}}@endif"  id="kick_mark{{$applicant->id}}"  oninput="footballkeeperskillTotal({{$applicant->id}})"  style="
			width: 50px;
			font-weight: 400;
			background: none;
			border: 1px solid #cdcdcd;
			">
			</td>
			<td><input type="number"  class="stop-{{$applicant->id}}" name="test_score_mark"   @if(isset($trialfootballkeeper) && $trialfootballkeeper->test_score_mark != '') readonly @endif value="@if(isset($trialfootballkeeper)){{$trialfootballkeeper->test_score_mark}}@endif"  id="test_score_mark{{$applicant->id}}"    style="
			width: 50px;
			font-weight: 400;
			background: none;
			border: 2px solid #868686;
			">
			</td>
			<td><input type="number"  class="stop-{{$applicant->id}}" name="game_technique"   @if(isset($trialfootballkeeper) && $trialfootballkeeper->game_technique != '') readonly   @endif value="@if(isset($trialfootballkeeper)){{$trialfootballkeeper->game_technique}}@endif"  oninput="mainTotal({{$applicant->id}})" id="game_technique{{$applicant->id}}" style="
			width: 50px;
			font-weight: 400;
			background: none;
			border: 1px solid #cdcdcd;
			">
			</td>
			<td><input type="number"  class="stop-{{$applicant->id}}" readonly  name="sport_test_mark" @if(isset($trialfootballkeeper) && $trialfootballkeeper->sport_test_mark != '') readonly   @endif value="@if(isset($trialfootballkeeper)){{$trialfootballkeeper->sport_test_mark}}@endif"  id="sport_test_mark{{$applicant->id}}" style="
			width: 50px;
			font-weight: 400;
			background: none;
			border: 2px solid #868686;
			">
			</td>
			<td><input type="number"  class="stop-{{$applicant->id}}" readonly  name="total_obtain_mark"@if(isset($trialfootballkeeper) && $trialfootballkeeper->total_obtain_mark != '') readonly @endif value="@if(isset($trialfootballkeeper)){{$trialfootballkeeper->total_obtain_mark}}@endif"  id="total_obtain_mark{{$applicant->id}}" style="
			width: 50px;
			font-weight: 400;
			background: none;
			border: 2px solid #868686;
			">
			</td>
			<td><input type="text" name="remark"  class="stop-{{$applicant->id}}" @if(isset($trialfootballkeeper) && $trialfootballkeeper->remark != '') readonly @endif value="@if(isset($trialfootballkeeper)){{$trialfootballkeeper->remark}}@endif"  id="remark{{$applicant->id}}" style="
			width: 50px;
			font-weight: 400;
			background: none;
			border: 1px solid #cdcdcd;
			">
																												</td>
			<td><input type="checkbox"  class="stop-{{$applicant->id}}"  id="checkfootballkeeper{{$applicant->id}}" @if(isset($trialfootballkeeper) && $trialfootballkeeper->total_obtain_mark != '') checked disabled @endif   onChange="footballkeeperData({{$applicant->id}})"  {{$applicant->id}}  style="
			width: 50px;
			font-weight: 400;
			background: none;
			border: 1px solid #cdcdcd;
			">
			</td>
			</form>

					@elseif ($trialType == 8)


			<form action="{{route('hostelfootballtrialList')}}" id="football_{{$applicant->id}}" class="needs-validation footballData"  novalidate method="post">

				@if(isset($applicant->application_no)) <?php $trialfootball = hosteltrialfootballData($applicant->application_no ,4);?>
				@if(isset($trialfootball))

				@endif
				@endif
			<td>
				<input type="hidden" name="application_no" value="{{$applicant->application_no}}">
				<input type="hidden" name="applicant_id" value="{{$applicant->id}}">
				<input type="hidden" name="sport_id" value="{{ data_get($filterData, 'sport_id') }}">
                <input type="hidden" name="trial_type" value="4">
				<input type="number"  class="stop-{{$applicant->id}}" name="kick_mark"  @if(isset($trialfootball) && $trialfootball->kick_mark != '') readonly @endif  value="@if(isset($trialfootball)){{$trialfootball->kick_mark}}@endif"  oninput="footballskillTotal({{$applicant->id}})" id="kick_mark{{$applicant->id}}" style="
			width: 50px;
			font-weight: 400;
			background: none;
			border: 1px solid #cdcdcd;
			">
			</td>
			<td><input type="number"  class="stop-{{$applicant->id}}" name="dribble_tackle_mark" @if(isset($trialfootball) && $trialfootball->dribble_tackle_mark != '') readonly @endif value="@if(isset($trialfootball)){{$trialfootball->dribble_tackle_mark}}@endif" id="dribble_tackle_mark{{$applicant->id}}"  oninput="footballskillTotal({{$applicant->id}})"  style="
			width: 50px;
			font-weight: 400;
			background: none;
			border: 1px solid #cdcdcd;
			">
			</td>
			<td><input type="number"  class="stop-{{$applicant->id}}" name="head_mark" @if(isset($trialfootball) && $trialfootball->head_mark != '') readonly @endif value="@if(isset($trialfootball)){{$trialfootball->head_mark}}@endif"  id="head_mark{{$applicant->id}}"  oninput="footballskillTotal({{$applicant->id}})"  style="
			width: 50px;
			font-weight: 400;
			background: none;
			border: 1px solid #cdcdcd;
			">
			</td>
			<td><input type="number"  class="stop-{{$applicant->id}}"  name="control_pad_mark" @if(isset($trialfootball) && $trialfootball->control_pad_mark != '') readonly @endif value="@if(isset($trialfootball)){{$trialfootball->control_pad_mark}}@endif"  id="control_pad_mark{{$applicant->id}}"  oninput="footballskillTotal({{$applicant->id}})"  style="
			width: 50px;
			font-weight: 400;
			background: none;
			border: 1px solid #cdcdcd;
			">
			</td>
			<td><input type="number"  class="stop-{{$applicant->id}}" name="test_score_mark"  @if(isset($trialfootball) && $trialfootball->test_score_mark != '') readonly @endif value="@if(isset($trialfootball)){{$trialfootball->test_score_mark}}@endif"  id="test_score_mark{{$applicant->id}}"    style="
			width: 50px;
			font-weight: 400;
			background: none;
			border: 2px solid #868686;
			">
			</td>
			<td><input type="number"  class="stop-{{$applicant->id}}" name="game_technique"   @if(isset($trialfootball) && $trialfootball->game_technique != '') readonly   @endif value="@if(isset($trialfootball)){{$trialfootball->game_technique}}@endif"  oninput="mainTotal({{$applicant->id}})" id="game_technique{{$applicant->id}}" style="
			width: 50px;
			font-weight: 400;
			background: none;
			border: 1px solid #cdcdcd;
			">
			</td>
			<td><input type="number"  class="stop-{{$applicant->id}}" readonly  name="sport_test_mark" @if(isset($trialfootball) && $trialfootball->sport_test_mark != '') readonly   @endif value="@if(isset($trialfootball)){{$trialfootball->sport_test_mark}}@endif"  id="sport_test_mark{{$applicant->id}}" style="
			width: 50px;
			font-weight: 400;
			background: none;
			border: 2px solid #868686;
			">
			</td>
			<td><input type="number"  class="stop-{{$applicant->id}}" readonly  name="total_obtain_mark"@if(isset($trialfootball) && $trialfootball->total_obtain_mark != '') readonly @endif value="@if(isset($trialfootball)){{$trialfootball->total_obtain_mark}}@endif"  id="total_obtain_mark{{$applicant->id}}" style="
			width: 50px;
			font-weight: 400;
			background: none;
			border: 2px solid #868686;
			">
			</td>
			<td><input type="text" name="remark"  class="stop-{{$applicant->id}}" @if(isset($trialfootball) && $trialfootball->remark != '') readonly @endif value="@if(isset($trialfootball)){{$trialfootball->remark}}@endif"  id="remark{{$applicant->id}}" style="
			width: 50px;
			font-weight: 400;
			background: none;
			border: 1px solid #cdcdcd;
			">
																										</td>
			<td><input type="checkbox"  class="stop-{{$applicant->id}}"  id="checkfootball{{$applicant->id}}" @if(isset($trialfootball) && $trialfootball->total_obtain_mark != '') checked disabled @endif   onChange="footballData({{$applicant->id}})"  {{$applicant->id}}  style="
			width: 50px;
			font-weight: 400;
			background: none;
			border: 1px solid #cdcdcd;
			">
			</td>
			</form>

					@elseif ($trialType == 9)

					<form action="{{route('hostelathleticsjumpertrialList')}}" id="athleticsjumper_{{$applicant->id}}" class="needs-validation athleticsjumperData"  novalidate method="post">

						@if(isset($applicant->application_no)) <?php $trialathleticsjumper = hosteltrialathleticsjumperData($applicant->application_no , 4);?>
						@if(isset($trialathleticsjumper))

						@endif
						@endif
					<td>
						<input type="hidden" name="application_no" value="{{$applicant->application_no}}">
						<input type="hidden" name="applicant_id" value="{{$applicant->id}}">
						<input type="hidden" name="sport_id" value="{{ data_get($filterData, 'sport_id') }}">
                        <input type="hidden" name="trial_type" value="4">
						<input type="number"  class="stop-{{$applicant->id}}" name="approach_mark"  @if(isset($trialathleticsjumper) && $trialathleticsjumper->approach_mark != '') readonly @endif  value="@if(isset($trialathleticsjumper)){{$trialathleticsjumper->approach_mark}}@endif"  oninput="athleticsjumperskillTotal({{$applicant->id}})" id="approach_mark{{$applicant->id}}" style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 1px solid #cdcdcd;
					">
					</td>
					<td><input type="number"  class="stop-{{$applicant->id}}" name="t_a_mark" @if(isset($trialathleticsjumper) && $trialathleticsjumper->t_a_mark != '') readonly  @endif value="@if(isset($trialathleticsjumper)){{$trialathleticsjumper->t_a_mark}}@endif" id="t_a_mark{{$applicant->id}}"  oninput="athleticsjumperskillTotal({{$applicant->id}})"  style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 1px solid #cdcdcd;
					">
					</td>
					<td><input type="number"  class="stop-{{$applicant->id}}" name="action_mark" @if(isset($trialathleticsjumper) && $trialathleticsjumper->action_mark != '') readonly @endif value="@if(isset($trialathleticsjumper)){{$trialathleticsjumper->action_mark}}@endif"  id="action_mark{{$applicant->id}}"  oninput="athleticsjumperskillTotal({{$applicant->id}})"  style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 1px solid #cdcdcd;
					">
					</td>
					<td><input type="number"  class="stop-{{$applicant->id}}"  name="landing_mark" @if(isset($trialathleticsjumper) && $trialathleticsjumper->landing_mark != '') readonly @endif value="@if(isset($trialathleticsjumper)){{$trialathleticsjumper->landing_mark}}@endif"  id="landing_mark{{$applicant->id}}"  oninput="athleticsjumperskillTotal({{$applicant->id}})"  style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 1px solid #cdcdcd;
					">
					</td>
					<td><input type="number"  class="stop-{{$applicant->id}}" name="test_score_mark"  @if(isset($trialathleticsjumper) && $trialathleticsjumper->test_score_mark != '') readonly @endif value="@if(isset($trialathleticsjumper)){{$trialathleticsjumper->test_score_mark}}@endif"  id="test_score_mark{{$applicant->id}}"    style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 2px solid #868686;
					">
					</td>
					<td><input type="number"  class="stop-{{$applicant->id}}" name="game_technique"   @if(isset($trialathleticsjumper) && $trialathleticsjumper->game_technique != '') readonly   @endif value="@if(isset($trialathleticsjumper)){{$trialathleticsjumper->game_technique}}@endif"  oninput="mainTotal({{$applicant->id}})" id="game_technique{{$applicant->id}}" style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 1px solid #cdcdcd;
					">
					</td>
					<td><input type="number"  class="stop-{{$applicant->id}}" readonly  name="sport_test_mark" @if(isset($trialathleticsjumper) && $trialathleticsjumper->sport_test_mark != '') readonly   @endif value="@if(isset($trialathleticsjumper)){{$trialathleticsjumper->sport_test_mark}}@endif"  id="sport_test_mark{{$applicant->id}}" style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 2px solid #868686;
					">
					</td>
					<td><input type="number"  class="stop-{{$applicant->id}}" readonly  name="total_obtain_mark"@if(isset($trialathleticsjumper) && $trialathleticsjumper->total_obtain_mark != '') readonly @endif value="@if(isset($trialathleticsjumper)){{$trialathleticsjumper->total_obtain_mark}}@endif"  id="total_obtain_mark{{$applicant->id}}" style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 2px solid #868686;
					">
					</td>
					<td><input type="text" name="remark"  class="stop-{{$applicant->id}}" @if(isset($trialathleticsjumper) && $trialathleticsjumper->remark != '') readonly @endif value="@if(isset($trialathleticsjumper)){{$trialathleticsjumper->remark}}@endif"  id="remark{{$applicant->id}}" style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 1px solid #cdcdcd;
					">
																														</td>
					<td><input type="checkbox"   class="stop-{{$applicant->id}}" id="checkathleticsjumper{{$applicant->id}}" @if(isset($trialathleticsjumper) && $trialathleticsjumper->total_obtain_mark != '') checked disabled @endif   onChange="athleticsjumperData({{$applicant->id}})"  {{$applicant->id}}  style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 1px solid #cdcdcd;
					">
					</td>
					</form>
				@elseif ($trialType == 10)

				<form action="{{route('hostelcricketbatsmantrialList')}}" id="cricketbatsman_{{$applicant->id}}" class="needs-validation cricketbatsmanData"  novalidate method="post">

					@if(isset($applicant->application_no)) <?php $trialcricketbatsman = hosteltrialcricketbatsmanData($applicant->application_no, 4);?>
					@if(isset($trialcricketbatsman))

					@endif
					@endif
				<td>
					<input type="hidden" name="application_no" value="{{$applicant->application_no}}">
					<input type="hidden" name="applicant_id" value="{{$applicant->id}}">
					<input type="hidden" name="sport_id" value="{{ data_get($filterData, 'sport_id') }}">
                    <input type="hidden" name="trial_type" value="4">
					<input type="number"  class="stop-{{$applicant->id}}" name="grip_stance_backlift_mark"  @if(isset($trialcricketbatsman) && $trialcricketbatsman->grip_stance_backlift_mark != '') readonly @endif  value="@if(isset($trialcricketbatsman)){{$trialcricketbatsman->grip_stance_backlift_mark}}@endif"  oninput="cricketbatsmanskillTotal({{$applicant->id}})" id="grip_stance_backlift_mark{{$applicant->id}}" style="
				width: 50px;
				font-weight: 400;
				background: none;
				border: 1px solid #cdcdcd;
				">
				</td>
				<td><input type="number"  class="stop-{{$applicant->id}}" name="ball_select_mark" @if(isset($trialcricketbatsman) && $trialcricketbatsman->ball_select_mark != '') readonly @endif  value="@if(isset($trialcricketbatsman)){{$trialcricketbatsman->ball_select_mark}}@endif" id="ball_select_mark{{$applicant->id}}"  oninput="cricketbatsmanskillTotal({{$applicant->id}})"  style="
				width: 50px;
				font-weight: 400;
				background: none;
				border: 1px solid #cdcdcd;
				">
				</td>
				<td><input type="number"  class="stop-{{$applicant->id}}" name="front_foot_back_foot_mark" @if(isset($trialcricketbatsman) && $trialcricketbatsman->front_foot_back_foot_mark != '') readonly @endif value="@if(isset($trialcricketbatsman)){{$trialcricketbatsman->front_foot_back_foot_mark}}@endif"  id="front_foot_back_foot_mark{{$applicant->id}}"  oninput="cricketbatsmanskillTotal({{$applicant->id}})"  style="
				width: 50px;
				font-weight: 400;
				background: none;
				border: 1px solid #cdcdcd;
				">
				</td>
				<td><input type="number"  class="stop-{{$applicant->id}}"  name="front_foot_back_foot_drive_mark" @if(isset($trialcricketbatsman) && $trialcricketbatsman->front_foot_back_foot_drive_mark != '') readonly @endif value="@if(isset($trialcricketbatsman)){{$trialcricketbatsman->front_foot_back_foot_drive_mark}}@endif"  id="front_foot_back_foot_drive_mark{{$applicant->id}}"  oninput="cricketbatsmanskillTotal({{$applicant->id}})"  style="
				width: 50px;
				font-weight: 400;
				background: none;
				border: 1px solid #cdcdcd;
				">
				</td>
				<td><input type="number"  class="stop-{{$applicant->id}}" name="test_score_mark"  readonly  @if(isset($trialcricketbatsman) && $trialcricketbatsman->test_score_mark != '') readonly @endif value="@if(isset($trialcricketbatsman)){{$trialcricketbatsman->test_score_mark}}@endif"  id="test_score_mark{{$applicant->id}}"    style="
				width: 50px;
				font-weight: 400;
				background: none;
				border: 2px solid #868686;
				">
				</td>
				<td><input type="number"  class="stop-{{$applicant->id}}" name="game_technique"   @if(isset($trialcricketbatsman) && $trialcricketbatsman->game_technique != '') readonly   @endif value="@if(isset($trialcricketbatsman)){{$trialcricketbatsman->game_technique}}@endif"  oninput="mainTotal({{$applicant->id}})" id="game_technique{{$applicant->id}}" style="
				width: 50px;
				font-weight: 400;
				background: none;
				border: 1px solid #cdcdcd;
				">
				</td>
				<td><input type="number"  class="stop-{{$applicant->id}}" readonly  name="sport_test_mark" @if(isset($trialcricketbatsman) && $trialcricketbatsman->sport_test_mark != '') readonly   @endif value="@if(isset($trialcricketbatsman)){{$trialcricketbatsman->sport_test_mark}}@endif"  id="sport_test_mark{{$applicant->id}}" style="
				width: 50px;
				font-weight: 400;
				background: none;
				border: 2px solid #868686;
				">
				</td>
				<td><input type="number"  class="stop-{{$applicant->id}}" readonly  name="total_obtain_mark"@if(isset($trialcricketbatsman) && $trialcricketbatsman->total_obtain_mark != '') readonly @endif value="@if(isset($trialcricketbatsman)){{$trialcricketbatsman->total_obtain_mark}}@endif"  id="total_obtain_mark{{$applicant->id}}" style="
				width: 50px;
				font-weight: 400;
				background: none;
				border: 2px solid #868686;
				">
				</td>
				<td><input type="text"  class="stop-{{$applicant->id}}" name="remark" @if(isset($trialcricketbatsman) && $trialcricketbatsman->remark != '') readonly @endif value="@if(isset($trialcricketbatsman)){{$trialcricketbatsman->remark}}@endif"  id="remark{{$applicant->id}}" style="
				width: 50px;
				font-weight: 400;
				background: none;
				border: 1px solid #cdcdcd;
				">
				</td>
				<td><input type="checkbox"  class="stop-{{$applicant->id}}"  id="checkcricketbatsman{{$applicant->id}}" @if(isset($trialcricketbatsman) && $trialcricketbatsman->total_obtain_mark != '') checked disabled @endif   onChange="cricketbatsmanData({{$applicant->id}})"  {{$applicant->id}}  style="
				width: 50px;
				font-weight: 400;
				background: none;
				border: 1px solid #cdcdcd;
				">
				</td>
				</form>
			@elseif ($trialType == 11)

			<form action="{{route('hostelcricketballertrialList')}}" id="cricketballer_{{$applicant->id}}" class="needs-validation cricketballerData"  novalidate method="post">

				@if(isset($applicant->application_no)) <?php $trialcricketballer = hosteltrialcricketballerData($applicant->application_no ,4);?>
				@if(isset($trialcricketballer))

				@endif
				@endif
			<td>
				<input type="hidden" name="application_no" value="{{$applicant->application_no}}">
				<input type="hidden" name="applicant_id" value="{{$applicant->id}}">
				<input type="hidden" name="sport_id" value="{{ data_get($filterData, 'sport_id') }}">
                <input type="hidden" name="trial_type" value="4">
				<input type="number"  class="stop-{{$applicant->id}}" name="runup_action_followthrough_mark"  @if(isset($trialcricketballer) && $trialcricketballer->runup_action_followthrough_mark != '') readonly @endif  value="@if(isset($trialcricketballer)){{$trialcricketballer->runup_action_followthrough_mark}}@endif"  oninput="cricketballerskillTotal({{$applicant->id}})" id="runup_action_followthrough_mark{{$applicant->id}}" style="
			width: 50px;
			font-weight: 400;
			background: none;
			border: 1px solid #cdcdcd;
			">
			</td>
			<td><input type="number"  class="stop-{{$applicant->id}}" name="swing_spin_mark" @if(isset($trialcricketballer) && $trialcricketballer->swing_spin_mark != '') readonly  @endif value="@if(isset($trialcricketballer)){{$trialcricketballer->swing_spin_mark}}@endif" id="swing_spin_mark{{$applicant->id}}"  oninput="cricketballerskillTotal({{$applicant->id}})"  style="
			width: 50px;
			font-weight: 400;
			background: none;
			border: 1px solid #cdcdcd;
			">
			</td>
			<td><input type="number"  class="stop-{{$applicant->id}}" name="line_length_mark" @if(isset($trialcricketballer) && $trialcricketballer->line_length_mark != '') readonly @endif value="@if(isset($trialcricketballer)){{$trialcricketballer->line_length_mark}}@endif"  id="line_length_mark{{$applicant->id}}"  oninput="cricketballerskillTotal({{$applicant->id}})"  style="
			width: 50px;
			font-weight: 400;
			background: none;
			border: 1px solid #cdcdcd;
			">
			</td>
			<td><input type="number"  class="stop-{{$applicant->id}}"  name="speed_flight_mark" @if(isset($trialcricketballer) && $trialcricketballer->speed_flight_mark != '') readonly @endif value="@if(isset($trialcricketballer)){{$trialcricketballer->speed_flight_mark}}@endif"  id="speed_flight_mark{{$applicant->id}}"  oninput="cricketballerskillTotal({{$applicant->id}})"  style="
			width: 50px;
			font-weight: 400;
			background: none;
			border: 1px solid #cdcdcd;
			">
			</td>
			<td><input type="number"  class="stop-{{$applicant->id}}" name="test_score_mark"  @if(isset($trialcricketballer) && $trialcricketballer->test_score_mark != '') readonly @endif value="@if(isset($trialcricketballer)){{$trialcricketballer->test_score_mark}}@endif"  id="test_score_mark{{$applicant->id}}"    style="
			width: 50px;
			font-weight: 400;
			background: none;
			border: 2px solid #868686;
			">
			</td>
			<td><input type="number"  class="stop-{{$applicant->id}}" name="game_technique"   @if(isset($trialcricketballer) && $trialcricketballer->game_technique != '') readonly   @endif value="@if(isset($trialcricketballer)){{$trialcricketballer->game_technique}}@endif"  oninput="mainTotal({{$applicant->id}})" id="game_technique{{$applicant->id}}" style="
			width: 50px;
			font-weight: 400;
			background: none;
			border: 1px solid #cdcdcd;
			">
			</td>
			<td><input type="number"  class="stop-{{$applicant->id}}" readonly  name="sport_test_mark" @if(isset($trialcricketballer) && $trialcricketballer->sport_test_mark != '') readonly   @endif value="@if(isset($trialcricketballer)){{$trialcricketballer->sport_test_mark}}@endif"  id="sport_test_mark{{$applicant->id}}" style="
			width: 50px;
			font-weight: 400;
			background: none;
			border: 2px solid #868686;
			">
			</td>
			<td><input type="number"  class="stop-{{$applicant->id}}" readonly  name="total_obtain_mark"@if(isset($trialcricketballer) && $trialcricketballer->total_obtain_mark != '') readonly @endif value="@if(isset($trialcricketballer)){{$trialcricketballer->total_obtain_mark}}@endif"  id="total_obtain_mark{{$applicant->id}}" style="
			width: 50px;
			font-weight: 400;
			background: none;
			border: 2px solid #868686;
			">
			</td>
			<td><input type="text"  class="stop-{{$applicant->id}}" name="remark" @if(isset($trialcricketballer) && $trialcricketballer->remark != '') readonly @endif value="@if(isset($trialcricketballer)){{$trialcricketballer->remark}}@endif"  id="remark{{$applicant->id}}" style="
			width: 50px;
			font-weight: 400;
			background: none;
			border: 1px solid #cdcdcd;
			">
			</td>
			<td><input type="checkbox"  class="stop-{{$applicant->id}}" id="checkcricketballer{{$applicant->id}}" @if(isset($trialcricketballer) && $trialcricketballer->total_obtain_mark != '') checked disabled @endif   onChange="cricketballerData({{$applicant->id}})"  {{$applicant->id}}  style="
			width: 50px;
			font-weight: 400;
			background: none;
			border: 1px solid #cdcdcd;
			">
			</td>
			</form>
			@elseif ($trialType == 12)
			<form action="{{route('hostelcricketkeepertrialList')}}" id="cricketkeeper_{{$applicant->id}}" class="needs-validation cricketkeeperData"  novalidate method="post">

				@if(isset($applicant->application_no)) <?php $trialcricketkeeper = hosteltrialcricketkeeperData($applicant->application_no , 4);?>
				@if(isset($trialcricketkeeper))

				@endif
				@endif
			<td>
				<input type="hidden" name="application_no" value="{{$applicant->application_no}}">
				<input type="hidden" name="applicant_id" value="{{$applicant->id}}">
				<input type="hidden" name="sport_id" value="{{ data_get($filterData, 'sport_id') }}">
                <input type="hidden" name="trial_type" value="4">
				<input type="number"  class="stop-{{$applicant->id}}" name="stumping_mark"  @if(isset($trialcricketkeeper) && $trialcricketkeeper->stumping_mark != '') readonly  @endif  value="@if(isset($trialcricketkeeper)){{$trialcricketkeeper->stumping_mark}}@endif"  oninput="cricketkeeperskillTotal({{$applicant->id}})" id="stumping_mark{{$applicant->id}}" style="
			width: 50px;
			font-weight: 400;
			background: none;
			border: 1px solid #cdcdcd;
			">
			</td>
			<td><input type="number"  class="stop-{{$applicant->id}}" name="gathering_mark" @if(isset($trialcricketkeeper) && $trialcricketkeeper->gathering_mark != '') readonly  @endif value="@if(isset($trialcricketkeeper)){{$trialcricketkeeper->gathering_mark}}@endif" id="gathering_mark{{$applicant->id}}"  oninput="cricketkeeperskillTotal({{$applicant->id}})"  style="
			width: 50px;
			font-weight: 400;
			background: none;
			border: 1px solid #cdcdcd;
			">
			</td>
			<td><input type="number"  class="stop-{{$applicant->id}}" name="off_stumping_gathering_mark" @if(isset($trialcricketkeeper) && $trialcricketkeeper->off_stumping_gathering_mark != '') readonly @endif value="@if(isset($trialcricketkeeper)){{$trialcricketkeeper->off_stumping_gathering_mark}}@endif"  id="off_stumping_gathering_mark{{$applicant->id}}"  oninput="cricketkeeperskillTotal({{$applicant->id}})"  style="
			width: 50px;
			font-weight: 400;
			background: none;
			border: 1px solid #cdcdcd;
			">
			</td>
			<td><input type="number"  class="stop-{{$applicant->id}}"  name="on_stumping_gathering_mark" @if(isset($trialcricketkeeper) && $trialcricketkeeper->on_stumping_gathering_mark != '') readonly @endif value="@if(isset($trialcricketkeeper)){{$trialcricketkeeper->on_stumping_gathering_mark}}@endif"  id="on_stumping_gathering_mark{{$applicant->id}}"  oninput="cricketkeeperskillTotal({{$applicant->id}})"  style="
			width: 50px;
			font-weight: 400;
			background: none;
			border: 1px solid #cdcdcd;
			">
			</td>
			<td><input type="number"  class="stop-{{$applicant->id}}" name="test_score_mark"  readonly  @if(isset($trialcricketkeeper) && $trialcricketkeeper->test_score_mark != '') readonly @endif value="@if(isset($trialcricketkeeper)){{$trialcricketkeeper->test_score_mark}}@endif"  id="test_score_mark{{$applicant->id}}"    style="
			width: 50px;
			font-weight: 400;
			background: none;
			border: 2px solid #868686;
			">
			</td>
			<td><input type="number"  class="stop-{{$applicant->id}}" name="game_technique"   @if(isset($trialcricketkeeper) && $trialcricketkeeper->game_technique != '') readonly   @endif value="@if(isset($trialcricketkeeper)){{$trialcricketkeeper->game_technique}}@endif"  oninput="mainTotal({{$applicant->id}})" id="game_technique{{$applicant->id}}" style="
			width: 50px;
			font-weight: 400;
			background: none;
			border: 1px solid #cdcdcd;
			">
			</td>
			<td><input type="number"  class="stop-{{$applicant->id}}" readonly  name="sport_test_mark" @if(isset($trialcricketkeeper) && $trialcricketkeeper->sport_test_mark != '') readonly   @endif value="@if(isset($trialcricketkeeper)){{$trialcricketkeeper->sport_test_mark}}@endif"  id="sport_test_mark{{$applicant->id}}" style="
			width: 50px;
			font-weight: 400;
			background: none;
			border: 2px solid #868686;
			">
			</td>
			<td><input type="number"  class="stop-{{$applicant->id}}" readonly  name="total_obtain_mark"@if(isset($trialcricketkeeper) && $trialcricketkeeper->total_obtain_mark != '') readonly @endif value="@if(isset($trialcricketkeeper)){{$trialcricketkeeper->total_obtain_mark}}@endif"  id="total_obtain_mark{{$applicant->id}}" style="
			width: 50px;
			font-weight: 400;
			background: none;
			border: 2px solid #868686;
			">
			</td>
			<td><input type="text"  class="stop-{{$applicant->id}}" name="remark" @if(isset($trialcricketkeeper) && $trialcricketkeeper->remark != '') readonly @endif value="@if(isset($trialcricketkeeper)){{$trialcricketkeeper->remark}}@endif"  id="remark{{$applicant->id}}" style="
			width: 50px;
			font-weight: 400;
			background: none;
			border: 1px solid #cdcdcd;
			">
			</td>
			<td><input type="checkbox"  class="stop-{{$applicant->id}}" id="checkcricketkeeper{{$applicant->id}}" @if(isset($trialcricketkeeper) && $trialcricketkeeper->total_obtain_mark != '') checked disabled @endif   onChange="cricketkeeperData({{$applicant->id}})"  {{$applicant->id}}  style="
			width: 50px;
			font-weight: 400;
			background: none;
			border: 1px solid #cdcdcd;
			">
			</td>
			<td><input type="checkbox"  class="stop-{{$applicant->id}}"  id="checkcricketkeeper{{$applicant->id}}" @if(isset($trialcricketkeeper)) checked disabled @endif   onChange="cricketkeeperData({{$applicant->id}})"  {{$applicant->id}}  style="
			width: 50px;
			font-weight: 400;
			background: none;
			border: 1px solid #cdcdcd;
			">
			</td>
			</form>

			@elseif ($trialType == 13)

			<form action="{{route('hostelkabadditrialList')}}" id="kabaddi_{{$applicant->id}}" class="needs-validation kabaddiData"  novalidate method="post">

				@if(isset($applicant->application_no)) <?php $trialkabaddi = hosteltrialkabaddiData($applicant->application_no, 4);?>
				@if(isset($trialkabaddi))

				@endif
				@endif
			<td>
				<input type="hidden" name="application_no" value="{{$applicant->application_no}}">
				<input type="hidden" name="applicant_id" value="{{$applicant->id}}">
				<input type="hidden" name="sport_id" value="{{ data_get($filterData, 'sport_id') }}">
                <input type="hidden" name="trial_type" value="4">
				<input type="number"  class="stop-{{$applicant->id}}" name="raid_mark"  @if(isset($trialkabaddi) && $trialkabaddi->raid_mark != '') readonly @endif  value="@if(isset($trialkabaddi)){{$trialkabaddi->raid_mark}}@endif"  oninput="kabaddiskillTotal({{$applicant->id}})" id="raid_mark{{$applicant->id}}" style="
			width: 50px;
			font-weight: 400;
			background: none;
			border: 1px solid #cdcdcd;
			">
			</td>
			<td><input type="number"  class="stop-{{$applicant->id}}" name="kick_skill_mark" @if(isset($trialkabaddi) && $trialkabaddi->kick_skill_mark != '') readonly @endif value="@if(isset($trialkabaddi)){{$trialkabaddi->kick_skill_mark}}@endif" id="kick_skill_mark{{$applicant->id}}"  oninput="kabaddiskillTotal({{$applicant->id}})"  style="
			width: 50px;
			font-weight: 400;
			background: none;
			border: 1px solid #cdcdcd;
			">
			</td>
			<td><input type="number"  class="stop-{{$applicant->id}}" name="covering_mark" @if(isset($trialkabaddi) && $trialkabaddi->covering_mark != '') readonly @endif value="@if(isset($trialkabaddi)){{$trialkabaddi->covering_mark}}@endif"  id="covering_mark{{$applicant->id}}"  oninput="kabaddiskillTotal({{$applicant->id}})"  style="
			width: 50px;
			font-weight: 400;
			background: none;
			border: 1px solid #cdcdcd;
			">
			</td>
			<td><input type="number"  class="stop-{{$applicant->id}}"  name="pakad_mark" @if(isset($trialkabaddi) && $trialkabaddi->pakad_mark != '') readonly @endif value="@if(isset($trialkabaddi)){{$trialkabaddi->pakad_mark}}@endif"  id="pakad_mark{{$applicant->id}}"  oninput="kabaddiskillTotal({{$applicant->id}})"  style="
			width: 50px;
			font-weight: 400;
			background: none;
			border: 1px solid #cdcdcd;
			">
			</td>
			<td><input type="number"  class="stop-{{$applicant->id}}" name="test_score_mark"  @if(isset($trialkabaddi) && $trialkabaddi->test_score_mark != '') readonly @endif value="@if(isset($trialkabaddi)){{$trialkabaddi->test_score_mark}}@endif"  id="test_score_mark{{$applicant->id}}"    style="
			width: 50px;
			font-weight: 400;
			background: none;
			border: 2px solid #868686;
			">
			</td>
			<td><input type="number"  class="stop-{{$applicant->id}}" name="game_technique"   @if(isset($trialkabaddi) && $trialkabaddi->game_technique != '') readonly @endif   value="@if(isset($trialkabaddi)){{$trialkabaddi->game_technique}}@endif"  oninput="mainTotal({{$applicant->id}})" id="game_technique{{$applicant->id}}" style="
			width: 50px;
			font-weight: 400;
			background: none;
			border: 1px solid #cdcdcd;
			">
			</td>
			<td><input type="number"  class="stop-{{$applicant->id}}" readonly  name="sport_test_mark" @if(isset($trialkabaddi) && $trialkabaddi->sport_test_mark != '') readonly   @endif value="@if(isset($trialkabaddi)){{$trialkabaddi->sport_test_mark}}@endif"  id="sport_test_mark{{$applicant->id}}" style="
			width: 50px;
			font-weight: 400;
			background: none;
			border: 2px solid #868686;
			">
			</td>
			<td><input type="number"  class="stop-{{$applicant->id}}" readonly  name="total_obtain_mark"@if(isset($trialkabaddi) && $trialkabaddi->total_obtain_mark != '') readonly @endif value="@if(isset($trialkabaddi)){{$trialkabaddi->total_obtain_mark}}@endif"  id="total_obtain_mark{{$applicant->id}}" style="
			width: 50px;
			font-weight: 400;
			background: none;
			border: 2px solid #868686;
			">
			</td>
			<td><input type="text"  class="stop-{{$applicant->id}}" name="remark" @if(isset($trialkabaddi) && $trialkabaddi->remark != '') readonly @endif value="@if(isset($trialkabaddi)){{$trialkabaddi->remark}}@endif"  id="remark{{$applicant->id}}" style="
			width: 50px;
			font-weight: 400;
			background: none;
			border: 1px solid #cdcdcd;
			">
																										</td>
			<td><input type="checkbox"  class="stop-{{$applicant->id}}" id="checkkabaddi{{$applicant->id}}" @if(isset($trialkabaddi) && $trialkabaddi->total_obtain_mark != '') checked disabled @endif   onChange="kabaddiData({{$applicant->id}})"  {{$applicant->id}}  style="
			width: 50px;
			font-weight: 400;
			background: none;
			border: 1px solid #cdcdcd;
			">
			</td>
			</form>

		@elseif ($trialType == 14)

        <form action="{{route('hosteljudotrialList')}}" id="judo_{{$applicant->id}}" class="needs-validation judoData"  novalidate method="post">

            @if(isset($applicant->application_no)) <?php $trialjudo = hosteltrialjudoData($applicant->application_no, 4);?>
            @if(isset($trialjudo))

            @endif
            @endif
        <td>
            <input type="hidden" name="application_no" value="{{$applicant->application_no}}">
            <input type="hidden" name="applicant_id" value="{{$applicant->id}}">
            <input type="hidden" name="sport_id" value="{{ data_get($filterData, 'sport_id') }}">
            <input type="hidden" name="trial_type" value="4">
            <input type="number"  class="stop-{{$applicant->id}}" name="standing_work_throw_mark"  @if(isset($trialjudo) && $trialjudo->standing_work_throw_mark != '') readonly @endif  value="@if(isset($trialjudo)){{$trialjudo->standing_work_throw_mark}}@endif"  oninput="judoskillTotal({{$applicant->id}})" id="standing_work_throw_mark{{$applicant->id}}" style="
        width: 50px;
        font-weight: 400;
        background: none;
        border: 1px solid #cdcdcd;
        ">
        </td>
        <td><input type="number"  class="stop-{{$applicant->id}}" name="hip_leg_hand_techniquec_mark" @if(isset($trialjudo) && $trialjudo->hip_leg_hand_techniquec_mark != '') readonly @endif value="@if(isset($trialjudo)){{$trialjudo->hip_leg_hand_techniquec_mark}}@endif" id="hip_leg_hand_techniquec_mark{{$applicant->id}}"  oninput="judoskillTotal({{$applicant->id}})"  style="
        width: 50px;
        font-weight: 400;
        background: none;
        border: 1px solid #cdcdcd;
        ">
        </td>
        <td><input type="number"  class="stop-{{$applicant->id}}" name="throw_count_mark" @if(isset($trialjudo) && $trialjudo->throw_count_mark != '') readonly @endif value="@if(isset($trialjudo)){{$trialjudo->throw_count_mark}}@endif"  id="throw_count_mark{{$applicant->id}}"  oninput="judoskillTotal({{$applicant->id}})"  style="
            width: 50px;
            font-weight: 400;
            background: none;
            border: 1px solid #cdcdcd;
            ">
        </td>
        <td><input type="number"  class="stop-{{$applicant->id}}"  name="throw_combination_mark" @if(isset($trialjudo) && $trialjudo->throw_combination_mark != '') readonly @endif value="@if(isset($trialjudo)){{$trialjudo->throw_combination_mark}}@endif"  id="throw_combination_mark{{$applicant->id}}"  oninput="judoskillTotal({{$applicant->id}})"  style="
        width: 50px;
        font-weight: 400;
        background: none;
        border: 1px solid #cdcdcd;
        ">
        </td>
        <td><input type="number"  class="stop-{{$applicant->id}}" name="test_score_mark"  @if(isset($trialjudo) && $trialjudo->test_score_mark != '') readonly @endif value="@if(isset($trialjudo)){{$trialjudo->test_score_mark}}@endif"  id="test_score_mark{{$applicant->id}}"    style="
        width: 50px;
        font-weight: 400;
        background: none;
        border: 2px solid #868686;
        ">
        </td>
        <td><input type="number"  class="stop-{{$applicant->id}}" name="game_technique"   @if(isset($trialjudo) && $trialjudo->game_technique != '') readonly @endif   value="@if(isset($trialjudo)){{$trialjudo->game_technique}}@endif"  oninput="mainTotal({{$applicant->id}})" id="game_technique{{$applicant->id}}" style="
        width: 50px;
        font-weight: 400;
        background: none;
        border: 1px solid #cdcdcd;
        ">
        </td>
        <td><input type="number"  class="stop-{{$applicant->id}}" readonly  name="sport_test_mark" @if(isset($trialjudo) && $trialjudo->sport_test_mark != '') readonly   @endif value="@if(isset($trialjudo)){{$trialjudo->sport_test_mark}}@endif"  id="sport_test_mark{{$applicant->id}}" style="
        width: 50px;
        font-weight: 400;
        background: none;
        border: 2px solid #868686;
        ">
        </td>
        <td><input type="number"  class="stop-{{$applicant->id}}" readonly  name="total_obtain_mark"@if(isset($trialjudo) && $trialjudo->total_obtain_mark != '') readonly @endif value="@if(isset($trialjudo)){{$trialjudo->total_obtain_mark}}@endif"  id="total_obtain_mark{{$applicant->id}}" style="
        width: 50px;
        font-weight: 400;
        background: none;
        border: 2px solid #868686;
        ">
        </td>
        <td><input type="text"  class="stop-{{$applicant->id}}" name="remark" @if(isset($trialjudo) && $trialjudo->remark != '') readonly @endif value="@if(isset($trialjudo)){{$trialjudo->remark}}@endif"  id="remark{{$applicant->id}}" style="
        width: 50px;
        font-weight: 400;
        background: none;
        border: 1px solid #cdcdcd;
        ">
                                                                                                    </td>
        <td><input type="checkbox"  class="stop-{{$applicant->id}}" id="checkjudo{{$applicant->id}}" @if(isset($trialjudo) && $trialjudo->total_obtain_mark != '') checked disabled @endif   onChange="judoData({{$applicant->id}})"  {{$applicant->id}}  style="
        width: 50px;
        font-weight: 400;
        background: none;
        border: 1px solid #cdcdcd;
        ">
        </td>
        </form>



					@elseif ($trialType == 15)
					<form action="{{route('hostelathleticsrunnertrialList')}}" id="athleticsrunner_{{$applicant->id}}" class="needs-validation athleticsrunnerData"  novalidate method="post">

						@if(isset($applicant->application_no)) <?php $trialathleticsrunner = hosteltrialathleticsrunnerData($applicant->application_no, 4);?>
						@if(isset($trialathleticsrunner))

						@endif
						@endif
					<td>
						<input type="hidden" name="application_no" value="{{$applicant->application_no}}">
						<input type="hidden" name="applicant_id" value="{{$applicant->id}}">
						<input type="hidden" name="sport_id" value="{{ data_get($filterData, 'sport_id') }}">
                        <input type="hidden" name="trial_type" value="4">
						<input type="number"  class="stop-{{$applicant->id}}" name="stance_mark"  @if(isset($trialathleticsrunner) && $trialathleticsrunner->stance_mark != '') readonly @endif  value="@if(isset($trialathleticsrunner)){{$trialathleticsrunner->stance_mark}}@endif"  oninput="athleticsrunnerskillTotal({{$applicant->id}})" id="runner_stance_mark{{$applicant->id}}" style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 1px solid #cdcdcd;
					">
					</td>
					<td><input type="number"  class="stop-{{$applicant->id}}" name="start_mark" @if(isset($trialathleticsrunner) && $trialathleticsrunner->start_mark != '') readonly @endif  value="@if(isset($trialathleticsrunner)){{$trialathleticsrunner->start_mark}}@endif" id="runner_start_mark{{$applicant->id}}"  oninput="athleticsrunnerskillTotal({{$applicant->id}})"  style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 1px solid #cdcdcd;
					">
					</td>
					<td><input type="number"  class="stop-{{$applicant->id}}" name="action_mark" @if(isset($trialathleticsrunner) && $trialathleticsrunner->action_mark != '') readonly @endif value="@if(isset($trialathleticsrunner)){{$trialathleticsrunner->action_mark}}@endif"  id="runner_action_mark{{$applicant->id}}"  oninput="athleticsrunnerskillTotal({{$applicant->id}})"  style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 1px solid #cdcdcd;
					">
					</td>
					<td><input type="number"  class="stop-{{$applicant->id}}"  name="finish_mark" @if(isset($trialathleticsrunner) && $trialathleticsrunner->finish_mark != '') readonly @endif value="@if(isset($trialathleticsrunner)){{$trialathleticsrunner->finish_mark}}@endif"  id="runner_finish_mark{{$applicant->id}}"  oninput="athleticsrunnerskillTotal({{$applicant->id}})"  style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 1px solid #cdcdcd;
					">
					</td>
					<td><input type="number"  class="stop-{{$applicant->id}}" name="test_score_mark"   @if(isset($trialathleticsrunner) && $trialathleticsrunner->test_score_mark != '') readonly @endif value="@if(isset($trialathleticsrunner)){{$trialathleticsrunner->test_score_mark}}@endif"  id="test_score_mark{{$applicant->id}}"    style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 2px solid #868686;
					">
					</td>
					<td><input type="number"  class="stop-{{$applicant->id}}" name="game_technique"   @if(isset($trialathleticsrunner) && $trialathleticsrunner->game_technique != '') readonly @endif   value="@if(isset($trialathleticsrunner)){{$trialathleticsrunner->game_technique}}@endif"  oninput="mainTotal({{$applicant->id}})" id="game_technique{{$applicant->id}}" style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 1px solid #cdcdcd;
					">
					</td>
					<td><input type="number"  class="stop-{{$applicant->id}}" readonly  name="sport_test_mark" @if(isset($trialathleticsrunner) && $trialathleticsrunner->sport_test_mark != '') readonly   @endif value="@if(isset($trialathleticsrunner)){{$trialathleticsrunner->sport_test_mark}}@endif"  id="sport_test_mark{{$applicant->id}}" style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 2px solid #868686;
					">
					</td>
					<td><input type="number"  class="stop-{{$applicant->id}}" readonly  name="total_obtain_mark"@if(isset($trialathleticsrunner) && $trialathleticsrunner->total_obtain_mark != '') readonly @endif value="@if(isset($trialathleticsrunner)){{$trialathleticsrunner->total_obtain_mark}}@endif"  id="total_obtain_mark{{$applicant->id}}" style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 2px solid #868686;
					">
					</td>
					<td><input type="text"  class="stop-{{$applicant->id}}" name="remark" @if(isset($trialathleticsrunner) && $trialathleticsrunner->remark != '') readonly @endif value="@if(isset($trialathleticsrunner)){{$trialathleticsrunner->remark}}@endif"  id="remark{{$applicant->id}}" style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 1px solid #cdcdcd;
					">
																														</td>
					<td><input type="checkbox"  class="stop-{{$applicant->id}}"  id="checkathleticsrunner{{$applicant->id}}" @if(isset($trialathleticsrunner) && $trialathleticsrunner->total_obtain_mark != '') checked disabled @endif   onChange="athleticsrunnerData({{$applicant->id}})"  {{$applicant->id}}  style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 1px solid #cdcdcd;
					">
					</td>
					</form>

					@elseif ($trialType == 16)

                    <form action="{{route('hostelgymnasticboystrialList')}}" id="gymnasticboys_{{$applicant->id}}" class="needs-validation gymnasticboysData"  novalidate method="post">

						@if(isset($applicant->application_no)) <?php $trialgymnasticboys = hosteltrialgymnasticboysData($applicant->application_no, 4);?>
						@if(isset($trialgymnasticboys))

						@endif
						@endif
					<td>
						<input type="hidden" name="application_no" value="{{$applicant->application_no}}">
						<input type="hidden" name="applicant_id" value="{{$applicant->id}}">
						<input type="hidden" name="sport_id" value="{{ data_get($filterData, 'sport_id') }}">
                        <input type="hidden" name="trial_type" value="4">
						<input type="number"  class="stop-{{$applicant->id}}" name="floor_exercise_mark"  @if(isset($trialgymnasticboys) && $trialgymnasticboys->floor_exercise_mark != '') readonly @endif  value="@if(isset($trialgymnasticboys)){{$trialgymnasticboys->floor_exercise_mark}}@endif"  oninput="gymnasticboysskillTotal({{$applicant->id}})" id="floor_exercise_mark{{$applicant->id}}" style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 1px solid #cdcdcd;
					">
					</td>
					<td><input type="number"  class="stop-{{$applicant->id}}" name="pommel_horse_mark" @if(isset($trialgymnasticboys) && $trialgymnasticboys->pommel_horse_mark != '') readonly @endif  value="@if(isset($trialgymnasticboys)){{$trialgymnasticboys->pommel_horse_mark}}@endif" id="pommel_horse_mark{{$applicant->id}}"  oninput="gymnasticboysskillTotal({{$applicant->id}})"  style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 1px solid #cdcdcd;
					">
					</td>
					<td><input type="number"  class="stop-{{$applicant->id}}" name="ring_mark" @if(isset($trialgymnasticboys) && $trialgymnasticboys->ring_mark != '') readonly @endif value="@if(isset($trialgymnasticboys)){{$trialgymnasticboys->ring_mark}}@endif"  id="ring_mark{{$applicant->id}}"  oninput="gymnasticboysskillTotal({{$applicant->id}})"  style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 1px solid #cdcdcd;
					">
					</td>
                    <td><input type="number"  class="stop-{{$applicant->id}}" name="vaulving_horse_mark" @if(isset($trialgymnasticboys) && $trialgymnasticboys->vaulving_horse_mark != '') readonly @endif  value="@if(isset($trialgymnasticboys)){{$trialgymnasticboys->vaulving_horse_mark}}@endif" id="vaulving_horse_mark{{$applicant->id}}"  oninput="gymnasticboysskillTotal({{$applicant->id}})"  style="
                        width: 50px;
                        font-weight: 400;
                        background: none;
                        border: 1px solid #cdcdcd;
                        ">
                        </td>
                        <td><input type="number"  class="stop-{{$applicant->id}}" name="parallel_bar_mark" @if(isset($trialgymnasticboys) && $trialgymnasticboys->parallel_bar_mark != '') readonly @endif value="@if(isset($trialgymnasticboys)){{$trialgymnasticboys->parallel_bar_mark}}@endif"  id="parallel_bar_mark{{$applicant->id}}"  oninput="gymnasticboysskillTotal({{$applicant->id}})"  style="
                        width: 50px;
                        font-weight: 400;
                        background: none;
                        border: 1px solid #cdcdcd;
                        ">
                        </td>
					<td><input type="number"  class="stop-{{$applicant->id}}"  name="horizontal_bar_mark" @if(isset($trialgymnasticboys) && $trialgymnasticboys->horizontal_bar_mark != '') readonly @endif value="@if(isset($trialgymnasticboys)){{$trialgymnasticboys->horizontal_bar_mark}}@endif"  id="horizontal_bar_mark{{$applicant->id}}"  oninput="gymnasticboysskillTotal({{$applicant->id}})"  style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 1px solid #cdcdcd;
					">
					</td>
					<td><input type="number"  class="stop-{{$applicant->id}}" name="test_score_mark"   @if(isset($trialgymnasticboys) && $trialgymnasticboys->test_score_mark != '') readonly @endif value="@if(isset($trialgymnasticboys)){{$trialgymnasticboys->test_score_mark}}@endif"  id="test_score_mark{{$applicant->id}}"    style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 2px solid #868686;
					">
					</td>
					<td><input type="number"  class="stop-{{$applicant->id}}" name="game_technique"   @if(isset($trialgymnasticboys) && $trialgymnasticboys->game_technique != '') readonly @endif   value="@if(isset($trialgymnasticboys)){{$trialgymnasticboys->game_technique}}@endif"  oninput="mainTotal({{$applicant->id}})" id="game_technique{{$applicant->id}}" style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 1px solid #cdcdcd;
					">
					</td>
					<td><input type="number"  class="stop-{{$applicant->id}}" readonly  name="sport_test_mark" @if(isset($trialgymnasticboys) && $trialgymnasticboys->sport_test_mark != '') readonly   @endif value="@if(isset($trialgymnasticboys)){{$trialgymnasticboys->sport_test_mark}}@endif"  id="sport_test_mark{{$applicant->id}}" style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 2px solid #868686;
					">
					</td>
					<td><input type="number"  class="stop-{{$applicant->id}}" readonly  name="total_obtain_mark"@if(isset($trialgymnasticboys) && $trialgymnasticboys->total_obtain_mark != '') readonly @endif value="@if(isset($trialgymnasticboys)){{$trialgymnasticboys->total_obtain_mark}}@endif"  id="total_obtain_mark{{$applicant->id}}" style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 2px solid #868686;
					">
					</td>
					<td><input type="text" name="remark"  class="stop-{{$applicant->id}}" @if(isset($trialgymnasticboys) && $trialgymnasticboys->remark != '') readonly @endif value="@if(isset($trialgymnasticboys)){{$trialgymnasticboys->remark}}@endif"  id="remark{{$applicant->id}}" style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 1px solid #cdcdcd;
					">
																														</td>
					<td><input type="checkbox"  class="stop-{{$applicant->id}}" id="checkgymnasticboys{{$applicant->id}}" @if(isset($trialgymnasticboys) && $trialgymnasticboys->total_obtain_mark != '') checked disabled @endif   onChange="gymnasticboysData({{$applicant->id}})"  {{$applicant->id}}  style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 1px solid #cdcdcd;
					">
					</td>
					</form>


					@elseif ($trialType == 17)

                    <form action="{{route('hostelgymnasticgirlstrialList')}}" id="gymnasticgirls_{{$applicant->id}}" class="needs-validation gymnasticgirlsData"  novalidate method="post">

						@if(isset($applicant->application_no)) <?php $trialgymnasticgirls = hosteltrialgymnasticgirlsData($applicant->application_no, 4);?>
						@if(isset($trialgymnasticgirls))

						@endif
						@endif
					<td>
						<input type="hidden" name="application_no" value="{{$applicant->application_no}}">
						<input type="hidden" name="applicant_id" value="{{$applicant->id}}">
						<input type="hidden" name="sport_id" value="{{ data_get($filterData, 'sport_id') }}">
                        <input type="hidden" name="trial_type" value="4">
						<input type="number"  class="stop-{{$applicant->id}}" name="balancing_beam_mark"  @if(isset($trialgymnasticgirls) && $trialgymnasticgirls->balancing_beam_mark != '') readonly @endif  value="@if(isset($trialgymnasticgirls)){{$trialgymnasticgirls->balancing_beam_mark}}@endif"  oninput="gymnasticgirlsskillTotal({{$applicant->id}})" id="balancing_beam_mark{{$applicant->id}}" style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 1px solid #cdcdcd;
					">
					</td>
					<td><input type="number"  class="stop-{{$applicant->id}}" name="uneven_bar_mark" @if(isset($trialgymnasticgirls) && $trialgymnasticgirls->uneven_bar_mark != '') readonly @endif  value="@if(isset($trialgymnasticgirls)){{$trialgymnasticgirls->uneven_bar_mark}}@endif" id="uneven_bar_mark{{$applicant->id}}"  oninput="gymnasticgirlsskillTotal({{$applicant->id}})"  style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 1px solid #cdcdcd;
					">
					</td>
					<td><input type="number"  class="stop-{{$applicant->id}}" name="floor_exercise_mark" @if(isset($trialgymnasticgirls) && $trialgymnasticgirls->floor_exercise_mark != '') readonly @endif value="@if(isset($trialgymnasticgirls)){{$trialgymnasticgirls->floor_exercise_mark}}@endif"  id="floor_exercise_mark{{$applicant->id}}"  oninput="gymnasticgirlsskillTotal({{$applicant->id}})"  style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 1px solid #cdcdcd;
					">
					</td>
					<td><input type="number"  class="stop-{{$applicant->id}}"  name="vaulving_horse_mark" @if(isset($trialgymnasticgirls) && $trialgymnasticgirls->vaulving_horse_mark != '') readonly @endif value="@if(isset($trialgymnasticgirls)){{$trialgymnasticgirls->vaulving_horse_mark}}@endif"  id="vaulving_horse_mark{{$applicant->id}}"  oninput="gymnasticgirlsskillTotal({{$applicant->id}})"  style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 1px solid #cdcdcd;
					">
					</td>
					<td><input type="number"  class="stop-{{$applicant->id}}" name="test_score_mark"   @if(isset($trialgymnasticgirls) && $trialgymnasticgirls->test_score_mark != '') readonly @endif value="@if(isset($trialgymnasticgirls)){{$trialgymnasticgirls->test_score_mark}}@endif"  id="test_score_mark{{$applicant->id}}"    style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 2px solid #868686;
					">
					</td>
					<td><input type="number"  class="stop-{{$applicant->id}}" name="game_technique"   @if(isset($trialgymnasticgirls) && $trialgymnasticgirls->game_technique != '') readonly @endif   value="@if(isset($trialgymnasticgirls)){{$trialgymnasticgirls->game_technique}}@endif"  oninput="mainTotal({{$applicant->id}})" id="game_technique{{$applicant->id}}" style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 1px solid #cdcdcd;
					">
					</td>
					<td><input type="number"  class="stop-{{$applicant->id}}" readonly  name="sport_test_mark" @if(isset($trialgymnasticgirls) && $trialgymnasticgirls->sport_test_mark != '') readonly   @endif value="@if(isset($trialgymnasticgirls)){{$trialgymnasticgirls->sport_test_mark}}@endif"  id="sport_test_mark{{$applicant->id}}" style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 2px solid #868686;
					">
					</td>
					<td><input type="number"  class="stop-{{$applicant->id}}" readonly  name="total_obtain_mark"@if(isset($trialgymnasticgirls) && $trialgymnasticgirls->total_obtain_mark != '') readonly @endif value="@if(isset($trialgymnasticgirls)){{$trialgymnasticgirls->total_obtain_mark}}@endif"  id="total_obtain_mark{{$applicant->id}}" style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 2px solid #868686;
					">
					</td>
					<td><input type="text" name="remark"  class="stop-{{$applicant->id}}" @if(isset($trialgymnasticgirls) && $trialgymnasticgirls->remark != '') readonly @endif value="@if(isset($trialgymnasticgirls)){{$trialgymnasticgirls->remark}}@endif"  id="remark{{$applicant->id}}" style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 1px solid #cdcdcd;
					">
																														</td>
					<td><input type="checkbox"  class="stop-{{$applicant->id}}" id="checkgymnasticgirls{{$applicant->id}}" @if(isset($trialgymnasticgirls) && $trialgymnasticgirls->total_obtain_mark != '') checked disabled @endif   onChange="gymnasticgirlsData({{$applicant->id}})"  {{$applicant->id}}  style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 1px solid #cdcdcd;
					">
					</td>
					</form>


					@elseif ($trialType == 19)

                    <form action="{{route('hostelathleticsthrowertrialList')}}" id="athleticsthrower_{{$applicant->id}}" class="needs-validation athleticsthrowerData"  novalidate method="post">

						@if(isset($applicant->application_no)) <?php $trialathleticsthrower = hosteltrialathleticsthrowerData($applicant->application_no, 4);?>
						@if(isset($trialathleticsthrower))

						@endif
						@endif
					<td>
						<input type="hidden" name="application_no" value="{{$applicant->application_no}}">
						<input type="hidden" name="applicant_id" value="{{$applicant->id}}">
						<input type="hidden" name="sport_id" value="{{ data_get($filterData, 'sport_id') }}">
                        <input type="hidden" name="trial_type" value="4">
						<input type="number"  class="stop-{{$applicant->id}}" name="stance_mark"  @if(isset($trialathleticsthrower) && $trialathleticsthrower->stance_mark != '') readonly @endif  value="@if(isset($trialathleticsthrower)){{$trialathleticsthrower->stance_mark}}@endif"  oninput="athleticsthrowerskillTotal({{$applicant->id}})" id="stance_mark{{$applicant->id}}" style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 1px solid #cdcdcd;
					">
					</td>
					<td><input type="number"  class="stop-{{$applicant->id}}" name="action_mark" @if(isset($trialathleticsthrower) && $trialathleticsthrower->action_mark != '') readonly @endif  value="@if(isset($trialathleticsthrower)){{$trialathleticsthrower->action_mark}}@endif" id="action_mark{{$applicant->id}}"  oninput="athleticsthrowerskillTotal({{$applicant->id}})"  style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 1px solid #cdcdcd;
					">
					</td>
					<td><input type="number"  class="stop-{{$applicant->id}}" name="execution_mark" @if(isset($trialathleticsthrower) && $trialathleticsthrower->execution_mark != '') readonly @endif value="@if(isset($trialathleticsthrower)){{$trialathleticsthrower->execution_mark}}@endif"  id="execution_mark{{$applicant->id}}"  oninput="athleticsthrowerskillTotal({{$applicant->id}})"  style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 1px solid #cdcdcd;
					">
					</td>
					<td><input type="number"  class="stop-{{$applicant->id}}"  name="follow_throw_mark" @if(isset($trialathleticsthrower) && $trialathleticsthrower->follow_throw_mark != '') readonly @endif value="@if(isset($trialathleticsthrower)){{$trialathleticsthrower->follow_throw_mark}}@endif"  id="follow_throw_mark{{$applicant->id}}"  oninput="athleticsthrowerskillTotal({{$applicant->id}})"  style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 1px solid #cdcdcd;
					">
					</td>
					<td><input type="number"  class="stop-{{$applicant->id}}" name="test_score_mark"   @if(isset($trialathleticsthrower) && $trialathleticsthrower->test_score_mark != '') readonly @endif value="@if(isset($trialathleticsthrower)){{$trialathleticsthrower->test_score_mark}}@endif"  id="test_score_mark{{$applicant->id}}"    style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 2px solid #868686;
					">
					</td>
					<td><input type="number"  class="stop-{{$applicant->id}}" name="game_technique"   @if(isset($trialathleticsthrower) && $trialathleticsthrower->game_technique != '') readonly @endif   value="@if(isset($trialathleticsthrower)){{$trialathleticsthrower->game_technique}}@endif"  oninput="mainTotal({{$applicant->id}})" id="game_technique{{$applicant->id}}" style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 1px solid #cdcdcd;
					">
					</td>
					<td><input type="number"  class="stop-{{$applicant->id}}" readonly  name="sport_test_mark" @if(isset($trialathleticsthrower) && $trialathleticsthrower->sport_test_mark != '') readonly   @endif value="@if(isset($trialathleticsthrower)){{$trialathleticsthrower->sport_test_mark}}@endif"  id="sport_test_mark{{$applicant->id}}" style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 2px solid #868686;
					">
					</td>
					<td><input type="number"  class="stop-{{$applicant->id}}" readonly  name="total_obtain_mark"@if(isset($trialathleticsthrower) && $trialathleticsthrower->total_obtain_mark != '') readonly @endif value="@if(isset($trialathleticsthrower)){{$trialathleticsthrower->total_obtain_mark}}@endif"  id="total_obtain_mark{{$applicant->id}}" style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 2px solid #868686;
					">
					</td>
					<td><input type="text"  class="stop-{{$applicant->id}}" name="remark" @if(isset($trialathleticsthrower) && $trialathleticsthrower->remark != '') readonly @endif value="@if(isset($trialathleticsthrower)){{$trialathleticsthrower->remark}}@endif"  id="remark{{$applicant->id}}" style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 1px solid #cdcdcd;
					">
																														</td>
					<td><input type="checkbox"  class="stop-{{$applicant->id}}"  id="checkathleticsthrower{{$applicant->id}}" @if(isset($trialathleticsthrower) && $trialathleticsthrower->total_obtain_mark != '') checked disabled @endif   onChange="athleticsthrowerData({{$applicant->id}})"  {{$applicant->id}}  style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 1px solid #cdcdcd;
					">
					</td>
					</form>



                    @elseif ($trialType == 20)

                    <form action="{{route('hostelboxingtrialList')}}" id="boxing_{{$applicant->id}}" class="needs-validation boxingData"  novalidate method="post">

						@if(isset($applicant->application_no)) <?php $trialboxing = hosteltrialboxingData($applicant->application_no, 4);?>
						@if(isset($trialboxing))

						@endif
						@endif
					<td>
						<input type="hidden" name="application_no" value="{{$applicant->application_no}}">
						<input type="hidden" name="applicant_id" value="{{$applicant->id}}">
						<input type="hidden" name="sport_id" value="{{$filterData['sport_id']}}">
                        <input type="hidden" name="trial_type" value="4">
						<input type="number"  class="stop-{{$applicant->id}}" name="punching_pad"  @if(isset($trialboxing) && $trialboxing->punching_pad != '') readonly @endif  value="@if(isset($trialboxing)){{$trialboxing->punching_pad}}@endif"  oninput="boxingskillTotal({{$applicant->id}})" id="punching_pad{{$applicant->id}}" style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 1px solid #cdcdcd;
					">
					</td>
					<td><input type="number"  class="stop-{{$applicant->id}}" name="shadow_boxing" @if(isset($trialboxing) && $trialboxing->shadow_boxing != '') readonly @endif  value="@if(isset($trialboxing)){{$trialboxing->shadow_boxing}}@endif" id="shadow_boxing{{$applicant->id}}"  oninput="boxingskillTotal({{$applicant->id}})"  style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 1px solid #cdcdcd;
					">
					</td>
					<td><input type="number"  class="stop-{{$applicant->id}}" name="skypink" @if(isset($trialboxing) && $trialboxing->skypink != '') readonly @endif value="@if(isset($trialboxing)){{$trialboxing->skypink}}@endif"  id="skypink{{$applicant->id}}"  oninput="boxingskillTotal({{$applicant->id}})"  style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 1px solid #cdcdcd;
					">
					</td>
					<td><input type="number"  class="stop-{{$applicant->id}}"  name="sparring" @if(isset($trialboxing) && $trialboxing->sparring != '') readonly @endif value="@if(isset($trialboxing)){{$trialboxing->sparring}}@endif"  id="sparring{{$applicant->id}}"  oninput="boxingskillTotal({{$applicant->id}})"  style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 1px solid #cdcdcd;
					">
					</td>
					<td><input type="number"  class="stop-{{$applicant->id}}" name="test_score_mark"   @if(isset($trialboxing) && $trialboxing->test_score_mark != '') readonly @endif value="@if(isset($trialboxing)){{$trialboxing->test_score_mark}}@endif"  id="test_score_mark{{$applicant->id}}"    style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 2px solid #868686;
					">
					</td>
					<td><input type="number"  class="stop-{{$applicant->id}}" name="game_technique"   @if(isset($trialboxing) && $trialboxing->game_technique != '') readonly @endif   value="@if(isset($trialboxing)){{$trialboxing->game_technique}}@endif"  oninput="mainTotal({{$applicant->id}})" id="game_technique{{$applicant->id}}" style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 1px solid #cdcdcd;
					">
					</td>
					<td><input type="number"  class="stop-{{$applicant->id}}" readonly  name="sport_test_mark" @if(isset($trialboxing) && $trialboxing->sport_test_mark != '') readonly   @endif value="@if(isset($trialboxing)){{$trialboxing->sport_test_mark}}@endif"  id="sport_test_mark{{$applicant->id}}" style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 2px solid #868686;
					">
					</td>
					<td><input type="number"  class="stop-{{$applicant->id}}" readonly  name="total_obtain_mark"@if(isset($trialboxing) && $trialboxing->total_obtain_mark != '') readonly @endif value="@if(isset($trialboxing)){{$trialboxing->total_obtain_mark}}@endif"  id="total_obtain_mark{{$applicant->id}}" style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 2px solid #868686;
					">
					</td>
					<td><input type="text"  class="stop-{{$applicant->id}}" name="remark" @if(isset($trialboxing) && $trialboxing->remark != '') readonly @endif value="@if(isset($trialboxing)){{$trialboxing->remark}}@endif"  id="remark{{$applicant->id}}" style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 1px solid #cdcdcd;
					">
																												</td>
					<td><input type="checkbox"  class="stop-{{$applicant->id}}" id="checkboxing{{$applicant->id}}" @if(isset($trialboxing)) checked disabled @endif   onChange="boxingData({{$applicant->id}})"  {{$applicant->id}}  style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 1px solid #cdcdcd;
					">
					</td>
					</form>




                    @elseif ($trialType == 21)

                    <form action="{{route('hostelbasketballtrialList')}}" id="basketball_{{$applicant->id}}" class="needs-validation basketballData"  novalidate method="post">

						@if(isset($applicant->application_no)) <?php $trialbasketball = hosteltrialbasketballData($applicant->application_no, 4);?>
						@if(isset($trialbasketball))

						@endif
						@endif
					<td>
						<input type="hidden" name="application_no" value="{{$applicant->application_no}}">
						<input type="hidden" name="applicant_id" value="{{$applicant->id}}">
						<input type="hidden" name="sport_id" value="{{$filterData['sport_id']}}">
                        <input type="hidden" name="trial_type" value="4">
						<input type="number"  class="stop-{{$applicant->id}}" name="dribbling"  @if(isset($trialbasketball) && $trialbasketball->dribbling != '') readonly @endif  value="@if(isset($trialbasketball)){{$trialbasketball->dribbling}}@endif"  oninput="basketballskillTotal({{$applicant->id}})" id="dribbling{{$applicant->id}}" style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 1px solid #cdcdcd;
					">
					</td>
					<td><input type="number"  class="stop-{{$applicant->id}}" name="passing" @if(isset($trialbasketball) && $trialbasketball->passing != '') readonly @endif  value="@if(isset($trialbasketball)){{$trialbasketball->passing}}@endif" id="passing{{$applicant->id}}"  oninput="basketballskillTotal({{$applicant->id}})"  style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 1px solid #cdcdcd;
					">
					</td>
					<td><input type="number"  class="stop-{{$applicant->id}}" name="standing" @if(isset($trialbasketball) && $trialbasketball->standing != '') readonly @endif value="@if(isset($trialbasketball)){{$trialbasketball->standing}}@endif"  id="standing{{$applicant->id}}"  oninput="basketballskillTotal({{$applicant->id}})"  style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 1px solid #cdcdcd;
					">
					</td>
					<td><input type="number"  class="stop-{{$applicant->id}}"  name="jumpshot" @if(isset($trialbasketball) && $trialbasketball->jumpshot != '') readonly @endif value="@if(isset($trialbasketball)){{$trialbasketball->jumpshot}}@endif"  id="jumpshot{{$applicant->id}}"  oninput="basketballskillTotal({{$applicant->id}})"  style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 1px solid #cdcdcd;
					">
					</td>
					<td><input type="number"  class="stop-{{$applicant->id}}" name="test_score_mark"   @if(isset($trialbasketball) && $trialbasketball->test_score_mark != '') readonly @endif value="@if(isset($trialbasketball)){{$trialbasketball->test_score_mark}}@endif"  id="test_score_mark{{$applicant->id}}"    style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 2px solid #868686;
					">
					</td>
					<td><input type="number"  class="stop-{{$applicant->id}}" name="game_technique"   @if(isset($trialbasketball) && $trialbasketball->game_technique != '') readonly @endif   value="@if(isset($trialbasketball)){{$trialbasketball->game_technique}}@endif"  oninput="mainTotal({{$applicant->id}})" id="game_technique{{$applicant->id}}" style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 1px solid #cdcdcd;
					">
					</td>
					<td><input type="number"  class="stop-{{$applicant->id}}" readonly  name="sport_test_mark" @if(isset($trialbasketball) && $trialbasketball->sport_test_mark != '') readonly   @endif value="@if(isset($trialbasketball)){{$trialbasketball->sport_test_mark}}@endif"  id="sport_test_mark{{$applicant->id}}" style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 2px solid #868686;
					">
					</td>
					<td><input type="number"  class="stop-{{$applicant->id}}" readonly  name="total_obtain_mark"@if(isset($trialbasketball) && $trialbasketball->total_obtain_mark != '') readonly @endif value="@if(isset($trialbasketball)){{$trialbasketball->total_obtain_mark}}@endif"  id="total_obtain_mark{{$applicant->id}}" style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 2px solid #868686;
					">
					</td>
					<td><input type="text"  class="stop-{{$applicant->id}}" name="remark" @if(isset($trialbasketball) && $trialbasketball->remark != '') readonly @endif value="@if(isset($trialbasketball)){{$trialbasketball->remark}}@endif"  id="remark{{$applicant->id}}" style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 1px solid #cdcdcd;
					">
																												</td>
					<td><input type="checkbox"  class="stop-{{$applicant->id}}" id="checkbasketball{{$applicant->id}}" @if(isset($trialbasketball)) checked disabled @endif   onChange="basketballData({{$applicant->id}})"  {{$applicant->id}}  style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 1px solid #cdcdcd;
					">
					</td>
					</form>


                    @elseif ($trialType == 22)

                    <form action="{{route('hosteltabletennistrialList')}}" id="tabletennis_{{$applicant->id}}" class="needs-validation tabletennisData"  novalidate method="post">

						@if(isset($applicant->application_no)) <?php $trialtabletennis = hosteltrialtabletennisData($applicant->application_no, 4);?>
						@if(isset($trialtabletennis))

						@endif
						@endif
					<td>
						<input type="hidden" name="application_no" value="{{$applicant->application_no}}">
						<input type="hidden" name="applicant_id" value="{{$applicant->id}}">
						<input type="hidden" name="sport_id" value="{{$filterData['sport_id']}}">
                        <input type="hidden" name="trial_type" value="4">
						<input type="number"  class="stop-{{$applicant->id}}" name="counter"  @if(isset($trialtabletennis) && $trialtabletennis->counter != '') readonly @endif  value="@if(isset($trialtabletennis)){{$trialtabletennis->counter}}@endif"  oninput="tabletennisskillTotal({{$applicant->id}})" id="counter{{$applicant->id}}" style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 1px solid #cdcdcd;
					">
					</td>
					<td><input type="number"  class="stop-{{$applicant->id}}" name="push" @if(isset($trialtabletennis) && $trialtabletennis->push != '') readonly @endif  value="@if(isset($trialtabletennis)){{$trialtabletennis->push}}@endif" id="push{{$applicant->id}}"  oninput="tabletennisskillTotal({{$applicant->id}})"  style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 1px solid #cdcdcd;
					">
					</td>
					<td><input type="number"  class="stop-{{$applicant->id}}" name="block" @if(isset($trialtabletennis) && $trialtabletennis->block != '') readonly @endif value="@if(isset($trialtabletennis)){{$trialtabletennis->block}}@endif"  id="block{{$applicant->id}}"  oninput="tabletennisskillTotal({{$applicant->id}})"  style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 1px solid #cdcdcd;
					">
					</td>
					<td><input type="number"  class="stop-{{$applicant->id}}"  name="service" @if(isset($trialtabletennis) && $trialtabletennis->service != '') readonly @endif value="@if(isset($trialtabletennis)){{$trialtabletennis->service}}@endif"  oninput="tabletennisskillTotal({{$applicant->id}})"  id="service{{$applicant->id}}" style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 1px solid #cdcdcd;
					">
					</td>
					<td><input type="number"  class="stop-{{$applicant->id}}" name="test_score_mark"   @if(isset($trialtabletennis) && $trialtabletennis->test_score_mark != '') readonly @endif value="@if(isset($trialtabletennis)){{$trialtabletennis->test_score_mark}}@endif"  id="test_score_mark{{$applicant->id}}"    style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 2px solid #868686;
					">
					</td>
					<td><input type="number"  class="stop-{{$applicant->id}}" name="game_technique"   @if(isset($trialtabletennis) && $trialtabletennis->game_technique != '') readonly @endif   value="@if(isset($trialtabletennis)){{$trialtabletennis->game_technique}}@endif"  oninput="mainTotal({{$applicant->id}})" id="game_technique{{$applicant->id}}" style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 1px solid #cdcdcd;
					">
					</td>
					<td><input type="number"  class="stop-{{$applicant->id}}" readonly  name="sport_test_mark" @if(isset($trialtabletennis) && $trialtabletennis->sport_test_mark != '') readonly   @endif value="@if(isset($trialtabletennis)){{$trialtabletennis->sport_test_mark}}@endif"  id="sport_test_mark{{$applicant->id}}" style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 2px solid #868686;
					">
					</td>
					<td><input type="number"  class="stop-{{$applicant->id}}" readonly  name="total_obtain_mark"@if(isset($trialtabletennis) && $trialtabletennis->total_obtain_mark != '') readonly @endif value="@if(isset($trialtabletennis)){{$trialtabletennis->total_obtain_mark}}@endif"  id="total_obtain_mark{{$applicant->id}}" style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 2px solid #868686;
					">
					</td>
					<td><input type="text"  class="stop-{{$applicant->id}}" name="remark" @if(isset($trialtabletennis) && $trialtabletennis->remark != '') readonly @endif value="@if(isset($trialtabletennis)){{$trialtabletennis->remark}}@endif"  id="remark{{$applicant->id}}" style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 1px solid #cdcdcd;
					">
																												</td>
					<td><input type="checkbox"  class="stop-{{$applicant->id}}"  id="checktabletennis{{$applicant->id}}" @if(isset($trialtabletennis)) checked disabled @endif   onChange="tabletennisData({{$applicant->id}})"  {{$applicant->id}}  style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 1px solid #cdcdcd;
					">
					</td>
					</form>



                    @elseif ($trialType == 23)
                    <form action="{{route('hostelhandballtrialList')}}" id="handball_{{$applicant->id}}" class="needs-validation handballData"  novalidate method="post">
						@if(isset($applicant->application_no)) <?php $trialhandball = hosteltrialhandballData($applicant->application_no, 4);?>
						@if(isset($trialhandball))
						@endif
						@endif
					<td>
						<input type="hidden" name="application_no" value="{{$applicant->application_no}}">
						<input type="hidden" name="applicant_id" value="{{$applicant->id}}">
						<input type="hidden" name="sport_id" value="{{$filterData['sport_id']}}">
                        <input type="hidden" name="trial_type" value="4">
						<input type="number"  class="stop-{{$applicant->id}}" name="catch_pass"  @if(isset($trialhandball) && $trialhandball->catch_pass != '') readonly @endif  value="@if(isset($trialhandball)){{$trialhandball->catch_pass}}@endif"  oninput="handballskillTotal({{$applicant->id}})" id="catch_pass{{$applicant->id}}" style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 1px solid #cdcdcd;
					">
					</td>
					<td><input type="number"  class="stop-{{$applicant->id}}" name="dibbling" @if(isset($trialhandball) && $trialhandball->dibbling != '') readonly @endif  value="@if(isset($trialhandball)){{$trialhandball->dibbling}}@endif" id="dibbling{{$applicant->id}}"  oninput="handballskillTotal({{$applicant->id}})"  style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 1px solid #cdcdcd;
					">
					</td>
					<td><input type="number"  class="stop-{{$applicant->id}}" name="standing_shot" @if(isset($trialhandball) && $trialhandball->standing_shot != '') readonly @endif value="@if(isset($trialhandball)){{$trialhandball->standing_shot}}@endif"  id="standing_shot{{$applicant->id}}"  oninput="handballskillTotal({{$applicant->id}})"  style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 1px solid #cdcdcd;
					">
					</td>
					<td><input type="number"  class="stop-{{$applicant->id}}"  name="jumpshot" @if(isset($trialhandball) && $trialhandball->jumpshot != '') readonly @endif value="@if(isset($trialhandball)){{$trialhandball->jumpshot}}@endif"  id="jumpshot{{$applicant->id}}"  oninput="handballskillTotal({{$applicant->id}})"  style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 1px solid #cdcdcd;
					">
					</td>
					<td><input type="number"  class="stop-{{$applicant->id}}" name="test_score_mark"   @if(isset($trialhandball) && $trialhandball->test_score_mark != '') readonly @endif value="@if(isset($trialhandball)){{$trialhandball->test_score_mark}}@endif"  id="test_score_mark{{$applicant->id}}"    style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 2px solid #868686;
					">
					</td>
					<td><input type="number"  class="stop-{{$applicant->id}}" name="game_technique"   @if(isset($trialhandball) && $trialhandball->game_technique != '') readonly @endif   value="@if(isset($trialhandball)){{$trialhandball->game_technique}}@endif"  oninput="mainTotal({{$applicant->id}})" id="game_technique{{$applicant->id}}" style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 1px solid #cdcdcd;
					">
					</td>
					<td><input type="number"  class="stop-{{$applicant->id}}" readonly  name="sport_test_mark" @if(isset($trialhandball) && $trialhandball->sport_test_mark != '') readonly @endif  value="@if(isset($trialhandball)){{$trialhandball->sport_test_mark}}@endif"  id="sport_test_mark{{$applicant->id}}" style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 2px solid #868686;
					">
					</td>
					<td><input type="number"  class="stop-{{$applicant->id}}" readonly  name="total_obtain_mark"@if(isset($trialhandball) && $trialhandball->total_obtain_mark != '') readonly @endif value="@if(isset($trialhandball)){{$trialhandball->total_obtain_mark}}@endif"  id="total_obtain_mark{{$applicant->id}}" style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 2px solid #868686;
					">
					</td>
					<td><input type="text" name="remark"  class="stop-{{$applicant->id}}" @if(isset($trialhandball) && $trialhandball->remark != '') readonly @endif value="@if(isset($trialhandball)){{$trialhandball->remark}}@endif"  id="remark{{$applicant->id}}" style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 1px solid #cdcdcd;
					">
																												</td>
					<td><input type="checkbox"  class="stop-{{$applicant->id}}"  id="checkhandball{{$applicant->id}}" @if(isset($trialhandball) && $trialhandball->total_obtain_mark != '') checked disabled @endif   onChange="handballData({{$applicant->id}})"  {{$applicant->id}}  style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 1px solid #cdcdcd;
					">
					</td>
					</form>


                    @elseif ($trialType == 24)

                    <form action="{{route('hostelarcherytrialList')}}" id="archery_{{$applicant->id}}" class="needs-validation archeryData"  novalidate method="post">

						@if(isset($applicant->application_no)) <?php $trialarchery = hosteltrialarcheryData($applicant->application_no, 4);?>
						@if(isset($trialarchery))

						@endif
						@endif
					<td>
						<input type="hidden" name="application_no" value="{{$applicant->application_no}}">
						<input type="hidden" name="applicant_id" value="{{$applicant->id}}">
						<input type="hidden" name="sport_id" value="{{$filterData['sport_id']}}">
                        <input type="hidden" name="trial_type" value="4">
						<input type="number"  class="stop-{{$applicant->id}}" name="staines"  @if(isset($trialarchery) && $trialarchery->staines != '') readonly @endif  value="@if(isset($trialarchery)){{$trialarchery->staines}}@endif"  oninput="archeryskillTotal({{$applicant->id}})" id="staines{{$applicant->id}}" style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 1px solid #cdcdcd;
					">
					</td>
					<td><input type="number"  class="stop-{{$applicant->id}}" name="knocking" @if(isset($trialarchery) && $trialarchery->knocking != '') readonly @endif  value="@if(isset($trialarchery)){{$trialarchery->knocking}}@endif" id="knocking{{$applicant->id}}"  oninput="archeryskillTotal({{$applicant->id}})"  style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 1px solid #cdcdcd;
					">
					</td>
					<td><input type="number"  class="stop-{{$applicant->id}}" name="expansion" @if(isset($trialarchery) && $trialarchery->expansion != '') readonly @endif value="@if(isset($trialarchery)){{$trialarchery->expansion}}@endif"  id="expansion{{$applicant->id}}"  oninput="archeryskillTotal({{$applicant->id}})"  style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 1px solid #cdcdcd;
					">
					</td>
					<td><input type="number"  class="stop-{{$applicant->id}}"  name="driving" @if(isset($trialarchery) && $trialarchery->driving != '') readonly @endif value="@if(isset($trialarchery)){{$trialarchery->driving}}@endif"  id="driving{{$applicant->id}}"  oninput="archeryskillTotal({{$applicant->id}})"  style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 1px solid #cdcdcd;
					">
					</td>
                    <td><input type="number"  class="stop-{{$applicant->id}}"  name="anchoring" @if(isset($trialarchery) && $trialarchery->anchoring != '') readonly @endif value="@if(isset($trialarchery)){{$trialarchery->anchoring}}@endif"  id="anchoring{{$applicant->id}}"  oninput="archeryskillTotal({{$applicant->id}})"  style="
                        width: 50px;
                        font-weight: 400;
                        background: none;
                        border: 1px solid #cdcdcd;
                        ">
                        </td>
                    <td><input type="number"  class="stop-{{$applicant->id}}"  name="titan_hold" @if(isset($trialarchery) && $trialarchery->titan_hold != '') readonly @endif value="@if(isset($trialarchery)){{$trialarchery->titan_hold}}@endif"  id="titan_hold{{$applicant->id}}"  oninput="archeryskillTotal({{$applicant->id}})"  style="
                        width: 50px;
                        font-weight: 400;
                        background: none;
                        border: 1px solid #cdcdcd;
                        ">
                        </td>
                        <td><input type="number"  class="stop-{{$applicant->id}}"  name="aiming" @if(isset($trialarchery) && $trialarchery->aiming != '') readonly @endif value="@if(isset($trialarchery)){{$trialarchery->aiming}}@endif"  id="aiming{{$applicant->id}}"  oninput="archeryskillTotal({{$applicant->id}})"  style="
                            width: 50px;
                            font-weight: 400;
                            background: none;
                            border: 1px solid #cdcdcd;
                            ">
                            </td>
                        <td><input type="number"  class="stop-{{$applicant->id}}"  name="titan_release" @if(isset($trialarchery) && $trialarchery->titan_release != '') readonly @endif value="@if(isset($trialarchery)){{$trialarchery->titan_release}}@endif"  id="titan_release{{$applicant->id}}"  oninput="archeryskillTotal({{$applicant->id}})"  style="
                            width: 50px;
                            font-weight: 400;
                            background: none;
                            border: 1px solid #cdcdcd;
                            ">
                            </td>

                            <td><input type="number"  class="stop-{{$applicant->id}}"   name="after_hold" @if(isset($trialarchery)) readonly value="{{$trialarchery->after_hold}}" @endif  id="after_hold{{$applicant->id}}"  oninput="archeryskillTotal({{$applicant->id}})"  style="
                                width: 50px;
                                font-weight: 400;
                                background: none;
                                border: 1px solid #cdcdcd;
                                ">
                                </td>
					<td><input type="number"  class="stop-{{$applicant->id}}" readonly  name="sport_test_mark" @if(isset($trialarchery)) readonly   value="{{$trialarchery->sport_test_mark}}"  @endif  id="sport_test_mark{{$applicant->id}}" style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 2px solid #868686;
					">
					</td>
					<td><input type="number"  class="stop-{{$applicant->id}}" readonly  name="total_obtain_mark"@if(isset($trialarchery)) readonly value="{{$trialarchery->total_obtain_mark}}" @endif  id="total_obtain_mark{{$applicant->id}}" style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 2px solid #868686;
					">
					</td>
					<td><input type="text" name="remark"  class="stop-{{$applicant->id}}" @if(isset($trialarchery)) readonly value="{{$trialarchery->remark}}" @endif  id="remark{{$applicant->id}}" style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 1px solid #cdcdcd;
					">
																												</td>
					<td><input type="checkbox"  class="stop-{{$applicant->id}}"  id="checkarchery{{$applicant->id}}" @if(isset($trialarchery)) checked disabled @endif   onChange="archeryData({{$applicant->id}})"  {{$applicant->id}}  style="
					width: 50px;
					font-weight: 400;
					background: none;
					border: 1px solid #cdcdcd;
					">
					</td>
					</form>


	@endif

@endif
{{-- End change on basis of subSport and gender --}}


	</tr>

							@endforeach

						</tbody>
					</table>



























                    <div id="prodiv" class="dn">


                        <table class="dn" style="width: 100%; margin-bottom: 5px;" border="0" >
                            <tbody>
                                <tr>

                                    <td colspan="2" align="center" style="position: relative; border: 0; padding-bottom: 5px;">
                                        <div style="border-bottom: 0px solid #000; ">
                                            <img src="{{ url('admin') }}/images/logo.png" style="position: absolute; width: 70px; top: 5px; left: 0;">
                                            <div style="font-size: 25px; font-weight: bold;">
                                                Department of Sports
                                            </div>
                                            <div style="font-size: 18px; font-weight: bold;">
                                                GOVERNMENT OF UTTAR PRADESH
                                            </div>
                                            <div style="font-size: 18px; font-weight: bold;">

				@if ($trialType == 1)
				Hockey Trial  List

				@elseif ($trialType == 2)
				Hockey Keeper Trial  List

				@elseif ($trialType == 3)
				Badminton Trial  List


				@elseif ($trialType == 4)
				Volleyball Trial  List

				@elseif ($trialType == 5)
				Khushti Trial  List

				@elseif ($trialType == 6)
				Swimming Trial  List

				@elseif ($trialType == 7)
				Football Keeper Trial  List


				@elseif ($trialType == 8)
				Football Trial  List


				@elseif ($trialType == 9)
				Athletic Jumper Trial  List

				@elseif ($trialType == 10)
				Cricket Batsman Trial  List

				@elseif ($trialType == 11)
				Cricket Bowler Trial  List

				@elseif ($trialType == 12)
				Cricket Keeper Trial  List

				@elseif ($trialType == 13)
				Kabadi Trial  List

				@elseif ($trialType == 14)
				Judo Trial  List

				@elseif ($trialType == 15)
				Athletic Runner Trial  List

				@elseif ($trialType == 16)
				Gymnastic Boy's Trial  List

				@elseif ($trialType == 17)
				Gymnastic Girl's Trial  List

				@elseif ($trialType == 18)
				Trial  List

                @elseif ($trialType == 19)
                Athletic Thrower Trial  List

                @elseif ($trialType == 20)
                Boxing Trial  List
                @elseif ($trialType == 21)
                Basketball Trial  List
                @elseif ($trialType == 22)
             Table Tennis Trial  List
             @elseif ($trialType == 23)
             Handball Trial  List
             @elseif ($trialType == 24)
             Archery Trial  List


				@endif


                <br>
              Coaching Camp Trial List

                                            </div>

                                        </div>
                                    </td>


                                </tr>
                                <tr>
                                    <td style="text-align: left; font-size: 12px; padding-top: 5px;"></td>
                                    <td style="text-align: right; font-size: 12px; padding-top: 5px;"><b>Print Date :</b> {{ Carbon\Carbon::parse(date('Y-m-d') )->format('d/m/Y') }}</td>
                                </tr>
                            </tbody>
                        </table>
                        <table  class="table text-center table-bordered" style="
                        font-size: smaller;
                    "  id="dataTablee">
                                            <thead>
                                                <tr>
                                                    <th rowspan="3" valign="top">क्रस
                                                    </th>
                                                    <th rowspan="3" valign="top">फार्म सं0<br> </th>
                                                    <th valign="top">उम्मीदवार का नाम<br> </th>
                                                    <th valign="top">जन्म तिथि<br>
                                                    </th>
                                                    <th rowspan="3" valign="top"> राज्य
                                                    </th>
                                                    <th rowspan="3" valign="top"> जनपद
                                                    </th>
                                                    <th rowspan="3" valign="top"> लिंग
                                                    </th>
                                                    <th colspan="12" valign="top">शारीरिक परीक्षा<span lang="en"><br>
                                                       </span>
                                                        <br> पूर्णांक- 50</th>

                                                        @if ($trialType == 1)
                                                    <th colspan="7" valign="top">खेल परीक्षा<br> पूर्णांक - 50</th>
                                                     @elseif ($trialType == 2)

                                                     <th colspan="8" valign="top">खेल परीक्षा<br> पूर्णांक - 50</th>

                                                     @elseif ($trialType == 3)

                                                     <th colspan="7" valign="top">खेल परीक्षा<br> पूर्णांक - 50</th>

                                                     @elseif ($trialType == 4)

                                                     <th colspan="7" valign="top">खेल परीक्षा<br> पूर्णांक - 50</th>
                                                     @elseif ($trialType == 5)

                                                     <th colspan="5" valign="top">खेल परीक्षा<br> पूर्णांक - 50</th>
                                                     @elseif ($trialType == 6)

                                                     <th colspan="9" valign="top">खेल परीक्षा<br> पूर्णांक - 50</th>
                                                     @elseif ($trialType == 7)

                                                     <th colspan="7" valign="top">खेल परीक्षा<br> पूर्णांक - 50</th>
                                                     @elseif ($trialType == 8)

                                                     <th colspan="7" valign="top">खेल परीक्षा<br> पूर्णांक - 50</th>

                                                     @elseif ($trialType == 9)

                                                     <th colspan="7" valign="top">खेल परीक्षा<br> पूर्णांक - 50</th>


                                                     @elseif ($trialType == 10)

                                                     <th colspan="7" valign="top">खेल परीक्षा<br> पूर्णांक - 50</th>


                                                     @elseif ($trialType == 11)

                                                     <th colspan="7" valign="top">खेल परीक्षा<br> पूर्णांक - 50</th>


                                                     @elseif ($trialType == 12)

                                                     <th colspan="7" valign="top">खेल परीक्षा<br> पूर्णांक - 50</th>

                                                     @elseif ($trialType == 13)

                                                     <th colspan="7" valign="top">खेल परीक्षा<br> पूर्णांक - 50</th>

                                                     @elseif ($trialType == 14)

                                                     <th colspan="7" valign="top">खेल परीक्षा<br> पूर्णांक - 50</th>


                                                     @elseif ($trialType == 15)

                                                     <th colspan="7" valign="top">खेल परीक्षा<br> पूर्णांक - 50</th>


                                                     @elseif ($trialType == 16)

                                                     <th colspan="9" valign="top">खेल परीक्षा<br> पूर्णांक - 50</th>

                                                     @elseif ($trialType == 17)

                                                     <th colspan="7" valign="top">खेल परीक्षा<br> पूर्णांक - 50</th>
                                                     @elseif ($trialType == 19)

                                                     <th colspan="7" valign="top">खेल परीक्षा<br> पूर्णांक - 50</th>
                                                     @elseif ($trialType == 20)

                                                     <th colspan="7" valign="top">खेल परीक्षा<br> पूर्णांक - 50</th>
                                                     @elseif ($trialType == 21)

                                                     <th colspan="7" valign="top">खेल परीक्षा<br> पूर्णांक - 50</th>
                                                     @elseif ($trialType == 22)

                                                     <th colspan="7" valign="top">खेल परीक्षा<br> पूर्णांक - 50</th>

                                                     @elseif ($trialType == 23)

                                                     <th colspan="7" valign="top">खेल परीक्षा<br> पूर्णांक - 50</th>



                                                     @elseif ($trialType == 24)

                                                     <th colspan="10" valign="top">खेल परीक्षा<br> पूर्णांक - 50</th>


                                                     @endif


                    {{-- End change on basis of subSport and gender --}}


                                                    <th rowspan="3" valign="top">कुल प्रा०
                                                        <br> पूर्ण०
                                                         100<br>
                                                    </th>
                                                    <th rowspan="3" valign="top">अभ्यु०
                                                    </th>
                                                    <th rowspan="3" valign="top"> एक्शन
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th rowspan="2" valign="top">&nbsp;

                                                    </th>
                                                    <th rowspan="2" valign="top">&nbsp;

                                                    </th>
                                                    <th colspan="2" valign="top">50/100मी<br> 10 अंक</th>
                                                    <th colspan="2" valign="top">800मी0<br> 10अंक
                                                    </th>
                                                    <th colspan="2" valign="top">ब्रॉड जम्प<br> 10अंक
                                                    </th>
                                                    <th colspan="2" valign="top">शटल रन<br> 10अंक
                                                    </th>
                                                    <th colspan="2" valign="top">बाल थ्रो<br> 10अंक
                                                    </th>
                                                    <th rowspan="2" valign="top">कुल प्रा०<br>
                                                    </th>
                                                    <th rowspan="2" valign="top">एक्शन
                                                    </th>


                    {{--  change on basis of subSport and gender --}}



                                                    @if ($trialType == 1)
                                                    <th colspan="4" valign="top">स्किल टेस्ट
                                                        <br> (पूर्ण० - 30)</th>
                                                    <th valign="top">&nbsp;
                                                    @elseif ($trialType == 2)
                                                    <th colspan="5" valign="top">स्किल टेस्ट
                                                        <br> (पूर्ण० - 30)</th>
                                                    <th valign="top">&nbsp;


                                                        @elseif ($trialType == 3)
                                                    <th colspan="4" valign="top">स्किल टेस्ट
                                                        <br> (पूर्ण० - 30)</th>
                                                    <th valign="top">&nbsp;

                                                        @elseif ($trialType == 4)
                                                        <th colspan="4" valign="top">स्किल टेस्ट
                                                            <br> (पूर्ण० - 30)</th>
                                                        <th valign="top">&nbsp;


                                                    @elseif ($trialType == 5)
                                                    <th colspan="2" valign="top">स्किल टेस्ट
                                                        <br> (पूर्ण० - 30)</th>
                                                    <th valign="top">&nbsp;

                                                    @elseif ($trialType == 6)
                                                    <th colspan="6" valign="top">स्किल टेस्ट
                                                        <br> (पूर्ण० - 30)</th>
                                                    <th valign="top">&nbsp;

                                                        @elseif ($trialType == 7)
                                                    <th colspan="4" valign="top">स्किल टेस्ट
                                                        <br> (पूर्ण० - 30)</th>
                                                    <th valign="top">&nbsp;

                                                        @elseif ($trialType == 8)
                                                    <th colspan="4" valign="top">स्किल टेस्ट
                                                        <br> (पूर्ण० - 30)</th>
                                                    <th valign="top">&nbsp;

                                                        @elseif ($trialType == 9)
                                                    <th colspan="4" valign="top">स्किल टेस्ट
                                                        <br> (पूर्ण० - 30)</th>
                                                    <th valign="top">&nbsp;

                                                        @elseif ($trialType == 10)
                                                        <th colspan="4" valign="top">स्किल टेस्ट
                                                            <br> (पूर्ण० - 30)</th>
                                                        <th valign="top">&nbsp;

                                                            @elseif ($trialType == 11)
                                                        <th colspan="4" valign="top">स्किल टेस्ट
                                                            <br> (पूर्ण० - 30)</th>
                                                        <th valign="top">&nbsp;


                                                        @elseif ($trialType == 12)
                                                        <th colspan="4" valign="top">स्किल टेस्ट
                                                            <br> (पूर्ण० - 30)</th>
                                                        <th valign="top">&nbsp;


                                                    @elseif ($trialType == 13)
                                                    <th colspan="4" valign="top">स्किल टेस्ट
                                                        <br> (पूर्ण० - 30)</th>
                                                    <th valign="top">&nbsp;

                                                        @elseif ($trialType == 14)
                                                        <th colspan="4" valign="top">स्किल टेस्ट
                                                            <br> (पूर्ण० - 30)</th>
                                                        <th valign="top">&nbsp;


                                                            @elseif ($trialType == 15)
                                                            <th colspan="4" valign="top">स्किल टेस्ट
                                                                <br> (पूर्ण० - 30)</th>
                                                            <th valign="top">&nbsp;


                                                        @elseif ($trialType == 16)
                                                        <th colspan="6" valign="top">स्किल टेस्ट
                                                            <br> (पूर्ण० - 30)</th>
                                                        <th valign="top">&nbsp;

                                                            @elseif ($trialType == 17)
                                                            <th colspan="4" valign="top">स्किल टेस्ट
                                                                <br> (पूर्ण० - 30)</th>
                                                            <th valign="top">&nbsp;

                                                                @elseif ($trialType == 19)
                                                        <th colspan="4" valign="top">स्किल टेस्ट
                                                            <br> (पूर्ण० - 30)</th>
                                                        <th valign="top">&nbsp;

                                                            @elseif ($trialType == 20)
                                                            <th colspan="4" valign="top">स्किल टेस्ट
                                                                <br> (पूर्ण० - 30)</th>
                                                            <th valign="top">&nbsp;

                                                                @elseif ($trialType == 21)
                                                                <th colspan="4" valign="top">स्किल टेस्ट
                                                                    <br> (पूर्ण० - 30)</th>
                                                                <th valign="top">&nbsp;


                                                                    @elseif ($trialType == 22)
                                                                    <th colspan="4" valign="top">स्किल टेस्ट
                                                                        <br> (पूर्ण० - 30)</th>
                                                                    <th valign="top">&nbsp;

                                                                        @elseif ($trialType == 23)
                                                                        <th colspan="4" valign="top">स्किल टेस्ट
                                                                            <br> (पूर्ण० - 30)</th>
                                                                        <th valign="top">&nbsp;
                                                                            @elseif ($trialType == 24)
                                                                            <th colspan="8" valign="top">स्किल टेस्ट
                                                                                <br> (पूर्ण० - 50)</th>
                                                                            <th valign="top">&nbsp;

                                                    @endif


                                                    </th>

                                                    @if ($trialType != 24)
                                                    <th rowspan="2" valign="top"><span jsaction="blur:Om5fgd; click:JUJgG; focus:kFg5W; mouseout:Om5fgd; mouseover:kFg5W;XIxNK:LOG0D;w02ePb:RzCLcc" jsname="gm7qse" data-term-type="tl" role="button" tabindex="0" data-sl="hi" data-tl="en">खेल</span><br> टे०
                                                        <br> पूर्ण०
                                                        <br> 20
                                                    </th>
                                                    @endif
                                                    <th rowspan="2" valign="top">प्रा०<br> 50
                                                    </th>
                                                </tr>
                                                <tr>
                                                    <th valign="top">स०</th>
                                                    <th valign="top">अं०</th>
                                                    <th valign="top">स०</th>
                                                    <th valign="top">
                                                        अं०</th>
                                                    <th valign="top">दू०</th>
                                                    <th valign="top" class="border-dark">अं०</th>
                                                    <th valign="top">स०</th>
                                                    <th valign="top">अं०</th>
                                                    <th valign="top">दू०</th>
                                                    <th valign="top">अं०</th>



                                                    {{-- change on basis of subSport and gender --}}





                                                    @if ($trialType == 1)
                                                    <th valign="top"> हिट<br> 7.5
                                                    </th>
                                                    <th valign="top">
                                                        पुश
                                                        <br> 7.5
                                                        <br>
                                                    </th>
                                                    <th valign="top">स्कूप
                                                        <br> 7.5
                                                    </th>

                                                    <th valign="top">
                                                        <p>ड्रिब्लिंग
                                                            <br> 7.5
                                                        </p>
                                                    </th>

                                                    @elseif ($trialType == 2)
                                                    <th valign="top"> किक<br> 6
                                                    </th>
                                                    <th valign="top">
                                                        पैड <br> 6
                                                        <br>
                                                    </th>
                                                    <th valign="top">स्टॉप
                                                        <br> 6
                                                    </th>

                                                    <th valign="top">
                                                        <p>हाई <br> पुश
                                                            <br> 6
                                                        </p>
                                                    </th>
                                                    <th valign="top">
                                                        <p>	हिमात
                                                            <br> 6
                                                        </p>
                                                    </th>



                                                    @elseif ($trialType == 3)
                                                    <th valign="top">हाई <br>सर्विस/
                                                    <br>डबल <br>
                                                        सर्विस <br>/टॉस <br> 7.5
                                                    </th>
                                                    <th valign="top">
                                                        स्मैश

                                                        <br>7.5
                                                        <br>
                                                    </th>
                                                    <th valign="top">ड्राप
                                                        <br> 7.5
                                                    </th>

                                                    <th valign="top">
                                                        <p>बैकहैंड
                                                            <br> 7.5
                                                        </p>
                                                    </th>


                                                    @elseif ($trialType == 4)
                                                    <th valign="top">अंडर<br> हैंड
                                                         <br> 7.5
                                                    </th>
                                                    <th valign="top">
                                                        उप्पेर <br> हैंड

                                                        <br>7.5
                                                        <br>
                                                    </th>
                                                    <th valign="top">सर्विस
                                                        <br> 7.5
                                                    </th>

                                                    <th valign="top">
                                                        <p>स्मैश

                                                            <br> 7.5
                                                        </p>
                                                    </th>


                                                    @elseif ($trialType == 5)
                                                    <th valign="top">ग्रा॰ पो॰  <br>(फेस<br> टू फेस/बैक <br> पो॰)

                                                         <br> 15
                                                    </th>
                                                    <th valign="top">
                                                        स्टै॰ पो॰<br> (फ्रन्ट पो॰/<br>बैक पो॰)

                                                        <br>15
                                                        <br>
                                                    </th>

                                                    @elseif ($trialType == 6)
                                                    <th valign="top">
                                                        फ्री <br>स्टा॰

                                                        <br>5
                                                        <br>
                                                    </th>
                                                    <th valign="top">
                                                        बैक<br>स्ट्रो

                                                        <br>5
                                                        <br>
                                                    </th>
                                                    <th valign="top">
                                                        बे्रस्ट <br>स्ट्रो

                                                        <br>5
                                                        <br>
                                                    </th>
                                                   <th valign="top">
                                                    बटर <br> फ्लाइ
                                                       <br>5
                                                       <br>
                                                   </th>
                                                   <th valign="top">
                                                    ग्लाइडिंग
                                                    <br> 5
                                               </th>

                                               <th valign="top">
                                                स्टार्ट

                                                <br> 5
                                           </th>

                                               @elseif ($trialType == 7)
                                               <th valign="top">
                                                ग्रिप

                                                   <br>7.5
                                                   <br>
                                               </th>
                                               <th valign="top">
                                                डाइव

                                                   <br>7.5
                                                   <br>
                                               </th>
                                               <th valign="top">
                                                पैच

                                                   <br>7.5
                                                   <br>
                                               </th>
                                              <th valign="top">
                                                किक


                                                  <br>7.5
                                                  <br>
                                              </th>

                                              @elseif ($trialType == 8)
                                              <th valign="top">
                                                किक

                                                  <br>7.5
                                                  <br>
                                              </th>
                                              <th valign="top">
                                                ड्रिब/ <br>टेक्ल <br>


                                                  <br>7.5
                                                  <br>
                                              </th>
                                              <th valign="top">
                                                हेड
                                                  <br>7.5
                                                  <br>
                                              </th>
                                             <th valign="top">
                                                कान्ट्रो/  <br>पैड/  <br>


                                                 <br>7.5
                                                 <br>
                                             </th>

                                             @elseif ($trialType == 9)
                                             <th valign="top">
                                                एप्रोच

                                                 <br>7.5
                                                 <br>
                                             </th>
                                             <th valign="top">
                                                टे॰आ॰



                                                 <br>7.5
                                                 <br>
                                             </th>
                                             <th valign="top">
                                                एक्शन


                                                 <br>7.5
                                                 <br>
                                             </th>
                                            <th valign="top">
                                                लैण्डिंग


                                                <br>7.5
                                                <br>
                                            </th>


                                            @elseif ($trialType == 10)
                                            <th valign="top">
                                                ग्रिप/ <br> स्टान्स <br> बैकलिफ्ट


                                                <br>7.5
                                                <br>
                                            </th>
                                            <th valign="top">
                                                बाल <br> सेलेक

                                                <br>7.5
                                                <br>
                                            </th>
                                            <th valign="top">
                                                फ्रन्ट <br> फुट/ <br> बैक <br> फुट

                                                <br>7.5
                                                <br>
                                            </th>
                                           <th valign="top">
                                            फ्रन्ट <br> फुट/ <br> बैक <br> फुट <br> ड्रा0/

                                               <br>7.5
                                               <br>
                                           </th>


                                           @elseif ($trialType == 11)
                                            <th valign="top">
                                                रनअप/<br>एक्शन/<br>फालोथ्रू<br>


                                                <br>7.5
                                                <br>
                                            </th>
                                            <th valign="top">
                                                स्विंग/<br>स्पिन

                                                <br>7.5
                                                <br>
                                            </th>
                                            <th valign="top">
                                                लाइन <br>लेन्थ

                                                <br>7.5
                                                <br>
                                            </th>
                                           <th valign="top">
                                            स्पीड/<br>फ्लाइट

                                               <br>7.5
                                               <br>
                                           </th>


                                           @elseif ($trialType == 12)
                                           <th valign="top">
                                            स्टम्पिंग

                                               <br>7.5
                                               <br>
                                           </th>
                                           <th valign="top">
                                            गैदरिंग
                                               <br>7.5
                                               <br>
                                           </th>
                                           <th valign="top">
                                            आफ <br> स्टम्पिंग <br>गैदरिंग

                                               <br>7.5
                                               <br>
                                           </th>
                                          <th valign="top">
                                            आन <br>स्टम्पिंग <br>गैदरिंग

                                              <br>7.5
                                              <br>
                                          </th>


                                          @elseif ($trialType == 13)
                                          <th valign="top">
                                            रेड

                                              <br>7.5
                                              <br>
                                          </th>
                                          <th valign="top">
                                            किक/ <br>स्किल

                                              <br>7.5
                                              <br>
                                          </th>
                                          <th valign="top">
                                            कवरिंग
                                              <br>7.5
                                              <br>
                                          </th>
                                         <th valign="top">
                                            पकड़

                                             <br>7.5
                                             <br>
                                         </th>

                                         @elseif ($trialType == 14)
                                         <th valign="top">
                                            स्टै॰  <br> वर्क  <br>थ्रो
                                             <br>7.5
                                             <br>
                                         </th>
                                         <th valign="top">
                                            हिप, <br> लेग, <br> हैण्ड  <br> टै॰
                                         <br>7.5
                                             <br>
                                         </th>
                                         <th valign="top">
                                            थ्रो <br> का <br> काउ॰

                                             <br>7.5
                                             <br>
                                         </th>
                                        <th valign="top">
                                            थ्रो 	<br> का 	<br>काप्बी॰

                                            <br>7.5
                                            <br>
                                        </th>

                                        @elseif ($trialType == 15)
                                        <th valign="top">
                                            स्टान्स

                                            <br>7.5
                                            <br>
                                        </th>
                                        <th valign="top">
                                            स्टार्ट

                                            <br>7.5
                                            <br>
                                        </th>
                                        <th valign="top">
                                            एक्शन


                                            <br>7.5
                                            <br>
                                        </th>
                                       <th valign="top">
                                        फिनिश
                                           <br>7.5
                                           <br>
                                       </th>


                                       @elseif ($trialType == 16)
                                       <th valign="top">
                                        फ्लोर

                                           <br>5
                                           <br>
                                       </th>
                                       <th valign="top">
                                        पामे    <br>हार्स

                                           <br>5
                                           <br>
                                       </th>
                                       <th valign="top">
                                        रिंग

                                           <br>5
                                           <br>
                                       </th>
                                      <th valign="top">
                                        वाल्विंग<br> हार्स

                                          <br>5
                                          <br>
                                      </th>
                                      <th valign="top">
                                        पैरे  <br> बार

                                        <br>5
                                        <br>
                                    </th>
                                   <th valign="top">
                                    हारि॰<br> बार

                                       <br>5
                                       <br>
                                   </th>

                                      @elseif ($trialType == 17)
                                      <th valign="top">
                                        बैल॰  <br> बी॰ / <br>

                                          <br>7.5
                                          <br>
                                      </th>
                                      <th valign="top">
                                        अन<br> इवन <br>बार

                                          <br>7.5
                                          <br>
                                      </th>
                                      <th valign="top">
                                        फ्लोर  <br> एक्स॰

                                          <br>7.5
                                          <br>
                                      </th>
                                     <th valign="top">
                                        वाल्विंग <br> हार्स


                                         <br>7.5
                                         <br>
                                     </th>


                                     @elseif ($trialType == 19)
                                     <th valign="top">
                                     थ्रो
                                     स्टान्स

                                         <br>7.5
                                         <br>
                                     </th>
                                     <th valign="top">
                                     एक्शन
                                         <br>7.5
                                         <br>
                                     </th>
                                     <th valign="top">
                                        क्यजीशन

                                         <br>7.5
                                         <br>
                                     </th>
                                    <th valign="top">
                                     फालो थ्रो

                                        <br>7.5
                                        <br>
                                    </th>


                                    @elseif ($trialType == 20)
                                    <th valign="top">
                                        पंचिंग पैड
                                        <br>7.5
                                        <br>
                                    </th>
                                    <th valign="top">
                                        शैडो   बॉक्सिंग
                                        <br>7.5
                                        <br>
                                    </th>
                                    <th valign="top">
                                        स्कीपिंक
                                     <br>
                                      7.5
                                        <br>
                                    </th>
                                   <th valign="top">
                                    स्पैरिंग

                                       <br>7.5
                                       <br>
                                   </th>

                                   @elseif ($trialType == 19)
                                   <th valign="top">
                                   थ्रो
                                   स्टान्स

                                       <br>7.5
                                       <br>
                                   </th>
                                   <th valign="top">
                                   एक्शन

                                       <br>7.5
                                       <br>
                                   </th>
                                   <th valign="top">
                                      क्यजीशन

                                       <br>7.5
                                       <br>
                                   </th>
                                  <th valign="top">
                                   फालो थ्रो

                                      <br>7.5
                                      <br>
                                  </th>


                                  @elseif ($trialType == 21)
                                  <th valign="top">
                                    डिबलिंग
                                      <br>7.5
                                      <br>
                                  </th>
                                  <th valign="top">
                                    पासिंग
                                      <br>7.5
                                      <br>
                                  </th>
                                  <th valign="top">
                                    स्टैण्डिंग
                                    7.5
                                      <br>
                                  </th>
                                 <th valign="top">
                                 जंप शॉट


                                     <br>7.5
                                     <br>
                                 </th>


                                 @elseif ($trialType == 22)
                                 <th valign="top">
                                    काउण्टर
                                     <br>7.5
                                     <br>
                                 </th>
                                 <th valign="top">
                                    पुश

                                     <br>7.5
                                     <br>
                                 </th>
                                 <th valign="top">
                                    ब्लाक
                                  <br>
                                   7.5
                                     <br>
                                 </th>
                                <th valign="top">
                                    सर्विस


                                    <br>7.5
                                    <br>
                                </th>

                                @elseif ($trialType == 23)
                                <th valign="top">
                                    कैच/पास

                                    <br>7.5
                                    <br>
                                </th>
                                <th valign="top">
                                    डिबलिंग

                                    <br>7.5
                                    <br>
                                </th>
                                <th valign="top">
                                    स्टेण्डिंगशाट
                                 <br>
                                  7.5
                                    <br>
                                </th>
                               <th valign="top">
                                जम्पशाट


                                   <br>7.5
                                   <br>
                               </th>



                               @elseif ($trialType == 24)
                               <th valign="top">
                                स्टांस

                                   <br>5
                                   <br>
                               </th>
                               <th valign="top">
                                नाकिंग
                                   <br>5
                                   <br>
                               </th>
                               <th valign="top">
                                एक्सटेंसिंग
                                <br>
                                 5
                                   <br>
                               </th>

                               <th valign="top">
                                ड्राइंग
                                <br>
                                 5
                                   <br>
                               </th>

                               <th valign="top">
                                एंकरिंग
                                <br>
                                 6
                                   <br>
                               </th>

                               <th valign="top">
                                टाइटेन होल्ड


                                  <br>6
                                  <br>
                              </th>

                               <th valign="top">
                                एमिंग
                                <br>
                                 6
                                   <br>
                               </th>

                               <th valign="top">
                                टाइटेन रिलीज
                                <br>
                                 6
                                   <br>
                               </th>

                               <th valign="top">
                                आफ्टर होल्ड
                                <br>
                                 6
                                   <br>
                               </th>







                                                    @endif





                    {{-- End change on basis of subSport and gender --}}


                                                @if ($trialType != 24 && $trialType != 25)
                                                    <th valign="top">
                                                        <p>प्रा०<br> 30
                                                        </p>
                                                    </th>
                                                    @endif
                                                </tr>
                                            </thead>
                                            <tbody>

                    @foreach ($applicants as $key=>$applicant)

                        <tr>

                            @if(isset($applicant->application_no)) <?php $trial = hosteltrialData($applicant->application_no, 4);?>
                            @if(isset($trial))

                            @endif
                            @endif
                            <td valign="bottom">
                            {{$key+1}}
                            </td>
                            <td valign="top">
                                {{$applicant->application_no}}
                            </td>
                            <td valign="top">
                                {{$applicant->fullname}}
                            </td>
                            <td valign="top">

                                {{dmy($applicant->dob)}}
                            </td>
                            <td valign="top">

                                Uttar Pradesh
                            </td>
                            <td valign="top">
                                {{districtName($applicant->district_id)}}</td>
                            <td valign="top">
                                @if($applicant->gender == 1) Male @else Female @endif</td>


                                   <td> @if(isset($trial)){{($trial->hundred_mt_time)}}@endif </td>
                                     <td>@if(isset($trial)){{($trial->hundred_mt_mark)}}@endif</td>
                                     <td >@if(isset($trial)){{($trial->eight_hundred_mt_time)}}@endif</td>

                                     <td>@if(isset($trial)){{($trial->eight_hundred_mt_mark)}}@endif</td>
                                     <td>@if(isset($trial)){{($trial->broad_jump_distance)}}@endif</td>
                                     <td>@if(isset($trial)){{($trial->broad_jump_mark)}}@endif</td>
                                     <td>@if(isset($trial)){{($trial->shuttle_run_time)}}@endif</td>
                                     <td>@if(isset($trial)){{($trial->shuttle_run_mark)}}@endif</td>
                                     <td>@if(isset($trial)){{($trial->ball_throw_distance)}}@endif</td>
                                     <td>@if(isset($trial)){{($trial->ball_throw_mark)}}@endif</td>
                                     <td>@if(isset($trial)){{($trial->physical_total_mark)}}@endif</td>
                                     <td> @if(isset($trial))Checked @endif  </td>

                    {{-- change on basis of subSport and gender --}}

                                      @if ($trialType != 25)
                        @if ($trialType == 1)


                                                @if(isset($applicant->application_no)) <?php $trialhockey = hosteltrialhockeyData($applicant->application_no, 4);?>
                                                @if(isset($trialhockey))

                                                @endif
                                                @endif
                                            <td>

                                             @if(isset($trialhockey)){{$trialhockey->hit_mark}}@endif
                                            </td>
                                            <td>
                                            @if(isset($trialhockey)){{$trialhockey->push_mark}}@endif
                                            </td>
                                            <td>@if(isset($trialhockey)){{$trialhockey->scoop_mark}}@endif
                                            </td>
                                            <td>@if(isset($trialhockey)){{$trialhockey->dribbling_mark}}@endif
                                            </td>

                                            <td>@if(isset($trialhockey)){{$trialhockey->test_score_mark}} @endif
                                            </td>
                                            <td>@if(isset($trialhockey)) {{$trialhockey->game_technique}}  @endif
                                            </td>
                                            <td>@if(isset($trialhockey)){{$trialhockey->sport_test_mark}}  @endif</td>
                                            <td>@if(isset($trialhockey)){{$trialhockey->total_obtain_mark}} @endif </td>
                                            <td>@if(isset($trialhockey)){{$trialhockey->remark}}@endif</td>

                                            <td> @if(isset($trialhockey))Checked @endif  </td>

                        @elseif ($trialType == 2)

                                            @if(isset($applicant->application_no)) <?php $trialhockeykeeper = hosteltrialhockeykeeperData($applicant->application_no, 4);?>
                                            @if(isset($trialhockeykeeper))

                                            @endif
                                            @endif
                                        <td>
                                           @if(isset($trialhockeykeeper)){{$trialhockeykeeper->kick_mark}} @endif
                                        </td>
                                        <td>
                                         @if(isset($trialhockeykeeper)){{$trialhockeykeeper->pad_mark}} @endif
                                        </td>
                                        <td>
                                        @if(isset($trialhockeykeeper)){{$trialhockeykeeper->stop_mark}} @endif
                                        </td>
                                        <td> @if(isset($trialhockeykeeper)){{$trialhockeykeeper->high_push_mark}} @endif
                                        </td>
                                        <td>
                                              @if(isset($trialhockeykeeper)){{$trialhockeykeeper->himmat_mark}} @endif
                                        </td>
                                        <td>
                                        @if(isset($trialhockeykeeper)){{$trialhockeykeeper->test_score_mark}} @endif
                                        </td>
                                        <td>@if(isset($trialhockeykeeper)){{$trialhockeykeeper->game_technique}} @endif
                                        </td>
                                        <td>@if(isset($trialhockeykeeper)){{$trialhockeykeeper->sport_test_mark}} @endif
                                        </td>
                                        <td>
                                        @if(isset($trialhockeykeeper)){{$trialhockeykeeper->total_obtain_mark}} @endif
                                        </td>
                                        <td> @if(isset($trialhockeykeeper)){{$trialhockeykeeper->remark}} @endif</td>

                                        <td> @if(isset($trialhockeykeeper))Checked @endif  </td>


                                        @elseif ($trialType == 3)




                                                    @if(isset($applicant->application_no)) <?php $trialbadminton = hosteltrialBadmintonData($applicant->application_no , 4);?>
                                                    @if(isset($trialbadminton))

                                                    @endif
                                                    @endif
                                                <td> @if(isset($trialbadminton)){{$trialbadminton->high_double_service_mark}}@endif
                                                </td>
                                                <td>@if(isset($trialbadminton)){{$trialbadminton->smash_mark}}@endif
                                                </td>

                                                <td>@if(isset($trialbadminton)){{$trialbadminton->drop_mark}}@endif
                                                </td>
                                                <td>
                                                @if(isset($trialbadminton)){{$trialbadminton->backhand_mark}}@endif
                                                </td>
                                                <td>
                                                  @if(isset($trialbadminton)){{$trialbadminton->test_score_mark}}@endif
                                                </td>
                                                <td> @if(isset($trialbadminton)){{$trialbadminton->game_technique}}@endif
                                                </td>
                                                <td>

                                                 @if(isset($trialbadminton)){{$trialbadminton->sport_test_mark}}@endif
                                                </td>
                                                <td>
                                                 @if(isset($trialbadminton)){{$trialbadminton->total_obtain_mark}}@endif
                                                </td>
                                                <td>@if(isset($trialbadminton)){{$trialbadminton->remark}}@endif  </td>
                                                <td> @if(isset($trialbadminton))Checked @endif  </td>
                                                @elseif ($trialType == 4)

                                                    @if(isset($applicant->application_no)) <?php $trialvolleyball = hosteltrialvolleyballData($applicant->application_no ,4);?>
                                                    @if(isset($trialvolleyball))

                                                    @endif
                                                    @endif
                                                <td>
                                                    @if(isset($trialvolleyball)){{$trialvolleyball->under_hand_mark}} @endif
                                                </td>
                                                <td>
@if(isset($trialvolleyball)){{$trialvolleyball->upper_hand_mark}} @endif
                                                </td>
                                                <td>
                                                   @if(isset($trialvolleyball)){{$trialvolleyball->service_mark}} @endif
                                                </td>
                                                <td>
                                                   @if(isset($trialvolleyball)){{$trialvolleyball->smash_mark}} @endif
                                                </td>
                                                <td>
                                                   @if(isset($trialvolleyball)){{$trialvolleyball->test_score_mark}} @endif
                                                </td>
                                                <td>
                                                @if(isset($trialvolleyball)){{$trialvolleyball->game_technique}} @endif
                                                </td>
                                                <td>@if(isset($trialvolleyball)){{$trialvolleyball->sport_test_mark}} @endif
                                                </td>
                                                <td>@if(isset($trialvolleyball)){{$trialvolleyball->total_obtain_mark}} @endif
                                                </td>
                                                <td>@if(isset($trialvolleyball)){{$trialvolleyball->remark}} @endif  </td>
                                                <td> @if(isset($trialvolleyball))Checked @endif  </td>

                                @elseif ($trialType == 5)




                                    @if(isset($applicant->application_no)) <?php $trialkusti = hosteltrialkustiData($applicant->application_no ,4);?>
                                    @if(isset($trialkusti))

                                    @endif
                                    @endif
                                <td>
                                   @if(isset($trialkusti)){{$trialkusti->ground_position_mark}} @endif
                                </td>
                                <td>@if(isset($trialkusti)){{$trialkusti->front_position_back_position_mark}} @endif
                                </td>

                                <td>@if(isset($trialkusti)){{$trialkusti->test_score_mark}} @endif
                                </td>
                                <td>@if(isset($trialkusti)){{$trialkusti->game_technique}} @endif
                                </td>
                                <td>
                                    @if(isset($trialkusti)){{$trialkusti->sport_test_mark}} @endif
                                </td>
                                <td>
                                @if(isset($trialkusti)){{$trialkusti->total_obtain_mark}} @endif
                                </td>
                                <td>@if(isset($trialkusti)){{$trialkusti->remark}} @endif  </td>

                                <td> @if(isset($trialkusti))Checked @endif  </td>

                                @elseif ($trialType == 6)



                                    @if(isset($applicant->application_no)) <?php $trialswimming = hosteltrialswimmingData($applicant->application_no , 4);?>
                                    @if(isset($trialswimming))

                                    @endif
                                    @endif
                                <td>
                                     @if(isset($trialswimming)) {{$trialswimming->free_stroke_mark}}@endif
                                </td>

                                <td>  @if(isset($trialswimming)) {{$trialswimming->back_stroke_mark}}@endif
                                </td>
                                <td>  @if(isset($trialswimming)) {{$trialswimming->breast_stroke_mark}}@endif
                                    </td>
                                <td>
                                @if(isset($trialswimming)) {{$trialswimming->butter_fly_mark}}@endif
                                </td>
                                <td>@if(isset($trialswimming)) {{$trialswimming->glaiding_mark}}@endif
                                </td>
                                <td>  @if(isset($trialswimming)) {{$trialswimming->start_mark}}@endif
                                </td>
                                <td>
                                  @if(isset($trialswimming)) {{$trialswimming->test_score_mark}}@endif
                                </td>
                                <td>
                                  @if(isset($trialswimming)) {{$trialswimming->game_technique}}@endif
                                </td>
                                <td>  @if(isset($trialswimming)) {{$trialswimming->sport_test_mark}}@endif
                                </td>
                                <td>   @if(isset($trialswimming)) {{$trialswimming->total_obtain_mark}}@endif
                                </td>
                                <td>
                                    @if(isset($trialswimming)) {{$trialswimming->remark}}@endif </td>
                                    <td> @if(isset($trialswimming))Checked @endif  </td>

                                @elseif ($trialType == 7)



                                    @if(isset($applicant->application_no)) <?php $trialfootballkeeper = hosteltrialfootballkeeperData($applicant->application_no, 4);?>
                                    @if(isset($trialfootballkeeper))

                                    @endif
                                    @endif
                                <td>

                                   @if(isset($trialfootballkeeper)) {{$trialfootballkeeper->grip_mark}}@endif
                                </td>
                                <td>
                                @if(isset($trialfootballkeeper)) {{$trialfootballkeeper->dive_mark}}@endif
                                </td>
                                <td>  @if(isset($trialfootballkeeper)) {{$trialfootballkeeper->patch_mark}}@endif
                                </td>
                                <td>
                                @if(isset($trialfootballkeeper)) {{$trialfootballkeeper->kick_mark}}@endif
                                </td>
                                <td>@if(isset($trialfootballkeeper)) {{$trialfootballkeeper->test_score_mark}}@endif
                                </td>
                                <td>@if(isset($trialfootballkeeper)) {{$trialfootballkeeper->game_technique}}@endif
                                </td>
                                <td>@if(isset($trialfootballkeeper)) {{$trialfootballkeeper->sport_test_mark}}@endif
                                </td>
                                <td>@if(isset($trialfootballkeeper)) {{$trialfootballkeeper->total_obtain_mark}}@endif
                                </td>
                                <td> @if(isset($trialfootballkeeper)) {{$trialfootballkeeper->remark}}@endif  </td>

                                <td> @if(isset($trialfootballkeeper))Checked @endif  </td>
                                                                                                                                </td>
                                        @elseif ($trialType == 8)




                                    @if(isset($applicant->application_no)) <?php $trialfootball = hosteltrialfootballData($applicant->application_no ,4);?>
                                    @if(isset($trialfootball))

                                    @endif
                                    @endif
                                <td>

                                  @if(isset($trialfootball)) {{$trialfootball->kick_mark}} @endif
                                </td>
                                <td>
                                   @if(isset($trialfootball)) {{$trialfootball->dribble_tackle_mark}} @endif
                                </td>
                                <td>
                                  @if(isset($trialfootball)) {{$trialfootball->head_mark}} @endif
                                </td>
                                <td>
                                      @if(isset($trialfootball)) {{$trialfootball->control_pad_mark}} @endif
                                </td>
                                <td>
                                    @if(isset($trialfootball)) {{$trialfootball->test_score_mark}} @endif
                                </td>
                                <td>
                                   @if(isset($trialfootball)) {{$trialfootball->game_technique}} @endif
                                </td>
                                <td>
                                @if(isset($trialfootball)) {{$trialfootball->sport_test_mark}} @endif
                                </td>
                                <td>@if(isset($trialfootball)) {{$trialfootball->total_obtain_mark}} @endif
                                </td>
                                <td> @if(isset($trialfootball)) {{$trialfootball->remark}} @endif </td>
                                <td> @if(isset($trialfootball))Checked @endif  </td>

                                        @elseif ($trialType == 9)



                                            @if(isset($applicant->application_no)) <?php $trialathleticsjumper = hosteltrialathleticsjumperData($applicant->application_no , 4);?>
                                            @if(isset($trialathleticsjumper))

                                            @endif
                                            @endif
                                        <td>

                                        @if(isset($trialathleticsjumper)){{$trialathleticsjumper->approach_mark}} @endif
                                        </td>
                                        <td>   @if(isset($trialathleticsjumper)){{$trialathleticsjumper->t_a_mark}} @endif
                                        </td>
                                        <td>
                                        @if(isset($trialathleticsjumper)){{$trialathleticsjumper->action_mark}} @endif
                                        </td>
                                        <td>@if(isset($trialathleticsjumper)){{$trialathleticsjumper->landing_mark}} @endif
                                        </td>
                                        <td>
                                        @if(isset($trialathleticsjumper)){{$trialathleticsjumper->test_score_mark}} @endif
                                        </td>
                                        <td>@if(isset($trialathleticsjumper)){{$trialathleticsjumper->game_technique}} @endif
                                        </td>
                                        <td>@if(isset($trialathleticsjumper)){{$trialathleticsjumper->sport_test_mark}} @endif
                                        </td>
                                        <td>
                                      @if(isset($trialathleticsjumper)){{$trialathleticsjumper->total_obtain_mark}} @endif
                                        </td>
                                        <td>
                                        @if(isset($trialathleticsjumper)){{$trialathleticsjumper->remark}} @endif
                                                                                                                                    </td>

                                                                                                                                    <td> @if(isset($trialathleticsjumper))Checked @endif  </td>

                                    @elseif ($trialType == 10)


                                        @if(isset($applicant->application_no)) <?php $trialcricketbatsman = hosteltrialcricketbatsmanData($applicant->application_no, 4);?>
                                        @if(isset($trialcricketbatsman))

                                        @endif
                                        @endif
                                    <td>
                                        @if(isset($trialcricketbatsman)){{$trialcricketbatsman->grip_stance_backlift_mark}} @endif
                                    </td>
                                    <td>@if(isset($trialcricketbatsman)){{$trialcricketbatsman->ball_select_mark}} @endif
                                    </td>
                                    <td>@if(isset($trialcricketbatsman)){{$trialcricketbatsman->front_foot_back_foot_mark}} @endif
                                    </td>
                                    <td>@if(isset($trialcricketbatsman)){{$trialcricketbatsman->front_foot_back_foot_drive_mark}} @endif
                                    </td>
                                    <td>@if(isset($trialcricketbatsman)){{$trialcricketbatsman->test_score_mark}} @endif
                                    </td>
                                    <td>@if(isset($trialcricketbatsman)){{$trialcricketbatsman->game_technique}} @endif
                                    </td>
                                    <td>@if(isset($trialcricketbatsman)){{$trialcricketbatsman->sport_test_mark}} @endif
                                    </td>
                                    <td>@if(isset($trialcricketbatsman)){{$trialcricketbatsman->total_obtain_mark}} @endif
                                    </td>
                                    <td> @if(isset($trialcricketbatsman)){{$trialcricketbatsman->remark}} @endif
                                                                                                                                </td>
                                    <td> @if(isset($trialcricketbatsman)) checked  @endif
                                    </td>

                                @elseif ($trialType == 11)


                                    @if(isset($applicant->application_no)) <?php $trialcricketballer = hosteltrialcricketballerData($applicant->application_no ,4);?>
                                    @if(isset($trialcricketballer))

                                    @endif
                                    @endif
                                <td>
                                    @if(isset($trialcricketballer)){{$trialcricketballer->runup_action_followthrough_mark}}  @endif
                                </td>
                                <td>@if(isset($trialcricketballer)){{$trialcricketballer->swing_spin_mark}}  @endif
                                </td>
                                <td>@if(isset($trialcricketballer)){{$trialcricketballer->line_length_mark}}  @endif
                                </td>
                                <td>@if(isset($trialcricketballer)){{$trialcricketballer->speed_flight_mark}}  @endif
                                </td>
                                <td>@if(isset($trialcricketballer)){{$trialcricketballer->test_score_mark}}  @endif
                                </td>
                                <td>@if(isset($trialcricketballer)){{$trialcricketballer->game_technique}}  @endif
                                </td>
                                <td>@if(isset($trialcricketballer)){{$trialcricketballer->sport_test_mark}}  @endif
                                </td>
                                <td>@if(isset($trialcricketballer)){{$trialcricketballer->total_obtain_mark}}  @endif
                                </td>
                                <td>@if(isset($trialcricketballer)){{$trialcricketballer->remark}}  @endif
                                                                                                                            </td>
                                <td>@if(isset($trialcricketballer)) checked  @endif
                                </td>

                                @elseif ($trialType == 12)


                                    @if(isset($applicant->application_no)) <?php $trialcricketkeeper = hosteltrialcricketkeeperData($applicant->application_no , 4);?>
                                    @if(isset($trialcricketkeeper))

                                    @endif
                                    @endif
                                <td>

                                   @if(isset($trialcricketkeeper)) {{$trialcricketkeeper->stumping_mark}} @endif
                                </td>
                                <td>@if(isset($trialcricketkeeper)) {{$trialcricketkeeper->gathering_mark}} @endif
                                </td>
                                <td>@if(isset($trialcricketkeeper)) {{$trialcricketkeeper->off_stumping_gathering_mark}} @endif
                                </td>
                                <td>@if(isset($trialcricketkeeper)) {{$trialcricketkeeper->on_stumping_gathering_mark}} @endif
                                </td>
                                <td>@if(isset($trialcricketkeeper)) {{$trialcricketkeeper->test_score_mark}} @endif
                                </td>
                                <td>@if(isset($trialcricketkeeper)) {{$trialcricketkeeper->game_technique}} @endif
                                </td>
                                <td>@if(isset($trialcricketkeeper)) {{$trialcricketkeeper->sport_test_mark}} @endif
                                </td>
                                <td>@if(isset($trialcricketkeeper)) {{$trialcricketkeeper->total_obtain_mark}} @endif
                                </td>
                                <td>@if(isset($trialcricketkeeper)) {{$trialcricketkeeper->remark}} @endif
                                                                                                                            </td>
                                <td>@if(isset($trialcricketkeeper)) checked  @endif
                                </td>


                                @elseif ($trialType == 13)



                                    @if(isset($applicant->application_no)) <?php $trialkabaddi = hosteltrialkabaddiData($applicant->application_no, 4);?>
                                    @if(isset($trialkabaddi))

                                    @endif
                                    @endif
                                <td>
                                  @if(isset($trialkabaddi)) {{$trialkabaddi->raid_mark}} @endif
                                </td>
                                <td>@if(isset($trialkabaddi)) {{$trialkabaddi->kick_skill_mark}} @endif
                                </td>
                                <td>@if(isset($trialkabaddi)) {{$trialkabaddi->covering_mark}} @endif
                                </td>
                                <td>@if(isset($trialkabaddi)) {{$trialkabaddi->pakad_mark}} @endif
                                </td>
                                <td>@if(isset($trialkabaddi)) {{$trialkabaddi->test_score_mark}} @endif
                                </td>
                                <td>@if(isset($trialkabaddi)) {{$trialkabaddi->game_technique}} @endif
                                </td>
                                <td>@if(isset($trialkabaddi)) {{$trialkabaddi->sport_test_mark}} @endif
                                </td>
                                <td>@if(isset($trialkabaddi)) {{$trialkabaddi->total_obtain_mark}} @endif
                                </td>
                                <td>@if(isset($trialkabaddi)) {{$trialkabaddi->remark}} @endif
                                                                                                                            </td>
                                <td>@if(isset($trialkabaddi)) checked  @endif
                                </td>


                            @elseif ($trialType == 14)



                                @if(isset($applicant->application_no)) <?php $trialjudo = hosteltrialjudoData($applicant->application_no, 4);?>
                                @if(isset($trialjudo))

                                @endif
                                @endif
                            <td>

                               @if(isset($trialjudo)) {{$trialjudo->straight_work_throw_mark}} @endif
                            </td>
                            <td>@if(isset($trialjudo)) {{$trialjudo->hip_leg_hand_techniquec_mark}} @endif
                            </td>
                            <td>@if(isset($trialjudo)) {{$trialjudo->throw_count_mark}} @endif
                            </td>
                            <td>@if(isset($trialjudo)) {{$trialjudo->throw_combination_mark}} @endif
                            </td>
                            <td>@if(isset($trialjudo)) {{$trialjudo->test_score_mark}} @endif
                            </td>
                            <td>@if(isset($trialjudo)) {{$trialjudo->game_technique}} @endif
                            </td>
                            <td>@if(isset($trialjudo)) {{$trialjudo->sport_test_mark}} @endif
                            </td>
                            <td>@if(isset($trialjudo)) {{$trialjudo->total_obtain_mark}} @endif
                            </td>
                            <td>@if(isset($trialjudo)) {{$trialjudo->remark}} @endif
                                                                                                                        </td>
                            <td>@if(isset($trialjudo)) checked  @endif
                            </td>




                                        @elseif ($trialType == 15)


                                            @if(isset($applicant->application_no)) <?php $trialathleticsrunner = hosteltrialathleticsrunnerData($applicant->application_no, 4);?>
                                            @if(isset($trialathleticsrunner))

                                            @endif
                                            @endif
                                        <td>

                                          @if(isset($trialathleticsrunner)) {{$trialathleticsrunner->stance_mark}} @endif
                                        </td>
                                        <td>@if(isset($trialathleticsrunner)) {{$trialathleticsrunner->start_mark}} @endif
                                        </td>
                                        <td>@if(isset($trialathleticsrunner)) {{$trialathleticsrunner->action_mark}} @endif
                                        </td>
                                        <td>@if(isset($trialathleticsrunner)) {{$trialathleticsrunner->finish_mark}} @endif
                                        </td>
                                        <td>@if(isset($trialathleticsrunner)) {{$trialathleticsrunner->test_score_mark}} @endif
                                        </td>
                                        <td>@if(isset($trialathleticsrunner)) {{$trialathleticsrunner->game_technique}} @endif
                                        </td>
                                        <td>@if(isset($trialathleticsrunner)) {{$trialathleticsrunner->sport_test_mark}} @endif
                                        </td>
                                        <td>@if(isset($trialathleticsrunner)) {{$trialathleticsrunner->total_obtain_mark}} @endif
                                        </td>
                                        <td> @if(isset($trialathleticsrunner)) {{$trialathleticsrunner->remark}} @endif
                                               </td>
                                        <td> @if(isset($trialathleticsrunner)) checked  @endif
                                        </td>


                                        @elseif ($trialType == 16)



                                            @if(isset($applicant->application_no)) <?php $trialgymnasticboys = hosteltrialgymnasticboysData($applicant->application_no, 4);?>
                                            @if(isset($trialgymnasticboys))

                                            @endif
                                            @endif
                                        <td>
                                           @if(isset($trialgymnasticboys)) {{$trialgymnasticboys->floor_exercise_mark}}  @endif
                                        </td>
                                        <td>@if(isset($trialgymnasticboys)) {{$trialgymnasticboys->pommel_horse_mark}}  @endif
                                        </td>
                                        <td>@if(isset($trialgymnasticboys)) {{$trialgymnasticboys->ring_mark}}  @endif
                                        </td>

                                        <td>@if(isset($trialgymnasticboys)) {{$trialgymnasticboys->vaulving_horse_mark}}  @endif
                                            </td>

                                            <td>@if(isset($trialgymnasticboys)) {{$trialgymnasticboys->parallel_bar_mark}}  @endif
                                            </td>
                                        <td>
                                        @if(isset($trialgymnasticboys)) {{$trialgymnasticboys->horizontal_bar_mark}}  @endif
                                        </td>
                                        <td>@if(isset($trialgymnasticboys)) {{$trialgymnasticboys->test_score_mark}}  @endif
                                        </td>
                                        <td>@if(isset($trialgymnasticboys)) {{$trialgymnasticboys->game_technique}}  @endif
                                        </td>
                                        <td>@if(isset($trialgymnasticboys)) {{$trialgymnasticboys->sport_test_mark}}  @endif
                                        </td>
                                        <td>@if(isset($trialgymnasticboys)) {{$trialgymnasticboys->total_obtain_mark}}  @endif

                                        </td>
                                        <td>@if(isset($trialgymnasticboys)) {{$trialgymnasticboys->remark}}  @endif
                                                                                                                                    </td>
                                        <td>@if(isset($trialgymnasticboys)) checked  @endif
                                        </td>





                                        @elseif ($trialType == 17)



                                            @if(isset($applicant->application_no)) <?php $trialgymnasticgirls = hosteltrialgymnasticgirlsData($applicant->application_no, 4);?>
                                            @if(isset($trialgymnasticgirls))

                                            @endif
                                            @endif
                                        <td>
                                         @if(isset($trialgymnasticgirls)){{$trialgymnasticgirls->balancing_beam_mark}} @endif
                                        </td>
                                        <td>@if(isset($trialgymnasticgirls)){{$trialgymnasticgirls->uneven_bar_mark}} @endif
                                        </td>
                                        <td>@if(isset($trialgymnasticgirls)){{$trialgymnasticgirls->floor_exercise_mark}} @endif
                                        </td>
                                        <td>@if(isset($trialgymnasticgirls)){{$trialgymnasticgirls->vaulving_horse_mark}} @endif
                                        </td>
                                        <td>@if(isset($trialgymnasticgirls)){{$trialgymnasticgirls->test_score_mark}} @endif
                                        </td>
                                        <td>@if(isset($trialgymnasticgirls)){{$trialgymnasticgirls->game_technique}} @endif
                                        </td>
                                        <td>@if(isset($trialgymnasticgirls)){{$trialgymnasticgirls->sport_test_mark}} @endif
                                        </td>
                                        <td>@if(isset($trialgymnasticgirls)){{$trialgymnasticgirls->total_obtain_mark}} @endif

                                        </td>
                                        <td>@if(isset($trialgymnasticgirls)){{$trialgymnasticgirls->remark}} @endif
                                                                                                                                    </td>
                                        <td> @if(isset($trialgymnasticgirls)) checked  @endif
                                        </td>
                                        </form>


                                        @elseif ($trialType == 19)



                                            @if(isset($applicant->application_no)) <?php $trialathleticsthrower = hosteltrialathleticsthrowerData($applicant->application_no, 4);?>
                                            @if(isset($trialathleticsthrower))

                                            @endif
                                            @endif
                                        <td>
                                            @if(isset($trialathleticsthrower)) {{$trialathleticsthrower->stance_mark}}  @endif
                                        </td>
                                        <td>@if(isset($trialathleticsthrower)) {{$trialathleticsthrower->action_mark}}  @endif
                                        </td>
                                        <td>@if(isset($trialathleticsthrower)) {{$trialathleticsthrower->execution_mark}}  @endif
                                        </td>
                                        <td>@if(isset($trialathleticsthrower)) {{$trialathleticsthrower->follow_throw_mark}}  @endif
                                        </td>
                                        <td>@if(isset($trialathleticsthrower)) {{$trialathleticsthrower->test_score_mark}}  @endif
                                        </td>
                                        <td>@if(isset($trialathleticsthrower)) {{$trialathleticsthrower->game_technique}}  @endif
                                        </td>
                                        <td>@if(isset($trialathleticsthrower)) {{$trialathleticsthrower->sport_test_mark}}  @endif
                                        </td>
                                        <td> @if(isset($trialathleticsthrower)) {{$trialathleticsthrower->total_obtain_mark}}  @endif
                                        </td>
                                        <td>
                                         @if(isset($trialathleticsthrower)) {{$trialathleticsthrower->remark}}  @endif
                                                                                                                                    </td>
                                        <td> @if(isset($trialathleticsthrower)) checked  @endif
                                        </td>




                                        @elseif ($trialType == 20)



                                            @if(isset($applicant->application_no)) <?php $trialboxing = hosteltrialboxingData($applicant->application_no, 4);?>
                                            @if(isset($trialboxing))

                                            @endif
                                            @endif
                                        <td>
                                            @if(isset($trialboxing)) {{$trialboxing->punching_pad}}  @endif
                                        </td>
                                        <td>@if(isset($trialboxing)) {{$trialboxing->shadow_boxing}}  @endif
                                        </td>
                                        <td>@if(isset($trialboxing)) {{$trialboxing->skypink}}  @endif
                                        </td>
                                        <td>@if(isset($trialboxing)) {{$trialboxing->sparring}}  @endif
                                        </td>
                                        <td>@if(isset($trialboxing)) {{$trialboxing->test_score_mark}}  @endif
                                        </td>
                                        <td>@if(isset($trialboxing)) {{$trialboxing->game_technique}}  @endif
                                        </td>
                                        <td>@if(isset($trialboxing)) {{$trialboxing->sport_test_mark}}  @endif
                                        </td>
                                        <td>@if(isset($trialboxing)) {{$trialboxing->total_obtain_mark}}  @endif
                                        </td>
                                        <td>@if(isset($trialboxing)) {{$trialboxing->remark}}  @endif
                                                                                                                                    </td>
                                        <td> @if(isset($trialboxing)) checked  @endif
                                        </td>





                                        @elseif ($trialType == 21)



                                            @if(isset($applicant->application_no)) <?php $trialbasketball = hosteltrialbasketballData($applicant->application_no, 4);?>
                                            @if(isset($trialbasketball))

                                            @endif
                                            @endif
                                        <td>
                                            @if(isset($trialbasketball)) {{$trialbasketball->dribbling}}  @endif
                                        </td>
                                        <td>@if(isset($trialbasketball)) {{$trialbasketball->passing}}  @endif
                                        </td>
                                        <td>@if(isset($trialbasketball)) {{$trialbasketball->standing}}  @endif
                                        </td>
                                        <td>@if(isset($trialbasketball)) {{$trialbasketball->jumpshot}}  @endif
                                        </td>
                                        <td>@if(isset($trialbasketball)) {{$trialbasketball->test_score_mark}}  @endif
                                        </td>
                                        <td>@if(isset($trialbasketball)) {{$trialbasketball->game_technique}}  @endif
                                        </td>
                                        <td> @if(isset($trialbasketball)) {{$trialbasketball->sport_test_mark}}  @endif
                                        </td>
                                        <td> @if(isset($trialbasketball)) {{$trialbasketball->total_obtain_mark}}  @endif
                                        </td>
                                        <td>
                                              @if(isset($trialbasketball)) {{$trialbasketball->remark}}  @endif                                                                                         </td>
                                        <td> @if(isset($trialbasketball)) checked  @endif
                                        </td>



                                        @elseif ($trialType == 22)



                                            @if(isset($applicant->application_no)) <?php $trialtabletennis = hosteltrialtabletennisData($applicant->application_no, 4);?>
                                            @if(isset($trialtabletennis))

                                            @endif
                                            @endif
                                        <td>
                                           @if(isset($trialtabletennis)) {{$trialtabletennis->counter}}  @endif
                                        </td>
                                        <td>@if(isset($trialtabletennis)) {{$trialtabletennis->push}}  @endif
                                        </td>
                                        <td>@if(isset($trialtabletennis)) {{$trialtabletennis->block}}  @endif
                                        </td>
                                        <td>@if(isset($trialtabletennis)) {{$trialtabletennis->service}}  @endif
                                        </td>
                                        <td>  @if(isset($trialtabletennis)) {{$trialtabletennis->test_score_mark}}  @endif
                                        </td>
                                        <td>
                                        @if(isset($trialtabletennis)) {{$trialtabletennis->game_technique}}  @endif
                                        </td>
                                        <td>@if(isset($trialtabletennis)) {{$trialtabletennis->sport_test_mark}}  @endif
                                        </td>
                                        <td>@if(isset($trialtabletennis)) {{$trialtabletennis->total_obtain_mark}}  @endif
                                        </td>
                                        <td>@if(isset($trialtabletennis)) {{$trialtabletennis->remark}}  @endif
                                                                                                                                    </td>
                                        <td>@if(isset($trialtabletennis)) checked  @endif
                                        </td>




                                        @elseif ($trialType == 23)



                                            @if(isset($applicant->application_no)) <?php $trialhandball = hosteltrialhandballData($applicant->application_no, 4);?>
                                            @if(isset($trialhandball))

                                            @endif
                                            @endif
                                        <td>

                                           @if(isset($trialhandball)) {{$trialhandball->catch_pass}}  @endif
                                        </td>
                                        <td>@if(isset($trialhandball)) {{$trialhandball->dibbling}}  @endif
                                        </td>
                                        <td>@if(isset($trialhandball)) {{$trialhandball->standing_shot}}  @endif
                                        </td>
                                        <td>@if(isset($trialhandball)) {{$trialhandball->jumpshot}}  @endif
                                        </td>
                                        <td>@if(isset($trialhandball)) {{$trialhandball->test_score_mark}}  @endif
                                        </td>
                                        <td>@if(isset($trialhandball)) {{$trialhandball->game_technique}}  @endif
                                        </td>
                                        <td>@if(isset($trialhandball)) {{$trialhandball->sport_test_mark}}  @endif
                                        </td>
                                        <td>@if(isset($trialhandball)) {{$trialhandball->total_obtain_mark}}  @endif
                                        </td>
                                        <td>
                                             @if(isset($trialhandball)) {{$trialhandball->remark}}  @endif                                                                          </td>
                                        <td>@if(isset($trialhandball)) checked  @endif
                                        </td>


                                        @elseif ($trialType == 24)



                                            @if(isset($applicant->application_no)) <?php $trialarchery = hosteltrialarcheryData($applicant->application_no, 4);?>
                                            @if(isset($trialarchery))

                                            @endif
                                            @endif
                                        <td>
                                               @if(isset($trialarchery)) {{$trialarchery->staines}}  @endif
                                        </td>
                                        <td>@if(isset($trialarchery)) {{$trialarchery->knocking}}  @endif
                                        </td>
                                        <td>@if(isset($trialarchery)) {{$trialarchery->expansion}}  @endif
                                        </td>
                                        <td>@if(isset($trialarchery)) {{$trialarchery->driving}}  @endif
                                        </td>
                                        <td>@if(isset($trialarchery)) {{$trialarchery->anchoring}}  @endif
                                            </td>
                                        <td>@if(isset($trialarchery)) {{$trialarchery->titan_hold}}  @endif
                                            </td>
                                            <td>@if(isset($trialarchery)) {{$trialarchery->aiming}}  @endif
                                                </td>
                                            <td>@if(isset($trialarchery)) {{$trialarchery->titan_release}}  @endif
                                                </td>

                                                <td> @if(isset($trialarchery)) {{$trialarchery->after_hold}}  @endif
                                                    </td>
                                        <td>   @if(isset($trialarchery)) {{$trialarchery->sport_test_mark}}  @endif
                                        </td>
                                        <td>
                                         @if(isset($trialarchery)) {{$trialarchery->total_obtain_mark}}  @endif
                                        </td>
                                        <td> @if(isset($trialarchery)) {{$trialarchery->remark}}  @endif
                                                                                                                                    </td>
                                        <td> @if(isset($trialarchery)) checked  @endif
                                        </td>
                                        </form>


                        @endif

                    @endif
                    {{-- End change on basis of subSport and gender --}}


                        </tr>

                                                @endforeach

                                            </tbody>
                                        </table>




                    </div>










				</div>
			</div>

		</div>

		@endif

	</div>

</div>

@endsection
@push('custom-scripts')
<script type="text/javascript" src="{{ asset('js/xlsx.full.min.js') }}"></script>

<script>
$(document).ready(function() {
    // Step 1: Recalculate physical totals for all rows
    $('.stop').each(function () {
        var id = $(this).data('id');
        if(id) allAdd(id);
    });
    // Step 2: Recalculate skill test totals from existing DB values
    var _seenSkill = {};
    $('input[oninput]').each(function() {
        if ($(this).val() !== '') {
            var h = this.getAttribute('oninput');
            if (h) {
                var m = h.match(/^(\w+skillTotal)\((\d+)\)$/);
                if (m && !_seenSkill[m[2]] && typeof window[m[1]] === 'function') {
                    _seenSkill[m[2]] = true;
                    window[m[1]](parseInt(m[2]));
                }
            }
        }
    });
});







function allAdd(application_no){
    var hund_mt = parseFloat($(`#hund${application_no}`).val()) || 0;
    var eight = parseFloat($(`#eight${application_no}`).val()) || 0;
    var jump = parseFloat($(`#jump${application_no}`).val()) || 0;
    var shuttle = parseFloat($(`#shuttle${application_no}`).val()) || 0;
    var ball = parseFloat($(`#ball${application_no}`).val()) || 0;
    var total = hund_mt + eight + jump + shuttle + ball;
    $(`#phy${application_no}`).val(total);
    if($(`#phy${application_no}`).val()){
        $(`.stop-${application_no}`).attr('readonly', false);
    }
}

function hundred_mt_score(application_no , gender, age){


hundtime = $(`#hundtime${application_no}`).val()
var sportt =  $(`#sport`).val();


allAdd(application_no)
}




function eight_mt_score(application_no , gender, age){

eighttime_new = parseFloat(+$(`#eighttime${application_no}`).val());

if(eighttime_new.toFixed(2).split(".")[1] >= 60){
    eighttime= $(`#eighttime${application_no}`).val(+eighttime_new.toFixed(2).split(".")[0] + 1)
}else{
    eighttime= $(`#eighttime${application_no}`).val()
}


var sportt =  $(`#sport`).val();

allAdd(application_no)
}



function jumpdist_score(application_no , gender, age){
jumpdist = $(`#jumpdist${application_no}`).val()



var sportt =  $(`#sport`).val();

allAdd(application_no)
}



function shuttletime_score(application_no , gender, age){
shuttletime = $(`#shuttletime${application_no}`).val()
var sportt =  $(`#sport`).val();

allAdd(application_no)
}




function balldist_score(application_no , gender, age){


balldist = $(`#balldist${application_no}`).val()
var sportt =  $(`#sport`).val();
allAdd(application_no)


}




   


	function badminData(val){
		if($(`#checkbad${val}`).is(':checked')){

			badskillTotal(val);
			$(`#badmin_${val}`).trigger('submit');

		}


	}

	$(`.badminData`).submit(function (e) {
                e.preventDefault();
              $.ajax({
            type: "POST",
            url: $(this).attr("action"),
            data: new FormData(this),
            //dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: function (res) {
                if (res.error == false) {


					success(res.msg);

					$(`#high_double_service_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#smash_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#drop_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#backhand_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#test_score_mark${res.applicant_id}`).attr('readonly', true);
					$(`#game_technique${res.applicant_id}`).attr('readonly', true);
	                $(`#sport_test_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#total_obtain_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#remark${res.applicant_id}`).attr('readonly', true);

					$(`#checkbad${res.applicant_id}`).attr('disabled', true);


                } else {

                    error(res.msg);
                    $(`#checkbad${res.applicant_id}`).prop("checked", false);

                }
            },
        });
});



function volleyballData(val){
		if($(`#checkvolleyball${val}`).is(':checked')){

			volleyballskillTotal(val);
			$(`#volleyball_${val}`).trigger('submit');

		}


	}

	$(`.volleyballData`).submit(function (e) {
                e.preventDefault();
              $.ajax({
            type: "POST",
            url: $(this).attr("action"),
            data: new FormData(this),
            //dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: function (res) {
                if (res.error == false) {


					success(res.msg);

					$(`#under_hand_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#upper_hand_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#service_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#smash_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#test_score_mark${res.applicant_id}`).attr('readonly', true);
					$(`#game_technique${res.applicant_id}`).attr('readonly', true);
	                $(`#sport_test_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#total_obtain_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#remark${res.applicant_id}`).attr('readonly', true);

					$(`#checkvolleyball${res.applicant_id}`).attr('disabled', true);


                } else {
                    error(res.msg);
                    $(`#checkvolleyball${res.applicant_id}`).prop("checked", false);
                }
            },
        });
});






function basketballData(val){
		if($(`#checkbasketball${val}`).is(':checked')){

			basketballskillTotal(val);
			$(`#basketball_${val}`).trigger('submit');

		}


	}

	$(`.basketballData`).submit(function (e) {
                e.preventDefault();
              $.ajax({
            type: "POST",
            url: $(this).attr("action"),
            data: new FormData(this),
            //dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: function (res) {
                if (res.error == false) {


					success(res.msg);

					$(`#dribbling${res.applicant_id}`).attr('readonly', true);
	                $(`#passing${res.applicant_id}`).attr('readonly', true);
	                $(`#standing${res.applicant_id}`).attr('readonly', true);
	                $(`#jumpshot${res.applicant_id}`).attr('readonly', true);
	                $(`#test_score_mark${res.applicant_id}`).attr('readonly', true);
					$(`#game_technique${res.applicant_id}`).attr('readonly', true);
	                $(`#sport_test_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#total_obtain_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#remark${res.applicant_id}`).attr('readonly', true);

					$(`#checkbasketball${res.applicant_id}`).attr('disabled', true);


                } else {
                    error(res.msg);
                    $(`#checkbasketball${res.applicant_id}`).prop("checked", false);
                }
            },
        });
});


function kustiData(val){
		if($(`#checkkusti${val}`).is(':checked')){

			kustiskillTotal(val);
			$(`#kusti_${val}`).trigger('submit');

		}


	}

	$(`.kustiData`).submit(function (e) {
                e.preventDefault();
              $.ajax({
            type: "POST",
            url: $(this).attr("action"),
            data: new FormData(this),

            contentType: false,
            cache: false,
            processData: false,
            success: function (res) {
                if (res.error == false) {


					success(res.msg);

					$(`#ground_position_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#front_position_back_position_mark${res.applicant_id}`).attr('readonly', true);

	                $(`#test_score_mark${res.applicant_id}`).attr('readonly', true);
					$(`#game_technique${res.applicant_id}`).attr('readonly', true);
	                $(`#sport_test_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#total_obtain_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#remark${res.applicant_id}`).attr('readonly', true);

					$(`#checkkusti${res.applicant_id}`).attr('disabled', true);


                } else {
                    error(res.msg);
                    $(`#checkkusti${res.applicant_id}`).prop("checked", false);
                }
            },
        });
});




function boxingData(val){
		if($(`#checkboxing${val}`).is(':checked')){

			boxingskillTotal(val);
			$(`#boxing_${val}`).trigger('submit');

		}


	}

	$(`.boxingData`).submit(function (e) {
                e.preventDefault();
              $.ajax({
            type: "POST",
            url: $(this).attr("action"),
            data: new FormData(this),

            contentType: false,
            cache: false,
            processData: false,
            success: function (res) {
                if (res.error == false) {


					success(res.msg);

					$(`#punching_pad${res.applicant_id}`).attr('readonly', true);
	                $(`#shadow_boxing${res.applicant_id}`).attr('readonly', true);
                    $(`#skypink${res.applicant_id}`).attr('readonly', true);
	                $(`#sparring${res.applicant_id}`).attr('readonly', true);
	                $(`#test_score_mark${res.applicant_id}`).attr('readonly', true);
					$(`#game_technique${res.applicant_id}`).attr('readonly', true);
	                $(`#sport_test_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#total_obtain_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#remark${res.applicant_id}`).attr('readonly', true);

					$(`#checkboxing${res.applicant_id}`).attr('disabled', true);


                } else {
                    error(res.msg);
                    $(`#checkboxing${res.applicant_id}`).prop("checked", false);
                }
            },
        });
});








function Data(val){
		if($(`#check${val}`).is(':checked')){

			$(`#_${val}`).trigger('submit');

		}


	}

	$(`.Data`).submit(function (e) {
                e.preventDefault();
              $.ajax({
            type: "POST",
            url: $(this).attr("action"),
            data: new FormData(this),
            //dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: function (res) {
                if (res.error == false) {


					success(res.msg);

					$(`#under_hand_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#upper_hand_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#service_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#smash_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#test_score_mark${res.applicant_id}`).attr('readonly', true);
					$(`#game_technique${res.applicant_id}`).attr('readonly', true);
	                $(`#sport_test_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#total_obtain_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#remark${res.applicant_id}`).attr('readonly', true);

					$(`#check${res.applicant_id}`).attr('disabled', true);


                } else {
                    error(res.msg);
                    $(`#check${res.applicant_id}`).prop("checked", false);
                }
            },
        });
});


function judoData(val){
		if($(`#checkjudo${val}`).is(':checked')){

			judoskillTotal(val);
			$(`#judo_${val}`).trigger('submit');

		}


	}

	$(`.judoData`).submit(function (e) {
                e.preventDefault();
              $.ajax({
            type: "POST",
            url: $(this).attr("action"),
            data: new FormData(this),
            //dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: function (res) {
                if (res.error == false) {


					success(res.msg);

					$(`#straight_work_throw_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#hip_leg_hand_techniquec_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#throw_count_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#throw_combination_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#test_score_mark${res.applicant_id}`).attr('readonly', true);
					$(`#game_technique${res.applicant_id}`).attr('readonly', true);
	                $(`#sport_test_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#total_obtain_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#remark${res.applicant_id}`).attr('readonly', true);

					$(`#checkjudo${res.applicant_id}`).attr('disabled', true);


                } else {
                    error(res.msg);
                    $(`#checkjudo${res.applicant_id}`).prop("checked", false);
                }
            },
        });
});



function archeryData(val){
		if($(`#checkarchery${val}`).is(':checked')){

			archeryskillTotal(val);
			$(`#archery_${val}`).trigger('submit');

		}


	}

	$(`.archeryData`).submit(function (e) {
                e.preventDefault();
              $.ajax({
            type: "POST",
            url: $(this).attr("action"),
            data: new FormData(this),
            //dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: function (res) {
                if (res.error == false) {


					success(res.msg);

					$(`#staines${res.applicant_id}`).attr('readonly', true);
	                $(`#knocking${res.applicant_id}`).attr('readonly', true);
	                $(`#expansion${res.applicant_id}`).attr('readonly', true);
	                $(`#driving${res.applicant_id}`).attr('readonly', true);
	                $(`#anchoring${res.applicant_id}`).attr('readonly', true);
					$(`#titan_hold${res.applicant_id}`).attr('readonly', true);
                    $(`#aiming${res.applicant_id}`).attr('readonly', true);
	                $(`#titan_release${res.applicant_id}`).attr('readonly', true);
					$(`#titan_hold${res.applicant_id}`).attr('readonly', true);
	                $(`#sport_test_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#total_obtain_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#remark${res.applicant_id}`).attr('readonly', true);

					$(`#checkarchery${res.applicant_id}`).attr('disabled', true);


                } else {
                    error(res.msg);
                    $(`#checkarchery${res.applicant_id}`).prop("checked", false);
                }
            },
        });
});




function footballkeeperData(val){
		if($(`#checkfootballkeeper${val}`).is(':checked')){

			footballkeeperskillTotal(val);
			$(`#footballkeeper_${val}`).trigger('submit');

		}


	}

	$(`.footballkeeperData`).submit(function (e) {
                e.preventDefault();
              $.ajax({
            type: "POST",
            url: $(this).attr("action"),
            data: new FormData(this),
            //dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: function (res) {
                if (res.error == false) {


					success(res.msg);

					$(`#grip_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#dive_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#patch_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#kick_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#test_score_mark${res.applicant_id}`).attr('readonly', true);
					$(`#game_technique${res.applicant_id}`).attr('readonly', true);
	                $(`#sport_test_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#total_obtain_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#remark${res.applicant_id}`).attr('readonly', true);

					$(`#checkfootballkeeper${res.applicant_id}`).attr('disabled', true);


                } else {
                    error(res.msg);
                    $(`#checkfootballkeeper${res.applicant_id}`).prop("checked", false);
                }
            },
        });
});


function footballData(val){
		if($(`#checkfootball${val}`).is(':checked')){

			footballskillTotal(val);
			$(`#football_${val}`).trigger('submit');

		}


	}

	$(`.footballData`).submit(function (e) {
                e.preventDefault();
              $.ajax({
            type: "POST",
            url: $(this).attr("action"),
            data: new FormData(this),
            //dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: function (res) {
                if (res.error == false) {


					success(res.msg);

					$(`#kick_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#dribble_tackle_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#head_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#control_pad_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#test_score_mark${res.applicant_id}`).attr('readonly', true);
					$(`#game_technique${res.applicant_id}`).attr('readonly', true);
	                $(`#sport_test_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#total_obtain_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#remark${res.applicant_id}`).attr('readonly', true);

					$(`#checkfootball${res.applicant_id}`).attr('disabled', true);


                } else {
                    error(res.msg);
                    $(`#checkfootball${res.applicant_id}`).prop("checked", false);
                }
            },
        });
});



function hockeyData(val){
		if($(`#checkhockey${val}`).is(':checked')){

			hockeyskillTotal(val);
			$(`#hockey_${val}`).trigger('submit');

		}


	}

	$(`.hockeyData`).submit(function (e) {
                e.preventDefault();
              $.ajax({
            type: "POST",
            url: $(this).attr("action"),
            data: new FormData(this),
            //dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: function (res) {
                if (res.error == false) {


					success(res.msg);

					$(`#hit_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#push_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#dribbling_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#scoop_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#test_score_mark${res.applicant_id}`).attr('readonly', true);
					$(`#game_technique${res.applicant_id}`).attr('readonly', true);
	                $(`#sport_test_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#total_obtain_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#remark${res.applicant_id}`).attr('readonly', true);

					$(`#checkhockey${res.applicant_id}`).attr('disabled', true);


                } else {
                    error(res.msg);
                    $(`#checkhockey${res.applicant_id}`).prop("checked", false);
                }
            },
        });
});


function kabaddiData(val){
		if($(`#checkkabaddi${val}`).is(':checked')){

			kabaddiskillTotal(val);
			$(`#kabaddi_${val}`).trigger('submit');

		}


	}

	$(`.kabaddiData`).submit(function (e) {
                e.preventDefault();
              $.ajax({
            type: "POST",
            url: $(this).attr("action"),
            data: new FormData(this),
            //dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: function (res) {
                if (res.error == false) {


					success(res.msg);

					$(`#raid_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#kick_skill_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#covering_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#pakad_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#test_score_mark${res.applicant_id}`).attr('readonly', true);
					$(`#game_technique${res.applicant_id}`).attr('readonly', true);
	                $(`#sport_test_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#total_obtain_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#remark${res.applicant_id}`).attr('readonly', true);

					$(`#checkkabaddi${res.applicant_id}`).attr('disabled', true);


                } else {
                    error(res.msg);
                    $(`#checkkabaddi${res.applicant_id}`).prop("checked", false);
                }
            },
        });
});





function tabletennisData(val){
		if($(`#checktabletennis${val}`).is(':checked')){

			tabletennisskillTotal(val);
			$(`#tabletennis_${val}`).trigger('submit');

		}


	}

	$(`.tabletennisData`).submit(function (e) {
                e.preventDefault();
              $.ajax({
            type: "POST",
            url: $(this).attr("action"),
            data: new FormData(this),
            //dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: function (res) {
                if (res.error == false) {


					success(res.msg);

					$(`#counter${res.applicant_id}`).attr('readonly', true);
	                $(`#push${res.applicant_id}`).attr('readonly', true);
	                $(`#block${res.applicant_id}`).attr('readonly', true);
	                $(`#service${res.applicant_id}`).attr('readonly', true);
	                $(`#test_score_mark${res.applicant_id}`).attr('readonly', true);
					$(`#game_technique${res.applicant_id}`).attr('readonly', true);
	                $(`#sport_test_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#total_obtain_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#remark${res.applicant_id}`).attr('readonly', true);

					$(`#checktabletennis${res.applicant_id}`).attr('disabled', true);


                } else {
                    error(res.msg);
                    $(`#checktabletennis${res.applicant_id}`).prop("checked", false);
                }
            },
        });
});





function hockeykeeperData(val){

		if($(`#checkhockeykeeper${val}`).is(':checked')){

			hockeykeeperskillTotal(val);
			$(`#hockeykeeper_${val}`).trigger('submit');

		}


	}

	$(`.hockeykeeperData`).submit(function (e) {

                e.preventDefault();
              $.ajax({
            type: "POST",
            url: $(this).attr("action"),
            data: new FormData(this),
            //dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: function (res) {
                if (res.error == false) {


					success(res.msg);

					$(`#kick_mark${res.applicant_id}`).attr('readonly', true);
					$(`#pad_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#high_push_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#stop_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#himmat_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#test_score_mark${res.applicant_id}`).attr('readonly', true);
					$(`#game_technique${res.applicant_id}`).attr('readonly', true);
	                $(`#sport_test_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#total_obtain_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#remark${res.applicant_id}`).attr('readonly', true);

					$(`#checkhockeykeeper${res.applicant_id}`).attr('disabled', true);


                } else {
                    error(res.msg);
                    $(`#checkhockeykeeper${res.applicant_id}`).prop("checked", false);
                }
            },
        });
});



function handballData(val){



if($(`#checkhandball${val}`).is(':checked')){

    handballskillTotal(val);
    $(`#handball_${val}`).trigger('submit');

}


}

$(`.handballData`).submit(function (e) {


        e.preventDefault();
      $.ajax({
    type: "POST",
    url: $(this).attr("action"),
    data: new FormData(this),
    //dataType: "json",
    contentType: false,
    cache: false,
    processData: false,
    success: function (res) {
        if (res.error == false) {


            success(res.msg);

            $(`#dibbling${res.applicant_id}`).attr('readonly', true);
            $(`#standing_shot${res.applicant_id}`).attr('readonly', true);
            $(`#jumpshot${res.applicant_id}`).attr('readonly', true);
            $(`#catch_pass${res.applicant_id}`).attr('readonly', true);
            $(`#test_score_mark${res.applicant_id}`).attr('readonly', true);
            $(`#game_technique${res.applicant_id}`).attr('readonly', true);
            $(`#sport_test_mark${res.applicant_id}`).attr('readonly', true);
            $(`#total_obtain_mark${res.applicant_id}`).attr('readonly', true);
            $(`#remark${res.applicant_id}`).attr('readonly', true);

            $(`#checkhandball${res.applicant_id}`).attr('disabled', true);


        } else {


            error(res.msg);
            $(`#checkhandball${res.applicant_id}`).prop("checked", false);
        }
    },
});
});




function swimmingData(val){

	if($(`#checkswimming${val}`).is(':checked')){

		swimmingskillTotal(val);
		$(`#swimming_${val}`).trigger('submit');

	}


}

$(`.swimmingData`).submit(function (e) {

			e.preventDefault();
		  $.ajax({
		type: "POST",
		url: $(this).attr("action"),
		data: new FormData(this),
		//dataType: "json",
		contentType: false,
		cache: false,
		processData: false,
		success: function (res) {
			if (res.error == false) {


				success(res.msg);

				$(`#free_stroke_mark${res.applicant_id}`).attr('readonly', true);
				$(`#back_stroke_mark${res.applicant_id}`).attr('readonly', true);
				$(`#breast_stroke_mark${res.applicant_id}`).attr('readonly', true);
				$(`#butter_fly_mark${res.applicant_id}`).attr('readonly', true);
				$(`#glaiding_mark${res.applicant_id}`).attr('readonly', true);
				$(`#start_mark${res.applicant_id}`).attr('readonly', true);
				$(`#himmat_mark${res.applicant_id}`).attr('readonly', true);
				$(`#test_score_mark${res.applicant_id}`).attr('readonly', true);
				$(`#game_technique${res.applicant_id}`).prop('readonly', true);
				$(`#sport_test_mark${res.applicant_id}`).attr('readonly', true);
				$(`#total_obtain_mark${res.applicant_id}`).attr('readonly', true);
				$(`#remark${res.applicant_id}`).attr('readonly', true);

				$(`#checkswimming${res.applicant_id}`).attr('disabled', true);


			} else {
				error(res.msg);
                $(`#checkswimming${res.applicant_id}`).prop("checked", false);
			}
		},
	});
});



function athleticsrunnerData(val){
		if($(`#checkathleticsrunner${val}`).is(':checked')){

			athleticsrunnerskillTotal(val);
			$(`#athleticsrunner_${val}`).trigger('submit');

		}


	}

	$(`.athleticsrunnerData`).submit(function (e) {
                e.preventDefault();
              $.ajax({
            type: "POST",
            url: $(this).attr("action"),
            data: new FormData(this),
            //dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: function (res) {
                if (res.error == false) {


					success(res.msg);

					$(`#runner_stance_mark${res.applicant_id}`).prop('readonly', true);
	                $(`#runner_start_mark${res.applicant_id}`).prop('readonly', true);
	                $(`#runner_action_mark${res.applicant_id}`).prop('readonly', true);
	                $(`#runner_finish_mark${res.applicant_id}`).prop('readonly', true);
	                $(`#test_score_mark${res.applicant_id}`).prop('readonly', true);
					$(`#game_technique${res.applicant_id}`).prop('readonly', true);
	                $(`#sport_test_mark${res.applicant_id}`).prop('readonly', true);
	                $(`#total_obtain_mark${res.applicant_id}`).prop('readonly', true);
	                $(`#remark${res.applicant_id}`).prop('readonly', true);

					$(`#checkathleticsrunner${res.applicant_id}`).prop('disabled', true);


                } else {
                    error(res.msg);
                    $(`#checkathleticsrunner${res.applicant_id}`).prop("checked", false);
                }
            },
        });
});



function athleticsthrowerData(val){
		if($(`#checkathleticsthrower${val}`).is(':checked')){

			athleticsthrowerskillTotal(val);
			$(`#athleticsthrower_${val}`).trigger('submit');

		}


	}

	$(`.athleticsthrowerData`).submit(function (e) {
                e.preventDefault();
              $.ajax({
            type: "POST",
            url: $(this).attr("action"),
            data: new FormData(this),
            //dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: function (res) {
                if (res.error == false) {


					success(res.msg);

					$(`#stance_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#execution_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#action_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#follow_throw_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#test_score_mark${res.applicant_id}`).attr('readonly', true);
					$(`#game_technique${res.applicant_id}`).attr('readonly', true);
	                $(`#sport_test_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#total_obtain_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#remark${res.applicant_id}`).attr('readonly', true);

					$(`#checkathleticsthrower${res.applicant_id}`).attr('disabled', true);


                } else {
                    error(res.msg);
                    $(`#checkathleticsthrower${res.applicant_id}`).prop("checked", false);
                }
            },
        });
});





function gymnasticgirlsData(val){
		if($(`#checkgymnasticgirls${val}`).is(':checked')){

			gymnasticgirlsskillTotal(val);
			$(`#gymnasticgirls_${val}`).trigger('submit');

		}


	}

	$(`.gymnasticgirlsData`).submit(function (e) {
                e.preventDefault();
              $.ajax({
            type: "POST",
            url: $(this).attr("action"),
            data: new FormData(this),
            //dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: function (res) {
                if (res.error == false) {


					success(res.msg);

					$(`#balancing_beam_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#uneven_bar_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#floor_exercise_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#vaulving_horse_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#test_score_mark${res.applicant_id}`).attr('readonly', true);
					$(`#game_technique${res.applicant_id}`).attr('readonly', true);
	                $(`#sport_test_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#total_obtain_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#remark${res.applicant_id}`).attr('readonly', true);

					$(`#checkgymnasticgirls${res.applicant_id}`).attr('disabled', true);


                } else {
                    error(res.msg);
                    $(`#checkgymnasticgirls${res.applicant_id}`).prop("checked", false);
                }
            },
        });
});



function gymnasticboysData(val){
		if($(`#checkgymnasticboys${val}`).is(':checked')){

			gymnasticboysskillTotal(val);
			$(`#gymnasticboys_${val}`).trigger('submit');

		}


	}

	$(`.gymnasticboysData`).submit(function (e) {
                e.preventDefault();
              $.ajax({
            type: "POST",
            url: $(this).attr("action"),
            data: new FormData(this),
            //dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: function (res) {
                if (res.error == false) {


					success(res.msg);

					$(`#floor_exercise_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#pommel_horse_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#ring_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#vaulving_horse_mark${res.applicant_id}`).attr('readonly', true);
                    $(`#parallel_bar_mark${res.applicant_id}`).attr('readonly', true);
                    $(`#horizontal_bar_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#test_score_mark${res.applicant_id}`).attr('readonly', true);
					$(`#game_technique${res.applicant_id}`).attr('readonly', true);
	                $(`#sport_test_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#total_obtain_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#remark${res.applicant_id}`).attr('readonly', true);

					$(`#checkgymnasticboys${res.applicant_id}`).attr('disabled', true);


                } else {
                    error(res.msg);
                    $(`#checkgymnasticboys${res.applicant_id}`).prop("checked", false);
                }
            },
        });
});


function athleticsjumperData(val){
		if($(`#checkathleticsjumper${val}`).is(':checked')){

			athleticsjumperskillTotal(val);
			$(`#athleticsjumper_${val}`).trigger('submit');

		}


	}

	$(`.athleticsjumperData`).submit(function (e) {
                e.preventDefault();
              $.ajax({
            type: "POST",
            url: $(this).attr("action"),
            data: new FormData(this),
            //dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: function (res) {
                if (res.error == false) {


					success(res.msg);

					$(`#approach_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#t_a_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#action_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#landing_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#test_score_mark${res.applicant_id}`).attr('readonly', true);
					$(`#game_technique${res.applicant_id}`).attr('readonly', true);
	                $(`#sport_test_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#total_obtain_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#remark${res.applicant_id}`).attr('readonly', true);

					$(`#checkathleticsjumper${res.applicant_id}`).attr('disabled', true);


                } else {
                    error(res.msg);
                    $(`#checkathleticsjumper${res.applicant_id}`).prop("checked", false);
                }
            },
        });
});




function cricketbatsmanData(val){
		if($(`#checkcricketbatsman${val}`).is(':checked')){

			cricketbatsmanskillTotal(val);
			$(`#cricketbatsman_${val}`).trigger('submit');

		}


	}

	$(`.cricketbatsmanData`).submit(function (e) {
                e.preventDefault();
              $.ajax({
            type: "POST",
            url: $(this).attr("action"),
            data: new FormData(this),
            //dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: function (res) {
                if (res.error == false) {


					success(res.msg);

					$(`#grip_stance_backlift_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#ball_select_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#front_foot_back_foot_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#front_foot_back_foot_drive_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#test_score_mark${res.applicant_id}`).attr('readonly', true);
					$(`#game_technique${res.applicant_id}`).attr('readonly', true);
	                $(`#sport_test_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#total_obtain_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#remark${res.applicant_id}`).attr('readonly', true);

					$(`#checkcricketbatsman${res.applicant_id}`).attr('disabled', true);


                } else {
                    error(res.msg);
                    $(`#checkcricketbatsman${res.applicant_id}`).prop("checked", false);
                }
            },
        });
});


function cricketkeeperData(val){
		if($(`#checkcricketkeeper${val}`).is(':checked')){

			cricketkeeperskillTotal(val);
			$(`#cricketkeeper_${val}`).trigger('submit');

		}


	}

	$(`.cricketkeeperData`).submit(function (e) {
                e.preventDefault();
              $.ajax({
            type: "POST",
            url: $(this).attr("action"),
            data: new FormData(this),
            //dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: function (res) {
                if (res.error == false) {


					success(res.msg);

					$(`#stumping_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#gathering_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#off_stumping_gathering_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#on_stumping_gathering_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#test_score_mark${res.applicant_id}`).attr('readonly', true);
					$(`#game_technique${res.applicant_id}`).attr('readonly', true);
	                $(`#sport_test_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#total_obtain_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#remark${res.applicant_id}`).attr('readonly', true);

					$(`#checkcricketkeeper${res.applicant_id}`).attr('disabled', true);


                } else {
                    error(res.msg);
                    $(`#checkcricketkeeper${res.applicant_id}`).prop("checked", false);
                }
            },
        });
});





function cricketballerData(val){
		if($(`#checkcricketballer${val}`).is(':checked')){

			cricketballerskillTotal(val);
			$(`#cricketballer_${val}`).trigger('submit');

		}


	}

	$(`.cricketballerData`).submit(function (e) {
                e.preventDefault();
              $.ajax({
            type: "POST",
            url: $(this).attr("action"),
            data: new FormData(this),
            //dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: function (res) {
                if (res.error == false) {


					success(res.msg);

					$(`#runup_action_followthrough_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#swing_spin_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#line_length_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#speed_flight_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#test_score_mark${res.applicant_id}`).attr('readonly', true);
					$(`#game_technique${res.applicant_id}`).attr('readonly', true);
	                $(`#sport_test_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#total_obtain_mark${res.applicant_id}`).attr('readonly', true);
	                $(`#remark${res.applicant_id}`).attr('readonly', true);

					$(`#checkcricketballer${res.applicant_id}`).attr('disabled', true);


                } else {


                    error(res.msg);
                    $(`#checkcricketballer${res.applicant_id}`).prop("checked", false);
                }
            },
        });
});



	function myfunction(val){
		if($(`#check${val}`).is(':checked')){
			var form= '#form_'+val;
		 $(form).trigger('submit');

		};




	}
	$(".applicantData").submit(function (e) {
    e.preventDefault();
    $.ajax({
            type: "POST",
            url: $(this).attr("action"),
            data: new FormData(this),
            //dataType: "json",
            contentType: false,
            cache: false,
            processData: false,
            success: function (res) {
                if (res.error == false) {


					success(res.msg);
					$(`#hund${res.applicant_id}`).attr('readonly', true);
	                $(`#eight${res.applicant_id}`).attr('readonly', true);
	                $(`#jump${res.applicant_id}`).attr('readonly', true);
	                $(`#shuttle${res.applicant_id}`).attr('readonly', true);
	                $(`#ball${res.applicant_id}`).attr('readonly', true);
					$(`#hundtime${res.applicant_id}`).attr('readonly', true);
	                $(`#eighttime${res.applicant_id}`).attr('readonly', true);
	                $(`#jumpdist${res.applicant_id}`).attr('readonly', true);
	                $(`#shuttletime${res.applicant_id}`).attr('readonly', true);
	                $(`#balldist${res.applicant_id}`).attr('readonly', true);
					$(`#check${res.applicant_id}`).attr('disabled', true);
                    $(`.stop-${res.applicant_id}`).attr('readonly', false);

                } else {
                    console.log(res);
                    error(res.msg);
                    $(`#check${res.applicant_id}`).prop("checked", false);
                }
            },
        });
});


function showMe(e) {
  var t = e.value;
  e.value = t.indexOf(".") >= 0 ? t.slice(0, t.indexOf(".") + 2) : t;
}


function PrintDoc() {

var toPrint = document.getElementById('prodiv');

var popupWin = window.open('', '_blank', 'left=100,top=100,width=1100,height=600,tollbar=0,scrollbars=1,status=0,resizable=1');

popupWin.document.open();

popupWin.document.write('<html><title>::Preview::</title><head><style>body{font-family:Arial} .noprint{display: none;} table{width:100%; border-collapse:collapse;} .table tr th, .table tr td{border:1px solid #000; padding:3px 5px; font-size: 12px; text-align: left;} th.table-warning{background-color: #dbdbdb;} .table-warning h3{margin: 0;}</style></head><body onload="window.print()">')

popupWin.document.write(toPrint.innerHTML);

popupWin.document.write('</body></html>');

popupWin.document.close();

}


function ExportToExcell(type, fn, dl) {
    var elt = document.getElementById('dataTablee');
    var wb = XLSX.utils.table_to_book(elt, {
      sheet: "sheet1"
    });
    return dl ?
      XLSX.write(wb, {
        bookType: type,
        bookSST: true,
        type: 'base64'
      }) :
      XLSX.writeFile(wb, fn || ('Trial Report.' + (type || 'xlsx')));
}
  function mainTotal(id) {
    let skillTest = parseFloat($(`#test_score_mark${id}`).val()) || 0;
    let gameTech = parseFloat($(`#game_technique${id}`).val()) || 0;
    let physicalTrial = parseFloat($(`#phy${id}`).val()) || 0;

    let sportTest = skillTest + gameTech;
    $(`#sport_test_mark${id}`).val(sportTest.toFixed(2));

    let totalMarks = physicalTrial + sportTest;
    $(`#total_obtain_mark${id}`).val(totalMarks.toFixed(2));
}

  function hockeyskillTotal(id) {
      let hit = parseFloat($(`#hit_mark${id}`).val()) || 0;
      let push = parseFloat($(`#push_mark${id}`).val()) || 0;
      let scoop = parseFloat($(`#scoop_mark${id}`).val()) || 0;
      let dribbling = parseFloat($(`#dribbling_mark${id}`).val()) || 0;
      $(`#test_score_mark${id}`).val((hit + push + scoop + dribbling).toFixed(2));
      mainTotal(id);
  }

  function hockeykeeperskillTotal(id) {
      let kick = parseFloat($(`#kick_mark${id}`).val()) || 0;
      let pad = parseFloat($(`#pad_mark${id}`).val()) || 0;
      let stop = parseFloat($(`#stop_mark${id}`).val()) || 0;
      let high = parseFloat($(`#high_push_mark${id}`).val()) || 0;
      let himmat = parseFloat($(`#himmat_mark${id}`).val()) || 0;
      $(`#test_score_mark${id}`).val((kick + pad + stop + high + himmat).toFixed(2));
      mainTotal(id);
  }

  function badskillTotal(id) {
      let service = parseFloat($(`#high_double_service_mark${id}`).val()) || 0;
      let smash = parseFloat($(`#smash_mark${id}`).val()) || 0;
      let drop = parseFloat($(`#drop_mark${id}`).val()) || 0;
      let backhand = parseFloat($(`#backhand_mark${id}`).val()) || 0;
      $(`#test_score_mark${id}`).val((service + smash + drop + backhand).toFixed(2));
      mainTotal(id);
  }

  function volleyballskillTotal(id) {
      let under = parseFloat($(`#under_hand_mark${id}`).val()) || 0;
      let upper = parseFloat($(`#upper_hand_mark${id}`).val()) || 0;
      let service = parseFloat($(`#service_mark${id}`).val()) || 0;
      let smash = parseFloat($(`#smash_mark${id}`).val()) || 0;
      $(`#test_score_mark${id}`).val((under + upper + service + smash).toFixed(2));
      mainTotal(id);
  }

  function kustiskillTotal(id) {
      let ground = parseFloat($(`#ground_position_mark${id}`).val()) || 0;
      let front = parseFloat($(`#front_position_back_position_mark${id}`).val()) || 0;
      $(`#test_score_mark${id}`).val((ground + front).toFixed(2));
      mainTotal(id);
  }

  function swimmingskillTotal(id) {
      let free = parseFloat($(`#free_stroke_mark${id}`).val()) || 0;
      let back = parseFloat($(`#back_stroke_mark${id}`).val()) || 0;
      let breast = parseFloat($(`#breast_stroke_mark${id}`).val()) || 0;
      let butter = parseFloat($(`#butter_fly_mark${id}`).val()) || 0;
      let glide = parseFloat($(`#glaiding_mark${id}`).val()) || 0;
      let start = parseFloat($(`#start_mark${id}`).val()) || 0;
      $(`#test_score_mark${id}`).val((free + back + breast + butter + glide + start).toFixed(2));
      mainTotal(id);
  }

  function footballkeeperskillTotal(id) {
      let grip = parseFloat($(`#grip_mark${id}`).val()) || 0;
      let dive = parseFloat($(`#dive_mark${id}`).val()) || 0;
      let patch = parseFloat($(`#patch_mark${id}`).val()) || 0;
      let kick = parseFloat($(`#kick_mark${id}`).val()) || 0;
      $(`#test_score_mark${id}`).val((grip + dive + patch + kick).toFixed(2));
      mainTotal(id);
  }

  function footballskillTotal(id) {
      let kick = parseFloat($(`#kick_mark${id}`).val()) || 0;
      let dribble = parseFloat($(`#dribble_tackle_mark${id}`).val()) || 0;
      let head = parseFloat($(`#head_mark${id}`).val()) || 0;
      let control = parseFloat($(`#control_pad_mark${id}`).val()) || 0;
      $(`#test_score_mark${id}`).val((kick + dribble + head + control).toFixed(2));
      mainTotal(id);
  }

  function athleticsjumperskillTotal(id) {
      let approach = parseFloat($(`#approach_mark${id}`).val()) || 0;
      let ta = parseFloat($(`#t_a_mark${id}`).val()) || 0;
      let action = parseFloat($(`#action_mark${id}`).val()) || 0;
      let landing = parseFloat($(`#landing_mark${id}`).val()) || 0;
      $(`#test_score_mark${id}`).val((approach + ta + action + landing).toFixed(2));
      mainTotal(id);
  }

  function cricketbatsmanskillTotal(id) {
      let grip = parseFloat($(`#grip_stance_backlift_mark${id}`).val()) || 0;
      let ball = parseFloat($(`#ball_select_mark${id}`).val()) || 0;
      let front = parseFloat($(`#front_foot_back_foot_mark${id}`).val()) || 0;
      let drive = parseFloat($(`#front_foot_back_foot_drive_mark${id}`).val()) || 0;
      $(`#test_score_mark${id}`).val((grip + ball + front + drive).toFixed(2));
      mainTotal(id);
  }

  function cricketballerskillTotal(id) {
      let runup = parseFloat($(`#runup_action_followthrough_mark${id}`).val()) || 0;
      let swing = parseFloat($(`#swing_spin_mark${id}`).val()) || 0;
      let line = parseFloat($(`#line_length_mark${id}`).val()) || 0;
      let speed = parseFloat($(`#speed_flight_mark${id}`).val()) || 0;
      $(`#test_score_mark${id}`).val((runup + swing + line + speed).toFixed(2));
      mainTotal(id);
  }

  function cricketkeeperskillTotal(id) {
      let stumping = parseFloat($(`#stumping_mark${id}`).val()) || 0;
      let gathering = parseFloat($(`#gathering_mark${id}`).val()) || 0;
      let off = parseFloat($(`#off_stumping_gathering_mark${id}`).val()) || 0;
      let on = parseFloat($(`#on_stumping_gathering_mark${id}`).val()) || 0;
      $(`#test_score_mark${id}`).val((stumping + gathering + off + on).toFixed(2));
      mainTotal(id);
  }

  function kabaddiskillTotal(id) {
      let raid = parseFloat($(`#raid_mark${id}`).val()) || 0;
      let kick = parseFloat($(`#kick_skill_mark${id}`).val()) || 0;
      let covering = parseFloat($(`#covering_mark${id}`).val()) || 0;
      let pakad = parseFloat($(`#pakad_mark${id}`).val()) || 0;
      $(`#test_score_mark${id}`).val((raid + kick + covering + pakad).toFixed(2));
      mainTotal(id);
  }

  function judoskillTotal(id) {
      let straight = parseFloat($(`#straight_work_throw_mark${id}`).val()) || 0;
      let hip = parseFloat($(`#hip_leg_hand_techniquec_mark${id}`).val()) || 0;
      let throw_count = parseFloat($(`#throw_count_mark${id}`).val()) || 0;
      let combo = parseFloat($(`#throw_combination_mark${id}`).val()) || 0;
      $(`#test_score_mark${id}`).val((straight + hip + throw_count + combo).toFixed(2));
      mainTotal(id);
  }

  function athleticsrunnerskillTotal(id) {
    let stance = parseFloat($(`#runner_stance_mark${id}`).val()) || 0;
    let start = parseFloat($(`#runner_start_mark${id}`).val()) || 0;
    let action = parseFloat($(`#runner_action_mark${id}`).val()) || 0;
    let finish = parseFloat($(`#runner_finish_mark${id}`).val()) || 0;
    let total = stance + start + action + finish;
    $(`#test_score_mark${id}`).val(total.toFixed(2));
    mainTotal(id);
}

  function gymnasticboysskillTotal(id) {
      let floor = parseFloat($(`#floor_exercise_mark${id}`).val()) || 0;
      let pommel = parseFloat($(`#pommel_horse_mark${id}`).val()) || 0;
      let ring = parseFloat($(`#ring_mark${id}`).val()) || 0;
      let vault = parseFloat($(`#vaulving_horse_mark${id}`).val()) || 0;
      let parallel = parseFloat($(`#parallel_bar_mark${id}`).val()) || 0;
      let horizontal = parseFloat($(`#horizontal_bar_mark${id}`).val()) || 0;
      $(`#test_score_mark${id}`).val((floor + pommel + ring + vault + parallel + horizontal).toFixed(2));
      mainTotal(id);
  }

  function gymnasticgirlsskillTotal(id) {
      let balancing = parseFloat($(`#balancing_beam_mark${id}`).val()) || 0;
      let uneven = parseFloat($(`#uneven_bar_mark${id}`).val()) || 0;
      let floor = parseFloat($(`#floor_exercise_mark${id}`).val()) || 0;
      let vault = parseFloat($(`#vaulving_horse_mark${id}`).val()) || 0;
      $(`#test_score_mark${id}`).val((balancing + uneven + floor + vault).toFixed(2));
      mainTotal(id);
  }

  function athleticsthrowerskillTotal(id) {
      let stance = parseFloat($(`#stance_mark${id}`).val()) || 0;
      let action = parseFloat($(`#action_mark${id}`).val()) || 0;
      let execution = parseFloat($(`#execution_mark${id}`).val()) || 0;
      let follow = parseFloat($(`#follow_throw_mark${id}`).val()) || 0;
      $(`#test_score_mark${id}`).val((stance + action + execution + follow).toFixed(2));
      mainTotal(id);
  }

  function boxingskillTotal(id) {
      let punch = parseFloat($(`#punching_pad${id}`).val()) || 0;
      let shadow = parseFloat($(`#shadow_boxing${id}`).val()) || 0;
      let skypink = parseFloat($(`#skypink${id}`).val()) || 0;
      let sparring = parseFloat($(`#sparring${id}`).val()) || 0;
      $(`#test_score_mark${id}`).val((punch + shadow + skypink + sparring).toFixed(2));
      mainTotal(id);
  }

  function basketballskillTotal(id) {
      let dribbling = parseFloat($(`#dribbling${id}`).val()) || 0;
      let passing = parseFloat($(`#passing${id}`).val()) || 0;
      let standing = parseFloat($(`#standing${id}`).val()) || 0;
      let jumpshot = parseFloat($(`#jumpshot${id}`).val()) || 0;
      $(`#test_score_mark${id}`).val((dribbling + passing + standing + jumpshot).toFixed(2));
      mainTotal(id);
  }

  function tabletennisskillTotal(id) {
      let counter = parseFloat($(`#counter${id}`).val()) || 0;
      let push = parseFloat($(`#push${id}`).val()) || 0;
      let block = parseFloat($(`#block${id}`).val()) || 0;
      let service = parseFloat($(`#service${id}`).val()) || 0;
      $(`#test_score_mark${id}`).val((counter + push + block + service).toFixed(2));
      mainTotal(id);
  }

  function handballskillTotal(id) {
      let pass = parseFloat($(`#catch_pass${id}`).val()) || 0;
      let dibbling = parseFloat($(`#dibbling${id}`).val()) || 0;
      let standing = parseFloat($(`#standing_shot${id}`).val()) || 0;
      let jumpshot = parseFloat($(`#jumpshot${id}`).val()) || 0;
      $(`#test_score_mark${id}`).val((pass + dibbling + standing + jumpshot).toFixed(2));
      mainTotal(id);
  }

  function archeryskillTotal(id) {
      let staines = parseFloat($(`#staines${id}`).val()) || 0;
      let knocking = parseFloat($(`#knocking${id}`).val()) || 0;
      let expansion = parseFloat($(`#expansion${id}`).val()) || 0;
      let driving = parseFloat($(`#driving${id}`).val()) || 0;
      let anchoring = parseFloat($(`#anchoring${id}`).val()) || 0;
      let titan_hold = parseFloat($(`#titan_hold${id}`).val()) || 0;
      let aiming = parseFloat($(`#aiming${id}`).val()) || 0;
      let titan_release = parseFloat($(`#titan_release${id}`).val()) || 0;
      let after_hold = parseFloat($(`#after_hold${id}`).val()) || 0;
      let skillTotal = staines + knocking + expansion + driving + anchoring + titan_hold + aiming + titan_release + after_hold;
      $(`#sport_test_mark${id}`).val(skillTotal.toFixed(2));
      let physicalTrial = parseFloat($(`#phy${id}`).val()) || 0;
      $(`#total_obtain_mark${id}`).val((physicalTrial + skillTotal).toFixed(2));
  }
</script>
@endpush
