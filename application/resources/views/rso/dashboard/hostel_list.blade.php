@extends('layouts/admin_layout')
@section('content')


<div class="pageheader" id="menu-margin">
    <h4 class="mb-0"> List of Hostel <!-- <a class="btn btn-sm btn-success" href="{{ route('exportExcel',5) }}"> -->
      
        <a title="Application Details ExportToExcel" class="btn btn-sm btn-success float-end" href="{{route('download_hostel_pdf',7)}}">
            <i class="fa fa-file-excel"></i> Export to PDF
        </a>
      
        <a title="Sport Wise Count" class="btn btn-sm btn-success float-end" onclick="ExportToExcel('xlsx')">
            <i class="fa fa-file-excel"></i> Export to Excel
          </a>
    </h4>
</div>

<div class="card">
    <div class="card-body">
        <form method="POST" action="{{route('hostel_list_filter')}}">
            @csrf
            <div class="row mb-3">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="city_filter">District</label>
                        <select class="form-select" name="district_id">
                            <option value="">--All--</option>
                            @foreach ($districts as $item)
                            <option value="{{$item->id}}" {{request()->input('district_id') == $item->id ? 'selected' : ''}}>{{$item->city}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="city_filter">Sport</label>
                        <select class="form-select" name="sport_id">
                            <option value="">--All--</option>
                            @foreach ($sports as $item)
                            <option value="{{$item->id}}" {{request()->input('sport_id') == $item->id ? 'selected' : ''}}>{{$item->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group d-grid">
                        <label for="reset">&nbsp;</label>
                        <button type="submit" class="btn btn-primary">
                            Submit
                        </button>
                    </div>
                </div>
                <div class="col-md-2">
                    <div class="form-group d-grid">
                    <label for="reset">&nbsp;</label>
                        <a href="{{route('hostel_list')}}" class="btn btn-danger">
                            Reset
                        </a>
                    </div>
                </div>
            </div>
        </form>
        <div class="row">
            <div class="col-12">
                <div class="table-responsive">
                    <table id="dataTable" class="table table-striped table-bordered datatable" id="datatable">
                        <thead>
                            <tr>
                                <th rowspan="2">S.No.</th>
                                <th rowspan="2">Hostel Name</th>
                                <th rowspan="2">District</th>
                                <th rowspan="2">Sport Name</th>
                                <th rowspan="2" style="text-align: center;">Total Seats</th>
                                <th colspan="2" style="text-align: center;">Total Seats</th>
                                <th colspan="2" style="text-align: center;">Alloted Seats</th>
                                <th colspan="2" style="text-align: center;">Vacant Seats</th>
                                <th rowspan="2">Created On</th>
                            </tr>
                            <tr>
                                <th style="text-align: center;">Boy's</th>
                                <th style="text-align: center;">Girl's</th>
                                <th style="text-align: center;">Boy's </th>
                                <th style="text-align: center;">Girl's</th>
                                <th style="text-align: center;">Boy's</th>
                                <th style="text-align: center;">Girl's</th>
                            

                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($hostels as $key=>$item)
                            <tr>
                                <td>{{$key +1 }}</td>
                                <td>{{$item->hostel_name}}</td>
                                <td>{{districtName($item->districts)}}</td>
                                <td> @for ($i = 0; $i < count(explode(",",$item->sports)); $i++)
                                {{sport_name(explode(",",$item->sports)[$i] ) }},
                                @endfor
                                </td>
                                <td>{{$item->total_seats}}</td>
                                <td>{{$item->boys}}</td>
                                <td>{{$item->girls}}</td>
                                <td><a href="{{ route('hostel_allotted_to',$item->id) }}">{{$item->boys_alloted}}</a></td>
                                <td>{{$item->girls_alloted}}</td>
                                <td>{{$item->boys-$item->boys_alloted}}</td>
                                <td>{{$item->girls - $item->girls_alloted}}</td>
                                <td>{{dmy($item->created_at)}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>





<script type="text/javascript" src="{{ asset('js/xlsx.full.min.js') }}"></script>
<script>






    function ExportToExcel(type, fn, dl) {
       var elt = document.getElementById('dataTable');
       var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
       return dl ?
         XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }):
         XLSX.writeFile(wb, fn || ('Applicant List.' + (type || 'xlsx')));
    }

</script>


@endsection
