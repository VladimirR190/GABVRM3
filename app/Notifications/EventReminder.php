<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class EventReminder extends Notification
{
    use Queueable;
    public $event;

    /**
     * Create a new notification instance.
     */
    public function __construct($event)
    {
        $this->event = $event;
    }


    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via($notifiable)
    {
        return ['mail', 'database'];
    }


    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Напоминание о событии: ' . $this->event->title)
            ->line('Событие ' . $this->event->title . ' начнется через 1 час.')
            ->action('Посмотреть событие', route('events.show', $this->event))
            ->line('Спасибо за использование нашего сервиса!');
    }


    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray($notifiable)
    {
        return [
            'event_id' => $this->event->id,
            'title' => 'Напоминание о событии: ' . $this->event->title,
            'message' => 'Событие начинается в ' . $this->event->start_time->format('H:i'),
        ];
    }
}
