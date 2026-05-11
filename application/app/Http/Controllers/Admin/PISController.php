<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\DivisionModel;
use App\Models\DivisionDistrictMap;
use App\Models\SportModel;
use App\Models\SportModelMaster;
use App\Models\DistrictModel;
use App\Models\EmployeeModel;

class PISController extends Controller
{
  
  public function employee(Request $request){

    return view('admin.employee.employee');
  }

  public function employee_store(Request $request)
  {
    $this->validate($request, [
        // 'employee_id' => 'required|unique:employee',
        'employee_name' => 'required',
        // 'employee_father_name' => 'required',
        // 'employee_mother_name' => 'required',
        // 'employee_mobile' => 'required|numeric|digits:10',
        // 'employee_email' => 'required|email',
        'employee_designation' => 'required',
        // 'employee_dob' => 'required',
        // 'employee_rank' => 'required',
        // 'year_of_appointment' => 'required',
        'employee_gender' => 'required'
   ]);  

    EmployeeModel::create([
        'employee_name' => $request->employee_name,
        'employee_mother' => $request->employee_mother_name,
        'employee_father' => $request->employee_father_name,
        'employee_email' => $request->employee_email,
        'employee_mobile' => $request->employee_mobile,
        'employee_designation' => $request->employee_designation,
        'employee_dob' => $request->employee_dob,
        'employee_rank'  => $request->employee_rank,
        'year_of_appointment' => $request->year_of_appointment,
        'employee_gender' => $request->employee_gender,
        'employee_id' => $request->employee_id,
        'created_by' => Auth::guard('admin')->user()->id
     ]);
 
    return redirect('admin/employee_list')->with("success", "Employee Successfully Saved.");          
  }

  public function employee_show()
  {        
    $template_manager = DB::table('employee');
    if(Auth::guard('admin')->user()->admin_role != 1){
      $template_manager->where('created_by', Auth::guard('admin')->user()->id);
    }
    $template_manager =$template_manager->orderBy('id', 'DESC')->get();        
    return view('admin.employee.employee_show', compact('template_manager'));
  }

  public function employee_edit($id)
  {
    $edit_template = EmployeeModel::findOrFail(decrypt($id));
    return view('admin.employee.employee_edit', compact('edit_template'));
  }

  public function employee_update(Request $request, $id)
  {
    $this->validate($request, [
      // 'employee_id' => 'required',
      'employee_name' => 'required',
      // 'employee_father_name' => 'required',
      // 'employee_mother_name' => 'required',
      // 'employee_mobile' => 'required',
      // 'employee_email' => 'required',
      'employee_designation' => 'required',
      // 'employee_dob' => 'required',
      // 'employee_rank' => 'required',
      // 'year_of_appointment' => 'required',
      'employee_gender' => 'required'
    ]); 
          
  DB::update('update employee set employee_id = ?, employee_name = ?, 
  employee_father = ?, employee_mother = ?, employee_mobile = ?, 
  employee_email = ?, employee_designation = ?, employee_rank = ?,year_of_appointment = ?,
  employee_gender = ?,  employee_dob = ?, updated_by = ? where id = ?',[$request->employee_id , $request->employee_name, 
  $request->employee_mother_name, $request->employee_father_name,$request->employee_mobile,  
  $request->employee_email,  $request->employee_designation,  $request->employee_rank, 
  $request->year_of_appointment,$request->employee_gender, $request->employee_dob,  Auth::guard('admin')->user()->id,  decrypt($id)]);

  return redirect('/admin/employee_list')->with('success', 'Employee Successfully Updated.');
  }

  public function employee_destroy(EmployeeModel $template,$id)
  {
    DB::delete('DELETE FROM employee WHERE id = ?', [decrypt($id)]);
    return redirect()->back()->with('success','Employee has been deleted successfully');
  }
  //----

  
}