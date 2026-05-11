<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\User\SolarPlantInvestor;
use App\Http\Controllers\Auth\Authentication;
use App\Http\Controllers\Auth\HostelAuthController;
use App\Http\Controllers\HostelApplication;
use App\Http\Controllers\darpanController;
use App\Http\Controllers\PlayerCoachController;
use App\Http\Controllers\GymnasiumSwimmingController;
use App\Http\Controllers\EklavyaKreedaKoshController;
use App\Http\Controllers\HostelTrailController;
use App\Http\Controllers\HostelTrailControllerTest;
use App\Http\Controllers\Admin;
use App\Http\Controllers\User\Dashboard;
use App\Http\Controllers\User\Profile;
use App\Http\Controllers\User\Plant;
use App\Http\Controllers\Auth\Adminathentication;
use App\Http\Controllers\Location;
use App\Http\Controllers\Admin\AdminDashboard;
use App\Http\Controllers\Admin\AdminMailController;
use App\Http\Controllers\Department\DashboardController;
use App\Http\Controllers\Admin\Department;
use App\Http\Controllers\Admin\Sector;
use App\Http\Controllers\Admin\RegisteredUser;
use App\Http\Controllers\Admin\PageManager;
use App\Http\Controllers\Admin\ModuleManager;
use App\Http\Controllers\Admin\AdminRole;
use App\Http\Controllers\Admin\Menu;
use App\Http\Controllers\Admin\Project;
use App\Http\Controllers\Admin\DivisionController;
use App\Http\Controllers\Admin\TehsilController;
use App\Http\Controllers\Admin\DivisionMapController;
use App\Http\Controllers\Admin\HostelMasterController;
use App\Http\Controllers\Admin\SportsController;
use App\Http\Controllers\Admin\DistrictController;
use App\Http\Controllers\Admin\PISController;
use App\Http\Controllers\Admin\SportsCollegeMasterController;
use App\Http\Controllers\Admin\CollegeSportsMapController;
use App\Http\Controllers\Admin\StudiumMasterController;
use App\Http\Controllers\Admin\OnlineAdmissionDetailController;
use App\Http\Controllers\Admin\MessageBoard;
use App\Http\Controllers\Controller;

use App\Http\Controllers\DirectRecruitment;
use App\Http\Controllers\FinancialAssistance;

use App\Http\Controllers\SuperAdmin;
use App\Http\Controllers\CollegeAdmin;
use App\Http\Controllers\DarpanCountController;
use App\Http\Controllers\OnlineAdmission;
use App\Http\Controllers\PaymentController;

use App\Http\Controllers\InventoryMaster;
use App\Http\Controllers\ItemMaster;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\PurchaseStores;
use App\Http\Controllers\InventoryReportController;

use App\Http\Controllers\Auth\PlayerAuthController;
use App\Http\Controllers\Player\PlayerApplication;
use App\Http\Controllers\Admin\PlayerClassificationController;
use App\Http\Controllers\Admin\InformationDetailController;
use App\Http\Controllers\Admin\EklavyaKreedaKendraController;
use App\Http\Controllers\Admin\GymnasiumSwimmingDetailController;
use App\Http\Controllers\Admin\CalendarManagementController;
use App\Http\Controllers\Admin\menuController;
use App\Http\Controllers\Auth\FacilityAuthController;
use App\Http\Controllers\FacilityApplication;
use App\Http\Controllers\UserCalendarManagement;
use App\Http\Controllers\Admin\CoachMasterController;
use App\Http\Controllers\AdminCoachingCampController;
use App\Http\Controllers\CoachingCampController;
use App\Http\Controllers\Admin\RegionalMasterController;
use App\Http\Controllers\EdistrcitController;
use App\Http\Controllers\Admin\HostelSportsController;
use App\Http\Controllers\Admin\PositionController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PrivateCoachingController;
use App\Http\Controllers\RajkoshController;
use App\Http\Controllers\FacilityBookingController;

use App\Http\Controllers\EklavyaFundController;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::any('/tableCollection', [Controller::class, 'tableCollection']);

Route::get('/pagination', [AdminDashboard::class, 'index']);
Route::get('/paginations', [AdminDashboard::class, 'fetch_data'])->name('fetch_data');


Route::get('/reset-marks-saurabh', function () {
    $appNo = '2026009393';

    // 1. Reset Skill marks for Athletics Runner
    DB::table('hostel_athletics_runner_trial')->where('application_no', $appNo)->where('trial_type', 4)->delete();

    // 2. Reset Physical marks
    DB::table('hostel_trial_applicant')->where('application_no', $appNo)->where('trial_type', 4)->delete();

    // 3. Reset main status and marks
    DB::table('hostel_register')->where('application_no', $appNo)->update([
        'trial_four' => 1,
        'skill_trial_four_marks' => 0.00,
        'physical_trial_four_marks' => 0.00
    ]);

    return "Trial marks for Application No 2026009393 have been successfully reset. Please refresh your list.";
});


Route::get('/clear', function () {
    Artisan::call('config:cache');
    Artisan::call('config:clear');
    Artisan::call('optimize:clear');
    Artisan::call('cache:clear');
    return 'Done';
});

// Route::get('/', function () {
//     return view('auth.login');
// });->middleware('StopScriptTags')


Route::any('/checkEmailValidity', [Authentication::class, 'checkEmailValidity'])->middleware('StopScriptTags');
Route::any('/checkandsendOTP', [Authentication::class, 'checkandsendOTP'])->middleware('StopScriptTags');
// Route::any('/mailCheck',[Authentication::class, 'mailCheck']);
// Route::any('/SendSMS',[Authentication::class, 'SendSMS']);


Route::any('/',    [Authentication::class, 'loginForm']);

// Player Registration ================================================================
// 08.05.2026 =========================================================================

Route::get('/sign-up/{id?}',          [Authentication::class, 'signUp'])->name('signUp');
Route::any('/login',            [Authentication::class, 'login'])->name('login'); // using
Route::get('/cp_refresh',       [Authentication::class, 'cp_refresh']);
Route::post('/preRegistration', [Authentication::class, 'preRegistration'])->name('preRegistration'); // using
Route::match(['GET', 'POST'], '/forgot-password', [Authentication::class, 'forgot'])->name('forgot');
Route::get('/otp',              [Authentication::class, 'otp'])->name('otp');
Route::post('/otpVerify',       [Authentication::class, 'otpVerify'])->name('otpVerify'); // using
Route::any('/resendOtp',        [Authentication::class, 'resendOtp'])->middleware('StopScriptTags'); // using

Route::get('/getStateData/{id}',  [Location::class, 'getState'])->middleware('StopScriptTags');
Route::get('/getCityData/{id}',   [Location::class, 'getCity'])->middleware('StopScriptTags');
Route::get('/getCitybyDiv/{id}/{dis?}',   [Location::class, 'getCitybyDiv']);


//direct recruitment
Route::get('/direct-recruitment/sign-up',          [DirectRecruitment::class, 'signUp'])->name('drsignUp');
Route::get('/direct-recruitment/loginForm',            [DirectRecruitment::class, 'loginForm'])->name('drloginForm');
Route::post('/direct-recruitment/login',            [DirectRecruitment::class, 'login'])->name('drlogin');
Route::match(['GET', 'POST'], '/direct-recruitment/forgot-password', [DirectRecruitment::class, 'forgot'])->name('drforgot');
Route::post('/direct-recruitment/preRegistration', [DirectRecruitment::class, 'preRegistration'])->name('drpreRegistration');
Route::get('/direct-recruitment/otp',              [DirectRecruitment::class, 'otp'])->name('drotp');
Route::post('/direct-recruitment/otpVerify',       [DirectRecruitment::class, 'otpVerify'])->name('drotpVerify');
Route::post('/direct-recruitment/advertisment-session', [DirectRecruitment::class, 'advertisment_session'])->name('advertisment-session');
//jyoti
Route::any('/direct-recruitment', [DirectRecruitment::class, 'postDetail'])->middleware('StopScriptTags');
Route::any('/direct-recruitment/advertisment_details', [DirectRecruitment::class, 'advertisment_details'])->middleware('StopScriptTags');

Route::middleware('IsUsers')->group(function () {
    Route::get('/direct-recruitment/dashboard',          [DirectRecruitment::class, 'dashboard'])->name('drdashboard')->middleware('StopScriptTags');
    Route::any('/sport_achievement',    [DirectRecruitment::class, 'sport_achievement'])->name('drsa')->middleware('StopScriptTags');
    Route::post('/direct-recruitment/save_achievement', [DirectRecruitment::class, 'save_achievement'])->name('drSaveAchievement');

    Route::get('/direct-recruitment/profile_detail/{id?}',    [DirectRecruitment::class, 'profile_detail'])->name('drcp');
    Route::get('/direct-recruitment/edit_profile_detail/{id?}',    [DirectRecruitment::class, 'edit_profile_detail'])->name('drecp');
    Route::post('/direct-recruitment/compProfile', [DirectRecruitment::class, 'compProfile'])->name('drcompProfile');
    Route::post('/direct-recruitment/updateProfile', [DirectRecruitment::class, 'updateProfile'])->name('drupdateProfile');
    Route::get('/direct-recruitment/formPreview/{id?}',    [DirectRecruitment::class, 'formPreview'])->name('drformPreview')->middleware('StopScriptTags');
    Route::post('/direct-recruitment/finalSubmit/{id?}',    [DirectRecruitment::class, 'finalSubmit'])->name('drfinalSubmit')->middleware('StopScriptTags');
    Route::get('/direct-recruitment/change-password',    [DirectRecruitment::class, 'changePassword'])->name('drchangePassword')->middleware('StopScriptTags');

    Route::post('/direct-recruitment/updatePassword',    [DirectRecruitment::class, 'updatePassword'])->name('drupdatePassword')->middleware('StopScriptTags');
    Route::get('/direct-recruitment/signOut',            [DirectRecruitment::class, 'signOut'])->name('drsignOut')->middleware('StopScriptTags');
});

//ifsc
Route::post('/financial-assistance/ifsc',    [FinancialAssistance::class, 'ifsc'])->name('ifsc');
//financial assistance
Route::get('/financial-assistance/sign-up',          [FinancialAssistance::class, 'signUp'])->name('fasignUp');
Route::get('/financial-assistance',            [FinancialAssistance::class, 'loginForm'])->name('faloginForm');
Route::post('/financial-assistance/login',            [FinancialAssistance::class, 'login'])->name('falogin');
Route::match(['GET', 'POST'], '/financial-assistance/forgot-password', [FinancialAssistance::class, 'forgot'])->name('faforgot');
Route::post('/financial-assistance/preRegistration', [FinancialAssistance::class, 'preRegistration'])->name('fapreRegistration');
Route::get('/financial-assistance/otp',              [FinancialAssistance::class, 'otp'])->name('faotp');
Route::post('/financial-assistance/otpVerify',       [FinancialAssistance::class, 'otpVerify'])->name('faotpVerify');
Route::middleware('IsUsers')->group(function () {

    Route::get('/financial-assistance/applyFor',    [FinancialAssistance::class, 'applyFor'])->name('faapplyFor')->middleware('StopScriptTags');
    Route::post('/financial-assistance/saveApplyFor',    [FinancialAssistance::class, 'saveApplyFor'])->name('fasaveApplyFor')->middleware('StopScriptTags');

    Route::get('/financial-assistance/dashboard',          [FinancialAssistance::class, 'dashboard'])->name('fadashboard')->middleware('StopScriptTags');
    Route::get('/financial-assistance/profile',    [FinancialAssistance::class, 'profile'])->name('faprofile')->middleware('StopScriptTags');
    Route::get('/financial-assistance/profile_detail',    [FinancialAssistance::class, 'profile_detail'])->name('facp')->middleware('StopScriptTags');
    Route::get('/financial-assistance/edit_profile_detail',    [FinancialAssistance::class, 'edit_profile_detail'])->name('faecp')->middleware('StopScriptTags');

    Route::post('/financial-assistance/compProfile', [FinancialAssistance::class, 'compProfile'])->name('facompProfile');
    Route::post('/financial-assistance/updateProfile', [FinancialAssistance::class, 'updateProfile'])->name('faupdateProfile');
    Route::get('/financial-assistance',    [FinancialAssistance::class, 'form'])->name('faform')->middleware('StopScriptTags');

    Route::post('/financial-assistance/save_financial_assistance',    [FinancialAssistance::class, 'save_financial_assistance'])->name('save_financial_assistance')->middleware('StopScriptTags');

    Route::get('/financialformPreview/{id?}',    [FinancialAssistance::class, 'financialformPreview'])->name('financialformpreview')->middleware('StopScriptTags');

    Route::get('/financial-assistance/edit_financialform/{id?}',    [FinancialAssistance::class, 'edit_financialform'])->name('edit_financialform')->middleware('StopScriptTags');
    Route::post('/financial-assistance/updatefinancialform', [FinancialAssistance::class, 'updatefinancialform'])->name('updatefinancialform');
    Route::post('/financial-assistance/finalSubmit/{id?}',    [FinancialAssistance::class, 'finalSubmit'])->name('fafinalSubmit')->middleware('StopScriptTags');
    Route::get('/financial-assistance/change-password',    [FinancialAssistance::class, 'changePassword'])->name('fachangePassword');

    Route::post('/financial-assistance/updatePassword',    [FinancialAssistance::class, 'updatePassword'])->name('faupdatePassword');
    Route::get('/financial-assistance/signOut',            [FinancialAssistance::class, 'signOut'])->name('fasignOut');

    Route::get('/monthlyPension_form',    [FinancialAssistance::class, 'monthlyPension_form'])->name('monthlyPension_form')->middleware('StopScriptTags');
    Route::post('/financial-assistance/save_monthlyPension',    [FinancialAssistance::class, 'save_monthlyPension'])->name('save_monthlyPension');
    Route::get('/monthlypensionformpreview/{id?}',    [FinancialAssistance::class, 'monthlypensionformpreview'])->name('monthlypensionformpreview')->middleware('StopScriptTags');
    Route::get('/financial-assistance/edit_monthlypensionform/{id?}',    [FinancialAssistance::class, 'edit_monthlypensionform'])->name('edit_monthlypensionform')->middleware('StopScriptTags');
    Route::post('/financial-assistance/updatemonthlypensionform', [FinancialAssistance::class, 'updatemonthlypensionform'])->name('updatemonthlypensionform');
    Route::post('/financial-assistance/finalSubmitmonthly/{id?}',    [FinancialAssistance::class, 'finalSubmitmonthly'])->name('finalSubmitmonthly')->middleware('StopScriptTags');
});


// city

Route::any('get_city', [Profile::class, 'get_city']);

// regional office

Route::post('get_region_sport_office', [Profile::class, 'get_region_sport_office']);

// Route::get('profile_detail',[Authentication::class,'profile_detail']);
//Route::get('application-preview',[Authentication::class,'application_preview']);

Route::any('/getReplyDetails',     [Authentication::class, 'getReplyDetails'])->middleware('StopScriptTags');
Route::any('directMarkQuery',     [Authentication::class, 'directMarkQuery'])->middleware('StopScriptTags');

/**
 * User Route
 *
 * Guard Web Middleware Authentication
 */

Route::get('/dashboard_new', [Dashboard::class, 'dashboard_new'])->name('dashboard_new');

// Player Registration =================================================================================
// 08.05.2026 ==========================================================================================
Route::middleware('IsUsers')->group(function () {

    /**
     * User Dashboard Route
     */
    Route::get('/dashboard', [Dashboard::class, 'dashboard_new'])->name('dashboard'); // using

  // Route::get('/dashboard',          [Dashboard::class, 'dashboard'])->name('dashboard')->middleware('StopScriptTags');


    /**
     * User Award detail route
     */
    Route::any('/awardDeatils/{id}',             [Profile::class, 'awardDeatils'])->name('awardDeatils')->middleware('StopScriptTags');
    Route::any('/laxmandetailForm/{id?}',             [Profile::class, 'laxmandetailForm'])->name('laxmandetailForm')->middleware('StopScriptTags');
    Route::any('/laxmibaidetailForm/{id?}',             [Profile::class, 'laxmibaidetailForm'])->name('laxmibaidetailForm')->middleware('StopScriptTags');
    Route::any('/positiondetailForm/{id?}',             [Profile::class, 'positiondetailForm'])->name('positiondetailForm')->middleware('StopScriptTags');




    /**
     * User Profile Route
     */
    Route::get('/profile',    [Profile::class, 'index'])->name('profile')->middleware('StopScriptTags');
    Route::get('/applyFor',    [Profile::class, 'applyFor'])->name('applyFor')->middleware('StopScriptTags');
    Route::post('/saveApplyFor',    [Profile::class, 'saveApplyFor'])->name('saveApplyFor')->middleware('StopScriptTags');
    Route::get('/profile_detail',    [Profile::class, 'profile_detail'])->name('cp');
    Route::any('/updateProfile',      [Profile::class, 'updateProfile'])->name('updateProfile');
    Route::get('/change-password',    [Profile::class, 'changePassword'])->name('changePassword'); // using

    Route::post('compProfile', [Profile::class, 'compProfile']);


    Route::get('position_holder', [Profile::class, 'position_holder'])->middleware('StopScriptTags');
    Route::post('save_position_holder_award', [Profile::class, 'save_position_holder_award']);
    Route::get('edit_position_holder/{id?}', [Profile::class, 'edit_position_holder'])->name('edit_position_holder');
    Route::post('update_position_holder', [Profile::class, 'update_position_holder']);
    Route::post('finalSubmit_position_holder/{id?}', [Profile::class, 'finalSubmit_position_holder']);
    Route::post('get_position_event', [Profile::class, 'get_position_event']);

    Route::get('direct_recruitment', [Profile::class, 'direct_recruitment'])->middleware('StopScriptTags');
    Route::get('rani_laxmi_bai_award', [Profile::class, 'rani_laxmi_bai_award'])->middleware('StopScriptTags');
    Route::get('laxman_award', [Profile::class, 'laxman_award'])->name('laxman_award')->middleware('StopScriptTags');
    // Route::get('laxman_award2',[Profile::class,'laxman_award2']);
    Route::get('edit_laxman_award/{id?}', [Profile::class, 'edit_laxman_award'])->name('edit_laxman_award')->middleware('StopScriptTags');
    Route::post('save_laxman_award', [Profile::class, 'save_laxman_award']);
    Route::post('update_laxman_award', [Profile::class, 'update_laxman_award']);
    Route::post('finalSubmit_laxman_award/{id?}', [Profile::class, 'finalSubmit_laxman_award'])->middleware('StopScriptTags');
    Route::get('rso_login', [Profile::class, 'rso_login'])->middleware('StopScriptTags');

    Route::post('save_rani_laxmibai_award', [Profile::class, 'save_rani_laxmibai_award']);
    Route::any('/ranilaxmibaiForm',             [Profile::class, 'ranilaxmibaiForm'])->name('ranilaxmibaiForm')->middleware('StopScriptTags');
    Route::get('edit_laxmibai_award/{id?}', [Profile::class, 'edit_laxmibai_award'])->name('edit_laxmibai_award')->middleware('StopScriptTags');
    Route::post('update_laxmibai_award', [Profile::class, 'update_laxmibai_award']);
    Route::post('finalSubmit_laxmibai_award/{id?}', [Profile::class, 'finalSubmit_laxmibai_award'])->middleware('StopScriptTags');


  // financial


    /**
     * User Authentication Route
     */

    Route::post('/updatePassword',    [Authentication::class, 'updatePassword']); // using
    Route::get('/signOut',            [Authentication::class, 'signOut'])->name('signOut')->middleware('StopScriptTags');
});



