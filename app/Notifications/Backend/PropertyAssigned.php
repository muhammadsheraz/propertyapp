<?php

namespace App\Notifications\Backend;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

/**
 * Class Property Assigned To Broker.
 */
class PropertyAssigned extends Notification
{
    use Queueable;

    protected $user;
    protected $property;
    protected $assignee_broker;

    public function __construct($user, $property, $assignee_broker)
    {   
        $this->user = $user;
        $this->property = $property;
        $this->assignee_broker = $assignee_broker;
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
        if ($notifiable->id != 1) {
            return ['mail', 'database'];
        } else {
            return ['database'];
        }
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param mixed $notifiable
     *
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage())
            ->subject(app_name() . ' - ' . __('strings.emails.subject.property_assigned'))
            ->greeting('Dear ' . $notifiable->full_name . ',')
            ->line(__('strings.emails.messages.property_assigned', ['property_no' => $this->property->property_no]))
            ->line(__('strings.emails.auth.thank_you_for_using_app'));
    }    

    public function toDatabase($notifiable)
    {
        $roles = $this->user->roles->toArray();

        return [
            'action' => 'property assigned',
            'property' => array_only($this->property->toArray(), ['id','property_no','title']),
            'done_by' => array_only($this->user->toArray(), ['id','full_name','broker_no','email','avatar_location', 'active','confirmed']),
            'broker' => array_only($this->assignee_broker->toArray(), ['id','full_name','broker_no','email','avatar_location', 'active','confirmed']),
            'done_by_role' => $roles[0],
        ];
    }
}
