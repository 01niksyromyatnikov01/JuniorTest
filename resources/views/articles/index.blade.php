@extends('layouts.app')

@section('content')
    <div class="container py-4">
        @if (count($articles) > 0)
            <div class="panel panel-default center  col-md-10">
                <div class="panel-heading ">
                    <h3>{{trans('main.news')}}</h3>
                </div>
                <div class="panel-body">
                    <table class="table table-striped task-table">
                        <tbody>
                        @foreach ($articles as $article)
                            <tr>
                                <!-- Имя задачи -->
                                <td class="table-text">
                                    <div><h5><a href="article/{{$article->id}}">{{ $article->header }}</a></h5></div>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>

@endsection

