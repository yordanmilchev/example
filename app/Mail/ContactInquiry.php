<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ContactInquiry extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    private $inquiry;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($inquiry)
    {
        $this->inquiry = $inquiry;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->view('emails.contact_inquiry', [
            'inquiry' => $this->inquiry
        ])->subject("Контактна форма");
    }
}
