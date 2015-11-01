<?php namespace App\Gm\Repositories;


use App\User;

class UserRepository
{

    /**
     * Finds or creates a user by the user's username.
     *
     * @param $githubUser
     * @return User $user
     */
    public function findOrCreateUserByUsername($githubUser)
    {
        $user = User::where('username', $githubUser->nickname)->first();

        if($user == null)
        {
            return User::create([
                'username' => $githubUser->nickname,
                'email' => $githubUser->email,
                'avatar' => $githubUser->avatar,
            ]);
        }

        return $user;
    }
}