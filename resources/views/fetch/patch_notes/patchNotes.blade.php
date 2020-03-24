<!-- START: Posts List -->
<div class="nk-blog-list-classic">
    <!-- START: Post -->
    <div id="patchData"></div>
    @if(count($data) > 0)
        @foreach($data as $news)
            <div class="nk-blog-post">
                <div class="nk-post-content bg-dark-2">
                    <h2 class="nk-post-title h3">
                    <a href="/News/Read/{{$news->RowID}}">{{$news->Title}} </a>
                    </h2>
                    <div class="nk-post-date">
                        {{date('F d, Y', strtotime($news->Date))}}
                    </div>
                    <div class="nk-post-text">
                        {!!$news->Detail!!}
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <p>No News found. Please check back later.</p>
    @endif
    <!-- END: Post -->
</div>
<!-- END: Posts List -->