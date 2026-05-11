<?php

namespace App\Traits;

use Illuminate\Http\Request;

 class ISPApplicantData {

	public $request_id;
	public  $dept_id;
}

 class ISPRequestData {

	public  $dept_id;
	public  $e_data;
}

 class ISPRequestedDataResponse {

	public  $error;
	public  $statusMessage;
	public  $data;
	public  $timestamp;

public function set_data($data) {
    $this->data = $data;
  }
  public function get_data() {
    return $this->data;
  }

  public function set_error($error) {
    $this->error = $error;
  }
  public function get_error() {
    return $this->error;
  }

 public function set_statusMessage($statusMessage) {
    $this->statusMessage = $statusMessage;
  }
  public function get_statusMessage() {
    return $this->statusMessage;
  }

  public function set_timestamp($timestamp) {
    $this->timestamp = $timestamp;
  }
  public function get_timestamp() {
    return $this->timestamp;
  }



}

class ISPRequestIdData{

	public  $request_id;
	public  $applicant_id;
	public  $service_code;
	public  $request_validated;

public function set_request_id($request_id) {
    $this->request_id = $request_id;
  }
  public function get_request_id() {
    return $this->request_id;
  }

  public function set_applicant_id($applicant_id) {
    $this->applicant_id = $applicant_id;
  }
  public function get_applicant_id() {
    return $this->applicant_id;
  }

 public function set_service_code($service_code) {
    $this->service_code = $service_code;
  }
  public function get_service_code() {
    return $this->service_code;
  }





}

class ISPRequestValidate {

	public  $sessionkey;
	public  $dept_id;
}

class ISPResponseApplicantData {

	public  $applicant_id;
	public  $first_name_eng;
	public  $middle_name_eng;
	public  $ast_name_eng;
	public  $first_name_hindi;
	public  $middle_name_hindi;
	public $gender;
	public $father_or_husband_or_guardian_name_eng;
	public $father_or_husband_or_guardian_name_hindi;
	public $mother_name_eng;
	public $mother_name_hindi;
	public $category;
	public $dob;
	public $pan_no;
	public $mobile;
	public $email;
	public $residential_house_no;
	public $residential_mohalla;
	public $residential_state;
	public $residential_post_office;
	public $residential_district;
	public $residential_tehsil;
	public $residential_police_station;
	public $residential_pin;
	public $permanent_house_no;
	public $permanent_mohalla;
	public $permanent_state;
	public $permanent_post_office;
	public $permanent_district;
	public $permanent_tehsil;
	public $permanent_police_station;
	public $permanent_pin;
	public $service_name_eng;
	public $service_name_hindi;
	public $service_code;
	public $family_id;
	public $member_id;
}

class ReturnServiceStatus {

	public $request_id;
	public $applicant_id;
	public $service_code;
	public $application_id;
	public $status_code;
	public $remarks;
	public $pendency_level;
	public $action_taken_time;
	public $pending_with_officer;
	public $d1;
    public $d2;
    public $d3;
    public $d4;
    public $d5;
    public $d6;
    public $d7;
    public $d8;
    public $d9;
    public $d10;
    public $d11;
    public $d12;
    public $d13;
    public $d14;
    public $d15;
    public $d16;
    public $d17;
    public $d18;
    public $d19;
    public $d20;

public function set_request_id($request_id) {
    $this->request_id = $request_id;
  }
 public function getRequest_id() {
    return $this->request_id;
  }

 public function set_applicant_id($applicant_id) {
    $this->applicant_id = $applicant_id;
  }
  function get_applicant_id() {
    return $this->applicant_id;
  }

public function set_service_code($service_code) {
    $this->service_code = $service_code;
  }
  public function get_service_code() {
    return $this->service_code;
  }

public function set_application_id($application_id) {
    $this->application_id = $application_id;
  }
  public function get_application_id() {
    return $this->application_id;
  }

public function set_status_code($status_code) {
    $this->status_code = $status_code;
  }
  public function get_status_code() {
    return $this->status_code;
  }

public function set_remarks($remarks) {
    $this->remarks = $remarks;
  }
  public function get_remarks() {
    return $this->remarks;
  }

public function set_pendency_level($pendency_level) {
    $this->pendency_level = $pendency_level;
  }
  public function get_pendency_level() {
    return $this->pendency_level;
  }

public function set_action_taken_time($action_taken_time) {
    $this->action_taken_time = $action_taken_time;
  }
  public function get_action_taken_time() {
    return $this->action_taken_time;
  }

public function set_pending_with_officer($pending_with_officer) {
    $this->pending_with_officer = $pending_with_officer;
  }
  public function get_pending_with_officer() {
    return $this->pending_with_officer;
  }
}

class ISPToken {

	public $username;
	public $password;
}

class ISPTokenResponse {

	public $token;
	public $error;
	public $statusMessage;
	public $timestamp;

	public function set_token($token) {
    $this->token = $token;
  }
  public function get_token() {
    return $this->token;
  }

  public function set_error($error) {
    $this->error = $error;
  }
  public function get_error() {
    return $this->error;
  }

 public function set_statusMessage($statusMessage) {
    $this->statusMessage = $statusMessage;
  }
  public function get_statusMessage() {
    return $this->statusMessage;
  }

  public function set_timestamp($timestamp) {
    $this->timestamp = $timestamp;
  }
  public function get_timestamp() {
    return $this->timestamp;
  }

}



?>
