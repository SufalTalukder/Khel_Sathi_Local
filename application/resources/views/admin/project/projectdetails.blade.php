<div class="table-responsivde">

    <table  id="dataTable" class="table table-striped table-bordered" width="100%">
        <tr> 
            <th>S.No.</th>
            <th>User Name</th>
            <th>Project ID</th>
            <th>Project Name</th>
            <th>Date of Application</th>
            <th>Status</th>
            <th class="text-center">View</th>
        </tr>
        @foreach($collection as $key=>$row)
        <tr>
            <td>{{ $key+1 }}</td>
            <td>{{ $row->fullname }}</td>
            <td>{{ $row->project_id }}</td>
            <td>{{ $row->project_name }}</td>
            <td>{{ dmy($row->application_date) }}</td>
            <td>
                <strong class='btn btn-primary btn-xs btn-block btn-block'>{{ $row->application_status }}</strong>
            </td>
            <td>
                <a href="{{route('projectdeatil', ['id' => $row->id, 'type' => $row->type])}}" class='btn btn-primary btn-xs btn-block'>
                    <i class='fas fa-eye'></i>
                </a>
            </td>
        </tr>
        @endforeach
    </table>
    <div class="row">
        <div class="col-sm-7">
            <div class="col-sm-12 pagignation">
                {!! $collection->links() !!}
            </div>
        </div>
        <div class="col-md-5 text-end">
            <div class="dataTables_info">
                <?= showPages($collection, 'cities'); ?>
            </div>
        </div>
    </div>
</div>
