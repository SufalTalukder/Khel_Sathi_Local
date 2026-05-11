@extends('layouts/admin_layout')
@section('content')


		<div class="pageheader" id="menu-margin">
			<h4 class="mb-0">Sports Event</h4>
		</div>
	
                <div class="row">
                    
                    <div class="col-md-3">
                        <div class="card mb-3">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-11">
                                        <h5>Create Sport Event </h5>
 
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('createSEvent') }}" class="needs-validation" 
                                    novalidate method="post" autocomplete="off">
                                    @csrf
                                       <div class="form-group">
                                                <label for="event_name">Name</label>
                                                <input type="text" class="form-control" id="event_name" name="event_name" required>
                                                <div class="invalid-feedback">
                                                    Please provide an Event Name.
                                                </div>
                                                @if ($errors->has('event_name'))
                                                <span class="error_mess">{{ $errors->first('event_name') }}</span>
                                                @endif
                                            </div>
                                       
                                        <div class="mt-3">
                                            <button class="btn btn-primary form-group" type="submit">Submit/दर्ज करे</button>
                                        </div>
                                </form>
                            </div>
                        </div>
                        </div>

                    
                    <div class="col-md-9">
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-11">
                                        <h5>Sports Event List</h5>
                                          <a  title="Role Manager List" class="btn btn-sm btn-success float-end" onclick="ExportToExcel('xlsx')"><i class="fa fa-file-excel"></i> Export to Excel
                                        </a>
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
                                                    <th width="20%">Event Name</th>
                                                    <th class="text-center">Status</th>
                                                    <th class="text-center">Edit</th>
                                                    <th class="text-center">Delete</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach($sport_event as $key=>$item)
                                                <tr>
                                                    
                                                    <td>{{ $key+1 }}</td>
                                                    <td>{{ $item->event_name }}</td>
                                                    <td class="text-center">
                                                        <div class="form-control2">
                                                            <label class="switch">
                                                                <input type="checkbox" id="themeskin{{ $key+1 }}"
                                                                    <?php if($item->event_status==1){ echo "checked"; }elseif($item->event_status==0){ echo ""; }else{ echo "checked"; } ?>>
                                                                <div class="slider round"
                                                                    onclick="sportEventStatus('{{$item->id}}')">
                                                                    <span class="off">Disable</span>
                                                                    <span class="on">Enable</span>
                                                                </div>
                                                            </label>
                                                        </div>
                                                    </td>
                                                    <td class="text-center">
                                                        <a class="btn btn-sm btn-dark pointer bt role_manager_id"
                                                            href="javascript:void(0)" data-toggle="modal"
                                                            data-target="#exampleModal" data-id="{{$item->id}}"
                                                            data-name="{{$item->event_name}}">
                                                            <i class="far fa-edit"></i>
                                                        </a>
                                                    </td>
                                                    <td class="text-center">
                                                        <a class="btn btn-sm btn-danger pointer bt"
                                                            href="{{url('/admin/deleteSEvent')}}/{{$item->id}}" 
                                                            onclick="return confirm('Are you sure you want to delete ?')">
                                                            <i class="fa fa-trash"></i>
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
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Update Sport Event</h5>
                <button type="button" class="close" data-bs-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
            </div>
            <form action="{{ route('updateSEvent') }}" class="needs-validation" id="document_detail" novalidate
                method="post" autocomplete="off">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-8">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="hidden" class="form-control" id="role_id" name="id">
                                <input type="text" class="form-control" id="role_name" name="event_name" required>
                                <div class="invalid-feedback">
                                    Please provide a Role Manager.
                                </div>
                                @if ($errors->has('name'))
                                <span class="error_mess">{{ $errors->first('name') }}</span>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                    <button class="btn btn-primary" type="submit">Submit/दर्ज करे</button>
                </div>
            </form>
        </div>
    </div>
</div>

@push('custom-scripts')
<script type="text/javascript" src="{{ asset('js/xlsx.full.min.js') }}"></script>
<script>
    function ExportToExcel(type, fn, dl) {
       var elt = document.getElementById('dataTable');
       var wb = XLSX.utils.table_to_book(elt, { sheet: "sheet1" });
       return dl ?
         XLSX.write(wb, { bookType: type, bookSST: true, type: 'base64' }):
         XLSX.writeFile(wb, fn || ('Role Manager List.' + (type || 'xlsx')));
    }
</script> 
@endpush
