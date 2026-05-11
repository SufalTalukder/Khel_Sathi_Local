@extends('layouts/admin_layout')
@section('content')


<div class="pageheader" id="menu-margin">
    <h4 class="mb-0">Manage User List
        <a href="{{ route('user_manager') }}" class="btn btn-primary btn-sm float-end">
            <i class="fa fa-arrow-left"></i>
            &nbsp;&nbsp;Back
        </a>
    </h4>
</div>
<div class="card">
    <div class="card-body">
        <form action="{{ route('user_manager_update') }}" method="post" class="needs-validation" novalidate>
            @csrf
            <div class="row">
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="role">Role</label>
                        <select class="form-select attrs" id="rolename" name="rolename" required>
                            <option selected disabled value="">Select Role</option>
                            @foreach($roles as $role)
                            <option value="{{ $role->id }}" @if($item->admin_role==$role->id) selected @endif >{{ $role->role_name }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            Please select a legal status.
                        </div>
                    </div>
                </div>
                <div class="col-md-4" id="sport">
                    <div class="form-group ">
                        <label class="placeholder">Sport</label>
                        <select id="sportType" class="form-select" name="sport_type">
                            <option selected disabled value="">Select</option>
                            @foreach ($sports as $type)
                            <option value="{{$type->id}}" {{ $item->sport_type === $type->id ? 'selected' : '' }}>{{$type->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4" id="division_name_selected">
                    <div class="form-group ">
                        <label class="placeholder">Division Name</label>
                        <select id="division_name" class="form-select" name="division_name">
                            <option selected disabled value="">Select division</option>
                            @foreach ($divisions as $division)
                            <option value="{{$division->id}}" {{ $item->division_id === $division->id ? 'selected' : '' }}>{{$division->division_name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4" id="district_name_selected">
                    <div class="form-group ">
                        <label class="placeholder">District Name</label>
                        <select id="district_name" class="form-select" name="district_name">
                            <option selected disabled value="">Select district</option>
                            @foreach ($districts as $district)
                            <option value="{{$district->id}}" {{ $item->district_id === $district->id ? 'selected' : '' }}>{{$district->city}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control alphanumeric" id="authorized_person" name="name" required value="{{ $item->name }}">
                        <div class="invalid-feedback">
                            Please enter name.
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name">Username</label>
                        <input type="text" class="form-control alphanumeric" id="authorized_person" name="username" required value="{{ $item->username }}">
                        <div class="invalid-feedback">
                            Please enter name.
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="email">Email ID</label>
                        <input type="email" name="email" id="email" class="form-control" required value="{{ $item->email }}">
                        <div class="invalid-feedback">
                            Please provide a email.
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="mobile">Phone</label>
                        <!-- <input type="tel" name="mobile" id="mobile" min="10" max="10" class="form-control" required value="{{ $item->mobile }}"> -->
                        <input type="text" name="mobile" class="form-control" pattern="[6-9][0-9]{9}$" required value="{{ $item->mobile }}" maxlength="10" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                        <div class="invalid-feedback">
                            Please provide a Phone no.
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="username" class="placeholder"> Status</label>
                        <select class="form-select" name="status">
                            <option @if($item->status==1) selected @endif value="1">Active</option>
                            <option @if($item->status==2) selected @endif value="0" >Inactive</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="mobile">Designation</label>
                        <input type="text" name="designation" id="designation" class="form-control" required value="{{ $item->designation }}">
                        <div class="invalid-feedback">
                            Please provide Designation.
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="mobile">Password</label>
                        <input type="text" name="password" id="designation" class="form-control" required value="{{ $item->user_password }}">
                        <div class="invalid-feedback">
                            Please provide Password.
                        </div>
                    </div>
                </div>
            </div>
            <input type="hidden" name="id" id="id" value="{{ $item->id }}">
            <div class="row justify-content-center mt-3">
                <div class="col-md-2 mb-2 d-grid">
                    <button type="submit" class="btn btn-primary">Update</button>
                </div>
            </div>
        </form>
    </div>
</div>

@endsection

@push('custom-scripts')
<script>
    // if($("#sportType").val()){
    //     $("#sport").show();
    // }
    $('#rolename').change(function() {
        if ($(this).val() == 3) {
            $("#sport").show();
            $("#sportType").attr("required", "true");
        } else {
            $("#sport").hide();
            $("#sportType").removeAttr("required");
        }
    });
    $('#rolename').change(function() {
        if ($(this).val() == 9) {
            $("#district_name_selected").show();
            $("#district_name").attr("required", "true");
        } else {
            $("#district_name_selected").hide();
            $("#district_name").removeAttr("required");
        }
    });
    $('#rolename').change(function() {
        if ($(this).val() == 10) {
            $("#division_name_selected").show();
            $("#division_name").attr("required", "true");
        } else {
            $("#division_name_selected").hide();
            $("#division_name").removeAttr("required");
        }
    });
</script>
@endpush
