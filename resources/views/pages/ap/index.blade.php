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
                                <div class="col-md-6 m_t_10">
                                    <div id="content_card" class="card custom-card">
                                        <div class="card-header cstm-card-head tac">
                                            <i class="fas fa-clock"></i>
                                            Admin Panel Action Log
                                        </div>
                                        <div class="card-block content_bg content pContent">
                                            <div class="card-text">
                                                <div class="table-responsive">
                                                    <table class="table table-striped table-dark">
                                                        <thead>
                                                            <tr>
                                                                <th>Action</th>
                                                                <th>Time</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <tr>
                                                                @foreach ($data['panels']['actionLogs'] as $action)
                                                                    <td>{{$action->UserID}} - {{$action->Action}}</td>
                                                                    <td>
                                                                        <span class="badge badge-pill badge-secondary">{{$data['data']->getDateDiff($action->ActionTime)}}</span>
                                                                    </td>
                                                                @endforeach
                                                            </tr>
                                                        </tbody>
                                                    </table>
                                                </div>
                                            </div>
                                            <div class="text-center">
                                                <a class="badge badge-pill badge-primary b_i f14" href="/admin/accesslogs">View All Activity</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @else
                        You must be logged in to access the admin dashboard.
                    @endif
                </div>
            </div>
        </div>
    </div>
@endsection
