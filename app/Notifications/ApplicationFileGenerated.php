<?php

namespace App\Notifications;

use App\Models\Application\Application;
use App\Models\Application\File;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Storage;

class ApplicationFileGenerated extends Notification implements ShouldQueue
{
    use Queueable;

    /** @var Application */
    public $application;

    /** @var File */
    public $applicationFile;

    /**
     * Create a new notification instance.
     *
     * @param File $applicationFile
     * @param Application $application
     */
    public function __construct(File $applicationFile, Application $application)
    {
        $this->applicationFile = $applicationFile;
        $this->application = $application;
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
        $state = $this->application->state;
        $link = "/{$state->iso_3166_2}/{$this->application->id}";

        if($this->application->name_change && $this->application->gender_change) {
            $type = 'Name and Gender Change';
        } else if($this->application->name_change) {
            $type = 'Name Change';
        } else if($this->application->gender_change) {
            $type = 'Gender Change';
        }

        $name = $this->application->data['requested_legal_name'];

        $fileContent = Storage::get($this->applicationFile->path);
        return (new MailMessage)
                    ->from('congratulations@namechangr.com', 'NameChangr')
                    ->replyTo('hello@namechangr.com', 'Hello NameChangr')
                    ->subject("Your $type Documents Are Ready")
                    ->greeting("Congratulations, $name")
                    ->line('Your documents are attached to this email.')
                    ->action('View Application', url($link, [], true))
                    ->line('Feel free to directly reply to ask any questions or share any feedback you have.  This is a brand new application and we are working hard to improve it!')
                    ->line('I sincerely hope our application made your day today :-)')
                    ->attach(resource_path('templates/ut/instructions.pdf'), ['as'=>"instructions.pdf"])
                    ->attach(resource_path('templates/ut/cover-sheet.pdf'), ['as'=>"cover-sheet.pdf"])
                    ->attachData($fileContent, "document-package.{$this->applicationFile->type}");
    }
}
