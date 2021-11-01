<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

use Illuminate\Http\Resources\Json\ResourceCollection;



class FactoryResource extends JsonResource
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
        //JsonResource::withoutWrapping();

  
    return [
      'id' => $this->id,
      'name' => $this->name,
      'price' => $this->price,
      'bedrooms' => $this->bedrooms,
      'bathrooms' => $this->bathrooms,
      'storeys' => $this->storeys,
      'garages'=> $this->garages,
     ];
        //return parent::toArray($request);
    }
}
