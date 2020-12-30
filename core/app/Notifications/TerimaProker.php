<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class TerimaProker extends Notification
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
        $url = (config('app.url').'prokerpermohonan');
        return (new MailMessage)
                    ->subject('Pengajuan Proker Diterima')
                    ->greeting('Hello!')
                    ->line('Pengajuan Proker sudah disetujui PPK, sekarang Anda bisa membuat permohonan menggunakan Proker tersebut.')
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
            'submited_by' => auth()->user()->id,
            'message' => 'Pengajuan Proker Anda diterima!'
        ];
    }
}
