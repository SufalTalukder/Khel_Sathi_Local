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
                बिन्दु-11 - मण्डलीय अधिकारियों (क्रीड़ाधिकारी/क्षेत्रीय क्रीड़ाधिकारी) द्वारा किये गये निरीक्षण का विवरण
                <a title="Print" class="btn btn btn-outline-success float-end" data-print="modal" onclick="PrintDoc()"><i class="icons icon-printer"></i> प्रिंट</a>
                <button onclick="PrintExce('Kshetreya Kreeda Adhikari')" class="btn btn btn-outline-primary float-end">Excel</button>
            </h4>
        </div>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                @if(Auth::guard('admin')->user()->admin_role != 1 && Auth::guard('admin')->user()->admin_role != 18)
                <form id="reload_two" action="{{url('admin/information/kshetreeykreedaadhikaari')}}" class="needs-validation" novalidate method="post" autocomplete="off">
                    @csrf
                    <div class="col-12">
                        <fieldset>
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="row">
                                        <div class="col-6">
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
                                        <div class="col-6">
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
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="placeholder">निरीक्षण करने वाले अधिकारी का नाम <span class="text-danger">*</span></label>
                                        <input type="text" name="inspected_officer" @if(isset($ed_data->inspected_officer) ) value="{{repairHindi($ed_data->inspected_officer)}}" @endif required class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="placeholder">पदनाम <span class="text-danger">*</span></label>
                                        <input type="text" name="subpost_name" @if(isset($ed_data->subpost_name) ) value="{{repairHindi($ed_data->subpost_name)}}" @endif required class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="placeholder">तैनाती स्थान/मण्डल का नाम <span class="text-danger">*</span></label>
                                        <input type="text" name="posting_place_division" @if(isset($ed_data->posting_place_division) ) value="{{repairHindi($ed_data->posting_place_division)}}" @endif required class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="placeholder">निरीक्षण का दिनांक</label>
                                        <input type="date" name="inspected_date" @if(isset($ed_data->inspected_date) ) value="{{$ed_data->inspected_date}}" @endif class="form-control" />
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="placeholder">निरीक्षण किये गये कार्यालय का नाम</label>
                                        <input type="text" name="inspected_office" @if(isset($ed_data->inspected_office) ) value="{{repairHindi($ed_data->inspected_office)}}" @endif required class="form-control" />
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
            </div>
            <div class="container removebg-color" style="background: #f0e7eb;padding: 10px;margin-bottom: 10px;">
                <form action="{{ url('admin/information/kshetreeykreedaadhikaari') }}" class="needs-validation" method="get" novalidate
                    autocomplete="off">
                    <div class="pageheaderr">
                        <div class="row">
                            {{-- <div class="col-md-3">
                                <label class="form-label" style="margin-bottom: 0;">Division</label>
                                <select name="division_name" id="division_name" class="form-control form-select">
                                    <option value="">--select--</option>
                                    @foreach($division as $key=>$division)
                                    <option {{$division->id == request()->input('division_name') ? 'selected' : ''}} value="{{ $division->id }}"
                                        data-badge="">{{$division->division_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label" style="margin-bottom: 0;">District</label>
                                <select name="district_name" id="district_name" class="form-control form-select">
                                    <option value="">--select--</option>
                                    @foreach($districts as $key=>$district)
                                    <option {{$district->id == request()->input('district_name') ? 'selected' : ''}} value="{{ $district->id }}"
                                        data-badge="">{{$district->city}}</option>
                                    @endforeach
                                </select>
                            </div> --}}
                            <div class="col-md-2">
                                <label class="form-label" style="margin-bottom: 0;">Year</label>
                                <select name="year" id="year" class="form-control form-select">
                                    <option value="all">--all--</option>
                                    @for ($i = 2000; $i <=date('Y'); $i++)
                                    <option   {{$i == $s_year ? 'selected' : ''}} value="{{ $i }}">{{ $i }}</option>
                                    @endfor
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label" style="margin-bottom: 0;">From Month</label>
                                <select name="from_month" id="from_month" class="form-control form-select">
                                    <option value='all'>--all--</option>
                                    <option {{1 == $from_month ? 'selected' : ''}} value='1'>Janaury</option>
                                    <option {{2 == $from_month ? 'selected' : ''}} value='2'>February</option>
                                    <option {{3 == $from_month ? 'selected' : ''}} value='3'>March</option>
                                    <option {{4 == $from_month ? 'selected' : ''}} value='4'>April</option>
                                    <option {{5 == $from_month ? 'selected' : ''}} value='5'>May</option>
                                    <option {{6 == $from_month ? 'selected' : ''}} value='6'>June</option>
                                    <option {{7 == $from_month ? 'selected' : ''}} value='7'>July</option>
                                    <option {{8 == $from_month ? 'selected' : ''}} value='8'>August</option>
                                    <option {{9 == $from_month ? 'selected' : ''}} value='9'>September</option>
                                    <option {{10 == $from_month ? 'selected' : ''}} value='10'>October</option>
                                    <option {{11 == $from_month ? 'selected' : ''}} value='11'>November</option>
                                    <option {{12 == $from_month ? 'selected' : ''}} value='12'>December</option>
                                </select>
                            </div>
                            <div class="col-md-2">
                                <label class="form-label" style="margin-bottom: 0;">To Month</label>
                                <select name="to_month" id="to_month" class="form-control form-select">
                                    <option value='all'>--all--</option>
                                    <option {{1 == $to_month ? 'selected' : ''}} value='1'>Janaury</option>
                                    <option {{2 == $to_month ? 'selected' : ''}} value='2'>February</option>
                                    <option {{3 == $to_month ? 'selected' : ''}} value='3'>March</option>
                                    <option {{4 == $to_month ? 'selected' : ''}} value='4'>April</option>
                                    <option {{5 == $to_month ? 'selected' : ''}} value='5'>May</option>
                                    <option {{6 == $to_month ? 'selected' : ''}} value='6'>June</option>
                                    <option {{7 == $to_month ? 'selected' : ''}} value='7'>July</option>
                                    <option {{8 == $to_month ? 'selected' : ''}} value='8'>August</option>
                                    <option {{9 == $to_month ? 'selected' : ''}} value='9'>September</option>
                                    <option {{10 == $to_month ? 'selected' : ''}} value='10'>October</option>
                                    <option {{11 == $to_month ? 'selected' : ''}} value='11'>November</option>
                                    <option {{12 == $to_month ? 'selected' : ''}} value='12'>December</option>
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
                                <a class="btn btn-primary btn-sm" href="{{url('admin/information/kshetreeykreedaadhikaari')}}"><i class="fas fa-refresh"></i></a>
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
                                                बिन्दु-11
                                            </h2>
                                            <h2 style="text-align: center; margin:0px 0px 0px 0px; font-size:14pt; padding: 0px; color:#383838; font-weight: bold;">
                                                मण्डलीय अधिकारियों (क्रीड़ाधिकारी/क्षेत्रीय क्रीड़ाधिकारी) द्वारा किये गये निरीक्षण का विवरण
                                            </h2>
                                        </div>
                                    </th>
                                </tr>
                                <tr>
                                    <th style="font-size: 10pt; text-align: left;">
                                        <b>Year :</b> {{request()->input('year') ? request()->input('year'):date("Y")}} <b>@if(request()->input('from_month') != 'all' || request()->input('to_month') != 'all'  )  ,Month : @endif </b> {{request()->input('from_month') ? month_name(request()->input('from_month')):month_name(date("m"))}} @if(request()->input('from_month') != 'all' && request()->input('to_month') != 'all'  )  to @endif {{request()->input('to_month') ? month_name(request()->input('to_month')):month_name(date("m"))}}
                                    </th>
                                    <th style="font-size: 10pt; text-align:right">
                                        <strong>Report Period : </strong> {{first_insert('information_kshetreey_kreeda_adhikaari','created_at')}} to {{date("d-m-Y")}}
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
                                                        <th>क्र. सं.</th>
                                                        <th>माह</th>
                                                        <th>वर्ष</th>
                                                        <th>निरीक्षण करने वाले अधिकारी का नाम</th>
                                                        <th>पदनाम</th>
                                                        <th>तैनाती स्थान/मण्डल का नाम</th>
                                                        <th>निरीक्षण का दिनांक</th>
                                                        <th>निरीक्षण किये गये कार्यालय का नाम</th>
                                                        <th  class="noprint">Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php $t_received_applications = 0; ?>
                                                    @foreach($kshetreeykreedaadhikaari as $key=>$item)
                                                    <tr>
                                                        <td>{{$key+1}}</td>
                                                        <td>{{month_name($item->month_name)}}</td>
                                                        <td>{{$item->year}}</td>
                                                        <td valign="top">{{repairHindi($item->inspected_officer)}} </td>
                                                        <td valign="top">{{repairHindi($item->subpost_name)}}</td>
                                                        <td valign="top">{{repairHindi($item->posting_place_division)}}</td>
                                                        <td valign="top">@if($item->inspected_date){{dmy($item->inspected_date)}}@else NA @endif</td>
                                                        <td valign="top">{{repairHindi($item->inspected_office)}}</td>
                                                        <td class="text-center noprint">
                                                            <a class="btn btn-sm btn-dark pointer bt" href="{{ route('kshetreeykreedaadhikaari' , $item->id) }}">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        
                                                            <a class="btn btn-sm btn-danger pointer bt" href="{{ route('delete_inf' , [$item->id,'information_kshetreey_kreeda_adhikaari']) }}" onclick="return confirm('Are you sure you want to delete ?')">
                                                            <i class="fa fa-trash"></i>
                                                        </a>
                                                        
                                                        </td>

                                                    </tr>
                                                    @endforeach
                                                </tbody>
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
