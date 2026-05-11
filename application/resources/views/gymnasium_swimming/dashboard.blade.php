@extends( 'layouts\gymnasium_swimming_dashboard' )
@section('content')
<style>
   #dash_submit_status_2 {
    display: none !important;
}
</style>
<div class="container-fluid pagecontentbody">
    <div class="tab-content">
        <div class="pagebody removebg-color">
            <div class="col-md-12 pageheader pb-2">
                <div class="row">
                    <div class="col-md-10">
                        <h4 class="mb-0">Dashboard</h4>
                    </div>
                    <div class="col-md-2 d-grid">
                        <a class="btn btn-outline-danger btn-sm  rounded-pill" href="{{ route('gymnasium_swimming_applicationpreview') }}"><i class="fa fa-plus"></i>&nbsp;&nbsp; Application Preview</a>
                    </div>
                </div>
            </div>

            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-11">
                            <h5>Applicant Details</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    <table class="table table-bordred table-hover bg-white">
                        <thead>
                            <tr>
                                <th>S.No.</th>
                                <th>Application No.</th>
                                <th>Applicant Name</th>
                                <th>District</th>
                                <th>Vehicle Number</th>
                                <th>Applied for</th>
                                <th>Form Submission Date</th>
                                <th class="text-center" style="width:10%;">Query Status</th>
                                <th class="text-center" style="width:10%;">Status</th>
                                <th class="text-center" style="width:10%;">Application Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td>@if (Auth::guard('GymnasiumSwimming')->user()->application_no)
                                    {{ Auth::guard('GymnasiumSwimming')->user()->application_no }}
                                @else
                                    NA
                                @endif</td>
                                <td>{{ Auth::guard('GymnasiumSwimming')->user()->name}}</td>
                                <td>{{ districtName($applicationview->district_id) }}</td>
                                <td>@if ($applicationview->vehicle_no)
                                    {{ $applicationview->vehicle_no }}@else
                                    NA
                               @endif</td>
                                <td>@if (Auth::guard('GymnasiumSwimming')->user()->type == 1) Gymnasium @else Swimming Pool @endif</td>
                                <td>{{ dmy( Auth::guard('GymnasiumSwimming')->user()->final_submit_date) }}</td>
                                <td class="text-center">
                                    <span class="badge bg-success rounded-pill">Marked</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-success rounded-pill">Submitted successfully</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-info text-white rounded-pill ">RSO Pending</span>
                                </td>
                            </tr>
                            {{-- <tr>
                                <td>2</td>
                                <td>SG001</td>
                                <td>Avinash Verma</td>
                                <td>Lucknow</td>
                                <td>UP32 0000000</td>
                                <td>Gymnasium</td>
                                <td>25/07/2023</td>
                                <td class="text-center">
                                    <span class="badge bg-danger rounded-pill">Not Marked</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-danger rounded-pill"> Incomplete Form</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-primary text-white rounded-pill">Directorate Pending</span>
                                </td>
                            </tr>
                            <tr>
                                <td>3</td>
                                <td>SG001</td>
                                <td>Avinash Verma</td>
                                <td>Lucknow</td>
                                <td>UP32 0000000</td>
                                <td>Swimming Pool</td>
                                <td>25/07/2023</td>
                                <td class="text-center">
                                    <span class="badge bg-warning text-white rounded-pill">Replied</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-danger rounded-pill"> Incomplete Form</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-success rounded-pill">Accepted Successfully</span>
                                </td>
                            </tr>
                            <tr>
                                <td>4</td>
                                <td>SG001</td>
                                <td>Avinash Verma</td>
                                <td>Lucknow</td>
                                <td>UP32 0000000</td>
                                <td>Gymnasium</td>
                                <td>25/07/2023</td>
                                <td class="text-center">
                                    <span class="badge bg-info text-white rounded-pill ">Pending</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-success rounded-pill">Submitted successfully</span>
                                </td>
                                <td class="text-center">
                                    <span class="badge bg-info text-white rounded-pill ">RSO Pending</span>
                                </td>
                            </tr> --}}
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="paymentnote" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Payment Note</h5>
                <!--<button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>-->
            </div>
            <div class="modal-body">
                <h3 class="text-center">Registration Fees - <span class="text-success"><i class="fa fa-rupee-sign"></i>5500.00</span></h3>
            </div>
            <div class="modal-footer">
                <!--<button type="button" class="btn btn btn-outline-danger"><span class="icons icon-cloud-download"></span> Download</button>-->
                <button type="button" class="btn btn-outline-danger rounded-pill" data-bs-dismiss="modal">Proceed To Pay</button>
            </div>
        </div>
    </div>
</div>
<script>
    function showMe(e) {
        var t = e.value;
        e.value = t.indexOf(".") >= 0 ? t.slice(0, t.indexOf(".") + 2) : t;
    }


    function PrintDoc() {
        // $('#dataTable_player').DataTable().destroy();
        var toPrint = document.getElementById('player_prodiv');
        //alert(toPrint);
        var popupWin = window.open('', '_blank', 'left=100,top=100,width=1100,height=600,tollbar=0,scrollbars=1,status=0,resizable=1');
        popupWin.document.open();
        popupWin.document.write('<html><title>::Preview::</title><head><style>body{font-family:Arial} .noprint{display: none;} table{width:100%; border-collapse:collapse;} .table tr th, .table tr td{border:1px solid #000; padding:3px 5px; font-size: 12px; text-align: left;} th.table-warning{background-color: #dbdbdb;} .table-warning h3{margin: 0;}</style></head><body onload="window.print()">')
        popupWin.document.write(toPrint.innerHTML);
        popupWin.document.write('</body></html>');
        popupWin.document.close();
        // $('#dataTable_player').DataTable();
    }
</script>
<script type="text/javascript" src="{{ asset('js/xlsx.full.min.js') }}"></script>

<script>
    function ExportToExcel(type, fn, dl) {
        var elt = document.getElementById('dataTable_player_dashboard');
        var wb = XLSX.utils.table_to_book(elt, {
            sheet: "sheet1"
        });
        return dl ?
            XLSX.write(wb, {
                bookType: type,
                bookSST: true,
                type: 'base64'
            }) :
            XLSX.writeFile(wb, fn || ('Applicant Report.' + (type || 'xlsx')));
    }
</script>

@endsection
@push('custom-scripts')
