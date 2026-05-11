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
                <button onclick="PrintExce('Rajasv Praptiya')" class="btn btn btn-outline-primary float-end">Excel</button>
            </h4>
        </div>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                @if(Auth::guard('admin')->user()->admin_role != 1)
                <form id="reload_two" action="{{url('admin/information/rajasv_praptiya')}}" class="needs-validation" novalidate method="post" autocomplete="off">
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
                                        <label class="placeholder">जनपद का नाम <span class="text-danger">*</span></label>
                                        <select class="form-select" name="district_id" required>
                                            <option value="">--All--</option>
                                            @foreach ($districts as $item)
                                            <option value="{{$item->id}}" @if(isset($ed_data->district_id) && ($ed_data->district_id==$item->id)) selected @endif>{{$item->city}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                @if(isset($ed_data->id))
                                <input type="hidden" value="{{$ed_data->id}}" name="id">
                                @endif
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="placeholder">प्रशिक्षण <span class="text-danger">*</span></label>
                                        <input type="text" required name="prasikshan" @if(isset($ed_data->prasikshan) ) value="{{$ed_data->prasikshan}}" @endif class="form-control total_rajsv_get" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/(\.\d{2}).+/g, '$1');">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="placeholder">आरक्षण <span class="text-danger">*</span></label>
                                        <input type="text" required name="aarakshan" @if(isset($ed_data->aarakshan) ) value="{{$ed_data->aarakshan}}" @endif class="form-control total_rajsv_get" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/(\.\d{2}).+/g, '$1');">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="placeholder"> छात्रावास <span class="text-danger">*</span></label>
                                        <input type="text" required name="chatravas" @if(isset($ed_data->chatravas) ) value="{{$ed_data->chatravas}}" @endif class="form-control total_rajsv_get" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/(\.\d{2}).+/g, '$1');">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="placeholder">शौकिया <span class="text-danger">*</span></label>
                                        <input type="text" required name="shokiya" @if(isset($ed_data->shokiya) ) value="{{$ed_data->shokiya}}" @endif class="form-control total_rajsv_get" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/(\.\d{2}).+/g, '$1');">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="placeholder">तरणताल <span class="text-danger">*</span></label>
                                        <input type="text" required name="tarantal" @if(isset($ed_data->tarantal) ) value="{{$ed_data->tarantal}}" @endif class="form-control total_rajsv_get" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/(\.\d{2}).+/g, '$1');">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="placeholder">अन्य प्राप्तियां <span class="text-danger">*</span></label>
                                        <input type="text" required name="any_praptiya" @if(isset($ed_data->any_praptiya) ) value="{{$ed_data->any_praptiya}}" @endif class="form-control total_rajsv_get" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/(\.\d{2}).+/g, '$1');">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="placeholder"> माह में राजस्व प्राप्तियां <span class="text-danger">*</span></label>
                                        <input type="text" required name="mah_me_rajasv_praptiya" @if(isset($ed_data->mah_me_rajasv_praptiya) ) value="{{$ed_data->mah_me_rajasv_praptiya}}" @endif class="form-control" id="total_rajsv" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/(\.\d{2}).+/g, '$1');" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="placeholder"> पिछला योग <span class="text-danger">*</span></label>
                                        <input type="text" required name="pichala_yog" @if(isset($ed_data->pichala_yog) ) value="{{$ed_data->pichala_yog}}" @endif class="form-control" id="old_total" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/(\.\d{2}).+/g, '$1');">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="placeholder"> वर्ष का प्रगामी योग <span class="text-danger">*</span></label>
                                        <input type="text" required name="varsh_ka_pragami_yog" @if(isset($ed_data->varsh_ka_pragami_yog) ) value="{{$ed_data->varsh_ka_pragami_yog}}" @endif class="form-control" id="vigat_current_total" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/(\.\d{2}).+/g, '$1');" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="placeholder"> विगत वर्ष इसी माह तक योग <span class="text-danger">*</span></label>
                                        <input type="text" required name="vigat_varsh_isi_mah_tak" @if(isset($ed_data->vigat_varsh_isi_mah_tak) ) value="{{$ed_data->vigat_varsh_isi_mah_tak}}" @endif class="form-control" id="current_total" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/(\.\d{2}).+/g, '$1');">
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="placeholder"> वृद्धि <span class="text-danger">*</span></label>
                                        <input type="text" required name="increment" @if(isset($ed_data->increment) ) value="{{$ed_data->increment}}" @endif class="form-control" id="total_increment" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/(\.\d{2}).+/g, '$1');" readonly>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label class="placeholder"> कमी <span class="text-danger">*</span></label>
                                        <input type="text" required name="decrement" @if(isset($ed_data->decrement) ) value="{{$ed_data->decrement}}" @endif class="form-control" id="total_decrement" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*?)\..*/g, '$1').replace(/(\.\d{2}).+/g, '$1');" readonly>
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
                    <form action="{{ asset('assets_admin/information/rajasv_praptiya') }}" class="needs-validation" method="get" novalidate
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
                                    <a class="btn btn-primary btn-sm" href="{{url('admin/information/rajasv_praptiya')}}"><i class="fas fa-refresh"></i></a>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
                <div class="col-md-12">
                    <div class="table-responsive" id="prodiv">
                        <table border="0" cellspacing="0" cellpadding="4" width="100%" style="border-collapse:collapse;">
                            <thead class="dn">
                                <tr>
                                    <th colspan="2">
                                        <div style="padding: 0 15px 3px; margin-bottom: 10px; border-bottom: 0px solid #000; position: relative;">
                                            <h2 style="text-align: center; margin:0px 0px 15px 0px; font-size:14pt; padding: 0px; color:#383838; font-weight: bold;">
                                                बिन्दु-03
                                            </h2>
                                            <h2 style="text-align: center; margin:0px 0px 0px 0px; font-size:14pt; padding: 0px; color:#383838; font-weight: bold;">
                                                राजस्व प्राप्तियां
                                            </h2>
                                        </div>
                                    </th>
                                </tr>
                                <tr>
                                    <th style="font-size: 10pt; text-align: left;">
                                        <b>Year :</b> {{request()->input('year') ? request()->input('year'):date("Y")}} @if(request()->input('month')), <b>Month :</b> {{month_name(request()->input('month'))}} @endif
                                    </th>
                                    <th style="font-size: 10pt; text-align:right">
                                        <strong>Report Period : </strong> {{first_insert('information_rajasv_praptiya','created_at')}} to {{date("d-m-Y")}}
                                    </th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="2">
                                        <div class="table-responsive">
                                            <table class="table table-bordered table-hover bg-white mb-3"  id="dataTable" cellpadding="3">
                                                <thead>
                                                    <tr>
                                                        <th>क्र.सं.</th>
                                                        <th>मण्डल का नाम</th>
                                                        <th>जनपद का नाम</th>
                                                        <th>माह</th>
                                                        <th>वर्ष</th>
                                                        <th>प्रशिक्षण</th>
                                                        <th>आरक्षण</th>
                                                        <th>छात्रावास</th>
                                                        <th>शौकिया</th>
                                                        <th>तरणताल</th>
                                                        <th>अन्य प्राप्तियां</th>
                                                        <th>माह में राजस्व प्राप्तियां</th>
                                                        <th>पिछला योग</th>
                                                        <th>वर्ष का प्रगामी योग</th>
                                                        <th>विगत वर्ष इसी माह तक योग</th>
                                                        <th>वृद्धि</th>
                                                        <th>कमी</th>
                                                        <th class="noprint">जमा करने की तिथि</th>
                                                        <th class="noprint">Action</th>
                                                    </tr>

                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $t_prasikshan = 0;
                                                    $t_aarakshan = 0;
                                                    $t_chatravas = 0;
                                                    $t_shokiya = 0;
                                                    $t_tarantal = 0;
                                                    $t_any_praptiya = 0;
                                                    $t_mah_me_rajasv_praptiya = 0;
                                                    $t_pichala_yog = 0;
                                                    $t_varsh_ka_pragami_yog = 0;
                                                    $t_vigat_varsh_isi_mah_tak = 0;
                                                    $t_increment = 0;
                                                    $t_decrement = 0;
                                                    ?>
                                                    @foreach($rajasv_praptiya as $key=>$item)
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
                                                        <td>
                                                            <?php $t_prasikshan += $item->prasikshan ?>
                                                            {{$item->prasikshan}}
                                                        </td>
                                                        <td>
                                                            <?php $t_aarakshan += $item->aarakshan ?>
                                                            {{$item->aarakshan}}
                                                        </td>
                                                        <td>
                                                            <?php $t_chatravas += $item->chatravas ?>
                                                            {{$item->chatravas}}
                                                        </td>
                                                        <td>
                                                            <?php $t_shokiya += $item->shokiya ?>
                                                            {{$item->shokiya}}
                                                        </td>
                                                        <td>
                                                            <?php $t_tarantal += $item->tarantal ?>
                                                            {{$item->tarantal}}
                                                        </td>
                                                        <td>
                                                            <?php $t_any_praptiya += $item->any_praptiya ?>
                                                            {{$item->any_praptiya}}
                                                        </td>
                                                        <td>
                                                            <?php $t_mah_me_rajasv_praptiya += $item->mah_me_rajasv_praptiya ?>
                                                            {{$item->mah_me_rajasv_praptiya}}
                                                        </td>
                                                        <td>
                                                            <?php $t_pichala_yog += $item->pichala_yog ?>
                                                            {{$item->pichala_yog}}
                                                        </td>
                                                        <td>
                                                            <?php $t_varsh_ka_pragami_yog += $item->varsh_ka_pragami_yog ?>
                                                            {{$item->varsh_ka_pragami_yog}}
                                                        </td>
                                                        <td>
                                                            <?php $t_vigat_varsh_isi_mah_tak += $item->vigat_varsh_isi_mah_tak ?>
                                                            {{$item->vigat_varsh_isi_mah_tak}}
                                                        </td>
                                                        <td>
                                                            <?php $t_increment += $item->increment ?>
                                                            {{$item->increment}}
                                                        </td>
                                                        <td>
                                                            <?php $t_decrement += $item->decrement ?>
                                                            {{$item->decrement}}
                                                        </td>
                                                        <td class="noprint">{{ date('d-m-Y', strtotime(isset($item->created_at))) ? date('d-m-Y', strtotime($item->created_at)) : '-' }}
                                                        </td>
                                                        <td class="text-center noprint">
                                                            <a class="btn btn-sm btn-dark pointer bt" href="{{ route('rajasv_praptiya' , $item->id) }}">
                                                            <i class="fa fa-edit"></i>
                                                        </a>
                                                        
                                                            <a class="btn btn-sm btn-danger pointer bt" href="{{ route('delete_inf' , [$item->id,'information_rajasv_praptiya']) }}" onclick="return confirm('Are you sure you want to delete ?')">
                                                            <i class="fa fa-trash"></i>
                                                        </a>
                                                        
                                                        </td>
                                                    </tr>
                                                    @endforeach
                                                </tbody>
                                                    <tr>
                                                        <td>&nbsp;</td>
                                                        <td colspan="4" align="center"><b>कुल योग:- </b></td>
                                                        <td><b>{{$t_prasikshan}}</b></td>
                                                        <td><b>{{$t_aarakshan}}</b></td>
                                                        <td><b>{{$t_chatravas}}</b></td>
                                                        <td><b>{{$t_shokiya}}</b></td>
                                                        <td><b>{{$t_tarantal}}</b></td>
                                                        <td><b>{{$t_any_praptiya}}</b></td>
                                                        <td><b>{{$t_mah_me_rajasv_praptiya}}</b></td>
                                                        <td><b>{{$t_pichala_yog}}</b></td>
                                                        <td><b>{{$t_varsh_ka_pragami_yog}}</b></td>
                                                        <td><b>{{$t_vigat_varsh_isi_mah_tak}}</b></td>
                                                        <td><b>{{$t_increment}}</b></td>
                                                        <td><b>{{$t_decrement}}</b></td>
                                                        
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
    $(document.body).on('blur', '.total_rajsv_get, #old_total, #current_total', function() {
        var total = 0;
        //   console.log('hello')
        $('.total_rajsv_get').each(function(index, value) {
            var item = $(this);
            if (item.val() != '') {
                total = parseInt(total) + parseInt(item.val());
                $('#total_rajsv').val(total);
            }
        });
        if (total == 0) {
            $('#total_rajsv').val(0);
        }
        $('#vigat_current_total').val(total + parseInt($('#old_total').val()));
        if ((total + parseInt($('#old_total').val()) - parseInt($('#current_total').val())) > 0) {
            console.log((total + parseInt($('#old_total').val()) - parseInt($('#current_total').val())))
            $('#total_increment').val((total + parseInt($('#old_total').val()) - parseInt($('#current_total').val())));
            $('#total_decrement').val(0);
        } else {
            $('#total_increment').val(0);
            $('#total_decrement').val(parseInt($('#current_total').val()) - (total + parseInt($('#old_total').val())));
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
