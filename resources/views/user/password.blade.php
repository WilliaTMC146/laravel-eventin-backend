@extends('layout.master')
@section('title', 'Change Password')
@section('content')
<div class="right_col" role="main">
    <div class="">
        <div class="row top_tiles">
            <div class="wrapper">
                <div class="row" id="row-report">
                    <div class="col-md-12">
                        <section class="panel">
                            <header class="panel-heading">
                                Change Password
                            </header>
                            <div class="panel-body" id="toro-area">
                                @if(\Session::has('error'))
                                <div class="alert alert-danger">
                                    <div>{{Session::get('error')}}</div>
                                </div>
                                @endif
                                <form id="toro-form" method="POST" action="{{ route('users.savePassword') }}">
                                    @csrf
                                    <div class="form-group">
                                        <label for="old_password">Old Password</label>
                                        <input type="password" class="form-control" id="old_password" name="old_password" placeholder="Enter Old Password" data-bind="value: oldPassword" required>
                                    </div>
                                    <div class="form-group">
                                        <label for="new_password">New Password</label>
                                        <input type="password" class="form-control" id="new_password" name="new_password" placeholder="Enter New Password" data-bind="value: newPassword" required>
                                    </div>
                                    <input type="hidden" name="summary" data-bind="value: ko.toJSON($root)">
                                    <button type="submit" class="btn btn-primary">Submit</button>
                                </form>
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
@parent
<link href="{{ asset ('semantic/components/checkbox.css') }}" rel="stylesheet">

<script src="{{ asset ('js/knockout.js') }}"></script>
<script src="{{ asset ('js/knockout-sortable.js') }}"></script>
<script src="{{ asset ('js/tinymce/tinymce.min.js') }}"></script>
<script src="{{ asset ('js/tinymce/jquery.tinymce.min.js') }}"></script>
<script src="{{ asset ('semantic/components/checkbox.js') }}"></script>
@endsection

@section('script')
<script>
    function UserViewModel() {
        var self = this;

        self.oldPassword = ko.observable();
        self.newPassword = ko.observable();
    }

    ko.applyBindings(new UserViewModel());

    $(document).ready(function() {});
</script>
@endsection