// --- Universal Asset Fallback Route ---
// Catch requests for static files that might be hardcoded with various prefixes or point to the wrong subdirectory.
// This serves them directly from the public/ folder if they exist, bypassing middleware.
Route::get('{any}', function ($path) {
    if (strpos($path, '..') !== false) {
        abort(404);
    }

    $file = public_path($path);

    // Fallback 1: Try removing the first segment (the "prefix")
    if (!file_exists($file) || is_dir($file)) {
        $segments = explode('/', $path);
        if (count($segments) > 1) {
            array_shift($segments);
            $cleanPath = implode('/', $segments);
            if (file_exists(public_path($cleanPath)) && !is_dir(public_path($cleanPath))) {
                $file = public_path($cleanPath);
            }
        }
    }

    // Fallback 2: Try looking in common images/admin/assets_admin folders if still not found
    if (!file_exists($file) || is_dir($file)) {
        $basename = basename($path);
        $directories = ['images/', 'admin/images/', 'assets_admin/images/', 'facility_booking_storage/images/', 'RPCAA/images/'];
        foreach ($directories as $dir) {
            if (file_exists(public_path($dir . $basename))) {
                $file = public_path($dir . $basename);
                break;
            }
        }
    }

    if (file_exists($file) && !is_dir($file)) {
        $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
        $mimeTypes = [
            'css'   => 'text/css',
            'js'    => 'application/javascript',
            'svg'   => 'image/svg+xml',
            'png'   => 'image/png',
            'jpg'   => 'image/jpeg',
            'jpeg'  => 'image/jpeg',
            'gif'   => 'image/gif',
            'woff'  => 'font/woff',
            'woff2' => 'font/woff2',
            'ttf'   => 'font/ttf',
            'pdf'   => 'application/pdf',
            'ico'   => 'image/x-icon',
        ];

        if (isset($mimeTypes[$extension])) {
            return response()->file($file, ['Content-Type' => $mimeTypes[$extension], 'Cache-Control' => 'public, max-age=3600']);
        }
    }
    abort(404);
})->where('any', '.*\.(png|jpg|jpeg|gif|svg|css|js|woff|woff2|ttf|pdf|ico)$');
// --------------------------------------
// --------------------------------------
// -----------------------------

Route::group(['prefix' => 'admin', 'middleware' => ['IsAdmin']], function () {

    Route::get('/unauthorized', function () {
        return view('admin.unauthorised');
    });
    // delete login detail code by anu
    Route::any('delete_login_history',        [Adminathentication::class, 'delete_login_history'])->name('delete_login_history');
    // delete login detail code by anu

    Route::get('dashboard',        [AdminDashboard::class, 'dashboard'])->name('ad')->middleware('StopScriptTags');
    Route::any('projectlist',      [AdminDashboard::class, 'projectlist'])->name('projectlist')->middleware('StopScriptTags');
    Route::any('projectdashboard', [AdminDashboard::class, 'projectdashboard'])->middleware('StopScriptTags');
    Route::get('/signOuts',        [Adminathentication::class, 'signOuts'])->name('signOuts');

    // Route::get('/registeredInvestors',  [AdminDashboard::class, 'registeredInvestors']);
    // Route::get('/filedProjects',        [AdminDashboard::class, 'filedProjects']);

    // Route::get('/directRecruitmentPlayers',        [AdminDashboard::class, 'directRecruitmentPlayers'])->name('directRecruitmentPlayers');
    // Route::get('/formerSportsPerson',        [AdminDashboard::class, 'formerSportsPerson'])->name('formerSportsPerson');
    // Route::get('/awardList',        [AdminDashboard::class, 'awardList'])->name('awardList');
    // Route::get('/positionHolders',        [AdminDashboard::class, 'positionHolders'])->name('positionHolders');
    // Route::get('/applicantDashboard',        [AdminDashboard::class, 'applicantDashboard'])->name('applicantDashboard');
    Route::get('user_manager',        [AdminDashboard::class, 'user_manager'])->name('user_manager')->middleware('IsMapping');
    Route::get('/userManagerStatus/{id}', [AdminDashboard::class, 'userManagerStatus']);
    Route::get('user_access_details', [AdminDashboard::class, 'user_access_details'])->name('user_access_details');
    Route::get('/user_manager/add',        [AdminDashboard::class, 'user_manager_add'])->name('user_manager_add');
    Route::get('edit-user/{id}',   [AdminDashboard::class, 'edituser'])->name('edituser');
    Route::post('user_manager/update',        [AdminDashboard::class, 'user_manager_update'])->name('user_manager_update');



    Route::get('post_master',        [AdminDashboard::class, 'post_master'])->name('post_master')->middleware('IsMapping')->middleware('StopScriptTags');
    Route::get('edit-post/{id}',        [AdminDashboard::class, 'editpost'])->name('edit_post')->middleware('StopScriptTags');
    Route::any('/post_master/add',        [AdminDashboard::class, 'post_master_add'])->name('post_master_add')->middleware('StopScriptTags');
    Route::post('add_advertisment_post',        [AdminDashboard::class, 'add_advertisment_post'])->name('add_advertisment_post')->middleware('StopScriptTags');


    Route::get('deletePostMaster/{id}', [AdminDashboard::class, 'deletePostMaster'])->name('deletePostMaster')->middleware('StopScriptTags')->middleware('IsMapping');
    Route::get('post_wise_count',        [AdminDashboard::class, 'post_wise_count'])->name('post_wise_count')->middleware('StopScriptTags')->middleware('IsMapping');


    /**
     * date management
     */
    Route::get('date_manangement_master',        [AdminDashboard::class, 'dateManangementMaster'])->name('dateManangementMaster')->middleware('StopScriptTags');
    Route::get('date_manangement_edit/{id}',        [AdminDashboard::class, 'editDateMmanangement'])->name('editDateMmanangement')->middleware('StopScriptTags');
    Route::any('/date_manangement/add',        [AdminDashboard::class, 'dateManangementAdd'])->name('dateManangementAdd')->middleware('StopScriptTags');

    /**
     * Admin User Route
     */

  // Route::get('registered-users', [RegisteredUser::class, 'registeredUsers'])->name('regUser');
  // Route::get('users-manage',     [RegisteredUser::class, 'usermanage'])->name('usermanage');
  // Route::get('usersStatus/{id}', [RegisteredUser::class, 'usersStatus'])->name('usersStatus');
  // Route::get('edit-user/{id}',   [RegisteredUser::class, 'edituser'])->name('edituser');
  // Route::post('updateUser',      [RegisteredUser::class, 'updateUser'])->name('updateUser');
  // Route::get('deleteUser/{id}', [RegisteredUser::class, 'deleteUser'])->name('deleteUser');

  // Route::get('userslist',        [RegisteredUser::class, 'userslist'])->name('userslist');

    /**
     * Admin Department Routet
     */

  // Route::get('department',            [Department::class, 'index'])->name('adDepart');
  // Route::any('createDepartment',      [Department::class, 'addDepartment'])->name('createDepartment');
  // Route::get('departmentStatus/{id}', [Department::class, 'departmentStatus']);
  // Route::post('updateDepartment',     [Department::class, 'updateDepartment'])->name('updateDepartment');

    /**
     * Admin Role Route
     */

    Route::get('role_manager',     [AdminRole::class, 'index'])->name('roles')->middleware('IsMapping')->middleware('StopScriptTags');
    Route::any('createRole',       [AdminRole::class, 'createRole'])->name('createRole')->middleware('StopScriptTags');
    Route::post('updateRole',      [AdminRole::class, 'updateRole'])->name('updateRole')->middleware('StopScriptTags');
    Route::get('roleStatus/{id}',  [AdminRole::class, 'roleStatus'])->middleware('StopScriptTags');
    Route::get('deleteRole/{id}',  [AdminRole::class, 'deleteRole'])->middleware('StopScriptTags');

    /**
     * Admin Sector Route
     */
    /**
     * Admin sport event module
     */

    Route::get('sport_event',            [SportsController::class, 'sport_event'])->name('sport_event')->middleware('StopScriptTags');
    Route::any('createSEvent',       [SportsController::class, 'createSEvent'])->name('createSEvent')->middleware('StopScriptTags');
    Route::post('updateSEvent',      [SportsController::class, 'updateSEvent'])->name('updateSEvent')->middleware('StopScriptTags');
    Route::get('SEventStatus/{id}',  [SportsController::class, 'SEventStatus'])->name('SEventStatus')->middleware('StopScriptTags');
    Route::get('deleteSEvent/{id}', [SportsController::class, 'deleteSEvent'])->name('deleteSEvent')->middleware('StopScriptTags');

    /**
     * Admin division master 10/04/2023 Route---------------------------------------------------------------------
     */

    //onlineAdmissionDetail
    Route::get('online-admission-detail', [OnlineAdmissionDetailController::class, 'index'])->name('onlineAdmissionDetail')->middleware('StopScriptTags');
    Route::get('online-admission-details/{id}', [OnlineAdmissionDetailController::class, 'registerUserDetails'])->name('registerUserDetails')->middleware('StopScriptTags');


    //stadium_url
    Route::get('create-stadium', [StudiumMasterController::class, 'index'])->name('create-studium')->middleware('StopScriptTags');
    Route::any('save-studium-master', [StudiumMasterController::class, 'saveStudiumMaster'])->name('saveStudiumMaster')->middleware('StopScriptTags');
    Route::post('updateStudiumMaster', [StudiumMasterController::class, 'updateStudiumMaster'])->name('updateStudiumMaster')->middleware('StopScriptTags');
    Route::get('delete-studium-master/{id}', [StudiumMasterController::class, 'deleteStudiumMaster'])->name('deleteStudiumMaster')->middleware('StopScriptTags');

    //Gymnasium nov-02-2023
    Route::get('create-gymnasium', [StudiumMasterController::class, 'gymnasium'])->name('create-gymnasium')->middleware('StopScriptTags');
    Route::any('save-gymnasium-master', [StudiumMasterController::class, 'saveGymnasiumMaster'])->name('saveGymnasiumMaster')->middleware('StopScriptTags');
    Route::post('updateGymnasiumMaster', [StudiumMasterController::class, 'updateGymnasiumMaster'])->name('updateGymnasiumMaster')->middleware('StopScriptTags');
    Route::get('delete-gymnasium-master/{id}', [StudiumMasterController::class, 'deleteGymnasiumMaster'])->name('deleteGymnasiumMaster')->middleware('StopScriptTags');

    //Swimming nov-02-2023
    Route::get('create-swimming', [StudiumMasterController::class, 'swimming'])->name('create-swimming')->middleware('StopScriptTags');
    Route::any('save-swimming-master', [StudiumMasterController::class, 'saveSwimmingMaster'])->name('saveSwimmingMaster')->middleware('StopScriptTags');
    Route::post('updateSwimmingMaster', [StudiumMasterController::class, 'updateSwimmingMaster'])->name('updateSwimmingMaster')->middleware('StopScriptTags');
    Route::get('delete-swimming-master/{id}', [StudiumMasterController::class, 'deleteSwimmingMaster'])->name('deleteSwimmingMaster')->middleware('StopScriptTags');


    //Regional Sports Office mapping 05-2-2024
    Route::get('create-regional', [RegionalMasterController::class, 'regional'])->name('create-regional')->middleware('StopScriptTags');
    Route::any('save-regional-master', [RegionalMasterController::class, 'saveRegionalMaster'])->name('saveRegionalMaster')->middleware('StopScriptTags');
    Route::post('updateRegionalMaster', [RegionalMasterController::class, 'updateRegionalMaster'])->name('updateRegionalMaster')->middleware('StopScriptTags');
    Route::get('delete-regional-master/{id}', [RegionalMasterController::class, 'deleteRegionalMaster'])->name('deleteRegionalMaster')->middleware('StopScriptTags');
    Route::get('regionalStatus/{id}', [RegionalMasterController::class, 'regionalStatus'])->name('regionalStatus')->middleware('StopScriptTags');


    //college sport mapping route
    Route::get('college-sports-map-list/{id?}', [CollegeSportsMapController::class, 'index'])->name('collegeSportsMapList')->middleware('StopScriptTags');
    Route::any('create-sports-map', [CollegeSportsMapController::class, 'saveSportCollegeMap'])->name('saveSportCollegeMap')->middleware('StopScriptTags');
    Route::get('checkedStatus/{id}', [CollegeSportsMapController::class, 'checkedStatus'])->name('checkedStatus')->middleware('StopScriptTags');
    Route::get('delete-sport-college-map/{id}', [CollegeSportsMapController::class, 'deleteSportCollege'])->name('deleteSportCollege')->middleware('StopScriptTags');

    //college master route
    Route::get('college-master-list', [SportsCollegeMasterController::class, 'index'])->name('collegeMasterList')->middleware('StopScriptTags');
    Route::any('create-college-master', [SportsCollegeMasterController::class, 'saveSportMaster'])->name('saveSportMaster')->middleware('StopScriptTags');
    Route::post('updateCollegeMaster', [SportsCollegeMasterController::class, 'updateCollegeMaster'])->name('updateCollegeMaster')->middleware('StopScriptTags');
    Route::get('delete-college-master/{id}', [SportsCollegeMasterController::class, 'deleteCollegeMaster'])->name('deleteCollegeMaster')->middleware('StopScriptTags');


    //district route
    Route::get('district-list',        [DistrictController::class, 'index'])->name('district')->middleware('StopScriptTags');
    Route::any('create-district',       [DistrictController::class, 'saveDistrict'])->name('saveDistrict')->middleware('StopScriptTags');
    Route::post('updateDistrict',       [DistrictController::class, 'updateDistrict'])->name('updateDistrict')->middleware('StopScriptTags');
    Route::get('districtStatus/{id}', [DistrictController::class, 'districtStatus'])->name('districtStatus')->middleware('StopScriptTags');

    //sport_type route
    Route::get('hostel-sport-list',         [HostelSportsController::class, 'index'])->name('hostel_sports')->middleware('StopScriptTags');
    Route::any('hostel-create-sport',       [HostelSportsController::class, 'saveSport'])->name('hostelsaveSport')->middleware('StopScriptTags');
    Route::get('hostel-sportStatus/{id}', [HostelSportsController::class, 'sportStatus'])->name('hostelsportStatus')->middleware('StopScriptTags');
    Route::post('hostel-updateSport',      [HostelSportsController::class, 'updateSport'])->name('hostelupdateSport')->middleware('StopScriptTags');




    Route::get('sport-list',         [SportsController::class, 'index'])->name('sports')->middleware('StopScriptTags');
    Route::any('create-sport',       [SportsController::class, 'saveSport'])->name('saveSport')->middleware('StopScriptTags');
    Route::post('updateSport',      [SportsController::class, 'updateSport'])->name('updateSport')->middleware('StopScriptTags');
    Route::get('sportStatus/{id}', [SportsController::class, 'sportStatus'])->name('sportStatus')->middleware('StopScriptTags');

    //CreateDivision
    Route::get('create-division',     [DivisionController::class, 'index'])->name('division')->middleware('StopScriptTags');
    Route::any('save-division',       [DivisionController::class, 'saveDivision'])->name('saveDivision')->middleware('StopScriptTags');
    Route::post('updateDivision',     [DivisionController::class, 'updateDivision'])->name('updateDivision')->middleware('StopScriptTags');
    Route::get('divisionStatus/{id}', [DivisionController::class, 'divisionStatus'])->name('divisionStatus')->middleware('StopScriptTags');
    Route::get('deleteDivision/{id}', [DivisionController::class, 'deleteDivision'])->name('deleteDivision')->middleware('StopScriptTags');

    //tehsil_master
    Route::get('create-tehsil',     [TehsilController::class, 'index'])->name('tehsil')->middleware('StopScriptTags');
    Route::any('save-tehsil',       [TehsilController::class, 'saveTehsil'])->name('saveTehsil')->middleware('StopScriptTags');
    Route::post('updateTehsil',     [TehsilController::class, 'updateTehsil'])->name('updateTehsil')->middleware('StopScriptTags');
    Route::get('tehsilStatus/{id}', [TehsilController::class, 'tehsilStatus'])->name('tehsilStatus')->middleware('StopScriptTags');
    Route::get('deleteTehsil/{id}', [TehsilController::class, 'deleteTehsil'])->name('deleteTehsil')->middleware('StopScriptTags');

    //DivisionMapController
    Route::get('list-division-map',          [DivisionMapController::class, 'index'])->name('list-division-map')->middleware('StopScriptTags');
    Route::any('save-division-map',          [DivisionMapController::class, 'saveDivisionMap'])->name('saveDivisionMap')->middleware('StopScriptTags');
    Route::get('divisionMap/{id}',           [DivisionMapController::class, 'divisionMap'])->name('divisionMap')->middleware('StopScriptTags');
    Route::get('delete-division-map/{id}', [DivisionMapController::class, 'deleteDivisionMap'])->name('deleteDivisionMap')->middleware('StopScriptTags');

    //HostelMasterController
    Route::get('hostel-master',             [HostelMasterController::class, 'index'])->name('hostelMaster')->middleware('StopScriptTags');
    Route::match(['get', 'post'], 'list-hostel-master',        [HostelMasterController::class, 'listHostelMaster'])->name('listHostelMaster')->middleware('StopScriptTags');
    Route::post('save-hostel-master',       [HostelMasterController::class, 'saveHostelMaster'])->name('saveHostelMaster')->middleware('StopScriptTags');
    Route::post('fetch-cities',             [HostelMasterController::class, 'fetchCities'])->name('fetchCities')->middleware('StopScriptTags');
    Route::get('edit-hotel-master/{id}',    [HostelMasterController::class, 'editHotelMaster'])->name('editHotelMaster')->middleware('StopScriptTags');
    Route::post('update-hotel-master/{id}', [HostelMasterController::class, 'updateHotelMaster'])->name('updateHotelMaster')->middleware('StopScriptTags');
    Route::get('search',                       [HostelMasterController::class, 'search'])->name('search')->middleware('StopScriptTags');


    //sport add-employee  working 05/12/2023
    Route::any('add-employee', [PISController::class, 'employee'])->name('employee')->middleware('StopScriptTags');
    Route::post('employee_store', [PISController::class, 'employee_store'])->name('employee_store')->middleware('StopScriptTags');
    Route::get('employee_list', [PISController::class, 'employee_show'])->name('employee_show')->middleware('StopScriptTags');
    Route::get('employee_edit/{id}', [PISController::class, 'employee_edit'])->name('employee_edit')->middleware('StopScriptTags');
    Route::post('employee_update/{id}', [PISController::class, 'employee_update'])->name('employee_update')->middleware('StopScriptTags');
    Route::post('employee_destroy/{id}', [PISController::class, 'employee_destroy'])->name('employee_destroy')->middleware('StopScriptTags');
    /**
     * Admin divisin master 10/04/2023 Route--------------------------------------------------------
     */

  // Route::get('sector',            [Sector::class, 'index'])->name('adSector');
  // Route::any('createSector',      [Sector::class, 'createSector'])->name('createSector');
  // Route::get('sectorStatus/{id}', [Sector::class, 'sectorStatus']);
  // Route::post('updateSector',     [Sector::class, 'updateSector'])->name('updateSector');

    /**
     * Admin Location Route
     */

    Route::get('state',             [Location::class, 'state'])->name('state')->middleware('StopScriptTags');
    Route::get('city',              [Location::class, 'city'])->name('city')->middleware('StopScriptTags');
    Route::get('cityStatus/{id}',   [Location::class, 'cityStatus'])->middleware('StopScriptTags');
    Route::get('stateStatus/{id}',  [Location::class, 'stateStatus'])->middleware('StopScriptTags');
    Route::any('cityUpdate',        [Location::class, 'updateCity'])->name('cityUpdate')->middleware('StopScriptTags');
    Route::any('stateUpdate',       [Location::class, 'stateUpdate'])->middleware('StopScriptTags');
    Route::any('addState',          [Location::class, 'addState'])->middleware('StopScriptTags');
    Route::any('addCity',           [Location::class, 'addCity'])->middleware('StopScriptTags');

    /**
     * Admin Page Manager Route
     */

    Route::any('page_manager',    [PageManager::class, 'index'])->name('pageCreate')->middleware('IsMapping');
    Route::any('add-new-page',    [PageManager::class, 'pageForm'])->name('pageForm');
    Route::any('createPage',      [PageManager::class, 'createPage'])->name('createPage');
    Route::any('getPage/{id}',    [PageManager::class, 'getPage'])->name('getPage');
    Route::get('pageStatus/{id}', [PageManager::class, 'pageStatus']);
    Route::any('editPage/{id}',   [PageManager::class, 'editPage'])->name('editPage');
    Route::any('updatePage/{id}', [PageManager::class, 'updatePage'])->name('updatePage');

    /**
     * Admin Module Manager Route
     */

    Route::any('module_manager',    [ModuleManager::class, 'index'])->name('moduleCreate')->middleware('IsMapping');
    Route::any('add-new-module',    [ModuleManager::class, 'moduleForm'])->name('moduleForm');
    Route::any('createModule',      [ModuleManager::class, 'createModule'])->name('createModule');
    Route::get('moduleStatus/{id}', [ModuleManager::class, 'moduleStatus']);
    Route::any('editModule/{id}',   [ModuleManager::class, 'editModule'])->name('editModule');
    Route::any('updateModule/{id}', [ModuleManager::class, 'updateModule'])->name('updateModule');

    /**
     * Admin Menu Manage Route
     */

    Route::get('menu',            [Menu::class, 'menu'])->name('menu');
    Route::post('menuCreate',     [Menu::class, 'menuCreate'])->name('menuCreate');
    Route::any('menuUpdate',      [Menu::class, 'menuUpdate'])->name('menuUpdate');
    Route::get('menuStatus/{id}', [Menu::class, 'menuStatus'])->name('menuStatus');

    //nov212023
    Route::get('coach',  [CoachMasterController::class, 'index']);
//endnov212023

    /**
     * Admin Project Manage Route
     */

    // Route::any('/projectdeatil/{id}/{type}',          [Project::class, 'projectdeatil'])->name('projectdeatil');
    // Route::any('/projectdeatilsExports/{id}/{type}',  [Project::class, 'projectdeatilsExports'])->name('projectdeatilsExports');
    // Route::any('/exportExcel',  [Project::class, 'exportExcel'])->name('exportExcel');

    Route::any('/forwordProject',          [Project::class, 'forwordProject'])->name('forwordProject')->middleware('StopScriptTags');

    Route::any('coaches', [PlayerCoachController::class, 'admin_coach'])->name('admin_coach')->middleware('StopScriptTags');

    Route::any('players', [PlayerCoachController::class, 'admin_player'])->name('admin_player')->middleware('StopScriptTags');
    Route::get('applicant_view_details/{id}', [PlayerCoachController::class, 'player_coach_view_details'])->name('player_coach_view_details')->middleware('StopScriptTags');

    Route::any('player_status/{status}', [PlayerCoachController::class, 'admin_player_status'])->name('admin_player_status')->middleware('StopScriptTags');
    Route::any('coach_status/{status}', [PlayerCoachController::class, 'admin_coach_status'])->name('admin_coach_status')->middleware('StopScriptTags');

    Route::any('player_coach_application_status/{id}/{status}', [PlayerCoachController::class, 'player_coach_application_status'])->name('player_coach_application_status')->middleware('StopScriptTags');


    Route::get('create_calendar_management',     [CalendarManagementController::class, 'index'])->name('index')->middleware('IsMapping');
    Route::any('save_calendar',  [CalendarManagementController::class, 'saveCalendar'])->name('saveCalendar')->middleware('IsMapping');
    Route::get('calendar_list',     [CalendarManagementController::class, 'calendarList'])->name('calendarList')->middleware('IsMapping');
    Route::get('edit_calendar/{id}',  [CalendarManagementController::class, 'edit_calendar'])->name('edit_calendar')->middleware('IsMapping');
    Route::post('calendar_management_update/{id}', [CalendarManagementController::class, 'calendar_management_update'])->name('calendar_management_update')->middleware('IsMapping');
});


