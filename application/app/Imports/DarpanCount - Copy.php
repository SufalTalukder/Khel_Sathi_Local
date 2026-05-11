<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\DB;

class DarpanCount implements ToCollection
{
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {

         foreach ($collection as $key =>$item ) {
        if ($key > 0) {

            $data = [

                'state_code'=> $item[0],
               'state_name'=> $item[1],
               'division_code'=> $item[2],
               'division_name'=>$item[3],
               'district_code'=> $item[4],
               'district_name'=>$item[5],
               'l_value'=> $item[7],
               'k_value'=> $item[6],

            ];



            $data = DB::table('darpan_count')->insert($data);


        }


         }
    }
}
