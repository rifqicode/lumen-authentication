<?php

namespace App\Http\Controllers;
use \Illuminate\Http\Request;

class ExampleController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {

    }

    public function welcomeMessage($name = 'Mr.Unknown' , Request $request)
    {
      return response()->json(['error' => 'Unauthorized'], 401);
    }
}
