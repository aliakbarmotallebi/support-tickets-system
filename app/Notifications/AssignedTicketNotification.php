<?php

namespace App\Notifications;

use App\Channels\TelegramCahnnel;
use Illuminate\Notifications\Notification;
use Coderflex\LaravelTicket\Models\Ticket;
use App\Services\TelegramBot;


class AssignedTicketNotification extends Notification
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
			//->setText('New ticket have been created: ' . $this->ticket->title . "\n by Username: " . $this->ticket->user->name . "\n You have been assigned a new ticket: ". $this->ticket->assigned_to)
			//->send();
    }

    public function toArray($notifiable): array
    {
        return [];
    }
}
