<?php

namespace App\Notifications\Backend\Auth;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Auth\User;

/**
 * Class BrokerRegistered.
 */
class BrokerRegistered extends Notification
{
    use Queueable;

    protected $user;

    public function __construct($user)
    {
        $this->user = $user;
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
        return ['mail','database'];
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
        $roles = $this->user->roles->toArray();
        $role = $roles[0];
        $role_name = $role['name'];
        $user = $this->user->toArray();
        return (new MailMessage())
            ->subject(app_name() . " - " . __('strings.emails.subject.account_registered'))
            ->greeting('Dear Administrator,')        
            ->line(__('strings.emails.messages.account_registered', [
                'user_label' => $role_name . '<a target="_blank" href="' . url('/admin/auth/broker/' . $user['id'] ) . '">' . $user['broker_no'] . '</a>'
            ]));
    }


    public function toDatabase($notifiable)
    {
        $roles = $this->user->roles->toArray();

        return [
            'action' => config('app.broker_registered'),
            'broker' => $this->user->toArray(),
            'done_by' => $this->user->toArray(),
            'done_by_role' => $roles[0],
            
        ];
    }
}
