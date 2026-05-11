@extends('layouts/admin_layout')
@section('content')

							<div class="pageheader" id="menu-margin">
			<h4 class="mb-0">Manage User </h4>
		</div>
                        <div class="card">


                            <div class="card-body">

                                <form action="{{ route('user_manager_update') }}" method="post"  class="needs-validation" novalidate>

                                @csrf
                                <div class="row">

                                        <div class="col-md-4">
                                            <div class="form-group">
                                                <label for="role">Role</label>
                                                <select class="form-control attrs" id="rolename" name="rolename" required>
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
                                                <select  id="sportType" class="form-control" name="sport_type" >
                                                    <option selected disabled value="">Select</option>
                                                    @foreach ($sports as $type)
                                                    <option  value="{{$type->id}}"  {{ old('sport_type') === $type->id ? 'selected' : '' }}>{{$type->name}}</option>
                                                    @endforeach

                                                </select>
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
                                                    Please provide  Designation.
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-4">
                                            <div class="form-group">
                                            <label for="username" class="placeholder"> Status</label>
                                            <select class="form-control" name="status">

                                            <option value="1">Active</option>
                                            <option value="2" >Inactive</option>

                                            </select>
                                            </div>
                                        </div>



                                    </div>

                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-2 mt-2 d-grid">
                                                <button type="submit" class="btn btn-primary">Add</button>
                                            </div>
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
                if ($(this).val()==3){
                    $("#sport").show();
                    $("#sportType").attr("required", "true");
                }
                else{
                    $("#sport").hide();
                    $("#sportType").removeAttr("required");
                }
            });
            </script>
    @endpush
