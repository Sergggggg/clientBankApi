<?php

namespace App\Http\Controllers\Api\Auth;

use Laravel\Passport\Passport;
use Laravel\Passport\Client;
use Laravel\Passport\Token;
use Laravel\Passport\AuthCode;

//use Laravel\Passport\PersonalAccessClient;
use Laravel\Passport\ClientRepository;

//use App\Models\Passport\PersonalAccessClient;
use Illuminate\Support\Str;
use App\Http\Controllers\Controller;
use App\Models\User;
use DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Redirect;
use Laravel\Passport\HasApiTokens;



class AuthController extends Controller
{
    /**
     * Authorization and get token to get api 
     */

    public function get_api(Request $request, ClientRepository $ClientRepository)
    {
        $loginData = $request->validate([
            'email' => 'email|required',
            'password' =>'required',
             // 'redirect'     =>'required|url',
             // 'name' => 'required',
        ]);

        if (!auth()->attempt($loginData)){
            return response(['message' => 'Invalid Credentials']);
        }else{

            $oauth_clients = /*User::find(1)*/DB::table('oauth_clients')->where('user_id', Auth::user()->id)->first();

            if($oauth_clients === null){

            $oauth_clients =  Passport::client()->forceFill([
                             'user_id'                => Auth::user()->id, //$users[0]->id,
                             'name'                   => $request->name,
                             'secret'                 => Str::random(40),
                             'redirect'               => $request->redirect,
                             'personal_access_client' => false,
                             'password_client'        => false,
                             'revoked'                => false,
                         ]);
             
                $oauth_clients->save();
            }

        }
        
        return Redirect::to("/access/api")->with(['oauth_clients' =>(array) $oauth_clients]);

    }

    /**
     *  Redirect to authorize app  
     */

    public function redirect(Request $request){

            $request->validate([
                'number' => 'required',
                'key' =>'required',
                'redirect'     =>'required|url',
            ]);

            $query = http_build_query(array(
            'client_id' => $request->number,
            'redirect_uri' => $request->redirect,
            'response_type' => 'code',
            'client_secret' => $request->number,
            'scope' => ''
            ));
        return redirect('http://127.0.0.1:8003/oauth/authorize?'.$query);
    } 
}
