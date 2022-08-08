<?php

namespace App\Http\Controllers;

use App\Member;
use App\MRolePermission;
use App\Organizer;
use App\OrganizerMember;
use App\OrganizerRole;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx\Rels;

use function GuzzleHttp\Psr7\str;

class OrganizerController extends Controller
{
    public function __construct()
    {
        if (!check_user_access(Session::get('user_access'), 'organizer_manage')) {
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
        if (!check_user_access(Session::get('user_access'), 'organizer_manage')) {
            return redirect('/');
        }

        return view('organizer.index');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(!check_user_access(Session::get('user_access'), 'organizer_create')){
            return redirect('/');
        }

        $data['actions'] = 'store';
        return view('organizer.organizer', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if(!check_user_access(Session::get('user_access'), 'organizer_create')){
            return redirect('/');
        }

        $summary = json_decode($request->summary);

        $organizer = new Organizer();
        $organizer->nama = $summary->nama;
        $organizer->keterangan = $summary->keterangan;
        $organizer->status = $summary->status;
        $organizer->created_id = Auth::user()->id;
        $organizer->updated_id = Auth::user()->id;
        
        if($request->hasFile('image'))
        {
            $file = $request->file('image');
            $filename = strtotime('now') . '.' . $file->getClientOriginalExtension();
            $path = 'uploads/organizer/';
            $file->move($path, $filename);
            $organizer->image = $path . $filename;
        }
        
        $organizer->save();

        return redirect()->route('organizers.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if (!check_user_access(Session::get('user_access'), 'organizer_read')) {
            return redirect('/');
        }

        $id = base64_decode($id);
        $data['organizer'] = Organizer::find($id);
        return view('organizer.show', compact('data'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        if(!check_user_access(Session::get('user_access'), 'organizer_update')){
            return redirect('/');
        }

        $id = base64_decode($id);

        $data['actions'] = 'update';
        $data['organizer'] = Organizer::find($id);
        return view('organizer.organizer', compact('data'));
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
        if(!check_user_access(Session::get('user_access'), 'organizer_update')){
            return redirect('/');
        }

        $summary = json_decode($request->summary);

        $id = base64_decode($id);

        $organizer = Organizer::find($id);
        $organizer->nama = $summary->nama;
        $organizer->keterangan = $summary->keterangan;
        $organizer->status = $summary->status;
        $organizer->updated_id = Auth::user()->id;

        if($request->hasFile('image')){
            if(File::exists($organizer->image)){
                unlink($organizer->image);
            }

            $file = $request->file('image');
            $filename = strtotime('now') . '.' . $file->getClientOriginalExtension();
            $path = 'uploads/organizer/';
            $file->move($path, $filename);
            $organizer->image = $path . $filename;
        }

        $organizer->save();

        return redirect()->route('organizers.index');
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
            "image" => (isset($columns[4]['search']['value'])) ? $columns[4]['search']['value'] : "",
            "status" => (isset($columns[5]['search']['value'])) ? $columns[5]['search']['value'] : "",
            "created_at" => (isset($columns[6]['search']['value'])) ? $columns[6]['search']['value'] : "",
            "user_create" => (isset($columns[7]['search']['value'])) ? $columns[7]['search']['value'] : "",
            "updated_at" => (isset($columns[8]['search']['value'])) ? $columns[8]['search']['value'] : "",
            "user_update" => (isset($columns[9]['search']['value'])) ? $columns[9]['search']['value'] : "",
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
        else if ($order_index == 3)
            $order_field = 'image';
        else if ($order_index == 5)
            $order_field = 'status';
        else if ($order_index == 6)
            $order_field = 'created_at';
        else if ($order_index == 7)
            $order_field = 'user_create_name';
        else if ($order_index == 8)
            $order_field = 'updated_at';
        else if ($order_index == 9)
            $order_field = 'user_update_name';
        else
            $order_field = 'id';

        $order_ascdesc = $_GET['order'][0]['dir'];

        $organizer = new Organizer();

        $sql_total = $organizer->count();
        $sql_filter = $organizer->filter(
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
            if (check_user_access(Session::get('user_access'), 'organizer_update')) {
                $action .= "<a class='btn btn-info btn-xl' href='" . route('organizers.edit', base64_encode($value->id)) . "'><i class='fa fa-fw fa-pencil'></i> Edit</a>";
            }
            if (check_user_access(Session::get('user_access'), 'organizer_read')) {
                $action .= "<a class='btn btn-success btn-xl' href='" . route('organizers.show', base64_encode($value->id)) . "'><i class='fa fa-fw fa-eye'></i> Detail</a>";
            }
            if(check_user_access(Session::get('user_access'), 'organizer_manage')){
                $action .= "<a class='btn btn-success btn-xl' href='" . route('organizers.manageTeam', base64_encode($value->id)) . "'><i class='fa fa-fw fa-gear'></i> Manage Team</a>";
            }

            $row[] = $action;
            $row[] = $value->id;
            $row[] = $value->nama;
            $row[] = $value->keterangan;
            $row[] = $value->image;
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

    public function manageTeam($id)
    {
        if(!check_user_access(Session::get('user_access'), 'organizer_manage'))
        {
            return redirect('/');
        }

        $id = base64_decode($id);

        $data['id_organizer'] = $id;

        $data['member'] = OrganizerMember::where('id_organizer', $id)->get();

        foreach ($data['member'] as $member) {
            $member->id_m_member = $member->member->nama;
            $member->id_organizer_role = $member->role->nama;
        }

        $data['role'] = OrganizerRole::where('id_organizer', $id)->get();

        foreach ($data['role'] as $role) {
            $role->created_id = $role->user_create->name;
            $role->updated_id = $role->user_update->name;
        }

        return view('organizer.team.index', compact('data'));
    }

    public function createRole($id)
    {
        if(!check_user_access(Session::get('user_access'), 'organizer_create'))
        {
            return redirect('/');
        }

        $data['actions'] = 'store';
        $data['id_organizer'] = $id;
        $data['role_permission'] = MRolePermission::where('status', 1)->get();
        return view('organizer.team.role', compact('data'));
    }

    public function storeRole(Request $request, $id)
    {
        if(!check_user_access(Session::get('user_access'), 'organizer_create'))
        {
            return redirect('/');
        }

        $summary = json_decode($request->summary);

        $organizer_role = new OrganizerRole();
        $organizer_role->nama = $summary->nama;
        $organizer_role->keterangan = $summary->keterangan;
        $organizer_role->status = $summary->status;
        $organizer_role->id_organizer = base64_decode($id);
        $organizer_role->created_id = Auth::user()->id;
        $organizer_role->updated_id = Auth::user()->id;
        $organizer_role->save();

        $organizer_role->permissions()->attach($summary->permissions);

        return redirect()->route('organizers.manageTeam', $id);
    }

    public function editRole($id_organizer, $id_role)
    {
        if(!check_user_access(Session::get('user_access'), 'organizer_update'))
        {
            return redirect('/');
        }

        $id_role = base64_decode($id_role);

        $data['actions'] = 'update';
        $data['role_permission'] = MRolePermission::where('status', 1)->get();
        $data['organizer_role'] = OrganizerRole::find($id_role);

        return view('organizer.team.role', compact('data'));
    }

    public function updateRole(Request $request, $id_organizer, $id_role)
    {
        if (!check_user_access(Session::get('user_access'), 'organizer_update')) {
            return redirect('/');
        }

        $summary = json_decode($request->summary);

        $id_role = base64_decode($id_role);

        $organizer_role = OrganizerRole::find($id_role);

        $organizer_role->permissions()->detach();

        $organizer_role->nama = $summary->nama;
        $organizer_role->keterangan = $summary->keterangan;
        $organizer_role->status = $summary->status;
        $organizer_role->updated_id = Auth::user()->id;
        $organizer_role->save();

        $organizer_role->permissions()->attach($summary->permissions);

        return redirect()->route('organizers.manageTeam', $id_organizer);
    }

    public function createMember($id)
    {
        if (!check_user_access(Session::get('user_access'), 'organizer_create')) {
            return redirect('/');
        }

        $data['actions'] = 'store';
        $data['id_organizer'] = $id;
        $data['member'] = Member::where('status', 1)->get();
        $data['organizer_role'] = OrganizerRole::where('status', 1)->where('id_organizer', base64_decode($id))->get();
        return view('organizer.team.member', compact('data'));
    }

    public function storeMember(Request $request, $id)
    {
        if (!check_user_access(Session::get('user_access'), 'organizer_create')) {
            return redirect('/');
        }

        $summary = json_decode($request->summary);

        $organizer_member = new OrganizerMember();
        $organizer_member->id_organizer = base64_decode($id);
        $organizer_member->id_m_member = $summary->id_m_member;
        $organizer_member->id_organizer_role = $summary->id_organizer_role;
        $organizer_member->save();

        return redirect()->route('organizers.manageTeam', $id);
    }

    public function editMember($id_organizer, $id_member)
    {
        if (!check_user_access(Session::get('user_access'), 'organizer_update')) {
            return redirect('/');
        }

        $id_member = base64_decode($id_member);
        
        $data['actions'] = 'update';
        $data['organizer_member'] = OrganizerMember::find($id_member);
        $data['member'] = Member::where('status', 1)->get();
        $data['organizer_role'] = OrganizerRole::where('status', 1)->where('id_organizer', base64_decode($id_organizer))->get();
        return view('organizer.team.member', compact('data'));
    }

    public function updateMember(Request $request, $id_organizer, $id_member)
    {
        if (!check_user_access(Session::get('user_access'), 'organizer_update')) {
            return redirect('/');
        }

        $summary = json_decode($request->summary);

        $id_member = base64_decode($id_member);

        $organizer_member = OrganizerMember::find($id_member);
        $organizer_member->id_m_member = $summary->id_m_member;
        $organizer_member->id_organizer_role = $summary->id_organizer_role;
        $organizer_member->save();

        return redirect()->route('organizers.manageTeam', $id_organizer);
    }
}
