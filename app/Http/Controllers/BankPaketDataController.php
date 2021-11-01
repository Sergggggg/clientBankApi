<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class BankPaketDataController extends Controller
{

	/**
     * Authorization in client app 
     */
    public function oauthApp(){

	    if (isset($_REQUEST['code']) && $_REQUEST['code']){

	    $ch = curl_init();
	    $url = 'http://127.0.0.1:8003/oauth/token';
	 
	    $params = array(
	        'grant_type' => 'authorization_code',
	        'client_id' => '76',
	        'client_secret' => 'mS6OH9XQtTUSiLrGvOnlQXEIR4sX5dFVv6afQDPT ',
	        'redirect_uri' => 'http://site/bank/paket',
	        'code' => $_REQUEST['code']
	    );	 
	    curl_setopt($ch,CURLOPT_URL, $url);
	    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	 
	    $params_string = '';
	 
	    if (is_array($params) && count($params))
	    {
	        foreach($params as $key=>$value) {
	            $params_string .= $key.'='.$value.'&';
	        } 
	        rtrim($params_string, '&');

	        curl_setopt($ch,CURLOPT_POST, count($params));
	        curl_setopt($ch,CURLOPT_POSTFIELDS, $params_string);
	    }
	 
	    $result = curl_exec($ch);

	    curl_close($ch);
	    $response = json_decode($result);

	    if($response)
	    	$this->getBankPaketData($response);
		else echo 'Your authentication failed'; 
    
		}
    }

    /**
     * Get data from client app
     */
    
    public function getBankPaketData($response){

    	// check if the response includes access_token
	    if (isset($response->access_token) && $response->access_token)
	    {
	        // you would like to store the access_token in the session though...
	        $access_token = $response->access_token;
	 
	        // use above token to make further api calls in this session or until the access token expires
	        $ch = curl_init();
	        $url = 'http://127.0.0.1:8003/api/oauth';
	         //'http://127.0.0.1:8002/api/text';
	        $header = array(
	        'Authorization: Bearer '. $access_token,
	        "content-type: application/xml",
	        "accept: application/xml",
	        );
	        $query = http_build_query(array('uid' => '1'));
	 
	        curl_setopt($ch,CURLOPT_URL, $url . '?' . $query);
	        curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
	        curl_setopt($ch, CURLOPT_HTTPHEADER, $header);
	        $result = curl_exec($ch);
	        curl_close($ch);
	        $response = json_decode($result, true);

	        if($response)
	        	$this->saveBankPaketData($response); 
	    }
	    else
	    {
	        echo 'Cannot get data from client app'; 
	    }

    }

    /**
     *  save data into database
     */

    public function saveBankPaketData($response){

    	DB::table('bank')->insert(['password' => $response[0]['password'],]);
    	
    	echo 'Data saved in database';
    }
}
