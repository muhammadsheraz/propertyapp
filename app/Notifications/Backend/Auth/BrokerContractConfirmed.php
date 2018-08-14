<?php

namespace App\Notifications\Backend\Auth;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

/**
 * Class BrokerContractConfirmed.
 */
class BrokerContractConfirmed extends Notification
{
    use Queueable;

    protected $user;
    protected $broker;

    public function __construct($user, $broker)
    {
        $this->user = $user;
        $this->broker = $broker;
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
            ->subject(app_name() . ' - ' . __('strings.emails.subject.broker_contract_confirmed'))
            ->greeting('Dear ' . $notifiable->full_name . ',')
            ->line(__('strings.emails.messages.broker_contract_confirmed'))
            ->action(__('labels.frontend.auth.login_button'), route('frontend.auth.login'))
            ->line(__('strings.emails.auth.thank_you_for_using_app'));
    }


    public function toDatabase($notifiable)
    {
        $roles = $this->user->roles->toArray();
        
        return [
            'action' => config('app.broker_contract_confirmed'),
            'broker' => array_only($this->broker->toArray(), ['id','full_name','broker_no','email','avatar_location', 'active','confirmed']),
            'done_by' => array_only($this->user->toArray(), ['id','full_name','email','avatar_location', 'active','confirmed']),
            'done_by_role' => $roles[0],
        ];
    }
}
