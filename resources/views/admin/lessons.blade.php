@extends('layouts.app')
@section('content')
<div class="container-fluid" style="background: url('{{asset('series/' . $series->imageUrl)}}'); background-repeat: no-repeat; height:400px; background-size:100%;">
    <div class="jumbotron jumbotron-fluid" style="background-color:white; opacity:0.5; margin-bottom:0px; padding-bottom:0px">
        <div class="row justify-content-center">
            <div class="col-md-12 text-center">
            <h1 style="color:green">Welcome To Course!</h1>
            </div>
            <div class="col-md-12 text-center">
                <h2>{{substr(strtoupper($series->title) , 0 , 50)}}</h2>
            <p>
                {{substr($series->description , 0 , 100)}}
            </p>
            </div>
        </div>
</div>
</div>
<div class="container-fluid my-2">
    <div class="row">
        <div class="col-md-12">
        @if(auth()->check())
        @if(auth()->user()->isAdmin())
        <series-lessons default_lessons="{{$series->lessons}}" series_id="{{$series->id}}"></series-lessons>
        @endif
        @endif

    </div>
        </div>
    </div>
</div>
@endsection
