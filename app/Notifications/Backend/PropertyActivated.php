<?php

namespace App\Notifications\Backend;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

/**
 * Class PropertyActivated.
 */
class PropertyActivated extends Notification
{
    use Queueable;

    protected $user;
    protected $property;

    public function __construct($user, $property)
    {   
        $this->user = $user->toArray();
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
        return ['database'];
    }


    public function toDatabase($notifiable)
    {
        $roles = $user->roles->toArray();

        return [
            'action' => 'property active',
            'property' => array_only($this->property->toArray(), ['id','property_no','title']),
            'done_by' => array_only($this->user->toArray(), ['id','full_name','broker_no','email','avatar_location', 'active','confirmed']),
            'done_by_role' => $roles[0],
        ];
    }
}
