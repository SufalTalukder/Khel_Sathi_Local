@extends( 'layouts/admin_layout' )
@section( 'content' )


<div class="pageheader" id="menu-margin">
	<h4 class="mb-0">Department</h4>
</div>

<div class="row">


	<div class="col-md-4  update-department">

		<div class="card">
			<div class="card-header">
				<div class="row">
					<div class="col-md-11">
						<h5>Create Department</h5>
					</div>
				</div>
			</div>
			<div class="card-body">
				<form action="{{ route('createDepartment') }}" class="needs-validation" id="reload" novalidate method="post">
					<div class="form-group">
						<label for="name">Name</label>
						<input type="text" class="form-control" id="department" name="department" required>
						<div class="invalid-feedback">
							Please provide a name.
						</div>
					</div>

					<div class="form-group">
						<label for="code">Code</label>
						<input type="text" class="form-control" id="department_code" name="department_code" required>
						<div class="invalid-feedback">
							Please provide a code.
						</div>
					</div>
					<button class="btn btn-primary mt-2" type="submit">Submit/दर्ज करे</button>
				</form>
			</div>
		</div>

	</div>

	<div class="col-md-4 update-from" style="display:none">

		<div class="card">
			<div class="card-header">
				<div class="row">
					<div class="col-md-7">
						<h5>Update Department</h5>
					</div>
					<div class="col-md-5" style="text-align: right;">
						<a href="javascript:void(0)" onclick="backDepartment()" class="btn btn-primary btn-sm float-end">
                                            <i class="fa fa-arrow-left"></i>
                                            &nbsp;&nbsp;Back
                                        </a>
					
					</div>
				</div>
			</div>
			<div class="card-body">
				<form action="{{ route('updateDepartment') }}" class="needs-validation" id="updatedepartment" novalidate method="post">
					<div class="form-group">
						<label for="name">Name</label>
						<input type="text" class="form-control" id="up_department" name="up_department" required>
						<div class="invalid-feedback">
							Please provide a name.
						</div>
					</div>
					<input type="hidden" id="department_id" name="department_id">
					<div class="form-group">
						<label for="code">Code</label>
						<input type="text" class="form-control" id="up_department_code" name="up_department_code" required>
						<div class="invalid-feedback">
							Please provide a code.
						</div>
					</div>
					<button class="btn btn-primary mt-2" type="submit">Update</button>
				</form>
			</div>
		</div>

	</div>


	<div class="col-md-8 update-department">
		<div class="card">
			<div class="card-header">
				<div class="row">
					<div class="col-md-11">
						<h5>Departments List</h5>
					</div>
				</div>
			</div>
			<div class="card-body">
				<div class="">
								<div class="table-responsive">
						<table  id="dataTable" class="table table-bordred table-hover bg-white datatable" >
							<thead>
								<tr>
									<th>S.No.</th>
									<th>Name</th>
									<th>Code</th>
									<th class="text-center">Action</th>
								</tr>
							</thead>
							<tbody>
								@foreach($department as $key=>$item)
								<tr>
									<td>{{ $key+1 }}</td>
									<td id="department{{$item->id}}">{{ $item->department }}</td>
									<td id="department_code{{$item->id}}">{{ $item->department_code }}</td>
									<td class="text-center" width="20%">

										<div class="btn-group">
											@if($item->status==0)
											<div class="form-control2">
												<label class="switch">
                                                                    <input type="checkbox" id="themeskin{{ $key+1 }}">
                                                                    <div class="slider round" onclick="departmentStatus('{{$item->id}}')">
                                                                        <span class="off">Disable</span>
                                                                        <span class="on">Enable</span>
                                                                    </div>
                                                                </label>
											
											</div>
											@else
											<div class="form-control2">
												<label class="switch">
                                                                    <input type="checkbox" id="themeskin{{ $key+1 }}" checked>
                                                                    <div class="slider round" onclick="departmentStatus('{{$item->id}}')">
                                                                        <span class="off">Disable</span>
                                                                        <span class="on">Enable</span>
                                                                    </div>
                                                                </label>
											
											</div>
											@endif

											<a class="pointer bt stateup{{$item->id}}" href="javascript:void(0)" onclick="updateDepartment('{{$item->id}}')">
                                                                <i class="fa fa-pencil"></i>
                                                            </a>
										
										</div>
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
