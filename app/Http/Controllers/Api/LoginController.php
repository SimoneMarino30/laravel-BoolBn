<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

use Exception;

class LoginController extends Controller
{
    public function login()
    {
        if(request()->input('user_id'))
        $userd_id= request()->input('user_id');

        $userDetail = User::where('id', $userd_id)->with('user_detail')->firstOrFail();

        $user= [];
        $user['email']= $userDetail['email'];
        $user['name']= $userDetail['user_detail']['name'];
        $user['surname']= $userDetail['user_detail']['surname'];

        // $response = [
        //     'success' => true,
        //     'code' => 200,
        //     'message' => 'L\'API funziona',
        //     'user' => $user
        // ];

        // ? SE DOVESSI RICEVERE ERRORE, AGGIUNGERE try{...} catch(Exception $e){...} PER CAPIRE QUAL'E' IL PROBLEMA

        return response()->json($user);
    }
}