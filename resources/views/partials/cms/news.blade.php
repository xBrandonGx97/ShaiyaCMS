@php
    $pagination = new Classes\Utils\Pagination;
    $records_per_page = 5;

    $content = trim(file_get_contents('php://input'));
    $decoded = json_decode($content, true);

    if (is_array($decoded)) {
        if (isset($decoded['page'])) {
            $page = $decoded['page'];
        } else {
            $page = 1;
        }
        $prevPage = $page - 1;
        $nextPage = $page + 1;
        $start_from = ($page - 1) * $records_per_page;
    }
    $pagination->sp($records_per_page,$prevPage,$nextPage,$page);
@endphp
<!-- START: Posts List -->
<div class="nk-blog-list-classic">
    <!-- START: Post -->
    <div id="newsData"></div>
    @if(count($data) > 0)
        @foreach($data as $news)
            <div class="nk-blog-post">
                <div class="nk-post-content bg-dark-2">
                    <h2 class="nk-post-title h3">
                        <a href="/News/Read/27">{{$news->Title}} </a>
                    </h2>
                    <div class="nk-post-date">
                        {{date('F d, Y', strtotime($news->Date))}}
                    </div>
                    <div class="nk-post-text">
                        {{$news->Detail}}
                    </div>
                </div>
            </div>
        @endforeach
    @endif
    {{-- @if(count($data['news']) > 0)
        @foreach($data['news'] as $news)
            <div class="nk-blog-post">
                <div class="nk-post-content bg-dark-2">
                    <h2 class="nk-post-title h3">
                        <a href="/News/Read/27">{{$news->Title}} </a>
                    </h2>
                    <div class="nk-post-date">
                        {{date('F d, Y', strtotime($news->Date))}}
                    </div>
                    <div class="nk-post-text">
                        {{$news->Detail}}
                    </div>
                </div>
            </div>
        @endforeach
    @endif --}}
    <!-- END: Post -->
    <!-- START: Pagination -->
    @php

    $pagination->sp($records_per_page,$prevPage,$nextPage,$page);
    #Pagination::showPages_Rankings($records_per_page,$prevPage,$nextPage,$page)
    @endphp
    {{-- <div class="nk-pagination nk-pagination-center">
        <nav>
            <a href="#" class="nk-pagination-current-white" style="pointer-events:none;">1</a>
            <a href="community/news?Page=2">2</a>
        </nav>
    </div> --}}
    <!-- END: Pagination -->
</div>
<!-- END: Posts List -->