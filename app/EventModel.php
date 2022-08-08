<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class EventModel extends Model
{
    protected $table = 'event';

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

    public function type()
    {
        return $this->belongsTo('App\MType', 'id_m_type', 'id');
    }

    public function category()
    {
        return $this->belongsTo('App\MCategory', 'id_m_category', 'id');
    }

    public function event_adds_ons()
    {
        return $this->hasMany('App\EventAddsOn', 'id_event', 'id');
    }

    public function event_tickets()
    {
        return $this->hasMany('App\EventTicket', 'id_event', 'id');
    }

    public function event_tags()
    {
        return $this->belongsToMany('App\MTags', 'event_tags', 'id_event', 'id_m_tags');
    }

    public function filter($order_field, $order_ascdesc, $search, $search_column, $limit, $startLimit)
    {
        $sql = EventModel::select('event.*', 'user_create.name as user_create_name', 'user_update.name as user_update_name', 'organizer.nama as organizer', 'm_category.nama as category', 'm_type.nama as type')
        ->join('organizer', 'organizer.id', 'event.id_organizer')
        ->join('m_category', 'm_category.id', 'event.id_m_category')
        ->join('m_type', 'm_type.id', 'event.id_m_type')
        ->join('users as user_create', 'user_create.id', 'event.created_id')
        ->join('users as user_update', 'user_update.id', 'event.updated_id')
        ->orderBy($order_field, $order_ascdesc);

        if ($search != '' && $search != NULL) {
            $sql->where('event.id', 'LIKE', "%{$search}%")
            ->orWhere('event.nama', 'LIKE', "%{$search}%")
            ->orWhere('event.keterangan', 'LIKE', "%{$search}%")
            ->orWhere('event.harga', 'LIKE', "%{$search}%")
            ->orWhere('event.lokasi', 'LIKE', "%{$search}%")
            ->orWhere('organizer.nama', 'LIKE', "%{$search}%")
            ->orWhere('m_category.nama', 'LIKE', "%{$search}%")
            ->orWhere('m_type.nama', 'LIKE', "%{$search}%")
            ->orWhere('event.status', 'LIKE', "%{$search}%")
            ->orWhere('event.created_at', 'LIKE', "%{$search}%")
            ->orWhere('user_create.name', 'LIKE', "%{$search}%")
            ->orWhere('event.updated_at', 'LIKE', "%{$search}%")
            ->orWhere('user_update.name', 'LIKE', "%{$search}%");
        }

        if ($search_column['id'] != '' && $search_column['id'] != NULL) {
            $sql->where('event.id', 'LIKE', "%{$search_column['id']}%");
        }
        if ($search_column['nama'] != '' && $search_column['nama'] != NULL) {
            $sql->where('event.nama', 'LIKE', "%{$search_column['nama']}%");
        }
        if ($search_column['keterangan'] != '' && $search_column['keterangan'] != NULL) {
            $sql->where('event.keterangan', 'LIKE', "%{$search_column['keterangan']}%");
        }
        if ($search_column['harga'] != '' && $search_column['harga'] != NULL) {
            $sql->where('event.harga', 'LIKE', "%{$search_column['harga']}%");
        }
        if ($search_column['lokasi'] != '' && $search_column['lokasi'] != NULL) {
            $sql->where('event.lokasi', 'LIKE', "%{$search_column['lokasi']}%");
        }
        if ($search_column['organizer'] != '' && $search_column['organizer'] != NULL) {
            $sql->where('organizer.nama', 'LIKE', "%{$search_column['organizer']}%");
        }
        if ($search_column['category'] != '' && $search_column['category'] != NULL) {
            $sql->where('m_category.nama', 'LIKE', "%{$search_column['category']}%");
        }
        if ($search_column['type'] != '' && $search_column['type'] != NULL) {
            $sql->where('m_type.nama', 'LIKE', "%{$search_column['type']}%");
        }
        if ($search_column['status'] != '' && $search_column['status'] != NULL) {
            $sql->where('event.status', 'LIKE', "%{$search_column['status']}%");
        }
        if ($search_column['created_at'] != '' && $search_column['created_at'] != NULL) {
            $sql->where('event.created_at', 'LIKE', "%{$search_column['created_at']}%");
        }
        if ($search_column['user_create'] != '' && $search_column['user_create'] != NULL) {
            $sql->where('user_create.name', 'LIKE', "%{$search_column['user_create']}%");
        }
        if ($search_column['updated_at'] != '' && $search_column['updated_at'] != NULL) {
            $sql->where('event.updated_at', 'LIKE', "%{$search_column['updated_at']}%");
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
