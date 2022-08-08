<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderTicket extends Model
{
    protected $table = 'order_ticket';

    public function event()
    {
        return $this->belongsTo('App\EventModel', 'id_event', 'id');
    }

    public function member()
    {
        return $this->belongsTo('App\Member', 'id_m_member', 'id');
    }

    public function event_adds_ons()
    {
        return $this->belongsToMany('App\EventAddsOn', 'order_ticket_details', 'id_order_ticket', 'id_event_adds_on')->withPivot(['qty', 'harga']);
    }
}
