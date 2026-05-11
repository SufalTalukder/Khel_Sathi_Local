@extends( 'layouts\player_layout_dashboard' )
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
                        <a class="btn btn-outline-danger btn-sm  rounded-pill" href="{{ route('playerapplicationpreview') }}"><i class="fa fa-plus"></i>&nbsp;&nbsp; Application Preview</a>
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
                                <th>Date of Birth</th>
                                <th>Applied for Sport</th>
                                <th>Form Submission Date</th>
                                <th>Status</th>
                                <!--<th style="width:25%;">Remarks</th>
                                <th>Allotment Status</th>-->
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>1</td>
                                <td> @if (Auth::guard('player')->user()->application_no)
                                    {{ Auth::guard('player')->user()->application_no }}
                                @else
                                    NA
                                @endif</td>
                                <td>{{ Auth::guard('player')->user()->name }}</td>
                                <td>{{ districtName($player_applicationview->district_id) }}</td>
                                <td>{{ dmy( Auth::guard('player')->user()->dob) }}</td>
                                <td>{{sport_name($player_applicationview->sport_id)}}</td>
                                <td>@if (Auth::guard('player')->user()->final_submit_date)
                                    {{ dmy( Auth::guard('player')->user()->final_submit_date) }}
                                @else
                                    NA
                                @endif</td>
                                <td>
                                @if (Auth::guard('player')->user()->application_status == 2)
                                <span class="badge bg-danger rounded-pill">Rejected</span>
                                @elseif (Auth::guard('player')->user()->application_status == 3)
                                <span class="badge bg-primary text-white rounded-pill"> Accepted</span> @else

                                <span class="badge bg-warning text-white rounded-pill">Pending</span> @endif
                            </td>
                                <!--<td class="text-center">
                                    <span class="badge bg-success rounded-pill">Accepted</span>
                                    <span class="badge bg-danger rounded-pill">Rejected</span>
                                    <span class="badge bg-warning text-white rounded-pill">Pending</span>
                                    <span class="badge bg-info text-white rounded-pill ">Not Yet Submitted</span>
                                    <span class="badge bg-primary text-white rounded-pill">Provisionally accepted</span>
                                </td>
                                <td class="text-center">
                                    <a class="btn btn-outline-danger btn-sm  rounded-pill" href="ApplicationPreview.html"><i class="fa fa-eye"></i></a>
                                    <a class="btn btn-outline-success btn-sm  rounded-pill" href=""><i class="fa fa-edit"></i></a>
                                </td>-->
                            </tr>
                            <!--<tr>
                                <td>2</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>Not allotted due to low merit</td>
                                <td><strong class="btn btn-danger btn-xs disabled btn-block">Not Alloted</strong></td>
                                <td class="text-center"><a class="btn btn-outline-danger btn-sm  rounded-pill" href="ApplicationPreview.html"><i class="fa fa-eye"></i></a></td>
                            </tr>-->
                            <!--<tr>
                                <td>3</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td>-</td>
                                <td><strong class="btn btn-primary btn-xs disabled btn-block">Pendding</strong></td>
                                <td class="text-center"><a class="btn btn-outline-danger btn-sm  rounded-pill" href="ApplicationPreview.html"><i class="fa fa-eye"></i></a></td>
                            </tr>-->
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
{{-- 
<div class="container-fluid pagecontentbody">
    <div class="tab-content">
        <div class="pagebody removebg-color">
            <div class="col-md-12 pageheader pb-2">
                <div class="row">
                    <div class="col-md-10">
                        <h4 class="mb-0">Dashboard</h4>
                    </div>
                   <?php
                  //dd($check_applicant->submit_status);
                   if(!empty($check_register)){
                     if($check_register->status_preview == 1|| $check_register->change_password_status == 1){ ?>
                        <div class="col-md-2 d-grid" id="dash_submit_status_<?php if(!empty($check_applicant)){echo $check_applicant->submit_status;}else{ echo '1'; } ?>">
                            <a class="btn btn-outline-danger btn-sm  rounded-pill" href="{{route('playerapplication')}}"><i class="fa fa-plus"></i>&nbsp;&nbsp; Application Form</a>
                        </div>
                    <?php } ?>
                    <?php } ?>
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
                <div class="card-body" id="player_prodiv">
                    <?php if (!empty($check_applicant)) { ?>
                        <table id="dataTable_player_dashboard" class="table table-bordred table-hover bg-white">
                            <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Application No.</th>
                                    <th>Applicant Name</th>
                                    <th>Date of Birth</th>
                                    <th>Applied for Sport</th>
                                    <th>District</th>
                                    <th>Form Submission Date</th>
                                    <th>View</th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td>1</td>
                                    <td>{{$check_applicant->player_application_no}}</td>
                                    <?php //dd(Auth::guard('player')->user()->dob);
                                    ?>
                                    <td><?php echo ucfirst(Auth::guard('player')->user()->name); ?></td>
                                    <td>
                                        {{dmy(Auth::guard('player')->user()->dob)}}
                                    </td>

                                    <td>{{!empty(sport_name($check_applicant->sports_type)) ? sport_name($check_applicant->sports_type) : 'N/A' }}</td>
                                    <td>{{!empty(districtName($check_applicant->district_id)) ? districtName($check_applicant->district_id) : 'N/A' }}</td>
                                    <td><?php echo date("d-m-Y", strtotime($check_applicant->final_submission_date)); ?></td>
                                    <td><a href="{{route('playerapplicationpreview')}}"><i class="fa fa-eye"></i></a></td>
                                </tr>


                            <?php } else { ?>
                                <div class="test-player-preview">
                                    <p>No data available...</p>
                                </div>
                            <?php } ?>
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
</div> --}}


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
            XLSX.writeFile(wb, fn || ('Player Applicant Report.' + (type || 'xlsx')));
    }
</script>

@endsection
@push('custom-scripts')