Route::group(['prefix' => 'department', 'middleware' => ['IsDepartment']], function () {

    Route::get('/signOutsDep',        [Authentication::class, 'signOutsDep'])->name('signOutsDep')->middleware('StopScriptTags');
    Route::get('dashboard',        [DashboardController::class, 'dashboard'])->middleware('StopScriptTags');
    Route::any('projectdashboard', [DashboardController::class, 'projectdashboard'])->middleware('StopScriptTags');
    Route::any('revertProject', [DashboardController::class, 'revertProject'])->middleware('StopScriptTags');
    Route::any('/projectDeatils/{id}/{type}',          [DashboardController::class, 'projectDeatils'])->name('projectDeatils')->middleware('StopScriptTags');
});


Route::get('department/login',     [Adminathentication::class, 'd_form_login']);
Route::post('department/login',     [Adminathentication::class, 'd_login'])->name('d_login');

Route::get('admin/login',     [Adminathentication::class, 'form_login']);
Route::post('admin/login',     [Adminathentication::class, 'login'])->name('adminlogin');

Route::match(['GET', 'POST'], 'admin/forgot-password', [Adminathentication::class, 'forgot'])->name('adminforgot');
Route::match(['GET', 'POST'], 'admin/adminotp', [Adminathentication::class, 'otp'])->name('adminotp');
Route::get('admin/forgot_password',     [Admin::class, 'forgot_password'])->name('forgot_password');
Route::get('admin/AddCourseWiseEligibility',     [Admin::class, 'AddCourseWiseEligibility'])->name('AddCourseWiseEligibility');
Route::get('admin/AddSubject',     [Admin::class, 'AddSubject'])->name('AddSubject');
Route::get('admin/Admission_form_field_details',     [Admin::class, 'Admission_form_field_details'])->name('Admission_form_field_details');
Route::get('admin/admissionNumberAllotment',     [Admin::class, 'admissionNumberAllotment'])->name('admissionNumberAllotment');
Route::get('admin/board_master',     [Admin::class, 'board_master'])->name('board_master');


//darpan count
Route::get('darpancount',   [DarpanCountController::class, 'darpancount'])->name('darpancount');
Route::get('darpancountList',   [DarpanCountController::class, 'darpancountList'])->name('darpancountList');

Route::post('darpancountStore',   [DarpanCountController::class, 'darpancountStore'])->name('darpancountStore');
Route::post('darpancountStoreFinal',   [DarpanCountController::class, 'darpancountStoreFinal'])->name('darpancountStoreFinal');
Route::post('darpancountGetdate',   [DarpanCountController::class, 'getdateAction'])->name('darpancountGetdate');


Route::any('/logintype',                 [Authentication::class, 'logintype']);

Route::get('admin/change-password',    [Adminathentication::class, 'changePassword'])->name('adminChangePassword')->middleware('StopScriptTags');

