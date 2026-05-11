<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
class ImportSendSms implements ToCollection
{
    public $number; 
    /**
    * @param Collection $collection
    */
    public function collection(Collection $collection)
    {
        // dd($collection);
        // $number ="";
         foreach ($collection as $key =>$row ) {
        if ($key > 0) {
            if($row->filter()->isNotEmpty()){
                $this->number[] = $row[2];
            }
            
        }
         }
       
         return $this->number;
    }
}
