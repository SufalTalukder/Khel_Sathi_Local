@extends( 'layouts/admin_layout' )
@section( 'content' )
<div class="pageheader" id="menu-margin">
  <h4 class="mb-0">
    Hostel Admission Count District Wise
    <a href="{{ asset('assets_admin/hostel') }}" class="btn btn-outline-danger btn-sm backbtn float-end  me-2"><span class="icons icon-arrow-left"></span>Back/पीछे</a>
    <a title="Application Details ExportToExcel" class="btn btn-sm btn-success float-end" href="{{route('download_hostel_pdf',8)}}">
      <i class="fa fa-file-excel"></i> Export to PDF
    </a>
    <a title="Sport Wise Count" class="btn btn-sm btn-success float-end" onclick="ExportToExcel('xlsx')">
      <i class="fa fa-file-excel"></i> Export to Excel
    </a>
  </h4>
</div>

<div class="card">
  <div class="card-body">
    <div class="mb-4">
      <form class="row" method="get" action="{{ url()->current() }}">
        <div class="col-md-4">
          <div class="form-group">
            <label for="sport_filter">Sport</label>
            @php
            $abc=request()->input('subsport');
            @endphp
            <select class="form-select" id="sport_filter" name="sport_id" onchange="sporttype(this.value)" data-subsport="{{  $abc }}">
              <option value="">--All--</option>
              @foreach ($sports as $item)
              <option value="{{ data_get($item, 'id') }}" {{request()->input('sport_id') == data_get($item, 'id') ? 'selected' : ''}}>{{ data_get($item, 'name') }}</option>
              @endforeach
            </select>
          </div>
        </div>
        <div class="col-md-4">
          <div class="form-group">
            <label for="division_filter">Division</label>
            <select class="form-select" id="division_filter" name="division_filter">
              <option value="">--All--</option>
              @foreach ($divisions as $item)
              <option value="{{$item->id}}" {{request()->input('division_filter') == $item->id ? 'selected' : ''}}>{{$item->division_name}}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="col-md-4">
          <div class="form-group">
            <label for="subsport">Sub Sport Name</label>
            <div id="list1" class="dropdown-check-list">
              <select name="subsport" id="dropdownid" class="form-select">
                <option value="">Select Sub Sport</option>
              </select>
            </div>
          </div>
        </div>

        <div class="col-md-4">
          <div class="form-group">
            <label for="city_filter">District</label>
            <select class="form-select" id="city_filter" name="city_filter">
              <option value="">--All--</option>
              @foreach ($districts_list as $item)
              <option value="{{$item->id}}" {{request()->input('city_filter') == $item->id ? 'selected' : ''}}>{{$item->city}}</option>
              @endforeach
            </select>
          </div>
        </div>

        <div class="col-md-4 mt-2">
          <div class="form-group">
            <label for="district_trial">District Level Trial</label>
            <select class="form-select" name="district_trial" id="district_trial">
              <option value="">--All--</option>
              <option value="1" {{request()->input('district_trial') == 1 ? 'selected' : ''}}>Pending</option>
              <option value="2" {{request()->input('district_trial') == 2 ? 'selected' : ''}}>Pass</option>
              <option value="3" {{request()->input('district_trial') == 3 ? 'selected' : ''}}>Fail</option>
            </select>
          </div>
        </div>

        <div class="col-md-4 mt-2">
          <div class="form-group">
            <label for="status_filter">Application Status</label>
            <select class="form-select" id="status_filter" name="status_filter">
              <option value="">--All--</option>
              <option value="3" {{request()->input('status_filter') == 3 ? 'selected' : ''}}>Pending</option>
              <option value="1" {{request()->input('status_filter') == 1 ? 'selected' : ''}}>Provisionally Accepted</option>
              <option value="2" {{request()->input('status_filter') == 2 ? 'selected' : ''}}>Rejected</option>
            </select>
          </div>
        </div>

        <div class="col-md-4 mt-2">
          <div class="form-group">
            <label for="payment_status">Payment Status</label>
            <select class="form-select" name="payment_status">
              <option value="">--All--</option>
              <option value="1" {{request()->input('payment_status') == 1 ? 'selected' : ''}}>Pending</option>
              <option value="2" {{request()->input('payment_status') == 2 ? 'selected' : ''}}>Success</option>
              <option value="3" {{request()->input('payment_status') == 3 ? 'selected' : ''}}>Fail</option>
            </select>
          </div>
        </div>

        <div class="col-md-4 mt-2">
          <div class="form-group">
            <label for="division_trial">Division Level Trial</label>
            <select class="form-select" name="division_trial">
              <option value="">--All--</option>
              <option value="1" {{request()->input('division_trial') == 1 ? 'selected' : ''}}>Pending</option>
              <option value="2" {{request()->input('division_trial') == 2 ? 'selected' : ''}}>Pass</option>
              <option value="3" {{request()->input('division_trial') == 3 ? 'selected' : ''}}>Fail</option>
            </select>
          </div>
        </div>

        <div class="col-md-4 mt-2">
          <div class="form-group">
            <label for="state_trial">State Level Trial</label>
            <select class="form-select" name="state_trial">
              <option value="">--All--</option>
              <option value="1" {{request()->input('state_trial') == 1 ? 'selected' : ''}}>Pending</option>
              <option value="2" {{request()->input('state_trial') == 2 ? 'selected' : ''}}>Pass</option>
              <option value="3" {{request()->input('state_trial') == 3 ? 'selected' : ''}}>Fail</option>
            </select>
          </div>
        </div>

        <div class="col-md-4 mt-2">
          <div class="form-group">
            <label for="existing_student">Existing student of Sports College</label>
            <select class="form-select" name="existing_student">
              <option value="">--All--</option>
              <option value="1" {{request()->input('existing_student') == 1 ? 'selected' : ''}}>Yes </option>
              <option value="2" {{request()->input('existing_student') == 2 ? 'selected' : ''}}>No</option>
            </select>
          </div>
        </div>

        <div class="col-md-4 mt-2">
          <div class="form-group">
            <label for="session_year">Session Year </label>
            <select class="form-select" name="session_year">
              <option value="">--All--</option>
              @php
              $currentSession = config('app.session_year');
              @endphp
              @for ($i = $currentSession; $i >= 2024; $i--)
              <option value="{{$i}}" {{request()->input('session_year') == $i ? 'selected' : ''}}>{{$i}}-{{$i+1}}</option>
              @endfor
            </select>
          </div>
        </div>

        <div class="col-md-4 mt-2">
          <div class="form-group">
            <label for="gender">Gender </label>
            <select class="form-select" name="gender">
              <option value="">--All--</option>
              <option value="1" {{request()->input('gender') == 1 ? 'selected' : ''}}>Male</option>
              <option value="2" {{request()->input('gender') == 2 ? 'selected' : ''}}>Female</option>
            </select>
          </div>
        </div>

        <div class="col-md-2 mt-2">
          <div class="form-group d-grid">
            <label for="submit">&nbsp;</label>
            <button type="submit" class="btn btn-primary btn-block">
              Submit
            </button>
          </div>
        </div>
        <div class="col-md-2 mt-2">
          <div class="form-group d-grid">
            <label for="reset">&nbsp;</label>
            <a href="{{ url()->current() }}" class="btn btn-danger btn-block">
              Reset
            </a>
          </div>
        </div>

      </form>
    </div>
    <div class="table-responsive table-bordred">
      <table id="dataTable" class="table table_new datatable table-bordred table-hover bg-white">
        <thead>
          <tr>
            <th>S.No.</th>
            <th>District</th>
            <th class="text-center">Total Admission</th>
            <th class="text-center">Gender ( Male)</th>
            <th class="text-center">Gender ( Female)</th>

          </tr>
        </thead>
        <tbody>


          @foreach ($districts as $key=>$item)

          <tr>
            <td>
              {{$key +1}}
            </td>
            <td >
              {{$item->city}}
            </td>
            <td class="text-center">
              {{$item->total}}
            </td>
            <td class="text-center">
              {{$item->male}}
            </td>
            <td class="text-center">
              {{$item->female}}
            </td>
          </tr>
          @endforeach
        </tbody>

        <tr>
          <td>&nbsp;</td>
          <td><strong>
              Total
            </strong></td>
          <td class="text-center"><strong>
              {{ $total[0]->total}}
            </strong></td>
          <td class="text-center"><strong>
              {{ $total[0]->male}}
            </strong></td>
          <td class="text-center"><strong>
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
      XLSX.writeFile(wb, fn || ('Districtwise Count Report.' + (type || 'xlsx')));
  }

  function sporttype(sport) {
    var subsports_id = $("#sport_filter").attr('data-subsport');

    $.ajax({
      type: "POST",
      url: "{{url('admin/get_subsport_admin')}}",
      data: {
        _token: "{{ csrf_token() }}",
        sport
      },
      success: function(response) {
        var d = $('#dropdownid').empty();
        $('#dropdownid').append('<option value="">Select Sub Sport</option>');
        $.each(response.sub_type, function(key, value) {
          $('#dropdownid').append(
            `<option ${value.id == subsports_id ? 'selected' : ''} value="${value.id}"> ${value.sub_type} </option>`);
        });
      }
    })
  }

  $(document).ready(function() {
    var selectedSport = $('#sport_filter').val();
    if (selectedSport) {
      sporttype(selectedSport);
    }
  });
</script>
@endpush
