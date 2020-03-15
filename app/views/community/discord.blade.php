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
                <h2 class="display-4">Discord</h2>
                <p>We want to stay in touch with our community, to do this it is important that we use discord. Doing this will bring everybody closer together and make it really easy to get updates,communicate with the players,staff and so on.</p>
                <p><a href="https://discord.gg/BYdTkgN" target="_blank">This</a> is our official Discord link.</p>
                <p><a href="https://discord.gg/BYdTkgN" target="_blank" class="nk-btn nk-btn-color-main-1">Click here to join</a></p>
                <h5>Why should I join?</h5>
                <p>You should join so you can stay up to date with our server and what is going on, what we plan to bring, change and the future of notorious.</p>
                <p>You can also contact our staff, report any issues that you may find,chat with other players in the community,and much more..</p>

                <h5>Whats Discord?</h5>
                <p>Discord is a proprietary freeware VoIP application and digital distribution platform designed for video gaming communities, that specializes in text, image, video and audio communication between users in a chat channel. Discord runs on Windows, macOS, Android, iOS, Linux, and in web browsers.</p>
                <h5>How can I join?</h5>
                <p><a href="https://support.discordapp.com/hc/en-us/articles/219470277-Getting-Started" target="_blank">Getting Started on Discord</a></p>
                <p><a href="https://discord.gg/BYdTkgN" target="_blank">Notorious Discord Server</a></p>
            </div>
        </div>
        @php Separator(120); @endphp
    </div>
@endsection