<?php
/**
 * Created by PhpStorm.
 * User: wizxs
 * Date: 10/31/2015
 * Time: 3:27 PM
 */
namespace App\Http\Controllers;

use App\Gm\Auth\AuthenticateUser;
use Illuminate\Http\Request;

interface AuthenticateUserListener
{
    /**
     * Return authenticated user response containing the JWT token.
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function handleAuthenticatedUser();
}