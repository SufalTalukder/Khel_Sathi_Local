@extends('layouts/admin_layout')
@section('content')
<div class="row">


                    <div class="col-md-4 update-menu">

                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-11">
                                        <h5>Create Menu</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('menuCreate') }}" class="needs-validation" id="reload" novalidate method="post">
                                    <div class="form-group">
                                        <label for="name">Menu</label>
                                        <input type="text" class="form-control" id="menu_name" name="menu_name" required>
                                        <div class="invalid-feedback">
                                            Please provide a menu.
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Order</label>
                                        <input type="text" class="form-control" id="order" name="order" required>
                                        <div class="invalid-feedback">
                                            Please provide a order.
                                        </div>
                                    </div>
                                    <button class="btn btn-primary mt-2" type="submit">Submit/दर्ज करे</button>
                                </form>
                            </div>
                        </div>

                    </div>



                    <div class="col-md-4 update-from" style="display:none;">

                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-7">
                                        <h5>Update Menu</h5>
                                    </div>
                                    <div class="col-md-5" style="text-align: right;">
                                        <a href="javascript:void(0)" onclick="backmenu()" class="btn btn-primary btn-sm float-end">
                                            <i class="fa fa-arrow-left"></i>
                                            &nbsp;&nbsp;Back
                                        </a>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('menuUpdate') }}" class="needs-validation" id="updatemenu" novalidate method="post">
                                    <div class="form-group">
                                        <label for="name">Menu</label>
                                        <input type="text" class="form-control" id="up_menu_name" name="up_menu_name" required>
                                        <div class="invalid-feedback">
                                            Please provide a menu.
                                        </div>
                                    </div>
                                    <div class="form-group">
                                        <label for="name">Order</label>
                                        <input type="text" class="form-control" id="up_order" name="up_order" required>
                                        <div class="invalid-feedback">
                                            Please provide a order.
                                        </div>
                                    </div>
                                    <input type="hidden" name="menu_di" id="menu_di" />
                                    <button class="btn btn-primary mt-2" type="submit">Update</button>
                                </form>
                            </div>
                        </div>

                    </div>



                    <div class="col-md-8 update-menu">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-11">
                                        <h5>Menu List</h5>
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
                                                    <th>Name</th>
                                                    <th>Order</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($menu as $key=>$item)
                                                <tr>
                                                    <td>{{ $key+1 }}</td>
                                                    <td id="menuname{{$item->id}}">{{ $item->name }}</td>
                                                    <td id="menuorder{{$item->id}}">{{ $item->order }}</td>

                                                    <td class="text-center" width="20%">

                                                        <div class="btn-group">
                                                            @if($item->status==0)
                                                            <div class="form-control2">
                                                                <label class="switch">
                                                                    <input type="checkbox" id="themeskin{{ $key+1 }}">
                                                                    <div class="slider round" onclick="menuStatus('{{$item->id}}')">
                                                                        <span class="off">Disable</span>
                                                                        <span class="on">Enable</span>
                                                                    </div>
                                                                </label>
                                                            </div>
                                                            @else
                                                            <div class="form-control2">
                                                                <label class="switch">
                                                                    <input type="checkbox" id="themeskin{{ $key+1 }}" checked>
                                                                    <div class="slider round" onclick="menuStatus('{{$item->id}}')">
                                                                        <span class="off">Disable</span>
                                                                        <span class="on">Enable</span>
                                                                    </div>
                                                                </label>
                                                            </div>
                                                            @endif

                                                            <a class="pointer bt" href="javascript:void(0)" onclick="updateMenu('{{$item->id}}')">
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
                    </div>


                </div>
@endsection
