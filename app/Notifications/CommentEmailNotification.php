<?php

namespace App\Notifications;

use App\Channels\TelegramCahnnel;
use Illuminate\Notifications\Notification;
use Coderflex\LaravelTicket\Models\Message;
use App\Services\TelegramBot;

class CommentEmailNotification extends Notification
{
    public function __construct(protected Message $message)
    {}

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
            //->setText('Replay comment on ticket ' . $this->message->ticket->title. "\n comment: ". strip_tags($this->message->message))
            //->send();
    }

    public function toArray($notifiable): array
    {
        return [];
    }
}
