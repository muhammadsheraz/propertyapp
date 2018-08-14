<?php

namespace App\Notifications\Backend;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

/**
 * Class UserAccountActive.
 */
class CityDeleted extends Notification
{
    use Queueable;

    protected $user;
    protected $city;

    public function __construct($user, $city)
    {   
        $this->user = $user;
        $this->city = $city;
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
        return ['database'];
    }


    public function toDatabase($notifiable)
    {
        return [
            'action' => 'city deleted',
            'city' => $this->city,
            'data' => $this->user,
        ];
    }
}
