@extends( 'layouts/admin_layout' )
@section( 'content' )


<div class="pageheader" id="menu-margin">
	<h4 class="mb-0">Module Manager
		<a href="{{ route('moduleCreate') }}" class="btn btn-primary btn-sm float-end">
			<i class="fa fa-arrow-left"></i>
			&nbsp;&nbsp;Back
		</a>
	</h4>
</div>
<div class="card">
	<div class="card-header">
		<div class="row">
			<div class="col-md-10">
				<h5>Create Module</h5>
			</div>
			<div class="col-md-2" style="text-align: right;">

			</div>
		</div>
	</div>
	<div class="card-body">
		<form action="{{ route('createModule') }}" class="needs-validation row" novalidate method="post">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
						<label for="name">Module Name</label>
						<input type="text" class="form-control alphanumeric" id="modulename" name="modulename" required>
						<div class="invalid-feedback">
							Please provide a module name.
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="code">Module URL</label>
						<input type="test" class="form-control" id="moduleurl" name="moduleurl" required>
						<div class="invalid-feedback">
							Please provide a module url.
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="code">Menu Order</label>
						<input type="number" class="form-control" id="menuorder" name="menuorder" required>
						<div class="invalid-feedback">
							Please provide a menu order.
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="ismenu">Is Menu</label>
						<select class="form-select" id="ismenu" name="ismenu" required>
							<option value="1">Yes</option>
							<option value="2">No</option>
						</select>
						<div class="invalid-feedback">
							Please provide a code.
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label for="status">Status</label>
						<select class="form-select" id="status" name="status" required>
							<option value="1">Active</option>
							<option value="0" selected>Inactive</option>
						</select>
						<div class="invalid-feedback">
							Please provide a code.
						</div>
					</div>
				</div>
				<div class="col-md-6">
					<div class="form-group">
						<label class="form-label">Icon</label>
						<div class="icon-group">
							<input type="radio" class="btn-check" name="options" id="icon-op1" value="icon icon-grid" checked autocomplete="off">
							<label class="btn btn-icon" for="icon-op1"><span class="icon icon-grid"></span></label>
							<input type="radio" class="btn-check" name="options" id="icon-op2" value="icon icon-note" autocomplete="off">
							<label class="btn btn-icon" for="icon-op2"><span class="icon icon-note"></span></label>
							<input type="radio" class="btn-check" name="options" id="icon-op3" value="icon icon-globe" autocomplete="off">
							<label class="btn btn-icon" for="icon-op3"><span class="icon icon-globe"></span></label>
							<input type="radio" class="btn-check" name="options" id="icon-op4" value="icon icon-share-alt" autocomplete="off">
							<label class="btn btn-icon" for="icon-op4"><span class="icon icon-share-alt"></span></label>
							<input type="radio" class="btn-check" name="options" id="icon-op5" value="icon icon-eye" autocomplete="off">
							<label class="btn btn-icon" for="icon-op5"><span class="icon icon-eye"></span></label>
							<input type="radio" class="btn-check" name="options" id="icon-op6" value="icon icon-docs" autocomplete="off">
							<label class="btn btn-icon" for="icon-op6"><span class="icon icon-docs"></span></label>
							<input type="radio" class="btn-check" name="options" id="icon-op7" value="icon icon-shield" autocomplete="off">
							<label class="btn btn-icon" for="icon-op7"><span class="icon icon-shield"></span></label>
							<input type="radio" class="btn-check" name="options" id="icon-op8" value="icon icon-graduation" autocomplete="off">
							<label class="btn btn-icon" for="icon-op8"><span class="icon icon-graduation"></span></label>
							<input type="radio" class="btn-check" name="options" id="icon-op9" value="icon icon-grid" autocomplete="off">
							<label class="btn btn-icon" for="icon-op9"><span class="icon icon-bell"></span></label>
							<input type="radio" class="btn-check" name="options" id="icon-op10" value="icon icon-share-alt" autocomplete="off">
							<label class="btn btn-icon" for="icon-op10"><span class="icon icon-share-alt"></span></label>
							<input type="radio" class="btn-check" name="options" id="icon-op11" value="icon icon-puzzle" autocomplete="off">
							<label class="btn btn-icon" for="icon-op11"><span class="icon icon-puzzle"></span></label>
							<input type="radio" class="btn-check" name="options" id="icon-op12" value="icon icon-folder-alt" autocomplete="off">
							<label class="btn btn-icon" for="icon-op12"><span class="icon icon-folder-alt"></span></label>
							<input type="radio" class="btn-check" name="options" id="icon-op13" value="icon icon-directions" autocomplete="off">
							<label class="btn btn-icon" for="icon-op13"><span class="icon icon-directions"></span></label>
							<input type="radio" class="btn-check" name="options" id="icon-op14" value="icon icon-user-follow" autocomplete="off">
							<label class="btn btn-icon" for="icon-op14"><span class="icon icon-user-follow"></span></label>
							<input type="radio" class="btn-check" name="options" id="icon-op15" value="icon icon-people" autocomplete="off">
							<label class="btn btn-icon" for="icon-op15"><span class="icon icon-people"></span></label>
							<input type="radio" class="btn-check" name="options" id="icon-op16" value="icon icon-organization" autocomplete="off">
							<label class="btn btn-icon" for="icon-op16"><span class="icon icon-organization"></span></label>
							<input type="radio" class="btn-check" name="options" id="icon-op17" value="icon icon-crop" autocomplete="off">
							<label class="btn btn-icon" for="icon-op17"><span class="icon icon-crop"></span></label>
							<input type="radio" class="btn-check" name="options" id="icon-op18" value="icon icon-speedometer" autocomplete="off">
							<label class="btn btn-icon" for="icon-op18"><span class="icon icon-speedometer"></span></label>
						</div>
					</div>
				</div>
			</div>
			<div class="row justify-content-center">
				<div class="col-md-2">
					<div class="form-group d-grid">
						<button class="btn btn-primary mt-2" type="submit">Submit/दर्ज करे</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>


@endsection
