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
        <div class="container">
            @php
                Display('new_topic_modal','<i class="fas fa-plus"></i>','0','2','Create New Topic');
                $url = checkUrl();
            @endphp
            @if ($data['User']['LoginStatus']==true)
                <button class="nk-btn nk-btn-lg link-effect-4 float-right open_new_topic_modal" id="reply_submit" data-id="{{$url[2]}}~{{$data['User']['DisplayName']}}" data-target="#new_topic_modal" data-toggle="modal">Create New Topic</button>
            @endif
            <div class="nk-gap-4"></div>
            @php
                $topicID  =   $data['topicID'];
                $data['forum']->getTopics($topicID);
                $data['forum']->getPinnedTopics($topicID);
            @endphp
            <!-- START: Forums List -->
            @if(count($data['forum']->fetch) > 0)
                <ul class="nk-forum">
                    @foreach($data['forum']->fetch as $topic)
                        @php
                            $data['forum']->getPostCount($topic->TopicID);
                            $data['forum']->getPostTitle($topic->TopicID);
                            $data['forum']->getPostBody($topic->TopicID);
                            $data['forum']->getPostDate($topic->TopicID);
                        @endphp
                        <li>
                            <div class="nk-forum-icon">
                                <span class="ion-pin"></span>
                            </div>
                            <div class="nk-forum-title">
                                <h3><a href="/forum/topics/view_topic/{{$topic->TopicID}}">{{$topic->PostTitle}}</a></h3>
                                <div class="nk-forum-title-sub">Started by <a href="#">{{$topic->PostAuthor}}</a> on {{date("M d, Y", strtotime($topic->PostDate))}}</div>
                            </div>
                            <div class="nk-forum-count">
                                @if($data['forum']->postCount->Posts == 1)
                                    {{$data['forum']->postCount->Posts}} post
                                @else
                                    {{$data['forum']->postCount->Posts}} posts
                                @endif
                            </div>
                            <div class="nk-forum-activity-avatar">
                                <img src="/resources/themes/godlike/images/avatar-1-sm.jpg" alt="Lesa Cruz">
                            </div>
                            <div class="nk-forum-activity">
                                <div class="nk-forum-activity-title" title="{{$data['forum']->postTitle->PostTitle}}">
                                    @if(!empty($data['forum']->postTitle))
                                        <a href="forum-single-topic.html">{{$data['forum']->postBody->PostBody}}</a>
                                    @else
                                        —

                                    @endif
                                </div>
                                <div class="nk-forum-activity-date">
                                    @if(!empty($data['forum']->postDate))
                                        {{date("M d, Y", strtotime($data['forum']->postDate->PostDate))}}
                                    @endif
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @endif
            <div class="nk-gap-2"></div>
            @if(count($data['forum']->row) > 0)
                <ul class="nk-forum">
                @foreach($data['forum']->row as $topic)
                    @php
                        $data['forum']->getPostCount($topic->TopicID);
                        $data['forum']->getPostTitle($topic->TopicID);
                        $data['forum']->getPostBody($topic->TopicID);
                        $data['forum']->getPostDate($topic->TopicID);
                    @endphp
                    <li>
                        <div class="nk-forum-icon">
                            <span class="ion-ios-game-controller-b"></span>
                        </div>
                        <div class="nk-forum-title">
                            <h3><a href="/forum/topics/view_topic/{{$topic->TopicID}}">{{$topic->PostTitle}}</a></h3>
                            <div class="nk-forum-title-sub">Started by <a href="#">{{$topic->TopicAuthor}}</a> on {{date("M d, Y", strtotime($topic->TopicDate))}}</div>
                        </div>
                        <div class="nk-forum-count">
                            @if($data['forum']->postCount->Posts == 1)
                                {{$data['forum']->postCount->Posts}} post
                            @else
                                {{$data['forum']->postCount->Posts}} posts
                            @endif
                        </div>
                        <div class="nk-forum-activity-avatar">
                            <img src="/resources/themes/godlike/images/avatar-1-sm.jpg" alt="Lesa Cruz">
                        </div>
                        <div class="nk-forum-activity">
                            <div class="nk-forum-activity-title" title="{{$data['forum']->postTitle->PostTitle}}">
                                @if(!empty($data['forum']->postTitle))
                                    <a href="forum-single-topic.html">{{$data['forum']->postBody->PostBody}}</a>
                                @else
                                    —

                                @endif
                            </div>
                            <div class="nk-forum-activity-date">
                                @if(!empty($data['forum']->postDate))
                                    {{date("M d, Y", strtotime($data['forum']->postDate->PostDate))}}
                                @endif
                            </div>
                        </div>
                    </li>
                @endforeach
                </ul>
            @else
                {{--<p>No Topics found. Please check back later.</p>--}}
            @endif
            @if(!count($data['forum']->row) > 0 && !count($data['forum']->fetch) > 0)
                <p>No Topics found. Please check back later.</p>
            @endif
            {{--<ul class="nk-forum">
                <li>
                    <div class="nk-forum-icon">
                        <span class="ion-pin"></span>
                    </div>
                    <div class="nk-forum-title">
                        <h3><a href="forum-single-topic.html">Suggestions</a></h3>
                        <div class="nk-forum-title-sub">Started by <a href="#">nK</a> on January 17, 2017</div>
                    </div>
                    <div class="nk-forum-count">
                        178 posts
                    </div>
                    <div class="nk-forum-activity-avatar">
                        <img src="assets/images/avatar-1-sm.jpg" alt="Lesa Cruz">
                    </div>
                    <div class="nk-forum-activity">
                        <div class="nk-forum-activity-title" title="Lesa Cruz">
                            <a href="#">Lesa Cruz</a>
                        </div>
                        <div class="nk-forum-activity-date">
                            September 11, 2017
                        </div>
                    </div>
                </li>
            </ul>--}}
            <!-- END: Forums List -->
        </div>
    @php Separator(120); @endphp
    </div>
    <script>
        $(document).ready(function(){
            $(document).on('click', '.open_new_topic_modal', function (e) {
                e.preventDefault();

                var uid = $(this).data("id");

                $('#new_topic_modal #dynamic-content').html('');
                $('#new_topic_modal #modal-loader').show();
                $.ajax({
                    url: "/resources/jquery/addons/ajax/blade/init.forum_new_topic.php",
                    type: 'POST',
                    data: "id="+uid,
                    dataType: 'html'
                })
                .done(function (data) {
                    $('#new_topic_modal #dynamic-content').html('');
                    $('#new_topic_modal #dynamic-content').html(data);
                    $('#new_topic_modal #modal-loader').hide();
                })
                .fail(function () {
                    $('#new_topic_modal #dynamic-content').html('<i class="fa fa-exclamation-triangle"></i> Something went wrong, Please try again...');
                    $('#new_topic_modal #modal-loader').hide();
                });
            });
        });
    </script>
@endsection