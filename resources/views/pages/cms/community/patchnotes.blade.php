@extends('layouts.app')
@section('title', 'Patch Notes')
@section('content')
    @include('pages.cms.home.inc.page_bg')
    @include('pages.cms.home.inc.page_border')
    <header class="nk-header nk-header-opaque">
        @include('inc.cms.topNav')
        @include('inc.cms.nav')
    </header>
    @include('inc.cms.rightNav')
    @include('inc.cms.mobileNav')
    <div class="nk-main">
        @include('inc.cms.signForms')
        <div class="nk-gap-4"></div>
        <div class="container">'
            <h2 class="display-4 text-center">Patch Notes</h2>
            @if(count($data['patchnotes']) > 0)
                @foreach($data['patchnotes'] as $patchnotes)
                    <div class="row">
                        <div class="col-lg-8 offset-lg-2">
                            <div class="nk-box-3 bg-dark-1">
                                <h2 class="nk-title h3 text-xs-center">{{$patchnotes->Title}}</h2>
                                @php echo $patchnotes->Detail; @endphp
                                <span class="float-right">{{date('F d, Y', strtotime($patchnotes->Date))}}</span>
                            </div>
                        </div>
                    </div>
                    @php Separator(40); @endphp
                @endforeach
            @else
                <p>No Patch Notes found. Please check back later.</p>
            @endif
        </div>
        @php Separator(120); @endphp
    </div>
@endsection