@extends( 'layouts/admin_layout' )
@section( 'content' )

<style>
	table.dataTable>thead>tr>th:not(.sorting_disabled),
	table.dataTable>thead>tr>td:not(.sorting_disabled) {
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



</style>
<div class="pageheader" id="menu-margin">
	<h4 class="mb-0">Trial List

	<a href="{{ url('collegeadmin/trialList') }}"  class="btn btn-sm  btn-outline-primary ms-2 float-end " ><span class="icons icon-list"></span> Trial List</button>
			  <a href="{{ url('collegeadmin/dashboard') }}" class="btn btn-outline-danger btn-sm backbtn float-end "><span class="icons icon-arrow-left"></span>Back/पीछे</a>

	</h4>
</div>


		<div class="card">

			<div class="card-body">
				<div class="row">
					<div class="mb-3 col-md-2">


						<label>Name of The Sport</label>
						<select class="form-control">
							<option selected="selected" value="10">select</option>
							<option value="20"></option>
							<option value="30"></option>
							<option value="40"></option>
							<option value="50"></option>

						</select>


					</div>
					<div class="mb-3 col-md-2">


						<label>Name of Applicant</label>
						<select class="form-control">
							<option selected="selected" value="10">select</option>
							<option value="20"></option>
							<option value="30"></option>
							<option value="40"></option>
							<option value="50"></option>

						</select>


					</div>


					<div class="mb-3 col-md-2">


						<label>Category</label>
						<select class="form-control">
							<option selected="selected" value="10">select</option>
							<option value="">Girl</option>
							<option value="">Boy</option>
							<option value="">Both</option>

						</select>


					</div>
				</div>
			</div>
		</div>

		<div class="card">

			<div class="card-body input_new">

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
					<table  id="dataTable" class="table datatable text-center table-bordered" style="
    font-size: smaller;
">
						<thead>
							<tr>
								<th rowspan="3" valign="top">क्रस
								</th>
								<th rowspan="3" valign="top">फार्म सं0</th>
								<th valign="top">उम्मीदवार का नाम</th>
								<th valign="top">जन्म तिथि
								</th>
								<th rowspan="3" valign="top">मण्डल
								</th>
								<th colspan="11" valign="top">शारीरिक परीक्षा/<span lang="en"><br>
  </span>
									<br> पूर्णांक - 50</th>
								<th colspan="7" valign="top">खेल परीक्षा/<br>  पूर्णांक - 50/</th>
								<th rowspan="3" valign="top">कुल प्रा०
									<br> पूर्ण० 100<br>
								</th>
								<th rowspan="3" valign="top">अभ्यु०
								</th>
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
								<th rowspan="2" valign="top">कुल प्रा० - 50<br>
								</th>
								<th colspan="4" valign="top">स्किल टेस्ट
									<br> (पूर्ण० - 30)</th>
								<th valign="top">&nbsp;

								</th>
								<th rowspan="2" valign="top"><span jsaction="blur:Om5fgd; click:JUJgG; focus:kFg5W; mouseout:Om5fgd; mouseover:kFg5W;XIxNK:LOG0D;w02ePb:RzCLcc" jsname="gm7qse" data-term-type="tl" role="button" tabindex="0" data-sl="hi" data-tl="en">खेल</span><br> टे०
									<br> पूर्ण०
									<br> 20
								</th>
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
								<th valign="top">ग्रिप/<br> स्टान्स <br> बैक
									<br> लिफ्ट/
								<br> 7.5
								</th>
								<th valign="top">बाल <br> सेले0
									<br> 7.5
								</th>
								<th valign="top">
									फ्रन्ट <br> फुट/
									<br> बैक
									<br> फुट डि०
									<br> 7.5
									<br>
								</th>
								<th valign="top">
									<p>फ्रन्ट<br> फुट/
										<br> बैक
										<br> फुट <br> ड्रा०
										<br> 7.5
									</p>
								</th>
								<th valign="top">
									<p>प्रा०<br> 30
									</p>
								</th>
							</tr>
						</thead>
						<tbody>


							<tr>
								<td valign="bottom">
									1
								</td>
								<td valign="top">
									&nbsp;426
								</td>
								<td valign="top">मोना/Mona
								</td>
								<td valign="top">
									24.10.2011
								</td>
								<td valign="top">
									अयोध्या</td>
								<td>

									<input type="number" style="
    width: 50px;
    font-weight: 400;
    background: none;
    border: 1px solid #cdcdcd;
">
								</td>
								<td><input type="number" style="
    width: 50px;
    font-weight: 400;
    background: none;
    border: 1px solid #cdcdcd;
">
								</td>
								<td><input type="number" style="
    width: 50px;
    font-weight: 400;
    background: none;
    border: 1px solid #cdcdcd;
">
								</td>
								<td><input type="number" style="
    width: 50px;
    font-weight: 400;
    background: none;
    border: 1px solid #cdcdcd;
">
								</td>
								<td><input type="number" style="
    width: 50px;
    font-weight: 400;
    background: none;
    border: 1px solid #cdcdcd;
">
								</td>
								<td><input type="number" style="
    width: 50px;
    font-weight: 400;
    background: none;
    border: 1px solid #cdcdcd;
">
								</td>
								<td><input type="number" style="
    width: 50px;
    font-weight: 400;
    background: none;
    border: 1px solid #cdcdcd;
">
								</td>
								<td><input type="number" style="
    width: 50px;
    font-weight: 400;
    background: none;
    border: 1px solid #cdcdcd;
">
								</td>
								<td><input type="number" style="
    width: 50px;
    font-weight: 400;
    background: none;
    border: 1px solid #cdcdcd;
">
								</td>
								<td><input type="number" style="
    width: 50px;
    font-weight: 400;
    background: none;
    border: 1px solid #cdcdcd;
">
								</td>
								<td><input type="number" style="
    width: 50px;
    font-weight: 400;
    background: none;
    border: 1px solid #cdcdcd;
">
								</td>
								<td><input type="number" style="
    width: 50px;
    font-weight: 400;
    background: none;
    border: 1px solid #cdcdcd;
">
								</td>
								<td><input type="number" style="
    width: 50px;
    font-weight: 400;
    background: none;
    border: 1px solid #cdcdcd;
">
								</td>
								<td><input type="number" style="
    width: 50px;
    font-weight: 400;
    background: none;
    border: 1px solid #cdcdcd;
">
								</td>
								<td><input type="number" style="
    width: 50px;
    font-weight: 400;
    background: none;
    border: 1px solid #cdcdcd;
">
								</td>
								<td><input type="number" style="
    width: 50px;
    font-weight: 400;
    background: none;
    border: 1px solid #cdcdcd;
">
								</td>
								<td><input type="number" style="
    width: 50px;
    font-weight: 400;
    background: none;
    border: 1px solid #cdcdcd;
">
								</td>
								<td><input type="number" style="
    width: 50px;
    font-weight: 400;
    background: none;
    border: 1px solid #cdcdcd;
">
								</td>
								<td><input type="number" style="
    width: 50px;
    font-weight: 400;
    background: none;
    border: 1px solid #cdcdcd;
">
								</td>
								<td valign="top"><input type="number" style="
    width: 50px;
    font-weight: 400;
    background: none;
    border: 1px solid #cdcdcd;
">
								</td>
							</tr>





						</tbody>
					</table>
				</div>
			</div>
		</div>


@endsection
