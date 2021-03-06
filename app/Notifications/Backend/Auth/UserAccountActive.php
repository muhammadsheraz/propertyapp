<?php

namespace App\Notifications\Backend\Auth;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

/**
 * Class UserAccountActive.
 */
class UserAccountActive extends Notification
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
            ->subject(app_name() . ' - ' . __('strings.emails.subject.account_activated'))
            ->greeting('Dear ' . $notifiable->full_name . ',')
            ->line(__('strings.emails.messages.account_activated'))
            ->action(__('labels.frontend.auth.login_button'), route('frontend.auth.login'))
            ->line(__('strings.emails.auth.thank_you_for_using_app'));
    }


    public function toDatabase($notifiable)
    {
        return [
            'action' => config('app.broker_active'),
            'data' => $this->user,
        ];
    }
}
