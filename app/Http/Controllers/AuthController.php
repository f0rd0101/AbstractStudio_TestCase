<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegistrationRequest;
use App\Http\Services\AuthService;


class AuthController extends Controller
{
    protected AuthService $authService;

    public function __construct(AuthService $authService){
        $this->authService = $authService;
    }


    public function register(RegistrationRequest $request){
        $validatedBody = $request->validated();

        $res = $this->authService->registerUser($validatedBody);
        return  response()->json($res,200);


    }
    //  public function test(){
    //     return response()->json(['message'=>'hello world']);
    // }
}
