<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Spatie\Activitylog\LogOptions;
use Spatie\Activitylog\Traits\LogsActivity;
use Spatie\MediaLibrary\InteractsWithMedia;
use Coderflex\LaravelTicket\Models\Ticket as TicketModel;

class Ticket extends TicketModel implements HasMedia
{
    use LogsActivity;
    use InteractsWithMedia;

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()
            ->logFillable();
    }

    public function messages(): HasMany
    {
        return $this->hasMany(Message::class);
    }
}
