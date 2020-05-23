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
                    @php
                     $userPlan = isset($user->subscriptions->first()->name) ? $user->subscriptions->first()->name : "";
                    @endphp
                    <h3>Current Plan
                        @if($userPlan == 'price_HHscK4hA3OppYy')
                        <span class="badge badge-primary">Monthly</span>
                        @elseif($userPlan == 'price_HHseeeuTgOe3DY')
                        <span class="badge badge-danger">Yearly</span>
                        @endif
                    </h3>

                <form action="{{route('update.plan')}}" method="post">
                    @csrf
                        <div class="form-group">
                            <div class="form-group">
                              <label for="">Select Plan</label>
                              <select class="form-control" name="plan">
                                <option value="">--select plan--</option>
                                <option value="price_HHscK4hA3OppYy">Monthly</option>
                                <option value="price_HHseeeuTgOe3DY">Yearly</option>
                              </select>
                            </div>
                        </div>
                        <button class="btn btn-success"><i class="fa fa-refresh" aria-hidden="true"></i> Change Plan</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
