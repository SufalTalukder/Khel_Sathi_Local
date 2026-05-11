<?php

namespace App\Http;

use Illuminate\Foundation\Http\Kernel as HttpKernel;

class Kernel extends HttpKernel
{
    /**
     * The application's global HTTP middleware stack.
     *
     * These middleware are run during every request to your application.
     *
     * @var array<int, class-string|string>
     */
    protected $middleware = [
        // \App\Http\Middleware\TrustHosts::class,
        \App\Http\Middleware\TrustProxies::class,
        \Fruitcake\Cors\HandleCors::class,
        \App\Http\Middleware\PreventRequestsDuringMaintenance::class,
        \Illuminate\Foundation\Http\Middleware\ValidatePostSize::class,
        \App\Http\Middleware\TrimStrings::class,
        \Illuminate\Foundation\Http\Middleware\ConvertEmptyStringsToNull::class,
    ];

    /**
     * The application's route middleware groups.
     *
     * @var array<string, array<int, class-string|string>>
     */
    protected $middlewareGroups = [
        'web' => [
            \App\Http\Middleware\EncryptCookies::class,
            \Illuminate\Cookie\Middleware\AddQueuedCookiesToResponse::class,
            \Illuminate\Session\Middleware\StartSession::class,
            // \Illuminate\Session\Middleware\AuthenticateSession::class,
            \Illuminate\View\Middleware\ShareErrorsFromSession::class,
            \App\Http\Middleware\VerifyCsrfToken::class,
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],

        'api' => [
            // \Laravel\Sanctum\Http\Middleware\EnsureFrontendRequestsAreStateful::class,
            'throttle:api',
            \Illuminate\Routing\Middleware\SubstituteBindings::class,
        ],
    ];

    /**
     * The application's route middleware.
     *
     * These middleware may be assigned to groups or used individually.
     *
     * @var array<string, class-string|string>
     */
    protected $routeMiddleware = [
        'auth' => \App\Http\Middleware\Authenticate::class,
        'auth.basic' => \Illuminate\Auth\Middleware\AuthenticateWithBasicAuth::class,
        'cache.headers' => \Illuminate\Http\Middleware\SetCacheHeaders::class,
        'can' => \Illuminate\Auth\Middleware\Authorize::class,
        'guest' => \App\Http\Middleware\RedirectIfAuthenticated::class,
        'password.confirm' => \Illuminate\Auth\Middleware\RequirePassword::class,
        'signed' => \Illuminate\Routing\Middleware\ValidateSignature::class,
        'throttle' => \Illuminate\Routing\Middleware\ThrottleRequests::class,
        'verified' => \Illuminate\Auth\Middleware\EnsureEmailIsVerified::class,
        'IsUsers' => \App\Http\Middleware\IsUser::class,
        'IsAdmin' => \App\Http\Middleware\IsAdmin::class,
        'IsDepartment' => \App\Http\Middleware\IsDepartment::class,
        'directRecruitment' => \App\Http\Middleware\directRecruitment::class,
        'FinancialAssistance' => \App\Http\Middleware\FinancialAssistance::class,
        'IsRso' => \App\Http\Middleware\IsRso::class,
        'IsMapping' => \App\Http\Middleware\IsMapping::class,
        'hostel' => \App\Http\Middleware\HostelMiddleware::class,
        'facility_booking' => \App\Http\Middleware\FacilityMiddleware::class,
        'player' => \App\Http\Middleware\PlayerMiddleware::class,
        'OnlineAdmission' => \App\Http\Middleware\OnlineAdmission::class,
        'OnlineAdmissionTest' => \App\Http\Middleware\OnlineAdmissionTest::class,
        'GymnasiumSwimming' => \App\Http\Middleware\GymnasiumSwimming::class,
        'StopScriptTags' => \App\Http\Middleware\StopScriptTags::class,
        'EklavyaKreedaKosh' => \App\Http\Middleware\EklavyaKridaKosh::class,
        'Information' => \App\Http\Middleware\InformationMiddleware::class,
        'CoachingCamp'=>\App\Http\Middleware\CoachingCamp::class,
        'PrivateCoaching'=>\App\Http\Middleware\PrivateCoaching::class,
        'EklavyaFund' => \App\Http\Middleware\EklavyaFund::class,
        
    ];
}
