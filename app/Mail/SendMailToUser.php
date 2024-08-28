<?php

namespace App\Mail;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class SendMailToUser extends Mailable
{
    use Queueable, SerializesModels;

    public $toUserName;
    public $subject;
    public $bodyText;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($toUserName, $subject, $bodyText)
    {
       
        $this->toUserName = $toUserName;
        $this->subject = $subject;
        $this->bodyText = $bodyText;
    }
    /*
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
      
        return $this->view('layouts.email_template')
        ->with(['toUserName' => $this->toUserName, 'subject' => $this->subject, 'bodyText' => $this->bodyText]);
    }
}