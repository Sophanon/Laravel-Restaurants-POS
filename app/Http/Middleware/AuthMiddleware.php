<?php

namespace App\Http\Middleware;

use App\Models\UserLoginAccess;
use Carbon\Carbon;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class AuthMiddleware
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
                    $login_access->expired_at = Carbon::now()->addDay();
                    $login_access->save();
                    auth()->loginUsingId($login_access->user_id);
                    return $next($request);
                }
            }
        }
        session([
            'access_token' => null
        ]);
        return redirect(route('login'));
    }
}
