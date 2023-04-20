<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class UserController extends Controller
{
    public function register(Request $request)
    {
        $rules=array(
            'name' => 'required',
            'email_address' => "required|email|unique:users,email_address,",
            'password' => 'required|min:8',
            'password_confirmed' => 'required|min:8|same:password'
        );
        $validator=Validator::make($request->all(), $rules);
        if ($validator->fails()) {
            return response()->json($validator->errors(), 403);
        } else {
            $user = new User();
            $user->name=$request->name;
            $user->email_address=$request->email_address;
            $user->password=Hash::make($request->password);

            $result=$user ->save();

            if ($result) {
                return ["Result"=>"User registered successfully"];
            } else {
                return ["Result"=>"Data not regu successfully",$validator->errors()];
            }
        }
    }
    public function login(Request $request)
    {
        $user = User::where('email_address', $request->email_address)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json(['message' => 'These credentials do not match our records.'], 404);
        }

        $token = $user->createToken('my-app-token');

        $accessToken = $token->accessToken;
        $tokenType = 'Bearer';
        $expiresAt = $token->token->expires_at;

        return response()->json([
            'message' => 'Login successful. Welcome!',
            'data' => $user,
            'access_token' => $accessToken,
            'token_type' => $tokenType,
            'expires_at' => $expiresAt,
        ]);
    }

    public function update(Request $request)
    {
        $user = User::find($request->id);
        $user->name=$request->name;
        $user->email_address=$request->email_address;
        $user->password=Hash::make($request->password);
        $result=$user->save();
        if ($result) {
            return ["Result"=>"User updated successfully"];
        } else {
            return ["Result"=>"Data not updated successfully"];
        }
    }

    public function delete($id)
    {
        $user = User::find($id);
        $result=$user->delete();
        if ($result) {
            return ["Result"=>"User deleted successfully"];
        } else {
            return ["Result"=>"Data not deleted successfully"];
        }
    }

    public function profile()
    {
        return auth()->user();
    }


    public function logout()
    {
        $user = auth()->user();
        $user->tokens()->delete();
        return response()->json(['message' => 'Logged out successfully.'], 200);
    }

     public function getUsers()
     {
         return User::all();
     }

}
