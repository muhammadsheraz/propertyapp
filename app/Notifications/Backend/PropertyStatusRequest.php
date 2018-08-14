<?php

namespace App\Notifications\Backend;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

/**
 * Class UserAccountActive.
 */
class PropertyStatusRequest extends Notification
{
    use Queueable;

    protected $user;
    protected $property;

    public function __construct($user, $property)
    {
        $this->user = $user;
        $this->property = $property;
    }
    
    /**
     * Get the notification's delivery channels.
     *
     * @param mixed $notifiable
     *
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }

    public function toMail($notifiable)
    {
        $mailMessage = (new MailMessage());
        $mailMessage->greeting('Dear Administrator,');

        if ($this->property->status == config('app.request_sold')) {
            $mailMessage->subject(app_name() . ' - ' . __('strings.emails.subject.request_sold'));
            $mailMessage->line(__('strings.emails.messages.request_sold'));
            $mailMessage->action(__('labels.general.view_property'), url('/admin/properties') . "/" . $this->property->id);
        } elseif ($this->property->status == config('app.request_rented')) {
            $mailMessage->subject(app_name() . ' - ' . __('strings.emails.subject.request_rented'));   
            $mailMessage->line(__('strings.emails.messages.request_rented'));
            $mailMessage->action(__('labels.general.view_property'), url('/admin/properties') . "/" . $this->property->id);
        }

        
        return $mailMessage;
    }

    public function toDatabase($notifiable)
    {
        if ($this->property->status == config('app.request_sold')) {
            $action = config('app.sold_request');
        } elseif ($this->property->status == config('app.request_rented')) {
            $action = config('app.rented_request');
        }

        $roles = $this->user->roles->toArray();

        return [
            'action' => $action,
            'property' => array_only($this->property->toArray(), ['id','property_no','title']),
            'done_by' => array_only($this->user->toArray(), ['id','full_name','broker_no','email','avatar_location', 'active','confirmed']),
            'done_by_role' => $roles[0],
        ];
    }
}
