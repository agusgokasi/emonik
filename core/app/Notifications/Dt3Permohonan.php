<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class Dt3Permohonan extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        if(config('mail.username')){
            return ['database', 'mail'];
        }else{
            return ['database'];
        }
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $url = (config('app.url').'permohonan');
        return (new MailMessage)
                    ->subject('Permohonan Ditolak')
                    ->greeting('Hello!')
                    ->line('Permohonan yang anda ajukan ditolak! Periksa kembali kesalahan anda.')
                    ->action('Lihat Website', $url)
                    ->line('Thank you for using our application!');
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
            'rejected_by' => auth()->user()->id,
            'message' => 'Permohonan anda ditolak'
        ];
    }
}
