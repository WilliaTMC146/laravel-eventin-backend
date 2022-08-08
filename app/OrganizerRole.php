<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrganizerRole extends Model
{
    protected $table = 'organizer_role';

    public function user_create()
    {
        return $this->belongsTo('App\User', 'created_id', 'id');
    }

    public function user_update()
    {
        return $this->belongsTo('App\User', 'updated_id', 'id');
    }

    public function organizer()
    {
        return $this->belongsTo('App\Organizer', 'id_organizer', 'id');
    }

    public function permissions()
    {
        return $this->belongsToMany('App\MRolePermission', 'organizer_role_permission', 'id_organizer_role', 'id_m_role_permission');
    }
}
