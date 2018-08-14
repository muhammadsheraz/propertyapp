<?php

namespace App\Notifications\Frontend\Auth;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;
use App\Models\Auth\User;

/**
 * Class BrokerContractUploaded.
 */
class BrokerContractUploaded extends Notification
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
        if ($notifiable->id == 1) {
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
            ->subject(app_name() . " - " . __('strings.emails.subject.broker_contract_uploaded', ['broker_label'=>$this->broker->broker_no]))
            ->greeting('Dear ' . $notifiable->full_name . ',')        
            ->line(__('strings.emails.messages.broker_contract_uploaded', ['broker_label'=>$this->broker->broker_no]))
            ->line(__('strings.emails.auth.thank_you_for_using_app'));
    }


    public function toDatabase($notifiable)
    {
        $roles = $this->user->roles->toArray();

        return [
            'action' => config('app.broker_contract_uploaded'),
            'broker' => $this->broker,
            'done_by' => $this->user->toArray(),
            'done_by_role' => $roles[0],
        ];
    }
}
