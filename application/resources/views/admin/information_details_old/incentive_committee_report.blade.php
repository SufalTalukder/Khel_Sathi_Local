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
<div class="row">
    <div class="col-12">
        <div class="pageheader" id="menu-margin">
            <h4 class="mb-0">
                प्रोत्साहन समिति प्रपत्र
                <a title="Print" class="btn btn btn-outline-success float-end" data-print="modal" onclick="PrintDoc()"><i class="icons icon-printer"></i> प्रिंट</a>
            </h4>
        </div>
    </div>
    <div class="col-12">
        <div class="card">
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12">
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
                                                प्रोत्साहन समिति प्रपत्र
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <table class="table table-bordered table-hover bg-white datatable mb-3" id="dataTable">
                                <thead>
                                    <tr>
                                        <th rowspan="2"><strong>क्र.सं.</strong></th>
                                        <th rowspan="2"><strong>मण्डल</strong><strong> का नाम</strong></th>
                                        <th rowspan="2"><strong>जिला </strong><strong> का नाम</strong></th>
                                        <th rowspan="2"><strong>तहसील</strong><strong> का नाम</strong></th>
                                        <th colspan="3" class="text-center"><strong>समिति के गठन/बैठक का दिनाँक</strong></th>
                                        <th colspan="3" class="text-center"><strong>समिति के रजिस्ट्रेशन/नवीनीकरण की संख्या/दिनाँक</strong></th>
                                        <th colspan="4" class="text-center"><strong>बैंक खाता का पूर्ण विवरण</strong></th>
                                    </tr>
                                    <tr>
                                        <th>
                                            <p align="center"><strong>मण्डल</strong> <strong>स्तर</strong></p>
                                        </th>
                                        <th>
                                            <p align="center"><strong>जिला </strong><strong>स्तर</strong></p>
                                        </th>
                                        <th>
                                            <p align="center"><strong>तहसील </strong><strong>स्तर</strong></p>
                                        </th>
                                        <th><strong>मण्डल</strong> <strong>स्तर</strong></th>
                                        <th><strong>जिला </strong><strong>स्तर</strong></th>
                                        <th>
                                            <p align="center"><strong>तहसील </strong></p>
                                            <strong>स्तर</strong>
                                        </th>
                                        <th><strong>मण्डल</strong> <strong>स्तर</strong></th>
                                        <th><strong>जिला </strong><strong>स्तर</strong></th>
                                        <th>
                                            <p align="center"><strong>तहसील </strong></p>
                                            <strong>स्तर</strong>
                                        </th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($incentiveCommittee as $key=>$item)
                                    <tr>
                                        <td>{{ $key+1 }}</td>
                                        <?php if ($item->status == 0) { ?>
                                            <td>{{!empty(divisionName($item->division_id)) ? divisionName($item->division_id) : '-' }}</td>
                                            <td>-</td>
                                            <td>-</td>
                                            <td class="nowraptd">{{ !empty(date('d-m-Y', strtotime($item->date_of_committee_formation ))) ? date('d-m-Y', strtotime($item->date_of_committee_formation )): '-'}}</td>
                                            <td>-</td>
                                            <td>-</td>
                                            <td class="nowraptd">{{ date('d-m-Y', strtotime($item->date_of_registration_renewal_committee)) }}</td>
                                            <td>-</td>
                                            <td>-</td>
                                            <td><b>Bank Name: </b>{{isset($item->bank_name) ? $item->bank_name : '-' }}<br><b>Branch: </b>{{isset($item->branch_name) ? $item->branch_name : '-' }}<br><b>A/C Holder: </b>{{isset($item->account_holder_name) ? $item->account_holder_name : '-' }}</td>
                                            <td>-</td>
                                            <td>-</td>
                                        <?php } ?>
                                        <?php if ($item->status == 1) { ?>
                                            <td>-</td>
                                            <td>{{!empty(districtName($item->district_id)) ? districtName($item->district_id) : '-' }}</td>
                                            <td>-</td>
                                            <td>-</td>
                                            <td class="nowraptd">{{ !empty(date('d-m-Y', strtotime($item->date_of_committee_formation ))) ? date('d-m-Y', strtotime($item->date_of_committee_formation )): '-'}}</td>
                                            <td>-</td>
                                            <td>-</td>
                                            <td class="nowraptd">{{ date('d-m-Y', strtotime($item->date_of_registration_renewal_committee)) }}</td>
                                            <td>-</td>
                                            <td>-</td>
                                            <td><b>Bank Name: </b>{{isset($item->bank_name) ? $item->bank_name : '-' }}<br><b>Branch: </b>{{isset($item->branch_name) ? $item->branch_name : '-' }}<br><b>A/C Holder: </b>{{isset($item->account_holder_name) ? $item->account_holder_name : '-' }}</td>
                                            <td>-</td>
                                        <?php } ?>
                                        <?php if ($item->status == 2) { ?>
                                            <td>-</td>
                                            <td>-</td>
                                            <td>{{!empty(tehsiltName($item->tehsil_id)) ? tehsiltName($item->tehsil_id) : '-' }}</td>
                                            <td>-</td>
                                            <td>-</td>
                                            <td class="nowraptd">{{ !empty(date('d-m-Y', strtotime($item->date_of_committee_formation ))) ? date('d-m-Y', strtotime($item->date_of_committee_formation )): '-'}}</td>
                                            <td>-</td>
                                            <td>-</td>
                                            <td class="nowraptd">{{ date('d-m-Y', strtotime($item->date_of_registration_renewal_committee)) }}</td>
                                            <td>-</td>
                                            <td>-</td>
                                            <td><b>Bank Name: </b>{{isset($item->bank_name) ? $item->bank_name : '-' }}<br><b>Branch: </b>{{isset($item->branch_name) ? $item->branch_name : '-' }}<br><b>A/C Holder: </b>{{isset($item->account_holder_name) ? $item->account_holder_name : '-' }}</td>
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
            XLSX.writeFile(wb, fn || ('Incentive Committee List.' + (type || 'xlsx')));
    }
</script>

@endpush
