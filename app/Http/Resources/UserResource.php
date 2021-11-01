<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use Illuminate\Http\Resources\Json\ResourceCollection;



class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    
    public static $wrap = 'results';

    public function toArray($request)
    {
        JsonResource::withoutWrapping();

  
    return [
      //'id' => $this->id,
      //'title' => $this->title,
      'password' => $this->password,
     ];
        //return parent::toArray($request);
    }
}