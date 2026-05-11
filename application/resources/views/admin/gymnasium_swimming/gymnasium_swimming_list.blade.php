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
                        <h4 class="mb-0">Gymnasium swimming list</h4>
                    </div>
                    <div class="col-md-2 d-grid">
                       
                    </div>
                </div>
            </div>
            <div class="card">
            <div class="card-body">
            <div class="mb-4">
                <form class="row" method="post" action="{{ route('gymnasium_swimming_list_search') }}">
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
                                <th>District</th>
                                <th>Vehicle Number</th>
                                <th>Applied for</th>
                                <th>Form Submission Date</th>                                
                                <th class="text-center" style="width:10%;">Application Status</th>
                                <th>View</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($applicationview as $key=>$item)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{!empty($item->application_no) ? $item->application_no : 'N/A' }}</td>
                                <td>{{!empty($item->name) ? $item->name : 'N/A' }}</td>
                                <td>{{!empty(districtName($item->district_id)) ? districtName($item->district_id) : 'N/A' }}</td>
                                <td>@if ($item->vehicle_no)
                                    {{ $item->vehicle_no }}@else
                                    NA
                               @endif</td>                               
                               <?php if($item->type == 1){ ?>
                               <td>Gymnasium </td>
                               <?php } else if($item->type == 2){ ?>
                               <td>Swimming Pool</td>
                               <?php } ?>
                               <td>{{dmy($item->final_submit_date)}}</td>   
                               <?php if($item->status_preview == 2){ ?>
                                <td class="text-center">
                                    <span class="badge bg-success rounded-pill">Submitted successfully</span>
                                </td>
                                    <?php } ?>
                                    <td><a href="{{ route('gymnasium_swimming_view_details', $item->user_id) }}"><i class="fa fa-eye"></i></td>     
                                    
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
