<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(Request): (Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!$request->user()) { //artinya: mengambil user yg sedang login
            return redirect()->route('login'); //kalau belum login, arahin ke halaman login
        }
        if (!in_array($request->user()->role, $roles)) { //Mengambil role user login.
            abort(403);
        }
        return $next($request);
    }
}
