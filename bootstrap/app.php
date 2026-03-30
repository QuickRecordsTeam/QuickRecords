<?php

use App\Exceptions\BusinessValidationException;
use App\Exceptions\EmailException;
use App\Exceptions\ResourceNotFoundException;
use App\Exceptions\UnAuthorizedException;
use App\Http\Middleware\CanAuthenticate;
use App\Http\Middleware\IsAdminIsPresidentIsFinancialSecretary;
use App\Http\Middleware\IsAdminMiddleware;
use App\Http\Middleware\IsAdminOrIsTreasurer;
use App\Http\Middleware\IsAuditorMiddleware;
use App\Http\Middleware\IsAuthorizedToAccessPlatform;
use App\Http\Middleware\IsAuthorizedToCreateOrganisation;
use App\Http\Middleware\IsAuthorizedToSubscribe;
use App\Http\Middleware\IsElectionAdmin;
use App\Http\Middleware\IsFinancialSecretaryMiddleware;
use App\Http\Middleware\IsPresidentIsFinancialSecretaryIsTreasurerIsAdmin;
use App\Http\Middleware\isPresidentMiddleware;
use App\Http\Middleware\IsPresidentOrIsAdmin;
use App\Http\Middleware\isPresidentOrisFinancialSecretary;
use App\Http\Middleware\IsSystemAdminMiddleware;
use App\Http\Middleware\IsTreasurerMiddleware;
use App\Http\Middleware\IsTreasurerOrIsFinancialSecretary;
use App\Http\Middleware\IsTreasurerOrIsFinancialSecretaryOrIsPresident;
use App\Http\Middleware\IsUserMiddleware;
use App\Http\Middleware\SubscriptionMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| Create The Application
|--------------------------------------------------------------------------
|
| The first thing we will do is create a new Laravel application instance
| which serves as the "glue" for all the components of Laravel, and is
| the IoC container for the system binding all of the various parts.
|
*/

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__ . '/../routes/web.php',
        commands: __DIR__ . '/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        $middleware->alias([
            'isPresident'           => IsPresidentMiddleware::class,
            'isAdmin'               => IsAdminMiddleware::class,
            'isAuditor'             => IsAuditorMiddleware::class,
            'isFinancialSecretary'  => IsFinancialSecretaryMiddleware::class,
            'isTreasurer'           => IsTreasurerMiddleware::class,
            'isUser'                => IsUserMiddleware::class,
            'isPresidentOrIsFinancialSecretary' => IsPresidentOrisFinancialSecretary::class,
            'isTreasurerOrIsFinancialSecretary' => IsTreasurerOrIsFinancialSecretary::class,
            'isTreasurerOrIsFinancialSecretaryOrIsPresident' => IsTreasurerOrIsFinancialSecretaryOrIsPresident::class,
            'isElectionAdmin' => IsElectionAdmin::class,
            'IsPresidentIsFinancialSecretaryIsTreasurerIsAdmin' => IsPresidentIsFinancialSecretaryIsTreasurerIsAdmin::class,
            'isPresidentOrIsAdmin' => IsPresidentOrIsAdmin::class,
            'isAdminIsPresidentIsFinancialSecretary' => IsAdminIsPresidentIsFinancialSecretary::class,
            'IsAdminOrIsTreasurer' => IsAdminOrIsTreasurer::class,
            'isSystemAdmin' => IsSystemAdminMiddleware::class,
            'subscribed' =>  SubscriptionMiddleware::class,
            'isAuthorizedToAccessPlatform' =>  IsAuthorizedToAccessPlatform::class,
            'isAuthorizedToCreateOrganisation' =>  IsAuthorizedToCreateOrganisation::class,
            'isAuthorizedToSubscribe' =>  IsAuthorizedToSubscribe::class,
            'canAuthenticate' => CanAuthenticate::class
        ]);
        $middleware->statefulApi();
    })
    ->withExceptions(function (Exceptions $exceptions) {
        $exceptions->render(function (ResourceNotFoundException $e, Request $request) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 404);
        });

        $exceptions->render(function (BusinessValidationException $e, Request $request) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);
        });

        $exceptions->render(function (EmailException $e, Request $request) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 400);
        });

        $exceptions->render(function (UnAuthorizedException $e, Request $request) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 401);
        });
    })
    ->withBroadcasting(
        __DIR__ . '/../routes/channels.php',
        ['prefix' => 'api', 'middleware' => ['api', 'auth:sanctum']],
    )
    ->create();
