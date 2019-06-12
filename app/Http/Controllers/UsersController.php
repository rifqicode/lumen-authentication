<?php

namespace App\Http\Controllers;
use \Illuminate\Http\Request;
use App\User;
use App\Api\Key;
use Validator;
use Illuminate\Support\Facades\Hash;

class UsersController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

    public function __construct(User $user , Key $key)
    {
      $this->user = $user;
      $this->key = $key;
    }

    public function authentication(Request $request)
    {
      $validateKey = $this->key->validate($request->input('_key'));
      if (!$validateKey) {
        return response()->json(['status' => 401 , 'message' => 'Invalid apikey']);
      }

      $validatedData = Validator::make($request->all() , [
          '_email' => 'required|string',
          '_password' => 'required|min:6|string'
      ]);

      if ($validatedData->fails()) {
        $errorMessages = ['status' => 500 , 'message' => $validatedData->messages()];
        return response()->json($errorMessages);
      }

      $dataRequest = $request->only('_email' , '_password');
      $checkUser = $this->userCheck($dataRequest);
      return $checkUser;
  }

  private function userCheck($request)
  {
    $check = $this->user->where('email' , $request['_email'])->first();

    if (Hash::check($request['_password'] , $check->password)) {
      $update = ['api_token' => $this->apiToken($request['_email'])];

      $this->user->where('email' , $request['_email'])->update($update);
      return ['status' => 200 , 'api_key' => $update['api_token']];
    }

    return ['status' => 500 , 'message' => 'Incorrect username or password'];
  }

  private function apiToken(string $p)
  {
    return Hash::make('key-' . $p);
  }

}
