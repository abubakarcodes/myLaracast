@extends('layouts.app')
@section('content')
    <div id="carouselId" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner" role="listbox">
            <div class="carousel-item active">
            <img class="w-100 d-block"  src="{{asset('series/image1.jpg')}}" alt="First slide">
            <div class="carousel-caption">
                <div class="jumbotron jumbotron-fluid" style="background-color:white; opacity:0.5">
                    <div class="row justify-content-center">
                        <div class="col-md-12 text-center">
                        <h2 style="color:green">Welcome To Laracast!</h2>
                        </div>
                        <div style="color:black" class="col-md-12 text-center">
                            <h3>Great Opportunity to Learn Courses!</h3>
                        <p>
                            Laracast is a course Web Application I created it for just learning purposes or as porfolio project
                            because its a simple project so may be design is not good hence its fully functional has good functionality created with vue.js and laravel framework.
                        </p>
                        </div>
                    </div>
            </div>
            </div>
            </div>
            @foreach($series as $mySeries)
            <div class="carousel-item">
                <img class="w-100 d-block"  src="{{asset('series/' . $mySeries->imageUrl)}}" alt="Second slide">
                <div class="carousel-caption">
                    <div class="jumbotron jumbotron-fluid" style="background-color:white; opacity:0.5">
                        <div class="row justify-content-center">
                            <div class="col-md-12 text-center">
                            <h2 style="color:green">Welcome To Course!</h2>
                            </div>
                            <div style="color:black" class="col-md-12 text-center">
                                <h3>{{substr(strtoupper($mySeries->title) , 0 , 50)}}</h3>
                            <p>
                                {{substr($mySeries->description , 0 , 100)}}
                            </p>
                            </div>
                        </div>
                </div>
                </div>
            </div>
            @endforeach

        </div>
        <a class="carousel-control-prev" href="#carouselId" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselId" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>

<div class="container">
    <div class="header my-5 text-center">
        <h1>All Series</h1>
    </div>
   <div class="row">
    <div class="col-md-12">
    <form action="{{route('search')}}" method="GET">
            <div class="form-group">
                <input name="search" type="text" class="form-control form-control-lg" placeholder="Search">
            </div>
            <div class="d-flex justify-content-center">
                <button class="btn btn-success btn-lg"><i class="fa fa-search" aria-hidden="true"></i> Search For Series</button>
            </div>
        </form>
    </div>
   </div>
    @foreach($series as $singleSeries)
    <div class="row my-5">
        <div class="col-md-6">
        <a href="{{route('series.show' , $singleSeries)}}"><img src="{{asset('series/' . $singleSeries->imageUrl)}}"  class="w-100 img-thumbnail" alt=""></a>
        </div>
        <div class="col-md-6">
         <div class="my-3">
            <h2>{{$singleSeries->title}}</h2>
            <p>{{$singleSeries->description}}</p>
            <h5><a href="{{route('series.show' , $singleSeries)}}">read more <i class="fa fa-angle-double-right" aria-hidden="true"></i></a></h5>
         </div>
        </div>
    </div>
    @endforeach
        <div class="pagination justify-content-center">
            {{$series->links()}}
        </div>
    <br>
</div>
@endsection
