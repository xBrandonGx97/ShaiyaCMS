<div class="col-lg-8">
    <!-- START: Posts List -->
    <div class="nk-blog-list-classic">
        <!-- START: Post -->
        @if(count($data['news']) > 0)
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
        @endif
        <!-- END: Post -->
        <!-- START: Pagination -->
        <div class="nk-pagination nk-pagination-center">
            <nav>
                <a href="#" class="nk-pagination-current-white" style="pointer-events:none;">1</a>
                <a href="community/news?Page=2">2</a>
            </nav>
        </div>
        <!-- END: Pagination -->
    </div>
    <!-- END: Posts List -->
</div>
