@extends('layouts.app')

@section('content')
   <div class="py-4">
    <div class="row justify-content-center" style="margin-right: 0px!important;">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{trans('main.postArticle')}}</div>
                <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        <form action="{{url('article/new')}}" method="POST">
                        <div class="form-group">
                            <label for="exampleFormControlInput1">{{trans('main.ArticleCaption')}}</label>
                            <input required type="name" name='header' maxlength="120" class="form-control" id="exampleFormControlInput1" placeholder="Caption for your article">
                        </div>

                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">{{trans('main.ArticleText')}}</label>
                            <textarea required name='description' class="form-control" id="exampleFormControlTextarea1" maxlength="5000" rows="15" placeholder="{{trans('main.TextArea')}}"></textarea>
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
                        </div>

                        <button type="submit" style="float: right;" class="btn btn-outline-primary">{{trans('main.save')}}</button>
                    </form>

                </div>
            </div>
        </div>
    <!-- Scripts -->
    <script src="{{ asset('js/article.js') }}" defer></script>
@endsection