<?php

namespace App\Http\Middleware;

use App\Models\User\UserActivity;
use App\Repositories\UserActivityRepository;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Gate;

class AdminAuth
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        $user = auth()->user();
        if (!empty($user) && auth()->user()->remember_token) {
            $userActivityToday = UserActivityRepository::hasActivityToday(auth()->user()->id);
            if (!$userActivityToday) {
                $userActivity = new UserActivity();
                $userActivity->action_type = 'login';
                $userActivity->user_id = $user->id;
                $userActivity->save();
            }
        }

        if (auth()->user() && auth()->user()->can('access_administration_pages')) {
            return $next($request);
        }
        elseif(auth()->user()) {
            abort(403,'Потребител '.auth()->user()->email.' няма достъп до администраторския панел.');
        }
        else {
            return redirect(route('login'), 302);
        }
    }

}
