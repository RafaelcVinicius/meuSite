<?php

namespace App\Exceptions;

use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\ItemNotFoundException;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use Throwable;

class Handler extends ExceptionHandler
{
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
        $this->renderable(function(ValidationException $e) {
            return response()->json([
                'type' => get_class($e),
                'message' => $e->getMessage(),
                'errors' => $e->validator->errors()
            ], 422);
        });

        $this->renderable(function(NotFoundHttpException $e) {
            return response()->json([
                'type' => get_class($e),
                'message' => $e->getMessage(),
            ], 404);
        });

        $this->renderable(function(ItemNotFoundException $e) {
            return response()->json([
                'type' => get_class($e),
                'message' => 'Item not found',
            ], 404);
        });

        $this->renderable(function(Throwable $e) {
            Log::error($e);
            return response()->json([
                'type' => get_class($e),
                'message' => $e->getMessage(),
            ], 500);
        });
    }
}
