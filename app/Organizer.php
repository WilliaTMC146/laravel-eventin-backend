<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Organizer extends Model
{
    protected $table = 'organizer';

    public function user_create()
    {
        return $this->belongsTo('App\User', 'created_id', 'id');
    }

    public function user_update()
    {
        return $this->belongsTo('App\User', 'updated_id', 'id');
    }

    public function events()
    {
        return $this->hasMany('App\EventModel', 'id_organizer', 'id');
    }

    public function roles()
    {
        return $this->hasMany('App\OrganizerRole', 'id_organizer', 'id');
    }

    public function followers()
    {
        return $this->belongsToMany('App\Member', 'organizer_followers', 'id_organizer', 'id_m_member');
    }

    public function members()
    {
        return $this->belongsToMany('App\Member', 'organizer_member', 'id_organizer', 'id_m_member')->withPivot('id_organizer_role');
    }

    public function filter($order_field, $order_ascdesc, $search, $search_column, $limit, $startLimit)
    {
        $sql = Organizer::select('organizer.*', 'user_create.name as user_create_name', 'user_update.name as user_update_name')
        ->join('users as user_create', 'user_create.id', 'organizer.created_id')
        ->join('users as user_update', 'user_update.id', 'organizer.updated_id')
        ->orderBy($order_field, $order_ascdesc);

        if ($search != '' && $search != NULL) {
            $sql->where('organizer.id', 'LIKE', "%{$search}%")
            ->orWhere('organizer.nama', 'LIKE', "%{$search}%")
            ->orWhere('organizer.keterangan', 'LIKE', "%{$search}%")
            ->orWhere('organizer.status', 'LIKE', "%{$search}%")
            ->orWhere('organizer.created_at', 'LIKE', "%{$search}%")
            ->orWhere('user_create.name', 'LIKE', "%{$search}%")
            ->orWhere('organizer.updated_at', 'LIKE', "%{$search}%")
            ->orWhere('user_update.name', 'LIKE', "%{$search}%");
        }

        if ($search_column['id'] != '' && $search_column['id'] != NULL) {
            $sql->where('organizer.id', 'LIKE', "%{$search_column['id']}%");
        }
        if ($search_column['nama'] != '' && $search_column['nama'] != NULL) {
            $sql->where('organizer.nama', 'LIKE', "%{$search_column['nama']}%");
        }
        if ($search_column['keterangan'] != '' && $search_column['keterangan'] != NULL) {
            $sql->where('organizer.keterangan', 'LIKE', "%{$search_column['keterangan']}%");
        }
        if ($search_column['status'] != '' && $search_column['status'] != NULL) {
            $sql->where('organizer.status', 'LIKE', "%{$search_column['status']}%");
        }
        if ($search_column['created_at'] != '' && $search_column['created_at'] != NULL) {
            $sql->where('organizer.created_at', 'LIKE', "%{$search_column['created_at']}%");
        }
        if ($search_column['user_create'] != '' && $search_column['user_create'] != NULL) {
            $sql->where('user_create.name', 'LIKE', "%{$search_column['user_create']}%");
        }
        if ($search_column['updated_at'] != '' && $search_column['updated_at'] != NULL) {
            $sql->where('organizer.updated_at', 'LIKE', "%{$search_column['updated_at']}%");
        }
        if ($search_column['user_update'] != '' && $search_column['user_update'] != NULL) {
            $sql->where('user_update.name', 'LIKE', "%{$search_column['user_update']}%");
        }

        $filter_count = $sql->count();
        $filter_data = $sql->offset($startLimit)->limit($limit)->get();

        $data = ['filter_count' => $filter_count, 'filter_data' => $filter_data];
        return $data;
    }
}
