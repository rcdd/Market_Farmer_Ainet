<?php namespace app\Http\Middleware;

use Closure;
use Illuminate\Contracts\Auth\Guard;

class IsOwn {

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
        //return var_dump($request->id);
        if($this->auth->user()->id != $request->id)
        {
            session()->flash('error','Resource not allowed to you!');
            return redirect('/home');
        }
        return $next($request);
    }

}