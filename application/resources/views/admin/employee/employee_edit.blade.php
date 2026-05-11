@extends( 'layouts/admin_layout' )
@section( 'content' )

                    
                            <div class="pageheader" id="menu-margin">
                                <h4 class="mb-0">Employee Edit</h4>
                            </div>
                            
                            <div class="card mb-3">
                                
                                <div class="card-body">
                            <form action="{{url('admin/employee_update')}}/{{encrypt($edit_template->id)}}" class="needs-validation"
                            novalidate method="post">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="employee_id">Employee ID</label>
                                        <input type="text" class="form-control" id="employee_id" name="employee_id"   oninput="this.value = this.value.replace(/[^a-z0-9 ]/gi, '')" value="<?php echo $edit_template->employee_id; ?>" />
                                        <div class="invalid-feedback">
                                            Please provide employee id.
                                        </div>
                                        @if ($errors->has('employee_id'))
                                        <span class="error_mess">{{ $errors->first('employee_id') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="employee_name">Employee Name<span class="text-danger">*</span></label>
                                        <input type="text" class="form-control" id="employee_name" name="employee_name"  required=" " onkeydown="return /[a-z ]/i.test(event.key)" value="<?php echo $edit_template->employee_name; ?>" />
                                        <div class="invalid-feedback">
                                            Please provide employee name.
                                        </div>
                                        @if ($errors->has('employee_name'))
                                        <span class="error_mess">{{ $errors->first('employee_name') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="employee_father_name">Employee Father Name</label>
                                        <input type="text" class="form-control" id="employee_father_name" name="employee_father_name" onkeydown="return /[a-z ]/i.test(event.key)" value="<?php echo $edit_template->employee_father; ?>" />
                                        <div class="invalid-feedback">
                                            Please provide employee father name.
                                        </div>
                                        @if ($errors->has('employee_father_name'))
                                        <span class="error_mess">{{ $errors->first('employee_father_name') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="employee_mother_name">Employee Mother Name</label>
                                        <input type="text" class="form-control" id="employee_mother_name" name="employee_mother_name" onkeydown="return /[a-z ]/i.test(event.key)" min="<?php echo date("Y-m-d"); ?>" value="<?php echo $edit_template->employee_mother ; ?>" />
                                        <div class="invalid-feedback">
                                            Please provide employee mother name.
                                        </div>
                                        @if ($errors->has('employee_mother_name'))
                                        <span class="error_mess">{{ $errors->first('employee_mother_name') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="employee_mobile">Employee Mobile No.
                                        </label>
                                        <input type="text" pattern="[6-9][0-9]{9}" minlength="10" maxlength="10" class="form-control" id="employee_mobile" name="employee_mobile"   value="<?php echo $edit_template->employee_mobile; ?>" />
                                        <div class="invalid-feedback">
                                            Please provide employee mobile.
                                        </div>
                                        @if ($errors->has('employee_mobile'))
                                        <span class="error_mess">{{ $errors->first('employee_mobile') }}</span>
                                        @endif
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="employee_email">Employee Email
                                        </label>
                                        <input type="email" class="form-control" id="employee_email" name="employee_email"   value="<?php echo $edit_template->employee_email; ?>" />
                                        <div class="invalid-feedback">
                                            Please provide employee email.
                                        </div>
                                        @if ($errors->has('employee_email'))
                                        <span class="error_mess">{{ $errors->first('employee_email') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="employee_designation">Employee Designation<span class="text-danger">*</span>
                                        </label>
                                        <input type="text" class="form-control" id="employee_designation" name="employee_designation"  required=" " onkeydown="return /[a-z]/i.test(event.key)" value="<?php echo $edit_template->employee_designation; ?>" />
                                        <div class="invalid-feedback">
                                            Please provide employee designation.
                                        </div>
                                        @if ($errors->has('employee_designation'))
                                        <span class="error_mess">{{ $errors->first('employee_designation') }}</span>
                                        @endif
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="employee_dob">Employee DOB
                                        </label>
                                        <input type="date" class="form-control" id="employee_dob" name="employee_dob"  value="<?php echo $edit_template->employee_dob; ?>"  />
                                        <div class="invalid-feedback">
                                            Please provide employee DOB.
                                        </div>
                                        @if ($errors->has('employee_dob'))
                                        <span class="error_mess">{{ $errors->first('employee_dob') }}</span>
                                        @endif
                                    </div>
                                </div>

                                 <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="employee_rank">Employee Rank
                                        </label>
                                        <input type="text" class="form-control" id="employee_rank" name="employee_rank"  onkeydown="return /[a-z]/i.test(event.key)"  value="<?php echo $edit_template->employee_rank; ?>" />
                                        <div class="invalid-feedback">
                                            Please provide employee rank.
                                        </div>
                                        @if ($errors->has('employee_rank'))
                                        <span class="error_mess">{{ $errors->first('employee_rank') }}</span>
                                        @endif
                                    </div>
                                </div>

                                 <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="year_of_appointment">Year of Appointment
                                        </label>
                                         <select class="form-control" name="year_of_appointment" >
                                            <option value="0">--year--</option>
                                            <?php
                                            for ($year = (int)date('Y'); 1900 <= $year; $year--): ?>
                                            <option value="<?=$year;?>" {{ ( $year == $edit_template->year_of_appointment) ? 'selected' : '' }}><?=$year;?></option>
                                            <?php endfor; ?>
                                        </select>
                                        <div class="invalid-feedback">
                                            Please provide employee year of appointment.
                                        </div>
                                        @if ($errors->has('year_of_appointment'))
                                        <span class="error_mess">{{ $errors->first('year_of_appointment') }}</span>
                                        @endif
                                    </div>
                                </div>

                                 <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="employee_gender">Employee Gender<span class="text-danger">*</span>
                                        </label><br/>
                                        <input type="radio" {{ $edit_template->employee_gender == '1' ? 'checked' : ''}} name="employee_gender" value="1"> Male
                                        <input type="radio" {{ $edit_template->employee_gender == '0' ? 'checked' : ''}} name="employee_gender" value="0"> Female
                                        <div class="invalid-feedback">
                                            Please provide employee gender.
                                        </div>
                                        @if ($errors->has('employee_gender'))
                                        <span class="error_mess">{{ $errors->first('employee_gender') }}</span>
                                        @endif
                                    </div>
                                </div>

                                </div>
                                <div class="row">
                                    <div class="col-sm-4">
                                        <br><button class="btn btn-primary form-group" type="submit" style="width: inherit">Update</button>
                                    </div>
                                </div>
                            </form>
                           </div>
                            </div>
           
@endsection 
@push('custom-scripts')
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.4/jquery.min.js"></script>
<script type="text/javascript">
   $(document).ready(function(){
        $("#work_start_date").change(function(){
        var date = $("#work_start_date").val();
        $("#work_completion_date").attr("min", date);
   });
});  
</script>
@endpush
