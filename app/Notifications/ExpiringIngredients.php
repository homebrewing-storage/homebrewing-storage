<?php

declare(strict_types=1);

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\Facades\Auth;

class ExpiringIngredients extends Notification
{
    use Queueable;
    protected $ingredientsName;
    protected $ingredientsDate;
    protected $userSettings;

    public function __construct($ingredientsName, $ingredientsDate, $userSettings)
    {
        $this->ingredientsName = $ingredientsName;
        $this->ingredientsDate = $ingredientsDate;
        $this->userSettings = $userSettings;
    }

    public function via($notifiable): array
    {
        if($this->userSettings->email === 0)
        {
            return ['database'];
        }
        return ['mail', 'database'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('The introduction to the notification.')
            ->action('Notification Action', url('/'))
            ->line('Thank you for using our application!');
    }

    public function toDatabase($notifiable): array
    {
        return [
            'Ingredient' => $this->ingredientsName,
            'Message' => ' will be expired on ',
            'Date' => $this->ingredientsDate
        ];
    }
}
