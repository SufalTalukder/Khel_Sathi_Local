@extends( 'layouts/admin_layout' )
@section( 'content' )
<style>
    .nowraptd {
        white-space: nowrap;
    }

    .dn {
        display: none;
    }
    .table thead tr th {
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
                बिन्दु-03 - राजस्व प्राप्तियां
                <a title="Print" class="btn btn btn-outline-success float-end" data-print="modal" onclick="PrintDoc()"><i class="icons icon-printer"></i> प्रिंट</a>
            </h4>
        </div>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form <?php if ($admin_id == 1) { ?> style="display:none" <?php } ?> action="{{url('admin/information/create_departmentalrevenue')}}" class="needs-validation" novalidate method="post" autocomplete="off">
                    @csrf
                    <div class="col-12">
                        <fieldset>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="placeholder">महीना <span class="text-danger">*</span></label>
                                        <select name="month_name" id="month_name" class="form-control form-select" required>
                                            <option disabled selected value="">-Select Month-</option>
                                            <option value="1">January</option>
                                            <option value="2">February</option>
                                            <option value="3">March</option>
                                            <option value="4">April</option>
                                            <option value="5">May</option>
                                            <option value="6">June</option>
                                            <option value="7">July</option>
                                            <option value="8">August</option>
                                            <option value="9">September</option>
                                            <option value="10">October</option>
                                            <option value="11">November</option>
                                            <option value="12">December</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="placeholder">वर्ष <span class="text-danger">*</span></label>
                                        <select name="year_name" id="year_name" class="form-control form-select" required>
                                            <option disabled selected value="">-वर्ष चुनें-</option>
                                            <option value="1">2023</option>
                                            <option value="2">2024</option>
                                        </select>
                                    </div>
                                    @error('district_name')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <?php if (!empty($district_id_departmental)) { ?>
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
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="placeholder">खेल का नाम <span class="text-danger">*</span></label>
                                        <select name="name_of_sport" id="name_of_sport" class="form-control form-select">
                                            <option selected="" disabled="" value="">खेल का चयन करें</option>
                                            @foreach($sports as $key=>$sport)
                                            <option value="{{ $sport->id }}" data-badge="">{{$sport->name}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    @error('name_of_sport')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </fieldset>
                        <fieldset>
                            <legend>प्रशिक्षण मद से आय</legend>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="placeholder">प्रशिक्षणार्थियों की संख्या<span class="text-danger">*</span></label>
                                        <input type="text" value="" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/(\.\d{2}).+/g, '$1');" id="number_of_trainees1" name="training_number_of_trainees" class="form-control itemOne">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="placeholder">निर्धारित शुल्क<span class="text-danger">*</span></label>
                                        <input type="text" value="" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/(\.\d{2}).+/g, '$1');" id="fixed_fee1" name="training_fixed_fee" onkeyup="totalFirstIncome()" class="form-control itemTwo">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="placeholder">कुल आय<span class="text-danger">*</span></label>
                                        <input type="text" readonly name="training_total_income" id="total_income1" class="form-control total_income" value="">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="placeholder">विभागीय प्राप्ति रसीद संख्या<span class="text-danger">*</span></label>
                                        <input type="text" id="departmental_receipt_number" name="departmental_receipt_number" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="placeholder">विभागीय प्राप्ति रसीद दिनाँक <span class="text-danger">*</span></label>
                                        <input type="date" id="departmental_receipt_date" name="training_departmental_receipt_date" class="form-control " data-language="en">
                                    </div>
                                </div>
                                <input type="hidden" name="type1[]" value="1" id="type" />
                            </div>
                        </fieldset>                        
                        <fieldset>
                            <legend>आरक्षण मद से आय</legend>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="placeholder">कीडांगन/ग्राउण्ड से किराया<span class="text-danger">*</span></label>
                                        <input type="text" id="departmental_receipt_number1" name="training_departmental_receipt_number" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="placeholder">बहुउद्देशीय हॉल से किराया <span class="text-danger">*</span></label>
                                        <input type="text" value="" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/(\.\d{2}).+/g, '$1');" id="rent_from_multipurpose_hall" name="rent_from_multipurpose_hall" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="placeholder">कमरे बुकिंग से किराया <span class="text-danger">*</span></label>
                                        <input type="text" value="" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/(\.\d{2}).+/g, '$1');" id="rent_from_room_booking" name="rent_from_room_booking" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="placeholder">स्टेडियम बुकिंग से किराया <span class="text-danger">*</span></label>
                                        <input type="text" value="" onkeyup="totalRentIncome()" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/(\.\d{2}).+/g, '$1');" id="rent_from_stadium_booking" name="rent_from_stadium_booking" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="placeholder">कुल आय<span class="text-danger">*</span></label>
                                        <input type="text" readonly oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/(\.\d{2}).+/g, '$1');" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/(\.\d{2}).+/g, '$1');" id="rent_total_income" name="rent_total_income" value="" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="placeholder">विभागीय प्राप्ति रसीद संख्या<span class="text-danger">*</span></label>
                                        <input type="text" id="rent_departmental_receipt_number" name="rent_departmental_receipt_number" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="placeholder">विभागीय प्राप्ति रसीद दिनांक<span class="text-danger">*</span></label>
                                        <input type="date" name="rent_departmental_receipt_date" id="rent_departmental_receipt_date" class="form-control" data-language="en">
                                    </div>
                                </div>
                                <!-- <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="placeholder">खेल के मैदान/मैदान से किराया <span class="text-danger">*</span></label>
                                        <input type="text" value="" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/(\.\d{2}).+/g, '$1');" id="rent_from_playground" name="rent_from_playground" class="form-control">
                                    </div>
                                </div> -->
                            </div>
                        </fieldset>                        
                        <fieldset>
                            <legend>तरणताल मद से आय</legend>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="placeholder">प्रशिक्षणार्थियों की संख्या <span class="text-danger">*</span></label>
                                        <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/(\.\d{2}).+/g, '$1');" id="number_of_trainees2" name="swimming_number_of_trainees" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="placeholder">निर्धारित शुल्क<span class="text-danger">*</span></label>
                                        <input type="text" onkeyup="totalPoolIncome()" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/(\.\d{2}).+/g, '$1');" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/(\.\d{2}).+/g, '$1');" id="fixed_fee2" name="swimming_fixed_fee" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="placeholder">कुल आय<span class="text-danger">*</span></label>
                                        <input type="text" readonly oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/(\.\d{2}).+/g, '$1');" id="total_income2" name="swimming_total_income" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="placeholder">विभागीय प्राप्ति रसीद संख्या <span class="text-danger">*</span></label>
                                        <input type="text" id="departmental_receipt_number2" name="swimming_departmental_receipt_number" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="placeholder">विभागीय प्राप्ति रसीद दिनाँक<span class="text-danger">*</span></label>
                                        <input type="date" id="departmental_receipt_date" name="swimming_departmental_receipt_date" class="form-control" data-language="en">
                                    </div>
                                </div>
                                <input type="hidden" name="type2[]" value="2" id="type" />

                            </div>
                        </fieldset>                        
                        <fieldset>
                            <legend>छात्रावास मद से आय</legend>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="placeholder">छात्रों की संख्या <span class="text-danger">*</span></label>
                                        <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/(\.\d{2}).+/g, '$1');" id="number_of_student3" name="hostel_number_of_student" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="placeholder">निर्धारित शुल्क<span class="text-danger">*</span></label>
                                        <input type="text" onkeyup="totalHostelIncome()" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/(\.\d{2}).+/g, '$1');" id="fixed_fee3" name="hostel_fixed_fee" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="placeholder">कुल आय<span class="text-danger">*</span></label>
                                        <input type="text" readonly oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/(\.\d{2}).+/g, '$1');" id="total_income3" name="hostel_total_income" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="placeholder">विभागीय प्राप्ति रसीद संख्या </label>
                                        <input type="text" id="departmental_receipt_number3" name="hostel_departmental_receipt_number" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="placeholder">विभागीय प्राप्ति रसीद दिनाँक </label>
                                        <input type="date" id="departmental_receipt_date" name="hostel_departmental_receipt_date" class="form-control" data-language="en">
                                    </div>
                                </div>
                                <input type="hidden" name="type3[]" value="3" id="type" />

                            </div>
                        </fieldset>
                        <fieldset>
                            <legend>अन्य प्राप्तियों के मद से आय</legend>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="placeholder">शौकिया खिलाड़ियों की संख्या </label>
                                        <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/(\.\d{2}).+/g, '$1');" id="number_of_amateur_players" name="number_of_amateur_players" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="placeholder">निर्धारित शुल्क/खिलाड़ी </label>
                                        <input type="text" onkeyup="amateurPlayers()" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/(\.\d{2}).+/g, '$1');" id="receipts_fixed_fee" name="receipts_fixed_fee" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="placeholder">कुल आय </label>
                                        <input type="text" readonly oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/(\.\d{2}).+/g, '$1');" id="receipts_total_income" name="receipts_total_income" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="placeholder">विभागीय प्राप्ति रसीद संख्या </label>
                                        <input type="text" id="receipts_number" name="receipts_receipt_number" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="placeholder">विभागीय प्राप्ति रसीद दिनाँक </label>
                                        <input type="date" name="receipts_date" id="receipts_date" class="form-control" data-language="en">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="placeholder">कार/मोटरसाइकिल/साइकिल स्टैंड से आय </label>
                                        <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/(\.\d{2}).+/g, '$1');" name="receipts_income_from_vehicle" id="receipts_income_from_vehicle" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="placeholder">निष्प्रयोज्य सामानो की नीलामी से आय </label>
                                        <input type="text" id="receipts_auction_useless" name="receipts_auction_useless" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="placeholder">फार्मो की बिक्री से आय</label>
                                        <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/(\.\d{2}).+/g, '$1');" id="receipts_income_from_sales" name="receipts_income_from_sales" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="placeholder">विभाग के अन्य आय के स्रोतो से आय </label>
                                        <input type="text" onkeyup="totalReceiptsIncome()" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/(\.\d{2}).+/g, '$1');" id="receipts_income_from_other" name="receipts_income_from_other" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="placeholder">कुल आय </label>
                                        <input type="text" readonly oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/(\.\d{2}).+/g, '$1');" id="receipts_total_income" name="receipts_total_income" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="placeholder">विभागीय प्राप्ति रसीद संख्या </label>
                                        <input type="text" id="receipts_number" name="receipts_receipt_number" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="placeholder">विभागीय प्राप्ति रसीद दिनाँक </label>
                                        <input type="date" name="receipts_date" id="receipts_date" class="form-control" data-language="en">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="placeholder">माह में प्राप्त कुल राजस्व प्राप्तियां </label>
                                        <input type="text" readonly oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/(\.\d{2}).+/g, '$1');" name="receipts_total_revenue" id="total_revenue" class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="placeholder">गत माह की राजस्व प्राप्तियां</label>
                                        <input type="text" readonly class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="placeholder">प्रगामी राजस्व प्राप्तियां</label>
                                        <input type="text" readonly class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="placeholder">गत वित्तीय वर्ष में इसी माह तक राजस्व प्राप्तियां</label>
                                        <input type="text" readonly class="form-control">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group mb-3">
                                        <label class="placeholder">राजस्व प्राप्तियां में प्रतिशत वृद्धि अथवा कमी</label>
                                        <input type="text" readonly class="form-control">
                                    </div>
                                </div>
                            </div>
                            <div class="bhoechie-footer">
                                <div class="row justify-content-center">
                                    <input type="hidden" name="division_id" id="division_id" value="{{!empty($division_id) ? $division_id : 'null' }}">
                                    <!-- <div class="col-md-2 d-grid">
                                                            <button type="reset" class="btn btn-outline-info rounded-pill">Back</button>
                                                        </div> -->
                                    <div class="col-md-2 d-grid">
                                        <button id="reset" type="reset" class="btn btn-outline-danger rounded-pill">रीसेट</button>
                                    </div>
                                    <div class="col-md-2 d-grid">
                                        <button type="submit" class="btn btn-outline-info rounded-pill">सुनिश्चित करे</button>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </form>
            </div>
            <div class="col-md-12">
                <div class="table-responsive" id="prodiv">
                    <table style="width: 100%;" class="dn">
                        <tr>
                            <td align="center" style="position: relative; border: 0; padding-bottom: 5px;">
                                <div style="border-bottom: 0px solid #000; padding-bottom: 2vw;">
                                    <!-- <img src="{{ url('onlineAdmission') }}/images/logo.png" style="position: absolute; width: 70px; top: 5px; left: 0;"/> -->
                                    <!-- <img src="images/logo.png" style="position: absolute; width: 70px; top: 5px; left: 0;"/> -->
                                    <div style="font-size: 18px; font-weight: bold;">
                                        खेल साथी पोर्टल
                                    </div>
                                    <div style="font-size: 14px; font-weight: bold;">
                                        उत्तर प्रदेश सरकार
                                    </div>
                                    <div style="font-size: 18px; font-weight: bold;">
                                        विभागीय राजस्व प्रपत्र
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                    <table class="table table-bordered table-hover bg-white mb-3 nowraptbl">
                        <thead>
                            <tr>
                                <th colspan="31" class="text-center"><strong>कार्यालय का नाम</strong></th>
                                <th rowspan="4" class="text-center">माह में प्राप्त<br>कुल राजस्व प्राप्तियां<br>(कालम<br>6+12+16+20+24+30<br>का महायोग)</th>
                            </tr>
                            <tr>
                                <th colspan="12" class="text-center"><strong>विभागीय राजस्व प्राप्तियों का विवरण</strong></th>
                                <th colspan="7" class="text-center"><strong>माह </strong> - </th>
                                <th colspan="5" class="text-center"><strong>वर्ष</strong> - </th>
                                <th colspan="7" class="text-center"><strong>(धनराशि रू. में)</strong> -</th>
                            </tr>
                            <tr>
                                <th colspan="3" class="text-center">विवरण</th>
                                <th colspan="4" class="text-center">प्रशिक्षण मद से आय</th>
                                <th colspan="6" class="text-center">आरक्षण मद से आय</th>
                                <th colspan="4" class="text-center">तरणताल मद से आय</th>
                                <th colspan="4" class="text-center">छात्रावास मद से आय</th>
                                <th colspan="10" class="text-center">अन्य प्राप्तियों के मद से आय</th>                                
                            </tr>
                            <tr>
                                <!-- <th>क्र.सं.</th> -->
                                <?php if ($admin_id == 10) { ?>
                                    <th colspan="2">विभाग का नाम</th>
                                <?php } ?>
                                <?php if ($admin_id == 9) { ?>
                                    <th>जनपद/संस्था का नाम</th>
                                    <th>तहसील का नाम</th>
                                <?php } ?>
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
                                <!-- <th>खेल के मैदान/मैदान से किराया</th> -->

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
                                <th>1</th>
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
                                <!-- <td class="text-center">{{ $key+1 }}</td> -->
                                <?php if ($item->status == 0) { ?>
                                    <th colspan="2" class="text-center">{{!empty(divisionName($item->division_id)) ? divisionName($item->division_id) : '-' }}</th>
                                <?php } ?>
                                <?php //1 District
                                if ($item->status == 1) { ?>
                                    <td>{{!empty(districtName($item->district_id)) ? districtName($item->district_id) : '-' }} </td>
                                    <td>-</td>
                                <?php } ?>
                                <?php //2 tehsil name
                                if ($item->status == 2) { ?>
                                    <td>{{!empty(districtName($item->district_id)) ? districtName($item->district_id) : '-' }} </td>
                                    <td>{{!empty(tehsiltName($item->tehsil_id)) ? tehsiltName($item->tehsil_id) : '-' }}</td>
                                <?php } ?>
                                <td class="text-center">{{sport_name($item->name_of_sport)}}</td>
                                <!-- प्रशिक्षण से आय -->
                                <td class="text-center">{{isset($item->training_number_of_trainees) ? $item->training_number_of_trainees : '-' }}</td>
                                <td class="text-center">{{isset($item->training_fixed_fee) ? $item->training_fixed_fee : '-' }}</td>
                                <td class="text-center">{{isset($item->training_total_income) ? $item->training_total_income : '-' }}</td>
                                <td class="text-center">{{isset($item->training_departmental_receipt_number) ? $item->training_departmental_receipt_number : '-' }}<br>({{date('d-m-Y', strtotime($item->training_departmental_receipt_date)) ? date('d-m-Y', strtotime($item->training_departmental_receipt_date)) : '-' }})</td>
                                <!-- आरक्षण से आय -->
                                <td>----</td>
                                <td class="text-center">{{isset($item->rent_from_multipurpose_hall) ? $item->rent_from_multipurpose_hall : '-' }}</td>                                
                                <td class="text-center">{{isset($item->rent_from_room_booking) ? $item->rent_from_room_booking : '-' }}</td>
                                <td class="text-center">{{isset($item->rent_from_stadium_booking) ? $item->rent_from_stadium_booking : '-' }}</td>
                                <td class="text-center">{{isset($item->rent_total_income) ? $item->rent_total_income : '-' }}</td>
                                <td class="text-center">{{isset($item->rent_departmental_receipt_number) ? $item->rent_departmental_receipt_number : '-' }}
                                    <br>{{isset($item->rent_departmental_receipt_date) ? $item->rent_departmental_receipt_date : '-' }}
                                </td>
                                <!-- <td class="text-center">{{isset($item->rent_from_playground) ? $item->rent_from_playground : '-' }}</td> -->
                                
                                <!-- तरणताल मद से आय -->
                                <th class="text-center">{{isset($item->swimming_number_of_trainees) ? $item->swimming_number_of_trainees : '-'}}</th>
                                <td class="text-center">{{isset($item->swimming_fixed_fee) ? $item->swimming_fixed_fee : '-'}}</td>
                                <td class="text-center">{{isset($item->swimming_total_income) ? $item->swimming_total_income : '-'}}</td>
                                <td class="text-center">{{isset($item->swimming_departmental_receipt_number) ? $item->swimming_departmental_receipt_number : '-'}}
                                    <br>({{date('d-m-Y', strtotime(isset($item->swimming_departmental_receipt_date))) ? date('d-m-Y', strtotime( $item->swimming_departmental_receipt_date)) : '-' }})
                                </td>

                                 <!-- छात्रावास से आय-->
                                <td class="text-center">{{isset($item->hostel_number_of_student) ? $item->hostel_number_of_student : '-'}}</td>
                                <td class="text-center">{{isset($item->hostel_fixed_fee) ? $item->hostel_fixed_fee : '-'}}</td>
                                <td class="text-center">{{isset($item->hostel_total_income) ? $item->hostel_total_income : '-'}}</td>
                                <td class="text-center">{{isset($item->hostel_departmental_receipt_number) ? $item->hostel_departmental_receipt_number : '-'}}
                                    <br>({{date('d-m-Y', strtotime(isset($item->hostel_departmental_receipt_date))) ? date('d-m-Y', strtotime( $item->hostel_departmental_receipt_date)) : '-' }})
                                </td>

                                <!-- अन्य प्राप्तियों के मद से आय -->
                                <td class="text-center">{{isset($item->number_of_amateur_players) ? $item->number_of_amateur_players : '-' }}</td>
                                <td class="text-center">{{isset($item->receipts_fixed_fee) ? $item->receipts_fixed_fee : '-' }}</td>
                                <td class="text-center">{{isset($item->receipts_total_income) ? $item->receipts_total_income : '-' }}</td>
                                <td class="text-center">{{isset($item->receipts_receipt_number) ? $item->receipts_receipt_number : '-' }}
                                    <br>({{date('d-m-Y', strtotime(isset($item->receipts_date))) ? date('d-m-Y', strtotime( $item->receipts_date)) : '-' }})
                                </td>
                                <td class="text-center">{{isset($item->receipts_income_from_vehicle) ? $item->receipts_income_from_vehicle : '-' }}</td>
                                <td class="text-center">{{isset($item->receipts_auction_useless) ? $item->receipts_income_from_vehicle : '-' }}</td>
                                <td class="text-center">{{isset($item->receipts_income_from_sales) ? $item->receipts_income_from_sales : '-' }}</td>
                                <td class="text-center">{{isset($item->receipts_income_from_other) ? $item->receipts_income_from_other : '-' }}</td>
                                <td class="text-center">{{isset($item->receipts_total_revenue) ? $item->receipts_total_revenue : '-' }}</td>
                                <td class="text-center">{{isset($item->receipts_receipt_number) ? $item->receipts_receipt_number : '-' }}
                                    <br>({{date('d-m-Y', strtotime(isset($item->receipts_date))) ? date('d-m-Y', strtotime( $item->receipts_date)) : '-' }})
                                </td>
                            </tr>
                            @endforeach
                            <!-- <tr>
                                <td colspan="32"><strong>योग</strong></td>
                                <td></td>
                            </tr> -->
                            <tr>
                                <td colspan="31"><strong>माह में प्राप्त कुल राजस्व प्राप्तियां</strong></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="31"><strong>गत माह की राजस्व प्राप्तियां</strong></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="31"><strong>प्रगामी राजस्व प्राप्तियां</strong></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="31"><strong>गत वित्तीय वर्ष में इसी माह तक राजस्व प्राप्तियां</strong></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="31"><strong>राजस्व प्राप्तियां में प्रतिशत वृद्धि अथवा कमी</strong></td>
                                <td></td>
                            </tr>
                            <tr>
                                <td colspan="32"><strong><input type="checkbox"> &nbsp; प्रमाणित किया जाता है उपरोक्त सभी सूचनाएं मेरी जानकारी में सही हैं तथा प्राप्त राजस्व प्राप्तियों को विभागीय लेखाशीर्षक में जमा करा दिया गया है, गलत सूचना पाये जाने पर वसूली हेतु उत्तरदायी रहेंगे।</strong></td>
                            </tr>
                        </tbody>
                    </table>
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
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#reset').click(function() {
            $('#district_name_selected').hide();

        });
    });
