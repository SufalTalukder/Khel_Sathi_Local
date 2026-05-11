<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsOnError;
use Illuminate\Support\Facades\DB;

use Maatwebsite\Excel\Concerns\SkipsErrors;
class Trial_import_state implements ToCollection
{
    /**
     * @param Collection $collection
     */

    public function collection(Collection $collection)
    {



        foreach ($collection as $item) {
       if($item->filter()->isNotEmpty()){
            if ($item[1]) {
                $user =  DB::table('hostel_register')->leftJoin('hostel_application_basic', 'hostel_application_basic.hostel_register_id', '=', 'hostel_register.id')
                    ->select('hostel_register.application_no', 'hostel_register.id', 'hostel_application_basic.sports', 'hostel_application_basic.sub_sport_type', 'hostel_register.gender')
                    ->where('hostel_register.application_no', $item[1])->first();


                if ($user) {


                    $data = [
                        'sport_id' => $user->sports,
                        'gender' => $user->gender,

                        'sub_sport_id' => $user->sub_sport_type,
                        'application_no' => $user->application_no,
                        'applicant_id' => $user->id,
                        'hundred_mt_time' => $item[2],
                        'hundred_mt_mark' => $item[3],
                        'eight_hundred_mt_time' => $item[4],
                        'eight_hundred_mt_mark' => $item[5],
                        'broad_jump_distance' => $item[6],
                        'broad_jump_mark' => $item[7],
                        'shuttle_run_time' => $item[8],
                        'shuttle_run_mark' => $item[9],
                        'ball_throw_distance' => $item[10],
                        'ball_throw_mark' => $item[11],
                        'physical_total_mark' => $item[12],
                        'addedby' => Auth::guard('admin')->user()->id,
                        'date' => date("Y-m-d H:i:s")
                    ];

                    $data['trial_type'] = 3;

                    $id = DB::table('hostel_trial_applicant')->insertGetId($data);

                    if ($item[12] >= 20) {
                        DB::table('hostel_register')->where('id', $user->id)->update([


                            'trial_three' => 2,
                            'physical_trial_three_marks' => $item[12],


                        ]);
                    } elseif ($item[12] < 20) {
                        DB::table('hostel_register')->where('id', $user->id)->update([


                            'trial_three' => 3,
                            'physical_trial_three_marks' => $item[12],


                        ]);
                    }


















                    if ($item[13]) {



                        if ($item[0] == 1) {


                            //badminton

                            $data = [
                                'sport_id' => $user->sports,


                                'application_no' => $user->application_no,
                                'applicant_id' => $user->id,
                                'high_double_service_mark' => $item[13],
                                'smash_mark' => $item[14],
                                'drop_mark' => $item[15],
                                'backhand_mark' => $item[16],
                                'test_score_mark' => $item[17],
                                'game_technique' => $item[18],
                                'sport_test_mark' => $item[19],
                                'total_obtain_mark' => $item[20],
                                'remark' => 'ok',
                                'addedby' => Auth::guard('admin')->user()->id,
                                'date' => date("Y-m-d H:i:s")

                            ];



                            $data['trial_type'] = 3;

                            $id = DB::table('hostel_badminton_trial')->insertGetId($data);






                            if ($item[19] >= 25) {
                                DB::table('hostel_register')->where('id', $user->id)->update([


                                    'trial_three' => 2,
                                    'skill_trial_three_marks' => $item[19],



                                ]);
                            } elseif ($item[19] < 25) {
                                DB::table('hostel_register')->where('id', $user->id)->update([


                                    'trial_three' => 3,
                                    'skill_trial_three_marks' => $item[19],



                                ]);
                            }







                        } elseif ($item[0] == 2) {


                            //volleyball


                            $data = [
                                'sport_id' => $user->sports,


                                'application_no' => $user->application_no,
                                'applicant_id' => $user->id,
                                'under_hand_mark' => $item[13],
                                'upper_hand_mark' => $item[14],
                                'service_mark' => $item[15],
                                'smash_mark' => $item[16],
                                'test_score_mark' => $item[17],
                                'game_technique' => $item[18],
                                'sport_test_mark' => $item[19],
                                'total_obtain_mark' => $item[20],
                                'remark' => 'ok',
                                'addedby' => Auth::guard('admin')->user()->id,
                                'date' => date("Y-m-d H:i:s")

                            ];


                            $data['trial_type'] = 3;

                           $id = DB::table('hostel_volleyball_trial')->insertGetId($data);


                            if ($item[19] >= 25) {
                                DB::table('hostel_register')->where('id', $user->id)->update([


                                    'trial_three' => 2,
                                    'skill_trial_three_marks' => $item[19],




                                ]);
                            } elseif ($item[19] < 25) {
                                DB::table('hostel_register')->where('id', $user->id)->update([


                                    'trial_three' => 3,
                                    'skill_trial_three_marks' => $item[19],


                                ]);
                            }







                        } elseif ($item[0] == 3) {

                            // kusti







                            $data = [
                                'sport_id' => $user->sports,


                                'application_no' => $user->application_no,
                                'applicant_id' => $user->id,
                                'ground_position_mark' => $item[13],
                                'front_position_back_position_mark' => $item[14],

                                'test_score_mark' => $item[15],
                                'game_technique' => $item[16],
                                'sport_test_mark' => $item[17],
                                'total_obtain_mark' => $item[18],
                                'remark' => 'ok',
                                'addedby' => Auth::guard('admin')->user()->id,
                                'date' => date("Y-m-d H:i:s")

                            ];
                            $data['trial_type'] = 3;

                            $id = DB::table('hostel_kusti_trial')->insertGetId($data);

                            if ($item[17] >= 25) {
                                DB::table('hostel_register')->where('id', $user->id)->update([


                                    'trial_three' => 2,
                                    'skill_trial_three_marks' => $item[17],



                                ]);
                            } elseif ($item[17] < 25) {
                                DB::table('hostel_register')->where('id', $user->id)->update([


                                    'trial_three' => 3,
                                    'skill_trial_three_marks' => $item[17],


                                ]);
                            }






                        } elseif ($item[0] == 4) {
                            //   swimming



                            $data = [
                                'sport_id' => $user->sports,


                                'application_no' => $user->application_no,
                                'applicant_id' => $user->id,
                                'free_stroke_mark' => $item[13],
                                'back_stroke_mark' => $item[14],
                                'breast_stroke_mark' => $item[15],
                                'butter_fly_mark' => $item[16],
                                'glaiding_mark' => $item[17],
                                'start_mark' => $item[18],

                                'test_score_mark' => $item[19],
                                'game_technique' => $item[20],
                                'sport_test_mark' => $item[21],
                                'total_obtain_mark' => $item[22],
                                'remark' => 'ok',
                                'addedby' => Auth::guard('admin')->user()->id,
                                'date' => date("Y-m-d H:i:s")

                            ];



                            $data['trial_type'] = 3;

                            $id = DB::table('hostel_swimming_trial')->insertGetId($data);

                            if ($item[21] >= 25) {
                                DB::table('hostel_register')->where('id', $user->id)->update([


                                    'trial_three' => 2,
                                    'skill_trial_three_marks' => $item[21],


                                ]);
                            } elseif ($item[21] < 25) {
                                DB::table('hostel_register')->where('id', $user->id)->update([


                                    'trial_three' => 3,
                                    'skill_trial_three_marks' => $item[21],



                                ]);
                            }


                        } elseif ($item[0] == 5) {

                            //kabaddi


                            $data = [
                                'sport_id' => $user->sports,


                                'application_no' => $user->application_no,
                                'applicant_id' => $user->id,
                                'raid_mark' => $item[13],
                                'kick_skill_mark' => $item[14],
                                'pakad_mark' => $item[15],
                                'covering_mark' => $item[16],

                                'test_score_mark' => $item[17],
                                'game_technique' => $item[18],
                                'sport_test_mark' => $item[19],
                                'total_obtain_mark' => $item[20],
                                'remark' => 'ok',
                                'addedby' => Auth::guard('admin')->user()->id,
                                'date' => date("Y-m-d H:i:s")

                            ];
                            $data['trial_type'] = 3;

                              $id = DB::table('hostel_kabbadi_trial')->insertGetId($data);


                            if ($item[19] >= 25) {
                                DB::table('hostel_register')->where('id', $user->id)->update([


                                    'trial_three' => 2,
                                    'skill_trial_three_marks' => $item[19],



                                ]);
                            } elseif ($item[19] < 25) {
                                DB::table('hostel_register')->where('id', $user->id)->update([


                                    'trial_three' => 3,
                                    'skill_trial_three_marks' => $item[19],



                                ]);
                            }





                        } elseif ($item[0] == 6) {

                            //judo





                            $data = [
                                'sport_id' => $user->sports,


                                'application_no' => $user->application_no,
                                'applicant_id' => $user->id,
                                'straight_work_throw_mark' => $item[13],
                                'hip_leg_hand_techniquec_mark' => $item[14],
                                'throw_count_mark' => $item[15],
                                'throw_combination_mark' => $item[16],
                                'test_score_mark' => $item[17],
                                'game_technique' => $item[18],
                                'sport_test_mark' => $item[19],
                                'total_obtain_mark' => $item[20],
                                'remark' => 'ok',
                                'addedby' => Auth::guard('admin')->user()->id,
                                'date' => date("Y-m-d H:i:s")

                            ];
                            $data['trial_type'] = 3;

                              $id = DB::table('hostel_judo_trial')->insertGetId($data);



                            if ($item[19] >= 25) {
                                DB::table('hostel_register')->where('id', $user->id)->update([


                                    'trial_three' => 2,
                                    'skill_trial_three_marks' => $item[19],


                                ]);
                            } elseif ($item[19] < 25) {
                                DB::table('hostel_register')->where('id', $user->id)->update([


                                    'trial_three' => 3,
                                    'skill_trial_three_marks' => $item[19],



                                ]);
                            }









                        } elseif ($item[0] == 7) {

                            //  gymnasticboys




                            $data = [
                                'sport_id' => $user->sports,


                                'application_no' => $user->application_no,
                                'applicant_id' => $user->id,
                                'floor_exercise_mark' => $item[13],
                                'pommel_horse_mark' => $item[14],
                                'ring_mark' => $item[15],
                                'vaulving_horse_mark' => $item[16],
                                'parallel_bar_mark' => $item[17],
                                'horizontal_bar_mark' => $item[18],
                                'test_score_mark' => $item[19],
                                'game_technique' => $item[20],
                                'sport_test_mark' => $item[21],
                                'total_obtain_mark' => $item[22],
                                'remark' => 'ok',
                                'addedby' => Auth::guard('admin')->user()->id,
                                'date' => date("Y-m-d H:i:s")

                            ];


                            $data['trial_type'] = 3;

                                 $id = DB::table('hostel_gymnastic_boy_trial')->insertGetId($data);

                            if ($item[21] >= 25) {
                                DB::table('hostel_register')->where('id', $user->id)->update([


                                    'trial_three' => 2,
                                    'skill_trial_three_marks' => $item[21],



                                ]);
                            } elseif ($item[21] < 25) {
                                DB::table('hostel_register')->where('id', $user->id)->update([


                                    'trial_three' => 3,
                                    'skill_trial_three_marks' => $item[21],



                                ]);
                            }








                        } elseif ($item[0] == 8) {

                            //gymnasticgirls





                            $data = [
                                'sport_id' => $user->sports,


                                'application_no' => $user->application_no,
                                'applicant_id' => $user->id,
                                'balancing_beam_mark' => $item[13],
                                'uneven_bar_mark' => $item[14],
                                'floor_exercise_mark' => $item[15],
                                'vaulving_horse_mark' => $item[16],
                                'test_score_mark' => $item[17],
                                'game_technique' => $item[18],
                                'sport_test_mark' => $item[19],
                                'total_obtain_mark' => $item[20],
                                'remark' => 'ok',
                                'addedby' => Auth::guard('admin')->user()->id,
                                'date' => date("Y-m-d H:i:s")

                            ];
                            $data['trial_type'] = 3;

                             $id = DB::table('hostel_gymnastic_girl_trial')->insertGetId($data);


                            if ($item[19] >= 25) {
                                DB::table('hostel_register')->where('id', $user->id)->update([


                                    'trial_three' => 2,
                                    'skill_trial_three_marks' => $item[19],


                                ]);
                            } elseif ($item[19] < 25) {
                                DB::table('hostel_register')->where('id', $user->id)->update([


                                    'trial_three' => 3,
                                    'skill_trial_three_marks' => $item[19],


                                ]);
                            }

                        } elseif ($item[0] == 9) {

                            //cricketbatsman


                            $data = [
                                'sport_id' => $user->sports,


                                'application_no' => $user->application_no,
                                'applicant_id' => $user->id,
                                'grip_stance_backlift_mark' => $item[13],
                                'ball_select_mark' => $item[14],
                                'front_foot_back_foot_mark' => $item[15],
                                'front_foot_back_foot_drive_mark' => $item[16],

                                'test_score_mark' => $item[17],
                                'game_technique' => $item[18],
                                'sport_test_mark' => $item[19],
                                'total_obtain_mark' => $item[20],
                                'remark' => 'ok',
                                'addedby' => Auth::guard('admin')->user()->id,
                                'date' => date("Y-m-d H:i:s")

                            ];
                            $data['trial_type'] = 3;

                            $id = DB::table('hostel_cricket_batsman_trial')->insertGetId($data);



                            if ($item[19] >= 25) {
                                DB::table('hostel_register')->where('id', $user->id)->update([


                                    'trial_three' => 2,
                                    'skill_trial_three_marks' => $item[19],


                                ]);
                            } elseif ($item[19] < 25) {
                                DB::table('hostel_register')->where('id', $user->id)->update([
                                    'trial_three' => 3,
                                    'skill_trial_three_marks' => $item[19],

                                ]);
                            }







                        } elseif ($item[0] == 10) {

                            //cricketballer










                            $data = [
                                'sport_id' => $user->sports,


                                'application_no' => $user->application_no,
                                'applicant_id' => $user->id,
                                'runup_action_followthrough_mark' => $item[13],
                                'swing_spin_mark' => $item[14],
                                'line_length_mark' => $item[15],
                                'speed_flight_mark' => $item[16],
                                'test_score_mark' => $item[17],
                                'game_technique' => $item[18],
                                'sport_test_mark' => $item[19],
                                'total_obtain_mark' => $item[20],
                                'remark' => 'ok',
                                'addedby' => Auth::guard('admin')->user()->id,
                                'date' => date("Y-m-d H:i:s")

                            ];
                            $data['trial_type'] = 3;

                                  $id = DB::table('hostel_cricket_bowler_trial')->insertGetId($data);



                            if ($item[19] >= 25) {
                                DB::table('hostel_register')->where('id', $user->id)->update([


                                    'trial_three' => 2,
                                    'skill_trial_three_marks' => $item[19],


                                ]);
                            } elseif ($item[19] < 25) {
                                DB::table('hostel_register')->where('id', $user->id)->update([


                                    'trial_three' => 3,
                                    'skill_trial_three_marks' => $item[19],


                                ]);
                            }

                        } elseif ($item[0] == 11) {

                            //cricketkeeper

                            $data = [
                                'sport_id' => $user->sports,


                                'application_no' => $user->application_no,
                                'applicant_id' => $user->id,
                                'stumping_mark' => $item[13],
                                'gathering_mark' => $item[14],
                                'off_stumping_gathering_mark' => $item[15],
                                'on_stumping_gathering_mark' => $item[16],
                                'test_score_mark' => $item[17],
                                'game_technique' => $item[18],
                                'sport_test_mark' => $item[19],
                                'total_obtain_mark' => $item[20],
                                'remark' => 'ok',
                                'addedby' => Auth::guard('admin')->user()->id,
                                'date' => date("Y-m-d H:i:s")

                            ];
                            $data['trial_type'] = 3;

                              $id = DB::table('hostel_cricket_wicket_keeper_trial')->insertGetId($data);


                               if ($item[19] >= 25) {
                                DB::table('hostel_register')->where('id', $user->id)->update([


                                    'trial_three' => 2,
                                    'skill_trial_three_marks' => $item[19],


                                ]);
                            } elseif ($item[19] < 25) {
                                DB::table('hostel_register')->where('id', $user->id)->update([


                                    'trial_three' => 3,
                                    'skill_trial_three_marks' => $item[19],

                                ]);
                            }



                        } elseif ($item[0] == 12) {

                            //hockey


                            $data = [
                                'sport_id' => $user->sports,


                                'application_no' => $user->application_no,
                                'applicant_id' => $user->id,
                                'hit_mark' => $item[13],
                                'push_mark' => $item[14],
                                'scoop_mark' => $item[15],
                                'dribbling_mark' => $item[16],
                                'test_score_mark' => $item[17],
                                'game_technique' => $item[18],
                                'sport_test_mark' => $item[19],
                                'total_obtain_mark' => $item[20],
                                'remark' => 'ok',
                                'addedby' => Auth::guard('admin')->user()->id,
                                'date' => date("Y-m-d H:i:s")

                            ];
                            $data['trial_type'] = 3;

                            $id = DB::table('hostel_hockey_trial')->insertGetId($data);



                             if ($item[19] >= 25) {
                                DB::table('hostel_register')->where('id', $user->id)->update([


                                    'trial_three' => 2,
                                    'skill_trial_three_marks' => $item[19],


                                ]);
                            } elseif ($item[19] < 25) {
                                DB::table('hostel_register')->where('id', $user->id)->update([


                                    'trial_three' => 3,
                                    'skill_trial_three_marks' => $item[19],


                                ]);
                            }



                        } elseif ($item[0] == 13) {

                            //hockeykeeper


                            $data = [
                                'sport_id' => $user->sports,


                                'application_no' => $user->application_no,
                                'applicant_id' => $user->id,
                                'kick_mark' => $item[13],
                                'pad_mark' => $item[14],
                                'stop_mark' => $item[15],
                                'high_push_mark' => $item[16],
                                'himmat_mark' => $item[17],
                                'test_score_mark' => $item[18],
                                'game_technique' => $item[19],
                                'sport_test_mark' => $item[20],
                                'total_obtain_mark' => $item[21],
                                'remark' => 'ok',
                                'addedby' => Auth::guard('admin')->user()->id,
                                'date' => date("Y-m-d H:i:s")

                            ];
                            $data['trial_type'] = 3;

                            $id = DB::table('hostel_hockey_goalkeeper_trial')->insertGetId($data);


                            if ($item[20] >= 25) {
                                DB::table('hostel_register')->where('id', $user->id)->update([


                                    'trial_three' => 2,
                                    'skill_trial_three_marks' => $item[20],


                                ]);
                            } elseif ($item[20] < 25) {
                                DB::table('hostel_register')->where('id', $user->id)->update([


                                    'trial_three' => 3,
                                    'skill_trial_three_marks' => $item[20],


                                ]);
                            }


                        } elseif ($item[0] == 14) {

                            //footballkeeper



                            $data = [
                                'sport_id' => $user->sports,


                                'application_no' => $user->application_no,
                                'applicant_id' => $user->id,
                                'grip_mark' => $item[13],
                                'dive_mark' => $item[14],
                                'patch_mark' => $item[15],
                                'kick_mark' => $item[16],
                                'test_score_mark' => $item[17],
                                'game_technique' => $item[18],
                                'sport_test_mark' => $item[19],
                                'total_obtain_mark' => $item[20],
                                'remark' => 'ok',
                                'addedby' => Auth::guard('admin')->user()->id,
                                'date' => date("Y-m-d H:i:s")

                            ];
                            $data['trial_type'] = 3;

                            $id = DB::table('hostel_football_goalkeeper_trial')->insertGetId($data);



                            if ($item[19] >= 25) {
                                DB::table('hostel_register')->where('id', $user->id)->update([


                                    'trial_three' => 2,
                                    'skill_trial_three_marks' => $item[19],


                                ]);
                            } elseif ($item[19] < 25) {
                                DB::table('hostel_register')->where('id', $user->id)->update([


                                    'trial_three' => 3,
                                    'skill_trial_three_marks' => $item[19],


                                ]);
                            }




                        } elseif ($item[0] == 15) {

                            //  football






                            $data = [
                                'sport_id' => $user->sports,


                                'application_no' => $user->application_no,
                                'applicant_id' => $user->id,
                                'kick_mark' => $item[13],
                                'dribble_tackle_mark' => $item[14],
                                'head_mark' => $item[15],
                                'control_pad_mark' => $item[16],
                                'test_score_mark' => $item[17],
                                'game_technique' => $item[18],
                                'sport_test_mark' => $item[19],
                                'total_obtain_mark' => $item[20],
                                'remark' => 'ok',
                                'addedby' => Auth::guard('admin')->user()->id,
                                'date' => date("Y-m-d H:i:s")

                            ];


                            $data['trial_type'] = 3;

                            $id = DB::table('hostel_football_trial')->insertGetId($data);


                            if ($item[19] >= 25) {
                                DB::table('hostel_register')->where('id', $user->id,)->update([


                                    'trial_three' => 2,
                                    'skill_trial_three_marks' => $item[19],


                                ]);
                            } elseif ($item[19] < 25) {
                                DB::table('hostel_register')->where('id', $user->id,)->update([


                                    'trial_three' => 3,
                                    'skill_trial_three_marks' => $item[19],



                                ]);
                            }






                        } elseif ($item[0] == 16) {

                            //athleticsrunner


                            $data = [
                                'sport_id' => $user->sports,


                                'application_no' => $user->application_no,
                                'applicant_id' => $user->id,
                                'stance_mark' => $item[13],
                                'start_mark' => $item[14],
                                'action_mark' => $item[15],
                                'finish_mark' => $item[16],

                                'test_score_mark' => $item[17],
                                'game_technique' => $item[18],
                                'sport_test_mark' => $item[19],
                                'total_obtain_mark' => $item[20],
                                'remark' => 'ok',
                                'addedby' => Auth::guard('admin')->user()->id,
                                'date' => date("Y-m-d H:i:s")

                            ];



                            $data['trial_type'] = 3;

                            $id = DB::table('hostel_athletics_runner_trial')->insertGetId($data);

                             if ($item[19] >= 25) {
                                DB::table('hostel_register')->where('id', $user->id,)->update([


                                    'trial_three' => 2,
                                    'skill_trial_three_marks' => $item[19],


                                ]);
                            } elseif ($item[19] < 25) {
                                DB::table('hostel_register')->where('id', $user->id,)->update([


                                    'trial_three' => 3,
                                    'skill_trial_three_marks' => $item[19],



                                ]);
                            }
                        } elseif ($item[0] == 17) {

                            //athleticsthrower


                            $data = [
                                'sport_id' => $user->sports,


                                'application_no' => $user->application_no,
                                'applicant_id' => $user->id,
                                'stance_mark' => $item[13],
                                'execution_mark' => $item[14],
                                'action_mark' => $item[15],
                                'follow_throw_mark' => $item[16],

                                'test_score_mark' => $item[17],
                                'game_technique' => $item[18],
                                'sport_test_mark' => $item[19],
                                'total_obtain_mark' => $item[20],
                                'remark' => 'ok',
                                'addedby' => Auth::guard('admin')->user()->id,
                                'date' => date("Y-m-d H:i:s")

                            ];

                            $data['trial_type'] = 3;

                            $id = DB::table('hostel_athletics_thrower_trial')->insertGetId($data);


                             if ($item[19] >= 25) {
                                DB::table('hostel_register')->where('id', $user->id,)->update([


                                    'trial_three' => 2,
                                    'skill_trial_three_marks' => $item[19],


                                ]);
                            } elseif ($item[19] < 25) {
                                DB::table('hostel_register')->where('id', $user->id,)->update([


                                    'trial_three' => 3,
                                    'skill_trial_three_marks' => $item[19],



                                ]);
                            }


                        } elseif ($item[0] == 18) {

                            //athleticsjumper






                            $data = [
                                'sport_id' => $user->sports,


                                'application_no' => $user->application_no,
                                'applicant_id' => $user->id,
                                'approach_mark' => $item[13],
                                't_a_mark' => $item[14],
                                'action_mark' => $item[15],
                                'landing_mark' => $item[16],

                                'test_score_mark' => $item[17],
                                'game_technique' => $item[18],
                                'sport_test_mark' => $item[19],
                                'total_obtain_mark' => $item[20],
                                'remark' => 'ok',
                                'addedby' => Auth::guard('admin')->user()->id,
                                'date' => date("Y-m-d H:i:s")

                            ];


                            $data['trial_type'] = 3;

                            $id = DB::table('hostel_athletics_jumper_trial')->insertGetId($data);
                            $data['trial_type'] = 4;

                             $id = DB::table('hostel_athletics_jumper_trial')->insertGetId($data);
                             if ($item[19] >= 25) {
                                DB::table('hostel_register')->where('id', $user->id,)->update([


                                    'trial_three' => 2,
                                    'skill_trial_three_marks' => $item[19],


                                ]);
                            } elseif ($item[19] < 25) {
                                DB::table('hostel_register')->where('id', $user->id,)->update([


                                    'trial_three' => 3,
                                    'skill_trial_three_marks' => $item[19],



                                ]);
                            }


                        } elseif ($item[0] == 19) {

                            //boxing
                            $data = [
                                'sport_id' => $user->sports,


                                'application_no' => $user->application_no,
                                'applicant_id' => $user->id,
                                'punching_pad' => $item[13],
                                'shadow_boxing' => $item[14],
                                'skypink' => $item[15],
                                'sparring' => $item[16],

                                'test_score_mark' => $item[17],
                                'game_technique' => $item[18],
                                'sport_test_mark' => $item[19],
                                'total_obtain_mark' => $item[20],
                                'remark' => 'ok',
                                'addedby' => Auth::guard('admin')->user()->id,
                                'date' => date("Y-m-d H:i:s")

                            ];
                            $data['trial_type'] = 3;

                            $id = DB::table('hostel_boxing_trial')->insertGetId($data);


                             if ($item[19] >= 25) {
                                DB::table('hostel_register')->where('id', $user->id,)->update([


                                    'trial_three' => 2,
                                    'skill_trial_three_marks' => $item[19],


                                ]);
                            } elseif ($item[19] < 25) {
                                DB::table('hostel_register')->where('id', $user->id,)->update([


                                    'trial_three' => 3,
                                    'skill_trial_three_marks' => $item[19],



                                ]);
                            }


                        } elseif ($item[0] == 20) {

                            //basketball


                            $data = [
                                'sport_id' => $user->sports,


                                'application_no' => $user->application_no,
                                'applicant_id' => $user->id,
                                'dribbling' => $item[13],
                                'passing' => $item[14],
                                'standing' => $item[15],
                                'jumpshot' => $item[16],

                                'test_score_mark' => $item[17],
                                'game_technique' => $item[18],
                                'sport_test_mark' => $item[19],
                                'total_obtain_mark' => $item[20],
                                'remark' => 'ok',
                                'addedby' => Auth::guard('admin')->user()->id,
                                'date' => date("Y-m-d H:i:s")

                            ];
                            $data['trial_type'] = 3;

                            $id = DB::table('hostel_basketball_trial')->insertGetId($data);



                             if ($item[19] >= 25) {
                                DB::table('hostel_register')->where('id', $user->id,)->update([


                                    'trial_three' => 2,
                                    'skill_trial_three_marks' => $item[19],


                                ]);
                            } elseif ($item[19] < 25) {
                                DB::table('hostel_register')->where('id', $user->id,)->update([


                                    'trial_three' => 3,
                                    'skill_trial_three_marks' => $item[19],



                                ]);
                            }



                        } elseif ($item[0] == 21) {
                            //tabletennis








                            $data = [
                                'sport_id' => $user->sports,


                                'application_no' => $user->application_no,
                                'applicant_id' => $user->id,
                                'counter' => $item[13],
                                'push' => $item[14],
                                'block' => $item[15],
                                'service' => $item[16],

                                'test_score_mark' => $item[17],
                                'game_technique' => $item[18],
                                'sport_test_mark' => $item[19],
                                'total_obtain_mark' => $item[20],
                                'remark' => 'ok',
                                'addedby' => Auth::guard('admin')->user()->id,
                                'date' => date("Y-m-d H:i:s")

                            ];
                            $data['trial_type'] = 3;

                            $id = DB::table('hostel_tabletennis_trial')->insertGetId($data);


                             if ($item[19] >= 25) {
                                DB::table('hostel_register')->where('id', $user->id,)->update([


                                    'trial_three' => 2,
                                    'skill_trial_three_marks' => $item[19],


                                ]);
                            } elseif ($item[19] < 25) {
                                DB::table('hostel_register')->where('id', $user->id,)->update([


                                    'trial_three' => 3,
                                    'skill_trial_three_marks' => $item[19],



                                ]);
                            }

                        } elseif ($item[0] == 22) {
                            //handball



                            $data = [
                                'sport_id' => $user->sports,


                                'application_no' => $user->application_no,
                                'applicant_id' => $user->id,
                                'catch_pass' => $item[13],
                                'dibbling' => $item[16],
                                'standing_shot' => $item[15],
                                'jumpshot' => $item[16],

                                'test_score_mark' => $item[17],
                                'game_technique' => $item[18],
                                'sport_test_mark' => $item[19],
                                'total_obtain_mark' => $item[20],
                                'remark' => 'ok',
                                'addedby' => Auth::guard('admin')->user()->id,
                                'date' => date("Y-m-d H:i:s")

                            ];
                            $data['trial_type'] = 3;

                            $id = DB::table('hostel_handball_trial')->insertGetId($data);


                            if ($item[19] >= 25) {
                                DB::table('hostel_register')->where('id', $user->id,)->update([


                                    'trial_three' => 2,
                                    'skill_trial_three_marks' => $item[19],

                                ]);
                            } elseif ($item[19] < 25) {
                                DB::table('hostel_register')->where('id', $user->id,)->update([


                                    'trial_three' => 3,
                                    'skill_trial_three_marks' => $item[19],



                                ]);
                            }

                        } elseif ($item[0] == 23) {
                            //archery


                            $data = [
                                'sport_id' => $user->sports,


                                'application_no' => $user->application_no,
                                'applicant_id' => $user->id,
                                'staines' => $item[13],
                                'knocking' => $item[14],
                                'expansion' => $item[15],
                                'driving' => $item[16],

                                'anchoring' => $item[17],
                                'titan_hold' => $item[18],
                                'aiming' => $item[19],
                                'titan_release' => $item[20],
                                'after_hold' => $item[21],
                                'sport_test_mark' => $item[22],
                                'total_obtain_mark' => $item[23],
                                'remark' => 'ok',
                                'addedby' => Auth::guard('admin')->user()->id,
                                'date' => date("Y-m-d H:i:s")

                            ];
                            $data['trial_type'] = 3;

                            $id = DB::table('hostel_archery_trial')->insertGetId($data);


                            if ($item[22] >= 25) {
                                DB::table('hostel_register')->where('id', $user->id)->update([


                                    'trial_three' => 2,
                                    'skill_trial_three_marks' => $item[22],


                                ]);
                            } elseif ($item[22] < 25) {
                                DB::table('hostel_register')->where('id', $user->id)->update([


                                    'trial_three' => 3,
                                    'skill_trial_three_marks' => $item[22],


                                ]);
                            }
                        }
                    }
                    }
                }
            }


        }


    }
}
