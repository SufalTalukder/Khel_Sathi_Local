@extends('layouts/admin_layout')
@section('content')


<style>
    .pagination {
        display: -ms-flexbox;
        display: flex;
        padding-left: 0;
        list-style: none;
        border-radius: 0.25rem;
    }

    .page-item:first-child .page-link {
        margin-left: 0;
        border-top-left-radius: 0.25rem;
        border-bottom-left-radius: 0.25rem;
    }

    .page-link {
        position: relative;
        display: block;
        padding: 0.5rem 0.75rem;
        margin-left: -1px;
        line-height: 1.25;
        color: #007bff;
        background-color: #fff;
        border: 1px solid #dee2e6;
    }

    a {
        color: #007bff;
        text-decoration: none;
        background-color: transparent;
    }

    .page-item:last-child .page-link {
        border-top-right-radius: 0.25rem;
        border-bottom-right-radius: 0.25rem;
    }

    .page-item.active .page-link {
        z-index: 3;
        color: #fff;
        background-color: #007bff;
        border-color: #007bff;
    }
</style>

<div class="container-fluid pagecontentbody">
    <div class="tab-content">
        <div class="pagebody removebg-color">
            <div class="pageheader">
                <h4 class="mb-0">Dashboard</h4>
            </div>
            <div class="card mb-5">
                <div class="card-header">
                    <div class="row">
                        <div class="col-md-11">
                            <h5>Project Details</h5>
                        </div>
                    </div>
                </div>
                <div class="card-body">
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
                                    <option value="-1">All</option>
                                </select> entries
                            </label>
                        </div>
                        <div class="col-md-6 text-end">
                            <label>Search:
                                <input type="search" placeholder="Search..." name="table_search" id="table_search" class="table-form-control">
                            </label>
                        </div>
                    </div>
                    <div id="table_data">
                        @include('pagination_datas')
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@push('custom-scripts')
<script type="text/javascript">

</script>
@endpush
