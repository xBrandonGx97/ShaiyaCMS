@extends('layouts.app')
@section('content')
    @include('home.inc.page_bg')
    @include('home.inc.page_border')
    <header class="nk-header nk-header-opaque">
        @include('inc.cms.topNav')
        @include('inc.cms.nav')
    </header>
    @include('inc.cms.rightNav')
    @include('inc.cms.mobileNav')
    <div class="nk-main">
        @include('inc.cms.signForms')
        <div class="container text-xs-center">
            <div class="nk-gap-6"></div>
            <div class="nk-gap-2"></div>
            <div class="container">
                <div class="row">
                    <div class="col-md-8 offset-md-2">
                        @if (!$data['User']['LoginStatus']==true)
                            <p>Please login to continue.</p>
                        @else
                            <div class="nk-tabs">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li class="nav-item">
                                        <a class="nav-link active" href="#tabs-3-1" role="tab" data-toggle="tab">My Tickets</a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link open_send_ticket_modal" data-id="{{$data['User']['UserUID']}}" data-toggle="modal" data-target="#get_ticket_modal" href="#">New Ticket</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane fade show active" id="tabs-3-1">
                                        <div class="nk-gap-2"></div>
                                        <div class="table-responsive" id="TableLoader">
                                            <table class="table table-dark2" id="TabularData">
                                                <thead>
                                                    <tr class="tac">
                                                        <td>Ticket ID</td>
                                                        <td>Subject</td>
                                                        <td>Status</td>
                                                        <td>Last Updated</td>
                                                        <td>Edit</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @foreach($data['support']->fet as $fet)
                                                        <tr>
                                                            <td class="tac">{{$fet['TicketID']}}</td>
                                                            <td class="tac">{{$fet['Subject']}}</td>
                                                            <td class="tac">{{$data['support']->getStatus($fet['Status'])}}</td>
                                                            <td class="tac">{{date("M d, Y h:i A", strtotime($fet['Date']))}}</td>
                                                            <td class="tac"><button class="nk-btn nk-btn-color-main-1 open_edit_ticket_modal" data-toggle="modal" data-id="{{$fet['UserUID']}}~{{$fet['TicketID']}}~{{$fet['Category']}}~{{$fet['Subject']}}~{{$fet['Message']}}~{{$fet['Status']}}~{{$fet['Date']}}" data-target="#get_e_ticket_modal">Edit</button></td>
                                                        </tr>
                                                    @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="nk-gap-2"></div>'
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        @php Separator(120); @endphp
        @php
            Display('get_ticket_modal','<i class="fa fa-send"></i>','0','2','Send Ticket');
            Display('get_e_ticket_modal','<i class="fa fa-send"></i>','1','2','Edit Ticket');
        @endphp
    </div>
@endsection