<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
// use JWTAuth;
use Tymon\JWTAuth\Facades\JWTAuth;
use Tymon\JWTAuth\Exceptions\JWTException;

class UserController extends Controller
{
    public  function createUser(Request $request)
            
    {       echo("done");
            $user=$request->all();
            $user['password']=Hash::make($user['password']);
            $users=User::create($user);
            $data=['message'=>'user added'];
            $data['status']=true;
            $data['data']=$users;
            return $data;
        }


    public function login(Request $request){
            $email=$request->input('email');
            $password=$request->input('password');
            $user = User::where('email', '=', $email)->first();
            if (!$user) {
            return response()->json(['success'=>false, 'message' => 'Login Fail, please check email id']);
         }
         if (!Hash::check($password, $user->password)) {
               return response()->json(['success'=>false, 'message' => 'Login Fail, pls check password']);
            }
               return response()->json(['success'=>true,'message'=>'success', 'data' => $user]); 
            }


            public function loginn(Request $request)
            {
                $input = $request->only('email', 'password');
                $jwt_token = null;
        
                if (!$jwt_token = JWTAuth::attempt($input)) {
                    return response()->json([
                        'success' => false,
                        'message' => 'Invalid Email or Password',
                    ], Response::HTTP_UNAUTHORIZED);
                }
                $user = JWTAuth::user();
                $data=['message'=>'Login ok'];
                $data['data']=$user;
                $data['data']['token']=$jwt_token;
                return $data;



                // $user = JWTAuth::user();
                // echo($user);
                // return response()->json([
                //     'success' => true,
                //     'token' => $jwt_token,
                // ]);
            }
            public function au(Request $request)
            {$user = JWTAuth::user();
                echo($user->name);
            
                // $user=User::all();
                // $data=['status'=>true];
                // $data['message']="Here is list of All Student";
                // $data['data']=$user;
                // return $data;
            }


















        }
