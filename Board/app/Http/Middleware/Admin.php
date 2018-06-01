<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
use App\Repository\UserRepository;

class Admin
{
    protected $oUserRepository;

    public function __construct(UserRepository $oUserRepository)
    {
        $this->oUserRepository = $oUserRepository;
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
        if (!Auth::User()->checkAdmin()) {
            return redirect('home');
        }

        // $password = \Hash::make('secret');var_dump($password);
        // $password = '$2y$10$uNX8GWQNoIM8co53qtuywOp0evUpQzgW7RXQHSsQkWoSUNaVBoag.';
        // $request->user()->fill([
        //     'password' => Hash::make($request->newPassword)
        // ]);
        // $password = \Hash::check('secret', $password);

        return $next($request);
    }
}
