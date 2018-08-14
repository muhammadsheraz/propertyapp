<?php

namespace App\Mail\Api\PasswordReset;

use Illuminate\Http\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Class ResetCodeSend.
 */
class ResetCodeSend extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var Request
     */
    public $request;
    public $code;

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
        return $this->to($this->request->customer->email, $this->request->customer->full_name)
            ->view('api.mail.reset-code-send')
            ->text('api.mail.reset-code-send-text')
            ->subject(__('strings.emails.subject.your_password_reset_code'))
            ->from(config('mail.from.address'), config('mail.from.name'))
            ->replyTo(config('mail.from.address'), config('mail.from.name'));
    }
}
