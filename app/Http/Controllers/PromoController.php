<?php

namespace App\Http\Controllers;

use App\MPromo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class PromoController extends Controller
{
    public function __construct()
    {
        if (!check_user_access(Session::get('user_access'), 'm_promo_manage')) {
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
        if (!check_user_access(Session::get('user_access'), 'm_promo_manage')) {
            return redirect('/');
        }

        return view('promo.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if (!check_user_access(Session::get('user_access'), 'm_promo_create')) {
            return redirect('/');
        }

        $data['actions'] = 'store';
        return view('promo.promo', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (!check_user_access(Session::get('user_access'), 'm_promo_create')) {
            return redirect('/');
        }

        $input = $request->all();
        $validator = Validator::make($input, [
            'nama' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->route('promos.create')->withErrors($validator);
        }

        $summary = json_decode($request->summary);
        dd($summary);
        $promo = new MPromo();
        $promo->nama = $summary->nama;
        $promo->keterangan = $summary->keterangan;
        $promo->discount = $summary->discount;
        $promo->code = $summary->code;
        $promo->qty = $summary->qty;
        $promo->status = $summary->status;
        $promo->tanggal_awal = $summary->tanggal_awal;
        $promo->tanggal_akhir = $summary->tanggal_akhir;
        $promo->created_id = Auth::user()->id;
        $promo->updated_id = Auth::user()->id;
        $promo->save();

        return redirect()->route('promos.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!check_user_access(Session::get('user_access'), 'm_promo_read')) {
            return redirect('/');
        }

        $id = base64_decode($id);
        $data['promo'] = MPromo::find($id);
        return view('promo.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if (!check_user_access(Session::get('user_access'), 'm_promo_update')) {
            return redirect('/');
        }

        $id = base64_decode($id);
        $data['actions'] = 'update';
        $data['promo'] = MPromo::find($id);
        return view('promo.promo', compact('data'));
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
        if (!check_user_access(Session::get('user_access'), 'm_promo_update')) {
            return redirect('/');
        }

        $input = $request->all();
        $validator = Validator::make($input, [
            'nama' => 'required|max:255',
        ]);

        if ($validator->fails()) {
            return redirect()->route('promos.edit', $id)->withErrors($validator);
        }

        $id = base64_decode($id);
        $summary = json_decode($request->summary);

        $promo = MPromo::find($id);
        $promo->nama = $summary->nama;
        $promo->keterangan = $summary->keterangan;
        $promo->discount = $summary->discount;
        $promo->code = $summary->code;
        $promo->qty = $summary->qty;
        $promo->status = $summary->status;
        $promo->tanggal_awal = $summary->tanggal_awal;
        $promo->tanggal_akhir = $summary->tanggal_akhir;
        $promo->created_id = Auth::user()->id;
        $promo->updated_id = Auth::user()->id;
        $promo->save();

        return redirect()->route('promos.index');
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
            "discount" => (isset($columns[4]['search']['value'])) ? $columns[4]['search']['value'] : "",
            "code" => (isset($columns[5]['search']['value'])) ? $columns[5]['search']['value'] : "",
            "qty" => (isset($columns[6]['search']['value'])) ? $columns[6]['search']['value'] : "",
            "status" => (isset($columns[7]['search']['value'])) ? $columns[7]['search']['value'] : "",
            "tanggal_awal" => (isset($columns[8]['search']['value'])) ? $columns[8]['search']['value'] : "",
            "tanggal_akhir" => (isset($columns[9]['search']['value'])) ? $columns[9]['search']['value'] : "",
            "created_at" => (isset($columns[10]['search']['value'])) ? $columns[10]['search']['value'] : "",
            "user_create" => (isset($columns[11]['search']['value'])) ? $columns[11]['search']['value'] : "",
            "updated_at" => (isset($columns[12]['search']['value'])) ? $columns[12]['search']['value'] : "",
            "user_update" => (isset($columns[13]['search']['value'])) ? $columns[13]['search']['value'] : "",
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
            $order_field = 'discount';
        else if ($order_index == 5)
            $order_field = 'code';
        else if ($order_index == 6)
            $order_field = 'qty';
        else if ($order_index == 7)
            $order_field = 'status';
        else if ($order_index == 8)
            $order_field = 'tanggal_awal';
        else if ($order_index == 9)
            $order_field = 'tanggal_akhir';
        else if ($order_index == 10)
            $order_field = 'created_at';
        else if ($order_index == 11)
            $order_field = 'user_create_name';
        else if ($order_index == 12)
            $order_field = 'updated_at';
        else if ($order_index == 13)
            $order_field = 'user_update_name';
        else
            $order_field = 'id';

        $order_ascdesc = $_GET['order'][0]['dir'];

        $promo = new MPromo();

        $sql_total = $promo->count();
        $sql_filter = $promo->filter(
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
            if (check_user_access(Session::get('user_access'), 'm_promo_update')) {
                $action .= "<a class='btn btn-info btn-xl' href='" . route('promos.edit', base64_encode($value->id)) . "'><i class='fa fa-fw fa-pencil'></i> Edit</a>";
            }
            if (check_user_access(Session::get('user_access'), 'm_promo_read')) {
                $action .= "<a class='btn btn-success btn-xl' href='" . route('promos.show', base64_encode($value->id)) . "'><i class='fa fa-fw fa-eye'></i> Detail</a>";
            }

            $row[] = $action;
            $row[] = $value->id;
            $row[] = $value->nama;
            $row[] = $value->keterangan;
            $row[] = $value->discount;
            $row[] = $value->code;
            $row[] = $value->qty;
            $row[] = $value->status;
            $row[] = $value->tanggal_awal;
            $row[] = $value->tanggal_akhir;
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
