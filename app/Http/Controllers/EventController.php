<?php

namespace App\Http\Controllers;

use App\EventModel;
use App\Organizer;
use App\MCategory;
use App\MType;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class EventController extends Controller
{
    public function __construct()
    {
        if (!check_user_access(Session::get('user_access'), 'event_manage')) {
            return redirect('/');
        }
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if (!check_user_access(Session::get('user_access'), 'event_manage')) {
            return redirect('/');
        }

        return view('event.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!check_user_access(Session::get('user_access'), 'event_create')){
            return redirect('/');
        }

        $data['actions'] = 'store';
        $data['organizer'] = Organizer::all();
        $data['categorys'] = MCategory::all();
        $data['type'] = MType::all();

        return view('event.event', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!check_user_access(Session::get('user_access'), 'event_create')) {
            return redirect('/');
        }

        $input = $request->all();
        $validator = Validator::make($input, [
            'nama' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->route('events.create')->withErrors($validator);
        }

        $summary = json_decode($request->summary);
        $event = new EventModel();
        $event->nama = $summary->nama;
        $event->keterangan = $summary->keterangan;
        $event->harga = $summary->harga;
        $event->lokasi = $summary->lokasi;
        $event->status = $summary->status;

        $category = '';
        foreach($request->m_categorys as $cat)
        {
            $cat = MCategory::find($cat);
            $category .= $cat->id . ';;';
        }
        $event->id_m_category = $category;

        $type = '';
        foreach($request->m_types as $types)
        {
            $types = MType::find($types);
            $type .= $types->id . ';;';
        }
        $event->id_m_type = $type;
        
        $organizer = '';
        foreach($request->organizers as $org)
        {
            $org = Organizer::find($org);
            $organizer .= $org->id . ';;';
        }
        $event->id_organizer = $organizer;

        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $filename = strtotime('now') . '.' . $file->getClientOriginalExtension();
            $path = 'uploads/event/';
            $file->move($path, $filename);
            $event->image = $path . $filename;
            //dd($filename);
        }

        $event->created_id = Auth::user()->id;
        $event->updated_id = Auth::user()->id;
        $event->save();

        return redirect()->route('events.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!check_user_access(Session::get('user_access'), 'event_read')) {
            return redirect('/');
        }

        $id = base64_decode($id);
        $data['event'] = EventModel::find($id);
        return view('event.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!check_user_access(Session::get('user_access'), 'event_update')){
            return redirect('/');
        }

        $id = base64_decode($id);

        $data['actions'] = 'update';
        $data['event'] = EventModel::find($id);
        return view('event.event', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        if (!check_user_access(Session::get('user_access'), 'event_create')) {
            return redirect('/');
        }

        $input = $request->all();
        $validator = Validator::make($input, [
            'nama' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->route('events.create')->withErrors($validator);
        }

        $summary = json_decode($request->summary);
        $id = base64_decode($id);

        $event = EventModel::find($id);
        $event->nama = $summary->nama;
        $event->keterangan = $summary->keterangan;
        $event->harga = $summary->harga;
        $event->lokasi = $summary->lokasi;
        $event->status = $summary->status;

        $category = '';
        foreach($request->m_categorys as $cat)
        {
            $cat = MCategory::find($cat);
            $category .= $cat->id . ';;';
        }
        $event->id_m_category = $category;

        $type = '';
        foreach($request->m_types as $types)
        {
            $types = MType::find($types);
            $type .= $types->id . ';;';
        }
        $event->id_m_type = $type;
        
        $organizer = '';
        foreach($request->organizers as $org)
        {
            $org = Organizer::find($org);
            $organizer .= $org->id . ';;';
        }
        $event->id_organizer = $organizer;

        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $filename = strtotime('now') . '.' . $file->getClientOriginalExtension();
            $path = 'uploads/event/';
            $file->move($path, $filename);
            $event->image = $path . $filename;
        }

        $event->created_id = Auth::user()->id;
        $event->updated_id = Auth::user()->id;
        $event->save();

        return redirect()->route('events.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }

    public function datatable(Request $request)
    {
        $search  = $_GET['search']['value'];
        $columns = $request->input('columns');

        $search_column = array(
            "id" => (isset($columns[1]['search']['value'])) ? $columns[1]['search']['value'] : "",
            "nama" => (isset($columns[2]['search']['value'])) ? $columns[2]['search']['value'] : "",
            "keterangan" => (isset($columns[3]['search']['value'])) ? $columns[3]['search']['value'] : "",
            "harga" => (isset($columns[4]['search']['value'])) ? $columns[4]['search']['value'] : "",
            "lokasi" => (isset($columns[5]['search']['value'])) ? $columns[5]['search']['value'] : "",
            "organizer" => (isset($columns[6]['search']['value'])) ? $columns[6]['search']['value'] : "",
            "image" => (isset($columns[7]['search']['value'])) ? $columns[7]['search']['value'] : "",
            "category" => (isset($columns[8]['search']['value'])) ? $columns[8]['search']['value'] : "",
            "type" => (isset($columns[9]['search']['value'])) ? $columns[9]['search']['value'] : "",
            "status" => (isset($columns[10]['search']['value'])) ? $columns[10]['search']['value'] : "",
            "created_at" => (isset($columns[11]['search']['value'])) ? $columns[11]['search']['value'] : "",
            "user_create" => (isset($columns[12]['search']['value'])) ? $columns[12]['search']['value'] : "",
            "updated_at" => (isset($columns[13]['search']['value'])) ? $columns[13]['search']['value'] : "",
            "user_update" => (isset($columns[14]['search']['value'])) ? $columns[14]['search']['value'] : "",
        );

        $limit = $request->input('length');
        $start = $request->input('start');
        $order_index = $_GET['order'][0]['column'];
        if ($order_index == 1)
            $order_field = 'id';
        else if ($order_index == 2)
            $order_field = 'nama';
        else if ($order_index == 3)
            $order_field = 'keterangan';
        else if ($order_index == 4)
            $order_field = 'harga';
        else if ($order_index == 5)
            $order_field = 'lokasi';
        else if ($order_index == 6)
            $order_field = 'organizer';
        else if ($order_index == 7)
            $order_field = 'organizer';
        else if ($order_index == 8)
            $order_field = 'category';
        else if ($order_index == 9)
            $order_field = 'type';
        else if ($order_index == 10)
            $order_field = 'status';
        else if ($order_index == 11)
            $order_field = 'created_at';
        else if ($order_index == 12)
            $order_field = 'user_create_name';
        else if ($order_index == 13)
            $order_field = 'updated_at';
        else if ($order_index == 14)
            $order_field = 'user_update_name';
        else
            $order_field = 'id';

        $order_ascdesc = $_GET['order'][0]['dir'];

        $event = new EventModel();

        $sql_total = $event->count();
        $sql_filter = $event->filter(
            $order_field,
            $order_ascdesc,
            $search,
            $search_column,
            $limit,
            $start
        );

        $filter_count = $sql_filter['filter_count'];
        $filter_data = $sql_filter['filter_data'];

        foreach ($filter_data as $value) {
            $row = array();

            $action = '';
            if (check_user_access(Session::get('user_access'), 'event_update')) {
                $action .= "<a class='btn btn-info btn-xl' href='" . route('events.edit', base64_encode($value->id)) . "'><i class='fa fa-fw fa-pencil'></i> Edit</a>";
            }
            if (check_user_access(Session::get('user_access'), 'event_read')) {
                $action .= "<a class='btn btn-success btn-xl' href='" . route('events.show', base64_encode($value->id)) . "'><i class='fa fa-fw fa-eye'></i> Detail</a>";
            }

            $row[] = $action;
            $row[] = $value->id;
            $row[] = $value->nama;
            $row[] = $value->keterangan;
            $row[] = $value->harga;
            $row[] = $value->lokasi;
            $row[] = $value->organizer;
            $row[] = $value->image;
            $row[] = $value->category;
            $row[] = $value->type;
            $row[] = $value->status;
            $row[] = date('d-m-Y H:i:s', strtotime($value->created_at));
            $row[] = $value->user_create_name;
            $row[] = date('d-m-Y H:i:s', strtotime($value->updated_at));
            $row[] = $value->user_update_name;

            $data[] = $row;
        }

        if ($filter_count == 0) {
            $data = 0;
        }

        $callback = array(
            'draw' => $_GET['draw'],
            'recordsTotal' => $sql_total,
            'recordsFiltered' => $filter_count,
            'data' => $data
        );
        header('Content-Type: application/json');
        return $callback;
    }
}