// Route::group(['prefix' => 'rso'], function () {
Route::group(['prefix' => 'admin', 'middleware' => ['IsAdmin']], function () {
    Route::get('profile',     [AdminDashboard::class, 'adminprofile'])->name('adminprofile')->middleware('StopScriptTags');
    // Route::get('login',     [Adminathentication::class, 'rso_form_login']);
    // Route::post('rso_login',     [Adminathentication::class, 'rso_login'])->name('rso_login');
    Route::get('rsoDashboard',        [DashboardController::class, 'rsoDashboard'])->name('rsoDashboard')->middleware('StopScriptTags');
    Route::post('updatePasswordd',    [Adminathentication::class, 'updatePassword'])->name('adminupdatePassword');

    Route::get('rsologout', [Adminathentication::class, 'rsologout'])->name('rsologout')->middleware('StopScriptTags');

    Route::get('direct_rect',     [Adminathentication::class, 'direct_rect'])->name('direct_rect')->middleware('StopScriptTags');
    Route::get('direct_rect_spe/{id}/{type?}',     [Adminathentication::class, 'direct_rect_spe'])->name('direct_rect_spe')->middleware('StopScriptTags');
    Route::get('direct_rect_view/{id}',     [Adminathentication::class, 'direct_rect_view'])->name('direct_rect_view')->middleware('StopScriptTags');

    Route::get('financial_assis',     [Adminathentication::class, 'financial_assis'])->name('financial_assis')->middleware('StopScriptTags');
    Route::get('financial_assis_spe/{id}',     [Adminathentication::class, 'financial_assis_spe'])->name('financial_assis_spe')->middleware('StopScriptTags');
    Route::get('financial_assis_view/{id}',     [Adminathentication::class, 'financial_assis_view'])->name('financial_assis_view')->middleware('StopScriptTags');

    Route::get('monthly_pension',     [Adminathentication::class, 'monthly_pension'])->name('monthly_pension')->middleware('StopScriptTags');
    Route::get('monthly_pension_spe/{id}',     [Adminathentication::class, 'monthly_pension_spe'])->name('monthly_pension_spe')->middleware('StopScriptTags');
    Route::get('monthly_pension_view/{id}',     [Adminathentication::class, 'monthly_pension_view'])->name('monthly_pension_view')->middleware('StopScriptTags');

    Route::get('eklavya_krida',     [Adminathentication::class, 'eklavya_krida'])->name('eklavya_krida')->middleware('StopScriptTags');
    Route::get('eklavya_krida_spe/{id}',     [Adminathentication::class, 'eklavya_krida_spe'])->name('eklavya_krida_spe')->middleware('StopScriptTags');
    Route::get('eklavya_krida_view/{id}',     [Adminathentication::class, 'eklavya_krida_view'])->name('eklavya_krida_view')->middleware('StopScriptTags');


    Route::any('eklavya_krida_co/{id?}',     [Adminathentication::class, 'eklavya_krida_co'])->name('eklavya_krida_co')->middleware('StopScriptTags');
    Route::any('eklavya_krida_co_exce',     [Adminathentication::class, 'eklavya_krida_co_exce'])->name('eklavya_krida_co_exce')->middleware('StopScriptTags');
    Route::any('eklavya_krida_co_pd',     [Adminathentication::class, 'eklavya_krida_co_pd'])->name('eklavya_krida_co_pd')->middleware('StopScriptTags');


    Route::get('laxman',     [Adminathentication::class, 'laxman'])->name('laxman');
    Route::get('laxman_spe/{id}',     [Adminathentication::class, 'laxman_spe'])->name('laxman_spe')->middleware('StopScriptTags');
    Route::get('laxman_view/{id}',     [Adminathentication::class, 'laxman_view'])->name('laxman_view')->middleware('StopScriptTags');

    Route::get('laxmibai',     [Adminathentication::class, 'laxmibai'])->name('laxmibai')->middleware('StopScriptTags');
    Route::get('laxmibai_spe/{id}',     [Adminathentication::class, 'laxmibai_spe'])->name('laxmibai_spe')->middleware('StopScriptTags');
    Route::get('laxmibai_view/{id}',     [Adminathentication::class, 'laxmibai_view'])->name('laxmibai_view')->middleware('StopScriptTags');

    Route::get('award',     [Adminathentication::class, 'award'])->name('award')->middleware('StopScriptTags');
    Route::get('award_spe/{id}',     [Adminathentication::class, 'award_spe'])->name('award_spe')->middleware('StopScriptTags');
    Route::get('award_view/{id}',     [Adminathentication::class, 'award_view'])->name('award_view')->middleware('StopScriptTags');

    Route::post('financial_forward',     [Adminathentication::class, 'financial_forward'])->name('financial_forward')->middleware('StopScriptTags');
    Route::post('financial_released',     [Adminathentication::class, 'financial_released'])->name('financial_released')->middleware('StopScriptTags');

    Route::post('financial_mark_query',     [Adminathentication::class, 'financial_mark_query'])->name('financial_mark_query')->middleware('StopScriptTags');
    Route::post('financial_is_rejected',     [Adminathentication::class, 'financial_is_rejected'])->name('financial_is_rejected')->middleware('StopScriptTags');
    Route::post('financial_is_accepted',     [Adminathentication::class, 'financial_is_accepted'])->name('financial_is_accepted')->middleware('StopScriptTags');

    Route::post('award_is_accepted',     [Adminathentication::class, 'award_is_accepted'])->name('award_is_accepted')->middleware('StopScriptTags');
    Route::post('award_is_rejected',     [Adminathentication::class, 'award_is_rejected'])->name('award_is_rejected')->middleware('StopScriptTags');
    Route::post('award_forward_directorate',     [Adminathentication::class, 'award_forward_directorate'])->name('award_forward_directorate')->middleware('StopScriptTags');
    Route::post('award_released_amount',     [Adminathentication::class, 'award_released_amount'])->name('award_released_amount')->middleware('StopScriptTags');


    Route::post('direct_is_accepted',     [Adminathentication::class, 'direct_is_accepted'])->name('direct_is_accepted')->middleware('StopScriptTags');
    Route::post('direct_is_rejected',     [Adminathentication::class, 'direct_is_rejected'])->name('direct_is_rejected')->middleware('StopScriptTags');
    Route::post('direct_forward_directorate',     [Adminathentication::class, 'direct_forward_directorate'])->name('direct_forward_directorate')->middleware('StopScriptTags');
    Route::post('direct_released_amount',     [Adminathentication::class, 'direct_released_amount'])->name('direct_released_amount')->middleware('StopScriptTags');

    Route::post('direct_mark_query',     [Adminathentication::class, 'direct_mark_query'])->name('direct_mark_query')->middleware('StopScriptTags');
    Route::post('queryClosed',     [Adminathentication::class, 'queryClosed'])->name('queryClosed')->middleware('StopScriptTags');
    Route::get('hostel/{id?}',     [HostelApplication::class, 'hostelList'])->name('hostelList')->middleware('StopScriptTags');
    Route::get('hostel_preview/{id}',     [HostelApplication::class, 'hostelView'])->name('hostelView')->middleware('StopScriptTags');

    Route::post('hostel_allot',     [HostelApplication::class, 'hostel_allot'])->name('hostel_allot')->middleware('StopScriptTags');
    Route::post('filterHostel',     [HostelApplication::class, 'filterHostel'])->name('filterHostel')->middleware('StopScriptTags');
    Route::post('hostel/mark_query',     [HostelApplication::class, 'mark_query_hostel'])->name('mark_query_hostel')->middleware('StopScriptTags');


    Route::post('hostel/mark_query/reply',     [HostelApplication::class, 'query_hostel_reply_admin'])->name('query_hostel_reply')->middleware('StopScriptTags');

    Route::post('hostel/accept',     [HostelApplication::class, 'hostel_accept'])->name('hostel_accept')->middleware('StopScriptTags');
    Route::post('hostel/reject',     [HostelApplication::class, 'hostel_reject'])->name('hostel_reject')->middleware('StopScriptTags');
    Route::get('hostel/queryClosed/{id}',     [HostelApplication::class, 'queryClosed'])->name('hqueryClosed')->middleware('StopScriptTags');
    Route::get('hostel_list',     [HostelApplication::class, 'hostel_list'])->name('hostel_list')->middleware('StopScriptTags');

    Route::post('hostel_list/filter',     [HostelApplication::class, 'hostel_list_filter'])->name('hostel_list_filter')->middleware('StopScriptTags');
    Route::get('sport_wise_hostel_seat_master', [HostelApplication::class, 'sport_wise_hostel_seat'])->name('sport_wise_hostel_seat')->middleware('StopScriptTags');
    Route::post('sport_wise_hostel_seat_store', [HostelApplication::class, 'sport_wise_hostel_seat_store'])->name('sport_wise_hostel_seat_store')->middleware('StopScriptTags');
    Route::post('sport_wise_hostel_seat_update', [HostelApplication::class, 'sport_wise_hostel_seat_update'])->name('sport_wise_hostel_seat_update')->middleware('StopScriptTags');


    /* admin excel import Route */
    Route::get('/file-imports', [AdminDashboard::class, 'fileimports'])->name('fileimports')->middleware('StopScriptTags');
    Route::post('file-import', [AdminDashboard::class, 'fileImport'])->name('file-import')->middleware('StopScriptTags');
    Route::get('trail/{id}/{type}', [AdminDashboard::class, 'trailDetail'])->name('trailDetail')->middleware('StopScriptTags');
    Route::get('log/{id}', [AdminDashboard::class, 'logDetail'])->name('logDetail')->middleware('StopScriptTags');

    /****jyoti-Sept042023****/
    Route::get('information/incentive_committee',   [InformationDetailController::class, 'incentiveCommittee'])->name('incentiveCommittee')->middleware('Information');
    Route::post('information/create_incentive',       [InformationDetailController::class, 'createIncentive'])->name('createIncentive')->middleware('Information');
    Route::get('information/sports_infrastructure',   [InformationDetailController::class, 'sportsInfrastructure'])->name('sportsInfrastructure');
    Route::post('information/create_sportsinfra',       [InformationDetailController::class, 'createSportsinfra'])->name('createSportsinfra')->middleware('Information');
    Route::post('information/infrastructure_list_filter',       [InformationDetailController::class, 'infrastructure_list_filter'])->name('infrastructure_list_filter')->middleware('Information');
    Route::get('information/organized_competition',   [InformationDetailController::class, 'organizedCompetition'])->name('organizedCompetition');
    Route::post('information/create_organized_competition',       [InformationDetailController::class, 'createOrganizedCompetition'])->name('createOrganizedCompetition')->middleware('Information');
    Route::post('information/organized_competition_list_filter',       [InformationDetailController::class, 'organized_competition_list_filter'])->name('organized_competition_list_filter')->middleware('Information');
    Route::get('information/monthly_information',   [InformationDetailController::class, 'monthlyInformation'])->name('monthlyInformation')->middleware('Information');
    Route::post('information/create_monthly_information',       [InformationDetailController::class, 'createMonthlyinformation'])->name('createMonthlyinformation')->middleware('Information');
    Route::post('information/monthly_list_filter',       [InformationDetailController::class, 'monthly_list_filter'])->name('monthly_list_filter')->middleware('Information');
    Route::get('information/departmental_revenue',   [InformationDetailController::class, 'departmentalRevenue'])->name('departmentalRevenue')->middleware('Information');
    Route::post('information/create_departmentalrevenue',       [InformationDetailController::class, 'createDepartmentalRevenue'])->name('createDepartmentalRevenue')->middleware('Information');
    Route::get('information/information_honorable', [InformationDetailController::class, 'information_honorable'])->name('informationHonorable')->middleware('Information');

    Route::get('information/financial_report',       [InformationDetailController::class, 'infoFinancialReport'])->name('infoFinancialReport')->middleware('Information');
    Route::post('information/financial_create',       [InformationDetailController::class, 'financial_create'])->name('financial_create')->middleware('Information');
    Route::post('information/financial_list_filter',       [InformationDetailController::class, 'financial_list_filter'])->name('financial_list_filter')->middleware('Information');

    /****EndSept042023****/


    //*** anu information */
    Route::any('information/projects_under_construction/{id?}',   [InformationDetailController::class, 'projects_under_construction'])->name('projects_under_construction');
    Route::any('information/nodal_officer/{id?}',   [InformationDetailController::class, 'nodal_officer'])->name('nodal_officer');
    Route::any('information/khelo_india_yojana/{id?}',   [InformationDetailController::class, 'khelo_india_yojana'])->name('khelo_india_yojana');
    Route::any('information/khelo_india_yojana_two/{id?}',   [InformationDetailController::class, 'khelo_india_yojana_two'])->name('khelo_india_yojana_two');
    Route::any('information/rajasv_praptiya/{id?}',   [InformationDetailController::class, 'rajasv_praptiya'])->name('rajasv_praptiya');
    Route::any('information/kreeda_chatravas/{id?}',   [InformationDetailController::class, 'kreeda_chatravas'])->name('kreeda_chatravas');
    Route::any('information/prashikshan/{id?}',   [InformationDetailController::class, 'prashikshan'])->name('prashikshan');
    Route::any('information/kheloindiyacentar/{id?}',   [InformationDetailController::class, 'kheloindiyacentar'])->name('kheloindiyacentar');
    Route::any('information/pratiyogitaonKaAayojan/{id?}',   [InformationDetailController::class, 'pratiyogitaonKaAayojan'])->name('pratiyogitaonKaAayojan');
    Route::any('information/ekalavyKreedaKosh/{id?}',   [InformationDetailController::class, 'ekalavyKreedaKosh'])->name('ekalavyKreedaKosh');
    Route::any('information/jilaKhelVikaas/{id?}',   [InformationDetailController::class, 'jilaKhelVikaas'])->name('jilaKhelVikaas');
    Route::any('information/kshetreeykreedaadhikaari/{id?}',   [InformationDetailController::class, 'kshetreeykreedaadhikaari'])->name('kshetreeykreedaadhikaari');
    Route::any('information/adhikaariyonprashikshon/{id?}',   [InformationDetailController::class, 'adhikaariyonprashikshon'])->name('adhikaariyonprashikshon');
    Route::any('information/vyayaadhi_bachat/{id?}',   [InformationDetailController::class, 'vyayaadhi_bachat'])->name('vyayaadhi_bachat');
    Route::any('information/information_honorable/{id?}', [InformationDetailController::class, 'information_honorable'])->name('information_honorable');

    Route::any('information/delete_inf/{id}/{tbl}',   [InformationDetailController::class, 'delete_inf'])->name('delete_inf');

    /** end information */
    /******Query document By admin******/
    Route::post('save_query_for_supporting_document',       [Adminathentication::class, 'save_query_for_supporting_document'])->name('save_query_for_supporting_document');
    Route::post('query_reply_for_supporting_document',       [Adminathentication::class, 'query_reply_for_supporting_document'])->name('query_reply_for_supporting_document');


    Route::any('eklavya_competition',             [AdminDashboard::class, 'eklavya_competition'])->name('eklavya_competition')->middleware('StopScriptTags');
});

// Route::group(['prefix' => 'information','middleware' => ['Information']], function () {

// });

//filter
Route::any('/filterData',  [Adminathentication::class, 'filterData'])->name('filterData');

// excel
Route::any('/exportExcel',  [AdminDashboard::class, 'exportExcel'])->name('exportExcel');
Route::any('/exportPdf',  [AdminDashboard::class, 'exportPdf'])->name('exportPdf');

//endexcel
Route::group(['prefix' => 'superadmin', 'middleware' => ['IsAdmin']], function () {

    Route::get('dashboard',        [SuperAdmin::class, 'index'])->name('superdashboard')->middleware('StopScriptTags');
    Route::get('change-password',    [SuperAdmin::class, 'changePassword'])->name('superChangePassword')->middleware('StopScriptTags');
    Route::get('/signOuts',        [SuperAdmin::class, 'signOuts'])->name('susignOuts')->middleware('StopScriptTags');
    Route::get('profile',     [SuperAdmin::class, 'profile'])->name('superprofile')->middleware('StopScriptTags');
});

//college admin


Route::group(['prefix' => 'collegeadmin', 'middleware' => ['IsAdmin']], function () {
    Route::get('collegewisecount',        [CollegeAdmin::class, 'collegewisecount'])->name('collegewisecount')->middleware('StopScriptTags');
    Route::get('sportwisecount',        [CollegeAdmin::class, 'sportwisecount'])->name('sportwisecount')->middleware('StopScriptTags');

    Route::get('districtwisecount',        [CollegeAdmin::class, 'districtwisecount'])->name('districtwisecount')->middleware('StopScriptTags');
    Route::get('transactionenquiryupdatebyemail',        [PaymentController::class, 'transactionenquiryupdatebyemail'])->name('transactionenquiryupdatebyemail')->middleware('StopScriptTags');
    Route::post('transactionenquiryStorebyemail',        [PaymentController::class, 'transactionenquiryStorebyemail'])->name('transactionenquirystorebyemail')->middleware('StopScriptTags');
    Route::get('transactionenquiryupdate',        [PaymentController::class, 'transactionenquiryupdate'])->name('transactionenquiryupdate')->middleware('StopScriptTags');
    Route::post('transactionenquiryStore',        [PaymentController::class, 'transactionenquiryStore'])->name('transactionenquirystore')->middleware('StopScriptTags');
    Route::get('dashboard',           [CollegeAdmin::class, 'index'])->name('collegeadmindashboard')->middleware('StopScriptTags');
    Route::get('trialListtwo',        [CollegeAdmin::class, 'trialListtwo'])->name('collegeadmintrialListtwo')->middleware('StopScriptTags');
    Route::get('trialList',        [CollegeAdmin::class, 'trialList'])->name('collegeadmintrialList')->middleware('StopScriptTags');

    Route::post('get_subsport',    [CollegeAdmin::class, 'get_subsport'])->middleware('StopScriptTags');
    Route::get('trialresultreport',        [CollegeAdmin::class, 'trialresultreport'])->name('collegeadmintrialresultreport')->middleware('StopScriptTags');
    Route::post('filtertrialresultreport',        [CollegeAdmin::class, 'filtertrialresultreport'])->name('collegeadminfiltertrialresultreport')->middleware('StopScriptTags');
    Route::match(['get', 'post'], 'filtertrialListtwo',        [CollegeAdmin::class, 'filtertrialListtwo'])->name('collegeadminfiltertrialListtwo')->middleware('StopScriptTags');

    Route::match(['get', 'post'], 'filtertrialList',        [CollegeAdmin::class, 'filtertrialList'])->name('collegeadminfiltertrialList')->middleware('StopScriptTags');
    Route::post('trialListApplicantStore',        [CollegeAdmin::class, 'trialListApplicantStore'])->name('trialListApplicantStore')->middleware('StopScriptTags');
    Route::post('footballkeepertrialList',   [CollegeAdmin::class, 'footballkeepertrialList'])->name('collegeadminfootballkeepertrialList')->middleware('StopScriptTags');
    Route::post('footballtrialList',   [CollegeAdmin::class, 'footballtrialList'])->name('collegeadminfootballtrialList')->middleware('StopScriptTags');

    Route::post('kabadditrialList',   [CollegeAdmin::class, 'kabadditrialList'])->name('collegeadminkabadditrialList')->middleware('StopScriptTags');
    Route::post('hockeykeepertrialList',     [CollegeAdmin::class, 'hockeykeepertrialList'])->name('collegeadminhockeykeepertrialList')->middleware('StopScriptTags');
    Route::post('hockeytrialList',     [CollegeAdmin::class, 'hockeytrialList'])->name('collegeadminhockeytrialList')->middleware('StopScriptTags');
    Route::Post('badmintontrialList',  [CollegeAdmin::class, 'badmintontrialList'])->name('collegeadminbadmintontrialList')->middleware('StopScriptTags');

    Route::post('athleticsrunnertrialList',  [CollegeAdmin::class, 'athleticsrunnertrialList'])->name('collegeadminathleticsrunnertrialList')->middleware('StopScriptTags');
    Route::post('volleyBalltrialList', [CollegeAdmin::class, 'volleyBalltrialList'])->name('collegeadminvolleyBalltrialList')->middleware('StopScriptTags');
    Route::post('swimmingtrialList',  [CollegeAdmin::class, 'swimmingtrialList'])->name('collegeadminswimmingtrialList')->middleware('StopScriptTags');
    Route::post('kustitrialList',    [CollegeAdmin::class, 'kustitrialList'])->name('collegeadminkustitrialList')->middleware('StopScriptTags');

    Route::post('athleticsthrowertrialList',  [CollegeAdmin::class, 'athleticsthrowertrialList'])->name('collegeadminathleticsthrowertrialList')->middleware('StopScriptTags');
    Route::post('athleticsjumpertrialList',  [CollegeAdmin::class, 'athleticsjumpertrialList'])->name('collegeadminathleticsjumpertrialList')->middleware('StopScriptTags');
    Route::post('cricketbatsmantrialList',     [CollegeAdmin::class, 'cricketbatsmantrialList'])->name('collegeadmincricketbatsmantrialList')->middleware('StopScriptTags');
    Route::post('cricketballertrialList',     [CollegeAdmin::class, 'cricketballertrialList'])->name('collegeadmincricketballertrialList')->middleware('StopScriptTags');

    Route::post('cricketkeepertrialList',     [CollegeAdmin::class, 'cricketkeepertrialList'])->name('collegeadmincricketkeepertrialList')->middleware('StopScriptTags');
    Route::post('judotrialList',      [CollegeAdmin::class, 'judotrialList'])->name('collegeadminjudotrialList')->middleware('StopScriptTags');
    Route::post('gymnasticboystrialList', [CollegeAdmin::class, 'gymnasticboystrialList'])->name('collegeadmingymnasticboystrialList')->middleware('StopScriptTags');
    Route::post('gymnasticgirlstrialList', [CollegeAdmin::class, 'gymnasticgirlstrialList'])->name('collegeadmingymnasticgirlstrialList')->middleware('StopScriptTags');

    Route::match(['get', 'post'], 'filter',     [CollegeAdmin::class, 'filter'])->name('filter')->middleware('StopScriptTags');
    Route::match(['get', 'post'], 'filter/1',     [CollegeAdmin::class, 'filteraccepted'])->name('filteraccepted')->middleware('StopScriptTags');
    Route::match(['get', 'post'], 'filter/2',     [CollegeAdmin::class, 'filterrejected'])->name('filterrejected')->middleware('StopScriptTags');
    Route::match(['get', 'post'], 'filter/3',     [CollegeAdmin::class, 'filterpending'])->name('filterpending')->middleware('StopScriptTags');

    Route::get('admission-detail/{id}', [CollegeAdmin::class, 'registerUuserDetails'])->name('admissionDetail')->middleware('StopScriptTags');
    // Route::get('trialList',        [CollegeAdmin::class, 'trialList'])->name('collegeadmintrialList');
    // Route::get('trialList',        [CollegeAdmin::class, 'trialList'])->name('collegeadmintrialList');
    // Route::get('trialList',        [CollegeAdmin::class, 'trialList'])->name('collegeadmintrialList');
    Route::get('change-password',    [CollegeAdmin::class, 'changePassword'])->name('collegeadminChangePassword');

    Route::get('/signOuts',        [CollegeAdmin::class, 'signOuts'])->name('collegeadminsignOuts');
    Route::get('profile',     [CollegeAdmin::class, 'profile'])->name('collegeadminprofile');
    Route::post('accepted',     [CollegeAdmin::class, 'accepted'])->name('collegeadminaccepted');
    Route::post('rejected',     [CollegeAdmin::class, 'rejected'])->name('collegeadminrejected');
});

