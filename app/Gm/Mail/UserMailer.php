<?php namespace App\Gm\Mail;


use App\User;
use Illuminate\Support\Facades\Mail;

class UserMailer
{

    public function sendInvitationToUser(User $user)
    {
        //Send invitation mail to the user.
        Mail::raw('Join this Github Manager you friend '.\Auth::user()->username.' is already there ,Click on the url:' .url('/'), function ($message) use($user) {
            $message->from('info@githubManager', 'Laravel');

            $message->to($user->email);
        });
    }
}