@extends('layouts/admin_layout')
@section('content')

<div class="pageheader" id="menu-margin">
    <h4 class="mb-0">Role Mapping</h4>
</div>
<div class="card">
    <div class="card-body">
        <form action="{{ route('urm_role_module_mapping') }}" method="post" id="reload" class="needs-validation" novalidate>
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Role Mapping</label>
                        <div class="form-control">
                            <div class="form-check form-check-inline">
                                <label class="radio-inline">
                                    <input type="radio" class="form-check-input CheckBoxList" name="optradio" value="1" checked>
                                    <label class="form-check-label">Role Wise</label>
                                </label>
                            </div>
                            <div class="form-check form-check-inline">
                                <label class="radio-inline">
                                    <input type="radio" class="form-check-input CheckBoxList" name="optradio" value="2">
                                    <label class="form-check-label">User Wise</label>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="role">Module</label>
                        <select class="form-select attrs module_select" id="modulename" name="modulename" required>
                            <option selected disabled value="">Select Module</option>
                            @foreach($module as $module)
                            <option value="{{ $module->id }}">{{ $module->module_name }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            Please select a legal status.
                        </div>
                    </div>
                </div>
                <div class="col-md-3" id="role">
                    <div class="form-group">
                        <label for="role">Role</label>
                        <select class="form-select attrs role_select" id="role_id" name="role_id">
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
                <div class="col-md-3" id="user">
                    <div class="form-group">
                        <label for="role">User</label>
                        <select class="form-select attrs user_select" id="user_id" name="user_id">
                            <option selected disabled value="">Select User</option>
                            @foreach($users as $user)
                            <option value="{{ $user->id }}">{{ $user->username }}</option>
                            @endforeach
                        </select>
                        <div class="invalid-feedback">
                            Please select a legal status.
                        </div>
                    </div>
                </div>
            </div>
            <div class="form-check mb-3" id="sel_all" style="display:none;">
                <input type="checkbox" class="form-check-input" id="ckbCheckAll" /> <label class="form-check-label" for="flexCheckDefault">Select All </label>
            </div>
            <div class="module_role_div maping-text mb-3" style="display:none;"></div>
            <div class="row justify-content-center">
                <div class="col-md-2">
                    <button type="submit" class="btn btn-primary w-100">Save</button>
                </div>
            </div>
        </form>
    </div>
</div>


@endsection
@push('custom-scripts')

<!-- InstanceBeginEditable name="for-javascript" -->
<script>
    $(document).ready(function() { //Make script DOM ready
        $("#user").hide();
        $("#role_id").prop('required', true);
        $('input:radio[name="optradio"]').change(
            function() {
                if ($(this).is(':checked') && $(this).val() == 1) {
                    $("#role").show();
                    $("#user").hide();
                    $("#user_id").prop('required', false);
                    $("#role_id").prop('required', true);
                } else {
                    $("#user_id").prop('required', true);
                    $("#role_id").prop('required', false);
                    $("#user").show();
                    $("#role").hide();
                }
            });
    });
</script>

@endpush
