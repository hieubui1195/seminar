<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Models\Seminar;
use App\Models\User;
use Lang;

class CreateSeminarMail extends Mailable
{
    use Queueable, SerializesModels;

    protected $seminar, $user;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($seminarId, $userId)
    {
        $this->seminar = Seminar::withUser($seminarId)->get();
        $this->user = User::find($userId);
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject(Lang::get('custom.mail.subject_create_seminar'))
                    ->markdown('emails.create-seminar')
                    ->with([
                        'seminar' => $this->seminar,
                        'user' => $this->user,
                    ]);
    }
}
