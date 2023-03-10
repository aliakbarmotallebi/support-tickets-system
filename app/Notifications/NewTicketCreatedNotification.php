<?php

namespace App\Notifications;

use App\Channels\TelegramCahnnel;
use App\Models\Ticket;
use Illuminate\Notifications\Notification;
use App\Services\TelegramBot;

class NewTicketCreatedNotification extends Notification
{
    public function __construct(protected Ticket $ticket) {}

    public function via($notifiable): array
    {
        return [TelegramCahnnel::class];
    }

    public function toTelegramBot($notifiable)
    {
        //return (new TelegramBot)
			//->setToken('569740318:AAFJU5LkwbIRC6ABfCz-ri7gbA0ojwbqfe4')
			//->setMethod('sendMessage')
			//->setChatId('-1001490183979')
			//->setText('New ticket have been created: ' . $this->ticket->title . "\n message: ". $this->ticket->message ."\n by Username: " . $this->ticket->user->name)
			//->send();
    }

    public function toArray($notifiable): array
    {
        return [];
    }
}
