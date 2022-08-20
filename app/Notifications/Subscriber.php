<?php

namespace App\Notifications;

use App\Models\Post;
use App\Models\Website;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class Subscriber extends Notification implements ShouldQueue
// class Subscriber extends Notification
{
    use Queueable;

    public $website;
    public $post;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Website $website, Post $post)
    {
        $this->website  = $website;
        $this->post     = $post;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
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
                    ->subject("We've made a post on our website: {$this->website->name}!")
                    ->greeting("Dear {$notifiable->name},")
                    ->line("Thanks for subscribing to our website: {$this->website->name}")
                    ->line("Post Title: {$this->post->title}")
                    ->line("Post Description: {$this->post->description}")
                    ->line('Thank you.')
                    ->action('Click here to unsubscribe', url("/unsubscribe/".$notifiable->id));
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
            //
        ];
    }
}
