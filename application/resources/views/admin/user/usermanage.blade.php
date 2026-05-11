@extends('layouts/admin_layout')
@section('content')

<div class="pageheader">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{route('ad')}}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Registere Investor</li>
        </ol>
    </nav>
</div>
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-11">
                <h5>Registered Investor List</h5>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="">
            <div class="table-responsive">
                <table id="dataTable" class="table table-bordred table-hover bg-white datatable">
                    <thead>
                        <tr>
                            <th>S.No.</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Mobile</th>
                            <th>User Type</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $key=>$item)
                        <tr>
                            <td>{{ $key+1 }}</td>
                            <td>{{ $item->fullname }}</td>
                            <td>{{ $item->email }}</td>
                            <td>{{ $item->mobile }}</td>
                            <td>{{ $item->investor_type }}</td>
                            <td class="text-center" width="20%">

                                <div class="btn-group">
                                    @if($item->status==0)
                                    <div class="form-control2">
                                        <label class="switch">
                                            <input type="checkbox" id="themeskin{{ $key+1 }}">
                                            <div class="slider round" onclick="usersStatus('{{$item->id}}')">
                                                <span class="off">Disable</span>
                                                <span class="on">Enable</span>
                                            </div>
                                        </label>
                                    </div>
                                    @else
                                    <div class="form-control2">
                                        <label class="switch">
                                            <input type="checkbox" id="themeskin{{ $key+1 }}" checked>
                                            <div class="slider round" onclick="usersStatus('{{$item->id}}')">
                                                <span class="off">Disable</span>
                                                <span class="on">Enable</span>
                                            </div>
                                        </label>
                                    </div>
                                    @endif

                                    <a class="pointer bt" href="{{ route('edituser',$item->id) }}">
                                        <i class="fa fa-pencil"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

@endsection
