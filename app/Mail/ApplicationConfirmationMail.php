<?php
namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\contact;

class ApplicationConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $contact;

    public function __construct(contact $contact)
    {
        $this->contact = $contact;
    }

    public function build()
    {
        return $this->subject('Application Confirmation')
                    ->view('applyNow.idCard');
    }
}