//hostel routes
// TEMPORARILY DISABLED - Applications Closed
// Route::get('/hostel/register', [HostelAuthController::class, 'register'])->name('hostel.register');
Route::get('/hostel/register', function () {
    return redirect()->route('hostel.login');
})->name('hostel.register');
Route::get('/hostel/login', [HostelAuthController::class, 'login'])->name('hostel.login');
Route::get('/hostel/otp', [HostelAuthController::class, 'otp'])->name('hostel.otp');
Route::get('/hostel/resend_otp', [HostelAuthController::class, 'resendotp'])->name('hostel.resendotp');

// TEMPORARILY DISABLED - Applications Closed
// Route::post('/hostel/register/store', [HostelAuthController::class, 'registerStore'])->name('hostel.registerStore');
Route::post('/hostel/register/store', function () {
    return redirect()->route('hostel.login');
})->name('hostel.registerStore');
Route::post('/hostel/otp/store', [HostelAuthController::class, 'otpStore'])->name('hostel.otpStore');
Route::get('/hostel/forgot', [HostelAuthController::class, 'forgot'])->name('hostel.forgot');
Route::post('/hostel/forgot/passwordStore', [HostelAuthController::class, 'forgotStore'])->name('hostel.forgotStore');

Route::post('/hostel/login/store', [HostelAuthController::class, 'loginStore'])->name('hostel.loginStore');
Route::group(['prefix' => 'hostel', 'middleware' => ['hostel']], function () {
    Route::get('/changepassword', [HostelAuthController::class, 'changePassword'])->name('hostel.changePassword');
    Route::get('/logout', [HostelAuthController::class, 'logout'])->name('hostel.logout');
    Route::patch('/changepasswordStore', [HostelAuthController::class, 'changepasswordStore'])->name('hostel.changepasswordStore');


    Route::get('/dashboard', [HostelApplication::class, 'dashboard'])->name('hostel.dashboard')->middleware('StopScriptTags');
    Route::get('/application_form', [HostelApplication::class, 'applicationForm'])->name('hostel.applicationForm')->middleware('StopScriptTags');
    Route::post('/application_form/basic', [HostelApplication::class, 'applicationbasicForm'])->name('hostel.applicationBasicForm')->middleware('StopScriptTags');
    Route::post('/application_form/communication', [HostelApplication::class, 'applicationCommunicationForm'])->name('hostel.applicationCommunicationForm')->middleware('StopScriptTags');
    Route::post('/application_form/qualification', [HostelApplication::class, 'applicationQualicationForm'])->name('hostel.applicationQualificationForm')->middleware('StopScriptTags');
    Route::post('/application_form/preview', [HostelApplication::class, 'applicationPreviewForm'])->name('hostel.applicationPreviewForm')->middleware('StopScriptTags');
    Route::get('/application_form/district/{state_id}', [HostelApplication::class, 'getDistrict'])->middleware('StopScriptTags');
    Route::get('/application_form/preview', [HostelApplication::class, 'applicationView'])->name('hostel.applicationView')->middleware('StopScriptTags');
    Route::post('hostel/mark_query/reply/user',     [HostelApplication::class, 'query_hostel_reply_user'])->name('query_hostel_reply_user')->middleware('StopScriptTags');
    Route::post('/get_subsport',    [HostelTrailController::class, 'get_subsport'])->middleware('StopScriptTags');
});


// ═══════════════════════════════════════════════════════════════
// ONLINE ADMISSION TEST MODULE  (test URL – original untouched)
// ═══════════════════════════════════════════════════════════════
use App\Http\Controllers\OnlineAdmissionTest;

// ── Online Admission (live module) ──────────────────────────────
// 08-05-2026 (using) =====================================================
Route::get('/onlineAdmission',                  [OnlineAdmissionTest::class, 'index'])->name('onlineAdmissionTest.loginForm');
Route::post('/onlineAdmission/login',           [OnlineAdmissionTest::class, 'login'])->name('onlineAdmissionTest.login'); // using
Route::get('/onlineAdmission/logintest',        [OnlineAdmissionTest::class, 'logintest'])->name('onlineAdmissionTest.logintest');
Route::get('/onlineAdmission/register',         [OnlineAdmissionTest::class, 'register'])->name('onlineAdmissionTest.register');
Route::post('/onlineAdmission/preRegistration', [OnlineAdmissionTest::class, 'preRegistration'])->name('onlineAdmissionTest.preRegistration');
Route::get('/onlineAdmission/otp',              [OnlineAdmissionTest::class, 'otp'])->name('onlineAdmissionTest.otp');
Route::post('/onlineAdmission/otpVerify',       [OnlineAdmissionTest::class, 'otpVerify'])->name('onlineAdmissionTest.otpVerify');
Route::post('/onlineAdmission/resendOtp',       [OnlineAdmissionTest::class, 'resendOtp'])->name('onlineAdmissionTest.resendOtp');
Route::get('/onlineAdmission/forgot',           [OnlineAdmissionTest::class, 'forgotPassword'])->name('onlineAdmissionTest.forgotPassword');
Route::post('/onlineAdmission/forgot',          [OnlineAdmissionTest::class, 'forgot'])->name('onlineAdmissionTest.forgot');
Route::post('/onlineAdmission/getSubSport',     [OnlineAdmissionTest::class, 'getSubSport'])->name('onlineAdmissionTest.getSubSport');
Route::get('/onlineAdmission/getDistricts',     [OnlineAdmissionTest::class, 'getDistricts'])->name('onlineAdmissionTest.getDistricts');

Route::group(['prefix' => 'onlineAdmission', 'middleware' => ['OnlineAdmissionTest']], function () {
    Route::get('change-password',       [OnlineAdmissionTest::class, 'changePassword'])->name('onlineAdmissionTest.ChangePassword');
    Route::post('updatePassword',       [OnlineAdmissionTest::class, 'updatePassword'])->name('onlineAdmissionTest.updatePassword');
    Route::get('dashboard',             [OnlineAdmissionTest::class, 'dashboard'])->name('onlineAdmissionTest.dashboard'); // using
    Route::get('applicationForm',       [OnlineAdmissionTest::class, 'applicationForm'])->name('onlineAdmissionTest.applicationForm'); // using
    Route::post('saveBasic',            [OnlineAdmissionTest::class, 'saveBasic'])->name('onlineAdmissionTest.saveBasic'); // using
    Route::post('saveCommunication',    [OnlineAdmissionTest::class, 'saveCommunication'])->name('onlineAdmissionTest.saveCommunication'); // using
    Route::post('saveEducation',        [OnlineAdmissionTest::class, 'saveEducation'])->name('onlineAdmissionTest.saveEducation'); // using
    Route::post('saveDocuments',        [OnlineAdmissionTest::class, 'saveDocuments'])->name('onlineAdmissionTest.saveDocuments'); // using
    Route::post('saveDeclaration',      [OnlineAdmissionTest::class, 'saveDeclaration'])->name('onlineAdmissionTest.saveDeclaration'); // using
    Route::post('getCollege',           [OnlineAdmissionTest::class, 'getCollege'])->name('onlineAdmissionTest.getCollege');
    Route::post('getAvailableSports',   [OnlineAdmissionTest::class, 'getAvailableSports'])->name('onlineAdmissionTest.getAvailableSports');
    Route::get('applicationPreview',    [OnlineAdmissionTest::class, 'applicationPreview'])->name('onlineAdmissionTest.applicationPreview');
    Route::post('finalSubmit',          [OnlineAdmissionTest::class, 'finalSubmit'])->name('onlineAdmissionTest.finalSubmit'); // using
    Route::get('payment',               [OnlineAdmissionTest::class, 'payment'])->name('onlineAdmissionTest.payment'); // using
    Route::get('logout',                [OnlineAdmissionTest::class, 'logout'])->name('onlineAdmissionTest.logout'); // using
    Route::get('paymentReceipt',        [OnlineAdmissionTest::class, 'paymentReceipt'])->name('onlineAdmissionTest.paymentReceipt');
    Route::get('trialSchedule',         [OnlineAdmissionTest::class, 'trialSchedule'])->name('onlineAdmissionTest.trialSchedule'); // using
});


Route::get('payment', [PaymentController::class, 'gateway'])->name('onlineAdmission.payment');

Route::get('payment/refund', [PaymentController::class, 'gatewayRefund'])->name('onlineAdmission.paymentRefund');

Route::post('/payment_response', [PaymentController::class, 'gatewayResponse'])->name('gatewayResponse');

Route::get('/payment_response/updateStatus', [PaymentController::class, 'updatePaymentStatus'])->name('onlineAdmission.updatePayment');




//darpan
Route::get('darpan',        [darpanController::class, 'index'])->name('dad');

Route::any('darpan/award/{id?}/{dist?}',        [darpanController::class, 'award']);
Route::any('darpan/district_award/{id?}',        [darpanController::class, 'district_award']);

Route::any('darpan/direct/{id?}/{dist?}',        [darpanController::class, 'direct']);
Route::any('darpan/district_direct/{id?}',        [darpanController::class, 'district_direct']);

Route::any('darpan/financial/{id?}/{dist?}',        [darpanController::class, 'financial']);
Route::any('darpan/district_financial/{id?}',        [darpanController::class, 'district_financial']);

Route::any('darpan/monthly/{id?}',        [darpanController::class, 'monthly']);

Route::any('darpan/position/{id?}/{dist?}',        [darpanController::class, 'position']);
Route::any('darpan/district_position/{id?}',        [darpanController::class, 'district_position']);

// Route::any('/darpanData',  [darpanController::class, 'darpanData'])->name('darpanData');


Route::group(['prefix' => 'admin', 'middleware' => ['IsAdmin']], function () {
    /* inventory start 15-05-2023 */

    //section master
    Route::get('section', [InventoryMaster::class, 'sectionList'])->name('section')->middleware('StopScriptTags');
    Route::any('save-section',       [InventoryMaster::class, 'saveSection'])->name('saveSection')->middleware('StopScriptTags');
    Route::get('editsection/{id}', [InventoryMaster::class, 'editsection'])->name('editSection')->middleware('StopScriptTags');
    Route::get('deletesection/{id}', [InventoryMaster::class, 'deletesection'])->name('deleteSection')->middleware('StopScriptTags');

    //section end

    //unit master
    Route::get('unit', [InventoryMaster::class, 'unitList'])->name('unit')->middleware('StopScriptTags');
    Route::any('save-unit',       [InventoryMaster::class, 'saveUnit'])->name('saveUnit')->middleware('StopScriptTags');
    Route::get('editUnit/{id}', [InventoryMaster::class, 'editUnit'])->name('editUnit')->middleware('StopScriptTags');
    Route::get('deleteUnit/{id}', [InventoryMaster::class, 'deleteUnit'])->name('deleteUnit')->middleware('StopScriptTags');

    //unit end

    //Vendor master
    Route::get('vendor', [InventoryMaster::class, 'vendorList'])->name('vendor')->middleware('StopScriptTags');
    Route::any('save-vendor',       [InventoryMaster::class, 'saveVendor'])->name('saveVendor')->middleware('StopScriptTags');
    Route::get('editVendor/{id}', [InventoryMaster::class, 'editVendor'])->name('editVendor')->middleware('StopScriptTags');
    Route::get('deleteVendor/{id}', [InventoryMaster::class, 'deleteVendor'])->name('deleteVendor')->middleware('StopScriptTags');

    //Vendor end

    //category master
    Route::get('category', [InventoryMaster::class, 'categoryList'])->name('category')->middleware('StopScriptTags');
    Route::any('save-Category',       [InventoryMaster::class, 'saveCategory'])->name('saveCategory')->middleware('StopScriptTags');
    Route::get('editCategory/{id}', [InventoryMaster::class, 'editCategory'])->name('editCategory')->middleware('StopScriptTags');
    Route::get('deleteCategory/{id}', [InventoryMaster::class, 'deleteCategory'])->name('deleteCategory')->middleware('StopScriptTags');

    //category end

    //subcategory master
    Route::any('subcategory/{id?}', [InventoryMaster::class, 'subCategoryList'])->name('subCategory')->middleware('StopScriptTags');
    // Route::any('save-SubCategory',   	[InventoryMaster::class, 'savesubCategory'])->name('saveSubCategory');
    // Route::get('editSubCategory/{id}', [InventoryMaster::class, 'editsubCategory'])->name('editSubCategory');
    Route::get('deleteSubCategory/{id}', [InventoryMaster::class, 'deletesubCategory'])->name('deleteSubCategory')->middleware('StopScriptTags');

    //subcategory end

    /* inventory end */

    /* item master */

    // fixed item


    Route::any('itemsInventory', [ItemMaster::class, 'itemsInventory'])->name('itemsInventory')->middleware('StopScriptTags');
    Route::any('itemsInventoryPdf', [ItemMaster::class, 'itemsInventoryPdf'])->name('itemsInventoryPdf')->middleware('StopScriptTags');
    Route::any('item-detail/{id?}', [ItemMaster::class, 'itemDetail'])->name('itemDetail')->middleware('StopScriptTags');


    Route::any('fixed-item', [ItemMaster::class, 'FixedItem'])->name('FixedItem')->middleware('StopScriptTags');
    Route::any('add-fixed-item/{id?}', [ItemMaster::class, 'addFixedItem'])->name('addFixedItem')->middleware('StopScriptTags');
    Route::post('get_subCategory', [ItemMaster::class, 'get_subCategory'])->name('get_subcategory')->middleware('StopScriptTags');
    Route::any('save-fixed-item',       [ItemMaster::class, 'savefixedItem'])->name('savefixedItem')->middleware('StopScriptTags');
    Route::get('deleteFixedItem/{id}', [ItemMaster::class, 'deleteFixedItem'])->name('deleteFixedItem')->middleware('StopScriptTags');
    // end fixed item

    // Consumable item
    Route::any('consumable-item', [ItemMaster::class, 'ConsumableItem'])->name('ConsumableItem')->middleware('StopScriptTags');
    Route::any('add-consumable-item/{id?}', [ItemMaster::class, 'addConsumableItem'])->name('addConsumableItem')->middleware('StopScriptTags');
    Route::post('get_subCategory', [ItemMaster::class, 'get_subCategory'])->name('get_subcategory')->middleware('StopScriptTags');
    Route::any('save-consumable-item',       [ItemMaster::class, 'saveConsumableItem'])->name('saveConsumableItem')->middleware('StopScriptTags');
    Route::get('deleteConsumableItem/{id}', [ItemMaster::class, 'deleteConsumableItem'])->name('deleteConsumableItem')->middleware('StopScriptTags');
    // end fixed item

    /* item master end */

    /* purchase start */
    Route::any('listOrder', [PurchaseController::class, 'listOrder'])->name('listOrder')->middleware('StopScriptTags');
    Route::any('addOrder/{id?}', [PurchaseController::class, 'addOrder'])->name('addOrder')->middleware('StopScriptTags');
    Route::post('get_Category', [PurchaseController::class, 'get_Category'])->name('get_category')->middleware('StopScriptTags');
    Route::post('get_item', [PurchaseController::class, 'get_item'])->name('get_item')->middleware('StopScriptTags');
    Route::post('saveOrder', [PurchaseController::class, 'saveOrder'])->name('saveOrder')->middleware('StopScriptTags');
    Route::get('generatePO/{id}', [PurchaseController::class, 'generatePO'])->name('generatePO')->middleware('StopScriptTags');
    Route::get('deleteOrder/{id}', [PurchaseController::class, 'deleteOrder'])->name('deleteOrder')->middleware('StopScriptTags');
    Route::post('orderDetails', [PurchaseController::class, 'orderDetails'])->name('orderDetails')->middleware('StopScriptTags');
    Route::get('purchase_entry', [PurchaseController::class, 'purchase_entry'])->name('purchase_entry')->middleware('StopScriptTags');
    Route::post('get_vendor_order', [PurchaseController::class, 'get_vendor_order'])->name('get_vendor_order')->middleware('StopScriptTags');
    Route::post('get_vendor_order_detail', [PurchaseController::class, 'get_vendor_order_detail'])->name('get_vendor_order_detail')->middleware('StopScriptTags');
    Route::post('save_purchase_entry', [PurchaseController::class, 'save_purchase_entry'])->name('save_purchase_entry')->middleware('StopScriptTags');

    Route::post('itemsDetails', [PurchaseController::class, 'itemsDetails'])->name('itemsDetails')->middleware('StopScriptTags');


    Route::get('return_entry', [PurchaseController::class, 'return_entry'])->name('return_entry')->middleware('StopScriptTags');
    Route::post('get_order_challan', [PurchaseController::class, 'get_order_challan'])->name('get_order_challan')->middleware('StopScriptTags');
    Route::post('get_order_challan_detail', [PurchaseController::class, 'get_order_challan_detail'])->name('get_order_challan_detail')->middleware('StopScriptTags');
    Route::post('save_return_entry', [PurchaseController::class, 'save_return_entry'])->name('save_return_entry')->middleware('StopScriptTags');
    Route::post('challanDetails', [PurchaseController::class, 'challanDetails'])->name('challanDetails')->middleware('StopScriptTags');


    Route::any('verify_purchase_order', [PurchaseController::class, 'verify_purchase_order'])->name('verify_purchase_order');
    Route::any('po_verify', [PurchaseController::class, 'po_verify'])->name('po_verify');

    /* purchase end */


    /* raise indent */
    Route::any('indentList', [PurchaseStores::class, 'indentList'])->name('indentList')->middleware('StopScriptTags');
    Route::any('indent', [PurchaseStores::class, 'indent'])->name('indent')->middleware('StopScriptTags');
    Route::any('addIndent/{id?}', [PurchaseStores::class, 'addIndent'])->name('addIndent')->middleware('StopScriptTags');

    Route::get('deleteIntent/{id}', [PurchaseStores::class, 'deleteIntent'])->name('deleteIntent')->middleware('StopScriptTags');
    Route::get('deleteIntentById/{id}', [PurchaseStores::class, 'deleteIntentById'])->name('deleteIntentById')->middleware('StopScriptTags');

    Route::post('indentDetails', [PurchaseStores::class, 'indentDetails'])->name('indentDetails')->middleware('StopScriptTags');


    Route::any('aproveIndent', [PurchaseStores::class, 'aproveIndent'])->name('aproveIndent')->middleware('StopScriptTags');
    Route::post('indents_pending_to_process', [PurchaseStores::class, 'indents_pending_to_process'])->name('indents_pending_to_process')->middleware('StopScriptTags');
    Route::any('pending_to_process', [PurchaseStores::class, 'pending_to_process'])->name('pending_to_process')->middleware('StopScriptTags');
    //new work
    Route::any('indents_issue', [PurchaseStores::class, 'indents_issue'])->name('indents_issue')->middleware('StopScriptTags');
    Route::any('save_indent_issue', [PurchaseStores::class, 'save_indent_issue'])->name('save_indent_issue')->middleware('StopScriptTags');

    Route::any('indents_return', [PurchaseStores::class, 'indents_return'])->name('indents_return')->middleware('StopScriptTags');
    Route::any('save_indent_return', [PurchaseStores::class, 'save_indent_return'])->name('save_indent_return')->middleware('StopScriptTags');


    Route::any('indent_history_list', [PurchaseStores::class, 'indent_history_list'])->name('indent_history_list')->middleware('StopScriptTags');
    Route::any('indent_history_details/{id}', [PurchaseStores::class, 'indent_history_details'])->name('indent_history_details')->middleware('StopScriptTags');

    /*end */


    /* inventory report */

    Route::any('orderReport', [InventoryReportController::class, 'orderReport'])->name('orderReport')->middleware('StopScriptTags');
    Route::any('orderReportPdf', [InventoryReportController::class, 'orderReportPdf'])->name('orderReportPdf')->middleware('StopScriptTags');
    Route::any('get_order_list', [InventoryReportController::class, 'get_order_list'])->name('get_order_list')->middleware('StopScriptTags');
    Route::any('indentReport', [InventoryReportController::class, 'indentReport'])->name('indentReport')->middleware('StopScriptTags');
    Route::any('indentReportPdf', [InventoryReportController::class, 'indentReportPdf'])->name('indentReportPdf')->middleware('StopScriptTags');

    /*end*/

    /* message board start anu */

    Route::get('email_template_list', [MessageBoard::class, 'email_template_list'])->name('email_template_list');
    Route::any('email_template', [MessageBoard::class, 'email_template'])->name('email_template');
    Route::any('save-email-template',       [MessageBoard::class, 'saveEmailTemplate'])->name('saveEmailTemplate');
    Route::get('editEmailTemplate/{id}', [MessageBoard::class, 'editEmailTemplate'])->name('editEmailTemplate');
    Route::get('lockEmailTemplate/{id}', [MessageBoard::class, 'lockEmailTemplate'])->name('lockEmailTemplate');
    Route::get('deleteEmailTemplate/{id}', [MessageBoard::class, 'deleteEmailTemplate'])->name('deleteEmailTemplate');


    Route::get('sms_template_list', [MessageBoard::class, 'sms_template_list'])->name('sms_template_list');
    Route::any('sms_template', [MessageBoard::class, 'sms_template'])->name('sms_template');
    Route::any('save-sms-template',       [MessageBoard::class, 'saveSmsTemplate'])->name('saveSmsTemplate');
    Route::get('editSmsTemplate/{id}', [MessageBoard::class, 'editSmsTemplate'])->name('editSmsTemplate');
    Route::get('lockSmsTemplate/{id}', [MessageBoard::class, 'lockSmsTemplate'])->name('lockSmsTemplate');
    Route::get('deleteSmsTemplate/{id}', [MessageBoard::class, 'deleteSmsTemplate'])->name('deleteSmsTemplate');

    Route::any('send_sms', [MessageBoard::class, 'send_sms'])->name('send_sms');
    Route::post('get_template_message', [MessageBoard::class, 'get_template_message'])->name('get_template_message');
    Route::post('get_user', [MessageBoard::class, 'get_user'])->name('get_user');


    Route::any('send_mail', [MessageBoard::class, 'send_mail'])->name('send_mail');

    // # Rakesh Broadcasting

    Route::any('broadcast', [MessageBoard::class, 'send_broadcast'])->name('send_broadcast');
    Route::any('broadcast_list', [MessageBoard::class, 'broadcast_list'])->name('broadcast_list');
    Route::get('broadcast_deactive/{broadcast_id}', [MessageBoard::class, 'broadcast_deactive'])->name('broadcast_deactive');
    Route::get('changeBroadcastStatus/{id}', [MessageBoard::class, 'changeBroadcastStatus'])->name('changeBroadcastStatus');
    Route::get('all_broadcast', [MessageBoard::class, 'all_broadcast'])->name('all_broadcast');
    Route::get('view_broadcast/{broadcast_id}', [MessageBoard::class, 'view_broadcast'])->name('view_broadcast');


    // # Rakesh mail
    Route::get('mail', [AdminMailController::class, 'adminmail'])->name('adminmail');
    Route::post('mailStore', [AdminMailController::class, 'adminmailStore'])->name('adminmailStore');
    Route::get('mail_compose/{id?}', [AdminMailController::class, 'mail_compose'])->name('mail_compose');
    Route::get('draft_mail', [AdminMailController::class, 'draft_mail'])->name('draft_mail');
    Route::get('all_mail', [AdminMailController::class, 'all_mail'])->name('all_mail');
    Route::get('mail_view/{id}', [AdminMailController::class, 'mail_view'])->name('mail_view');
    Route::get('mail_view_detail/{id}', [AdminMailController::class, 'mail_view_detail'])->name('mail_view_detail');
    Route::post('mail_reply', [AdminMailController::class, 'mail_reply'])->name('mail_reply');

    // # Rakesh announcement
    Route::any('add_announcement', [AdminMailController::class, 'add_announcement'])->name('add_announcement');
    Route::any('announcement', [AdminMailController::class, 'announcement'])->name('announcement');

    //Jyoti-sept14-2023
    Route::any('eklavya_kreeda_kendra_list', [EklavyaKreedaKendraController::class, 'eklavya_kreeda_kendra_list'])->name('eklavya_kreeda_kendra_list')->middleware('StopScriptTags');
    Route::get('eklavya_kreeda_view_details/{id}', [EklavyaKreedaKendraController::class, 'eklavya_kreeda_view_details'])->name('eklavya_kreeda_view_details')->middleware('StopScriptTags');
    Route::any('eklavya_kreeda_kendra_list', [EklavyaKreedaKendraController::class, 'eklavya_kreeda_list_search'])->name('eklavya_kreeda_list_search')->middleware('StopScriptTags');

    Route::any('gymnasium_swimming_list', [GymnasiumSwimmingDetailController::class, 'gymnasium_swimming_list'])->name('gymnasium_swimming_list')->middleware('StopScriptTags');
    Route::get('gymnasium_swimming_view_details/{id}', [GymnasiumSwimmingDetailController::class, 'gymnasium_swimming_view_details'])->name('gymnasium_swimming_view_details')->middleware('StopScriptTags');
    Route::any('gymnasium_swimming_list', [GymnasiumSwimmingDetailController::class, 'gymnasium_swimming_list_search'])->name('gymnasium_swimming_list_search')->middleware('StopScriptTags');

    //end sept14-2023

    /* message board end anu */
});

