<?php

namespace App\Imports;

use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Concerns\ToCollection;
use Illuminate\Support\Facades\DB;

class Trial_import_bkp implements ToCollection
{
    /**
     * @param Collection $collection
     */
    public function collection(Collection $collection)
    {

        foreach ($collection as $item) {
            if ($item->filter()->isNotEmpty()) {
                if ($item[1]) {



                    $user = DB::table('admission_registration_login')->leftJoin('online_admission_basic_details', 'online_admission_basic_details.application_no', '=', 'admission_registration_login.application_no')
                        ->select('admission_registration_login.application_no', 'admission_registration_login.id', 'online_admission_basic_details.sport_type', 'online_admission_basic_details.sub_sport_type', 'online_admission_basic_details.gender')
                        ->where('admission_registration_login.application_no', $item[1])->first();

                    $data = [
                        'sport_id' => $user->sport_type,
                        'gender' => $user->gender,
                        'trial_type' => 2,
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

                    $id = DB::table('online_admission_trial_applicant')->insertGetId($data);



                    DB::table('admission_registration_login')->where('id', $user->id)->update([

                        'physical_trial_two_marks' => $item[12]

                    ]);



                    if ($item[0] == 1) {


                        //badminton

                        $data = [
                            'sport_id' => $user->sport_type,
                            'trial_type' => 2,

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
                            'remark' => $item[21],
                            'addedby' => Auth::guard('admin')->user()->id,
                            'date' => date("Y-m-d H:i:s")

                        ];

                        $id = DB::table('online_admission_badminton_trial')->insertGetId($data);





                        if ($item[19] >= 20 && $item[20] - $item[19] >= 20) {
                            $user = DB::table('admission_registration_login')->where('id', $user->id)->update([
                                'trial_type' => 3,
                                'skill_trial_two_marks' => $item[19]
                            ]);
                        } elseif (($item[19] < 20 || $item[20] - $item[19] < 20)) {
                            $user = DB::table('admission_registration_login')->where('id',  $user->id)->update([
                                'trial_type' => 5,
                                'final_status' => 3,
                                'skill_trial_two_marks' => $item[19]
                            ]);
                        }
                    } elseif ($item[0] == 2) {
                        //judo



                        $data = [
                            'sport_id' => $user->sport_type,
                            'trial_type' => 2,

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
                            'remark' => $item[21],
                            'addedby' => Auth::guard('admin')->user()->id,
                            'date' => date("Y-m-d H:i:s")

                        ];

                        $id = DB::table('online_admission_judo_trial')->insertGetId($data);



                        if ($item[19] >= 20 && $item[20] - $item[19] >= 20) {
                            $user = DB::table('admission_registration_login')->where('id', $user->id)->update([
                                'trial_type' => 3,
                                'skill_trial_two_marks' => $item[19]
                            ]);
                        } elseif (($item[19] < 20 || $item[20] - $item[19] < 20)) {
                            $user = DB::table('admission_registration_login')->where('id',  $user->id)->update([
                                'trial_type' => 5,
                                'final_status' => 3,
                                'skill_trial_two_marks' => $item[19]
                            ]);
                        }
                    } elseif ($item[0] == 3) {

                        //kusti

                        $data = [
                            'sport_id' => $user->sport_type,
                            'trial_type' => 2,

                            'application_no' => $user->application_no,
                            'applicant_id' => $user->id,
                            'ground_position_mark' => $item[13],
                            'front_position_back_position_mark' => $item[14],

                            'test_score_mark' => $item[15],
                            'game_technique' => $item[16],
                            'sport_test_mark' => $item[17],
                            'total_obtain_mark' => $item[18],
                            'remark' => $item[19],
                            'addedby' => Auth::guard('admin')->user()->id,
                            'date' => date("Y-m-d H:i:s")

                        ];

                        $id = DB::table('online_admission_kusti_trial')->insertGetId($data);


                        if ($item[17] >= 20 && $item[18] - $item[17] >= 20) {
                            $user = DB::table('admission_registration_login')->where('id', $user->id)->update([
                                'trial_type' => 3,
                                'skill_trial_two_marks' => $item[17]
                            ]);
                        } elseif (($item[17] < 20 || $item[18] - $item[17] < 20)) {
                            $user = DB::table('admission_registration_login')->where('id',  $user->id)->update([
                                'trial_type' => 5,
                                'final_status' => 3,
                                'skill_trial_two_marks' => $item[17]
                            ]);
                        }
                    } elseif ($item[0] == 4) {
                        // volleyBall


                        $data = [
                            'sport_id' => $user->sport_type,
                            'trial_type' => 2,

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
                            'remark' => $item[21],
                            'addedby' => Auth::guard('admin')->user()->id,
                            'date' => date("Y-m-d H:i:s")

                        ];

                        $id = DB::table('online_admission_volleyball_trial')->insertGetId($data);





                        if ($item[19] >= 20 && $item[20] - $item[19] >= 20) {
                            $user = DB::table('admission_registration_login')->where('id', $user->id)->update([
                                'trial_type' => 3,
                                'skill_trial_two_marks' => $item[19]
                            ]);
                        } elseif (($item[19] < 20 || $item[20] - $item[19] < 20)) {
                            $user = DB::table('admission_registration_login')->where('id',  $user->id)->update([
                                'trial_type' => 5,
                                'final_status' => 3,
                                'skill_trial_two_marks' => $item[19]
                            ]);
                        }
                    } elseif ($item[0] == 5) {
                        //footballkeeper
                        $data = [
                            'sport_id' => $user->sport_type,
                            'trial_type' => 2,

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
                            'remark' => $item[21],
                            'addedby' => Auth::guard('admin')->user()->id,
                            'date' => date("Y-m-d H:i:s")

                        ];

                        $id = DB::table('online_admission_football_goalkeeper_trial')->insertGetId($data);




                        if ($item[19] >= 20 && $item[20] - $item[19] >= 20) {
                            $user = DB::table('admission_registration_login')->where('id', $user->id)->update([
                                'trial_type' => 3,
                                'skill_trial_two_marks' => $item[19]
                            ]);
                        } elseif (($item[19] < 20 || $item[20] - $item[19] < 20)) {
                            $user = DB::table('admission_registration_login')->where('id',  $user->id)->update([
                                'trial_type' => 5,
                                'final_status' => 3,
                                'skill_trial_two_marks' => $item[19]
                            ]);
                        }
                    } elseif ($item[0] == 6) {
                        //football

                        $data = [
                            'sport_id' => $user->sport_type,
                            'trial_type' => 2,

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
                            'remark' => $item[21],
                            'addedby' => Auth::guard('admin')->user()->id,
                            'date' => date("Y-m-d H:i:s")

                        ];

                        $id = DB::table('online_admission_football_trial')->insertGetId($data);





                        if ($item[19] >= 20 && $item[20] - $item[19] >= 20) {
                            $user = DB::table('admission_registration_login')->where('id', $user->id)->update([
                                'trial_type' => 3,
                                'skill_trial_two_marks' => $item[19]
                            ]);
                        } elseif (($item[19] < 20 || $item[20] - $item[19] < 20)) {
                            $user = DB::table('admission_registration_login')->where('id',  $user->id)->update([
                                'trial_type' => 5,
                                'final_status' => 3,
                                'skill_trial_two_marks' => $item[19]
                            ]);
                        }
                    } elseif ($item[0] == 7) {
                        //hockey

                        $data = [
                            'sport_id' => $user->sport_type,
                            'trial_type' => 2,

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
                            'remark' => $item[21],
                            'addedby' => Auth::guard('admin')->user()->id,
                            'date' => date("Y-m-d H:i:s")

                        ];

                        $id = DB::table('online_admission_hockey_trial')->insertGetId($data);


                        if ($item[19] >= 20 && $item[20] - $item[19] >= 20) {
                            $user = DB::table('admission_registration_login')->where('id', $user->id)->update([
                                'trial_type' => 3,
                                'skill_trial_two_marks' => $item[19]
                            ]);
                        } elseif (($item[19] < 20 || $item[20] - $item[19] < 20)) {
                            $user = DB::table('admission_registration_login')->where('id',  $user->id)->update([
                                'trial_type' => 5,
                                'final_status' => 3,
                                'skill_trial_two_marks' => $item[19]
                            ]);
                        }
                    } elseif ($item[0] == 8) {
                        //hockeykeeper




                        $data = [
                            'sport_id' => $user->sport_type,
                            'trial_type' => 2,

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
                            'remark' => $item[22],
                            'addedby' => Auth::guard('admin')->user()->id,
                            'date' => date("Y-m-d H:i:s")

                        ];

                        $id = DB::table('online_admission_hockey_goalkeeper_trial')->insertGetId($data);



                        if ($item[20] >= 20 && $item[21] - $item[20] >= 20) {
                            $user = DB::table('admission_registration_login')->where('id', $user->id)->update([
                                'trial_type' => 3,
                                'skill_trial_two_marks' => $item[20]
                            ]);
                        } elseif (($item[20] < 20 || $item[21] - $item[20] < 20)) {
                            $user = DB::table('admission_registration_login')->where('id',  $user->id)->update([
                                'trial_type' => 5,
                                'final_status' => 3,
                                'skill_trial_two_marks' => $item[20]
                            ]);
                        }
                    } elseif ($item[0] == 9) {
                        //kabaddi
                        $data = [
                            'sport_id' => $user->sport_type,
                            'trial_type' => 2,

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
                            'remark' => $item[21],
                            'addedby' => Auth::guard('admin')->user()->id,
                            'date' => date("Y-m-d H:i:s")

                        ];

                        $id = DB::table('online_admission_kabbadi_trial')->insertGetId($data);


                        if ($item[19] >= 20 && $item[20] - $item[19] >= 20) {
                            $user = DB::table('admission_registration_login')->where('id', $user->id)->update([
                                'trial_type' => 3,
                                'skill_trial_two_marks' => $item[19]
                            ]);
                        } elseif (($item[19] < 20 || $item[20] - $item[19] < 20)) {
                            $user = DB::table('admission_registration_login')->where('id',  $user->id)->update([
                                'trial_type' => 5,
                                'final_status' => 3,
                                'skill_trial_two_marks' => $item[19]
                            ]);
                        }
                    } elseif ($item[0] == 10) {
                        //swimming






                        $data = [
                            'sport_id' => $user->sport_type,
                            'trial_type' => 2,

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
                            'remark' => $item[23],
                            'addedby' => Auth::guard('admin')->user()->id,
                            'date' => date("Y-m-d H:i:s")

                        ];

                        $id = DB::table('online_admission_swimming_trial')->insertGetId($data);


                        if ($item[21] >= 20 && $item[22] - $item[21] >= 20) {
                            $user = DB::table('admission_registration_login')->where('id', $user->id)->update([
                                'trial_type' => 3,
                                'skill_trial_two_marks' => $item[21]
                            ]);
                        } elseif (($item[21] < 20 || $item[22] - $item[21] < 20)) {
                            $user = DB::table('admission_registration_login')->where('id',  $user->id)->update([
                                'trial_type' => 5,
                                'final_status' => 3,
                                'skill_trial_two_marks' => $item[21]
                            ]);
                        }
                    } elseif ($item[0] == 11) {
                        //athleticsrunner



                        $data = [
                            'sport_id' => $user->sport_type,
                            'trial_type' => 2,

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
                            'remark' => $item[21],
                            'addedby' => Auth::guard('admin')->user()->id,
                            'date' => date("Y-m-d H:i:s")

                        ];

                        $id = DB::table('online_admission_athletics_runner_trial')->insertGetId($data);



                        if ($item[19] >= 20 && $item[20] - $item[19] >= 20) {
                            $user = DB::table('admission_registration_login')->where('id', $user->id)->update([
                                'trial_type' => 3,
                                'skill_trial_two_marks' => $item[19]
                            ]);
                        } elseif (($item[19] < 20 || $item[20] - $item[19] < 20)) {
                            $user = DB::table('admission_registration_login')->where('id',  $user->id)->update([
                                'trial_type' => 5,
                                'final_status' => 3,
                                'skill_trial_two_marks' => $item[19]
                            ]);
                        }
                    } elseif ($item[0] == 12) {
                        //athleticsthrower

                        $data = [
                            'sport_id' => $user->sport_type,
                            'trial_type' => 2,

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
                            'remark' => $item[21],
                            'addedby' => Auth::guard('admin')->user()->id,
                            'date' => date("Y-m-d H:i:s")

                        ];

                        $id = DB::table('online_admission_athletics_thrower_trial')->insertGetId($data);



                        if ($item[19] >= 20 && $item[20] - $item[19] >= 20) {
                            $user = DB::table('admission_registration_login')->where('id', $user->id)->update([
                                'trial_type' => 3,
                                'skill_trial_two_marks' => $item[19]
                            ]);
                        } elseif (($item[19] < 20 || $item[20] - $item[19] < 20)) {
                            $user = DB::table('admission_registration_login')->where('id',  $user->id)->update([
                                'trial_type' => 5,
                                'final_status' => 3,
                                'skill_trial_two_marks' => $item[19]
                            ]);
                        }
                    } elseif ($item[0] == 13) {
                        //athleticsjumper









                        $data = [
                            'sport_id' => $user->sport_type,
                            'trial_type' => 2,

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
                            'remark' => $item[21],
                            'addedby' => Auth::guard('admin')->user()->id,
                            'date' => date("Y-m-d H:i:s")

                        ];



                        $id = DB::table('online_admission_athletics_jumper_trial')->insertGetId($data);







                        if ($item[19] >= 20 && $item[20] - $item[19] >= 20) {
                            $user = DB::table('admission_registration_login')->where('id', $user->id)->update([
                                'trial_type' => 3,
                                'skill_trial_two_marks' => $item[19]
                            ]);
                        } elseif (($item[19] < 20 || $item[20] - $item[19] < 20)) {
                            $user = DB::table('admission_registration_login')->where('id',  $user->id)->update([
                                'trial_type' => 5,
                                'final_status' => 3,
                                'skill_trial_two_marks' => $item[19]
                            ]);
                        }
                    } elseif ($item[0] == 14) {


                        //cricketbatsman


                        $data = [
                            'sport_id' => $user->sport_type,
                            'trial_type' => 2,

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
                            'remark' => $item[21],
                            'addedby' => Auth::guard('admin')->user()->id,
                            'date' => date("Y-m-d H:i:s")

                        ];

                        $id = DB::table('online_admission_cricket_batsman_trial')->insertGetId($data);


                        if ($item[19] >= 20 && $item[20] - $item[19] >= 20) {
                            $user = DB::table('admission_registration_login')->where('id', $user->id)->update([
                                'trial_type' => 3,
                                'skill_trial_two_marks' => $item[19]
                            ]);
                        } elseif (($item[19] < 20 || $item[20] - $item[19] < 20)) {
                            $user = DB::table('admission_registration_login')->where('id',  $user->id)->update([
                                'trial_type' => 5,
                                'final_status' => 3,
                                'skill_trial_two_marks' => $item[19]
                            ]);
                        }
                    } elseif ($item[0] == 15) {


                        //cricketballer



                        $data = [
                            'sport_id' => $user->sport_type,
                            'trial_type' => 2,

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
                            'remark' => $item[21],
                            'addedby' => Auth::guard('admin')->user()->id,
                            'date' => date("Y-m-d H:i:s")

                        ];

                        $id = DB::table('online_admission_cricket_bowler_trial')->insertGetId($data);


                        if ($item[19] >= 20 && $item[20] - $item[19] >= 20) {
                            $user = DB::table('admission_registration_login')->where('id', $user->id)->update([
                                'trial_type' => 3,
                                'skill_trial_two_marks' => $item[18]
                            ]);
                        } elseif (($item[19] >= 20 && $item[20] - $item[19] < 20)) {
                            $user = DB::table('admission_registration_login')->where('id',  $user->id)->update([
                                'trial_type' => 5,
                                'final_status' => 3,
                                'skill_trial_two_marks' => $item[18]
                            ]);
                        }
                    } elseif ($item[0] == 16) {

                        //cricketkeeper


                        $data = [
                            'sport_id' => $user->sport_type,
                            'trial_type' => 2,

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
                            'remark' => $item[21],
                            'addedby' => Auth::guard('admin')->user()->id,
                            'date' => date("Y-m-d H:i:s")

                        ];

                        $id = DB::table('online_admission_cricket_wicket_keeper_trial')->insertGetId($data);




                        if ($item[19] >= 20 && $item[20] - $item[19] >= 20) {
                            $user = DB::table('admission_registration_login')->where('id', $user->id)->update([
                                'trial_type' => 3,
                                'skill_trial_two_marks' => $item[19]
                            ]);
                        } elseif (($item[19] < 20 || $item[20] - $item[19] < 20)) {
                            $user = DB::table('admission_registration_login')->where('id',  $user->id)->update([
                                'trial_type' => 5,
                                'final_status' => 3,
                                'skill_trial_two_marks' => $item[19]
                            ]);
                        }
                    } elseif ($item[0] == 17) {

                        //gymnasticboys

                        $data = [
                            'sport_id' => $user->sport_type,
                            'trial_type' => 2,

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
                            'remark' => $item[23],
                            'addedby' => Auth::guard('admin')->user()->id,
                            'date' => date("Y-m-d H:i:s")

                        ];

                        $id = DB::table('online_admission_gymnastic_boy_trial')->insertGetId($data);

                        if ($item[21] >= 20 && $item[22] - $item[21] >= 20) {
                            $user = DB::table('admission_registration_login')->where('id', $user->id)->update([
                                'trial_type' => 3,
                                'skill_trial_two_marks' => $item[21]
                            ]);
                        } elseif (($item[21] < 20 || $item[22] - $item[21] < 20)) {
                            $user = DB::table('admission_registration_login')->where('id',  $user->id)->update([
                                'trial_type' => 5,
                                'final_status' => 3,
                                'skill_trial_two_marks' => $item[21]
                            ]);
                        }
                    } elseif ($item[0] == 18) {

                        //gymnasticgirls




                        $data = [
                            'sport_id' => $user->sport_type,
                            'trial_type' => 2,

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
                            'remark' => $item[21],
                            'addedby' => Auth::guard('admin')->user()->id,
                            'date' => date("Y-m-d H:i:s")

                        ];

                        $id = DB::table('online_admission_gymnastic_girl_trial')->insertGetId($data);




                        if ($item[19] >= 20 && $item[20] - $item[19] >= 20) {
                            $user = DB::table('admission_registration_login')->where('id', $user->id)->update([
                                'trial_type' => 3,
                                'skill_trial_two_marks' => $item[19]
                            ]);
                        } elseif (($item[19] < 20 || $item[20] - $item[19] < 20)) {
                            $user = DB::table('admission_registration_login')->where('id',  $user->id)->update([
                                'trial_type' => 5,
                                'final_status' => 3,
                                'skill_trial_two_marks' => $item[19]
                            ]);
                        }
                    }
                }
            }
        }
    }
}
