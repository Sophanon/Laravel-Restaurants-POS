<?php

namespace App\Http\Middleware;

use App\Models\UserLoginAccess;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LoginModdleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if (session('access_token')) {
            $token = session('access_token');
            $login_access = UserLoginAccess::where('access_token', $token)->first();
            if ($login_access) {
                if (Carbon::parse($login_access->expired_at) > Carbon::now()) {
                    return redirect(route('user_list'));
                }
            }
        }
        return $next($request);
    }
}