Route::group(['prefix' => 'hosteladmin', 'middleware' => ['IsAdmin']], function () {
    Route::get('districtwisecount',        [HostelTrailController::class, 'districtwisecount'])->middleware('StopScriptTags');
    Route::get('divisionwisecount',        [HostelTrailController::class, 'divisionwisecount'])->middleware('StopScriptTags');
    Route::any('district_level_approved', [HostelTrailController::class, 'district_level_approved'])->name('district_level_approved')->middleware('StopScriptTags');
    Route::post('district_level_approved_store', [HostelTrailController::class, 'district_level_approved_store'])->name('district_level_approved_store')->middleware('StopScriptTags');

    Route::any('division_level_approved', [HostelTrailController::class, 'division_level_approved'])->name('division_level_approved')->middleware('StopScriptTags');
    Route::post('division_level_approved_store', [HostelTrailController::class, 'division_level_approved_store'])->name('division_level_approved_store')->middleware('StopScriptTags');

    Route::post('get_gender',    [HostelTrailController::class, 'get_gender'])->middleware('StopScriptTags');
    Route::any('district_level_trialList',        [HostelTrailController::class, 'trialList'])->name('hosteladmintrialList')->middleware('StopScriptTags');
    Route::match(['get', 'post'], 'district_level_filtertrialList',        [HostelTrailController::class, 'filtertrialList'])->name('hosteladminfiltertrialList')->middleware('StopScriptTags');

    Route::any('division_level_trialList',        [HostelTrailController::class, 'trialListtwo'])->name('hosteladmintrialListtwo')->middleware('StopScriptTags');
    Route::match(['get', 'post'], 'division_level_filtertrialList',        [HostelTrailController::class, 'filtertrialListtwo'])->name('hosteladminfiltertrialListtwo')->middleware('StopScriptTags');

    Route::any('state_level_trialList',        [HostelTrailController::class, 'trialListthree'])->name('hosteladmintrialListthree')->middleware('StopScriptTags');
    Route::match(['get', 'post'], 'state_level_filtertrialList',        [HostelTrailController::class, 'filtertrialListthree'])->name('hosteladminfiltertrialListthree')->middleware('StopScriptTags');

    Route::any('medical_test',        [HostelTrailController::class, 'medical_test'])->name('hosteladminmedical_test')->middleware('StopScriptTags');
    Route::post('medical_test_approved',        [HostelTrailController::class, 'medical_test_approved'])->name('hosteladminmedical_test_approved')->middleware('StopScriptTags');
    Route::post('trialListApplicantStore',        [HostelTrailController::class, 'trialListApplicantStore'])->name('hosteltrialListApplicantStore')->middleware('StopScriptTags');
    //badminton trial
    Route::Post('badmintontrialList',  [HostelTrailController::class, 'badmintontrialList'])->name('hostelbadmintontrialList')->middleware('StopScriptTags');
    //volleyball trial
    Route::post('volleyBalltrialList', [HostelTrailController::class, 'volleyBalltrialList'])->name('hostelvolleyBalltrialList')->middleware('StopScriptTags');
    // kusti trial
    Route::post('kustitrialList',    [HostelTrailController::class, 'kustitrialList'])->name('hostelkustitrialList')->middleware('StopScriptTags');
    // swimming  trial
    Route::post('swimmingtrialList',  [HostelTrailController::class, 'swimmingtrialList'])->name('hostelswimmingtrialList')->middleware('StopScriptTags');
    // kabaddi trial
    Route::post('kabadditrialList',   [HostelTrailController::class, 'kabadditrialList'])->name('hostelkabadditrialList')->middleware('StopScriptTags');
    // judo trial
    Route::post('judotrialList',      [HostelTrailController::class, 'judotrialList'])->name('hosteljudotrialList')->middleware('StopScriptTags');
    //gymnastic trial
    Route::post('gymnasticboystrialList', [HostelTrailController::class, 'gymnasticboystrialList'])->name('hostelgymnasticboystrialList')->middleware('StopScriptTags');
    Route::post('gymnasticgirlstrialList', [HostelTrailController::class, 'gymnasticgirlstrialList'])->name('hostelgymnasticgirlstrialList')->middleware('StopScriptTags');
    //cricket trial
    Route::post('cricketbatsmantrialList',     [HostelTrailController::class, 'cricketbatsmantrialList'])->name('hostelcricketbatsmantrialList')->middleware('StopScriptTags');
    Route::post('cricketbowlertrialList',     [HostelTrailController::class, 'cricketballertrialList'])->name('hostelcricketballertrialList')->middleware('StopScriptTags');
    Route::post('cricketkeepertrialList',     [HostelTrailController::class, 'cricketkeepertrialList'])->name('hostelcricketkeepertrialList')->middleware('StopScriptTags');
    //hockey trial
    Route::post('hockeykeepertrialList',     [HostelTrailController::class, 'hockeykeepertrialList'])->name('hostelhockeykeepertrialList')->middleware('StopScriptTags');
    Route::post('hockeytrialList',     [HostelTrailController::class, 'hockeytrialList'])->name('hostelhockeytrialList')->middleware('StopScriptTags');
    //football trial
    Route::post('footballkeepertrialList',   [HostelTrailController::class, 'footballkeepertrialList'])->name('hostelfootballkeepertrialList')->middleware('StopScriptTags');
    Route::post('footballtrialList',   [HostelTrailController::class, 'footballtrialList'])->name('hostelfootballtrialList')->middleware('StopScriptTags');


    Route::post('athleticsrunnertrialList',  [HostelTrailController::class, 'athleticsrunnertrialList'])->name('hostelathleticsrunnertrialList')->middleware('StopScriptTags');
    Route::post('athleticsthrowertrialList',  [HostelTrailController::class, 'athleticsthrowertrialList'])->name('hostelathleticsthrowertrialList')->middleware('StopScriptTags');
    Route::post('athleticsjumpertrialList',  [HostelTrailController::class, 'athleticsjumpertrialList'])->name('hostelathleticsjumpertrialList')->middleware('StopScriptTags');
    // boxing trial
    Route::post('boxingtrialList',      [HostelTrailController::class, 'boxingtrialList'])->name('hostelboxingtrialList')->middleware('StopScriptTags');
    // basketball trial
    Route::post('basketballtrialList',      [HostelTrailController::class, 'basketballtrialList'])->name('hostelbasketballtrialList')->middleware('StopScriptTags');
    // tabletennsi trial
    Route::post('tabletennistrialList',      [HostelTrailController::class, 'tabletennistrialList'])->name('hosteltabletennistrialList')->middleware('StopScriptTags');
    // handball trial
    Route::post('handballtrialList',      [HostelTrailController::class, 'handballtrialList'])->name('hostelhandballtrialList')->middleware('StopScriptTags');
    // archery trial
    Route::post('archerytrialList',      [HostelTrailController::class, 'archerytrialList'])->name('hostelarcherytrialList')->middleware('StopScriptTags');
});

// //jyoti
// //Player Route
// Route::group(['prefix' => 'player-coach','middleware' => ['player']], function () {
// Route::get('dashboard', [PlayerApplication::class, 'player_dashboard'])->name('playerdashboard')->middleware('StopScriptTags');
// Route::get('application', [PlayerApplication::class, 'player_application'])->name('playerapplication')->middleware('StopScriptTags');
// Route::get('applicationpreview', [PlayerApplication::class, 'player_applicationpreview'])->name('playerapplicationpreview')->middleware('StopScriptTags');
// Route::get('logout', [PlayerAuthController::class, 'player_logout'])->name('playerlogout')->middleware('StopScriptTags');
// Route::get('applicant_application', [PlayerApplication::class,'applicant_application'])->name('playerapplicantapplication')->middleware('StopScriptTags');
// Route::post('applicant_form', [PlayerApplication::class, 'applicant_applicationbasicForm'])->name('playerapplicationBasicForm')->middleware('StopScriptTags');
// Route::post('final_submit', [PlayerApplication::class, 'applicant_applicationFinalSubmit'])->name('playerapplicationFinalSubmit')->middleware('StopScriptTags');
// Route::get('applicant_payment', [PlayerApplication::class,'applicant_payment'])->name('playerapplicantpayment')->middleware('StopScriptTags');
// });

// Route::group(['prefix' => 'player_coach'], function () {
// Route::get('/', [PlayerAuthController::class, 'player_register'])->name('playerregistration');
// Route::post('registration/store', [PlayerAuthController::class, 'player_registrationStore'])->name('playerregistrationStore');

// Route::get('login', [PlayerAuthController::class, 'player_login'])->name('playerlogin');
// Route::post('login/store', [PlayerAuthController::class, 'player_loginStore'])->name('playerloginStore');
// Route::get('otp', [PlayerAuthController::class, 'player_otp'])->name('playerotp');
// Route::get('resend_otp', [PlayerAuthController::class, 'player_resendotp'])->name('playerresendotp');
// Route::post('otp/store', [PlayerAuthController::class, 'player_otpStore'])->name('playerotpStore');
// Route::get('changepassword', [PlayerAuthController::class, 'player_changepassword'])->name('playerchangepassword');

// Route::patch('changepasswordStore', [PlayerAuthController::class, 'player_changepasswordStore'])->name('playerchangepasswordStore');
// Route::get('forgotpassword', [PlayerAuthController::class, 'player_forgotpassword'])->name('playerforgotpassword');
// Route::post('forgot/passwordStore', [PlayerAuthController::class, 'player_forgotStore'])->name('playerforgotStore');

// });



Route::get('calendar_management', function () {
    return view('admin.calender.calender_management');
});

Route::get('allevent', function () {
    return view('admin.calender.allevent');
})->name('allevent');

