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
        $tickets = Ticket::whereUserId(auth()->user()->id)->latest()->get();
        return view('dashboard', compact('totalTickets', 'openTickets', 'closedTickets', 'tickets'));
    }
}