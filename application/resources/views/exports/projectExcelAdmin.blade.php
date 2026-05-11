<table>
    <tbody>
        <tr>
            <th colspan="5" style="text-align:center;background-color: #fdf8f8;" height="55">
                DEPARTMENT OF ADDITIONAL SOURCES OF ENERGY, GOVERNMENT OF UTTAR PRADESH<br>
                Project List<br> 
            </th>
        </tr>
        <tr>
            <th>User Name</th>
            <th>Project ID</th>
            <th>Project Name</th>
            <th>Date of Application</th>
            <th>Status</th>
        </tr>
        @foreach($collection as $row)
        <tr>
            <td>{{ $row->fullname }}</td>
            <td>{{ $row->id }}</td>
            <td>hello</td>
            <td>{{ dmy($row->status) }}</td>
            <td>
                hello
            </td>
        </tr>
        @endforeach
    </tbody>
</table>
