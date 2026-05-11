@extends('layouts/admin_layout')
@section('content')

<div class="pageheader" id="menu-margin">
    <h4 class="mb-0">Edit Post
    <a href="{{ route('post_master') }}" class="btn btn-primary btn-sm float-end">
			<i class="fa fa-arrow-left"></i>
			&nbsp;&nbsp;Back
		</a>
	</h4>
    </h4>
</div>
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-11">
                <h5>Post Fields </h5>
            </div>
        </div>
    </div>
    <div class="card-body">
        <form action="{{route('post_master_add')}}" id="form" method="post" class="needs-validation" novalidate>
            @csrf
            <div class="row">
                <div class="col-md-3">
                    <div class="form-group ">
                        <label class="placeholder">Post Category<span class="text-danger">*</span></label>
                        <select id="post_category" class="form-select" name="post_category" required>
                            <option value="">Select</option>
                            <option @if($post->post_category == 1) Selected @endif value="1">Level 1</option>
                            <option @if($post->post_category == 2) Selected @endif value="2">Level 2</option>
                            <option @if($post->post_category == 3) Selected @endif value="3">Level 3</option>
                            <option @if($post->post_category == 4) Selected @endif value="4">Level 4</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="name">Department Name</label>
                        <input type="text" class="form-control" id="advertisment_no" autocomplete="off" name="advertisment_no" required value="{{ $post->advertisment_no }}">
                        <div class="invalid-feedback">
                            Please enter Department Name.
                        </div>
                    </div>
                </div>
                {{-- <div class="col-md-3">
                    <div class="form-group ">
                        <label class="placeholder">Sport Type<span class="text-danger">*</span></label>
                        <select id="sportType" class="form-control selectpicker" name="sport_type[]" multiple data-live-search="true">
                            <!-- <option disabled value="">Select</option> -->
                            @foreach ($sport_type as $type)
                            <option value="{{$type->id}}" <?php if (in_array($type->id, $spo)) echo 'selected'; ?>>{{$type->name}}</option>
                            @endforeach
                        </select>
                    </div>
                </div> --}}
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="email">Post Name</label>
                        <input type="text" name="post_name" id="post_name" autocomplete="off" class="form-control alphanumeric" required value="{{ $post->post_name }}">
                        <div class="invalid-feedback">
                            Please provide Post Name.
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="name">Basic Pay</label>
                        <input type="text" class="form-control alphanumeric"  id="basic_pay" autocomplete="off" name="basic_pay" required value="{{  $post->basic_pay }}">
                        <div class="invalid-feedback">
                            Please enter Basic Pay.
                        </div>
                    </div>
                </div>
                <input type="hidden" name="id" id="id" value="{{ $post->id }}">
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="mobile">No. of Post</label>
                        <input type="number" id="total_post" autocomplete="off" name="total_post" class="form-control" required value="{{ $post->total_post }}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                        <!-- <input type="tel" name="mobile"  min="10" max="10"  id="mobile" class="form-control" required value="{{ old('name') }}"> -->
                        <div class="invalid-feedback">
                            Please provide No. of Post.
                        </div>
                    </div>
                </div>
                {{--   <div class="col-md-3">
                    <div class="form-group">
                        <label for="name">Start Date</label>
                        <input type="text" name="start_date" id="start_date" autocomplete="off" onkeypress="return false" class="form-control dateTime" required value="{{ dmy($post->start_date) }}">
                        <div class="invalid-feedback">
                            Please enter Start Date.
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="name">End Date</label>
                        <input type="text" name="end_date" id="end_date" autocomplete="off" onkeypress="return false" class="form-control dateTime" required value="{{ dmy($post->end_date) }}">
                        <div class="invalid-feedback">
                            Please enter End Date.
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="mobile">MIN AGE</label>
                        <input type="number" name="min_age" autocomplete="off" class="form-control" required value="{{ $post->min_age }}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                        <div class="invalid-feedback">
                            Please provide MIN AGE.
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="mobile">MAX AGE</label>
                        <input type="number" name="max_age" autocomplete="off" class="form-control" required value="{{ $post->max_age }}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                        <div class="invalid-feedback">
                            Please provide MAX AGE.
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label for="name">Age at the Date of</label>
                        <input type="text" name="min_age_from" autocomplete="off" id="min_age_from" class="form-control" required value="{{ dmy($post->min_age_from) }}">
                        <div class="invalid-feedback">
                            Please enter Age at the Date of.
                        </div>
                    </div>
                </div>
                <div class="col-md-3">
                    <div class="form-group">
                        <label>Upload PDF</label>
                        <div class="input-group">
                            <input type="file" name="adevertisment_doc" class="form-control" onchange="getfileext(this.value,'T3')" id="FileT3" aria-describedby="inputGroupFileAddon05" aria-label="Upload">
                        </div>
                        <input type="hidden" name="adevertisment_doc1" value="{{$post->adevertisment_doc}}">
                        <span class="note">(File Format: jpeg, jpg| Max File Size: 2 MB)</span>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="mobile">Is Age Relaxation ?</label>
                            <input name="is_age_relaxation" value="1" {{($post->is_age_relaxation == 1 ? ' checked' : '')}} type="checkbox" id="checkbox" />
                            <div class="row" id="age_lst">
                                <div class="col-md-2">
                                    <label for="mobile">OBC</label>
                                    <input type="text" name="age_relax_obc" autocomplete="off" id="age_relax_obc" class="form-control age_c" value="{{ $post->age_relax_obc }}">
                                    <div class="invalid-feedback">
                                        Please provide OBC Age Relaxation.
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label for="mobile">SC</label>
                                    <input type="text" name="age_relax_sc" autocomplete="off" id="age_relax_sc" class="form-control age_c" value="{{ $post->age_relax_sc }}">
                                    <div class="invalid-feedback">
                                        Please provide SC Age Relaxation.
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label for="mobile">ST</label>
                                    <input type="text" name="age_relax_st" autocomplete="off" id="age_relax_st" class="form-control age_c" value="{{ $post->age_relax_st }}">
                                    <div class="invalid-feedback">
                                        Please provide ST Age Relaxation.
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label for="mobile">EWS</label>
                                    <input type="text" name="age_relax_ews" autocomplete="off" id="age_relax_ews" class="form-control age_c" value="{{ $post->age_relax_ews }}">
                                    <div class="invalid-feedback">
                                        Please provide EWS Age Relaxation.
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label for="mobile">PWD</label>
                                    <input type="text" name="age_relax_pwd" autocomplete="off" id="age_relax_pwd" class="form-control age_c" value="{{ $post->age_relax_pwd }}">
                                    <div class="invalid-feedback">
                                        Please provide PWD Age Relaxation.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group">
                            <label for="mobile">Category wise no. of post</label>
                            <div class="row">
                                <div class="col-md-2">
                                    <label for="mobile">General</label>
                                    <input type="text" name="general_post" autocomplete="off" id="general_post" class="form-control" required value="{{ $post->general_post }}">
                                    <div class="invalid-feedback">
                                        Please provide General Post.
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label for="mobile">OBC</label>
                                    <input type="text" name="obc_post" autocomplete="off" id="obc_post" class="form-control" required value="{{ $post->obc_post }}">
                                    <div class="invalid-feedback">
                                        Please provide OBC Post.
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label for="mobile">SC</label>
                                    <input type="text" name="sc_post" autocomplete="off" id="sc_post" class="form-control" required value="{{ $post->sc_post }}">
                                    <div class="invalid-feedback">
                                        Please provide SC Post.
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label for="mobile">ST</label>
                                    <input type="text" name="st_post" autocomplete="off" id="st_post" class="form-control" required value="{{ $post->st_post }}">
                                    <div class="invalid-feedback">
                                        Please provide ST Post.
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label for="mobile">EWS</label>
                                    <input type="text" name="ews_post" autocomplete="off" id="ews_post" class="form-control" required value="{{ $post->ews_post }}">
                                    <div class="invalid-feedback">
                                        Please provide EWS Post.
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <label for="mobile">PWD</label>
                                    <input type="text" name="pwd_post" autocomplete="off" id="pwd_post" class="form-control" required value="{{ $post->pwd_post }}">
                                    <div class="invalid-feedback">
                                        Please provide PWD Post.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col-md-3">
                    <div class="form-group">
                        <label for="mobile">MIN Qualification</label>
                        <input type="number" name="min_qualification" autocomplete="off" class="form-control" value="{{ $post->min_qualification }}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                        <div class="invalid-feedback">
                            Please provide Qualification.
                        </div>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="mobile">Is experience required ?</label>
                        <input type="checkbox" id="experience_required" {{ ($post->is_experience_required == 1 ? ' checked' : '') }} name="experience_required" value="1" id="exp" />
                        <div class="col-md-6 exp_field">
                            <label style="display: flex;" for="mobile">Min No. of Year
                                <input type="number" id="exp_req" name="exp_req" autocomplete="off" class="form-control" value="{{ $post->exp_req }}" oninput="this.value = this.value.replace(/[^0-9.]/g, '').replace(/(\..*)\./g, '$1');">
                            </label>
                        </div>
                    </div>
                </div>
            </div> --}}

            <div class="form-group">
                <div class="row justify-content-center">
                    <div class="col-md-2 mt-2 d-grid">
                        <button type="submit" class="btn btn-primary">Update</button>
                    </div>
                </div>
            </div>
        </form>


    </div>
