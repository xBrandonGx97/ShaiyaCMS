<!doctype html>
<html lang="{{$_SESSION['Settings']['SITE_LANG']}}">
    <head>
        @if ($data['pageData']['zone']=='CMS')
            @include('inc.cms.head')
            @else
                @include('inc.ap.head')
        @endif
    </head>
    <body>
        @yield('content')
        @if ($data['pageData']['zone']=='CMS')
		    @include('inc.cms.footer')
            @else
                @include('inc.ap.footer')
        @endif
    </body>
</html>