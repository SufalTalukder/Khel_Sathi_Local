@extends( 'layouts/admin_layout' )
@section( 'content' )
<style>
	.nowraptd {
		white-space: nowrap;
	}

	.dn {
		display: none;
	}
</style>
<style>
	.hide-panel {
		background: #f7f7f7;
		padding: 20px;
		margin-bottom: 20px;
		border: 1px dashed #ccc;
	}
</style>
<div class="row">
	<div class="col-12">
		<div class="pageheader" id="menu-margin">
			<h4 class="mb-0">
				व्ययाधिक्य बचत की सूचना
				<a title="Application Details ExportToExcel" class="btn btn-sm btn-success float-end" data-print="modal" onclick="PrintDoc()">
					<i class="fa fa-print" aria-hidden="true"></i> Print
				</a>
			</h4>
		</div>
	</div>
	<div class="col-12">
		<div class="bhoechie-tab-container">
			<div class="row mb-3">
				<div class="col-lg-12 col-md-12 col-sm-12 col-xs-12 bhoechie-tab" <?php if ($admin_id == 1) { ?> style="display:none" <?php } ?>>
					<div class="bhoechie-tab-content active">
						<div class="form-scroll">
							<form action="{{url('admin/information/financial_create')}}" class="needs-validation" novalidate method="post" autocomplete="off">
								@csrf
								<div class="row">
									<?php if (!empty($district_id_financial)) { ?>
										<div class="col-md-4">
											<div class="form-group">
												<label class="placeholder">प्रकार <span class="text-danger">*</span></label>
												<div class="form-control">
													<div class=" form-check-inline">
														<input class="form-check-input" type="radio" name="identified_the_department" id="department_yes" value="1" required>
														<label class="form-check-label mb-0" for="inlineCheckbox1">जनपद</label>
													</div>
													<div class=" form-check-inline">
														<input class="form-check-input" type="radio" name="identified_the_department" id="department_no" value="2" required>
														<label class="form-check-label mb-0" for="inlineCheckbox2">तहसील</label>
													</div>
												</div>
											</div>
											@error('district_name')
											<div class="text-danger">{{ $message }}</div>
											@enderror
										</div>
										<div class="col-md-4" id="district_name_selected" style="display: none;">
											<div class="form-group mb-3">
												<label class="placeholder">जनपद/संस्था का नाम <span class="text-danger">*</span></label>
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
												<label class="placeholder">तहसील का नाम <span class="text-danger">*</span></label>
												<select name="tehsil_name" id="tehsil_name" class="form-control form-select" required>
													<option selected="" disabled="" value="">तहसील का चयन करें</option>
													@foreach($tehsils as $key=>$tehsil)
													<option {{$tehsil->id == 561 ? 'selected' : ''}} value="{{ $tehsil->id }}" data-badge="">{{$tehsil->Tehsil_Name}}</option>
													@endforeach
												</select>
											</div>
											@error('tehsil_name')
											<div class="text-danger">{{ $message }}</div>
											@enderror
										</div>
									<?php } ?>
									<div class="col-md-4 mb-3">
										<div class="form-group">
											<label for="division_filter">मद का नाम </label>
											<select required class="form-select" onchange="getval(this);" name="item_name" required>
												<option disabled selected value="">--All--</option>
												<option value="1">2013-मंत्रि परिशद 105-मंत्रियों द्वारा विवेकाधीन अनुदान 03-क्रीड़ा मंत्री द्वारा विवेकाधीन अनुदान 42-अन्य व्यय</option>
												<option value="2">2059.लोक निर्माण कार्य 80.सामान्य 053.रखरखाव तथा मरम्मत 03.मेयोहाल इलाहाबाद के अनावासीय भवनों का अनुरक्षण 29-अनुरक्षण</option>
												<option id="pl-2204" value="3">2204-खेलकूद तथा युवा सेवायें 001-निदेषन तथा प्रषासन 03-खेलकूद निदेषालय</option>
												<option id="pl-104" value="4">104-खेलकूद</option>
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4 mb-3" style="display: none;" id="play-2204">
										<h4>राजस्वा लेखा</h4>
										<hr />
										<div class="form-group">
											<select class="form-select" name="revenue_accounting">
												<option disabled selected value="">--All--</option>
												<option value="1">01-वेतन</option>
												<option value="2">03-मंहगाई भत्ता</option>
												<option value="3">04-यात्रा व्यय</option>
												<option value="4">05-स्थानान्तरण यात्रा व्यय</option>
												<option value="5">06-अन्य भत्ते</option>
												<option value="6">07-मानदेय</option>
												<option value="7">08-कार्यालय व्यय</option>
												<option value="8">09-विद्युत देय</option>
												<option value="9">10-जलकर/जल प्रभार</option>
												<option value="10">11-लेखन सामग्री और फार्मो की छपाई</option>
												<option value="11">12-कार्यालय फर्नीचर एवं उपकरण</option>
												<option value="12">13-टेलीफोन पर व्यय</option>
												<option value="13">15-गाड़ियो का अनुरक्षण और पेट्रोल आदि की खरीद</option>
												<option value="14">16-व्यावसायिक तथा विषेश सेवाओं के लिए भुगतान</option>
												<option value="15">17-किराया, उपषुल्क और कर स्वामित्व</option>
												<option value="16">22-आतिथ्य व्यय/व्यय विशयक भत्ता आदि</option>
												<option value="17">26-मषीने और सज्जा/उपकरण और संयंत्र</option>
												<option value="18">42-अन्य व्यय</option>
												<option value="19">44-प्रषिक्षण हेतु यात्रा एवं अन्य प्रासंगिक व्यय</option>
												<option value="20">45-अवकाष यात्रा व्यय</option>
												<option value="21">46-कम्प्यूटर हार्डवेयर/साफ्टवेयर का क्रय</option>
												<option value="22">47-कम्प्यूटर अनुरक्षण/तत्सम्बन्धी स्टेषनरी का क्रय</option>
												<option value="23">49-चिकित्सा व्यय</option>
												<option value="24">51-वर्दी व्यय</option>
												<option value="25">55-मकान किराया भत्ता</option>
												<option value="26">56-नगर प्रतिकर भत्ता</option>
												<option value="27">58-आउट सोर्सिंग सेवाओं हेतु भुगतान</option>
												<option value="28">59-एकमुश्त नियोक्ता अंशदान/ब्याज</option>
											</select>
										</div>
									</div>
									<div class="col-md-4 mb-3" style="display: none;" id="play-104">
										<h4>राजस्वा लेखा</h4>
										<hr />
										<div class="form-group">
											<select class="form-select" onchange="getplay104(this);" name="revenue_accounting">
												<option disabled selected value="">--All--</option>
												<option value="1">03-सरकारी कर्मचारियों तथा उनके परिवारों के कल्याण सम्बन्धी कार्यकलाप 20-सहायता अनुदान-सामान्य (गैर वेतन)</option>
												<option value="2">04-क्रीड़ा छात्रावास के आवासीय खिलाड़ियों पर व्यय (बालिकाओं हेतु) 12-कार्यालय फर्नीचर एवं उपकरण</option>
												<option value="3">42-अन्य व्यय</option>
												<option value="4">05-भूतपूर्व प्रसिद्ध खिलाड़ियों तथा पहलवानों को वित्तीय सहायता 20-सहायता अनुदान-सामान्य (गैर वेतन)</option>
												<option value="5">06-क्रीड़ा छात्रावास के आवासीय खिलाड़ियों पर व्यय (बालको हेतु) 12-कार्यालय फर्नीचर एवं उपकरण</option>
												<option value="6">42-अन्य व्यय</option>
												<option id="pl-07" value="7">07-उत्तर प्रदेश खेल विकास एवं प्रोत्साहन योजना 42-अन्य व्यय</option>
												<option value="8">09-क्रीड़ागनों/स्टेडियमों/बहुउद्देषीय हालों/तरणतालांे/छात्रावासों एवं भवनों का अनुरक्षण 29-अनुरक्षण</option>
												<option value="9">10-विषिश्ट खिलाड़ियों को प्रदेषीय पुरस्कार 20-सहायता अनुदान-सामान्य (गैर वेतन)</option>
												<option value="10">11-क्रीड़ा एवं खेलकूद प्रतियोगिताओं का आयोजन (राज्य से.) 42-अन्य व्यय</option>
												<option value="11">12-खेलकूद उपकरण सामग्री की सम्पूर्ति 43-सामग्री एवं सम्पूर्ति</option>
												<option value="12">16-प्रत्येक क्रीड़ांगन में एक फिजियोथैरेपी केन्द्र की स्थापना 42-अन्य व्यय</option>
												<option value="13">18-प्रषिक्षण (राज्य सेक्टर)- 42-अन्य व्यय</option>
												<option value="14">21-राश्ट्रीय प्रतियोगिताओं में भाग लेने वाली प्रदेषीय टीम के खिलाड़ियों हेतु किट की व्यवस्था 20-सहायता अनुदान-सामान्य (गैर वेतन)</option>
												<option value="15">29-राश्ट्रीय एवं अन्तर्राश्ट्रीय स्तर की खेल प्रतियोगिताओं का आयोजन-20-सहायता अनुदान-सामान्य (गैर वेतन)</option>
												<option value="16">30-पंडित दीन दयाल उपाध्याय जी की जन्म षताब्दी के अवसर पर खेल प्रतियोगिताओं का आयोजन 20-सहायता अनुदान-सामान्य (गैर वेतन)</option>
											</select>
										</div>
									</div>
									<div class="col-md-4 mb-3" style="display: none;" id="play-07">
										<h4 class="mb-3" style="visibility:hidden">राजस्वा लेखा</h4>
										<div class="form-group">
											<select class="form-select" name="uttar_pradesh_sports_development">
												<option disabled selected value="">--All--</option>
												<option value="1">08-मेयोहाल इलाहाबाद में स्थापित क्रीड़ा स्थल</option>
												<option value="2">01-वेतन</option>
												<option value="3">03-मंहगाई भत्ता</option>
												<option value="4">04-यात्रा व्यय</option>
												<option value="5">05-स्थानान्तरण यात्रा व्यय</option>
												<option value="6">06-अन्य भत्ते </option>
												<option value="7">08-कार्यालय व्यय</option>
												<option value="8">09-विद्युत देय</option>
												<option value="9">10-जलकर/जल प्रभार</option>
												<option value="10">11-लेखन सामग्री और फार्मो की छपाई</option>
												<option value="11">12-कार्यालय फर्नीचर एवं उपकरण</option>
												<option value="12">13-टेलीफोन पर व्यय</option>
												<option value="13">43-सामग्री एवं सम्पूर्ति</option>
												<option value="14">44-प्रषिक्षण हेतु यात्रा एवं अन्य प्रासंगिक व्यय</option>
												<option value="15">45-अवकाष यात्रा व्यय</option>
												<option value="16">47-कम्प्यूटर अनुरक्षण/तत्सम्बन्धी स्टेषनरी का क्रय</option>
												<option value="17">49-चिकित्सा व्यय</option>
												<option value="18">51-वर्दी व्यय</option>
												<option value="19">55-मकान किराया भत्ता</option>
												<option value="20">56-नगर प्रतिकर भत्ता</option>
											</select>
										</div>
									</div>
								</div>
								<div class="row">
									<div class="col-md-4 mb-3">
										<div class="form-group">
											<label for="">निदेशालय सत्तर पर आवंटित धन राशि रुपये में</label>
											<input required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/(\.\d{2}).+/g, '$1');" type="text" name="directorate_seventy" class="form-control" aria-describedby="emailHelp">
										</div>
									</div>
									<div class="col-md-4 mb-3">
										<div class="form-group">
											<label for="">व्यय की गयी धन राशि रुपये में </label>
											<input required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/(\.\d{2}).+/g, '$1');" type="text" class="form-control" name="amount_of_money_spent" aria-describedby="emailHelp">
										</div>
									</div>
									<div class="col-md-4 mb-3">
										<div class="form-group">
											<label for="">बचत </label>
											<input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/(\.\d{2}).+/g, '$1');" name="savings" class="form-control" aria-describedby="emailHelp">
										</div>
									</div>
									<div class="col-md-4 mb-3">
										<div class="form-group">
											<label for="">अभ्युक्ति</label>
											<textarea name="allegation" class="form-control" aria-describedby="emailHelp"></textarea>
										</div>
									</div>
								</div>
								<div class="row justify-content-center">
									<div class="col-md-2">
										<button type="submit" class="btn btn-primary w-100">Save</button>
									</div>
								</div>
							</form>
							<div class="table-responsive" id="prodiv">
								<table style="width: 100%;" class="dn">
									<tr>
										<td align="center" style="position: relative; border: 0; padding-bottom: 5px;">
											<div style="border-bottom: 0px solid #000; padding-bottom: 2vw;">

												<div style="font-size: 18px; font-weight: bold;">
													<!-- Department of Sports -->
													खेल साथी पोर्टल
												</div>
												<div style="font-size: 14px; font-weight: bold;">
													उत्तर प्रदेश सरकार
												</div>
												
												<h4 style="text-align: center;">व्ययाधिक्य बचत की सूचना</h4>
											</div>
										</td>
									</tr>
								</table>
								<table class="table table-bordered table-hover bg-white mb-3 datatable">
									<thead>
										<tr>
											<th>क्र.सं.</th>
											<?php if ($admin_id == 9) { ?>
												<th>जनपद/संस्था का नाम</th>
												<th>तहसील का नाम</th>
											<?php } ?>
											<th>
												<p align="center"><strong>मद का नाम </strong></p>
											</th>
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
											<?php //1 District
											if ($item->status == 1) { ?>
												<td>{{!empty(districtName($item->district_id)) ? districtName($item->district_id) : '-' }} </td>
												<td>-</td>
											<?php } ?>
											<?php
											//2 tehsil name
											if ($item->status == 2) { ?>
												<td>{{!empty(districtName($item->district_id)) ? districtName($item->district_id) : '-' }} </td>
												<td>{{!empty(tehsiltName($item->tehsil_id)) ? tehsiltName($item->tehsil_id) : '-' }}</td>
											<?php } ?>
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

													//dd($item->revenue_accounting);
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
												?>
											</td>
											<td>{{isset($item->allegation) ? $item->allegation : '-' }}</td>
											<td>({{date('d-m-Y', strtotime(isset($item->created_on))) ? date('d-m-Y', strtotime( $item->created_on)) : '-' }})</td>
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
@endsection
@push( 'custom-scripts' )
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

	function getval(sel) {
		//alert(sel.value);
		if (sel.value == 3) {
			$("#play-2204").css("display", "block");
			$("#play-104").css("display", "none");
		} else if (sel.value == 4) {
			$("#play-2204").css("display", "none");
			$("#play-104").css("display", "block");
		} else if (sel.value == 1 || sel.value == 2) {
			$("#play-2204").css("display", "none");
			$("#play-104").css("display", "none");
			$("#play-07").css("display", "none");
		}
	}

	function getplay104(sel) {
		if (sel.value == 7) {
			$("#play-07").css("display", "block");
		} else {
			$("#play-07").css("display", "none");
		}

	}

	//    $('input[name="identified_the_department"]').click(function() {
	//        var identified_the_department = $(this).val();
	//        if (identified_the_department == 1) {
	//            $('#district_name_selected').show();
	//            $('#tehsil_name_selected').hide();

	//        } else if (identified_the_department == 2) {
	//            $('#tehsil_name_selected').show();
	//            $('#district_name_selected').hide();

	//        }
	//    });
</script>
@endpush
