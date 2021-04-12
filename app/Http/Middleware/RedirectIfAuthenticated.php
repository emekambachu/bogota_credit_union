<?php

namespace App\Http\Middleware;

use App\Providers\RouteServiceProvider;
use Closure;
use Illuminate\Support\Facades\Auth;

use Carbon\Carbon;
use Illuminate\Support\Facades\Mail;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if ($guard === 'admin') {
            if (Auth::guard($guard)->check()) {
                return redirect()->route('admin');
            }
        } else if (Auth::guard($guard)->check() && auth()->user()->is_active === 1) {

//                    // current date using laravel carbon
//                    $now = Carbon::now();
//                    $time = $now->toDayDateTimeString();
//
//                    //Get current ip
//                    $ip = \Request::ip();
//
//                    $data = [
//                        'name' => auth()->user()->fname.' '.auth()->user()->lname,
//                        'time' => $time,
//                        'ip' => $ip,
//                        'email' => auth()->user()->email
//                    ];
//
//                    session()->put('time', $data['time']);
//
//                    Mail::send('emails.login', $data, function ($message) use ($data) {
//                        $message->from('info@bogotacreditunion.com', 'Bogota Credit Union');
//                        $message->to($data['email'], $data['name'])->cc('info@bogotacreditunion.com');
//                        $message->replyTo('info@bogotacreditunion.com', 'Bogota Credit Union');
//                        $message->subject('Login Session '.$data['time']);
//                    });

            return redirect()->route('users');
        }

        return $next($request);
    }
}
