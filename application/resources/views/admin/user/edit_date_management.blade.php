@extends('layouts/admin_layout')
@section('content')

        <div class="pageheader" id="menu-margin">
               

                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="{{route('ad')}}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Add Post</li>
                        </ol>
                    </nav>

               
            </div>

         
                        <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-11">
                                        <h5>Date Management</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">

                                <form action="{{route('dateManangementAdd')}}" id="preregistration" method="post"  class="needs-validation" novalidate>
                                    
                                    @csrf
                                    <div class="row">    
                                        <div class="col-md-3">
                                            <div class="form-group ">
                                                <div class="form-group  ">
                                                    <label class="placeholder">Form<span class="text-danger">*</span></label>
                                                    <select class="form-control" style="cursor: not-allowed;" name="award_type" required>
                                                        <!-- <option disabled value="">Select</option> -->
                                                        @foreach ($award_type as $typee)
                                                        <option  value="{{$typee->id}}"  {{ $item->form_type === $typee->id ? 'selected' : '' }}>{{$typee->name}}</option>
                                                        @endforeach
                                                        
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                          <!--  -->
                                          <div class="col-md-3">
                                            <div class="form-group ">
                                                <label class="placeholder">URL(slug)<span class="text-danger">*</span></label>
                                               <input type="text"  value="{{ ($item->url_slug) }}" class="form-control" name="url_slug" required >
                                            </div>
                                        </div>
                                        <!--  -->
                                        
                                        <input type="hidden" name="id" id="id" value="{{ $item->id }}">
                                        
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="name">Start Date<span class="text-danger">*</span></label>
                                                <!-- <input type="datetime-local" min="<?=date('Y-m-d\Th:i')?>" name="start_date" id="start_date"  autocomplete="off"  class="form-control"  required value="{{ ($item->start_date) }}"> -->
                                                {{-- <input type="datetime-local" name="start_date" id="start_date"  autocomplete="off"  class="form-control date"  required value="{{ ($item->start_date) }}"> --}}
                                                <input type="datetime-local" min="<?=date('Y-m-d\Th:i')?>" name="start_date" id="start_date"  autocomplete="off" class="form-control"  required value="{{ ($item->start_date) }}">
                                                <div class="invalid-feedback">
                                                    Please enter Start Date.
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="name">End Date<span class="text-danger">*</span></label>
                                                <input type="datetime-local" name="end_date"  id="end_date"   autocomplete="off"   class="form-control date" required value="{{ ($item->end_date) }}">
                                                <div class="invalid-feedback">
                                                    Please enter End Date.
                                                </div>
                                            </div>
                                        </div>
                                        
                                        
                                        
                                        <div class="col-md-3">
                                            <div class="form-group">
                                            <label for="name">&nbsp;</label>
                                                <div class="row">
                                                    <div class="col-md-2 d-grid">
                                                        <button type="submit"   class="btn btn-primary">Update</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>


                            </div>
                        </div>

                        <div class="table-responsive">
			<table  id="dataTable" class="table table-bordred table-hover bg-white datatable" >
				<thead>
					<tr>
						<th>S.No.</th>
						<th>Change Type</th>
						<th>Change By</th>
						<th>Ip Address</th>
						<th>Date & Time</th>
					</tr>
				</thead>
				<tbody>
					 @foreach($trail_list as $key=>$item)
					<tr>
						<td>{{ $key+1 }}</td>
						<td>@if($item->type == 1) Add @else Update @endif</td>
						<td>{{ rsoName($item->user_id) }}</td>
						<td>{{ $item->ip_address }}</td>
						<td>{{ dmyHi($item->created_at) }}</td>
						
					</tr>
					@endforeach 
				</tbody>
			</table>
		</div>
            
    @endsection
    @push( 'custom-scripts' )
	<script>
    $(".date").datepicker({
				changeMonth: true,
				changeYear: true,
				minDate: '0',
				// minDate: '-60Y',
				// minDate: new Date(start, 4 - 1, 1),
				// yearRange: yrRange,
				// maxDate: '0',
				dateFormat: 'dd-mm-yy'
			});
            </script>

@endpush
