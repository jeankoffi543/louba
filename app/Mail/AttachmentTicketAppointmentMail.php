<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


class AttachmentTicketAppointmentMail extends Mailable
{
    use Queueable, SerializesModels;

    public $data;
    public $attachment;

    public function __construct($data, $attachment)
    {
        $this->data = $data;
        $this->attachment = $attachment;
    }

    public function build()
    {
        return $this->subject('Votre reçu de prise de rendez-vous LOUBA')->view('emails.ticket_appointment')
            ->attachData($this->attachment['data'], $this->attachment['name'], [
                'mime' => 'application/pdf'
            ]);
    }
}
