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
                <!-- <a title=" Monthly Information Form Details ExportToExcel" class="btn btn-sm btn-success float-end" onclick="ExportToExcel('xlsx')">
                            <i class="fa fa-file-excel"></i>Export to Excel
                        </a> -->
                <a title="Print" class="btn btn btn-outline-success float-end" data-print="modal" onclick="PrintDoc()"><i class="icons icon-printer"></i> प्रिंट</a>
            </h4>
            <form method="POST" action="{{url('admin/information/monthly_list_filter')}}">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="division_filter">मण्डल</label>
                            <select class="form-select" name="division_id">
                                <option value="">--All--</option>
                                @foreach ($division_list as $item)
                                <option value="{{$item->id}}" {{request()->input('id') == $item->id ? 'selected' : ''}}>{{$item->division_name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="city_filter">जनपद</label>
                            <select class="form-select" name="district_id">
                                <option value="">--All--</option>
                                @foreach ($districts_list as $item)
                                <option value="{{$item->id}}" {{request()->input('district_id') == $item->id ? 'selected' : ''}}>{{$item->city}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="city_filter">तहसील</label>
                            <select class="form-select" name="tehsil_id">
                                <option value="">--All--</option>
                                @foreach ($tehsils_list as $item)
                                <option value="{{$item->id}}" {{request()->input('id') == $item->id ? 'selected' : ''}}>{{$item->Tehsil_Name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group d-grid">
                                    <label for="reset">&nbsp;</label>
                                    <button type="submit" class="btn btn-primary">
                                        Submit
                                    </button>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group d-grid">
                                    <label for="reset">&nbsp;</label>
                                    <a href="{{url('admin/information/sports_infrastructure')}}" class="btn btn-danger">
                                        Reset
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            </form>
        </div>
    </div>
    <div class="col-12">
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
            <table class="table table-bordered table-hover bg-white datatable mb-3" id="dataTable">
                <thead>
                    <tr>
                        <th><strong>क्र.सं.</strong></th>
                        <th>मण्डल का नाम</th>
                        <th><strong>जनपद का नाम</strong></th>
                        <th>
                            <p align="center"><strong>तहसील </strong><strong>का नाम</strong></p>
                        </th>
                        <th><strong>वित्तीय वर्ष का प्रारंभिक अवशेष</strong></th>
                        <th><strong>वर्तमान माह में प्राप्त धनराशि</strong></th>
                        <th><strong>वर्तमान माह में व्यय धनराशि</strong></th>
                        <th><strong>वर्तमान माह तक कुल अवशेष जमा धनराशि</strong></th>
                        <th><strong>वर्तमान माह तक कुल प्राप्त धनराशि</strong></th>
                        <th><strong>गत वर्ष इसी माह तक कुल प्राप्त धनराशि</strong></th>
                        <th><strong>वृद्धि</strong></th>
                        <th><strong>कमी</strong></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($monthlyInformation as $key=>$item)
                    <tr>
                        <td>{{$key+1}}</td>
                        <?php if ($item->status == 0) { ?>
                            <td>{{!empty(divisionName($item->division_id)) ? divisionName($item->division_id) : '-' }}</td>
                            <td>-</td>
                            <td>-</td>
                        <?php } ?>
                        <?php if ($item->status == 1) { ?>
                            <td>-</td>
                            <td>{{!empty(districtName($item->district_id)) ? districtName($item->district_id) : '-' }} </td>
                            <td>-</td>
                        <?php } ?>
                        <?php if ($item->status == 2) { ?>
                            <td>-</td>
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

@endsection

@push( 'custom-scripts' )

<script>
    function PrintDoc() {
        $('#dataTable').DataTable().destroy();
        var toPrint = document.getElementById('prodiv');

        var popupWin = window.open('', '_blank', 'left=100,top=100,width=1100,height=600,tollbar=0,scrollbars=1,status=0,resizable=1');

        popupWin.document.open();

        popupWin.document.write('<html><title>::Preview::</title><head><meta charset="UTF-8"><style>body{font-family:Arial,sans-serif} .noprint{display: none;} table{width:100%; border-collapse:collapse;} .table tr th, .table tr td{border:1px solid #000; padding:3px 5px; font-size: 12px;} .table > thead > tr > th{background-color: #eee;}</style></head><body onload="window.print()">')

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
