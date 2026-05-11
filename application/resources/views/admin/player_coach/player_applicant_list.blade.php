@extends( 'layouts/admin_layout' )
@section( 'content' )
<style>
    td.player_name {
        text-transform: capitalize;
    }
</style>

<div class="container-fluid pagecontentbody">
    <div class="col-md-12 pageheader pb-2">
        <div class="row">
            <div class="col-md-10">
                <h4 class="mb-0">List of Player Applicant</h4>
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
        <div class="card-body" id="prodiv">
            <div class="mb-4">
                <form class="row" method="post" action="{{ route('admin_player') }}">
                    @csrf
                    <div class="col-md-3">
                        <label for="project_filter">Sport</label>
                        <select class="form-select" id="sport_filter" name="sport_id">
                            <option value="">--All--</option>
                            @foreach ($sports as $item)
                            <option value="{{$item->id}}" {{request()->input('sport_id') == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-2">
                        <label for="city_filter">District</label>
                        <select class="form-select" id="city_filter" name="city_filter">
                            <option value="">--All--</option>
                            @foreach ($districts as $item)
                            <option value="{{$item->id}}" {{request()->input('city_filter') == $item->id ? 'selected' : ''}}>{{$item->city}}</option>
                            @endforeach
                        </select>
                    </div>


                    <div class="col-md-2">

                        <label for="name">Application Status</label>
                        <select class="form-select" name="status">
                            <option value="">--All--</option>
                            <option value="1" {{request()->input('status') == 1 ? 'selected' : ''}}>Pending</option>
                            <option value="3" {{request()->input('status') == 3 ? 'selected' : ''}}>Accepted </option>
                            <option value="2" {{request()->input('status') == 2 ? 'selected' : ''}}>Rejected </option>
                        </select>

                    </div>

                    <div class="col-md-1">
                        <label for="reset">&nbsp;</label>
                        <button type="submit" class="btn btn-info  btn-block">
                            Submit
                        </button>
                    </div>
                    {{-- <div class="col-md-1">
                        <label for="reset">&nbsp;</label>
                        <a href="{{ route('hostelList') }}" class="btn btn-success btn-block">
                    Reset
                    </a>
            </div> --}}
            </form>
        </div>
        <div class="table-responsive" id="prodiv">
            <table class="table table-bordered datatable" id="dataTable_player">
                <thead>
                    <tr>
                        <th>S.No.</th>
                        <th>Application No.</th>
                        <th>Applicant Name</th>
                        <th>Sport</th>
                        <th>District</th>
                        <th>Date of Birth</th>
                        <th>Mobile No.</th>
                        <th>Email</th>
                        <th>Status</th>
                        <th>View</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($applicant_details as $key=>$row)

                    <tr>
                        <td>{{ $key+1 }}</td>
                        <td>{{ !empty($row->application_no) ? $row->application_no : 'N/A' }}</td>
                        <td class="player_name">{{ !empty($row->name) ? $row->name : 'N/A' }}</td>
                        <td>{{!empty(sport_name($row->sport_id)) ? sport_name($row->sport_id) : 'N/A' }}</td>
                        <td>{{!empty(districtName($row->district_id)) ? districtName($row->district_id) : 'N/A' }}</td>
                        <td>{{dmy(!empty($row->dob) ? $row->dob : 'N/A') }} </td>
                        <td>{{!empty($row->mobile) ? $row->mobile : 'N/A' }} </td>
                        <td>{{ !empty($row->email) ? $row->email : 'N/A' }}</td>
                        <td>
                            @if ($row->application_status == 1)
                            <span class="badge bg-warning text-white rounded-pill">Pending</span> @elseif ($row->application_status == 3)
                            <span class="badge bg-primary text-white rounded-pill"> Accepted</span> @else
                            <span class="badge bg-danger rounded-pill">Rejected</span> @endif
                        </td>
                        <td><a href="{{ route('player_coach_view_details', $row->play_id) }}"><i class="fa fa-eye"></i></td>
                        <?php  ?>
                    </tr>
                    @endforeach
                </tbody>
            </table>
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
        $('.fa-download').text('View');
        var toPrint = document.getElementById('prodiv');
        //alert(toPrint);
        var popupWin = window.open('', '_blank', 'left=100,top=100,width=1100,height=600,tollbar=0,scrollbars=1,status=0,resizable=1');
        popupWin.document.open();
        popupWin.document.write('<html><title>::Preview::</title><head><style>body{font-family:Arial} .noprint{display: none;} table{width:100%; border-collapse:collapse;} .table tr th, .table tr td{border:1px solid #000; padding:3px 5px; font-size: 12px; text-align: left;} th.table-warning{background-color: #dbdbdb;} .table-warning h3{margin: 0;}</style></head><body onload="window.print()">')
        popupWin.document.write(toPrint.innerHTML);
        popupWin.document.write('</body></html>');
        popupWin.document.close();
        $('.fa-download').text('');
        // $('#dataTable_player').DataTable();
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

@endsection
@push('custom-scripts')
