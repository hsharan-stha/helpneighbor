<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailController extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    protected $content;

    public function __construct(string $content)
    {
        $this->content = $content;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $this->from(env('MAIL_FROM_ADDRESS'), env('MAIL_FROM_NAME'))
            ->subject('Welcome to Help Neighbor!')
            ->view('emails.welcome')->with(['content' => $this->content]);

        return $this;
    }
}
