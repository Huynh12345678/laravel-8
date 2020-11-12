<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\Muser;

class Forgot extends Mailable
{
    use Queueable, SerializesModels;

    public $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */

    public function __construct(Muser $user)
    {
        $this->muser = $user;
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
        ->view('frontend.email.fotgot')
        ->with([
            'userid' => $this->muser->id,
        ]);
    }
}
