<?php

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Http\Exceptions\ThrottleRequestsException;
use Symfony\Component\HttpFoundation\Response;
use Throwable;
use App\Traits\ResponseTrait;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Validation\UnauthorizedException;

class Handler extends ExceptionHandler
{
    use ResponseTrait;

    /**
     * A list of exception types with their corresponding custom log levels.
     *
     * @var array<class-string<\Throwable>, \Psr\Log\LogLevel::*>
     */
    protected $levels = [
        //
    ];

    /**
     * A list of the exception types that are not reported.
     *
     * @var array<int, class-string<\Throwable>>
     */
    protected $dontReport = [
        //
    ];

    /**
     * A list of the inputs that are never flashed to the session on validation exceptions.
     *
     * @var array<int, string>
     */
    protected $dontFlash = [
        'current_password',
        'password',
        'password_confirmation',
    ];

    /**
     * Register the exception handling callbacks for the application.
     */
    public function register(): void
    {
        $this->reportable(function (Throwable $e) {
            //
        });
    }

    public function render($request, Throwable $exception)
    {
        $responses = $this->requestResponses();

        if ($exception instanceof ThrottleRequestsException) {
            $errorCode = Response::HTTP_TOO_MANY_REQUESTS;

            $result = $responses + $this->responseErrors($errorCode, Response::$statusTexts[$errorCode], trans('auth.throttle', ['seconds' => 60]));

            return response()->json($result, $errorCode);
        }

        if ($exception instanceof AuthenticationException) {
            $errorCode = Response::HTTP_UNAUTHORIZED;

            $result = $responses + $this->responseErrors($errorCode, Response::$statusTexts[$errorCode], trans('auth.unauthorized_access'));

            return response()->json($result, $errorCode);
        }

        return parent::render($request, $exception);
    }
}
