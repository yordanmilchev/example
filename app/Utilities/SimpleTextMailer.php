<?php


namespace App\Utilities;

use Illuminate\Contracts\Mail\Mailer;

/**
 * Class SimpleTextMailer provides shortcut for sending raw text emails without Laravel's Mailable mechanism
 *
 * @package App\Utilities
 */
class SimpleTextMailer
{
    /**
     * @var Mailer
     */
    private Mailer $mailer;

    public function __construct(Mailer $mailer)
    {
        $this->mailer = $mailer;
    }

    /**
     * Sent raw text mail (useful for mail reporting)
     *
     * @param string $subject
     * @param string $rawText
     * @param $toMail
     */
    public function send($subject = '', $rawText = '', $toMail = 'office@abv.bg')
    {
        $this->mailer->raw($rawText, function($message) use ($toMail, $subject){
            $message->subject($subject)->to($toMail);
        });
    }
}

