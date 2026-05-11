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
<div class="col-12">
<div class="col-12 pt-2">

</div>
        <div class="card">
          <div class="card-body">
          <?php
//dd($applicationBooking);

            ?>
            <table class="table table-bordered datatable" id="dataTable_player">
              <thead>
                <tr>
                  <th>S.No.</th>
                  <th>Application No.</th>
                  <th>Applicant Name</th>
                  <th>Date of Birth</th>
                  <th>Email ID</th>
                  <th>Mobile No.</th>
                  <th>Service</th>
                  <th>Status of Application</th>
                  <th>View</th>
                </tr>
              </thead>
              <tbody>

              @foreach($applicationBooking as $key=>$item)
                <tr>
                  <td> {{$key+1}} </td>
                  <td>gjgj</td>
                  <td>ggg</td>
                  <td>gg</td>
                  <td>gg</td>
                  <td>gg</td>
                   <td>vff</td>
                   <td>ddd</td>
                  <td>
                    <a class="btn btn-outline-success" href="#"><i class="fa fa-eye"></i></a>

                    <a  href="#"  class="btn btn-outline-success btn btn-primary-print btn-block"><i class="fa fa-print" aria-hidden="true"></i></a>

                    <!--<a class="btn btn-outline-success" href=""><i class="fa fa-edit"></i></a>-->
                  </td>

                 </td>
                </tr>
                @endforeach
              </tbody>

            </table>


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

        popupWin.document.write('<html><title>::Preview::</title><head><style>body{font-family:Arial} .noprint{display: none;} table{width:100%; border-collapse:collapse;} .table tr th, .table tr td{border:1px solid #000; padding:3px 5px; font-size: 12px;} .table > thead > tr > th{background-color: #eee;}</style></head><body onload="window.print()">')

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
