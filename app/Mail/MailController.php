<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class MailController extends Mailable
{
    use Queueable, SerializesModels;
    private $content;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($content)
    {
        $this->content = $content;
        $this->queue = 'emails';
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject($this->content['subject'])
            ->view('mail.mail')
            ->with([
                'content' => $this->content['body'],
                'type' => $this->content['type'],
            ]);
    }
}
