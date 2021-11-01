<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Redirect;
use App\Models\Service;
use DB;

class LanguageController extends Controller
{
    public function switchLang($lang)
    {
    	
        if (array_key_exists($lang, Config::get('languages'))) {
            Session::put('applocale', $lang);
        }
        return Redirect::back();
    }

    public function sent(Request $request){

    	$validatedData = $request->validate([
	    'text' => 'required|min:3|max:255',
	    'message' => 'required|min:3|max:1000',
	    'image' => 'required|image|mimes:jpeg,png,jpg,gif,svg',
		]);

		 $services = new Service;

    	 $services->title = $request->text;
    	 $services->body = $request->message;
    	 $services->lat = $request->lat;
    	 $services->lng = $request->lng;
    	 $services->user = $request->user;
    	 $services->user_id = $request->user_id;
  
    	if ($request->hasFile('image')){

	 		$path = $request->file('image');
	 		$photo = $path->getClientOriginalName();
			$destination = base_path() . '/public/uploads';
			$services->path_image = 'uploads/'.$photo;
			$request->file('image')->move($destination, $photo);
    	}

    	$services->save();

    	return redirect('/');
    }

      public function index()
    {
    	return view('home', ['services' =>DB::table('services')->orderBy('user')->get()]);
    }
    public function page($id)
    {	
    	return view('page', ['page' =>DB::table('services')->orderBy('user')->where('user_id', $id)->get()]);
    } 
}
