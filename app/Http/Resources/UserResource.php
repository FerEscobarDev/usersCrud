<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'lastname' => $this->lastname,
            'cedula' => $this->cedula,
            'country' => $this->country,
            'address' => $this->address,
            'mobil' => $this->mobil,
            'email' => $this->email,
            'category' => CategoryResource::make($this->category)
        ];
    }
}
