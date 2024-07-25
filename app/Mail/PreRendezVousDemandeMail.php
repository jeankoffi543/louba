<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class PreRendezVousDemandeMail extends Mailable
{
   use Queueable, SerializesModels;
   private  $email;
   private string $username;
   public array $attachment;
   public $subject;
   public array $details;
   /**
    * Create a new message instance.
    */
   public function __construct($subject, $details = [], $attachment = [])
   {
      //
      $this->attachment = $attachment;
      $this->subject = $subject;
      $this->details = $details;
   }

   /**
    * Build the message. 
    *
    * @return $this
    */
   public function build()
   {
      $emailMessage = $this->markdown('emails.PreRendezVousDemande', $this->details);
      if (!empty($this->subject)) {
         $emailMessage->subject($this->subject);
      }

      if (is_array($this->attachment) && isset($this->attachment['data']) && isset($this->attachment['name'])) {
         $emailMessage->attachData($this->attachment['data'], $this->attachment['name'], [
            'mime' => 'application/pdf'
         ]);
      }

      return $emailMessage;
   }
}
