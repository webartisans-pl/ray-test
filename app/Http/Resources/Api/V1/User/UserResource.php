<?php

namespace App\Http\Resources\Api\V1\User;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param Request $request
     * @return array
     */
    public function toArray($request)
    {
        /**
         * @var User $user
         */
        $user = $this->resource;

        return [
            'id' => $user->getKey(),
            'first_name' => $user->first_name,
            'last_name' => $user->first_name,
            'email' => $user->email,
        ];
    }
}
