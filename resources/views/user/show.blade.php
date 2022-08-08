@extends('layout.master')
@section('title', 'User Detail')
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
                                User Detail
                            </header>
                            <div class="panel-body" id="toro-area">
                                <div class="ui card" style="width: 100%;">
                                    <div class="content">
                                        <div class="header">General</div>
                                    </div>
                                    <div class="content">
                                        <div class="description">
                                            <p><b>Name : </b> {{ $data['user']->name }}</p>
                                            <p><b>Email : </b> {{ $data['user']->email }} </p>
                                            <p><b>Access Group : </b> {{ $data['user']->access_group->nama }} </p>
                                            <p><b>Created At : </b> {{ date_format(Carbon::createFromFormat('Y-m-d H:i:s', $data['user']->created_at, 'UTC')->tz('Asia/Jakarta'), 'd-m-Y H:i:s') }}</p>
                                            <p><b>Updated At : </b> {{ date_format(Carbon::createFromFormat('Y-m-d H:i:s', $data['user']->updated_at, 'UTC')->tz('Asia/Jakarta'), 'd-m-Y H:i:s') }}</p>
                                        </div>
                                    </div>
                                </div>
                                <div class="ui card" style="width: 100%;">
                                    <div class="content">
                                        <div class="header">Statistics</div>
                                    </div>
                                    <div class="content">
                                        <div class="description">
                                            <div class="ui one statistics">
                                                <div class="statistic">
                                                    <div class="value">
                                                        {{ $data['user']->access_group->access_masters->count() }}
                                                    </div>
                                                    <div class="label">
                                                        Access Master
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="ui card" style="width: 100%;">
                                    <div class="content">
                                        <div class="header">Access Detail</div>
                                    </div>
                                    <div class="content">
                                        <div class="description">
                                            <div id="btnbar" style="float: right; margin-bottom: 10px"></div>
                                            <table id="toro-data" class=" table table-hover table-bordered convert-data-table display" width="100%">
                                                <thead>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Access Master</th>
                                                        <th>Keterangan</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </thead>
                                                <tfoot>
                                                    <tr>
                                                        <th>ID</th>
                                                        <th>Access Master</th>
                                                        <th>Keterangan</th>
                                                        <th>Actions</th>
                                                    </tr>
                                                </tfoot>
                                            </table>
                                        </div>
                                    </div>
                                </div>
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
    $(document).ready(function() {
        $('#toro-data tfoot th').each(function() {
            var title = $(this).text();
            $(this).html('<input type="text" class="form-control" name="search_tabel" placeholder="Search ' + title + '" />');
        });
        tabel = $('#toro-data').DataTable({
            "responsive": true,
            "ordering": true,
            "data": <?= $data['user']->access_group->access_masters ?>,
            "columns": [{
                    data: 'id'
                },
                {
                    data: 'nama'
                },
                {
                    data: 'keterangan'
                },
                {
                    data: 'id',
                    render: function(value) {
                        return "<a class='btn btn-success btn-xl' href='<?= url('access_masters') . '/' ?>" + btoa(value) + "'><i class='fa fa-fw fa-eye'></i> Detail</a>";
                    }
                }
            ],
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

        tabel.buttons().container().appendTo($('#btnbar'));

        tabel.columns().every(function() {
            var that = this;
            $('input', this.footer()).on('keyup change', function() {
                if (that.search() !== this.value) {
                    that.search(this.value).draw();
                }
            });
        });
    });
</script>
@endsection