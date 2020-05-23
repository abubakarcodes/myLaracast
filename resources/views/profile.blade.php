@extends('layouts.app')
@section('content')
<div class="container">
    <div class="row my-5">
        <div class="col-md-4">
            @include('layouts.inc.profileSidebar')
        </div>
        <div class="col-md-8">
            <div class="card">
                <div class="card-header"><h3><i class="fa fa-user" aria-hidden="true"></i> Profile</h3></div>
                <div class="card-body">
                    @if(session()->has('message'))
                    <div class="alert alert-danger">
                        {{session()->get('message')}}
                    </div>
                    @endif
                    <table class="table table-light">
                        <thead>
                            <tr>
                                <th>Name</th>
                            <th>{{$user->name}}</th>
                            </tr>
                            <tr>
                                <th>Email</th>
                            <th>{{$user->email}}</th>
                            </tr>
                            <tr>
                                <th>username</th>
                            <th>{{$user->username}}</th>
                            </tr>
                            <tr>
                                <th>Plan</th>
                                @php
                                    $userPlan = isset($user->subscriptions->first()->name) ? $user->subscriptions->first()->name : "";
                                @endphp
                                @if($userPlan == 'price_HHscK4hA3OppYy')
                            <th><span class="badge badge-pill badge-primary">Monthly</span><a class="ml-2" href="{{route('change.plan')}}"> <span>Change Plan</span></a></th>
                            @elseif($userPlan == 'price_HHseeeuTgOe3DY')
                            <th><span class="badge badge-pill badge-danger">Yearly</span> <a class="ml-2" href="{{route('change.plan')}}"> <span>Change Plan</span></a></th>
                            @else
                            <th><span class="badge badge-pill badge-dark">No Plan</span> <a class="ml-2" href="{{route('checkout')}}"> <span>Subscribe Plan</span></a></th>
                            @endif
                            </tr>
                        </thead>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
