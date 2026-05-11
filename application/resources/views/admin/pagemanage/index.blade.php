@extends( 'layouts/admin_layout' )
@section( 'content' )


		<div class="pageheader" id="menu-margin">
			<h4 class="mb-0">Page Manager
	        
        	 <a href="{{ route('pageForm') }}" class="btn btn-primary btn-sm float-end">
                <i class="fas fa-plus"></i>
                &nbsp;&nbsp;Add Page
            </a>
             <a  title="Page Manager" class="btn btn-sm btn-success float-end" onclick="ExportToExcel('xlsx')">
			                            <i class="fa fa-file-excel"></i> Export to Excel
			                        </a>
        	</h4>
		</div>
		<div class="card">
			<div class="card-body">
				<div class="">
					<div class="table-responsive">
						<table id="dataTable" class="table table-bordred table-hover bg-white datatable">
							<thead>
								<tr>
									<th>S.No.</th>
									<th>Page Name</th>
									<th>Page URL</th>
									<th>Module</th>
									<!-- <th>Parent</th> -->
									<th>Is menu</th>
									<!-- <th>Status</th> -->
									<th class="text-center">Action</th>
									<th class="text-center">Edit</th>
								</tr>
							</thead>
							<tbody>
								@foreach($page as $key=>$item)
								<tr>

									<td>{{ $key+1 }}</td>

									<td>{{ $item->page_name }}</td>
									<td>{{ $item->page_url }}</td>
									<td>{{ $item->module_name }}</td>
									{{--
									<td>{{ $item->parent_page }}</td> --}}
									<td>
										<?php if($item->is_menu == 1){ echo "Yes"; } else { echo "No"; } ?> </td>
									<!-- <td>{{ $item->page_status==0?'Block':'Active' }}</td> -->

									<td class="text-center" width="20%">
										<div class="btn-group">
											@if($item->page_status==0)
											<div class="form-control2">
												<label class="switch">
                                                    <input type="checkbox" id="themeskin{{ $key+1 }}">
                                                    <div class="slider round" onclick="pageStatus('{{$item->id}}')">
                                                        <span class="off">Inactive</span>
                                                        <span class="on">Active</span>
                                                    </div>
                                                </label>
											
											</div>
											@else
											<div class="form-control2">
												<label class="switch">
                                                    <input type="checkbox" id="themeskin{{ $key+1 }}" checked>
                                                    <div class="slider round" onclick="pageStatus('{{$item->id}}')">
                                                        <span class="off">Inactive</span>
                                                        <span class="on">Active</span>
                                                    </div>
                                                </label>											
											</div>
											@endif
										</div>
									</td>
									<td>
										<a class="btn btn-sm btn-dark pointer bt" href="{{ route('editPage' , $item->id) }}">
                                            <i class="fa fa-edit"></i>
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


@endsection


@push( 'custom-scripts' )
	<script type="text/javascript" src="{{ asset('js/xlsx.full.min.js') }}"></script>
<script>
	function ExportToExcel( type, fn, dl ) {
		var elt = document.getElementById( 'dataTable' );
		var wb = XLSX.utils.table_to_book( elt, {
			sheet: "sheet1"
		} );
		return dl ?
			XLSX.write( wb, {
				bookType: type,
				bookSST: true,
				type: 'base64'
			} ) :
			XLSX.writeFile( wb, fn || ( 'Page Manager.' + ( type || 'xlsx' ) ) );
	}
</script>
@endpush
