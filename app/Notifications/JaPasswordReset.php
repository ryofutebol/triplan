<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class JaPasswordReset extends Notification
{
	use Queueable;

    /**
     * Create a new notification instance.
     * @param  string  $token
     * @return void
     */
    public function __construct($token)
    {
       $this->token = $token;
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
					->subject(__('パスワードリセットの準備ができました'))
					->from(config('mail.from.address'))
					->view('vendor.notifications.email')
					->action(__('パスワードリセット'), url('password/reset', $this->token));
					/*デフォルト
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
					->line('Thank you for using our application!');
					 */
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
