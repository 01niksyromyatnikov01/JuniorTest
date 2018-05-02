@extends('layouts.app')

@section('content')
<div class="py-4">

<div class="container col-md-7">
    <h1>{{$article->header}}</h1>
    <p class="article-paragraph">{{$article->desc}}</p>

    <p class="author_name"><span class="trans-text">{{trans('main.postBy')}}</span><strong><a href="{{url('user/'.$article->user_id)}}">{{$author}}</a></strong>
        <span class="postdate">{{trans('main.postAt',['datetime' => $article->updated_at])}}</span></p>


        <div class="comments" style="text-align: center;">
            <button id="comments_button" class="btn btn-outline-primary" onclick="getComments( {{$article->id}} )">{{trans('main.showComments')}}</button>
        <hr>
            <div id="comments_container" class="col-md-10 center" style="display: none;text-align: left">
                @auth
                    <li class="list-group-item comment_info" onclick="ShowForm()">{{trans('main.addcomment')}}</li>
                    <li id="add_comment_block" class="list-qroup-item" style="display:none;"><textarea class="form-control" maxlength="230" id="CommentTextForm" rows="2" placeholder="{{trans('main.typeCommentHere')}}"></textarea>
                    <button id="button_send_comment" onclick="SendComment('{{$article->id}}')" class="btn btn-outline-success">{{trans('main.send')}}</button></li>
                    @else
                        <li class="list-group-item comment_info">{{trans('main.logIntoAddComment')}}</li>
                        @endauth
                <ul id="comments_list" class="list-group">
                </ul>
            </div>
        </div>
</div>
</div>
<!-- Scripts -->
<script src="{{ asset('js/article.js') }}" defer></script>
@endsection