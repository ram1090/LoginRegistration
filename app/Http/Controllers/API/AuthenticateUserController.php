<?php

namespace App\Http\Controllers\API;

use Auth;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;

class AuthenticateUserController extends Controller
{
    public function authenticate(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if ($validator->fails()) {
            // return error if form validation will fail.
            return response()->json(['errors'=>$validator->errors()],422);
        }
        else{
            // if form successfully validated
            $credentials = $validator->validated();

            if (Auth::attempt($credentials)) {
                $user = Auth::user(); 
                $this->status = 'success';
                $this->response['user'] = $user;
                $this->response['token'] =  $user->createToken(strtolower($user->name)."_token")->plainTextToken; 
                return response()->json($this->response, 200); 
            }
            else{
                $this->response['status'] = 'error';
                $this->response['message'] = 'Invalid Credentials';
                return response()->json($this->response, 401); 
            }
        }
           
    }


    public function logout()
    {
        $user = Auth::user();
        $user->tokens()->delete();
        $this->response = [
            'message' => 'Successfully Loged Out !!'
        ];
        return response()->json($this->response, 200); 
    }
}
