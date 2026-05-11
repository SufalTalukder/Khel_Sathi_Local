@extends('layouts/department_layout')
@section('content')

            <div class="pageheader">
                <h4 class="mb-0">Dashboard</h4>
            </div>

            <div class="card mb-5">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-7">
                            <h5>Project Details</h5>
                        </div>
                    </div>

                </div>

                <div class="card-body">


                    <div class="mb-4">
                        <form class="row">
                            <div class="col-md-3">
                                <label for="project_filter">Project</label>
                                <select class="form-control" id="project_filter" name="project_filter" onchange="handeChange(this)">
                                    <option value="">--Select--</option>
                                    <option value="SG001">Solar Power Project PPA with UPPCL</option>
                                    <option value="SG002">Solar Power Project under Open Access</option>
                                    <option value="SG003">Solar Power Park Public Sector</option>
                                    <option value="SG004">Solar Power Park Private Sector</option>
                                    <option value="SG005">Solar Project with Storage</option>
                                    <option value="SG006">Solar Project with Storage</option>
                                    <option value="SG007">Solarization of PTW</option>
                                    <option value="SG008">Solar Roof Top in Government Buildings</option>
                                </select>

                            </div>

                            <div class="col-md-2">
                                <label for="status_filter">Status</label>
                                <select class="form-control" id="status_filter" name="status_filter" onchange="handeChange(this)">
                                    <option value="">--Select--</option>
                                    <option value="Pending">Pending</option>
                                    <option value="Approved">Approved</option>
                                    <option value="Forwarded">Forwarded</option>
                                    <option value="Reverted">Reverted</option>
                                </select>
                            </div>

                            <div class="col-md-2">
                                <label for="city_filter">City</label>
                                <select class="form-control" id="city_filter" name="city_filter" onchange="handeChange(this)">
                                    <option value="">--Select--</option>
                                    @foreach($cities as $city)
                                    <option value="{{ $city->id }}">{{ $city->city }}</option>
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-2">
                                <label for="from_date">From Date</label>
                                <input readonly name="from_date" onchange="handeChange(this)" id="from_date" type="text" required class="form-control datepicker-here" placeholder="From Date" data-language="en">
                            </div>
                            <div class="col-md-2">
                                <label for="to_date">To Date</label>
                                <input readonly name="to_date" id="to_date" onchange="handeChange(this)" type="text" required class="form-control datepicker-here" placeholder="To Date" data-language="en">
                            </div>
                            <div class="col-md-1">
                                <label for="reset">&nbsp;</label>
                                <button type="reset" class="btn btn-info  btn-block" onclick="resetButton()">
                                    Reset
                                </button>
                            </div>
                        </form>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <label>Show
                                <select name="table_length" id="table_length" class="table-form-control">
                                    <option value="5">5</option>
                                    <option value="10">10</option>
                                    <option value="25">25</option>
                                    <option value="50">50</option>
                                    <option value="100">100</option>
                                    <option value="200">200</option>
                                    <!--option value="-1">All</option--->
                                </select> entries
                            </label>
                        </div>
                        <div class="col-md-6 text-end">
                            <label>Search:
                                <input type="search" placeholder="Search..." onchange="searchCollection(this.value);" onkeyup="this.onchange();" onpaste="this.onchange();" oncut="this.onchange();" oninput="this.onchange();" name="table_search" id="table_search" class="table-form-control">
                            </label>
                        </div>
                    </div>
                    <div id="table_data_department"></div>
                </div>
            </div>



@endsection

@push('custom-scripts')
<script type="text/javascript">

</script>
@endpush
