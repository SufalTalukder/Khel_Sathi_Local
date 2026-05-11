@extends('layouts/admin_layout')
@section('content')

            <div class="pageheader">
                <div class="row">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('ad')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">City</li>
                        </ol>
                    </nav>

                </div>
            </div>



                <div class="row">

                    <div class="col-md-4 update-city">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-11">
                                        <h5>Create City</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ asset('assets_admin/addCity') }}" class="needs-validation" id="reload" novalidate method="post">
                                    <div class="form-group">
                                        <label for="status">State</label>
                                        <span class="get-state-date">
                                            <select class="form-control state_id" id="state_id" name="state_id" required>
                                                <option value="">Select State</option>
                                                @foreach($states as $item)
                                                <option value="{{ $item->id }}" data-value="{{ $item->name}}">{{ $item->name}}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">
                                                Please select state
                                            </div>
                                        </span>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">City</label>
                                        <input type="text" class="form-control alphanumeric" id="city" name="city" required>
                                        <div class="invalid-feedback">
                                            Please provide a city name.
                                        </div>
                                    </div>
                                    <button class="btn btn-primary mt-2" type="submit">Submit/दर्ज करे</button>
                                </form>
                            </div>
                        </div>

                    </div>


                    <div class="col-md-4 update-from" style="display:none">

                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-7">
                                        <h5>Update City</h5>
                                    </div>
                                    <div class="col-md-5" style="text-align: right;">
                                        <a href="javascript:void(0)" onclick="backCity()" class="btn btn-primary btn-sm float-end">
                                            <i class="fa fa-arrow-left"></i>
                                            &nbsp;&nbsp;Back
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('cityUpdate') }}" class="needs-validation" id="updatecitya" novalidate method="post">

                                    <div class="form-group">
                                        <label for="status">State</label>
                                        <span class="get-state-date">
                                            <select class="form-control" id="state_id_up" name="state_id_up" required>
                                                <option value="">Select State</option>
                                                @foreach($states as $item)
                                                <option value="{{ $item->id }}" data-value="{{ $item->name}}">{{ $item->name}}</option>
                                                @endforeach
                                            </select>
                                            <div class="invalid-feedback">
                                                Please select state
                                            </div>
                                        </span>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">City</label>
                                        <input type="text" class="form-control alphanumeric" id="upcity" name="upcity" required>
                                        <div class="invalid-feedback">
                                            Please provide a city name.
                                        </div>
                                    </div>

                                    <input type="hidden" id="city_id" name="city_id">

                                    <button class="btn btn-primary mt-2" type="submit">Update</button>
                                </form>
                            </div>
                        </div>

                    </div>


                    <div class="col-md-8 update-city">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-11">
                                        <h5>City List</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <div class="">
								<div class="table-responsive">
                                        <table  id="dataTable" class="table table-bordred table-hover bg-white datatable" >
                                            <thead>
                                                <tr>
                                                    <th>S.No.</th>
                                                    <th>City</th>
                                                    <th>State</th>
                                                    <th class="text-center">Status</th>
                                                    <th class="text-center">Edit</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($city as $key=>$item)
                                                <tr>
                                                    <td>{{ $key+1 }}</td>
                                                    <td id="upcity{{$item->id}}">{{ $item->city }}</td>
                                                    <td id="stateup{{$item->id}}">{{ $item->state_name }}</td>
                                                    <td class="text-center">

                                                        @if($item->status==0)
                                                        <div class="form-control2">
                                                            <label class="switch">
                                                                <input type="checkbox" id="themeskin{{ $key+1 }}">
                                                                <div class="slider round" onclick="cityStatus('{{$item->id}}')">
                                                                    <span class="off">Disable</span>
                                                                    <span class="on">Enable</span>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        @else
                                                        <div class="form-control2">
                                                            <label class="switch">
                                                                <input type="checkbox" id="themeskin{{ $key+1 }}" checked>
                                                                <div class="slider round" onclick="cityStatus('{{$item->id}}')">
                                                                    <span class="off">Disable</span>
                                                                    <span class="on">Enable</span>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        @endif
                                                    </td>
                                                    <td class="text-center">
                                                        <!-- <a class="btn btn-sm btn-dark cityup{{$item->id}}" href="javascript:void(0)" onclick="showButtonCity('{{$item->id}}')">
                                                            <i class="fa fa-pencil"></i>
                                                        </a>
                                                        <a style="display:none;" class="btn btn-sm btn-info city{{$item->id}}" href="javascript:void(0)" onclick="updateCity('{{$item->id}}')">
                                                            Update
                                                        </a> -->
                                                        <a class="pointer bt cutyup{{$item->id}}" href="javascript:void(0)" onclick="updateCity('{{$item->id}}','{{$item->state_id}}')">
                                                            <i class="fa fa-pencil"></i>
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


                </div>

@endsection