Route::group(['prefix' => 'player_coach'], function () {
    Route::get('/cp_refresh',       [PlayerCoachController::class, 'cp_refresh']);
    Route::get('/', [PlayerCoachController::class, 'player_register'])->name('playerregistration');
    Route::post('registration/store', [PlayerCoachController::class, 'player_registrationStore'])->name('playerregistrationStore');

    Route::get('login', [PlayerCoachController::class, 'player_login'])->name('playerlogin');
    Route::post('login/store', [PlayerCoachController::class, 'player_loginStore'])->name('playerloginStore');
    Route::get('otp', [PlayerCoachController::class, 'player_otp'])->name('playerotp');
    Route::get('resend_otp', [PlayerCoachController::class, 'player_resendotp'])->name('playerresendotp');
    Route::post('otp/store', [PlayerCoachController::class, 'player_otpStore'])->name('playerotpStore');
    Route::get('forgotpassword', [PlayerCoachController::class, 'player_forgotpassword'])->name('playerforgotpassword');
    Route::post('forgot/passwordStore', [PlayerCoachController::class, 'player_forgotStore'])->name('playerforgotStore');
});


//Player Route
Route::group(['prefix' => 'player_coach', 'middleware' => ['player']], function () {
    Route::post('awardStore', [PlayerCoachController::class, 'awardStore'])->name('awardStore');
    Route::get('awarddelete/{id}', [PlayerCoachController::class, 'awarddelete'])->name('awarddelete');
    Route::post('basicDetailStore', [PlayerCoachController::class, 'basicDetailStore'])->name('basicDetailStore');
    Route::post('qualicationStore', [PlayerCoachController::class, 'qualicationStore'])->name('qualicationStore');
    Route::get('qualicationdelete/{id}', [PlayerCoachController::class, 'qualicationdelete'])->name('qualicationdelete');
    Route::get('changepassword', [PlayerCoachController::class, 'player_changepassword'])->name('playerchangepassword');
    Route::patch('changepasswordStore', [PlayerCoachController::class, 'player_changepasswordStore'])->name('playerchangepasswordStore');
    Route::get('dashboard', [PlayerCoachController::class, 'player_dashboard'])->name('playerdashboard')->middleware('StopScriptTags');
    Route::get('application', [PlayerCoachController::class, 'player_application'])->name('playerapplication')->middleware('StopScriptTags');
    Route::get('applicationpreview', [PlayerCoachController::class, 'player_applicationpreview'])->name('playerapplicationpreview')->middleware('StopScriptTags');
    Route::get('logout', [PlayerCoachController::class, 'player_logout'])->name('playerlogout')->middleware('StopScriptTags');
    Route::get('applicant_application', [PlayerCoachController::class, 'applicant_application'])->name('playerapplicantapplication')->middleware('StopScriptTags');
    Route::post('applicant_form', [PlayerCoachController::class, 'applicant_applicationbasicForm'])->name('playerapplicationBasicForm');
    Route::get('final_submit', [PlayerCoachController::class, 'applicant_applicationFinalSubmit'])->name('playerapplicationFinalSubmit')->middleware('StopScriptTags');
    Route::get('applicant_payment', [PlayerCoachController::class, 'applicant_payment'])->name('playerapplicantpayment')->middleware('StopScriptTags');
});


Route::group(['prefix' => 'gymnasium_swimming'], function () {
    Route::get('login', [GymnasiumSwimmingController::class, 'login'])->name('gymnasium_swimming_login');
    Route::get('/cp_refresh', [GymnasiumSwimmingController::class, 'cp_refresh']);
    Route::get('/', [GymnasiumSwimmingController::class, 'gymnasium_swimming_register'])->name('gymnasium_swimmingregistration');
    Route::post('registration/store', [GymnasiumSwimmingController::class, 'registrationStore'])->name('gymnasium_swimmingregistration_store');
    Route::post('login/store', [GymnasiumSwimmingController::class, 'loginStore'])->name('gymnasium_swimming_loginStore');
    Route::get('otp', [GymnasiumSwimmingController::class, 'otp'])->name('gymnasium_swimming_otp');
    Route::post('otp/store', [GymnasiumSwimmingController::class, 'otpStore'])->name('gymnasium_swimming_otpStore');
    Route::get('resend_otp', [GymnasiumSwimmingController::class, 'resendotp'])->name('gymnasium_swimming_resendotp');
    Route::get('forgotpassword', [GymnasiumSwimmingController::class, 'forgotpassword'])->name('gymnasium_swimming_forgotpassword');
    Route::post('awardStore', [GymnasiumSwimmingController::class, 'awardStore']);
    Route::get('awarddelete/{id}', [GymnasiumSwimmingController::class, 'awarddelete']);
    Route::get('final_submit', [GymnasiumSwimmingController::class, 'applicant_applicationFinalSubmit'])->middleware('StopScriptTags');
    // Route::get('final_submit', [GymnasiumSwimmingController::class, 'applicant_applicationFinalSubmit'])->name('playerapplicationFinalSubmit')->middleware('StopScriptTags');
    Route::post('forgot/passwordStore', [GymnasiumSwimmingController::class, 'forgotStore'])->name('gymnasium_swimming_forgotStore');
});




Route::group(['prefix' => 'gymnasium_swimming', 'middleware' => ['GymnasiumSwimming']], function () {
    Route::get('changepassword', [GymnasiumSwimmingController::class, 'changepassword'])->name('gymnasium_swimming_changepassword');
    Route::post('changepasswordStore', [GymnasiumSwimmingController::class, 'changepasswordStore'])->name('gymnasium_swimming_changepasswordStore');
    Route::get('dashboard', [GymnasiumSwimmingController::class, 'dashboard'])->name('gymnasium_swimming_dashboard')->middleware('StopScriptTags');
    Route::get('application', [GymnasiumSwimmingController::class, 'application'])->name('gymnasium_swimming_application')->middleware('StopScriptTags');
    Route::post('applicant_form', [GymnasiumSwimmingController::class, 'applicant_applicationbasicForm'])->name('gymnasium_swimming_applicationBasicForm');
    Route::get('applicationpreview', [GymnasiumSwimmingController::class, 'applicationpreview'])->name('gymnasium_swimming_applicationpreview')->middleware('StopScriptTags');
    Route::get('logout', [GymnasiumSwimmingController::class, 'logout'])->name('gymnasium_swimming_logout')->middleware('StopScriptTags');
});


// Route::group(['prefix' => 'eklavya_kreeda_kosh'], function () {
//  Route::get('/', [EklavyaKreedaKoshController::class, 'register'])->name('eklavya_kreeda_kosh_register');
//  Route::get('/cp_refresh', [EklavyaKreedaKoshController::class, 'cp_refresh']);
//  Route::post('registration/store', [EklavyaKreedaKoshController::class, 'registrationStore'])->name('eklavya_kreeda_kosh_registrationStore');
//  Route::get('otp', [EklavyaKreedaKoshController::class, 'otp'])->name('eklavya_kreeda_kosh_otp');
//  Route::post('otp/store', [EklavyaKreedaKoshController::class, 'otpStore'])->name('eklavya_kreeda_kosh_otpStore');
//  Route::get('login', [EklavyaKreedaKoshController::class, 'login'])->name('eklavya_kreeda_kosh_login');
//  Route::post('login/store', [EklavyaKreedaKoshController::class, 'loginStore'])->name('eklavya_kreeda_kosh_loginStore');
//  Route::get('resend_otp', [EklavyaKreedaKoshController::class, 'resend_otp'])->name('eklavya_kreeda_kosh_resend_otp')->middleware('StopScriptTags');
//  Route::get('forgotpassword', [EklavyaKreedaKoshController::class, 'forgotpassword'])->name('eklavya_kreeda_kosh_forgotpassword');
//  Route::post('forgot/passwordStore', [EklavyaKreedaKoshController::class, 'forgotStore'])->name('eklavya_kreeda_kosh_forgotStore');

// });


// Route::group(['prefix' => 'eklavya_kreeda_kosh','middleware' => ['EklavyaKreedaKosh']], function () {
Route::middleware('IsUsers')->group(function () {
    Route::post('applicant_form', [EklavyaKreedaKoshController::class, 'applicant_applicationbasicForm'])->name('eklavya_kreeda_kosh_applicationBasicForm');
    // Route::get('award_bank_detail', [EklavyaKreedaKoshController::class, 'award_bank_detail'])->name('eklavya_kreeda_kosh_award_bank_detail')->middleware('StopScriptTags');
    Route::get('eklavya_kreeda_kosh/{id?}', [EklavyaKreedaKoshController::class, 'eklavya_kreeda_kosh'])->name('eklavya_kreeda_kosh');
    Route::post('awardStore', [EklavyaKreedaKoshController::class, 'awardStore'])->name('eklavya_kreeda_kosh_awardStore');
    Route::post('updateawardStore', [EklavyaKreedaKoshController::class, 'updateawardStore'])->name('eklavya_kreeda_kosh_updateawardStore');
    // Route::get('awarddelete/{id}', [EklavyaKreedaKoshController::class, 'awarddelete']);
    Route::post('bank_detail_store', [EklavyaKreedaKoshController::class, 'bank_detail_store'])->name('eklavya_kreeda_kosh_bank_detail_store');
    Route::get('applicationpreview/{id}', [EklavyaKreedaKoshController::class, 'applicationpreview'])->name('eklavya_kreeda_kosh_applicationpreview')->middleware('StopScriptTags');
    Route::get('eklavya_kreeda_kosh/final_submit/{id}', [EklavyaKreedaKoshController::class, 'applicant_applicationFinalSubmit']);
});

//FacilityBooking

Route::get('/facility_booking/register', [FacilityAuthController::class, 'register'])->name('facility_booking.register');
Route::get('/facility_booking/login', [FacilityAuthController::class, 'login'])->name('facility_booking.login');
Route::get('/facility_booking/otp', [FacilityAuthController::class, 'otp'])->name('facility_booking.otp');
Route::get('/facility_booking/resend_otp', [FacilityAuthController::class, 'resendotp'])->name('facility_booking.resendotp');
Route::post('/facility_booking/register/store', [FacilityAuthController::class, 'registerStore']);
Route::post('/facility_booking/otp/store', [FacilityAuthController::class, 'otpStore'])->name('facility_booking.otpStore');
Route::get('/facility_booking/forgot', [FacilityAuthController::class, 'forgot'])->name('facility_booking.forgot');
Route::post('/facility_booking/forgot/passwordStore', [FacilityAuthController::class, 'forgotStore'])->name('facility_booking.forgotStore');
Route::post('/facility_booking/login/store', [FacilityAuthController::class, 'loginStore'])->name('facility_booking.loginStore');

Route::group(['prefix' => 'facility_booking', 'middleware' => ['facility_booking']], function () {

    Route::get('/changepassword', [FacilityAuthController::class, 'changePassword'])->name('facility_booking.changePassword');
    Route::get('/logout', [FacilityAuthController::class, 'logout'])->name('facility_booking.logout');
    Route::patch('/changepasswordStore', [FacilityAuthController::class, 'changepasswordStore'])->name('facility_booking.changepasswordStore');
    Route::get('/dashboard', [FacilityApplication::class, 'dashboard'])->name('facility_booking.dashboard');
    Route::get('/application_form', [FacilityApplication::class, 'applicationForm'])->name('facility_booking.applicationForm')->middleware('StopScriptTags');
    Route::get('/stadium_booking', [FacilityApplication::class, 'stadiumBooking'])->name('facility_booking.stadiumBooking');
    Route::post('/application_form/basic', [FacilityApplication::class, 'applicationBasicForm'])->name('facility_booking.applicationbookinForm');
    Route::post('/stadium_booking/basic', [FacilityApplication::class, 'stadiumBookingStore'])->name('facility_booking.stadiumBookingStore');
    Route::get('/application_preview/{id}', [FacilityApplication::class, 'applicationFormPreview'])->name('facility_booking.applicationFormPreview');
    Route::get('/booking_final_submit/{id}', [FacilityApplication::class, 'booking_final_submit']);
    Route::post('/application_form_update/{id}', [FacilityApplication::class, 'applicationFormUpdate'])->name('facility_booking.applicationFormUpdate');
    Route::get('/application_form_edit/{id}', [FacilityApplication::class, 'applicationFormEdit'])->name('applicationFormEdit');
    // Route::get('/application_form', [HostelApplication::class, 'applicationForm'])->name('hostel.applicationForm')->middleware('StopScriptTags');
    Route::get('/generate_application_preview/{id}', [FacilityApplication::class, 'generate_application_preview'])->name('generate_application_preview');
    Route::post('/get_swimming', [FacilityApplication::class, 'get_swimming']);
    Route::post('/get_gymnasium', [FacilityApplication::class, 'get_gymnasium']);
});

Route::get('/sports_calendar', [UserCalendarManagement::class, 'sports_calendar']);









//coaching camps  8/1/2024 4:30 pm
Route::group(['prefix' => 'coaching_camp'], function () {
    Route::get('/cp_refresh', [CoachingCampController::class, 'cp_refresh']);
    Route::get('/register', [CoachingCampController::class, 'coaching_camp_register'])->name('coaching_camp_register');
    Route::get('/otp', [CoachingCampController::class, 'coaching_camp_otp'])->name('coaching_camp_otp');
    Route::get('/', [CoachingCampController::class, 'coaching_camp_login'])->name('coaching_camp_login');
    Route::get('/forgot_password', [CoachingCampController::class, 'coaching_camp_forget_password'])->name('coaching_camp_forgot_password');
    Route::post('/register_store', [CoachingCampController::class, 'coaching_camp_regsiter_store'])->name('coaching_camp_regsiter_store');

    Route::post('/otpStore', [CoachingCampController::class, 'coaching_camp_otpStore'])->name('coaching_camp_otpStore');
    Route::get('resend_otp', [CoachingCampController::class, 'coaching_camp_resendotp'])->name('coaching_camp_resendotp');

    Route::post('/loginStore', [CoachingCampController::class, 'loginStore'])->name('coaching_camp_loginStore');
    Route::post('/forgotStore', [CoachingCampController::class, 'forgotStore'])->name('coaching_camp_forgotStore');
});




Route::group(['prefix' => 'coaching_camp', 'middleware' => 'CoachingCamp'], function () {
    Route::get('/change_password', [CoachingCampController::class, 'coaching_camp_change_password'])->name('coaching_camp_change_password');
    Route::get('/application_form', [CoachingCampController::class, 'coaching_camp_application_form'])->name('coaching_camp_application_form');
    Route::get('/application_preview', [CoachingCampController::class, 'coaching_camp_application_preview'])->name('coaching_camp_application_preview');
    Route::get('/dashboard', [CoachingCampController::class, 'coaching_camp_dashboard'])->name('coaching_camp_dashboard');
    Route::post('/changepasswordStore', [CoachingCampController::class, 'changepasswordStore'])->name('coaching_camp_changepasswordStore');
    Route::post('/application_form_store', [CoachingCampController::class, 'application_form_store'])->name('coaching_camp_application_form_store');

    Route::get('/applicationfinalSubmit', [CoachingCampController::class, 'applicationfinalSubmit']);
    Route::get('/logout', [CoachingCampController::class, 'logout'])->name('coaching_camp_logout');
    Route::get('/coaching_camp_application_registration_fee', [RajkoshController::class, 'coaching_camp_application_registration_fee'])->name('coaching_camp_application_registration_fee');

    Route::get('/coaching_camp_application_coaching_fee', [RajkoshController::class, 'coaching_camp_application_coaching_fee'])->name('coaching_camp_application_coaching_fee');
});


Route::group(['prefix' => 'admin', 'middleware' => ['IsAdmin']], function () {

    Route::any('/coaching_camp_list', [AdminCoachingCampController::class, 'coaching_camp_list'])->name('coaching_camp_list');
    Route::get('/coaching_camp_view_details/{id}', [AdminCoachingCampController::class, 'coaching_camp_view_details'])->name('coaching_camp_view_details');
    Route::Post('coaching_camp/applicationUpdateStatus/{id}', [AdminCoachingCampController::class, 'applicationUpdateStatus'])->name('applicationUpdateStatus');
});


//e_district




// Route::any('e_district', function(){

//     return view('e_district.home');
// });

Route::any('e_district', [EdistrcitController::class, 'sendrequestapiedistrict']);
Route::any('appResponse_reqId', [EdistrcitController::class, 'appResponse_reqId']);
Route::any('e_district_application_status', [EdistrcitController::class, 'e_district_application_status'])->name('e_district_application_status');

Route::group(['prefix' => 'admin', 'middleware' => ['IsAdmin']], function () {
    Route::post('/online_admission_query_mark', [CollegeAdmin::class, 'online_admission_query_mark'])->name('online_admission_query_mark');
    Route::get('/online_admission_edit/{id}', [CollegeAdmin::class, 'online_admission_edit'])->name('online_admission_edit');
    Route::post('/online_admission_update/{id}', [CollegeAdmin::class, 'online_admission_update'])->name('online_admission_update');

    Route::post('/change_trial_division', [CollegeAdmin::class, 'change_trial_division'])->name('change_trial_division');
    Route::post('get_sport_admin',    [OnlineAdmission::class, 'get_sport'])->name('onlineAdmission.get_sport_admin')->middleware('StopScriptTags');
    Route::post('get_college_admin',    [OnlineAdmission::class, 'get_college'])->name('onlineAdmission.get_college_admin')->middleware('StopScriptTags');
    Route::post('get_subsport_admin',    [CollegeAdmin::class, 'get_subsport'])->middleware('StopScriptTags');
});



Route::group(['prefix' => 'hostel', 'middleware' => ['hostel']], function () {
    Route::post('/update_challan_status', [HostelAuthController::class, 'update_challan_status'])->name('update_challan_status');
    Route::any('payment_verify_receipt',  [HostelApplication::class, 'payment_verify_receipt'])->name('payment_verify_receipt')->middleware('StopScriptTags');
});

