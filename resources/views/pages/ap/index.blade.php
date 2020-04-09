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
                    @auth
                        @if($data['user']->isStaff())
                            {{-- is admin --}}
                            @if($data['user']->isADM())
                                {{-- panels --}}
                                <div class="row">
                                    @include('partials.ap.panels.newlyRegistered')
                                    @include('partials.ap.panels.totalAccounts')
                                    @include('partials.ap.panels.online')
                                    @include('partials.ap.panels.spentPoints')
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
                            {{-- You must be logged in to access the admin dashboard. --}}
                            {{-- Sorry, you do not have permission to control the admin panel. --}}
                            {{-- {{redirect('/')}} --}}
                            {{abort(404)}}
                        @endif
                    @else
                        {{redirect('/admin/auth/login')}}
                        {{-- You must be logged in to control the admin panel. --}}
                    @endauth
                </div>
            </div>
        </div>
    </div>
@endsection
