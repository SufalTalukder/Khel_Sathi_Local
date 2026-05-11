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
        <div class="card">
            <div class="card-body">
                <form <?php if ($admin_id == 1) { ?> style="display:none" <?php } ?> action="{{url('admin/information/create_organized_competition')}}" class="needs-validation" novalidate method="post" autocomplete="off">
                    @csrf

                    <fieldset>
                        <legend>आयोजित प्रतियोगिता विवरण</legend>
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
                                        <option value="3">2025</option>
                                    </select>
                                </div>
                                @error('year_name')
                                <div class="text-danger">{{ $message }}</div>
                                @enderror
                            </div>
                            <?php if (!empty($district_id_organized)) { ?>
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
                                        <label class="placeholder">जनपद का नाम<span class="text-danger">*</span></label>
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
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label class="placeholder">आयोजित प्रति. का नाम <span class="text-danger">*</span></label>
                                    <input type="text" name="organized_competition_name" onkeypress="return ((event.charCode >= 65 && event.charCode <= 90) || (event.charCode >= 97 && event.charCode <= 122) || (event.charCode == 32))" pattern="^[A-Za-z -]+$" maxlength="150" id="organized_competition_name" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label class="placeholder">व्यय धनराशि <span class="text-danger">*</span></label>
                                    <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/(\.\d{2}).+/g, '$1');" name="spending_amount" id="spending_amount" class="form-control" required>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label class="placeholder">आयोजन का वर्ष <span class="text-danger">*</span></label>
                                    <input type="number" max="9999" min="0" pattern="/[0-9]/" name="year_of_event" id="year_of_event" class="form-control" required>
                                </div>
                            </div>
                        </div>
                        <div class="bhoechie-footer">
                            <div class="row justify-content-center">
                                <!-- <div class="col-md-2 d-grid">
                                                                    <button type="reset" class="btn btn-outline-info rounded-pill">Back</button>
                                                                </div> -->
                                <div class="col-md-2 d-grid">
                                    <button type="reset" class="btn btn-outline-danger rounded-pill">रीसेट</button>
                                </div>
                                <div class="col-md-2 d-grid">
                                    <button type="submit" class="btn btn-outline-info rounded-pill">सुनिश्चित करे</button>
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
                                        संगठित प्रतियोगिता प्रपत्र
                                    </div>
                                </div>
                            </td>
                        </tr>
                    </table>
                    <table class="table table-bordred table-hover bg-white datatable mb-3" id="dataTable">
                        <thead>
                            <tr>
                                <th rowspan="2">क्र.सं.</th>
                                <?php if ($admin_id ==  10) { ?>
                                    <th rowspan="2">जनपद का नाम</th>
                                    <th colspan="1" class="text-center">आयोजित प्रति. का नाम</th>
                                    <th rowspan="2">व्यय धनराशि</th>
                                    <th rowspan="2">आयोजन का वर्ष</th>
                                <?php } ?>


                                <?php if ($admin_id == 9) { ?>
                                    <th rowspan="2">जनपद का नाम</th>
                                    <th rowspan="2">तहसील का नाम</th>
                                    <th colspan="2" class="text-center"><strong>आयोजित प्रति. का नाम</strong></th>
                                    <th rowspan="2"><strong>व्यय धनराशि</strong></th>
                                    <th rowspan="2"><strong>आयोजन का वर्ष</strong></th>
                                <?php } ?>

                            </tr>
                            <tr>

                                <?php if ($admin_id == 9) { ?>
                                    <th>जनपद का नाम</th>
                                    <th>तहसील <strong>स्तर</strong></th>
                                <?php } ?>
                                <?php if ($admin_id == 10) { ?>
                                    <th>मण्डल
                                        स्तर
                                    </th>
                                <?php } ?>

                            </tr>
                        </thead>
                        <tbody>
                            @foreach($organizedCompetition as $key=>$item)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <?php
                                //0 Division name
                                if ($item->status == 0) { ?>
                                    <td>{{!empty(divisionName($item->division_id)) ? divisionName($item->division_id) : '-' }}</td>

                                    <td>{{isset($item->organized_competition_name) ? repairHindi($item->organized_competition_name) : '-' }}</td>

                                    <td>{{isset($item->spending_amount) ? $item->spending_amount : '-' }}</td>
                                    <td>{{isset($item->year_of_event) ? $item->year_of_event : '-' }}</td>

                                <?php } ?>
                                <?php

                                //1 District
                                if ($item->status == 1) { ?>
                                    <td>{{!empty(districtName($item->district_id)) ? districtName($item->district_id) : '-' }} </td>

                                    <td>-</td>
                                    <td>{{isset($item->organized_competition_name) ? repairHindi($item->organized_competition_name) : '-' }}</td>
                                    <td>-</td>

                                    <td>{{isset($item->spending_amount) ? $item->spending_amount : '-' }}</td>
                                    <td>{{isset($item->year_of_event) ? $item->year_of_event : '-' }}</td>
                                <?php } ?>
                                <?php
                                //2 tehsil name
                                if ($item->status == 2) { ?>

                                    <td>{{!empty(districtName($item->district_id)) ? districtName($item->district_id) : '-' }} </td>
                                    <td>{{!empty(tehsiltName($item->tehsil_id)) ? tehsiltName($item->tehsil_id) : '-' }}</td>
                                    <td>-</td>

                                    <td>{{isset($item->organized_competition_name) ? repairHindi($item->organized_competition_name) : '-' }}</td>

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
