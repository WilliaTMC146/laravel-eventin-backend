@extends('layout.master')
@section('title', 'Manage Team')
@section('content')
<?php

use Carbon\Carbon;
?>
<div class="right_col" role="main">
    <div class="">
        <div class="row top_tiles">
            <div class="wrapper">
                <div class="row" id="row-report">
                    <div class="col-md-12">
                        <section class="panel">
                            <header class="panel-heading">
                                Member
                            </header>
                            <div class="panel-body" id="toro-area">
                                <a class="btn btn-info" href="{{ route('organizers.createMember', base64_encode($data['id_organizer'])) }}">Tambah Member</a>
                                <div id="btnbar" style="float: right; margin-bottom: 10px"></div>
                                <table id="toro-data" class=" table table-hover table-bordered convert-data-table display" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Actions</th>
                                            <th>ID</th>
                                            <th>Nama</th>
                                            <th>Role</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Actions</th>
                                            <th>ID</th>
                                            <th>Nama</th>
                                            <th>Role</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </section>
                        <section class="panel">
                            <header class="panel-heading">
                                Role
                            </header>
                            <div class="panel-body" id="toro-area">
                                <a class="btn btn-info" href="{{ route('organizers.createRole', base64_encode($data['id_organizer'])) }}">Tambah Role</a>
                                <div id="btnbar2" style="float: right; margin-bottom: 10px"></div>
                                <table id="toro-data2" class=" table table-hover table-bordered convert-data-table display" width="100%">
                                    <thead>
                                        <tr>
                                            <th>Actions</th>
                                            <th>ID</th>
                                            <th>Nama</th>
                                            <th>Keterangan</th>
                                            <th>Status</th>
                                            <th>Created At</th>
                                            <th>Created By</th>
                                            <th>Updated At</th>
                                            <th>Updated By</th>
                                        </tr>
                                    </thead>
                                    <tfoot>
                                        <tr>
                                            <th>Actions</th>
                                            <th>ID</th>
                                            <th>Nama</th>
                                            <th>Keterangan</th>
                                            <th>Status</th>
                                            <th>Created At</th>
                                            <th>Created By</th>
                                            <th>Updated At</th>
                                            <th>Updated By</th>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </section>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('footerScripts')
<link href="{{ asset ('semantic/components/icon.min.css') }}" rel="stylesheet">
<link href="{{ asset ('semantic/components/statistic.min.css') }}" rel="stylesheet">
<link href="{{ asset ('semantic/components/card.css') }}" rel="stylesheet">
<link href="{{ asset ('js/data-table/css/dataTables.bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset ('js/data-table/buttons/buttons.bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset ('js/data-table/colreorder/colReorder.bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset ('js/data-table/keytable/keyTable.bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset ('js/data-table/fixedheader/fixedHeader.bootstrap.min.css') }}" rel="stylesheet">
<link href="{{ asset ('js/data-table/fixedcolumns/fixedColumns.bootstrap.min.css') }}" rel="stylesheet">

<script src="{{ asset ('js/data-table/js/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset ('js/data-table/js/dataTables.bootstrap.min.js') }}"></script>
<script src="{{ asset ('js/data-table/buttons/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset ('js/data-table/buttons/buttons.bootstrap.min.js') }}"></script>
<script src="{{ asset ('js/data-table/buttons/buttons.flash.min.js') }}"></script>
<script src="{{ asset ('js/data-table/buttons/jszip.min.js') }}"></script>
<script src="{{ asset ('js/data-table/buttons/pdfmake.min.js') }}"></script>
<script src="{{ asset ('js/data-table/buttons/vfs_fonts.js') }}"></script>
<script src="{{ asset ('js/data-table/buttons/buttons.html5.min.js') }}"></script>
<script src="{{ asset ('js/data-table/buttons/buttons.print.min.js') }}"></script>
<script src="{{ asset ('js/data-table/buttons/buttons.colVis.min.js') }}"></script>
<script src="{{ asset ('js/data-table/colreorder/dataTables.colReorder.min.js') }}"></script>
<script src="{{ asset ('js/data-table/keytable/dataTables.keyTable.min.js') }}"></script>
<script src="{{ asset ('js/data-table/fixedheader/dataTables.fixedHeader.min.js') }}"></script>
<script src="{{ asset ('js/data-table/fixedcolumns/dataTables.fixedColumns.min.js') }}"></script>
@endsection

@section('script')
<script type="text/javascript">
    function datatable(btnBarElement, tableElement, footElement, data, column) {
        $(footElement).each(function() {
            var title = $(this).text();
            $(this).html('<input type="text" class="form-control" name="search_tabel" placeholder="Search ' + title + '" />');
        });
        tabel = $(tableElement).DataTable({
            "responsive": true,
            "ordering": true,
            "data": data,
            "columns": column,
            "PaginationType": "bootstrap",
        });

        new $.fn.dataTable.Buttons(tabel, {
            buttons: [{
                extend: 'copyHtml5',
                exportOptions: {
                    columns: [':visible']
                }
            }, {
                extend: 'csvHtml5',
                exportOptions: {
                    columns: [':visible']
                }
            }, {
                extend: 'excelHtml5',
                exportOptions: {
                    columns: [':visible']
                }
            }, {
                extend: 'pdfHtml5',
                orientation: 'landscape',
                pageSize: 'LEGAL',
                exportOptions: {
                    columns: [':visible']
                }
            }, {
                extend: 'print',
                exportOptions: {
                    columns: [':visible']
                }
            }, 'colvis']
        });

        tabel.buttons().container().appendTo($(btnBarElement));

        tabel.columns().every(function() {
            var that = this;
            $('input', this.footer()).on('keyup change', function() {
                if (that.search() !== this.value) {
                    that.search(this.value).draw();
                }
            });
        });
    }

    $(document).ready(function() {
        datatable('#btnbar', '#toro-data', '#toro-data tfoot th', <?= $data['member'] ?>, [{
            data: 'id',
            render: function(value) {
                var actions = "<a class='btn btn-info btn-xl' href='<?= url('organizers') . '/' . base64_encode($data['id_organizer']) . '/member/' ?>" + btoa(value) + "/edit'><i class='fa fa-fw fa-pencil'></i> Edit</a>";
                actions += "<a class='btn btn-success btn-xl' href='<?= url('organizers') . '/' . base64_encode($data['id_organizer']) . '/member/' ?>" + btoa(value) + "'><i class='fa fa-fw fa-eye'></i> Detail</a>";
                return actions;
            }
        }, {
            data: 'id'
        }, {
            data: 'id_m_member'
        }, {
            data: 'id_organizer_role'
        }]);

        datatable('#btnbar2', '#toro-data2', '#toro-data2 tfoot th', <?= $data['role'] ?>, [{
            data: 'id',
            render: function(value) {
                var actions = "<a class='btn btn-info btn-xl' href='<?= url('organizers') . '/' . base64_encode($data['id_organizer']) . '/role/' ?>" + btoa(value) + "/edit'><i class='fa fa-fw fa-pencil'></i> Edit</a>";
                actions += "<a class='btn btn-success btn-xl' href='<?= url('organizers') . '/' . base64_encode($data['id_organizer']) . '/role/' ?>" + btoa(value) + "'><i class='fa fa-fw fa-eye'></i> Detail</a>";
                return actions;
            }
        }, {
            data: 'id'
        }, {
            data: 'nama'
        }, {
            data: 'keterangan'
        }, {
            data: 'status'
        }, {
            data: 'created_at',
        }, {
            data: 'created_id'
        }, {
            data: 'updated_at'
        }, {
            data: 'updated_id'
        }]);
    });
</script>
@endsection