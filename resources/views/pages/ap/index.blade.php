@extends('layouts.ap.app')
@section('index', 'dashboard')
@section('title', 'Dashboard')
@section('zone', 'AP')
@section('content')
    @include('partials.ap.nav')
    @include('partials.ap.header')
    <div class="pcoded-main-container">
        <div class="pcoded-wrapper">
            <div class="pcoded-content">
                <div class="pcoded-inner-content">
                    <div class="row">
                        @include('partials.ap.panels.newlyRegistered')
                        @include('partials.ap.panels.totalAccounts')
                        @include('partials.ap.panels.onlineLast24')
                        @include('partials.ap.panels.onlineCurrent')
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
