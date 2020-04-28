<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;

class SendMailUser extends Mailable
{
    use Queueable, SerializesModels;

    public $user;
    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($user)
    {
        $this->user = $user;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Ativação de Conta SIST - 12ª RM')
            ->from('noreply@sist.12rm.eb.mil.br', 'SIST - 12ª RM')
            ->markdown('emails.email-markdown')
            ->with([
                'user'     => $this->user
            ]);
    }
}
