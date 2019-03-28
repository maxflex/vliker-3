<?php

namespace App\Http\Controllers\Api\v1;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\User\UserResource;
use User;

class UsersController extends Controller
{
    public function index()
    {
        if (! User::loggedIn()) {
            User::tryCookieLogIn();
        }

        if (User::loggedIn()) {
            return new UserResource(User::fromSession());
        }
        return response(null, 204);
    }

    public function store(Request $request)
    {
        return new UserResource(
            User::createAndLogIn()
        );
    }
}
