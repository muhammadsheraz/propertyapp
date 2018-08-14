<?php

namespace App\Mail\Api\PropertyAlerts;

use Illuminate\Http\Request;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

/**
 * Class PropertyAlert.
 */
class PropertyAlert extends Mailable
{
    use Queueable, SerializesModels;

    /**
     * @var Request
     */
    public $request;
    private $property;
    private $customer;

    /**
     * SendContact constructor.
     *
     * @param Request $request
     */
    public function __construct(Request $request, $property, $customer)
    {
        $this->request = $request;
        $this->property = $property;
        $this->customer = $customer;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->to(config('mail.to.contact'), config('mail.from.name'))
            ->view('frontend.mail.customer-property-alert')
            ->text('frontend.mail.customer-property-alert-text')
            ->subject(__('strings.emails.customer-property-alert.subject', ['app_name' => app_name()]))
            ->from(config('mail.from.address'), config('mail.from.name'))
            ->replyTo(config('mail.from.address'), config('mail.from.name'));
    }
}
