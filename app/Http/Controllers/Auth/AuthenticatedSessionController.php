<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Providers\RouteServiceProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\View\View;

class AuthenticatedSessionController extends Controller
{
    /**
     * Display the login view.
     */
    public function create(): View
    {
        Redirect::setIntendedUrl(url()->previous());
        return view('auth.login');
    }

    /**
     * Handle an incoming authentication request.
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        
        $request->authenticate();

        $request->session()->regenerate();
       
        if ($request->user()->role === 'admin') {
            $url = RouteServiceProvider::ADMIN;
        } elseif ($request->user()->role === 'agent') {
            $url = RouteServiceProvider::AGENT;
        } elseif ($request->user()->role === 'user') {
           // $url = RouteServiceProvider::USER;
           $url = Session::get('url.intended');           
        } else {
            $url = RouteServiceProvider::HOME;
        }

            $notification =array(
            'message' =>  'User '.$request->user()->name.' Login Successfully',
            'alert-type' => 'info'
         );
        return redirect()->intended($url)->with($notification);
    }

    /**
     * Destroy an authenticated session.
     */
    public function destroy(Request $request): RedirectResponse
    {
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();
        $notification =array(
            'message' =>  'User Logout Successfully',
            'alert-type' => 'success'
         );
        return redirect('/')->with($notification);
    }
}
