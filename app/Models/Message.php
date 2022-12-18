<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;
use Coderflex\LaravelTicket\Models\Message as MessageModel;

class Message extends MessageModel
{
    use HasFactory, Notifiable;

    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
