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
        /*
                هنا هرجع شكل الداتا اللى انا عاوزها لل response الحاجه اللى انا محددها جوا ال array فقط
          */
        return [
          'id'  => $this->id,
          'user_name'  => $this->user_name,
          'email'  => $this->email,
          'date_of_birth'  => $this->date_of_birth,
          'phone_number'  => $this->phone_number,
          'password'  => $this->password,
        ];
    }
}
