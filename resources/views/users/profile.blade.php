@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{$user->name}}</div>
                <div class="card-body">
                    <div class="row" style="text-align: center;">
                    <div class="col-md-4">
                        {{trans('main.subs')}}

                        @if($issubed === 'not-user' OR $visitor_id === $user->id)
                        <div id="sub_button_block" class="subbers_counter"><button id="sub_button"  class="btn btn-outline-danger" disabled>{{trans('main.subscribe').': '}}
                                <span id="subs_counter">{{$subs}}</span></button></div>
                        @endif
                            @if($issubed === 'unsub' AND $visitor_id != $user->id)
                        <div id="sub_button_block" class="subbers_counter"><button id="sub_button" onclick="Subscribe({{$user->id}})" class="btn btn-outline-danger">{{trans('main.subscribe').':'}}
                                <span id="subs_counter">{{$subs}}</span></button></div>
                            @endif
                            @if($issubed === 'sub' AND $visitor_id != $user->id)
                        <div id="sub_button_block" class="subbers_counter"><button id="sub_button" onclick="Unsubscribe({{$user->id}})" class="btn btn-outline-danger">{{trans('main.unsubscribe').':'}}
                                <span id="subs_counter">{{$subs}}</span></button></div>
                        @endif

                    </div>
                        <div class="col-md-4">
                            {{trans('main.articles')}}
                            <div id="articles_button_block" class="articles_counter"><button  class="btn btn-outline-danger">{{trans('main.articles').': '.$articles}}</button></div>

                        </div>
                        <div class="col-md-4">
                            {{trans('main.comments')}}
                            <div id="comments_button_block" class="comments_counter"><button  class="btn btn-outline-danger">{{trans('main.comments').': '.$comments}}</button></div>
                        </div>


                    </div>
                    @if($visitor_id === $user->id)
                        <hr>
                        <ul class="list-group">
                            <li class="list-group-item">{{trans('main.email').': '.$user->email}}</li>
                            <li class="list-group-item">{{trans('main.APItoken').': '.$user->token}}</li>
                            <li class="list-group-item"><strong><a href="{{url('articles/my')}}">{{trans('main.articlesController')}}</a></strong></li>
                        </ul>
                    @endif
                    @if(count($user_articles) > 0)
                        <hr>
                        <ul class="list-group"><h4>{{trans('main.articles')}}</h4>
                        @foreach($user_articles as $article)
                                <li class="list-group-item"><a href="{{url('article/'.$article->id)}}">{{$article->header}}</a></li>
                        @endforeach
                        </ul>
                        @endif
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Scripts -->
<script src="{{ asset('js/User.js') }}" defer></script>
@endsection
