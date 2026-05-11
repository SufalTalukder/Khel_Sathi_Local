@extends('layouts/admin_layout')
@section('content')

<div class="pageheader" id="menu-margin">
    <h4 class="mb-0">Manage User
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
                            <option value="{{ $role->id }}">{{ $role->role_name }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            Please select a legal status.
                        </div>
                    </div>
                </div>
                <div class="col-md-3" style="display: none;" id="sport">
                    <div class="form-group ">
                        <label class="placeholder">Sport<span class="text-danger">*</span></label>
                        <select id="sportType" class="form-select" name="sport_type">
                            <option selected disabled value="">Select</option>
                            @foreach ($sports as $type)
                            <option value="{{$type->id}}" {{ old('sport_type') === $type->id ? 'selected' : '' }}>{{$type->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-3" id="district_name_selected" style="display: none;">
                    <div class="form-group mb-3">
                        <label class="placeholder">District Name <span class="text-danger">*</span></label>
                        <select name="district_name" id="district_name" class="form-control form-select" required>
                            <option selected="" disabled="" value="">Select District</option>
                            @foreach($districts as $key=>$district)
                            <option {{$district->id == 23 ? 'selected' : ''}} value="{{ $district->id }}" data-badge="">{{$district->city}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="invalid-feedback">
                        Please select a district name.
                    </div>
                </div>
                <div class="col-md-3" id="division_name_selected" style="display: none;">
                    <div class="form-group mb-3">
                        <label class="placeholder">Division Name <span class="text-danger">*</span></label>
                        <select name="division_name" id="division_name" class="form-control form-select" required>
                            <option selected disabled value="">Select Division</option>
                            @foreach($divisions as $division)
                            <option value="{{ $division->id }}">{{ $division->division_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="invalid-feedback">
                        Please select a division name.
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name">Name</label>
                        <input type="text" class="form-control alphanumeric" id="authorized_person" name="name" required value="{{ old('name') }}">
                        <div class="invalid-feedback">
                            Please enter name.
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="name">Username</label>
                        <input type="text" class="form-control alphanumeric" id="authorized_person" name="username" required value="{{ old('name') }}">
                        <div class="invalid-feedback">
                            Please enter name.
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" required value="{{ old('name') }}">
                        <div class="invalid-feedback">
                            Please provide a email.
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="mobile">Phone</label>
                        <input type="text" name="mobile" class="form-control" pattern="[6-9][0-9]{9}$" required value="{{ old('mobile') }}" maxlength="10" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                        <!-- <input type="tel" name="mobile"  min="10" max="10"  id="mobile" class="form-control" required value="{{ old('name') }}"> -->
                        <div class="invalid-feedback">
                            Please provide a Phone no.
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="mobile">Designation</label>
                        <input type="text" name="designation" id="designation" class="form-control" required value="{{ old('designation') }}">
                        <div class="invalid-feedback">
                            Please provide Designation.
                        </div>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="form-group">
                        <label for="username" class="placeholder"> Status</label>
                        <select class="form-select" name="status">
                            <option value="1">Active</option>
                            <option value="2">Inactive</option>
                        </select>
                    </div>
                </div>
            </div>
            <div class="row justify-content-center mt-3">
                <div class="col-md-2 mb-2 d-grid">
                    <button type="submit" class="btn btn-primary">Add</button>
                </div>
            </div>
        </form>
    </div>
</div>


@endsection
@push('custom-scripts')
<script>
    $('#rolename').change(function() {
        console.log($(this).val())
        if ($(this).val() == 3) {
            $("#sport").show();
            $("#sportType").attr("required", "true");
        } else {
            $("#sport").hide();
            $("#sportType").removeAttr("required");
        }
    });

    $('#rolename').change(function() {
        console.log($(this).val())
        if ($(this).val() == 9) {
            $("#district_name_selected").show();
            $("#district_name").attr("required", "true");
        } else {
            $("#district_name_selected").hide();
            $("#district_name").removeAttr("required");
        }
    });
    $('#rolename').change(function() {
        console.log($(this).val())
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
