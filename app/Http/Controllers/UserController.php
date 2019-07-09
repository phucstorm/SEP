<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\http\Requests;
use Auth;
use App\User;
class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index(){
        return view('user');
    }

    public function edit_user_info(Request $request){ 
        $user = User::find($request->id);
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        return response()->json($user);
    }

    public function edit_user_password(Request $request){ 
        $validator = "Mật khẩu hiện tại không đúng";
        $user = User::find($request->id);
        if(password_verify( $request->current_pass, $user->password)){
            $user->password = bcrypt($request->password);
            $user->save();
            return response()->json($user);
        }else{
            return $validator;
        }     
    }
}
