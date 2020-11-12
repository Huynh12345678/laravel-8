<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Mcontact;

class ContactEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $contact;
    public $reply;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct(Mcontact $contact, $reply)
    {
        $this->mcontact = $contact;
        $this->reply = $reply;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Circle Shop')
        ->from('emarketstore2020@gmail.com')
        ->view('backend.contact.email')
        ->with([
            'fullname' => $this->mcontact->name,
            'phone' => $this->mcontact->phone,
            'body' => $this->mcontact->body,
        ]);
    }
}
