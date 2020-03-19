@extends('layouts.app')
@section('content')
    @include('inc.ap.header')
    <div id="wrapper">
        @include('inc.ap.nav')
        <div id="content-wrapper">
            <div class="container-fluid">
                @include('inc.ap.breadcrumb')
            </div>
        </div>
    </div>
@endsection