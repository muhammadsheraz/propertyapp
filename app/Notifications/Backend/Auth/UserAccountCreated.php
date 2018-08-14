<?php

namespace App\Notifications\Backend\Auth;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

/**
 * Class UserAccountActive.
 */
class UserAccountCreated extends Notification
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
        ->subject(app_name().' - '.__('strings.emails.subject.account_created'))
        ->greeting('Dear ' . $notifiable->full_name . ',')        
        ->line(__('strings.emails.messages.created_pending'))
        ->line('Thank You.');
    }


    public function toDatabase($notifiable)
    {
        return [
            'action' => config('app.broker_created'),
            'data' => $this->user,
        ];
    }
}
