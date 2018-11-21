<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
//use Monolog\Logger;

use Illuminate\Log\Logger;

final class LogMiddleware
{


    private $logger;

    public function __construct(Logger $logger) {
    $this->logger = $logger;
    }


    public function handle(Request $request, Closure $next)
    {

//        dd($request->query());
//    $this->logger->info('Dump request', [
//    'request_ip' => $request->ip(),
//    'user' => auth()->user(),
//    'machine_user' => $request->server('USER'),
//    'machine_type' => $request->server('HTTP_USER_AGENT'),
//    'from' => $request->header('referer'),
//    'page' => $request->url(),
//    'query' => $request->query(),
//    ]);
    return $response = $next($request);

    }
}