@extends( 'layouts/admin_layout' )
@section( 'content' )

<style>
    .nowraptd {
        white-space: nowrap;
    }
    .dn{display: none;}
</style>

<div class="container-fluid pagecontentbody">
    <div class="tab-content">
        <div class="pagebody removebg-color">
            <div class="col-md-12 pageheader pb-2">
                <div class="row">
                    <div class="col-md-10">
                        <h4 class="mb-0">Coaching Camp</h4>
                    </div>
                    <div class="col-md-2 d-grid">

                    </div>
                </div>
            </div>
            <div class="card">
            <div class="card-body">
            <div class="mb-4">
                <form class="row" method="post" action="{{ route('coaching_camp_list') }}">
                    @csrf
                   <?php //dd($districts); ?>
                    <div class="col-md-3">
							<label for="city_filter">District</label>
							<select class="form-control" id="city_filter" name="city_filter">
								<option value="">--All--</option>
								@foreach ($districts as $item)
								<option value="{{$item->id}}" {{request()->input('city_filter') == $item->id ? 'selected' : ''}}>{{$item->city}}</option>
								@endforeach
							</select>
					</div>

                    <div class="col-md-1">
                        <label for="reset">&nbsp;</label>
                        <button type="submit" class="btn btn-info  btn-block">
                            Submit
                        </button>
                    </div>

                </form>
            </div>
            </div>
                <div class="card-body" id="prodiv">
            <table style="width: 100%;" class="dn">
                <tr>
                    <td align="center" style="position: relative; border: 0; padding-bottom: 5px;">
                        <div style="border-bottom: 0px solid #000; padding-bottom: 2vw;">
                            <!-- <img src="{{ url('onlineAdmission') }}/images/logo.png" style="position: absolute; width: 70px; top: 5px; left: 0;"/> -->
                            <!-- <img src="images/logo.png" style="position: absolute; width: 70px; top: 5px; left: 0;"/> -->
                            <div style="font-size: 18px; font-weight: bold;">
                                <!-- Department of Sports -->
                                Khel Sathi Portal
                            </div>
                            <div style="font-size: 14px; font-weight: bold;">
                                Government of Uttar Pradesh
                            </div>
                            <div style="font-size: 18px; font-weight: bold;">
                                Sport College online application form
                            </div>
                        </div>
                    </td>
                </tr>
            </table>
                <table class="table table-bordered datatable" id="dataTable_player">

                        <thead>
                            <tr>
                                <th>S.No.</th>
                                <th>Application No.</th>
                                <th>Applicant Name</th>
                                <th>Email</th>
                                <th>Mobile</th>
                                <th>Date of Birth</th>
                                <th>District</th>
                                <th>Sport</th>
                                <th>Form Submission Date</th>
                                <th class="text-center" style="width:10%;">Application Status</th>
                                <th>View</th>
                            </tr>
                        </thead>
                        <tbody>

                            
                        @foreach($applicationview as $key=>$item)


                            <tr>
                                <td>{{$key+1}}</td>
                                   <td>{{$item->application_no}}</td>
                                <td>{{$item->name}}</td>
                                <td>{{$item->email}}</td>
                                <td>{{$item->mobile}}</td>
                                <td>{{dmy($item->regdob)}}</td>
                                <td>{{!empty(districtName($item->permanent_district)) ? districtName($item->permanent_district) : 'N/A' }}</td>

                   


                             <td>
                                  @php
                    $sportIds = explode(',', optional($item)->sport ?? '');
                    $sportNames = array_map(function($id) {
                        return sport_name($id);
                    }, $sportIds);
                @endphp
                {{ implode(', ', $sportNames) }}
                             </td>
                             <td>{{dmy($item->created)}}</td>
                             <td class="text-center">
                                  @if ($item->final_submit == 1 && $item->status === 0)
                                            <span class="badge bg-danger rounded-pill">Application Rejected</span>
                                        @elseif ($item->final_submit == 1 && $item->status == 1)

                                             @if ($item->payment_status_coaching_fee == 1)
                                  
                                                  <span class="badge bg-primary rounded-pill">Success (Registration Fees)</span>

                                             @else
                                            <span class="badge bg-success rounded-pill">Application Accepted</span> <br>
                                           @endif
                                             @elseif ($item->final_submit == 1 && $item->payment_status == null)
                                            <span class="badge bg-warning rounded-pill">Payment Pending (Registration Fees)</span>
                                   
                                        @elseif ($item->final_submit == 1 && $item->payment_status == 1)
                                            <span class="badge bg-success rounded-pill">Payment Received</span>
                                        @else
                                              <span class="badge bg-success rounded-pill">Application Submitted </span>
                                        @endif
                            </td>
                            <td><a href="{{ route('coaching_camp_view_details', $item->basic_id) }}"><i class="fa fa-eye"></i></td>


                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
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
