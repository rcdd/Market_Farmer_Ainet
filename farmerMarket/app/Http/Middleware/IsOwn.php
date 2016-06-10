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
        //return var_dump($this->auth->user()->admin);
        $allowed = false;
        if($this->auth->user()->admin){
            $allowed = true;
        }else if($this->auth->user()->id == $request->id)
        {
            $allowed = true;
        }

        if($allowed = true){
            return $next($request);
        }else{  
            session()->flash('error','Resource not allowed to you!');
            return redirect('/home');
        }

       
    }

}