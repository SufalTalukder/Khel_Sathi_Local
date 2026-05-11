@extends( 'layouts/admin_layout' )
@section( 'content' )

<div class="pageheader" id="menu-margin">
	<h4 class="mb-0">Update Page
		<a href="{{ route('pageCreate') }}" class="btn btn-primary btn-sm float-end">
			<i class="fa fa-arrow-left"></i>
			&nbsp;&nbsp;Back
		</a>
	</h4>
</div>
<div class="card">
	<div class="card-body">
		<form action="{{ route('updatePage',$page->id) }}" class="needs-validation row" id="reloadd" novalidate method="post">
			<div class="row">
				<div class="col-md-4">
					<div class="form-group">
						<label for="name">Page Name</label>
						<input type="text" class="form-control" id="page_name" name="page_name" value="{{ $page->page_name }}" required>
						<div class="invalid-feedback">
							Please provide a page name.
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="code">Page URL</label>
						<input type="text" class="form-control" id="page_url" name="page_url" value="{{ $page->page_url }}" required>
						<div class="invalid-feedback">
							Please provide a page url.
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="status">Module</label>
						<select class="form-select" id="module_id" name="module_id" onchange="getParent(this.value)" required>
							<option value="">Select Module</option>
							@foreach($module as $item)
							<option value="{{ $item->id }}" @if($page->module_id==$item->id) selected @endif >{{ $item->module_name}}</option>
							@endforeach
						</select>
						<div class="invalid-feedback">
							Please select module
						</div>
					</div>
				</div>
				<div class="col-md-4">
					<div class="form-group">
						<label for="status">Parent</label>
						<select class="form-select" id="page_parent" name="page_parent">
							<option value="">Select Parent</option>
							@foreach($pageCollection as $item)
							<option value="{{ $item->id}}" @if($page->page_parent==$item->id) selected @endif >{{ $item->page_name}}</option>
							@endforeach
						</select>
						<div class="invalid-feedback">
							Please select parent.
						</div>
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label for="is_menu">Is Menu</label>
						<select class="form-select" id="is_menu" name="is_menu" required>
							<option value="1" <?php if (isset($page->is_menu) && $page->is_menu == 1) {
													echo "selected";
												} ?>>Yes</option>
							<option value="2" <?php if (isset($page->is_menu) && $page->is_menu == 2) {
													echo "selected";
												} ?>>No</option>
						</select>
						<div class="invalid-feedback">
							Please provide a code.
						</div>
						@if ($errors->has('is_menu'))
						<span class="error_mess">{{ $errors->first('is_menu') }}</span> @endif
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label for="code">Order</label>
						<input type="number" class="form-control" id="page_order" name="page_order" value="{{ $page->page_order }}" required>
						<div class="invalid-feedback">
							Please provide a order.
						</div>
					</div>
				</div>
				<div class="col-md-2">
					<div class="form-group">
						<label for="status">Status</label>
						<select class="form-select" id="page_status" name="page_status" required>
							<option value="1" @if($page->page_status==1) selected @endif>Active</option>
							<option value="0" @if($page->page_status==0) selected @endif>Inactive</option>
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
							@foreach($icon as $key=>$icon_list)
							<input type="radio" class="btn-check" name="menu_icon" id="icon-op{{$key+1}}" value="{{$icon_list->value}}" <?php if (isset($page->menu_icon) && $page->menu_icon == $icon_list->value) {
																																			echo "checked";
																																		} ?> autocomplete="off">
							<label class="btn btn-icon" for="icon-op{{$key+1}}"><span class="{{$icon_list->value}}"></span></label> @endforeach

						</div>
					</div>
				</div>
			</div>
			<div class="row justify-content-center mt-3">
				<div class="col-md-2">
					<div class="form-group  d-grid">
						<button class="btn btn-primary" type="submit">Update</button>
					</div>
				</div>
			</div>
		</form>
	</div>
</div>


@endsection
