<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Redirect;
use Session;
use App\User;
use Illuminate\Support\Facades\Hash;

class AdminController extends Controller
{
    public function login(Request $request){

    	if($request->isMethod('post')){
    		$data = $request->input();
    		if(Auth::attempt(['email'=>$data['email'],'password'=>$data['password'],'admin'=>'1'])){
    			//echo "Success";die;
                Session::put('adminSession',$data['email']);
                return redirect::action('AdminController@dashboard');
    		}
    		else{
    			//echo "Failed";die;
                return redirect('/admin')->with('flash_message_error','Invalid Username or Password');
    		}
    	}
    	return view('admin.admin_login');
    }

    public function dashboard(){
        if(Session::has('adminSession')){

        }
        else{
            return redirect('/admin')->with('flash_message_error','Please Login to Gain Access');
        }

        return view('admin.dashboard');
    }

    public function settings(){
        if(Session::has('adminSession')){

        }
        else{
            return redirect('/admin')->with('flash_message_error','Please Login to Gain Access');
        }

        return view('admin.settings');
    }

    public function checkPassword(Request $request){
            $data = $request->all();
            $current_password = $data['current_pwd'];
            $check_password = User::where(['admin'=>'1'])->first();
            if(Hash::check($current_password,$check_password->password)){
                echo "True";die;
            }else{
                echo "False";die;
            }
    }

    public function updatePassword(Request $request){
            if($request->isMethod("post")){
                $data = $request->all();
                //echo "<pre>"; print_r($data); die;
                $check_password = User::where(['email' => Auth::user()->email])->first();
                $current_password = $data['current_pwd'];
                if(Hash::check($current_password,$check_password->password)){
                    bcrypt($data['new_pwd']);
                    return redirect('/admin/settings')->with('flash_message_success','Password updated successfully');
                }else{
                    return redirect('/admin/settings')->with('flash_message_error','Incorrect Password');
                }
            }
    }

    public function logout(){
        Session::flush();
        return redirect('/admin')->with('flash_message_success','Logged Out Successfully');
    }

    public function donate(){
        return view('admin.donate');
    }

    public function index(){
        return view('admin.homepage');
    }

    public function about(){
        return view('admin.about');
    }

    public function domain(){
        return view('admin.domain');
    }

    public function hosting(){
        return view('admin.hosting');
    }

    public function blog(){
        return view('admin.blog');
    }

    public function contact(){
        return view('admin.contact');
    }
    
}