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
                बिन्दु-02 - खेलो इण्डिया योजनान्तर्गत स्वीकृत परियोजना
                <a title="Print" class="btn btn btn-outline-success float-end" data-print="modal" onclick="PrintDoc()"><i class="icons icon-printer"></i> प्रिंट</a>
                <button onclick="PrintExce('Khelo India Yojana')" class="btn btn btn-outline-primary float-end">Excel</button>
            </h4>
        </div>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                @if(Auth::guard('admin')->user()->admin_role != 1)
                <form action="{{url('admin/information/khelo_india_yojana')}}" class="needs-validation"
                    id="reload_two" novalidate method="post" autocomplete="off">
                    @csrf
                    <fieldset>
                        <div class="row">
                            <div class="col-md-2">
                                <div class="form-group">
                                    <label class="placeholder">माह <span class="text-danger">*</span></label>
                                    <select name="month" required class="form-control form-select">
                                        <option value=''>--select--</option>
                                        <option @if(isset($ed_data->month) && ($ed_data->month==1)) selected @endif value='1'>Janaury</option>
                                        <option @if(isset($ed_data->month) && ($ed_data->month==2)) selected @endif  value='2'>February</option>
                                        <option @if(isset($ed_data->month) && ($ed_data->month==3)) selected @endif  value='3'>March</option>
                                        <option @if(isset($ed_data->month) && ($ed_data->month==4)) selected @endif  value='4'>April</option>
                                        <option @if(isset($ed_data->month) && ($ed_data->month==5)) selected @endif  value='5'>May</option>
                                        <option @if(isset($ed_data->month) && ($ed_data->month==6)) selected @endif  value='6'>June</option>
                                        <option @if(isset($ed_data->month) && ($ed_data->month==7)) selected @endif  value='7'>July</option>
                                        <option @if(isset($ed_data->month) && ($ed_data->month==8)) selected @endif  value='8'>August</option>
                                        <option @if(isset($ed_data->month) && ($ed_data->month==9)) selected @endif  value='9'>September</option>
                                        <option @if(isset($ed_data->month) && ($ed_data->month==10)) selected @endif  value='10'>October</option>
                                        <option @if(isset($ed_data->month) && ($ed_data->month==11)) selected @endif  value='11'>November</option>
                                        <option @if(isset($ed_data->month) && ($ed_data->month==12)) selected @endif  value='12'>December</option>
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
                                <label class="form-label" style="margin-bottom: 0;">District <span class="text-danger">*</span></label>
                                <select name="district_name" id="district_name" required class="form-control form-select">
                                    <option value="">--select--</option>
                                    @foreach($districts as $key=>$district)
                                    <option @if(isset($ed_data->district_id) && ($ed_data->district_id==$district->id)) selected @endif  value="{{ $district->id }}"
                                        data-badge="">{{$district->city}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="placeholder">कार्य का नाम <span class="text-danger">*</span></label>
                                    <input name="yojna_name" @if(isset($ed_data->yojna_name) ) value="{{$ed_data->yojna_name}}" @endif  required type="text" class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="placeholder">कार्यदायी संस्था का नाम <span class="text-danger">*</span></label>
                                    <input type="text" name="name_of_executing_agency" @if(isset($ed_data->name_of_executing_agency) ) value="{{$ed_data->name_of_executing_agency}}" @endif  required class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="placeholder"> स्वीकृत लागत <span class="text-danger">*</span></label>
                                    <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/(\.\d{2}).+/g, '$1');" name="approval_amount" @if(isset($ed_data->approval_amount) ) value="{{$ed_data->approval_amount}}" @endif  required class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="placeholder">अवमुक्त धनराशि <span class="text-danger">*</span></label>
                                    <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/(\.\d{2}).+/g, '$1');" name="unreleased_amount" @if(isset($ed_data->unreleased_amount) ) value="{{$ed_data->unreleased_amount}}" @endif  required class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="placeholder">अवमुक्त धनराशि की तिथि <span class="text-danger">*</span></label>
                                    <input type="date" name="date_of_unreleased_amount" @if(isset($ed_data->date_of_unreleased_amount) ) value="{{$ed_data->date_of_unreleased_amount}}" @endif  class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="placeholder">अवशेष देय धनराशि <span class="text-danger">*</span></label>
                                    <input type="text" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/(\.\d{2}).+/g, '$1');" name="residual_due_amount" @if(isset($ed_data->residual_due_amount) ) value="{{$ed_data->residual_due_amount}}" @endif  required class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="placeholder">कार्य प्रारम्भ होने की तिथि </label>
                                    <input type="date" name="date_of_yojna_start" @if(isset($ed_data->date_of_yojna_start) ) value="{{$ed_data->date_of_yojna_start}}" @endif  class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="placeholder">कार्य पूर्ण होने की लक्ष्य तिथि </label>
                                    <input type="date" name="date_of_yojna_complete" @if(isset($ed_data->date_of_yojna_complete) ) value="{{$ed_data->date_of_yojna_complete}}" @endif  class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-12">
                                <strong>वर्तमान में उपलब्ध करायी गयी प्रगति</strong>
                                <hr style="margin: .3rem 0 0.7rem;" />
                            </div>
                            <div class="col-md-4">
                                <div class="form-group">
                                    <label class="placeholder">भौतिक प्रगति <span class="text-danger">*</span></label>
                                    <input type="text" name="material_progress" @if(isset($ed_data->material_progress) ) value="{{$ed_data->material_progress}}" @endif  required class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label class="placeholder">वित्तीय प्रगति <span class="text-danger">*</span></label>
                                    <input type="text" name="financial_progress" @if(isset($ed_data->financial_progress) ) value="{{$ed_data->financial_progress}}" @endif  required class="form-control" />
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group mb-3">
                                    <label class="placeholder">अभ्युक्ति </label>
                                    <input type="text" name="comment" @if(isset($ed_data->comment) ) value="{{$ed_data->comment}}" @endif class="form-control" />
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
                </form>
                @endif
                <div class="container removebg-color" style="background: #f0e7eb;padding: 10px;margin-bottom: 10px;">
                    <form action="{{ asset('assets_admin/information/khelo_india_yojana') }}" class="needs-validation" method="get" novalidate
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
                                    <label class="form-label" style="margin-bottom: 0;">जनपद का नाम <span class="text-danger">*</span></label>
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
                                    <a class="btn btn-primary btn-sm" href="{{url('admin/information/khelo_india_yojana')}}"><i class="fas fa-refresh"></i></a>
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
                                                    बिन्दु-02
                                                </h2>
                                                <h2 style="text-align: center; margin:0px 0px 0px 0px; font-size:14pt; padding: 0px; color:#383838; font-weight: bold;">
                                                    खेलो इण्डिया योजनान्तर्गत स्वीकृत कार्यों की स्थिति
                                                </h2>
                                            </div>
                                        </th>
                                    </tr>
                                    <tr>
                                        <th style="font-size: 10pt; text-align: left;">
                                            <b>Year :</b> {{request()->input('year') ? request()->input('year'):date("Y")}} @if(request()->input('month')), <b>Month :</b> {{month_name(request()->input('month'))}} @endif
                                        </th>
                                        <th style="font-size: 10pt; text-align:right">
                                            <strong>Report Period : </strong> {{first_insert('information_khelo_india_yojana','created_on')}} to {{date("d-m-Y")}}
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td colspan="2">
                                            <div class="table-responsive">
                                                <table class="table table-bordered table-hover bg-white datatable mb-3" id="dataTable" cellpadding="3">
                                                    <thead>
                                                        <tr>
                                                            <th rowspan="2"> क्र. सं.</th>
                                                            <th rowspan="2">माह</th>
                                                            <th rowspan="2">वर्ष</th>
                                                            <th rowspan="2">मण्डल का नाम</th>
                                                            <th rowspan="2"> जनपद का नाम</th>
                                                            <th rowspan="2">कार्य का नाम</th>
                                                            <th rowspan="2">कार्यदायी संस्था का नाम</th>
                                                            <th rowspan="2">स्वीकृत लागत</th>
                                                            <th rowspan="2">तिथि एवं अवमुक्त धनराशि </th>
                                                            <th rowspan="2">अवशेष देय धनराशि</th>
                                                            <th rowspan="2">कार्य प्रारम्भ होने की तिथि</th>
                                                            <th rowspan="2">कार्य पूर्ण होने की लक्ष्य तिथि</th>
                                                            <th colspan="2" style="text-align:center;">वर्तमान में उपलब्ध करायी गयी प्रगति</th>
                                                            <th rowspan="2">अभ्युक्ति</th>
                                                            <th rowspan="2" class="noprint">Action</th>
                                                        </tr>
                                                        <tr>
                                                            <th>भौतिक प्रगति</th>
                                                            <th>वित्तीय प्रगति</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        @foreach($khelo_india_data as $key=>$item)
                                                        <tr>
                                                            <td>{{$key+1}}</td>
                                                            <td>{{month_name($item->month)}}</td>
                                                            <td>{{$item->year}}</td>
                                                            <td>
                                                                <?php $division_id = DB::table('hostel_div_district_mapping')->where('district_id', $item->district_id)->first(); ?>
                                                                @if($division_id)
                                                                {{divisionName($division_id->division_id)}}
                                                                @else
                                                                NA
                                                                @endif
                                                            </td>
                                                            <td>{{districtName($item->district_id)}}</td>
                                                            <td>{{$item->yojna_name}}</td>
                                                            <td>{{$item->name_of_executing_agency}}</td>
                                                            <td>{{$item->approval_amount}}</td>
                                                            <td>@if($item->date_of_unreleased_amount){{dmy($item->date_of_unreleased_amount)}} @else NA @endif,<br>{{$item->unreleased_amount}}</td>
                                                            <td>{{$item->residual_due_amount}}</td>
                                                            <td>
                                                                @if($item->date_of_yojna_start)
                                                                {{dmy($item->date_of_yojna_start)}}
                                                                @else
                                                               NA
                                                                @endif
                                                            </td>
                                                            <td>
                                                                @if($item->date_of_yojna_complete)
                                                                {{dmy($item->date_of_yojna_complete)}}
                                                                @else
                                                                NA
                                                                @endif
                                                            </td>
                                                            <td>{{$item->material_progress}}</td>
                                                            <td>{{$item->financial_progress}}</td>
                                                            <td>{{$item->comment}}</td>
                                                            <td class="text-center noprint">
                                                                <a class="btn btn-sm btn-dark pointer bt" href="{{ route('khelo_india_yojana' , $item->id) }}">
                                                                <i class="fa fa-edit"></i>
                                                            </a>
                                                            
                                                                <a class="btn btn-sm btn-danger pointer bt" href="{{ route('delete_inf' , [$item->id,'information_khelo_india_yojana']) }}" onclick="return confirm('Are you sure you want to delete ?')">
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
