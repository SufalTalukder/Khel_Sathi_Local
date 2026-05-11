@extends('layouts/admin_layout')
@section('content')
    <div class="row">
        <div class="col-md-12">
            <div class="pageheader" id="menu-margin">
                <h4 class="mb-0"> List of Eklavya Krida {{$title}} Application
                    <!-- <a class="btn btn-sm btn-success" href="{{ route('exportExcel', 5) }}"> -->
                    @if($seg == 6) 
                    @php
                        $query = http_build_query([
                            'sport_id' => request()->input('sport_id', ''),
                            'status_filter' => $seg ?? '',
                            'city_filter' => request()->input('city_filter', ''),
                            'from_date' => request()->input('from_date', ''),
                            'to_date' => request()->input('to_date', '')
                        ]);
                    @endphp
                    <a title="Eklavya Krida Details ExportToExcel" class="btn btn-sm btn-success float-end" href="{{url('admin/eklavya_krida_co_exce')}}?{{ $query }}">
                        <i class="fa fa-file-excel"></i> Export to Excel
                    </a>
                    <!-- <a class="btn btn-sm btn-danger" href="{{ route('exportPdf', 5) }}"> -->
                    <a class="btn btn-sm btn-outline-danger float-end" target="_blank" href="{{url('admin/eklavya_krida_co_pd')}}?{{ $query }}" >
                        <i class="fa fa-file-pdf"></i> Export to PDF
                    </a>
                    @endif
                </h4>
            </div>
            <div class="card">
                <div class="card-body">
                    <form class="row" method="post" action="{{ url('/admin/eklavya_krida_co') }}/{{$seg}}">
                        <div class="col-md-2">
                           
                            <label for="sport_id">Sport</label>
                            <select class="form-select" id="sport_id" name="sport_id"
                                >
                                <option value="">--All--</option>
                                @foreach ($sports as $sport)
                                    <option {{request()->input('sport_id') == $sport->id ? 'selected' : ''}} value="{{ $sport->id }}">{{ $sport->name }}</option>
                                    </option>
                                @endforeach
                            </select>
                        </div>
                        <input type="hidden">
                        {{-- <div class="col-md-2">
                            <label for="status_filter">Application Status</label>
                            <select class="form-select" id="status_filter" name="status_filter">
                                <option value="">--All--</option>
                                <option {{request()->input('status_filter') == 1 ? 'selected' : ''}} value="1">Asso. Forwarded Application </option>
                                <option {{request()->input('status_filter') == 3 ? 'selected' : ''}} value="3">Asso. Pending Application </option>
                                <option {{request()->input('status_filter') == 2 ? 'selected' : ''}} value="2">Asso. Rejected Application </option>
                                <option {{request()->input('status_filter') == 4 ? 'selected' : ''}} value="4">RSO/SO Pending Application </option>
                                <option {{request()->input('status_filter') == 5 ? 'selected' : ''}} value="5">RSO/SO Rejected Application </option>
                                <option {{request()->input('status_filter') == 6 ? 'selected' : ''}} value="6">Admin Prize Money Pending Application </option>
                                <option {{request()->input('status_filter') == 7 ? 'selected' : ''}} value="7">Admin Prize Money Rejected Application </option>
                                <option {{request()->input('status_filter') == 8 ? 'selected' : ''}} value="8">Admin Prize Money Accepted Application </option>
                            
                            </select>
                        </div> --}}

                        <div class="col-md-2">
                            <label for="city_filter">District</label>
                            <select class="form-select" id="city_filter" name="city_filter" >
                                <option value="">--All--</option>
                                @foreach ($cities as $city)
                                    <option {{request()->input('city_filter') == $city->id ? 'selected' : ''}} value="{{ $city->id }}">{{ $city->city }}</option>
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-md-2">
                            <label for="from_date">From Date</label>
                            <input readonly name="from_date"  id="from_date" type="text"
                                required value="{{request()->input('from_date') }}" class="form-control dateTime" placeholder="From Date" data-language="en">
                        </div>
                        <div class="col-md-2">
                            <label for="to_date">To Date</label>
                            <input readonly name="to_date" id="to_date"  type="text"
                                required value="{{request()->input('to_date') }}" class="form-control dateTime" placeholder="To Date" data-language="en">
                        </div>
                        
                        <div class="col-md-1">
                            <label for="reset">&nbsp;</label>
                            <button type="submit" class="btn btn-primary  btn-block">Submit</button>
                        </div>
                        <div class="col-md-1">
                            <label for="reset">&nbsp;</label>
                            <a href="{{url('/admin/eklavya_krida_co')}}/{{$seg}}" class="btn btn-info  btn-block">Reset</a>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card">

                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-striped table-bordered datatable" id="datatable">
                            <thead>
                                <tr>
                                    <th>S.No.</th>
                                    <th>Application No.</th>
                                    <th>Applicant’s Name</th>
                                    <th>Email ID</th>
                                    <th>District</th>
                                    <th>Sport Name</th>
                                    <th>Date of Application</th>
                                    <th>Application Status</th>
                                    @if($seg == 8)
                                    <th>Amount</th>
                                    @endif
                                    <th>View</th>
                                    <th>Trail</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($collection as $key => $list)
                                    <tr>
                                        <?php $data = AllCom($list->application_no); ?>
                                        <td>{{ $key + 1 }}</td>
                                        <td>{{ $list->application_no }}</td>
                                        <td>{{ $list->fullname }}</td>
                                        <td>{{ $list->email }}</td>
                                        <td>{{ districtName($list->permanent_district) }}</td>
                                        <td>{{ $list->sportName }}</td>
                                        @if($seg == 6)
                                            <td>{{ date('d-m-Y', strtotime($list->trail_date)) }}</td>
                                        @else
                                            <td>{{ date('d-m-Y', strtotime($list->created_at)) }}</td>
                                        @endif
                                        <td>@if ($list->form_status == 1)
                                            <span class="badge bg-success text-white rounded-pill">Accepted</span>
                                           @elseif ($list->form_status == 3)
                                            <span class="badge bg-warning text-white rounded-pill">Pending</span>
                                            @elseif ($list->form_status == 2)
                                            <span class="badge bg-danger text-white rounded-pill">Rejected</span>
                                           @else
                                            <span class="badge bg-warning text-white rounded-pill">Pending</span>
                                            @endif
                                        </td>
                                        @if($seg == 8)
                                            <td>
                                                @if ($list->amount_release_status == 1)
                                                    <strong
                                                        class="badge bg-success text-white rounded-pill disabled">Released</strong>
                                                @else
                                                    <strong class="badge bg-danger text-white rounded-pill disabled nowrap">Not
                                                        Released</strong>
                                                @endif
                                            </td>
                                        @endif
                                        <td class="text-center">
                                            <span class="fa-stack ">
                                                <a class="btn btn-sm btn-dark"
                                                    href="{{ route('eklavya_krida_view', $list->application_no) }}"><i
                                                        class="fa fa-eye"></i></a>
                                            </span>
                                        </td>
                                        <td class="text-center">
                                            <a class="btn btn-sm btn-danger pointer bt" href="{{url('/admin/trail/')}}/{{$list->user_id}}/7">
                                                <i class="fa fa-eye"></i>
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
