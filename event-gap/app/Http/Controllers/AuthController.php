<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Helper\Responses;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    public function indexLogin(){
        return view('page.Auth.login');
    }

    public function checkLogin(Request $request){
        $this->validate($request, [
            'email' => 'required',
            'password' => 'required',
        ]);

        $credentials = $request->only('email', 'password');

        if (Auth::attempt($credentials)) {
            if(Auth::user()->isAdmin == 1){
                return redirect('/admin-page/dashboard');
            }else{
                return redirect('/dashboard');    
            }
        } else {
            return redirect('/login')->with('alert-fail','Email / password yang anda masukan salah!');
        }
    }
    
    public function indexRegister(){
        return view('page.Auth.register');
    }

    public function postRegister(Request $request){
        $this->validate($request,[
            'nama' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'hp' => 'required'
        ]);

        $checkEmail = User::where('email','=',$request->email)->first();
        if($checkEmail == null){
            $data = new User();
            $data->nama = $request->nama;
            $data->email = $request->email;
            $data->password = bcrypt($request->password);
            $data->hp = $request->hp;
            $data->save();
    
            return redirect('/login')->with ('alert-success','Berhasil Membuat Akun !');
        }
        else{
            return redirect('/register')->with('alert-fail','Email Sudah Terdaftar!');
        }
        
    }

    public function logout(){
        Auth::logout();
        return redirect('/')->with('alert-logout','Berhasil Logout!');
    }
}

