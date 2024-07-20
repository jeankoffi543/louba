<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class GlobalSenderMail extends Mailable
{
    use Queueable, SerializesModels;
    private  $email;
    private string $message;
    private string $username;
    public array $attachmentsArray;
    public $subject;
    /**
     * Create a new message instance.
     */
    public function __construct($message, $subject, $attachmentsArray = [])
    {
        //
        $this->message = $message;
        $this->attachmentsArray = $attachmentsArray;
        $this->subject = $subject;
        
    }

      /**
     * Build the message. 
     *
     * @return $this
     */
    public function build()
    {
        $emailMessage = $this->markdown('emails.globalsender', [
            'message' => $this->message,
        ]);
        if(!empty($this->subject)){
            $emailMessage->subject($this->subject);
        }
        
        if(!empty($this->attachmentsArray)){
        foreach ($this->attachmentsArray as $attachment) {

            $emailMessage->attach($attachment);
        }      
    }
    
        return $emailMessage;
    }
}
