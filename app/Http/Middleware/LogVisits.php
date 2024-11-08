<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use App\Models\Visits;
use Str;

class LogVisits
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $SubUrl = $request->fullUrl();
        $Url_New = '';

        if ($SubUrl) {
            $trimmedUrl = Str::after($SubUrl, 'https://prop.chaixi.co.th');
            if ($trimmedUrl === '/' || $trimmedUrl === '/main') {
                $Url_New = 'View';
                } else if ($trimmedUrl === '/search') {
                    $Url_New = 'Search';
                } else if ($trimmedUrl === '/history') {
                    $Url_New = 'History';
            } else {
                $Url_New = 'History';
            }
        }

        Visits::create([
            'Action' => $Url_New,
            'Ip' => $request->ip(),
            'User_Agent' => $request->userAgent(),
            'Url' => $request->fullUrl(),
        ]);
        return $next($request);
    }
}
