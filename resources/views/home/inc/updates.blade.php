<div class="nk-gap-6"></div>
<div class="nk-gap-2"></div>
<div class="nk-carousel-2" data-autoplay="12000" data-dots="true">
    <div class="nk-carousel-inner">
        <!-- SQL Query -->
        @if(count($data['news']) > 1)
            @foreach($data['news'] as $news)
                <div>
                    <div>
                        <blockquote class="nk-testimonial-2">
                            <div class="nk-testimonial-body">
                                <h2>{{$news->Title}}</h2>
                                <em>{{$news->Detail}}</em>
                            </div>
                            <div class="nk-testimonial-name h4">{{$news->UserID}}</div>
                            <div class="nk-testimonial-source">{{date('F d, Y', strtotime($news->Date))}}</div>
                        </blockquote>
                    </div>
                </div>
            @endforeach
        @else
            <p>No News found. Please check back later.</p>
        @endif
    </div>
<div class="nk-gap-2"></div>
<div class="nk-gap-6"></div>