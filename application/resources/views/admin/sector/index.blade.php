@extends('layouts/admin_layout')
@section('content')
<div class="row">


                    <div class="col-md-4 update-sector">

                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-11">
                                        <h5>Create Sector</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('createSector') }}" class="needs-validation" id="reload" novalidate method="post">
                                    <div class="form-group">
                                        <label for="name">Name</label>
                                        <input type="text" class="form-control" id="sector_name" name="sector_name" required>
                                        <div class="invalid-feedback">
                                            Please provide a name.
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
                <h5>Update Department</h5>
            </div>
            <div class="col-md-5" style="text-align: right;">
                <a href="javascript:void(0)" onclick="backSector()" class="btn btn-primary btn-sm float-end">
                    <i class="fa fa-arrow-left"></i>
                    &nbsp;&nbsp;Back
                </a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <form action="{{ route('updateSector') }}" class="needs-validation" id="updateSector" novalidate method="post">
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="up_sector" name="up_sector" required>
                <div class="invalid-feedback">
                    Please provide a name.
                </div>
            </div>
            <input type="hidden" id="sector_id" name="sector_id">
            <button class="btn btn-primary mt-2" type="submit">Update</button>
        </form>
    </div>
</div>

</div>





                    <div class="col-md-8 update-sector">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-11">
                                        <h5>Sector List</h5>
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
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($sector as $key=>$item)
                                                <tr>
                                                    <td>{{ $key+1 }}</td>
                                                    <td id="sector{{$item->id}}">{{ $item->sector_name }}</td>
                                                    <td class="text-center" width="20%">

                                                        <div class="btn-group">

                                                        @if($item->status==0)
                                                        <div class="form-control2">
                                                            <label class="switch">
                                                                <input type="checkbox" id="themeskin{{ $key+1 }}">
                                                                <div class="slider round" onclick="sectorStatus('{{$item->id}}')">
                                                                    <span class="off">Disable</span>
                                                                    <span class="on">Enable</span>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        @else
                                                        <div class="form-control2">
                                                            <label class="switch">
                                                                <input type="checkbox" id="themeskin{{ $key+1 }}" checked>
                                                                <div class="slider round" onclick="sectorStatus('{{$item->id}}')">
                                                                    <span class="off">Disable</span>
                                                                    <span class="on">Enable</span>
                                                                </div>
                                                            </label>
                                                        </div>
                                                        @endif

                                                        <a class="pointer bt stateup{{$item->id}}" href="javascript:void(0)" onclick="updateSector('{{$item->id}}')">
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
