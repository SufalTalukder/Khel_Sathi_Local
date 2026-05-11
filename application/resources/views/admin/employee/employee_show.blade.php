@extends( 'layouts/admin_layout' )
@section( 'content' )
 
            <div class="pageheader" id="menu-margin">
                <h4 class="mb-0">Employee List</h4>
            </div> 
           <div class="row">
            <div class="card">
                <div class="card-header">
                    <h5>&nbsp;<a href="{{url('admin/add-employee')}}" class="btn btn-primary btn-sm float-end">Add Employee</a></h5>    
                </div>
                <div class="card-body">
                    <div class="">
								<div class="table-responsive">
                            <table   class="table table-bordred table-hover bg-white datatable display"   style="width:100%"
                                >
                                <thead>
                                    <tr>
                                        <!-- <th with="3%"> <input type="checkbox" id="checkAll"> Select All</th> -->
                                       <th>S.No.</th>
                                        <th>Employee ID</th>
                                        <th>Employee Name</th>
                                        <th>Employee Father Name</th>
                                        <th>Employee Mother Name</th>
                                        <th>Employee Mobile No</th>
                                        <th>Employee Email</th>
                                        <th>Employee Designation</th>                              
                                        <th>Employee DOB</th>                              
                                        <th>Employee Gender</th>                              
                                        <th>Employee Rank</th>                              
                                        <th>Year of Appointment</th>                              
                                        <th>Added By</th>                              
                                        <th>Action</th>                                    
                                    </tr>
                                </thead>
                                <tbody>
                                <?php foreach ($template_manager as $key=>$template_data) { ?>
                                  
                                    <tr>                                                 
                                       <td>{{ $key+1 }}</td>
                                       <td>{{$template_data->employee_id ? $template_data->employee_id : 'NA' }}</td>
                                       <td>{{$template_data->employee_name ? $template_data->employee_name : 'NA'  }}</td>
                                       <td>{{$template_data->employee_father ? $template_data->employee_father : 'NA'  }}</td>
                                       <td>{{$template_data->employee_mother ? $template_data->employee_mother : 'NA'  }}</td>
                                       <td>{{$template_data->employee_mobile ? $template_data->employee_mobile : 'NA'  }}</td>
                                       <td>{{$template_data->employee_email ? $template_data->employee_email : 'NA'  }}</td>
                                       <td>{{$template_data->employee_designation ? $template_data->employee_designation : 'NA'  }}</td>
                                       <td>@if(!empty($template_data->employee_dob) && $template_data->employee_dob != '0000-00-00')
    {{ date('d-m-Y', strtotime($template_data->employee_dob)) }} @else NA @endif</td>
                                       <td>{{$template_data->employee_gender == '1' ? "Male" : "Female" }}</td>
                                       <td>{{$template_data->employee_rank ? $template_data->employee_rank : 'NA'  }}</td>
                                       <td>{{$template_data->year_of_appointment ? $template_data->year_of_appointment : 'NA'  }}</td>
                                       <td>{{$template_data->created_by ? admin_name($template_data->created_by) : 'NA'  }}</td>
                                       <td>                                                   
                                        <a href="{{url('admin/employee_edit')}}/{{encrypt($template_data->id)}}" class="btn btn-primary btn-sm"><i class="icon icon-note"></i></a>
                                        <form action="{{url('admin/employee_destroy')}}/{{encrypt($template_data->id)}}" method="post" style="display: inline-block">
                                            @csrf
                                            <button class="btn btn-danger btn-sm" type="submit"><i class="fa fa-remove" aria-hidden="true"></i></button>
                                        </form>
                                        </td>                                                
                                        </tr>
                                <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

@endsection 
@push('custom-scripts')
<script type="text/javascript">
    $(document).ready(function() {
    $('#dataTable').DataTable( {
        dom: 'Bfrtip',
        buttons: [
            'excelHtml5',
            'csvHtml5',
            'pdfHtml5'
        ]
    } );
} );
</script>

<script type="text/javascript" src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.6/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/2.3.6/js/buttons.html5.min.js"></script>
@endpush
