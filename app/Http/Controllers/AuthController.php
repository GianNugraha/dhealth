<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Crypt;


class AuthController extends Controller
{

    // ============== users login / register / reset password / management ==================================================
    public function logout() 
    {
        session()->flush();
        return redirect(route('login'))->with('success', 'You has been logout.');
    }
     
    public function login() 
    {
        if(!empty(session()->get('status'))) {
           //return redirect('/home');
           return redirect()->route('home');
        }
        return view('pages.auth.login');
    }

    public function proses_login(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');
        // Step 1 cek form 
        if(isset($username) || isset($password)) 
        {
            $results = DB::select('select * from tbl_user where username = :username and password = :password', [
                    'username' => $username,
                    'password' => $password,
                ]);
            // Step 2 cek data user terdaftar atau tidak terdaftar di dtabase
            if($results != NULL)
            {
                $status = 'loged in';
                $userid = $results[0]->id;
                $nama_lengkap = $results[0]->fullname;
                $username = $results[0]->username; 
                session()->put('status', $status);
                session()->put('fullname', $nama_lengkap);
                session()->put('userid', $userid);
                session()->put('username', $username);
                return redirect('/home');

            }
            else
            {
                session()->flash('error', 'Account not registred !');
                return redirect()->back();
            }
        }
        else
        {
            session()->flash('error', 'Username and password can`t empty!');
            return redirect()->back();
        }
    }

    public function proses_register(Request $request)
    {
        $username = $request->input('username');
        $password = $request->input('password');
        // Step 1 cek user
            if(isset($username) || isset($password)) 
            {
                if($request->input('password') === $request->input('confirmation_password'))
                {
                    $results = DB::select('select * from tbl_user where username = :username', [
                        'username' => $username
                    ]);


                    // Step 2 cek data user terdaftar atau tidak terdaftar di dtabase
                    if($results == NULL)
                    {
                        $username = $request->input('username');
                        $fullname = $request->input('fullname');
                        $password = $request->input('password');
                        $email = $request->input('email');

                        $data=array('username'=>$username,'password'=>$password,'fullname'=>$fullname, 'email'=>$email);
                        DB::table('tbl_user')->insert($data);
                       
                        return redirect()->route('login')
                            ->with('success', 'Pendaftaran User Berhasil !');
                    }
                    else
                    {
                        session()->flash('error', 'Username sudah digunakan !');
                        return redirect()->back();
                    }
                }
                else
                {
                    session()->flash('error', 'Kombinasi Password dan konfirmasi Password tidak cocok !');
                        return redirect()->back();
                }
            }
            else
            {
                session()->flash('error', 'Username and password can`t empty!');
                return redirect()->back();
            }
    }

    
    public function registration() 
    {
        return view('pages.auth.register');
    }
    public function filldata() 
    {
        return view('pages.auth.filldata');
    }


}