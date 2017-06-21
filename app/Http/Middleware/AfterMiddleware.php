<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Http\JsonResponse;

class AfterMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Request $request
     * @param  Closure $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        $status_code = $response->getStatusCode();

        if ($status_code != 200 && !($response instanceof JsonResponse)) {
            $error = $this->getErrorMessage($response);
            $response->setContent($error);
        }

        return $response->header('Status', $response->getStatusCode());
    }

    /**
     * Get error message
     *
     * @param Response $response
     * @return string
     */
    private function getErrorMessage($response)
    {
        $status_code = $response->getStatusCode();

        $message = "ERROR $status_code : " . Response::$statusTexts[$status_code];

        if (property_exists($response, "exception") && $response->exception && !empty($response->exception->getMessage())) {
            $message = $response->exception->getMessage();
        }

        return $message;
    }
}
