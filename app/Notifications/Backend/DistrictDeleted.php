<?php

namespace App\Notifications\Backend;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

/**
 * Class UserAccountActive.
 */
class DistrictDeleted extends Notification
{
    use Queueable;

    protected $user;
    protected $district;

    public function __construct($user, $district)
    {   
        $this->user = $user;
        $this->district = $district;
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
            'action' => 'district deleted',
            'district' => $this->district,
            'data' => $this->user,
        ];
    }
}
