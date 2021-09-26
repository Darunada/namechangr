<?php
/**
 * Created by PhpStorm.
 * User: Lea
 * Date: 7/16/2017
 * Time: 10:02 PM
 */

namespace App\Listeners;

use App\Events\ApplicationFileGenerated;
use App\Mail\ApplicationGenerated;
use App\Mail\UserRegistered;
use Illuminate\Auth\Events\Registered;
use Mail;


class NotifyAdminSubscriber
{

    /** @var string */
    protected $adminEmail;

    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
        //'Illuminate\Auth\Events\Registered' => [
        //'App\Listeners\LogRegisteredUser',

        $this->adminEmail = config('mail.email');
    }

    /**
     * Handle user register events.
     * @param Registered $event
     */
    public function onUserRegister(Registered $event)
    {
        if ($this->shouldSend()) {
            Mail::to($this->adminEmail)->queue(new UserRegistered($event->user));
        }
    }

    /**
     * @return bool
     */
    private function shouldSend()
    {
        return filter_var($this->adminEmail, FILTER_VALIDATE_EMAIL) == true;
    }

    /**
     * Handle user register events.
     * @param ApplicationFileGenerated $event
     */
    public function onApplicationGenerated(ApplicationFileGenerated $event)
    {
        if ($this->shouldSend()) {
            Mail::to($this->adminEmail)->queue(new ApplicationGenerated($event->file, $event->application));
        }
    }

    /**
     * Register the listeners for the subscriber.
     *
     * @param Illuminate\Events\Dispatcher $events
     */
    public function subscribe($events)
    {
        $events->listen(
            'Illuminate\Auth\Events\Registered',
            'App\Listeners\NotifyAdminSubscriber@onUserRegister'
        );

        $events->listen(
            'App\Events\ApplicationFileGenerated',
            'App\Listeners\NotifyAdminSubscriber@onApplicationGenerated'
        );
    }
}
