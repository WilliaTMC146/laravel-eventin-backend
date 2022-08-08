<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventTicket extends Model
{
    protected $table = 'event_ticket';

    public function event()
    {
        return $this->belongsTo('App\EventModel', 'id_event', 'id');
    }
}