</div>


@endsection
@push('custom-scripts')
<script>
    $(document).ready(function() {
        $('#sportType').selectpicker();
        if ($('#checkbox').prop('checked') == true) {
            $("#age_lst").show();
            $(".age_c").attr("required", "true");
        } else {
            $("#age_lst").hide();
        }
        if ($('#experience_required').prop('checked') == true) {
            $(".exp_field").show();
            $("#exp_req").attr("required", "true");
        } else {
            $(".exp_field").hide();
        }


        $("#min_age_from").datepicker({
            changeMonth: true,
            changeYear: true,
            yearRange: "-10:+10",
            minDate: '-60Y',
            maxDate: '60Y',
            dateFormat: 'dd-mm-yy'
        });

        var checkkk = 0;
        $("#start_date").datepicker({
            changeMonth: true,
            changeYear: true,
            minDate: '0',
            yearRange: "0:+10",
            maxDate: '60Y',
            dateFormat: 'dd-mm-yy'
        });
        $("#start_date").change(function() {
            var min = new Date($("#doc").val());
            var st = $("#start_date").datepicker('getDate');
            var start = new Date(st);
            if (checkkk == 0) {
                $("#end_date").datepicker({
                    changeMonth: true,
                    changeYear: true,
                    minDate: start,
                    yearRange: "0:+10",
                    maxDate: '60Y',
                    dateFormat: 'dd-mm-yy'
                });
            } else {
                $("#end_date").datepicker('option', {
                    minDate: start
                });
            }
            checkkk = 1;
        })

        // $(".dateTime").datepicker( { changeMonth: true, changeYear: true, minDate: '0',maxDate: '60Y',dateFormat: 'dd/mm/yy' });
        $('#checkbox').click(function() {

            if ($(this).prop('checked') == true) {
                $("#age_lst").show();
                $(".age_c").attr("required", "true");
            } else {
                $("#age_lst").hide();
                $(".age_c").removeAttr("required");
            }
        });

        $('#experience_required').click(function() {

            if ($(this).prop('checked') == true) {
                $(".exp_field").show();
                $("#exp_req").attr("required", "true");
            } else {
                $(".exp_field").hide();
                $("#exp_req").removeAttr("required");
            }
        });



        //     $("#final_submit").click(function(e) {
        //         e.preventDefault();
        //         $("#form").addClass("was-validated");
        //         if ($("#form").addClass("was-validated")) {
        //             e.stopPropagation();
        //         } else {
        //         var actionUrl = ajaxUrl+"/admin/post_master_add";
        //         var general_post = parseInt($('#general_post').val());
        //         var obc_post = parseInt($('#obc_post').val());
        //         var sc_post = parseInt($('#sc_post').val());
        //         var st_post = parseInt($('#st_post').val());
        //         var ews_post = parseInt($('#ews_post').val());
        //         var pwd_post = parseInt($('#pwd_post').val());

        //         var total_post = parseInt($('#total_post').val());
        //         var cat_post_total=general_post + obc_post + sc_post + st_post + ews_post + pwd_post;

        //         if(cat_post_total == total_post){
        //             $('#form').submit();
        //             $.ajax({
        //             type: "POST",
        //             url: actionUrl,

        //             data: new FormData(this),
        //             success: function(data)
        //             {
        //                 if(data == 1){
        //                     form.submit();
        //                 }else{
        //                     error("Something Error");
        //                 }
        //             }
        //         });

        //         }else{
        //             error("Total Post And category Wise Post Not same.");
        //         }
        //     }
        //     });
    });
</script>
@endpush
