<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class User extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {

        return [

            "id" => $this->id,
            "first_name" => $this->first_name,
            "last_name" => $this->last_name,
            "full_name" => $this->first_name." ".$this->last_name,            
            "email" => $this->email,
            "country_code" => $this->country_code,
            "mobile_number" => $this->mobile_number,
            "user_type" => $this->user_type,
            "token" => $this->token,
            "is_mobile_verified" => $this->is_mobile_verified,
            "is_email_verified" => $this->is_email_verified,
            "device_type" => $this->device_type,
            "created_at" => $this->created_at,
            "updated_at" => $this->updated_at,
        ];
    }
}
