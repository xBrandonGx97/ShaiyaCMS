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
        @php
            Display('discord_modal','<i class="fas fa-user-plus"></i>','0','2','Discord Popup');
        @endphp

        <div class="container">
            <!-- START: Forums List -->
            @php
                $topicID  =   $data['topicID'];
                $data['forum']->getTopicPost($topicID);
                $data['forum']->getPosts($topicID);
            @endphp
            @if(count($data['forum']->get) > 0)
                @foreach($data['forum']->get as $post)

                @endforeach
            @endif
            @if(count($data['forum']->data) > 0)
                <ul class="nk-forum nk-forum-topic">
                @foreach($data['forum']->data as $post)
                    @php
                        $data['forum']->memberSince($post->PostAuthor);
                        $data['forum']->userStatus($post->PostAuthor);
                        $data['forum']->loginStatus($post->PostAuthor);
                        $data['forum']->getUserRoles($post->PostAuthor);
                        $data['forum']->getUserTitle($post->PostAuthor);
                        $data['forum']->getUserSocials($post->PostAuthor);
                        $data['forum']->getUserLikes($post->PostAuthor);
                        $data['forum']->getPostLikes($post->PostID);
                        $data['forum']->getUserPosts($post->PostAuthor);
                        $data['forum']->getUserSignature($post->PostAuthor);
                        $data['forum']->getDisplayName($post->PostAuthor);
                    @endphp
                    <li>
                        <div class="nk-forum-topic-author" style="width:150px !important;">
                            <img src="/resources/themes/godlike/images/avatar-1-sm.jpg" alt="Lesa Cruz">
                            <div class="nk-forum-topic-author-name" title="{{$post->PostAuthor}}">
                                {{--<a href="#">{{$post->PostAuthor}} <i class="fa fa-circle text-success" aria-hidden="true"></i></a>--}}
                                @if ($data['forum']->displayName)
                                    <a href="">{!!$data['forum']->displayName->DisplayName!!}</a>
                                @else
                                    <a href="">{{$post->PostAuthor}}</a>
                                @endif
                                @if($data['forum']->loginStatus == 1)
                                    <i class="fa fa-circle text-success" aria-hidden="true" title="Online"></i>
                                @else
                                    <i class="fa fa-circle text-danger" aria-hidden="true" title="Offline"></i>
                                @endif
                            </div>
                            {{--<div class="nk-forum-topic-author-role"><span>{{$data['forum']->userStatus}}</span></div>--}}
                            @if(!$data['forum']->customUserTitle)
                                @foreach ($data['forum']->userRoles as $role)
                                    @if($role->DisplayName == $post->PostAuthor)
                                        <div class="nk-forum-topic-author-role"><img src="/resources/themes/core/images/forum/ranks/{{$role->RoleName}}.png" style="width:125px"></div>
                                    @endif
                                @endforeach
                                 {{--<div class="nk-forum-topic-author-role"><img src="/resources/themes/core/images/forum/ranks/{{$data['forum']->roles[0]}}.png" style="width:100px"></div>--}}
                            @else
                                <div class="nk-forum-topic-author-role"><span>{{$data['forum']->customUserTitle}}</span></div>
                            @endif
                            <!-- <span class="username--style3 username--staff username--moderator username--admin">ENXF NET</span> -->
                            <div class="nk-forum-topic-author-since">
                                Member since {{date("F d, Y", strtotime($data['forum']->memberSince->JoinDate))}}
                            </div>
                            <div class="nk-forum-topic-author-posts">
                                Posts: {{$data['forum']->posts->Posts}}
                            </div>
                            <div class="nk-forum-topic-author-likes">
                                Likes: {{$data['forum']->likes->Likes}}
                            </div>
                            <div class="nk-forum-topic-author-social">
                                @foreach($data['forum']->socials as $social)
                                    @if ($social->Social == 'Discord')
                                        <a href="#" class="open_discord_modal" title="{{$social->SocialValue}}"  data-id="{{$social->SocialValue}}~{{$post->PostAuthor}}" data-target="#discord_modal" data-toggle="modal"><i class="fab fa-discord"></i></a>
                                    @elseif ($social->Social == 'Skype')
                                        <a href="skype:{{$social->SocialValue}}?chat" title="{{$social->SocialValue}}"><i class="fab fa-skype"></i></a>
                                    @elseif ($social->Social == 'Steam')
                                        <a href="" title="{{$social->SocialValue}}"><i class="fab fa-steam"></i></a>
                                    @endif
                                @endforeach
                                {{--<a href=""><i class="fab fa-discord"></i></a>
                                <a href=""><i class="fab fa-skype"></i></a>
                                <a href=""><i class="fab fa-steam"></i></i></a>--}}
                            </div>
                        </div>
                        @if ($data['User']['LoginStatus']==true)
                            <div class="mod-actions float-right">
                                <div class="dropdown">
                                    <i class="fa fa-ellipsis-v dropbtn" aria-hidden="true"></i>
                                        <div class="dropdown-content">
                                            <a href="#" class="link-effect-4 ready"><span class="link-effect-inner"><span class="link-effect-l"><span>Pin Topic</span></span><span class="link-effect-r"><span>Pin Topic</span></span><span class="link-effect-shade"><span>Pin Topic</span></span></span></a>
                                            <a href="#" class="link-effect-4 ready"><span class="link-effect-inner"><span class="link-effect-l"><span>Move Topic</span></span><span class="link-effect-r"><span>Move Topic</span></span><span class="link-effect-shade"><span>Move Topic</span></span></span></a>
                                            <a href="#" class="link-effect-4 ready"><span class="link-effect-inner"><span class="link-effect-l"><span>Edit Topic</span></span><span class="link-effect-r"><span>Edit Topic</span></span><span class="link-effect-shade"><span>Edit Topic</span></span></span></a>
                                            <a href="#" class="link-effect-4 ready"><span class="link-effect-inner"><span class="link-effect-l"><span>Close Topic</span></span><span class="link-effect-r"><span>Close Topic</span></span><span class="link-effect-shade"><span>Close Topic</span></span></span></a>
                                            <a href="#" class="link-effect-4 ready"><span class="link-effect-inner"><span class="link-effect-l"><span>Open Topic</span></span><span class="link-effect-r"><span>Open Topic</span></span><span class="link-effect-shade"><span>Open Topic</span></span></span></a>
                                            <a href="#" class="link-effect-4 ready"><span class="link-effect-inner"><span class="link-effect-l"><span>Delete Topic</span></span><span class="link-effect-r"><span>Delete Topic</span></span><span class="link-effect-shade"><span>Delete Topic</span></span></span></a>
                                        </div>
                                </div>
                            </div>
                        @endif
                        <div class="nk-forum-topic-content">
                            <p>{!!$post->PostBody!!}</p>

                            {{--<div class="nk-forum-topic-attachments">
                                <h4 class="h5">Attachments</h4>
                                <a href="#">godlike-free.zip</a>
                                <br>
                                (14.86 MiB) Downloaded 185 times
                            </div>--}}
                        </div>
                        <div class="nk-forum-topic-footer">
                            <span class="nk-forum-topic-date">{{date("M d, Y", strtotime($post->PostDate))}}</span>
                            @if (!$data['forum']->signature)
                            @else
                                <div class="text-center">
                                    <span class="nk-forum-topic-sig">{!!$data['forum']->signature->Signature!!}</span>
                                </div>
                            @endif

                            @if ($data['User']['LoginStatus']==true)
                                <span class="nk-forum-action-btn">
                                    <a href="#forum-reply" class="nk-anchor"><span class="fa fa-reply"></span> Reply</a>
                                </span>
                                <span class="nk-forum-action-btn">
                                    <a href="#"><span class="fa fa-flag"></span> Spam</a>
                                </span>
                                <span class="nk-forum-action-btn">
                                    <span class="nk-action-heart">
                                        <span class="num">{{$data['forum']->postLikes->Likes}}</span>
                                        <span class="like-icon ion-android-favorite-outline"></span>
                                        <span class="liked-icon ion-android-favorite"></span>
                                        Like
                                    </span>
                                </span>
                            @else
                                <span class="nk-forum-action-btn">
                                    <span class="nk-action-heart">
                                        <span class="num">{{$data['forum']->postLikes->Likes}}</span>
                                        <span class="like-icon ion-android-favorite-outline"></span>
                                        <span class="liked-icon ion-android-favorite"></span>
                                    </span>
                                </span>
                            @endif
                        </div>
                    </li>
                    {{--<div style="border-top: 1px solid #181818;display: block;"></div>--}}

                @endforeach
                </ul>
                @else
                    <p>No Posts found. Please check back later.</p>
            @endif
            <!-- END: Forums List -->
            <div id="forum-reply"></div>
            <div class="nk-gap-4"></div>
            @if ($data['User']['LoginStatus']==true)
                <!-- START: Reply -->
                <h3 class="h4">Reply</h3>
                <p id="response"></p>
                <form method="post">
                    <div class="nk-gap-1"></div>
                    <textarea class="nk-summernote" name="content" id="content"></textarea>
                    <div class="nk-gap-1"></div>
                    <button class="nk-btn nk-btn-lg link-effect-4" id="reply_submit">Reply</button>
                    <input type="hidden" name="topicid" id="topicid" value="{{$topicID}}"/>
                    <input type="hidden" name="postauthor" id="postauthor" value="{{$data['User']['DisplayName']}}"/>
                </form>
            @else
                <h4 class="text-center">You must be logged in to reply.</h4>
            @endif
            <!-- END: Reply -->
        </div>
    @php Separator(120); @endphp
    </div>
    <script>
        $(document).ready(function(){
            $("button#reply_submit").click(function(e){
                e.preventDefault();

                var content            = $("#content").val();
                var topicid            = $("#topicid").val();
                var postauthor         = $("#postauthor").val();

                $.ajax(
                    {
                        url: '/resources/jquery/addons/ajax/site/forum/reply.submit.php',
                        method: 'POST',
                        data: {
                            sent: 1,
                            topicid: topicid,
                            postbody: content,
                            postauthor: postauthor
                        },
                        success: function(response) {
                            $("#response").html(response);
                        },
                        dataType: 'text'
                    }
                )
            });
            $(document).on('click', '.open_discord_modal', function (e) {
                e.preventDefault();

                var uid = $(this).data("id");

                $('#discord_modal #dynamic-content').html('');
                $('#discord_modal #modal-loader').show();
                $.ajax({
                    url: "/resources/jquery/addons/ajax/blade/init.forum_social_discord.php",
                    type: 'POST',
                    data: "id="+uid,
                    dataType: 'html'
                })
                .done(function (data) {
                    $('#discord_modal #dynamic-content').html('');
                    $('#discord_modal #dynamic-content').html(data);
                    $('#discord_modal #modal-loader').hide();
                })
                .fail(function () {
                    $('#discord_modal #dynamic-content').html('<i class="fa fa-exclamation-triangle"></i> Something went wrong, Please try again...');
                    $('#discord_modal #modal-loader').hide();
                });
            });
        });
    </script>
@endsection