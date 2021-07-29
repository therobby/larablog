<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Hash;
use App\Models\User;

class UserController extends Controller
{
    use AuthenticatesUsers;
    //

    public function auth(Request $request) {

        if($request->has(['email', 'password'])){
            $email = $request->input('email');

            $rules = [
                'email' => 'required|email',
                'password' => 'required|alphaNum|min:4',
            ];
            // return "asda";

            $request->validate([
                'email' => 'required|email',
                'password' => 'required|alphaNum|min:4',
            ]);

            $cred = $request->only('email', 'name', 'password');

            if(auth()->attempt($cred)){
                return redirect('/');
            } else {
                return back()->withInput()->withErrors('Wysłane dane są nieprawidłowe');
            }
        } else {
            return redirect('/login');
        }
    }

    public function showLogin() {
        return view('user.login');
    }

    public function registerUser(Request $request) {

        if($request->has(['email', 'name', 'password'])){
            $email = $request->input('email');
            $name = $request->input('name');
            $password = $request->input('password');

            $rules = [
                'email' => 'required|email',
                'password' => 'required|alphaNum|min:4',
            ];

            $request->validate([
                'email' => 'required|email',
                'password' => 'required|alphaNum|min:4',
            ]);

            $newUser = new User;
            $newUser->name = $name;
            $newUser->email = $email;
            $newUser->password = Hash::make($password);

            $newUser->save();
        
            return redirect('/login');
        } else {
            return redirect('/register');
        }
    }

    public function showRegister() {
        return view('user.register');
    }
}
