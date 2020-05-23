@extends('layouts.app')
@section('content')
<div class="container-fluid" style="background: url('{{asset('series/' . $series->imageUrl)}}'); background-repeat: no-repeat;  background-size:100% 400px; height:400px;">
        <div class="row justify-content-center">
            <div class="col-md-12 text-center mt-5">
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
@php
  $nextLesson = $lesson->nextLesson();
  $previousLesson = $lesson->previousLesson();
@endphp
<div class="container-fluid my-2">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="/">Home</a></li>
        <li class="breadcrumb-item"><a href="{{route('series.show' , $series)}}">Series</a></li>
          <li class="breadcrumb-item active" aria-current="page">Lessons</li>
        </ol>
      </nav>
    <div class="row justify-content-center">
    <vimeo-player default_lesson="{{$lesson}}"
    @if($nextLesson)
    next_lesson_url="{{route('series.lessons' , [$series , $nextLesson->id])}}"
    @endif
    ></vimeo-player>
    </div>
    <div class="d-flex justify-content-center">
        @if($previousLesson)
    <a href="{{route('series.lessons' , [$series , $previousLesson->id])}}" class="btn btn-outline-primary m-auto p-2"><i class="fa fa-arrow-left" aria-hidden="true"></i> Previous Lesson</a>
        @endif
        @if($nextLesson)
    <a href="{{route('series.lessons' , [$series , $nextLesson->id])}}" class="btn btn-outline-primary m-auto p-2">Next Lesson <i class="fa fa-arrow-right" aria-hidden="true"></i></a>
        @endif
</div>
<div class="row justify-content-center mt-5">
    <h3>Lessons Listing</h3>
</div>
<div class="row justify-content-center">
    <div class="col-md-8">
        <ul class="list-group">
            @foreach($series->getOrderedLessons() as $currentLesson)
        <li class="list-group-item {{$currentLesson->id == $lesson->id ? "active text-white" : ''}}">
            <a class="{{$currentLesson->id == $lesson->id ? "text-white" : ''}}" href="{{route('series.lessons' , [ $series , $currentLesson->id] )}}">{{$currentLesson->title}}</a>
            </li>
            @endforeach
        </ul>
    </div>
</div>
    </div>
</div>
@endsection
