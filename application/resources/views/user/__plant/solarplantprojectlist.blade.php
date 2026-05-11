@extends('layouts/layout')
@section('content')
<div class="row">
    <div class="col-2">
        <a href="{{ route('dashboard') }}" class="btn btn-outline-primary backbtn"><span class="icons icon-arrow-left"></span> Back to Dashboard</a>
        <div class="left-sidebar">
            <div >
                <ul>
                    <li>
                        <a href="{{ route('cp') }}">
                            <span class="icons icon-arrow-right"></span>Company Profile/Basic Details
                        </a>
                    </li>
                    <li>
                        <a href="{{ url('registered-project') }}" class="active">
                            <span class="icons icon-arrow-right"></span>Project Details
                        </a>
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div class="col-10">
        <div class="col-md-12 pageheader mb-0">
            <div class="row">
                <div class="col-md-10">
                    <h4>Project List</h4>
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="j{{ route('dashboard') }}">Dashboard</a></li>
                            <li class="breadcrumb-item active" aria-current="page">Project List</li>
                        </ol>
                    </nav>
                </div>
                <div class="col-md-2 text-end">
                    <a class="btn btn-sm btn-dark" href="{{ url('typeofPlant') }}"><i class="fa fa-plus"></i>&nbsp;&nbsp; New Project</a>
                </div>
            </div>
        </div>
        <div class="tab-content border-all-side">
            <div class="pagebody sidepage-pading pt-3 pb-3">
                <div class="emp-profile">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="table-responsive">
                                <div class="table-responsive">
                                    <table  id="dataTable" class="table table-bordred table-hover bg-white">
                                        <thead>
                                            <tr>
                                                <th>S.No.</th>
                                                <th>Project ID</th>
                                                <th>Project Name</th>
                                                <th>Date of Application</th>
                                                <th>Preferred Location</th>
                                                <th>Status</th>
                                                <th class="text-center">View</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($summary as $key=>$item)
                                            <tr>
                                                <td>{{ $key+1 }}</td>
                                                <td>{{ $item->project_id }}</td>
                                                <td>{{ $item->project_name }}</td>
                                                <td>{{ dmy($item->application_date) }}</td>
                                                <td><?= getPreferenceStation($item->type, $item->id); ?></td>
                                                <td>
                                                    <strong class='badge bg-light' style="color: black;font-size: 12px;">
                                                        {{ $item->application_status }}
                                                    </strong>
                                                </td>
                                                <td class="text-center">
                                                    <a href="{{ route('projectdeatils',['id'=>$item->id,'type'=>$item->type])}}" class="btn btn-primary btn-xs btn-block">
                                                        <i class="fas fa-eye"></i>
                                                    </a>
                                                </td>
                                                <td class="text-center">
                                                    @if($item->application_status=='Pending')
                                                    <a href="{{ route('projectedit',['id'=>$item->id,'type'=>$item->type])}}" class="btn btn-primary btn-xs btn-block">
                                                        Edit
                                                    </a>
                                                    @endif
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
        </div>
    </div>
    @endsection
