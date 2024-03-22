<?php

namespace App\Http\Controllers\Auth;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Validator;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function show()
    {
        return view('auth.auth');
    }
    
    public function auth(Request $request)
    {

        $validator = Validator::make($request->all(), [
            'username' => 'required|string|min:1|max:50',
            'password' => 'required|min:4'

        ]);

        if($validator->fails()){
            return redirect()->back()->withErrors($validator)->withInput();
        }

        try {
            $user = User::create($request->all());
            auth()->login($user);

            return redirect()->route('main')->with('message', 'Добро пожаловать,</br>' . Auth::user()->username . '!');
        } catch (\Exception $e) {
            if ($e->getCode() == 23000) {
                if (Auth::guard()->attempt($request->only('username', 'password'))) {
                    $request->session()->regenerate();
                    return redirect()->route('main')->with('message', 'С возвращением, </br>' . Auth::user()->username . '!');
                } else {
                    return redirect()->back()->withInput()->withErrors(['username' => 'Пользователь с таким именем уже существует. Укажите другое имя или введите правильно пароль.']);
                }
            }
        }
    }
}