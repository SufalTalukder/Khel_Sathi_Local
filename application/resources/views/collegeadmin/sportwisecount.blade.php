@extends( 'layouts/admin_layout' )
@section( 'content' )
<div class="pageheader" id="menu-margin">
  <h4 class="mb-0">
    Online Admission Count Sport Wise

    <a href="{{ url('collegeadmin/dashboard') }}" class="btn btn-outline-danger btn-sm backbtn float-end  me-2"><span class="icons icon-arrow-left"></span>Back/पीछे</a>
    <a title="Sport Wise Count" class="btn btn-sm btn-success float-end" onclick="ExportToExcel('xlsx')">
      <i class="fa fa-file-excel"></i> Export to Excel
    </a>
  </h4>


</div>

<div class="card">
  <div class="card-body">

    <div class="table-responsive table-bordred">
      <table id="dataTable" class="table table_new datatable table-bordred table-hover bg-white">
        <thead>
          <tr>
            <th>S.No.</th>
            <th>Sports</th>
            <th>Total Admission</th>
            <th>Gender ( Male)</th>
            <th>Gender ( Female)</th>

          </tr>
        </thead>
        <tbody>


          @foreach ($sports as $key=>$sport)

          <tr>
            <td>
              {{$key +1}}
            </td>
            <td>
              {{$sport->name}}
            </td>
            <td>
              {{$sport->total}}
            </td>
            <td>
              {{$sport->male}}
            </td>
            <td>
              {{$sport->female}}
            </td>
          </tr>

          @endforeach
        </tbody>
        <tr>
          <td>&nbsp;

          </td>
          <td><strong>
              Total
            </strong></td>
          <td><strong>
              {{ $total[0]->total}}
            </strong></td>
          <td><strong>
              {{ $total[0]->male}}
            </strong></td>
          <td><strong>
              {{ $total[0]->female}}
            </strong></td>

        </tr>

      </table>
    </div>
  </div>
</div>


@endsection



@push('custom-scripts')
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
      XLSX.writeFile(wb, fn || ('Sportwise Count Report.' + (type || 'xlsx')));
  }
</script>
@endpush
