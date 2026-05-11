<?php
namespace App\Imports;
use App\Customer;
use App\User;
use App\Courses;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
class Resultupdate implements ToCollection
{
   /**
   * @param array $row
   *
   * @return \Illuminate\Database\Eloquent\Model|null
   */

//    public function model(array $row)
//     {
// 		//dd($row);
// 		if(isset($row[1])){
// 			if($row[0]!='zone_name'){
// 				return new SubStations([
// 					'zone_name'     => $row[0],
// 					'voltage_capacity_kv'    => $row[1],
// 					'district_name' => $row[2],
// 					'name' => $row[3],
// 					'voltage_ratio_kv' => $row[4],
// 					'capacity_mva' => $row[5]
// 				]);
// 			}
// 		}
//     }
    public function collection(Collection $rows)
    {

        foreach ($rows as $key=>$row)
        {

			if($key > 0){

                
              $userdata =  DB::table('admission_registration_login')->where('application_no', $row[0])->first();     
                
       
              if($userdata){
                    $user = [
                        'physical_trial_one_marks' => $row[4],
                        'skill_trial_one_marks' => $row[5],
                    ];


                    if($row[4] < 20 || $row[5] < 20){
                        $user['trial_type'] = 4;
                    }else{
                        $user['trial_type'] = 2;
                    }
                    
                    DB::table('admission_registration_login')->where('application_no', $row[0])->update($user);
                 
                    }
                 
				


			}
		}

   }
}
