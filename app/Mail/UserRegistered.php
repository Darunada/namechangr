<?php

namespace App\Mail;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserRegistered extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /** @var User  */
    public $user;

    /**
     * Create a new message instance.
     *
     * @param User $user
     */
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $user = $this->user;

        return $this->from('donotreply@namechangr.com', 'NameChangr Notify')
            ->subject("A User Has Registered!")
            ->markdown('vendor.notifications.email')->with([
                "level" => "default",
                "greeting" => "Hello!",
                "introLines" => [
                    "Please welcome $user->name!"
                ],
                "actionText" => "See the site!",
                "actionUrl" => url('/'),
                "outroLines" => [
                    "Their email is $user->email"
                ]
            ]);
    }
}
