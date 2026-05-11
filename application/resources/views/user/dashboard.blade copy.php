@extends('layouts/layout')
@section('content')

<div class="tab-content">
    <div class="pagebody removebg-color">
        <div class="pageheader">
            <div class="row">
                <div class="col-md-10">
                    <h4 class="mb-0">Dashboard</h4>
                </div>
                <div class="col-md-2 d-grid">
                    <a class="btn btn-sm btn-dark" href="{{ route('typeofPlant') }}"><i class="fa fa-plus"></i>&nbsp;&nbsp; New Project</a>
                </div>
            </div>
        </div>

        <div class="card">
            <div class="card-header">
                <div class="row">
                    <div class="col-md-11">
                        <h5>Investor Details</h5>
                    </div>
                </div>
            </div>
            <div class="card-body">
                <div class="table-responsive">
                    <table  id="dataTable" class="table table-bordred table-hover bg-white">
                        <thead>
                            <tr>
                                <th>S.No.</th>
                                <th>Project ID</th>
                                <th>Project Name</th>
                                <th>Date of Application</th>
                                <th>Status</th>
                                <th class="text-center">View</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($summary as $key=>$item)

                            <tr>
                                <td>{{ $key+1 }}</td>
                                <td>{{ $item->project_id }}</td>
                                <td>{{ $item->project_name }}</td>
                                <td>{{ dmy($item->application_date) }}</td>
                                <td>
                                    <strong class="btn btn-primary btn-xs btn-block btn-block">Pending</strong>
                                </td>
                                <td class="text-center">
                                    <a href="{{ route('projectdeatils',['id'=>$item->id,'type'=>$item->project_id])}}" class="btn btn-primary btn-xs btn-block">
                                        <i class="fas fa-eye"></i>
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
@endsection