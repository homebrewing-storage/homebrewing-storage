<?php

declare(strict_types=1);

namespace App\Notifications;

use App\Models\UserSettings;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;
use Illuminate\Support\HtmlString;

class ExpiringIngredients extends Notification
{
    use Queueable;

    protected $ingredientsName;
    protected $ingredientsDate;
    protected $userSettings;

    public function __construct(string $ingredientsName, string $ingredientsDate, UserSettings $userSettings)
    {
        $this->ingredientsName = $ingredientsName;
        $this->ingredientsDate = $ingredientsDate;
        $this->userSettings = $userSettings;
    }

    public function via($notifiable): array
    {
        if ($this->userSettings->email === 0) {
            return ['database'];
        }
        return ['mail', 'database'];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
            ->line('Your ingredient ')
            ->line(new HtmlString('<strong>' . $this->ingredientsName . '</strong>'))
            ->line(' is expiring.')
            ->line(new HtmlString('It will expire on ' . '<strong>' . $this->ingredientsDate . '</strong>'))
            ->action('Go to the homepage', url('/'))
            ->line('Thank you for using our storage!');
    }

    public function toDatabase($notifiable): array
    {
        return [
            'Ingredient' => $this->ingredientsName,
            'Message' => ' will be expired on ',
            'Date' => $this->ingredientsDate,
        ];
    }
}
