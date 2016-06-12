<?php namespace app\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;
use Auth;

class IsAdmin {

    /**
     * The Guard implementation.
     *
     * @var Guard
     */
    protected $auth;

    /**
     * Create a new filter instance.
     *
     * @param  Guard  $auth
     * @return void
     */
    public function __construct(Guard $auth)
    {
        $this->auth = $auth;
    }

    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    { 
        if (Auth::guest()) {

            return redirect('/');
        }
        if(!$this->auth->user()->admin)
        {
            session()->flash('error','This resource is restricted to Administrators!');
            return redirect('/home');
        }
        return $next($request);
    }

}