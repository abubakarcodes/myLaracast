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
            @if(auth()->user())
                 <a href="{{route('series.lessons' , [ $series , $series->lessons()->orderBy('episode_number' , 'asc')->first()->id] )}}" class="btn btn-dark btn-lg animate__animated animate__tada animate__repeat-3">Continue Watching Series <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
            @else
            <a href="#" data-toggle="modal"
            data-target="#loginModal" class="btn btn-dark btn-lg animate__animated animate__tada animate__repeat-3">Continue Watching Series <i class="fa fa-angle-double-right" aria-hidden="true"></i></a>
            @endif
        </div>
</div>
<div class="container-fluid my-2">
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="/">Home</a></li>
          <li class="breadcrumb-item active" aria-current="page">Series</li>
        </ol>
      </nav>
    <div class="row">
        <div class="col-md-12">
        <div id="accordion">
            <div class="card-header text-center">
                <h1>Lessons</h1>
            </div>
            @foreach($series->lessons as $lesson)
            <div class="card">
              <div class="card-header" id="headingOne{{$lesson->id}}" data-toggle="collapse" data-target="#collapseOne{{$lesson->id}}" aria-expanded="true" aria-controls="collapseOne{{$lesson->id}}">
                <h5 class="mb-0">
                  <button class="btn btn-link">
                    {{$lesson->title}}
                  </button>
                </h5>
              </div>

              <div id="collapseOne{{$lesson->id}}" class="collapse" aria-labelledby="headingOne{{$lesson->id}}" data-parent="#accordion">
                <div class="card-body">
                  {{$lesson->description}}
                </div>
              </div>
            </div>
            @endforeach
          </div>
    </div>
        </div>
    </div>
</div>
@endsection
