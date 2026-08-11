<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class PropertyStatusNotification extends Notification
{
    use Queueable;

    public $property;
    public $status;
    public $messageText;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($property, $status, $messageText = '')
    {
        $this->property = $property;
        $this->status = $status;
        $this->messageText = $messageText;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database', 'mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->subject('Property Status Update: ' . $this->property->title)
                    ->line('Your property "' . $this->property->title . '" has been updated to status: ' . ucfirst($this->status))
                    ->line($this->messageText)
                    ->action('View Property', url('/property/' . $this->property->slug));
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'property_id' => $this->property->id,
            'title' => $this->property->title,
            'status' => $this->status,
            'message' => 'Your property status is now: ' . ucfirst($this->status),
            'url' => url('/property/' . $this->property->slug),
        ];
    }
}
