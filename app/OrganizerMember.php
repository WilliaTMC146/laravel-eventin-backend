<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrganizerMember extends Model
{
    protected $table = 'organizer_member';
    public $timestamps = false;

    public function role()
    {
        return $this->belongsTo('App\OrganizerRole', 'id_organizer_role', 'id');
    }

    public function member()
    {
        return $this->belongsTo('App\Member', 'id_m_member', 'id');
    }
}
