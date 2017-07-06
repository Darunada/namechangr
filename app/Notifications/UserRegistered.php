<?php

namespace App\Notifications;

use App\Mail\UserRegistered as UserRegisteredMail;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class UserRegistered extends Notification implements ShouldQueue
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Welcome to NameChangr!')
            ->greeting("Hi $notifiable->name,")
            ->line('Welcome to NameChangr!  You are now ready to get started creating your legal name change paperwork.')
            ->action('Visit your Dashboard', url('dashboard'))
            ->line('Thank you for giving our application a try!');
    }
}
