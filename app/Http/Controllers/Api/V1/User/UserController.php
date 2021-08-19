<?php

namespace App\Http\Controllers\Api\V1\User;

use App\Http\Controllers\Controller;
use App\Http\Resources\Api\V1\User\UserCollection;
use App\Models\User;

class UserController extends Controller
{
    /**
     * @return UserCollection
     */
    public function index(): UserCollection
    {
        ray("Hello from Laravel!")->orange();
        return new UserCollection(User::query()->paginate());
    }
}