</script>
<script>
    $(document).ready(function() {
        $('.amountless').keyup(function() {
            var amountless = (parseFloat($(this).val()) || 0);
            var finalamount = (parseFloat($("#total_balance").val()) || 0);
            var Tottim = (finalamount - amountless)
            $('#total_balance_deposited_current_month').val(Tottim.toFixed(2));
            //$('#total').text( value.toFixed(2) );
        });
    });
</script>
<script>
    function totalFirstIncome() {
        var x = parseInt(document.getElementById("fixed_fee1").value);
        var y = parseInt(document.getElementById("number_of_trainees1").value)
        document.getElementById("total_income1").value = x * y;
    }


    function totalRentIncome() {
        var rent1 = (parseFloat($("#rent_from_playground").val()) || 0);
        var rent2 = (parseFloat($("#rent_from_multipurpose_hall").val()) || 0);
        var rent3 = (parseFloat($("#rent_from_room_booking").val()) || 0);
        var rent4 = (parseFloat($("#rent_from_stadium_booking").val()) || 0);
        var v = (rent1 + rent2 + rent3 + rent4);
        console.log("v" + v);
        $('#rent_total_income').val(v.toFixed(2));

    }

    function totalPoolIncome() {
        var xx = parseInt(document.getElementById("number_of_trainees2").value);
        var yy = parseInt(document.getElementById("fixed_fee2").value)
        document.getElementById("total_income2").value = xx * yy;
    }

    function totalHostelIncome() {
        var hostalstudent = parseInt(document.getElementById("number_of_student3").value);
        var hostalfee = parseInt(document.getElementById("fixed_fee3").value)
        document.getElementById("total_income3").value = hostalstudent * hostalfee;

    }

    function amateurPlayers() {
        var hostalstudent = parseInt(document.getElementById("number_of_amateur_players").value);
        var hostalfee = parseInt(document.getElementById("receipts_fixed_fee").value)
        document.getElementById("receipts_total_income").value = hostalstudent * hostalfee;

    }

    function totalReceiptsIncome() {
        var totalReceipt1 = (parseFloat($("#receipts_income_from_vehicle").val()) || 0);
        var totalReceipt2 = (parseFloat($("#receipts_auction_useless").val()) || 0);
        var totalReceipt3 = (parseFloat($("#receipts_income_from_sales").val()) || 0);
        var totalReceipt4 = (parseFloat($("#receipts_income_from_other").val()) || 0);
        var totalReceipts = (totalReceipt1 + totalReceipt2 + totalReceipt3 + totalReceipt4);
        console.log("totalReceipts" + totalReceipts);
        $('#total_revenue').val(totalReceipts.toFixed(2));

    }
</script>
<script>
    function PrintDoc() {
        $('#dataTable').DataTable().destroy();
        var toPrint = document.getElementById('prodiv');
        alert(toPrint);
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
            XLSX.writeFile(wb, fn || ('Incentive Committee List.' + (type || 'xlsx')));
    }
</script>
@endpush
