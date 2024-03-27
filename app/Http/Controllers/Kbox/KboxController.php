<?php

namespace App\Http\Controllers\Kbox;

use App\Http\Controllers\Controller;
use App\Http\Requests\Auth\LoginRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class KboxController extends Controller
{
    public function index()
    {
        return view("kbox.index");
    }

    public function login(LoginRequest $request): RedirectResponse
    {
        $request->authenticate();
        $request->session()->regenerate();
        return redirect("/kbox");
    }

    /**
     * Destroy an authenticated session.
     */
    public function logout(Request $request): RedirectResponse
    {
        if(Auth::check()){
            Auth::guard('web')->logout();
            $request->session()->invalidate();
            $request->session()->regenerateToken();
        }
        return redirect('/kbox');
    }


    public function user_index()
    {
        $data   =   array(
            "users" =>  User::whereHas("categories", function($query){
                $query->whereCategory("kbox");
            })->get(),
        );
        return view("kbox.user.index", $data);
    }

    public function user_show($user_id)
    {
        $user   =   User::find($user_id);
        if($user->category("kbox")){
            $data   =   array(
                "user"  =>  $user,
            );
            return $user;
            // return view("kbox.user.show", $data);
        } else {
            return back();
        }
    }
}
