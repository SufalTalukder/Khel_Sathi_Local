@extends('layouts/admin_layout')
@section('content')
<div class="row">
            <div class="col-md-12">
               <div class="pageheader" id="menu-margin">
			<h4 class="mb-0">Admission Detail</h4>
		</div>
        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-12">
                        <h5 class="mb-0"> Admission Detail</h5>
                        <a  title="User Manager ExportToExcel" class="btn btn-sm btn-success float-end" onclick="ExportToExcel('xlsx')">
			                            <i class="fa fa-file-excel"></i> Export to Excel
			                        </a>
                    </div>
                    <div class="col-md-12">
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="">
								<div class="table-responsive">
                        <table  id="dataTable" class="table table-bordred table-hover bg-white datatable"
                            >
                            <thead>
                                <tr>
                                    <th width="6%">S.No.</th>
                                    <th width="6%">Application No</th>
                                    <th width="10%">Name</th>
                                    <th width="10%">Email</th>
                                    <!-- <th width="10%">Transaction</th> -->
                                    <th >DOB</th>
                                    <th width="3%">Aadhar_no</th>
                                    <th width="3%">Mobile</th>
                                    <th class="text-center">View</th>
                                </tr>
                            </thead>
                              <tbody>
                                @foreach($lists as $key=>$list)
                                <tr>
                                    <td>{{ $key+1 }}</td>
                                    <td>{{ $list->application_no }}</td>
                                    <td>{{ $list->fullname }}</td> 
                                    <td>{{ $list->email }}</td>
                                   <!--  <td> 12121212</td> -->
                                    <td>{{ $list->dob }}</td> 
                                    <td>{{ $list->aadhar_no }}</td>
                                    <td>{{ $list->mobile }}</td> 
                                    <td class="text-center">
                                        <a class="btn btn-sm btn-danger pointer bt" href="{{url('/admin/online-admission-details/')}}/{{$list->id}}" >
                                            <i class="fa fa-eye"></i>View
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
@push('custom-scripts')
<script type="text/javascript" src="{{ asset('js/xlsx.full.min.js') }}"></script>
<script>
    function ExportToExcel(type, fn, dl) {
       var elt = document.getElementById('dataTable');
       var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
       return dl ?
         XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }):
         XLSX.writeFile(wb, fn || ('UserList.' + (type || 'xlsx')));
    }
</script> 
@endpush
