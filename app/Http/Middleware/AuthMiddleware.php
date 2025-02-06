<?php
namespace App\Http\Middleware;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
class AuthMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        if (!auth()->check()) {
            return redirect('/login')->with('error', 'Anda harus login terlebih dahulu.');
        }
        return $next($request);
    }
    protected function redirectTo($request)
{
    if (!$request->expectsJson()) {
        return route('login'); // Arahkan user yang belum login ke halaman login
    }
}
}