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
                बिन्दु-09 - जिला खेल विकास एवं प्रोत्साहन समिति की स्थिति
                <a title="Print" class="btn btn btn-outline-success float-end" data-print="modal" onclick="PrintDoc()"><i class="icons icon-printer"></i> प्रिंट</a>
                <button onclick="PrintExce('Jila Khel Vikash')" class="btn btn btn-outline-primary float-end">Excel</button>
            </h4>
        </div>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                @if(Auth::guard('admin')->user()->admin_role != 1)
                <form id="reload_two" action="{{url('admin/information/jilaKhelVikaas')}}" class="needs-validation" novalidate method="post" autocomplete="off">
                    @csrf
                    <div class="col-12">
                        <fieldset>
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="placeholder">माह <span class="text-danger">*</span></label>
                                        <select name="month_name" id="month_name" class="form-control form-select" required>
                                            <option value=''>--select--</option>
                                            <option @if(isset($ed_data->month_name) && ($ed_data->month_name==1)) selected @endif value='1'>Janaury</option>
                                            <option @if(isset($ed_data->month_name) && ($ed_data->month_name==2)) selected @endif  value='2'>February</option>
                                            <option @if(isset($ed_data->month_name) && ($ed_data->month_name==3)) selected @endif  value='3'>March</option>
                                            <option @if(isset($ed_data->month_name) && ($ed_data->month_name==4)) selected @endif  value='4'>April</option>
                                            <option @if(isset($ed_data->month_name) && ($ed_data->month_name==5)) selected @endif  value='5'>May</option>
                                            <option @if(isset($ed_data->month_name) && ($ed_data->month_name==6)) selected @endif  value='6'>June</option>
                                            <option @if(isset($ed_data->month_name) && ($ed_data->month_name==7)) selected @endif  value='7'>July</option>
                                            <option @if(isset($ed_data->month_name) && ($ed_data->month_name==8)) selected @endif  value='8'>August</option>
                                            <option @if(isset($ed_data->month_name) && ($ed_data->month_name==9)) selected @endif  value='9'>September</option>
                                            <option @if(isset($ed_data->month_name) && ($ed_data->month_name==10)) selected @endif  value='10'>October</option>
                                            <option @if(isset($ed_data->month_name) && ($ed_data->month_name==11)) selected @endif  value='11'>November</option>
                                            <option @if(isset($ed_data->month_name) && ($ed_data->month_name==12)) selected @endif  value='12'>December</option>
                                        </select>
                                    </div>
                                </div>
                                @if(isset($ed_data->id))
                                        <input type="hidden" value="{{$ed_data->id}}" name="id">
                                        @endif
                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label class="placeholder">वर्ष <span class="text-danger">*</span></label>
                                        <select name="year" required class="form-control form-select">
                                            <option value=''>--select--</option>
                                            @for($i=2000;$i<=date('Y');$i++)
                                                {
                                                    <option @if(isset($ed_data->year) && ($ed_data->year==$i)) selected @endif value={{$i}}>{{$i}}</option>
                                                }
                                                @endfor
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="placeholder">जनपद का नाम <span class="text-danger">*</span></label>
                                        <select class="form-select" name="district_id" required>
                                            <option value="">--select--</option>
                                            @foreach ($districts as $item)
                                            <option value="{{$item->id}}" @if(isset($ed_data->district_id) && ($ed_data->district_id==$item->id)) selected @endif>{{$item->city}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="placeholder">वर्तमान वित्तीय वर्ष का प्रारम्भिक अवशेष <span class="text-danger">*</span></label>
                                        <input type="text" name="opening_balance_current_year" @if(isset($ed_data->opening_balance_current_year) ) value="{{$ed_data->opening_balance_current_year}}" @endif required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/(\.\d{2}).+/g, '$1');" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="placeholder">वर्तमान माह में प्राप्त धनराशि <span class="text-danger">*</span></label>
                                        <input type="text" name="amount_received_current_month" @if(isset($ed_data->amount_received_current_month) ) value="{{$ed_data->amount_received_current_month}}" @endif required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/(\.\d{2}).+/g, '$1');" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="placeholder">वर्तमान माह में व्यय धनराशि <span class="text-danger">*</span></label>
                                        <input type="text" name="amount_spent_current_month" @if(isset($ed_data->amount_spent_current_month) ) value="{{$ed_data->amount_spent_current_month}}" @endif required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/(\.\d{2}).+/g, '$1');" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="placeholder">वर्तमान माह तक कुल अवशेष जमा धनराशि <span class="text-danger">*</span></label>
                                        <input type="text" name="total_balance_deposited_till_current_month" @if(isset($ed_data->total_balance_deposited_till_current_month) ) value="{{$ed_data->total_balance_deposited_till_current_month}}" @endif required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/(\.\d{2}).+/g, '$1');" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="placeholder">वर्तमान माह तक कुल प्राप्त धनराशि <span class="text-danger">*</span></label>
                                        <input type="text" id="total_amount_received_till_current_month" name="total_amount_received_till_current_month" @if(isset($ed_data->total_amount_received_till_current_month) ) value="{{$ed_data->total_amount_received_till_current_month}}" @endif required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/(\.\d{2}).+/g, '$1');" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="placeholder">गत वर्ष इसी माह तक कुल प्राप्त धनराशि <span class="text-danger">*</span></label>
                                        <input type="text" id="total_amount_received_till_same_month_last_year" name="total_amount_received_till_same_month_last_year" @if(isset($ed_data->total_amount_received_till_same_month_last_year) ) value="{{$ed_data->total_amount_received_till_same_month_last_year}}" @endif required oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/(\.\d{2}).+/g, '$1');" class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="placeholder"> वृद्धि <span class="text-danger">*</span></label>
                                        <input type="text" id="growth" name="growth" @if(isset($ed_data->growth) ) value="{{$ed_data->growth}}" @endif required readonly class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="placeholder"> कमी <span class="text-danger">*</span></label>
                                        <input type="text" id="shortage" name="shortage" @if(isset($ed_data->shortage) ) value="{{$ed_data->shortage}}" @endif required readonly class="form-control" />
                                    </div>
                                </div>
                            </div>
                            <div class="bhoechie-footer">
                                <div class="row justify-content-center">
                                    <div class="col-md-2 d-grid">
                                        <button id="reset" type="reset" class="btn btn-outline-danger rounded-pill">रीसेट</button>
                                    </div>
                                    <div class="col-md-2 d-grid">
                                        <button type="submit" class="btn  btn-outline-info rounded-pill">सुनिश्चित करे</button>
                                    </div>
                                </div>
                            </div>
                        </fieldset>
                    </div>
                </form>
                @endif
                <div class="container removebg-color" style="background: #f0e7eb;padding: 10px;margin-bottom: 10px;">
                    <form action="{{ asset('assets_admin/information/jilaKhelVikaas') }}" class="needs-validation" method="get" novalidate
                        autocomplete="off">
                        <div class="pageheaderr">
                            <div class="row">
                                <div class="col-md-3">
                                    <label class="form-label" style="margin-bottom: 0;">Division</label>
                                    <select name="division_name" id="division_name" class="form-control form-select">
                                        <option value="">--select--</option>
                                        @foreach($division as $key=>$division)
                                        <option {{$division->id == request()->input('division_name') ? 'selected' : ''}} value="{{ $division->id }}"
                                            data-badge="">{{$division->division_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-3">
                                    <label class="form-label" style="margin-bottom: 0;">District</label>
                                    <input type="hidden" id="district_id" value="{{request()->input('district_name')}}">
                                    <select name="district_name" id="district_name" class="form-control form-select">
                                        <option value="">--select--</option>
                                        @foreach($districts as $key=>$district)
                                        <option {{$district->id == request()->input('district_name') ? 'selected' : ''}} value="{{ $district->id }}"
                                            data-badge="">{{$district->city}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label" style="margin-bottom: 0;">Year</label>
                                    <select name="year" id="year" class="form-control form-select">
                                        <option value="all">--all--</option>
                                        @for ($i = 2000; $i <=2024; $i++)
                                        <option   {{$i == $s_year ? 'selected' : ''}} value="{{ $i }}">{{ $i }}</option>
                                        @endfor
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <label class="form-label" style="margin-bottom: 0;">Month</label>
                                    <select name="month" id="month" class="form-control form-select">
                                        <option value='all'>--all--</option>
                                        <option {{1 == $s_month ? 'selected' : ''}} value='1'>Janaury</option>
                                        <option {{2 == $s_month ? 'selected' : ''}} value='2'>February</option>
                                        <option {{3 == $s_month ? 'selected' : ''}} value='3'>March</option>
                                        <option {{4 == $s_month ? 'selected' : ''}} value='4'>April</option>
                                        <option {{5 == $s_month ? 'selected' : ''}} value='5'>May</option>
                                        <option {{6 == $s_month ? 'selected' : ''}} value='6'>June</option>
                                        <option {{7 == $s_month ? 'selected' : ''}} value='7'>July</option>
                                        <option {{8 == $s_month ? 'selected' : ''}} value='8'>August</option>
                                        <option {{9 == $s_month ? 'selected' : ''}} value='9'>September</option>
                                        <option {{10 == $s_month ? 'selected' : ''}} value='10'>October</option>
                                        <option {{11 == $s_month ? 'selected' : ''}} value='11'>November</option>
                                        <option {{12 == $s_month ? 'selected' : ''}} value='12'>December</option>
                                    </select>
                                </div>
                                <!-- <div class="col-md-3">
                                <label class="form-label" style="margin-bottom: 0;">From Date</label>
                                <input type="text" name="from_date" id="from_date" value="{{request()->input('from_date')}}" placeholder="DD/MM/YYYY" class="form-control dateTime" />
                            </div>
                            <div class="col-md-3">
                                <label class="form-label" style="margin-bottom: 0;">To Date</label>
                                <input type="text" name="to_date" id="to_date" value="{{request()->input('to_date')}}" placeholder="DD/MM/YYYY" class="form-control dateTime" />
                            </div> -->
                                <div class="col-md-1 custom-buton" style="padding-top: 1.4rem;">
                                    <button class="btn btn-primary btn-sm" type="submit" title="Search">
                                        <i class="fas fa-search"></i>
                                    </button>
                                </div>
                                <div class="col-md-1 custom-buton" style="padding-top: 1.4rem;">
                                    <a class="btn btn-primary btn-sm" href="{{url('admin/information/jilaKhelVikaas')}}"><i class="fas fa-refresh"></i></a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive" id="prodiv">
                            <table border="0" cellspacing="0" cellpadding="4" width="100%" style="border-collapse:collapse;">
                                <thead class="dn">
                                    <tr>
                                        <th colspan="2">
                                            <div style="padding: 0 15px 3px; margin-bottom: 10px; border-bottom: 0px solid #000; position: relative;">
                                                <h2 style="text-align: center; margin:0px 0px 15px 0px; font-size:14pt; padding: 0px; color:#383838; font-weight: bold;">
                                                    बिन्दु-09
                                                </h2>
                                                <h2 style="text-align: center; margin:0px 0px 0px 0px; font-size:14pt; padding: 0px; color:#383838; font-weight: bold;">
                                                    जिला खेल विकास एवं प्रोत्साहन समिति की स्थिति
                                                </h2>
                                            </div>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th style="font-size: 10pt; text-align: left;">
                                            <b>Year :</b> {{request()->input('year') ? request()->input('year'):date("Y")}} @if(request()->input('month')), <b>Month :</b> {{month_name(request()->input('month'))}} @endif
                                        </th>
                                        <th style="font-size: 10pt; text-align:right">
                                            <strong>Report Period : </strong> {{first_insert('information_jilakhelvikaas','created_at')}} to {{date("d-m-Y")}}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="2">
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-hover bg-white mb-3" id="dataTable" cellpadding="3">
                                                    <thead>
                                                        <tr>
                                                            <th rowspan="2" nowrap="nowrap">क्र. सं.</th>
                                                            <th rowspan="2">मण्डल का नाम</th>
                                                            <th rowspan="2">जनपद का नाम</th>
                                                            <th rowspan="2">माह</th>
                                                            <th rowspan="2">वर्ष</th>
                                                            <th rowspan="2">वर्तमान वित्तीय वर्ष का प्रारम्भिक अवशेष</th>
                                                            <th colspan="2" style="text-align:center;">वर्तमान माह में</th>
                                                            <th rowspan="2">वर्तमान माह तक कुल अवशेष जमा धनराशि</th>
                                                            <th rowspan="2">वर्तमान माह तक कुल प्राप्त धनराशि</th>
                                                            <th rowspan="2">गत वर्ष इसी माह तक कुल प्राप्त धनराशि</th>
                                                            <th rowspan="2">वृद्धि</th>
                                                            <th rowspan="2">कमी</th>
                                                            <th rowspan="2" class="noprint">Action</th>
                                                        </tr>
                                                        <tr>
                                                            <th>प्राप्त धनराशि</th>
                                                            <th>व्यय धनराशि</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                            $t_amount_received_current_month = 0;
                                                            $t_amount_spent_current_month = 0;
                                                            $t_total_balance_deposited_till_current_month = 0;
                                                            $t_total_amount_received_till_current_month = 0;
                                                            $t_total_amount_received_till_same_month_last_year = 0;
                                                            $t_growth = 0;
                                                            $t_shortage = 0;
                                                        ?>
                                                        @foreach($jilaKhelVikaas as $key=>$item)
                                                        <tr>
                                                            <td>{{$key+1}}</td>
                                                            <td>
                                                                <?php $division_id = DB::table('hostel_div_district_mapping')->where('district_id', $item->district_id)->first(); ?>
                                                                @if($division_id)
                                                                {{divisionName($division_id->division_id)}}
                                                                @else
                                                                NA
                                                                @endif
                                                            </td>
                                                            <td>{{districtName($item->district_id)}}</td>
                                                            <td>{{month_name($item->month_name)}}</td>
                                                            <td>{{$item->year}}</td>
                                                            <td>{{$item->opening_balance_current_year}}</td>
                                                            <td>
                                                                <?php $t_amount_received_current_month += $item->amount_received_current_month ?>
                                                                {{$item->amount_received_current_month}}
                                                            </td>
                                                            <td>
                                                                <?php $t_amount_spent_current_month += $item->amount_spent_current_month ?>
                                                                {{$item->amount_spent_current_month}}
                                                            </td>
                                                            <td>
                                                                <?php $t_total_balance_deposited_till_current_month += $item->total_balance_deposited_till_current_month ?>
                                                                {{$item->total_balance_deposited_till_current_month}}
                                                            </td>
                                                            <td>
                                                                <?php $t_total_amount_received_till_current_month += $item->total_amount_received_till_current_month ?>
                                                                {{$item->total_amount_received_till_current_month}}
                                                            </td>
                                                            <td>
                                                                <?php $t_total_amount_received_till_same_month_last_year += $item->total_amount_received_till_same_month_last_year ?>
                                                                {{$item->total_amount_received_till_same_month_last_year}}
                                                            </td>
                                                            <td>
                                                                <?php $t_growth += $item->growth ?>
                                                                {{$item->growth}}
                                                            </td>
                                                            <td>
                                                                <?php $t_shortage += $item->shortage ?>
                                                                {{$item->shortage}}
                                                            </td>
                                                            <td class="text-center noprint">
                                                                <a class="btn btn-sm btn-dark pointer bt" href="{{ route('jilaKhelVikaas' , $item->id) }}">
                                                                <i class="fa fa-edit"></i>
                                                            </a>
                                                            
                                                                <a class="btn btn-sm btn-danger pointer bt" href="{{ route('delete_inf' , [$item->id,'information_jilaKhelVikaas']) }}" onclick="return confirm('Are you sure you want to delete ?')">
                                                                <i class="fa fa-trash"></i>
                                                            </a>
                                                            
                                                            </td>
                                                        </tr>
                                                        @endforeach
                                                    </tbody>
                                                        <tr>
                                                            <td colspan="6" align="center"><b>कुल योग:- </b></td>
                                                            <td><b>{{$t_amount_received_current_month}}</b></td>
                                                            <td><b>{{$t_amount_spent_current_month}}</b></td>
                                                            <td><b>{{$t_total_balance_deposited_till_current_month}}</b></td>
                                                            <td><b>{{$t_total_amount_received_till_current_month}}</b></td>
                                                            <td><b>{{$t_total_amount_received_till_same_month_last_year}}</b></td>
                                                            <td><b>{{$t_growth}}</b></td>
                                                            <td><b>{{$t_shortage}}</b></td>
                                                            <td>&nbsp;</td>
                                                        </tr>
                                                   

                                                </table>
                                            </div>
                                        </td>
                                    </tr>
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



<script>
    function PrintDoc() {
        $('#dataTable').DataTable().destroy();
        var toPrint = document.getElementById('prodiv');
        // alert(toPrint);
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
    $(document.body).on('blur', '#total_amount_received_till_current_month, #total_amount_received_till_same_month_last_year', function() {


        if ((parseInt($('#total_amount_received_till_current_month').val()) - parseInt($('#total_amount_received_till_same_month_last_year').val())) > 0) {

            $('#growth').val((parseInt($('#total_amount_received_till_current_month').val()) - parseInt($('#total_amount_received_till_same_month_last_year').val())));
            $('#shortage').val(0);
        } else {
            $('#growth').val(0);
            $('#shortage').val(parseInt($('#total_amount_received_till_same_month_last_year').val()) - (parseInt($('#total_amount_received_till_current_month').val())));
        }
        // $('#total_increment').val((total + parseInt($('#old_total').val()) - parseInt($('#current_total').val())));
        // $('#total_decrement').val(parseInt($('#current_total').val()) - (total + parseInt($('#old_total').val())));
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
