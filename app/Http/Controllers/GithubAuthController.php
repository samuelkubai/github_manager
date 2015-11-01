<?php

namespace App\Http\Controllers;

use App\Gm\Auth\AuthenticateUser;
use Illuminate\Http\Request;

use App\Http\Requests;
use App\Http\Controllers\Controller;
use Illuminate\Http\Response;
use Laravel\Socialite\Facades\Socialite;
use Tymon\JWTAuth\Facades\JWTAuth;

class GithubAuthController extends Controller implements AuthenticateUserListener
{
    /**
     * Display the login page for the user.
     *
     * @return \Illuminate\Http\Response
     */
    public function login()
    {
        return view('gm.auth.login');
    }

    /**
     * Redirect to github servers to authorise access.
     *
     * @param AuthenticateUser $authenticateUser
     * @param Request $request
     * @return mixed
     */
    public function authorise(AuthenticateUser $authenticateUser, Request $request)
    {
        return $authenticateUser->authenticate((bool) $request->has('code'), $this);
    }

    /**
     * Return authenticated user after authentication
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function handleAuthenticatedUser()
    {
        return redirect('/');
    }

    /**
     * Returns the authenticated user with their jwt token.
     *
     * @return mixed
     */
    public function getAuthenticatedUserWithToken()
    {
        //Get authenticated user.
        $user = \Auth::user();

        //Generate the jwt token for the user.
        $token = JWTAuth::fromUser($user);

        $userData = [
            'user' => $user,
            'token' => $token,
        ];
        return response()->json($userData);
    }
}
