<?php

namespace App\Mail;

use App\Models\Application\Application;
use App\Models\Application\File;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Storage;

class ApplicationGenerated extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /** @var Application */
    protected $application;

    /** @var  File */
    protected $file;

    /**
     * Create a new message instance.
     *
     * @param File $file
     * @param Application $application
     */
    public function __construct(File $file, Application $application)
    {
        $this->application = $application;
        $this->file = $file;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        if ($this->application->name_change && $this->application->gender_change) {
            $type = 'Name and Gender Change';
        } else {
            if ($this->application->name_change) {
                $type = 'Name Change';
            } else {
                if ($this->application->gender_change) {
                    $type = 'Gender Change';
                }
            }
        }

        $name = $this->application->data['requested_legal_name'];
        $user = $this->application->user;
        $fileContent = Storage::get($this->file->path);

        // heheh
        return $this->from('donotreply@namechangr.com', 'NameChangr Notify')
            ->subject("An Application was Generated!")
            ->attachData($fileContent, "document-package.{$this->file->type}")
            ->markdown('vendor.notifications.email')->with([
                                                               "level" => "default",
                                                               "greeting" => "Hello!",
                                                               "introLines" => [
                                                                   "A $type application has been generated!",
                                                                   "The user is now $name"
                                                               ],
                                                               "actionText" => "See the site!",
                                                               "actionUrl" => url('/'),
                                                               "outroLines" => [
                                                                   "Their email is $user->email"
                                                               ]
                                                           ]);
    }
}
