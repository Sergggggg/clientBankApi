<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
//use Illuminate\Http\Request;
use Illuminate\Http\Response;
use App\Models\Service;
use App\Http\Resources\ServicesResource;
use App\Http\Resources\FactoryResource;
use App\Http\Resources\UserResource;
use App\Models\Factory;
use App\Models\User;
use DB;

class ServicesApiController extends Controller
{
    public function index()
	{
		$categories = Service::all();
	 
		return ServicesResource::collection($categories);
	}

	public function factory()
	{
		$factories = Factory::all();
	 
		return FactoryResource::collection($factories);
	}

	public function sendKey($data_id=null)
	{
		$key = User::where('id', $data_id['id'])->get();

		$data = UserResource::collection($key);

		$sending_key = $key->toArray();

		//$sending_key = json_decode($data, true);
		
		DB::table('client')->insert(['password' => $sending_key[0]['password'],]);

		return  $data; //UserResource::collection($key);
	}
}