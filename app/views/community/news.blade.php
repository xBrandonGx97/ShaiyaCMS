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
        <div class="nk-gap-4"></div>
        <div class="container">'
            <h2 class="display-4 text-center">News</h2>
            @if(count($data['news']) > 0)
                @foreach($data['news'] as $news)
                    <div class="row">
                        <div class="col-lg-8 offset-lg-2">
                            <div class="nk-box-3 bg-dark-1">
                                <h2 class="nk-title h3 text-xs-center">{{$news->Title}}</h2>
                                <span>{{$news->Detail}}</span>
                                <span class="float-right">{{date('F d, Y', strtotime($news->Date))}}</span>
                                <span class="float-right"><strong>{{$news->UserID}}</strong> &nbsp;</span>
                            </div>
                        </div>
                    </div>
                    @php Separator(40); @endphp
                @endforeach
            @else
                <p>No News found. Please check back later.</p>
            @endif
        </div>
        @php Separator(120); @endphp
    </div>
@endsection