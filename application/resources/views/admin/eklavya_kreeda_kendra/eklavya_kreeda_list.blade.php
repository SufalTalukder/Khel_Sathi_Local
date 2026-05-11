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

<div class="container-fluid pagecontentbody">
    <div class="tab-content">
        <div class="pagebody removebg-color">
            <div class="col-md-12 pageheader pb-2">
                <div class="row">
                    <div class="col-md-9">
                        <h4 class="mb-0">List of Eklavya Kreeda </h4>
                    </div>
                    <div class="col-md-2 text-end">
                        <div data-print="modal" onclick="PrintDoc()" class="btn btn-primary iconbutn btn-sm me-2" title="Print"><i class="fa fa-print"></i></div>
                        <a title="College Wise Count" class="btn btn-sm btn-success" onclick="ExportToExcel('xlsx')" title="Export to Excel">
                            <i class="fa fa-file-excel"></i>
                        </a>
                    </div>
                </div>
            </div>

            <div class="card">
            <div class="card-body">


            <div class="mb-4">
                <form class="row" method="post" action="{{ route('eklavya_kreeda_list_search') }}">
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


                <div class="table-responsive" id="prodiv">
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
                                <th class="ellipsis">S.No.</th>
                                <th class="ellipsis">Application No.</th>
                                <th class="ellipsis">Applicant Name</th>
                                <th class="ellipsis">District</th>
                                <th class="ellipsis">DOB</th>

                                <!-- <th class="text-center" style="width:10%;">Status</th> -->
                                <th class="text-center" style="width:10%;">Status</th>
                                <th class="ellipsis">View</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php //print_r(Auth::guard('admin')->user());
                            ?>
                            @foreach($applicationview as $key=>$item)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{!empty(eklavyaApplication($item->user_id)) ? eklavyaApplication($item->user_id) : 'N/A' }}</td>
                                <td>{{!empty(eklavyaName($item->user_id)) ? eklavyaName($item->user_id) : 'N/A' }}</td>
                                <td>{{ districtName($item->permanent_district) }}</td>
                                <td>{{ dmy($item->dob) }}</td>

                                <?php //if($item->status == 2){
                                ?>
                                <td class="text-center">
                                    <span class="badge bg-success rounded-pill">Final Submitted successfully</span>
                                </td>
                                <?php //}else{
                                ?>
                                <!-- <td class="text-center">
                                    <span class="badge bg-warning text-white rounded-pill">Pending</span>
                                </td>  -->
                                <?php // }
                                ?>

                                <td><a href="{{ route('eklavya_kreeda_view_details', $item->user_id) }}"><i class="fa fa-eye"></i></td>


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

@endsection

@push( 'custom-scripts' )
<script>
    // function PrintDoc() {
    //     var toPrint = document.getElementById('prodiv');
    //     var popupWin = window.open('', '_blank', 'left=100,top=100,width=1100,height=600,tollbar=0,scrollbars=1,status=0,resizable=1');
    //     popupWin.document.open();
    //     popupWin.document.write('<html><title>::Preview::</title><head><style>body{font-family:Arial} .noprint{display: none;} table{width:100%; border-collapse:collapse;} .table tr th, .table tr td{border:1px solid #000; padding:3px 5px; font-size: 12px; text-align: left;} th.table-warning{background-color: #dbdbdb;} .table-warning h3{margin: 0;}</style></head><body onload="window.print()">')
    //     popupWin.document.write(toPrint.innerHTML);
    //     popupWin.document.write('</body></html>');
    //     popupWin.document.close();
    // }
    // function showMe(e) {
    //     var t = e.value;
    //     e.value = t.indexOf(".") >= 0 ? t.slice(0, t.indexOf(".") + 2) : t;
    // }
    function PrintDoc() {
        $('#dataTable_player').DataTable().destroy();
        var toPrint = document.getElementById('prodiv');

        var popupWin = window.open('', '_blank', 'left=100,top=100,width=1100,height=600,tollbar=0,scrollbars=1,status=0,resizable=1');

        popupWin.document.open();

        popupWin.document.write('<html><title>::Preview::</title><head><style>body{font-family:Arial} .noprint{display: none;} table{width:100%; border-collapse:collapse;} .table tr th, .table tr td{border:1px solid #000; padding:3px 5px; font-size: 10px;} .table > thead > tr > th{background-color: #eee;}</style></head><body onload="window.print()">')

        popupWin.document.write(toPrint.innerHTML);

        popupWin.document.write('</body></html>');

        popupWin.document.close();

        $('#dataTable_player').DataTable();

    }
</script>
<script type="text/javascript" src="{{ asset('js/xlsx.full.min.js') }}"></script>

<script>
    function ExportToExcel(type, fn, dl) {
        var elt = document.getElementById('dataTable_player');
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


@endpush
