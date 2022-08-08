<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventAddsOn extends Model
{
    protected $table = 'event_adds_on';

    public function event()
    {
        return $this->belongsTo('App\EventModel', 'id_event', 'id');
    }

    public function order_ticket_details()
    {
        return $this->belongsToMany('App\OrderTicket', 'order_ticket_detail', 'id_event_adds_on', 'id_order_ticket')->withPivot(['qty', 'harga']);
    }
}
