<?php

namespace App\Http\Controllers;

use App\Services\TelegramBot;
use Coderflex\LaravelTicket\Models\Ticket;

class DashboardController extends Controller
{
    public function __invoke()
    {
        $totalTickets = Ticket::count();
        $openTickets = Ticket::opened()->count();
        $closedTickets = Ticket::closed()->count();

        (new TelegramBot)
            ->setToken('569740318:AAFJU5LkwbIRC6ABfCz-ri7gbA0ojwbqfe4')
            ->setMethod('sendMessage')
            ->setChatId('-1001490183979')
            ->setText('New comment on ticket '  . "\n comment: \n by Username: ")
            ->send();

        return view('dashboard', compact('totalTickets', 'openTickets', 'closedTickets'));
    }
}