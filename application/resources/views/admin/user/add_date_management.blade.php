@extends('layouts/admin_layout')
@section('content')

        <div class="pageheader" id="menu-margin">
            <div class="row">

                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb">
                        <li class="breadcrumb-item"><a href="{{route('ad')}}">Dashboard</a></li>
                        <li class="breadcrumb-item active" aria-current="page">Add Post</li>
                    </ol>
                </nav>

            </div>
        </div>

           <div class="card">
                            <div class="card-header">
                                <div class="row">
                                    <div class="col-md-11">
                                        <h5>Date Management </h5>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">

                                <form action="{{route('dateManangementAdd')}}" id="date_management" enctype="multipart/form-data" method="post"  class="needs-validation" novalidate>
                                    
                                @csrf
                                <div class="row">
                                        <div class="col-md-3">
                                            <div class="form-group ">
                                                <label class="placeholder">Form<span class="text-danger">*</span></label>
                                                <select  id="award_type" class="form-control selectpicker" name="award_type" required>
                                                    <!-- <option disabled value="">Select</option> -->
                                                    @foreach ($award_type as $type)
                                                    <option  value="{{$type->id}}"  <?php  if(in_array($type->id,$award)) echo 'disabled'; ?> {{ old('award_type') === $type->id ? 'selected' : '' }}>{{$type->name}}</option>
                                                    @endforeach
                                                    
                                                </select>
                                            </div>
                                        </div>
                                       
                                        <!--  -->
                                        <div class="col-md-3">
                                            <div class="form-group ">
                                                <label class="placeholder">URL(slug)<span class="text-danger">*</span></label>
                                               <input type="text" class="form-control" name="url_slug" required >
                                            </div>
                                        </div>
                                        <!--  -->
                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="name">Start Date / Time <span class="text-danger">*</span></label>
                                                <input type="datetime-local" min="<?=date('Y-m-d\Th:i')?>" name="start_date" id="start_date"  autocomplete="off" class="form-control"  required value="@if(old('start_date')){{ dmyHi(old('start_date')) }}@endif">
                                                <div class="invalid-feedback">
                                                    Please enter Start Date.
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-3">
                                            <div class="form-group">
                                                <label for="name">End Date / Time <span class="text-danger">*</span></label>
                                                <input type="datetime-local" name="end_date" min="<?=date('Y-m-d\Th:i')?>" id="end_date"   autocomplete="off"  class="form-control" required value="@if(old('end_date')){{ dmyHi(old('end_date')) }}@endif">
                                                <div class="invalid-feedback">
                                                    Please enter End Date.
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group">
                                            <label for="name">&nbsp;</label>
                                                <div class="row">
                                                
                                                    <div class="col-md-2  d-grid">
                                                    
                                                        <!-- <button type="button"   class="btn btn-primary">Add</button> -->
                                                        <button type="submit"   class="btn btn-primary">Add</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                </form>


                            </div>
                        </div>
    @endsection
