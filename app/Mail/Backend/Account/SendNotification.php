<?php

namespace App\Mail\Backend\Account;

use Illuminate\Http\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Class SendContact.
 */
class SendNotification extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var Request
     */
    public $request;

    /**
     * SendContact constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request)
    {
        $this->request = $request;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        $view = 'backend.mail.account-activated';
        $view_text = 'backend.mail.account-activated-text';
        $subject = 'Account Activated';

        return $this->to(config('mail.from.address'), config('mail.from.name'))
            ->view($view)
            ->text($view_text)
            ->subject($subject)
            ->from($this->request->email, $this->request->name)
            ->replyTo($this->request->email, $this->request->name);
    }
}
