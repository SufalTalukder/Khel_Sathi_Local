<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public $searchColumn;
    public $tableName;
    public $queryCollection;

    function tableCollection(Request $request)
    {
        if ($request->ajax()) {

            $this->tableName = tables();
            $data = DB::table($this->tableName)->select('city','state_id','id');

            if ($request->search != '') {
                $this->searchColumn = '%' . $request->search . '%';
                $data->where(function ($query) {
                    $item = DB::select("SHOW COLUMNS FROM $this->tableName WHERE Type LIKE '%varchar%'");
                    foreach ($item as $key => $column) {
                        if ($key == 0) {
                            $query->where($column->Field, 'like', $this->searchColumn);
                        } else {
                            $this->queryCollection->orWhere($column, 'like', 'T%');
                        }
                    }
                });
            }

            $collection = $data->paginate($request->lenght);
            return view('pagination_datas', compact('collection'))->render();
        }
    }
}
