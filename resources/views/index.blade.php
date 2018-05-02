@extends('layouts.app')

@section('content')


        <!-- Main jumbotron for a primary marketing message or call to action -->
        <div class="jumbotron">
            <div class="container">
                <h1 class="display-3">Newsboard</h1>
                <p>{{trans('main.headerText')}}</p>
                <p><a class="btn btn-primary btn-lg" href="/articles" role="button">{{trans('main.toNewsPage')}} &raquo;</a></p>
            </div>
        </div>

        <div class="container">
            <!-- Example row of columns -->
            <div class="row">
            @foreach ($articles as $article)

                    <div class="col-md-4">
                        <h2><a style="color: #3d4145;" href="article/{{$article->id}}">{{$article->header}}</a></h2>
                        <p>{{mb_substr($article->desc,0,99)}}... </p>
                        <p><a class="btn btn-secondary" href="article/{{$article->id}}" role="button">{{trans('main.viewdetails')}} &raquo;</a></p>
                    </div>
            @endforeach
            </div>






            <hr>

        </div> <!-- /container -->
        <footer class="footer">
            <div class="container">
                <span class="text-muted">{{trans('main.footertext')}}</span>
            </div>
        </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script>window.jQuery || document.write('<script src="../../../../assets/js/vendor/jquery-slim.min.js"><\/script>')</script>

@endsection