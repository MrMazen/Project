<?php

namespace App\Notifications;

use App\models\Patient;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class PatientNotification extends Notification
{
    use Queueable;
   private $Patient;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Patient $Patient)
    {
        $this->Patient = $Patient;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toDatabase($notifiable)
    {
        return [


            'id'=> $this->Patient->id,
            'title'=>'تم اضافة  جديدة بواسطة :',
            'user'=> Auth::user()->name,

        ];
    }

}
