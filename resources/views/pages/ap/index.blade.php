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
                    {{-- is logged in and is staff --}}
                    @if($data['user']->isAuthorized())
                        {{-- is admin --}}
                        @if($data['user']->isADM())
                            {{-- panels --}}
                            <div class="row">
                                @include('partials.ap.panels.newlyRegistered')
                                @include('partials.ap.panels.totalAccounts')
                                @include('partials.ap.panels.onlineLast24')
                                @include('partials.ap.panels.onlineCurrent')
                            </div>
                            {{-- Action Logs --}}
                            <div class="row">
                                @include('partials.ap.panels.actionLogs')
                                @include('partials.ap.panels.gmLogs')
                            </div>
                            @Separator(10)
                            {{-- New Users --}}
                            @include('partials.ap.panels.newUsers')
                        @endif
                    @else
                        You must be logged in to access the admin dashboard.
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
