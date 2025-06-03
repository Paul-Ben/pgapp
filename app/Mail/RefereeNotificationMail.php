<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class RefereeNotificationMail extends Mailable
{
    use Queueable, SerializesModels;
    public $referee;
    public $applicant;

    /**
     * Create a new message instance.
     */
    public function __construct($referee, $applicant)
    {
        $this->referee = $referee;
        $this->applicant = $applicant;
    }

     public function build()
    {
        return $this->subject('Referee Request Notification')
            ->view('emails.referee_notification');
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Referee Notification Mail',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.referee_notification',
            with: [
                'referee' => $this->referee,
                'applicant'=> $this->applicant
            ]
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
