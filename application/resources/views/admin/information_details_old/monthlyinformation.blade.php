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
                मासिक सूचना प्रपत्र
                <a title="Print" class="btn btn btn-outline-success float-end" data-print="modal" onclick="PrintDoc()"><i class="icons icon-printer"></i> प्रिंट</a>
            </h4>
        </div>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <form <?php if ($admin_id == 1) { ?> style="display:none" <?php } ?> action="{{url('admin/information/create_monthly_information')}}" class="needs-validation" novalidate method="post">
                    @csrf
                    <fieldset>
                        <div class="row">
                            <?php if (!empty($district_id_monthly)) { ?>
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
                                            <option disabled selected value="">-Select Year-</option>
                                            <option value="1">2023</option>
                                            <option value="2">2024</option>
                                        </select>
                                    </div>
                                    @error('district_name')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="placeholder">प्रकार <span class="text-danger">*</span></label>
                                        <div class="form-control">
                                            <div class=" form-check-inline">
                                                <input class="form-check-input" type="radio" name="identified_the_department" id="department_yes" value="1" required>
                                                <label class="form-check-label mb-0" for="inlineCheckbox1"> ज़िला</label>
                                            </div>
                                            <div class=" form-check-inline">
                                                <input class="form-check-input" type="radio" name="identified_the_department" id="department_no" value="2" required>
                                                <label class="form-check-label mb-0" for="inlineCheckbox2"> तहसील </label>
                                            </div>
                                        </div>
                                    </div>
                                    @error('district_name')
                                    <div class="text-danger">{{ $message }}</div>
                                    @enderror
                                </div>
                                <div class="col-md-4" id="district_name_selected" style="display: none;">
                                    <div class="form-group mb-3">
                                        <label class="placeholder">जिले का नाम <span class="text-danger">*</span></label>
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
                                            <option selected="" disabled="" value="">Select Tehsil</option>
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
                        </div>
                        <div class="row">
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label class="placeholder">वित्तीय वर्ष का प्रारंभिक अवशेष <span class="text-danger">*</span></label>
                                    <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/(\.\d{2}).+/g, '$1');" id="opening_balance_of_financial" name="opening_balance_of_financial" class="form-control amount" required>
                                </div>
                                @error('opening_balance_of_financial')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label class="placeholder">वर्तमान माह में प्राप्त धनराशि <span class="text-danger">*</span></label>
                                    <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/(\.\d{2}).+/g, '$1');" id="amount_received" name="amount_received" class="form-control amount" required>
                                </div>
                                @error('amount_received')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label class="placeholder">वर्तमान माह में व्यय धनराशि<span class="text-danger">*</span></label>
                                    <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/(\.\d{2}).+/g, '$1');" id="amount_spent" name="amount_spent" class="form-control amountless" required>
                                </div>
                                @error('amount_spent')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label class="placeholder">वर्तमान माह तक कुल अवशेष जमा धनराशि<span class="text-danger">*</span></label>
                                    <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/(\.\d{2}).+/g, '$1');" id="total_balance_deposited_current_month" name="total_balance_deposited_current_month" class="form-control" readonly>
                                    <input type="hidden" id="total_balance" name="total_balance" />
                                </div>
                                @error('total_balance_deposited_current_month')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label class="placeholder">वर्तमान माह तक कुल प्राप्त धनराशि <span class="text-danger">*</span></label>
                                    <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/(\.\d{2}).+/g, '$1');" id="total_amount_received_current_month" name="total_amount_received_current_month" class="form-control current_amount" required>
                                </div>
                                @error('total_amount_received_current_month')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label class="placeholder">गत वर्ष इसी माह तक कुल प्राप्त धनराशि<span class="text-danger">*</span></label>
                                    <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/(\.\d{2}).+/g, '$1');" id="total_amount_received_lastyear" name="total_amount_received_lastyear" class="form-control lastyear" required>
                                </div>
                                @error('total_amount_received_lastyear')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="placeholder">जिला खेल विकास एवं प्रोत्साहन समिति की स्थिति माह</label>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <select name="month_name" id="month_name" class="form-control form-select" required="">
                                                    <option disabled="" selected="" value="">Month</option>
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
                                        <div class="col-md-6">
                                            <div class="form-group mb-3">
                                                <select name="month_name" id="month_name" class="form-control form-select" required="">
                                                    <option disabled="" selected="" value="">Year</option>
                                                    <option value="1">2014</option>
                                                    <option value="2">2015</option>
                                                    <option value="3">2016</option>
                                                    <option value="4">2017</option>
                                                    <option value="5">2018</option>
                                                    <option value="6">2019</option>
                                                    <option value="7">2020</option>
                                                    <option value="8">2021</option>
                                                    <option value="9">2022</option>
                                                    <option value="10">2023</option>
                                                    <option value="11">2024</option>
                                                    <option value="12">2025</option>
                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label>&nbsp;</label>
                                    <h3 id="increase" class="text-success" style="margin-top: 25px;"></h3>
                                    <h3 id="decrease" class="text-danger" style="margin-top: 25px;"></h3>
                                    <input type="hidden" name="increase" id="increaseval" value="" />
                                    <input type="hidden" name="decrease" id="decreaseval" value="" />
                                    <input type="hidden" id="increase-hidden" name="increase-hidden">
                                </div>
                                @error('increase')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                                @error('decrease')
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
                                    <button id="reset" type="reset" class="btn btn-outline-danger rounded-pill">रीसेट</button>
                                </div>
                                <div class="col-md-2 d-grid">
                                    <button type="submit" class="btn  btn-outline-info rounded-pill">सुनिश्चित करे</button>
                                </div>
                            </div>
                        </div>
                        <input type="hidden" name="division_id" id="division_id" value="{{!empty($division_id) ? $division_id : 'null' }}">
                    </fieldset>
                </form>
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
                                        मासिक सूचना प्रपत्र
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                    <p class="mb-2">जिला खेल विकास एवं प्रोत्साहन समिति की स्थिति माह  &nbsp; <b> April </b>&nbsp;&nbsp;वर्ष &nbsp;<b> 2024 </b></p>
                    <table class="table table-bordered table-hover bg-white datatable mb-3" id="dataTable">
                        <thead>
                            <tr>
                                <th><strong>क्र.सं.</strong></th>
                                <?php if ($admin_id == 10) { ?>
                                    <th><strong>जनपद का नाम</strong></th>
                                    <th><strong>वित्तीय वर्ष का प्रारम्भिक अवशेष</strong></th>
                                    <th><strong>वर्तमान माह में</strong> <strong>प्राप्त धनराशि</strong></th>
                                    <th><strong>वर्तमान माह में</strong> <strong>व्यय धनराशि</strong></th>
                                    <th><strong>वर्तमान माह तक कुल अवशेष जमा धनराशि</strong></th>
                                    <th><strong>वर्तमान माह तक कुल प्राप्त धनराशि</strong></th>
                                    <th><strong>गत वर्ष इसी माह तक कुल प्राप्त धनराशि</strong></th>
                                    <th><strong>वृद्धि</strong></th>
                                    <th><strong>कमी</strong></th>
                                <?php } ?>
                                <?php if ($admin_id == 9) { ?>
                                    <th><strong>जनपद का नाम</strong></th>
                                    <th>तहसील का नाम</th>
                                    <th><strong>वित्तीय वर्ष का प्रारम्भिक अवशेष</strong></th>
                                    <th><strong>वर्तमान माह में</strong> <strong>प्राप्त धनराशि</strong></th>
                                    <th><strong>वर्तमान माह में</strong> <strong>व्यय धनराशि</strong></th>
                                    <th><strong>वर्तमान माह तक कुल अवशेष जमा धनराशि</strong></th>
                                    <th><strong>वर्तमान माह तक कुल प्राप्त धनराशि</strong></th>
                                    <th><strong>गत वर्ष इसी माह तक कुल प्राप्त धनराशि</strong></th>
                                    <th><strong>वृद्धि</strong></th>
                                    <th><strong>कमी</strong></th>
                                <?php } ?>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($monthlyInformation as $key=>$item)
                            <tr>
                                <td>{{$key+1}}</td>
                                <?php
                                //2 tehsil name
                                if ($item->status == 0) { ?>
                                    <td>{{!empty(divisionName($item->division_id)) ? divisionName($item->division_id) : '-' }}</td>
                                <?php } ?>
                                <?php
                                //1 District
                                if ($item->status == 1) { ?>
                                    <td>{{!empty(districtName($item->district_id)) ? districtName($item->district_id) : '-' }} </td>
                                    <td>-</td>
                                <?php } ?>
                                <?php
                                //2 tehsil name
                                if ($item->status == 2) { ?>
                                    <td>-</td>
                                    <td>{{!empty(tehsiltName($item->tehsil_id)) ? tehsiltName($item->tehsil_id) : '-' }}</td>
                                <?php } ?>
                                <td>{{isset($item->opening_balance_of_financial) ? $item->opening_balance_of_financial : '-' }}</td>
                                <td>{{isset($item->amount_received) ? $item->amount_received : '-' }}</td>
                                <td>{{isset($item->amount_spent) ? $item->amount_spent : '-' }}</td>
                                <td>{{isset($item->total_balance_deposited_current_month) ? $item->total_balance_deposited_current_month : '-' }}</td>
                                <td>{{isset($item->total_amount_received_current_month) ? $item->total_amount_received_current_month : '-' }}</td>
                                <td>{{isset($item->total_amount_received_lastyear) ? $item->total_amount_received_lastyear : '-' }}</td>
                                <td>{{isset($item->increase) ? $item->increase : '-' }}</td>
                                <td>{{isset($item->decrease) ? $item->decrease : '-' }}</td>
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
@endsection

