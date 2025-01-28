<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/';

    public function auth(User $user, Request $request){
        $credenciais = request()->validate([
            'email' => ['required'],
            'password' => ['required'],
            'unidade_id' => ['required']
        ]);
        if(Auth::attempt($credenciais)){
            request()->session()->regenerate();
            return redirect()->intended('/');
        }else{
            $request->session()->flash('alert-danger','Credenciais incorretas');
            return redirect()->intended('/login');
        }
    }

    public function logout(){
        auth()->logout();
        return redirect('/');
    }

    public function index(){
        if(auth()->check()){
            return redirect('/');
        }
        return view('user.login');
    }

    public function registrar(){
        return view('user.create');
    }

    public function store(Request $request, User $user){
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->unidade_id = $request->unidade;
        $user->save();
        return redirect('/');
    }

}
