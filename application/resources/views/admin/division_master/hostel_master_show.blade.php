@extends('layouts/admin_layout')
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="pageheader" id="menu-margin">
            <h4 class="mb-0">Hostel Master List
                <a class="btn btn-sm btn-success float-end" href="{{ route('hostelMaster') }}"><i class="fas fa-plus"></i> Add</a>
            </h4>
        </div>
        <div class="card">
            <div class="card-body">
                <form action="{{ route('listHostelMaster') }}" class="needs-validation" method="post" autocomplete="off" id="formHostelMaster" novalidate>
                    @csrf
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="name">Hostel Name <span class="text-danger">*</span></label>
                                <input class="form-control alphanumeric" type="text" name="hostel_name" placeholder="Enter Hostel Name" value="{{ isset($_POST['hostel_name']) ? $_POST['hostel_name'] : '' }}">
                            </div>
                            @if ($errors->has('hostel_name'))
                            <span class="error_mess">{{ $errors->first('hostel_name') }}</span>
                            @endif
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="name">Division Name <span class="text-danger">*</span></label>
                                <select class="form-select" id="division_name" name="division_name" value="{{ isset($_POST['hostel_name']) ? $_POST['hostel_name'] : '' }}">
                                    <option selected="" disabled="" value="">Select Division</option>
                                    @foreach($divisions as $key=>$division)
                                    <option value="{{ $division->id }}" data-badge="" {{request()->input('division_name') == $division->id ? 'selected' : ''}}>{{$division->division_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @if ($errors->has('division_name'))
                            <span class="error_mess">{{ $errors->first('division_name') }}</span>
                            @endif
                        </div>
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="name">Districts Name <span class="text-danger">*</span></label>
                                <select id="city-dd" class="form-select" name="districts" value="{{ old('districts') }}">
                                    <option selected="" disabled="" value="">Select District</option>
                                    @foreach($districts as $key=>$district)
                                    <option value="{{ $district->id }}" data-badge="" {{request()->input('districts') == $district->id ? 'selected' : ''}}>{{$district->city}}</option>
                                    @endforeach
                                </select>
                            </div>
                            @if ($errors->has('districts'))
                            <span class="error_mess">{{ $errors->first('districts') }}</span>
                            @endif
                        </div>
                        <!--  </div> -->
                        <!--  <div class="row"> -->
                        <div class="col-md-2">
                            <div class="form-group d-grid">
                                <label class="form-label">&nbsp;</label>
                                <button class="btn btn-primary" type="submit">Search</button>
                            </div>
                        </div>
                        <div class="col-md-1">
                            <div class="form-group d-grid">
                                <label class="form-label">&nbsp;</label>
                                <a href="{{route('listHostelMaster')}}" class="btn btn-danger" type="submit">Reset</a>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table id="dataTable" class="table table-bordred table-hover bg-white datatable ellipsis">
                        <thead>
                            <tr>
                                <th width="6%">S.No.</th>
                                <th width="6%">Hostel Name</th>
                                <th width="10%">Division Name</th>
                                <th>District Name</th>
                                <th width="10%">Spots Name</th>
                                <th width="3%">Total Number Of Seats</th>
                                <th width="3%">Boys</th>
                                <th width="3%">Girls</th>
                                <th width="3%">Seats Used</th>
                                <th width="3%">Boys Alloted Seats</th>
                                <th width="3%">Girls Alloted Seats</th>
                                <th width="2%">Created At</th>
                                <th width="5%">Updated At</th>
                                <th class="text-center">Edit</th>
                                <!-- <th class="text-center">Delete</th> -->
                            </tr>
                        </thead>
                        <tbody>
                            @if(!empty($lists))
                            @foreach($lists as $key=>$list)
                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $list->hostel_name }}</td>
                                <td>{{ $list->division_name }}</td>
                                <td>{{ $list->city }}</td>
                                <td style="white-space: initial;">
                                    @foreach(sportName($list->sports) as $key=>$item)
                                    @if($key != 0),@endif
                                    {{$item->name}}
                                    @endforeach
                                </td>
                                <td>{{ $list->total_seats }}</td>
                                <td>{{ $list->boys }}</td>
                                <td>{{ $list->girls }}</td>
                                <td>{{ $list->seat_used }}</td>
                                <td>{{ $list->boys_alloted }}</td>
                                <td>{{ $list->girls_alloted }}</td>
                                <td>{{ date('d-m-Y', strtotime($list->created_at))}}</td>
                                <td>{{ date('d-m-Y', strtotime($list->updated_at)) .", ". date('h:i a', strtotime($list->updated_at)) }}</td>
                                <td class="text-center">
                                    <a class="btn btn-sm btn-dark pointer bt" href="{{url('/admin/edit-hotel-master/')}}/{{encrypt($list->id)}}">
                                        <i class="far fa-edit"></i>
                                    </a>
                                </td>
                                <!-- <td class="text-center">
                                        <a class="btn btn-sm btn-danger pointer bt"
                                            href="{{url('/admin/delete-division-map/')}}/{{$list->id}}"
                                            onclick="return confirm('Are you sure you want to delete ?')">
                                            <i class="fa fa-trash"></i>
                                        </a>
                                    </td> -->
                            </tr>
                            @endforeach
                            @endif
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('custom-scripts')

<script type="text/javascript">
    //get district data by division name
    $(document).ready(function() {
        $('#division_name').on('change', function() {
            var idState = this.value;
            //alert(idState);
            $("#city-dd").html('');
            $.ajax({
                url: "admin/fetch-cities",
                type: "POST",
                data: {
                    division_id: idState,
                    _token: '{{csrf_token()}}'
                },
                dataType: 'json',
                success: function(res) {
                    $('#city-dd').html('<option value="">Select Districts</option>');
                    $.each(res.cities, function(key, value) {
                        $("#city-dd").append('<option value="' + value
                            .district_id + '">' + value.city + '</option>');
                    });
                }
            });
        });
    });
</script>
@endpush
