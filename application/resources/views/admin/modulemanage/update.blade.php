@extends( 'layouts/admin_layout' )
@section( 'content' )


<div class="pageheader" id="menu-margin">
	<h4 class="mb-0">Upadte Module <a href="{{ route('moduleCreate') }}" class="btn btn-primary btn-sm float-end">
			<i class="fa fa-arrow-left"></i>
			&nbsp;&nbsp;Back
		</a>
	</h4>
</div>
<div class="card">
	<div class="card-body">
		<form action="{{ route('updateModule',$module->id) }}" class="needs-validation row" novalidate method="post">
			<div class="row">
				<div class="col-md-3">
					<div class="form-group">
						<label for="name">Module Name</label>
						<input type="text" class="form-control" id="module_name" name="module_name" value="{{ $module->module_name }}" required>
						<div class="invalid-feedback">
							Please provide a module name.
						</div>
					</div>
				</div>
				<div class="col-md-3">
					<div class="form-group">
						<label for="code">Module URL</label>
						<input type="text" class="form-control" id="module_url" name="module_url" value="{{ $module->module_url }}" required>
						<div class="invalid-feedback">
							Please provide a module url.
						</div>
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label for="code">Menu Order</label>
						<input type="number" class="form-control" id="menu_order" name="menu_order" value="{{ $module->menu_order }}" required>
						<div class="invalid-feedback">
							Please provide a menu order.
						</div>
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label for="ismenu">Is Menu</label>
						<select class="form-select" id="is_menu" name="is_menu" required>
							<option value="1" @if($module->is_menu==1) selected @endif >Yes</option>
							<option value="2" @if($module->is_menu==2) selected @endif >No</option>
						</select>
						<div class="invalid-feedback">
							Please provide a code.
						</div>
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label for="status">Status</label>
						<select class="form-select" id="module_status" name="module_status" required>
							<option value="1" @if($module->module_status==1) selected @endif>Active</option>
							<option value="0" @if($module->module_status==0) selected @endif>Inactive</option>
						</select>
						<div class="invalid-feedback">
							Please select status.
						</div>
					</div>
				</div>
				<div class="col-md-12">
					<div class="form-group">
						<label class="form-label">Icon</label>
						<div class="icon-group">
							@foreach($icon as $key=>$item)
							<input type="radio" class="btn-check" name="menu_icon" id="icon-op{{$key}}" value="{{$item->value}}" @if($module->menu_icon==$item->value) checked @endif autocomplete="off">
							<label class="btn btn-icon" for="icon-op{{$key}}"><span class="{{$item->value}}"></span></label> @endforeach
						</div>
					</div>
				</div>
			</div>
			<div class="row justify-content-center mt-3">
				<div class="col-md-2">
					<div class="form-group mb-2 d-grid">
						<button class="btn btn-primary" type="submit">Update</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>


@endsection
