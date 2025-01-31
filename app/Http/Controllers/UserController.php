<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Unidade;
use Illuminate\Support\Facades\Hash;
use App\Http\Requests\UserRequest;

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
            $request->session()->regenerate();
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

    public function registrar(Unidade $unidades){
        return view('user.create', ['user' => new User, 'unidades' => $unidades]);
    }

    public function store(UserRequest $request, User $user){
        $validated = $request->validated();
        User::create($validated);
        return redirect('/');
    }

}
