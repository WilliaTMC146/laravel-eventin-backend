@extends('layout.master')
@section('title', 'Dashboard')
@section('content')
<?php

use Illuminate\Support\Facades\Session;
?>
<div class="right_col" role="main">

    @if(\Session::has('error'))
    <div class="alert alert-danger">
        <div>{{Session::get('error')}}</div>
    </div>
    @endif

    <?php if (strpos(Session::get('user_access'), 'dashboard') !== false) : ?>
        
    <?php else : ?>
        <h1 align="middle"> ... Welcome ... </h1>
        <h2 align="middle"> <small>to</small> </h2>
        <h3 align="middle"> Event </h3>
    <?php endif; ?>
</div>
@endsection
@section('footerScripts')
<link href="{{ asset ('semantic/components/grid.css') }}" rel="stylesheet">
<link href="{{ asset ('semantic/components/card.css') }}" rel="stylesheet">
<link href="{{ asset ('semantic/components/icon.css') }}" rel="stylesheet">
<link href="{{ asset ('semantic/components/image.css') }}" rel="stylesheet">
<link href="{{ asset ('semantic/components/header.css') }}" rel="stylesheet">
<script>
</script>
@parent
@endsection