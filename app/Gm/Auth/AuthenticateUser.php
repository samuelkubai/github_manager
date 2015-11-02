<?php namespace App\Gm\Auth;


use App\Gm\Repositories\UserRepository;
use App\Http\Controllers\AuthenticateUserListener;
use Laravel\Socialite\Facades\Socialite;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthenticateUser
{
    /**
     * @var UserRepository
     */
    private $userRepository;

    /**
     * Initialize variables meant to be used in this class.
     * @param UserRepository $userRepository
     */
    function __construct(UserRepository $userRepository)
    {

        $this->userRepository = $userRepository;
    }

    /**
     * Authenticate the user.
     *
     * @param $hasCode
     * @param $listener
     * @return mixed
     */
    public function authenticate($hasCode, AuthenticateUserListener $listener)
    {
        //Check if the code has been passed
        if (!$hasCode)
            return $this->getAuthorization();


        //Authenticates or creates user if code has been passed
        $user = $this->userRepository->findOrCreateUserByUsername($this->getGithubUser());

        \Auth::login($user, true);

        return $listener->handleAuthenticatedUser();

    }

    /**
     * Sends the user to the github page to gain authorisation
     *
     * @return mixed
     */
    private function getAuthorization()
    {
        return Socialite::with('github')->redirect();
    }

    /**
     * Retrieves the user from github
     *
     * @return mixed
     */
    private function getGithubUser()
    {
        return Socialite::with('github')->user();
    }
}