Route::group(['prefix' => 'admin', 'middleware' => ['IsAdmin']], function () {
    Route::post('hostel/payment_accept',     [HostelApplication::class, 'payment_varify_accept'])->name('payment_varify_accept')->middleware('StopScriptTags');
    Route::post('hostel/payment_reject',     [HostelApplication::class, 'payment_varify_reject'])->name('payment_varify_reject')->middleware('StopScriptTags');
    Route::any('/hostelListExport',  [HostelAuthController::class, 'hostelListExport'])->name('hostelListExport')->middleware('StopScriptTags');
});



// Absent report
Route::group(['prefix' => 'admin', 'middleware' => ['IsAdmin']], function () {
    Route::any('/online_admission_absent', [CollegeAdmin::class, 'online_admission_absent'])->name('online_admission_absent');
    Route::any('/hostel_absent_application', [HostelApplication::class, 'hostel_absent_application'])->name('hostel_absent_application');
    Route::any('/hostel_districtwisecount', [HostelApplication::class, 'districtwisecount'])->name('hostel_absent_application');
    Route::any('/cancel_application_hostel', [HostelApplication::class, 'cancel_application_hostel'])->name('cancel_application_hostel');
});




Route::group(['prefix' => 'admin', 'middleware' => ['IsAdmin']], function () {
    Route::post('hostel_sub_sport_update',     [HostelApplication::class, 'hostel_sub_sport_update'])->name('hostel_sub_sport_update');
});



Route::group(['prefix' => 'hosteladmin', 'middleware' => ['IsAdmin']], function () {
    Route::any('competition_level_approved',     [HostelTrailController::class, 'competition_level_approved'])->name('hostel_competition_level_approved');
    Route::any('competition_level_approved_store',     [HostelTrailController::class, 'competition_level_approved_store'])->name('hostel_competition_level_approved_store');
    Route::any('division_level_merit_list',     [HostelTrailController::class, 'division_level_merit_list'])->name('hostel_division_level_merit_list');
});


Route::group(['prefix' => 'collegeadmin', 'middleware' => ['IsAdmin']], function () {
    Route::any('division_level_merit_list',     [CollegeAdmin::class, 'division_level_merit_list'])->name('college_division_level_merit_list');
});
Route::group(['prefix' => 'hosteladmin', 'middleware' => ['IsAdmin']], function () {
    Route::any('coaching_camp_trialList',        [HostelTrailController::class, 'trialListfour'])->name('hosteladmintrialListfour')->middleware('StopScriptTags');
    Route::any('coaching_camp_trialListTest',        [HostelTrailControllerTest::class, 'trialListfour'])->name('hosteladmintrialListfourtest')->middleware('StopScriptTags');
    Route::any('final_approved_list',     [HostelTrailController::class, 'final_approved_list'])->name('hostel_final_approved_list');
    Route::any('final_approved_list_store',     [HostelTrailController::class, 'final_approved_list_store'])->name('hostel_final_approved_list_store');
    Route::any('hostel_allotment_list',        [HostelTrailController::class, 'hostel_allotment_list'])->name('hostel_allotment_list');
    Route::any('hostel_alloted_to/{hostel_id?}',        [HostelTrailController::class, 'hostel_allotted_to'])->name('hostel_allotted_to');

    Route::any('hostel_seat_vacant',        [HostelTrailController::class, 'hostel_seat_vacant'])->name('hostel_seat_vacant');
    Route::any('hostel_detach',        [HostelTrailController::class, 'hostel_detach'])->name('hostel_detach');
});


Route::group(['prefix' => 'admin', 'middleware' => ['IsAdmin']], function () {
    Route::any('competition',        [PositionController::class, 'competition']);
    Route::any('addPositionComp',          [PositionController::class, 'addPositionComp']);
    Route::any('compUpdate',       [PositionController::class, 'compUpdate']);

    Route::any('event',        [PositionController::class, 'event']);
    Route::any('addPositionEvent',          [PositionController::class, 'addPositionEvent']);
    Route::any('eventUpdate',       [PositionController::class, 'eventUpdate']);


    Route::get('event-competition-map',          [PositionController::class, 'event_competition_map']);
    Route::any('mapCompEvent',          [PositionController::class, 'mapCompEvent']);
    Route::get('deleteComEvent/{id}', [PositionController::class, 'deleteComEvent']);
});











//   4/4/2024 rakesh hostel payment response
Route::any('hostel/payment_response', [RajkoshController::class, 'payment_response'])->name('hostel_payment_response');
Route::any('hostel/payment_request', [RajkoshController::class, 'payment_request'])->name('hostel_payment_request');


Route::any('hostel/payment_request_for_allotment', [RajkoshController::class, 'payment_request_for_allotment'])->name('hostel_payment_request_for_allotment');

Route::any('hostel/update_payment_status_allotment', [RajkoshController::class, 'update_payment_status_allotment'])->name('update_payment_status_allotment');





// 23/4/2024 Booking
Route::any('booking/guest_room_booking', [BookingController::class, 'guest_room_booking'])->name('guest_room_booking');
Route::any('booking/guest_room_booking_store', [BookingController::class, 'guest_room_booking_store'])->name('guest_room_booking_store');
Route::any('booking/stadium_booking', [BookingController::class, 'stadium_booking'])->name('stadium_booking');
Route::any('booking/stadium_booking_store', [BookingController::class, 'stadium_booking_store'])->name('stadium_booking_store');








Route::group(['prefix' => 'admin', 'middleware' => ['IsAdmin']], function () {

    Route::any('/guest_room_booking', [BookingController::class, 'admin_guest_room_booking'])->name('admin_guest_room_booking');
    Route::any('/stadium_booking', [BookingController::class, 'admin_stadium_booking'])->name('admin_stadium_booking');
    Route::any('/stadium_booking_approved', [BookingController::class, 'stadium_booking_approved'])->name('stadium_booking_approved');

    Route::any('/guest_room_booking_approved', [BookingController::class, 'guest_room_booking_approved'])->name('stadium_booking_approved');
});










Route::group(['middleware' => ['IsAdmin']], function () {
    Route::any('hostel_allotment_letter',        [HostelTrailController::class, 'hostel_allotment_letter'])->name('hostel_allotment_letter');
});

Route::any('trial_import',  [DarpanCountController::class, 'trial_import']);
Route::any('download_hostel_pdf/{checkk}', [HostelTrailController::class, 'download_hostel_pdf'])->name('download_hostel_pdf');
Route::any('download_hostel_pdftest/{checkk}', [HostelTrailController::class, 'download_hostel_pdf'])->name('download_hostel_pdftest');
Route::get('update_payment_status/{application_no}', [RajkoshController::class, 'update_payment_status'])->name('update_payment_status');




//fcaility booking  rakesh



Route::group(['prefix' => 'facility_booking'], function () {
    Route::any('register', [FacilityBookingController::class, 'register'])->name('facility_booking_register');
    Route::any('/', [FacilityBookingController::class, 'login'])->name('facility_booking_login');
    Route::any('/otp', [FacilityBookingController::class, 'otp'])->name('facility_booking_otp');
    Route::any('/forgot_password', [FacilityBookingController::class, 'forgot_password'])->name('facility_booking_forgot_password');
    Route::get('/resend_otp', [FacilityBookingController::class, 'resendotp'])->name('facility_booking.resendotp');
    Route::any('payment_request/{id}', [RajkoshController::class, 'facility_booking_payment_request'])->name('facility_booking_payment_request');
});

Route::group(['prefix' => 'facility_booking', 'middleware' => ['facility_booking']], function () {
    Route::any('change_password', [FacilityBookingController::class, 'change_password'])->name('facility_booking_change_password');
    Route::any('dashboard', [FacilityBookingController::class, 'dashboard'])->name('facility_booking_dashboard');
    Route::any('application', [FacilityBookingController::class, 'application'])->name('facility_booking_application');

    Route::any('application_preview/{id}', [FacilityBookingController::class, 'application_preview'])->name('facility_booking_application_preview');

    Route::any('stadium_booking', [FacilityBookingController::class, 'stadium_booking'])->name('facility_booking_stadium_booking');

    Route::any('stadium_booking_preview', [FacilityBookingController::class, 'stadium_booking_preview'])->name('facility_booking_stadium_booking_preview');

    Route::any('payment', [FacilityBookingController::class, 'payment'])->name('facility_booking_payment');

    Route::any('logout', [FacilityBookingController::class, 'logout'])->name('facility_booking_logout');

    Route::any('application_update/{id}', [FacilityBookingController::class, 'application_update'])->name('facility_booking_application_update');

    Route::any('final_submit/{id}', [FacilityBookingController::class, 'final_submit']);
    Route::any('stadium', [FacilityBookingController::class, 'stadium']);
});


Route::any('facility_booking/payment_receipt/{id}', [FacilityBookingController::class, 'payment_receipt'])->name('facility_booking_payment_receipt');



Route::group(['prefix' => 'admin/facility_booking', 'middleware' => ['IsAdmin', 'IsMapping']], function () {
    Route::any('/dashboard/{id}', [FacilityBookingController::class, 'admin_dashboard'])->name('admin_facility_booking_dashboard');
    Route::any('/preview/{id}', [FacilityBookingController::class, 'admin_application_preview'])->name('admin_facility_booking_preview');
    Route::any('/accepted_reject_status', [FacilityBookingController::class, 'accepted_reject_status'])->name('admin_facility_booking_accepted_reject_status');
    Route::any('/application_pdf/{id}', [FacilityBookingController::class, 'application_pdf'])->name('admin_facility_booking_application_pdf');
    Route::any('/query_mark', [FacilityBookingController::class, 'query_mark'])->name('admin_facility_booking_query_mark');
});


// Private Coaching
Route::group(['prefix' => 'private_coaching'], function () {
    Route::any('/register', [PrivateCoachingController::class, 'register'])->name('private_coaching_register');
    Route::any('/', [PrivateCoachingController::class, 'login'])->name('private_coaching_login');
    Route::any('/cp_refresh', [PrivateCoachingController::class, 'cp_refresh']);
    Route::any('/register_store', [PrivateCoachingController::class, 'register_store'])->name('private_coaching_register_store');
    Route::any('/otp', [PrivateCoachingController::class, 'otp'])->name('private_coaching_otp');
    Route::any('/resend_otp', [PrivateCoachingController::class, 'resend_otp']);
    Route::any('/otp_store', [PrivateCoachingController::class, 'otp_store'])->name('private_coaching_otp_store');
    Route::any('/login_store', [PrivateCoachingController::class, 'login_store'])->name('private_coaching_login_store');
    Route::any('/forgot_password', [PrivateCoachingController::class, 'forgot_password'])->name('private_coaching_forgot_password');
});


Route::group(['prefix' => 'private_coaching', 'middleware' => ['PrivateCoaching']], function () {
    Route::any('/change_password', [PrivateCoachingController::class, 'change_password'])->name('private_coaching_change_password');
    Route::any('/change_password_store', [PrivateCoachingController::class, 'change_password_store'])->name('private_coaching_change_password_store');
    Route::any('/dashboard', [PrivateCoachingController::class, 'dashboard'])->name('private_coaching_dashboard');
    Route::any('/application_form/{id?}', [PrivateCoachingController::class, 'application_form'])->name('private_coaching_application_form');
    Route::any('/application_form_store/{id?}', [PrivateCoachingController::class, 'application_form_store'])->name('private_coaching_application_form_store');
    Route::any('/application_preview/{id}', [PrivateCoachingController::class, 'application_preview'])->name('private_coaching_application_preview');
    Route::any('/applicationfinalSubmit/{id}', [PrivateCoachingController::class, 'applicationfinalSubmit'])->name('private_coaching_applicationfinalSubmit');

    Route::any('/profile', [PrivateCoachingController::class, 'profile'])->name('private_coaching_profile');
    Route::any('/profile_preview', [PrivateCoachingController::class, 'profile_preview'])->name('private_coaching_profile_preview');
    Route::any('/logout', [PrivateCoachingController::class, 'logout'])->name('private_coaching_logout');




    /// new url

    Route::any('/apply_for', [PrivateCoachingController::class, 'apply_for'])->name('private_apply_for');






    Route::any('/swimming_pool/{id?}', [PrivateCoachingController::class, 'swimming_pool'])->name('private_coaching_swimming_pool');
    Route::any('/gyms/{id?}', [PrivateCoachingController::class, 'gyms'])->name('private_coaching_gyms');
    Route::any('/academies/{id?}', [PrivateCoachingController::class, 'academies'])->name('private_coaching_academies');

    Route::any('/academies_application_form_store/{id?}', [PrivateCoachingController::class, 'academies_application_form_store'])->name('academies_application_form_store');
    Route::any('/academies_application_preview/{id?}', [PrivateCoachingController::class, 'academies_application_preview'])->name('academies_application_preview');
    Route::any('/academies_application_finalSubmit/{id}', [PrivateCoachingController::class, 'academies_application_finalSubmit'])->name('academies_application_finalSubmit');



    Route::any('/swimming_pool_form_store/{id?}', [PrivateCoachingController::class, 'swimming_pool_form_store'])->name('swimming_pool_form_store');
    Route::any('/swimming_pool_application_preview/{id?}', [PrivateCoachingController::class, 'swimming_pool_application_preview'])->name('swimming_pool_application_preview');
    Route::any('/swimming_pool_application_finalSubmit/{id}', [PrivateCoachingController::class, 'swimming_pool_application_finalSubmit'])->name('swimming_pool_application_finalSubmit');

    Route::any('/gyms_form_store/{id?}', [PrivateCoachingController::class, 'gyms_form_store'])->name('gyms_form_store');
    Route::any('/gyms_application_preview/{id?}', [PrivateCoachingController::class, 'gyms_application_preview'])->name('gyms_application_preview');

    Route::any('/gyms_application_finalSubmit/{id}', [PrivateCoachingController::class, 'gyms_application_finalSubmit'])->name('gyms_application_finalSubmit');
});



Route::group(['prefix' => 'admin/private_coaching', 'middleware' => ['IsAdmin']], function () {
    Route::any('/dashboard', [PrivateCoachingController::class, 'admin_dashboard'])->name('admin_private_coaching_dashboard');
    Route::any('/preview/{id}', [PrivateCoachingController::class, 'admin_application_preview'])->name('admin_private_coaching_preview');
    Route::any('/accepted_reject_status', [PrivateCoachingController::class, 'accepted_reject_status'])->name('admin_private_coaching_accepted_reject_status');
    Route::any('/query_mark', [PrivateCoachingController::class, 'query_mark'])->name('admin_private_coaching_query_mark');

    Route::any('/private_coaching_export_pdf', [PrivateCoachingController::class, 'private_coaching_export_pdf'])->name('private_coaching_export_pdf');


    Route::any('/gym_list', [PrivateCoachingController::class, 'gym_list']);
    Route::any('/admin_gym_preview/{id?}', [PrivateCoachingController::class, 'admin_gym_preview']);

    Route::any('/academy_list', [PrivateCoachingController::class, 'academy_list']);
    Route::any('/admin_academy_preview/{id?}', [PrivateCoachingController::class, 'admin_academy_preview']);

    Route::any('/swimming_pool_list', [PrivateCoachingController::class, 'swimming_pool_list']);
    Route::any('/admin_swimming_pool_preview/{id?}', [PrivateCoachingController::class, 'admin_swimming_pool_preview']);



    Route::any('/private_forward', [PrivateCoachingController::class, 'private_forward'])->name('admin_private_forward');
});



Route::group(['prefix' => 'collegeadmin', 'middleware' => ['IsAdmin']], function () {
    Route::any('college_sport_admission_matrix', [CollegeAdmin::class, 'college_sport_admission_matrix'])->name('college_sport_admission_matrix');
    Route::get('getAllAdmissionRegister', [CollegeAdmin::class,   'getAllAdmissionRegister']);
});




Route::group(['prefix' => 'admin', 'middleware' => ['IsAdmin']], function () {
    Route::get('sport-list-onlineAdmission',         [SportsController::class, 'index_onlineAdmission'])->name('sports_onlineAdmission')->middleware('StopScriptTags');
    Route::any('create-sport-onlineAdmission',       [SportsController::class, 'saveSport_onlineAdmission'])->name('saveSport_onlineAdmission')->middleware('StopScriptTags');
    Route::post('updateSport-onlineAdmission',      [SportsController::class, 'updateSport_onlineAdmission'])->name('updateSport_onlineAdmission')->middleware('StopScriptTags');
    Route::get('sportStatus-onlineAdmission/{id}', [SportsController::class, 'sportStatus_onlineAdmission'])->name('sportStatus_onlineAdmission')->middleware('StopScriptTags');
});





Route::group(['prefix' => 'collegeadmin', 'middleware' => ['IsAdmin']], function () {});


/** EklavyaSportsFund */

Route::any('/eklavyaFund', [EklavyaFundController::class, 'eklavyaFund'])->name('eklavyaFund');


Route::group(['prefix' => 'eklavyaFund'], function () {


    Route::any('/registration', [EklavyaFundController::class, 'registration']);
    Route::any('/otp', [EklavyaFundController::class, 'otp']);
    Route::group(['middleware' => ['EklavyaFund']], function () {
        Route::get('/dashboard', [EklavyaFundController::class, 'dashboard'])->name('eklavyaFund_dashboard');
        Route::any('/application_form/{id?}', [EklavyaFundController::class, 'application_form']);
        Route::any('/application_preview/{id}', [EklavyaFundController::class, 'application_preview']);
        Route::any('/change_password', [EklavyaFundController::class, 'change_password'])->name('eklavyaFund_change_password');
        Route::get('/logout', [EklavyaFundController::class, 'logout']);
    });
});
Route::any('admin/facility_booking/facilityBookingAjax/{id?}', [FacilityBookingController::class, 'facilityBookingAjax'])->name('facilityBookingAjax');