@push( 'custom-scripts' )
<script>
    $(document).ready(function() {
        $('.amount').keyup(function() {

            var val2 = 0;
            $('.amount').each(function() {
                val2 += (parseFloat($(this).val()) || 0);
            });

            $('#total_balance').val(val2);

        });
        $('.amountless').keyup(function() {
            var amountless = (parseFloat($(this).val()) || 0);
            var finalamount = (parseFloat($("#total_balance").val()) || 0);
            var Tottim = (finalamount - amountless)
            $('#total_balance_deposited_current_month').val(Tottim.toFixed(2));
            //$('#total').text( value.toFixed(2) );
        });
    });

    $(document).ready(function() {
        $('.lastyear').keyup(function() {
            var currentmonth = (parseFloat($("#total_amount_received_current_month").val()) || 0);
            console.log("currentmonth" + currentmonth);

            var lastyear = (parseFloat($("#total_amount_received_lastyear").val()) || 0);
            console.log("lastyear" + lastyear);

            var Tottim = (currentmonth - lastyear)
            console.log("Tottim" + Tottim);

            if (Tottim > 0) {
                //$('#decrease').val('');
                $('#increase').text("Increase +" + Tottim.toFixed(2));
                $('#increaseval').val(Tottim.toFixed(2));
                $('#decrease').text('');
                $('#decreaseval').val('');

            } else {
                $('#increase').text('');
                $('#decrease').text("Decrease " + Tottim.toFixed(2));
                $('#decreaseval').val(Tottim.toFixed(2));
                $('#increaseval').val('');
                // var inputStringd = $("#decrease").val();           
                // $('#decreaseval').val(inputStringd.toFixed(2));


            }
        });

    });
</script>
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
