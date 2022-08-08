<?php

namespace App\Http\Controllers;

use App\Member;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class MemberController extends Controller
{
    public function __construct()
    {
        if (!check_user_access(Session::get('user_access'), 'member_manage')) {
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
        if (!check_user_access(Session::get('user_access'), 'member_manage')) {
            return redirect('/');
        }

        return view('member.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!check_user_access(Session::get('user_access'), 'member_read')) {
            return redirect('/');
        }

        $id = base64_decode($id);
        $data['member'] = Member::find($id);
        return view('member.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
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
            "email" => (isset($columns[3]['search']['value'])) ? $columns[3]['search']['value'] : "",
            "telepon" => (isset($columns[4]['search']['value'])) ? $columns[4]['search']['value'] : "",
            "alamat" => (isset($columns[5]['search']['value'])) ? $columns[5]['search']['value'] : "",
            "status" => (isset($columns[6]['search']['value'])) ? $columns[6]['search']['value'] : "",
            "created_at" => (isset($columns[7]['search']['value'])) ? $columns[7]['search']['value'] : "",
            "updated_at" => (isset($columns[8]['search']['value'])) ? $columns[8]['search']['value'] : "",
        );

        $limit = $request->input('length');
        $start = $request->input('start');
        $order_index = $_GET['order'][0]['column'];
        if ($order_index == 1)
            $order_field = 'id';
        else if ($order_index == 2)
            $order_field = 'nama';
        else if ($order_index == 3)
            $order_field = 'email';
        else if ($order_index == 4)
            $order_field = 'telepon';
        else if ($order_index == 5)
            $order_field = 'alamat';
        else if ($order_index == 6)
            $order_field = 'status';
        else if ($order_index == 7)
            $order_field = 'creaated_at';
        else if ($order_index == 8)
            $order_field = 'updated_at';
        else
            $order_field = 'id';

        $order_ascdesc = $_GET['order'][0]['dir'];

        $member = new Member();

        $sql_total = $member->count();
        $sql_filter = $member->filter(
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
            if (check_user_access(Session::get('user_access'), 'member_read')) {
                $action .= "<a class='btn btn-success btn-xl' href='" . route('members.show', base64_encode($value->id)) . "'><i class='fa fa-fw fa-eye'></i> Detail</a>";
            }

            $row[] = $action;
            $row[] = $value->id;
            $row[] = $value->nama;
            $row[] = $value->email;
            $row[] = $value->telepon;
            $row[] = $value->alamat;
            $row[] = $value->status;
            $row[] = date('d-m-Y H:i:s', strtotime($value->created_at));
            $row[] = date('d-m-Y H:i:s', strtotime($value->updated_at));

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
