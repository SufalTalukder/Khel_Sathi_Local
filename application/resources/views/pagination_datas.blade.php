
<div class="table-responsivde">

    <table  id="dataTable" class="table table-striped table-bordered" width="100%">
        <tr>
            <th width="5%">ID</th>
            <th width="38%">City</th>
            <th width="57%">State ID</th>
        </tr>
        @foreach($collection as $row)
        <tr>
            <td>{{ $row->id }}</td>
            <td>{{ $row->city }}</td>
            <td>{{ $row->state_id }}</td>
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
                <?= showPages($collection,'cities'); ?>
            </div>
        </div>
    </div>
</div>
