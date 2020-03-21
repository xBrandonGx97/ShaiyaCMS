<!doctype html>
<html lang="{{$_SESSION['Settings']['SITE_LANG']}}">
    <head>
        @if ($__env->yieldContent('zone')==='CMS')
            @include('layouts.cms.head')
        @else
            {{-- include here --}}
        @endif
    </head>
    <body>
        @if ($__env->yieldContent('zone')==='CMS')
            @include('layouts.cms.body')
        @else
            {{-- include here --}}
        @endif
    </body>
</html>