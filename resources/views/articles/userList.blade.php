@extends('layouts.app')

@section('content')
    <div class="container py-4">
            <div class="panel panel-default center  col-md-10">
                <div class="panel-heading ">
                    <h3>{{trans('main.mynews')}}</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-striped task-table">
                        <tbody>
                        @if (count($articles) > 0)
                        @foreach ($articles as $article)
                            <tr id="tr_{{$article->id}}">
                                <!-- Имя задачи -->
                                <td class="table-text">
                                    <div><h5><a href="{{url('article/'.$article->id)}}">{{ $article->header }}</a></h5></div>
                                </td>
                                <td>@if($article->active == 0)
                                    <button id="btn_{{$article->id}}" class="btn btn-sm btn-outline-primary" onclick="Update('{{$article->id}}',1,'{{trans('main.active')}}')" style="float: right" >{{trans('main.publish')}}</button>
                                  @else
                                        <button id="btn_{{$article->id}}" class="btn btn-sm btn-outline-success"  onclick="Update('{{$article->id}}',0,'{{trans('main.publish')}}')"  >{{trans('main.active')}}</button>
                                    @endif
                                </td>
                                <td><i id="icon_delete" onclick="Delete('{{$article->id}}')" style="float: right" class="fas fa-trash-alt"></i></td>
                            </tr>
                        @endforeach
                        @else
                            <tr><td class="table-text">{{trans('main.nothingToShow')}}</td></tr>
                        @endif
                        </tbody>
                    </table>
                </div>
            </div>

    </div>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css" integrity="sha384-+d0P83n9kaQMCwj8F4RJB66tzIwOKmrdb46+porD/OvrJ+37WqIM7UoBtwHO6Nlg" crossorigin="anonymous">
    <script src="{{ asset('js/article.js') }}" defer></script>
@endsection

