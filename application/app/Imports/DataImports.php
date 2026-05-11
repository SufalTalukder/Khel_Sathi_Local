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
class DataImports implements ToCollection
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
	
        foreach ($rows as $row)
        { 
			
			if($row->filter()->isNotEmpty()){
				
				if($row[0] == 6){
					$user = [
						'name' => $row[2],
						'email'    => $row[3],
						'mobile' => $row[4],
						'post_applied_for' => $row[5],
						'address' => $row[6],
						'district' => $row[7],
						'award_achieved' => $row[8],
						'medal_position' => $row[9],
						'month' => $row[10],
						'year' => $row[11],
						'data_frequency' => 2,
						'status' =>  $row[12],
					];
					DB::table('darpan_direct_recru_data')->insert($user);
				}
				if($row[0] == 1){
					
					$user = [
						'name' => $row[2],
						'district' => $row[3],
						'sport_type' => $row[4],
						'email'    => $row[5],
						'mobile' => $row[6],
						'award_name' => $row[7],
						'award_category' => $row[8],
						'amount_release' => $row[9],
						'month' => $row[10],
						'year' => $row[11],
						'data_frequency' => 3,
						'status' =>  $row[12],
					];
					DB::table('darpan_award_data')->insert($user);
				}

				if($row[0] == 2){
					$user = [
						'name' => $row[2],
						'district' => $row[3],
						'sport_type' => $row[4],
						'email'    => $row[5],
						'mobile' => $row[6],
						'award_name' => $row[7],
						// 'award_category' => $row[8],
						'amount_release' => $row[8],
						'month' => $row[9],
						'year' => $row[10],
						'data_frequency' => 3,
						'status' => $row[11],
					];
					DB::table('darpan_financial_assistance_data')->insert($user);
				}

				if($row[0] == 3){
					$user = [
						'name' => $row[1],
						'district' => $row[2],
						// 'championship_level' => $row[3],
						'name_and_location_of_championship' => $row[3],
						'email'    => $row[4],
						'mobile' => $row[5],
						'award_name' => $row[6],
						// 'award_category' => $row[8],
						'amount_release' => $row[7],
						'month' => $row[8],
						'year' => $row[9],
						'data_frequency' => 1,
						'status' =>  $row[10],
					];
					DB::table('darpan_position_holder_data')->insert($user);
				}
				
				
			}
		}
	
   }
}